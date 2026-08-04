<?php
require __DIR__ . '/../../model/catalog.php';

$page_language = COUNTRY_DEFAULT;
$page_currency  = CURRENCY_DEFAULT; //only run jobs in Euro

$catalog = new Catalog;
$db = new db;

if($job_name == "update_price_cache")
//get_products($filter_array = false, $sort = false, $order = false, $limit = false, $page = false, $total_count = false, $filter_offers_array = false,) 
$products = $catalog->get_products(false, false, false, false, false, false, array("sp.stock > 0"));
foreach ($products as $product) {

	if(!empty($product['store_products'])) {
		$first_store_product = reset($product['store_products']);
		$price = number_format($first_store_product['price'], 2, '.', '');
		echo $product['name'] . "-" . $first_store_product['price'] . "<br>";
	
	} else {
			$price = 0;
			echo $product['name'] . "-<span style='color:red'> price set to 0</span><br>";
	}

	$sql = "UPDATE pricecomp_product SET lowest_price_eur = ?, lowest_price_updated = NOW() WHERE product_id = ?";
	$result = $db->query($sql, array((float) $price, $product['product_id']));

}
?>