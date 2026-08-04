<?php
require __DIR__ . '/../model/catalog.php';
require __DIR__ . '/../model/commodity.php';
require __DIR__ . '/../model/ads.php';
require __DIR__ . '/../translation/translations.php';
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

$sort = "sp.price ASC,";
if(!empty($_GET['sort'])) {
	switch ($_GET['sort']) {
		case "price_low":
			$sort = "sp.price ASC,";
			break;
		case "price_high":
			$sort = "sp.price DESC,";
			break;
		case "weight_low":
			$sort = "p.metal_weight_oz ASC,";
			break;
		case "weight_high":
			$sort = "p.metal_weight_oz DESC,";
			break;
		default:
			$sort = "sp.price ASC,";
		}
}

$store = $catalog->get_product_stores(array($shop_id));
$store = reset($store);

$products_array = $catalog->get_store_products($shop_id, $sort);
$countries_array = $catalog->get_countries($category_params);
$manufacturers_array = $catalog->get_manufacturers();

//filter and sort
$filtered_products = array();
foreach($products_array as $product) {
	$show_product = true;
	if(!empty($_GET['country']) && $_GET['country'] != $product['country_origin']) { $show_product = false; }
	if(!empty($_GET['metal_weight_class']) && $_GET['metal_weight_class'] != $product['metal_weight_class']) { $show_product = false; }
	
	if($show_product) {
		$product['offers'] = (int) count($product['store_products']);
		$product['best_price'] = $product['store_products'][0]['price'];
		$product['best_price_per_oz'] = $product['store_products'][0]['price_per_oz'];
		$product['best_price_compare_to_spot'] = 100*((float) $product['best_price_per_oz'] - (float) $comodity_price_array[$product['metal']][$page_currency]['price_per_oz'])/(float) $comodity_price_array[$product['metal']][$page_currency]['price_per_oz'];

		$filtered_products[] = $product;

	}
	
}

$sort = false;

if(!empty($_GET['sort'])) {
	$sort = $_GET['sort'];	
}

$filter_array = $catalog->get_filter($products_array);

$options_country = "";
$options_type = "";
$options_quantity = "";
$options_manufacturer = "";
$options_weight = "";
$stock_only = "";

$options_sorting = "";


if(count($countries_array) > 1) {
	foreach($filter_array['country_origin'] as $key => $value) {
		$selected = "";
		if(isset($_GET['country'])) {
			if($key == $_GET['country']) { $selected = "selected"; }
		}
		$country_name = "";
		foreach($countries_array as $country => $short_name) {
			if($key == $short_name) {
				$country_name = $country;
			}
		}

		$options_country .= "<option value='".$key."' ".$selected.">". $country_name ."</option>";
	}
	$options_country = $translation[$page_language]['filter']['land']." <select name='country' id='country' class='form-control'><option value=''>".$translation[$page_language]['filter']['view_all']."</option>" . $options_country . "</select>";	
}

if(count($filter_array['metal_weight_class']) > 1) {
	foreach($filter_array['metal_weight_class'] as $key => $value) { 
		$selected = "";
		if(isset($_GET['metal_weight_class'])) {
			if($key == $_GET['metal_weight_class']) { $selected = "selected"; }
		}	
		$options_weight .= "<option value='".$key."' ".$selected.">". $translation[$page_language]['filter'][$key] ."</option>";
	}	
	$options_weight = $translation[$page_language]['filter']['metal_weight']." <select name='metal_weight_class' id='metal_weight_class' class='form-control'><option value=''>".$translation[$page_language]['filter']['view_all']."</option>" . $options_weight . "</select>";
}

if(count($filter_array['manufacturer']) > 1) {
	foreach($filter_array['manufacturer'] as $key => $value) { 
		$selected = "";
		if(isset($_GET['manufacturer'])) {
			if($key == $_GET['manufacturer']) { $selected = "selected"; }
		}			$options_manufacturer .= "<option value='".$key."' ".$selected.">". $manufacturers_array[$key]['name'] ."</option>";
	}	
	$options_manufacturer = $translation[$page_language]['filter']['manufacturer']." <select name='manufacturer' id='manufacturer' class='form-control'><option value=''>".$translation[$page_language]['filter']['view_all']."</option>" . $options_manufacturer . "</select>";
}

$selected = "";

if(isset($_GET['stock_only'])) {
	if($_GET['stock_only'] == 1) { $selected = "checked"; }
}	
$stock_only = "<input class='form-check-input' type='checkbox' value='1' id='stock_only' name='stock_only' " . $selected . " >";

//Sorting
if(count($sorting_array) > 1) {
	foreach($sorting_array as $key => $value) { 
		$selected = "";
		if($key == $sort) { $selected = "selected"; }
		$options_sorting .= "<option value='".$key."' ".$selected.">". $value ."</option>";
	}	
}


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