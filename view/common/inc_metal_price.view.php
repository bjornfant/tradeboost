	<?php if(CURRENCY_DEFAULT == "SEK") {?>
	<!-- TradingView Widget BEGIN -->
	<div class="tradingview-widget-container d-none d-md-block d-lg-block sticky-footer">
	  <div class="tradingview-widget-container__widget"></div>
	  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-tickers.js" async>
	  {
	  "symbols": [
	    {
	      "description": "Guld SEK/g",
	      "proName": "FX_IDC:XAUUSDG*OANDA:USDSEK"
	    },
	    {
	      "description": "Silver SEK/g",
	      "proName": "FX_IDC:XAGUSDG*OANDA:USDSEK"
	    },
	    {
	      "description": "Guld SEK/oz",
	      "proName": "FX_IDC:XAUUSDG*OANDA:USDSEK*31.05"
	    },
	    {
	      "description": "Silver SEK/oz",
	      "proName": "FX_IDC:XAGUSDG*OANDA:USDSEK*31.05"
	    }
	  ],
	  "colorTheme": "dark",
	  "isTransparent": false,
	  "showSymbolLogo": true,
	  "locale": "en"
	}
	  </script>
	</div>
	<!-- TradingView Widget END -->	
	<?php } else { ?>
	<!-- TradingView Widget BEGIN -->
	<div class="tradingview-widget-container d-none d-md-block d-lg-block sticky-footer">
	  <div class="tradingview-widget-container__widget"></div>
	  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-tickers.js" async>
	  {
	  "symbols": [
	    {
	      "description": "Gold <?php echo CURRENCY_DEFAULT; ?>/g",
	      "proName": "FX_IDC:XAU<?php echo CURRENCY_DEFAULT; ?>/31.05"
	    },
	    {
	      "description": "Silver <?php echo CURRENCY_DEFAULT; ?>/g",
	      "proName": "FX_IDC:XAG<?php echo CURRENCY_DEFAULT; ?>/31.05"
	    },
	    {
	      "description": "Gold <?php echo CURRENCY_DEFAULT; ?>/oz",
	      "proName": "FX_IDC:XAU<?php echo CURRENCY_DEFAULT; ?>"
	    },
	    {
	      "description": "Silver <?php echo CURRENCY_DEFAULT; ?>/oz",
	      "proName": "FX_IDC:XAG<?php echo CURRENCY_DEFAULT; ?>"
	    }
	  ],
	  "colorTheme": "dark",
	  "isTransparent": false,
	  "showSymbolLogo": true,
	  "locale": "en"
	}
	  </script>
	</div>
	<!-- TradingView Widget END -->

	<?php } ?>
		<div class="container-fluid metalprice d-block">
			<div class="container px-0">
				<div class="row">
					<div class="col-12 col-md-4 px-1">WORLD SPOT PRICES</div>
					<div class="col-3 col-md-2 text-center px-1">
					<a href="/price_realtime/gold" style="color:#efbf04">
					<small><?php 
					echo ucfirst($translation[$page_language]['AU']) . " (" .  $translation[$page_language]['gram_single'] . ") </small><br><span  style='font-size: 1.2em'>" . $catalog->format_money($comodity_price_array['AU'][$page_currency]['price_per_gram'], $page_currency, 2) . "</span>" ?></small></a>
					</div>
					<div class="col-3 col-md-2 text-center px-1"><a href="/price_realtime/silver" style="color:#ffffff">
					<a href="/price_realtime/gold" style="color:#efbf04">
					<small><?php 
					echo ucfirst($translation[$page_language]['AU']) . " (" .  $translation[$page_language]['oz_single'] . ") </small><br><span  style='font-size: 1.2em'>" . $catalog->format_money($comodity_price_array['AU'][$page_currency]['price_per_oz'], $page_currency, 2) . "</span>" ?></small></a>
					</div>
					<div class="col-3 col-md-2 text-center px-1"><a href="/price_realtime/silver" style="color:#ffffff">
					<small><?php 
					echo ucfirst($translation[$page_language]['SI']) . " (" .  $translation[$page_language]['gram_single'] . ") </small><br><span style='font-size: 1.2em'>" . $catalog->format_money($comodity_price_array['SI'][$page_currency]['price_per_gram'], $page_currency, 2)  . "</span>"?></small></a>	
					</div>
					<div class="col-3 col-md-2 text-center px-1"><a href="/price_realtime/silver" style="color:#ffffff"><small><?php 
					echo ucfirst($translation[$page_language]['SI']) . " (" .  $translation[$page_language]['oz_single'] . ") </small><br><span  style='font-size: 1.2em'>" . $catalog->format_money($comodity_price_array['SI'][$page_currency]['price_per_oz'], $page_currency, 2)  . "</span>"?></small></a>
					</div>
				</div>
			</div>
		</div>
		<?php
		/*
		unused data in oz

			$catalog->format_money($comodity_price_array['AU'][$page_currency]['price_per_oz'], $page_currency, 2) 
			$translation[$page_language]['oz_single']
			
			$catalog->format_money($comodity_price_array['SI'][$page_currency]['price_per_oz'], $page_currency, 2) 
			$translation[$page_language]['oz_single'] 

		*/
		?>