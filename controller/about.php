<?php
require __DIR__ . '/../model/catalog.php';
require __DIR__ . '/../model/commodity.php';
require __DIR__ . '/../translation/translations.php';
require __DIR__ . '/../model/statistics.php';
$page_view = new Statistic;
$page_view->track_pageview(HTTP);


$page_language = COUNTRY_DEFAULT;
$page_currency  = CURRENCY_DEFAULT;

$catalog = new Catalog;

$price_array = new Commodity;
$comodity_price_array = array();
$comodity_price_array['AU'] = $price_array->get_commodity_price('AU');
$comodity_price_array['SI'] = $price_array->get_commodity_price('SI');

//page title and description
switch ($page_language) {
	case "SE":
		$page_title = "Om " . SITE_NAME;
		$page_meta_title = $page_title;
		$page_meta_description = "";
		break;
	case "DE":
		$page_title = "Über " . SITE_NAME;
		$page_meta_title = $page_title;
		$page_meta_description = "";
		break;
	case "FR":
		$page_title = "À propos  " . SITE_NAME;
		$page_meta_title = $page_title;
		$page_meta_description = "";
		break;
	case "NL":
		$page_title = "Over " . SITE_NAME;
		$page_meta_title = $page_title;
		$page_meta_description = "";
		break;
	case "ES":
		$page_title = "Sobre " . SITE_NAME;
		$page_meta_title = $page_title;
		$page_meta_description = "";
		break;
	default:
		$page_title = "About " . SITE_NAME;
		$page_meta_title = $page_title;
		$page_meta_description = "";		
}


$view_name = "about";

require_once(BASE_DIR . '/view/base.view.php');
?>
