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

if(!empty($_GET['country'])) {
	$category_params['country'] = array('sql' => "p.country_origin = ?", 'params' => array($_GET['country']));
	unset($category_params['updated_price']);
	unset($category_params['only_with_offers']);
}
if(!empty($_GET['manufacturer'])) {
	$category_params['manufacturer'] = array('sql' => "p.manufacturer = ?", 'params' => array($_GET['manufacturer']));
	unset($category_params['updated_price']);
	unset($category_params['only_with_offers']);
}

if(!isset($sort_params)) { $sort_params = array(); }


$order = " offers DESC";
if(!empty($_GET['sort'])) {
	switch ($_GET['sort']) {
		case "price_low":
			$order = "p.lowest_price_eur ASC";
			break;
		case "price_high":
			$order = "p.lowest_price_eur DESC";
			break;
		case "weight_low":
			$order = "p.metal_weight_oz ASC";
			break;
		case "weight_high":
			$order = "p.metal_weight_oz DESC";
			break;
		case "best_compare_price":
			$order = "(p.lowest_price_eur/p.metal_weight_oz) ASC";
			break;
		case "most_offers":
			$order = " offers DESC";
			break;
		default:
			$order = " offers DESC";
		}
}


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
	foreach($countries_array as $key => $value) {
		$selected = "";
		if(isset($_GET['country'])) {
			if($value == $_GET['country']) { $selected = "selected"; }
		}

		$options_country .= "<option value='".$value."' ".$selected.">". $key ."</option>";
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
	//$options_weight = $translation[$page_language]['filter']['metal_weight']." <select name='metal_weight_class' id='metal_weight_class' class='form-control'><option value=''>".$translation[$page_language]['filter']['view_all']."</option>" . $options_weight . "</select>";
	$options_weight =  "";


}


if(count($manufacturers_array) > 0) {
	foreach($manufacturers_array as $key => $value) { 
		$selected = "";
		if(isset($_GET['manufacturer'])) {
			if($key == $_GET['manufacturer']) { $selected = "selected"; }
		}			$options_manufacturer .= "<option value='".$key."' ".$selected.">". $manufacturers_array[$key]['name'] ." (". $manufacturers_array[$key]['country'].")</option>";
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

if(!empty($_GET['country']) && empty($_GET['manufacturer'])) {
	$page_title .= " " . $translation[COUNTRY_DEFAULT]['country'][$_GET['country']];
	$page_description = $first_item_description;
}

if(empty($_GET['country']) && !empty($_GET['manufacturer'])) {
	$page_title .= " " . $manufacturers_array[$_GET['manufacturer']]['name'] ;
	$page_description = $manufacturers_array[$_GET['manufacturer']]['description_'.$page_language];
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