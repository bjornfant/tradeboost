<?php
class Content {
	public function get_blog_posts($filter_array = false) {

		$db = new db;

		$sql_where = "";
		if(!empty($filter_array)) {
			$sql_where = "WHERE ";

		}

		$sql = "SELECT * FROM blog ORDER BY id DESC"; 

		$blog_posts = $db->query_select($sql);

		return $blog_posts->rows;
	}

	public function get_blog_post($post_id) {
		$db = new db;

		$sql = "SELECT * FROM blog WHERE id = ?";
		$blog_post = $db->query_select($sql, array($post_id));

		if($blog_post->num_rows > 0) {
			return $blog_post->row;;
		} else {
			return false;
		}

	}
	function convertTextToURL($str) { 
		
	  
		$str = transliterator_transliterate('Any-Latin; Latin-ASCII; [\u0080-\u7fff] remove', $str);

	    // Convert string to lowercase 
	    $str = strtolower($str); 
	    
	    // Convert special characters to ASCII equivalents
	    //$str = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	    
	    // Replace non-alphanumeric characters with hyphens 
	    $str = preg_replace('/[^a-z0-9]+/', '-', $str); 
	    
	    // Remove consecutive hyphens 
	    $str = preg_replace('/-+/', '-', $str); 
	    
	    // Trim hyphens from the beginning and ending of string 
	    $str = trim($str, '-'); 
	    
	    return $str; 
	} 	
}
?>