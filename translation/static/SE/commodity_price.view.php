<?php

$faq_array_weights = array(
	"1 oz" 		=> $comodity_price_array[$metal]['SEK']['price_per_oz'],
	"1/2 oz" 		=> $comodity_price_array[$metal]['SEK']['price_per_oz']/2,
	"1/4 oz" 		=> $comodity_price_array[$metal]['SEK']['price_per_oz']/4,
	"1/10 oz" 		=> $comodity_price_array[$metal]['SEK']['price_per_oz']/10,
	"1/20 oz" 		=> $comodity_price_array[$metal]['SEK']['price_per_oz']/20,
	"1/25 oz" 		=> $comodity_price_array[$metal]['SEK']['price_per_oz']/25,
	"2 oz" 			=> $comodity_price_array[$metal]['SEK']['price_per_oz']*2,
	"5 oz" 			=> $comodity_price_array[$metal]['SEK']['price_per_oz']*5,
	"10 oz" 		=> $comodity_price_array[$metal]['SEK']['price_per_oz']*10,
	"100 oz" 		=> $comodity_price_array[$metal]['SEK']['price_per_oz']*100,
	"10 kg" 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']*10000,
	"5 kg"	 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']*5000,
	"1 kg" 			=> $comodity_price_array[$metal]['SEK']['price_per_gram']*1000,
	"500 gram" 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']*500,
	"250 gram" 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']*250,
	"100 gram" 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']*100,
	"50 gram" 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']*50,
	"20 gram" 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']*20,
	"10 gram" 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']*10,
	"5 gram" 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']*5,
	"1 gram" 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']
);


$json_answers_array = array();
foreach ($faq_array_weights as $weight => $price) {
	$json_answers_array[] = '{
      "@type": "Question",
      "name": "Vad kostar '.$weight.' '.$translation[$page_language][$metal].' idag?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Med dagens '.$translation[$page_language][$metal].'pris är värdet '.number_format($price, 2, '.', ' ') .' kr för '.$weight.' '.$translation[$page_language][$metal].'."
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
					<h1 style="	padding-bottom:1em"><?php echo $translation[$page_language][$metal] ?>pris idag - Uppdateras varje timme</h1>
					<p class="intro">
						Priset på guld och silver sätts av marknaden som ett världspris. Metallerna värderas därmed till samma pris över hela världen. Priserna nedan är det så kallade "Spotpriset" - det pris marknaden värderar metallen till just nu.
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
						<h2><?php echo $translation[$page_language][$metal] ?>pris i gram</h2>
						<p><?php echo "&#x1F551;&nbsp; " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ." " . date("Y-m-d") ?></p>
					</div>
					<table class="table table-striped thead-dark table-bordered">
						<tr>
							<th scope="col"><b>Gram</b></th>
							<th scope="col"><b>Euro</b></th>
							<th scope="col"><b>SEK</b></th>
						</tr>
						<tr>
							<td>1 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram'], 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>2 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>250 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*250, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*250, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*500, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1 kilo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
						</tr>
					</table>
					

				</div>
				<div class="col-12 col-md-4 px-0 pl-md-3">
					<div style="height:80px;">
						<h2><?php echo $translation[$page_language][$metal] ?>pris i troy ounce</h2>
						<p><?php echo "&#x1F551;&nbsp; " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ." " . date("Y-m-d") ?></p>
					</div>
					<table class="table table-striped thead-light table-bordered">
						<tr>
							<th><b>Troy ounce</b></th>
							<th><b>Euro</b></th>
							<th><b>SEK</b></th>
						</tr>
						<tr>
							<td>1/20 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/20, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']/20, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/10 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']/10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/8 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/8, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']/8, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/4 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/4, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']/4, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/2 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']/2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz'], 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']*100, 2, '.', ' '); ?> </td>
						</tr>
					</table>


				</div>
				<div class="col-12 col-md-4 px-0 pl-md-3">
					<div style="height:80px;">
						<h2><?php echo $translation[$page_language][$metal] ?>pris historiskt - SEK per troy ounce</h2>
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
					  "largeChartUrl": "",
					  "isTransparent": false,
					  "width": "100%",
					  "height": "450",
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
			</div>

<?php } ?>

<?php if($metal == 'SI') { ?>	
			<div class="row">
				<div class="col-12 col-md-4 px-0 pr-md-3">
					<div style="height:80px;">
						<h2><?echo $translation[$page_language][$metal] ?>pris i gram</h2>
						<p><?php echo "&#x1F551;&nbsp; " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ." " . date("Y-m-d") ?></p>
					</div>
					<table class="table table-striped thead-dark table-bordered">
						<tr>
							<th scope="col"><b>Gram</b></th>
							<th scope="col"><b>Euro</b></th>
							<th scope="col"><b>SEK</b></th>
						</tr>
						<tr>
							<td>5 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>250 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*250, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*250, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*500, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1 kilo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 kilo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 kilo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
						</tr>
					</table>
					

				</div>
				<div class="col-12 col-md-4 px-0 pl-md-3">
					<div style="height:80px;">
						<h2><?php echo $translation[$page_language][$metal] ?>pris i troy ounce</h2>
						<p><?php echo "&#x1F551;&nbsp; " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ." " . date("Y-m-d") ?></p>
					</div>
					<table class="table table-striped thead-light table-bordered">
						<tr>
							<th><b>Troy ounce</b></th>
							<th><b>Euro</b></th>
							<th><b>SEK</b></th>
						</tr>
						<tr>
							<td>1/2 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']/2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz'], 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>2 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']*2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>20 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*20, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']*20, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['SEK']['price_per_oz']*500, 2, '.', ' '); ?> </td>
						</tr>
					</table>
				</div>
				<div class="col-12 col-md-4 px-0 pl-md-3">
					<div style="height:80px;">
						<h2><?php echo $translation[$page_language][$metal] ?>pris historiskt - SEK per troy ounce</h2>
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
					  "largeChartUrl": "",
					  "isTransparent": false,
					  "width": "100%",
					  "height": "450",
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
					          "s": "OANDA:XAGUSD*OANDA:USDSEK",
					          "d": "Silver SEK/Oz"
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

<?php } ?>

			<div class="row">
				<div class="col-12 col-md-12 px-0"><h2>Pris när du köper och säljer</h2>
					<p>
						 När du köper <?php echo strtolower($translation[$page_language][$metal]) ?> betalar du ofta lite över spot, och om du ska sälja <?php echo strtolower($translation[$page_language][$metal]) ?> till en butik får du omkring spotpris + ev. samlarvärde. Skillnaden mellan köp-pris och sälj-pris kallas "spread" och skiljer sig mellan olika butiker, så jämför priser innan du köper! 
						<br><br>
						<strong>Hos oss kan du följa priset på ädelmetaller och hitta lägsta pris på din nästa investering. För varje mynt eller tacka anger vi priset är i förhållade till spot. Du ser direkt om en produkt har en bra deal! Du kan även filtrera våra produktlistor efter lägsta pris i förhållande tll spot för att hitta de produkter där du får mest <?php echo strtolower($translation[$page_language][$metal]) ?> för pengarna</strong>
					</p>
				</div>
			</div>



			<div class="row">
				<div class="col-12 col-md-6 px-0 pr-md-3" style="height:500px"><h2>Guide: Investera i guld eller silver</h2>
					<iframe width="100%" height="400" src="https://www.youtube.com/embed/7OQ7d599Sv4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
				<div class="col-12 col-md-6 px-0 pl-md-3" style="height:500px"><h2>Guide: Ord och begrepp för investerare</h2>
					<iframe width="100%" height="400" src="https://www.youtube.com/embed/BwM4WxpzUao" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-6 px-0 pr-md-3" style="height:500px"><h2>Kom igång med guldmynt - The Coin Cabinett</h2>
					<iframe width="100%" height="400" src="https://www.youtube.com/embed/s2cZVRzARRw" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
				<div class="col-12 col-md-6 px-0 pl-md-3" style="height:500px"><h2>Världens största guldmynt 1 ton av Perth mint</h2>
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
				<div class="col-12 pl-0"><h2>Populära investeringar</h2></div>
			</div>
			<div class="row category_box">
				<div class="col-12 col-md-6 px-1 py-1">
					<div class="row">
						<div class="col-5">
							<a href="/products/goldcoins"><img src="https://tradeboost.eu/image/cat_gold_coin.jpg" alt="gold coins" style="max-width:100%" /></a>
						</div>
						<div class="col-7">
							<h2><a href="/products/goldcoins">Guldmynt</a></h2>
							<ul class="shortcuts">
								<li><a href="/products/goldcoins?country=ZA">Sydafrika (Krugerrands)</a></li>
								<li><a href="/products/goldcoins?country=CA">Kanada (Maple leafs)</a></li>
								<li><a href="/products/goldcoins?country=US">USA (Gold Eagles)</a></li>
								<li><a href="/products/goldcoins?country=CN">Kina (Gold pandas)</a></li>
								<li><a href="/products/goldcoins?country=GB">Storbritannien (Sovereigns)</a></li>
								<li><a href="/products/goldcoins"><br><b>Alla guldmynt</b></a></li>
							</ul>
						</div>
					</div>
				</div>


				<div class="col-12 col-md-6 px-1 py-1">
					<div class="row">
						<div class="col-5">
							<a href="/products/goldbars"><img src="https://tradeboost.eu/image/cat_gold_bar.jpg" alt="gold bars" style="max-width:100%" /></a>
						</div>
						<div class="col-7">
							<h2><a href="/products/goldbars">Guldtackor</a></h2>
							<ul class="shortcuts">
								<li><a href="/products/goldbars?manufacturer=CH_PAMP">PAMP guldtackor</a></li>
								<li><a href="/products/goldbars?manufacturer=CH_UBS">UBS guldtackor</a></li>
								<li><a href="/products/goldbars?manufacturer=AU">Perth mint guldtackor</a></li>
								<li><a href="/products/goldbars?manufacturer=SE_BOL">Boliden guldtackor</a></li>
								<li><a href="/products/goldbars?manufacturer=DE_HERA">Heraeus guldtackor</a></li>
								<li><a href="/products/goldbars"><br><b>Alla guldtackor</b></a></li>
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
							<h2><a href="/products/silvercoins">Silvermynt</a></h2>
							<ul class="shortcuts">
								<li><a href="/products/silvercoins?manufacturer=AT">Österrike (Philharmoniker)</a></li>
								<li><a href="/products/silvercoins?country=CA">Kanada (Maple leafs)</a></li>
								<li><a href="/products/silvercoins?country=AU">Australien (Kangaroos)</a></li>
								<li><a href="/products/silvercoins?country=US">USA (Silver eagles)</a></li>
								<li><a href="/products/silvercoins?country=GB">Storbritannien (Britannias)</a></li>
								<li><a href="/products/silvercoins"><br><b>Alla silvermynt</b></a></li>
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
							<h2><a href="/products/silverbars">Silvertackor</a></h2>
							<ul class="shortcuts">
								<li><a href="/products/silverbars?manufacturer=DE_HERA">Heraeus silvertackor</a></li>
								<li><a href="/products/silverbars?manufacturer=CH_VAL">Valcambi silvertackor</a></li>
								<li><a href="/products/silverbars?manufacturer=SE_BOL">Boliden silvertackor</a></li>
								<li><a href="/products/silverbars?manufacturer=AU">Perth mint silvertackor</a></li>
								<li><a href="/products/silverbars?manufacturer=CH_UBS">UBS silvertackor</a></li>
								<li><a href="/products/silverbars"><br><b>Alla silvertackor</b></a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
			<div class="row">
				<div class="col-12 pl-0"><h2>Aktuella priser i mobilen</h2>
				Aktuellt guldpris hittar du även på <a href="https://prisguld.se/">Prisguld.se</a><br>
				Aktuellt silverpris hittar du även på <a href="https://prisguld.se/">Prissilver.se</a><br><br><br>
				</div>
			</div>
			</div>

		</div>
	</div>				
