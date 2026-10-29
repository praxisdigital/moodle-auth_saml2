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
 * Dynamic form for federation tenant availability modal.
 *
 * @package    auth_saml2
 * @copyright  2026 moxis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace auth_saml2\form;

defined('MOODLE_INTERNAL') || die();

use auth_saml2\federation_manager;
use context;
use context_system;
use core_form\dynamic_form;
use moodle_url;

/**
 * Modal form to edit tenant availability for a federation.
 *
 * @package    auth_saml2
 * @copyright  2026 moxis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class federation_tenant_availability extends dynamic_form {

    /**
     * Form definition.
     */
    public function definition() {
        $mform = $this->_form;
        $mform->setDisableShortforms();
        $mform->addElement('header', 'hdr', '');

        $modes = [
            federation_manager::TENANT_MODE_ALL => get_string('federation_tenantmode_all', 'auth_saml2'),
            federation_manager::TENANT_MODE_INCLUDE => get_string('federation_tenantmode_include', 'auth_saml2'),
            federation_manager::TENANT_MODE_EXCLUDE => get_string('federation_tenantmode_exclude', 'auth_saml2'),
        ];

        $mform->addElement(
            'select',
            'tenantmode',
            get_string('federation_tenantmode', 'auth_saml2'),
            $modes
        );
        $mform->setType('tenantmode', PARAM_INT);
        $mform->setDefault('tenantmode', federation_manager::TENANT_MODE_ALL);
        $mform->addHelpButton('tenantmode', 'federation_tenantmode', 'auth_saml2');

        $tenantoptions = federation_manager::get_tenant_options();
        $mform->addElement(
            'autocomplete',
            'tenantids_include',
            get_string('federation_tenantids_include', 'auth_saml2'),
            $tenantoptions,
            ['multiple' => true]
        );
        $mform->setType('tenantids_include', PARAM_INT);
        $mform->hideIf('tenantids_include', 'tenantmode', 'ne', federation_manager::TENANT_MODE_INCLUDE);

        $mform->addElement(
            'autocomplete',
            'tenantids_exclude',
            get_string('federation_tenantids_exclude', 'auth_saml2'),
            $tenantoptions,
            ['multiple' => true]
        );
        $mform->setType('tenantids_exclude', PARAM_INT);
        $mform->hideIf('tenantids_exclude', 'tenantmode', 'ne', federation_manager::TENANT_MODE_EXCLUDE);

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
    }

    /**
     * Access check.
     */
    protected function check_access_for_dynamic_submission(): void {
        require_capability('moodle/site:config', context_system::instance());
        if (!federation_manager::tenancy_available()) {
            throw new \moodle_exception('nopermissions', 'error', '', get_string('federation_tenantavailability', 'auth_saml2'));
        }
    }

    /**
     * Context for the form.
     *
     * @return context
     */
    public function get_context_for_dynamic_submission(): context {
        return context_system::instance();
    }

    /**
     * Page URL for the form.
     *
     * @return moodle_url
     */
    protected function get_page_url_for_dynamic_submission(): moodle_url {
        $id = $this->optional_param('id', 0, PARAM_INT);
        return new moodle_url('/auth/saml2/managefederations.php', ['id' => $id]);
    }

    /**
     * Load existing data.
     */
    public function set_data_for_dynamic_submission(): void {
        $id = $this->optional_param('id', 0, PARAM_INT);
        $federation = federation_manager::get_by_id($id);
        if (!$federation) {
            return;
        }
        $mode = isset($federation->tenantmode)
            ? (int) $federation->tenantmode
            : federation_manager::TENANT_MODE_ALL;
        $ids = federation_manager::get_tenant_ids($federation);
        $data = [
            'id' => $id,
            'tenantmode' => $mode,
        ];
        if ($mode === federation_manager::TENANT_MODE_INCLUDE) {
            $data['tenantids_include'] = $ids;
        } else if ($mode === federation_manager::TENANT_MODE_EXCLUDE) {
            $data['tenantids_exclude'] = $ids;
        }
        $this->set_data($data);
    }

    /**
     * Process save.
     *
     * @return array
     */
    public function process_dynamic_submission() {
        $data = $this->get_data();
        $mode = (int) $data->tenantmode;
        $tenantids = [];
        if ($mode === federation_manager::TENANT_MODE_INCLUDE) {
            $tenantids = array_map('intval', (array) ($data->tenantids_include ?? []));
        } else if ($mode === federation_manager::TENANT_MODE_EXCLUDE) {
            $tenantids = array_map('intval', (array) ($data->tenantids_exclude ?? []));
        }
        federation_manager::save_tenant_availability((int) $data->id, $mode, $tenantids);
        return ['result' => true];
    }

    /**
     * Validation.
     *
     * @param array $data
     * @param array $files
     * @return array
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);
        $mode = (int) ($data['tenantmode'] ?? federation_manager::TENANT_MODE_ALL);
        if ($mode === federation_manager::TENANT_MODE_INCLUDE) {
            if (empty(array_filter((array) ($data['tenantids_include'] ?? [])))) {
                $errors['tenantids_include'] = get_string('federation_tenantids_required', 'auth_saml2');
            }
        } else if ($mode === federation_manager::TENANT_MODE_EXCLUDE) {
            if (empty(array_filter((array) ($data['tenantids_exclude'] ?? [])))) {
                $errors['tenantids_exclude'] = get_string('federation_tenantids_required', 'auth_saml2');
            }
        }
        $id = (int) ($data['id'] ?? 0);
        if ($id && !federation_manager::get_by_id($id)) {
            $errors['id'] = get_string('federation_notfound', 'auth_saml2');
        }
        return $errors;
    }
}
