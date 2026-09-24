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
 * Anobody can login using saml2
 *
 * @package   auth_saml2
 * @copyright Brendan Heywood <brendan@catalyst-au.net>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['allowcreate'] = 'Tillat oppretting';
$string['allowcreate_help'] = 'Tillat oppretting av IdP-brukere ved behov';
$string['alterlogout'] = 'Alternativ utloggings-URL';
$string['alterlogout_help'] = 'URL som brukeren omdirigeres til etter at alle interne utloggingsmekanismer er kjørt';
$string['anyauth'] = 'Tillat alle autentiseringstyper';
$string['anyauth_help'] = 'Ja: Tillat SAML-innlogging for alle brukere? Nei: Bare brukere med saml2 som type.';
$string['anyauthotherdisabled'] = 'Du har logget inn som \'{$a->username}\', men autentiseringstypen din \'{$a->auth}\' er deaktivert.';
$string['assertionsconsumerservices'] = 'Assertions-forbrukertjenester';
$string['assertionsconsumerservices_help'] = 'Liste over bindings som SP skal støtte';
$string['attemptsignout'] = 'Forsøk IdP-utlogging';
$string['attemptsignout_help'] = 'Dette vil forsøke å kommunisere med IdP for å sende en utloggingsforespørsel';
$string['attrsimple'] = 'Forenkle attributter';
$string['attrsimple_help'] = 'Ulike IdP-er som ADFS bruker lange attributtnøkler som urns eller namespaced xml-skjemanavn. Hvis satt til Ja, forenkles disse, f.eks. mappe http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname til \'givenname\'.';
$string['auth_data_mapping'] = 'Datamapping';
$string['auth_fieldlock_expl'] = '<p><b>Lås verdi:</b> Hvis aktivert, hindres Moodle-brukere og administratorer i å redigere feltet direkte. Bruk dette hvis du vedlikeholder dataene i det eksterne autentiseringssystemet.</p>';
$string['auth_fieldlockfield'] = 'Lås verdi ({$a})';
$string['auth_fieldlocks'] = 'Lås brukerfelt';
$string['auth_fieldmapping'] = 'Datamapping ({$a})';
$string['auth_saml2blockredirectdescription'] = 'Omdiriger eller vis melding til SAML2-innlogginger basert på konfigurerte grupperestriksjoner';
$string['auth_saml2description'] = 'Autentiser med en SAML2 Identity Provider (IdP)';
$string['auth_updatelocalfield'] = 'Oppdater lokalt ({$a})';
$string['auth_updateremotefield'] = 'Oppdater eksternt ({$a})';
$string['authncontext'] = 'AuthnContext';
$string['authncontext_help'] = 'Tillater utvidelse av assertions. La stå tomt med mindre det kreves';
$string['autocreate'] = 'Opprett brukere automatisk';
$string['autocreate_help'] = 'Tillat oppretting av Moodle-brukere ved behov';
$string['autologin'] = 'Auto-innlogging';
$string['autologin_help'] = 'På sider som tillater gjestetilgang uten innlogging, logg brukere automatisk inn i Moodle med en ekte brukerkonto hvis de er logget inn hos IdP (via passiv autentisering).';
$string['autologinbycookie'] = 'Sjekk når den angitte cookien finnes eller endres';
$string['autologinbysession'] = 'Sjekk én gang per økt';
$string['autologincookie'] = 'Cookie for auto-innlogging';
$string['autologincookie_help'] = 'Navn på cookie som brukes for å avgjøre når auto-innlogging skal forsøkes (kun relevant hvis cookie-valget er valgt ovenfor).';
$string['availableidps'] = 'Velg tilgjengelige IdP-er';
$string['availableidps_help'] = 'Hvis en IdP-metadata-xml inneholder flere IdP-entiteter, må du velge hvilke entiteter som er tilgjengelige for innlogging.
';
$string['federation_add'] = 'Legg til federert innlogging';
$string['federation_add_help'] = 'Konfigurer én eller flere føderasjoner (f.eks. HAKA, eduGAIN). Hver føderasjon får sin egen innloggingsknapp som sender brukeren til føderasjonens discovery-tjeneste. Dette er separat fra den globale innstillingen $CFG->auth_saml2_disco_url.';
$string['federation_manage'] = 'Administrer federerte innlogginger';
$string['federation_edit'] = 'Rediger federert innlogging';
$string['federation_remove'] = 'Fjern federert innlogging';
$string['federation_save'] = 'Lagre konfigurasjon';
$string['federation_shortname'] = 'Føderasjon shortname';
$string['federation_shortname_help'] = 'Unikt kort navn uten mellomrom (f.eks. HAKA eller eduGAIN). Brukes i innloggings-URL-en.';
$string['federation_shortname_invalid'] = 'Shortname kan ikke inneholde mellomrom eller spesialtegn. Bruk bare bokstaver, tall, punktum, understreker eller bindestreker.';
$string['federation_shortname_exists'] = 'En føderasjon med dette shortname finnes allerede.';
$string['federation_metadataurl'] = 'Føderasjon metadata-URL';
$string['federation_metadataurl_help'] = 'Offentlig URL til føderasjonens metadata-XML (f.eks. https://haka.funet.fi/metadata/haka-metadata-v10.xml). Brukes ved etablering av innloggingsøkt etter discovery.';
$string['federation_discourl'] = 'URL til føderasjonens discovery-tjeneste';
$string['federation_discourl_help'] = 'URL til føderasjonens IdP discovery-tjeneste (f.eks. https://haka.funet.fi/DS). Brukere omdirigeres hit når de klikker på føderasjonens innloggingsknapp.';
$string['federation_buttonlabel'] = 'Etikett for innloggingsknapp';
$string['federation_buttonlabel_help'] = 'Tekst som vises på Moodle-innloggingssiden for denne føderasjonen.';
$string['federation_logo'] = 'Logo for innloggingsknapp';
$string['federation_logo_help'] = 'Valgfritt bilde for innloggingsknappen. Brukes når knappvisningen inkluderer logoen.';
$string['federation_buttondisplay'] = 'Visning av innloggingsknapp';
$string['federation_buttondisplay_help'] = 'Som standard vises logoen når en er lastet opp, ellers vises etiketten. Du kan også vise logoen foran etiketten. Hvis det ikke finnes en logo, vises bare etiketten.';
$string['federation_buttondisplay_auto'] = 'Logo hvis lastet opp, ellers etikett';
$string['federation_buttondisplay_both'] = 'Logo og etikett';
$string['federation_buttondisplay_invalid'] = 'Velg en gyldig visning av innloggingsknappen.';
$string['federation_alwaysactive'] = 'Aktiv. En konfigurert føderasjon er alltid en aktiv IdP.';
$string['federation_info'] = 'Federerte innlogginger er uavhengige av valgte IdP-er. Hver føderasjon legger til en innloggingsknapp som bruker sin egen discovery-tjeneste og metadata. Eksisterende IdP-konfigurasjon endres ikke. Den globale $CFG->auth_saml2_disco_url gjelder fortsatt når ingen føderasjonsknapp brukes.';
$string['federation_none'] = 'Ingen federerte innlogginger konfigurert ennå.';
$string['federation_saved'] = 'Federert innlogging lagret.';
$string['federation_deleted'] = 'Federert innlogging fjernet.';
$string['federation_deleteconfirm'] = 'Er du sikker på at du vil fjerne den federerte innloggingen "{$a}"?';
$string['federation_notfound'] = 'Federert innlogging ble ikke funnet.';
$string['federation_invalidurl'] = 'Oppgi en gyldig URL.';
$string['federation_unknown'] = 'Ukjent føderasjon: {$a}';
$string['federation_tenantunavailable'] = 'Den federerte innloggingen "{$a}" er ikke tilgjengelig for gjeldende tenant.';
$string['federation_tenantavailability'] = 'Tenant-tilgjengelighet';
$string['federation_tenantavailabilityfor'] = 'Tenant-tilgjengelighet for \'{$a}\'';
$string['federation_tenantavailability_success'] = 'Føderasjonens tenant-tilgjengelighet ble oppdatert';
$string['federation_tenantmode'] = 'Tilgjengelig for';
$string['federation_tenantmode_help'] = 'Styrer hvilke Moodle Workplace-tenants som kan se og bruke denne føderasjonens innloggingsknapp. Konfigurer fra listesiden via handlingen for tenant-tilgjengelighet. På nettsteder uten Workplace-tenancy ignoreres disse innstillingene.';
$string['federation_tenantmode_all'] = 'Alle tenants';
$string['federation_tenantmode_include'] = 'Bare følgende tenants';
$string['federation_tenantmode_exclude'] = 'Alle tenants unntatt følgende';
$string['federation_tenantmode_include_summary'] = 'Inkluder ({$a})';
$string['federation_tenantmode_exclude_summary'] = 'Ekskluder ({$a})';
$string['federation_tenantids_include'] = 'Inkluderte tenants';
$string['federation_tenantids_exclude'] = 'Ekskluderte tenants';
$string['federation_tenantids_required'] = 'Velg minst én tenant.';
$string['federation_editnamed'] = 'Rediger federert innlogging: {$a}';
$string['federation_createnew'] = 'Opprett ny federert innlogging';
$string['federation_enabled'] = 'Federert innlogging aktivert.';
$string['federation_disabled'] = 'Federert innlogging deaktivert.';
$string['federation_disabled_error'] = 'Den federerte innloggingen "{$a}" er deaktivert.';
$string['federation_metadatastatus'] = 'Metadata';
$string['federation_metadatastatus_help'] = 'Om føderasjonens metadata-XML er lastet ned og cachet riktig.';
$string['federation_metadatastatus_ok'] = 'Metadata cachet';
$string['federation_metadatastatus_missing'] = 'Metadata mangler';
$string['eventfederationcreated'] = 'SAML2-føderasjon opprettet';
$string['eventfederationupdated'] = 'SAML2-føderasjon oppdatert';
$string['eventfederationdeleted'] = 'SAML2-føderasjon slettet';
$string['eventfederationtenantavailabilityupdated'] = 'SAML2-føderasjon tenant-tilgjengelighet oppdatert';
$string['blockredirectheading'] = 'Handlinger ved kontosperring';
$string['cannotmapfield'] = 'Mapping-kollisjon oppdaget - to felt mapper til samme karakterelement {$a}';
$string['certificate'] = 'Regenerer sertifikat';
$string['certificate_help'] = 'Regenerer den private nøkkelen og sertifikatet som brukes av denne SP. | <a href=\'{$a}\'>Vis SP-sertifikat</a>';
$string['certificatedetails'] = 'Sertifikatdetaljer';
$string['certificatedetailshelp'] = '<h1>Innhold i SAML2 auto-generert offentlig sertifikat</h1><p>Stien til sertifikatet er her:</p>';
$string['certificatelock'] = 'Lås sertifikat';
$string['certificatelock_help'] = 'Låsing av sertifikater forhindrer at de overskrives når de først er generert.';
$string['certificatelock_locked'] = 'Sertifikatet er låst';
$string['certificatelock_lockedmessage'] = 'Sertifikatene er for øyeblikket låst.';
$string['certificatelock_regenerate'] = 'Regenererer ikke sertifikater fordi de er låst!';
$string['certificatelock_unlock'] = 'Lås opp sertifikater';
$string['certificatelock_warning'] = 'Advarsel. Du er i ferd med å låse sertifikatene. Er du sikker? <br> Sertifikatene er for øyeblikket ikke låst';
$string['keysize'] = 'Nøkkelstørrelse';
$string['keysize_help'] = 'Angir bitstørrelsen på de offentlige/private nøklene som brukes til å generere og signere sertifikatet.';
$string['checkcertificateexpired'] = 'SAML-sertifikatet utløp for {$a} siden';
$string['checkcertificateexpiry'] = 'SAML-sertifikatets utløp';
$string['checkcertificateok'] = 'SAML-sertifikatet utløper om {$a}';
$string['checkcertificatewarn'] = 'SAML-sertifikatet utløper om {$a}';
$string['commonname'] = 'Common Name';
$string['countryname'] = 'Land';
$string['debug'] = 'Feilsøking';
$string['debug_help'] = '<p>Legger til ekstra feilsøking i den vanlige Moodle-loggen | <a href=\'{$a}\'>Vis SSP-konfigurasjon</a></p>';
$string['duallogin'] = 'Dobbel innlogging';
$string['duallogin_help'] = '
<p>Hvis på, ser brukere både manuell og SAML-innloggingsknapp. Hvis av, tas de alltid direkte til IdP-innloggingssiden.</p>
<p>Hvis passiv, logges brukere som allerede er autentisert hos IdP automatisk inn, ellers sendes de til Moodle-innloggingssiden.</p>
<p>Hvis av, kan administratorer fortsatt se den manuelle innloggingssiden via /login/index.php?saml=off</p>
<p>Hvis på, kan eksterne sider deep-linke til Moodle med saml, f.eks. /course/view.php?id=45&saml=on</p>
<p>Hvis satt til test IdP-tilkobling, sjekkes nettverket for tilkobling, og hvis det fungerer, startes SAML-innlogging.</p>';
$string['emailtaken'] = 'Kan ikke opprette ny konto fordi e-postadressen {$a} allerede er registrert';
$string['emailtakenupdate'] = 'E-posten din ble ikke oppdatert fordi e-postadressen {$a} allerede er registrert';
$string['error'] = 'Innloggingsfeil';
$string['errorinvalidautologin'] = 'Ugyldig auto-innloggingsforespørsel';
$string['errorparsingxml'] = 'Feil ved parsing av XML: {$a}';
$string['exception'] = 'SAML2-unntak: {$a}';
$string['expirydays'] = 'Utløp i dager';
$string['fielddelimiter'] = 'Feltskilletegn';
$string['fielddelimiter_help'] = 'Skilletegnet som brukes når et felt mottar en array av verdier fra IdP.';
$string['flaggedresponsetypemessage'] = 'Vis tilpasset melding';
$string['flaggedresponsetyperedirect'] = 'Omdiriger til ekstern URL';
$string['flagmessage'] = 'Svarmelding';
$string['flagmessage_default'] = 'Du er logget inn hos identity provider, men denne kontoen har begrenset tilgang til Moodle. Kontakt administratoren for mer informasjon.';
$string['flagmessage_help'] = '
<p>Meldingen som vises når en bruker ikke har tilgang til Moodle basert på konfigurerte grupperestriksjoner.</p>
<p>(Vises bare når \'Svartype\' er \'Vis tilpasset melding\'.)</p>';
$string['flagredirecturl'] = 'Omdirigerings-URL';
$string['flagredirecturl_help'] = '
<p>URL som brukeren omdirigeres til når tilgang til Moodle ikke er tillatt basert på konfigurerte grupperestriksjoner.</p>
<p>(Brukes bare når \'Svartype\' er \'Omdiriger til ekstern URL\'.)</p>';
$string['flagresponsetype'] = 'Svartype ved kontosperring';
$string['flagresponsetype_help'] = 'Hvis tilgang blokkeres basert på konfigurerte grupperestriksjoner, hvordan skal Moodle svare?';
$string['grouprules'] = 'Grupperegler';
$string['grouprules_help'] = '<p>En liste med regler for å styre tilgang basert på group-attributtverdien.</p>
<p>Hver linje skal ha én regel i formatet: {allow or deny} {groups attribute}={value}.</p>
<p>Regler høyere i listen brukes først.</p>
Eksempel: <br/>
allow admins=yes<br>
deny admins=no<br>
allow examrole=proctor<br>
deny library=overdue<br>';
$string['idpattr'] = 'IdP-mapping';
$string['idpattr_help'] = 'Hvilken IdP-attributt skal matches mot et Moodle-brukerfelt?';
$string['idpmetadata'] = 'IdP-metadata xml ELLER offentlig xml-URL';
$string['idpmetadata_badurl'] = 'Ugyldig metadata på {$a}';
$string['idpmetadata_help'] = 'For å bruke flere IdP-er, skriv inn hver offentlig metadata-URL på en ny linje.<br/>For å overstyre et navn, plasser tekst før http. f.eks. "Forced IdP Name http://ssp.local/simplesaml/saml2/idp/metadata.php"';
$string['idpmetadata_invalid'] = 'IdP-XML er ikke gyldig';
$string['idpmetadata_noentityid'] = 'IdP-XML har ingen entityID';
$string['idpmetadatarefresh'] = 'Oppdatering av IdP-metadata';
$string['idpmetadatarefresh_help'] = 'Kjør en planlagt oppgave for å oppdatere IdP-metadata fra IdP-metadata-URL';
$string['idpname'] = 'IdP-etikett overstyring';
$string['idpname_help'] = 'f.eks. myUNI - detekteres fra metadata og vises på siden for dobbel innlogging (hvis aktivert)';
$string['idpnamedefault'] = 'Logg inn via SAML2';
$string['idpnamedefault_varaible'] = 'Logg inn via SAML2 ({$a})';
$string['localityname'] = 'Lokalitet';
$string['locked'] = 'Låst';
$string['logdir'] = 'Loggkatalog';
$string['logdir_help'] = 'Loggkatalogen SSPHP skriver til; filen heter simplesamlphp.log';
$string['logdirdefault'] = '/tmp/';
$string['logtofile'] = 'Aktiver logging til fil';
$string['logtofile_help'] = 'Aktivering omdirigerer SSPHP-loggutdata til en fil i logdir';
$string['manageidpsheading'] = 'Administrer tilgjengelige Identity Providers (IdP-er)';
$string['mdlattr'] = 'Moodle-mapping';
$string['mdlattr_help'] = 'Hvilket Moodle-brukerfelt skal IdP-attributten matches til?';
$string['metadatafetchfailed'] = 'Henting av metadata mislyktes: {$a}';
$string['metadatafetchfailedstatus'] = 'Henting av metadata mislyktes: Statuskode {$a}';
$string['metadatafetchfailedunknown'] = 'Henting av metadata mislyktes: Ukjent cURL-feil';
$string['moodleidpdescription'] = 'Innstillinger for Moodle som Identity Provider for andre tjenester.';
$string['moodleidpenabled'] = 'Aktiver IdP';
$string['moodleidpenabled_error'] = 'Moodle IdP er ikke aktivert. Sjekk innstillinger.';
$string['moodleidpenabled_help'] = 'Tillat Moodle å fungere som IdP for eksterne tjenester.';
$string['moodleidpguest_error'] = 'Gjestbrukere kan ikke logge inn via SAML.';
$string['moodleidpheading'] = 'Moodle IdP-innstillinger';
$string['moodleidpmetadata'] = 'IdP-metadata';
$string['moodleidpmetadata_help'] = '<a href=\'{$a}\'>Vis Identity Provider-metadata</a> | <a href=\'{$a}?download=1\'>Last ned IdP-metadata</a>';
$string['moodleidpsplist'] = 'Gyldige issuers';
$string['moodleidpsplist_error'] = 'Ukjent tjeneste forsøker å autentisere: {$a}. Sjekk konfigurasjon.';
$string['moodleidpsplist_help'] = 'Liste over tjenester som får bruke denne Moodle som IdP, identifisert via <code>saml:Issuer</code>-taggen i SAML-forespørselen. Én per linje. {$a->example}';
$string['multiidp:label:active'] = 'Aktiv';
$string['multiidp:label:admin'] = 'Bare for administratorer';
$string['multiidp:label:admin_help'] = 'Brukere som logger inn via denne IdP gjøres automatisk til nettstedsadministrator';
$string['multiidp:label:alias'] = 'Alias';
$string['multiidp:label:defaultidp'] = 'Standard-IdP';
$string['multiidp:label:displayname'] = 'Visningsnavn';
$string['multiidp:label:whitelist'] = 'Omdirigerte IP-adresser';
$string['multiidp:label:whitelist_help'] = 'Hvis satt, tvinges klienter til denne IdP. Format: xxx.xxx.xxx.xxx/bitmask. Skill flere subnet på ny linje.';
$string['multiidpbuttons'] = 'Knapper med ikoner';
$string['multiidpdisplay'] = 'Visningstype for flere IdP-er';
$string['multiidpdisplay_help'] = 'Hvis en IdP-metadata-xml inneholder flere IdP-entiteter, hvordan skal hver tilgjengelige IdP vises?';
$string['multiidpdropdown'] = 'Nedtrekksliste';
$string['multiidpinfo'] = '
<ul>
<li>En IdP kan bare brukes hvis den er satt til Aktiv</li>
<li>Når dobbel innlogging er slått på, vises alle aktive IdP-er på innloggingssiden</li>
<li>Når en IdP er satt som Standard og dobbel innlogging ikke er slått på, brukes denne IdP automatisk med mindre ?multiidp=on eller saml=off sendes til /login/index.php</li>
<li>En IdP kan gis et Alias; via /login/index.php?idpalias={alias} kan aliaset brukes for å gå direkte til den IdP</li>
</ul>';
$string['nameidasattrib'] = 'Eksponer NameID som attributt';
$string['nameidasattrib_help'] = 'NameID-claim eksponeres for SSPHP som en attributt kalt nameid';
$string['nameidpolicy'] = 'NameID Policy';
$string['nameidpolicy_help'] = '';
$string['noattribute'] = 'Du har logget inn, men vi fant ikke \'{$a}\'-attributten din for å knytte deg til en konto i Moodle.';
$string['noidpfound'] = 'IdP \'{$a}\' ble ikke funnet som en konfigurert IdP.';
$string['noredirectips'] = 'Begrens noredirect etter IP';
$string['noredirectips_help'] = 'Når dobbel innlogging er slått av og IP-er er satt, begrenses bruken av ?saml=off og ?noredirect=1 under SAML-innlogging til brukere med matchende IP-subnet.';
$string['nouser'] = 'Du har logget inn som \'{$a}\', men har ikke en konto i Moodle.';
$string['nullprivatecert'] = 'Oppretting av privat sertifikat mislyktes.';
$string['nullpubliccert'] = 'Oppretting av offentlig sertifikat mislyktes.';
$string['organizationalunitname'] = 'Organisatorisk enhet';
$string['organizationname'] = 'Organisasjon';
$string['passivemode'] = 'Passiv modus';
$string['phone1'] = 'Telefon';
$string['phone2'] = 'Mobiltelefon';
$string['plugindisabled'] = 'SAML2-autentiseringsplugin er deaktivert';
$string['pluginname'] = 'SAML2';
$string['privatekeypass'] = 'Passord for privat sertifikatnøkkel';
$string['privatekeypass_help'] = 'Brukes til å signere det lokale Moodle-sertifikatet; endring ugyldiggjør det nåværende sertifikatet.';
$string['regenerate_submit'] = 'Regenerer';
$string['regenerateheading'] = 'Regenerer privat nøkkel og sertifikat';
$string['rememberidp'] = 'Husk innloggingstjeneste';
$string['requestedattributes'] = 'Forespurte attributter';
$string['requestedattributes_help'] = 'Noen IdP-er krever at SP erklærer hvilke attributter som forespørres eller er påkrevd. Legg til hver attributt på en ny linje; de vil stå i SP-metadata under <code>AttributeConsumingService</code>. Hvis et felt skal være påkrevd, legg til mellomrom og * etter linjen. {$a->example}';
$string['required'] = 'Dette feltet er påkrevd';
$string['requireint'] = 'Dette feltet er påkrevd og må være et positivt heltall';
$string['showidplink'] = 'Vis IdP-lenke';
$string['showidplink_help'] = 'Viser IdP-lenken når nettstedet er konfigurert.';
$string['source'] = 'Kilde: {$a}';
$string['spentityid'] = 'Entity ID';
$string['spentityid_help'] = 'Overstyr Entity ID for Service Provider. I de fleste tilfeller: la stå tomt for en god standard.';
$string['spmetadata'] = 'SP-metadata';
$string['spmetadata_help'] = '<a href=\'{$a}\'>Vis Service Provider-metadata</a> | <a href=\'{$a}?download=1\'>Last ned SP-metadata</a>
<p>Du kan måtte gi dette til IdP-administratoren for å whiteliste deg.</p>';
$string['spmetadatasign'] = 'SP-metadata-signatur';
$string['spmetadatasign_help'] = 'Signer SP-metadata.';
$string['sspversion'] = 'SimpleSAMLphp-versjon';
$string['stateorprovincename'] = 'Delstat eller provins';
$string['status'] = 'Status';
$string['suspendeduser'] = 'Du har logget inn som \'{$a}\', men kontoen din er suspendert i Moodle.';
$string['taskmetadatarefresh'] = 'Oppgave for metadataoppdatering';
$string['tempdir'] = 'SimpleSAMLphp midlertidig katalog';
$string['tempdir_help'] = 'En katalog der SimpleSAMLphp kan lagre midlertidige filer';
$string['test_auth_button_login'] = 'IdP-innlogging';
$string['test_auth_button_logout'] = 'IdP-utlogging';
$string['test_auth_str'] = 'Test isAuthenticated og innlogging';
$string['test_endpoint'] = 'URL for tilkoblingstest';
$string['test_endpoint_desc'] = 'Oppgi en URL for å teste tilkobling for IdP-omdirigering fra klientnettleseren. Noen brukere eller nettverk har kanskje ikke tilkobling til IdP pga. konto- eller nettverkstillatelser.';
$string['test_idp_conn'] = 'Test IdP-tilkobling';
$string['test_noticetestrequirements'] = 'For å bruke denne testen må plugin være konfigurert, aktivert, og feilsøking må være aktivert i plugin-innstillinger.';
$string['test_passive_str'] = 'Test med isPassive';
$string['testdebuggingdisabled'] = 'For å bruke denne testsiden må SAML-feilsøking være på';
$string['tolower'] = 'Store/små bokstaver ved matching';
$string['tolower:caseandaccentinsensitive'] = 'Uavhengig av store/små bokstaver og aksenter';
$string['tolower:caseinsensitive'] = 'Uavhengig av store/små bokstaver';
$string['tolower:exact'] = 'Eksakt';
$string['tolower:lowercase'] = 'Små bokstaver';
$string['tolower_help'] = '
<p>Eksakt: matching er skiftfølsom (standard).</p>
<p>Små bokstaver: bruker små bokstaver på IdP-attributten før matching.</p>
<p>Uavhengig av store/små bokstaver: ignorer skift ved matching.</p>';
$string['unlocked'] = 'Ulåst';
$string['unlockedifempty'] = 'Ulåst hvis tom';
$string['update_never'] = 'Aldri';
$string['update_oncreate'] = 'Ved oppretting';
$string['update_onlogin'] = 'Ved hver innlogging';
$string['update_onupdate'] = 'Ved oppdatering';
$string['wantassertionssigned'] = 'Krev signerte assertions';
$string['wantassertionssigned_help'] = 'Om assertions mottatt av denne SP må være signert';
$string['wrongauth'] = 'Du har logget inn som \'{$a}\', men er ikke autorisert til å få tilgang til Moodle.';
/*
 * Privacy provider (GDPR)
 */
$string["privacy:no_data_reason"] = "SAML2-autentiseringspluginet lagrer ingen personopplysninger.";

/*
 * Signing Algorithm
 */
$string['sha1'] = 'Eldre SHA1 (farlig)';
$string['sha256'] = 'SHA256';
$string['sha384'] = 'SHA384';
$string['sha512'] = 'SHA512';
$string['signaturealgorithm'] = 'Signeringsalgoritme';
$string['signaturealgorithm_help'] = 'Algoritmen som brukes til å signere SAML-forespørsler. Advarsel: SHA1 leveres bare for bakoverkompatibilitet; med mindre du absolutt må bruke den, anbefales minst SHA256.';
$string['selectloginservice'] = 'Velg en innloggingstjeneste';
$string['regenerateheader'] = 'Regenerer privat nøkkel og sertifikat';
$string['regeneratewarning'] = 'Advarsel! Generering av et nytt sertifikat overskriver det nåværende, og du kan måtte oppdatere IdP-en din';
$string['regeneratepath'] = 'Sertifikatsti: {$a}';
$string['regenerateheader'] = 'Regenerer privat nøkkel og sertifikat';
$string['regeneratesuccess'] = 'Privat nøkkel og sertifikat er regenerert';
