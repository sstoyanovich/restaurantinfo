<?
session_start(); 
require("bootstrap_v1/incld/db.php");
require_once("bootstrap_v1/incld/utils.php");	
	
//$debug_msgs = 1;

$token       			= clean_post_var($_POST["token"]); 
$session_token       	= $_SESSION["token"]; 
$sid         			= clean_post_var($_POST["sid"]); 
$actual_sid    			= session_id(); 
$self     				= clean_post_var($_POST["self"]); 
$server     			= clean_post_var($_POST["server"]); 
$ip_address     		= clean_post_var($_POST["ip_address"]); 

$member_id     			= clean_post_var($_POST["mkd83"]); 
$member_session_id   	= clean_post_var($_POST["msid"]); 
$inquirers_name     	= clean_post_var($_POST["inquirers_name"]); 
$inquirers_email     	= clean_post_var($_POST["inquirers_email"]); 
$inquirers_question     = clean_post_var($_POST["inquirers_question"]); 

$fwd = $self;

//if ($member_id == 1069) $debug_msgs = 1;

if ($debug_msgs)
{
	echo "token = $token<br />";	
	echo "session token = " . $_SESSION["token"] . "<br />";	
	echo "sid = $sid<br />";	
	echo "session sid = " . $actual_sid . "<br />";	

	echo "fwd = $fwd<br />";	
	echo "self = $self<br />";	
	echo "server = $server<br />";	
	echo "ip_address = $ip_address<br />";	
	echo "member_id = $member_id<br />";	
	echo "member_session_id = $member_session_id<br />";	
	echo "inquirers_name = $inquirers_name<br />";	
	echo "inquirers_email = $inquirers_email<br />";	
	echo "inquirers_question = $inquirers_question<br />";	
}



if ($token == $_SESSION['token'] && $sid == session_id() && $member_id)
{
	$query3 = "SELECT member_id FROM members WHERE member_id='" . $member_id . "' AND session_id='" . $member_session_id . "'";
	if ($debug_msgs) echo $query3 . "<br>";
	$result3 = mysql_query($query3) or die(mysql_error());
	$credentials_okay = mysql_num_rows($result3);
	if ($debug_msgs) echo "credentials_okay = $credentials_okay<br>";
/*	
	$query = "INSERT INTO contact_submissions SET 
							  paypal_email='" . mysql_real_escape_string($paypal_email) . "',  
							  paypal_agree='" . mysql_real_escape_string($paypal_agree) . "',  
							  allow_sales='" . mysql_real_escape_string($allow_sales) . "',  
							  charge_tax='" . mysql_real_escape_string($charge_tax) . "',  
							  return_policy='" . mysql_real_escape_string($return_policy) . "',
							  shipping_information='" . mysql_real_escape_string($shipping_information) . "',
							  usps_first_classs='" . mysql_real_escape_string($usps_first_classs) . "',
							  usps_priority='" . mysql_real_escape_string($usps_priority) . "',
							  ups_ground='" . mysql_real_escape_string($ups_ground) . "',
							  ups_two_day='" . mysql_real_escape_string($ups_two_day) . "',
							  fedex_overnight='" . mysql_real_escape_string($fedex_overnight) . "',
							  shipping_information='" . mysql_real_escape_string($shipping_information) . "',
							  tax_rate='" . mysql_real_escape_string($tax_rate) . "'";
		$query .= " WHERE member_id=" . $member_id . " LIMIT 1";
	if ($debug_msgs) echo $query . "<br>";
	$result = mysql_query($query) or die(mysql_error());
*/
	//****************************************************************************
	// Send emails.
	//****************************************************************************
	
	$query7 = "SELECT email, first_name, last_name FROM members WHERE member_id='" . $member_id . "'";
	if ($debug_msgs) echo $query7 . "<br />";
	$result7 = mysql_query($query7) or die(mysql_error());
	$rs7 = mysql_fetch_object($result7);
	$contact_email = stripslashes($rs7->email);
	$first_name = stripslashes($rs7->first_name);
	$last_name = stripslashes($rs7->last_name);
	@mysql_free_result($result7);

	if ($debug_msgs)
	{
		echo "first_name = $first_name<br />";	
		echo "last_name = $last_name<br />";	
		echo "contact_email = $contact_email<br />";	
	}
	
	$email_content = "<html>\n<head>\n</head>\n<body>\n<img src=\"http://www.restaurantinfo.com/images/layout/logo.png\" border=\"0\">\n<br><br>";
	$email_content .= $first_name . " " . $last_name . ", a visitor to Restaurant Info has sent you an inquiry:<br /><br />";
	$email_content .= "Their Name: " . $inquirers_name . "<br />";
	$email_content .= "Their Email: " . $inquirers_email . "<br />";
	$email_content .= "Their Question: " . $inquirers_question . "<br />";
	$email_content .= "</body>\n</html>\n";
	
	$headers = "From: Restaurant Info Inquiry<" . $inquirers_email . ">" . "\r\n" . 
			   "Reply-to: Restaurant Info Inquiry<" . $inquirers_email . ">" . "\r\n" . 
			   "X-Mailer: PHP/" . phpversion() . "\r\n" . 
			   "Content-Type: text/html; charset: us-ascii\r\n";
	$subject = "Restaurant Info Inquiry";
	
	if ($debug_msgs)
	{
		echo "subject = $subject<br />";	
		echo "headers = $headers<br />";	
		echo "email_content = $email_content<br />";	
	}
	
	$email_result = mail($contact_email, $subject, $email_content, $headers);
	if ($debug_msgs) echo "email_result = $email_result<br />";
	
	$query2 = "INSERT INTO contact_submissions SET 
												to_member_id='" . mysql_real_escape_string($member_id) . "',
												to_member_email='" . mysql_real_escape_string($contact_email) . "',
												from_name='" . mysql_real_escape_string($inquirers_name) . "',
												from_email='" . mysql_real_escape_string($inquirers_email) . "',
												question='" . mysql_real_escape_string($inquirers_question) . "',
												date_sent=NOW(), time_sent=NOW()";
	if ($debug_msgs) echo $query2 . "<br />";
	$result2 = mysql_query($query2) or die(mysql_error());
}

$forward_url = ($fwd) ? $fwd : "/index.php";
$forward_url .= "?contact_sent=1";

if (!$debug_msgs)
{
	header("Location: " . $forward_url );
	exit;
}
else
	echo "would normally forward to $forward_url<br />";