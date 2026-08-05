<?php
require __DIR__ . '/../model/catalog.php';
require __DIR__ . '/../model/commodity.php';
require __DIR__ . '/../model/ads.php';
require __DIR__ . '/../translation/translations.php';
require __DIR__ . '/../model/statistics.php';
require_once __DIR__ . '/inc_filter.php';
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

$db = new db;
$filter = false;
$category_params = array();

$sorting_array = $translation[$page_language]['sorting'];
unset($sorting_array['best_compare_price']);

if(!empty($_GET['type'])) {
	$product_type = $_GET['type'];
}
if(isset($metal)) {
	$category_params[] = array('sql' => "p.metal = ?", 'params' => array($metal));
}


$catalog = new Catalog;

$store = $catalog->get_product_stores(array($shop_id));
$store = reset($store);

$products_array = $catalog->get_store_products($shop_id);
$countries_array = $catalog->get_countries($category_params);
$manufacturers_array = $catalog->get_manufacturers();

//filter and sort
$prepared_products = array();
foreach($products_array as $product) {
	$product = tradeboost_prepare_product($product, $comodity_price_array, $page_currency, $translation);
	if($product !== false) { $prepared_products[] = $product; }
}

$selected_facets = tradeboost_selected_facets();
$sort = tradeboost_sort_key();

$price_min = tradeboost_price_bound('price_min');
$price_max = tradeboost_price_bound('price_max');

// best_price here is this shop's price, so a premium bracket describes what the
// shop charges rather than the market's best offer.
$spot_prices = array(
	'AU' => $comodity_price_array['AU'][$page_currency]['price_per_oz'],
	'SI' => $comodity_price_array['SI'][$page_currency]['price_per_oz'],
);

$facet_counts = $catalog->count_facets(
	tradeboost_facet_rows(tradeboost_price_filtered($prepared_products, $price_min, $price_max)),
	$selected_facets,
	$spot_prices
);

$filtered_products = array();
foreach($prepared_products as $product) {
	if(tradeboost_product_matches($catalog, $product, $selected_facets, $spot_prices, $price_min, $price_max)) {
		$filtered_products[] = $product;
	}
}

$filtered_products = tradeboost_sort_products($filtered_products, $sort);

$filter_groups = tradeboost_filter_groups($catalog, $facet_counts, $selected_facets, $countries_array, $translation, $page_language);
$price_filter_labels = tradeboost_price_labels($translation, $page_language);
$sort_options = tradeboost_sort_options($sorting_array, $sort);

// The store query carries no in-stock flag, so this page does not offer the box.
$stock_only = "";



//Shop offers
$offer_insured = "<span class='stockout'>✗</span> " . $translation[COUNTRY_DEFAULT]['shop']['not_offer_insured_delivery'];	;
if($store['offer_insured_delivery'] == 1) {
	$offer_insured = "<span class='stockin'>✓</span> " . $translation[COUNTRY_DEFAULT]['shop']['offer_insured_delivery'];	
}
$offer_storage = "<span class='stockout'>✗</span> " . $translation[COUNTRY_DEFAULT]['shop']['not_offer_storage'];
if($store['offer_storage'] == 1) {
	$offer_storage = "<span class='stockin'>✓</span> " . $translation[COUNTRY_DEFAULT]['shop']['offer_storage'];
}
$offer_store_pickup = "<span class='stockout'>✗</span> " . $translation[COUNTRY_DEFAULT]['shop']['not_offer_store_pickup'];
if($store['offer_store_pickup'] == 1) {
	$offer_store_pickup = "<span class='stockin'>✓</span> " . $translation[COUNTRY_DEFAULT]['shop']['offer_store_pickup'];
}


$url_store = $store['url_store'];
$url_shipping_information = $store['url_shipping_information'];
$url_payment_information = $store['url_payment_information'];



switch ($page_language) {
	case "SE":
		$description = $store['description_SE'];
		break;
	case "DE":
		$description = $store['description_DE'];
		break;
	case "FR":
		$description = $store['description_FR'];
		break;
	case "NL":
		$description = $store['description_NL'];
		break;
	default:
		$description = $store['description_EN'];
	}

$og_tags = array();

//page title and description
switch ($page_language) {
	case "SE":
		$page_title =  $store['name'];
		$page_meta_title = "Prisjämför alla produkter från " . $store['name'];
		$page_meta_description = strip_tags($description);
		break;
	case "DE":
		$page_title =  $store['name'];
		$page_meta_title = "Vergleiche alle Preise für Produkte von " . $store['name'];
		$page_meta_description = strip_tags($description);
		break;
	case "FR":
		$page_title =  $store['name'];
		$page_meta_title = "Comparez tous les prix des produits d’" . $store['name'];
		$page_meta_description = strip_tags($description);
		break;
	case "NL":
		$page_title =  $store['name'];
		$page_meta_title = "Vergelijk alle prijzen van producten van " . $store['name'];
		$page_meta_description = strip_tags($description);
		break;
	case "ES":
		$page_title =  $store['name'];
		$page_meta_title = "Compara todos los precios de productos de " . $store['name'];
		$page_meta_description = strip_tags($description);
		break;
	default:
		$page_title = $store['name'];
		$page_meta_title = "Compare all prices on products from " . $store['name'];
		$page_meta_description = strip_tags($description);		
}

$og_tags[] = array('property' => 'og:title', 'content' => $page_meta_title);
$og_tags[] = array('property' => 'og:description', 'content' => $page_meta_description);
$og_tags[] = array('property' => 'og:type', 'content' => 'website');	
$og_tags[] = array('property' => 'og:url', 'content' => 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

$current_url = $_SERVER['QUERY_STRING'];

$view_name = "shop";

require_once(BASE_DIR . '/view/base.view.php');

?>