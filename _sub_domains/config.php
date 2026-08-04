<?php
define('SITE_NAME', 'Trade boost');

// Database credentials live in one shared file. On the server that is the
// shared application directory; the second path is for a local checkout.
$tradeboost_secrets = '/var/www/tradeboost.eu/public_html/secrets.php';
if (!file_exists($tradeboost_secrets)) {
	$tradeboost_secrets = __DIR__ . '/../secrets.php';
}
require_once($tradeboost_secrets);
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