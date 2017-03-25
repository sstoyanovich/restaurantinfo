<?
$is_computer = 0;
$is_mobile = 0;

$g_website_domain = "http://restaurantinfo.com";
$company_name = "Restaurant Info";

$user_agent = $_SERVER['HTTP_USER_AGENT'];	

if (strstr($user_agent, "iPhone") || 
	strstr($user_agent, "iPad") || 
	strstr($user_agent, "Android") 
	)
	$is_mobile = 1;
else if (strstr($user_agent, "Windows") || 
		strstr($user_agent, "Macintosh") || 
		strstr($user_agent, "Linux") 
	)
	$is_computer = 1;
else
	$is_mobile = 1;
