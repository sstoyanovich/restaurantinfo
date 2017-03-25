<?php
session_start(); 
require("incld/config/site-parameters.php");	
require("incld/utils.php");	

$debug_msgs = 1;	

$token  = clean_post_var($_POST["token"]);

$name  				= clean_post_var($_POST["name"]);
$phone  			= clean_post_var($_POST["phone"]);
$cell  				= clean_post_var($_POST["cell"]);
$email  			= clean_post_var($_POST["email"]);
$contact_method  	= clean_post_var($_POST["contact_method"]);
$comments  			= clean_post_var($_POST["comments"]);

if ($_SESSION['token'] == $token)
{
	$email_content  = "<html>\n<head>\n</head>\n<body>\n";
	$email_content .= "A visitor to your site has filled out the request a quote form:<br><br>";
	$email_content .= "Name:  $name<br>";
	$email_content .= "E-mail:  $email<br>";
	$email_content .= "Phone:  $phone<br><br>";
	$email_content .= "Cell:  $cell<br><br>";
	
	$email_content .= "Questions / Comments:  $comments<br>";
	
	$email_content .= "</body>\n</html>\n";

	$from_email = $g_contact_email;
	
	$headers = "From: $g_company_name<$from_email>" . "\r\n" . 
			   "Reply-to: $g_company_name<$from_email>" . "\r\n" . 
			   "X-Mailer: PHP/" . phpversion() . "\r\n" . 
			   "Content-Type: text/html; charset: us-ascii\r\n";
	
	$subject = "$g_company_name Quote Request";
	
	$result = mail($g_contact_email, $subject, $email_content, $headers);
}

if (!$debug_msgs)
	header("Location: /contact.php?done=1");
