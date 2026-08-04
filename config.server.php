<?php
define('SITE_NAME', 'Trade boost');

// Database credentials live in one shared file. This config sits in the shared
// application directory, so secrets.php is a sibling of it.
require_once(__DIR__ . '/secrets.php');
tradeboost_define_database_credentials('production');

// HTTP
define('HTTP', 'https://tradeboost.eu/');
define('HTTP_SERVER', 'https://'.HTTP);
define('HTTP_IMAGE', 'https://'.HTTP.'image/');
define('HTTP_ADMIN', 'https://'.HTTP.'admin/');

// DIR
define('BASE_DIR', realpath(dirname(__FILE__)));
define('DIR_SYSTEM', BASE_DIR.'/system/');
define('DIR_TRANSLATION', BASE_DIR.'/translation/');
define('DIR_IMAGE', BASE_DIR.'/image/');

define('GA_UID', 'UA-1693681-21');

define('COUNTRY_DEFAULT', 'EN');
define('CURRENCY_DEFAULT', 'EUR');
define('SHIPPING_COUNTRIES',array('AT','BE','BG','CH','CY','CZ','DE','DK','EE','ES','FI','FR','GB','GR','HR','HU','IE','IT','LT','LU','LV','MT','NL','PL','PT','RO','SE','SI','SK'));

setlocale(LC_ALL, 'sv_SE');