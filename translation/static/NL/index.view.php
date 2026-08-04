	<div class="container-fluid page_head" style="background-color: #000000;">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-xs-12 pl-0">
					<img src="https://tradeboost.eu/image/bg_maple_leaf_small.png"  style="max-width:100%">
				</div>
				<div class="col-md-8 col-xs-12 pl-0">
					<h1 style="	padding-bottom:1em">Vergelijk prijzen voordat u investeert!</h1>
					<p class="intro">
						<span class='stockin'>✓</span> Bijgewerkte prijzen voor goud- en zilverproducten van Europese online leveranciers
					</p>
					<p class="intro">
						<span class='stockin'>✓</span> Prijzen per oz vergeleken met de spotprijs op de markt
					</p>
					<p class="intro">
						<span class='stockin'>✓</span> Real-time veilingen van Ebay en meer
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid page_body">
		<div class="container">

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
				$product_title = $bundle . ucfirst($translation[$page_language][$product['metal'].$product['type']]) . " " . $product['name'];
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
				<div class="col-12 pl-0"><h2>Goud en zilver spotprijzen</h2></div>
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
				<div class="col-12 pl-0"><h2>Populaire investeringen</h2></div>
			</div>

			<div class="row category_box">
				<div class="col-12 col-md-6 px-1 py-1">
					<div class="row">
						<div class="col-5">
							<a href="/products/goldbars"><img src="https://tradeboost.eu/image/cat_gold_bar.jpg" alt="guldtackor"  style="max-width:100%" /></a>
						</div>
						<div class="col-7">
							<h3><a href="/products/goldbars">Goudbaren</a></h3>
							<ul class="shortcuts">
								<li><a href="/manufacturer/CH_PAMP">PAMP goudbaren</a></li>
								<li><a href="/manufacturer/CH_VAL">Valcambi goudbaren</a></li>
								<li><a href="/manufacturer/DE_HERA">Heraeus goudbaren</a></li>
								<li><a href="/group/1_g_gold">1 gram goudbaren</a></li>
								<li><a href="/group/5_g_gold">5 gram goudbaren</a></li>
								<li><a href="/group/50_g_gold">50 gram goudbaren</a></li>
								<li><a href="/group/100_g_gold">100 gram goudbaren</a></li>
								<li><a href="/group/1000_g_gold">1 kilo goudbaren</a></li>
								<li><a href="/products/goldbars"><br><b>Alle goudbaren</b></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 px-1 py-1">
					<div class="row">
						<div class="col-5">
							<a href="/products/silverbars"><img src="https://tradeboost.eu/image/cat_silver_bar.jpg" alt="silvertackor"  style="max-width:100%" /></a>
						</div>
						<div class="col-7">
							<h3><a href="/products/silverbars">zilverenbaren</a></h3>
							<ul class="shortcuts">
								<li><a href="/manufacturer/CH_PAMP">PAMP zilverenbaren</a></li>
								<li><a href="/manufacturer/de_umicore">Umicore zilverenbaren</a></li>
								<li><a href="/manufacturer/ch_metalor">Metalor zilverenbaren</a></li>
								<li><a href="/group/1_oz_silver">1 oz zilverenbaren</a></li>
								<li><a href="/group/100_g_silver">100 gram zilverenbaren</a></li>
								<li><a href="/group/500_g_silver">500 gram zilverenbaren</a></li>								
								<li><a href="/group/1000_g_silver">1 kilo zilverenbaren</a></li>								
								<li><a href="/group/10_oz_silver">10 oz zilverenbaren</a></li>
								<li><a href="/products/silverbars"><br><b>Alle zilverenbaren</b></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Maple leaf</h3>
					<ul class="shortcuts">
						<li><a href="/product/305/1_oz_maple_leaf">1 oz goud Maple leaf</a></li>
						<li><a href="/product/227/1_2_oz_maple_leaf">1/2 oz goud Maple leaf</a></li>
						<li><a href="/product/216/1_4_oz_maple_leaf">1/4 oz goud Maple leaf</a></li>
						<li><a href="/product/328/1_10_oz_maple_leaf">1/10 oz goud Maple leaf</a></li>
						<li><a href="/product/306/1_oz_maple_leaf">1 oz zilver Maple leaf</a></li>
					</ul>
				</div>
				<div class="col-6 col-md-3 px-1 py-1">
					<h3>American eagle</h3>
					<ul class="shortcuts">
						<li><a href="/product/317/1_oz_american_gold_eagle_50_dollar">1 oz goud American eagle</a></li>
						<li><a href="/product/231/1_2_oz_american_gold_eagle">1/2 oz goud American eagle</a></li>
						<li><a href="/product/221/1_4_oz_american_gold_eagle">1/4 oz goud American eagle</a></li>
						<li><a href="/product/211/1_10_oz_american_gold_eagle">1/10 oz goud American eagle</a></li>
						<li><a href="/product/318/1_oz_american_silver_eagle_">1 oz zilver American eagle</a></li>
					</ul>
				</div>

				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Krugerrand</h3>
					<ul class="shortcuts">
						<li><a href="/product/319/1_oz_krugerrand">1 oz goud Krugerrand</a></li>
						<li><a href="/product/233/1_2_oz_krugerrand">1/2 oz goud Krugerrand</a></li>
						<li><a href="/product/222/1_4_oz_krugerrand">1/4 oz goud Krugerrand</a></li>
						<li><a href="/product/212/1_10_oz_krugerrand">1/10 oz goud Krugerrand</a></li>
						<li><a href="/product/320/1_oz_krugerrand">1 oz zilver Krugerrand</a></li>
					</ul>
				</div>

				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Kangaroo/Nugget</h3>
					<ul class="shortcuts">
						<li><a href="/product/387/1_oz_kangaroo___nugget">1 oz goud Kangaroo</a></li>
						<li><a href="/product/225/1_2_oz_kangaroo_nugget">1/2 oz goud Kangaroo</a></li>
						<li><a href="/product/214/1_4_oz_kangaroo_nugget">1/4 oz goud Kangaroo</a></li>
						<li><a href="/product/209/1_10_oz_kangaroo_nugget">1/10 oz goud Kangaroo</a></li>
						<li><a href="/product/299/1_oz_kangaroo">1 oz zilver Kangaroo</a></li>
					</ul>
				</div>
				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Philharmoniker uit Oostenrijk</h3>
					<ul class="shortcuts">
						<li><a href="/product/297/1_oz_philharmonic">1 oz goud Philharmoniker</a></li>
						<li><a href="/product/224/1_2_oz_philharmonic">1/2 oz goud Philharmoniker</a></li>
						<li><a href="/product/213/1_4_oz_philharmonic">1/4 oz goud Philharmoniker</a></li>
						<li><a href="/product/298/1_oz_philharmonic">1 oz zilver Philharmoniker</a></li>
					</ul>
				</div>

				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Panda uit China</h3>
					<ul class="shortcuts">
						<li><a href="/product/478/30_g_panda">30 g goud Panda</a></li>
						<li><a href="/product/290/15_g_gold_panda___200_yuan">15 g goud Panda</a></li>
						<li><a href="/product/528/8_g_gold_panda___100_yuan">8 g goud Panda</a></li>
						<li><a href="/product/479/30_g_panda">30 g zilver Panda</a></li>
					</ul>
				</div>
				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Sovereign uit Groot-Brittannië</h3>
					<ul class="shortcuts">
						<li><a href="/product/457/double_sovereign__country_gb">Double Sovereign</a></li>
						<li><a href="/product/322/sovereign__country_gb__elizabeth_ii">Sovereign</a></li>
						<li><a href="/product/235/half_sovereign__country_gb">Half Sovereign</a></li>
						<li><a href="/product/535/quarter_sovereign">Quarter Sovereign</a></li>
					</ul>
				</div>
				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Franc uit Frankrijk</h3>
					<ul class="shortcuts">
						<li><a href="/product/422/20_franc__country_fr__napoleon_iii">20 Franc Napoleon III</a></li>
						<li><a href="/product/808/20_franc__country_fr__marianne">20 Franc Marianne</a></li>
						<li><a href="/product/809/20_franc__country_fr__angel">20 Franc Angel</a></li>
						<li><a href="/product/807/20_franc__country_fr__ceres">20 Franc Ceres</a></li>
					</ul>
				</div>

			</div>


			<div class="row">
				<div class="col-12 px-0"><h2>This is Trade boost</h2>
					<p>
					Welkom bij Trade boost! Wij zijn een groep investeerders met interesse in goud en zilver die deze website op non-profit basis beheren. Ons doel is om Europa's beste prijsvergelijkingswebsite voor edele metalen te creëren, gericht op investeerders en verzamelaars.
					</p>
					<p>
					We verzamelen meerdere keren per dag producten, prijzen en voorraadstatus van alle grootste online leveranciers en veilinghuizen. De producten worden in realtime gesorteerd om de goedkoopste optie te presenteren voor een specifiek product dat u leuk vindt.
					</p>
					<p>
					Alle producten zijn niet 24-karaats goud, dus vóór Trade-boost was het moeilijk om twee producten te vergelijken. Bij Trade boost vind je de hoeveelheid puur edelmetaal in oz en gram per product om het te kunnen vergelijken met een ander product. Ook zie je hoeveel dat pure metaal op de markt waard is en hoeveel premie (verkoopmarge) de leverancier aan de prijs toevoegt. Alle leveranciers hebben deze premie. Zo verdienen ze geld. Meestal daalt de premie als u meer koopt.
					</p>
					<p>De marktprijzen voor goud en zilver veranderen elke seconde, en we halen momenteel de prijzen zo vaak mogelijk op, maar niet elke seconde. Controleer de prijs op de website van de leverancier voordat u koopt.
					</p>
					<p>
					Als je een idee hebt over een verbetering of functie, horen we dat graag! Stuur een e-mail naar info [a] Tradeboost.eu.
					</p>

				</div>


				</div>
			</div>

		</div>
	</div>				
