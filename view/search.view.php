		<div class="container-fluid page_head">
			<div class="container">
			<div class="row">
				<div class="col-12 pl-0">
					<h1><?php echo $page_title ?></h1>
					<form  class="form-inline my-2 my-lg-0 search" action="/search" method="GET">
						<input type="text" class="form-control" placeholder="" name="query" id="query" maxlength="50" style="width:70%" value="<?php echo $query ?>">
						<button class="btn btn-light" type="submit" id="button-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
						<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></button>
				    </form>
				    <p style="padding-top:10px;font-size: 0.9em;">
				    	<a href="/search?query=100+g+gold">100 g gold</a> | <a href="/search?query=maple+leaf">maple leaf</a> | <a href="/search?query=eagle">eagle</a> | <a href="/search?query=pamp">PAMP</a> | <a href="/search?query=panda">panda</a>
				    </p>
				</div>
			</div>
			</div>
		</div>	
		<div class="container-fluid page_body">
			<div class="container">
			<div class="row" style="min-height:500px"> 
    			<div class="col-12 col-md-12 px-1">   
    				<div class="row">
				
				<?php

				if(!empty($filtered_products )) {
				foreach($filtered_products as $product) {
						//if(!empty($product['store_products'])) {
							$store_count = 0;
							$best_price = $product['best_price'];
							$best_price_per_oz = $product['best_price_per_oz'];
							$compare_to_spot = $product['best_price_compare_to_spot'];

							$compare_string = "<small>+" . number_format($compare_to_spot, 1, '.', ' ') . " %" . $translation[$page_language]['over_spot'] . "</small>";
							if($compare_to_spot < 0) {
								$compare_string = "<small>" . number_format($compare_to_spot, 1, '.', ' ') . " % " . $translation[$page_language]['under_spot'] . "</small>";
							}

						//}

						$str_offer = $translation[$page_language]['offer'];
						if($product['offers'] > 1) { $str_offer = $translation[$page_language]['offers']; }
						$str_offer = $product['offers'] . " " . $str_offer;

						$bundle = "";
						if($product['quantity'] > 1) { $bundle = "Box "; }

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
										
										<div class='col-4'><a href="/product/<?php echo $product['url']; ?>" class="offer"><?php echo  $str_offer; ?></a></div>
										<div class='col-8 text-right margin-adjust-6'>
											<?php if($best_price > 0) { ?><a href="/product/<?php echo $product['url']; ?>"><span class='price'><?php echo ucfirst($translation[$page_language]['lowest_price']) ?>: <?php echo $catalog->format_money($best_price, $page_currency); ?></span></a><br><?php echo $compare_string ?>
											<?php } ?>
										</div>
									</div>
								</div>

							</div>
						<?php
					
				}
				} else { ?>
					<p>No results</p>
				<?php }
				?>

				</div>			
			</div>
		</div>
	</div>
