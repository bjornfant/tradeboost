
	<div class="container-fluid page_head" style="background-color: #000000;">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-xs-12 pl-0">
					<img src="https://tradeboost.eu/image/bg_maple_leaf_small.png"  style="max-width:100%">
				</div>
				<div class="col-md-8 col-xs-12 pl-0">

						<div class="wrapper">
						  <div class="spinny-wrapper">
							<h1 style="	padding-bottom:1em">We &hearts;  
						    <span class="spinny-words">
						      <span>stackers</span>
						      <span>collectors</span>
						      <span>investors</span>
						      <span>gold bugs</span>
						      <span>silverites</span>
						      <span>bullionists</span>
						    </span>
						    <br>
						    Buy silver and gold online - find the cheapest european dealers!</h1>
						  </div>
						</div>

					<p class="intro">
						<span class='stockin'>✓</span> Compare over 10,000 updated prices on physical gold and silver from European online dealers
					</p>
					<p class="intro">
						<span class='stockin'>✓</span> See market spot price for every product
					</p>
					<p class="intro">
						<span class='stockin'>✓</span> Track the gold and silver pirce in real time to make the best bargain
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid page_body">
		<div class="container">
		<?php if(!empty($ad_inventory['middle'])) {
			echo $ad_inventory['middle'];
		} ?>

		<?php if(!empty($deals_array_site)) { ?>
			<div class="row pt-2">
				<div class="col-12 px-0">
					<h2><?php echo $deals_array_site['headline'] ?></h2>
					<div class="row">
			<?php
			$i = 0;

			foreach($deals_array_site['products'] as $product) {
				$bundle = "";
				if($product['quantity'] > 1) { $bundle = "Box "; }
				$product_title = "<small>".$bundle . ucfirst($translation[$page_language][$product['metal'].$product['type']]) . "</small><br/> " . $product['name'];
			?>	
					<div class="col-6 col-md-3 px-1 px-md-3 pt-2">
						<div class="category_item text-center" style="min-height: 230px">
							<a href="/product/<?php echo $product['url']; ?>">
							<?php $product_image = '';
							if(!empty($product['product_image'])) { 
								$product_image = "<img src='https://tradeboost.imgix.net/" . $product['product_image'] . "?w=250&h=250' alt='" . $product['name'] . "' style='max-width:100%' />"; 
							} else {
								$product_image = "<img src='https://tradeboost.eu/image/placeholder_" . $product['type'] . "_" . $product['metal'] . ".png' alt='" . $product_title . "' style='height:125px;opacity: 0.2'/>";
							}
							echo $product_image;
							?><p>
							<div class="list_title"><?php echo  $product_title ?></a></div></p>
							<div class="row">		
								<div class='col-12 text-right'><a href="/product/<?php echo $product['url']; ?>"><span class='price'><?php echo ucfirst($translation[$page_language]['lowest_price']) ?> <?php echo $catalog->format_money($product['best_price'], $page_currency); ?></span></a></div>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>

		<?php } ?>


		<?php foreach($deals_array as $deal) { ?>

			<div class="row pt-2">
				<div class="col-12 px-0">
					<h2><?php echo $deal['headline'] ?></h2>
					<div class="row">
			<?php
			$i = 0;
			foreach($deal['products'] as $product) {
				$bundle = "";
				if($product['quantity'] > 1) { $bundle = "Box "; }
				$product_title = "<small>".$bundle . ucfirst($translation[$page_language][$product['metal'].$product['type']]) . "</small><br/> " . $product['name'];
			?>	
					<div class="col-6 col-md-3 px-1 px-md-3 pt-2">
						<div class="category_item text-center" style="min-height: 230px">
							<a href="/product/<?php echo $product['url']; ?>">
							<?php $product_image = '';
							if(!empty($product['product_image'])) { 
								$product_image = "<img src='https://tradeboost.imgix.net/" . $product['product_image'] . "?w=250&h=250' alt='" . $product['name'] . "' style='max-width:100%' />";
							} else {
								$product_image = "<img src='https://tradeboost.eu/image/placeholder_" . $product['type'] . "_" . $product['metal'] . ".png' alt='" . $product_title . "' style='height:125px;opacity: 0.2'/>";
							}
							echo $product_image;
							?><p>
							<div class="list_title"><?php echo  $product_title ?></a></div></p>
							<div class="row">		
								<div class='col-12 text-right'><a href="/product/<?php echo $product['url']; ?>"><span class='price'><?php echo ucfirst($translation[$page_language]['lowest_price']) ?> <?php echo $catalog->format_money($product['best_price'], $page_currency); ?></span></a></div>
							</div>
						</div>
					</div>
			<?php
				

				$i++;
				//if($i > 3) { break; }
			}
			?>
					</div>
				</div>
			</div>


		<?php
		}
		?>
			<div class="row pt-2">
				<div class="col-12 pl-0"><h2>Gold and silver spot prices</h2></div>
			</div>

			<div class="row">

				<div class="col-12 col-md-6 px-0 pr-md-3" >
					<!-- TradingView Widget BEGIN -->
					<div class="tradingview-widget-container">
					  <div class="tradingview-widget-container__widget"></div>
					  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/futures/" rel="noopener" target="_blank"><span class="blue-text">Commodities</span></a> by TradingView</div>
					  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
					  {
					  "colorTheme": "light",
					  "dateRange": "12M",
					  "showChart": true,
					  "locale": "en",
					  "width": "100%",
					  "height": "400",
					  "largeChartUrl": "",
					  "isTransparent": false,
					  "plotLineColorGrowing": "rgba(33, 150, 243, 1)",
					  "plotLineColorFalling": "rgba(33, 150, 243, 1)",
					  "gridLineColor": "rgba(240, 243, 250, 1)",
					  "scaleFontColor": "rgba(120, 123, 134, 1)",
					  "belowLineFillColorGrowing": "rgba(33, 150, 243, 0.12)",
					  "belowLineFillColorFalling": "rgba(33, 150, 243, 0.12)",
					  "symbolActiveColor": "rgba(33, 150, 243, 0.12)",
					  "tabs": [
					    {
					      "title": "Commodities",
					      "symbols": [
					        {
					          "s": "FX_IDC:XAUEUR",
					          "d": "Gold Euro/Oz"
					        },
					        {
					          "s": "FX_IDC:XAUEURG",
					          "d": "Gold Euro/Gram"
					        }
					      ],
					      "originalTitle": "Commodities"
					    }
					  ]
					}
					  </script>
					</div>
					<!-- TradingView Widget END -->
				</div>
				<div class="col-12 col-md-6 px-0 pl-md-3">

					<!-- TradingView Widget BEGIN -->
					<div class="tradingview-widget-container">
					  <div class="tradingview-widget-container__widget"></div>
					  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/futures/" rel="noopener" target="_blank"><span class="blue-text">Commodities</span></a> by TradingView</div>
					  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
					  {
					  "colorTheme": "light",
					  "dateRange": "12M",
					  "showChart": true,
					  "locale": "en",
					  "width": "100%",
					  "height": "400",
					  "largeChartUrl": "",
					  "isTransparent": false,
					  "plotLineColorGrowing": "rgba(33, 150, 243, 1)",
					  "plotLineColorFalling": "rgba(33, 150, 243, 1)",
					  "gridLineColor": "rgba(240, 243, 250, 1)",
					  "scaleFontColor": "rgba(120, 123, 134, 1)",
					  "belowLineFillColorGrowing": "rgba(33, 150, 243, 0.12)",
					  "belowLineFillColorFalling": "rgba(33, 150, 243, 0.12)",
					  "symbolActiveColor": "rgba(33, 150, 243, 0.12)",
					  "tabs": [
					    {
					      "title": "Commodities",
					      "symbols": [
					        {
					          "s": "FX_IDC:XAGEUR",
					          "d": "Silver Euro/Oz"
					        },
					        {
					          "s": "FX_IDC:XAGEURG",
					          "d": "Silver Euro/Gram"
					        }
					      ],
					      "originalTitle": "Commodities"
					    }
					  ]
					}
					  </script>
					</div>
					<!-- TradingView Widget END -->
					</div>



			</div>
			<div class="row">
				<div class="col-12 pl-0"><h2>Explore popular investements</h2></div>
			</div>
			<div class="row category_box">
				<div class="col-12 col-md-6 px-1 py-1">
					<div class="row">
						<div class="col-5">
							<a href="/products/goldbars"><img src="https://tradeboost.eu/image/cat_gold_bar.jpg" alt="gold bars"  style="max-width:100%" /></a>
						</div>
						<div class="col-7">
							<h3><a href="/products/goldbars">Gold bars</a></h3>
							<ul class="shortcuts">
								<li><a href="/manufacturer/CH_PAMP">PAMP gold bars</a></li>
								<li><a href="/manufacturer/CH_VAL">Valcambi gold bars</a></li>
								<li><a href="/manufacturer/DE_HERA">Heraeus gold bars</a></li>
								<li><a href="/group/1_g_gold">1 gram gold bars</a></li>
								<li><a href="/group/5_g_gold">5 gram gold bars</a></li>
								<li><a href="/group/50_g_gold">50 gram gold bars</a></li>
								<li><a href="/group/100_g_gold">100 gram gold bars</a></li>
								<li><a href="/group/1000_g_gold">1 kilo gold bars</a></li>
								<li><a href="/products/goldbars"><br><b>All gold bars</b></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 px-1 py-1">
					<div class="row">
						<div class="col-5">
							<a href="/products/silverbars"><img src="https://tradeboost.eu/image/cat_silver_bar.jpg" alt="silver bars"  style="max-width:100%" /></a>
						</div>
						<div class="col-7">
							<h3><a href="/products/silverbars">Silver bars</a></h3>
							<ul class="shortcuts">
								<li><a href="/manufacturer/CH_PAMP">PAMP silver bars</a></li>
								<li><a href="/manufacturer/de_umicore">Umicore silver bars</a></li>
								<li><a href="/manufacturer/ch_metalor">Metalor silver bars</a></li>
								<li><a href="/group/1_oz_silver">1 oz silver bars</a></li>
								<li><a href="/group/100_g_silver">100 gram silver bars</a></li>
								<li><a href="/group/500_g_silver">500 gram silver bars</a></li>								
								<li><a href="/group/10_oz_silver">10 oz silver bars</a></li>
								<li><a href="/group/1000_g_silver">1 kilo silver bars</a></li>								
								<li><a href="/products/silverbars"><br><b>All silver bars</b></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Canadian Maple leaf</h3>
					<ul class="shortcuts">
						<li><a href="/product/305/1_oz_maple_leaf">1 oz gold Maple leaf</a></li>
						<li><a href="/product/227/1_2_oz_maple_leaf">1/2 oz gold Maple leaf</a></li>
						<li><a href="/product/216/1_4_oz_maple_leaf">1/4 oz gold Maple leaf</a></li>
						<li><a href="/product/328/1_10_oz_maple_leaf">1/10 oz gold Maple leaf</a></li>
						<li><a href="/product/306/1_oz_maple_leaf">1 oz silver Maple leaf</a></li>
					</ul>
				</div>
				<div class="col-6 col-md-3 px-1 py-1">
					<h3>American eagle</h3>
					<ul class="shortcuts">
						<li><a href="/product/317/1_oz_american_gold_eagle_50_dollar">1 oz gold American eagle</a></li>
						<li><a href="/product/231/1_2_oz_american_gold_eagle">1/2 oz gold American eagle</a></li>
						<li><a href="/product/221/1_4_oz_american_gold_eagle">1/4 oz gold American eagle</a></li>
						<li><a href="/product/211/1_10_oz_american_gold_eagle">1/10 oz gold American eagle</a></li>
						<li><a href="/product/318/1_oz_american_silver_eagle_">1 oz silver American eagle</a></li>
					</ul>
				</div>

				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Krugerrand</h3>
					<ul class="shortcuts">
						<li><a href="/product/319/1_oz_krugerrand">1 oz gold Krugerrand</a></li>
						<li><a href="/product/233/1_2_oz_krugerrand">1/2 oz gold Krugerrand</a></li>
						<li><a href="/product/222/1_4_oz_krugerrand">1/4 oz gold Krugerrand</a></li>
						<li><a href="/product/212/1_10_oz_krugerrand">1/10 oz gold Krugerrand</a></li>
						<li><a href="/product/320/1_oz_krugerrand">1 oz silver Krugerrand</a></li>
					</ul>
				</div>

				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Kangaroo/Nugget</h3>
					<ul class="shortcuts">
						<li><a href="/product/387/1_oz_kangaroo___nugget">1 oz gold Kangaroo</a></li>
						<li><a href="/product/225/1_2_oz_kangaroo_nugget">1/2 oz gold Kangaroo</a></li>
						<li><a href="/product/214/1_4_oz_kangaroo_nugget">1/4 oz gold Kangaroo</a></li>
						<li><a href="/product/209/1_10_oz_kangaroo_nugget">1/10 oz gold Kangaroo</a></li>
						<li><a href="/product/299/1_oz_kangaroo">1 oz silver Kangaroo</a></li>
					</ul>
				</div>


			</div>

			<div class="row">
				<div class="col-12 px-0"><h2>This is Trade boost</h2>
					<p>
					Welcome to Trade boost! We are a group of investors with an interest in gold and silver who run this website on a non-profit basis. Our goal is to create Europe's best price comparison website for precious metals targeted against investors and collectors.
					</p>
					<p>
					We collect products, prices and stock status from all the biggest online suppliers and auction houses several times every day. The products are sorted in real time to present the cheapest option for a specific product that you like.
					</p>
					<p>
					All products are not 24K gold so before Trade boost it was hard to compare two products. At Trade boost you can find the amount of pure precious metal in oz and gram per product to be able to compare it to another product. You also see how much that pure metal is worth on the market and how much premium (sales margin) the supplier adds to the price. All suppliers have this premium. It's how they make money. Usually the premium goes down if you buy more.
					</p>
					<p>Market prices on gold and silver changes every second, and we currently fetch prices as often as possible but not every second. You should double check the price on the supplier website before you buy.
					</p>
					<p>
					If you have an idea about an improvement or feature, we'd love to here about it! Send an email to info [a] Tradeboost.eu.
					</p>

				</div>


				</div>
			</div>

		</div>
	</div>				
