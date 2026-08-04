<?php
// Database credentials live in one shared file. On the server that is the
// shared application directory; the second path is for a local checkout.
$tradeboost_secrets = '/var/www/tradeboost.eu/public_html/secrets.php';
if (!file_exists($tradeboost_secrets)) {
	$tradeboost_secrets = __DIR__ . '/../../secrets.php';
}
require_once($tradeboost_secrets);
tradeboost_define_database_credentials('production');
require_once('model/database.php');
require_once('model/commodity.php');


$price_array = new Commodity;
$comodity_price_array = array();
$comodity_price_array['AU'] = $price_array->get_commodity_price('AU');
$comodity_price_array['SI'] = $price_array->get_commodity_price('SI');


$page_title = "Aktueller Silberpreis in Gramm, Kilogramm und Unzen";
$page_meta_title = $page_title;
$page_meta_description = "Aktueller Silberpreis in Euro, CHF und USD für Investoren, Stapler und Silbersammler. Smartphone-freundliche Statistiken und Informationen für alle.";
?>
<html>
	<head>
		<title><?php echo $page_meta_title ?></title>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="<?php echo $page_meta_description; ?>">
		<link rel="stylesheet" href="css/bootstrap.min.css" />


	</head>
	<body style="padding:20px">



	<div class="container-fluid page_head">
		<div class="container">
			<div class="row">
				<div class="col-md-12 pl-0">
					<h1><?php echo $page_title; ?></h1>
					<p style="padding-bottom:1em">
						<?php echo $page_meta_description; ?>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid page_body">
		<div class="container">

			


			<div class="row">
				<div class="col-12 col-md-6 px-0 pr-md-3">
					<h2>Silber/Gramm</h2>
					<p><?php echo "&#x1F551;&nbsp; Aktualisiert " . substr($comodity_price_array['SI']['EUR']['update_date'],11,5) ?></p>
					<table class="table table-striped thead-dark table-bordered">
						<tr>
							<th scope="col"><b>Grammen</b></th>
							<th scope="col"><b>Euro</b></th>
							<th scope="col"><b>CHF</b></th>
							<th scope="col"><b>USD</b></th>
						</tr>
						<tr>
							<td>5 gram Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_gram']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 gram Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_gram']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 gram Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_gram']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 gram Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_gram']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 gram Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_gram']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>250 gram Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*250, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_gram']*250, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*250, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 gram Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_gram']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*500, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1 kilo Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 kilo Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 kilo Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
						</tr>
					</table>
					

				</div>
				<div class="col-12 col-md-6 px-0 pl-md-3">
					<h2>Silber/Unzen</h2>
					<p><?php echo "&#x1F551;&nbsp; Aktualisiert " . substr($comodity_price_array['SI']['EUR']['update_date'],11,5) ?></p>
					<table class="table table-striped thead-light table-bordered">
						<tr>
							<th><b>Unzen</b></th>
							<th><b>Euro</b></th>
							<th><b>CHF</b></th>
							<th><b>USD</b></th>
						</tr>
						<tr>
							<td>1/2 troy oz Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']/2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_oz']/2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']/2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1 troy oz Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_oz'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz'], 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>2 troy oz Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']*2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_oz']*2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']*2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 troy oz Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_oz']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 troy oz Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_oz']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>20 troy oz Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']*20, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_oz']*20, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']*20, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 troy oz Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_oz']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 troy oz Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_oz']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 troy oz Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_oz']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 troy oz Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_oz']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']*500, 2, '.', ' '); ?> </td>
						</tr>
					</table>
				</div>
			</div>




			<div class="row">			
				<div class="col-12 col-md-6 px-0 pr-md-3">
					<h2>Silberpreis Euro, CHF und USD pro Grammen</h2>
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
					  "height": "500",
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
					          "s": "FX_IDC:XAGEURG",
					          "d": "Silver Euro/Gram"
					        },
					       {
					          "s": "FX_IDC:XAGUSDG*OANDA:USDCHF",
					          "d": "Silver CHF/Gram"
					        },
					        {
					          "s": "FX_IDC:XAGUSDG",
					          "d": "Silver USD/Gram"
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
					<h2>Silberpreis Euro, CHF und USD pro Unzen</h2>
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
					  "height": "500",
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
					          "s": "FX_IDC:XAGUSD*OANDA:USDCHF",
					          "d": "Silver CHF/Oz"
					        },
					        {
					          "s": "FX_IDC:XAGUSD",
					          "d": "Silver USD/Oz"
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
				<div class="col-12 col-md-12 px-0 pr-md-3">
					<hr/>
					<h2>Silberminenunternehmen</h2>
				</div>
			</div>
			<div class="row">			
				<div class="col-12 col-md-12 px-0 pr-md-3">

				<!-- TradingView Widget BEGIN -->
				<div class="tradingview-widget-container">
				  <div class="tradingview-widget-container__widget"></div>
				  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com" rel="noopener" target="_blank"><span class="blue-text">Silver stocks</span></a> by TradingView</div>
				  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
				  {
				  "colorTheme": "light",
				  "dateRange": "12M",
				  "showChart": true,
				  "locale": "en",
				  "width": "100%",
				  "height": "600",
				  "largeChartUrl": "",
				  "isTransparent": false,
				  "showSymbolLogo": true,
				  "plotLineColorGrowing": "rgba(33, 150, 243, 1)",
				  "plotLineColorFalling": "rgba(33, 150, 243, 1)",
				  "gridLineColor": "rgba(240, 243, 250, 1)",
				  "scaleFontColor": "rgba(120, 123, 134, 1)",
				  "belowLineFillColorGrowing": "rgba(33, 150, 243, 0.12)",
				  "belowLineFillColorFalling": "rgba(33, 150, 243, 0.12)",
				  "symbolActiveColor": "rgba(33, 150, 243, 0.12)",
				  "tabs": [
				    {
				      "title": "Silver stocks",
				      "symbols": [
				        {
				          "s": "OTC:IPOAF",
				          "d": "Industrias Penoles SAB de CV"
				        },
				        {
				          "s": "OTC:AUCOY",
				          "d": "Polymetal International PLC"
				        },
				        {
				          "s": "OTC:FNLPF",
				          "d": "Fresnillo PLC"
				        },
				        {
				          "s": "NASDAQ:PAAS",
				          "d": "an American Silver Corp"
				        },
				        {
				          "s": "NYSE:WPM",
				          "d": "Wheaton Precious Metals Corp"
				        },
				        {
				          "s": "NYSE:CDE",
				          "d": "Coeur Mining Inc"
				        },
				        {
				          "s": "NYSE:BVN",
				          "d": "Buenaventura Mining Co. Inc"
				        },
				        {
				          "s": "NYSE:HL",
				          "d": "Hecla Mining Co"
				        },
				        {
				          "s": "NYSE:AG",
				          "d": "First Majestic Silver Corp"
				        },
				        {
				          "s": "NYSE:FSM",
				          "d": "Fortuna Silver Mines Inc"
				        }
				      ]
				    }
				  ]
				}
				  </script>
				</div>
				<!-- TradingView Widget END -->

				</div>
			</div>

			</div>



			
		</div>
	</div>				





	</body>
</html>