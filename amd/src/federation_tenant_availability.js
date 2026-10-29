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
 * Modal form for federation tenant availability.
 *
 * @module     auth_saml2/federation_tenant_availability
 * @copyright  2026 moxis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import ModalForm from 'core_form/modalform';
import Notification from 'core/notification';
import * as Str from 'core/str';

const SELECTOR = '[data-action="show-federation-tenantavailability"]';

/**
 * Open tenant availability modal for a federation.
 *
 * @param {Event} event
 */
const openModal = (event) => {
    const trigger = event.target.closest(SELECTOR);
    if (!trigger) {
        return;
    }
    event.preventDefault();

    const federationId = trigger.dataset.id;
    const federationName = trigger.dataset.name || '';

    const modalForm = new ModalForm({
        formClass: 'auth_saml2\\form\\federation_tenant_availability',
        args: {id: federationId},
        modalConfig: {
            title: Str.get_string('federation_tenantavailabilityfor', 'auth_saml2', federationName),
            scrollable: false,
        },
        returnFocus: trigger,
        saveButtonText: Str.get_string('save', 'core'),
    });

    modalForm.addEventListener(modalForm.events.FORM_SUBMITTED, () => {
        Str.get_string('federation_tenantavailability_success', 'auth_saml2')
            .then((message) => {
                // Reload so the tenant availability column updates.
                window.location.reload();
                return message;
            })
            .catch(Notification.exception);
    });

    modalForm.show();
};

/**
 * Initialise event delegation on the manage federations page.
 */
export const init = () => {
    document.addEventListener('click', openModal);
};
