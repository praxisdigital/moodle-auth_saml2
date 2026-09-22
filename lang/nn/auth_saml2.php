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
$string['allowcreate_help'] = 'Tillat oppretting av IdP-brukarar ved behov';
$string['alterlogout'] = 'Alternativ utloggings-URL';
$string['alterlogout_help'] = 'URL som brukaren vert omdirigert til etter at alle interne utloggingsmekanismar er køyrde';
$string['anyauth'] = 'Tillat alle autentiseringstypar';
$string['anyauth_help'] = 'Ja: Tillat SAML-innlogging for alle brukarar? Nei: Berre brukarar med saml2 som type.';
$string['anyauthotherdisabled'] = 'Du har logga inn som \'{$a->username}\', men autentiseringstypen din \'{$a->auth}\' er deaktivert.';
$string['assertionsconsumerservices'] = 'Assertions-forbrukartenester';
$string['assertionsconsumerservices_help'] = 'Liste over bindings som SP skal støtte';
$string['attemptsignout'] = 'Forsøk IdP-utlogging';
$string['attemptsignout_help'] = 'Dette vil forsøkje å kommunisere med IdP for å sende ein utloggingsførespurnad';
$string['attrsimple'] = 'Forenkle attributt';
$string['attrsimple_help'] = 'Ulike IdP-ar som ADFS brukar lange attributtnøklar som urns eller namespaced xml-skjemanamn. Viss sett til Ja, vert desse forenkla, t.d. mappe http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname til \'givenname\'.';
$string['auth_data_mapping'] = 'Datamapping';
$string['auth_fieldlock_expl'] = '<p><b>Lås verdi:</b> Viss aktivert, vert Moodle-brukarar og administratorar hindra i å redigere feltet direkte. Bruk dette viss du vedlikeheld dataa i det eksterne autentiseringssystemet.</p>';
$string['auth_fieldlockfield'] = 'Lås verdi ({$a})';
$string['auth_fieldlocks'] = 'Lås brukarfelt';
$string['auth_fieldmapping'] = 'Datamapping ({$a})';
$string['auth_saml2blockredirectdescription'] = 'Omdiriger eller vis melding til SAML2-innloggingar basert på konfigurerte grupperestriksjonar';
$string['auth_saml2description'] = 'Autentiser med ein SAML2 Identity Provider (IdP)';
$string['auth_updatelocalfield'] = 'Oppdater lokalt ({$a})';
$string['auth_updateremotefield'] = 'Oppdater eksternt ({$a})';
$string['authncontext'] = 'AuthnContext';
$string['authncontext_help'] = 'Tillèt utviding av assertions. La stå tomt med mindre det krevst';
$string['autocreate'] = 'Opprett brukarar automatisk';
$string['autocreate_help'] = 'Tillat oppretting av Moodle-brukarar ved behov';
$string['autologin'] = 'Auto-innlogging';
$string['autologin_help'] = 'På sider som tillèt gjestetilgang utan innlogging, logg brukarar automatisk inn i Moodle med ein ekte brukarkonto viss dei er logga inn hos IdP (via passiv autentisering).';
$string['autologinbycookie'] = 'Sjekk når den oppgjevne cookien finst eller endrast';
$string['autologinbysession'] = 'Sjekk éin gong per økt';
$string['autologincookie'] = 'Cookie for auto-innlogging';
$string['autologincookie_help'] = 'Namn på cookie som vert brukt for å avgjere når auto-innlogging skal forsøkjast (berre relevant viss cookie-valet er valt ovanfor).';
$string['availableidps'] = 'Vel tilgjengelege IdP-ar';
$string['availableidps_help'] = 'Viss ein IdP-metadata-xml inneheld fleire IdP-entitetar, må du velje kva for entitetar som er tilgjengelege for innlogging.
';
$string['federation_add'] = 'Legg til federert innlogging';
$string['federation_add_help'] = 'Konfigurer éin eller fleire føderasjonar (t.d. HAKA, eduGAIN). Kvar føderasjon får si eiga innloggingsknapp som sender brukaren til discovery-tenesta til føderasjonen. Dette er separat frå den globale innstillinga $CFG->auth_saml2_disco_url.';
$string['federation_manage'] = 'Administrer federerte innloggingar';
$string['federation_edit'] = 'Rediger federert innlogging';
$string['federation_remove'] = 'Fjern federert innlogging';
$string['federation_save'] = 'Lagre konfigurasjon';
$string['federation_shortname'] = 'Føderasjon shortname';
$string['federation_shortname_help'] = 'Unikt kort namn utan mellomrom (t.d. HAKA eller eduGAIN). Vert brukt i innloggings-URL-en.';
$string['federation_shortname_invalid'] = 'Shortname kan ikkje innehalde mellomrom eller spesialteikn. Bruk berre bokstavar, tal, punktum, understrekar eller bindestrekar.';
$string['federation_shortname_exists'] = 'Ein føderasjon med dette shortname finst allereie.';
$string['federation_metadataurl'] = 'Føderasjon metadata-URL';
$string['federation_metadataurl_help'] = 'Offentleg URL til metadata-XML for føderasjonen (t.d. https://haka.funet.fi/metadata/haka-metadata-v10.xml). Vert brukt ved etablering av innloggingsøkt etter discovery.';
$string['federation_discourl'] = 'URL til discovery-tenesta til føderasjonen';
$string['federation_discourl_help'] = 'URL til IdP discovery-tenesta til føderasjonen (t.d. https://haka.funet.fi/DS). Brukarar vert omdirigerte hit når dei klikkar på innloggingsknappen til føderasjonen.';
$string['federation_buttonlabel'] = 'Etikett for innloggingsknapp';
$string['federation_buttonlabel_help'] = 'Tekst som vert vist på Moodle-innloggingssida for denne føderasjonen.';
$string['federation_logo'] = 'Logo for innloggingsknapp';
$string['federation_logo_help'] = 'Valfritt bilete for innloggingsknappen. Når sett, vert logoen vist i staden for (eller saman med) etikettteksten.';
$string['federation_info'] = 'Federerte innloggingar er uavhengige av valde IdP-ar. Kvar føderasjon legg til ein innloggingsknapp som brukar si eiga discovery-teneste og metadata. Eksisterande IdP-konfigurasjon vert ikkje endra. Den globale $CFG->auth_saml2_disco_url gjeld framleis når ingen føderasjonsknapp vert brukt.';
$string['federation_none'] = 'Ingen federerte innloggingar konfigurerte enno.';
$string['federation_saved'] = 'Federert innlogging lagra.';
$string['federation_deleted'] = 'Federert innlogging fjerna.';
$string['federation_deleteconfirm'] = 'Er du sikker på at du vil fjerne den federerte innlogginga "{$a}"?';
$string['federation_notfound'] = 'Federert innlogging vart ikkje funnen.';
$string['federation_invalidurl'] = 'Oppgje ein gyldig URL.';
$string['federation_unknown'] = 'Ukjend føderasjon: {$a}';
$string['federation_tenantunavailable'] = 'Den federerte innlogginga "{$a}" er ikkje tilgjengeleg for gjeldande tenant.';
$string['federation_tenantavailability'] = 'Tenant-tilgjengelegheit';
$string['federation_tenantavailabilityfor'] = 'Tenant-tilgjengelegheit for \'{$a}\'';
$string['federation_tenantavailability_success'] = 'Tenant-tilgjengelegheit for føderasjonen vart oppdatert';
$string['federation_tenantmode'] = 'Tilgjengeleg for';
$string['federation_tenantmode_help'] = 'Styrer kva for Moodle Workplace-tenants som kan sjå og bruke innloggingsknappen til denne føderasjonen. Konfigurer frå listesida via handlinga for tenant-tilgjengelegheit. På nettstader utan Workplace-tenancy vert desse innstillingane ignorerte.';
$string['federation_tenantmode_all'] = 'Alle tenants';
$string['federation_tenantmode_include'] = 'Berre følgjande tenants';
$string['federation_tenantmode_exclude'] = 'Alle tenants unnateke følgjande';
$string['federation_tenantmode_include_summary'] = 'Inkluder ({$a})';
$string['federation_tenantmode_exclude_summary'] = 'Ekskluder ({$a})';
$string['federation_tenantids_include'] = 'Inkluderte tenants';
$string['federation_tenantids_exclude'] = 'Ekskluderte tenants';
$string['federation_tenantids_required'] = 'Vel minst éin tenant.';
$string['federation_editnamed'] = 'Rediger federert innlogging: {$a}';
$string['federation_createnew'] = 'Opprett ny federert innlogging';
$string['federation_enabled'] = 'Federert innlogging aktivert.';
$string['federation_disabled'] = 'Federert innlogging deaktivert.';
$string['federation_disabled_error'] = 'Den federerte innlogginga "{$a}" er deaktivert.';
$string['federation_metadatastatus'] = 'Metadata';
$string['federation_metadatastatus_help'] = 'Om metadata-XML for føderasjonen er lasta ned og cachet riktig.';
$string['federation_metadatastatus_ok'] = 'Metadata cachet';
$string['federation_metadatastatus_missing'] = 'Metadata manglar';
$string['eventfederationcreated'] = 'SAML2-føderasjon oppretta';
$string['eventfederationupdated'] = 'SAML2-føderasjon oppdatert';
$string['eventfederationdeleted'] = 'SAML2-føderasjon sletta';
$string['eventfederationtenantavailabilityupdated'] = 'SAML2-føderasjon tenant-tilgjengelegheit oppdatert';
$string['blockredirectheading'] = 'Handlingar ved kontosperring';
$string['cannotmapfield'] = 'Mapping-kollisjon oppdaga - to felt mappar til same karakterelement {$a}';
$string['certificate'] = 'Regenerer sertifikat';
$string['certificate_help'] = 'Regenerer den private nøkkelen og sertifikatet som vert brukt av denne SP. | <a href=\'{$a}\'>Vis SP-sertifikat</a>';
$string['certificatedetails'] = 'Sertifikatdetaljar';
$string['certificatedetailshelp'] = '<h1>Innhald i SAML2 auto-generert offentleg sertifikat</h1><p>Stien til sertifikatet er her:</p>';
$string['certificatelock'] = 'Lås sertifikat';
$string['certificatelock_help'] = 'Låsing av sertifikat hindrar at dei vert overskrivne når dei først er genererte.';
$string['certificatelock_locked'] = 'Sertifikatet er låst';
$string['certificatelock_lockedmessage'] = 'Sertifikata er for augeblikket låste.';
$string['certificatelock_regenerate'] = 'Regenererer ikkje sertifikat fordi dei er låste!';
$string['certificatelock_unlock'] = 'Lås opp sertifikat';
$string['certificatelock_warning'] = 'Åtvaring. Du er i ferd med å låse sertifikata. Er du sikker? <br> Sertifikata er for augeblikket ikkje låste';
$string['keysize'] = 'Nøkkelstorleik';
$string['keysize_help'] = 'Angir bitstorleiken på dei offentlege/private nøklane som vert brukte til å generere og signere sertifikatet.';
$string['checkcertificateexpired'] = 'SAML-sertifikatet gjekk ut for {$a} sidan';
$string['checkcertificateexpiry'] = 'Utløp for SAML-sertifikat';
$string['checkcertificateok'] = 'SAML-sertifikatet går ut om {$a}';
$string['checkcertificatewarn'] = 'SAML-sertifikatet går ut om {$a}';
$string['commonname'] = 'Common Name';
$string['countryname'] = 'Land';
$string['debug'] = 'Feilsøking';
$string['debug_help'] = '<p>Legg til ekstra feilsøking i den vanlege Moodle-loggen | <a href=\'{$a}\'>Vis SSP-konfigurasjon</a></p>';
$string['duallogin'] = 'Dobbel innlogging';
$string['duallogin_help'] = '
<p>Viss på, ser brukarar både manuell og SAML-innloggingsknapp. Viss av, vert dei alltid tekne direkte til IdP-innloggingssida.</p>
<p>Viss passiv, vert brukarar som allereie er autentiserte hos IdP automatisk logga inn, elles vert dei sende til Moodle-innloggingssida.</p>
<p>Viss av, kan administratorar framleis sjå den manuelle innloggingssida via /login/index.php?saml=off</p>
<p>Viss på, kan eksterne sider deep-linke til Moodle med saml, t.d. /course/view.php?id=45&saml=on</p>
<p>Viss sett til test IdP-tilkopling, vert nettverket sjekka for tilkopling, og viss det fungerer, vert SAML-innlogging starta.</p>';
$string['emailtaken'] = 'Kan ikkje opprette ny konto fordi e-postadressa {$a} allereie er registrert';
$string['emailtakenupdate'] = 'E-posten din vart ikkje oppdatert fordi e-postadressa {$a} allereie er registrert';
$string['error'] = 'Innloggingsfeil';
$string['errorinvalidautologin'] = 'Ugyldig auto-innloggingsførespurnad';
$string['errorparsingxml'] = 'Feil ved parsing av XML: {$a}';
$string['exception'] = 'SAML2-unntak: {$a}';
$string['expirydays'] = 'Utløp i dagar';
$string['fielddelimiter'] = 'Feltskiljeteikn';
$string['fielddelimiter_help'] = 'Skiljeteiknet som vert brukt når eit felt tek imot ein array av verdiar frå IdP.';
$string['flaggedresponsetypemessage'] = 'Vis tilpassa melding';
$string['flaggedresponsetyperedirect'] = 'Omdiriger til ekstern URL';
$string['flagmessage'] = 'Svarmelding';
$string['flagmessage_default'] = 'Du er logga inn hos identity provider, men denne kontoen har avgrensa tilgang til Moodle. Kontakt administratoren for meir informasjon.';
$string['flagmessage_help'] = '
<p>Meldinga som vert vist når ein brukar ikkje har tilgang til Moodle basert på konfigurerte grupperestriksjonar.</p>
<p>(Vert berre vist når \'Svartype\' er \'Vis tilpassa melding\'.)</p>';
$string['flagredirecturl'] = 'Omdirigerings-URL';
$string['flagredirecturl_help'] = '
<p>URL som brukaren vert omdirigert til når tilgang til Moodle ikkje er tillate basert på konfigurerte grupperestriksjonar.</p>
<p>(Vert berre brukt når \'Svartype\' er \'Omdiriger til ekstern URL\'.)</p>';
$string['flagresponsetype'] = 'Svartype ved kontosperring';
$string['flagresponsetype_help'] = 'Viss tilgang vert blokkert basert på konfigurerte grupperestriksjonar, korleis skal Moodle svare?';
$string['grouprules'] = 'Grupperegler';
$string['grouprules_help'] = '<p>Ei liste med reglar for å styre tilgang basert på group-attributtverdien.</p>
<p>Kvar linje skal ha éin regel i formatet: {allow or deny} {groups attribute}={value}.</p>
<p>Reglar høgare i lista vert brukte først.</p>
Døme: <br/>
allow admins=yes<br>
deny admins=no<br>
allow examrole=proctor<br>
deny library=overdue<br>';
$string['idpattr'] = 'IdP-mapping';
$string['idpattr_help'] = 'Kva for IdP-attributt skal matchast mot eit Moodle-brukarfelt?';
$string['idpmetadata'] = 'IdP-metadata xml ELLER offentleg xml-URL';
$string['idpmetadata_badurl'] = 'Ugyldig metadata på {$a}';
$string['idpmetadata_help'] = 'For å bruke fleire IdP-ar, skriv inn kvar offentleg metadata-URL på ei ny linje.<br/>For å overstyre eit namn, plasser tekst før http. t.d. "Forced IdP Name http://ssp.local/simplesaml/saml2/idp/metadata.php"';
$string['idpmetadata_invalid'] = 'IdP-XML er ikkje gyldig';
$string['idpmetadata_noentityid'] = 'IdP-XML har ingen entityID';
$string['idpmetadatarefresh'] = 'Oppdatering av IdP-metadata';
$string['idpmetadatarefresh_help'] = 'Køyr ei planlagd oppgåve for å oppdatere IdP-metadata frå IdP-metadata-URL';
$string['idpname'] = 'IdP-etikett overstyring';
$string['idpname_help'] = 't.d. myUNI - vert detektert frå metadata og vist på sida for dobbel innlogging (viss aktivert)';
$string['idpnamedefault'] = 'Logg inn via SAML2';
$string['idpnamedefault_varaible'] = 'Logg inn via SAML2 ({$a})';
$string['localityname'] = 'Lokalitet';
$string['locked'] = 'Låst';
$string['logdir'] = 'Loggkatalog';
$string['logdir_help'] = 'Loggkatalogen SSPHP skriv til; fila heiter simplesamlphp.log';
$string['logdirdefault'] = '/tmp/';
$string['logtofile'] = 'Aktiver logging til fil';
$string['logtofile_help'] = 'Aktivering omdirigerer SSPHP-loggutdata til ei fil i logdir';
$string['manageidpsheading'] = 'Administrer tilgjengelege Identity Providers (IdP-ar)';
$string['mdlattr'] = 'Moodle-mapping';
$string['mdlattr_help'] = 'Kva for Moodle-brukarfelt skal IdP-attributten matchast til?';
$string['metadatafetchfailed'] = 'Henting av metadata mislukkast: {$a}';
$string['metadatafetchfailedstatus'] = 'Henting av metadata mislukkast: Statuskode {$a}';
$string['metadatafetchfailedunknown'] = 'Henting av metadata mislukkast: Ukjend cURL-feil';
$string['moodleidpdescription'] = 'Innstillingar for Moodle som Identity Provider for andre tenester.';
$string['moodleidpenabled'] = 'Aktiver IdP';
$string['moodleidpenabled_error'] = 'Moodle IdP er ikkje aktivert. Sjekk innstillingar.';
$string['moodleidpenabled_help'] = 'Tillat Moodle å fungere som IdP for eksterne tenester.';
$string['moodleidpguest_error'] = 'Gjestbrukarar kan ikkje logge inn via SAML.';
$string['moodleidpheading'] = 'Moodle IdP-innstillingar';
$string['moodleidpmetadata'] = 'IdP-metadata';
$string['moodleidpmetadata_help'] = '<a href=\'{$a}\'>Vis Identity Provider-metadata</a> | <a href=\'{$a}?download=1\'>Last ned IdP-metadata</a>';
$string['moodleidpsplist'] = 'Gyldige issuers';
$string['moodleidpsplist_error'] = 'Ukjend teneste forsøkjer å autentisere: {$a}. Sjekk konfigurasjon.';
$string['moodleidpsplist_help'] = 'Liste over tenester som får bruke denne Moodle som IdP, identifisert via <code>saml:Issuer</code>-taggen i SAML-førespurnaden. Éin per linje. {$a->example}';
$string['multiidp:label:active'] = 'Aktiv';
$string['multiidp:label:admin'] = 'Berre for administratorar';
$string['multiidp:label:admin_help'] = 'Brukarar som loggar inn via denne IdP vert automatisk gjort til nettstadsadministrator';
$string['multiidp:label:alias'] = 'Alias';
$string['multiidp:label:defaultidp'] = 'Standard-IdP';
$string['multiidp:label:displayname'] = 'Visingsnamn';
$string['multiidp:label:whitelist'] = 'Omdirigerte IP-adresser';
$string['multiidp:label:whitelist_help'] = 'Viss sett, vert klientar tvinga til denne IdP. Format: xxx.xxx.xxx.xxx/bitmask. Skil fleire subnet på ny linje.';
$string['multiidpbuttons'] = 'Knappar med ikon';
$string['multiidpdisplay'] = 'Visingstype for fleire IdP-ar';
$string['multiidpdisplay_help'] = 'Viss ein IdP-metadata-xml inneheld fleire IdP-entitetar, korleis skal kvar tilgjengelege IdP visast?';
$string['multiidpdropdown'] = 'Nedtrekksliste';
$string['multiidpinfo'] = '
<ul>
<li>Ein IdP kan berre brukast viss han er sett til Aktiv</li>
<li>Når dobbel innlogging er slått på, vert alle aktive IdP-ar viste på innloggingssida</li>
<li>Når ein IdP er sett som Standard og dobbel innlogging ikkje er slått på, vert denne IdP automatisk brukt med mindre ?multiidp=on eller saml=off vert sende til /login/index.php</li>
<li>Ein IdP kan få eit Alias; via /login/index.php?idpalias={alias} kan aliaset brukast for å gå direkte til den IdP</li>
</ul>';
$string['nameidasattrib'] = 'Eksponer NameID som attributt';
$string['nameidasattrib_help'] = 'NameID-claim vert eksponert for SSPHP som ein attributt kalla nameid';
$string['nameidpolicy'] = 'NameID Policy';
$string['nameidpolicy_help'] = '';
$string['noattribute'] = 'Du har logga inn, men vi fann ikkje \'{$a}\'-attributten din for å knyte deg til ein konto i Moodle.';
$string['noidpfound'] = 'IdP \'{$a}\' vart ikkje funnen som ein konfigurert IdP.';
$string['noredirectips'] = 'Avgrens noredirect etter IP';
$string['noredirectips_help'] = 'Når dobbel innlogging er slått av og IP-ar er sette, vert bruken av ?saml=off og ?noredirect=1 under SAML-innlogging avgrensa til brukarar med matchande IP-subnet.';
$string['nouser'] = 'Du har logga inn som \'{$a}\', men har ikkje ein konto i Moodle.';
$string['nullprivatecert'] = 'Oppretting av privat sertifikat mislukkast.';
$string['nullpubliccert'] = 'Oppretting av offentleg sertifikat mislukkast.';
$string['organizationalunitname'] = 'Organisatorisk eining';
$string['organizationname'] = 'Organisasjon';
$string['passivemode'] = 'Passiv modus';
$string['phone1'] = 'Telefon';
$string['phone2'] = 'Mobiltelefon';
$string['plugindisabled'] = 'SAML2-autentiseringsplugin er deaktivert';
$string['pluginname'] = 'SAML2';
$string['privatekeypass'] = 'Passord for privat sertifikatnøkkel';
$string['privatekeypass_help'] = 'Vert brukt til å signere det lokale Moodle-sertifikatet; endring ugyldiggjer det noverande sertifikatet.';
$string['regenerate_submit'] = 'Regenerer';
$string['regenerateheading'] = 'Regenerer privat nøkkel og sertifikat';
$string['rememberidp'] = 'Hugs innloggingsteneste';
$string['requestedattributes'] = 'Forespurde attributt';
$string['requestedattributes_help'] = 'Nokre IdP-ar krev at SP erklærer kva for attributt som vert forespurde eller er påkravde. Legg til kvar attributt på ei ny linje; dei vil stå i SP-metadata under <code>AttributeConsumingService</code>. Viss eit felt skal vere påkravd, legg til mellomrom og * etter linja. {$a->example}';
$string['required'] = 'Dette feltet er påkravd';
$string['requireint'] = 'Dette feltet er påkravd og må vere eit positivt heiltal';
$string['showidplink'] = 'Vis IdP-lenkje';
$string['showidplink_help'] = 'Viser IdP-lenkja når nettstadet er konfigurert.';
$string['source'] = 'Kjelde: {$a}';
$string['spentityid'] = 'Entity ID';
$string['spentityid_help'] = 'Overstyr Entity ID for Service Provider. I dei fleste tilfelle: la stå tomt for ein god standard.';
$string['spmetadata'] = 'SP-metadata';
$string['spmetadata_help'] = '<a href=\'{$a}\'>Vis Service Provider-metadata</a> | <a href=\'{$a}?download=1\'>Last ned SP-metadata</a>
<p>Du kan måtte gje dette til IdP-administratoren for å whiteliste deg.</p>';
$string['spmetadatasign'] = 'SP-metadata-signatur';
$string['spmetadatasign_help'] = 'Signer SP-metadata.';
$string['sspversion'] = 'SimpleSAMLphp-versjon';
$string['stateorprovincename'] = 'Delstat eller provins';
$string['status'] = 'Status';
$string['suspendeduser'] = 'Du har logga inn som \'{$a}\', men kontoen din er suspendert i Moodle.';
$string['taskmetadatarefresh'] = 'Oppgåve for metadataoppdatering';
$string['tempdir'] = 'SimpleSAMLphp mellombels katalog';
$string['tempdir_help'] = 'Ein katalog der SimpleSAMLphp kan lagre mellombelse filer';
$string['test_auth_button_login'] = 'IdP-innlogging';
$string['test_auth_button_logout'] = 'IdP-utlogging';
$string['test_auth_str'] = 'Test isAuthenticated og innlogging';
$string['test_endpoint'] = 'URL for tilkoplingstest';
$string['test_endpoint_desc'] = 'Oppgje ein URL for å teste tilkopling for IdP-omdirigering frå klientnettlesaren. Nokre brukarar eller nettverk har kanskje ikkje tilkopling til IdP pga. konto- eller nettverksløyve.';
$string['test_idp_conn'] = 'Test IdP-tilkopling';
$string['test_noticetestrequirements'] = 'For å bruke denne testen må plugin vere konfigurert, aktivert, og feilsøking må vere aktivert i plugin-innstillingar.';
$string['test_passive_str'] = 'Test med isPassive';
$string['testdebuggingdisabled'] = 'For å bruke denne testsida må SAML-feilsøking vere på';
$string['tolower'] = 'Store/små bokstavar ved matching';
$string['tolower:caseandaccentinsensitive'] = 'Uavhengig av store/små bokstavar og aksentar';
$string['tolower:caseinsensitive'] = 'Uavhengig av store/små bokstavar';
$string['tolower:exact'] = 'Eksakt';
$string['tolower:lowercase'] = 'Små bokstavar';
$string['tolower_help'] = '
<p>Eksakt: matching er skiftkjensleg (standard).</p>
<p>Små bokstavar: brukar små bokstavar på IdP-attributten før matching.</p>
<p>Uavhengig av store/små bokstavar: ignorer skift ved matching.</p>';
$string['unlocked'] = 'Ulåst';
$string['unlockedifempty'] = 'Ulåst viss tom';
$string['update_never'] = 'Aldri';
$string['update_oncreate'] = 'Ved oppretting';
$string['update_onlogin'] = 'Ved kvar innlogging';
$string['update_onupdate'] = 'Ved oppdatering';
$string['wantassertionssigned'] = 'Krev signerte assertions';
$string['wantassertionssigned_help'] = 'Om assertions mottekne av denne SP må vere signerte';
$string['wrongauth'] = 'Du har logga inn som \'{$a}\', men er ikkje autorisert til å få tilgang til Moodle.';
/*
 * Privacy provider (GDPR)
 */
$string["privacy:no_data_reason"] = "SAML2-autentiseringspluginet lagrar ingen personopplysningar.";

/*
 * Signing Algorithm
 */
$string['sha1'] = 'Eldre SHA1 (farleg)';
$string['sha256'] = 'SHA256';
$string['sha384'] = 'SHA384';
$string['sha512'] = 'SHA512';
$string['signaturealgorithm'] = 'Signeringsalgoritme';
$string['signaturealgorithm_help'] = 'Algoritmen som vert brukt til å signere SAML-førespurnader. Åtvaring: SHA1 vert berre levert for bakoverkompatibilitet; med mindre du absolutt må bruke han, anbefalast minst SHA256.';
$string['selectloginservice'] = 'Vel ei innloggingsteneste';
$string['regenerateheader'] = 'Regenerer privat nøkkel og sertifikat';
$string['regeneratewarning'] = 'Åtvaring! Generering av eit nytt sertifikat overskriv det noverande, og du kan måtte oppdatere IdP-en din';
$string['regeneratepath'] = 'Sertifikatsti: {$a}';
$string['regenerateheader'] = 'Regenerer privat nøkkel og sertifikat';
$string['regeneratesuccess'] = 'Privat nøkkel og sertifikat er regenererte';
