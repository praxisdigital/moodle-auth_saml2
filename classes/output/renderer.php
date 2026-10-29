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
 * Renderer for auth_saml2 admin UI.
 *
 * @package    auth_saml2
 * @copyright  2026 moxis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace auth_saml2\output;

use auth_saml2\federation_manager;
use html_table;
use html_table_cell;
use html_table_row;
use html_writer;
use moodle_url;
use plugin_renderer_base;

defined('MOODLE_INTERNAL') || die();

/**
 * Plugin renderer.
 *
 * @package    auth_saml2
 * @copyright  2026 moxis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Admin table of federated logins (OAuth2 issuers style).
     *
     * @param \stdClass[] $federations
     * @return string HTML
     */
    public function federations_table(array $federations): string {
        $baseurl = '/auth/saml2/managefederations.php';
        $table = new html_table();
        $table->head = [
            get_string('name'),
            get_string('federation_metadatastatus', 'auth_saml2') . ' ' .
                $this->help_icon('federation_metadatastatus', 'auth_saml2'),
            get_string('federation_discourl', 'auth_saml2'),
        ];
        if (federation_manager::tenancy_available()) {
            $table->head[] = get_string('federation_tenantavailability', 'auth_saml2');
        }
        $table->head[] = get_string('edit');
        $table->attributes['class'] = 'admintable generaltable table table-hover';

        $data = [];
        $index = 0;
        $count = count($federations);

        foreach ($federations as $federation) {
            $first = ($index === 0);
            $last = ($index === $count - 1);
            $enabled = federation_manager::is_enabled($federation);

            // Name: logo + shortname.
            $name = s($federation->shortname);
            $logourl = federation_manager::get_logo_url((int) $federation->id);
            if ($logourl) {
                $name = html_writer::empty_tag('img', [
                    'src' => $logourl->out(false),
                    'alt' => '',
                    'width' => 24,
                    'height' => 24,
                    'class' => 'me-1',
                ]) . ' ' . $name;
            }
            $namecell = new html_table_cell($name);
            $namecell->header = true;

            // Metadata status.
            if (federation_manager::has_metadata_file($federation)) {
                $metastatus = $this->pix_icon('i/valid', get_string('federation_metadatastatus_ok', 'auth_saml2'), 'moodle');
            } else {
                $metastatus = $this->pix_icon('i/invalid', get_string('federation_metadatastatus_missing', 'auth_saml2'), 'moodle');
            }
            $metacell = new html_table_cell($metastatus);

            // Discovery URL (truncated display + link).
            $disco = $federation->discourl;
            if (\core_text::strlen($disco) > 48) {
                $discolabel = s(\core_text::substr($disco, 0, 45) . '…');
            } else {
                $discolabel = s($disco);
            }
            $discolink = html_writer::link($federation->discourl, $discolabel, [
                'target' => '_blank',
                'rel' => 'noopener noreferrer',
                'title' => $federation->discourl,
            ]);
            $discocell = new html_table_cell($discolink);

            $rowcells = [$namecell, $metacell, $discocell];

            if (federation_manager::tenancy_available()) {
                $rowcells[] = new html_table_cell(s(federation_manager::get_tenant_mode_label($federation)));
            }

            // Action icons.
            $links = '';
            $editurl = new moodle_url($baseurl, ['action' => 'edit', 'id' => $federation->id]);
            $links .= ' ' . html_writer::link($editurl, $this->pix_icon('t/edit', get_string('edit')));

            // Tenant availability modal (Workplace only), OAuth2 issuers style.
            if (federation_manager::tenancy_available()) {
                $tenantstr = get_string('federation_tenantavailability', 'auth_saml2');
                // Prefer Workplace sitemap icon when present (same as OAuth2 issuers).
                $tenanticon = $this->pix_icon('sitemap', $tenantstr, 'tool_tenant');
                $links .= ' ' . html_writer::link('#', $tenanticon, [
                    'data-action' => 'show-federation-tenantavailability',
                    'data-id' => $federation->id,
                    'data-name' => $federation->shortname,
                    'title' => $tenantstr,
                ]);
            }

            $deleteurl = new moodle_url($baseurl, ['action' => 'delete', 'id' => $federation->id]);
            $links .= ' ' . html_writer::link($deleteurl, $this->pix_icon('t/delete', get_string('delete')));

            if ($enabled) {
                $disableurl = new moodle_url($baseurl, [
                    'action' => 'disable',
                    'id' => $federation->id,
                    'sesskey' => sesskey(),
                ]);
                $links .= ' ' . html_writer::link($disableurl, $this->pix_icon('t/hide', get_string('disable')));
            } else {
                $enableurl = new moodle_url($baseurl, [
                    'action' => 'enable',
                    'id' => $federation->id,
                    'sesskey' => sesskey(),
                ]);
                $links .= ' ' . html_writer::link($enableurl, $this->pix_icon('t/show', get_string('enable')));
            }

            if (!$last) {
                $movedownurl = new moodle_url($baseurl, [
                    'action' => 'movedown',
                    'id' => $federation->id,
                    'sesskey' => sesskey(),
                ]);
                $links .= ' ' . html_writer::link($movedownurl, $this->pix_icon('t/down', get_string('movedown')));
            }
            if (!$first) {
                $moveupurl = new moodle_url($baseurl, [
                    'action' => 'moveup',
                    'id' => $federation->id,
                    'sesskey' => sesskey(),
                ]);
                $links .= ' ' . html_writer::link($moveupurl, $this->pix_icon('t/up', get_string('moveup')));
            }

            $rowcells[] = new html_table_cell($links);

            $row = new html_table_row($rowcells);
            if (!$enabled) {
                $row->attributes['class'] = 'dimmed_text';
            }
            $data[] = $row;
            $index++;
        }

        $table->data = $data;
        return html_writer::table($table);
    }
}
