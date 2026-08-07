<?php
header("Content-Type: application/xml; charset=utf-8");

require __DIR__ . '/../../model/catalog.php';

$page_language = COUNTRY_DEFAULT;
$page_currency = CURRENCY_DEFAULT;

$catalog = new Catalog;

/**
 * One entry per indexable page, and only pages that are indexable: the filtered
 * listings carry noindex, so they have no business here.
 *
 * lastmod is only written where a real date exists. An invented one is worse
 * than none - every URL used to claim it changed yesterday, which tells a
 * crawler nothing except that the dates cannot be trusted.
 */
$sitemap_links = array();

function tradeboost_sitemap_add(&$links, $path, $lastmod = false) {

	$entry = array('loc' => HTTP . ltrim($path, '/'));

	// 0000-00-00 turns up in this database where a date was never filled in.
	if (!empty($lastmod) && strpos($lastmod, '0000-00-00') === false) {
		$timestamp = strtotime($lastmod);
		if ($timestamp > 0) {
			$entry['lastmod'] = date('Y-m-d', $timestamp);
		}
	}

	$links[] = $entry;
}

// Static pages and the four categories.
$static_pages = array(
	'', 'about', 'faq_coin', 'gifts',
	'price_realtime/gold', 'price_realtime/silver',
	'products/goldbars', 'products/silverbars',
	'products/goldcoins', 'products/silvercoins',
);

foreach ($static_pages as $page) {
	tradeboost_sitemap_add($sitemap_links, $page);
}

// Country pages. Every product page links to one, and they were missing.
$countries = $catalog->get_countries();
if (!empty($countries)) {
	foreach ($countries as $country_code) {
		tradeboost_sitemap_add($sitemap_links, 'country/' . $country_code);
	}
}

$stores = $catalog->get_product_stores();
if (!empty($stores)) {
	foreach ($stores as $store) {
		tradeboost_sitemap_add($sitemap_links, 'shop/' . $store['url']);
	}
}

$manufacturers = $catalog->get_manufacturers();
if (!empty($manufacturers)) {
	foreach ($manufacturers as $manufacturer) {
		tradeboost_sitemap_add($sitemap_links, 'manufacturer/' . $manufacturer['id']);
	}
}

$product_groups = $catalog->get_product_groups();
if (!empty($product_groups)) {
	foreach ($product_groups as $product_group) {
		tradeboost_sitemap_add($sitemap_links, 'group/' . $product_group['url']);
	}
}

foreach ($catalog->get_sitemap_products() as $product) {
	tradeboost_sitemap_add(
		$sitemap_links,
		'product/' . $catalog->product_url($product['product_id'], $product['name']),
		$product['lowest_price_updated']
	);
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

foreach ($sitemap_links as $entry) {
	echo "\t<url>\n";
	echo "\t\t<loc>" . htmlspecialchars($entry['loc'], ENT_XML1) . "</loc>\n";
	if (isset($entry['lastmod'])) {
		echo "\t\t<lastmod>" . $entry['lastmod'] . "</lastmod>\n";
	}
	echo "\t</url>\n";
}

echo '</urlset>';
