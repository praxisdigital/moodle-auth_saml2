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
 * Manage federated login configurations (OAuth2 issuers-style admin UI).
 *
 * @package    auth_saml2
 * @copyright  2026 moxis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// @codingStandardsIgnoreStart
require_once(__DIR__ . '/../../config.php');
// @codingStandardsIgnoreEnd
require_once(__DIR__ . '/locallib.php');

use auth_saml2\federation_manager;
use auth_saml2\form\federation as federation_form;
use core\output\notification;

$action = optional_param('action', '', PARAM_ALPHAEXT);
$id = optional_param('id', 0, PARAM_INT);
$confirm = optional_param('confirm', false, PARAM_BOOL);

$heading = get_string('federation_manage', 'auth_saml2');
$basepath = '/auth/saml2/managefederations.php';

auth_saml2_admin_nav($heading, $basepath);

$settingsurl = new moodle_url('/admin/settings.php', ['section' => 'authsettingsaml2']);
$manageurl = new moodle_url($basepath);
$renderer = $PAGE->get_renderer('auth_saml2');

$federation = null;
if ($id) {
    $federation = federation_manager::get_by_id($id);
    if (!$federation && !in_array($action, ['', 'add', 'list'], true)) {
        redirect($manageurl, get_string('federation_notfound', 'auth_saml2'), null, notification::NOTIFY_ERROR);
    }
}

if ($action === 'edit' || $action === 'add') {
    if ($action === 'edit' && !$federation) {
        redirect($manageurl, get_string('federation_notfound', 'auth_saml2'), null, notification::NOTIFY_ERROR);
    }

    $formurl = new moodle_url($basepath, ['action' => $action, 'id' => $id]);
    $mform = new federation_form($formurl, ['federation' => $federation]);

    if ($mform->is_cancelled()) {
        redirect($manageurl);
    }

    if ($fromform = $mform->get_data()) {
        try {
            federation_manager::save($fromform);
            redirect($manageurl, get_string('federation_saved', 'auth_saml2'), null, notification::NOTIFY_SUCCESS);
        } catch (Throwable $e) {
            \core\notification::error($e->getMessage());
        }
    }

    $draftitemid = file_get_submitted_draft_itemid('logo');
    $context = context_system::instance();
    file_prepare_draft_area(
        $draftitemid,
        $context->id,
        'auth_saml2',
        federation_manager::LOGO_FILEAREA,
        $id ?: 0,
        ['subdirs' => 0, 'maxfiles' => 1]
    );

    $data = [
        'id' => $id,
        'logo' => $draftitemid,
    ];
    if ($federation) {
        $data['shortname'] = $federation->shortname;
        $data['metadataurl'] = $federation->metadataurl;
        $data['discourl'] = $federation->discourl;
        $data['buttonlabel'] = $federation->buttonlabel;
        $data['buttondisplay'] = isset($federation->buttondisplay)
            ? (int) $federation->buttondisplay
            : federation_manager::BUTTON_AUTO;
    }
    $mform->set_data($data);

    echo $OUTPUT->header();
    if ($federation) {
        echo $OUTPUT->heading(get_string('federation_editnamed', 'auth_saml2', s($federation->buttonlabel)));
    } else {
        echo $OUTPUT->heading(get_string('federation_add', 'auth_saml2'));
    }
    $mform->display();
    echo $OUTPUT->footer();
    exit;
}

if ($action === 'delete' && $id) {
    if (!$federation) {
        redirect($manageurl, get_string('federation_notfound', 'auth_saml2'), null, notification::NOTIFY_ERROR);
    }
    if (!$confirm) {
        $continueurl = new moodle_url($basepath, [
            'action' => 'delete',
            'id' => $id,
            'confirm' => 1,
            'sesskey' => sesskey(),
        ]);
        echo $OUTPUT->header();
        echo $OUTPUT->heading($heading);
        echo $OUTPUT->confirm(
            get_string('federation_deleteconfirm', 'auth_saml2', s($federation->buttonlabel)),
            $continueurl,
            $manageurl
        );
        echo $OUTPUT->footer();
        exit;
    }
    require_sesskey();
    federation_manager::delete($id);
    redirect($manageurl, get_string('federation_deleted', 'auth_saml2'), null, notification::NOTIFY_SUCCESS);
}

if ($action === 'enable' && $id) {
    require_sesskey();
    federation_manager::enable($id);
    redirect($manageurl, get_string('federation_enabled', 'auth_saml2'), null, notification::NOTIFY_SUCCESS);
}

if ($action === 'disable' && $id) {
    require_sesskey();
    federation_manager::disable($id);
    redirect($manageurl, get_string('federation_disabled', 'auth_saml2'), null, notification::NOTIFY_SUCCESS);
}

if ($action === 'moveup' && $id) {
    require_sesskey();
    federation_manager::move_up($id);
    redirect($manageurl);
}

if ($action === 'movedown' && $id) {
    require_sesskey();
    federation_manager::move_down($id);
    redirect($manageurl);
}

// Default: list federations.
$federations = federation_manager::get_all();

if (federation_manager::tenancy_available()) {
    $PAGE->requires->js_call_amd('auth_saml2/federation_tenant_availability', 'init');
}

echo $OUTPUT->header();
echo $OUTPUT->heading($heading);
echo $OUTPUT->notification(get_string('federation_info', 'auth_saml2'), notification::NOTIFY_INFO);

if (empty($federations)) {
    echo $OUTPUT->notification(get_string('federation_none', 'auth_saml2'), notification::NOTIFY_INFO);
} else {
    echo $renderer->federations_table($federations);
}

echo $OUTPUT->container_start('mt-3');
echo get_string('federation_createnew', 'auth_saml2') . ' ';
echo $OUTPUT->single_button(
    new moodle_url($basepath, ['action' => 'add']),
    get_string('federation_add', 'auth_saml2'),
    'get'
);
echo $OUTPUT->container_end();

echo html_writer::div(
    html_writer::link($settingsurl, get_string('back')),
    'mt-3'
);

echo $OUTPUT->footer();
