

	<div class="container-fluid page_head" style="background-color: #000000;">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-xs-12 pl-0">
					<img src="https://tradeboost.eu/image/bg_maple_leaf_small.png"  style="max-width:100%">
				</div>
				<div class="col-md-8 col-xs-12 pl-0">

						<div class="wrapper">
						  <div class="spinny-wrapper">
							<h1 style="	padding-bottom:1em">Nosotros &hearts;
						    <span class="spinny-words">
						      <span>stackers</span>
						      <span>coleccionistas</span>
						      <span>inversionistas</span>
						      <span>gold bugs</span>
						      <span>frikis de plata</span>
						    </span>
						    <br><br>
						    Compre plata y oro en línea: encuentre los distribuidores europeos más baratos!</h1>
						  </div>
						</div>

					<p class="intro">
						<span class='stockin'>✓</span> Más de 10.000 precios actualizados en oro y plata físicos de distribuidores online europeos
					</p>
					<p class="intro">
						<span class='stockin'>✓</span> Compare los precios con el precio al contado del mercado para cada producto
					</p>
					<p class="intro">
						<span class='stockin'>✓</span> Siga subastas en tiempo real como Ebay y más
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
								$product_image = "<img src='https://tradeboost.imgix.net/" . $product['product_image'] . "?w=250&h=250' alt='" . $$product['name'] . "' style='max-width:100%' />"; 
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
				<div class="col-12 pl-0"><h2>Precios spot del oro y la plata</h2></div>
			</div>

			<div class="row">

				<div class="col-12 col-md-6 px-0 pr-md-3" >
					<!-- TradingView Widget BEGIN -->
					<div class="tradingview-widget-container">
					  <div class="tradingview-widget-container__widget"></div>
					  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/futures/" rel="noopener" target="_blank"><span class="blue-text">Materias primas</span></a>  TradingView</div>
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
					      "title": "Materias primas",
					      "symbols": [
					        {
					          "s": "FX_IDC:XAUEUR",
					          "d": "Oro Euro/Onza"
					        },
					        {
					          "s": "FX_IDC:XAUEURG",
					          "d": "Oro Euro/Gramo"
					        }
					      ],
					      "originalTitle": "Materias primas"
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
					  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/futures/" rel="noopener" target="_blank"><span class="blue-text">Materias primas</span></a>  TradingView</div>
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
					      "title": "Materias primas",
					      "symbols": [
					        {
					          "s": "FX_IDC:XAGEUR",
					          "d": "Plata Euro/Onza"
					        },
					        {
					          "s": "FX_IDC:XAGEURG",
					          "d": "Plata Euro/Gramo"
					        }
					      ],
					      "originalTitle": "Materias primas"
					    }
					  ]
					}
					  </script>
					</div>
					<!-- TradingView Widget END -->
					</div>



			</div>
			<div class="row">
				<div class="col-12 pl-0"><h2>Explore la inversión popular</h2></div>
			</div>
			<div class="row category_box">
				<div class="col-12 col-md-4 px-1 py-1">
					<div class="row">
						<div class="col-5">
							<a href="/products/goldcoins"><img src="https://tradeboost.eu/image/cat_gold_coin.jpg" alt="gold coins" style="max-width:100%" /></a>
						</div>
						<div class="col-7">
							<h3><a href="/products/goldcoins">Monedas de oro y plata</a></h3>
							<ul class="shortcuts">
								<li><a href="/group/krugerrand_coins">Krugerrand (Sudáfrica)</a></li>
								<li><a href="/group/maple_leaf_coins">Maple leaf (Canadá)</a></li>
								<li><a href="/group/american_eagle_coins">Silver Eagle (Estados Unidos)</a></li>
								<li><a href="/group/panda_coins">Panda (China)</a></li>
								<li><a href="/group/gb_gold_sovereign_coins">Sovereign (Reino Unido)</a></li>
								<li><a href="/group/gold_nuggets">Kangaroo/Nugget (Australia)</a></li>
								<li><a href="/group/philharmonics_coins">Philharmonics (Austria)</a></li>
								<li><a href="/group/britannia_coins">Britannia (Reino Unido)</a></li>
								<li><a href="/products/goldcoins"><br><b>Todas las monedas de oro</b></a></li>
								<li><a href="/products/silvercoins"><b>Todas las monedas de plata</b></a></li>

							</ul>
						</div>
					</div>
				</div>

				<div class="col-12 col-md-4 px-1 py-1">
					<div class="row">
						<div class="col-5">
							<a href="/products/goldbars"><img src="https://tradeboost.eu/image/cat_gold_bar.jpg" alt="Lingotes de oro"  style="max-width:100%" /></a>
						</div>
						<div class="col-7">
							<h3><a href="/products/goldbars">Lingotes de oro</a></h3>
							<ul class="shortcuts">
								<li><a href="/manufacturer/CH_PAMP">Lingotes de oro PAMP</a></li>
								<li><a href="/manufacturer/CH_UBS">Lingotes de oro UBS</a></li>
								<li><a href="/manufacturer/DE_HERA">Lingotes de oro Heraeus</a></li>
								<li><a href="/group/1_g_gold">Lingotes de oro de 1 gramo</a></li>
								<li><a href="/group/5_g_gold">Lingotes de oro de 5 gramo</a></li>
								<li><a href="/group/50_g_gold">Lingotes de oro de 50 gramo</a></li>
								<li><a href="/group/100_g_gold">Lingotes de oro de 100 gramo</a></li>
								<li><a href="/products/goldbars"><br><b>Todos los lingotes de oro</b></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-4 px-1 py-1">
					<div class="row">
						<div class="col-5">
							<a href="/products/silverbars"><img src="https://tradeboost.eu/image/cat_silver_bar.jpg" alt="Lingotes de plata"  style="max-width:100%" /></a>
						</div>
						<div class="col-7">
							<h3><a href="/products/goldbars">Lingotes de plata</a></h3>
							<ul class="shortcuts">
								<li><a href="/manufacturer/CH_PAMP">Lingotes de plata PAMP</a></li>
								<li><a href="/manufacturer/CH_UBS">Lingotes de plata UBS</a></li>
								<li><a href="/manufacturer/ch_metalor">Lingotes de plata Metalor</a></li>
								<li><a href="/group/1_oz_silver">Lingotes de plata de 1 oz</a></li>
								<li><a href="/group/100_g_silver">Lingotes de plata de 100 gramos</a></li>
								<li><a href="/group/500_g_silver">Lingotes de plata de 500 gramos</a></li>								
								<li><a href="/group/10_oz_silver">Lingotes de plata de 10 oz</a></li>
								<li><a href="/products/silverbars"><br><b>Todos los lingotes de plata</b></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12 px-0"><h2>Este es el Trade boost</h2>
					<p>
					¡Bienvenido a Trade boost! Somos un grupo de inversionistas interesados en oro y plata que administran este sitio web sin fines de lucro. Nuestro objetivo es crear el mejor sitio web de comparación de precios de Europa para metales preciosos dirigido a inversores y coleccionistas.
					</p>
					<p>
					Recopilamos productos, precios y estado de existencias de los principales proveedores en línea y casas de subastas varias veces al día. Los productos se ordenan en tiempo real para presentar la opción más barata para un producto específico que le guste.
					</p>
					<p>
					Todos los productos no son de oro de 24 quilates, por lo que antes del impulso comercial era difícil comparar dos productos. En Trade boost puedes encontrar la cantidad de metal precioso puro en oz y gramo por producto para poder compararlo con otro producto. También puede ver cuánto vale ese metal puro en el mercado y cuánto prima (margen de ventas) el proveedor agrega al precio. Todos los proveedores tienen esta prima. Así es como ganan dinero. Por lo general, la prima baja si compra más.
					</p>
					<p>Los precios de mercado del oro y la plata cambian cada segundo, y actualmente buscamos precios con la mayor frecuencia posible, pero no cada segundo. Debe verificar el precio en el sitio web del proveedor antes de comprar.
					</p>
					<p>
					Si tiene una idea sobre una mejora o característica, ¡nos encantaría contarla! Enviar un correo electrónico a info [a] Tradeboost.eu.
					</p>

				</div>


				</div>
			</div>

		</div>
	</div>				
