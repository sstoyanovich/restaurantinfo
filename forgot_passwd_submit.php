<?php 
session_start(); 
require("bootstrap_v1/incld/db.php");
require_once("bootstrap_v1/incld/utils.php");	

$debug_msgs = 0;

//****************************************************************************
// Process the POST parms.
//****************************************************************************

$sid       		= clean_post_var($_POST["sid"]);
$actual_sid 	= session_id();
$token     		= clean_post_var($_POST["token"]);
$session_token 	= $_SESSION["token"];
$zip       		= clean_post_var($_POST["zip"]);
$email     		= clean_post_var($_POST["email"]);

if ($debug_msgs)
{
	echo "passed sid = $sid<br />";	
	echo "actual sid = " . $actual_sid . "<br />";	
	echo "passed token = $token<br />";	
	echo "actual sid = " . $session_token . "<br />";	
	echo "zip = $zip<br />";	
	echo "email = $email<br />";	
}

//****************************************************************************
// Save the POST parms as a GET string in case we need to return.
//****************************************************************************

if ($sid != session_id())
{
	if ($debug_msgs) echo "XSS Error (SID)<br />";
	header("Location: forgot-password.php?return=1&badsid=1");
	exit;
}

if ($token != $session_token)
{
	if ($debug_msgs) echo "XSS Error (SID)<br />";
	header("Location: forgot-password.php?return=1&badtoken=1");
	exit;
}

if (!$email)
{
	if ($debug_msgs) echo "Email Error<br />";
	header("Location: forgot-password.php?return=1&em=missing");
	exit;
}

if (!$zip)
{
	if ($debug_msgs) echo "password Error<br />";
	header("Location: forgot-password.php?return=1&zip=missing");
	exit;
}

//****************************************************************************
// Lets check to see if email address is correct.
//****************************************************************************

//$query2 = "SELECT member_id FROM members WHERE email='" . mysql_real_escape_string($email) . "' AND zip='" . mysql_real_escape_string($zip) . "'";
$query2 = "SELECT member_id FROM members WHERE email='" . mysql_real_escape_string($email) . "'";
if ($debug_msgs) echo $query2 . "<br>";
$result2 = mysql_query($query2) or die(mysql_error());
$combo_is_valid = mysql_num_rows($result2);
if ($debug_msgs) echo "combo_is_valid = $combo_is_valid.<br />";
if (!$combo_is_valid)
{
	if ($debug_msgs) echo "Email and or zip code is incorrect.<br />";
	header("Location: forgot-password.php?return=1&emzip=bad" . $get_parms);
	exit;
}

$rs2 = mysql_fetch_object($result2);
$member_id = stripslashes($rs2->member_id);
@mysql_free_result($result2);

if (!$member_id)
{
	if ($debug_msgs) echo "Email and or zip code is incorrect.<br />";
	header("Location: forgot-password.php?return=1&member_id=bad" . $get_parms);
	exit;
}
else if ($debug_msgs)
	echo "member_id = $member_id<br />";


//****************************************************************************
// Create a temporary password.
//****************************************************************************

function generate_temp_password_char()
{
	$random_number = (int)rand(1,50);
	if ($random_number > 0) $random_number--;
	if ($random_number > 49) $random_number = 49;
    $chars = '0a1b2c3d4e5f6g7h8i9j0k1L2m3n4o5p6q7r8s9t0u1v2x3y5z';
	return $chars[$random_number];
}

$temp_password = '';
for ($num_cntr = 1; $num_cntr <= 8; $num_cntr++)
{
	$temp_password .= generate_temp_password_char();
}

if ($debug_msgs) echo "temp_password = $temp_password.<br />";

$query = "UPDATE members SET password_reset=1, `password`='" . sha1($temp_password) . "' WHERE member_id=" . $member_id . " LIMIT 1";
if ($debug_msgs) echo $query . "<br />";
mysql_query($query) or die(mysql_error());

//****************************************************************************
// Send email
//****************************************************************************

$contact_email = "info@restaurantinfo.com";

$email_content = "<html>\n<head>\n</head>\n<body>\n<img src=http://restaurantinfo.com/images/layout/logo-for-emails.png\" border=\"0\">\n<br><br>";
$email_content .= "<strong>Password Reset</strong>.<br><br>\n";
$email_content .= "Your password has been reset to this temporary password: " . $temp_password . "<br><br>\n";
$email_content .= "Please login to your account and change your password as soon as possible";
$email_content .= "</body>\n</html>\n";

$headers = "From: restaurantinfo.com<" . $contact_email . ">" . "\r\n" . "Reply-to: restaurantinfo.com<" . $contact_email . ">" . "\r\n" . "X-Mailer: PHP/" . phpversion() . "\r\n" . "Content-Type: text/html; charset: us-ascii\r\n";
$subject = "Your restaurantinfo.com password has been reset";

if ($debug_msgs)
{
	echo "$contact_email = $contact_email<br />";	
	echo "$email = $email<br />";	
	echo "subject = $subject<br />";	
	echo "headers = $headers<br />";	
	echo "email_content = $email_content<br />";	
}

$email_result = mail($email, $subject, $email_content, $headers);
if ($debug_msgs) echo "email_result = $email_result<br />";

$query2 = "INSERT INTO reset_password_email_sends SET send_result='" . mysql_real_escape_string($email_result) . "', send_to_email='" . mysql_real_escape_string($email) . "', member_id=" . $member_id . ", the_date_time=NOW()";
$result2 = mysql_query($query2) or die(mysql_error());


$the_url = "login.php?password_reset=done";
if (!$debug_msgs) header("Location: " . $the_url);
