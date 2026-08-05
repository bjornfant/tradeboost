<?php
class Catalog {

	/**
	 * Builds a WHERE clause from a filter list and collects the values to bind.
	 *
	 * Every entry that carries a value must use the array form, with ? in the
	 * SQL and the value kept separate:
	 *
	 *     array('sql' => 'p.metal = ?', 'params' => array($metal))
	 *
	 * A plain string is still accepted, but only for fragments that contain no
	 * values at all, e.g. 'pb.quantity IS NULL'. Never build one from input.
	 *
	 * $parameters is appended to in the order the placeholders appear.
	 */
	private function build_filter($filter_array, &$parameters) {

		$clauses = array();

		if (!empty($filter_array)) {
			foreach ($filter_array as $filter) {

				if (is_array($filter)) {

					if (empty($filter['sql'])) {
						continue;
					}

					$clauses[] = $filter['sql'];

					if (!empty($filter['params'])) {
						foreach ($filter['params'] as $value) {
							$parameters[] = $value;
						}
					}

				} elseif (strlen(trim((string) $filter)) > 0) {
					$clauses[] = $filter;
				}
			}
		}

		if (empty($clauses)) {
			return "";
		}

		return " WHERE " . implode(" AND ", $clauses);
	}

	/**
	 * ORDER BY cannot be bound, so it is checked against a list of the sorts the
	 * controllers actually offer. Anything else is dropped and logged.
	 */
	private function sanitize_order($order) {

		if (empty($order)) {
			return false;
		}

		$allowed = array(
			'offers ASC',
			'offers DESC',
			'p.metal ASC, offers DESC',
			'p.lowest_price_eur ASC',
			'p.lowest_price_eur DESC',
			'p.metal_weight_oz ASC',
			'p.metal_weight_oz DESC',
			'(p.lowest_price_eur/p.metal_weight_oz) ASC',
			'(p.lowest_price_eur/p.metal_weight_oz) DESC',
			'sp.price ASC',
			'sp.price DESC'
		);

		// Callers pass values like " offers DESC" and "sp.price ASC," so the
		// spacing and any trailing comma are normalised before comparing.
		$candidate = trim(preg_replace('/\s+/', ' ', (string) $order));
		$candidate = rtrim($candidate, ',');
		$candidate = trim($candidate);

		if (in_array($candidate, $allowed, true)) {
			return $candidate;
		}

		error_log('Catalog: ignored unrecognised ORDER BY "' . $order . '"');

		return false;
	}

	public function get_product($product_id, $limit_matches = 1000, $get_all_matched_products = true, $currency_rates = false) {

		$db = new db;

		if($currency_rates == false) {
			$currency_rates = $this->get_currency_rates();
		}

		$sql = "SELECT p.*, m.id as manufacturer_id, m.name as manufacturer_name, pb.bundle_product_id, IFNULL(pb.quantity, 1) AS quantity, pg.id AS product_group_id, pg.name AS product_group_name, pg.url AS product_group_url FROM pricecomp_product p
		LEFT JOIN pricecomp_product_bundle pb on p.id = pb.bundle_parent_product_id
		LEFT JOIN pricecomp_manufacturer m on p.manufacturer = m.id
		LEFT JOIN pricecomp_product_group pg on p.product_group = pg.id
		WHERE p.product_id = ?";

		$product = $db->query_select($sql, array($product_id));


		if($product->num_rows > 0) {

			$product_row = $product->row;
			//$products_array['store_products'] = array();

			$product_row['url'] = $product_id."/".strtolower(preg_replace('/[^A-Za-z0-9]/', '_', $product_row['name']));
			$product_row['metal_weight_class'] = $this->set_weight_class($product_row);
			$product_row['store_products'] = array();
			$product_row['store_products_in_stock'] = array();

			if(strpos($product_row['name'], '{')) {
				$product_row['name'] = $this->parse_translation($product_row['name'], COUNTRY_DEFAULT);
			}

			//translate oz
			if(strpos($product_row['name'], 'oz')) {
				if($product_row['metal_weight_oz'] > 1) {
					$product_row['name'] = str_replace("oz", "{oz_plural}", $product_row['name']);
				} else {
					$product_row['name'] = str_replace("oz", "{oz_single}", $product_row['name']);
				}
				$product_row['name'] = $this->parse_translation($product_row['name'], COUNTRY_DEFAULT);
			}


			if($get_all_matched_products == true) {

				//get_all_matched_products($product_id = false, $store_id = false, $only_shipping_to_my_country = 1, $limit = 1000) 
				$matched_store_products = $this->get_all_matched_products($product_id, false, 1, $limit_matches,$currency_rates);

				$store_products = array();
				$store_products_in_stock = array();				

				if($matched_store_products) {
					foreach($matched_store_products as $store_product_row) {
						$store_product_row['price_per_oz'] = $store_product_row['price']/$product_row['metal_weight_oz'];

						//hack to ger a numberical value to sort on price...
						$store_products[number_format($store_product_row['price'], 2, '.', '').$store_product_row['id']] = $store_product_row;

						if($store_product_row['stock'] == '1') {
							$store_products_in_stock[$store_product_row['price'].$store_product_row['id']] = $store_product_row;

						}

					}

					ksort($store_products);
					$product_row['store_products'] = $store_products;

					ksort($store_products_in_stock);
					$product_row['store_products_in_stock'] = $store_products_in_stock;

					$this->cache_product($product_row);

				}

			}



		 return $product_row;
		} else {
			return false;
		}

	}

	public function get_product_by_old_id($id) {
		$db = new db;
		$sql = "SELECT p.product_id  FROM pricecomp_product p WHERE p.id = ?";
		$product = $db->query_select($sql, array($id));
		if($product->row) {
			return $product->row['product_id'];
		}
		return false;
	}

	public function get_products($filter_array = false, $sort = false, $order = false, $limit = false, $page = false, $total_count = false, $show_all_offers = false,$currency_rates = false) {
		$db = new db;

		if($currency_rates == false) {
			$currency_rates = $this->get_currency_rates();
		}

		$group = " ";

		// Values are collected in the order their placeholders appear in the
		// statement: the offers subquery comes first, then WHERE, then LIMIT.
		$parameters = array();

		// Offers limitations from get_all_matched_products
		$filter_offers = "";
		if($show_all_offers == false) {
			//only offers that have been scraped last X hours
			// A local checkout runs against a stale dump of the offer table, so the
			// freshness window is widened there. Keyed off the scheme rather than a
			// hostname, which is what made this stop working when the local host
			// changed from tradeboost:8888 to tb.local:8888.
			if(strpos(HTTP, 'https://') !== 0) {
				$filter_offers = " AND sp.update_date >= ?";
				$parameters[] = date("Y-m-d", strtotime("-1080 day"));
			} else {
				$filter_offers = " AND sp.update_date >= ?";
				$parameters[] = date("Y-m-d", strtotime("-2 day"));
			}
		}

		$filter = $this->build_filter($filter_array, $parameters);

		$order_string = "p.metal_weight_oz ASC, p.name, p.country_origin ASC ";
		$safe_order = $this->sanitize_order($order);
		if($safe_order) {
			$order_string = $safe_order . ", " . $order_string;
		}


		$order_string = " ORDER BY " .$order_string ;

		$limit_string = "";
		if($limit) {
			$limit_rows = (int) $limit;
			if($page) {
				$offset = $limit_rows * ((int) $page - 1);
				if($offset < 0) { $offset = 0; }

				$limit_string = " LIMIT ?, ?";
				$parameters[] = $offset;
				$parameters[] = $limit_rows;
			} else {
				$limit_string = " LIMIT ?";
				$parameters[] = $limit_rows;
			}
		}

		$sql = "SELECT p.*, pb.quantity , (p.lowest_price_eur/p.metal_weight_oz) as best_compare_price,
		(SELECT count(sp2p.id) FROM pricecomp_store_product_to_product sp2p
		INNER JOIN pricecomp_store_product sp ON sp.id = sp2p.store_product_id
		WHERE product_id = p.product_id ".$filter_offers.") as 'offers'
		FROM pricecomp_product p
		LEFT JOIN pricecomp_product_bundle pb on pb.bundle_parent_product_id = p.id"
		. $filter . $group . $order_string . $limit_string;

		$all_products = $db->query_select($sql, $parameters);

		if($total_count) {
			return $all_products->num_rows;
		} else {		
			$products_array = array();
			$return_products_array = array();

			if($all_products->num_rows > 0) {	

				foreach($all_products->rows as $product_row) {
					$return_products_array[] = $this->get_product($product_row['product_id'],100,true,$currency_rates); //Limit matched products to max 100 for performance
				}
				return $return_products_array;
			} else {
				return false;
			}
		}

	}	
	
	public function get_group_products($filter_array) {
		$db = new db;

		$parameters = array();
		$filter = $this->build_filter($filter_array, $parameters);

		$sql = "SELECT p.product_id, p.name, p.metal, p.type, (SELECT count(id) FROM pricecomp_store_product_to_product sp2p WHERE product_id = p.product_id) as offers
			FROM pricecomp_product p" . $filter;

		$all_products = $db->query_select($sql, $parameters);


		$return_products_array = array();

		if($all_products->num_rows > 0) {
			foreach($all_products->rows as $product_row) {
				$return_products_array[] = $this->get_product($product_row['product_id']);
			}
			return $return_products_array;
		} else {
			return false;
		}		

	}


	public function get_products_overview($filter_array = false, $sort = false, $order = false, $limit = false) {

		$group = " ";

		$parameters = array();
		$filter = $this->build_filter($filter_array, $parameters);

		$order_string = "p.metal_weight_oz ASC, p.name, p.country_origin ASC";
		$safe_order = $this->sanitize_order($order);
		if($safe_order) {
			$order_string = $safe_order . ", " . $order_string;
		}

		$order_string = " ORDER BY " .$order_string ;

		$limit_string = "";
		if($limit) {
			$limit_string = " LIMIT ?";
			$parameters[] = (int) $limit;
		}

		$db = new db;
		$sql = "SELECT p.* FROM pricecomp_product p "
				. $filter . $group . $order_string . $limit_string;
		$all_products = $db->query_select($sql, $parameters);

		$products_array = array();
		$return_products_array = array();

		return $all_products->rows;

	}	

	public function get_product_history($product_id = false) {
		/*
		SELECT * FROM pricecomp_store_product_log 
		WHERE store_product_id = 'https://tavex.se/guld/30g-kinesisk-panda-2016/' AND created_date > '2020-08-01' AND created_date < '2020-09-01'
		GROUP BY DAY(created_date)
		ORDER BY `created_date`, `price`
			*/

	}

	public function get_all_matched_products($product_id = false, $store_id = false, $only_shipping_to_my_country = "1", $limit_matches = 1000, $currency_rates = false) {
		$db = new db;

		if($currency_rates == false) {
			$currency_rates = $this->get_currency_rates();
		}

		$parameters = array();

		$filter  = "";
		if($product_id) {
			$filter .= " AND product_id = ? ";
			$parameters[] = $product_id;
		}
		if($store_id) {
			$filter .= " AND sp.store_id = ? ";
			$parameters[] = $store_id;
		}

			$filter .= " AND sp.store_id <> 16 "; //deactivate Celtic gold for faulty prices


		if($only_shipping_to_my_country) {
			$filter .= " AND s.ships_to_country IN ('EU', ?) ";

			if(isset($_COOKIE["shipping_country"])) {
				$parameters[] = substr($_COOKIE["shipping_country"],0,2); //country code, nothing longer is ever valid
			} else {
				$parameters[] = COUNTRY_DEFAULT;
			}
		}

		//only products that have been scraped last X hours
		// Same local-checkout widening as get_products(), and keyed off the scheme
		// for the same reason - a local dump of the offer table is months old.
		$filter .= " AND sp.update_date >= ?";
		if(strpos(HTTP, 'https://') !== 0) {
			$parameters[] = date("Y-m-d", strtotime("-1080 day"));
		} else {
			$parameters[] = date("Y-m-d", strtotime("-2 day"));
		}

		$parameters[] = (int) $limit_matches;

		$sql = "SELECT sp2p.product_id, sp.*, s.name as 'store_name', s.id as 'store_id' FROM pricecomp_store_product_to_product sp2p
		INNER JOIN pricecomp_store_product sp ON sp.id = sp2p.store_product_id
		INNER JOIN pricecomp_store s on s.id = sp.store_id
		WHERE LENGTH(sp2p.product_id) > 0 " . $filter . " LIMIT ?";
		$all_matched_store_products = $db->query_select($sql, $parameters);

		$return_products = array();


		if($all_matched_store_products->num_rows > 0) {
			foreach($all_matched_store_products->rows as $product_row) {
				if($product_row['currency'] != CURRENCY_DEFAULT) {
					$product_row['original_price'] = $product_row['price'];
					$product_row['original_currency'] = $product_row['currency'];
					$product_row['price'] = $this->convert_currency($product_row['currency'], CURRENCY_DEFAULT, $product_row['price'],$currency_rates);
				}

				if($product_row['price'] > 1) {
					$return_products[] = $product_row;
				}

			}

		}
		
		return $return_products;

	}

	public function get_store_products($store_id = false, $order = "", $currency_rates = false) {
		$db = new db;

		if($currency_rates == false) {
			$currency_rates = $this->get_currency_rates();
		}

		if($store_id) {
			// $order arrives as "sp.price ASC," - the whitelist drops the comma,
			// so it is put back here when composing the clause.
			$safe_order = $this->sanitize_order($order);
			$order_string = " ORDER BY p.type";
			if($safe_order) {
				$order_string = " ORDER BY " . $safe_order . ", p.type";
			}

			$sql = "SELECT p.*, sp.price FROM pricecomp_store_product sp
			LEFT JOIN pricecomp_store_product_to_product sp2p on sp.id = sp2p.store_product_id
			LEFT JOIN pricecomp_product p ON sp2p.product_id = p.product_id
			WHERE sp.store_id = ? AND p.product_id IS NOT NULL AND sp.update_date >= ?"
			. $order_string;

			// Same local-checkout widening as get_products(); see the note there.
			$offer_age = (strpos(HTTP, 'https://') !== 0) ? "-1080 day" : "-2 day";

			$all_products = $db->query_select($sql, array($store_id, date("Y-m-d", strtotime($offer_age))));

			if($all_products->num_rows > 0) {

			foreach($all_products->rows as $product_row) {
				$product_row['url'] = $product_row['product_id']."/".strtolower(preg_replace('/[^A-Za-z0-9]/', '_', $product_row['name']));

				if(strpos($product_row['name'], '{')) {
					$product_row['name'] = $this->parse_translation($product_row['name'], COUNTRY_DEFAULT);
				}

				//translate oz
				if(strpos($product_row['name'], 'oz')) {
					if($product_row['metal_weight_oz'] > 1) {
						$product_row['name'] = str_replace("oz", "{oz_plural}", $product_row['name']);
					} else {
						$product_row['name'] = str_replace("oz", "{oz_single}", $product_row['name']);
					}
					$product_row['name'] = $this->parse_translation($product_row['name'], COUNTRY_DEFAULT);
				}

				$product_row['store_products'] = array();
				$product_row['metal_weight_class'] = $this->set_weight_class($product_row);

				$products_array[$product_row['product_id']] = $product_row;

			}

			$all_matched_store_products = $this->get_all_matched_products(false, $store_id,0,10000,$currency_rates);

			if($all_matched_store_products) {
		
				foreach($all_matched_store_products as $store_product_row) {
					if(!empty($products_array[$store_product_row['product_id']])) {

					$store_product_row['price_per_oz'] = $store_product_row['price']/$products_array[$store_product_row['product_id']]['metal_weight_oz'];

					$products_array[$store_product_row['product_id']]['store_products'][] = $store_product_row;

					$return_products_array[$store_product_row['product_id']] = $products_array[$store_product_row['product_id']];

					}
				}
			}

			 	return $return_products_array;

			} else {
				return false;
			}
		}

	}	

	public function get_product_stores($store_id_array = false) {
		$db = new db;

		$parameters = array();

		$filter  = "";
		if($store_id_array) {
			$placeholders = implode(",", array_fill(0, count($store_id_array), "?"));
			$filter = " WHERE s.id IN (" . $placeholders . ") ";

			foreach ($store_id_array as $store_id) {
				$parameters[] = $store_id;
			}
		}

		$sql = "SELECT s.* FROM pricecomp_store s " . $filter;

		$all_stores = $db->query_select($sql, $parameters);

		if($all_stores->num_rows > 0) {
			$store_array = array();
			foreach ($all_stores->rows as $row) {
				$store_array[$row['id']] = $row;
				$store_array[$row['id']]['url'] = $row['id']."/".strtolower(preg_replace('/[^A-Za-z0-9]/', '_', $row['name']));
			}
			return $store_array;
		}else {
			return false;
		}

	}


	public function get_filter($products_array) {


		if(!empty($products_array)) {
			$filter_array = array();
			foreach ($products_array as $product) {
				if(isset($filter_array['country_origin'][$product['country_origin']])) {
					$filter_array['country_origin'][$product['country_origin']]++;
				} else {
					$filter_array['country_origin'][$product['country_origin']] = 1;
				}
				if(isset($filter_array['type'][$product['type']])) {
					$filter_array['type'][$product['type']]++;
				} else {
					$filter_array['type'][$product['type']] = 1;
				}
				if(isset($filter_array['metal'][$product['metal']])) {
					$filter_array['metal'][$product['metal']]++;
				} else {
					$filter_array['metal'][$product['metal']] = 1;
				}
				/*if(isset($filter_array['quantity'][$product['quantity']])) {
					$filter_array['quantity'][$product['quantity']]++;
				} else {
					$filter_array['quantity'][$product['quantity']] = 1;
				}*/
				if(isset($filter_array['manufacturer'][$product['manufacturer']])) {
					$filter_array['manufacturer'][$product['manufacturer']]++;
				} else {
					$filter_array['manufacturer'][$product['manufacturer']] = 1;
				}
				if(isset($filter_array['metal_weight_class'][$product['metal_weight_class']])) {
					$filter_array['metal_weight_class'][$product['metal_weight_class']]++;
				} else {
					$filter_array['metal_weight_class'][$product['metal_weight_class']] = 1;
				}
			}
			ksort($filter_array['country_origin']);
			ksort($filter_array['type']);
			ksort($filter_array['metal']);
			ksort($filter_array['manufacturer']);
			//ksort($filter_array['quantity']);

			return $filter_array;
		} else {
			return false;
		}
	}

	/**
	 * Coins and bars are both stored in metal_weight_oz, but the trade quotes
	 * some sizes in grams (a 100 g bar) and others in troy ounces (a 1 oz
	 * Krugerrand). Which series a product belongs to is a property of the
	 * product, not of its type, so both are listed here and matched against the
	 * stored value rather than branched on p.type.
	 */
	const OZ_IN_GRAM = 31.1034768;

	/** Stored weights are rounded to six decimals, so matching needs slack. */
	const WEIGHT_TOLERANCE = 0.002;

	private $denominations = false;

	public function weight_denominations() {

		if ($this->denominations !== false) {
			return $this->denominations;
		}

		$grams = array(1, 2, 2.5, 3, 5, 10, 20, 50, 100, 250, 500, 1000, 2000, 5000, 10000);
		$ounces = array(0.01, 0.02, 0.1, 0.2, 0.25, 0.5, 1, 2, 5, 10, 15, 20, 25, 50, 100);

		$denominations = array();

		foreach ($grams as $value) {
			$denominations['g_' . str_replace('.', '_', (string) $value)] = array(
				'oz'    => $value / self::OZ_IN_GRAM,
				'unit'  => 'gram',
				'value' => $value,
			);
		}

		foreach ($ounces as $value) {
			$denominations['oz_' . str_replace('.', '_', (string) $value)] = array(
				'oz'    => (float) $value,
				'unit'  => 'oz',
				'value' => $value,
			);
		}

		uasort($denominations, array($this, 'compare_denominations'));

		$this->denominations = $denominations;

		return $this->denominations;
	}

	/**
	 * Denominations are exact round numbers, so they are labelled without
	 * format_weight()'s two decimals - "1 g", not "1.00 g".
	 */
	public function denomination_label($denomination) {

		if ($denomination['unit'] == 'gram') {

			if ($denomination['value'] >= 1000) {
				return (string) (float) ($denomination['value'] / 1000) . ' kg';
			}

			return (string) (float) $denomination['value'] . ' g';
		}

		// Fractional ounces are traded as fractions, not decimals - a dealer
		// lists a 1/10 oz Britannia, never a 0.1 oz one.
		$fractions = array(
			'0.01' => '1/100',
			'0.02' => '1/50',
			'0.1'  => '1/10',
			'0.2'  => '1/5',
			'0.25' => '1/4',
			'0.5'  => '1/2',
		);

		$value = (string) (float) $denomination['value'];

		if (isset($fractions[$value])) {
			return $fractions[$value] . ' oz';
		}

		return $value . ' oz';
	}

	private function compare_denominations($a, $b) {
		if ($a['oz'] == $b['oz']) {
			return 0;
		}
		return ($a['oz'] < $b['oz']) ? -1 : 1;
	}

	/**
	 * Anything that is not a recognised denomination falls into 'other' rather
	 * than becoming its own checkbox - the catalog holds 228 distinct weights,
	 * some of them import errors (a coin stored as 32151 oz is a tonne of gold).
	 */
	public function denomination_key($metal_weight_oz) {

		$weight = (float) $metal_weight_oz;

		if ($weight <= 0) {
			return false;
		}

		foreach ($this->weight_denominations() as $key => $denomination) {
			if (abs($weight - $denomination['oz']) <= $denomination['oz'] * self::WEIGHT_TOLERANCE) {
				return $key;
			}
		}

		return 'other';
	}

	/**
	 * The lowest bracket has a floor at spot. Without it, rows with a broken
	 * price - a "1 oz" gold coin at 29 EUR - come out hundreds of percent below
	 * spot and land in the bucket meant to show the best deals. Anything priced
	 * below spot now falls outside every bracket: it still appears in the list,
	 * it just cannot be reached through the premium filter.
	 */
	public function premium_brackets() {
		return array(
			'under_3' => array('min' => 0,  'max' => 3),
			'3_to_5'  => array('min' => 3,  'max' => 5),
			'5_to_10' => array('min' => 5,  'max' => 10),
			'over_10' => array('min' => 10, 'max' => null),
		);
	}

	public function premium_bracket_key($row, $spot_prices) {

		$weight = (float) $row['metal_weight_oz'];
		$price = (float) $row['lowest_price_eur'];
		$spot = isset($spot_prices[$row['metal']]) ? (float) $spot_prices[$row['metal']] : 0;

		if ($weight <= 0 || $price <= 0 || $spot <= 0) {
			return false;
		}

		$premium = 100 * ((($price / $weight) - $spot) / $spot);

		foreach ($this->premium_brackets() as $key => $bracket) {
			if ($bracket['min'] !== null && $premium < $bracket['min']) {
				continue;
			}
			if ($bracket['max'] !== null && $premium >= $bracket['max']) {
				continue;
			}
			return $key;
		}

		return false;
	}

	/**
	 * Premium over spot is not a column - it is derived from the live metal
	 * price, so the spot values are bound in as parameters. Spot must be given
	 * in EUR because lowest_price_eur is.
	 */
	private function premium_expression(&$parameters, $spot_prices) {

		$gold = isset($spot_prices['AU']) ? (float) $spot_prices['AU'] : 0;
		$silver = isset($spot_prices['SI']) ? (float) $spot_prices['SI'] : 0;

		$spot_case = "CASE p.metal WHEN 'AU' THEN ? WHEN 'SI' THEN ? ELSE NULL END";

		// Order matters: the numerator's placeholders are read before the denominator's.
		$parameters[] = $gold;
		$parameters[] = $silver;
		$parameters[] = $gold;
		$parameters[] = $silver;

		return "(100 * (((p.lowest_price_eur / NULLIF(p.metal_weight_oz, 0)) - " . $spot_case . ") / " . $spot_case . "))";
	}

	public function filter_in($column, $values) {

		$clean = array();

		foreach ((array) $values as $value) {
			if ($value !== '' && $value !== null) {
				$clean[] = $value;
			}
		}

		if (empty($clean)) {
			return false;
		}

		return array(
			'sql'    => $column . " IN (" . implode(',', array_fill(0, count($clean), '?')) . ")",
			'params' => $clean,
		);
	}

	public function filter_weight($denomination_keys) {

		$denominations = $this->weight_denominations();
		$clauses = array();
		$parameters = array();
		$include_other = false;

		foreach ((array) $denomination_keys as $key) {

			if ($key === 'other') {
				$include_other = true;
				continue;
			}

			if (!isset($denominations[$key])) {
				continue;
			}

			$clauses[] = "(p.metal_weight_oz BETWEEN ? AND ?)";
			$parameters[] = $denominations[$key]['oz'] * (1 - self::WEIGHT_TOLERANCE);
			$parameters[] = $denominations[$key]['oz'] * (1 + self::WEIGHT_TOLERANCE);
		}

		if ($include_other) {

			$conditions = array();

			foreach ($denominations as $denomination) {
				$conditions[] = "(p.metal_weight_oz NOT BETWEEN ? AND ?)";
				$parameters[] = $denomination['oz'] * (1 - self::WEIGHT_TOLERANCE);
				$parameters[] = $denomination['oz'] * (1 + self::WEIGHT_TOLERANCE);
			}

			$clauses[] = "(p.metal_weight_oz > 0 AND " . implode(" AND ", $conditions) . ")";
		}

		if (empty($clauses)) {
			return false;
		}

		return array(
			'sql'    => "(" . implode(" OR ", $clauses) . ")",
			'params' => $parameters,
		);
	}

	public function filter_premium($bracket_keys, $spot_prices) {

		$brackets = $this->premium_brackets();
		$clauses = array();
		$parameters = array();

		foreach ((array) $bracket_keys as $key) {

			if (!isset($brackets[$key])) {
				continue;
			}

			$conditions = array();

			if ($brackets[$key]['min'] !== null) {
				$expression_parameters = array();
				$conditions[] = $this->premium_expression($expression_parameters, $spot_prices) . " >= ?";
				$parameters = array_merge($parameters, $expression_parameters);
				$parameters[] = $brackets[$key]['min'];
			}

			if ($brackets[$key]['max'] !== null) {
				$expression_parameters = array();
				$conditions[] = $this->premium_expression($expression_parameters, $spot_prices) . " < ?";
				$parameters = array_merge($parameters, $expression_parameters);
				$parameters[] = $brackets[$key]['max'];
			}

			if (!empty($conditions)) {
				$clauses[] = "(" . implode(" AND ", $conditions) . ")";
			}
		}

		if (empty($clauses)) {
			return false;
		}

		return array(
			'sql'    => "(" . implode(" OR ", $clauses) . ")",
			'params' => $parameters,
		);
	}

	public function filter_price($minimum, $maximum) {

		$conditions = array();
		$parameters = array();

		if ($minimum !== false && $minimum !== '' && $minimum !== null) {
			$conditions[] = "p.lowest_price_eur >= ?";
			$parameters[] = (float) $minimum;
		}

		if ($maximum !== false && $maximum !== '' && $maximum !== null) {
			$conditions[] = "p.lowest_price_eur <= ?";
			$parameters[] = (float) $maximum;
		}

		if (empty($conditions)) {
			return false;
		}

		return array(
			'sql'    => "(" . implode(" AND ", $conditions) . ")",
			'params' => $parameters,
		);
	}

	/**
	 * The rows the facet counts are built from. This deliberately ignores
	 * pagination: counting off a paginated array is what made the old weight
	 * dropdown reflect only page one.
	 */
	public function get_facet_rows($filter_array = false) {

		$db = new db;
		$parameters = array();
		$filter = $this->build_filter($filter_array, $parameters);

		$sql = "SELECT p.id, p.metal, p.type, p.country_origin, p.manufacturer, p.metal_weight_oz, p.lowest_price_eur
			FROM pricecomp_product p
			LEFT JOIN pricecomp_product_bundle pb on pb.bundle_parent_product_id = p.id" . $filter;

		$result = $db->query_select($sql, $parameters);

		if ($result->num_rows > 0) {
			return $result->rows;
		}

		return array();
	}

	private function facet_value($row, $facet_name, $spot_prices) {

		switch ($facet_name) {
			case 'country':
				return $row['country_origin'];
			case 'weight':
				return $this->denomination_key($row['metal_weight_oz']);
			case 'premium':
				return $this->premium_bracket_key($row, $spot_prices);
		}

		return false;
	}

	/**
	 * Counts each option against every *other* selected facet, so choosing one
	 * country does not collapse the country list to that single entry.
	 */
	public function count_facets($rows, $selected = array(), $spot_prices = array()) {

		$facet_names = array('country', 'weight', 'premium');
		$counts = array();

		foreach ($facet_names as $facet_name) {

			$counts[$facet_name] = array();

			foreach ($rows as $row) {

				$matches_other_facets = true;

				foreach ($facet_names as $other_name) {

					if ($other_name == $facet_name || empty($selected[$other_name])) {
						continue;
					}

					$other_value = $this->facet_value($row, $other_name, $spot_prices);

					if ($other_value === false || !in_array($other_value, (array) $selected[$other_name])) {
						$matches_other_facets = false;
						break;
					}
				}

				if (!$matches_other_facets) {
					continue;
				}

				$value = $this->facet_value($row, $facet_name, $spot_prices);

				if ($value === false) {
					continue;
				}

				if (isset($counts[$facet_name][$value])) {
					$counts[$facet_name][$value]++;
				} else {
					$counts[$facet_name][$value] = 1;
				}
			}
		}

		return $counts;
	}

	public function get_countries($filter_array = false) {
		$db = new db;
		require __DIR__ . '/../translation/translations.php';

		$parameters = array();
		$filter = $this->build_filter($filter_array, $parameters);

		$sql = "SELECT p.country_origin FROM pricecomp_product p ".$filter." GROUP BY p.country_origin";
		$result = $db->query_select($sql, $parameters);
		$countries_array = array();

		if($result->num_rows > 0) {
			foreach($result->rows as $row) {
				$country_name = $translation[COUNTRY_DEFAULT]['country'][$row['country_origin']];
				$countries_array[$country_name] = $row['country_origin'];
			}
			ksort($countries_array);

			return $countries_array;
		} else {
			return false;
		}
	}

	public function get_manufacturers() {
		$db = new db;

		$sql = "SELECT * FROM pricecomp_manufacturer ORDER BY name ASC";
		$all_manufacturers = $db->query_select($sql);
		$manufacturers_array = array();

		if($all_manufacturers->num_rows > 0) {
			foreach($all_manufacturers->rows as $manufacturer_row) {
				$manufacturers_array[$manufacturer_row['id']] = $manufacturer_row;
			}
			return $manufacturers_array;
		} else {
			return false;
		}
	}

	public function get_manufacturer($manufacturer_id) {
		$db = new db;

		$sql = "SELECT * FROM pricecomp_manufacturer WHERE id = ?";
		$manufacturer = $db->query_select($sql, array($manufacturer_id));

		if($manufacturer->row) {
			return $manufacturer->row;
		} else {
			return false;
		}
	}
	public function get_manufacturer_products($manufacturer_id) {
		$db = new db;

		$sql = "SELECT * FROM pricecomp_manufacturer WHERE id = ?";
		$manufacturer = $db->query_select($sql, array($manufacturer_id));

		if($manufacturer->row) {
			return $manufacturer->row;
		} else {
			return false;
		}
	}
	
	/**
	 * Groups that actually hold products in the current category, most populous
	 * first. The INNER JOIN drops ungrouped products, so this stays honest even
	 * though product_group is only sparsely filled in.
	 */
	public function get_popular_product_groups($filter_array = false, $limit = 12) {

		$db = new db;
		$parameters = array();
		$filter = $this->build_filter($filter_array, $parameters);

		$sql = "SELECT pg.id, pg.name, pg.url, COUNT(DISTINCT p.id) as product_count
			FROM pricecomp_product p
			LEFT JOIN pricecomp_product_bundle pb on pb.bundle_parent_product_id = p.id
			INNER JOIN pricecomp_product_group pg ON pg.id = p.product_group" . $filter . "
			GROUP BY pg.id, pg.name, pg.url
			ORDER BY product_count DESC, pg.name ASC
			LIMIT ?";

		$parameters[] = (int) $limit;

		$result = $db->query_select($sql, $parameters);

		if ($result->num_rows > 0) {
			return $result->rows;
		}

		return array();
	}

	public function get_product_groups() {
		$db = new db;

		$sql = "SELECT * FROM pricecomp_product_group";
		$product_group = $db->query_select($sql);

		if($product_group->rows) {
			return $product_group->rows;
		} else {
			return false;
		}
	}
	
	public function get_product_group($product_group_id) {
		$db = new db;

		$sql = "SELECT * FROM pricecomp_product_group WHERE id = ?";
		$product_group = $db->query_select($sql, array($product_group_id));

		if($product_group->row) {
			return $product_group->row;
		} else {
			return false;
		}
	}

	public function filter_and_sort_products($products_array = false, $filter_array = false, $sort = false) {
		require __DIR__ . '/../translation/translations.php';

		$page_language = COUNTRY_DEFAULT;
		$page_currency  = CURRENCY_DEFAULT;

		$price_array = new Commodity;
		$comodity_price_array = array();
		$comodity_price_array['AU'] = $price_array->get_commodity_price('AU');
		$comodity_price_array['SI'] = $price_array->get_commodity_price('SI');

		$filtered_products = array();

		foreach($products_array as $product) {
			$show_product = true;
			if(empty($product['store_products'])) { $show_product = false;} //only show products that are for sale somewhere
			if(!empty($filter_array['country']) && $filter_array['country'] != $product['country_origin']) { $show_product = false; }
			if(!empty($filter_array['metal']) && $filter_array['metal'] != $product['metal']) { $show_product = false; }
			if(!empty($filter_array['type']) && $filter_array['type'] != $product['type']) { $show_product = false; }
			if(!empty($filter_array['quantity']) && $filter_array['quantity'] != $product['quantity']) { $show_product  = false; }
			if(!empty($filter_array['manufacturer']) && $filter_array['manufacturer'] != $product['manufacturer_id']) { $show_product  = false; }
			if(!empty($filter_array['metal_weight_class']) && $filter_array['metal_weight_class'] != $product['metal_weight_class']) { $show_product = false; }
			

			if($show_product) {
				$first_store_product = reset($product['store_products']);
				$product['offers'] = (int) count($product['store_products']);

				if(isset($filter_array['stock_only'])) {
					if($filter_array['stock_only'] == 1) {
						$first_store_product = reset($product['store_products_in_stock']);
						$product['offers'] = (int) count($product['store_products_in_stock']);

					}
				}

				if(isset($first_store_product['price'])) {
					$product['best_price'] = $first_store_product['price'];
				}
				if(isset($first_store_product['price_per_oz'])) {
					$product['best_price_per_oz'] = $first_store_product['price_per_oz'];
				}
				
				if(isset($product['best_price_per_oz']) && !empty($comodity_price_array[$product['metal']][$page_currency]['price_per_oz'])) {
					$product['best_price_compare_to_spot'] = 100*((float) $product['best_price_per_oz'] - (float) $comodity_price_array[$product['metal']][$page_currency]['price_per_oz'])/(float) $comodity_price_array[$product['metal']][$page_currency]['price_per_oz'];
				} else {
					$product['best_price_compare_to_spot'] = 0;
				}

				$product['metal_type'] = strtolower($translation['EN'][$product['metal']].$product['type']);

				if($first_store_product['price'] > 0) {
					$filtered_products[] = $product; 
				}
				
			}
			
		}

		//$sort = false;
		$column  = array_column($filtered_products, 'best_price_compare_to_spot');
		$direction = SORT_ASC;

		if(!empty($sort)) {
			$column = false;
			switch ($sort) {
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
		}
		array_multisort($column , $direction, SORT_NUMERIC, $filtered_products);

		return $filtered_products;

	}

	public function cache_product($product) {
		if($product) {
			$db = new db;

			$lowest_price_per_oz = reset($product['store_products'])['price_per_oz'];

			$sql = "REPLACE INTO `pricecomp_website_product_cache` (`product_id`, `website`, `lowest_price`, `currency`)
			VALUES (?, ?, ?, ?)";

			$db->query($sql, array(
				$product['product_id'],
				HTTP,
				str_replace(",", ".", $lowest_price_per_oz),
				CURRENCY_DEFAULT
			));
	
		}
		return true;
	}


	public function get_currency_rates() {
		$db = new db;
		$currency_rates = array();
		$currencies = array('SEK', 'GBP', 'USD', 'CHF');

		foreach ($currencies as $currency) {

			$sql = "SELECT * FROM pricecomp_currency WHERE currency = ? ORDER BY ID DESC LIMIT 1";

			$currency_rate = $db->query_select($sql, array($currency));

			if($currency_rate->num_rows > 0) {
				$currency_rates[$currency] = $currency_rate->row['value'];
			}

		}
		return $currency_rates;

	}

	public function convert_currency($from, $to, $value, $currency_rates = false) {
		
		//currencies based on 1 EURO to ...
		$converted_value = false;

		if($currency_rates == false) {
			$currency_rates = $this->get_currency_rates();
		}

		// Converting a currency to itself is a no-op, not a failure. Without
		// this the EUR pages get false back and silently drop the value.
		if($from == $to) {
			return $value;
		}

		/**
		 * get_currency_rates() only sets a key when the currency has a row, so a
		 * rate can be missing. Dividing by a missing rate throws a
		 * DivisionByZeroError on PHP 8 and takes the whole page down, so every
		 * rate is looked up through currency_rate() and an unusable one makes the
		 * conversion return false - the same answer an unsupported pair gives.
		 */
		$rate_from_eur = $this->currency_rate($currency_rates, $from);
		$rate_to_eur = $this->currency_rate($currency_rates, $to);

		if($from == 'EUR' && $rate_to_eur !== false) {
			$converted_value = $value * $rate_to_eur;
		}

		if($to == 'EUR' && $rate_from_eur !== false) {
			$converted_value = $value / $rate_from_eur;
		}

		// Anything that is neither to nor from EUR goes via EUR.
		if($from != 'EUR' && $to != 'EUR' && $rate_from_eur !== false && $rate_to_eur !== false) {
			$converted_value = ($value / $rate_from_eur) * $rate_to_eur;
		}

		return $converted_value;

	}

	/**
	 * Rates are quoted against 1 EUR. Returns false when the rate is missing or
	 * unusable, so callers never divide by it.
	 */
	private function currency_rate($currency_rates, $currency) {

		if ($currency == 'EUR') {
			return 1.0;
		}

		if (isset($currency_rates[$currency]) && (float) $currency_rates[$currency] > 0) {
			return (float) $currency_rates[$currency];
		}

		return false;
	}



	public function format_money($number = 0, $currency = 'EUR', $decimals = 0) {

		//Default
		$prefix = "";
		$postfix = $currency;

		if( $currency == 'EUR') {
			$prefix = "€ ";
			$postfix = ""; 
			$decimals = 2;
		}
		if( $currency == 'GBP') {
			$prefix = "£ ";
			$postfix = ""; 
			$decimals = 2;
		}
		if( $currency == 'USD') {
			$prefix = "$ ";
			$postfix = ""; 
			$decimals = 2;
		}
		if( $currency == 'CHF') {
			$prefix = "";
			$postfix = " CHF";
			$decimals = 2;
		}
		if( $currency == 'SEK') {
			$prefix = "";
			$postfix = " kr";
		}

		return $prefix . number_format($number, $decimals, '.', ' ') . $postfix;

	}

	public function parse_translation($text, $language) {
		require __DIR__ . '/../translation/translations.php';

		preg_match('#\{(.*?)\}#', $text, $match);
		$translation_params = explode( ":",$match[1]);
		$translation_string = "";
		if(count($translation_params) == 2) {
			$translation_string = $translation[$language][$translation_params[0]][$translation_params[1]];
		} elseif (count($translation_params) == 1) {
			$translation_string = $translation[$language][$translation_params[0]];
		}

		return preg_replace('#\{(.*?)\}#', $translation_string, $text);

	}


	public function format_weight($number, $weight_unit) {
		$ext = '';
		$value = '';
		if ($weight_unit == 'gram') {
			$ext = 'g';
			if($number > 500) {
				$number = $number/1000;
				$ext = 'kg';
			} 
			$value = number_format($number, 2, '.', ' ') ;
		}
		if ($weight_unit == 'oz') {
			$ext = 'oz';
			if(intval($number) == $number) {
				$value = number_format($number, 0, '.', ' ');
			} else {
				$value = number_format($number, 2, '.', ' ');
			}
		}
		return $value . " " . $ext;
	} 	

	private function set_weight_class($product){
		$metal_weight_class = false;
		if($product['metal_weight_oz'] > 0 && $product['metal_weight_oz'] < 1 ) { $metal_weight_class = 'light'; }
		if($product['metal_weight_oz'] >= 1 && $product['metal_weight_oz'] < 5 ) { $metal_weight_class = 'medium'; }
		if($product['metal_weight_oz'] >= 5) { $metal_weight_class = 'heavy'; }
		if((int) $product['metal_weight_oz'] == 1) { $metal_weight_class = '1oz'; }

		return $metal_weight_class;
	}

	public function pagination($total_count, $limit, $current_page, $url) {
		$pagination_array = array();

		if($total_count > $limit) {
			$parsed = parse_url($url);
			$query = "";
			$params = array();
			if(!empty($parsed['query'])) {
				$query = $parsed['query'];
			}
			parse_str($query, $params);

			$counter = 1;

			for ($i = 0; $i < ($total_count+$limit); $i += $limit) {
				$current_params = $params;
				$current_params['page'] = $counter;
				$selected = false;
				if($current_page == $counter) { $selected = true; }

				$pagination_array[$counter] = array('url' => $parsed['path'] . "?" . http_build_query($current_params), 'selected' => $selected);

				$counter++;
			}
			array_pop($pagination_array);			
		}
		
		return $pagination_array;
	}

}