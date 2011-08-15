<?php if (!defined('APPLICATION')) exit();

// Cache
$Configuration['Cache']['Enabled'] = TRUE;
$Configuration['Cache']['Method'] = 'memcached';

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

// EnabledPlugins
$Configuration['EnabledPlugins']['GettingStarted'] = 'GettingStarted';
$Configuration['EnabledPlugins']['HtmLawed'] = 'HtmLawed';
$Configuration['EnabledPlugins']['Debugger'] = TRUE;

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
$Configuration['Garden']['InstallationID'] = '8C31-76A25FD5-4B158429';
$Configuration['Garden']['InstallationSecret'] = '7826ee2161c35e5909885a4006128f85aefb13e9';

// Plugins
$Configuration['Plugins']['GettingStarted']['Dashboard'] = '1';
$Configuration['Plugins']['GettingStarted']['Plugins'] = '1';

// Routes
$Configuration['Routes']['DefaultController'] = 'discussions';

// Vanilla
$Configuration['Vanilla']['Version'] = '2.0.18b2';

// Last edited by alex (83.242.167.62)2011-08-15 06:19:03