<?
	$debug_msgs = 0;
	$save_visitor = 1;
	
	//****************************************************************************
	// Record where the visitor came from and what page they landed on
	//****************************************************************************

	$http_ref = $_SERVER['HTTP_REFERER'];
	if ($debug_msgs) echo "http_ref = " . $http_ref . "<br />";
	
	if ($_GET["ref"])
		$save_visitor++; 	// from an affiliate or cross-link site.
		
	if (strstr($http_ref, "restaurantinfo.com"))
		$from_self=1; 		// we have a referral URL, make sure its not from ourself.
	else
		$from_self = 0;
		
	if (!$http_ref) 
		$save_visitor++; // Don't know where they came from, but lets track this visitor anyway.
	
	if (!$from_self)
	{
		$query3 = "SELECT id FROM referrals WHERE sessionid='" . session_id() . "'";
		if ($debug_msgs) echo $query3 . "<br />";
		$result3 = mysql_query($query3) or die("Could not look up sessionid - " . mysql_error() . "<br><br>");
		if (mysql_num_rows($result3) == 0)
		{
			$query3 = "INSERT INTO referrals SET page_count=1, ref='" . $_GET["ref"] . "', from_url='" . $http_ref . "', landing_page ='" . $_SERVER['PHP_SELF'] . "', the_date=NOW(), the_time=NOW(), sessionid='" . session_id() . "'";
			if ($debug_msgs) echo $query3 . "<br />";
			$result3 = mysql_query($query3) or die("Could not look up new members - " . mysql_error() . "<br><br>");
		}
	}
	else
	{
		// Tally up the page count each time the load a new page
	
		$query3 = "UPDATE referrals SET page_count = page_count + 1 WHERE sessionid='" . session_id() . "'";
		if ($debug_msgs) echo $query3 . "<br />";
		$result3 = mysql_query($query3) or die("Could not update referrals - page count - " . mysql_error() . "<br><br>");
	}
	

	
	//****************************************************************************
	// Record what page they are viewing and the time/date
	//**************************************************************************** 
	//    My IP: 71.198.2.102
	// Janis IP: 107.136.162.189

	$today_date = date("Y-m-d");
	
	if (!strstr($_SERVER['PHP_SELF'], "/admin/") && !strstr($_SERVER['PHP_SELF'], "/oops.php") && $_SERVER['REMOTE_ADDR'] != "71.198.2.102" && $_SERVER['REMOTE_ADDR'] != "107.136.162.189")
	{
		$query3 = "SELECT id FROM pages_viewed 
							 WHERE 
							 	(ip_address='" . $_SERVER['REMOTE_ADDR'] . "' OR session_id='" . session_id() . "') AND 
								the_page='" . mysql_real_escape_string($_SERVER['PHP_SELF']) . "' AND 
								the_date='" . mysql_real_escape_string($today_date) . "'";
		if ($debug_msgs) echo $query3 . "<br />";
		$result3 = mysql_query($query3) or die("Could not look up pages_viewed - " . mysql_error() . "<br><br>");
		if (mysql_num_rows($result3) && 0)
		{
			$rs3 = mysql_fetch_object($result3);
			$pv_id = $rs3->id;
			@mysql_free_result($result3);
	
			if ($pv_id)
			{
				$query3 = "UPDATE pages_viewed SET page_count = page_count + 1 WHERE id=" . $pv_id;
				if ($debug_msgs) echo $query3 . "<br />";
				$result3 = mysql_query($query3) or die("Could not look up pages_viewed - " . mysql_error() . "<br><br>");
			}
		}
		else
		{
			$query3 = "SELECT id FROM pages_viewed WHERE ip_address='" . $_SERVER['REMOTE_ADDR'] . "' AND the_date=NOW()";
			if ($debug_msgs) echo $query3 . "<br />";
			$result3 = mysql_query($query3) or die("Could not look up pages_viewed - " . mysql_error() . "<br><br>");
			if (mysql_num_rows($result3))
				$initial_visit = 0;
			else
				$initial_visit = 1;

			$from_url = $http_ref;
			$from_url = str_replace("http://", "", $from_url);
			$from_url = str_replace("www.", "", $from_url);
			$from_url = str_replace("&hl=en", "", $from_url);


			$user_agent = $_SERVER['HTTP_USER_AGENT'];		//  	
			$is_spider = 0;
			if (strstr($user_agent, "Googlebot") || 		// Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html) 
				strstr($user_agent, "Google-Site-Verification") || 	// Mozilla/5.0 (compatible; Google-Site-Verification/1.0)	

				strstr($user_agent, "msnbot") || 
				strstr($user_agent, "bingbot") || 			// Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)
				strstr($user_agent, "Yahoo! Slurp") || 
				strstr($user_agent, "ysearch/slurp") || 	// Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)

				strstr($user_agent, "Stratagems Kumo") || 
				
				strstr($user_agent, "crawler.007ac9.net") || 	// Mozilla/5.0 (compatible; 007ac9 Crawler; http://crawler.007ac9.net/)
				strstr($user_agent, "DomainCrawler") || 	// DomainCrawler/1.0
				strstr($user_agent, "GetintentCrawler") || 
				strstr($user_agent, "AdnormCrawler") || 	// AdnormCrawler www.adnorm.com/crawler
				strstr($user_agent, ".net/crawler") || 		// Mozilla/5.0 (compatible; oBot/2.3.1; http://filterdb.iss.net/crawler/)
				strstr($user_agent, "GrapeshotCrawler") || 	// Mozilla/5.0 (compatible; GrapeshotCrawler/2.0; +http://www.grapeshot.co.uk/crawler.php)
				strstr($user_agent, "CRAZYWEBCRAWLER") || 	// CRAZYWEBCRAWLER 0.9.10, http://www.crazywebcrawler.com

				strstr($user_agent, "uptime.com") || 		// Mozilla/5.0 (compatible; Uptimebot/1.0; +http://www.uptime.com/uptimebot)
				strstr($user_agent, "exabot.com") || 		// Mozilla/5.0 (compatible; Exabot/3.0; +http://www.exabot.com/go/robot)
				strstr($user_agent, "wotbox.com") || 		// Wotbox/2.01 (+http://www.wotbox.com/bot/)
				strstr($user_agent, "YisouSpider") || 
				strstr($user_agent, "ia_archiver") || 
				strstr($user_agent, "megaindex.com") || 	// Mozilla/5.0 (compatible; MegaIndex.ru/2.0; +http://megaindex.com/crawler)
				strstr($user_agent, "riddler.io") || 		// Riddler (http://riddler.io/about) - Irakleion, IR, Greece
				strstr($user_agent, "python-requests") || 	// python-requests/2.5.3 CPython/2.7.6 Linux/3.16.0-43-generic
				strstr($user_agent, "zgrab") || 			// Application layer scanner that operates with ZMap
				strstr($user_agent, "Netcraft") || 			// Mozilla/4.0 (compatible; Netcraft Web Server Survey)	
				strstr($user_agent, "HaosouSpider") || 		// Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0); 360Spider(compatible; HaosouSpider; http://www.haosou.com/help/help_3_2.html) - Beijing, BJ, China
				strstr($user_agent, "Qwantify") || 			// Mozilla/5.0 (compatible; Qwantify/2.1w; +https://www.qwant.com/) - Belgrade, SR, Yugoslavia
				strstr($user_agent, "SemrushBot") || 		// illa/5.0 (compatible; SemrushBot/1~bl; +http://www.semrush.com/bot.html)
				strstr($user_agent, "botje.com") || 		// Mozilla/5.0 (compatible; Plukkie/1.6; http://www.botje.com/plukkie.htm)	
				strstr($user_agent, "spbot") || 			// Mozilla/5.0 (compatible; spbot/4.4.2; +http://OpenLinkProfiler.org/bot )
				strstr($user_agent, "DotBot") || 			// Mozilla/5.0 (compatible; DotBot/1.1; http://www.opensiteexplorer.org/dotbot, help@moz.com)
				strstr($user_agent, "sproose bot") || 
				strstr($user_agent, "YandexBot") || 		// Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)
				strstr($user_agent, "Gigabot") || 
				strstr($user_agent, "semanticbot") || 		// semanticbot
				strstr($user_agent, "Scripting Engine") || 	// Mozilla/5.0 (compatible; Nmap Scripting Engine; http://nmap.org/book/nse.html)
				strstr($user_agent, "org_bot") || 			//Mozilla/5.0 (compatible; archive.org_bot +http://www.archive.org/details/archive.org_bot)		
				
				strstr($user_agent, "domainreanimator") || 	// Domain Re-Animator Bot (http://domainreanimator.com) - support@domainreanimator.com
				
				strstr($user_agent, "curl") || 				// curl/7.19.7 (x86_64-redhat-linux-gnu) libcurl/7.19.7 NSS/3.19.1 Basic ECC zlib/1.2.3 libidn/1.18 libssh2/1.4.2
				strstr($user_agent, "HttpClient/UNAVAILABLE") || 				// Apache-HttpClient/UNAVAILABLE (java 1.4)
				strstr($user_agent, "SurveyBot") || 		// Mozilla/5.0 (Windows; U; Windows NT 5.1; en; rv:1.9.0.13) Gecko/2009073022 Firefox/3.5.2 (.NET CLR 3.5.30729) SurveyBot/2.3 (DomainTools)
				strstr($user_agent, "SeznamBot") || 		// Mozilla/5.0 (compatible; SeznamBot/3.2; +http://fulltext.sblog.cz/)
				strstr($user_agent, "searchmetrics.com") || // Mozilla/5.0 (compatible; SearchmetricsBot; http://www.searchmetrics.com/en/searchmetrics-bot/)
				strstr($user_agent, "probethenet") || 		// www.probethenet.com scanner
				strstr($user_agent, "meanpathbot") || 		// http://www.meanpath.com/meanpathbot.html - Clermont-Ferrand, AU, France
				strstr($user_agent, "proximic") || 			// Mozilla/5.0 (compatible; proximic; +http://www.proximic.com/info/spider.php)
				strstr($user_agent, "WBSearchBot") || 		// Mozilla/5.0 (compatible; WBSearchBot/1.1; +http://www.warebay.com/bot.html)
				strstr($user_agent, "Baiduspider") || 		// Baiduspider/2.0; +http://www.baidu.com/search/spider.html
				strstr($user_agent, "baidu") || 			// Baiduspider/2.0; +http://www.baidu.com/search/spider.html
				strstr($user_agent, "BecomeBot"))
					$is_spider = 1;
	
			if ($is_spider)
				$the_table = "pages_viewed_bots";
			else
				$the_table = "pages_viewed";
			
			$query3 = "INSERT INTO $the_table   SET page_count=1, 
												    initial_visit=$initial_visit, 
												    is_spider=$is_spider, 
													the_page='" . mysql_real_escape_string($_SERVER['PHP_SELF']) . "', 
													query_string='" . mysql_real_escape_string($_SERVER["QUERY_STRING"]) . "', 
													from_url='" . mysql_real_escape_string($_SERVER['HTTP_REFERER']) . "',  
													ip_address='" . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . "',  
													user_agent='" . mysql_real_escape_string($_SERVER['HTTP_USER_AGENT']) . "',  
													remote_host='" . mysql_real_escape_string($_SERVER['REMOTE_HOST']) . "',  
													http_host='" . mysql_real_escape_string($_SERVER['HTTP_HOST']) . "',  
													remote_misc='" . mysql_real_escape_string($_SERVER['REMOTE_USER']) . "',  
													the_date=NOW(), 
													the_time=NOW(), 
													session_id='" . mysql_real_escape_string(session_id()) . "'";
			if ($debug_msgs) echo $query3 . "<br />";
			$result3 = mysql_query($query3) or die("Could not look up pages_viewed - " . mysql_error() . "<br><br>");
		}
	}
