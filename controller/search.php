<?php
require __DIR__ . '/../model/catalog.php';
require __DIR__ . '/../model/search.php';
require __DIR__ . '/../model/commodity.php';
require __DIR__ . '/../model/ads.php';
require __DIR__ . '/../translation/translations.php';
require __DIR__ . '/../model/statistics.php';
$page_view = new Statistic;
$page_view->track_pageview(HTTP);

$page_language = COUNTRY_DEFAULT;
$page_currency  = CURRENCY_DEFAULT;

$ad_inventory['left'] = gererate_adsense_html(HTTP, 'left');		
$ad_inventory['middle'] = gererate_adsense_html(HTTP, 'middle');	
$ad_inventory['right'] = gererate_adsense_html(HTTP, 'right');	

$db = new db;
$catalog = new Catalog;
$search = new Search;
$price_array = new Commodity;

$comodity_price_array = array();
$comodity_price_array['AU'] = $price_array->get_commodity_price('AU');
$comodity_price_array['SI'] = $price_array->get_commodity_price('SI');

if(!empty($_GET['query'])) {
	$query = $_GET['query'];
}

$query = $search->sanitize_query($query);

$search_result = array();

if(strlen($query) > 1) {
	$search_result = $search->search_query($query);
}

//filter and sort
$filtered_products = array();
$products_with_no_offers = array();

if(!empty($search_result)) {
	foreach($search_result as $product) {
		$product['metal_type'] = strtolower($translation['EN'][$product['metal']].$product['type']);

		if(empty($product['store_products'])) { 
			$first_store_product = false;
			$product['offers'] = 0;
			$product['best_price'] = 0;
			$product['best_price_per_oz'] = 0;
			$product['best_price_compare_to_spot'] = 0;

		} else {
			$first_store_product = reset($product['store_products']);
			$product['offers'] = (int) count($product['store_products']);
			
			if(isset($_GET['stock_only'])) {
				if($_GET['stock_only'] == 1) {
					$first_store_product = reset($product['store_products_in_stock']);
					$product['offers'] = (int) count($product['store_products_in_stock']);
				}
			} 

			$product['best_price'] = $first_store_product['price'];
			$product['best_price_per_oz'] = $first_store_product['price_per_oz'];
			$product['best_price_compare_to_spot'] = 100*((float) $product['best_price_per_oz'] - (float) $comodity_price_array[$product['metal']][$page_currency]['price_per_oz'])/(float) $comodity_price_array[$product['metal']][$page_currency]['price_per_oz'];
			
		}
		if(empty($first_store_product) || $first_store_product['price'] > 0) {
			$filtered_products[] = $product; 
		} else {
			$products_with_no_offers[] = $product; 
		}
		
	}	
}

$filtered_products = array_merge($filtered_products, $products_with_no_offers);

$og_tags = array();

switch ($page_language) {
	case "SE":
		$page_title = "Sökresultat " . $query . " (".count($filtered_products).")";
		$page_meta_title = $page_title;
		$page_meta_description = $page_title . " - hitta billigt guld och silver online.";
		break;
	case "DE":
		$page_title = "Sie haben gesucht " . $query . " (".count($filtered_products).")";
		$page_meta_title = $page_title;
		$page_meta_description = $page_title . " - finden Sie billiges Gold und Silber online.";		
		break;
	case "FR":
		$page_title = "Résultats de recherche " . $query . " (".count($filtered_products).")";
		$page_meta_title = $page_title;
		$page_meta_description = $page_title . " - trouver de l'or et de l'argent bon marché en ligne.";		
		break;
	case "NL":
		$page_title = "Zoekresultaten voor " . $query . " (".count($filtered_products).")";
		$page_meta_title = $page_title;
		$page_meta_description = $page_title . " - vind goedkoop goud en zilver online.";		
		break;
	case "ES":
		$page_title = "Has buscado " . $query . " (".count($filtered_products).")";
		$page_meta_title = $page_title;
		$page_meta_description = $page_title . "- encuentre lingotes de oro y plata baratos en línea.";		
		break;
	default:
		$page_title = "Search result " . $query . " (".count($filtered_products).")";
		$page_meta_title = $page_title;
		$page_meta_description = $page_title . " - find cheap gold and silver online.";		
}

$og_tags[] = array('property' => 'og:title', 'content' => $page_meta_title);
$og_tags[] = array('property' => 'og:description', 'content' => $page_meta_description);	
$og_tags[] = array('property' => 'og:type', 'content' => 'website');	
$og_tags[] = array('property' => 'og:url', 'content' => HTTP . 'search?query='.$query);	


$view_name = "search";
require_once(BASE_DIR . '/view/base.view.php');


?>