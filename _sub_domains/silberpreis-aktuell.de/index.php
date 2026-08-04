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
					<p><?php echo "&#x1F551;&nbsp; Aktualisiert " . substr($comodity_price_array['SI']['EUR']['update_date'],11,5) . " " . date("Y-m-d") ?></p>
					<table class="table table-striped thead-dark table-bordered">
						<tr>
							<th scope="col"><b>Gram</b></th>
							<th scope="col"><b>Euro</b></th>
							<th scope="col"><b>CHF</b></th>
							<th scope="col"><b>USD</b></th>
						</tr>
						<tr>
							<td>5 Gramm Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_gram']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 Gramm Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_gram']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 Gramm Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_gram']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 Gramm Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_gram']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 Gramm Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_gram']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>250 Gramm Silber</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*250, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['CHF']['price_per_gram']*250, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*250, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 Gramm Silber</td>
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
					<h2>Silber/Troy uns</h2>
					<p><?php echo "&#x1F551;&nbsp; Aktualisiert " . substr($comodity_price_array['SI']['EUR']['update_date'],11,5) . " " . date("Y-m-d")?></p>
					<table class="table table-striped thead-light table-bordered">
						<tr>
							<th><b>Troy uns</b></th>
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
					<h2>Silberpris per Gramm Euro, CHF und USD</h2>
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
					          "d": "Silber Euro/Gramm"
					        },
					       {
					          "s": "FX_IDC:XAGUSDG*OANDA:USDCHF",
					          "d": "Silber CHF/Gramm"
					        },
					        {
					          "s": "FX_IDC:XAGUSDG",
					          "d": "Silber USD/Gramm"
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
					<h2>Silberpris per troy uns Euro, CHF und USD</h2>
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
					          "d": "Silber Euro/Oz"
					        },
					        {
					          "s": "FX_IDC:XAGUSD*OANDA:USDCHF",
					          "d": "Silber CHF/Oz"
					        },
					        {
					          "s": "FX_IDC:XAGUSD",
					          "d": "Silber USD/Oz"
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
				<h2>Über das wunderbare Metall Silber</h2>
Silber ist ein faszinierendes Metall und bei Investoren sehr beliebt, da es im Gegensatz zu Gold in vielen Alltagsgegenständen verwendet wird. Autos, Telefone und andere Unterhaltungselektronik sind stark auf Silber angewiesen, da es ein exzellenter elektrischer Leiter ist. Viel von der Technologie, die den Weg für eine grüne Transformation unserer Welt ebnet, basiert auf Silber und Kupfer – insbesondere Batterietechnologien, aber auch Solarzellen, Windkraftanlagen und die Elektrifizierung des Transports.<br/><br/>
<h3>Wo wird das meiste Silber der Welt abgebaut?</h3>
„Argent“ bedeutet Silber – daher hat das Land Argentinien seinen Namen. Große Teile Süd- und Mittelamerikas sind reich an Silber, insbesondere Mexiko und Peru, wo sich viele der weltweit größten Minen befinden. Auch Russland, China und Australien sind bedeutende Förderländer für Silber und Gold. In Europa ist Polen der größte Produzent – direkt gefolgt von Schweden.<br/><br/>
Es gibt keine reinen Silber- oder Goldminen, da in einem Erzvorkommen meist mehrere Metalle gleichzeitig gefunden werden. Das Erz wird verarbeitet und die einzelnen Metalle voneinander getrennt. Silber ist häufiger als Gold – noch häufiger sind Blei, Zink und Kupfer.<br/><br/>
<h3>Physisches Silber kaufen</h3>
Wie bei allem, worin man investiert, ist es ein gutes Gefühl, etwas in der Hand halten zu können – so auch beim physischen Silber. Genau wie bei Gold kann man als Privatperson oder Unternehmen Silberbarren und Silbermünzen von verschiedenen Herstellern kaufen. Münzen werden von den Zentralbanken oder staatlichen Prägestätten ausgegeben und sind sowohl bei Sammlern als auch bei Investoren beliebt. Der Preis physischer Silberprodukte richtet sich nach dem Weltmarktpreis (Spotpreis) und ändert sich ständig. Hinzu kommen die Margen von Händlern und Herstellern.<br/><br/>
Silbermünzen und -barren findest du am günstigsten online – auch wenn einige Münzhändler diese ebenfalls anbieten. Den <a href= "https://tradeboost.eu/">besten Preis findest du über Preisvergleichsseiten wie Trade Boost</a>.<br/>
Anlagemünzen aus Silber gibt es in verschiedenen Größen, meist basierend auf dem Feingewicht in Troy-Unzen (ca. 31 g). Eine Münze kann mehr als 1 oz wiegen, wenn sie mit anderen Metallen legiert ist, aber eine 1 oz Silbermünze bedeutet immer 1 oz reines Silber. Für Silbermünzen ist das in der Regel auch der Fall. Goldmünzen hingegen werden oft mit Kupfer oder Silber legiert, um sie haltbarer zu machen. Typische Gewichte sind 1 oz, 2 oz, 5 oz, 10 oz und sogar 1 kg oder mehr. Die Form bleibt die einer Münze, aber das Gewicht erinnert eher an einen Barren. Silberbarren gibt es bis zu 100 oz.<br/><br/>
Der Vorteil beim Kauf größerer Silberstücke (Barren oder Münzen) ist der günstigere Preis. Zehn einzelne 1 oz Münzen sind teurer als eine 10 oz Münze, da bei mehreren Produkten höhere Produktionskosten entstehen. Auch wenn es nicht denselben Preisvorteil wie ein einzelner großer Barren gibt, kann man beim Kauf mehrerer Stücke Mengenrabatte erhalten. Silbermünzen werden oft in Plastikröhren mit 20 oder 25 Stück geliefert – je nach Hersteller. Mehrere Münzen zu haben ist auch vorteilhaft beim Verkauf: Einen Barren muss man als Ganzes verkaufen, Münzen kann man stückweise verkaufen.<br/><br/>
Bei der Auswahl der Münzen gibt es tausende Varianten. Für Sammler kann es spannend sein, nach besonderen Motiven oder niedrigen Auflagen zu suchen. Für Investoren ist es sinnvoller, auf weltweit bekannte und weit verbreitete Münzen zu setzen, da diese preislich wettbewerbsfähig und leicht verkäuflich sind. Hier sind einige empfehlenswerte Silbermünzen für Investoren:<br/>
1 oz Silber Maple Leaf – Kanada<br/>
1 oz American Silver Eagle – USA<br/>
1 oz Britannia – Großbritannien<br/>
1 oz Silber Philharmoniker – Österreich<br/>
1 oz Silber Känguru – Australien<br/>
1 kg Silber Koala – Australien<br/>
1 oz Libertad – Mexiko<br/>
30 g Silber Panda – China<br/><br/>
Alle diese Münzen werden von den jeweiligen Zentralbanken oder Prägestätten der Länder herausgegeben und sind international bekannt.<br/>
Silberbarren hingegen werden vor allem von Bergbauunternehmen oder verbundenen Unternehmen hergestellt, nicht von Zentralbanken oder staatlichen Münzanstalten – obwohl es Ausnahmen gibt. Bekannte Anbieter von Silberbarren sind UBS, Umicore, Heraeus und Valcambi. Auch Münzprägestätten wie Perth Mint, Royal Canadian Mint und die Royal Mint aus Großbritannien stellen Silberbarren her.

				</div>
			</div>

			<div class="row">			
				<div class="col-12 col-md-12 px-0 pr-md-3">
					<hr/>
					<h2>Börsennotierte Unternehmen in der Silberbranche</h2>
				</div>
			</div>
			<div class="row">			
				<div class="col-12 col-md-12 px-0 pr-md-3">

				<!-- TradingView Widget BEGIN -->
				<div class="tradingview-widget-container">
				  <div class="tradingview-widget-container__widget"></div>
				  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com" rel="noopener" target="_blank"><span class="blue-text">Silber stocks</span></a> by TradingView</div>
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
				      "title": "Silber stocks",
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
				          "d": "an American Silber Corp"
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
				          "d": "First Majestic Silber Corp"
				        },
				        {
				          "s": "NYSE:FSM",
				          "d": "Fortuna Silber Mines Inc"
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
		<div class="row">			
			<div class="col-12 col-md-12 px-0 pr-md-3">
				<hr/>
				&copy; Copyright <a href="https://goldenpreis.de/">Goldenpreis.de</a>,  <a href="https://silberpreis-aktuell.de/">Silberpreis-aktuell.de</a> | <a href= "https://tradeboost.eu/">Ein Teil des Dienstes Trade Boost – Finde den niedrigsten Preis für Gold und Gold in Europa</a></a>
			</div>
		</div>		


	</body>
</html>