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
 * Page to select which IdPs to display if a metadata xml contains multiple.
 *
 * @package   auth_saml2
 * @author    Rossco Hellmans <rosscohellmans@catalyst-au.net>
 * @copyright Catalyst IT
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// @codingStandardsIgnoreStart
require_once(__DIR__ . '/../../config.php');
// @codingStandardsIgnoreEnd
require_once(__DIR__ . '/locallib.php');

use core\output\notification;

$heading = get_string('manageidpsheading', 'auth_saml2');

$PAGE->set_pagelayout('standard');

auth_saml2_admin_nav(
    $heading,
    "/auth/saml2/availableidps.php"
);

$PAGE->requires->css('/auth/saml2/styles.css');

$metadataentities = auth_saml2_get_idps(false, true);
$federationidps = [];
foreach (\auth_saml2\federation_manager::get_all() as $federation) {
    $entityid = \auth_saml2\federation_manager::idp_entityid($federation->shortname);
    $federationidps[\auth_saml2\federation_manager::idp_md5($federation->shortname)] = [
        'name' => $federation->shortname,
        'entityid' => $entityid,
        'activeidp' => 1,
    ];
}

$data = [
    'metadataentities' => $metadataentities,
    'federationidps' => $federationidps,
];

$action = new moodle_url('/auth/saml2/availableidps.php');
$mform = new \auth_saml2\form\availableidps($action, $data);

if ($mform->is_cancelled()) {
    redirect("$CFG->wwwroot/admin/settings.php?section=authsettingsaml2");
}

if ($fromform = $mform->get_data()) {
    // Go through each idp and update its flags.
    foreach ($fromform->metadataentities as $idpentities) {
        foreach ($idpentities as $idpentity) {
            if (empty($idpentity->id)) {
                continue;
            }
            $existing = $DB->get_record('auth_saml2_idps', ['id' => $idpentity->id], 'id, entityid');
            if (!$existing || \auth_saml2\federation_manager::is_federation_entityid($existing->entityid)) {
                continue;
            }
            $DB->update_record('auth_saml2_idps', (object) $idpentity);
        }
    }
} else {
    $mform->set_data(['metadataentities' => $metadataentities]);
}

echo $OUTPUT->header();
echo $OUTPUT->heading($heading);
$notification = new notification(get_string('multiidpinfo', 'auth_saml2'), notification::NOTIFY_INFO, false);
echo $OUTPUT->render($notification);
$mform->display();
echo $OUTPUT->footer();
