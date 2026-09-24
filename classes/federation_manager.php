<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Federation login manager.
 *
 * @package    auth_saml2
 * @copyright  2026 moxis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace auth_saml2;

use context_system;
use moodle_exception;
use moodle_url;

defined('MOODLE_INTERNAL') || die();

/**
 * CRUD and metadata helpers for federated logins.
 *
 * @package    auth_saml2
 * @copyright  2026 moxis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class federation_manager {
    /** File area for federation button logos. */
    public const LOGO_FILEAREA = 'federationlogo';

    /** Prefix for the synthetic active IdP entityid that represents a federation. */
    public const IDP_ENTITY_PREFIX = 'federation:';

    /** Visible for all tenants (default). */
    public const TENANT_MODE_ALL = 0;
    /** Visible only for selected tenants. */
    public const TENANT_MODE_INCLUDE = 1;
    /** Visible for all tenants except selected. */
    public const TENANT_MODE_EXCLUDE = 2;

    /** Logo when a file exists, otherwise the label. */
    public const BUTTON_AUTO = 0;
    /** Logo before the label, or the label when there is no logo. */
    public const BUTTON_BOTH = 1;

    /**
     * Whether Moodle Workplace tenancy is available.
     *
     * @return bool
     */
    public static function tenancy_available(): bool {
        return class_exists(\tool_tenant\tenancy::class);
    }

    /**
     * Decode tenant id list from a federation record.
     *
     * @param object $federation
     * @return int[]
     */
    public static function get_tenant_ids(object $federation): array {
        if (empty($federation->tenantids)) {
            return [];
        }
        $decoded = json_decode($federation->tenantids, true);
        if (!is_array($decoded)) {
            return [];
        }
        return array_values(array_filter(array_map('intval', $decoded)));
    }

    /**
     * Whether the federation is available for the current tenant context.
     *
     * Non-Workplace sites always return true.
     *
     * @param object $federation
     * @return bool
     */
    public static function is_available_for_current_tenant(object $federation): bool {
        if (!self::tenancy_available()) {
            return true;
        }

        $mode = isset($federation->tenantmode) ? (int) $federation->tenantmode : self::TENANT_MODE_ALL;
        $tenantid = (int) \tool_tenant\tenancy::get_tenant_id();
        $ids = self::get_tenant_ids($federation);

        switch ($mode) {
            case self::TENANT_MODE_INCLUDE:
                return in_array($tenantid, $ids, true);
            case self::TENANT_MODE_EXCLUDE:
                return !in_array($tenantid, $ids, true);
            case self::TENANT_MODE_ALL:
            default:
                return true;
        }
    }

    /**
     * Human-readable tenant mode summary for admin lists.
     *
     * @param object $federation
     * @return string
     */
    public static function get_tenant_mode_label(object $federation): string {
        if (!self::tenancy_available()) {
            return '';
        }
        $mode = isset($federation->tenantmode) ? (int) $federation->tenantmode : self::TENANT_MODE_ALL;
        $count = count(self::get_tenant_ids($federation));
        switch ($mode) {
            case self::TENANT_MODE_INCLUDE:
                return get_string('federation_tenantmode_include_summary', 'auth_saml2', $count);
            case self::TENANT_MODE_EXCLUDE:
                return get_string('federation_tenantmode_exclude_summary', 'auth_saml2', $count);
            case self::TENANT_MODE_ALL:
            default:
                return get_string('federation_tenantmode_all', 'auth_saml2');
        }
    }

    /**
     * Tenant id => name map for forms (Workplace only).
     *
     * @return array<int, string>
     */
    public static function get_tenant_options(): array {
        if (!self::tenancy_available()) {
            return [];
        }
        $options = [];
        foreach (\tool_tenant\tenancy::get_tenants() as $tenant) {
            $options[(int) $tenant->id] = format_string($tenant->name);
        }
        return $options;
    }

    /**
     * Get federations ordered by sortorder then shortname.
     *
     * @param bool $onlyenabled When true, only enabled federations.
     * @return object[]
     */
    public static function get_all(bool $onlyenabled = false): array {
        global $DB;
        $conditions = $onlyenabled ? ['enabled' => 1] : null;
        return $DB->get_records('auth_saml2_federations', $conditions, 'sortorder ASC, shortname ASC');
    }

    /**
     * Next sortorder value for a new federation.
     *
     * @return int
     */
    public static function get_next_sortorder(): int {
        global $DB;
        $max = $DB->get_field_sql('SELECT MAX(sortorder) FROM {auth_saml2_federations}');
        return $max === false || $max === null ? 0 : ((int) $max + 1);
    }

    /**
     * Enable a federation.
     *
     * @param int $id
     * @return bool
     */
    public static function enable(int $id): bool {
        global $DB;
        $federation = self::get_by_id($id);
        if (!$federation) {
            return false;
        }
        $result = $DB->set_field('auth_saml2_federations', 'enabled', 1, ['id' => $id]);
        if ($result) {
            $federation->enabled = 1;
            self::sync_active_idp($federation);
            event\federation_updated::create_from_federation($federation, ['enabled' => 1])->trigger();
        }
        return $result;
    }

    /**
     * Disable a federation.
     *
     * @param int $id
     * @return bool
     */
    public static function disable(int $id): bool {
        global $DB;
        $federation = self::get_by_id($id);
        if (!$federation) {
            return false;
        }
        $result = $DB->set_field('auth_saml2_federations', 'enabled', 0, ['id' => $id]);
        if ($result) {
            $federation->enabled = 0;
            self::sync_active_idp($federation);
            event\federation_updated::create_from_federation($federation, ['enabled' => 0])->trigger();
        }
        return $result;
    }

    /**
     * Move federation up in sort order.
     *
     * @param int $id
     * @return bool
     */
    public static function move_up(int $id): bool {
        return self::swap_sortorder($id, -1);
    }

    /**
     * Move federation down in sort order.
     *
     * @param int $id
     * @return bool
     */
    public static function move_down(int $id): bool {
        return self::swap_sortorder($id, 1);
    }

    /**
     * Swap position with neighbour, then renumber.
     *
     * @param int $id
     * @param int $direction -1 up, +1 down
     * @return bool
     */
    private static function swap_sortorder(int $id, int $direction): bool {
        global $DB;

        if (!self::get_by_id($id)) {
            return false;
        }
        self::renumber_sortorder();
        $all = array_values(self::get_all());
        $index = null;
        foreach ($all as $i => $fed) {
            if ((int) $fed->id === $id) {
                $index = $i;
                break;
            }
        }
        if ($index === null) {
            return false;
        }
        $swapindex = $index + $direction;
        if ($swapindex < 0 || $swapindex >= count($all)) {
            return false;
        }
        $other = $all[$swapindex];
        $DB->set_field('auth_saml2_federations', 'sortorder', $swapindex, ['id' => $id]);
        $DB->set_field('auth_saml2_federations', 'sortorder', $index, ['id' => $other->id]);
        return true;
    }

    /**
     * Renumber sortorder 0..n-1 in current order.
     */
    private static function renumber_sortorder(): void {
        global $DB;
        $all = $DB->get_records('auth_saml2_federations', null, 'sortorder ASC, shortname ASC', 'id');
        $order = 0;
        foreach ($all as $fed) {
            $DB->set_field('auth_saml2_federations', 'sortorder', $order, ['id' => $fed->id]);
            $order++;
        }
    }

    /**
     * Whether federation is enabled (default true for legacy rows).
     *
     * @param object $federation
     * @return bool
     */
    public static function is_enabled(object $federation): bool {
        return !isset($federation->enabled) || (int) $federation->enabled === 1;
    }

    /**
     * Save tenant availability for a federation (Workplace modal).
     *
     * @param int $id Federation id.
     * @param int $mode One of TENANT_MODE_* constants.
     * @param int[] $tenantids Tenant ids for include/exclude modes.
     * @throws moodle_exception
     * @throws \invalid_parameter_exception
     */
    public static function save_tenant_availability(int $id, int $mode, array $tenantids = []): void {
        global $DB;

        if (!self::tenancy_available()) {
            throw new moodle_exception('nopermissions', 'error', '', get_string('federation_tenantavailability', 'auth_saml2'));
        }
        if (!self::get_by_id($id)) {
            throw new moodle_exception('invalidrecord', 'error');
        }

        $allowed = [
            self::TENANT_MODE_ALL,
            self::TENANT_MODE_INCLUDE,
            self::TENANT_MODE_EXCLUDE,
        ];
        if (!in_array($mode, $allowed, true)) {
            throw new \invalid_parameter_exception(get_string('federation_tenantmode', 'auth_saml2'));
        }

        $tenantids = array_values(array_unique(array_filter(array_map('intval', $tenantids))));
        if (($mode === self::TENANT_MODE_INCLUDE || $mode === self::TENANT_MODE_EXCLUDE) && empty($tenantids)) {
            throw new \invalid_parameter_exception(get_string('federation_tenantids_required', 'auth_saml2'));
        }

        $old = self::get_by_id($id);
        $oldtenantids = self::get_tenant_ids($old);

        $record = (object)[];
        $record->id = $id;
        $record->tenantmode = $mode;
        $record->tenantids = ($mode === self::TENANT_MODE_INCLUDE || $mode === self::TENANT_MODE_EXCLUDE)
            ? json_encode($tenantids)
            : null;
        $record->timemodified = time();
        $DB->update_record('auth_saml2_federations', $record);

        $federation = self::get_by_id($id);
        event\federation_tenant_availability_updated::create_from_federation($federation, [
            'tenantmode' => $mode,
            'tenantids' => $tenantids,
            'oldtenantmode' => isset($old->tenantmode) ? (int) $old->tenantmode : self::TENANT_MODE_ALL,
            'oldtenantids' => $oldtenantids,
        ])->trigger();
    }

    /**
     * Get a federation by id.
     *
     * @param int $id
     * @return object|false
     */
    public static function get_by_id(int $id) {
        global $DB;
        return $DB->get_record('auth_saml2_federations', ['id' => $id]);
    }

    /**
     * Get a federation by shortname.
     *
     * @param string $shortname
     * @return object|false
     */
    public static function get_by_shortname(string $shortname) {
        global $DB;
        return $DB->get_record('auth_saml2_federations', ['shortname' => $shortname]);
    }

    /**
     * Validate shortname: no spaces, unique.
     *
     * @param string $shortname
     * @param int|null $excludeid
     * @return string|null Error string or null if valid.
     */
    public static function validate_shortname(string $shortname, ?int $excludeid = null): ?string {
        if ($shortname === '' || preg_match('/\s/', $shortname)) {
            return get_string('federation_shortname_invalid', 'auth_saml2');
        }
        if (!preg_match('/^[A-Za-z0-9_-]+$/', $shortname)) {
            return get_string('federation_shortname_invalid', 'auth_saml2');
        }
        $existing = self::get_by_shortname($shortname);
        if ($existing && (int) $existing->id !== (int) $excludeid) {
            return get_string('federation_shortname_exists', 'auth_saml2');
        }
        return null;
    }

    /**
     * Save federation record and metadata; store logo draft files.
     *
     * @param object $data Form data including optional logo draft itemid.
     * @return int Federation id.
     * @throws moodle_exception
     */
    public static function save(object $data): int {
        global $DB;

        $now = time();
        $record = (object)[];
        $record->shortname = trim($data->shortname);
        $record->metadataurl = trim($data->metadataurl);
        $record->discourl = trim($data->discourl);
        $record->buttonlabel = trim($data->buttonlabel);
        $record->buttondisplay = self::normalise_button_display($data->buttondisplay ?? self::BUTTON_AUTO);
        $record->timemodified = $now;

        // Tenant availability (Workplace only; ignored elsewhere).
        if (self::tenancy_available() && property_exists($data, 'tenantmode')) {
            $mode = (int) $data->tenantmode;
            $tenantids = [];
            if ($mode === self::TENANT_MODE_INCLUDE) {
                $tenantids = array_map('intval', (array) ($data->tenantids_include ?? $data->tenantids ?? []));
            } else if ($mode === self::TENANT_MODE_EXCLUDE) {
                $tenantids = array_map('intval', (array) ($data->tenantids_exclude ?? $data->tenantids ?? []));
            }
            $tenantids = array_values(array_unique(array_filter($tenantids)));
            $record->tenantmode = $mode;
            $record->tenantids = ($mode === self::TENANT_MODE_INCLUDE || $mode === self::TENANT_MODE_EXCLUDE)
                ? json_encode($tenantids)
                : null;
        } else if (!self::tenancy_available()) {
            $record->tenantmode = self::TENANT_MODE_ALL;
            $record->tenantids = null;
        }

        $excludeid = !empty($data->id) ? (int) $data->id : null;
        $error = self::validate_shortname($record->shortname, $excludeid);
        if ($error !== null) {
            throw new \invalid_parameter_exception($error);
        }

        $isupdate = !empty($data->id);
        $old = null;
        if ($isupdate) {
            $old = self::get_by_id((int) $data->id);
            if (!$old) {
                throw new moodle_exception('invalidrecord', 'error');
            }
        }

        // Refetch only for a new federation, a changed metadata URL, or a missing cache.
        // Editing a logo must not fail when an already cached URL cannot be reached.
        $metadatachanged = !$old || $old->metadataurl !== $record->metadataurl;
        if ($metadatachanged || !self::has_metadata_file($record)) {
            self::fetch_and_store_metadata($record->metadataurl);
        }

        if ($isupdate) {
            $record->id = (int) $data->id;
            // If metadata URL changed, remove old cached file when unused.
            if ($old->metadataurl !== $record->metadataurl) {
                self::maybe_delete_metadata_file($old->metadataurl, $record->id);
            }
            $DB->update_record('auth_saml2_federations', $record);
            $id = $record->id;
        } else {
            $record->timecreated = $now;
            if (!isset($record->enabled)) {
                $record->enabled = 1;
            }
            if (!isset($record->sortorder)) {
                $record->sortorder = self::get_next_sortorder();
            }
            $id = $DB->insert_record('auth_saml2_federations', $record);
        }

        if (isset($data->logo)) {
            $context = context_system::instance();
            file_save_draft_area_files(
                $data->logo,
                $context->id,
                'auth_saml2',
                self::LOGO_FILEAREA,
                $id,
                ['subdirs' => 0, 'maxfiles' => 1]
            );
        }

        $federation = self::get_by_id($id);
        if ($isupdate && $old && $old->shortname !== $federation->shortname) {
            self::delete_active_idp($old->shortname);
        }
        self::sync_active_idp($federation);
        if ($isupdate) {
            event\federation_updated::create_from_federation($federation)->trigger();
        } else {
            event\federation_created::create_from_federation($federation)->trigger();
        }

        return $id;
    }

    /**
     * Delete a federation, its logo files, and unused metadata cache.
     *
     * @param int $id
     * @return bool
     */
    public static function delete(int $id): bool {
        global $DB;

        $record = self::get_by_id($id);
        if (!$record) {
            return false;
        }

        $event = event\federation_deleted::create_from_federation($record);

        $DB->delete_records('auth_saml2_federations', ['id' => $id]);
        self::delete_active_idp($record->shortname);

        $context = context_system::instance();
        $fs = get_file_storage();
        $fs->delete_area_files($context->id, 'auth_saml2', self::LOGO_FILEAREA, $id);

        self::maybe_delete_metadata_file($record->metadataurl, $id);

        $event->trigger();

        return true;
    }

    /**
     * Fetch federation metadata XML and store under dataroot/saml2.
     *
     * @param string $metadataurl
     * @throws moodle_exception
     */
    public static function fetch_and_store_metadata(string $metadataurl): void {
        $fetcher = new metadata_fetcher();
        $xml = $fetcher->fetch($metadataurl);
        if (empty($xml) || stripos($xml, 'EntityDescriptor') === false && stripos($xml, 'EntitiesDescriptor') === false) {
            throw new moodle_exception('idpmetadata_invalid', 'auth_saml2');
        }
        $writer = new metadata_writer();
        $writer->write(md5($metadataurl) . '.idp.xml', $xml);
    }

    /**
     * Refresh metadata for all configured federations.
     *
     * @return int Number refreshed successfully.
     */
    public static function refresh_all_metadata(): int {
        $count = 0;
        foreach (self::get_all() as $federation) {
            try {
                self::fetch_and_store_metadata($federation->metadataurl);
                $count++;
            } catch (\Throwable $e) {
                mtrace('Federation metadata refresh failed for ' . $federation->shortname . ': ' . $e->getMessage());
            }
        }
        return $count;
    }

    /**
     * Path to cached metadata file for a metadata URL.
     *
     * @param string $metadataurl
     * @return string
     */
    public static function get_metadata_filepath(string $metadataurl): string {
        global $CFG;
        return $CFG->dataroot . '/saml2/' . md5($metadataurl) . '.idp.xml';
    }

    /**
     * Whether the metadata file exists for this federation.
     *
     * @param object $federation
     * @return bool
     */
    public static function has_metadata_file(object $federation): bool {
        return file_exists(self::get_metadata_filepath($federation->metadataurl));
    }

    /**
     * Restrict button display to a known mode.
     *
     * @param int|string $display
     * @return int
     */
    public static function normalise_button_display($display): int {
        $display = (int) $display;
        $allowed = [self::BUTTON_AUTO, self::BUTTON_BOTH];
        return in_array($display, $allowed, true) ? $display : self::BUTTON_AUTO;
    }

    /**
     * Label and logo to render on the login button for the selected display mode.
     *
     * Default prefers the logo. Both always keeps the label, with the logo first when present.
     *
     * @param object $federation
     * @return array{name: string, iconurl: moodle_url|null}
     */
    public static function login_button_parts(object $federation): array {
        $display = self::normalise_button_display($federation->buttondisplay ?? self::BUTTON_AUTO);
        $logourl = self::get_logo_url((int) $federation->id);
        $showlogo = (bool) $logourl;
        $showlabel = $display === self::BUTTON_BOTH || !$showlogo;
        return [
            'name' => $showlabel ? $federation->buttonlabel : '',
            'iconurl' => $showlogo ? $logourl : null,
        ];
    }

    /**
     * Entity id used for the synthetic active IdP that represents a federation.
     *
     * Workplace treats login buttons as active IdPs only when they pass an idp
     * hash. This entity id is that IdP; it is not a real SAML entity.
     *
     * @param string $shortname
     * @return string
     */
    public static function idp_entityid(string $shortname): string {
        return self::IDP_ENTITY_PREFIX . $shortname;
    }

    /**
     * md5 of the synthetic IdP entity id. This is the login button idp param.
     *
     * @param string $shortname
     * @return string
     */
    public static function idp_md5(string $shortname): string {
        return md5(self::idp_entityid($shortname));
    }

    /**
     * Whether an IdP entity id belongs to a federation login, not a configured IdP.
     *
     * @param string $entityid
     * @return bool
     */
    public static function is_federation_entityid(string $entityid): bool {
        return strpos($entityid, self::IDP_ENTITY_PREFIX) === 0;
    }

    /**
     * Federation for a login idp hash, if that hash is a synthetic federation IdP.
     *
     * @param string $md5entityid
     * @return object|false
     */
    public static function get_by_idp_md5(string $md5entityid) {
        if ($md5entityid === '') {
            return false;
        }
        foreach (self::get_all() as $federation) {
            if (self::idp_md5($federation->shortname) === $md5entityid) {
                return $federation;
            }
        }
        return false;
    }

    /**
     * Keep one active IdP row per federation so it is always an active IdP.
     *
     * The enabled flag only controls the login button. It must not clear activeidp.
     *
     * @param object $federation
     */
    public static function sync_active_idp(object $federation): void {
        global $DB;

        $entityid = self::idp_entityid($federation->shortname);
        $button = self::login_button_parts($federation);
        $record = (object) [
            'metadataurl' => $federation->metadataurl,
            'entityid' => $entityid,
            'activeidp' => 1,
            'defaultidp' => 0,
            'adminidp' => 0,
            'defaultname' => $federation->buttonlabel,
            'displayname' => $button['name'],
            'logo' => $button['iconurl'] ? $button['iconurl']->out(false) : '',
            'alias' => null,
            'whitelist' => null,
        ];

        $existing = $DB->get_record('auth_saml2_idps', ['entityid' => $entityid]);
        if ($existing) {
            $record->id = $existing->id;
            $DB->update_record('auth_saml2_idps', $record);
            return;
        }
        $DB->insert_record('auth_saml2_idps', $record);
    }

    /**
     * Remove the synthetic active IdP for a federation shortname.
     *
     * @param string $shortname
     */
    public static function delete_active_idp(string $shortname): void {
        global $DB;
        $DB->delete_records('auth_saml2_idps', ['entityid' => self::idp_entityid($shortname)]);
    }

    /**
     * Public URL for federation logo, if any.
     *
     * @param int $federationid
     * @return moodle_url|null
     */
    public static function get_logo_url(int $federationid): ?moodle_url {
        $context = context_system::instance();
        $fs = get_file_storage();
        $files = $fs->get_area_files($context->id, 'auth_saml2', self::LOGO_FILEAREA, $federationid, 'itemid, filepath, filename', false);
        $file = reset($files);
        if (!$file) {
            return null;
        }
        return moodle_url::make_pluginfile_url(
            $context->id,
            'auth_saml2',
            self::LOGO_FILEAREA,
            $federationid,
            $file->get_filepath(),
            $file->get_filename()
        );
    }

    /**
     * Delete cached metadata file if no other federation (or IdP) still uses the same URL.
     *
     * @param string $metadataurl
     * @param int $excludefederationid
     */
    private static function maybe_delete_metadata_file(string $metadataurl, int $excludefederationid): void {
        global $DB;

        $others = $DB->count_records_select(
            'auth_saml2_federations',
            'metadataurl = ? AND id <> ?',
            [$metadataurl, $excludefederationid]
        );
        if ($others > 0) {
            return;
        }
        // Keep file if still used by configured IdPs.
        if ($DB->record_exists('auth_saml2_idps', ['metadataurl' => $metadataurl])) {
            return;
        }
        $path = self::get_metadata_filepath($metadataurl);
        if (file_exists($path)) {
            @unlink($path);
        }
    }
}
