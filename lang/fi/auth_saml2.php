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

$string['allowcreate'] = 'Salli luonti';
$string['allowcreate_help'] = 'Salli IdP-käyttäjien luonti tarvittaessa';
$string['alterlogout'] = 'Vaihtoehtoinen uloskirjautumis-URL';
$string['alterlogout_help'] = 'URL, johon käyttäjä ohjataan kaikkien sisäisten uloskirjautumismekanismien jälkeen';
$string['anyauth'] = 'Salli kaikki autentikointityypit';
$string['anyauth_help'] = 'Kyllä: Salli SAML-kirjautuminen kaikille käyttäjille? Ei: Vain käyttäjät, joiden tyyppi on saml2.';
$string['anyauthotherdisabled'] = 'Olet kirjautunut sisään tunnuksella \'{$a->username}\', mutta autentikointityyppisi \'{$a->auth}\' on pois käytöstä.';
$string['assertionsconsumerservices'] = 'Assertions-kuluttajapalvelut';
$string['assertionsconsumerservices_help'] = 'Luettelo SP:n tukemista bindingeista';
$string['attemptsignout'] = 'Yritä IdP-uloskirjautumista';
$string['attemptsignout_help'] = 'Yrittää kommunikoida IdP:n kanssa uloskirjautumispyynnön lähettämiseksi';
$string['attrsimple'] = 'Yksinkertaista attribuutit';
$string['attrsimple_help'] = 'Eri IdP:t kuten ADFS käyttävät pitkiä attribuuttiavaimia, kuten urn-tunnuksia tai namespaced xml-skeemanimiä. Jos arvo on Kyllä, nämä yksinkertaistetaan, esim. mapataan http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname arvoon \'givenname\'.';
$string['auth_data_mapping'] = 'Tiedon kartoitus';
$string['auth_fieldlock_expl'] = '<p><b>Lukitse arvo:</b> Jos käytössä, estää Moodle-käyttäjiä ja ylläpitäjiä muokkaamasta kenttää suoraan. Käytä tätä, jos ylläpidät tietoja ulkoisessa autentikointijärjestelmässä.</p>';
$string['auth_fieldlockfield'] = 'Lukitse arvo ({$a})';
$string['auth_fieldlocks'] = 'Lukitse käyttäjäkentät';
$string['auth_fieldmapping'] = 'Tiedon kartoitus ({$a})';
$string['auth_saml2blockredirectdescription'] = 'Ohjaa uudelleen tai näytä viesti SAML2-kirjautumisille määritettyjen ryhmärajoitusten perusteella';
$string['auth_saml2description'] = 'Autentikoi SAML2 Identity Providerilla (IdP)';
$string['auth_updatelocalfield'] = 'Päivitä paikallinen ({$a})';
$string['auth_updateremotefield'] = 'Päivitä ulkoinen ({$a})';
$string['authncontext'] = 'AuthnContext';
$string['authncontext_help'] = 'Mahdollistaa assertionien laajentamisen. Jätä tyhjäksi, ellei tarvita';
$string['autocreate'] = 'Luo käyttäjät automaattisesti';
$string['autocreate_help'] = 'Salli Moodle-käyttäjien luonti tarvittaessa';
$string['autologin'] = 'Automaattinen kirjautuminen';
$string['autologin_help'] = 'Sivuilla, jotka sallivat vieraskäytön ilman kirjautumista, kirjaa käyttäjät automaattisesti Moodleen oikealla käyttäjätilillä, jos he ovat kirjautuneena IdP:hen (passiivinen autentikointi).';
$string['autologinbycookie'] = 'Tarkista, kun määritetty eväste on olemassa tai muuttuu';
$string['autologinbysession'] = 'Tarkista kerran istuntoa kohden';
$string['autologincookie'] = 'Automaattisen kirjautumisen eväste';
$string['autologincookie_help'] = 'Evästeen nimi, jolla päätetään milloin yrittää automaattista kirjautumista (relevantti vain jos cookie-vaihtoehto on valittu yllä).';
$string['availableidps'] = 'Valitse käytettävissä olevat IdP:t';
$string['availableidps_help'] = 'Jos IdP-metadata-xml sisältää useita IdP-entiteettejä, sinun on valittava mitkä entiteetit ovat käytettävissä kirjautumiseen.
';
$string['federation_add'] = 'Lisää federoitu kirjautuminen';
$string['federation_add_help'] = 'Määritä yksi tai useampi federaatio (esim. HAKA, eduGAIN). Jokainen federaatio saa oman kirjautumispainikkeen, joka lähettää käyttäjän federaation discovery-palveluun. Tämä on erillinen globaalista asetuksesta $CFG->auth_saml2_disco_url.';
$string['federation_manage'] = 'Hallitse federoituja kirjautumisia';
$string['federation_edit'] = 'Muokkaa federoitua kirjautumista';
$string['federation_remove'] = 'Poista federoitu kirjautuminen';
$string['federation_save'] = 'Tallenna kokoonpano';
$string['federation_shortname'] = 'Federaation shortname';
$string['federation_shortname_help'] = 'Yksilöllinen lyhyt nimi ilman välilyöntejä (esim. HAKA tai eduGAIN). Käytetään kirjautumis-URL:ssa.';
$string['federation_shortname_invalid'] = 'Shortname ei saa sisältää välilyöntejä tai erikoismerkkejä. Käytä vain kirjaimia, numeroita, pisteitä, alaviivoja tai väliviivoja.';
$string['federation_shortname_exists'] = 'Federaatio tällä shortname-arvolla on jo olemassa.';
$string['federation_metadataurl'] = 'Federaation metadata-URL';
$string['federation_metadataurl_help'] = 'Federaation metadata-XML:n julkinen URL (esim. https://haka.funet.fi/metadata/haka-metadata-v10.xml). Käytetään kirjautumisistunnon muodostamisessa discoveryn jälkeen.';
$string['federation_discourl'] = 'Federaation discovery-palvelun URL';
$string['federation_discourl_help'] = 'Federaation IdP discovery-palvelun URL (esim. https://haka.funet.fi/DS). Käyttäjät ohjataan tänne, kun he napsauttavat federaation kirjautumispainiketta.';
$string['federation_buttonlabel'] = 'Kirjautumispainikkeen teksti';
$string['federation_buttonlabel_help'] = 'Teksti, joka näytetään Moodlen kirjautumissivulla tälle federaatiolle.';
$string['federation_logo'] = 'Kirjautumispainikkeen logo';
$string['federation_logo_help'] = 'Valinnainen kuva kirjautumispainikkeelle. Käytetään, kun painikkeen näyttö sisältää logon.';
$string['federation_buttondisplay'] = 'Kirjautumispainikkeen näyttö';
$string['federation_buttondisplay_help'] = 'Oletuksena logo näytetään, kun se on ladattu, muuten näytetään teksti. Voit myös näyttää logon tekstin edessä. Jos logoa ei ole, näytetään vain teksti.';
$string['federation_buttondisplay_auto'] = 'Logo jos ladattu, muuten teksti';
$string['federation_buttondisplay_both'] = 'Logo ja teksti';
$string['federation_buttondisplay_invalid'] = 'Valitse kelvollinen kirjautumispainikkeen näyttö.';
$string['federation_alwaysactive'] = 'Aktiivinen. Määritetty federaatio on aina aktiivinen IdP.';
$string['federation_info'] = 'Federoidut kirjautumiset ovat riippumattomia valituista IdP:istä. Jokainen federaatio lisää kirjautumispainikkeen, joka käyttää omaa discovery-palveluaan ja metadataansa. Olemassa oleva IdP-kokoonpano ei muutu. Globaali $CFG->auth_saml2_disco_url pätee edelleen, kun federaatiopainiketta ei käytetä.';
$string['federation_none'] = 'Federoituja kirjautumisia ei ole vielä määritetty.';
$string['federation_saved'] = 'Federoitu kirjautuminen tallennettu.';
$string['federation_deleted'] = 'Federoitu kirjautuminen poistettu.';
$string['federation_deleteconfirm'] = 'Haluatko varmasti poistaa federoidun kirjautumisen "{$a}"?';
$string['federation_notfound'] = 'Federoitua kirjautumista ei löytynyt.';
$string['federation_invalidurl'] = 'Anna kelvollinen URL.';
$string['federation_unknown'] = 'Tuntematon federaatio: {$a}';
$string['federation_tenantunavailable'] = 'Federoitu kirjautuminen "{$a}" ei ole käytettävissä nykyiselle tenantille.';
$string['federation_tenantavailability'] = 'Tenant-saatavuus';
$string['federation_tenantavailabilityfor'] = 'Tenant-saatavuus kohteelle \'{$a}\'';
$string['federation_tenantavailability_success'] = 'Federaation tenant-saatavuus päivitetty';
$string['federation_tenantmode'] = 'Käytettävissä';
$string['federation_tenantmode_help'] = 'Määrittää, mitkä Moodle Workplace -tenantit näkevät ja voivat käyttää tämän federaation kirjautumispainiketta. Määritä listan sivulta tenant-saatavuustoiminnolla. Sivustoilla ilman Workplace-tenancyä näitä asetuksia ei huomioida.';
$string['federation_tenantmode_all'] = 'Kaikki tenantit';
$string['federation_tenantmode_include'] = 'Vain seuraavat tenantit';
$string['federation_tenantmode_exclude'] = 'Kaikki tenantit paitsi seuraavat';
$string['federation_tenantmode_include_summary'] = 'Sisällytä ({$a})';
$string['federation_tenantmode_exclude_summary'] = 'Sulje pois ({$a})';
$string['federation_tenantids_include'] = 'Sisällytetyt tenantit';
$string['federation_tenantids_exclude'] = 'Poissuljetut tenantit';
$string['federation_tenantids_required'] = 'Valitse vähintään yksi tenant.';
$string['federation_editnamed'] = 'Muokkaa federoitua kirjautumista: {$a}';
$string['federation_createnew'] = 'Luo uusi federoitu kirjautuminen';
$string['federation_enabled'] = 'Federoitu kirjautuminen käytössä.';
$string['federation_disabled'] = 'Federoitu kirjautuminen pois käytöstä.';
$string['federation_disabled_error'] = 'Federoitu kirjautuminen "{$a}" on pois käytöstä.';
$string['federation_metadatastatus'] = 'Metadata';
$string['federation_metadatastatus_help'] = 'Onko federaation metadata-XML ladattu ja välimuistiin tallennettu onnistuneesti.';
$string['federation_metadatastatus_ok'] = 'Metadata välimuistissa';
$string['federation_metadatastatus_missing'] = 'Metadata puuttuu';
$string['eventfederationcreated'] = 'SAML2-federaatio luotu';
$string['eventfederationupdated'] = 'SAML2-federaatio päivitetty';
$string['eventfederationdeleted'] = 'SAML2-federaatio poistettu';
$string['eventfederationtenantavailabilityupdated'] = 'SAML2-federaation tenant-saatavuus päivitetty';
$string['blockredirectheading'] = 'Tilin esto -toiminnot';
$string['cannotmapfield'] = 'Kartoitusristiriita havaittu - kaksi kenttää kartoittuu samaan arvosanakohteeseen {$a}';
$string['certificate'] = 'Luo varmenne uudelleen';
$string['certificate_help'] = 'Luo uudelleen tämän SP:n käyttämä yksityinen avain ja varmenne. | <a href=\'{$a}\'>Näytä SP-varmenne</a>';
$string['certificatedetails'] = 'Varmenteen tiedot';
$string['certificatedetailshelp'] = '<h1>SAML2:n automaattisesti luodun julkisen varmenteen sisältö</h1><p>Varmenteen polku on täällä:</p>';
$string['certificatelock'] = 'Lukitse varmenne';
$string['certificatelock_help'] = 'Varmenteiden lukitus estää niiden ylikirjoittamisen generoinnin jälkeen.';
$string['certificatelock_locked'] = 'Varmenne on lukittu';
$string['certificatelock_lockedmessage'] = 'Varmenteet ovat tällä hetkellä lukittuja.';
$string['certificatelock_regenerate'] = 'Varmenteita ei luoda uudelleen, koska ne on lukittu!';
$string['certificatelock_unlock'] = 'Avaa varmenteiden lukitus';
$string['certificatelock_warning'] = 'Varoitus. Olet lukitsemassa varmenteita. Oletko varma? <br> Varmenteet eivät ole tällä hetkellä lukittuja';
$string['keysize'] = 'Avaimen koko';
$string['keysize_help'] = 'Asettaa julkisten/yksityisten avainten bittikoon, joita käytetään varmenteen luontiin ja allekirjoitukseen.';
$string['checkcertificateexpired'] = 'SAML-varmenne vanheni {$a} sitten';
$string['checkcertificateexpiry'] = 'SAML-varmenteen vanheneminen';
$string['checkcertificateok'] = 'SAML-varmenne vanhenee {$a} kuluttua';
$string['checkcertificatewarn'] = 'SAML-varmenne vanhenee {$a} kuluttua';
$string['commonname'] = 'Common Name';
$string['countryname'] = 'Maa';
$string['debug'] = 'Virheenjäljitys';
$string['debug_help'] = '<p>Lisää ylimääräistä virheenjäljitystä normaaliin Moodle-lokiin | <a href=\'{$a}\'>Näytä SSP-kokoonpano</a></p>';
$string['duallogin'] = 'Kaksoiskirjautuminen';
$string['duallogin_help'] = '
<p>Jos päällä, käyttäjät näkevät sekä manuaalisen että SAML-kirjautumispainikkeen. Jos pois, heidät viedään aina suoraan IdP:n kirjautumissivulle.</p>
<p>Jos passiivinen, IdP:hen jo autentikoidut käyttäjät kirjataan automaattisesti sisään, muuten heidät lähetetään Moodlen kirjautumissivulle.</p>
<p>Jos pois, ylläpitäjät voivat silti nähdä manuaalisen kirjautumissivun osoitteessa /login/index.php?saml=off</p>
<p>Jos päällä, ulkoiset sivut voivat deep-linkata Moodleen saml:lla, esim. /course/view.php?id=45&saml=on</p>
<p>Jos asetettu IdP-yhteyden testiin, verkkoyhteys tarkistetaan, ja jos se toimii, SAML-kirjautuminen aloitetaan.</p>';
$string['emailtaken'] = 'Uutta tiliä ei voida luoda, koska sähköpostiosoite {$a} on jo rekisteröity';
$string['emailtakenupdate'] = 'Sähköpostiasi ei päivitetty, koska osoite {$a} on jo rekisteröity';
$string['error'] = 'Kirjautumisvirhe';
$string['errorinvalidautologin'] = 'Virheellinen automaattisen kirjautumisen pyyntö';
$string['errorparsingxml'] = 'Virhe XML:n jäsennyssä: {$a}';
$string['exception'] = 'SAML2-poikkeus: {$a}';
$string['expirydays'] = 'Voimassaolo päivinä';
$string['fielddelimiter'] = 'Kentän erotin';
$string['fielddelimiter_help'] = 'Erotin, jota käytetään kun kenttä vastaanottaa arvojen taulukon IdP:ltä.';
$string['flaggedresponsetypemessage'] = 'Näytä mukautettu viesti';
$string['flaggedresponsetyperedirect'] = 'Ohjaa ulkoiseen URL-osoitteeseen';
$string['flagmessage'] = 'Vastausviesti';
$string['flagmessage_default'] = 'Olet kirjautunut identity provideriin, mutta tällä tilillä on rajoitettu pääsy Moodleen. Ota yhteyttä ylläpitäjään saadaksesi lisätietoja.';
$string['flagmessage_help'] = '
<p>Viesti, joka näytetään kun käyttäjällä ei ole pääsyä Moodleen määritettyjen ryhmärajoitusten perusteella.</p>
<p>(Näytetään vain kun \'Vastaustyyppi\' on \'Näytä mukautettu viesti\'.)</p>';
$string['flagredirecturl'] = 'Uudelleenohjaus-URL';
$string['flagredirecturl_help'] = '
<p>URL, johon käyttäjä ohjataan kun Moodle-pääsyä ei sallita määritettyjen ryhmärajoitusten perusteella.</p>
<p>(Käytetään vain kun \'Vastaustyyppi\' on \'Ohjaa ulkoiseen URL-osoitteeseen\'.)</p>';
$string['flagresponsetype'] = 'Tilin eston vastaustyyppi';
$string['flagresponsetype_help'] = 'Jos pääsy estetään määritettyjen ryhmärajoitusten perusteella, miten Moodlen tulee vastata?';
$string['grouprules'] = 'Ryhmäsäännöt';
$string['grouprules_help'] = '<p>Luettelo säännöistä, joilla hallitaan pääsyä group-attribuutin arvon perusteella.</p>
<p>Jokaisella rivillä yksi sääntö muodossa: {allow or deny} {groups attribute}={value}.</p>
<p>Ylempänä listassa olevat säännöt sovelletaan ensin.</p>
Esimerkki: <br/>
allow admins=yes<br>
deny admins=no<br>
allow examrole=proctor<br>
deny library=overdue<br>';
$string['idpattr'] = 'Kartoitus IdP';
$string['idpattr_help'] = 'Mikä IdP-attribuutti tulee sovittaa Moodle-käyttäjäkenttään?';
$string['idpmetadata'] = 'IdP-metadata xml TAI julkinen xml-URL';
$string['idpmetadata_badurl'] = 'Virheellinen metadata osoitteessa {$a}';
$string['idpmetadata_help'] = 'Käyttääksesi useita IdP:itä syötä jokainen julkinen metadata-URL uudelle riville.<br/>Nimen ylikirjoittamiseksi sijoita teksti ennen http:tä. esim. "Forced IdP Name http://ssp.local/simplesaml/saml2/idp/metadata.php"';
$string['idpmetadata_invalid'] = 'IdP-XML ei ole kelvollinen';
$string['idpmetadata_noentityid'] = 'IdP-XML:ssä ei ole entityID:tä';
$string['idpmetadatarefresh'] = 'IdP-metadatan päivitys';
$string['idpmetadatarefresh_help'] = 'Suorita ajoitettu tehtävä IdP-metadatan päivittämiseksi IdP-metadata-URL:sta';
$string['idpname'] = 'IdP-tunnisteen ylikirjoitus';
$string['idpname_help'] = 'esim. myUNI - tunnistetaan metadatasta ja näytetään kaksoiskirjautumissivulla (jos käytössä)';
$string['idpnamedefault'] = 'Kirjaudu SAML2:lla';
$string['idpnamedefault_varaible'] = 'Kirjaudu SAML2:lla ({$a})';
$string['localityname'] = 'Paikkakunta';
$string['locked'] = 'Lukittu';
$string['logdir'] = 'Lokihakemisto';
$string['logdir_help'] = 'Hakemisto johon SSPHP kirjoittaa lokin; tiedoston nimi on simplesamlphp.log';
$string['logdirdefault'] = '/tmp/';
$string['logtofile'] = 'Ota lokitus tiedostoon käyttöön';
$string['logtofile_help'] = 'Käyttöönotto ohjaa SSPHP-lokitulosteen tiedostoon logdir-hakemistossa';
$string['manageidpsheading'] = 'Hallitse käytettävissä olevia Identity Providereita (IdP)';
$string['mdlattr'] = 'Kartoitus Moodle';
$string['mdlattr_help'] = 'Mihin Moodle-käyttäjäkenttään IdP-attribuutti sovitetaan?';
$string['metadatafetchfailed'] = 'Metadatan haku epäonnistui: {$a}';
$string['metadatafetchfailedstatus'] = 'Metadatan haku epäonnistui: Tilakoodi {$a}';
$string['metadatafetchfailedunknown'] = 'Metadatan haku epäonnistui: Tuntematon cURL-virhe';
$string['moodleidpdescription'] = 'Asetukset Moodlelle Identity Providerina muille palveluille.';
$string['moodleidpenabled'] = 'Ota IdP käyttöön';
$string['moodleidpenabled_error'] = 'Moodle IdP ei ole käytössä. Tarkista asetukset.';
$string['moodleidpenabled_help'] = 'Salli Moodlen toimia IdP:nä ulkoisille palveluille.';
$string['moodleidpguest_error'] = 'Vieraskäyttäjät eivät voi kirjautua SAML:lla.';
$string['moodleidpheading'] = 'Moodle IdP -asetukset';
$string['moodleidpmetadata'] = 'IdP-metadata';
$string['moodleidpmetadata_help'] = '<a href=\'{$a}\'>Näytä Identity Provider -metadata</a> | <a href=\'{$a}?download=1\'>Lataa IdP-metadata</a>';
$string['moodleidpsplist'] = 'Kelvolliset issuerit';
$string['moodleidpsplist_error'] = 'Tuntematon palvelu yrittää autentikoitua: {$a}. Tarkista kokoonpano.';
$string['moodleidpsplist_help'] = 'Luettelo palveluista, jotka saavat käyttää tätä Moodlea IdP:nä, tunnistettuna SAML-pyynnön <code>saml:Issuer</code>-tunnisteella. Yksi per rivi. {$a->example}';
$string['multiidp:label:active'] = 'Aktiivinen';
$string['multiidp:label:admin'] = 'Vain ylläpitäjille';
$string['multiidp:label:admin_help'] = 'Tällä IdP:llä kirjautuvat käyttäjät tehdään automaattisesti sivuston ylläpitäjiksi';
$string['multiidp:label:alias'] = 'Alias';
$string['multiidp:label:defaultidp'] = 'Oletus-IdP';
$string['multiidp:label:displayname'] = 'Näyttönimi';
$string['multiidp:label:whitelist'] = 'Uudelleenohjatut IP-osoitteet';
$string['multiidp:label:whitelist_help'] = 'Jos asetettu, pakottaa asiakkaat tähän IdP:hen. Muoto: xxx.xxx.xxx.xxx/bitmask. Erota useat aliverkot uudella rivillä.';
$string['multiidpbuttons'] = 'Painikkeet kuvakkeilla';
$string['multiidpdisplay'] = 'Usean IdP:n näyttötyyppi';
$string['multiidpdisplay_help'] = 'Jos IdP-metadata-xml sisältää useita IdP-entiteettejä, miten kukin käytettävissä oleva IdP näytetään?';
$string['multiidpdropdown'] = 'Pudotusvalikko';
$string['multiidpinfo'] = '
<ul>
<li>IdP:tä voi käyttää vain jos se on asetettu Aktiiviseksi</li>
<li>Kun kaksoiskirjautuminen on päällä, kaikki aktiiviset IdP:t näytetään kirjautumissivulla</li>
<li>Kun IdP on asetettu Oletukseksi eikä kaksoiskirjautuminen ole päällä, tätä IdP:tä käytetään automaattisesti ellei /login/index.php:lle välitetä ?multiidp=on tai saml=off</li>
<li>IdP:lle voidaan antaa Alias; osoitteella /login/index.php?idpalias={alias} alias voidaan käyttää suoraan kyseiseen IdP:hen</li>
</ul>';
$string['nameidasattrib'] = 'Näytä NameID attribuuttina';
$string['nameidasattrib_help'] = 'NameID-claim näytetään SSPHP:lle nameid-nimisenä attribuuttina';
$string['nameidpolicy'] = 'NameID Policy';
$string['nameidpolicy_help'] = '';
$string['noattribute'] = 'Olet kirjautunut sisään, mutta emme löytäneet \'{$a}\'-attribuuttiasi yhdistääksemme sinut Moodle-tiliin.';
$string['noidpfound'] = 'IdP:tä \'{$a}\' ei löytynyt määritettynä IdP:nä.';
$string['noredirectips'] = 'Rajoita noredirect IP:n mukaan';
$string['noredirectips_help'] = 'Kun kaksoiskirjautuminen on pois päältä ja IP:t on asetettu, ?saml=off ja ?noredirect=1 -käyttö SAML-kirjautumisen aikana rajoitetaan käyttäjiin, joiden IP-aliverkko täsmää.';
$string['nouser'] = 'Olet kirjautunut sisään tunnuksella \'{$a}\', mutta sinulla ei ole tiliä Moodlessa.';
$string['nullprivatecert'] = 'Yksityisen varmenteen luonti epäonnistui.';
$string['nullpubliccert'] = 'Julkisen varmenteen luonti epäonnistui.';
$string['organizationalunitname'] = 'Organisaatioyksikkö';
$string['organizationname'] = 'Organisaatio';
$string['passivemode'] = 'Passiivinen tila';
$string['phone1'] = 'Puhelin';
$string['phone2'] = 'Matkapuhelin';
$string['plugindisabled'] = 'SAML2-autentikointilisäosa on pois käytöstä';
$string['pluginname'] = 'SAML2';
$string['privatekeypass'] = 'Yksityisen varmenteen avaimen salasana';
$string['privatekeypass_help'] = 'Käytetään paikallisen Moodle-varmenteen allekirjoittamiseen; muuttaminen mitätöi nykyisen varmenteen.';
$string['regenerate_submit'] = 'Luo uudelleen';
$string['regenerateheading'] = 'Luo yksityinen avain ja varmenne uudelleen';
$string['rememberidp'] = 'Muista kirjautumispalvelu';
$string['requestedattributes'] = 'Pyydetyt attribuutit';
$string['requestedattributes_help'] = 'Jotkin IdP:t vaativat SP:n ilmoittavan pyydetyt tai pakolliset attribuutit. Lisää kukin attribuutti uudelle riville; ne näkyvät SP-metadatassa <code>AttributeConsumingService</code>-tunnisteen alla. Jos kentän tulee olla pakollinen, lisää välilyönti ja * rivin jälkeen. {$a->example}';
$string['required'] = 'Tämä kenttä on pakollinen';
$string['requireint'] = 'Tämä kenttä on pakollinen ja sen on oltava positiivinen kokonaisluku';
$string['showidplink'] = 'Näytä IdP-linkki';
$string['showidplink_help'] = 'Näyttää IdP-linkin kun sivusto on määritetty.';
$string['source'] = 'Lähde: {$a}';
$string['spentityid'] = 'Entity ID';
$string['spentityid_help'] = 'Ylikirjoita Service Providerin Entity ID. Useimmissa tapauksissa jätä tyhjäksi hyvän oletuksen käyttämiseksi.';
$string['spmetadata'] = 'SP-metadata';
$string['spmetadata_help'] = '<a href=\'{$a}\'>Näytä Service Provider -metadata</a> | <a href=\'{$a}?download=1\'>Lataa SP-metadata</a>
<p>Saatat joutua antamaan tämän IdP-ylläpitäjälle whitelistausta varten.</p>';
$string['spmetadatasign'] = 'SP-metadatan allekirjoitus';
$string['spmetadatasign_help'] = 'Allekirjoita SP-metadata.';
$string['sspversion'] = 'SimpleSAMLphp-versio';
$string['stateorprovincename'] = 'Osavaltio tai provinssi';
$string['status'] = 'Tila';
$string['suspendeduser'] = 'Olet kirjautunut sisään tunnuksella \'{$a}\', mutta tilisi on jäädytetty Moodlessa.';
$string['taskmetadatarefresh'] = 'Metadatan päivitystehtävä';
$string['tempdir'] = 'SimpleSAMLphp-tilapäishakemisto';
$string['tempdir_help'] = 'Hakemisto, johon SimpleSAMLphp voi tallentaa tilapäistiedostoja';
$string['test_auth_button_login'] = 'IdP-kirjautuminen';
$string['test_auth_button_logout'] = 'IdP-uloskirjautuminen';
$string['test_auth_str'] = 'Testaa isAuthenticated ja kirjautuminen';
$string['test_endpoint'] = 'Yhteystestin URL';
$string['test_endpoint_desc'] = 'Anna URL IdP-uudelleenohjauksen yhteyden testaamiseen asiakasselaimesta. Joillain käyttäjillä tai verkoilla ei välttämättä ole yhteyttä IdP:hen tili- tai verkkolupien vuoksi.';
$string['test_idp_conn'] = 'Testaa IdP-yhteys';
$string['test_noticetestrequirements'] = 'Tämän testin käyttämiseksi lisäosan on oltava määritetty ja käytössä, ja virheenjäljityksen on oltava päällä lisäosan asetuksissa.';
$string['test_passive_str'] = 'Testaa isPassive-tilassa';
$string['testdebuggingdisabled'] = 'Tämän testisivun käyttämiseksi SAML-virheenjäljityksen on oltava päällä';
$string['tolower'] = 'Kirjainkoon vastaavuus';
$string['tolower:caseandaccentinsensitive'] = 'Kirjainkoosta ja aksenteista riippumaton';
$string['tolower:caseinsensitive'] = 'Kirjainkoosta riippumaton';
$string['tolower:exact'] = 'Tarkka';
$string['tolower:lowercase'] = 'Pienet kirjaimet';
$string['tolower_help'] = '
<p>Tarkka: vastaavuus on kirjainkoosta riippuvainen (oletus).</p>
<p>Pienet kirjaimet: muuntaa IdP-attribuutin pieniksi kirjaimiksi ennen vastaavuutta.</p>
<p>Kirjainkoosta riippumaton: ohita kirjainkoko vastaavuudessa.</p>';
$string['unlocked'] = 'Lukitsematon';
$string['unlockedifempty'] = 'Lukitsematon jos tyhjä';
$string['update_never'] = 'Ei koskaan';
$string['update_oncreate'] = 'Luonnin yhteydessä';
$string['update_onlogin'] = 'Jokaisella kirjautumisella';
$string['update_onupdate'] = 'Päivityksen yhteydessä';
$string['wantassertionssigned'] = 'Vaadi allekirjoitetut assertionit';
$string['wantassertionssigned_help'] = 'Tuleeko tämän SP:n vastaanottamien assertionien olla allekirjoitettuja';
$string['wrongauth'] = 'Olet kirjautunut sisään tunnuksella \'{$a}\', mutta sinulla ei ole oikeutta käyttää Moodlea.';
/*
 * Privacy provider (GDPR)
 */
$string["privacy:no_data_reason"] = "SAML2-autentikointilisäosa ei tallenna henkilötietoja.";

/*
 * Signing Algorithm
 */
$string['sha1'] = 'Vanha SHA1 (vaarallinen)';
$string['sha256'] = 'SHA256';
$string['sha384'] = 'SHA384';
$string['sha512'] = 'SHA512';
$string['signaturealgorithm'] = 'Allekirjoitusalgoritmi';
$string['signaturealgorithm_help'] = 'Algoritmi, jolla SAML-pyynnöt allekirjoitetaan. Varoitus: SHA1 tarjotaan vain taaksepäin yhteensopivuuden vuoksi; ellei sitä ehdottomasti tarvita, suositellaan vähintään SHA256:ta.';
$string['selectloginservice'] = 'Valitse kirjautumispalvelu';
$string['regenerateheader'] = 'Luo yksityinen avain ja varmenne uudelleen';
$string['regeneratewarning'] = 'Varoitus! Uuden varmenteen luonti ylikirjoittaa nykyisen, ja saatat joutua päivittämään IdP:si';
$string['regeneratepath'] = 'Varmenteen polku: {$a}';
$string['regenerateheader'] = 'Luo yksityinen avain ja varmenne uudelleen';
$string['regeneratesuccess'] = 'Yksityinen avain ja varmenne luotu uudelleen onnistuneesti';
