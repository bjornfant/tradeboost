	<div class="container-fluid page_head" style="background-color: #000000;">
		<div class="container">
			<div class="row" >
				<div class="col-md-4 col-xs-12 pl-0">
					<img src="https://tradeboost.eu/image/bg_maple_leaf_small.png"  style="max-width:100%">
				</div>
				<div class="col-md-8 col-xs-12 pl-0">
					<div class="wrapper">
						  <div class="spinny-wrapper">
							<h1 style="	padding-bottom:1em">Vi &hearts; 
						    <span class="spinny-words">
						      <span>stackers</span>
						      <span>gold bugs</span>
						      <span>myntsamlare</span>
						      <span>investerare</span>
						      <span>silvernördar</span>
						      <span>ekonomer</span>
						    </span>
						    <br>
						    Hitta billiga europeiska onlinebutiker för guld och silver!</h1>
						  </div>
						</div>
					<p class="intro">
						<span class='stockin'>✓</span> Jämför över 10,000 uppdaterade priser på guld och silver från butiker i Sverige och Europa
					</p>
					<p class="intro">
						<span class='stockin'>✓</span> Se varje produkt mot aktuellt marknadspris (spotpris)
					</p>
					<p class="intro">
						<span class='stockin'>✓</span> Hitta fynd på aktuella auktioner hos Tradera och Ebay
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
				<div class="col-12 pl-0"><h2>Marknadspriser på guld och silver</h2></div>
			</div>

			<div class="row">

				<div class="col-12 col-md-6 px-0 pr-md-3" >
					<!-- TradingView Widget BEGIN -->
					<div class="tradingview-widget-container">
					  <div class="tradingview-widget-container__widget"></div>
					  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/futures/" rel="noopener" target="_blank"><span class="blue-text">Guld</span></a> by TradingView</div>
					  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
					  {
					  "colorTheme": "light",
					  "dateRange": "12M",
					  "showChart": true,
					  "locale": "en",
					  "largeChartUrl": "",
					  "isTransparent": false,
					  "width": "100%",
					  "height": "400",
					  "plotLineColorGrowing": "rgba(33, 150, 243, 1)",
					  "plotLineColorFalling": "rgba(33, 150, 243, 1)",
					  "gridLineColor": "rgba(240, 243, 250, 1)",
					  "scaleFontColor": "rgba(120, 123, 134, 1)",
					  "belowLineFillColorGrowing": "rgba(33, 150, 243, 0.12)",
					  "belowLineFillColorFalling": "rgba(33, 150, 243, 0.12)",
					  "symbolActiveColor": "rgba(33, 150, 243, 0.12)",
					  "tabs": [
					    {
					      "title": "Guld",
					      "symbols": [
					        {
					          "s": "OANDA:XAUUSD*OANDA:USDSEK",
					          "d": "Guld SEK/Oz"
					        },
					        {
					          "s": "FX_IDC:XAUUSDG*OANDA:USDSEK",
					          "d": "Guld SEK/g"
					        }
					      ],
					      "originalTitle": "Guld"
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
					  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/futures/" rel="noopener" target="_blank"><span class="blue-text">Silver</span></a> by TradingView</div>
					  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
					  {
					  "colorTheme": "light",
					  "dateRange": "12M",
					  "showChart": true,
					  "locale": "en",
					  "largeChartUrl": "",
					  "isTransparent": false,
					  "width": "100%",
					  "height": "400",
					  "plotLineColorGrowing": "rgba(33, 150, 243, 1)",
					  "plotLineColorFalling": "rgba(33, 150, 243, 1)",
					  "gridLineColor": "rgba(240, 243, 250, 1)",
					  "scaleFontColor": "rgba(120, 123, 134, 1)",
					  "belowLineFillColorGrowing": "rgba(33, 150, 243, 0.12)",
					  "belowLineFillColorFalling": "rgba(33, 150, 243, 0.12)",
					  "symbolActiveColor": "rgba(33, 150, 243, 0.12)",
					  "tabs": [
					    {
					      "title": "Silver",
					      "symbols": [
					        {
					          "s": "OANDA:XAGUSD*OANDA:USDSEK",
					          "d": "Silver SEK/Oz"
					        },
					        {
					          "s": "FX_IDC:XAGUSDG*OANDA:USDSEK",
					          "d": "Silver SEK/g"
					        }
					      ],
					      "originalTitle": "Silver"
					    }
					  ]
					}
					  </script>
					</div>
					<!-- TradingView Widget END -->
					</div>

			</div>
			<div class="row">
				<div class="col-12 pl-0"><h2>Populära investeringar</h2></div>
			</div>
			<div class="row category_box">
				<div class="col-12 col-md-6 px-1 py-1">
					<div class="row">
						<div class="col-5">
							<a href="/products/goldbars"><img src="https://tradeboost.eu/image/cat_gold_bar.jpg" alt="guldtackor"  style="max-width:100%" /></a>
						</div>
						<div class="col-7">
							<h3><a href="/products/goldbars">Guldtackor</a></h3>
							<ul class="shortcuts">
								<li><a href="/manufacturer/CH_PAMP">PAMP guldtackor</a></li>
								<li><a href="/manufacturer/CH_VAL">Valcambi guldtackor</a></li>
								<li><a href="/manufacturer/DE_HERA">Heraeus guldtackor</a></li>
								<li><a href="/group/1_g_gold">1 gram guldtackor</a></li>
								<li><a href="/group/5_g_gold">5 gram guldtackor</a></li>
								<li><a href="/group/50_g_gold">50 gram guldtackor</a></li>
								<li><a href="/group/100_g_gold">100 gram guldtackor</a></li>
								<li><a href="/group/1000_g_gold">1 kg guldtackor</a></li>								
								<li><a href="/products/goldbars"><br><b>All guldtackor</b></a></li>
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
							<h3><a href="/products/silverbars">Silvertackor</a></h3>
							<ul class="shortcuts">
								<li><a href="/manufacturer/CH_PAMP">PAMP silvertackor</a></li>
								<li><a href="/manufacturer/de_umicore">Umicore silvertackor</a></li>
								<li><a href="/manufacturer/ch_metalor">Metalor silvertackor</a></li>
								<li><a href="/group/1_oz_silver">1 oz silvertackor</a></li>
								<li><a href="/group/100_g_silver">100 gram silvertackor</a></li>
								<li><a href="/group/500_g_silver">500 gram silvertackor</a></li>								
								<li><a href="/group/1000_g_silver">1 kg silvertackor</a></li>								
								<li><a href="/group/10_oz_silver">10 oz silvertackor</a></li>
								<li><a href="/products/silverbars"><br><b>All silvertackor</b></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Kanadensiska Maple leaf</h3>
					<ul class="shortcuts">
						<li><a href="/product/305/1_oz_maple_leaf">1 oz guld Maple leaf</a></li>
						<li><a href="/product/227/1_2_oz_maple_leaf">1/2 oz guld Maple leaf</a></li>
						<li><a href="/product/216/1_4_oz_maple_leaf">1/4 oz guld Maple leaf</a></li>
						<li><a href="/product/328/1_10_oz_maple_leaf">1/10 oz guld Maple leaf</a></li>
						<li><a href="/product/306/1_oz_maple_leaf">1 oz silver Maple leaf</a></li>
					</ul>
				</div>
				<div class="col-6 col-md-3 px-1 py-1">
					<h3>American eagle</h3>
					<ul class="shortcuts">
						<li><a href="/product/317/1_oz_american_gold_eagle_50_dollar">1 oz guld American eagle</a></li>
						<li><a href="/product/231/1_2_oz_american_gold_eagle">1/2 oz guld American eagle</a></li>
						<li><a href="/product/221/1_4_oz_american_gold_eagle">1/4 oz guld American eagle</a></li>
						<li><a href="/product/211/1_10_oz_american_gold_eagle">1/10 oz guld American eagle</a></li>
						<li><a href="/product/318/1_oz_american_silver_eagle_">1 oz silver American eagle</a></li>
					</ul>
				</div>

				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Krugerrand</h3>
					<ul class="shortcuts">
						<li><a href="/product/319/1_oz_krugerrand">1 oz guld Krugerrand</a></li>
						<li><a href="/product/233/1_2_oz_krugerrand">1/2 oz guld Krugerrand</a></li>
						<li><a href="/product/222/1_4_oz_krugerrand">1/4 oz guld Krugerrand</a></li>
						<li><a href="/product/212/1_10_oz_krugerrand">1/10 oz guld Krugerrand</a></li>
						<li><a href="/product/320/1_oz_krugerrand">1 oz silver Krugerrand</a></li>
					</ul>
				</div>

				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Kangaroo/Nugget</h3>
					<ul class="shortcuts">
						<li><a href="/product/387/1_oz_kangaroo___nugget">1 oz guld Kangaroo</a></li>
						<li><a href="/product/225/1_2_oz_kangaroo_nugget">1/2 oz guld Kangaroo</a></li>
						<li><a href="/product/214/1_4_oz_kangaroo_nugget">1/4 oz guld Kangaroo</a></li>
						<li><a href="/product/209/1_10_oz_kangaroo_nugget">1/10 oz guld Kangaroo</a></li>
						<li><a href="/product/299/1_oz_kangaroo">1 oz silver Kangaroo</a></li>
					</ul>
				</div>
				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Philharmoniker från Österrike</h3>
					<ul class="shortcuts">
						<li><a href="/product/297/1_oz_philharmonic">1 oz guld Philharmoniker</a></li>
						<li><a href="/product/224/1_2_oz_philharmonic">1/2 oz guld Philharmoniker</a></li>
						<li><a href="/product/213/1_4_oz_philharmonic">1/4 oz guld Philharmoniker</a></li>
						<li><a href="/product/298/1_oz_philharmonic">1 oz silver Philharmoniker</a></li>
					</ul>
				</div>

				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Panda från Kina</h3>
					<ul class="shortcuts">
						<li><a href="/product/478/30_g_panda">30 g guld Panda</a></li>
						<li><a href="/product/290/15_g_gold_panda___200_yuan">15 g guld Panda</a></li>
						<li><a href="/product/528/8_g_gold_panda___100_yuan">8 g guld Panda</a></li>
						<li><a href="/product/479/30_g_panda">30 g silver Panda</a></li>
					</ul>
				</div>
				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Sovereign från Storbritannien</h3>
					<ul class="shortcuts">
						<li><a href="/product/457/double_sovereign__country_gb">Double Sovereign</a></li>
						<li><a href="/product/322/sovereign__country_gb__elizabeth_ii">Sovereign</a></li>
						<li><a href="/product/235/half_sovereign__country_gb">Half Sovereign</a></li>
						<li><a href="/product/535/quarter_sovereign">Quarter Sovereign</a></li>
					</ul>
				</div>
				<div class="col-6 col-md-3 px-1 py-1">
					<h3>Franc från Frankrike</h3>
					<ul class="shortcuts">
						<li><a href="/product/422/20_franc__country_fr__napoleon_iii">20 Franc Napoleon III</a></li>
						<li><a href="/product/808/20_franc__country_fr__marianne">20 Franc Marianne / Tupp</a></li>
						<li><a href="/product/809/20_franc__country_fr__angel">20 Franc Ängel</a></li>
						<li><a href="/product/807/20_franc__country_fr__ceres">20 Franc Ceres</a></li>
					</ul>
				</div>

			</div>

			<div class="row">
				<div class="col-12 px-0"><h2>Detta är Trade boost</h2>
					<p>
					Välkommen till Tradeboost! Vi är en samling investerare med intresse för guld och silver som driver denna sajt på ideell basis. Vårt mål är att skapa Europas bästa sajt för prisjämförelse av ädelmetaller för investerare och samlare.
					</p>
					<p>
					Varje dag hämtas produkter, priser och lagerstatus från olika aktörer online för att du ska kunna jämföra snabbt och enkelt. Sen är det viktigt att du själv kontrollerar att priset stämmer på butikens sida precis innan du köper. Kom ihåg att även fraktkostnader kan tillkomma. 
					</p>
					<p>
					Varje produkt har en viss mängd ren ädelmetall, som du kan läsa angivet i troy uns (oz) på en produkt. Vi jämför sedan detta med dagsfärskt marknadspris på råvarumarknaden (s.k. spotpris), för att visa butikens påslag (% över spotpris). Alla återförsäljare har givetvis detta påslag och generellt blir påslaget lägre ju större belopp du köper för på en gång. Silver har till exempel ofta ett högre påslag eftersom de produkterna säljs till lägre belopp, samt att silver beläggs med moms på ett annat sätt än guld. 
					</p>
					<p>Marknadspriser för ädelmetaller i världen ändras varje sekund och vi läser in priser så ofta vi kan, men inte varje sekund. Jämförelsen kan därför skilja sig lite mot vad du får se när du klickar vidare till en säljare, men vi brukar ändå lyckas pricka rätt i vem som är billigast just nu.
					</p>
					<p>
					Det kan vara värt att besöka flera aktörer som säljer en produkt för att läsa om de fullständiga villkoren kring betalning och leverans. Exempelvis har en del butiker mängdrabatter när du köper flera produkter och frakrpriser kan skilja flera euro.
					</p>
					<p>
					Vi tar gärna emot feedback och förbättringsförslag. 
					</p>

				</div>


				</div>
			</div>

		</div>
	</div>				
