<?php if (!defined('APPLICATION')) exit();

// Conversations
$Configuration['Conversations']['Version'] = '2.0.18b2';

// Database
$Configuration['Database']['Name'] = 'test';
$Configuration['Database']['Host'] = 'localhost';
$Configuration['Database']['User'] = 'test';
$Configuration['Database']['Password'] = 'testfoodby';

// EnabledApplications
$Configuration['EnabledApplications']['Conversations'] = 'conversations';
$Configuration['EnabledApplications']['Vanilla'] = 'vanilla';

// EnabledLocales
$Configuration['EnabledLocales']['russian'] = 'ru-RU';

// EnabledPlugins
$Configuration['EnabledPlugins']['GettingStarted'] = 'GettingStarted';
$Configuration['EnabledPlugins']['HtmLawed'] = 'HtmLawed';
$Configuration['EnabledPlugins']['Flagging'] = TRUE;
$Configuration['EnabledPlugins']['Quotes'] = TRUE;

// Garden
$Configuration['Garden']['Title'] = 'Volkswagen Golf';
$Configuration['Garden']['Cookie']['Salt'] = 'IKRBALZLKY';
$Configuration['Garden']['Cookie']['Domain'] = '';
$Configuration['Garden']['Registration']['ConfirmEmail'] = '1';
$Configuration['Garden']['Registration']['Method'] = 'Captcha';
$Configuration['Garden']['Registration']['ConfirmEmailRole'] = '3';
$Configuration['Garden']['Registration']['CaptchaPrivateKey'] = '';
$Configuration['Garden']['Registration']['CaptchaPublicKey'] = '';
$Configuration['Garden']['Registration']['InviteExpiration'] = '-1 week';
$Configuration['Garden']['Registration']['InviteRoles'] = 'a:5:{i:3;s:1:"0";i:4;s:1:"0";i:8;s:1:"0";i:16;s:1:"0";i:32;s:1:"0";}';
$Configuration['Garden']['Email']['SupportName'] = 'Kлуб любителей - автомобилей Volkswagen Golf всех поколений';
$Configuration['Garden']['Version'] = '2.0.18b2';
$Configuration['Garden']['RewriteUrls'] = TRUE;
$Configuration['Garden']['CanProcessImages'] = TRUE;
$Configuration['Garden']['Installed'] = TRUE;
$Configuration['Garden']['InstallationID'] = 'D7EE-E5AB18E3-3ADA8C20';
$Configuration['Garden']['InstallationSecret'] = '092d26bac6cc1f2d9afe40caa96e201cd6f7c316';
$Configuration['Garden']['Theme'] = 'based';
$Configuration['Garden']['Locale'] = 'ru-RU';
$Configuration['Garden']['Html']['SafeStyles'] = FALSE;
$Configuration['Garden']['EditContentTimeout'] = '-1';

// Plugins
$Configuration['Plugins']['GettingStarted']['Dashboard'] = '1';
$Configuration['Plugins']['GettingStarted']['Discussion'] = '1';
$Configuration['Plugins']['GettingStarted']['Plugins'] = '1';
$Configuration['Plugins']['Tagging']['Enabled'] = FALSE;
$Configuration['Plugins']['Flagging']['Enabled'] = TRUE;
$Configuration['Plugins']['Flagging']['UseDiscussions'] = FALSE;
$Configuration['Plugins']['Flagging']['CategoryID'] = '-1';

// Routes
$Configuration['Routes']['DefaultController'] = 'discussions';

// Vanilla
$Configuration['Vanilla']['Version'] = '2.0.18b2';
$Configuration['Vanilla']['Categories']['MaxDisplayDepth'] = '3';
$Configuration['Vanilla']['Categories']['DoHeadings'] = FALSE;
$Configuration['Vanilla']['Categories']['HideModule'] = FALSE;
$Configuration['Vanilla']['Comments']['AutoOffset'] = TRUE;
$Configuration['Vanilla']['Comments']['AutoRefresh'] = '0';
$Configuration['Vanilla']['Comments']['PerPage'] = '10';
$Configuration['Vanilla']['Discussions']['PerPage'] = '10';
$Configuration['Vanilla']['Archive']['Date'] = '';
$Configuration['Vanilla']['Archive']['Exclude'] = FALSE;

// Last edited by alex808 (81.200.4.101)2011-11-03 16:38:12