<?php
require __DIR__ . '/../model/catalog.php';
require __DIR__ . '/../model/ads.php';
require __DIR__ . '/../model/commodity.php';
require __DIR__ . '/../translation/translations.php';
require __DIR__ . '/../model/statistics.php';

$page_view = new Statistic;
$page_view->track_pageview(HTTP);
$page_language = COUNTRY_DEFAULT;
$page_currency  = CURRENCY_DEFAULT;

$ad_inventory['middle'] = gererate_adsense_html(HTTP, 'middle');

$price_array = new Commodity;
$comodity_price_array = array();
$comodity_price_array['AU'] = $price_array->get_commodity_price('AU');
$comodity_price_array['SI'] = $price_array->get_commodity_price('SI');

$catalog = new Catalog;

$og_tags = array();

//page title and description
switch ($page_language) {
	case "SE":
		$page_title = $translation[$page_language][$metal] . "pris idag - per gram, kg och troy ounce";
		$page_meta_title = $page_title;
		$page_meta_description = "Följ priset på " . $translation[$page_language][$metal] . " varje sekund och jämför pris på mynt och tackor från hela Europa.";
		break;
	case "DE":
		$page_title =  $translation[$page_language][$metal.'price'] . " heute - pro Gramm, Kilo und Unze";
		$page_meta_title = $page_title;
		$page_meta_description = "Verfolgen Sie jede Sekunde den " . $translation[$page_language][$metal.'price'] . " und finden Sie den günstigsten Preis für Münzen und Barren aus ganz Europa.";
		break;
	case "FR":
		$page_title = "Prix de l'" . $translation[$page_language][$metal] . " aujourd'hui, par gramme et once";
		$page_meta_title = $page_title;
		$page_meta_description = "Suivez le prix de l'" . $translation[$page_language][$metal] . " et trouvez les prix les moins chers sur les lingots de tous les principaux fournisseurs européens";
		break;
	case "NL":
		$page_title = $translation[$page_language][$metal.'price'] . " vandaag, per gram en ounce";
		$page_meta_title = $page_title;
		$page_meta_description = "Volg de prijs van " . $translation[$page_language][$metal] . " en vind de goedkoopste prijzen voor edelmetaal van alle grote Europese leveranciers";
		break;
	case "ES":
		$page_title = $translation[$page_language][$metal.'price'] . " hoy, por gramo y onza";
		$page_meta_title = $page_title;
		$page_meta_description = "Realice un seguimiento del precio del " . $translation[$page_language][$metal] . " y encuentre los precios más baratos en lingotes de los principales proveedores europeos";
		break;
	default:
		$page_title = $translation[$page_language][$metal] . " price today - in gram, kilo and ounce";
		$page_meta_title = $page_title;
		$page_meta_description = "Follow the price of " . $translation[$page_language][$metal] . " and find the cheapest prices on bullions from major European online suppliers and retailers";		
}

$og_tags[] = array('property' => 'og:title', 'content' => $page_meta_title);
$og_tags[] = array('property' => 'og:description', 'content' => $page_meta_description);
$og_tags[] = array('property' => 'og:type', 'content' => 'website');	
$og_tags[] = array('property' => 'og:url', 'content' => 'https://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]);	

$view_name = "commodity_price";
require_once(BASE_DIR . '/view/base.view.php');
?>
