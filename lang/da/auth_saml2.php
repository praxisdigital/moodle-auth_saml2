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

$string['allowcreate'] = 'Tillad oprettelse';
$string['allowcreate_help'] = 'Tillad oprettelse af IdP-brugere efter behov';
$string['alterlogout'] = 'Alternativ logout-URL';
$string['alterlogout_help'] = 'URL som brugeren omdirigeres til, når alle interne logout-mekanismer er kørt';
$string['anyauth'] = 'Tillad alle auth-typer';
$string['anyauth_help'] = 'Ja: Tillad SAML-login for alle brugere? Nej: Kun brugere med saml2 som type.';
$string['anyauthotherdisabled'] = 'Du er logget ind som \'{$a->username}\', men din auth-type \'{$a->auth}\' er deaktiveret.';
$string['assertionsconsumerservices'] = 'Assertions-forbrugertjenester';
$string['assertionsconsumerservices_help'] = 'Liste over bindings som SP skal understøtte';
$string['attemptsignout'] = 'Forsøg IdP-signout';
$string['attemptsignout_help'] = 'Forsøger at kommunikere med IdP for at sende en signout-anmodning';
$string['attrsimple'] = 'Forenkl attributter';
$string['attrsimple_help'] = 'Forskellige IdP\'er som ADFS bruger lange attributnøgler såsom urns eller namespaced xml-skemanavne. Hvis sat til Ja, forenkles disse, f.eks. map http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname til \'givenname\'.';
$string['auth_data_mapping'] = 'Datamapping';
$string['auth_fieldlock_expl'] = '<p><b>Lås værdi:</b> Hvis aktiveret, forhindres Moodle-brugere og administratorer i at redigere feltet direkte. Brug denne indstilling, hvis du vedligeholder dataene i det eksterne auth-system.</p>';
$string['auth_fieldlockfield'] = 'Lås værdi ({$a})';
$string['auth_fieldlocks'] = 'Lås brugerfelter';
$string['auth_fieldmapping'] = 'Datamapping ({$a})';
$string['auth_saml2blockredirectdescription'] = 'Omdiriger eller vis besked til SAML2-logins baseret på konfigurerede grupperestriktioner';
$string['auth_saml2description'] = 'Autentificer med en SAML2 Identity Provider (IdP)';
$string['auth_updatelocalfield'] = 'Opdater lokalt ({$a})';
$string['auth_updateremotefield'] = 'Opdater eksternt ({$a})';
$string['authncontext'] = 'AuthnContext';
$string['authncontext_help'] = 'Tillader udvidelse af assertions. Lad stå tom, medmindre det er påkrævet';
$string['autocreate'] = 'Opret brugere automatisk';
$string['autocreate_help'] = 'Tillad oprettelse af Moodle-brugere efter behov';
$string['autologin'] = 'Automatisk login';
$string['autologin_help'] = 'På sider der tillader gæsteadgang uden login, log brugere automatisk ind i Moodle med en rigtig brugerkonto, hvis de er logget ind hos IdP (via passiv autentificering).';
$string['autologinbycookie'] = 'Tjek når den angivne cookie findes eller ændres';
$string['autologinbysession'] = 'Tjek én gang pr. session';
$string['autologincookie'] = 'Auto-login-cookie';
$string['autologincookie_help'] = 'Navn på cookie der bruges til at afgøre, hvornår auto-login skal forsøges (kun relevant hvis cookie-indstillingen er valgt ovenfor).';
$string['availableidps'] = 'Vælg tilgængelige IdP\'er';
$string['availableidps_help'] = 'Hvis en IdP-metadata-xml indeholder flere IdP-entiteter, skal du vælge hvilke entiteter der er tilgængelige for brugere at logge ind med.
';
$string['federation_add'] = 'Tilføj federeret login';
$string['federation_add_help'] = 'Konfigurer én eller flere federationer (f.eks. HAKA, eduGAIN). Hver federation får sin egen login-knap, der sender brugeren til federationens discovery-service. Dette er separat fra den globale indstilling $CFG->auth_saml2_disco_url.';
$string['federation_manage'] = 'Administrer federerede logins';
$string['federation_edit'] = 'Rediger federeret login';
$string['federation_remove'] = 'Fjern federeret login';
$string['federation_save'] = 'Gem konfiguration';
$string['federation_shortname'] = 'Federationens shortname';
$string['federation_shortname_help'] = 'Unikt kort navn uden mellemrum (f.eks. HAKA eller eduGAIN). Bruges i login-URL\'en.';
$string['federation_shortname_invalid'] = 'Shortname må ikke indeholde mellemrum eller specialtegn. Brug kun bogstaver, tal, punktummer, understreger eller bindestreger.';
$string['federation_shortname_exists'] = 'En federation med dette shortname findes allerede.';
$string['federation_metadataurl'] = 'Federation metadata-URL';
$string['federation_metadataurl_help'] = 'Offentlig URL til federationens metadata-XML (f.eks. https://haka.funet.fi/metadata/haka-metadata-v10.xml). Bruges ved etablering af login-session efter discovery.';
$string['federation_discourl'] = 'Federation discovery-service-URL';
$string['federation_discourl_help'] = 'URL til federationens IdP discovery-service (f.eks. https://haka.funet.fi/DS). Brugere omdirigeres hertil, når de klikker på federationens login-knap.';
$string['federation_buttonlabel'] = 'Login-knapetiket';
$string['federation_buttonlabel_help'] = 'Tekst der vises på Moodle-loginsiden for denne federation.';
$string['federation_logo'] = 'Login-knaplogo';
$string['federation_logo_help'] = 'Valgfrit billede til login-knappen. Bruges når knapvisningen inkluderer logoet.';
$string['federation_buttondisplay'] = 'Visning af login-knap';
$string['federation_buttondisplay_help'] = 'Som standard vises logoet, når et er uploadet, ellers vises etiketten. Du kan også vise logoet før etiketten. Hvis der ikke er et logo, vises kun etiketten.';
$string['federation_buttondisplay_auto'] = 'Logo hvis uploadet, ellers etiket';
$string['federation_buttondisplay_both'] = 'Logo og etiket';
$string['federation_buttondisplay_invalid'] = 'Vælg en gyldig visning af login-knappen.';
$string['federation_alwaysactive'] = 'Aktiv. En konfigureret federation er altid en aktiv IdP.';
$string['federation_info'] = 'Federerede logins er uafhængige af valgte IdP\'er. Hver federation tilføjer en login-knap, der bruger sin egen discovery-service og metadata. Eksisterende IdP-konfiguration ændres ikke. Den globale $CFG->auth_saml2_disco_url gælder stadig, når ingen federationsknap bruges.';
$string['federation_none'] = 'Ingen federerede logins konfigureret endnu.';
$string['federation_saved'] = 'Federeret login gemt.';
$string['federation_deleted'] = 'Federeret login fjernet.';
$string['federation_deleteconfirm'] = 'Er du sikker på, at du vil fjerne det federerede login "{$a}"?';
$string['federation_notfound'] = 'Federeret login ikke fundet.';
$string['federation_invalidurl'] = 'Angiv en gyldig URL.';
$string['federation_unknown'] = 'Ukendt federation: {$a}';
$string['federation_tenantunavailable'] = 'Det federerede login "{$a}" er ikke tilgængeligt for den aktuelle tenant.';
$string['federation_tenantavailability'] = 'Tenant-tilgængelighed';
$string['federation_tenantavailabilityfor'] = 'Tenant-tilgængelighed for \'{$a}\'';
$string['federation_tenantavailability_success'] = 'Federation tenant-tilgængelighed opdateret';
$string['federation_tenantmode'] = 'Tilgængelig for';
$string['federation_tenantmode_help'] = 'Styrer hvilke Moodle Workplace-tenants der kan se og bruge denne federations login-knap. Konfigurer fra listesiden via tenant-tilgængelighed. På sites uden Workplace-tenancy ignoreres disse indstillinger.';
$string['federation_tenantmode_all'] = 'Alle tenants';
$string['federation_tenantmode_include'] = 'Kun følgende tenants';
$string['federation_tenantmode_exclude'] = 'Alle tenants undtagen følgende';
$string['federation_tenantmode_include_summary'] = 'Inkluder ({$a})';
$string['federation_tenantmode_exclude_summary'] = 'Ekskluder ({$a})';
$string['federation_tenantids_include'] = 'Inkluderede tenants';
$string['federation_tenantids_exclude'] = 'Ekskluderede tenants';
$string['federation_tenantids_required'] = 'Vælg mindst én tenant.';
$string['federation_editnamed'] = 'Rediger federeret login: {$a}';
$string['federation_createnew'] = 'Opret nyt federeret login';
$string['federation_enabled'] = 'Federeret login aktiveret.';
$string['federation_disabled'] = 'Federeret login deaktiveret.';
$string['federation_disabled_error'] = 'Det federerede login "{$a}" er deaktiveret.';
$string['federation_metadatastatus'] = 'Metadata';
$string['federation_metadatastatus_help'] = 'Om federationens metadata-XML er downloadet og cachet korrekt.';
$string['federation_metadatastatus_ok'] = 'Metadata cachet';
$string['federation_metadatastatus_missing'] = 'Metadata mangler';
$string['eventfederationcreated'] = 'SAML2-federation oprettet';
$string['eventfederationupdated'] = 'SAML2-federation opdateret';
$string['eventfederationdeleted'] = 'SAML2-federation slettet';
$string['eventfederationtenantavailabilityupdated'] = 'SAML2-federation tenant-tilgængelighed opdateret';
$string['blockredirectheading'] = 'Kontoblokeringshandlinger';
$string['cannotmapfield'] = 'Mapping-kollision fundet - to felter mapper til samme karakterelement {$a}';
$string['certificate'] = 'Generer certifikat på ny';
$string['certificate_help'] = 'Generer privat nøgle og certifikat brugt af denne SP på ny. | <a href=\'{$a}\'>Vis SP-certifikat</a>';
$string['certificatedetails'] = 'Certifikatdetaljer';
$string['certificatedetailshelp'] = '<h1>Indhold af SAML2 auto-genereret offentligt certifikat</h1><p>Stien til certifikatet er her:</p>';
$string['certificatelock'] = 'Lås certifikat';
$string['certificatelock_help'] = 'Låsning af certifikater forhindrer, at de overskrives, når de først er genereret.';
$string['certificatelock_locked'] = 'Certifikatet er låst';
$string['certificatelock_lockedmessage'] = 'Certifikaterne er i øjeblikket låst.';
$string['certificatelock_regenerate'] = 'Genererer ikke certifikater på ny, fordi de er låst!';
$string['certificatelock_unlock'] = 'Lås certifikater op';
$string['certificatelock_warning'] = 'Advarsel. Du er ved at låse certifikaterne. Er du sikker? <br> Certifikaterne er ikke låst i øjeblikket';
$string['keysize'] = 'Nøglestørrelse';
$string['keysize_help'] = 'Angiver bitstørrelsen på de offentlige/private nøgler, der bruges til at generere og signere certifikatet.';
$string['checkcertificateexpired'] = 'SAML-certifikat udløb for {$a} siden';
$string['checkcertificateexpiry'] = 'SAML-certifikat udløb';
$string['checkcertificateok'] = 'SAML-certifikat udløber om {$a}';
$string['checkcertificatewarn'] = 'SAML-certifikat udløber om {$a}';
$string['commonname'] = 'Common Name';
$string['countryname'] = 'Land';
$string['debug'] = 'Fejlfinding';
$string['debug_help'] = '<p>Tilføjer ekstra fejlfinding til den normale Moodle-log | <a href=\'{$a}\'>Vis SSP-konfiguration</a></p>';
$string['duallogin'] = 'Dobbelt login';
$string['duallogin_help'] = '
<p>Hvis til, ser brugere både manuel og SAML-login-knap. Hvis fra, tages de altid direkte til IdP-loginsiden.</p>
<p>Hvis passiv, logges brugere der allerede er autentificeret hos IdP automatisk ind, ellers sendes de til Moodle-loginsiden.</p>
<p>Hvis fra, kan administratorer stadig se den manuelle loginside via /login/index.php?saml=off</p>
<p>Hvis til, kan eksterne sider deep-linke til Moodle med saml, f.eks. /course/view.php?id=45&saml=on</p>
<p>Hvis sat til test IdP-forbindelse, tjekkes netværket for forbindelse, og hvis det fungerer, startes SAML-login.</p>';
$string['emailtaken'] = 'Kan ikke oprette ny konto, fordi e-mailadressen {$a} allerede er registreret';
$string['emailtakenupdate'] = 'Din e-mail blev ikke opdateret, fordi e-mailadressen {$a} allerede er registreret';
$string['error'] = 'Loginfejl';
$string['errorinvalidautologin'] = 'Ugyldig auto-login-anmodning';
$string['errorparsingxml'] = 'Fejl ved parsing af XML: {$a}';
$string['exception'] = 'SAML2-undtagelse: {$a}';
$string['expirydays'] = 'Udløb i dage';
$string['fielddelimiter'] = 'Feltskilletegn';
$string['fielddelimiter_help'] = 'Skilletegn der bruges, når et felt modtager et array af værdier fra IdP.';
$string['flaggedresponsetypemessage'] = 'Vis tilpasset besked';
$string['flaggedresponsetyperedirect'] = 'Omdiriger til ekstern URL';
$string['flagmessage'] = 'Svarbesked';
$string['flagmessage_default'] = 'Du er logget ind hos din identity provider, men denne konto har begrænset adgang til Moodle. Kontakt din administrator for flere detaljer.';
$string['flagmessage_help'] = '
<p>Beskeden der vises, når en bruger ikke har adgang til Moodle baseret på konfigurerede grupperestriktioner.</p>
<p>(Vises kun når \'Svartype\' er \'Vis tilpasset besked\'.)</p>';
$string['flagredirecturl'] = 'Omdirigerings-URL';
$string['flagredirecturl_help'] = '
<p>URL som brugeren omdirigeres til, når adgang til Moodle ikke er tilladt baseret på konfigurerede grupperestriktioner.</p>
<p>(Bruges kun når \'Svartype\' er \'Omdiriger til ekstern URL\'.)</p>';
$string['flagresponsetype'] = 'Svartype ved kontoblokering';
$string['flagresponsetype_help'] = 'Hvis adgang blokeres baseret på konfigurerede grupperestriktioner, hvordan skal Moodle svare?';
$string['grouprules'] = 'Grupperegler';
$string['grouprules_help'] = '<p>En liste af regler til at styre adgang baseret på group-attributværdien.</p>
<p>Hver linje skal have én regel i formatet: {allow or deny} {groups attribute}={value}.</p>
<p>Regler højere i listen anvendes først.</p>
Eksempel: <br/>
allow admins=yes<br>
deny admins=no<br>
allow examrole=proctor<br>
deny library=overdue<br>';
$string['idpattr'] = 'IdP-mapping';
$string['idpattr_help'] = 'Hvilken IdP-attribut skal matches mod et Moodle-brugerfelt?';
$string['idpmetadata'] = 'IdP-metadata xml ELLER offentlig xml-URL';
$string['idpmetadata_badurl'] = 'Ugyldig metadata på {$a}';
$string['idpmetadata_help'] = 'For at bruge flere IdP\'er skal du indtaste hver offentlig metadata-URL på en ny linje.<br/>For at overskrive et navn, placér tekst før http. f.eks. "Forced IdP Name http://ssp.local/simplesaml/saml2/idp/metadata.php"';
$string['idpmetadata_invalid'] = 'IdP-XML er ikke gyldig';
$string['idpmetadata_noentityid'] = 'IdP-XML har ingen entityID';
$string['idpmetadatarefresh'] = 'Opdatering af IdP-metadata';
$string['idpmetadatarefresh_help'] = 'Kør en planlagt opgave for at opdatere IdP-metadata fra IdP-metadata-URL';
$string['idpname'] = 'IdP-etiket override';
$string['idpname_help'] = 'f.eks. myUNI - detekteres fra metadata og vises på dobbelt-loginsiden (hvis aktiveret)';
$string['idpnamedefault'] = 'Log ind via SAML2';
$string['idpnamedefault_varaible'] = 'Log ind via SAML2 ({$a})';
$string['localityname'] = 'Lokalitet';
$string['locked'] = 'Låst';
$string['logdir'] = 'Logmappe';
$string['logdir_help'] = 'Logmappen SSPHP skriver til; filen hedder simplesamlphp.log';
$string['logdirdefault'] = '/tmp/';
$string['logtofile'] = 'Aktiver logning til fil';
$string['logtofile_help'] = 'Aktivering omdirigerer SSPHP-logoutput til en fil i logdir';
$string['manageidpsheading'] = 'Administrer tilgængelige Identity Providers (IdP\'er)';
$string['mdlattr'] = 'Moodle-mapping';
$string['mdlattr_help'] = 'Hvilket Moodle-brugerfelt skal IdP-attributten matches til?';
$string['metadatafetchfailed'] = 'Hentning af metadata mislykkedes: {$a}';
$string['metadatafetchfailedstatus'] = 'Hentning af metadata mislykkedes: Statuskode {$a}';
$string['metadatafetchfailedunknown'] = 'Hentning af metadata mislykkedes: Ukendt cURL-fejl';
$string['moodleidpdescription'] = 'Indstillinger for Moodle som Identity Provider for andre tjenester.';
$string['moodleidpenabled'] = 'Aktiver IdP';
$string['moodleidpenabled_error'] = 'Moodle IdP er ikke aktiveret. Tjek indstillinger.';
$string['moodleidpenabled_help'] = 'Tillad Moodle at fungere som IdP for eksterne tjenester.';
$string['moodleidpguest_error'] = 'Gæstebrugere kan ikke logge ind via SAML.';
$string['moodleidpheading'] = 'Moodle IdP-indstillinger';
$string['moodleidpmetadata'] = 'IdP-metadata';
$string['moodleidpmetadata_help'] = '<a href=\'{$a}\'>Vis Identity Provider-metadata</a> | <a href=\'{$a}?download=1\'>Download IdP-metadata</a>';
$string['moodleidpsplist'] = 'Gyldige issuers';
$string['moodleidpsplist_error'] = 'Ukendt tjeneste forsøger at autentificere: {$a}. Tjek konfiguration.';
$string['moodleidpsplist_help'] = 'Liste over tjenester der må bruge denne Moodle som IdP, identificeret via <code>saml:Issuer</code>-tagget i SAML-anmodningen. Én pr. linje. {$a->example}';
$string['multiidp:label:active'] = 'Aktiv';
$string['multiidp:label:admin'] = 'Kun for administratorer';
$string['multiidp:label:admin_help'] = 'Brugere der logger ind via denne IdP gøres automatisk til site-administrator';
$string['multiidp:label:alias'] = 'Alias';
$string['multiidp:label:defaultidp'] = 'Standard-IdP';
$string['multiidp:label:displayname'] = 'Visningsnavn';
$string['multiidp:label:whitelist'] = 'Omdirigerede IP-adresser';
$string['multiidp:label:whitelist_help'] = 'Hvis sat, tvinges klienter til denne IdP. Format: xxx.xxx.xxx.xxx/bitmask. Adskil flere subnet på ny linje.';
$string['multiidpbuttons'] = 'Knapper med ikoner';
$string['multiidpdisplay'] = 'Visningstype for flere IdP\'er';
$string['multiidpdisplay_help'] = 'Hvis en IdP-metadata-xml indeholder flere IdP-entiteter, hvordan skal hver tilgængelige IdP vises?';
$string['multiidpdropdown'] = 'Rulleliste';
$string['multiidpinfo'] = '
<ul>
<li>En IdP kan kun bruges, hvis den er sat til Aktiv</li>
<li>Når dobbelt login er slået til, vises alle aktive IdP\'er på loginsiden</li>
<li>Når en IdP er sat som Standard og dobbelt login ikke er slået til, bruges denne IdP automatisk, medmindre ?multiidp=on eller saml=off sendes til /login/index.php</li>
<li>En IdP kan få et Alias; via /login/index.php?idpalias={alias} kan aliaset bruges til at gå direkte til den IdP</li>
</ul>';
$string['nameidasattrib'] = 'Eksponér NameID som attribut';
$string['nameidasattrib_help'] = 'NameID-claim eksponeres for SSPHP som en attribut navngivet nameid';
$string['nameidpolicy'] = 'NameID Policy';
$string['nameidpolicy_help'] = '';
$string['noattribute'] = 'Du er logget ind, men vi kunne ikke finde din \'{$a}\'-attribut til at knytte dig til en konto i Moodle.';
$string['noidpfound'] = 'IdP \'{$a}\' blev ikke fundet som en konfigureret IdP.';
$string['noredirectips'] = 'Begræns noredirect efter IP';
$string['noredirectips_help'] = 'Når dobbelt login er slået fra og IP\'er er sat, begrænses brugen af ?saml=off og ?noredirect=1 under SAML-login til brugere med matchende IP-subnet.';
$string['nouser'] = 'Du er logget ind som \'{$a}\', men har ikke en konto i Moodle.';
$string['nullprivatecert'] = 'Oprettelse af privat certifikat mislykkedes.';
$string['nullpubliccert'] = 'Oprettelse af offentligt certifikat mislykkedes.';
$string['organizationalunitname'] = 'Organisatorisk enhed';
$string['organizationname'] = 'Organisation';
$string['passivemode'] = 'Passiv tilstand';
$string['phone1'] = 'Telefon';
$string['phone2'] = 'Mobiltelefon';
$string['plugindisabled'] = 'SAML2-autentificeringsplugin er deaktiveret';
$string['pluginname'] = 'SAML2';
$string['privatekeypass'] = 'Adgangskode til privat certifikatnøgle';
$string['privatekeypass_help'] = 'Bruges til at signere det lokale Moodle-certifikat; ændring ugyldiggør det nuværende certifikat.';
$string['regenerate_submit'] = 'Generer på ny';
$string['regenerateheading'] = 'Generer privat nøgle og certifikat på ny';
$string['rememberidp'] = 'Husk logintjeneste';
$string['requestedattributes'] = 'Anmodede attributter';
$string['requestedattributes_help'] = 'Nogle IdP\'er kræver at SP erklærer hvilke attributter der anmodes om eller er påkrævet. Tilføj hver attribut på en ny linje; de vil fremgå i SP-metadata under <code>AttributeConsumingService</code>. Hvis et felt skal være påkrævet, tilføj mellemrum og * efter linjen. {$a->example}';
$string['required'] = 'Dette felt er påkrævet';
$string['requireint'] = 'Dette felt er påkrævet og skal være et positivt heltal';
$string['showidplink'] = 'Vis IdP-link';
$string['showidplink_help'] = 'Viser IdP-linket når sitet er konfigureret.';
$string['source'] = 'Kilde: {$a}';
$string['spentityid'] = 'Entity ID';
$string['spentityid_help'] = 'Overskriv Entity ID for Service Provider. I de fleste tilfælde: lad stå tom for en god standard.';
$string['spmetadata'] = 'SP-metadata';
$string['spmetadata_help'] = '<a href=\'{$a}\'>Vis Service Provider-metadata</a> | <a href=\'{$a}?download=1\'>Download SP-metadata</a>
<p>Du skal muligvis give dette til IdP-administratoren for at whitelist\'e dig.</p>';
$string['spmetadatasign'] = 'SP-metadata-signatur';
$string['spmetadatasign_help'] = 'Signer SP-metadata.';
$string['sspversion'] = 'SimpleSAMLphp-version';
$string['stateorprovincename'] = 'Stat eller provins';
$string['status'] = 'Status';
$string['suspendeduser'] = 'Du er logget ind som \'{$a}\', men din konto er suspenderet i Moodle.';
$string['taskmetadatarefresh'] = 'Opgave til opdatering af metadata';
$string['tempdir'] = 'SimpleSAMLphp midlertidig mappe';
$string['tempdir_help'] = 'En mappe hvor SimpleSAMLphp kan gemme midlertidige filer';
$string['test_auth_button_login'] = 'IdP-login';
$string['test_auth_button_logout'] = 'IdP-logout';
$string['test_auth_str'] = 'Test isAuthenticated og login';
$string['test_endpoint'] = 'URL til forbindelsestest';
$string['test_endpoint_desc'] = 'Angiv en URL til at teste forbindelse for IdP-omdirigering fra klientbrowseren. Nogle brugere eller netværk har måske ikke forbindelse til IdP pga. konto- eller netværkstilladelser.';
$string['test_idp_conn'] = 'Test IdP-forbindelse';
$string['test_noticetestrequirements'] = 'For at bruge denne test skal plugin være konfigureret, aktiveret, og fejlfinding skal være aktiveret i plugin-indstillinger.';
$string['test_passive_str'] = 'Test med isPassive';
$string['testdebuggingdisabled'] = 'For at bruge denne testsiden skal SAML-fejlfinding være slået til';
$string['tolower'] = 'Store/små bogstaver ved match';
$string['tolower:caseandaccentinsensitive'] = 'Uafhængig af store/små bogstaver og accenter';
$string['tolower:caseinsensitive'] = 'Uafhængig af store/små bogstaver';
$string['tolower:exact'] = 'Eksakt';
$string['tolower:lowercase'] = 'Små bogstaver';
$string['tolower_help'] = '
<p>Eksakt: match er case-sensitive (standard).</p>
<p>Små bogstaver: anvender små bogstaver på IdP-attributten før match.</p>
<p>Uafhængig af store/små bogstaver: ignorer case ved match.</p>';
$string['unlocked'] = 'Ulåst';
$string['unlockedifempty'] = 'Ulåst hvis tom';
$string['update_never'] = 'Aldrig';
$string['update_oncreate'] = 'Ved oprettelse';
$string['update_onlogin'] = 'Ved hvert login';
$string['update_onupdate'] = 'Ved opdatering';
$string['wantassertionssigned'] = 'Kræv signerede assertions';
$string['wantassertionssigned_help'] = 'Om assertions modtaget af denne SP skal være signeret';
$string['wrongauth'] = 'Du er logget ind som \'{$a}\', men er ikke autoriseret til at tilgå Moodle.';
/*
 * Privacy provider (GDPR)
 */
$string["privacy:no_data_reason"] = "SAML2-autentificeringspluginnet gemmer ingen personlige data.";

/*
 * Signing Algorithm
 */
$string['sha1'] = 'Ældre SHA1 (farligt)';
$string['sha256'] = 'SHA256';
$string['sha384'] = 'SHA384';
$string['sha512'] = 'SHA512';
$string['signaturealgorithm'] = 'Signeringsalgoritme';
$string['signaturealgorithm_help'] = 'Algoritmen der bruges til at signere SAML-anmodninger. Advarsel: SHA1 leveres kun for bagudkompatibilitet; medmindre du absolut skal bruge den, anbefales mindst SHA256.';
$string['selectloginservice'] = 'Vælg en logintjeneste';
$string['regenerateheader'] = 'Generer privat nøgle og certifikat på ny';
$string['regeneratewarning'] = 'Advarsel! Generering af et nyt certifikat overskriver det nuværende, og du skal muligvis opdatere din IdP';
$string['regeneratepath'] = 'Certifikatsti: {$a}';
$string['regenerateheader'] = 'Generer privat nøgle og certifikat på ny';
$string['regeneratesuccess'] = 'Privat nøgle og certifikat er genereret på ny';
