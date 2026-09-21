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
            return $item['url']->get_param('federation') !== null;
        });
        $this->assertCount(2, $fedurls);
        foreach ($fedurls as $item) {
            $this->assertEquals('off', $item['url']->get_param('passive'));
            $this->assertEquals('/', $item['url']->get_param('wants'));
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
        $this->assertEquals('HAKA', $list[0]['url']->get_param('federation'));
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
}
