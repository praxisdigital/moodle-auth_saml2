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
 * Main file
 *
 * @package auth_saml2
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright Catalyst IT
 */

/**
 * Callback before HTTP headers are sent.
 *
 * This is called on every page.
 */
function auth_saml2_before_http_headers() {
    \auth_saml2\auto_login::process();
}

/**
 * Add service status checks
 *
 * @return array of check objects
 */
function auth_saml2_status_checks(): array {
    global $saml2auth;
    require_once(__DIR__ . '/setup.php');

    // Only if saml is configured then check certificate expiry.
    if ($saml2auth->is_configured()) {
        return [
            new \auth_saml2\check\certificateexpiry(),
        ];
    }
    return [];
}

/**
 * Serve federation logo files.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function auth_saml2_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = []) {
    if ($context->contextlevel != CONTEXT_SYSTEM) {
        return false;
    }
    if ($filearea !== \auth_saml2\federation_manager::LOGO_FILEAREA) {
        return false;
    }

    $itemid = array_shift($args);
    $filename = array_pop($args);
    $filepath = $args ? '/' . implode('/', $args) . '/' : '/';

    $fs = get_file_storage();
    $file = $fs->get_file($context->id, 'auth_saml2', $filearea, $itemid, $filepath, $filename);
    if (!$file || $file->is_directory()) {
        return false;
    }

    send_stored_file($file, 0, 0, $forcedownload, $options);
}
