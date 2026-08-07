<?php
//error_reporting(E_ALL);
require __DIR__ . '/../model/catalog.php';
require __DIR__ . '/../model/commodity.php';
require __DIR__ . '/../model/ads.php';
require __DIR__ . '/../model/marketplace.php';
require __DIR__ . '/../translation/translations.php';
require __DIR__ . '/../model/statistics.php';
$db = new db;

$catalog = new Catalog;
$marketplace = new Marketplace;
$price_array = new Commodity;


if(strlen($product_id) > 6) {
	$product_id = $catalog->get_product_by_old_id($product_id);
	$product = $catalog->get_product($product_id);

	//echo HTTP . "product/". $product['url'];

  	header("HTTP/1.1 301 Moved Permanently");  
	header("Location: ". HTTP . "product/". $product['url']);  
	header("Connection: close"); 	

}


$page_view = new Statistic;
$page_view->track_pageview(HTTP);

$page_language = COUNTRY_DEFAULT;
$page_currency  = CURRENCY_DEFAULT;

$filter = false;
$product = false;

$ad_inventory['left'] = gererate_adsense_html(HTTP, 'left');		
$ad_inventory['middle'] = gererate_adsense_html(HTTP, 'middle');	
$ad_inventory['right'] = gererate_adsense_html(HTTP, 'right');



$comodity_price_array = array();
$comodity_price_array['AU'] = $price_array->get_commodity_price('AU');
$comodity_price_array['SI'] = $price_array->get_commodity_price('SI');



if($product_id) {
	$product = $catalog->get_product($product_id);

	$products_grouped_by_store_array = array();
	$product_store_array = array();

	if(!empty($product['store_products'])) {
		foreach($product['store_products'] as $store_product) {
			$product_store_array[$store_product['store_id']] = $store_product['store_id'];
			$products_grouped_by_store_array[$store_product['store_id']]['products'][] = $store_product;

			if(!isset($products_grouped_by_store_array[$store_product['store_id']]['lowest_price'])) {
				$products_grouped_by_store_array[$store_product['store_id']]['lowest_price'] = $store_product['price'];
			} else {
				if($products_grouped_by_store_array[$store_product['store_id']]['lowest_price'] > $store_product['price']) {
					$products_grouped_by_store_array[$store_product['store_id']]['lowest_price'] = $store_product['price'];
				}
			}

		}
	}

	array_multisort($products_grouped_by_store_array, SORT_ASC, SORT_NUMERIC, array_column($products_grouped_by_store_array, 'lowest_price'));

	//get all stores
	$store_array = array();
	$store_array = $catalog->get_product_stores(array_unique($product_store_array));

}


if(!empty($products_grouped_by_store_array[0])) {
	$lowest_price_product = $products_grouped_by_store_array[0];
}
if(isset($lowest_price_product['lowest_price'])) {
	$lowest_price = $catalog->format_money($lowest_price_product['lowest_price'], $page_currency);
} else {
	$lowest_price = $catalog->format_money($product['metal_weight_oz'] * (float) $comodity_price_array[$product['metal']][$page_currency]['price_per_oz'], $page_currency);
}

if($product['metal'] == 'AU') {
	if($product['fineness'] == '999.9') { $product['fineness'] = $product['fineness'] . " (24K)"; }
	if($product['fineness'] == '916.67') { $product['fineness'] = $product['fineness'] . " (22K)"; }
	if($product['fineness'] == '750') { $product['fineness'] = $product['fineness'] . " (18K)"; }	
}

$metal_value = $catalog->format_money($product['metal_weight_oz']*$comodity_price_array[$product['metal']][$page_currency]['price_per_oz'],$page_currency,2); 

//$product_description  = str_replace("\n", "<br>", $product['description_' . $page_language]);
$product_description = nl2br($product['description_' . $page_language]);

//AI translation emrbyo code
/*
require __DIR__ . '/../model/translate.php';
$product_ai_translation = new Translation;
$translated_product_description = $product_ai_translation->translate($product_description,"english", "swedish"); 
if($translated_product_description['success'] == 1) {
	$product_description = $translated_product_description['translated_text'];
}
*/
$schema_org_faqpage = array();

$cannonical = HTTP . "product/" .  $product['url'];

$category_cannonical = HTTP . strtolower("products/" .  $translation['EN'][$product['metal']].$product['type']."s");


//page title and description
switch ($page_language) {
	case "SE":
		$page_title = ucfirst($translation[$page_language][$product['metal'].$product['type']] . " " .  $product['name']);
		$page_meta_title = $page_title . ". Pris från " . $lowest_price . "";
		$page_meta_description = $page_title . " - " . $lowest_price . " lägsta pris online just nu. Aktuella priser på " .$translation[$page_language][$product['metal'].$product['type']] . " " .  $product['name'] . ". Hitta billigaste onlinebutik i Europa. Se även spotpris per produkt!";

		$schema_org_faqpage[] = array(
			"question" => "Vad är ".  $product['name'] . " " . strtolower($translation[$page_language][$product['metal'].$product['type']]). " värd?",
			"answer" => "Med dagens " . $translation[$page_language][$product['metal']] . "pris är värdet minst " . $metal_value ." för ". $product['name'] . ". Utöver värdet för ädelmetallen lägger säljaren på en försäljningsmarginal (premium) och eventuellt samlarvärde."
		);		
		if (!empty($product['fineness']) && $product['metal'] == "AU" && $product['type'] == "coin") {
			$schema_org_faqpage[] = array(
				"question" => "Hur mycket guld finns det i  ".  $product['name'] . "?",
				"answer" => $product['name'] . " har en renhet på " . $product['fineness'] . " och mängden rent guld i myntet är " . $catalog->format_weight($product['metal_weight_oz'],'oz') . " (" . $catalog->format_weight($product['metal_weight_gram'],'gram') . ")."
			);	
		} 
		if (!empty($product['diameter'])) { 
			$schema_org_faqpage[] = array(
				"question" => "Vad har ".  $product['name'] . " " . strtolower($translation[$page_language][$product['metal'].$product['type']]). " för diameter?",
				"answer" => $product['name'] . " har en diameter på " . $product['diameter'] . " millimeter."
			);	
		} 
		break;
	case "DE":
		$page_title = ucfirst($translation[$page_language][$product['metal'].$product['type']] . " " .  $product['name']);
		$page_meta_title =  "Preisvergleich: " . $page_title . " " . $lowest_price. " niedrigster jetzt: ";
		$page_meta_description = $translation[$page_language][$product['metal'].$product['type']] . " " .  $product['name'] . " aus " . $translation[$page_language]['country'][$product['country_origin']] . ". Niedrigster aktueller Preis " . $lowest_price . " von Online-Shops. Vergleichen Sie aktualisierte Preise und finden Sie online den günstigsten europäischen Anbieter.";
		$schema_org_faqpage[] = array(
			"question" => "Was kostet ".  $product['name'] . " " . $translation[$page_language][$product['metal'].$product['type']]. "?",
			"answer" => "Beim heutigen ".ucfirst($translation[$page_language][$product['metal']]) . "preis ist " . $product['name'] . " " . $metal_value . " wert. Zum Wert des Edelmetalls addiert der Verkäufer eine Verkaufsmarge (Premium) und einen möglichen Sammlerwert."
		);		
			break;
	case "FR":
		$page_title = ucfirst($translation[$page_language][$product['metal'].$product['type']] . " " .  $product['name']);
		$page_meta_title = $page_title . " - Meilleur prix en ligne: " . $lowest_price;
		$page_meta_description = $translation[$page_language][$product['metal'].$product['type']] . " " .  $product['name'] . " de " . $translation[$page_language]['country'][$product['country_origin']] . ". Prix actuel le plus bas " . $lowest_price . " online. Comparez les prix mis à jour et trouvez le fournisseur européen le moins cher en ligne.";			
			break;
	case "NL":
		$page_title = ucfirst($translation[$page_language][$product['metal'].$product['type']] . " " .  $product['name']);
		$page_meta_title = $page_title . " - Beste prijs online: " . $lowest_price;
		$page_meta_description = $translation[$page_language][$product['metal'].$product['type']] . " " .  $product['name'] . " uit " . $translation[$page_language]['country'][$product['country_origin']] . ". Laagste huidige prijs " . $lowest_price . " online. Vergelijk bijgewerkte prijzen en vind online de goedkoopste Europese leverancier.";			
			break;
	case "ES":
		$page_title = ucfirst($translation[$page_language][$product['metal'].$product['type']] . " " .  $product['name']);
		$page_meta_title = $page_title . " - El precio más bajo: " . $lowest_price;
		$page_meta_description = $translation[$page_language][$product['metal'].$product['type']] . " " .  $product['name'] . " de " . $translation[$page_language]['country'][$product['country_origin']] . ". El precio más bajo " . $lowest_price . " . Encuentre el proveedor europeo de oro y plata más barato en línea.";			
			break;
	default:
		$page_title = ucfirst($translation[$page_language][$product['metal'].$product['type']] . " " .  $product['name']);
		$page_meta_title = $page_title . " - Lowest price: " . $lowest_price;
		$page_meta_description = "Compare prices on ". $translation[$page_language][$product['metal'].$product['type']] . " " .  $product['name'] . " from " . $translation[$page_language]['country'][$product['country_origin']] . ". " . $lowest_price . " is currently the lowest price we have found. Follow updated prices and find the cheapest European supplier online.";
		$schema_org_faqpage[] = array(
			"question" => "What is ".  $product['name'] . " " . strtolower($translation[$page_language][$product['metal'].$product['type']]). " worth?",
			"answer" => $product['name'] . " is worth at least " . $metal_value ." according to the ". $translation[$page_language][$product['metal']] . " spot price. The seller also applies a sales margin (premium) and collectible items are more expensive."
		);		
		if (!empty($product['fineness']) && $product['metal'] == "AU" && $product['type'] == "coin") {
			$schema_org_faqpage[] = array(
				"question" => "What is the amount of gold in ".  $product['name'] . "?",
				"answer" => $product['name'] . " has a fineness of " . $product['fineness'] . " and the amount of pure gold is " . $catalog->format_weight($product['metal_weight_oz'],'oz') . " (" . $catalog->format_weight($product['metal_weight_gram'],'gram') . ")."
			);	
		} 
		if (!empty($product['diameter'])) { 
			$schema_org_faqpage[] = array(
				"question" => "What's the diameter of ".  $product['name'] . " " . strtolower($translation[$page_language][$product['metal'].$product['type']]). "?",
				"answer" => $product['name'] . " has a diameter of " . $product['diameter'] . " millimeter."
			);	
		} 

}


if(!empty($schema_org_faqpage)) {
	$faq = "<h3>FAQ</h3>";
	foreach($schema_org_faqpage as $question) {
		$faq .= "<h4>".$question['question']."</h4><p>" . $question['answer'] . "</p>";
	}

	$product_description = $faq . "<hr>" . $product_description;

}




$og_tags = array();
/**
 * Product with AggregateOffer. This is a comparison page - the same coin from a
 * dozen shops - so the aggregate is the honest shape: a price range and a
 * count, with each shop listed beneath it as its own offer.
 *
 * Prices are written as strings with a decimal point. Casting a float to string
 * follows the locale before PHP 8, and config.php sets a Swedish one, so a
 * price would otherwise reach the markup as "1 234,50".
 */
$schema_org_product = array();

if(!empty($product['store_products'])) {

	$offer_prices = array();
	$schema_offers = array();

	/**
	 * Every offer counts towards the range and the total, but only the cheapest
	 * few are written out. All 264 of them on a Krugerrand came to 65 kB, 13% of
	 * the page, and the aggregate is what a search result reads anyway.
	 * store_products arrives sorted by price, so these are the cheapest.
	 */
	$schema_offer_limit = 25;
	$schema_offer_count = 0;

	foreach($product['store_products'] as $store_product) {

		$price = (float) $store_product['price'];
		if($price <= 0) { continue; }

		$offer_prices[] = $price;
		$schema_offer_count++;

		if(count($schema_offers) >= $schema_offer_limit) { continue; }

		$schema_offers[] = array(
			'@type'         => 'Offer',
			'url'           => $store_product['url'],
			'price'         => number_format($price, 2, '.', ''),
			'priceCurrency' => $page_currency,
			'availability'  => (!empty($store_product['stock']) && $store_product['stock'] == 1)
				? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
			'seller'        => array('@type' => 'Organization', 'name' => $store_product['store_name']),
		);
	}

	if(!empty($offer_prices)) {

		$schema_org_product = array(
			'@context'    => 'https://schema.org',
			'@type'       => 'Product',
			'name'        => $page_title,
			'description' => trim(strip_tags($page_meta_description)),
			'url'         => $cannonical,
			'offers'      => array(
				'@type'         => 'AggregateOffer',
				'priceCurrency' => $page_currency,
				'lowPrice'      => number_format(min($offer_prices), 2, '.', ''),
				'highPrice'     => number_format(max($offer_prices), 2, '.', ''),
				'offerCount'    => $schema_offer_count,
				'offers'        => $schema_offers,
			),
		);

		if(!empty($product['product_image'])) {
			$schema_org_product['image'] = 'https://tradeboost.imgix.net/' . $product['product_image'] . '?w=500&h=500';
		}

		if(!empty($product['manufacturer_name'])) {
			$schema_org_product['brand'] = array('@type' => 'Brand', 'name' => $product['manufacturer_name']);
		}

		if(!empty($product['country_origin']) && !empty($translation[$page_language]['country'][$product['country_origin']])) {
			$schema_org_product['countryOfOrigin'] = $translation[$page_language]['country'][$product['country_origin']];
		}

		if(!empty($product['metal_weight_oz']) && $product['metal_weight_oz'] > 0) {
			$schema_org_product['weight'] = array(
				'@type'    => 'QuantitativeValue',
				'value'    => number_format((float) $product['metal_weight_oz'], 6, '.', ''),
				'unitCode' => 'APZ', // troy ounce
			);
		}
	}
}

$og_tags[] = array('property' => 'og:title', 'content' => $page_meta_title);
$og_tags[] = array('property' => 'og:description', 'content' => $page_meta_description);
$og_tags[] = array('property' => 'og:type', 'content' => 'website');	
$og_tags[] = array('property' => 'og:url', 'content' => $cannonical);		
if(!empty($product['product_image'])) { 
	$og_tags[] = array('property' => 'og:image', 'content' => 'https://tradeboost.imgix.net/' . $product['product_image'] . '?w=500&h=500');		
} 

//error_log("product page loaded: " . $product['name']. " | user agent: " . $_SERVER['HTTP_USER_AGENT']);

$tradera_products = false;
if(HTTP == 'https://tradeboost.se/' && strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "bot") == false) {
	$tradera_products = $marketplace->get_tradera_products($product['name'], $translation[$page_language][$product['metal']]);
	$ad_inventory['middle_first'] = gererate_html_ad(HTTP, 'middle');				
	error_log("tradera products loaded on page:" . $cannonical . " | user agent: " . $_SERVER['HTTP_USER_AGENT']);
}

$ebay_products = false;
if(HTTP == 'https://trade-boost.de/' || HTTP == 'https://tradeboost.at/' || HTTP == 'https://tradeboost.fr/' || HTTP == 'https://tradeboost.ch/' || HTTP == 'https://tradeboost.nl/') {
	//if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "bot") == false) { //don't do api-calls on scrapers
		$ebay_products =  $marketplace->get_ebay_products($translation[$page_language][$product['metal']], $product['name']);
		$ad_inventory['middle_first'] = gererate_html_ad(HTTP, 'middle');				
	//}
}
if(HTTP == 'https://trade-boost.co.uk/') {
	$ebay_products =  $marketplace->get_ebay_products($translation[$page_language][$product['metal']], $product['name']);
	$ad_inventory['middle_first'] = gererate_html_ad(HTTP, 'middle');					
}
if(HTTP == 'http://tradeboost:8888/') {
		$ebay_products =  false;//$marketplace->get_ebay_products($translation[$page_language][$product['metal']], $product['name']);
}

//get related products
$category_params = array();
$category_params['type'] = array('sql' => "p.type = ?", 'params' => array($product['type']));
$category_params['metal'] = array('sql' => "p.metal = ?", 'params' => array($product['metal']));
$category_params['country'] = array('sql' => "p.country_origin = ?", 'params' => array($product['country_origin']));
$limit = 6;
if(count($store_array) < 6){
	$limit = count($store_array)+3;
}

$order = " offers DESC";
$related_products_array = $catalog->get_products($category_params, false, $order, $limit, 1, false, false);

//check if any ar for sale
$unavailable = true;
foreach($related_products_array as $related_product) {
	if(!empty($related_product['store_products'])) {
		$unavailable = false;
	}
}

if($unavailable) {
	unset($category_params['country']);
	$category_params['weight'] = array(
		'sql' => "p.metal_weight_oz > ? * 0.8  AND p.metal_weight_oz < ? * 1.1",
		'params' => array((float) $product['metal_weight_oz'], (float) $product['metal_weight_oz'])
	);
	$related_products_array = $catalog->get_products($category_params, false, $order, $limit, 1, false, false);
}

//filter and sort
$related_products = array();
if(!empty($related_products_array)) {
	foreach($related_products_array as $related_product) {
		$show_product = true;
		if(empty($related_product['store_products'])) { $show_product = false;} //only show products that are for sale somewhere

		if($show_product && $related_product['product_id'] != $product_id) {
			$first_store_product = reset($related_product['store_products']);
			$related_product['offers'] = (int) count($related_product['store_products']);
			$related_product['best_price'] = $first_store_product['price'];
			$related_product['best_price_per_oz'] = $first_store_product['price_per_oz'];
			$related_product['best_price_compare_to_spot'] = 100*((float) $related_product['best_price_per_oz'] - (float) $comodity_price_array[$related_product['metal']][$page_currency]['price_per_oz'])/(float) $comodity_price_array[$related_product['metal']][$page_currency]['price_per_oz'];

			$related_product['metal_type'] = strtolower($translation['EN'][$related_product['metal']].$related_product['type']);

			if($first_store_product['price'] > 0) {
				$related_products[] = $related_product; 
			}
			if(empty($first_item_description) && strlen($related_product['description_' . $page_language])>0) {
				$first_item_description = $related_product['description_' . $page_language];
			}
		}
	}	
}




$sponsored_capsule_link = "";
if(!empty($product['diameter'])) {
	$sponsored_capsule_link = gererate_amazon_capsule_link(HTTP, $product['diameter']);
}


$view_name = "product";
require_once(BASE_DIR . '/view/base.view.php');

?>
