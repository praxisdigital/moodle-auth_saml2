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
 * Federation tenant availability updated event.
 *
 * @package    auth_saml2
 * @copyright  2026 moxis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace auth_saml2\event;

use core\event\base;
use moodle_url;
use stdClass;

/**
 * Federation tenant availability updated event.
 *
 * @package    auth_saml2
 * @copyright  2026 moxis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class federation_tenant_availability_updated extends base {

    /**
     * Initialise event parameters.
     */
    protected function init() {
        $this->data['objecttable'] = 'auth_saml2_federations';
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Create event from a federation record.
     *
     * @param stdClass $federation
     * @param array $other Must include tenantmode; may include tenantids, oldtenantmode, oldtenantids.
     * @return self
     */
    public static function create_from_federation(stdClass $federation, array $other = []): self {
        $event = self::create([
            'objectid' => $federation->id,
            'context' => \context_system::instance(),
            'other' => [
                'shortname' => $federation->shortname,
            ] + $other,
        ]);
        $event->add_record_snapshot('auth_saml2_federations', $federation);
        return $event;
    }

    /**
     * Returns localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventfederationtenantavailabilityupdated', 'auth_saml2');
    }

    /**
     * Returns non-localised event description with id's for admin use only.
     *
     * @return string
     */
    public function get_description() {
        $shortname = s($this->other['shortname'] ?? '');
        $mode = $this->other['tenantmode'] ?? '';
        $ids = $this->other['tenantids'] ?? [];
        if (!is_array($ids)) {
            $ids = [];
        }
        $idlist = implode(',', array_map('intval', $ids));
        return "The user with id '$this->userid' updated tenant availability for SAML2 federation " .
            "with id '$this->objectid' and shortname '{$shortname}' " .
            "(tenantmode='{$mode}', tenantids='{$idlist}').";
    }

    /**
     * Returns relevant URL.
     *
     * @return moodle_url
     */
    public function get_url() {
        return new moodle_url('/auth/saml2/managefederations.php');
    }

    /**
     * Custom validation.
     */
    protected function validate_data() {
        parent::validate_data();
        if (!isset($this->other['shortname'])) {
            throw new \coding_exception('The \'shortname\' value must be set in other.');
        }
        if (!array_key_exists('tenantmode', $this->other)) {
            throw new \coding_exception('The \'tenantmode\' value must be set in other.');
        }
    }

    /**
     * Object id mapping for backup/restore.
     *
     * @return array
     */
    public static function get_objectid_mapping() {
        return ['db' => 'auth_saml2_federations', 'restore' => base::NOT_MAPPED];
    }
}
