<?php
require __DIR__ . '/../model/catalog.php';
require __DIR__ . '/../model/commodity.php';
require __DIR__ . '/../translation/translations.php';
require __DIR__ . '/../model/ads.php';
require __DIR__ . '/../model/statistics.php';
$page_view = new Statistic;
$page_view->track_pageview(HTTP);

$page_language = COUNTRY_DEFAULT;
$page_currency  = CURRENCY_DEFAULT;

$price_array = new Commodity;
$comodity_price_array = array();
$comodity_price_array['AU'] = $price_array->get_commodity_price('AU');
$comodity_price_array['SI'] = $price_array->get_commodity_price('SI');

$catalog = new Catalog;

$featured_products = array(
	'1306', 
	'209', 
	'219', 
	'317', 
	'315',
	'319', 
	'305', 
	'421',
	'306', 
	'318', 
	'293', 
	'391', 
	'370', 
	'298', 
	'299', 
	'479', 
	'197', 
	'83', 
	'143', 
	'12',
	'60', 
	'5', 
	'109', 
	'47'
);


$ad_inventory['middle'] = gererate_adsense_html(HTTP, 'middle');	


$products_array = array();

foreach ($featured_products as $product) {
	$products_array[] = $catalog->get_product($product);
}


$deals_array = array (
	array(
		'headline' => ucfirst($translation[$page_language]['popular_deals']) . " " . $translation[$page_language]['AUcoins'],
		'products' => $catalog->filter_and_sort_products($products_array, array('metal' => 'AU', 'type' => 'coin', 'quantity' => 1), 'best_price_compare_to_spot')
	),
	array(
		'headline' => ucfirst($translation[$page_language]['popular_deals']) . " " . $translation[$page_language]['SIcoins'],
		'products' => $catalog->filter_and_sort_products($products_array, array('metal' => 'SI', 'type' => 'coin', 'quantity' => 1), 'best_price_compare_to_spot')
	),
	array(
		'headline' => ucfirst($translation[$page_language]['popular_deals']) . " " . $translation[$page_language]['AUbars'],
		'products' => $catalog->filter_and_sort_products($products_array, array('metal' => 'AU', 'type' => 'bar', 'quantity' => 1), 'best_price_compare_to_spot')
	),
	array(
		'headline' => ucfirst($translation[$page_language]['popular_deals']) . " " . $translation[$page_language]['SIbars'],
		'products' => $catalog->filter_and_sort_products($products_array, array('metal' => 'SI', 'type' => 'bar', 'quantity' => 1), 'best_price_compare_to_spot')
	)
);

//site specific featured products
$featured_products_site = array();
$featured_headline = "";

switch(HTTP) {
	case "https://trade-boost.co.uk/":
	$featured_products_site = array('322','370','475','313');
	$featured_headline = "British bullion coins";
	break;
	case "https://trade-boost.de/":
	$featured_products_site = array('258','243','666','661');
	$featured_headline = "Deutsche Anlagemünzen";
	break;
	case "https://tradeboost.se/":
	$featured_products_site = array('798','251','425','2');
	$featured_headline = "Svenska favoriter";
	break;
	case "https://tradeboost.ch/":
	$featured_products_site = array('421','10','32','119');
	$featured_headline = "Favoriten in der Schweiz";
	break;
	case "https://tradeboost.at/":
	$featured_products_site = array('240','297','298','614');
	$featured_headline = "Münzen aus Österreich";
	break;
	case "https://tradeboost.fr/":
	$featured_products_site = array('481','809','248','422');
	$featured_headline = "Monnaies de France";
	break;
}

$products_array_site = array();

foreach ($featured_products_site as $product) {
	$products_array_site[] = $catalog->get_product($product);
}

$deals_array_site = array(
		'headline' => $featured_headline,
		'products' => $catalog->filter_and_sort_products($products_array_site, array('quantity' => 1), 'best_price_compare_to_spot')
	);

$og_tags = array();

//page title and description
switch ($page_language) {
	case "SE":
		$page_title = "Jämför onlinepriser på guld och silver från hela Europa";
		$page_meta_title = $page_title;
		$page_meta_description = "Hitta billigaste pris på silver och guld online. Uppdaterade priser varje timme. Jämför priser och butiker innan din nästa investering. ";
		break;
	case "DE":
		$page_title = "Vergleichsportal: Silber und Gold, Barren und Münzen online";
		$page_meta_title = $page_title;
		$page_meta_description = "Finden Sie stündlich den günstigsten Preis, wenn Sie Gold und Silber online für Investitionen kaufen. Vergleichen Sie Preise und Geschäfte online.";
		break;
	case "FR":
		$page_title = "Achetez de l'argent et de l'or en ligne - Comparez les prix";
		$page_meta_title = $page_title;
		$page_meta_description = "Comparez les prix et trouvez le prix le moins cher toutes les heures. Achetez de l'or et de l'argent physiques en ligne.";
		break;
	case "NL":
		$page_title = "Koop zilver en goud online - Vergelijk prijzen";
		$page_meta_title = $page_title;
		$page_meta_description = "Vergelijk prijzen en vind elk uur de goedkoopste prijs. Koop fysiek goud en zilver online.";
		break;
	case "ES":
		$page_title = "Comparación de precios: lingotes de plata y oro en línea";
		$page_meta_title = $page_title;
		$page_meta_description = "Encuentre el precio más barato cada hora antes de comprar oro y plata físicos en línea.";
		break;
	default:
		$page_title = "Compare Silver and Gold bullion prices online";
		$page_meta_title = $page_title;
		$page_meta_description = "Find the cheapest price every hour before buying physical gold and silver online. Boost you trading today.";		
}

$og_tags[] = array('property' => 'og:title', 'content' => $page_meta_title);
$og_tags[] = array('property' => 'og:description', 'content' => $page_meta_description);
$og_tags[] = array('property' => 'og:type', 'content' => 'website');	
$og_tags[] = array('property' => 'og:url', 'content' => 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);	

$view_name = "index";
require_once(BASE_DIR . '/view/base.view.php');
?>
