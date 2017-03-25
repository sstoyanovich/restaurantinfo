<?php 
session_start();
require("bootstrap_v1/incld/utils.php");

$debug_msgs = 0;

if (!strstr($HTTP_REFERER, "register.php") && 0)	// Try to block some of the spamers from joining
{
	header("location: register_error.php");
	exit;
}
else
{
	require("bootstrap_v1/incld/db.php");

	//****************************************************************************
	// Process the POST parms.
	//****************************************************************************

	$passed_token     			= clean_post_var($_POST["token"]);
	$session_token     			= $_SESSION["token"]; 
	$passed_sid  				= clean_post_var($_POST["sid"]);
	$session_sid				= session_id();
	
	$pased_ip_address       	= clean_post_var($_POST["ip_address"]);
	$ip_address    				= $_SERVER['REMOTE_ADDR'];
	$pased_self       			= clean_post_var($_POST["self"]);
	$self    					= $_SERVER['PHP_SELF'];
	$pased_server       		= clean_post_var($_POST["server"]);
	$server    					= $_SERVER['SERVER_NAME'];
	
	$member_type  = clean_post_var($_POST["member_type"]); 
	
	$company_name  = clean_post_var($_POST["company_name"]); 

	$first_name  = clean_post_var($_POST["first_name"]); 
	$last_name   = clean_post_var($_POST["last_name"]);
	$address     = clean_post_var($_POST["address"]);
	$address2    = clean_post_var($_POST["address2"]);
	$city        = clean_post_var($_POST["city"]);
	$state       = clean_post_var($_POST["state"]);
	$country     = clean_post_var($_POST["country"]);
	$zip         = clean_post_var($_POST["zip"]);
	
	$phone_area_code      = clean_post_var($_POST["phone_area_code"]); 
	$phone_prefix     	  = clean_post_var($_POST["phone_prefix"]); 
	$phone_last_4     	  = clean_post_var($_POST["phone_last_4"]); 
	$cell_phone_area_code = clean_post_var($_POST["cell_phone_area_code"]); 
	$cell_phone_prefix    = clean_post_var($_POST["cell_phone_prefix"]); 
	$cell_phone_last_4    = clean_post_var($_POST["cell_phone_last_4"]); 

	if (!$phone_area_code) $phone_area_code      = 0; 
	if (!$phone_prefix) $phone_prefix     	  = 0; 
	if (!$phone_last_4) $phone_last_4     	  = 0; 
	if (!$cell_phone_area_code) $cell_phone_area_code = 0; 
	if (!$cell_phone_prefix) $cell_phone_prefix    = 0; 
	if (!$cell_phone_last_4) $cell_phone_last_4    = 0; 
	
	$email       = clean_post_var($_POST["email"]);
	$email2      = clean_post_var($_POST["email2"]);
	$password     = clean_post_var($_POST["password"]);
	$password2    = clean_post_var($_POST["password2"]);
	
	$security_question    = clean_post_var($_POST["security_question"]);
	$security_response    = clean_post_var($_POST["security_response"]);
	$referred_by    = clean_post_var($_POST["referred_by"]);
	
	$accept        = ($_POST["accept"]) ? 1 : 0 ; 			
	$reg_code      = clean_post_var($_POST["reg_code"]);
	$reg_code_ref  = clean_post_var($_POST["reg_code_ref"]);
		
	$ip_address    = $_SERVER['REMOTE_ADDR'];

	if ($debug_msgs)
	{
		echo "passed token = $passed_token<br />";	
		echo "session token = " . $session_token . "<br />";	
		echo "passed sid = $passed_sid<br />";	
		echo "actual sid = " . $session_sid . "<br />";	
		
		echo "pased_ip_address = " . $pased_ip_address . "<br />";	
		echo "ip_address = " . $ip_address . "<br />";	
		echo "pased_self = " . $pased_self . "<br />";	
		echo "pased_server = " . $pased_server . "<br />";	
		echo "self = " . $self . "<br />";	
		echo "server = " . $server . "<br />";	
	
		echo "company_name = $company_name<br />";	
		echo "first_name = $first_name<br />";	
		echo "last_name = $last_name<br />";	
		echo "address = $address<br />";	
		echo "address2 = $address2<br />";	
		echo "city = $city<br />";	
		echo "state = $state<br />";	
		echo "zip = $zip<br />";	
		
		echo "email = $email<br />";	
		echo "email2 = $email2<br />";	
		echo "phone =  ($phone_area_code) $phone_prefix - $phone_last_4<br />";	
		echo "cell_phone =  ($cell_phone_area_code) $cell_phone_prefix - $cell_phone_last_4<br />";	
		
		echo "security_question = $security_question<br />";	
		echo "security_response = $security_response<br />";	
		
		echo "password = $password<br />";	
		echo "password2 = $password2<br />";	
		echo "reg_code = $reg_code<br />";	
		echo "reg_code_ref = $reg_code_ref<br />";	
		echo "accept = $accept<br />";	
	}

	//****************************************************************************
	// Save the POST parms as a GET string in case we need to return.
	//****************************************************************************

	$get_parms = "&company_name=$company_name" . 
				 "&member_type=$member_type" . 
				 "&first_name=$first_name&last_name=$last_name&address=$address&address2=$address2&city=$city&state=$state&zip=$zip" . 
				 "&company_name=$company_name&email=$email&phone=$phone&cell_phone=$cell_phone&security_question=$security_question&security_response=$security_response" . 
				 "&password=$password&referred_by=$referred_by" .
				 "&package=$package&accept=$accept";

	if ($debug_msgs) echo "get_parms = " . $get_parms . "<br>";

	//****************************************************************************
	// Cross site scripting.
	//****************************************************************************

	if ($passed_token != $session_token || $passed_sid != $session_sid || $pased_ip_address != $ip_address)
	{
		header("Location: register.php?return=1&regcode=bad" . $get_parms);
		exit;
	}
	else 
		if ($debug_msgs) echo "Token and session ID are okay.<br>";

	//****************************************************************************
	// Verify the registration code was properly entered.
	//****************************************************************************

	if ($reg_code != $reg_code_ref)
	{
		header("Location: register.php?return=1&regcode=bad" . $get_parms);
		exit;
	}
	else 
		if ($debug_msgs) echo "Registration code matches<br>";

	//****************************************************************************
	// Lets check to see if the email address has already been used.
	//****************************************************************************

	$query2 = "SELECT member_id FROM members WHERE email='" . mysql_real_escape_string($email) . "'";
	if ($debug_msgs) echo $query2 . "<br>";
	$result2 = mysql_query($query2) or die(mysql_error());
	$email_already_used = mysql_num_rows($result2);
	
	if ($email_already_used) 
	{
		header("Location: register.php?return=1&emailused=1" . $get_parms);
		exit;
	}
	else 
		if ($debug_msgs) echo "email_already_used = $email_already_used<br>";

	//****************************************************************************
	// Save the members registration info in the database.
	//****************************************************************************

	$query = "INSERT INTO members SET token='" . mysql_real_escape_string($passed_token) . "',
									  member_type='" . mysql_real_escape_string($member_type) . "', 
									  
									  first_name='" . mysql_real_escape_string($first_name) . "', 
									  last_name='" . mysql_real_escape_string($last_name) . "', 
									  
									  company_name='" . mysql_real_escape_string($company_name) . "', 
									  referred_by='" . mysql_real_escape_string($referred_by) . "', 
									  
									  address='" . mysql_real_escape_string($address) . "', 
									  address2='" . mysql_real_escape_string($address2) . "', 
									  city='" . mysql_real_escape_string($city) . "', 
									  state='" . mysql_real_escape_string($state) . "', 
									  zip='" . mysql_real_escape_string($zip) . "', 
									  
									  email='" . mysql_real_escape_string($email) . "', 
									  phone_area_code='" . mysql_real_escape_string($phone_area_code) . "',
									  phone_prefix='" . mysql_real_escape_string($phone_prefix) . "',
									  phone_last_4='" . mysql_real_escape_string($phone_last_4) . "',
									  cell_phone_area_code='" . mysql_real_escape_string($cell_phone_area_code) . "',
									  cell_phone_prefix='" . mysql_real_escape_string($cell_phone_prefix) . "',
									  cell_phone_last_4='" . mysql_real_escape_string($cell_phone_last_4) . "',

									  security_question='" . mysql_real_escape_string($security_question) . "', 
									  security_response='" . mysql_real_escape_string($security_response) . "', 
									  
									  `password`='" . sha1($password) . "', 
									  
									  accept_terms='" . $accept . "', 
									  
									  ip_address='" . mysql_real_escape_string($ip_address) . "',  
									  user_agent='" . $_SERVER['HTTP_USER_AGENT'] . "',
									  date_signedup=NOW(), 
									  activated='1', 
									  verified='0', 
									  last_login=NOW(), 
									  session_id='" . $the_session_id . "',
									  num_logins=0";
    
	if ($debug_msgs) echo str_replace(",", ",<br>", $query) . "<br>";
	$result = mysql_query($query) or die(mysql_error());
	$their_id = mysql_insert_id();

	//****************************************************************************
	// Now, depending upon the package they have selected, we either take them
	// to the payment page, or directly to the thank you page..
	//****************************************************************************

//	if ($member_type == "C" && $price && !$free_trial)
//	{
//		$the_url = $g_ssl_url . "payment/get-billing-info.php?member_id=" . $their_id  . "&regpaystep=1&package=" . $package . "&sid=" . $the_session_id . "&member_type=" . $member_type;
//	}
//	else
		$the_url = "register-done.php?id=" . $their_id  . "&token=" . $passed_token;

	if (!$debug_msgs) { header("Location: " . $the_url); }
	exit;
}
