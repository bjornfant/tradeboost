	<div class="container-fluid page_head" style="background-color: #000000;">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-xs-12 pl-0">
					<img src="https://tradeboost.eu/image/bg_maple_leaf_small.png"  style="max-width:100%">
				</div>
				<div class="col-md-8 col-xs-12 pl-0">
					<h1 style="	padding-bottom:1em">Vergleichen Sie die Preise, bevor Sie investieren!</h1>
					<p class="intro">
						<span class='stockin'>✓</span> Aktualisierte Preise für Gold- und Silberprodukte von europäischen Online-Anbietern
					</p>
					<p class="intro">
						<span class='stockin'>✓</span> Preise pro Unze im Vergleich zum Marktspotpreis
					</p>
					<p class="intro">
						<span class='stockin'>✓</span> Echtzeitauktionen von Ebay und mehr
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid page_body">
		<div class="container">

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
								$product_image = "<img src='https://tradeboost.imgix.net/" . $product['product_image'] . "?w=250&h=250' alt='" . $product_title . "' style='max-width:100%' />";
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
								$product_image = "<img src='https://tradeboost.imgix.net/" . $product['product_image'] . "?w=250&h=250' alt='" . $product_title . "' style='max-width:100%' />";
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
				<div class="col-12 pl-0"><h2>Gold und Silber chart - Spotpreise</h2></div>
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
				<div class="col-12 pl-0"><h2>Entdecken Sie beliebte Investitionen</h2></div>
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
								<li><a href="/manufacturer/CH_PAMP">PAMP Goldbarren</a></li>
								<li><a href="/manufacturer/CH_UBS">UBS Goldbarren</a></li>
								<li><a href="/manufacturer/DE_HERA">Heraeus Goldbarren</a></li>
								<li><a href="/group/1_g_gold">1 gram Goldbarren</a></li>
								<li><a href="/group/5_g_gold">5 gram Goldbarren</a></li>
								<li><a href="/group/50_g_gold">50 gram Goldbarren</a></li>
								<li><a href="/group/100_g_gold">100 gram Goldbarren</a></li>
								<li><a href="/products/goldbars"><br><b>Alle Goldbarren</b></a></li>
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
							<h3><a href="/products/goldbars">Silver bars</a></h3>
							<ul class="shortcuts">
								<li><a href="/manufacturer/CH_PAMP">PAMP Silberbarren</a></li>
								<li><a href="/manufacturer/CH_UBS">Valcambi Silberbarren</a></li>
								<li><a href="/manufacturer/ch_metalor">Metalor Silberbarren</a></li>
								<li><a href="/group/1_oz_silver">1 oz Silberbarren</a></li>
								<li><a href="/group/100_g_silver">100 grams Silberbarren</a></li>
								<li><a href="/group/500_g_silver">500 gram Silberbarren</a></li>								
								<li><a href="/group/10_oz_silver">10 oz Silberbarren</a></li>
								<li><a href="/products/silverbars"><br><b>Alle Silberbarren</b></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-12 col-md-3 px-1 py-1">
					<h3>Canadian Maple leaf</h3>
					<ul class="shortcuts">
						<li><a href="/product/305/1_oz_maple_leaf">1 oz Gold Maple leaf</a></li>
						<li><a href="/product/227/1_2_oz_maple_leaf">1/2 oz Gold Maple leaf</a></li>
						<li><a href="/product/216/1_4_oz_maple_leaf">1/4 oz Gold Maple leaf</a></li>
						<li><a href="/product/328/1_10_oz_maple_leaf">1/10 oz Gold Maple leaf</a></li>
						<li><a href="/product/306/1_oz_maple_leaf">1 oz Silber Maple leaf</a></li>
					</ul>
				</div>
				<div class="col-12 col-md-3 px-1 py-1">
					<h3>American eagle</h3>
					<ul class="shortcuts">
						<li><a href="/product/317/1_oz_american_gold_eagle_50_dollar">1 oz Gold American eagle</a></li>
						<li><a href="/product/231/1_2_oz_american_gold_eagle">1/2 oz Gold American eagle</a></li>
						<li><a href="/product/221/1_4_oz_american_gold_eagle">1/4 oz Gold American eagle</a></li>
						<li><a href="/product/211/1_10_oz_american_gold_eagle">1/10 oz Gold American eagle</a></li>
						<li><a href="/product/318/1_oz_american_silver_eagle_">1 oz Silber American eagle</a></li>
					</ul>
				</div>

				<div class="col-12 col-md-3 px-1 py-1">
					<h3>Krugerrand</h3>
					<ul class="shortcuts">
						<li><a href="/product/319/1_oz_krugerrand">1 oz Gold Krugerrand</a></li>
						<li><a href="/product/233/1_2_oz_krugerrand">1/2 oz Gold Krugerrand</a></li>
						<li><a href="/product/222/1_4_oz_krugerrand">1/4 oz Gold Krugerrand</a></li>
						<li><a href="/product/212/1_10_oz_krugerrand">1/10 oz Gold Krugerrand</a></li>
						<li><a href="/product/320/1_oz_krugerrand">1 oz Silber Krugerrand</a></li>
					</ul>
				</div>

				<div class="col-12 col-md-3 px-1 py-1">
					<h3>Kangaroo/Nugget</h3>
					<ul class="shortcuts">
						<li><a href="/product/387/1_oz_kangaroo___nugget">1 oz Gold Kangaroo</a></li>
						<li><a href="/product/225/1_2_oz_kangaroo_nugget">1/2 oz Gold Kangaroo</a></li>
						<li><a href="/product/214/1_4_oz_kangaroo_nugget">1/4 oz Gold Kangaroo</a></li>
						<li><a href="/product/209/1_10_oz_kangaroo_nugget">1/10 oz Gold Kangaroo</a></li>
						<li><a href="/product/299/1_oz_kangaroo">1 oz Silber Kangaroo</a></li>
					</ul>
				</div>


			</div>

			<div class="row">
				<div class="col-12 px-0"><h2>Das ist Trade boost</h2>
					<p>
					Willkommen bei Trade Boost! Wir sind eine Gruppe von Investoren mit Interesse an Gold und Silber, die diese Website auf gemeinnütziger Basis betreiben. Unser Ziel ist es, Europas beste Preisvergleichs-Website für Edelmetalle zu schaffen, die sich an Investoren und Sammler richtet.
					</p>
					<p>
					Wir sammeln mehrmals täglich Produkte, Preise und Lagerstatus bei den größten Online-Anbietern und Auktionshäusern. Die Produkte werden in Echtzeit sortiert, um die günstigste Option für ein bestimmtes Produkt zu präsentieren, das Ihnen gefällt.
					</p>
					<p>
					Alle Produkte sind nicht aus 24 Karat Gold, daher war es vor Trade boost schwierig, zwei Produkte zu vergleichen. Bei Trade boost finden Sie die Menge an reinem Edelmetall in Unzen und Gramm pro Produkt, um es mit einem anderen Produkt vergleichen zu können. Sie sehen auch, wie viel dieses reine Metall auf dem Markt wert ist und wie viel Prämie (Verkaufsmarge) der Lieferant zum Preis hinzufügt. Alle Lieferanten haben diese Prämie. So verdienen sie Geld. Normalerweise sinkt die Prämie, wenn Sie mehr kaufen.
					</p>
					<p>Die Marktpreise für Gold und Silber ändern sich jede Sekunde, und wir rufen die Preise derzeit so oft wie möglich ab, aber nicht jede Sekunde. Sie sollten den Preis auf der Website des Anbieters überprüfen, bevor Sie kaufen.
					</p>
					<p>
					Wenn Sie eine Idee zu einer Verbesserung oder Funktion haben, würden wir uns freuen, hier darüber zu sprechen! Senden Sie eine E-Mail an info [a] tradeboost.eu.
					</p>

				</div>


				</div>
			</div>

		</div>
	</div>				
