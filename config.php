<?php
define('SITE_NAME', 'Trade boost test');


define('DB_NAME', 'tradeboost');
define('DB_USER', 'genuser');
define('DB_PASSWORD', 'genpass');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

// HTTP
define('HTTP', 'http://tb.local:8888/');
define('HTTP_SERVER', 'http://'.HTTP);
define('HTTP_IMAGE', 'http://'.HTTP.'image/');
define('HTTP_ADMIN', 'http://'.HTTP.'admin/');

// DIR
define('BASE_DIR', realpath(dirname(__FILE__)));
define('DIR_SYSTEM', BASE_DIR.'/system/');
define('DIR_TRANSLATION', BASE_DIR.'/translation/');
define('DIR_IMAGE', BASE_DIR.'/image/');

define('GA_UID', 'UA-1693681-20');

define('COUNTRY_DEFAULT', 'SE');
define('CURRENCY_DEFAULT', 'EUR');
define('SHIPPING_COUNTRIES',array('AT','BE','BG','CH','CY','CZ','DE','DK','EE','ES','FI','FR','GB','GR','HR','HU','IE','IT','LT','LU','LV','MT','NL','PL','PT','RO','SE','SI','SK'));

setlocale(LC_ALL, 'sv_SE');
