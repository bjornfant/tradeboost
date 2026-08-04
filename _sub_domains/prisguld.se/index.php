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


$page_title = "Aktuellt guldpris i gram, kilo och troy uns";
$page_meta_title = $page_title;
$page_meta_description = "Smartphonevänligt guldpris i SEK, Euro och USD för samlare och investerare som vill hålla koll på guldpriset. Sidan utvecklas hela tiden med mer statistik och information om råvarumarknaden och gruvindustrin kring guld";
?>
<html>
	<head>
		<title><?php echo $page_meta_title ?></title>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="<?php echo $page_meta_description; ?>">
		<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="icon" href="https://prisguld.se/img/cropped-maple-leaf-coin-32x32.jpg" sizes="32x32" />
<link rel="icon" href="https://prisguld.se/img/cropped-maple-leaf-coin-192x192.jpg" sizes="192x192" />
<link rel="apple-touch-icon-precomposed" href="https://prisguld.se/img/cropped-maple-leaf-coin-180x180.jpg" />		
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
				<div class="col-12 col-md-6 px-0 pr-md-">
					<h2>Guld/Troy uns</h2>
					<p><?php echo "&#x1F551;&nbsp; Uppdaterat " . substr($comodity_price_array['AU']['EUR']['update_date'],11,5) . " " . date("Y-m-d")?></p>
					<table class="table table-striped thead-light table-bordered">
						<tr>
							<th><b>Troy uns</b></th>
							<th><b>Euro</b></th>
							<th><b>SEK</b></th>
							<th><b>USD</b></th>
						</tr>
						<tr>
							<td>1/2 troy oz Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_oz']/2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_oz']/2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_oz']/2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1 troy oz Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_oz'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_oz'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_oz'], 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>2 troy oz Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_oz']*2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_oz']*2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_oz']*2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 troy oz Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_oz']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_oz']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_oz']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 troy oz Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_oz']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_oz']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_oz']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>20 troy oz Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_oz']*20, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_oz']*20, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_oz']*20, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 troy oz Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_oz']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_oz']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_oz']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 troy oz Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_oz']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_oz']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_oz']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 troy oz Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_oz']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_oz']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_oz']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 troy oz Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_oz']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_oz']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_oz']*500, 2, '.', ' '); ?> </td>
						</tr>
					</table>
				</div>				
				<div class="col-12 col-md-6 px-0 pl-md-3">
					<h2>Guld/Gram</h2>
					<p><?php echo "&#x1F551;&nbsp; Uppdaterat " . substr($comodity_price_array['AU']['EUR']['update_date'],11,5) . " " . date("Y-m-d") ?></p>
					<table class="table table-striped thead-dark table-bordered">
						<tr>
							<th scope="col"><b>Gram</b></th>
							<th scope="col"><b>Euro</b></th>
							<th scope="col"><b>SEK</b></th>
							<th scope="col"><b>USD</b></th>
						</tr>
						<tr>
							<td>5 Gram Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_gram']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_gram']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_gram']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 Gram Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_gram']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_gram']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_gram']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 Gram Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_gram']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_gram']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_gram']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 Gram Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_gram']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_gram']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_gram']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 Gram Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_gram']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_gram']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_gram']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>250 Gram Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_gram']*250, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_gram']*250, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_gram']*250, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 Gram Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_gram']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_gram']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_gram']*500, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1 kilo Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 kilo Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 kilo Guld</td>
							<td> <?php echo number_format($comodity_price_array['AU']['EUR']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['SEK']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array['AU']['USD']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
						</tr>
					</table>
					

				</div>
			</div>




			<div class="row">			
				<div class="col-12 col-md-6 px-0 pr-md-3">
					<h2>Guldpris per Gram Euro, SEK und USD</h2>
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
					          "s": "FX_IDC:XAUEURG",
					          "d": "Guld Euro/Gram"
					        },
					       {
					          "s": "FX_IDC:XAUUSDG*OANDA:USDSEK",
					          "d": "Guld SEK/Gram"
					        },
					        {
					          "s": "FX_IDC:XAUUSDG",
					          "d": "Guld USD/Gram"
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
					<h2>Guldpris per troy uns Euro, SEK und USD</h2>
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
					          "s": "FX_IDC:XAUEUR",
					          "d": "Guld Euro/Oz"
					        },
					        {
					          "s": "FX_IDC:XAUUSD*OANDA:USDSEK",
					          "d": "Guld SEK/Oz"
					        },
					        {
					          "s": "FX_IDC:XAUUSD",
					          "d": "Guld USD/Oz"
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
<h1>Köpa guld i Sverige – en guide för investerare och samlare</h1>

<p>Intresset för <strong>guld</strong> har ökat markant bland svenska investerare och samlare de senaste åren. I en värld präglad av inflation, börsoro och geopolitiska konflikter ses guld som en trygg hamn för kapital. För dig som vill förstå mer om <strong>guldpriset</strong>, hur du kan <strong>köpa guld online</strong> och vilka <strong>guldmynt och guldtackor</strong> som är mest populära i Europa, är detta rätt plats att börja.</p>

<h2>Varför investera i guld?</h2>

<p>Guld är en tidlös investering som har använts som betalningsmedel och värdebevarare i tusentals år. Till skillnad från aktier eller obligationer är guld ett fysiskt tillgångsslag som inte är beroende av en enskild valuta, centralbank eller företag. Det ger skydd mot inflation, valutakollapser och finanskriser. Många svenskar använder idag guld som en del av en diversifierad portfölj för att sprida riskerna.</p>

<h2>Vad påverkar guldpriset?</h2>

<p><strong>Guldpriset</strong> bestäms av den globala marknaden och handlas i USD per troy ounce (ca 31,1 gram). Prisets rörelser påverkas av en rad faktorer såsom:</p>
<ul>
  <li>Inflation och räntor</li>
  <li>Valutakurser, särskilt dollarn</li>
  <li>Centralbankers köp och försäljningar</li>
  <li>Geopolitisk oro</li>
  <li>Utbud och efterfrågan på fysiskt guld</li>
</ul>
<p>För att hitta det <strong>lägsta guldpriset i Europa</strong> kan du använda <a href="https://tradeboost.se">prisjämförelsesajter som <strong>Tradeboost.eu</strong></a>, där du ser aktuella spotpriser, återförsäljarpriser och leveransalternativ.</p>

<h2>Populära guldmynt för investerare och samlare</h2>

<p><strong>Guldmynt</strong> är ett mycket populärt sätt att investera i guld eftersom de är internationellt igenkända, lätta att sälja och ofta momsbefriade inom EU. De präglas vanligtvis i vikten 1 oz (31,1 g), men finns även i mindre storlekar som 1/2 oz, 1/4 oz och 1/10 oz. Här är några av de mest kända mynten:</p>

<ul>
  <li><a href="https://tradeboost.se/group/philharmonics_coins"><strong>Wiener Philharmoniker</strong></a> – Österrike: En av Europas mest sålda investeringsmynt, i 24 karat (999,9/1000).</li>
  <li><a href="https://tradeboost.se/group/krugerrand_coins"><strong>Krugerrand</strong></a> – Sydafrika: Världens mest kända guldmynt, med 22 karat (91,67 % guld och 8,33 % koppar).</li>
  <li><a href="https://tradeboost.se/group/maple_leaf_coins"><strong>Maple Leaf</strong></a> – Kanada: Känd för sin renhet och säkerhetsdetaljer. 24 karat (999,9/1000).</li>
  <li><a href="https://tradeboost.se/group/britannia_coins"><strong>Britannia</strong></a> – Storbritannien: 999,9/1000 guld med växlande motiv och hög säkerhet.</li>
  <li><a href="https://tradeboost.se/group/panda_coins"><strong>Panda</strong></a> – Kina och <strong>Libertad</strong> – Mexiko: Ofta eftertraktade av samlare tack vare begränsade upplagor och design.</li>
</ul>

<p>Dessa mynt är lagliga betalningsmedel i sina respektive länder, vilket innebär att de ofta är <strong>momsbefriade</strong> när du köper dem som investering i Sverige.</p>

<h2>Guldtackor – för större investeringar</h2>

<p>Vill du investera större belopp kan <strong>guldtackor</strong> vara ett bättre alternativ. De finns i storlekar från 1 gram till 1 kg och till och med 400 oz (ca 12,5 kg) för institutionella investerare. Ju större tacka, desto lägre premium i procent räknat – men också lägre flexibilitet vid försäljning.</p>

<p>I Europa är följande varumärken särskilt välkända och respekterade:</p>

<ul>
  <li><a href="https://tradeboost.se/manufacturer/CH_VAL"><strong>Valcambi</strong></a> (Schweiz) – Kända för sina CombiBars (brytbara tackor i 1g-storlek).</li>
  <li><a href="https://tradeboost.se/manufacturer/de_umicore"><strong>Umicore</strong></a> (Belgien) – Fokuserar på hållbarhet och återvunnet guld.</li>
  <li><a href="https://tradeboost.se/manufacturer/DE_HERA"><strong>Argor-Heraeus</strong></a> (Schweiz) – Samarbetar med flera banker och återförsäljare i Europa.</li>
</ul>

<p>Samtliga dessa tillverkare erbjuder <strong>LBMA-certifierade guldtackor</strong> vilket innebär att de är godkända för handel på den internationella marknaden.</p>

<h2>Köpa guld online i Sverige och Europa</h2>

<p>Att <strong>köpa guld online</strong> har blivit både enkelt och säkert. Du får tillgång till ett stort utbud, realtidspriser och leverans direkt till dörren eller till ett bankfack. Några populära guldhandlare i Sverige och övriga Europa är:</p>

<ul>
  <li><strong>Tavex</strong> – Verksamma i flera europeiska länder med kontor i Stockholm.</li>
  <li><strong>Guldcentralen</strong> – Svensk återförsäljare av både mynt och tackor.</li>
  <li><strong>Degussa</strong> – Tysk guldfirma med gott rykte och fysisk närvaro i flera länder.</li>
  <li><strong>GoldSilberShop.de</strong> – Tysk aktör med snabba leveranser till Sverige.</li>
  <li><strong>CoinInvest</strong> – Brittisk återförsäljare med stort utbud och konkurrenskraftiga priser.</li>
</ul>

<p>Innan du handlar bör du kontrollera att återförsäljaren:</p>

<ul>
  <li>Visar <strong>aktuella spotpriser</strong></li>
  <li>Erbjuder <strong>säker och försäkrad leverans</strong></li>
  <li>Har <strong>certifierade produkter</strong> från LBMA-godkända tillverkare</li>
  <li>Har bra omdömen och recensioner</li>
</ul>


<h2>Sälja guld – när och hur?</h2>

<p>När det är dags att <strong>sälja guld</strong> är det viktigt att välja rätt tidpunkt och en trovärdig köpare. Guldpriset varierar dagligen, så att sälja när marknaden är stark kan ge dig bättre avkastning. Många återförsäljare som säljer guld erbjuder även <strong>återköp</strong> – antingen via postförsändelse eller i butik.</p>

<p>Du kan också sälja direkt till andra samlare eller investerare via auktionssajter eller specialiserade plattformar – men var då noga med att kontrollera äkthet och betalningssäkerhet.</p>

<p>Genom att köpa välkända <strong>guldmynt</strong> eller <strong>guldtackor</strong> från certifierade tillverkare får du en investering med hög likviditet och global acceptans. Med dagens teknik är det enkelt att <strong>köpa guld online</strong> till konkurrenskraftiga priser.</p>


				</div>
			</div>
			
		</div>
	</div>				
		<div class="row">			
			<div class="col-12 col-md-12 px-0 pr-md-3">
				<hr/>
				&copy; Copyright Prisguld.se | <a href= "https://tradeboost.eu/">En del av Trade boost</a></a>
			</div>
		</div>		


	</body>
</html>