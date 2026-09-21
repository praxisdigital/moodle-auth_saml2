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
 * Form to add or edit a federated login.
 *
 * @package    auth_saml2
 * @copyright  2026 moxis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace auth_saml2\form;

defined('MOODLE_INTERNAL') || die();

use auth_saml2\federation_manager;
use moodleform;

require_once($CFG->libdir . '/formslib.php');

/**
 * Federation add/edit form.
 *
 * @package    auth_saml2
 * @copyright  2026 moxis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class federation extends moodleform {
    /**
     * Form definition.
     */
    public function definition() {
        $mform = $this->_form;
        $federation = $this->_customdata['federation'] ?? null;

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('text', 'shortname', get_string('federation_shortname', 'auth_saml2'), ['size' => 40]);
        $mform->setType('shortname', PARAM_ALPHANUMEXT);
        $mform->addRule('shortname', get_string('required'), 'required', null, 'client');
        $mform->addHelpButton('shortname', 'federation_shortname', 'auth_saml2');

        $mform->addElement('text', 'metadataurl', get_string('federation_metadataurl', 'auth_saml2'), ['size' => 80]);
        $mform->setType('metadataurl', PARAM_URL);
        $mform->addRule('metadataurl', get_string('required'), 'required', null, 'client');
        $mform->addHelpButton('metadataurl', 'federation_metadataurl', 'auth_saml2');

        $mform->addElement('text', 'discourl', get_string('federation_discourl', 'auth_saml2'), ['size' => 80]);
        $mform->setType('discourl', PARAM_URL);
        $mform->addRule('discourl', get_string('required'), 'required', null, 'client');
        $mform->addHelpButton('discourl', 'federation_discourl', 'auth_saml2');

        $mform->addElement('text', 'buttonlabel', get_string('federation_buttonlabel', 'auth_saml2'), ['size' => 40]);
        $mform->setType('buttonlabel', PARAM_TEXT);
        $mform->addRule('buttonlabel', get_string('required'), 'required', null, 'client');
        $mform->addHelpButton('buttonlabel', 'federation_buttonlabel', 'auth_saml2');

        $mform->addElement(
            'filemanager',
            'logo',
            get_string('federation_logo', 'auth_saml2'),
            null,
            [
                'subdirs' => 0,
                'maxfiles' => 1,
                'accepted_types' => ['web_image'],
            ]
        );
        $mform->addHelpButton('logo', 'federation_logo', 'auth_saml2');

        $this->add_action_buttons(true, get_string('federation_save', 'auth_saml2'));
    }

    /**
     * Extra validation.
     *
     * @param array $data
     * @param array $files
     * @return array
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        $excludeid = !empty($data['id']) ? (int) $data['id'] : null;
        $shorterror = federation_manager::validate_shortname(trim($data['shortname'] ?? ''), $excludeid);
        if ($shorterror !== null) {
            $errors['shortname'] = $shorterror;
        }

        if (empty($data['metadataurl']) || !filter_var($data['metadataurl'], FILTER_VALIDATE_URL)) {
            $errors['metadataurl'] = get_string('federation_invalidurl', 'auth_saml2');
        }
        if (empty($data['discourl']) || !filter_var($data['discourl'], FILTER_VALIDATE_URL)) {
            $errors['discourl'] = get_string('federation_invalidurl', 'auth_saml2');
        }
        if (trim($data['buttonlabel'] ?? '') === '') {
            $errors['buttonlabel'] = get_string('required');
        }

        return $errors;
    }
}
