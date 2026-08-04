	<div class="container-fluid page_head">
		<div class="container">
			<div class="row">
				<div class="col-md-12 pl-0">
					<h1 style="	padding-bottom:1em">Precio de <?php echo $translation[$page_language][$metal] ?></h1>
					<p class="intro">
					Siga los precios de los metales preciosos y encuentre las inversiones más baratas en oro y plata.
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
					<h2>Precio del <?echo $translation[$page_language][$metal] ?> en gramo</h2>
					<p><?php echo "&#x1F551;&nbsp; " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ." " . date("Y-m-d") ?></p>
					<table class="table table-striped thead-dark table-bordered">
						<tr>
							<th scope="col"><b>Gramo</b></th>
							<th scope="col"><b>Euro</b></th>
							<th scope="col"><b>USD</b></th>
						</tr>
						<tr>
							<td>1 Gramo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram'], 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>2 Gramo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 Gramo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 Gramo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 Gramo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 Gramo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 Gramo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>250 Gramo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*250, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*250, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 Gramo <?echo $translation[$page_language][$metal] ?></td>
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
					<h2>Precio del <?echo $translation[$page_language][$metal] ?> en onza</h2>
					<p><?php echo "&#x1F551;&nbsp; " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ." " . date("Y-m-d") ?></p>
					<table class="table table-striped thead-light table-bordered">
						<tr>
							<th><b>Onza</b></th>
							<th><b>Euro</b></th>
							<th><b>USD</b></th>
						</tr>
						<tr>
							<td>1/20 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/20, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/20, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/10 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/8 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/8, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/8, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/4 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/4, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/4, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1/2 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz'], 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*100, 2, '.', ' '); ?> </td>
						</tr>
					</table>


				</div>

<?php } ?>

<?php if($metal == 'SI') { ?>	
				<div class="col-12 col-md-6 px-0 pr-md-3">
					<h2>Precio del <?echo $translation[$page_language][$metal] ?> en gramo</h2>
					<p><?php echo "&#x1F551;&nbsp; " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ." " . date("Y-m-d") ?></p>
					<table class="table table-striped thead-dark table-bordered">
						<tr>
							<th scope="col"><b>Gramo</b></th>
							<th scope="col"><b>Euro</b></th>
							<th scope="col"><b>USD</b></th>
						</tr>
						<tr>
							<td>5 Gramo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 Gramo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 Gramo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 Gramo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 Gramo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>250 Gramo <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_gram']*250, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_gram']*250, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 Gramo <?echo $translation[$page_language][$metal] ?></td>
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
					<h2>Precio del <?echo $translation[$page_language][$metal] ?> en onza</h2>
					<p><?php echo "&#x1F551;&nbsp; " . substr($comodity_price_array[$metal]['EUR']['update_date'],11,5) ." " . date("Y-m-d") ?></p>
					<table class="table table-striped thead-light table-bordered">
						<tr>
							<th><b>Onza</b></th>
							<th><b>Euro</b></th>
							<th><b>USD</b></th>
						</tr>
						<tr>
							<td>1/2 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']/2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']/2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>1 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz'], 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz'], 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>2 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*2, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*2, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>5 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*5, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*5, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>10 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*10, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*10, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>20 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*20, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*20, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>25 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*25, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*25, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>50 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*50, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*50, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>100 troy Onza <?echo $translation[$page_language][$metal] ?></td>
							<td> <?php echo number_format($comodity_price_array[$metal]['EUR']['price_per_oz']*100, 2, '.', ' '); ?> </td>
							<td> <?php echo number_format($comodity_price_array[$metal]['USD']['price_per_oz']*100, 2, '.', ' '); ?> </td>
						</tr>
						<tr>
							<td>500 troy Onza <?echo $translation[$page_language][$metal] ?></td>
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
					<h2><?php echo $translation[$page_language][$metal] ?> precio spot Euro por Onza y Gramo</h2>
					<!-- TradingView Widget BEGIN -->
					<div class="tradingview-widget-container">
					  <div class="tradingview-widget-container__widget"></div>
					  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/futures/" rel="noopener" target="_blank"><span class="blue-text">Materias primas</span></a> TradingView</div>
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
					          "d": "Oro Euro/Gramoo"
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

				<div class="col-12 col-md-6 px-0 pl-md-3" >
					<h2><?php echo $translation[$page_language][$metal] ?> precio spot USD por Onza y Gramo</h2>

					<!-- TradingView Widget BEGIN -->
					<div class="tradingview-widget-container">
					  <div class="tradingview-widget-container__widget"></div>
					  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/futures/" rel="noopener" target="_blank"><span class="blue-text">Materias primas</span></a> TradingView</div>
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
					          "s": "FX_IDC:XAUUSD",
					          "d": "Oro USD/Onza"
					        },
					        {
					          "s": "FX_IDC:XAUUSDG",
					          "d": "Oro USD/Gramo"
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

<?php } ?>

<?php if($metal == 'SI') { ?>				
				<div class="col-12 col-md-6 px-0 pr-md-3">
					<h2><?php echo $translation[$page_language][$metal] ?> precio spot Euro por Onza y Gramo</h2>
					<!-- TradingView Widget BEGIN -->
					<div class="tradingview-widget-container">
					  <div class="tradingview-widget-container__widget"></div>
					  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/futures/" rel="noopener" target="_blank"><span class="blue-text">Materias primas</span></a> TradingView</div>
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
					          "d": "Silver Euro/Onza"
					        },
					        {
					          "s": "FX_IDC:XAGEURG",
					          "d": "Silver Euro/Gramo"
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
					<h2><?php echo $translation[$page_language][$metal] ?> precio spot USD por Onza y Gramo</h2>

					<!-- TradingView Widget BEGIN -->
					<div class="tradingview-widget-container">
					  <div class="tradingview-widget-container__widget"></div>
					  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/futures/" rel="noopener" target="_blank"><span class="blue-text">Materias primas</span></a> TradingView</div>
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
					          "s": "FX_IDC:XAGUSD",
					          "d": "Silver USD/Onza"
					        },
					        {
					          "s": "FX_IDC:XAGUSDG",
					          "d": "Silver USD/Gramo"
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

<?php } ?>




			</div>


			<div class="row">
				<div class="col-12 col-md-6 px-0 pr-md-3" style="height:450px"><h2>Últimas noticias de Kitco</h2><a class="twitter-timeline" data-lang="en" data-height="400" href="https://twitter.com/KitcoNewsNOW?ref_src=twsrc%5Etfw">Tweets de KitcoNewsNOW</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></div>
				<div class="col-12 col-md-6 px-0 pl-md-3" style="height:450px"><h2>Guías de "Inside the vault"</h2>
					<iframe width="100%" height="400" src="https://www.youtube.com/embed/BwM4WxpzUao" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>
			<div class="row">
				<div class="col-12 pl-0"><h2>Inversiones populares</h2></div>
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
				<div class="col-12 pl-0"><h2></h2></div>
			</div>
			</div>

		</div>
	</div>				
