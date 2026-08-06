<?php
/**
 * Shared filter and sort handling for the product listings.
 *
 * product_list paginates in SQL, so it applies the filters there and counts the
 * facets with a separate query. The shop, manufacturer and product group pages
 * fetch their whole set in one go, so they filter and count over that array
 * instead - the counts are exact either way because neither counts off a page.
 *
 * The facet rows are built from the price shown on the card, so a premium
 * bracket on a shop page describes that shop's price rather than the market's.
 */

/**
 * Filters are multi-select, so every value arrives as an array. Anything that
 * is not a plain scalar is dropped rather than passed on to the query.
 */
function tradeboost_filter_values($key) {

	if(!isset($_GET[$key])) { return array(); }

	$values = array();

	foreach((array) $_GET[$key] as $value) {
		if(is_scalar($value) && (string) $value !== '') { $values[] = (string) $value; }
	}

	return array_values(array_unique($values));
}

function tradeboost_filter_label($translation, $language, $key, $fallback) {

	if(isset($translation[$language]['filter'][$key])) { return $translation[$language]['filter'][$key]; }
	if(isset($translation['EN']['filter'][$key])) { return $translation['EN']['filter'][$key]; }

	return $fallback;
}

/**
 * Query keys that narrow or reorder a listing without producing a page worth
 * ranking on its own. "page" is deliberately absent: paginated pages carry
 * content that exists nowhere else and stay indexable with their own canonical.
 *
 * metal and type are absent too. They scope a country page to a category, every
 * product page links to one, and the result reads as its own listing rather
 * than a filtered view.
 */
function tradeboost_filter_query_keys() {
	return array(
		'country', 'manufacturer', 'weight', 'premium',
		'price_min', 'price_max', 'sort', 'stock_only',
		'metal_weight_class',
	);
}

function tradeboost_has_active_filters() {

	foreach(tradeboost_filter_query_keys() as $key) {

		if(!isset($_GET[$key])) { continue; }

		$value = $_GET[$key];

		if(is_array($value)) {
			if(!empty($value)) { return true; }
			continue;
		}

		if((string) $value !== '') { return true; }
	}

	return false;
}

/**
 * The address the unfiltered version of the current page lives at.
 *
 * A few keys survive into the canonical because they define which listing this
 * is rather than narrowing one: metal and type scope a country page to a
 * category, and page 2 has to point at itself rather than at page 1. Everything
 * in tradeboost_filter_query_keys() is dropped.
 */
function tradeboost_canonical_url() {

	$url = rtrim(HTTP, '/') . strtok($_SERVER['REQUEST_URI'], '?');
	$query = array();

	foreach(array('metal', 'type') as $key) {
		if(!empty($_GET[$key]) && is_scalar($_GET[$key])) {
			$query[$key] = (string) $_GET[$key];
		}
	}

	if(!empty($_GET['page']) && (int) $_GET['page'] > 1) {
		$query['page'] = (int) $_GET['page'];
	}

	if(!empty($query)) {
		$url .= '?' . http_build_query($query);
	}

	return $url;
}

function tradeboost_selected_facets() {
	return array(
		'metal'        => tradeboost_filter_values('metal'),
		'type'         => tradeboost_filter_values('type'),
		'country'      => tradeboost_filter_values('country'),
		'manufacturer' => tradeboost_filter_values('manufacturer'),
		'weight'       => tradeboost_filter_values('weight'),
		'premium'      => tradeboost_filter_values('premium'),
	);
}

/**
 * Printing a float follows LC_NUMERIC before PHP 8, and config.php sets a
 * Swedish locale, so a price of 100.5 would be written into the form field as
 * "100,5" - which a number input rejects, silently emptying the box.
 */
function tradeboost_decimal($value) {

	if ($value === false || $value === null || $value === '') { return ''; }

	$formatted = rtrim(rtrim(number_format((float) $value, 6, '.', ''), '0'), '.');

	return ($formatted === '' || $formatted === '-') ? '0' : $formatted;
}

function tradeboost_price_bound($key) {

	if(isset($_GET[$key]) && is_scalar($_GET[$key]) && $_GET[$key] !== '') {
		return (float) $_GET[$key];
	}

	return false;
}

function tradeboost_price_to_eur($catalog, $currency, $value, $currency_rates) {

	if($value === false) { return false; }

	$converted = $catalog->convert_currency($currency, 'EUR', $value, $currency_rates);

	// An unsupported currency pair would otherwise drop the filter entirely.
	return ($converted === false) ? $value : $converted;
}

/**
 * The four sorts the listings offer. The map doubles as the whitelist, so
 * anything else falls back to the default rather than reaching the query.
 */
function tradeboost_sort_orders() {
	return array(
		'price_low'   => 'p.lowest_price_eur ASC',
		'price_high'  => 'p.lowest_price_eur DESC',
		'weight_low'  => 'p.metal_weight_oz ASC',
		'weight_high' => 'p.metal_weight_oz DESC',
	);
}

function tradeboost_sort_key() {

	$orders = tradeboost_sort_orders();

	if(!empty($_GET['sort']) && is_scalar($_GET['sort']) && isset($orders[$_GET['sort']])) {
		return (string) $_GET['sort'];
	}

	return 'price_low';
}

function tradeboost_sort_options($sorting_array, $sort) {

	$options = array();

	foreach(tradeboost_sort_orders() as $key => $ignored) {
		$options[] = array(
			'value'    => $key,
			'label'    => isset($sorting_array[$key]) ? $sorting_array[$key] : $key,
			'selected' => ($key == $sort),
		);
	}

	return $options;
}

/**
 * Sorts on the values the card actually shows, so the order on a shop page
 * follows that shop's price rather than the market's lowest.
 */
function tradeboost_sort_products($products, $sort) {

	if(empty($products)) { return $products; }

	switch($sort) {
		case 'price_high':
			usort($products, 'tradeboost_compare_price_desc');
			break;
		case 'weight_low':
			usort($products, 'tradeboost_compare_weight_asc');
			break;
		case 'weight_high':
			usort($products, 'tradeboost_compare_weight_desc');
			break;
		default:
			usort($products, 'tradeboost_compare_price_asc');
	}

	return $products;
}

function tradeboost_compare_numbers($a, $b) {
	if($a == $b) { return 0; }
	return ($a < $b) ? -1 : 1;
}

function tradeboost_compare_price_asc($a, $b) {
	return tradeboost_compare_numbers((float) $a['best_price'], (float) $b['best_price']);
}

function tradeboost_compare_price_desc($a, $b) {
	return tradeboost_compare_numbers((float) $b['best_price'], (float) $a['best_price']);
}

function tradeboost_compare_weight_asc($a, $b) {
	return tradeboost_compare_numbers((float) $a['metal_weight_oz'], (float) $b['metal_weight_oz']);
}

function tradeboost_compare_weight_desc($a, $b) {
	return tradeboost_compare_numbers((float) $b['metal_weight_oz'], (float) $a['metal_weight_oz']);
}

/**
 * count_facets() reads lowest_price_eur, so the displayed price is mapped onto
 * that key. Spot must then be given in the same currency as the card.
 */
function tradeboost_facet_rows($products) {

	$rows = array();

	if(empty($products)) { return $rows; }

	foreach($products as $product) {
		$rows[] = array(
			'metal'            => isset($product['metal']) ? $product['metal'] : '',
			'type'             => isset($product['type']) ? $product['type'] : '',
			'country_origin'   => isset($product['country_origin']) ? $product['country_origin'] : '',
			'manufacturer'     => isset($product['manufacturer']) ? $product['manufacturer'] : '',
			'metal_weight_oz'  => isset($product['metal_weight_oz']) ? $product['metal_weight_oz'] : 0,
			'lowest_price_eur' => isset($product['best_price']) ? $product['best_price'] : 0,
		);
	}

	return $rows;
}

/**
 * Works out the numbers every listing shows on a card: how many offers there
 * are, the best price and how far that sits above spot. Returns false when the
 * in-stock box is ticked and the product has no offer in stock.
 *
 * All four listings derived these the same way, in four near-identical loops.
 */
function tradeboost_prepare_product($product, $comodity_price_array, $page_currency, $translation) {

	$offers = isset($product['store_products']) ? $product['store_products'] : array();

	$in_stock_only = (!empty($_GET['stock_only']) && $_GET['stock_only'] == 1);

	if($in_stock_only && isset($product['store_products_in_stock'])) {
		$offers = $product['store_products_in_stock'];
	}

	$product['offers'] = (int) count($offers);

	$first_offer = reset($offers);

	if($product['offers'] < 1 || empty($first_offer)) {
		$product['offers'] = 0;
		$product['best_price'] = 0;
		$product['best_price_per_oz'] = 0;
	} else {
		$product['best_price'] = $first_offer['price'];
		$product['best_price_per_oz'] = isset($first_offer['price_per_oz']) ? $first_offer['price_per_oz'] : 0;
	}

	$spot = 0;
	if(!empty($comodity_price_array[$product['metal']][$page_currency]['price_per_oz'])) {
		$spot = (float) $comodity_price_array[$product['metal']][$page_currency]['price_per_oz'];
	}

	$product['best_price_compare_to_spot'] = 0;
	if($spot > 0) {
		$product['best_price_compare_to_spot'] = 100 * (((float) $product['best_price_per_oz'] - $spot) / $spot);
	}

	if(isset($translation['EN'][$product['metal']])) {
		$product['metal_type'] = strtolower($translation['EN'][$product['metal']] . $product['type']);
	}

	if($in_stock_only && $product['offers'] == 0) {
		return false;
	}

	return $product;
}

/**
 * The price range narrows what the facets are counted from, mirroring how
 * product_list keeps it among the base constraints: it is a range input with no
 * counts of its own, so it must not be excluded from its own tally.
 */
function tradeboost_price_filtered($products, $price_min, $price_max) {

	if(empty($products) || ($price_min === false && $price_max === false)) { return $products; }

	$kept = array();

	foreach($products as $product) {
		$price = isset($product['best_price']) ? (float) $product['best_price'] : 0;
		if($price_min !== false && $price < $price_min) { continue; }
		if($price_max !== false && $price > $price_max) { continue; }
		$kept[] = $product;
	}

	return $kept;
}

function tradeboost_product_matches($catalog, $product, $selected, $spot_prices, $price_min, $price_max) {

	$row = array(
		'metal'            => isset($product['metal']) ? $product['metal'] : '',
		'metal_weight_oz'  => isset($product['metal_weight_oz']) ? $product['metal_weight_oz'] : 0,
		'lowest_price_eur' => isset($product['best_price']) ? $product['best_price'] : 0,
	);

	$price = (float) $row['lowest_price_eur'];

	if($price_min !== false && $price < $price_min) { return false; }
	if($price_max !== false && $price > $price_max) { return false; }

	if(!empty($selected['metal'])) {
		if(!in_array((string) $product['metal'], $selected['metal'])) { return false; }
	}

	if(!empty($selected['type'])) {
		if(!in_array((string) $product['type'], $selected['type'])) { return false; }
	}

	if(!empty($selected['country'])) {
		if(!in_array((string) $product['country_origin'], $selected['country'])) { return false; }
	}

	if(!empty($selected['manufacturer'])) {
		if(!in_array((string) $product['manufacturer'], $selected['manufacturer'])) { return false; }
	}

	if(!empty($selected['weight'])) {
		$denomination = $catalog->denomination_key($row['metal_weight_oz']);
		if($denomination === false || !in_array($denomination, $selected['weight'])) { return false; }
	}

	if(!empty($selected['premium'])) {
		$bracket = $catalog->premium_bracket_key($row, $spot_prices);
		if($bracket === false || !in_array($bracket, $selected['premium'])) { return false; }
	}

	return true;
}

/**
 * An option is kept when it still matches something, or when it is already
 * ticked - otherwise unticking your own selection would be impossible.
 */
function tradeboost_filter_groups($catalog, $facet_counts, $selected, $countries_array, $translation, $language, $order = null) {

	$groups = array();

	/**
	 * Metal and type are built from whatever the data holds rather than from a
	 * fixed list, so a third metal starts appearing on its own once products
	 * carry it. The preferred order just puts the familiar ones first; anything
	 * unrecognised follows in count order.
	 *
	 * Nothing ticked means nothing is excluded, which is how the other facets
	 * behave too - an untouched sidebar shows gold and silver, coins and bars.
	 */
	$groups['metal'] = tradeboost_value_group(
		'metal', tradeboost_filter_label($translation, $language, 'metal', 'Metal'),
		isset($facet_counts['metal']) ? $facet_counts['metal'] : array(),
		$selected['metal'], array('AU', 'SI'),
		$translation, $language, array()
	);

	$groups['type'] = tradeboost_value_group(
		'type', tradeboost_filter_label($translation, $language, 'product_type', 'Type'),
		isset($facet_counts['type']) ? $facet_counts['type'] : array(),
		$selected['type'], array('coin', 'bar'),
		$translation, $language, array('coin' => 'coins', 'bar' => 'bars')
	);

	$country_options = array();
	if(!empty($countries_array)) {
		foreach($countries_array as $country_name => $country_code) {
			$count = isset($facet_counts['country'][$country_code]) ? $facet_counts['country'][$country_code] : 0;
			$checked = in_array((string) $country_code, $selected['country']);
			if($count == 0 && !$checked) { continue; }
			$country_options[] = array('value' => $country_code, 'label' => $country_name, 'count' => $count, 'checked' => $checked);
		}
	}
	if(count($country_options) > 1) {
		$groups['country'] = array(
			'name'    => 'country',
			'label'   => tradeboost_filter_label($translation, $language, 'land', 'Country'),
			'options' => $country_options,
		);
	}

	$weight_options = array();
	foreach($catalog->weight_denominations() as $denomination_key => $denomination) {
		$count = isset($facet_counts['weight'][$denomination_key]) ? $facet_counts['weight'][$denomination_key] : 0;
		$checked = in_array($denomination_key, $selected['weight']);
		if($count == 0 && !$checked) { continue; }
		$weight_options[] = array(
			'value'   => $denomination_key,
			'label'   => $catalog->denomination_label($denomination),
			'count'   => $count,
			'checked' => $checked,
		);
	}
	if(isset($facet_counts['weight']['other']) || in_array('other', $selected['weight'])) {
		$weight_options[] = array(
			'value'   => 'other',
			'label'   => tradeboost_filter_label($translation, $language, 'weight_other', 'Other weights'),
			'count'   => isset($facet_counts['weight']['other']) ? $facet_counts['weight']['other'] : 0,
			'checked' => in_array('other', $selected['weight']),
		);
	}
	if(count($weight_options) > 1) {
		$groups['weight'] = array(
			'name'    => 'weight',
			'label'   => tradeboost_filter_label($translation, $language, 'metal_weight', 'Precious metal weight'),
			'options' => $weight_options,
		);
	}

	$premium_labels = array(
		'under_3' => array('premium_under_3', 'Under 3% over spot'),
		'3_to_5'  => array('premium_3_to_5',  '3 - 5% over spot'),
		'5_to_10' => array('premium_5_to_10', '5 - 10% over spot'),
		'over_10' => array('premium_over_10', 'Over 10% over spot'),
	);
	$premium_options = array();
	foreach($catalog->premium_brackets() as $bracket_key => $bracket) {
		$count = isset($facet_counts['premium'][$bracket_key]) ? $facet_counts['premium'][$bracket_key] : 0;
		$checked = in_array($bracket_key, $selected['premium']);
		if($count == 0 && !$checked) { continue; }
		$premium_options[] = array(
			'value'   => $bracket_key,
			'label'   => tradeboost_filter_label($translation, $language, $premium_labels[$bracket_key][0], $premium_labels[$bracket_key][1]),
			'count'   => $count,
			'checked' => $checked,
		);
	}
	if(count($premium_options) > 1) {
		$groups['premium'] = array(
			'name'    => 'premium',
			'label'   => tradeboost_filter_label($translation, $language, 'premium', 'Premium over spot'),
			'options' => $premium_options,
		);
	}

	/**
	 * The order the groups appear in the sidebar. Reorder this list to move
	 * them; a group missing from $groups is simply skipped.
	 */
	if($order === null) { $order = array('premium', 'weight', 'country'); }

	$filter_groups = array();

	foreach($order as $name) {
		if(!empty($groups[$name])) { $filter_groups[] = $groups[$name]; }
	}

	return $filter_groups;
}

/**
 * Builds one checkbox group straight from the facet counts. $preferred lists the
 * values to show first; $label_keys maps a value onto a key in the filter
 * translations, otherwise the value is looked up as a top level translation
 * (AU is already "Guld") and falls back to the raw value.
 */
function tradeboost_value_group($name, $label, $counts, $selected_values, $preferred, $translation, $language, $label_keys) {

	$values = $preferred;

	foreach(array_keys($counts) as $value) {
		if(!in_array($value, $values)) { $values[] = $value; }
	}

	$options = array();

	foreach($values as $value) {

		$count = isset($counts[$value]) ? $counts[$value] : 0;
		$checked = in_array((string) $value, $selected_values);

		if($count == 0 && !$checked) { continue; }

		if(isset($label_keys[$value])) {
			$option_label = tradeboost_filter_label($translation, $language, $label_keys[$value], $value);
		} elseif(!empty($translation[$language][$value])) {
			$option_label = $translation[$language][$value];
		} else {
			$option_label = $value;
		}

		$options[] = array(
			'value'   => $value,
			'label'   => ucfirst($option_label),
			'count'   => $count,
			'checked' => $checked,
		);
	}

	if(count($options) < 2) { return null; }

	return array('name' => $name, 'label' => $label, 'options' => $options);
}

function tradeboost_price_labels($translation, $language) {
	return array(
		'heading' => tradeboost_filter_label($translation, $language, 'price_range', 'Price'),
		'from'    => tradeboost_filter_label($translation, $language, 'price_from', 'From'),
		'to'      => tradeboost_filter_label($translation, $language, 'price_to', 'To'),
	);
}
