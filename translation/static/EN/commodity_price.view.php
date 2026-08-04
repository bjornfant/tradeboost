<?php

$faq_array_weights = array(
	"1 oz" 		=> $comodity_price_array[$metal]['EUR']['price_per_oz'],
	"1/2 oz" 		=> $comodity_price_array[$metal]['EUR']['price_per_oz']/2,
	"1/4 oz" 		=> $comodity_price_array[$metal]['EUR']['price_per_oz']/4,
	"1/10 oz" 		=> $comodity_price_array[$metal]['EUR']['price_per_oz']/10,
	"1/20 oz" 		=> $comodity_price_array[$metal]['EUR']['price_per_oz']/20,
	"1/25 oz" 		=> $comodity_price_array[$metal]['EUR']['price_per_oz']/25,
	"2 oz" 			=> $comodity_price_array[$metal]['EUR']['price_per_oz']*2,
	"5 oz" 			=> $comodity_price_array[$metal]['EUR']['price_per_oz']*5,
	"10 oz" 		=> $comodity_price_array[$metal]['EUR']['price_per_oz']*10,
	"100 oz" 		=> $comodity_price_array[$metal]['EUR']['price_per_oz']*100,
	"10 kg" 		=> $comodity_price_array[$metal]['EUR']['price_per_gram']*10000,
	"5 kg"	 		=> $comodity_price_array[$metal]['EUR']['price_per_gram']*5000,
	"1 kg" 			=> $comodity_price_array[$metal]['EUR']['price_per_gram']*1000,
	"500 gram" 		=> $comodity_price_array[$metal]['EUR']['price_per_gram']*500,
	"250 gram" 		=> $comodity_price_array[$metal]['EUR']['price_per_gram']*250,
	"100 gram" 		=> $comodity_price_array[$metal]['EUR']['price_per_gram']*100,
	"50 gram" 		=> $comodity_price_array[$metal]['EUR']['price_per_gram']*50,
	"20 gram" 		=> $comodity_price_array[$metal]['EUR']['price_per_gram']*20,
	"10 gram" 		=> $comodity_price_array[$metal]['EUR']['price_per_gram']*10,
	"5 gram" 		=> $comodity_price_array[$metal]['EUR']['price_per_gram']*5,
	"1 gram" 		=> $comodity_price_array[$metal]['EUR']['price_per_gram']
);


$json_answers_array = array();
foreach ($faq_array_weights as $weight => $price) {
	$json_answers_array[] = '{
      "@type": "Question",
      "name": "How much is '.$weight.' of '.$translation[$page_language][$metal].' worth?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "The current value of '.$weight.' '.$translation[$page_language][$metal].' is €'.number_format($price, 2, '.', ' ') .'. The price is called spot price and is set on a global market. It changes every second. On top of the pure metal value there is a premium that is based on product popularity, scarcity and the trader selling the item."
      }
    }';
}

?>
<script type="application/ld+json">
    {
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    <?php echo implode(",", $json_answers_array);?>
  ]
}
</script>


	<div class="container-fluid page_head">
		<div class="container">
			<div class="row">
				<div class="col-md-12 pl-0">
					<h1 style="	padding-bottom:1em"><?php echo $translation[$page_language][$metal] ?> price today</h1>
					<p class="intro">
						The <?php echo $translation[$page_language][$metal] ?> price is set as a global market price - a "Spot pice". That is why the price of <?php echo $translation[$page_language][$metal] ?> coins and other bullion products shift fast. Monitor the prices of precious metal to find the cheapest investements in gold and silver. 
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid page_body">
		<div class="container">


<?php if($metal == 'AU') { ?>					
			<div class="row">
				<div class="col-12 col-md-4 px-0 pr-md-3">
					<div style="height:80px;">
						<h2><?php echo $translation[$page_language][$metal] ?> price in gram</h2>
						<p><?php echo "&#x1F551;&nbsp; " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ." " . date("Y-m-d") ?></p>
					</div>
					<table class="table table-striped thead-dark table-bordered">
						<tr>
							<th scope="col"><b>Gram</b></th>
							<th scope="col"><b>Euro</b></th>
							<th scope="col"><b>USD</b></th>
						</tr>
						<tr style="background-color:#FFE1BD;">
							<td><strong>1 kilo <?php echo $translation[$page_language][$metal] ?><strong></td>
							<td><strong> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*1000, 2, '.', ' '); ?> <strong></td>
							<td><strong> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*1000, 2, '.', ' '); ?> <strong></td>
						</tr>
						<tr>
							<td>1 gram <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram'], 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>2 gram <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 gram <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 gram <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 gram <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 gram <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 gram <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>250 gram <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*250, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*250, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 gram <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*500, 2, '.', ' '); ?> </td>
						</tr>
					</table>
					

				</div>
				<div class="col-12 col-md-4 px-0 pl-md-3">
					<div style="height:80px;">
						<h2><?php echo $translation[$page_language][$metal] ?> price in troy ounce</h2>
						<p><?php echo "&#x1F551;&nbsp; " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ." " . date("Y-m-d") ?></p>
					</div>					
					<table class="table table-striped thead-light table-bordered">
						<tr>
							<th><b>Troy ounce</b></th>
							<th><b>Euro</b></th>
							<th><b>USD</b></th>
						</tr>
						<tr style="background-color: #FFE1BD;">
							<td><strong>1 troy oz <?php echo $translation[$page_language][$metal] ?></strong></td>
							<td><strong> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz'], 2, '.', ' '); ?> </strong></td>
							<td><strong> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz'], 2, '.', ' '); ?> </strong></td>
						</tr>
						<tr>
							<td>1/20 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/20, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/20, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/10 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/8 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/8, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/8, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/4 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/4, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/4, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/2 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*100, 2, '.', ' '); ?> </td>
						</tr>
					</table>


				</div>
				<div class="col-12 col-md-4 px-0 pl-md-3">
					<div style="height:80px;">
						<h2><?php echo $translation[$page_language][$metal] ?> price history - Euro per troy ounce</h2>
					</div>						

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
					  "height": "450",
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
<?php } ?>

<?php if($metal == 'SI') { ?>	
			<div class="row">
				<div class="col-12 col-md-4 px-0 pr-md-3">
					<div style="height:80px;">
						<h2><?php echo $translation[$page_language][$metal] ?> price in gram</h2>
						<p><?php echo "&#x1F551;&nbsp; " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ." " . date("Y-m-d") ?></p>
					</div>
					<table class="table table-striped thead-dark table-bordered">
						<tr>
							<th scope="col"><b>Gram</b></th>
							<th scope="col"><b>Euro</b></th>
							<th scope="col"><b>USD</b></th>
						</tr>
						<tr style="background-color: #FFE1BD;">
							<td>1 kilo <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
						</tr>						
						<tr>
							<td>5 gram <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 gram <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 gram <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 gram <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 gram <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>250 gram <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*250, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*250, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 gram <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*500, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 kilo <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 kilo <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
						</tr>
					</table>
					

				</div>
				<div class="col-12 col-md-4 px-0 pl-md-3">
					<div style="height:80px;">
						<h2><?php echo $translation[$page_language][$metal] ?> price in troy ounce</h2>
						<p><?php echo "&#x1F551;&nbsp; " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ." " . date("Y-m-d") ?></p>
					</div>
					<table class="table table-striped thead-light table-bordered">
						<tr>
							<th><b>Troy ounce</b></th>
							<th><b>Euro</b></th>
							<th><b>USD</b></th>
						</tr>
						<tr style="background-color: #FFE1BD;">
							<td>1 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz'], 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/2 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>2 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>20 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*20, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*20, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 troy oz <?php echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*500, 2, '.', ' '); ?> </td>
						</tr>
					</table>
				</div>
				<div class="col-12 col-md-4 px-0 pl-md-3">
					<div style="height:80px;">
						<h2><?php echo $translation[$page_language][$metal] ?> price history - Euro per troy ounce</h2>
					</div>
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
					  "height": "450",
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
<?php } ?>


			<div class="row">
				<div class="col-12 d-none d-sm-block" style="text-align:center">
					<small>Ad</small><br>
						<a href="https://goldbroker.com/#2214-1321-1">
				        <img src="https://banners.goldbroker.com/affiliation/impression/1321/1/2214" width="728" alt="Why invest in physical gold and silver?" style="max-width:100%">
				    </a>
				    <hr/>
				</div>
				<div class="col-12 d-block d-sm-none" style="text-align:center">
					<small>Ad</small><br>
						<a href="https://goldbroker.com/#2214-303-1">
				        <img src="https://banners.goldbroker.com/affiliation/impression/303/1/2214" width="336" height="280" alt="A unique and safe way to invest in gold and silver">
				    </a>
				    <hr/>
				</div>
			</div>





			<div class="row">
				<div class="col-12 col-md-6 px-0 pr-md-3" style="height:500px"><h2>Guide: Basic investing tips for gold and silver</h2>
					<iframe width="100%" height="400" src="https://www.youtube.com/embed/7OQ7d599Sv4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
				<div class="col-12 col-md-6 px-0 pl-md-3" style="height:500px"><h2>Guide: Words and concepts for investors</h2>
					<iframe width="100%" height="400" src="https://www.youtube.com/embed/BwM4WxpzUao" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-6 px-0 pr-md-3" style="height:500px"><h2>Getting started with gold coins - The Coin Cabinet</h2>
					<iframe width="100%" height="400" src="https://www.youtube.com/embed/s2cZVRzARRw" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
				<div class="col-12 col-md-6 px-0 pl-md-3" style="height:500px"><h2>The story behind the 1 tonne gold coin record!</h2>
					<iframe width="100%" height="400" src="https://www.youtube.com/embed/R1KoF8Ik24Y" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>

			<div class="row">

		    <?php if(isset($ad_inventory['middle'])) {
				echo "<div class='col-12 col-md-12' style='padding:10px;'><div style='background-color:white'>";
				echo $ad_inventory['middle'];
				echo "</div></div>";
			}?>		

			</div>


			<div class="row">
				<div class="col-12 pl-0"><h2>Explore popular investements</h2></div>
			</div>
			<div class="row category_box">
				<div class="col-12 col-md-6 px-1 py-1">
					<div class="row">
						<div class="col-5">
							<a href="/products/goldcoins"><img src="https://tradeboost.eu/image/cat_gold_coin.jpg" alt="gold coins" style="max-width:100%" /></a>
						</div>
						<div class="col-7">
							<h3><a href="/products/goldcoins">Gold coins</a></h3>
							<ul class="shortcuts">
								<li><a href="/products/goldcoins?country=ZA">South Africa (Krugerrands)</a></li>
								<li><a href="/products/goldcoins?country=CA">Canada (Maple leafs)</a></li>
								<li><a href="/products/goldcoins?country=US">USA (Gold Eagles)</a></li>
								<li><a href="/products/goldcoins?country=CN">China (Gold pandas)</a></li>
								<li><a href="/products/goldcoins?country=GB">Great Britain (Sovereigns)</a></li>
								<li><a href="/products/goldcoins"><br><b>All gold coins</b></a></li>
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
							<h3><a href="/products/goldbars">Gold bars</a></h3>
							<ul class="shortcuts">
								<li><a href="/products/goldbars?manufacturer=CH_PAMP">PAMP gold bars</a></li>
								<li><a href="/products/goldbars?manufacturer=CH_UBS">UBS gold bars</a></li>
								<li><a href="/products/goldbars?manufacturer=AU">Perth mint gold bars</a></li>
								<li><a href="/products/goldbars?manufacturer=SE_BOL">Boliden gold bars</a></li>
								<li><a href="/products/goldbars?manufacturer=DE_HERA">Heraeus gold bars</a></li>
								<li><a href="/products/goldbars"><br><b>All gold bars</b></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-12 col-md-6 px-1 py-1">
					<div class="row">
						<div class="col-5">
							<a href="/products/silvercoins"><img src="https://tradeboost.eu/image/cat_silver_coin.jpg" alt="silver coins" style="max-width:100%" /></a>
						</div>
						<div class="col-7">
							<h3><a href="/products/silvercoins">Silver coins</a></h3>
							<ul class="shortcuts">
								<li><a href="/products/silvercoins?manufacturer=AT">Austria (Philharmonics)</a></li>
								<li><a href="/products/silvercoins?country=CA">Canada (Maple leafs)</a></li>
								<li><a href="/products/silvercoins?country=AU">Australia (Nuggets)</a></li>
								<li><a href="/products/silvercoins?country=US">USA (Silver eagles)</a></li>
								<li><a href="/products/silvercoins?country=GB">Great Britain (Britannias)</a></li>
								<li><a href="/products/silvercoins"><br><b>All silver coins</b></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 px-1 py-1">
					<div class="row">
						<div class="col-5">
							<a href="/products/silverbars"><img src="https://tradeboost.eu/image/cat_silver_bar.jpg" alt="silver bars" style="max-width:100%" /></a>
						</div>
						<div class="col-7">
							<h3><a href="/products/silverbars">Silver bars</a></h3>
							<ul class="shortcuts">
								<li><a href="/products/silverbars?manufacturer=DE_HERA">Heraeus silver bars</a></li>
								<li><a href="/products/silverbars?manufacturer=CH_VAL">Valcambi silver bars</a></li>
								<li><a href="/products/silverbars?manufacturer=SE_BOL">Boliden silver bars</a></li>
								<li><a href="/products/silverbars?manufacturer=AU">Perth mint silver bars</a></li>
								<li><a href="/products/silverbars?manufacturer=CH_UBS">UBS silver bars</a></li>
								<li><a href="/products/silverbars"><br><b>All silver bars</b></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 pl-0"><h2></h2></div>
			</div>
			</div>

		</div>
	</div>				
