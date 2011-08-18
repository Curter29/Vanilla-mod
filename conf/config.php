<?php if (!defined('APPLICATION')) exit();

// Cache
$Configuration['Cache']['Enabled'] = TRUE;
$Configuration['Cache']['Method'] = 'memcache';
$Configuration['Cache']['Memcache']['Store'] = 'localhost:11211';

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
$Configuration['EnabledPlugins']['AllViewed'] = TRUE;
$Configuration['EnabledPlugins']['Quotes'] = TRUE;
$Configuration['EnabledPlugins']['Tagging'] = TRUE;
$Configuration['EnabledPlugins']['FileUpload'] = TRUE;

// Garden
$Configuration['Garden']['Title'] = 'Test';
$Configuration['Garden']['Cookie']['Salt'] = 'RG1RL38DX8';
$Configuration['Garden']['Cookie']['Domain'] = '';
$Configuration['Garden']['Registration']['ConfirmEmail'] = TRUE;
$Configuration['Garden']['Email']['SupportName'] = 'Test';
$Configuration['Garden']['Version'] = '2.0.18b2';
$Configuration['Garden']['RewriteUrls'] = TRUE;
$Configuration['Garden']['CanProcessImages'] = TRUE;
$Configuration['Garden']['Installed'] = TRUE;
$Configuration['Garden']['Analytics']['Enabled'] = FALSE;
$Configuration['Garden']['Html']['SafeStyles'] = FALSE;
$Configuration['Garden']['Theme'] = 'simple_based';
$Configuration['Garden']['Locale'] = 'ru-RU';

// Plugins
$Configuration['Plugins']['GettingStarted']['Dashboard'] = '1';
$Configuration['Plugins']['GettingStarted']['Plugins'] = '1';
$Configuration['Plugins']['GettingStarted']['Discussion'] = '1';
$Configuration['Plugins']['GettingStarted']['Profile'] = '1';
$Configuration['Plugins']['GettingStarted']['Categories'] = '1';
$Configuration['Plugins']['AllViewed']['Enabled'] = TRUE;
$Configuration['Plugins']['Tagging']['Enabled'] = TRUE;
$Configuration['Plugins']['FileUpload']['Enabled'] = TRUE;

// Routes
$Configuration['Routes']['DefaultController'] = 'discussions';

// Vanilla
$Configuration['Vanilla']['Version'] = '2.0.18b2';
$Configuration['Vanilla']['Categories']['MaxDisplayDepth'] = '3';
$Configuration['Vanilla']['Categories']['DoHeadings'] = FALSE;
$Configuration['Vanilla']['Categories']['HideModule'] = FALSE;

// Last edited by alex (83.242.167.62)2011-08-16 11:23:08