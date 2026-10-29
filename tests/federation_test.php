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
 * Tests for federated login.
 *
 * @package    auth_saml2
 * @copyright  2026 moxis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace auth_saml2;

/**
 * Federation manager and login button tests.
 *
 * @package    auth_saml2
 * @copyright  2026 moxis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers     \auth_saml2\federation_manager
 * @covers     \auth_saml2\auth::loginpage_idp_list
 */
final class federation_test extends \advanced_testcase {

    /**
     * Create a federation DB row and optional metadata file (no HTTP fetch).
     *
     * @param array $data
     * @param bool $createmetafile
     * @return \stdClass
     */
    private function create_federation(array $data = [], bool $createmetafile = true): \stdClass {
        global $DB, $CFG;

        $record = (object) array_merge([
            'shortname' => 'HAKA',
            'metadataurl' => 'https://example.org/federation-metadata.xml',
            'discourl' => 'https://example.org/DS',
            'buttonlabel' => 'Login with HAKA',
            'buttondisplay' => federation_manager::BUTTON_AUTO,
            'tenantmode' => federation_manager::TENANT_MODE_ALL,
            'tenantids' => null,
            'enabled' => 1,
            'sortorder' => 0,
            'timecreated' => time(),
            'timemodified' => time(),
        ], $data);
        if (!isset($data['sortorder'])) {
            $record->sortorder = (int) $DB->count_records('auth_saml2_federations');
        }

        $record->id = $DB->insert_record('auth_saml2_federations', $record);

        if ($createmetafile) {
            $dir = $CFG->dataroot . '/saml2';
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $path = federation_manager::get_metadata_filepath($record->metadataurl);
            file_put_contents($path, '<?xml version="1.0"?><EntitiesDescriptor></EntitiesDescriptor>');
            $auth = get_auth_plugin('saml2');
            touch($auth->certcrt);
            touch($auth->certpem);
        }

        return $DB->get_record('auth_saml2_federations', ['id' => $record->id]);
    }

    /**
     * Store a tiny PNG as the federation button logo.
     *
     * @param int $federationid
     */
    private function store_logo(int $federationid): void {
        $fs = get_file_storage();
        $fs->create_file_from_string([
            'contextid' => \context_system::instance()->id,
            'component' => 'auth_saml2',
            'filearea' => federation_manager::LOGO_FILEAREA,
            'itemid' => $federationid,
            'filepath' => '/',
            'filename' => 'logo.png',
        ], base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg=='));
    }

    public function test_validate_shortname(): void {
        $this->resetAfterTest();

        $this->assertNull(federation_manager::validate_shortname('HAKA'));
        $this->assertNull(federation_manager::validate_shortname('eduGAIN'));
        $this->assertNull(federation_manager::validate_shortname('my-fed_1'));

        $this->assertNotNull(federation_manager::validate_shortname(''));
        $this->assertNotNull(federation_manager::validate_shortname('has space'));
        $this->assertNotNull(federation_manager::validate_shortname('bad@name'));

        $this->create_federation(['shortname' => 'HAKA']);
        $this->assertNotNull(federation_manager::validate_shortname('HAKA'));
        $existing = federation_manager::get_by_shortname('HAKA');
        $this->assertNull(federation_manager::validate_shortname('HAKA', (int) $existing->id));
    }

    public function test_get_all_and_delete(): void {
        $this->resetAfterTest();

        $this->assertEmpty(federation_manager::get_all());

        $f1 = $this->create_federation(['shortname' => 'HAKA', 'buttonlabel' => 'HAKA']);
        $f2 = $this->create_federation([
            'shortname' => 'eduGAIN',
            'metadataurl' => 'https://example.org/edugain.xml',
            'discourl' => 'https://example.org/edugain/DS',
            'buttonlabel' => 'eduGAIN',
        ]);

        $all = federation_manager::get_all();
        $this->assertCount(2, $all);
        $this->assertEquals('HAKA', federation_manager::get_by_shortname('HAKA')->shortname);

        $path = federation_manager::get_metadata_filepath($f1->metadataurl);
        $this->assertTrue(file_exists($path));

        federation_manager::delete((int) $f1->id);
        $this->assertFalse(federation_manager::get_by_id((int) $f1->id));
        $this->assertFalse(file_exists($path));
        $this->assertCount(1, federation_manager::get_all());
        $this->assertNotFalse(federation_manager::get_by_id((int) $f2->id));
    }

    public function test_loginpage_idp_list_includes_federations(): void {
        $this->resetAfterTest();

        // IdP only.
        $this->getDataGenerator()->get_plugin_generator('auth_saml2')->create_idp_entity();
        $auth = get_auth_plugin('saml2');
        $list = $auth->loginpage_idp_list('/');
        $this->assertCount(1, $list);
        $this->assertNull($list[0]['url']->get_param('federation'));
        $this->assertNotEquals(federation_manager::idp_md5('HAKA'), $list[0]['url']->get_param('idp'));

        // Add two federations.
        $this->create_federation(['shortname' => 'HAKA', 'buttonlabel' => 'Login HAKA']);
        $this->create_federation([
            'shortname' => 'eduGAIN',
            'metadataurl' => 'https://example.org/edugain.xml',
            'discourl' => 'https://example.org/edugain/DS',
            'buttonlabel' => 'Login eduGAIN',
        ]);

        $auth = get_auth_plugin('saml2');
        $list = $auth->loginpage_idp_list('/');
        $this->assertCount(3, $list);

        $names = array_column($list, 'name');
        $this->assertContains('Login HAKA', $names);
        $this->assertContains('Login eduGAIN', $names);

        $fedurls = array_filter($list, static function ($item) {
            $idp = $item['url']->get_param('idp');
            return $idp === federation_manager::idp_md5('HAKA') || $idp === federation_manager::idp_md5('eduGAIN');
        });
        $this->assertCount(2, $fedurls);
        foreach ($fedurls as $item) {
            $this->assertEquals('off', $item['url']->get_param('passive'));
            $this->assertEquals('/', $item['url']->get_param('wants'));
            $this->assertNull($item['url']->get_param('federation'));
        }
    }

    public function test_loginpage_idp_list_federation_only(): void {
        $this->resetAfterTest();

        $this->create_federation(['shortname' => 'HAKA', 'buttonlabel' => 'Login HAKA']);

        $auth = get_auth_plugin('saml2');
        $this->assertTrue($auth->is_configured());
        $list = $auth->loginpage_idp_list('/');
        $this->assertCount(1, $list);
        $this->assertEquals('Login HAKA', $list[0]['name']);
        $this->assertEquals(federation_manager::idp_md5('HAKA'), $list[0]['url']->get_param('idp'));
        $this->assertNull($list[0]['url']->get_param('federation'));
    }

    public function test_save_skips_metadata_fetch_when_cache_exists(): void {
        global $DB;
        $this->resetAfterTest();

        $fed = $this->create_federation([
            'shortname' => 'HAKA',
            'buttonlabel' => 'Login HAKA',
            'metadataurl' => 'https://wp50.m.dev/mock-idp/metadata',
        ]);
        $path = federation_manager::get_metadata_filepath($fed->metadataurl);
        $this->assertTrue(file_exists($path));
        $before = filemtime($path);

        $id = federation_manager::save((object) [
            'id' => $fed->id,
            'shortname' => 'HAKA',
            'metadataurl' => $fed->metadataurl,
            'discourl' => $fed->discourl,
            'buttonlabel' => 'Login HAKA logo',
        ]);

        $saved = $DB->get_record('auth_saml2_federations', ['id' => $id]);
        $this->assertEquals('Login HAKA logo', $saved->buttonlabel);
        $this->assertTrue(file_exists($path));
        $this->assertEquals($before, filemtime($path));
    }

    public function test_login_button_display_modes(): void {
        global $DB;
        $this->resetAfterTest();

        $fed = $this->create_federation([
            'shortname' => 'HAKA',
            'buttonlabel' => 'Login HAKA',
            'buttondisplay' => federation_manager::BUTTON_AUTO,
        ]);
        $auth = get_auth_plugin('saml2');
        $list = $auth->loginpage_idp_list('/');
        $this->assertEquals('Login HAKA', $list[0]['name']);
        $this->assertEmpty($list[0]['iconurl']);

        $this->store_logo((int) $fed->id);
        $DB->set_field('auth_saml2_federations', 'buttondisplay', federation_manager::BUTTON_AUTO, ['id' => $fed->id]);
        $auth = get_auth_plugin('saml2');
        $list = $auth->loginpage_idp_list('/');
        $this->assertSame('', $list[0]['name']);
        $this->assertNotEmpty($list[0]['iconurl']);

        $DB->set_field('auth_saml2_federations', 'buttondisplay', federation_manager::BUTTON_BOTH, ['id' => $fed->id]);
        $auth = get_auth_plugin('saml2');
        $list = $auth->loginpage_idp_list('/');
        $this->assertEquals('Login HAKA', $list[0]['name']);
        $this->assertNotEmpty($list[0]['iconurl']);

        $fs = get_file_storage();
        $fs->delete_area_files(
            \context_system::instance()->id,
            'auth_saml2',
            federation_manager::LOGO_FILEAREA,
            (int) $fed->id
        );
        $auth = get_auth_plugin('saml2');
        $list = $auth->loginpage_idp_list('/');
        $this->assertEquals('Login HAKA', $list[0]['name']);
        $this->assertEmpty($list[0]['iconurl']);
    }

    public function test_availableidps_lists_federation_as_always_active(): void {
        $this->resetAfterTest();
        $this->setAdminUser();

        $this->create_federation(['shortname' => 'HAKA', 'buttonlabel' => 'Login HAKA']);
        federation_manager::sync_active_idp(federation_manager::get_by_shortname('HAKA'));

        $federationidps = [];
        foreach (federation_manager::get_all() as $federation) {
            $federationidps[federation_manager::idp_md5($federation->shortname)] = [
                'name' => $federation->shortname,
                'entityid' => federation_manager::idp_entityid($federation->shortname),
                'activeidp' => 1,
            ];
        }
        $form = new \auth_saml2\form\availableidps(null, [
            'metadataentities' => auth_saml2_get_idps(false, true),
            'federationidps' => $federationidps,
        ]);
        $html = $form->render();
        $this->assertStringContainsString('HAKA', $html);
        $this->assertStringContainsString(get_string('federation_alwaysactive', 'auth_saml2'), $html);
        $this->assertStringNotContainsString('federation:' . 'HAKA' . '[activeidp]', $html);
        $this->assertStringNotContainsString(federation_manager::idp_md5('HAKA') . '[activeidp]', $html);
    }

    public function test_tenant_availability_trigger_uses_shortname(): void {
        $this->resetAfterTest();

        if (!federation_manager::tenancy_available()) {
            $this->markTestSkipped('tool_tenant not available');
        }

        $fed = $this->create_federation(['shortname' => 'HAKA', 'buttonlabel' => 'Login HAKA']);
        $renderer = $GLOBALS['PAGE']->get_renderer('auth_saml2');
        $html = $renderer->federations_table([$fed]);
        $this->assertStringContainsString('data-name="HAKA"', $html);
        $this->assertStringNotContainsString('data-name="Login HAKA"', $html);
    }

    public function test_save_renames_synthetic_idp(): void {
        global $DB;
        $this->resetAfterTest();

        $fed = $this->create_federation(['shortname' => 'HAKA', 'buttonlabel' => 'Login HAKA']);
        federation_manager::sync_active_idp($fed);
        $oldentityid = federation_manager::idp_entityid('HAKA');
        $this->assertTrue($DB->record_exists('auth_saml2_idps', ['entityid' => $oldentityid]));

        federation_manager::save((object) [
            'id' => $fed->id,
            'shortname' => 'eduGAIN',
            'metadataurl' => $fed->metadataurl,
            'discourl' => $fed->discourl,
            'buttonlabel' => 'Login HAKA',
        ]);

        $this->assertFalse($DB->record_exists('auth_saml2_idps', ['entityid' => $oldentityid]));
        $new = $DB->get_record('auth_saml2_idps', ['entityid' => federation_manager::idp_entityid('eduGAIN')]);
        $this->assertNotFalse($new);
        $this->assertEquals(1, (int) $new->activeidp);
    }

    public function test_sync_creates_active_idp_and_delete_removes_it(): void {
        global $DB;
        $this->resetAfterTest();

        $fed = $this->create_federation(['shortname' => 'HAKA', 'buttonlabel' => 'Login HAKA']);
        federation_manager::sync_active_idp($fed);

        $entityid = federation_manager::idp_entityid('HAKA');
        $idp = $DB->get_record('auth_saml2_idps', ['entityid' => $entityid]);
        $this->assertNotFalse($idp);
        $this->assertEquals(1, (int) $idp->activeidp);
        $this->assertEquals(0, (int) $idp->defaultidp);
        $this->assertEquals('Login HAKA', $idp->displayname);
        $this->assertFalse(federation_manager::get_by_idp_md5(md5('https://idp.example.org')));
        $this->assertEquals('HAKA', federation_manager::get_by_idp_md5(federation_manager::idp_md5('HAKA'))->shortname);

        $idps = auth_saml2_get_idps(false, true);
        $this->assertEmpty($idps);

        federation_manager::disable((int) $fed->id);
        $idp = $DB->get_record('auth_saml2_idps', ['entityid' => $entityid]);
        $this->assertEquals(1, (int) $idp->activeidp);

        federation_manager::delete((int) $fed->id);
        $this->assertFalse($DB->record_exists('auth_saml2_idps', ['entityid' => $entityid]));
    }

    public function test_loginpage_idp_list_unchanged_without_federations(): void {
        $this->resetAfterTest();

        $entity = $this->getDataGenerator()->get_plugin_generator('auth_saml2')->create_idp_entity();
        $auth = get_auth_plugin('saml2');
        $list = $auth->loginpage_idp_list('/');
        $this->assertCount(1, $list);
        $this->assertEquals(md5($entity->entityid), $list[0]['url']->get_param('idp'));
        $this->assertNull($list[0]['url']->get_param('federation'));
    }

    public function test_tenant_availability_without_tenancy_always_true(): void {
        $this->resetAfterTest();

        // On non-Workplace or when filtering is not applied via real tenancy context,
        // default ALL mode must keep the federation available.
        $fed = $this->create_federation([
            'shortname' => 'ALLFED',
            'tenantmode' => federation_manager::TENANT_MODE_ALL,
        ]);
        $this->assertTrue(federation_manager::is_available_for_current_tenant($fed));

        $auth = get_auth_plugin('saml2');
        $list = $auth->loginpage_idp_list('/');
        $names = array_column($list, 'name');
        $this->assertContains('Login with HAKA', $names);
    }

    public function test_tenant_mode_include_exclude_logic(): void {
        $this->resetAfterTest();

        if (!federation_manager::tenancy_available()) {
            $this->markTestSkipped('tool_tenant not available');
        }

        $tenants = \tool_tenant\tenancy::get_tenants();
        $this->assertNotEmpty($tenants);
        $tenantids = array_map(static fn($t) => (int) $t->id, array_values($tenants));
        $first = $tenantids[0];
        $second = $tenantids[1] ?? $first;

        $include = $this->create_federation([
            'shortname' => 'INCFED',
            'buttonlabel' => 'IncludeFed',
            'metadataurl' => 'https://example.org/inc.xml',
            'tenantmode' => federation_manager::TENANT_MODE_INCLUDE,
            'tenantids' => json_encode([$first]),
        ]);
        $exclude = $this->create_federation([
            'shortname' => 'EXCFED',
            'buttonlabel' => 'ExcludeFed',
            'metadataurl' => 'https://example.org/exc.xml',
            'tenantmode' => federation_manager::TENANT_MODE_EXCLUDE,
            'tenantids' => json_encode([$first]),
        ]);

        // Force current tenant context to first tenant when API allows.
        if (method_exists(\tool_tenant\tenancy::class, 'set_switched_tenant_id')) {
            \tool_tenant\tenancy::set_switched_tenant_id($first);
        }

        $this->assertTrue(federation_manager::is_available_for_current_tenant($include));
        $this->assertFalse(federation_manager::is_available_for_current_tenant($exclude));

        if ($second !== $first && method_exists(\tool_tenant\tenancy::class, 'set_switched_tenant_id')) {
            \tool_tenant\tenancy::set_switched_tenant_id($second);
            $this->assertFalse(federation_manager::is_available_for_current_tenant($include));
            $this->assertTrue(federation_manager::is_available_for_current_tenant($exclude));
        }

        $this->assertEquals(
            get_string('federation_tenantmode_include_summary', 'auth_saml2', 1),
            federation_manager::get_tenant_mode_label($include)
        );
    }

    public function test_get_tenant_ids_and_label_defaults(): void {
        $this->resetAfterTest();

        $fed = $this->create_federation([
            'shortname' => 'LABEL',
            'tenantmode' => federation_manager::TENANT_MODE_ALL,
            'tenantids' => null,
        ]);
        $this->assertSame([], federation_manager::get_tenant_ids($fed));

        if (federation_manager::tenancy_available()) {
            $this->assertEquals(
                get_string('federation_tenantmode_all', 'auth_saml2'),
                federation_manager::get_tenant_mode_label($fed)
            );
        } else {
            $this->assertSame('', federation_manager::get_tenant_mode_label($fed));
        }
    }

    public function test_save_tenant_availability(): void {
        $this->resetAfterTest();

        if (!federation_manager::tenancy_available()) {
            $this->markTestSkipped('tool_tenant not available');
        }

        $fed = $this->create_federation(['shortname' => 'TENSAVE', 'buttonlabel' => 'TenSave']);
        $tenants = array_values(\tool_tenant\tenancy::get_tenants());
        $tid = (int) $tenants[0]->id;

        federation_manager::save_tenant_availability(
            (int) $fed->id,
            federation_manager::TENANT_MODE_INCLUDE,
            [$tid]
        );
        $reloaded = federation_manager::get_by_id((int) $fed->id);
        $this->assertEquals(federation_manager::TENANT_MODE_INCLUDE, (int) $reloaded->tenantmode);
        $this->assertSame([$tid], federation_manager::get_tenant_ids($reloaded));

        federation_manager::save_tenant_availability(
            (int) $fed->id,
            federation_manager::TENANT_MODE_ALL,
            []
        );
        $reloaded = federation_manager::get_by_id((int) $fed->id);
        $this->assertEquals(federation_manager::TENANT_MODE_ALL, (int) $reloaded->tenantmode);
        $this->assertSame([], federation_manager::get_tenant_ids($reloaded));
    }

    public function test_enabled_filter_and_move(): void {
        $this->resetAfterTest();

        $f1 = $this->create_federation([
            'shortname' => 'FED1',
            'buttonlabel' => 'Fed One',
            'metadataurl' => 'https://example.org/f1.xml',
            'sortorder' => 0,
        ]);
        $f2 = $this->create_federation([
            'shortname' => 'FED2',
            'buttonlabel' => 'Fed Two',
            'metadataurl' => 'https://example.org/f2.xml',
            'sortorder' => 1,
        ]);

        federation_manager::disable((int) $f1->id);
        $auth = get_auth_plugin('saml2');
        $list = $auth->loginpage_idp_list('/');
        $names = array_column($list, 'name');
        $this->assertNotContains('Fed One', $names);
        $this->assertContains('Fed Two', $names);

        federation_manager::enable((int) $f1->id);
        $auth = get_auth_plugin('saml2');
        $list = $auth->loginpage_idp_list('/');
        $names = array_column($list, 'name');
        $this->assertContains('Fed One', $names);

        federation_manager::move_down((int) $f1->id);
        $all = array_values(federation_manager::get_all());
        $this->assertEquals('FED2', $all[0]->shortname);
        $this->assertEquals('FED1', $all[1]->shortname);

        federation_manager::move_up((int) $f1->id);
        $all = array_values(federation_manager::get_all());
        $this->assertEquals('FED1', $all[0]->shortname);
        $this->assertEquals('FED2', $all[1]->shortname);
    }

    /**
     * Enable/disable and delete must emit standard Moodle events.
     *
     * @covers \auth_saml2\event\federation_updated
     * @covers \auth_saml2\event\federation_deleted
     */
    public function test_enable_disable_delete_events(): void {
        $this->resetAfterTest();
        $this->setAdminUser();

        $fed = $this->create_federation(['shortname' => 'EVTFED', 'buttonlabel' => 'Event Fed']);

        $sink = $this->redirectEvents();
        federation_manager::disable((int) $fed->id);
        $events = array_values(array_filter(
            $sink->get_events(),
            static fn($e) => $e instanceof event\federation_updated
        ));
        $sink->clear();
        $this->assertCount(1, $events);
        $this->assertEquals(0, $events[0]->other['enabled']);
        $this->assertEquals('EVTFED', $events[0]->other['shortname']);
        $this->assertEquals((int) $fed->id, $events[0]->objectid);

        federation_manager::enable((int) $fed->id);
        $events = array_values(array_filter(
            $sink->get_events(),
            static fn($e) => $e instanceof event\federation_updated
        ));
        $sink->clear();
        $this->assertCount(1, $events);
        $this->assertEquals(1, $events[0]->other['enabled']);

        federation_manager::delete((int) $fed->id);
        $events = array_values(array_filter(
            $sink->get_events(),
            static fn($e) => $e instanceof event\federation_deleted
        ));
        $this->assertCount(1, $events);
        $this->assertEquals('EVTFED', $events[0]->other['shortname']);
        $this->assertEquals((int) $fed->id, $events[0]->objectid);
        $this->assertStringContainsString('deleted', $events[0]->get_description());
    }

    /**
     * Tenant availability changes emit a dedicated event.
     *
     * @covers \auth_saml2\event\federation_tenant_availability_updated
     */
    public function test_save_tenant_availability_event(): void {
        $this->resetAfterTest();
        $this->setAdminUser();

        if (!federation_manager::tenancy_available()) {
            $this->markTestSkipped('tool_tenant not available');
        }

        $fed = $this->create_federation(['shortname' => 'TENVT', 'buttonlabel' => 'TenEvt']);
        $tenants = array_values(\tool_tenant\tenancy::get_tenants());
        $tid = (int) $tenants[0]->id;

        $sink = $this->redirectEvents();
        federation_manager::save_tenant_availability(
            (int) $fed->id,
            federation_manager::TENANT_MODE_INCLUDE,
            [$tid]
        );
        $events = array_values(array_filter(
            $sink->get_events(),
            static fn($e) => $e instanceof event\federation_tenant_availability_updated
        ));
        $this->assertCount(1, $events);
        $this->assertEquals(federation_manager::TENANT_MODE_INCLUDE, $events[0]->other['tenantmode']);
        $this->assertSame([$tid], $events[0]->other['tenantids']);
        $this->assertEquals(federation_manager::TENANT_MODE_ALL, $events[0]->other['oldtenantmode']);
        $this->assertEquals('TENVT', $events[0]->other['shortname']);
        $this->assertStringContainsString('tenant availability', $events[0]->get_description());
    }

    /**
     * Created/updated event factories expose expected name and description.
     *
     * @covers \auth_saml2\event\federation_created
     * @covers \auth_saml2\event\federation_updated
     */
    public function test_federation_created_updated_event_factories(): void {
        $this->resetAfterTest();
        $this->setAdminUser();

        $fed = $this->create_federation(['shortname' => 'FACTFED', 'buttonlabel' => 'Factory']);

        $created = event\federation_created::create_from_federation($fed);
        $this->assertEquals(get_string('eventfederationcreated', 'auth_saml2'), $created->get_name());
        $this->assertStringContainsString('created', $created->get_description());
        $this->assertEquals((int) $fed->id, $created->objectid);

        $updated = event\federation_updated::create_from_federation($fed);
        $this->assertEquals(get_string('eventfederationupdated', 'auth_saml2'), $updated->get_name());
        $this->assertStringContainsString('updated', $updated->get_description());
    }
}
