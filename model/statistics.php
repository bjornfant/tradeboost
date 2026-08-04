<?php
class Statistic {

	public function track_pageview($domain) {
	$db = new db;
		
	$url 			= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
	$user_agent 	= isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
	$user_browser	= $this->get_browser_name($user_agent);
	$user_os		= $this->get_os($user_agent);	
	$referrer		= "";
	$IP_adress 		= isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
	$track_pageview = true;

	if(!empty($_SERVER['HTTP_REFERER'])) {
		$referrer = $_SERVER['HTTP_REFERER'];
	}

	$not_allowed_referrer = $this->getReferrerBlacklist(); //sql injection and similar in referrer
	foreach ($not_allowed_referrer as $block_ref) {
		$referrer = str_replace($block_ref, "", $referrer);
	}

	if (strpos(strtolower($referrer), "anonymous") !== false) {
		//redirect hackers
		header("HTTP/1.1 301 Moved Permanently");  
		header("Location: ".HTTP."?bot=true");  
		header("Connection: close"); 	    
		$track_pageview = false;
	} 


	$not_allowed = $this->getUserAgentBlacklist();
	foreach ($not_allowed as $block) {
	  if (strpos(strtolower($user_agent), $block) !== false) {
	  	//redirect hackers
	  	header("HTTP/1.1 301 Moved Permanently");  
		header("Location: ".HTTP."?bot=true");  
		header("Connection: close"); 
		$track_pageview = false;

	    //sleep(600); // Make site load slow for bots and hackers
	  } 
	}

	$not_allowed_pages = $this->getPageBlacklist();
	foreach ($not_allowed_pages as $block_page) {
	  if (strpos(strtolower($url), $block_page) !== false) {
	    //sleep(1200); // Make site load slow for bots and hackers
	  	//redirect hackers
	  	header("HTTP/1.1 301 Moved Permanently");  
		header("Location: ".HTTP."?bot=true");  
		header("Connection: close"); 	    
		$track_pageview = false;

	  } 
	}

	$asset_list = $this->getAssetList(); //Don't track images, css etc as pageviews
	foreach ($asset_list as $asset) {
	  if (strpos(strtolower($url), $asset) !== false) {    
		$track_pageview = false;

	  } 
	}
	
	/*$allowed_bots = array("googlebot","bingbot","ahref");

	if (strpos(strtolower($user_agent), "bot") && !in_array(strtolower($user_agent), $allowed_bots)) {
	    sleep(60); // Make site load slow for bots and hackers
	}*/


	//log pageview
	if ($track_pageview) {
		$sql = 'INSERT INTO stats_pageview (timestamp, domain, url, user_agent, user_browser, user_os, referrer, IP_adress)
		VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?)';

		// Every value below except $domain comes from request headers, so it is
		// attacker controlled and must stay bound.
		// Tracking must never be able to take a page down, hence the catch.
		try {
			$db->query($sql, array($domain, $url, $user_agent, $user_browser, $user_os, $referrer, $IP_adress));
		} catch (\Exception $exception) {
			error_log('Pageview tracking failed: ' . $exception->getMessage());
		}
	}
}






	private function get_browser_name($user_agent) {
		$arr_browsers = ["Opera", "Edg", "Chrome", "Safari", "Firefox", "MSIE", "Trident"];
 
		$user_browser = '';
		foreach ($arr_browsers as $browser) {
		    if (strpos($user_agent, $browser) !== false) {
		        $user_browser = $browser;
		        break;
		    }   
		}
		  
		switch ($user_browser) {
		    case 'MSIE':
		        $user_browser = 'Internet Explorer';
		        break;
		  
		    case 'Trident':
		        $user_browser = 'Internet Explorer';
		        break;
		  
		    case 'Edg':
		        $user_browser = 'Microsoft Edge';
		        break;
		}
		  
		return $user_browser;
	}

	private function  get_os($user_agent) { 
     
	    $os_platform    =   "Unknown OS Platform";
	    $os_array       =   array(
	                            '/windows nt 12/i'     =>  'Windows 12',
	                            '/windows nt 11/i'     =>  'Windows 11',
	                            '/windows nt 10/i'     =>  'Windows 10',
	                            '/windows nt 6.3/i'     =>  'Windows 8.1',
	                            '/windows nt 6.2/i'     =>  'Windows 8',
	                            '/windows nt 6.1/i'     =>  'Windows 7',
	                            '/windows nt 6.0/i'     =>  'Windows Vista',
	                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
	                            '/windows nt 5.1/i'     =>  'Windows XP',
	                            '/windows xp/i'         =>  'Windows XP',
	                            '/windows nt 5.0/i'     =>  'Windows 2000',
	                            '/windows me/i'         =>  'Windows ME',
	                            '/win98/i'              =>  'Windows 98',
	                            '/win95/i'              =>  'Windows 95',
	                            '/win16/i'              =>  'Windows 3.11',
	                            '/macintosh|mac os x/i' =>  'Mac OS X',
	                            '/mac_powerpc/i'        =>  'Mac OS 9',
	                            '/linux/i'              =>  'Linux',
	                            '/ubuntu/i'             =>  'Ubuntu',
	                            '/iphone/i'             =>  'iPhone',
	                            '/ipod/i'               =>  'iPod',
	                            '/ipad/i'               =>  'iPad',
	                            '/android/i'            =>  'Android',
	                            '/blackberry/i'         =>  'BlackBerry',
	                            '/webos/i'              =>  'Mobile'
	                        );

	    foreach ($os_array as $regex => $value) { 

	        if (preg_match($regex, $user_agent)) {
	            $os_platform    =   $value;
	        }

	    }   

	    return $os_platform;

	}

	private function getUserAgentBlacklist() {
		return array("java", "wp_is_mobile", "mediapartners", "expanse","360Spider","acapbot","acoonbot","alexibot","asterias","attackbot","backdorbot","becomebot","binlar","blackwidow","blekkobot","blexbot","blowfish","bullseye","bunnys","butterfly","careerbot","casper","checkpriv","cheesebot","cherrypick","chinaclaw","choppy","clshttp","cmsworld","copernic","copyrightcheck","cosmos","crescent","cy_cho","datacha","demon","diavol","discobot","dittospyder","dotbot","dotnetdotcom","dumbot","emailcollector","emailsiphon","emailwolf","exabot","extract","eyenetie","feedfinder","flaming","flashget","flicky","foobot","g00g1e","getright","gigabot","go-ahead-got","gozilla","grabnet","grafula","harvest","heritrix","httrack","icarus6j","jetbot","jetcar","jikespider","kmccrew","leechftp","libweb","linkextractor","linkscan","linkwalker","loader","masscan","miner","majestic","mechanize","mj12bot","morfeus","moveoverbot","netmechanic","netspider","nicerspro","nikto","ninja","nutch","octopus","pagegrabber","planetwork","postrank","proximic","purebot","pycurl","python","queryn","queryseeker","radian6","radiation","realdownload","rogerbot","scooter","seekerspider","semalt","siclab","sindice","sistrix","sitebot","siteexplorer","sitesnagger","skygrid","smartdownload","snoopy","sosospider","spankbot","spbot","sqlmap","stackrambler","stripper","sucker","surftbot","sux0r","suzukacz","suzuran","takeout","teleport","telesoft","true_robots","turingos","turnit","vampire","vikspider","voideye","webleacher","webreaper","webstripper","webvac","webviewer","webwhacker","winhttp","wwwoffle","woxbot","xaldon","xxxyy","yamanalab","yioopbot","youda","zeus","zmeu","zune","zyborg");
	}

	private function getPageBlacklist() {
		return array("wp-", ".asp", "mailer", "login", "wordpress","application", "shell", "sh3ll", "sql","password", "documentation", "cpanel", "/app/","/webapp","sleep","select","insert","update","delete","drop","empty","export","import", ".zip", ".gz", ".tar", ".tgz",".rar","ashx","admin","backup","manifest","xmlrpc","vscode","phpmyadmin",".log","well-known","uedit","tongjis","ob_flush","/public","webupload");
	}

	private function getReferrerBlacklist() {
		return array("sleep","'","select","insert","update","delete","drop","empty","export","import","sysdate","now","binance");
	}

	private function getAssetList() {
		return array(".js",".css",".txt",".jpg",".gif",".png",".ico");
	}

}