	<script>
	function toggle_filter() {
		  var btnText = document.getElementById("filter_button");
		  $("#filters").toggleClass('d-none');

		  if ($("#filters").hasClass('d-none')) {
		    btnText.innerHTML = "<?php echo $translation[$page_language]['show_filter']; ?>";
		  } else {
		    btnText.innerHTML = "<?php echo $translation[$page_language]['hide_filter']; ?>>";
		  }
	}


	</script>
		<div class="container-fluid page_head">
			<div class="container">
			<div class="row">
				<div class="col-12 pl-0">
					<h1><?php echo $page_title ?></h1>
					<span style="color:#ffffff;">
					<?php 
						if(!empty($page_description)) {
							$replace_array = array("h1","h2","h3","h4");
							$outline = preg_replace("/\<h[0-6](.*)\>(.*)\<\/h[0-6]\>/","", $page_description); //remove <h*>
							$truncate_text_position = strpos($outline , " ", 300);
							//$outline = str_replace($replace_array, "<br>", $page_description);
							echo substr($outline,0,$truncate_text_position) . " <a href='#page_description'>[...]</a>";
						}

					?>
					</span>
				</div>
			</div>
			</div>
		</div>	
		<div class="container-fluid page_body">
			<div class="container">
			<div class="row">
				<div class="col-12 col-md-3 text-left pl-0 mt-md-3">
						<p>
						<small><a href="/"><svg width="16" height="16" viewBox="0 0 16 16"><path d="M3 5v5h3v-3h3v3h3v-5L8,3z"/></svg> &gt;</a>
						 <a href=""><?php echo ucfirst($page_title) ?> &gt;</a>
						</small>
						</p>
					<span onclick="toggle_filter()" id="filter_button" class="btn btn-dark d-block d-sm-none" style="width:100%">
	    					<?php echo $translation[$page_language]['show_filter']; ?> </span><br/>					
					<div class="d-none d-sm-block" id="filters" style="padding:0px">
						<form action="" method="get">
							<div class="form-group">
								 <div class="row">
									<?php require BASE_DIR . '/view/common/inc_filters.view.php'; ?>
								</div>
							</div>
						</form>
							<?php
		    				if(isset($ad_inventory['left'])) {
								echo $ad_inventory['left'];
							}?>
					</div>
				</div>  

    			<div class="col-12 col-md-9 px-1">   
    				<div class="row">
				
				<?php
				$ad_after_products = 2;
				foreach($filtered_products as $product) {
					$show_product = true;
					/*if(!empty($_GET['country']) && $_GET['country'] != $product['country_origin']) { $show_product = false; }
					if(!empty($metal) && $metal != $product['metal']) { $show_product = false; }
					if(!empty($product_type) && $product_type != $product['type']) { $show_product = false; }
					if(!empty($_GET['quantity']) && $_GET['quantity'] != $product['quantity']) { $show_product  = false; }
					if(!empty($_GET['manufacturer']) && $_GET['manufacturer'] != $product['manufacturer_id']) { $show_product  = false; }
					if(!empty($_GET['metal_weight_class']) && $_GET['metal_weight_class'] != $product['metal_weight_class']) { $show_product = false; }
					if(!$product['store_products']) { $show_product = false;} //only show products that are for sale somewhere
					*/

					if($show_product) {

						if(!empty($product['store_products'])) {
							$store_count = 0;
							$best_price = $product['best_price'];
							$best_price_per_oz = $product['best_price_per_oz'];
							$compare_to_spot = $product['best_price_compare_to_spot'];

							$compare_string = "<small>+" . number_format($compare_to_spot, 1, '.', ' ') . "% " . $translation[$page_language]['over_spot'] . "</small>";
							if($compare_to_spot < 0) {
								$compare_string = "<small>" . number_format($compare_to_spot, 1, '.', ' ') . "% " . $translation[$page_language]['under_spot'] . "</small>";
							}

						}

						$str_offer = $translation[$page_language]['offer'];
						if($product['offers'] > 1) { $str_offer = $translation[$page_language]['offers']; }

						if($product['offers'] > 99) { $product['offers'] = "99+"; }

						$str_offer = $product['offers'] . " " . $str_offer;


						$bundle = "";
						/*if($product['quantity'] > 1) { $bundle = "Box "; }*/

						$product_title = $bundle . ucfirst($translation[$page_language][$product['metal'].$product['type']]) . " " .   $product['name'];

						?>

							<div class='col-12 col-md-6' style="padding:10px;">
								<div class="category_item">
									<div class="row" style="min-height:90px">
										<div class="col-4 col-md-3 text-center">
											<a href="/product/<?php echo $product['url']; ?>">
											<?php $product_image = '';
											if(!empty($product['product_image'])) { 
												$product_image = "<img src='https://tradeboost.imgix.net/" . $product['product_image'] . "?w=100&h=100' style='max-width:100%' alt='" . $product_title . "' />"; 
											} else {
												$product_image = "<img src='https://tradeboost.eu/image/placeholder_" . $product['type'] . "_" . $product['metal'] . ".png' alt='" . $product_title . "' style='max-width:100%;opacity: 0.2'/>";
											}

											echo $product_image;
											?>
											</a>
										</div>
										<div class="col-8 col-md-9">
											<h3><a href="/product/<?php echo $product['url']; ?>"><?php echo $product_title ?></a></h3>
											<small><?php echo $translation[$page_language]['country'][$product['country_origin']]; ?><br>
												<?php echo $translation[$page_language][$product['metal']]; ?>: <?php echo $catalog->format_weight($product['metal_weight_oz'],'oz'); ?> (<?php echo $catalog->format_weight($product['metal_weight_gram'],'gram'); ?>)</small>
								
										</div>
									</div>
									<hr/>

									<div class="row">
										
										<div class='col-5'><a href="/product/<?php echo $product['url']; ?>" class="offer"><?php echo  $str_offer; ?></a></div>
										<div class='col-7 text-right margin-adjust-6'><a href="/product/<?php echo $product['url']; ?>"><span class='price'><?php echo ucfirst($translation[$page_language]['lowest_price']) ?>: <?php echo $catalog->format_money($best_price, $page_currency); ?></span></a><br><?php echo $compare_string ?></div>
									</div>
								</div>

							</div>
						<?php
					}
					$ad_after_products--;
					if($ad_after_products == 0) {
	    				if(isset($ad_inventory['middle'])) {
	    					echo "<div class='col-12 col-md-12' style='padding:10px;'><div style='background-color:white'>";
							echo $ad_inventory['middle'];
							echo "</div></div>";
						}
					}
					
				}
				?>

				</div>
				<div class="row">
				    <div class="col-12 col-md-12 px-2">   
						<nav aria-label="Page navigation example">
						  <ul class="pagination pagination-md">
							<?php
							foreach($pagination as $key => $value) {
							$selected = "";
							if($value['selected']) {
								$selected = ' style="background-color:#0B1D51;color:#EBB97C;"';
							}
							echo '<li class="page-item"><a class="page-link" '.$selected.' href="'.$value['url'].'">'.$key.'</a></li>';
							}
							?>
						  </ul>
						</nav>
					</div>
				</div>
				<?php if(!empty($popular_product_groups)) { ?>
				<div class="row">
					<div class="col-12">
						<hr/>
						<h3><?php echo $popular_groups_label; ?></h3>
						<ul class="list-inline">
						<?php foreach($popular_product_groups as $product_group) { ?>
							<li class="list-inline-item">
								<a href="/group/<?php echo htmlspecialchars($product_group['url'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($product_group['name']); ?></a>
								<span class="filter-count"><?php echo (int) $product_group['product_count']; ?></span>
							</li>
						<?php } ?>
						</ul>
					</div>
				</div>
				<?php } ?>
				<div class="row">
					<div class="col-12">
						<hr/>
						<a name="page_description"></a>
						<p>
						<?php echo $page_description; ?>
						<p>
					</div>
				</div>			
			</div>
		</div>
	</div>
