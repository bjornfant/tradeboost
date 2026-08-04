	<div class="container-fluid page_head" style="background-color: #000000;">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-xs-12 pl-0">
					<img src="https://tradeboost.eu/image/bg_maple_leaf_small.png"  style="max-width:100%">
				</div>
				<div class="col-md-8 col-xs-12 pl-0">
					<h1 style="	padding-bottom:1em">Comparez les prix avant d'investir!</h1>
					<p class="intro">
						<span class='stockin'>✓</span> Prix mis à jour sur les produits d'or et d'argent des fournisseurs en ligne européens
					</p>
					<p class="intro">
						<span class='stockin'>✓</span> Prix par once par rapport au prix au comptant du marché
					</p>
					<p class="intro">
						<span class='stockin'>✓</span> Enchères en temps réel sur Ebay et plus
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
				<div class="col-12 pl-0"><h2>Prix au comptant de l'or et de l'argent</h2></div>
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
				<div class="col-12 pl-0"><h2>Investissements populaires</h2></div>
			</div>
			<div class="row category_box">
				<div class="col-12 col-md-6 px-1 py-1">
					<div class="row">
						<div class="col-5">
							<a href="/products/goldcoins"><img src="https://tradeboost.eu/image/cat_gold_coin.jpg" alt="gold coins" style="max-width:100%" /></a>
						</div>
						<div class="col-7">
							<h3><a href="/products/goldcoins">Pièces d'or et d'argent</a></h3>
							<ul class="shortcuts">
								<li><a href="/group/krugerrand_coins">Krugerrand</a></li>
								<li><a href="/group/maple_leaf_coins">Maple leaf</a></li>
								<li><a href="/group/american_eagle_coins">Gold and Silver Eagles</a></li>
								<li><a href="/group/panda_coins">Pandas</a></li>
								<li><a href="/group/gb_gold_sovereign_coins">Sovereigns</a></li>
								<li><a href="/group/gold_nuggets">Kangaroo/Nugget</a></li>
								<li><a href="/group/philharmonics_coins">Philharmonics</a></li>
								<li><a href="/group/britannia_coins">Britannias</a></li>
								<li><a href="/products/goldcoins"><br><b>Toutes les pièces d'or</b></a></li>
								<li><a href="/products/silvercoins"><b>Toutes les pièces d'argent</b></a></li>

							</ul>
						</div>
					</div>
				</div>

				<div class="col-12 col-md-6 px-1 py-1">
					<div class="row">
						<div class="col-5">
							<a href="/products/goldbars"><img src="https://tradeboost.eu/image/cat_gold_bar.jpg" alt="gold bars"  style="max-width:100%" /></a>
						</div>
						<div class="col-7">
							<h3><a href="/products/goldbars">Lingots d'or et d'argent</a></h3>
							<ul class="shortcuts">
								<li><a href="/products/goldbars?manufacturer=CH_PAMP">PAMP lingots d'or</a></li>
								<li><a href="/products/goldbars?manufacturer=CH_UBS">UBS lingots d'or</a></li>
								<li><a href="/products/goldbars?manufacturer=AU">Perth lingots d'or</a></li>
								<li><a href="/products/goldbars?manufacturer=SE_BOL">Boliden lingots d'or</a></li>
								<li><a href="/products/goldbars?manufacturer=AT">Münze Osterreich lingots d'or</a></li>
								<li><a href="/products/goldbars?manufacturer=DE_HERA">Heraeus lingots d'or</a></li>
								<li><a href="/products/silverbars?manufacturer=CH_VAL">Valcambi lingots d'argent</a></li>
								<li><a href="/products/silverbars?manufacturer=SE_BOL">Boliden lingots d'argent</a></li>
								<li><a href="/products/goldbars"><br><b>Tous les lingots d'or</b></a></li>
								<li><a href="/products/silverbars"><b>Tous les lingots d'argent</b></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12 px-0"><h2>C'est Trade boost</h2>
					<p>
					Bienvenue sur Trade Boost ! Nous sommes un groupe d'investisseurs intéressés par l'or et l'argent qui gérons ce site Web à but non lucratif. Notre objectif est de créer le meilleur site de comparaison de prix en Europe pour les métaux précieux destiné aux investisseurs et aux collectionneurs.
					</p>
					<p>
					Nous collectons plusieurs fois par jour les produits, les prix et l'état des stocks de tous les plus grands fournisseurs en ligne et maisons de ventes aux enchères. Les produits sont triés en temps réel pour présenter l'option la moins chère pour un produit spécifique que vous aimez.
					</p>
					<p>
					Tous les produits ne sont pas en or 24 carats, il était donc difficile de comparer deux produits avant le développement du commerce. Chez Trade Boost, vous pouvez trouver la quantité de métal précieux pur en oz et gramme par produit pour pouvoir la comparer à un autre produit. Vous voyez également combien vaut ce métal pur sur le marché et combien de prime (marge de vente) le fournisseur ajoute au prix. Tous les fournisseurs bénéficient de cette prime. C'est comme ça qu'ils gagnent de l'argent. Habituellement, la prime diminue si vous achetez plus.
					</p>
					<p>Les prix du marché de l'or et de l'argent changent toutes les secondes, et nous récupérons actuellement les prix aussi souvent que possible, mais pas toutes les secondes. Vous devriez vérifier le prix sur le site Web du fournisseur avant d'acheter.
					</p>
					<p>
					Si vous avez une idée sur une amélioration ou une fonctionnalité, nous aimerions en parler ici! Envoyez un e-mail à info [a] Trade boost.eu.
					</p>

				</div>


				</div>
			</div>

		</div>
	</div>				
