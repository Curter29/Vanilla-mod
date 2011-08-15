<?php if (!defined('APPLICATION')) exit();
// DO NOT EDIT THIS FILE.
// If you want to override the settings in this file then edit config.php.
// This is the global application configuration file that sets up default
// values for configuration settings.
$Configuration = array();

$Configuration['EnabledApplications']['Dashboard']             = 'dashboard';

$Configuration['Database']['Engine']                           = 'MySQL';
$Configuration['Database']['Host']                             = 'dbhost';
$Configuration['Database']['Name']                             = 'dbname';
$Configuration['Database']['User']                             = 'dbuser';
$Configuration['Database']['Password']                         = '';
$Configuration['Database']['ConnectionOptions']                = array(
                                                                  PDO::ATTR_PERSISTENT => FALSE,
                                                                  1000 => TRUE, // PDO::MYSQL_ATTR_USE_BUFFERED_QUERY is missing in some php installations
                                                                  1002 => "set names 'utf8'" // PDO::MYSQL_ATTR_INIT_COMMAND is missing in PHP 5.3, so I use the actual value "1002" instead
                                                               );
$Configuration['Database']['CharacterEncoding']                = 'cp1251';
$Configuration['Database']['DatabasePrefix']                    = 'G1_';
$Configuration['Database']['ExtendedProperties']['Collate']     = 'cp1251_general_ci';

$Configuration['Cache']['Enabled']                              = TRUE;
$Configuration['Cache']['Method']                               = 'dirtycache';
$Configuration['Cache']['Filecache']['Store']                   = PATH_LOCAL_CACHE.'/Filecache';

$Configuration['Garden']['ContentType']                         = 'text/html';
$Configuration['Garden']['Charset']                             = 'utf-8';
// An array of folders the application should never search through when searching for classes. (note: plugins had to be removed so that locale searches could get the locale folder from the plugin's folder).
$Configuration['Garden']['FolderBlacklist']                     = array('.', '..', '_svn', '.git');
$Configuration['Garden']['Locale']                              = 'en-CA';
$Configuration['Garden']['LocaleCodeset']                       = 'UTF8';
$Configuration['Garden']['Title']                               = 'Vanilla 2';
$Configuration['Garden']['Domain']                              = '';
$Configuration['Garden']['WebRoot']                             = FALSE; // You can set this value if you are using htaccess to direct into the application, but the correct webroot isn't being recognized.
$Configuration['Garden']['StripWebRoot']                        = FALSE;
$Configuration['Garden']['Debug']                               = FALSE;
$Configuration['Garden']['RewriteUrls']                         = FALSE;
$Configuration['Garden']['Session']['Length']                   = '15 minutes';
$Configuration['Garden']['Cookie']['Salt']                      = '';
$Configuration['Garden']['Cookie']['Name']                      = 'Vanilla';
$Configuration['Garden']['Cookie']['Path']                      = '/';
$Configuration['Garden']['Cookie']['Domain']                    = '';
$Configuration['Garden']['Cookie']['HashMethod']                = 'md5'; // md5 or sha1
$Configuration['Garden']['Authenticator']['DefaultScheme']      = 'password'; // Types include 'Password', 'Handshake', 'Openid'
$Configuration['Garden']['Authenticator']['RegisterUrl']        = '/entry/register?Target=%2$s';
$Configuration['Garden']['Authenticator']['SignInUrl']          = '/entry/signin?Target=%2$s';
$Configuration['Garden']['Authenticator']['SignOutUrl']         = '/entry/signout/{Session_TransientKey}?Target=%2$s';
$Configuration['Garden']['Authenticator']['EnabledSchemes']     = array('password');
$Configuration['Garden']['Authenticator']['SyncScreen']         = "smart";
$Configuration['Garden']['Authenticators']['password']['Name']  = "Password";
$Configuration['Garden']['Errors']['LogEnabled']                = FALSE;
$Configuration['Garden']['Errors']['LogFile']                   = '';
$Configuration['Garden']['Errors']['MasterView']                = 'deverror.master.php'; // Used at installation time and you should use it too view when debugging
$Configuration['Garden']['SignIn']['Popup']                     = TRUE; // Should the sign-in link pop up or go to it's own page? (SSO requires going to it's own external page)
$Configuration['Garden']['UserAccount']['AllowEdit']            = TRUE; // Allow users to edit their account information? (SSO requires accounts be edited in external system).
$Configuration['Garden']['Registration']['Method']              = 'Captcha'; // Options are: Basic, Captcha, Approval, Invitation
$Configuration['Garden']['Registration']['DefaultRoles']        = array('8'); // The default role(s) to assign new users (4 is "Member")
$Configuration['Garden']['Registration']['ApplicantRoleID']     = 4; // The "Applicant" RoleID.
$Configuration['Garden']['Registration']['InviteExpiration']    = '-1 week'; // The time before now that an invitation expires. ie. If an invitation was sent within the last week, it is still valid. This value will be plugged directly into strtotime()
$Configuration['Garden']['Registration']['InviteRoles']         = 'FALSE';
$Configuration['Garden']['Registration']['ConfirmEmail']        = FALSE;
$Configuration['Garden']['Registration']['ConfirmEmailRole']    = 3;
$Configuration['Garden']['TermsOfService']                      = '/dashboard/home/termsofservice'; // The url to the terms of service.
$Configuration['Garden']['Email']['UseSmtp']                    = FALSE;
$Configuration['Garden']['Email']['SmtpHost']                   = '';
$Configuration['Garden']['Email']['SmtpUser']                   = '';
$Configuration['Garden']['Email']['SmtpPassword']               = '';
$Configuration['Garden']['Email']['SmtpPort']                   = '25';
$Configuration['Garden']['Email']['SmtpSecurity']               = ''; // ssl/tls
$Configuration['Garden']['Email']['MimeType']                   = 'text/plain';
$Configuration['Garden']['Email']['SupportName']                = 'Support';
$Configuration['Garden']['Email']['SupportAddress']             = '';
$Configuration['Garden']['UpdateCheckUrl']                      = 'http://vanillaforums.org/addons/update';
$Configuration['Garden']['AddonUrl']                            = 'http://vanillaforums.org/addons';
$Configuration['Garden']['CanProcessImages']                    = FALSE;
$Configuration['Garden']['Installed']                           = FALSE; // Has Garden been installed yet?
$Configuration['Garden']['Forms']['HoneypotName']               = 'hpt';
$Configuration['Garden']['Upload']['MaxFileSize']               = '50M';
$Configuration['Garden']['Upload']['AllowedFileExtensions']     = array('txt','jpg','jpeg','gif','png','bmp','tiff','zip','gz','tar.gz','tgz','psd','ai','fla','swf','pdf','doc','xls','ppt','docx','xlsx','log','pdf');
$Configuration['Garden']['Picture']['MaxHeight']                = 1000;
$Configuration['Garden']['Picture']['MaxWidth']                 = 600;
$Configuration['Garden']['Profile']['MaxHeight']                = 1000;
$Configuration['Garden']['Profile']['MaxWidth']                 = 250;
$Configuration['Garden']['Preview']['MaxHeight']                = 100;
$Configuration['Garden']['Preview']['MaxWidth']                 = 75;
$Configuration['Garden']['Thumbnail']['Size']                   = 50;
$Configuration['Garden']['Menu']['Sort']                        = array('Dashboard', 'Discussions', 'Questions', 'Activity', 'Applicants', 'Conversations', 'User');
//$Configuration['Garden']['DashboardMenu']['Sort']               = array('Dashboard', 'Appearance', 'Banner', 'Themes', 'Theme Options', 'Custom Theme', 'Messages', 'Custom Domain', 'Users', 'Roles & Permissions', 'Registration', 'Applicants', 'Authentication', 'Forum', 'Forum Settings', 'Categories', 'Tagging', 'Voting', 'Spam', 'Flagging', 'Flagged Content', 'Media', 'Signatures', 'Add-ons', 'Addons', 'Plugins', 'Applications', '&lt;Embed&t; Vanilla', 'Locales', 'Site Settings', 'Import');
$Configuration['Garden']['InputFormatter']                      = 'Html';
$Configuration['Garden']['Html']['SafeStyles']                  = TRUE; // disallow style/class attributes in html to prevent click jacking
$Configuration['Garden']['Search']['Mode']                      = 'matchboolean'; // matchboolean, match, boolean, like
$Configuration['Garden']['Theme']                               = 'default';
$Configuration['Garden']['MobileTheme']                         = 'mobile';
$Configuration['Garden']['Profile']['Public']                   = TRUE;
$Configuration['Garden']['Profile']['ShowAbout']                = TRUE;
$Configuration['Garden']['Roles']['Manage']                     = TRUE;
$Configuration['Garden']['VanillaUrl']                          = 'http://vanillaforums.org';
$Configuration['Garden']['AllowSSL']                            = TRUE;
$Configuration['Garden']['PrivateCommunity']                    = FALSE;
$Configuration['Garden']['EditContentTimeout']                  = -1; // -1 means no timeout. 0 means immediate timeout. > 0 is in seconds.
$Configuration['Garden']['Profile']['EditUsernames']            = FALSE;
$Configuration['Garden']['Modules']['ShowGuestModule']          = TRUE;
$Configuration['Garden']['Modules']['ShowSignedInModule']       = FALSE;
$Configuration['Garden']['Modules']['ShowRecentUserModule']     = FALSE;

// Formatting
$Configuration['Garden']['Format']['Mentions']                  = TRUE;
$Configuration['Garden']['Format']['Hashtags']                  = TRUE;
$Configuration['Garden']['Format']['YouTube']                   = TRUE;
$Configuration['Garden']['Format']['Vimeo']                     = TRUE;
$Configuration['Garden']['Format']['EmbedSize']                 = 'normal'; // tiny/small/normal/big/huge or WIDTHxHEIGHT

// Default Preferences
$Configuration['Preferences']['Email']['ConversationMessage']   = '1';
$Configuration['Preferences']['Email']['AddedToConversation']   = '1';
$Configuration['Preferences']['Email']['BookmarkComment']       = '1';
$Configuration['Preferences']['Email']['WallComment']           = '0';
$Configuration['Preferences']['Email']['ActivityComment']       = '0';
$Configuration['Preferences']['Email']['DiscussionComment']     = '0';
$Configuration['Preferences']['Email']['DiscussionMention']     = '0';
$Configuration['Preferences']['Email']['CommentMention']        = '0';
$Configuration['Preferences']['Popup']['ConversationMessage']   = '1';
$Configuration['Preferences']['Popup']['AddedToConversation']   = '1';
$Configuration['Preferences']['Popup']['BookmarkComment']       = '1';
$Configuration['Preferences']['Popup']['WallComment']           = '1';
$Configuration['Preferences']['Popup']['ActivityComment']       = '1';
$Configuration['Preferences']['Popup']['DiscussionComment']     = '1';
$Configuration['Preferences']['Popup']['DiscussionMention']     = '1';
$Configuration['Preferences']['Popup']['CommentMention']        = '1';

// Modules
$Configuration['Modules']['Garden']['Panel'] = array('UserPhotoModule', 'UserInfoModule', 'GuestModule', 'Ads');
$Configuration['Modules']['Garden']['Content'] = array('MessageModule', 'Notices', 'Content', 'Ads');
$Configuration['Modules']['Vanilla']['Panel'] = array('NewDiscussionModule', 'SignedInModule', 'GuestModule', 'Ads');
$Configuration['Modules']['Vanilla']['Content'] = array('MessageModule', 'Notices', 'NewConversationModule', 'NewDiscussionModule', 'CategoryModeratorsModule', 'Content', 'Ads');
$Configuration['Modules']['Conversations']['Panel'] = array('NewConversationModule', 'SignedInModule', 'GuestModule', 'Ads');
$Configuration['Modules']['Conversations']['Content'] = array('MessageModule', 'Notices', 'NewConversationModule', 'NewDiscussionModule', 'Content', 'Ads');

// Routes
$Configuration['Routes']['DefaultController'] = 'discussions';
$Configuration['Routes']['Default404'] = array('dashboard/home/filenotfound', 'NotFound');
$Configuration['Routes']['DefaultPermission'] = array('dashboard/home/permission', 'NotAuthorized');
$Configuration['Routes']['UpdateMode'] = 'dashboard/home/updatemode';