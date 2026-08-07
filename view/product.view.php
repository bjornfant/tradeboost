<?php
/**
 * Two independent blocks: the product, and the questions beneath it.
 *
 * Both are encoded rather than concatenated. The questions carry product names
 * and prices, so a stray quote used to break the JSON silently, and the closing
 * script tag sat outside the FAQ condition - a page without questions emitted a
 * closing tag with nothing opening it.
 */
if(!empty($schema_org_product)) { ?>
<script type="application/ld+json"><?php echo json_encode($schema_org_product, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
<?php }

if(!empty($schema_org_faqpage)) {

	$schema_questions = array();

	foreach($schema_org_faqpage as $faq) {
		$schema_questions[] = array(
			'@type'          => 'Question',
			'name'           => $faq['question'],
			'acceptedAnswer' => array('@type' => 'Answer', 'text' => $faq['answer']),
		);
	}

	$schema_faq = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $schema_questions,
	);
?>
<script type="application/ld+json"><?php echo json_encode($schema_faq, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
<?php } ?>		
		<div class="container-fluid page_head">
			<div class="container">
				<div class="row">
					<?php if(strlen($page_title)>1) { ?>
					<div class="col-6 col-md-4 px-0">
						<h1><?php echo $page_title ?></h1>
						<p class="intro">
							<strong>
							<?php echo $translation[$page_language][$product['metal']]; ?>: <?php echo $catalog->format_weight($product['metal_weight_oz'],'oz'); ?> (<?php echo $catalog->format_weight($product['metal_weight_gram'],'gram'); ?>)
							<?php echo "<br/>" . ucfirst($translation[$page_language][$product['metal'].'value']) . ": " . $catalog->format_money($product['metal_weight_oz']*$comodity_price_array[$product['metal']][$page_currency]['price_per_oz'],$page_currency,2); ?> <br>
							</strong>
							<small>
							<a href="<?php echo "/country/".$product['country_origin']."?metal=".$product['metal']."&type=".$product['type']?>"><?php echo ucfirst($translation[$page_language][$product['metal'].$product['type']]);?> <?php echo $translation[$page_language]['country'][$product['country_origin']]; ?></a><br>								
							<?php echo ucfirst($translation[$page_language]['minted_by']);?> <a href="/manufacturer/<?php echo $product['manufacturer_id']; ?>"><?php echo $product['manufacturer_name']; ?></a><br>
							<?php if (!empty($product['product_group_name'])) { 
							 echo ucfirst($translation[$page_language]['product_group']);?> <a href="/group/<?php echo $product['product_group_url']; ?>"><?php echo $product['product_group_name']; ?></a><br>
							<?php } ?>
							<?php if (!empty($product['fineness'])) { 
							 echo ucfirst($translation[$page_language][$product['metal'].'fineness']);?>: <?php echo $product['fineness']; ?><br>
							<?php } ?>
							<?php if (!empty($product['diameter'])) { 
							 echo ucfirst($translation[$page_language]['diameter']);?>: <?php echo $product['diameter']; ?> mm <?php echo $sponsored_capsule_link ?>
							<?php } ?>
							</small>
						<p>
					</div>
					<div class="col-6 col-md-4 px-0">
						<?php $product_image = '';
							if(!empty($product['product_image'])) { 
								$product_image = "<a href=https://tradeboost.imgix.net/" . $product['product_image'] . "?w=500&h=500'><img src='https://tradeboost.imgix.net/" . $product['product_image'] . "?w=240&h=240' style='max-width:100%;float:left;padding-right:20px;padding-bottom:20px;filter: drop-shadow(.5rem .5rem 1rem black)' alt='" . $page_title . "' /></a>&nbsp;&nbsp;"; 
							} 
								echo $product_image;

							?>
					</div>
					<div class="col-12 col-md-4 px-0 d-none d-lg-block" id="pricetrend">

					<?php 
					if($product['metal'] == "AU") {
						echo "<p class='chart-title'>" . ucfirst($translation[$page_language]['AUprice']) . " $/oz</p>";
					?>
							<!-- TradingView Widget BEGIN -->
							<div class="tradingview-widget-container">
							  <div class="tradingview-widget-container__widget"></div>
							  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="black-text">TradingView</span></a></div>
							  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-overview.js" async>
							  {
							  "symbols": [
							    [
      							"TVC:GOLD|60M"
							    ]
							  ],
							  "chartOnly": true,
							  "width": "380",
							  "height": "250",
							  "locale": "en",
							  "colorTheme": "dark",
							  "autosize": true,
							  "showVolume": false,
							  "showMA": false,
							  "hideDateRanges": false,
							  "hideMarketStatus": false,
							  "hideSymbolLogo": true,
							  "scalePosition": "right",
							  "scaleMode": "Normal",
							  "fontFamily": "-apple-system, BlinkMacSystemFont, Trebuchet MS, Roboto, Ubuntu, sans-serif",
							  "fontSize": "10",
							  "noTimeScale": false,
							  "valuesTracking": "1",
							  "changeMode": "price-and-percent",
							  "chartType": "area",
							  "maLineColor": "#2962FF",
							  "maLineWidth": 1,
							  "maLength": 9,
							  "lineWidth": 2,
							  "lineType": 0,
							  "dateRanges": [
							    "60m|1W",
							    "12m|1D",
							    "6m|120",
							    "3m|60"
							  ],
							  "lineColor": "rgba(251, 192, 45, 1)"
							}
							  </script>
							</div>
							<!-- TradingView Widget END -->

					<?php } elseif($product['metal'] == "SI") {
						echo "<p class='chart-title'>" . ucfirst($translation[$page_language]['SIprice']) . " $/oz</p>";
					?>
							<!-- TradingView Widget BEGIN -->
							<div class="tradingview-widget-container">
							  <div class="tradingview-widget-container__widget"></div>
							  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="black-text">TradingView</span></a></div>
							  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-overview.js" async>
							  {
							  "symbols": [
							    [
      							"TVC:SILVER|60M"
							    ]
							  ],
							  "chartOnly": true,
							  "width": "380",
							  "height": "240",
							  "locale": "en",
							  "colorTheme": "dark",
							  "autosize": true,
							  "showVolume": false,
							  "showMA": false,
							  "hideDateRanges": false,
							  "hideMarketStatus": false,
							  "hideSymbolLogo": true,
							  "scalePosition": "right",
							  "scaleMode": "Normal",
							  "fontFamily": "-apple-system, BlinkMacSystemFont, Trebuchet MS, Roboto, Ubuntu, sans-serif",
							  "fontSize": "10",
							  "noTimeScale": false,
							  "valuesTracking": "1",
							  "changeMode": "price-and-percent",
							  "chartType": "area",
							  "maLineColor": "#2962FF",
							  "maLineWidth": 1,
							  "maLength": 9,
							  "lineWidth": 2,
							  "lineType": 0,
							  "dateRanges": [
							    "60m|1W",
							    "12m|1D",
							    "6m|120",
							    "3m|60"
							  ],
							  "lineColor": "rgba(192, 192, 192, 1)"
							}
							  </script>
							</div>
							<!-- TradingView Widget END -->

					<?php } ?>

						



					</div>
					<?php } else {
						echo "Page not found";
					}?>
				</div>
			</div>
		</div>

		<div class="container-fluid page_body" >			
		<div class="container">
			<div class="row ">
    			<div class="col-12 col-md-8 px-0">
					<p>
					<small><a href="/"><svg width="16" height="16" viewBox="0 0 16 16"><path d="M3 5v5h3v-3h3v3h3v-5L8,3z"/></svg> &gt;</a>
					 <a href="<?php echo $category_cannonical ?>"><?php echo ucfirst($translation[$page_language][$product['metal'].$product['type']."s"]) ?> &gt;</a> <?php echo $page_title ?>
					</small>
					</p>

				<?php
				if(!empty($product['store_products'])) {
					$first_item = 'style="background-color:#dff0d8;border:1px solid #3c763d;margin-top:0px;"';
					$first_item_text = '';//ucfirst($translation[$page_language]['lowest_price']) . '!<br>';
					$ad_counter = 1;

				foreach($products_grouped_by_store_array as $store) { ?>
						<div class='col-12 px-0' style="padding:10px;">
							<div class="category_item" <?php echo $first_item ?>>

					<?php foreach($store['products'] as $key => $store_product) {

						$compare_to_spot = 100*((float) $store_product['price_per_oz']-(float) $comodity_price_array[$product['metal']][$page_currency]['price_per_oz'])/(float) $comodity_price_array[$product['metal']][$page_currency]['price_per_oz'];

						$stock = "<span class='stockout'>✗</span> " . $translation[$page_language]['out_stock'];
						if($store_product['stock'] == 1) {
							$stock = "<span class='stockin'>✓</span> " . $translation[$page_language]['in_stock'];	
						}

						$url = $store_product['url'];
						if(strpos($url,"suissegold")) { //Make The correct currency on suisse gold links
							$url = $url . "?change-currency=".$page_currency;
						}
						if(strpos($url,"?")) { //Make The correct currency on suisse gold links
							$url = $url . "&utm_source=tradeboost.eu&utm_medium=referral&utm_campaign=tradeboost";
						} else {
							$url = $url . "?utm_source=tradeboost.eu&utm_medium=referral&utm_campaign=tradeboost";	
						}

						$compare_string = "<small>+" . number_format($compare_to_spot, 1, '.', ' ') . "% " . $translation[$page_language]['over_spot'] . "</small>";
						if($compare_to_spot < 0) {
							$compare_string = "<small>" . number_format($compare_to_spot, 1, '.', ' ') . "% " . $translation[$page_language]['under_spot'] . "</small>";
						}
						$original_price = "";
						if(isset($store_product['original_price'])) {
							$original_price = "<br><small>(". $catalog->format_money($store_product['original_price'], $store_product['original_currency']) . ")</small>";
						}
						

					?>

				<?php if($key == 0) { ?>

								<div class='row'>
									<div class="col-12">

									<?php
										$store_info = $store_array[$store_product['store_id']];

										$offer_insured = "<span class='stockout'>✗</span> " . $translation[$page_language]['shop']['not_offer_insured_delivery'];	;
										if($store_info['offer_insured_delivery'] == 1) {
											$offer_insured = "<span class='stockin'>✓</span> " . $translation[$page_language]['shop']['offer_insured_delivery'];	
										}
										$offer_storage = "<span class='stockout'>✗</span> " . $translation[$page_language]['shop']['not_offer_storage'];
										if($store_info['offer_storage'] == 1) {
											$offer_storage = "<span class='stockin'>✓</span> " . $translation[$page_language]['shop']['offer_storage'];
										}
										$offer_store_pickup = "<span class='stockout'>✗</span> " . $translation[$page_language]['shop']['not_offer_store_pickup'];
										if($store_info['offer_store_pickup'] == 1) {
											$offer_store_pickup = "<span class='stockin'>✓</span> " . $translation[$page_language]['shop']['offer_store_pickup'];
										}

										echo "<h3><img src='https://tradeboost.eu/image/icons/flags/" . $country_flags[$store_info['country']] . ".png' style='width:28px' /> <a href='/shop/" . $store_info['url'] . "'>" . $store_info['name'] . "</a> <a href='/shop/" . $store_info['url'] . "' class='product-link'><small>". $translation[$page_language]['read_more'] ."</small></a></h3><small>" . $translation[$page_language]['shop']['shipping_fee'] . ": <i>" . $store_info['shipping_fee'] . "</i></small><br><div class='d-none d-md-block'><small>";

										echo $offer_insured . " &nbsp; ";
										echo $offer_storage . " &nbsp; "; 
									 	echo $offer_store_pickup . "</small></div>";

										echo "<hr>";
									
									?>

									</div>
								</div>

								<div class="row">
									
									<div class='col-5'><h3><a href="<?php echo $url; ?>" target="_blank" rel="noopener noreferrer nofollow"  class="product-link"><?php echo $store_product['store_product_name']; ?> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
  <path d="M4.715 6.542L3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.001 1.001 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
  <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 0 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 0 0-4.243-4.243L6.586 4.672z"/>
</svg></a></h3><?php echo $stock; ?><br>

									</div>
									<div class='col-7 text-right'><span class="price"><small><?php echo $first_item_text?></small><?php echo $catalog->format_money($store_product['price'], $page_currency); ?></span><?php echo $original_price; ?><br><?php echo $compare_string; ?><br>

										<div>
											<a href="<?php echo $url; ?>" target="_blank" rel="noopener noreferrer nofollow"class="btn btn-info btn-cta"><small><?php echo $translation[$page_language]['visit_store']?></small></a>
										</div>	
									</div>
								</div>
							<?php if(count($store['products'])>1) { ?>
								<div class="row">
									<div class="col-12">
										<hr/>
									<button type="button" class="btn btn-outline-secondary" style="min-width:50%;" data-toggle="collapse" data-target="#more_offers<?php echo $store_product['store_id']; ?>" >
									  <?php echo ucfirst($translation[$page_language]['more_offers']); ?> (<strong><?php echo count($store['products'])-1;?></strong>) &#9660;
									</button>
									</div>
								</div>
								<div id="more_offers<?php echo $store_product['store_id']; ?>"  class="collapse in"> 
									<br><br>
							<?php } ?>
						<?php } else { ?>
								<?php if($key > 1) { ?>
									<hr/>
								<?php } ?>
									<div class="row">
										<div class='col-7'>
											<a href="<?php echo $url; ?>" target="_blank" rel="noopener noreferrer nofollow" class="product-link"><?php echo $store_product['store_product_name']; ?> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
  <path d="M4.715 6.542L3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.001 1.001 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
  <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 0 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 0 0-4.243-4.243L6.586 4.672z"/>
</svg> </a><br><small><?php echo $stock; ?></small>
										</div>
										<div class='col-5 text-right'><span class="price"><?php echo $catalog->format_money($store_product['price'], $page_currency); ?></span><?php echo $original_price; ?><br><?php echo $compare_string; ?><br>

											<div>
											<a href="<?php echo $url; ?>" target="_blank" rel="noopener noreferrer nofollow"class="btn btn-info"><small><?php echo $translation[$page_language]['visit_store']?></small></a>
											</div>	
										</div>
									</div>

						<?php } ?>

						<?php if($key == (int) count($store['products'])-1 && count($store['products'])>1) { ?>
							</div> 	
						<?php } ?>	


					<?php } 

					if($store_info['name'] == "Bullion by post") {/* ?>
					<hr/>
					<small>Ad</small><br>
					<a href="https://www.bullionbypost.eu/accounts/login/?referral_code=WGO3SHPC"  rel="nofollow"  target="_blank">
					<div style="width:100%;text-align:center;background-color:#fff">
						<img src="https://tradeboost.eu/image/logo_bbp.png" style="max-width:100%" /><br>
						<p>
							<h2>Get a free 1 oz Silver Britannia on your first order</h2>
						</p>
						<p>
							<img src="https://tradeboost.imgix.net/coin_1_oz_britannia_si_gb_gb.png?w=240&h=240" style="max-width:100%" />
						</p>
						<p>
							Get a free coin on your first order over €300 <br> 
							by using the Tradeboost gift code <br><span style="font-family: courier; color: #99cc99;font-size:2em;line-height:2em"><strong>WGO3 SHPC</strong></span><br/>
							Tradeboost will also get a free Britannia, so you also support this website!<br>
							Shipping is free and insured.
						</p>
						<br><br>
					</div>
					</a>

					<?php				
					*/}
					?>

						</div>
					</div>
			<?php 

				if($ad_counter == 2) { 
					if(isset($ad_inventory['middle_first'])) {
						echo $ad_inventory['middle_first'];
						$ad_counter = 3;
					} elseif(isset($ad_inventory['middle'])) {
						echo $ad_inventory['middle'];
						$ad_counter = 3;
					} 
				}


				$ad_counter++;


				if(isset($ad_inventory['middle']) && $ad_counter == 7) {
					echo $ad_inventory['middle'];
					$ad_counter = 3;
				}

					$first_item = "";
					$first_item_text = "";

			}
		} else { ?>
				<div class="row">
					<div class="col-12">
						<div class="category_item">
						<strong><?php echo $translation[$page_language]['no_offers']?></strong>
						</div>
					</div>									
				</div> 
	<?php } ?>


					<?php if(!empty($ebay_products[0]) && empty($product['store_products'])) { ?>
					<div class="row">
						<div class="col-12 px-0 px-md-3">							
					<h2>Ebay <?php echo $translation[$page_language]['country'][$_COOKIE["shipping_country"]];?></h2>
					<?php
					$counter = 0; //max 6 items
					foreach ($ebay_products as $item) {

						$original_item = (array) $item->sellingStatus[0]->currentPrice[0];
						$original_item_price =  $original_item['__value__'];
						$original_item_currency = $original_item['@currencyId'];
						$item_price = $catalog->convert_currency('EUR', 'SEK', $original_item_price);
						$item_price = $catalog->format_money($item_price);
						$original_item_price =  $catalog->format_money($original_item_price, $original_item_currency);
						$url = $item->viewItemURL[0];

						//print_r($item);

					//	if(isset($item->ShortDescription)) {
					?>
					<div class="col-12 px-0" style="padding-top:10px;">
						<a href="<?php echo $url; ?>" rel="nofollow" target="_blank">
						<div class="category_item">
							<div class="row">
								<div class="col-12 text-center" style="padding-bottom:20px;">
									<?php $product_image = '';
									if(!empty($item->galleryURL[0])) { 
										$product_image = "<img src='". str_replace("l140","l640",$item->galleryURL[0]) . "' style='width:100%'/>"; //l640 = hack to display a bigger thumbnail
									} 
									echo $product_image;
									?>
								</div>
								<div class="col-12" style="min-height:80px">
									<?php echo $item->title[0]; ?>
								</div>
							</div>

							<div class="row">
								<div class="col-12 text-right"><a href="<?php echo $item->viewItemURL[0]; ?>" target="_blank" rel="nofollow"><span class="price"><?php echo $translation[$page_language]['auction']['current_bid'] . ": " . $original_item_price; ?></span></a><br><small>
									<?php echo $translation[$page_language]['auction']['auction_ends'] . " " .  substr($item->listingInfo[0]->endTime[0], 0,10); ?></small></div>
							</div>
						</div>
						</a>
					</div>
					<?php
						//}
					}?>
					</div>
			</div>

					<?php

				 } 
				 ?>


				<?php if(!empty($product_description)) {?>
				<hr/>
				<p>
					<?php echo $product_description; ?>
				</p>
				<?php } ?>


				<br><br>

				    
				</div>

				<div class="col-12 col-md-4">

				<?php if(!empty($related_products)) { ?>
					<div class="row related_products">
						<div class="col-12 px-0 px-md-3">						
					<h2><?php echo ucfirst($translation[$page_language]['more_offers']); ?></h2>
				<?php
				foreach($related_products as $related_product) {
					$show_product = true;
					if($show_product) {

						if(!empty($related_product['store_products'])) {
							$store_count = 0;
							$best_price = $related_product['best_price'];
							$best_price_per_oz = $related_product['best_price_per_oz'];
							$compare_to_spot = $related_product['best_price_compare_to_spot'];

							$compare_string = "<small>+" . number_format($compare_to_spot, 1, '.', ' ') . "% " . $translation[$page_language]['over_spot'] . "</small>";
							if($compare_to_spot < 0) {
								$compare_string = "<small>" . number_format($compare_to_spot, 1, '.', ' ') . "% " . $translation[$page_language]['under_spot'] . "</small>";
							}

						}

						$str_offer = $translation[$page_language]['offer'];
						if($related_product['offers'] > 1) { $str_offer = $translation[$page_language]['offers']; }

						if($related_product['offers'] > 99) { $related_product['offers'] = "99+"; }

						$str_offer = $related_product['offers'] . " " . $str_offer;

						$bundle = "";
						if($related_product['quantity'] > 1) { $bundle = "Box "; }

						$product_title = $bundle . ucfirst($translation[$page_language][$related_product['metal'].$related_product['type']]) . " " .   $related_product['name'];

						?>

							<div class='col-12' style="padding:10px;padding-left:0px">
								<div class="category_item">
									<div class="row">
										<div class="col-4 text-center">
											<a href="/product/<?php echo $related_product['url']; ?>">
											<?php $product_image = '';
											if(!empty($related_product['product_image'])) { 
												$product_image = "<img src='https://tradeboost.imgix.net/" . $related_product['product_image'] . "?w=100&h=100' style='max-width:100%' alt='" . $product_title . "' />"; 
											} else {
												$product_image = "<img src='https://tradeboost.eu/image/placeholder_" . $related_product['type'] . "_" . $related_product['metal'] . ".png' alt='" . $product_title . "' style='max-width:100%;max-height:100px;opacity: 0.2'/>";
											}

											echo $product_image;
											?>
											</a>
										</div>
										<div class="col-8">
											<h3><a href="/product/<?php echo $related_product['url']; ?>"><?php echo $product_title ?></a></h3>
											<small><?php echo $translation[$page_language]['country'][$related_product['country_origin']]; ?><br>
												<?php echo $translation[$page_language][$related_product['metal']]; ?>: <?php echo $catalog->format_weight($related_product['metal_weight_oz'],'oz'); ?> (<?php echo $catalog->format_weight($related_product['metal_weight_gram'],'gram'); ?>)</small>
								
										</div>
									</div>
									<hr/>

									<div class="row">
										
										<div class='col-5'><a href="/product/<?php echo $related_product['url']; ?>" class="offer"><?php echo  $str_offer; ?></a></div>
										<div class='col-7 text-right margin-adjust-6'><a href="/product/<?php echo $related_product['url']; ?>"><span class='price'><span class="d-sm-block"><small><?php echo ucfirst($translation[$page_language]['lowest_price']) ?>: </small></span><?php echo $catalog->format_money($best_price, $page_currency); ?></span></a><br><?php echo $compare_string ?></div>
									</div>
								</div>

							</div>
						<?php
					}
				}
				?>

					</div>
			</div>

				<?php }?>



				<br><br>
				<?php if(isset($ad_inventory['right'])) {
					echo $ad_inventory['right'] . "<br><br>";
				}?>


					<?php if(!empty($tradera_products[0])) { ?>
					<div class="row">
						<div class="col-12 px-0 px-md-3">								
							<h2>Relaterat från Tradera</h2>
							<?php
							$counter = 0; //max 6 items
							foreach ($tradera_products as $item) {
								//print_r($item);

								if(isset($item->ShortDescription)) {
									$item_price = $catalog->format_money((int) $item->MaxBid, 'SEK');
							?>
							<div class='col-12 px-0' style="padding-top:10px;">
								<div class="category_item">
									<div class="row">
										<div class="col-12 text-center">
											<?php $product_image = '';
											if(!empty($item->ImageLinks->string[0])) { 
												$product_image = "<img src='".$item->ImageLinks->string[0] . "' style='width:100%'/>"; 
											} 
											echo $product_image;
											?>
										</div>
										<div class="col-12" style="min-height:80px">
											<a href="<?php echo $item->ItemLink; ?>" target="_blank" rel="nofollow">Tradera<h3><?php echo $item->ShortDescription; ?></h3></a>
											<?php echo $translation[$page_language]['auction']['auction_ends'] . " " .  substr($item->EndDate, 0,10); ?>
										</div>
									</div>

									<div class="row">
										<div class="col-12 text-right"><a href="<?php echo $item->ItemLink; ?>" target="_blank" rel="nofollow"><span class="price"><?php echo $translation[$page_language]['auction']['current_bid'] . ": " .  $item_price; ?></span></a><br><small></small></div>
									</div>
								</div>
							</div>

					<?php
							}
						} 
						?>
						</div>
					</div>

					 <?php } ?>


					<?php if(!empty($ebay_products[0]) && !empty($product['store_products'])) { ?>
					<div class="row">
						<div class="col-12 px-0 px-md-3">						
					<h2>Ebay <?php echo $translation[$page_language]['country'][$_COOKIE["shipping_country"]];?></h2>
					<?php
					$counter = 0; //max 6 items
					foreach ($ebay_products as $item) {

						$original_item = (array) $item->sellingStatus[0]->currentPrice[0];
						$original_item_price =  $original_item['__value__'];
						$original_item_currency = $original_item['@currencyId'];
						$item_price = $catalog->convert_currency('EUR', 'SEK', $original_item_price);
						$item_price = $catalog->format_money($item_price);
						$original_item_price =  $catalog->format_money($original_item_price, $original_item_currency);
						$url = $item->viewItemURL[0];

						//print_r($item);

					//	if(isset($item->ShortDescription)) {
					?>
					<div class='col-12 px-0' style="padding-top:10px;">
						<a href="<?php echo $url; ?>" rel="nofollow" target="_blank">
						<div class="category_item">
							<div class="row">
								<div class="col-12 text-center" style="padding-bottom:20px;">
									<?php $product_image = '';
									if(!empty($item->galleryURL[0])) { 
										$product_image = "<img src='". str_replace("l140","l640",$item->galleryURL[0]) . "' style='width:100%'/>"; //l640 = hack to display a bigger thumbnail
									} 
									echo $product_image;
									?>
								</div>
								<div class="col-12" style="min-height:80px">
									<?php echo $item->title[0]; ?>
								</div>
							</div>

							<div class="row">
								<div class="col-12 text-right"><a href="<?php echo $item->viewItemURL[0]; ?>" target="_blank" rel="nofollow"><span class="price"><?php echo $translation[$page_language]['auction']['current_bid'] . ": " . $original_item_price; ?></span></a><br><small>
									<?php echo $translation[$page_language]['auction']['auction_ends'] . " " .  substr($item->listingInfo[0]->endTime[0], 0,10); ?></small></div>
							</div>
						</div>
						</a>
					</div>
					<?php
						//}
					}?>
					</div>
			</div>

					<?php
				 } else {
				 ?>
				
				<br><br>

				<?php } ?>
				




				</div>
			</div>	
		</div>
	</div>