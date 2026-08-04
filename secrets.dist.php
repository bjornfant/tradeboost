<?php
/**
 * Template for secrets.php - copy this file to secrets.php and fill in the
 * real values. secrets.php itself is never committed.
 *
 * On the server it belongs in the shared application directory:
 *
 *     /var/www/tradeboost.eu/public_html/secrets.php
 *
 * Every site config finds it from there, so a rotated password only has to be
 * changed in this one file.
 */

function tradeboost_define_database_credentials($set = 'production') {

	$credentials = array(

		// The shared catalogue database behind all the tradeboost.* sites.
		'production' => array(
			'name'     => '',
			'user'     => '',
			'password' => '',
			'host'     => ''
		),

		// Older separate database, still used by old_goldenpreis.de.
		'prisguld' => array(
			'name'     => '',
			'user'     => '',
			'password' => '',
			'host'     => ''
		)

	);

	if (!isset($credentials[$set])) {
		error_log('Unknown database credential set requested: ' . $set);
		exit('Configuration error.');
	}

	define('DB_NAME', $credentials[$set]['name']);
	define('DB_USER', $credentials[$set]['user']);
	define('DB_PASSWORD', $credentials[$set]['password']);
	define('DB_HOST', $credentials[$set]['host']);
	define('DB_CHARSET', 'utf8');
	define('DB_COLLATE', '');
}

/**
 * API key for the OpenAI translation helper in system/translate.php.
 */
function tradeboost_openai_api_key() {
	return '';
}

/**
 * Tradera API credentials, used by model/marketplace.php.
 */
function tradeboost_tradera_credentials() {
	return array(
		'app_id'  => '',
		'app_key' => ''
	);
}

/**
 * eBay production application name (SECURITY-APPNAME), used by
 * model/marketplace.php.
 */
function tradeboost_ebay_app_name() {
	return '';
}
