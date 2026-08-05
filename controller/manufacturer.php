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

$catalog = new Catalog;

$manufacturer = $catalog->get_manufacturer($manufacturer_id);

$category_params = array();

if(!empty($manufacturer_id)) {
	$category_params[] = array('sql' => "p.manufacturer = ?", 'params' => array($manufacturer_id));
}

$products_array = $catalog->get_products($category_params);

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

// best_price is already in the page currency, so nothing needs converting.
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

$countries_array = $catalog->get_countries($category_params);
$filter_groups = tradeboost_filter_groups($catalog, $facet_counts, $selected_facets, $countries_array, $translation, $page_language);
$price_filter_labels = tradeboost_price_labels($translation, $page_language);
$sort_options = tradeboost_sort_options($sorting_array, $sort);

$selected = "";
if(!empty($_GET['stock_only']) && $_GET['stock_only'] == 1) { $selected = "checked"; }
$stock_only = "<input class='form-check-input' type='checkbox' value='1' id='stock_only' name='stock_only' " . $selected . " >";


$og_tags = array();

//page title and description
switch ($page_language) {
	case "SE":
		$page_title = "Produkter från " . $manufacturer['name'];
		$page_meta_title = "Guld- och silverprodukter av  " . $manufacturer['name'];
		$page_meta_description = "";
		$description = $manufacturer['description_SE'];			
		break;
	case "DE":
		$page_title = "Produkte hergestellt von " . $manufacturer['name'];
		$page_meta_title = "Gold und Silber aus " . $manufacturer['name'];
		$page_meta_description = "";
		$description = $manufacturer['description_DE'];			
		break;
	case "FR":
		$page_title = "Produits fabriqués par " . $manufacturer['name'];
		$page_meta_title = "Or et argent par " . $manufacturer['name'];
		$page_meta_description = "";
		$description = $manufacturer['description_DE'];			
		break;
	case "NL":
		$page_title = "Producten gemaakt door " . $manufacturer['name'];
		$page_meta_title = "Goud en zilver door " . $manufacturer['name'];
		$page_meta_description = "";
		$description = $manufacturer['description_DE'];			
		break;
	case "ES":
		$page_title = "Productos de " . $manufacturer['name'];
		$page_meta_title = "Productos de lingotes de oro y plata de" . $manufacturer['name'];
		$page_meta_description = "";
		$description = $manufacturer['description_DE'];			
		break;
	default:
		$page_title = "Products made by " . $manufacturer['name'];
		$page_meta_title = "Gold and Silver bullion by  " . $manufacturer['name'];
		$page_meta_description = "";		
		$description = $manufacturer['description_EN'];	

}

$og_tags[] = array('property' => 'og:title', 'content' => $page_meta_title);
$og_tags[] = array('property' => 'og:description', 'content' => $page_meta_description);	

//html formatting
$description = str_replace("\n", "<br/>", $description); 

$current_url = $_SERVER['QUERY_STRING'];

$view_name = "manufacturer";

require_once(BASE_DIR . '/view/base.view.php');

?>