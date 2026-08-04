<?php
class Commodity {
	public function get_commodity_price($commodity) {

		$db = new db;
		$catalog = new catalog;

		$load_currencies = array('SEK', 'EUR', 'USD', 'CHF', 'GBP');
		$return_array = array();

		foreach($load_currencies as $currency) {
			$sql = "SELECT * FROM pricecomp_commodity_price WHERE currency = ? AND commodity = ? ORDER BY update_date DESC LIMIT 10";

			$result = $db->query_select($sql, array($currency, $commodity));

			if(!empty($result->row['price_per_oz'])) {
				$return_array[$currency] = array(
					'price_per_oz' 		=> $result->row['price_per_oz'],
					'price_per_gram' 	=> $result->row['price_per_gram'],
					'update_date' 		=> $result->row['update_date']
				);
			} else {
				return 0;
			}
			
		}

		return $return_array;
	}
}
?>