<?php
	$url_extension = "?utm_source=tradeboost.eu&utm_medium=referral&utm_campaign=tradeboost";
	if(strpos($url_store,"suissegold")) { //Make The correct currency on suisse gold links
		$url_extension .= "&change-currency=".$page_currency;
	} 
?>
	<script>
	function toggle_filter() {
		  var btnText = document.getElementById("filter_button");
		  $("#filters").toggleClass('d-none');

		  if ($("#filters").hasClass('d-none')) {
		    btnText.innerHTML = "<?php echo $translation[$page_language]['show_filter']; ?>";
		  } else {
		    btnText.innerHTML = "<?php echo $translation[$page_language]['hide_filter']; ?>";
		  }
	}


	</script>
		<div class="container-fluid page_head">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-9 pl-0">
						<h1><?php echo $page_title ?></h1>

						<div class="row">
							<div class="col-12 col-md-auto shop_usp"><?php echo $offer_insured; ?></div>
							<div class="col-12 col-md-auto shop_usp"><?php echo $offer_storage; ?></div>
							<div class="col-12 col-md-auto shop_usp"><?php echo $offer_store_pickup; ?></div>
						</div>

						<p class="intro"><?php echo $description ?>
						</p>

						</div>
						<div class="col-12 col-md-3 pl-0">
							<br/><br/>
							<?php if(!empty($url_store)) { ?>
													<a href="<?php echo $url_store . $url_extension; ?>" target="_blank"  rel="nofollow" onclick="trackOutboundLink('<?php echo $url_store; ?>'); return false;"  rel="nofollow"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
							  <path d="M4.715 6.542L3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.001 1.001 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
							  <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 0 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 0 0-4.243-4.243L6.586 4.672z"/>
							</svg>  <?php echo ucfirst($translation[$page_language]['visit_store']);?></a>
													<br>
							<?php } ?>
							<?php if(!empty($url_shipping_information)) { ?>

													<a href="<?php echo $url_shipping_information . $url_extension; ?>" target="_blank"  rel="nofollow" onclick="trackOutboundLink('<?php echo $url_shipping_information; ?>'); return false;"  rel="nofollow">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
							  <path d="M4.715 6.542L3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.001 1.001 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
							  <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 0 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 0 0-4.243-4.243L6.586 4.672z"/>
							</svg> <?php echo "Shipping information"; ?></a>
													<br>
							<?php } ?>
							<?php if(!empty($url_payment_information)) { ?>						
													<a href="<?php echo $url_payment_information . $url_extension; ?>" target="_blank"  rel="nofollow" onclick="trackOutboundLink('<?php echo $url_payment_information; ?>'); return false;"  rel="nofollow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
							  <path d="M4.715 6.542L3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.001 1.001 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
							  <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 0 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 0 0-4.243-4.243L6.586 4.672z"/>
							</svg>  <?php echo "Payment information"; ?></a>
													<br>
							<?php } ?>
						</div>
					</div>	
				</div>			
			</div>
		</div>
	
		<div class="container-fluid page_body">
			<div class="container">
			<div class="row">
				<div class="col-12 col-md-3 text-left pl-0 mt-md-3">
					<div class="d-none d-sm-block" id="filters" style="padding:0px"> 
						<form action="" method="get">
							<div class="form-group">
								 <div class="row">
									<?php require BASE_DIR . '/view/common/inc_filters.view.php'; ?>
									<div class="col-12" style="padding-top:8px;"><input type="submit" value="Filtrera" class="btn btn-dark" />
									<!--a href="product_catalog.php" class="btn btn-outline-light">Rensa filter</a--></div>
								</div>
							</div>
						</form>
					</div>
				</div>  

    			<div class="col-12 col-md-9 px-1">   
    				<div class="row">
				
				<?php
				foreach($filtered_products as $product) {
					$show_product = true;
					if(!empty($_GET['country']) && $_GET['country'] != $product['country_origin']) { $show_product = false; }
					if(!empty($metal) && $metal != $product['metal']) { $show_product = false; }
					if(!empty($product_type) && $product_type != $product['type']) { $show_product = false; }
					if(!empty($_GET['quantity']) && $_GET['quantity'] != $product['quantity']) { $show_product  = false; }
					if(!empty($_GET['manufacturer']) && $_GET['manufacturer'] != $product['manufacturer_id']) { $show_product  = false; }
					if(!empty($_GET['metal_weight_class']) && $_GET['metal_weight_class'] != $product['metal_weight_class']) { $show_product = false; }
					if(!$product['store_products']) { $show_product = false;} //only show products that are for sale somewhere
					

					if($show_product) {
						if(!empty($product['store_products'])) {
							$store_count = 0;
							$best_price = $product['best_price'];
							$best_price_per_oz = $product['best_price_per_oz'];
							$compare_to_spot = $product['best_price_compare_to_spot'];

						}
						$compare_string = "<small>+" . number_format($compare_to_spot, 1, '.', ' ') . "% " . $translation[$page_language]['over_spot'] . "</small>";
						if($compare_to_spot < 0) {
							$compare_string = "<small style='color:red'>" . number_format($compare_to_spot, 1, '.', ' ') . "% " . $translation[$page_language]['under_spot'] . "</small>";
						}

						$str_offer = "erbjudande";
						if($product['offers'] > 1) { $str_offer = "erbjudanden"; }
						$str_offer = $product['offers'] . " " . $str_offer;

						$bundle = "";
						if(isset($product['quantity']) && $product['quantity'] > 1) { $bundle = "Box "; }

						$url = $product['store_products'][0]['url'] . $url_extension;

						?>

							<div class='col-12 col-md-6' style="padding:10px;">
								<div class="category_item">
									<div class="row" style="min-height:90px">
										<div class="col-4 col-md-3 text-center">
											<a href="/product/<?php echo $product['url']; ?>">
											<?php $product_image = '';
											if(!empty($product['product_image'])) { 
												$product_image = "<img src='https://tradeboost.imgix.net/" . $product['product_image'] . "?w=100&h=100'  style='max-width:100%' alt='" . $bundle . ucfirst($translation[$page_language][$product['metal'].$product['type']]) . " " .   $product['name'] . "' />";  
											} else {
												$product_image = "<img src='https://tradeboost.eu/image/placeholder_" . $product['type'] . "_" . $product['metal'] . ".png' style='max-width:100%;opacity: 0.2'/>";
											}

											echo $product_image;
											?>
											</a>
										</div>
										<div class="col-8 col-md-9">
											<h3><a href="/product/<?php echo $product['url']; ?>"><?php echo  $bundle . ucfirst($translation[$page_language][$product['metal'].$product['type']]);?>  <?php echo $product['name'];?></a></h3>
											<small><?php echo $translation[$page_language]['country'][$product['country_origin']]; ?><br>
												<?php echo $translation[$page_language][$product['metal']]; ?>: <?php echo $catalog->format_weight($product['metal_weight_oz'],'oz'); ?> (<?php echo $catalog->format_weight($product['metal_weight_gram'],'gram'); ?>)</small>
								
										</div>
									</div>
									<hr/>

									<div class="row">
										
										<div class='col-4'><a href="<?php echo $url; ?>" class="btn btn-info" onclick="trackOutboundLink('<?php echo $url; ?>'); return false;"  rel="nofollow" target="_blank"><?php echo $translation[$page_language]['visit_store']?></a></div>
										<div class='col-8 text-right margin-adjust-6'><span class='price'><?php echo $translation[$page_language]['shop_price']?>: <?php echo $catalog->format_money($best_price, $page_currency); ?> </span><br><?php echo $compare_string; ?></small></div>
									</div>
								</div>
							</div>
						<?php
					}
					
				}
				?>
				</div>
			</div>
		</div>
	</div>
