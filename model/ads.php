<?php

function gererate_adsense_html($website, $position) {

$adsense_slot_array = array(
	'https://tradeboost.se/' => array(
		'left' 	 => 1829952842,
		'middle' => 4072972808,
		'right'  => 1829952842),
	'https://tradeboost.eu/' => array(
		'left' 	 => 1197767141,
		'middle' => 5610643114,
		'right'  => 1197767141),
	'https://tradeboost.at/' => array(
		'left' 	 => 1197767141,
		'middle' => 5610643114,
		'right'  => 1197767141),
	'https://tradeboost.ch/' => array(
		'left' 	 => 1197767141,
		'middle' => 5610643114,
		'right'  => 1197767141),
	'https://tradeboost.fr/' => array(
		'left' 	 => 1197767141,
		'middle' => 5610643114,
		'right'  => 1197767141),
	'https://tradeboost.nl/' => array(
		'left' 	 => 1197767141,
		'middle' => 5610643114,
		'right'  => 1197767141),
	'https://tradeboost.be/' => array(
		'left' 	 => 1197767141,
		'middle' => 5610643114,
		'right'  => 1197767141)
);

if(!isset($adsense_slot_array[$website])) {
	$website = "https://tradeboost.se/";
	$position = "left";
}

return '<small>Ad</small><br>
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<ins class="adsbygoogle"
		     style="display:block"
		     data-ad-client="ca-pub-1161048397659913"
		     data-ad-slot="'.$adsense_slot_array[$website][$position].'"
		     data-ad-format="auto"
		     data-full-width-responsive="true"></ins>
		<script>
		     (adsbygoogle = window.adsbygoogle || []).push({});
		</script>';	

}

function gererate_html_ad($website, $position) {

	$ads = array();

	if($website == "https://tradeboost.se/") {
		// Sweden coin capsules
		$ad[0] = '<small>Ad</small><br>
				<div class="col-12 px-0">
					<a target="_blank" href="https://www.amazon.se/gp/search?ie=UTF8&tag=tradeboostse-21&linkCode=ur2&linkId=20fbb08de98a7f45a2c5f6766f51f652&camp=247&creative=1211&index=toys&keywords=Leuchtturm myntkapslar">

					<div class="category_item" style="padding:10px">
						<div class="row">
							<div class="col-6 col-md-4"><img src="https://tradeboost.eu/image/ads/coin_capsules_250x250.jpg" style="max-width:100%;border:1px solid #333" /></div>
							<div class="col-6 col-md-8"><h2>Leuchtturm myntkapslar till bästa pris</h2>Låga priser och stort utbud för alla myntägares behov hos Amazon Sverige.<br><br><input type="button" class="btn btn-primary" value=" VISA PRODUKTER "/></div>
						</div>
					</div></a>
				</div>';

		// Sweden safe
		$ad[1] = '<small>Ad</small><br>
			<div class="col-12 px-0">
				<a target="_blank" href="https://www.amazon.se/gp/search?ie=UTF8&tag=tradeboostse-21&linkCode=ur2&linkId=cb21ed5f6c70a31a2530550a4d352ceb&camp=247&creative=1211&index=aps&keywords=kassaskåp">

				<div class="category_item" style="padding:10px">
					<div class="row">
						<div class="col-6 col-md-4"><img src="https://tradeboost.eu/image/ads/kassaskap_250x250.jpg" style="max-width:100%;border:1px solid #333" /></div>
						<div class="col-6 col-md-8"><h2>Håll dina investeringar inlåsta</h2>Stort utbud av kassaskåp för hemmet hos Amazon Sverige.<br><br><input type="button" class="btn btn-primary" value=" VISA PRODUKTER "/></div>
					</div>
				</div></a>
			</div>';

		return $ad[rand(0,1)];

	}


	if($website == "https://trade-boost.co.uk/") {
		// UK coin capsules
		$ad[0] = '<small>Ad</small><br>
				<div class="col-12 px-0">
					<a target="_blank" href="ref="https://www.ebay.co.uk/sch/i.html?_from=R40&_trksid=p2334524.m570.l1313&_nkw=coin+capsule+&_sacat=0&LH_TitleDesc=0&_odkw=coin+capslue&_osacat=0&mkcid=1&mkrid=710-53481-19255-0&siteid=3&campid=5338736546&customid=kapsel&toolid=10001&mkevt=1">

					<div class="category_item" style="padding:10px">
						<div class="row">
							<div class="col-6 col-md-4"><img src="https://tradeboost.eu/image/ads/coin_capsules_250x250.jpg" style="max-width:100%;border:1px solid #333" /></div>
							<div class="col-6 col-md-8"><h2>Great deals on coin capsules</h2>Low prices and lots of different models and designs at Ebay.co.uk.<br><br><input type="button" class="btn btn-primary" value=" SHOW ME SOME PRODUCTS "/></div>
						</div>
					</div></a>
				</div>';

		// UK safe
		$ad[1] = '<small>Ad</small><br>
			<div class="col-12 px-0">
				<a target="_blank" href="https://www.ebay.co.uk/sch/i.html?_from=R40&_trksid=p4432023.m570.l1313&_nkw=digital+safe&_sacat=0&mkcid=1&mkrid=710-53481-19255-0&siteid=3&campid=5338736546&customid=kapsel&toolid=10001&mkevt=1">

				<div class="category_item" style="padding:10px">
					<div class="row">
						<div class="col-6 col-md-4"><img src="https://tradeboost.eu/image/ads/kassaskap_250x250.jpg" style="max-width:100%;border:1px solid #333" /></div>
						<div class="col-6 col-md-8"><h2>Keep your investments safe!</h2>Get a digital safe for your home. Find different models and sizes at Ebay.co.uk<br><br><input type="button" class="btn btn-primary" value=" SHOW ME THE PRODUCTS "/></div>
					</div>
				</div></a>
			</div>';


		$ad[2] = '<small>Ad</small><br>
				<a href="https://goldbroker.com/#2214-301-1">
        <img src="https://banners.goldbroker.com/affiliation/impression/301/1/2214" width="300" height="250" alt="A unique and safe way to invest in gold and silver">
    	</a>';


		return $ad[rand(0,2)];

	} else {

		$ad[0] = '<small>Ad</small><br>
				<a href="https://goldbroker.com/#2214-301-1">
        <img src="https://banners.goldbroker.com/affiliation/impression/301/1/2214" width="300" height="250" alt="A unique and safe way to invest in gold and silver">
    </a>';

    return $ad[0];

	}








	return false;
}

function gererate_amazon_capsule_link($website, $diameter) {

	$capsule_sizes_mm = array(14,15,16,16.5,17,18,19.5,19,20,21.5,21,22.05,22,23,24.5,24,25,26,27,28,29,30,31,32,32.6,33,34,35,36,37,38,38.61,38.73,39,40,40.6,41,42,43,44,45,46,50);

	if((int) $diameter > 50) { return false; }

	$selected_capsule = getClosest((float)$diameter+0.05, $capsule_sizes_mm);
	
	$capsule_link = "";


	if($website == "https://tradeboost.se/") {
		// Sweden coin capsules
		$capsule_link = ' <a target="_blank" href="https://www.amazon.se/gp/search?ie=UTF8&tag=tradeboostse-21&linkCode=ur2&linkId=20fbb08de98a7f45a2c5f6766f51f652&camp=247&creative=1211&index=toys&keywords=Leuchtturm '.$selected_capsule.' mm"> - Köp myntkapsel [sponsrad länk]</a>';
	
	}
	if($website == "https://tradeboost.eu/") {
		// German coin capsules
		$capsule_link = ' <a target="_blank" href="https://www.ebay.de/sch/i.html?_from=R40&_trksid=p2499337.m570.l1313&_nkw=Münzkapsel+'.$selected_capsule.'mm&_sacat=0&mkcid=1&mkrid=707-53477-19255-0&siteid=77&campid=5338736546&customid=kapsel&toolid=10001&mkevt=1"> - Buy coin capsule [sponsored link]</a>';
	
	}
	if($website == "https://trade-boost.de/") {
		// German coin capsules
		$capsule_link = ' <a target="_blank" href="https://www.ebay.de/sch/i.html?_from=R40&_trksid=p2499337.m570.l1313&_nkw=Münzkapsel+'.$selected_capsule.'mm&_sacat=0&mkcid=1&mkrid=707-53477-19255-0&siteid=77&campid=5338736546&customid=kapsel&toolid=10001&mkevt=1"> - Münzkapsel kaufen [Anzeige]</a>';
	
	}
	if($website == "https://tradeboost.ch/") {
		// Swiss coin capsules
		$capsule_link = ' <a target="_blank" href="https://www.ebay.ch/sch/i.html?_from=R40&_trksid=p2499337.m570.l1313&_nkw=Münzkapsel+'.$selected_capsule.'mm&_sacat=0&mkcid=1&mkrid=707-53477-19255-0&siteid=77&campid=5338736546&customid=kapsel&toolid=10001&mkevt=1"> - Münzkapsel kaufen [Anzeige]</a>';
	}
	if($website == "https://tradeboost.at/") {
		// Austrian coin capsules
		$capsule_link = ' <a target="_blank" href="https://www.ebay.at/sch/i.html?_from=R40&_trksid=p2499337.m570.l1313&_nkw=Münzkapsel+'.$selected_capsule.'mm&_sacat=0&mkcid=1&mkrid=707-53477-19255-0&siteid=77&campid=5338736546&customid=kapsel&toolid=10001&mkevt=1"> - Münzkapsel kaufen [Anzeige]</a>';
	
	}
	if($website == "https://trade-boost.co.uk/") {
		// Sweden coin capsules
		$capsule_link = ' <a target="_blank" href="https://www.ebay.co.uk/sch/i.html?_from=R40&_trksid=p2334524.m570.l1313&_nkw=coin+capsule+'.$selected_capsule.'mm&_sacat=0&LH_TitleDesc=0&_odkw=coin+capslue&_osacat=0&mkcid=1&mkrid=710-53481-19255-0&siteid=3&campid=5338736546&customid=kapsel&toolid=10001&mkevt=1"> - Buy coin capsule [sponsored link]</a>';
	
	}
	if($website == "https://tradeboost.nl/") {
		// Dutch coin capsules
		$capsule_link = ' <a target="_blank" href="https://www.ebay.nl/sch/i.html?_from=R40&_trksid=p2380057.m570.l1313&_nkw=munt+capsule+'.$selected_capsule.'mm&_sacat=0&mkcid=1&mkrid=1346-53482-19255-0&siteid=146&campid=5338736546&customid=kapsel&toolid=10001&mkevt=1"> - Muntcapsule kopen [publicité]</a>';
	
	}
	if($website == "https://tradeboost.fr/") {
		// French coin capsules
		$capsule_link = ' <a target="_blank" href="https://www.ebay.fr/sch/i.html?_from=R40&_trksid=p4432023.m570.l1313&_nkw=capsule+monnaie+'.$selected_capsule.'mm&_sacat=0&mkcid=1&mkrid=709-53476-19255-0&siteid=71&campid=5338736546&customid=kapsel&toolid=10001&mkevt=1"> - Acheter une capsule de pièces [advertentie]</a>';
	
	}
	if($website == "https://tradeboost.es/") {
		// Spanish coin capsules
		$capsule_link = ' <a target="_blank" href="https://www.ebay.es/sch/i.html?_from=R40&_trksid=p4432023.m570.l1313&_nkw=Capsula+de+monedas+'.$selected_capsule.'mm&_sacat=0&mkcid=1&mkrid=1185-53479-19255-0&siteid=186&campid=5338736546&customid=kapsel&toolid=10001&mkevt=1"> - Comprar cápsula de monedas [publicidad]</a>';
	
	}



	

	return $capsule_link ;

}


function getClosest($search, $arr) {
   $closest = null;
   foreach ($arr as $item) {
      if ($closest === null || abs($search - $closest) > abs($item - $search)) {
         $closest = $item;
      }
   }
   return $closest;
}



