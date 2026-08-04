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


$page_title = "Aktuellt silverpris i gram, kilo och troy uns";
$page_meta_title = $page_title;
$page_meta_description = "Smartphonevänligt silverpris i SEK, Euro och USD för samlare och investerare som vill hålla koll på silverpriset. Sidan växer konstant med mer statistik och information om råvarumarknaden och gruvindustrin kring silver";
?>
<html>
	<head>
		<title><?php echo $page_meta_title ?></title>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="<?php echo $page_meta_description; ?>">
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-BNBH6E6F9T"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'G-BNBH6E6F9T');
		</script>
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
					<h2>Silver/Gram</h2>
					<p><?php echo "&#x1F551;&nbsp; Uppdaterat " . substr($comodity_price_array['SI']['SEK']['update_date'],11,5) ?></p>
					<table class="table table-striped thead-dark table-bordered">
						<tr>
							<th scope="col"><b>Gram</b></th>
							<th scope="col"><b>Euro</b></th>
							<th scope="col"><b>SEK</b></th>
							<th scope="col"><b>USD</b></th>
						</tr>
						<tr>
							<td>5 gram silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_gram']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 gram silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_gram']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 gram silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_gram']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 gram silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_gram']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 gram silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_gram']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>250 gram silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*250, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_gram']*250, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*250, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 gram silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_gram']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*500, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1 kilo silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 kilo silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 kilo silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
						</tr>
					</table>
					

				</div>
				<div class="col-12 col-md-6 px-0 pl-md-3">
					<h2>Silver/Troy uns</h2>
					<p><?php echo "&#x1F551;&nbsp; Uppdaterat " . substr($comodity_price_array['SI']['EUR']['update_date'],11,5) ?></p>
					<table class="table table-striped thead-light table-bordered">
						<tr>
							<th><b>Troy uns</b></th>
							<th><b>Euro</b></th>
							<th><b>SEK</b></th>
							<th><b>USD</b></th>
						</tr>
						<tr>
							<td>1/2 troy oz silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']/2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_oz']/2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']/2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1 troy oz silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_oz'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz'], 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>2 troy oz silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']*2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_oz']*2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']*2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 troy oz silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_oz']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 troy oz silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_oz']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>20 troy oz silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']*20, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_oz']*20, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']*20, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 troy oz silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_oz']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 troy oz silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_oz']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 troy oz silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_oz']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 troy oz silver</td>
							<td> <?php echo number_format($comodity_price_array['SI']['EUR']['price_per_oz']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['SEK']['price_per_oz']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['SI']['USD']['price_per_oz']*500, 2, '.', ' '); ?> </td>
						</tr>
					</table>
				</div>
			</div>




			<div class="row">			
				<div class="col-12 col-md-6 px-0 pr-md-3">
					<h2>Silverpris per gram Euro, SEK och USD</h2>
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
					          "s": "FX_IDC:XAGUSDG*OANDA:USDSEK",
					          "d": "Silver SEK/Gram"
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
					<h2>Silverpris per troy uns Euro, SEK och USD</h2>
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
					          "s": "FX_IDC:XAGUSD*OANDA:USDSEK",
					          "d": "Silver SEK/Oz"
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
				<h2>Om den underbara metallen silver</h2>
				Silver är en fantastisk metall och mycket uppskattad bland investerare, eftersom den till skillnad mot guld används i stor utsträckning i många av de föremål som vi använder varje dag. Bilar, telefoner och annan hemelektronik är helt beroende av silver eftersom det är en metall som leder ström extremt bra. Mycket av den teknik som banar väg för en grön omställning i vår värld kommer med hjälp av silver och koppar. I synnerhet batteriteknik, men även solceller, vindkraft och elektrifiering av olika transporter.<br/><br/>
				<h3>Var bryts all världens silver?</h3>
				”Argent” betyder silver, därav landet har Argentina fått sitt namn. Stora delar av syd- och mellanamerika är rika på silver och här ligger de flesta av världens gruvor, i synnerhet Mexiko och Peru. Ryssland, Kina och Australien är också rika gruvnationer och bryter både silver och guld. Här i Europa är det Polen som är störst, men sen är faktiskt Sverige den nästs största producenten. Våra gruvor ligger primärt i Norrbotten och Västerbotten och där bryts både guld och silver tillsammans med bly, zink, koppar och järnmalm. <br/><br/>
				Det finns inga renodlade silvergruvor eller guldgruvor eftersom man hittar flera metaller på samma ställe i samma malm. Malmen tas om hand och de olika metallerna separeras. Silver är vanligare än guld och ännu vanligare är bly, zink och koppar.<br/><br/>
				<h3>Att köpa fysiskt silver</h3>
				Som med allt man lägger pengar på är det skönt att kunna hålla något i handen. En investering i fysiskt silver är en sån. Precis som med guld kan du som privatperson eller företag köpa silvertackor och silvermynt från olika tillverkare. Mynt ges ut av olika länders centralbanker eller myntverk. Mynten har fördelen att de i sig är eftertraktade av så väl samlare som investerare. Även fysiska silverprodukter får sitt pris efter världspriset på silver (spotpriset) och priset ändras varje sekund. Ovanpå priset finns handlarens marginal och tillverkarens marginal. Silver är till skillnad från guld är också belagt med moms i många länder eftersom det inte fått samma status som investering som har fått guld. Inom EU är dock momssatsen på silver väldigt varierande och Sverige har en av de högsta procenten. <br/><br/>
				Du hittar silvermynt och silvertackor billigast online, även om mynthandlare även säljer en del. <a href= "https://tradeboost.eu/">Hitta lägst pris på silver med en prisjämförelse som Trade boost</a>.<br/>
				Silvermynt för investerare finns i lite olika storlekar och de flesta baseras på ädelmetallvikt (mängd silver) i troy uns (ca 31 g). Ett mynt kan väga mer än 1 oz om det är utblandat med andra metaller, men ett 1 oz silvermynt innebär att silvermängden är 1 oz. För silver är det inte så vanligt. För guldmynt är det vanligt att man blandar ut det med andra metaller som koppar och silver för att det ska få en bättre hållbarhet. Mynt hittar du vanligtvis i vikterna 1 oz, 2 oz, 5 oz, 10 oz och även 1 kg eller mer. Formen är fortfarande ett präglat mynt, men vikten för tankarna till en silvertacka istället. Silvertackor hittar du i valörer upp till 100 oz.<br/><br/>
				Fördelen med att köpa en stor bit silver (tacka eller mynt) är att det ofta är billigare. Att köpa 10 st 1 oz mynt är dyrare än att köpa ett 10 oz mynt eftersom det är mer kostnader bakom att göra flera produkter. Även om det inte kommer upp i samma prisfördel som ett stycke silver så kan man få mängdrabatt som du köper flera samtidigt. Silvermynt kommer ofta i plasttub om 20 eller 25 mynt, beroende på tillverkare. Att har flera mynt istället för en tacka är också en fördel när du ska sälja. En tacka behöver du sälja på en gång, medan mynt kan du sälja i omgångar.<br/><br/>
				När du ska välja vilka mynt att köpa finns det tusentals varianter. För samlare kan det vara kul att leta olika teman eller leta efter mynt med låg upplaga som ger en unik samling. För investerare är det en bättre ide att köpa populära mynt som är kända över hela världen och som är prispressade eftersom det är många aktörer som säljer dem. De är dessutom lätta att sälja när det är dags för det. Här är några mynt som är värda att ta en närmare titt på som investerare:<br/>
				1 oz Silver Maple Leaf – Kanada<br/>
				1 oz American Silver Eagle – USA<br/>
				1 oz Britannia – Storbritannien<br/>
				1 oz Silver Philharmoniker - Österrike<br/>
				1 oz Silver Kangaroo – Australien<br/>
				1 kg Silver Koala – Australien<br/>
				1 oz Libertad – Mexiko <br/>
				30 g Silver Panda – Kina<br/><br/>
				Alla dessa mynt ges ut av respektive lands centralbank eller myntverk och är internationellt kända.<br/>
				Primärt olika gruvföretag eller bolag associerade med dessa gjuter silvertackor, inte av centralbanker eller myntverk, men det förekommer. Du hittar silvertackor hos aktörer som UBS, Umicore, Heraeus och Valcambi, men även myntverk som Perth mint, Royal canadian mint och Royal mint från Storbritannien. 

				</div>
			</div>

			<div class="row">			
				<div class="col-12 col-md-12 px-0 pr-md-3">
					<hr/>
					<h2>Noterade gruvbolag inom silver</h2>
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


		<div class="row">			
			<div class="col-12 col-md-12 px-0 pr-md-3">
				<hr/>
				&copy; Copyright Prisilver.se | <a href= "https://tradeboost.eu/">En del av Trade boost</a></a>
			</div>
		</div>	


	</body>
</html>