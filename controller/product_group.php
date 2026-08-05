<?php
require __DIR__ . '/../model/catalog.php';
require __DIR__ . '/../model/url.php';
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

$url = new Url;

$product_group_id = $url->get_id($product_group_url, 'product_group');
$catalog = new Catalog;

$product_group = $catalog->get_product_group($product_group_id);

$products_array = $catalog->get_group_products(array(
	array('sql' => 'p.product_group = ?', 'params' => array($product_group_id))
));

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

// best_price is already in the page currency, so the range and the spot price
// are compared in that currency too and nothing needs converting.
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
		$page_title = $product_group['name'];
		$page_meta_title = $product_group['name'] . ". Hitta billigaste pris";
		$description = $product_group['description_SE'];	
		break;
	case "DE":
		$page_title = $product_group['name'];
		$page_meta_title = "Finden Sie den günstigsten Preis - " . $product_group['name'];
		$description = $product_group['description_DE'];	
		break;
	case "FR":
		$page_title = $product_group['name'];
		$page_meta_title = "Trouvez le prix le moins cher - " . $product_group['name'];
		$description = $product_group['description_FR'];	
		break;
	case "NL":
		$page_title = $product_group['name'];
		$page_meta_title = "Vind de goedkoopste prijs - " . $product_group['name'];
		$description = $product_group['description_NL'];	
		break;
	case "ES":
		$page_title = $product_group['name'];
		$page_meta_title = "Encuentra el precio más barato - " . $product_group['name'];
		$description = $product_group['description_EN'];	
		break;
	default:
		$page_title = $product_group['name'];
		$page_meta_title = "Find the cheapest price - " . $product_group['name'];
		$description = $product_group['description_EN'];				
}

$page_meta_description = $page_title;//$description;

$description = str_replace("\n", '<br/>', $description);



$og_tags[] = array('property' => 'og:title', 'content' => $page_meta_title);
$og_tags[] = array('property' => 'og:description', 'content' => $page_meta_description);	
$og_tags[] = array('property' => 'og:type', 'content' => 'website');	
$og_tags[] = array('property' => 'og:url', 'content' => 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

$current_url = $_SERVER['QUERY_STRING'];

$view_name = "product_group";

require_once(BASE_DIR . '/view/base.view.php');

?>