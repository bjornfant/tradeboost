<?php
//error_reporting(E_ALL);
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
$filter = false;
$sort = "";
$category_params = array();


if($product_type) {
	$category_params[] = array('sql' => "p.type = ?", 'params' => array($product_type));
}
if($metal) {
	$category_params[] = array('sql' => "p.metal = ?", 'params' => array($metal));
}

$currency_rates = $catalog->get_currency_rates();
$countries_array = $catalog->get_countries($category_params);
$manufacturers_array = $catalog->get_manufacturers();
$sorting_array = $translation[$page_language]['sorting'];


//Don't list bundle items
$category_params['no_bundles'] = "pb.quantity IS NULL";

//only with offers";
$category_params['only_with_offers'] = "(SELECT count(id) FROM pricecomp_store_product_to_product sp2p WHERE product_id = p.product_id) > 0";

//only with an updated price
$category_params['updated_price'] = "(p.lowest_price_eur/p.metal_weight_oz) > 0";

/**
 * Filters are multi-select, so every value arrives as an array. Anything that
 * is not a plain scalar is dropped rather than passed on to the query.
 */
if(!function_exists('tradeboost_filter_values')) {
	function tradeboost_filter_values($key) {
		if(!isset($_GET[$key])) { return array(); }
		$values = array();
		foreach((array) $_GET[$key] as $value) {
			if(is_scalar($value) && (string) $value !== '') { $values[] = (string) $value; }
		}
		return array_values(array_unique($values));
	}
}

if(!function_exists('tradeboost_filter_label')) {
	function tradeboost_filter_label($translation, $language, $key, $fallback) {
		if(isset($translation[$language]['filter'][$key])) { return $translation[$language]['filter'][$key]; }
		if(isset($translation['EN']['filter'][$key])) { return $translation['EN']['filter'][$key]; }
		return $fallback;
	}
}

$selected_facets = array(
	'country'      => tradeboost_filter_values('country'),
	'manufacturer' => tradeboost_filter_values('manufacturer'),
	'weight'       => tradeboost_filter_values('weight'),
	'premium'      => tradeboost_filter_values('premium'),
);

// lowest_price_eur is in EUR, so both the spot price and the price range have
// to be converted out of the page currency before they reach the query.
$spot_prices_eur = array(
	'AU' => $comodity_price_array['AU']['EUR']['price_per_oz'],
	'SI' => $comodity_price_array['SI']['EUR']['price_per_oz'],
);

$price_min = (isset($_GET['price_min']) && is_scalar($_GET['price_min']) && $_GET['price_min'] !== '') ? (float) $_GET['price_min'] : false;
$price_max = (isset($_GET['price_max']) && is_scalar($_GET['price_max']) && $_GET['price_max'] !== '') ? (float) $_GET['price_max'] : false;

if(!function_exists('tradeboost_price_to_eur')) {
	function tradeboost_price_to_eur($catalog, $currency, $value, $currency_rates) {
		if($value === false) { return false; }
		$converted = $catalog->convert_currency($currency, 'EUR', $value, $currency_rates);
		// An unsupported currency pair would otherwise drop the filter entirely.
		return ($converted === false) ? $value : $converted;
	}
}

$price_min_eur = tradeboost_price_to_eur($catalog, $page_currency, $price_min, $currency_rates);
$price_max_eur = tradeboost_price_to_eur($catalog, $page_currency, $price_max, $currency_rates);

/**
 * The facet counts are built from the base constraints only - the same ones the
 * product query uses - so the numbers shown always add up to what the list
 * actually contains. The price range sits in the base because it is a range
 * input with no counts of its own.
 */
$base_params = $category_params;

$price_filter = $catalog->filter_price($price_min_eur, $price_max_eur);
if($price_filter) { $base_params['price'] = $price_filter; }

// Manufacturer is no longer offered as a filter, but existing ?manufacturer=
// links still have to narrow the list. Keeping it in the base rather than in
// the facets means the counts shown stay consistent with such a link.
$manufacturer_filter = $catalog->filter_in('p.manufacturer', $selected_facets['manufacturer']);
if($manufacturer_filter) { $base_params['manufacturer'] = $manufacturer_filter; }

$facet_rows = $catalog->get_facet_rows($base_params);
$facet_counts = $catalog->count_facets($facet_rows, $selected_facets, $spot_prices_eur);

$category_params = $base_params;

$country_filter = $catalog->filter_in('p.country_origin', $selected_facets['country']);
if($country_filter) { $category_params['country'] = $country_filter; }

$weight_filter = $catalog->filter_weight($selected_facets['weight']);
if($weight_filter) { $category_params['weight'] = $weight_filter; }

$premium_filter = $catalog->filter_premium($selected_facets['premium'], $spot_prices_eur);
if($premium_filter) { $category_params['premium'] = $premium_filter; }

if(!isset($sort_params)) { $sort_params = array(); }


/**
 * Sorting is part of the filter form rather than its own mechanism, so a
 * chosen sort survives the filters and vice versa. The map doubles as the
 * whitelist - anything not a key here falls back to the default.
 */
$sort_orders = array(
	'price_low'   => 'p.lowest_price_eur ASC',
	'price_high'  => 'p.lowest_price_eur DESC',
	'weight_low'  => 'p.metal_weight_oz ASC',
	'weight_high' => 'p.metal_weight_oz DESC',
);

$sort = 'price_low';
if(!empty($_GET['sort']) && is_scalar($_GET['sort']) && isset($sort_orders[$_GET['sort']])) {
	$sort = (string) $_GET['sort'];
}

$order = $sort_orders[$sort];


$products_total = $catalog->get_products($category_params, false, $order,false, false, true, false, $currency_rates);
$limit = 30;
$page = 1;
if(!empty($_GET['page'])) {
	$page = $_GET['page'];
}
$products_array = $catalog->get_products($category_params, false, $order, $limit, $page, false, $currency_rates);

//filter and sort
$filtered_products = array();
$first_item_description = "";
$first_store_product = array();

if(!empty($products_array)) {
	foreach($products_array as $product) {
		$show_product = true;
		if(empty($product['store_products'])) { $show_product = false;} //only show products that are for sale somewhere
		//if(!empty($_GET['metal_weight_class']) && $_GET['metal_weight_class'] != $product['metal_weight_class']) { $show_product = false; }

		if($show_product) {

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

			$product['metal_type'] = strtolower($translation['EN'][$product['metal']].$product['type']);

			if($first_store_product['price'] > 0) {
				$filtered_products[] = $product; 
			}
			if(empty($first_item_description) && strlen($product['description_' . $page_language])>0) {
				$first_item_description = $product['description_' . $page_language];
			}

			
		}
		
	}	
}

$stock_only = "";

// Handed to the view as data, like the filter groups.
$sort_options = array();
foreach($sort_orders as $sort_key => $sort_sql) {
	$sort_options[] = array(
		'value'    => $sort_key,
		'label'    => isset($sorting_array[$sort_key]) ? $sorting_array[$sort_key] : $sort_key,
		'selected' => ($sort_key == $sort),
	);
}

/**
 * Each filter group is handed to the view as data rather than as a blob of
 * HTML. An option is kept when it still matches something, or when it is
 * already ticked - otherwise unticking your own selection would be impossible.
 */
$filter_groups = array();

$country_options = array();
if(!empty($countries_array)) {
	foreach($countries_array as $country_name => $country_code) {
		$count = isset($facet_counts['country'][$country_code]) ? $facet_counts['country'][$country_code] : 0;
		$checked = in_array($country_code, $selected_facets['country']);
		if($count == 0 && !$checked) { continue; }
		$country_options[] = array('value' => $country_code, 'label' => $country_name, 'count' => $count, 'checked' => $checked);
	}
}
if(count($country_options) > 1) {
	$filter_groups[] = array(
		'name'    => 'country',
		'label'   => tradeboost_filter_label($translation, $page_language, 'land', 'Country'),
		'options' => $country_options,
	);
}

$weight_options = array();
foreach($catalog->weight_denominations() as $denomination_key => $denomination) {
	$count = isset($facet_counts['weight'][$denomination_key]) ? $facet_counts['weight'][$denomination_key] : 0;
	$checked = in_array($denomination_key, $selected_facets['weight']);
	if($count == 0 && !$checked) { continue; }
	$weight_options[] = array(
		'value'   => $denomination_key,
		'label'   => $catalog->denomination_label($denomination),
		'count'   => $count,
		'checked' => $checked,
	);
}
if(isset($facet_counts['weight']['other']) || in_array('other', $selected_facets['weight'])) {
	$weight_options[] = array(
		'value'   => 'other',
		'label'   => tradeboost_filter_label($translation, $page_language, 'weight_other', 'Other weights'),
		'count'   => isset($facet_counts['weight']['other']) ? $facet_counts['weight']['other'] : 0,
		'checked' => in_array('other', $selected_facets['weight']),
	);
}
if(count($weight_options) > 1) {
	$filter_groups[] = array(
		'name'    => 'weight',
		'label'   => tradeboost_filter_label($translation, $page_language, 'metal_weight', 'Precious metal weight'),
		'options' => $weight_options,
	);
}

$premium_labels = array(
	'under_3' => 'premium_under_3',
	'3_to_5'  => 'premium_3_to_5',
	'5_to_10' => 'premium_5_to_10',
	'over_10' => 'premium_over_10',
);
$premium_fallbacks = array(
	'under_3' => 'Under 3% over spot',
	'3_to_5'  => '3 - 5% over spot',
	'5_to_10' => '5 - 10% over spot',
	'over_10' => 'Over 10% over spot',
);
$premium_options = array();
foreach($catalog->premium_brackets() as $bracket_key => $bracket) {
	$count = isset($facet_counts['premium'][$bracket_key]) ? $facet_counts['premium'][$bracket_key] : 0;
	$checked = in_array($bracket_key, $selected_facets['premium']);
	if($count == 0 && !$checked) { continue; }
	$premium_options[] = array(
		'value'   => $bracket_key,
		'label'   => tradeboost_filter_label($translation, $page_language, $premium_labels[$bracket_key], $premium_fallbacks[$bracket_key]),
		'count'   => $count,
		'checked' => $checked,
	);
}
if(count($premium_options) > 1) {
	$filter_groups[] = array(
		'name'    => 'premium',
		'label'   => tradeboost_filter_label($translation, $page_language, 'premium', 'Premium over spot'),
		'options' => $premium_options,
	);
}

$price_filter_labels = array(
	'heading' => tradeboost_filter_label($translation, $page_language, 'price_range', 'Price'),
	'from'    => tradeboost_filter_label($translation, $page_language, 'price_from', 'From'),
	'to'      => tradeboost_filter_label($translation, $page_language, 'price_to', 'To'),
);

// product_group is only sparsely filled in, so it reads better as a list of
// links to the group pages than as a filter.
$popular_product_groups = $catalog->get_popular_product_groups($base_params, 12);
$popular_groups_label = tradeboost_filter_label($translation, $page_language, 'popular_groups', 'Popular product groups');

$selected = "";

if(isset($_GET['stock_only'])) {
	if($_GET['stock_only'] == 1) { $selected = "checked"; }
}	
$stock_only = "<input class='form-check-input' type='checkbox' value='1' id='stock_only' name='stock_only' " . $selected . " >";

//page title and description
if($product_type == "bar" && $metal == "AU") { 
	$page_title = ucfirst($translation[$page_language]['AUbars']); 
}
if($product_type == "bar" && $metal == "SI") { 
	$page_title = ucfirst($translation[$page_language]['SIbars']);  
}
if($product_type == "coin" && $metal == "AU") { 
	$page_title = ucfirst($translation[$page_language]['AUcoins']); 
}
if($product_type == "coin" && $metal == "SI") { 
	$page_title = ucfirst($translation[$page_language]['SIcoins']); 
}

$page_description = "";
if(!empty($translation_product_list[$page_language][$metal][$product_type]) && $page == 1) {
	$page_description = $translation_product_list[$page_language][$metal][$product_type];
}

/**
 * The single-selection titles are what the country and manufacturer landing
 * pages rank on, so they are kept. Once several values are ticked there is no
 * one name to put in the title and the generic one stands.
 */
$single_country = (count($selected_facets['country']) == 1) ? reset($selected_facets['country']) : false;
$single_manufacturer = (count($selected_facets['manufacturer']) == 1) ? reset($selected_facets['manufacturer']) : false;

if($single_country !== false && $single_manufacturer === false) {
	if(isset($translation[COUNTRY_DEFAULT]['country'][$single_country])) {
		$page_title .= " " . $translation[COUNTRY_DEFAULT]['country'][$single_country];
	}
	$page_description = $first_item_description;
}

if($single_country === false && $single_manufacturer !== false) {
	if(isset($manufacturers_array[$single_manufacturer])) {
		$page_title .= " " . $manufacturers_array[$single_manufacturer]['name'];
		$page_description = $manufacturers_array[$single_manufacturer]['description_'.$page_language];
	}
}


$og_tags = array();

switch ($page_language) {
	case "SE":
		$page_meta_title = "Jämför priser på " . $page_title . " - köp online i Europa";
		$page_meta_description = "Prisjämförelse på " . $page_title . ". Jämför priser på tusentals produkter från hela Europa när du ska köpa guld och silver på nätet.";
		break;
	case "DE":
		$page_meta_title = $page_title . " - online kaufen - Preisvergleich";
		$page_meta_description = $page_title . ". Niedrigster Preis, jede Stunde. Vergleichen Sie Tausende von Produkten und Online-Shops, wenn Sie Gold und Silber online kaufen.";		
		break;
	case "FR":
		$page_meta_title = "Acheter " . $page_title . " en ligne - Comparaison de prix";
		$page_meta_description = $page_title . ". Trouvez le prix le plus bas, toutes les heures. Comparez des milliers de produits, de produits et de fournisseurs lorsque vous êtes sur le point d'acheter de l'or ou de l'argent en ligne.";		
		break;
	case "NL":
		$page_meta_title = "Koop " . $page_title  . " online - Prijsvergelijking";
		$page_meta_description = $page_title . ". Vind de laagste prijs, elk uur! Vergelijk duizenden producten, producten en leveranciers wanneer u op het punt staat online goud of zilver te kopen.";		
		break;
	case "ES":
		$page_meta_title = "Comprar " . $page_title  . " online - Comparación de precios";
		$page_meta_description = $page_title . ". ¡Encuentre el precio más bajo, cada hora. Compare miles de productos, productos y proveedores cuando esté a punto de comprar oro o plata en línea.";		
		break;
	default:
		$page_meta_title = "Compare prices on " . $page_title . " to get the best deal";
		$page_meta_description = "Find the best deals in Europe. Compare prices on " . $page_title . " and thousands of products and suppliers of gold or silver online.";		
}

$og_tags[] = array('property' => 'og:title', 'content' => $page_meta_title);
$og_tags[] = array('property' => 'og:description', 'content' => $page_meta_description);
$og_tags[] = array('property' => 'og:type', 'content' => 'website');	
$og_tags[] = array('property' => 'og:url', 'content' => 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

$pagination = $catalog->pagination($products_total, $limit, $page, $_SERVER['REQUEST_URI']);

if(!strpos($page_description,"<br")) {
	$page_description = str_replace("\n", "<br/>", $page_description); 	
}


$view_name = "product_list";
require_once(BASE_DIR . '/view/base.view.php');

?>