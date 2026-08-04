<?php
class Url {
	public function get_id($url, $page_type) {

		$db = new db;

		if($page_type != 'product_group') {
			return false;
		}

		$sql = "SELECT id FROM pricecomp_product_group WHERE url = ?";

		$result = $db->query_select($sql, array($url));

		if($result->row) {
			return $result->row['id'];
		} else {
			return false;
		}

	}

}
?>		