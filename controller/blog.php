<?php
require __DIR__ . '/../model/catalog.php';
require __DIR__ . '/../model/commodity.php';
require __DIR__ . '/../translation/translations.php';
require __DIR__ . '/../model/statistics.php';
require __DIR__ . '/../model/content.php';
$page_view = new Statistic;
$page_view->track_pageview(HTTP);

$page_language = COUNTRY_DEFAULT;
$page_currency  = CURRENCY_DEFAULT;

$catalog = new Catalog;

$price_array = new Commodity;
$comodity_price_array = array();
$comodity_price_array['AU'] = $price_array->get_commodity_price('AU');
$comodity_price_array['SI'] = $price_array->get_commodity_price('SI');

$content = new Content;
$blog_array = array();
$blog_post_array = array();

$str_find   = array("\r\n", "\n", "\r");
$str_replace = '<br />';


$blog_posts = $content->get_blog_posts(false);


//get all posts
foreach ($blog_posts as $blog_post) {
	$post_text = str_replace($str_find, $str_replace, $blog_post['post_'.$page_language]);

	$blog_post_image = "/blog/placeholder_coins.jpg";
	if(!empty($blog_post['image'])) {
		$blog_post_image = str_replace("/images/uploads/","",$blog_post['image']);
	}

	$blog_array[] = array(
		'title' => $blog_post['title_'.$page_language], 
		'text' => $post_text, 
		'url' => "/blog/" .$blog_post['id'] . "/" . $content->convertTextToURL($blog_post['title_'.$page_language]),
		'image' => $blog_post_image
	);
}

$page_title = "Blog";
$page_meta_title = "";
$page_meta_description = "";

if(!empty($blog_post_id)) {
	$blog_post = $content->get_blog_post($blog_post_id);
	if(!empty($blog_post)) {
		$post_text = str_replace($str_find, $str_replace, $blog_post['post_'.$page_language]);
		$page_title = $blog_post['title_'.$page_language];

		$blog_post_array[] = array(
			'title' => $page_title, 
			'text' => $post_text, 
			'url' => "/blog/" .$blog_post['id'] . "/" . $content->convertTextToURL($blog_post['title_'.$page_language]),
			'image' => str_replace("/images/uploads/","",$blog_post['image'])
		);	
	
	}

} 

$og_tags = array();

//page title and description
/*switch ($page_language) {
	case "SE":
		$page_title = "Blog";
		$page_meta_title = "";
		$page_meta_description = "";
		$description = "";	
		break;
	case "DE":
		$page_title = "Blog";
		$page_meta_title = "";
		$page_meta_description = "";
		$description = "";	
		break;
	case "FR":
		$page_title = "Blog";
		$page_meta_title = "";
		$page_meta_description = "";
		$description = "";	
		break;
	case "NL":
		$page_title = "Blog";
		$page_meta_title = "";
		$page_meta_description = "";
		$description = "";	
		break;
	case "ES":
		$page_title = "Blog";
		$page_meta_title = "";
		$page_meta_description = "";
		$description = "";	
		break;
	default:
		$page_title = "Blog";
		$page_meta_title = "";
		$page_meta_description = "";		
		$description = "";	

}*/

$og_tags[] = array('property' => 'og:title', 'content' => $page_meta_title);
$og_tags[] = array('property' => 'og:description', 'content' => $page_meta_description);	

$current_url = $_SERVER['QUERY_STRING'];

$view_name = "blog";

require_once(BASE_DIR . '/view/base.view.php');

?>