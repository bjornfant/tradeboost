<?php
//error_reporting(E_ALL);
require __DIR__ . '/../model/catalog.php';
require __DIR__ . '/../model/commodity.php';
require __DIR__ . '/../model/ads.php';
require __DIR__ . '/../translation/translations.php';
require __DIR__ . '/../translation/translations_product_list.php';
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

$selected_facets = tradeboost_selected_facets();

// lowest_price_eur is in EUR, so both the spot price and the price range have
// to be converted out of the page currency before they reach the query.
$spot_prices_eur = array(
	'AU' => $comodity_price_array['AU']['EUR']['price_per_oz'],
	'SI' => $comodity_price_array['SI']['EUR']['price_per_oz'],
);

$price_min = tradeboost_price_bound('price_min');
$price_max = tradeboost_price_bound('price_max');

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


$sort_orders = tradeboost_sort_orders();
$sort = tradeboost_sort_key();
$order = $sort_orders[$sort];


$products_total = $catalog->get_products($category_params, false, $order,false, false, true, false, $currency_rates);
$limit = 30;
$page = 1;
if(!empty($_GET['page'])) {
	$page = $_GET['page'];
}
// The seventh argument is $show_all_offers, not $currency_rates. Passing the
// rates there made it truthy, which skipped the offer filtering entirely: the
// offers column counted every shop ever seen, so ordering by it sorted on a
// number several times larger than the one on the card.
$products_array = $catalog->get_products($category_params, false, $order, $limit, $page, false, false, $currency_rates);

//filter and sort
$filtered_products = array();
$first_item_description = "";

if(!empty($products_array)) {
	foreach($products_array as $product) {

		// Only products that are for sale somewhere.
		if(empty($product['store_products'])) { continue; }

		$description = 'description_' . $page_language;
		if(empty($first_item_description) && !empty($product[$description])) {
			$first_item_description = $product[$description];
		}

		$product = tradeboost_prepare_product($product, $comodity_price_array, $page_currency, $translation);

		if($product !== false && $product['best_price'] > 0) {
			$filtered_products[] = $product;
		}
	}
}

$stock_only = "";

$sort_options = tradeboost_sort_options($sorting_array, $sort);

$filter_groups = tradeboost_filter_groups($catalog, $facet_counts, $selected_facets, $countries_array, $translation, $page_language);
$price_filter_labels = tradeboost_price_labels($translation, $page_language);

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

// After the switch above has built the title, not before it.
tradeboost_paginate_meta($page_meta_title, $page_meta_description, $page, $translation, $page_language);

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