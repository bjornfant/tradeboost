<?php
require __DIR__ . '/../model/catalog.php';
require __DIR__ . '/../model/url.php';
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

$url = new Url;

$product_group_id = $url->get_id($product_group_url, 'product_group');
$catalog = new Catalog;

$product_group = $catalog->get_product_group($product_group_id);

$products_array = $catalog->get_group_products(array(
	array('sql' => 'p.product_group = ?', 'params' => array($product_group_id))
));

//filter and sort
$filtered_products = array();
foreach($products_array as $product) {
	$show_product = true;
	//if(!isset($product['store_products'])) { $show_product = false;} //only show products that are for sale somewhere
	/*
	if($product_group_id != $product['product_group_id']) { $show_product  = false; }
	if(!empty($metal) && $metal != $product['metal']) { $show_product = false; }
	if(!empty($product_type) && $product_type != $product['type']) { $show_product = false; }
	if(!empty($_GET['quantity']) && $_GET['quantity'] != $product['quantity']) { $show_product  = false; }
	*/

	if(!empty($_GET['metal_weight_class']) && $_GET['metal_weight_class'] != $product['metal_weight_class']) { $show_product = false; }

	if($show_product) {

		$first_store_product = reset($product['store_products']);

		$product['offers'] = (int) count($product['store_products']);
		
		if(isset($_GET['stock_only'])) {
			if($_GET['stock_only'] == 1) {
				$first_store_product = reset($product['store_products_in_stock']);
				$product['offers'] = (int) count($product['store_products_in_stock']);
			}
		} 

		if($product['offers'] < 1) { 
			$product['offers'] = 0; 
			$first_store_product['price'] = 0;
			$first_store_product['price_per_oz'] = 0;
		}

		$product['best_price'] = $first_store_product['price'];
		$product['best_price_per_oz'] = $first_store_product['price_per_oz'];
		$product['best_price_compare_to_spot'] = 100*((float) $product['best_price_per_oz'] - (float) $comodity_price_array[$product['metal']][$page_currency]['price_per_oz'])/(float) $comodity_price_array[$product['metal']][$page_currency]['price_per_oz'];

		$product['metal_type'] = strtolower($translation['EN'][$product['metal']].$product['type']);

		if($_GET['stock_only'] == 1) {
			if((int) count($product['store_products_in_stock']) > 0) {
				$filtered_products[] = $product; 
			}
		} else {
			$filtered_products[] = $product; 
		}

		
	}
	
}
$sort = false;
$column  = array_column($filtered_products, 'offers');
$direction = SORT_DESC;

if(!empty($_GET['sort'])) {
	$column = false;
	switch ($_GET['sort']) {
		case "price_low":
			$column  = array_column($filtered_products, 'best_price');
			$direction = SORT_ASC;
			break;
		case "price_high":
			$column  = array_column($filtered_products, 'best_price');
			$direction = SORT_DESC;
			break;
		case "weight_low":
			$column  = array_column($filtered_products, 'metal_weight_oz');
			$direction = SORT_ASC;
			break;
		case "weight_high":
			$column  = array_column($filtered_products, 'metal_weight_oz');
			$direction = SORT_DESC;
			break;
		case "best_compare_price":
			$column  = array_column($filtered_products, 'best_price_compare_to_spot');
			$direction = SORT_ASC;
			break;
		case "most_offers":
			$column  = array_column($filtered_products, 'offers');
			$direction = SORT_DESC;
			break;
		default:
			$column  = array_column($filtered_products, 'offers');
			$direction = SORT_DESC;
		}

	$sort = $_GET['sort'];
}
array_multisort($column , $direction, SORT_NUMERIC, $filtered_products);

//$product_groups_array = $catalog->get_product_groups();

$filter_array = $catalog->get_filter($products_array);

$options_country = "";
$options_type = "";
$options_quantity = "";
$options_product_group = "";
$stock_only = "";
$options_weight = "";

$options_sorting = "";

if(count($filter_array['metal_weight_class']) > 1) {
	foreach($filter_array['metal_weight_class'] as $key => $value) { 
		$selected = "";
		if(isset($_GET['metal_weight_class'])) {
			if($key == $_GET['metal_weight_class']) { 
				$selected = "selected"; 
			}
		}
		$options_weight .= "<option value='".$key."' ".$selected.">". $translation[$page_language]['filter'][$key] ."</option>";
	}	
	$options_weight = $translation[$page_language]['filter']['metal_weight']." <select name='metal_weight_class' id='metal_weight_class' class='form-control'><option value=''>".$translation[$page_language]['filter']['view_all']."</option>" . $options_weight . "</select>";
}

$selected = "";
if (isset($_GET['stock_only'])) {
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