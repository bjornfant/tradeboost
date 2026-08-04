<?php
class Search {

	public function search_query($query, $dataset = false) {
	$db = new db;
	$catalog = new Catalog;

	$rich_query = $this->parse_query($query);
	$filter_string = "";
	$filter = array();

	// Everything derived from the visitor's search term is bound, never
	// concatenated. $parameters is filled in the order the ? appear.
	$parameters = array();

	if(!empty($rich_query['metal'])) {
		$filter[] = " p.metal = ?";
		$parameters[] = $rich_query['metal'];
	}
	if(!empty($rich_query['type'])) {
		$filter[] = " p.type = ?";
		$parameters[] = $rich_query['type'];
	}
	if(!empty($rich_query['country_origin'])) {
		$filter[] = " p.country_origin = ?";
		$parameters[] = $rich_query['country_origin'];
	}
	if(!empty($rich_query['weight_unit']) && !empty($rich_query['weight'])) {
		$weight_low = (float) str_replace(",", ".", $rich_query['weight']*0.49);
		$weight_high = (float) str_replace(",", ".", $rich_query['weight']*2.1);

		if($rich_query['weight_unit'] == "gram") {
			$filter[] = " p.metal_weight_gram > ? AND  p.metal_weight_gram < ?";
			$parameters[] = $weight_low;
			$parameters[] = $weight_high;
		} elseif ($rich_query['weight_unit'] == "oz") {
			$filter[] = " p.metal_weight_oz > ? AND  p.metal_weight_oz < ?";
			$parameters[] = $weight_low;
			$parameters[] = $weight_high;
		}

	}
	$filter_keywords = array();
	$keyword_parameters = array();
	if(!empty($rich_query['keywords'])) {
		foreach($rich_query['keywords'] as $keyword) {
			$filter_keywords[] = " p.name LIKE ?";
			$keyword_parameters[] = '%' . $keyword . '%';
		}
	}

	$filter[] = " p.name NOT LIKE '%various%'";	//filter out products that are from "various brands"

	if(!empty($filter)) {
		$filter_string = " WHERE " . implode(" AND ", $filter);
	}

	// The keyword group sits after the other conditions in the statement, so its
	// values are appended after them too.
	if(!empty($filter_keywords)) {
		$filter_string .= " AND (" . implode(" OR ", $filter_keywords) . ")";

		foreach($keyword_parameters as $keyword_parameter) {
			$parameters[] = $keyword_parameter;
		}
	}

	$sql = "SELECT p.product_id, p.name, p.metal, p.type, (SELECT count(id) FROM pricecomp_store_product_to_product sp2p WHERE product_id = p.product_id) as offers FROM pricecomp_product p " . $filter_string . " LIMIT 100";


	$all_products = $db->query_select($sql, $parameters);

	//fallback if no search result
	if(empty($all_products->rows)) {

		$filter_string = " WHERE p.name LIKE ?";
		$fallback_parameters = array('%' . $query . '%');

		//Search keywords
		if(strpos($query, " ")) {
			$query_split = array();
			$fallback_parameters = array();

			foreach(explode(" ", $query) as $keyword) {
				$query_split[] = " p.name LIKE ?";
				$fallback_parameters[] = '%' . $keyword . '%';
			}

			$filter_string = " WHERE " . implode(" OR ", $query_split);
		}

		$sql = "SELECT p.product_id, p.name, p.metal, p.type, (SELECT count(id) FROM pricecomp_store_product_to_product sp2p WHERE product_id = p.product_id) as offers FROM pricecomp_product p " . $filter_string . " LIMIT 100";

		$all_products = $db->query_select($sql, $fallback_parameters);

		if(empty($all_products->rows)) {
			if(!empty($rich_query['country_origin'])) {
				$sql = "SELECT p.product_id, p.name, p.metal, p.type, (SELECT count(id) FROM pricecomp_store_product_to_product sp2p WHERE product_id = p.product_id) as offers FROM pricecomp_product p  WHERE p.country_origin = ? LIMIT 100";
				$all_products = $db->query_select($sql, array($rich_query['country_origin']));
			}
		}

	}


	if(!empty($rich_query['original_name'])) {
		$words = explode(" ",$rich_query['original_name']) + $rich_query['keywords'];
	}
	$search_result = array();

	foreach($all_products->rows as $product_row) {

		$result_ranking = 1;
		$product_row['name'] = strtolower($product_row['name']);

		$product_name_parts = explode(" ", $product_row['name']);

		if(!empty($words)) {
			foreach($words as $keyword) {
				if(strlen($keyword)>1) {
					if(strpos($product_row['name'], $keyword) !== false) {
						$result_ranking +=3; 
					}
					foreach($product_name_parts as $part) {
						if($keyword == $part) {
							$result_ranking +=1; 
						}
					}
				}
			}
		}
		if(strpos($product_row['name'], "x") !== false) { //boxes are ranked lower
			$result_ranking -= 20;
		}
		if(strpos($product_row['name'], "1 oz") !== false) { //1 oz is the most common coin
			$result_ranking += 1;
		}

		$result_ranking += (int) $product_row['offers']*5;

		//if($result_ranking > 5) {
			$search_result[$result_ranking . "." . $product_row['product_id']] = $product_row['product_id'];
		//}
		
	}
	krsort($search_result,SORT_NUMERIC);

	$currency_rates = $catalog->get_currency_rates();

	$product_array = array();
	if(!empty($search_result)){
		foreach($search_result as $product => $product_id) {
			$product_array[] = $catalog->get_product($product_id,1000,true,$currency_rates);
		}
	}

	//log searches
	$sql = "INSERT INTO pricecomp_page_search (query, parsed_query, returned_results) VALUES (?, ?, ?)";

	// Logging must never break the search page.
	try {
		$db->query($sql, array(
			$rich_query['original_name'],
			$rich_query['parsed_name'],
			(int) $all_products->num_rows
		));
	} catch (\Exception $exception) {
		error_log('Search logging failed: ' . $exception->getMessage());
	}


	return $product_array;
	}

	public function parse_query($query) {

		require __DIR__ . '/../translation/translations.php';

		$query .= " ";

		$weight_string = false;
		$weight_unit = false;
		$product_weight = false;
		$product_type = false;
		$product_metal = false;

		$parse_weight_array = array("1000","500","100","50","20","10","5","2","1");


		foreach($parse_weight_array as $weight) {
			$query = str_replace($weight . "g", $weight . "gram", $query);
			$query = str_replace($weight . " g", $weight . "gram", $query);
			$query = str_replace($weight . ".00g", $weight . "gram", $query);
			$query = str_replace($weight . ".00 g", $weight . "gram", $query);
		}

		$pattern = array("'é'", "'è'", "'ë'", "'ê'", "'É'", "'È'", "'Ë'", "'Ê'", "'á'", "'à'", "'ä'", "'â'", "'å'", "'Á'", "'À'", "'Ä'", "'Â'", "'Å'", "'ó'", "'ò'", "'ö'", "'ô'", "'Ó'", "'Ò'", "'Ö'", "'Ô'", "'í'", "'ì'", "'ï'", "'î'", "'Í'", "'Ì'", "'Ï'", "'Î'", "'ú'", "'ù'", "'ü'", "'û'", "'Ú'", "'Ù'", "'Ü'", "'Û'", "'ý'", "'ÿ'", "'Ý'", "'ø'", "'Ø'", "'œ'", "'Œ'", "'Æ'", "'ç'", "'Ç'");

		$replace = array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E', 'a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'A', 'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O', 'i', 'i', 'i', 'I', 'I', 'I', 'I', 'I', 'u', 'u', 'u', 'u', 'U', 'U', 'U', 'U', 'y', 'y', 'Y', 'o', 'O', 'a', 'A', 'A', 'c', 'C'); 


		$parse_array = array(
			"general" => array(
				"{kg}"		=> array("kilogram", "kilo"),
				"{gram}" 	=> array("gram","gramm","grammen"),
				"{oz}" 		=> array("troy ounce", "ounce","ounces","once","onces","unze","unzen","oz","onza"),
				"{bar}" 	=> array("barren","tacka","tackor"," bar ", " bars ","ingot","staaf","baren","lingots","lingot"),
				"{coin}" 	=> array("münze","munze","mynt","coin","munt","pièce","piece","munt","moneda"),
				"{gold}" 	=> array("gold","guld","goud","'or"," or","oro"),
				"{silver}" 	=> array("silber","silver","zilver","argent","plata"),
				"kronen" 	=> array("corona","korona"),
				"franc" 	=> array("franken","vreneli", "frank","franks","rooster","marianne"),
				"mark" 		=> array("marken","marks"),
				"kronor" 	=> array("krona","kr "),
				"gulden" 	=> array("guilder"),
				"peso" 		=> array("pesos"),
				"krugerrand" => array("krugerand","krügerand","kreugerand"),
				"0.05" 		=> array("1/20", "1 / 20", "twentieth"),
				"0.5" 		=> array("1/2", "1 / 2", "half"),
				"0.25" 		=> array("1/4", "1 / 4", "quarter"),
				"0.1" 		=> array("1/10", "1 / 10", "tenth"),
				"lunar" 	=> array("year of","jahr des","ratte","maus","mouse","affe","monkey","schwein", "ochse","hase","schlange","pferd","zieg","hahn","hund", "rabbit", " pig", " rat", "snake", " ox", "sheep",),
				"god"		=> array("perseus", "hades", "medusa", " hera ", "poseidon", "athen", "aphrodite", "zeus"),
				"star wars"	=> array("darth", "mandalorien", "yoda", "stormtrooper","anakin","boba", "jabba","obi-wan","lando","palpatine","chewbacca","c3po","r2d2","ahsoka","rebel"),
				"lord of the rings" => array("bruchtal", "legolas", "aragorn", "samweis","gollum","frodo", "gandalf","smeagol","sauron","saruman","theodon","treebeard","galadriel","bilbo","boromir","elrond","gimli","shelob","one ring","mount doom"),
				"pirates of the caribbean" => array("black pearl", "flying dutchman", "the empress", "anne´s revenge","anne's revenge","annes revenge", "jack sparrow","bill turner")
			)
		);



		$parsed_name = strtolower(preg_replace($pattern, $replace, $query));

		foreach($parse_array["general"] as $replacement => $search_terms) {
			foreach ($search_terms as $search_term) {
				$parsed_name = str_replace($search_term, $replacement , $parsed_name);
			}
		}

		//$parsed_name = str_replace("  ", " ", $parsed_name);
		//remove double spaces
		$parsed_name = preg_replace('/\s+/', ' ', $parsed_name);


		if(strpos($parsed_name, "{gold}") !== false) {
			$product_metal = "AU";
		}
		if(strpos($parsed_name, "{silver}") !== false) {
			$product_metal = "SI";
		}
		if(strpos($parsed_name, "{bar}") !== false) {
			$product_type = "bar";
		}
		if(strpos($parsed_name, "{coin}") !== false) {
			$product_type = "coin";
		}

		if($weight_string == false && $weight_unit == false) {
			if(strpos($parsed_name, "{oz}") !== false) {
				$weight_string = substr($parsed_name, 0, strpos($parsed_name, "{oz}"));
				$weight_unit = "oz";
			}
			if(strpos($parsed_name, "{gram}") !== false) {
				$weight_string = substr($parsed_name, 0, strpos($parsed_name, "{gram}"));
				$weight_unit = "gram";
			}
			if(strpos($parsed_name, "{kg}") !== false) {
				$weight_string = (int) substr($parsed_name, 0, strpos($parsed_name, "{kg}"))*1000;
				$weight_unit = "gram";
			}			
		}

		if($weight_string) {
			$product_weight = substr($weight_string,-6);
			$product_weight = preg_replace("/[^0-9.,\/]/","",$product_weight);
		}


		$keywords = array();
		
		$spelling_words =  array("maple","eagle","du","fra","lunar","krugerrand","rand","krug","kooka","liber","nugget","koala","panda","sov","arm","ron","beast","britan","buffalo","harmoni","hera","ubs","degu","perth","valc","mark","pound","dollar","peso","kronor", "gulden");
		foreach($spelling_words as $word) {
			if(strpos($parsed_name, $word) !== false) {
				$keywords[] = $word;
			}
		}

		$search_terms = explode(" ",preg_replace("/\{[^)]+\}/","",$parsed_name)); //regexp removes replaced metadata like "{coin}""

		$country_origin = "";
		foreach($search_terms as $word) {
			if(array_search(ucfirst($word),$translation[COUNTRY_DEFAULT]["country"]) !== false){
				$country_origin = array_search(ucfirst($word),$translation[COUNTRY_DEFAULT]["country"]);
			} elseif(!empty($word)) {
				$keywords[] = $word;
			}
		}

		// The country list is keyed by code, so the key has to be captured here -
		// without it $country_code was undefined and blanked out any country the
		// loop above had already found.
		foreach($translation[COUNTRY_DEFAULT]['country'] as $country_code => $country_name) {
			if(stripos($parsed_name,$country_name,0) !== false){
				$country_origin = $country_code;
			}
		}

		$country_synonyms = array(
			"CH" => array("zwitser","swiss","helveti"),
			"GB" => array("britain","british","engl"),
			"ES" => array("spani"),
			"AT" => array("sterreich")
		);


		foreach($country_synonyms as $country_code => $country_synonym_array) {
			foreach($country_synonym_array as $country_synonym) {
				if(stripos($parsed_name,$country_synonym,0) !== false){
					$country_origin = $country_code;
				}
			}
		}


		$rich_query = array(
			"original_name" => $query,
			"parsed_name" => $parsed_name,//preg_replace("/[^ \w\/]+/", "", $parsed_name),
			"weight" => $product_weight,
			"weight_unit" => $weight_unit,
			"type" => $product_type,
			"metal" => $product_metal,
			"country_origin" => $country_origin,
			"keywords" => $keywords
		);

		return $rich_query;
	}

	public function sanitize_query($query) {

		$parse_array = array(
			'%20' => ' ',
			'%25' => '%',
			'%28' => '(',
			'%29' => ')',
			'%22' => '"',
			'%bc' => '1/4',
			'%bd' => '1/2',
			'%27' => '',
			'%5c' => '',
			'%2F' => '/'			
		);

		foreach($parse_array as $text => $replacement) {
			$query = str_replace($text, $replacement , $query);
		}



		$forbidden_words = array("select","drop","empty","truncate","insert","delete","update","create","table","column","row","null","login","user","username","password","root","reset","database","increment","view","event","trigger");

		foreach ($forbidden_words as $forbidden_word) {
			if(strrpos($query, $forbidden_word)) {
				$query = "";
			}

		}

		return $query;

	}

}