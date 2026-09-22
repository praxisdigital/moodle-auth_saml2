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

$string['allowcreate'] = 'Tillåt skapande';
$string['allowcreate_help'] = 'Tillåt skapande av IdP-användare vid behov';
$string['alterlogout'] = 'Alternativ utloggnings-URL';
$string['alterlogout_help'] = 'URL att omdirigera användaren till efter att alla interna utloggningsmekanismer har körts';
$string['anyauth'] = 'Tillåt alla autentiseringstyper';
$string['anyauth_help'] = 'Ja: Tillåt SAML-inloggning för alla användare? Nej: Endast användare med saml2 som typ.';
$string['anyauthotherdisabled'] = 'Du har loggat in som \'{$a->username}\' men din autentiseringstyp \'{$a->auth}\' är inaktiverad.';
$string['assertionsconsumerservices'] = 'Assertions-konsumenttjänster';
$string['assertionsconsumerservices_help'] = 'Lista över bindings som SP ska stödja';
$string['attemptsignout'] = 'Försök IdP-utloggning';
$string['attemptsignout_help'] = 'Detta försöker kommunicera med IdP för att skicka en utloggningsbegäran';
$string['attrsimple'] = 'Förenkla attribut';
$string['attrsimple_help'] = 'Olika IdP:er såsom ADFS använder långa attributnycklar som urns eller namespaced xml-schemanamn. Om Ja förenklas dessa, t.ex. mappa http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname till \'givenname\'.';
$string['auth_data_mapping'] = 'Datamappning';
$string['auth_fieldlock_expl'] = '<p><b>Lås värde:</b> Om aktiverat förhindras Moodle-användare och administratörer från att redigera fältet direkt. Använd detta om du underhåller data i det externa autentiseringssystemet.</p>';
$string['auth_fieldlockfield'] = 'Lås värde ({$a})';
$string['auth_fieldlocks'] = 'Lås användarfält';
$string['auth_fieldmapping'] = 'Datamappning ({$a})';
$string['auth_saml2blockredirectdescription'] = 'Omdirigera eller visa meddelande till SAML2-inloggningar baserat på konfigurerade grupprestriktioner';
$string['auth_saml2description'] = 'Autentisera med en SAML2 Identity Provider (IdP)';
$string['auth_updatelocalfield'] = 'Uppdatera lokalt ({$a})';
$string['auth_updateremotefield'] = 'Uppdatera externt ({$a})';
$string['authncontext'] = 'AuthnContext';
$string['authncontext_help'] = 'Tillåter utökning av assertions. Lämna tomt om det inte krävs';
$string['autocreate'] = 'Skapa användare automatiskt';
$string['autocreate_help'] = 'Tillåt skapande av Moodle-användare vid behov';
$string['autologin'] = 'Auto-inloggning';
$string['autologin_help'] = 'På sidor som tillåter gäståtkomst utan inloggning, logga in användare automatiskt i Moodle med ett riktigt användarkonto om de är inloggade hos IdP (via passiv autentisering).';
$string['autologinbycookie'] = 'Kontrollera när den angivna cookien finns eller ändras';
$string['autologinbysession'] = 'Kontrollera en gång per session';
$string['autologincookie'] = 'Cookie för auto-inloggning';
$string['autologincookie_help'] = 'Namn på cookie som används för att avgöra när auto-inloggning ska försökas (endast relevant om cookie-alternativet valts ovan).';
$string['availableidps'] = 'Välj tillgängliga IdP:er';
$string['availableidps_help'] = 'Om en IdP-metadata-xml innehåller flera IdP-entiteter måste du välja vilka entiteter som är tillgängliga för inloggning.
';
$string['federation_add'] = 'Lägg till federerad inloggning';
$string['federation_add_help'] = 'Konfigurera en eller flera federationer (t.ex. HAKA, eduGAIN). Varje federation får en egen inloggningsknapp som skickar användaren till federationens discovery-tjänst. Detta är separat från den globala inställningen $CFG->auth_saml2_disco_url.';
$string['federation_manage'] = 'Hantera federerade inloggningar';
$string['federation_edit'] = 'Redigera federerad inloggning';
$string['federation_remove'] = 'Ta bort federerad inloggning';
$string['federation_save'] = 'Spara konfiguration';
$string['federation_shortname'] = 'Federationens shortname';
$string['federation_shortname_help'] = 'Unikt kort namn utan mellanslag (t.ex. HAKA eller eduGAIN). Används i inloggnings-URL:en.';
$string['federation_shortname_invalid'] = 'Shortname får inte innehålla mellanslag eller specialtecken. Använd endast bokstäver, siffror, punkter, understreck eller bindestreck.';
$string['federation_shortname_exists'] = 'En federation med detta shortname finns redan.';
$string['federation_metadataurl'] = 'Federation metadata-URL';
$string['federation_metadataurl_help'] = 'Offentlig URL till federationens metadata-XML (t.ex. https://haka.funet.fi/metadata/haka-metadata-v10.xml). Används när inloggningssessionen etableras efter discovery.';
$string['federation_discourl'] = 'URL till federationens discovery-tjänst';
$string['federation_discourl_help'] = 'URL till federationens IdP discovery-tjänst (t.ex. https://haka.funet.fi/DS). Användare omdirigeras hit när de klickar på federationens inloggningsknapp.';
$string['federation_buttonlabel'] = 'Etikett för inloggningsknapp';
$string['federation_buttonlabel_help'] = 'Text som visas på Moodles inloggningssida för denna federation.';
$string['federation_logo'] = 'Logotyp för inloggningsknapp';
$string['federation_logo_help'] = 'Valfri bild för inloggningsknappen. När den är angiven visas logotypen istället för (eller tillsammans med) etiketttexten.';
$string['federation_info'] = 'Federerade inloggningar är oberoende av valda IdP:er. Varje federation lägger till en inloggningsknapp som använder sin egen discovery-tjänst och metadata. Befintlig IdP-konfiguration ändras inte. Den globala $CFG->auth_saml2_disco_url gäller fortfarande när ingen federationsknapp används.';
$string['federation_none'] = 'Inga federerade inloggningar konfigurerade ännu.';
$string['federation_saved'] = 'Federerad inloggning sparad.';
$string['federation_deleted'] = 'Federerad inloggning borttagen.';
$string['federation_deleteconfirm'] = 'Är du säker på att du vill ta bort den federerade inloggningen "{$a}"?';
$string['federation_notfound'] = 'Federerad inloggning hittades inte.';
$string['federation_invalidurl'] = 'Ange en giltig URL.';
$string['federation_unknown'] = 'Okänd federation: {$a}';
$string['federation_tenantunavailable'] = 'Den federerade inloggningen "{$a}" är inte tillgänglig för aktuell tenant.';
$string['federation_tenantavailability'] = 'Tenanttillgänglighet';
$string['federation_tenantavailabilityfor'] = 'Tenanttillgänglighet för \'{$a}\'';
$string['federation_tenantavailability_success'] = 'Federationens tenanttillgänglighet uppdaterades';
$string['federation_tenantmode'] = 'Tillgänglig för';
$string['federation_tenantmode_help'] = 'Styr vilka Moodle Workplace-tenanter som kan se och använda denna federations inloggningsknapp. Konfigurera från listan via åtgärden för tenanttillgänglighet. På sajter utan Workplace-tenancy ignoreras dessa inställningar.';
$string['federation_tenantmode_all'] = 'Alla tenanter';
$string['federation_tenantmode_include'] = 'Endast följande tenanter';
$string['federation_tenantmode_exclude'] = 'Alla tenanter utom följande';
$string['federation_tenantmode_include_summary'] = 'Inkludera ({$a})';
$string['federation_tenantmode_exclude_summary'] = 'Exkludera ({$a})';
$string['federation_tenantids_include'] = 'Inkluderade tenanter';
$string['federation_tenantids_exclude'] = 'Exkluderade tenanter';
$string['federation_tenantids_required'] = 'Välj minst en tenant.';
$string['federation_editnamed'] = 'Redigera federerad inloggning: {$a}';
$string['federation_createnew'] = 'Skapa ny federerad inloggning';
$string['federation_enabled'] = 'Federerad inloggning aktiverad.';
$string['federation_disabled'] = 'Federerad inloggning inaktiverad.';
$string['federation_disabled_error'] = 'Den federerade inloggningen "{$a}" är inaktiverad.';
$string['federation_metadatastatus'] = 'Metadata';
$string['federation_metadatastatus_help'] = 'Om federationens metadata-XML har laddats ner och cachats korrekt.';
$string['federation_metadatastatus_ok'] = 'Metadata cachad';
$string['federation_metadatastatus_missing'] = 'Metadata saknas';
$string['eventfederationcreated'] = 'SAML2-federation skapad';
$string['eventfederationupdated'] = 'SAML2-federation uppdaterad';
$string['eventfederationdeleted'] = 'SAML2-federation borttagen';
$string['eventfederationtenantavailabilityupdated'] = 'SAML2-federationens tenanttillgänglighet uppdaterad';
$string['blockredirectheading'] = 'Åtgärder vid kontospärr';
$string['cannotmapfield'] = 'Mappningskollision upptäckt - två fält mappar till samma betygsobjekt {$a}';
$string['certificate'] = 'Återgenerera certifikat';
$string['certificate_help'] = 'Återgenerera den privata nyckeln och certifikatet som används av denna SP. | <a href=\'{$a}\'>Visa SP-certifikat</a>';
$string['certificatedetails'] = 'Certifikatdetaljer';
$string['certificatedetailshelp'] = '<h1>Innehåll i SAML2 auto-genererat offentligt certifikat</h1><p>Sökvägen till certifikatet är här:</p>';
$string['certificatelock'] = 'Lås certifikat';
$string['certificatelock_help'] = 'Låsning av certifikat förhindrar att de skrivs över när de väl genererats.';
$string['certificatelock_locked'] = 'Certifikatet är låst';
$string['certificatelock_lockedmessage'] = 'Certifikaten är för närvarande låsta.';
$string['certificatelock_regenerate'] = 'Återgenererar inte certifikat eftersom de är låsta!';
$string['certificatelock_unlock'] = 'Lås upp certifikat';
$string['certificatelock_warning'] = 'Varning. Du håller på att låsa certifikaten. Är du säker? <br> Certifikaten är för närvarande inte låsta';
$string['keysize'] = 'Nyckelstorlek';
$string['keysize_help'] = 'Anger bitstorleken för de publika/privata nycklar som används för att generera och signera certifikatet.';
$string['checkcertificateexpired'] = 'SAML-certifikatet gick ut för {$a} sedan';
$string['checkcertificateexpiry'] = 'SAML-certifikatets utgång';
$string['checkcertificateok'] = 'SAML-certifikatet går ut om {$a}';
$string['checkcertificatewarn'] = 'SAML-certifikatet går ut om {$a}';
$string['commonname'] = 'Common Name';
$string['countryname'] = 'Land';
$string['debug'] = 'Felsökning';
$string['debug_help'] = '<p>Lägger till extra felsökning i den vanliga Moodle-loggen | <a href=\'{$a}\'>Visa SSP-konfiguration</a></p>';
$string['duallogin'] = 'Dubbel inloggning';
$string['duallogin_help'] = '
<p>Om på ser användare både manuell och SAML-inloggningsknapp. Om av tas de alltid direkt till IdP-inloggningssidan.</p>
<p>Om passiv loggas användare som redan är autentiserade hos IdP in automatiskt, annars skickas de till Moodles inloggningssida.</p>
<p>Om av kan administratörer fortfarande se den manuella inloggningssidan via /login/index.php?saml=off</p>
<p>Om på kan externa sidor deep-länka till Moodle med saml, t.ex. /course/view.php?id=45&saml=on</p>
<p>Om satt till testa IdP-anslutning kontrolleras nätverket, och om det fungerar startas SAML-inloggning.</p>';
$string['emailtaken'] = 'Kan inte skapa nytt konto eftersom e-postadressen {$a} redan är registrerad';
$string['emailtakenupdate'] = 'Din e-post uppdaterades inte eftersom e-postadressen {$a} redan är registrerad';
$string['error'] = 'Inloggningsfel';
$string['errorinvalidautologin'] = 'Ogiltig begäran om auto-inloggning';
$string['errorparsingxml'] = 'Fel vid tolkning av XML: {$a}';
$string['exception'] = 'SAML2-undantag: {$a}';
$string['expirydays'] = 'Giltighet i dagar';
$string['fielddelimiter'] = 'Fältavgränsare';
$string['fielddelimiter_help'] = 'Avgränsare som används när ett fält tar emot en array av värden från IdP.';
$string['flaggedresponsetypemessage'] = 'Visa anpassat meddelande';
$string['flaggedresponsetyperedirect'] = 'Omdirigera till extern URL';
$string['flagmessage'] = 'Svarsmeddelande';
$string['flagmessage_default'] = 'Du är inloggad hos din identity provider men detta konto har begränsad åtkomst till Moodle. Kontakta din administratör för mer information.';
$string['flagmessage_help'] = '
<p>Meddelandet som visas när en användare inte får åtkomst till Moodle baserat på konfigurerade grupprestriktioner.</p>
<p>(Visas endast när \'Svarstyp\' är \'Visa anpassat meddelande\'.)</p>';
$string['flagredirecturl'] = 'Omdirigerings-URL';
$string['flagredirecturl_help'] = '
<p>URL att omdirigera användaren till när åtkomst till Moodle inte tillåts baserat på konfigurerade grupprestriktioner.</p>
<p>(Används endast när \'Svarstyp\' är \'Omdirigera till extern URL\'.)</p>';
$string['flagresponsetype'] = 'Svarstyp vid kontospärr';
$string['flagresponsetype_help'] = 'Om åtkomst blockeras baserat på konfigurerade grupprestriktioner, hur ska Moodle svara?';
$string['grouprules'] = 'Gruppregler';
$string['grouprules_help'] = '<p>En lista med regler för att styra åtkomst baserat på group-attributvärdet.</p>
<p>Varje rad ska ha en regel i formatet: {allow or deny} {groups attribute}={value}.</p>
<p>Regler högre upp i listan tillämpas först.</p>
Exempel: <br/>
allow admins=yes<br>
deny admins=no<br>
allow examrole=proctor<br>
deny library=overdue<br>';
$string['idpattr'] = 'Mappning IdP';
$string['idpattr_help'] = 'Vilket IdP-attribut ska matchas mot ett Moodle-användarfält?';
$string['idpmetadata'] = 'IdP-metadata xml ELLER offentlig xml-URL';
$string['idpmetadata_badurl'] = 'Ogiltig metadata på {$a}';
$string['idpmetadata_help'] = 'För att använda flera IdP:er anger du varje offentlig metadata-URL på en ny rad.<br/>För att åsidosätta ett namn, placera text före http. t.ex. "Forced IdP Name http://ssp.local/simplesaml/saml2/idp/metadata.php"';
$string['idpmetadata_invalid'] = 'IdP-XML är inte giltig';
$string['idpmetadata_noentityid'] = 'IdP-XML saknar entityID';
$string['idpmetadatarefresh'] = 'Uppdatering av IdP-metadata';
$string['idpmetadatarefresh_help'] = 'Kör en schemalagd uppgift för att uppdatera IdP-metadata från IdP-metadata-URL';
$string['idpname'] = 'Åsidosätt IdP-etikett';
$string['idpname_help'] = 't.ex. myUNI - detekteras från metadata och visas på sidan för dubbel inloggning (om aktiverat)';
$string['idpnamedefault'] = 'Logga in via SAML2';
$string['idpnamedefault_varaible'] = 'Logga in via SAML2 ({$a})';
$string['localityname'] = 'Ort';
$string['locked'] = 'Låst';
$string['logdir'] = 'Loggkatalog';
$string['logdir_help'] = 'Loggkatalogen som SSPHP skriver till; filen heter simplesamlphp.log';
$string['logdirdefault'] = '/tmp/';
$string['logtofile'] = 'Aktivera loggning till fil';
$string['logtofile_help'] = 'Aktivering omdirigerar SSPHP-loggutdata till en fil i logdir';
$string['manageidpsheading'] = 'Hantera tillgängliga Identity Providers (IdP:er)';
$string['mdlattr'] = 'Mappning Moodle';
$string['mdlattr_help'] = 'Vilket Moodle-användarfält ska IdP-attributet matchas mot?';
$string['metadatafetchfailed'] = 'Hämtning av metadata misslyckades: {$a}';
$string['metadatafetchfailedstatus'] = 'Hämtning av metadata misslyckades: Statuskod {$a}';
$string['metadatafetchfailedunknown'] = 'Hämtning av metadata misslyckades: Okänt cURL-fel';
$string['moodleidpdescription'] = 'Inställningar för Moodle som Identity Provider för andra tjänster.';
$string['moodleidpenabled'] = 'Aktivera IdP';
$string['moodleidpenabled_error'] = 'Moodle IdP är inte aktiverad. Kontrollera inställningarna.';
$string['moodleidpenabled_help'] = 'Tillåt Moodle att fungera som IdP för externa tjänster.';
$string['moodleidpguest_error'] = 'Gästanvändare kan inte logga in via SAML.';
$string['moodleidpheading'] = 'Moodle IdP-inställningar';
$string['moodleidpmetadata'] = 'IdP-metadata';
$string['moodleidpmetadata_help'] = '<a href=\'{$a}\'>Visa Identity Provider-metadata</a> | <a href=\'{$a}?download=1\'>Ladda ner IdP-metadata</a>';
$string['moodleidpsplist'] = 'Giltiga issuers';
$string['moodleidpsplist_error'] = 'Okänd tjänst försöker autentisera: {$a}. Kontrollera konfigurationen.';
$string['moodleidpsplist_help'] = 'Lista över tjänster som får använda denna Moodle som IdP, identifierade via <code>saml:Issuer</code>-taggen i SAML-begäran. En per rad. {$a->example}';
$string['multiidp:label:active'] = 'Aktiv';
$string['multiidp:label:admin'] = 'Endast för administratörer';
$string['multiidp:label:admin_help'] = 'Användare som loggar in via denna IdP görs automatiskt till webbplatsadministratör';
$string['multiidp:label:alias'] = 'Alias';
$string['multiidp:label:defaultidp'] = 'Standard-IdP';
$string['multiidp:label:displayname'] = 'Visningsnamn';
$string['multiidp:label:whitelist'] = 'Omdirigerade IP-adresser';
$string['multiidp:label:whitelist_help'] = 'Om angivet tvingas klienter till denna IdP. Format: xxx.xxx.xxx.xxx/bitmask. Separera flera subnet på ny rad.';
$string['multiidpbuttons'] = 'Knappar med ikoner';
$string['multiidpdisplay'] = 'Visningstyp för flera IdP:er';
$string['multiidpdisplay_help'] = 'Om en IdP-metadata-xml innehåller flera IdP-entiteter, hur ska varje tillgänglig IdP visas?';
$string['multiidpdropdown'] = 'Rullgardinslista';
$string['multiidpinfo'] = '
<ul>
<li>En IdP kan endast användas om den är satt till Aktiv</li>
<li>När dubbel inloggning är på visas alla aktiva IdP:er på inloggningssidan</li>
<li>När en IdP är satt som Standard och dubbel inloggning inte är på används denna IdP automatiskt om inte ?multiidp=on eller saml=off skickas till /login/index.php</li>
<li>En IdP kan ges ett Alias; via /login/index.php?idpalias={alias} kan aliaset användas för att gå direkt till den IdP</li>
</ul>';
$string['nameidasattrib'] = 'Exponera NameID som attribut';
$string['nameidasattrib_help'] = 'NameID-claim exponeras för SSPHP som ett attribut med namnet nameid';
$string['nameidpolicy'] = 'NameID Policy';
$string['nameidpolicy_help'] = '';
$string['noattribute'] = 'Du har loggat in men vi kunde inte hitta ditt \'{$a}\'-attribut för att koppla dig till ett konto i Moodle.';
$string['noidpfound'] = 'IdP \'{$a}\' hittades inte som en konfigurerad IdP.';
$string['noredirectips'] = 'Begränsa noredirect efter IP';
$string['noredirectips_help'] = 'När dubbel inloggning är av och IP:er är angivna begränsas användningen av ?saml=off och ?noredirect=1 under SAML-inloggning till användare med matchande IP-subnet.';
$string['nouser'] = 'Du har loggat in som \'{$a}\' men har inget konto i Moodle.';
$string['nullprivatecert'] = 'Skapande av privat certifikat misslyckades.';
$string['nullpubliccert'] = 'Skapande av offentligt certifikat misslyckades.';
$string['organizationalunitname'] = 'Organisatorisk enhet';
$string['organizationname'] = 'Organisation';
$string['passivemode'] = 'Passivt läge';
$string['phone1'] = 'Telefon';
$string['phone2'] = 'Mobiltelefon';
$string['plugindisabled'] = 'SAML2-autentiseringspluginet är inaktiverat';
$string['pluginname'] = 'SAML2';
$string['privatekeypass'] = 'Lösenord för privat certifikatnyckel';
$string['privatekeypass_help'] = 'Används för att signera det lokala Moodle-certifikatet; ändring ogiltigförklarar det nuvarande certifikatet.';
$string['regenerate_submit'] = 'Återgenerera';
$string['regenerateheading'] = 'Återgenerera privat nyckel och certifikat';
$string['rememberidp'] = 'Kom ihåg inloggningstjänst';
$string['requestedattributes'] = 'Begärda attribut';
$string['requestedattributes_help'] = 'Vissa IdP:er kräver att SP deklarerar vilka attribut som begärs eller krävs. Lägg till varje attribut på en ny rad; de visas i SP-metadata under <code>AttributeConsumingService</code>. Om ett fält ska vara obligatoriskt, lägg till mellanslag och * efter raden. {$a->example}';
$string['required'] = 'Detta fält är obligatoriskt';
$string['requireint'] = 'Detta fält är obligatoriskt och måste vara ett positivt heltal';
$string['showidplink'] = 'Visa IdP-länk';
$string['showidplink_help'] = 'Visar IdP-länken när sajten är konfigurerad.';
$string['source'] = 'Källa: {$a}';
$string['spentityid'] = 'Entity ID';
$string['spentityid_help'] = 'Åsidosätt Entity ID för Service Provider. I de flesta fall: lämna tomt för en bra standard.';
$string['spmetadata'] = 'SP-metadata';
$string['spmetadata_help'] = '<a href=\'{$a}\'>Visa Service Provider-metadata</a> | <a href=\'{$a}?download=1\'>Ladda ner SP-metadata</a>
<p>Du kan behöva ge detta till IdP-administratören för att whitelista dig.</p>';
$string['spmetadatasign'] = 'SP-metadatasignatur';
$string['spmetadatasign_help'] = 'Signera SP-metadata.';
$string['sspversion'] = 'SimpleSAMLphp-version';
$string['stateorprovincename'] = 'Delstat eller provins';
$string['status'] = 'Status';
$string['suspendeduser'] = 'Du har loggat in som \'{$a}\' men ditt konto är avstängt i Moodle.';
$string['taskmetadatarefresh'] = 'Uppgift för metadatauppdatering';
$string['tempdir'] = 'SimpleSAMLphp tillfällig katalog';
$string['tempdir_help'] = 'En katalog där SimpleSAMLphp kan spara tillfälliga filer';
$string['test_auth_button_login'] = 'IdP-inloggning';
$string['test_auth_button_logout'] = 'IdP-utloggning';
$string['test_auth_str'] = 'Testa isAuthenticated och inloggning';
$string['test_endpoint'] = 'URL för anslutningstest';
$string['test_endpoint_desc'] = 'Ange en URL för att testa anslutning för IdP-omdirigering från klientwebbläsaren. Vissa användare eller nätverk kan sakna anslutning till IdP p.g.a. konto- eller nätverksbehörigheter.';
$string['test_idp_conn'] = 'Testa IdP-anslutning';
$string['test_noticetestrequirements'] = 'För att använda detta test måste pluginet vara konfigurerat, aktiverat och felsökning aktiverad i plugininställningarna.';
$string['test_passive_str'] = 'Testa med isPassive';
$string['testdebuggingdisabled'] = 'För att använda denna testsida måste SAML-felsökning vara på';
$string['tolower'] = 'Skiftläge vid matchning';
$string['tolower:caseandaccentinsensitive'] = 'Oberoende av skiftläge och accenter';
$string['tolower:caseinsensitive'] = 'Oberoende av skiftläge';
$string['tolower:exact'] = 'Exakt';
$string['tolower:lowercase'] = 'Gemener';
$string['tolower_help'] = '
<p>Exakt: matchning är skiftlägeskänslig (standard).</p>
<p>Gemener: tillämpar gemener på IdP-attributet före matchning.</p>
<p>Oberoende av skiftläge: ignorera skiftläge vid matchning.</p>';
$string['unlocked'] = 'Olåst';
$string['unlockedifempty'] = 'Olåst om tomt';
$string['update_never'] = 'Aldrig';
$string['update_oncreate'] = 'Vid skapande';
$string['update_onlogin'] = 'Vid varje inloggning';
$string['update_onupdate'] = 'Vid uppdatering';
$string['wantassertionssigned'] = 'Kräv signerade assertions';
$string['wantassertionssigned_help'] = 'Om assertions som tas emot av denna SP måste vara signerade';
$string['wrongauth'] = 'Du har loggat in som \'{$a}\' men är inte behörig att komma åt Moodle.';
/*
 * Privacy provider (GDPR)
 */
$string["privacy:no_data_reason"] = "SAML2-autentiseringspluginet lagrar inga personuppgifter.";

/*
 * Signing Algorithm
 */
$string['sha1'] = 'Äldre SHA1 (farligt)';
$string['sha256'] = 'SHA256';
$string['sha384'] = 'SHA384';
$string['sha512'] = 'SHA512';
$string['signaturealgorithm'] = 'Signeringsalgoritm';
$string['signaturealgorithm_help'] = 'Algoritmen som används för att signera SAML-begäranden. Varning: SHA1 tillhandahålls endast för bakåtkompatibilitet; om du inte absolut måste använda den rekommenderas minst SHA256.';
$string['selectloginservice'] = 'Välj en inloggningstjänst';
$string['regenerateheader'] = 'Återgenerera privat nyckel och certifikat';
$string['regeneratewarning'] = 'Varning! Generering av ett nytt certifikat skriver över det nuvarande och du kan behöva uppdatera din IdP';
$string['regeneratepath'] = 'Certifikatsökväg: {$a}';
$string['regenerateheader'] = 'Återgenerera privat nyckel och certifikat';
$string['regeneratesuccess'] = 'Privat nyckel och certifikat har återgenererats';
