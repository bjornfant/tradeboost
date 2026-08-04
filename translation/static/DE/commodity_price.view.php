<?php

$faq_array_weights_singular = array(
	"1 Unze" 		=> $comodity_price_array[$metal]['SEK']['price_per_oz'],
	"1/2 Unze" 		=> $comodity_price_array[$metal]['SEK']['price_per_oz']/2,
	"1/4 Unze" 		=> $comodity_price_array[$metal]['SEK']['price_per_oz']/4,
	"1/10 Unze" 	=> $comodity_price_array[$metal]['SEK']['price_per_oz']/10,
	"1/20 Unze" 	=> $comodity_price_array[$metal]['SEK']['price_per_oz']/20,
	"1/25 Unze" 	=> $comodity_price_array[$metal]['SEK']['price_per_oz']/25,
	"1 Kilo" 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']*1000,
	"1 Gramm" 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']
);

$faq_array_weights_plural = array(
	"2 Unzen" 		=> $comodity_price_array[$metal]['SEK']['price_per_oz']*2,
	"5 Unzen" 		=> $comodity_price_array[$metal]['SEK']['price_per_oz']*5,
	"10 Unzen" 		=> $comodity_price_array[$metal]['SEK']['price_per_oz']*10,
	"100 Unzen" 	=> $comodity_price_array[$metal]['SEK']['price_per_oz']*100,
	"10 Kilo" 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']*10000,
	"5 Kilo"	 	=> $comodity_price_array[$metal]['SEK']['price_per_gram']*5000,
	"500 Gramm" 	=> $comodity_price_array[$metal]['SEK']['price_per_gram']*500,
	"250 Gramm" 	=> $comodity_price_array[$metal]['SEK']['price_per_gram']*250,
	"100 Gramm" 	=> $comodity_price_array[$metal]['SEK']['price_per_gram']*100,
	"50 Gramm" 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']*50,
	"20 Gramm" 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']*20,
	"10 Gramm" 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']*10,
	"5 Gramm" 		=> $comodity_price_array[$metal]['SEK']['price_per_gram']*5,
);


$json_answers_array = array();
foreach ($faq_array_weights_singular as $weight => $price) {
	$json_answers_array[] = '{
      "@type": "Question",
      "name": "Was kostet '.$weight.' '.$translation[$page_language][$metal].'?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Beim heutigen '.ucfirst($translation[$page_language][$metal]).'preis ist '.$weight.' '.$translation[$page_language][$metal].' ' . number_format($price, 2, '.', ' ') .' ' . $page_currency .' wert."
      }
    }';
}
foreach ($faq_array_weights_plural as $weight => $price) {
	$json_answers_array[] = '{
      "@type": "Question",
      "name": "Was kosten '.$weight.' '.$translation[$page_language][$metal].'?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Beim heutigen '.ucfirst($translation[$page_language][$metal]).'preis sind '.$weight.' '.$translation[$page_language][$metal].' ' . number_format($price, 2, '.', ' ') .' ' . $page_currency .' wert."
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
					<h1 style="	padding-bottom:1em">Aktueller <?echo $translation[$page_language][$metal.'price'] ?></h1>
					<p class="intro">
						<?php echo $translation[$page_language][$metal] ?>preis (<?php echo date("y-m-d") . " " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ?>) in Euro und US-Dollar, pro Unzen und Grammen. <br>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid page_body">
		<div class="container">


			<div class="row">
<?php if($metal == 'AU') { ?>					
				<div class="col-12 col-md-6 px-0 pr-md-3">
					<h2>Goldrechner <?echo $translation[$page_language][$metal.'price'] ?>/Gramm</h2>
					<p><?php echo "&#x1F551;&nbsp; " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ." " . date("Y-m-d")  ?></p>
					<table class="table table-striped thead-dark table-bordered">
						<tr>
							<th scope="col"><b>Grammen</b></th>
							<th scope="col"><b>Euro</b></th>
							<th scope="col"><b>USD</b></th>
						</tr>
						<tr>
							<td>1 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram'], 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>2 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>250 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*250, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*250, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*500, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1 kilo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
						</tr>
					</table>
					

				</div>
				<div class="col-12 col-md-6 px-0 pl-md-3">
					<h2>Goldrechner <?echo $translation[$page_language][$metal.'price'] ?>/Unze</h2>
					<p><?php echo "&#x1F551;&nbsp; " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ." " . date("Y-m-d") ?></p>
					<table class="table table-striped thead-light table-bordered">
						<tr>
							<th><b>Troy Unzen</b></th>
							<th><b>Euro</b></th>
							<th><b>USD</b></th>
						</tr>
						<tr>
							<td>1/20 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/20, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/20, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/10 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/8 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/8, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/8, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/4 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/4, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/4, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/2 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz'], 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*100, 2, '.', ' '); ?> </td>
						</tr>
					</table>


				</div>

<?php } ?>

<?php if($metal == 'SI') { ?>	
				<div class="col-12 col-md-6 px-0 pr-md-3">
					<h2>Silberrechner <?echo $translation[$page_language][$metal.'price'] ?>/Gramm</h2>
					<p><?php echo "&#x1F551;&nbsp; " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ." " . date("Y-m-d") ?></p>
					<table class="table table-striped thead-dark table-bordered">
						<tr>
							<th scope="col"><b>Grammen</b></th>
							<th scope="col"><b>Euro</b></th>
							<th scope="col"><b>USD</b></th>
						</tr>
						<tr>
							<td>5 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>250 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*250, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*250, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 gram <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*500, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1 kilo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*1000, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 kilo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 kilo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*5000, 2, '.', ' '); ?> </td>
						</tr>
					</table>
					

				</div>
				<div class="col-12 col-md-6 px-0 pl-md-3">
					<h2>Silberrechner <?echo $translation[$page_language][$metal.'price'] ?>/Unzen</h2>
					<p><?php echo "&#x1F551;&nbsp; " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ." " . date("Y-m-d") ?></p>
					<table class="table table-striped thead-light table-bordered">
						<tr>
							<th><b>Unzen</b></th>
							<th><b>Euro</b></th>
							<th><b>USD</b></th>
						</tr>
						<tr>
							<td>1/2 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz'], 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>2 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>20 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*20, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*20, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 troy oz <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*500, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*500, 2, '.', ' '); ?> </td>
						</tr>
					</table>
				</div>

<?php } ?>
			</div>

			<div class="row">
		    <?php if(isset($ad_inventory['middle'])) {
				echo "<div class='col-12 col-md-12' style='padding:10px;'><div style='background-color:white'>";
				echo $ad_inventory['middle'];
				echo "</div></div>";
			}?>	
<?php if($metal == 'AU') { ?>				

				<div class="col-12 col-md-6 px-0 pr-md-3" >
					<h2><?php echo $translation[$page_language][$metal] ?> Spotpreis Euro pro Unzen und Grammen</h2>
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

				<div class="col-12 col-md-6 px-0 pl-md-3" >
					<h2><?php echo $translation[$page_language][$metal] ?> Spotpreis USD pro Unzen und Grammen</h2>

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
					          "s": "FX_IDC:XAUUSD",
					          "d": "Gold USD/Oz"
					        },
					        {
					          "s": "FX_IDC:XAUUSDG",
					          "d": "Gold USD/Gram"
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

<?php } ?>

<?php if($metal == 'SI') { ?>				
				<div class="col-12 col-md-6 px-0 pr-md-3">
					<h2><?php echo $translation[$page_language][$metal] ?> Spotpreis Euro pro Unzen und Grammen</h2>
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

					<div class="col-12 col-md-6 px-0 pl-md-3">
					<h2><?php echo $translation[$page_language][$metal] ?> Spotpreis USD pro Unzen und Grammen</h2>

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
					          "s": "FX_IDC:XAGUSD",
					          "d": "Silver USD/Oz"
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

<?php } ?>




			</div>




			<div class="row">
				<div class="col-12 col-md-6 px-0 pr-md-3" style="height:450px"><h2>Neueste Nachrichten von Kitco</h2><a class="twitter-timeline" data-lang="en" data-height="400" href="https://twitter.com/KitcoNewsNOW?ref_src=twsrc%5Etfw">Tweets by KitcoNewsNOW</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></div>
				<div class="col-12 col-md-6 px-0 pl-md-3" style="height:450px"><h2>Anleitungen von "Inside the Vault"</h2>
					<iframe width="100%" height="400" src="https://www.youtube.com/embed/BwM4WxpzUao" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>
			<div class="row">
				<div class="col-12 pl-0"><h2>Entdecken Sie beliebte Investitionen</h2></div>
			</div>
			<div class="row category_box">
				<div class="col-12 col-md-6 px-1 py-1">
					<div class="row">
						<div class="col-5">
							<a href="/products/goldcoins"><img src="https://tradeboost.eu/image/cat_gold_coin.jpg" alt="gold coins" style="max-width:100%" /></a>
						</div>
						<div class="col-7">
							<h3><a href="/products/goldcoins">Goldmünzen</a></h3>
							<ul class="shortcuts">
								<li><a href="/products/goldcoins?country=ZA">Südfrika (Krugerrand)</a></li>
								<li><a href="/products/goldcoins?country=CA">Kanada (Maple leaf)</a></li>
								<li><a href="/products/goldcoins?country=US">USA (Gold Eagle)</a></li>
								<li><a href="/products/goldcoins?country=CN">China (Gold panda)</a></li>
								<li><a href="/products/goldcoins?country=GB">Großbritannien (Sovereign)</a></li>
								<li><a href="/products/goldcoins"><br><b>Alle Goldmünzen</b></a></li>
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
							<h3><a href="/products/goldbars">Goldbarren</a></h3>
							<ul class="shortcuts">
								<li><a href="/manufacturer/CH_PAMP">PAMP Goldbarren</a></li>
								<li><a href="/manufacturer/CH_UBS">UBS Goldbarrens</a></li>
								<li><a href="/manufacturer/DE_HERA">Heraeus Goldbarren</a></li>
								<li><a href="/group/1_g_gold">1 gramm Goldbarren</a></li>
								<li><a href="/group/5_g_gold">5 gramen Goldbarren</a></li>
								<li><a href="/group/50_g_gold">50 gramen Goldbarren</a></li>
								<li><a href="/group/100_g_gold">100 gramen Goldbarren</a></li>								
								<li><a href="/products/goldbars"><br><b>Alle Goldbarren</b></a></li>
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
							<h3><a href="/products/silvercoins">Silbermünzen</a></h3>
							<ul class="shortcuts">
								<li><a href="/products/silvercoins?manufacturer=AT">Österreich (Philharmoniker)</a></li>
								<li><a href="/products/silvercoins?country=CA">Kanada (Maple leaf)</a></li>
								<li><a href="/products/silvercoins?country=AU">Australien (Kangaroo/Nugget)</a></li>
								<li><a href="/products/silvercoins?country=US">USA (Silver eagle)</a></li>
								<li><a href="/products/silvercoins?country=GB">Großbritannien (Britannia)</a></li>
								<li><a href="/products/silvercoins"><br><b>Alle Silbermünzen</b></a></li>
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
							<h3><a href="/products/silverbars">Silberbarren</a></h3>
							<ul class="shortcuts">
								<li><a href="/products/silverbars?manufacturer=DE_HERA">Heraeus Silberbarren</a></li>
								<li><a href="/products/silverbars?manufacturer=CH_VAL">Valcambi Silberbarren</a></li>
								<li><a href="/manufacturer/de_umicore">Umicore Silberbarren</a></li>
								<li><a href="/products/silverbars?manufacturer=AU">Perth mint Silberbarren</a></li>
								<li><a href="/products/silverbars?manufacturer=CH_UBS">UBS Silberbarren</a></li>
								<li><a href="/products/silverbars"><br><b>Alle Silberbarren</b></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 pl-0"><h2>Aktuella priser i mobilen</h2>
				Aktueller Goldpreis <a href="https://goldenpreis.de/">Goldenpreis.de</a><br>
				Aktueller Silberpreis <a href="https://silberpreis-aktuell.de/">silberpreis-aktuell.de</a><br><br><br><br>
				</div>
			</div>

			</div>

		</div>
	</div>				
