<?php
header ("Content-Type:text/xml");

require __DIR__ . '/../../model/catalog.php';

$page_language = COUNTRY_DEFAULT;
$page_currency  = CURRENCY_DEFAULT;

$catalog = new Catalog;
$products = $catalog->get_products();
$product_groups = $catalog->get_product_groups();
$manufacturers = $catalog->get_manufacturers();
$stores = $catalog->get_product_stores();

$sitemap_links = array("","about","price_realtime/gold","price_realtime/silver","products/goldbars", "products/silverbars", "products/goldcoins", "products/silvercoins", "faq_coin");

foreach ($stores as $store) {
	$sitemap_links[]  = "shop/" . $store['url'];
}
foreach ($manufacturers as $manufacturer) {
	$sitemap_links[]  = "manufacturer/" . $manufacturer['id'];
}
foreach ($products as $product) {
	$sitemap_links[]  = "product/" . $product['url'];
}
foreach ($product_groups as $product_group) {
	$sitemap_links[]  = "group/" . $product_group['url'];
}


$xml_string = "";

foreach ($sitemap_links as $link) {
	$xml_string .= "
	<url>
	    <loc>".HTTP . $link ."</loc>
	    <lastmod>".date("Y-m-d", strtotime("-1 day"))."</lastmod>
  	</url>";
}

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
echo $xml_string;
echo '</urlset>';
?>