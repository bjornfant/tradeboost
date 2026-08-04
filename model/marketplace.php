<?php

class Marketplace {

	public function get_tradera_products($query, $metal) {

		$tradera = tradeboost_tradera_credentials();

		$filter_weight = preg_split("/(oz |g )/", $query);
		$filter_years = preg_split("/(15|16|17|18|19)/", end($filter_weight));
		$matches = explode(" ",$filter_years[0]);

		$search_string = $matches[0] ." ". $matches[1];// . " " . $matches[2];

		$category = 22;
		if($metal == 'Guld') {
			$category = 220211;
		}

		$url = 'http://api.tradera.com/v3/searchservice.asmx/Search';
		$full_query = '?query='.urlencode($search_string).'&categoryId='.$category.'&pageNumber=1&orderBy=EndDateAscending&appId='.urlencode($tradera['app_id']).'&appkey='.urlencode($tradera['app_key']);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url.$full_query);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 4); //Timeout after 4 seconds
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		$output = simplexml_load_string(curl_exec($ch));
		$info = curl_getinfo($ch);

		if(curl_errno($ch)){
			error_log("Error connecting to  API", 0);	
		    return false;
		} 
		curl_close($ch);

		$products = array();
		//get more item data
		$counter = 0;
		foreach ($output->Items as $item) {
			$url = 'http://api.tradera.com/v3/publicservice.asmx/GetItem';
			$full_query = '?itemId='.$item->Id.'&appId='.urlencode($tradera['app_id']).'&appkey='.urlencode($tradera['app_key']);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url.$full_query);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 4); //Timeout after 4 seconds
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			$item_output = simplexml_load_string(curl_exec($ch));
			$info = curl_getinfo($ch);

			$products[] = $item_output;

			if(curl_errno($ch)){
				error_log("Error connecting to  API", 0);	
				break;
			} 
			curl_close($ch);

			$counter++;
			if($counter > 5) { break; }

		}

		if($products) {
			return $products;
		} else {
			return false;			
		}


	}

	public function get_ebay_products($metal, $query) {

		//campaign tradeboost

		$ebay_app_name = tradeboost_ebay_app_name();

		$affiliate_tracking = "&affiliate.trackingId=5338736546&affiliate.networkId=9"; //tradeboost.se

		/*$filter_weight = preg_split("/(oz |g )/", $query);
		$filter_years = preg_split("/(15|16|17|18|19)/", end($filter_weight));
		$matches = explode(" ",$filter_years[0]);

		$search_string = $matches[0] ." ". $matches[1];// . " " . $metal;*/

		$stringNoYear = preg_replace('/(19|20)[0-9][0-9]/', '', $query);
		$search_string = $stringNoYear;



		$ebay_market = 'EBAY-DE';

		switch (HTTP) {
			case "https://tradeboost.at/":
				$ebay_market = 'EBAY-AT';
				break;
			case "https://tradeboost.ch/":
				$ebay_market = 'EBAY-CH';
				break;
			case "https://tradeboost.es/":
				$ebay_market = 'EBAY-ES';
				break;
			case "https://trade-boost.co.uk/":
				$ebay_market = 'EBAY-GB';
				break;
			case "https://tradeboost.fr/":
				$ebay_market = 'EBAY-FR';
				break;
			case "https://tradeboost.be/":
				$ebay_market = 'EBAY-BE';
				break;
			case "https://tradeboost.it/":
				$ebay_market = 'EBAY-IT';
				break;
			case "https://tradeboost.nl/":
				$ebay_market = 'EBAY-NL';
				break;
			default:
				$ebay_market = 'EBAY-DE';
		}

		$url = 'https://svcs.ebay.com/services/search/FindingService/v1';
		$full_query = '?SECURITY-APPNAME='.urlencode($ebay_app_name).'&OPERATION-NAME=findItemsByKeywords&SERVICE-VERSION=1.0.0&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&keywords='.urlencode($search_string).'&paginationInput.entriesPerPage=5&GLOBAL-ID='.$ebay_market.'&siteid=0'.$affiliate_tracking;


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url.$full_query);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 4); //Timeout after 4 seconds
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		$output = json_decode(curl_exec($ch));

		$info = curl_getinfo($ch);
		if(curl_errno($ch)){
			error_log("Error connecting to  API", 0);	
		    return false;
		} 
		curl_close($ch);

		$products = false;
		if(isset($output->findItemsByKeywordsResponse[0]->searchResult[0]->item)) {
			$products = $output->findItemsByKeywordsResponse[0]->searchResult[0]->item;
		}

		if($products) {
			return $products;
		} else {
			return false;			
		}


	}


}