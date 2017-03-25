<?
session_start(); 
require("bootstrap_v1/incld/db.php");
require_once("bootstrap_v1/incld/utils.php");	
	
$debug_msgs = 0;

$token       			= clean_post_var($_POST["token"]); 
$sid         			= clean_post_var($_POST["sid"]); 

$member_id     			= clean_post_var($_POST["member_id"]); 
$paypal_email     		= clean_post_var($_POST["paypal_email"]); 
$tax_rate     			= clean_post_var($_POST["tax_rate"]); 
$return_policy     		= clean_post_var($_POST["return_policy"]); 
$shipping_information   = clean_post_var($_POST["shipping_information"]); 

$paypal_agree       	= ($_POST["paypal_agree"]) ? 1 : 0;
$allow_sales       		= ($_POST["allow_sales"]) ? 1 : 0;
$charge_tax        		= ($_POST["charge_tax"]) ? 1 : 0;
$usps_first_classs      = ($_POST["usps_first_classs"]) ? 1 : 0;
$usps_priority        	= ($_POST["usps_priority"]) ? 1 : 0;
$ups_ground        		= ($_POST["ups_ground"]) ? 1 : 0;
$ups_two_day        	= ($_POST["ups_two_day"]) ? 1 : 0;
$fedex_overnight        = ($_POST["fedex_overnight"]) ? 1 : 0;

if ($debug_msgs)
{
	echo "token = $token<br />";	
	echo "session token = " . $_SESSION["token"] . "<br />";	
	echo "sid = $sid<br />";	
	echo "session sid = " . session_id() . "<br />";	

	echo "member_id = $member_id<br />";	
	echo "paypal_email = $paypal_email<br />";	
	echo "paypal_agree = $paypal_agree<br />";	
	echo "allow_sales = $allow_sales<br />";	
	echo "charge_tax = $charge_tax<br />";	
	echo "tax_rate = $tax_rate<br />";	
	echo "return_policy = $return_policy<br />";	
	echo "shipping_information = $shipping_information<br />";	
	echo "usps_first_classs = $usps_first_classs<br />";	
	echo "usps_priority = $usps_priority<br />";	
	echo "ups_ground = $ups_ground<br />";	
	echo "ups_two_day = $ups_two_day<br />";	
	echo "fedex_overnight = $fedex_overnight<br />";	
}

if ($token == $_SESSION['token'] && $sid == session_id() && $member_id)
{
	$query = "UPDATE seller_settings SET 
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

	if (!$debug_msgs) { header("Location: dashboard.php"); }
	exit;
}
else
{
  header("Location: ../index.php");
  exit;
}
