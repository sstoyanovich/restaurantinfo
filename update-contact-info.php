<?
session_start(); 
require("bootstrap_v1/incld/db.php");
require_once("bootstrap_v1/incld/utils.php");	
	
$debug_msgs = 0;
$path_base = "/home/eysdev/public_html/";

$admin_edit       	= clean_post_var($_POST["admin_edit"]); 
$token       		= clean_post_var($_POST["token"]); 
$sid         		= clean_post_var($_POST["sid"]); 
$member_id     		= clean_post_var($_POST["member_id"]); 
$member_token     	= clean_post_var($_POST["member_token"]); 
$job_title     		= clean_post_var($_POST["job_title"]); 
$company_name     	= clean_post_var($_POST["company_name"]); 
$first_name     	= clean_post_var($_POST["first_name"]); 
$last_name     		= clean_post_var($_POST["last_name"]); 
$address     		= clean_post_var($_POST["address"]); 
$address2     		= clean_post_var($_POST["address2"]); 
$city     			= clean_post_var($_POST["city"]); 
$state     			= clean_post_var($_POST["state"]); 
$zip     			= clean_post_var($_POST["zip"]); 
$email     			= clean_post_var($_POST["email"]); 
$phone_area_code      = clean_post_var($_POST["phone_area_code"]); 
$phone_prefix     	  = clean_post_var($_POST["phone_prefix"]); 
$phone_last_4     	  = clean_post_var($_POST["phone_last_4"]); 
$cell_phone_area_code = clean_post_var($_POST["cell_phone_area_code"]); 
$cell_phone_prefix    = clean_post_var($_POST["cell_phone_prefix"]); 
$cell_phone_last_4    = clean_post_var($_POST["cell_phone_last_4"]); 
$website_address  	= clean_post_var($_POST["website_address"]); 
$security_question  = clean_post_var($_POST["security_question"]); 
$security_response  = clean_post_var($_POST["security_response"]); 

if ($debug_msgs)
{
	echo "token = $token<br />";	
	echo "session token = " . $_SESSION["token"] . "<br />";	
	echo "sid = $sid<br />";	
	echo "session sid = " . session_id() . "<br />";	

	echo "member_id = $member_id<br />";	
	echo "member_token = $member_token<br />";	
	echo "job_title = $job_title<br />";	
	echo "company_name = $company_name<br />";	
	echo "first_name = $first_name<br />";	
	echo "last_name = $last_name<br />";	
	echo "address = $address<br />";	
	echo "address2 = $address2<br />";	
	echo "city = $city<br />";	
	echo "state = $state<br />";	
	echo "zip = $zip<br />";	
	echo "email = $email<br />";	
	echo "phone =  ($phone_area_code) $phone_prefix - $phone_last_4<br />";	
	echo "cell_phone =  ($cell_phone_area_code) $cell_phone_prefix - $cell_phone_last_4<br />";	
	echo "website_address = $website_address<br />";	
	echo "security_question = $security_question<br />";	
	echo "security_response = $security_response<br />";	
}

if ($token && $token == $_SESSION['token'] && $sid && $sid == session_id() && $member_id)
{
	$query = "UPDATE members SET 
							  job_title='" . mysql_real_escape_string($job_title) . "',  
							  company_name='" . mysql_real_escape_string($company_name) . "',  
							  first_name='" . mysql_real_escape_string($first_name) . "',  
							  last_name='" . mysql_real_escape_string($last_name) . "',  
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
							  website_address='" . mysql_real_escape_string($website_address) . "',
							  security_question='" . mysql_real_escape_string($security_question) . "',
							  security_response='" . mysql_real_escape_string($security_response) . "'";
		$query .= " WHERE member_id=" . $member_id . " and token='" . mysql_real_escape_string($member_token) . "' LIMIT 1";
	if ($debug_msgs) echo $query . "<br>";
	$result = mysql_query($query) or die(mysql_error());

	if (!$debug_msgs) 
	{ 	
		if ($admin_edit)
			header("Location: members.php"); 
		else
			header("Location: my-jobs.php"); 
	}
	exit;
}
else
{
  header("Location: ../index.php");
  exit;
}