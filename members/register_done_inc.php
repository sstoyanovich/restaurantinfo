<?
$debug_msgs = 0;

$member_id = $_GET["id"];
$member_token = $_GET["token"];

if ($debug_msgs) echo "member_id = $member_id<br />";
if ($debug_msgs) echo "member_token = $member_token<br />";

$query3 = "SELECT email FROM members WHERE member_id='" . $member_id . "' AND token='" . mysql_real_escape_string($member_token) . "'";
if ($debug_msgs) echo $query3 . "<br />";
$result3 = mysql_query($query3) or die(mysql_error());
$rs3 = mysql_fetch_object($result3);
$found_member = mysql_num_rows($result3);
if ($debug_msgs) echo "found_member = $found_member<br />";
$members_email = stripslashes($rs3->email);
@mysql_free_result($result3);

if ($found_member)
{
	$query3 = "SELECT contact_email FROM company_information";
	if ($debug_msgs) echo $query3 . "<br />";
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	$contact_email = stripslashes($rs3->contact_email);
	@mysql_free_result($result3);
	if ($debug_msgs) echo "contact_email = $contact_email<br />";

	$email_content = "<html>\n<head>\n</head>\n<body>\n<img src=\"http://www." . $g_website_domain . "/images/layout/logo-for-emails.png\" border=\"0\">\n<br><br>";
	$email_content .= "Thank you for registering with " . $company_name . ". Please verify your email address by clicking on the link below.   This will activate your new account with " . $company_name . ".<br><br>\n";
	$email_content .= "<a href=\"http://www.restaurantinfo.com/email-verification.php?verify=1&id=" . $member_id . "&token=" . $member_token . "\" target=\"_top\">Activate your Account</a>";
	$email_content .= "</body>\n</html>\n";
	
	$headers = "From: " . $company_name . " Registration<" . $contact_email . ">" . "\r\n" . "Reply-to: " . $company_name . " Registration<" . $contact_email . ">" . "\r\n" . "X-Mailer: PHP/" . phpversion() . "\r\n" . "Content-Type: text/html; charset: us-ascii\r\n";
	$subject = "Welcome to " . $company_name . "!";
	
	if ($debug_msgs)
	{
		echo "members_email = $members_email<br />";	
		echo "subject = $subject<br />";	
		echo "headers = $headers<br />";	
		echo "email_content = $email_content<br />";	
	}
	
	$email_result = mail($members_email, $subject, $email_content, $headers);
	if ($debug_msgs) echo "email_result = $email_result<br />";
	
	$query2 = "UPDATE members SET verify_email_send_result='" . mysql_real_escape_string($email_result) . "' WHERE member_id=" . $member_id . " LIMIT 1";
	if ($debug_msgs) echo $query2 . "<br />";
	$result2 = mysql_query($query2) or die(mysql_error());
	
	?>
	<strong>Registration complete</strong>.<br /><br />
	
	An confirmation email has been sent to email address: <?=$email?><br /><br />
	
	To ensure that you receive the confirmation email, please added email address: <strong>info@<?=$g_website_domain?></strong> to your approved list in your email program.
	If you do not receive this email, please check for it in your junk email folder. <br /><br />
	
	To activate your account, please click on a link provided in confirmation email.
	
<?
}
else
{
?>
	We are sorry, but we are not able to locate your membership in our database.<br /><br />
    Please <a href="contact.php">contact us</a> for assistance.
    
<?	
}
