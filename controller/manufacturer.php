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

$catalog = new Catalog;

$manufacturer = $catalog->get_manufacturer($manufacturer_id);

$category_params = array();

if(!empty($manufacturer_id)) {
	$category_params[] = array('sql' => "p.manufacturer = ?", 'params' => array($manufacturer_id));
}

$products_array = $catalog->get_products($category_params);

//filter and sort
$filtered_products = array();
foreach($products_array as $product) {
	$show_product = true;
	//if($manufacturer_id != $product['manufacturer_id']) { $show_product  = false; }
	//if(!isset($product['store_products'])) { $show_product = false;} //only show products that are for sale somewhere
	//if(!empty($metal) && $metal != $product['metal']) { $show_product = false; }
	//if(!empty($product_type) && $product_type != $product['type']) { $show_product = false; }
	//if(!empty($_GET['quantity']) && $_GET['quantity'] != $product['quantity']) { $show_product  = false; }
	//if(!empty($_GET['metal_weight_class']) && $_GET['metal_weight_class'] != $product['metal_weight_class']) { $show_product = false; }
	

	if($show_product) {

		$first_store_product = false;
		$product['offers'] = 0;
		$product['best_price'] = 0;
		$product['best_price_per_oz'] = 0;
		$product['best_price_compare_to_spot'] = 1000000;

		if(!empty($product['store_products'])){
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

		} else {
			$product['store_products'] = false;
		}

		$product['metal_type'] = strtolower($translation['EN'][$product['metal']].$product['type']);

		$filtered_products[] = $product; 

		if(isset($_GET['stock_only'])) {
			if($_GET['stock_only'] == 1 && $product['offers'] == 0) {
				array_pop($filtered_products);
			}
		}
		
	}
	
}
$sort = false;
$column  = array_column($filtered_products, 'best_price_compare_to_spot');
$direction = SORT_ASC;

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
		default:
			$column  = array_column($filtered_products, 'best_price_compare_to_spot');
			$direction = SORT_ASC;
		}

	$sort =$_GET['sort'];
}
array_multisort($column , $direction, SORT_NUMERIC, $filtered_products);

//$manufacturers_array = $catalog->get_manufacturers();

$filter_array = $catalog->get_filter($products_array);

$options_country = "";
$options_type = "";
$options_quantity = "";
$options_manufacturer = "";
$options_weight = "";
$stock_only = "";

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