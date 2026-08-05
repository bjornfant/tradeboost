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
				<div class="col-12 pl-0">
					<h1><?php echo $page_title ?></h1>
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
									<div class="col-12" style="padding-top:8px;"><input type="submit" value="<?php echo $translation[$page_language]['do_filter']; ?>" class="btn btn-dark" />
									<!--a href="product_catalog.php" class="btn btn-outline-light">Rensa filter</a--></div>
								</div>
							</div>
						</form>
							<?php
		    				if(isset($ad_inventory['left'])) {
								echo $ad_inventory['left'];
							} ?>
					</div>
				</div>  

    			<div class="col-12 col-md-9 px-1">   
    				<div class="row">
    					<div class="col-12 pl-2"> 
	    					<span onclick="toggle_filter()" id="filter_button" class="btn btn-dark d-block d-sm-none" style="width:100%">
	    					<?php echo $translation[$page_language]['show_filter']; ?></span>
    					</div>
    				</div>
    				<div class="row">
				
				<?php
				foreach($filtered_products as $product) {
					$show_product = true;
					/*if(!empty($_GET['country']) && $_GET['country'] != $product['country_origin']) { $show_product = false; }
					if(!empty($metal) && $metal != $product['metal']) { $show_product = false; }
					if(!empty($product_type) && $product_type != $product['type']) { $show_product = false; }
					if(!empty($_GET['quantity']) && $_GET['quantity'] != $product['quantity']) { $show_product  = false; }
					if(!empty($_GET['product_group']) && $_GET['product_group'] != $product['product_group_id']) { $show_product  = false; }
					if(!empty($_GET['metal_weight_class']) && $_GET['metal_weight_class'] != $product['metal_weight_class']) { $show_product = false; }
					if(!$product['store_products']) { $show_product = false;} //only show products that are for sale somewhere
					*/

					if($show_product) {

						if(!empty($product['store_products'])) {
							$store_count = 0;
							$best_price = $product['best_price'];
							$best_price_per_oz = $product['best_price_per_oz'];
							$compare_to_spot = $product['best_price_compare_to_spot'];

							$compare_string = "<small>+" . number_format($compare_to_spot, 1, '.', ' ') . " %" . $translation[$page_language]['over_spot'] . "</small>";
							if($compare_to_spot < 0) {
								$compare_string = "<small>" . number_format($compare_to_spot, 1, '.', ' ') . "% " . $translation[$page_language]['under_spot'] . "</small>";
							}

						}

						$str_offer = $translation[$page_language]['offer'];
						if($product['offers'] > 1) { $str_offer = $translation[$page_language]['offers']; }
						$str_offer = $product['offers'] . " " . $str_offer;

						$bundle = "";
						/*if($product['quantity'] > 1) { $bundle = "Box "; }*/

						?>

							<div class='col-12 col-md-6' style="padding:10px;">
								<div class="category_item">
									<div class="row" style="min-height:90px">
										<div class="col-4 col-md-3 text-center">
											<a href="/product/<?php echo $product['url']; ?>">
											<?php $product_image = '';
											if(!empty($product['product_image'])) { 
												$product_image = "<img src='https://tradeboost.imgix.net/" . $product['product_image'] . "?w=100&h=100' style='max-width:100%' alt='" . $bundle . ucfirst($translation[$page_language][$product['metal'].$product['type']]) . " " .   $product['name'] . "' />"; 
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
										
										<div class='col-4'><a href="/product/<?php echo $product['url']; ?>" class="offer"><?php echo  $str_offer; ?></a></div>
										<div class='col-8 text-right'>
										<?php if($product['offers'] > 0) { ?>
											<a href="/product/<?php echo $product['url']; ?>">
											<span class='price'><?php echo ucfirst($translation[$page_language]['lowest_price']) ?>: 
												<?php echo $catalog->format_money($best_price, $page_currency); ?></span></a>
												<br><?php echo $compare_string ?>
										<?php } ?>
										</div>
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
	<?php if(isset($description)) {?>
	<div class="container">
		<div class="row">
			<div class="col-12 pl-0">
				<hr/>
				<p>
					<?php echo $description ?>
				</p>
			</div>
		</div>
	</div>
	<?php } ?>