<?php

// Defines functions only, and every page needs the indexing helpers below.
require_once BASE_DIR . '/controller/inc_filter.php';

if(!isset($page_meta_title)) { $page_meta_title = $page_title; }
if(!isset($page_meta_description)) { $page_meta_description = "Compare prices and find the best gold and silver products for investment online"; } 

$SHIPPING_COUNTRIES = array('AT','BE','BG','CH','CY','CZ','DE','DK','EE','ES','FI','FR','GB','GR','HR','HU','IE','IT','LT','LU','LV','MT','NL','PL','PT','RO','SE','SI','SK');

$shipping_array = array();
if($SHIPPING_COUNTRIES !== false && isset($page_language)) {
	foreach ($SHIPPING_COUNTRIES as $country_code) {
		$shipping_array[$translation[$page_language]['country'][$country_code]] = array('code' => $country_code, 'name' => $translation[$page_language]['country'][$country_code]);
	}

}
ksort($shipping_array);
array_unshift($shipping_array, array('code' => 'EU', 'name' => 'EU'));

if(isset($_COOKIE["shipping_country"])) {
	$selected_name = $translation[$page_language]['country'][$_COOKIE["shipping_country"]];
	$selected_flag = $country_flags[$_COOKIE["shipping_country"]];
	
	unset($shipping_array[$translation[$page_language]['country'][$_COOKIE["shipping_country"]]]);
} else {
	$selected_name = $translation[$page_language]['country']['EU'];
	$selected_flag = $country_flags['EU'];
	
	unset($shipping_array[$translation[$page_language]['country']['EU']]);	
}

$shipping_options = '';
if(!empty($shipping_array)) {
	foreach ($shipping_array as $shipping_code  => $shipping_country) {
		$set_cookie = "setCookie('shipping_country','".$shipping_country['code']."')";
		$shipping_options .= '<a class="dropdown-item" href="#" onclick="'.$set_cookie.'"><img src="https://tradeboost.eu/image/icons/flags/' . $country_flags[$shipping_country['code']] . '.png" style="height:18px" /> '.$shipping_country['name'].'</a>';
	}

$shipping_options = '<ul class="navbar-nav justify-content-end">
	  					<li class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          '.ucfirst($translation[$page_language]['shipping_to']).' <span><img src="https://tradeboost.eu/image/icons/flags/' . $selected_flag . '.png" style="height:18px" /> '. $selected_name .'</span></a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          '.$shipping_options .'
				      	</div>
				      	</li>
  					</ul>';

}
//page search suggestions
switch ($page_language) {
	case "SE":
		$search_suggestions = array("sovereign"=>"sovereign","maple leaf"=>"maple+leaf","rubel"=>"rubel", "lunar"=>"lunar");
		$page_tagline = "Jämför priser på guld och silver";
		break;
	case "DE":
		$search_suggestions = array("sovereign"=>"sovereign","maple leaf"=>"maple+leaf","star wars"=>"star+wars", "lunar"=>"lunar");
		$page_tagline = "Gold- und Silberpreisvergleich für Anleger";
		break;
	case "FR":
		$search_suggestions = array("sovereign"=>"sovereign","maple leaf"=>"maple+leaf","star wars"=>"star+wars", "lunar"=>"lunar");
		$page_tagline = "Comparaison des prix de l’or et de l’argent";
		break;
	case "NL":
		$search_suggestions = array("sovereign"=>"sovereign","maple leaf"=>"maple+leaf","star wars"=>"star+wars", "lunar"=>"lunar");
		$page_tagline = "Goud- en zilverprijsvergelijking voor beleggers";
		break;
	case "ES":
		$search_suggestions = array("sovereign"=>"sovereign","maple leaf"=>"maple+leaf","star wars"=>"star+wars", "lunar"=>"lunar");
		$page_tagline = "Comparación de precios del oro y la plata";
		break;
	default:
		$search_suggestions = array("sovereign"=>"sovereign","maple leaf"=>"maple+leaf","star wars"=>"star+wars", "lunar"=>"lunar");
		$page_tagline = "Gold and silver price comparison for investors";
}



?>
<html>
	<head>
		<title><?php echo $page_meta_title ?> | <?php echo SITE_NAME ?></title>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="<?php echo $page_meta_description; ?>">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<meta name="gb-site-verification" content="a6f59b2284fb79abfc7059f7a92869d759dcfd9a">
		<?php
		/**
		 * A filtered or re-sorted listing is the same products in another order,
		 * so it is kept out of the index while its links are still followed -
		 * that is what lets the crawler reach the products through it.
		 *
		 * noindex and canonical are deliberately not combined: they tell the
		 * crawler two different things about the same page. A filtered page gets
		 * the directive, an unfiltered one gets the canonical.
		 *
		 * These URLs must stay crawlable for this to work. Disallowing them in
		 * robots.txt would stop the crawler from ever reading the noindex, and
		 * the address could still end up in the index without its content.
		 */
		$tradeboost_filtered = function_exists('tradeboost_has_active_filters') && tradeboost_has_active_filters();

		//Don't index 404
		if(strlen($page_title) < 2) { ?>
		<meta name="robots" content="noindex" />
		<?php } elseif($tradeboost_filtered) { ?>
		<meta name="robots" content="noindex,follow" />
		<?php } ?>
		<link rel="stylesheet" type="text/css" href="/css/base.css?ver=2.03" />
		<link rel="icon" href="https://tradeboost.eu/image/icons/icon32.png" sizes="32x32" />	
		<link rel="icon" href="https://tradeboost.eu/image/icons/icon192.png" sizes="192x192" />
		<link rel="icon" href="https://tradeboost.eu/image/icons/icon512.png" sizes="512x512" />
		<?php
		// The listings had no canonical at all, so each filter combination read
		// as its own page. They now point at the unfiltered address.
		$tradeboost_canonical = '';
		if(!$tradeboost_filtered) {
			if(!empty($cannonical)) {
				$tradeboost_canonical = $cannonical;
			} elseif(function_exists('tradeboost_canonical_url')) {
				$tradeboost_canonical = tradeboost_canonical_url();
			}
		}
		if(!empty($tradeboost_canonical)) { ?>
		<link href="<?php echo htmlspecialchars($tradeboost_canonical, ENT_QUOTES); ?>" rel="canonical" />
		<?php }?>
		<?php if(!empty($og_tags)) { 
			foreach($og_tags as $og_tag) {
		?>
		<meta property="<?php echo htmlspecialchars($og_tag['property'], ENT_QUOTES); ?>" content="<?php echo htmlspecialchars($og_tag['content'], ENT_QUOTES); ?>" />
		<?php
			}
		}?>

		<script>
			function search_page(query) {
				window.location = "<?php echo strtoupper(HTTP) ?>search/" + query;
			}
		</script>
	</head>
	<body>
	<div class="container-fluid">
		<div class="row px-0">
			<div class="col-12 text-center d-block tagline">
				<?php echo $page_tagline; ?>
			</div>
		</div>
	</div>
	<?php include 'inc_metal_price.view.php'; ?>
	<div class="container-fluid menu px-lg-5 "><!-- sticky-top -->
		<!-div class="container px-0"-->
			<nav class="navbar navbar-expand-lg navbar-dark">
			  <a class="navbar-brand" href="/"><?php echo strtoupper(SITE_NAME) ?></a>

  <button class="btn d-lg-none" data-toggle="collapse" data-target="#searchBox" role="button" aria-expanded="false" aria-controls="collapseExample" style="color:#ffffff"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></button>


			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border-radius: 0px;">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav mr-auto">
			      <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <?php echo ucfirst($translation[$page_language]['buy_gold']); ?>
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="/products/goldcoins"><?php echo ucfirst($translation[$page_language]['AUcoins']); ?></a>
			          <a class="dropdown-item" href="/products/goldbars"><?php echo ucfirst($translation[$page_language]['AUbars']); ?></a>
			          <div class="dropdown-divider"></div>
			          <a class="dropdown-item" href="/group/masterbox-gold"><?php echo ucfirst($translation[$page_language]['monsterbox']); ?></a>
			          <a class="dropdown-item" href="/group/tube-gold-coins"><?php echo ucfirst($translation[$page_language]['cointube']); ?></a>
			      	</div>
			      </li>
			       <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <?php echo ucfirst($translation[$page_language]['buy_silver']); ?>  
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="/products/silvercoins"><?php echo ucfirst($translation[$page_language]['SIcoins']); ?></a>
			          <a class="dropdown-item" href="/products/silverbars"><?php echo ucfirst($translation[$page_language]['SIbars']); ?></a>
			          <div class="dropdown-divider"></div>
			          <a class="dropdown-item" href="/group/masterbox-silver"><?php echo ucfirst($translation[$page_language]['monsterbox']); ?></a>
			          <a class="dropdown-item" href="/group/tube-silver-coins"><?php echo ucfirst($translation[$page_language]['cointube']); ?></a>
			        </div>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="/price_realtime/gold"><?php echo ucfirst($translation[$page_language]['AUprice']); ?></a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="/price_realtime/silver"><?php echo ucfirst($translation[$page_language]['SIprice']); ?></a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="/gifts"><?php echo ucfirst($translation[$page_language]['gift_ideas']); ?></a>
			      </li>

			    <?php echo $shipping_options ;?>
			    </ul>
			    <form  class="form-inline my-2 my-lg-0 search d-none d-lg-block" action="/search" method="GET">
					<input type="text" class="form-control" placeholder="" name="query" id="query" maxlength="50" style="width:200px">
					<button class="btn btn-light" type="submit" id="button-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
					<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></button>
			    </form>
			</nav>


		<!--/div-->
		<div class="collapse" id="searchBox" >
		  <div class="card card-body text-center" style="background-color: #112C7E">
			    <form  class="form-inline my-2 my-lg-0 search" action="/search" method="GET">
					<input type="text" class="form-control" placeholder="" name="query" id="query" maxlength="50" style="width:80%">
					<button class="btn btn-light" type="submit" id="button-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
					<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></button>
			    </form>
			    <p style="padding-top:10px;font-size: 0.8em;text-align: left;">
		    	<a href="/search?query=sovereign">sovereign</a> | <a href="/search?query=maple+leaf">maple leaf</a> | <a href="/search?query=star+wars">star wars</a> | <a href="/search?query=valcambi">valcambi</a> | <a href="/search?query=lunar">lunar</a>
		    	</p>
		  </div>
		</div>
	</div>		