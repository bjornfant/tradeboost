<?php
require __DIR__ . '/../model/catalog.php';
require __DIR__ . '/../model/commodity.php';
require __DIR__ . '/../model/ads.php';
require __DIR__ . '/../translation/translations.php';
require __DIR__ . '/../translation/translations_product_list.php';
require __DIR__ . '/../model/statistics.php';
$page_view = new Statistic;
$page_view->track_pageview(HTTP);

$page_language = COUNTRY_DEFAULT;
$page_currency  = CURRENCY_DEFAULT;

$price_array = new Commodity;
$comodity_price_array = array();
$comodity_price_array['AU'] = $price_array->get_commodity_price('AU');
$comodity_price_array['SI'] = $price_array->get_commodity_price('SI');

$ad_inventory['left'] = gererate_adsense_html(HTTP, 'left');		
$ad_inventory['middle'] = gererate_adsense_html(HTTP, 'middle');	

$catalog = new Catalog;
$db = new db;



switch ($page_language) {
	case "SE":
		$page_meta_title = "Så säljer du ditt guld till bästa pris";
		$page_meta_description = "Så säljer du ditt guld till bästa pris.";
		break;
	case "DE":
		$page_meta_title = "";
		$page_meta_description = "";
		break;
	case "FR":
		$page_meta_title = "";
		$page_meta_description = "";
		break;
	case "NL":
		$page_meta_title = "";
		$page_meta_description = "";
		break;
	case "ES":
		$page_meta_title = "";
		$page_meta_description = "";
		break;
	default:
		$page_meta_title = "";
		$page_meta_description = "";
}

$og_tags = array();
$og_tags[] = array('property' => 'og:title', 'content' => $page_meta_title);
$og_tags[] = array('property' => 'og:description', 'content' => $page_meta_description);	

//page title and description
$page_title = $page_meta_title; 
$page_description = $page_meta_description;


$view_name = "sales_information";
require_once(BASE_DIR . '/view/base.view.php');

?>