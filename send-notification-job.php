<?
session_start(); 
require("bootstrap_v1/incld/db.php");
require_once("bootstrap_v1/incld/utils.php");	
	
$debug_msgs = 0;

$token       			= clean_post_var($_POST["token"]); 
$sid         			= clean_post_var($_POST["sid"]); 

$job_id     			= clean_post_var($_POST["job_id"]); 
$candidate_member_id   	= clean_post_var($_POST["candidate_member_id"]); 
$employer_member_id  	= clean_post_var($_POST["employer_member_id"], 1); 
$notification_type    	= clean_post_var($_POST["notification_type"], 1); 
$notification_comments  = clean_post_var($_POST["notification_comments"]); 

if ($debug_msgs)
{
	echo "token = $token<br />";	
	echo "session token = " . $_SESSION["token"] . "<br />";	
	echo "sid = $sid<br />";	
	echo "session sid = " . session_id() . "<br />";	

	echo "job_id = $job_id<br />";	
	echo "candidate_member_id = $candidate_member_id<br />";	
	echo "employer_member_id = $employer_member_id<br />";	
	echo "notification_type = $notification_type<br />";	
	echo "notification_comments = $notification_comments<br />";	
}

if ($token && $token == $_SESSION['token'] && $candidate_member_id && $candidate_member_id && $employer_member_id && $notification_type)
{
	$query = "INSERT INTO employer_sent_notifications SET 
							  job_id='" . mysql_real_escape_string($job_id) . "',  
							  candidate_member_id='" . mysql_real_escape_string($candidate_member_id) . "',  
							  employer_member_id='" . mysql_real_escape_string($employer_member_id) . "',  
							  notification_type='" . mysql_real_escape_string($notification_type) . "',  
							  notification_comments='" . mysql_real_escape_string($notification_comments) . "',  
							  date_sent=NOW(),  
							  time_sent=NOW(),  
							  unix_time_sent='" . time() . "'";
	if ($debug_msgs) echo $query . "<br>";
	$result = mysql_query($query) or die(mysql_error());
	$employer_sent_notifications_id = mysql_insert_id();

	switch ($notification_type)
	{
		case 1:  $notification_type_text = "Request Application"; break;
		case 2:  $notification_type_text = "Request Phone Interview"; break;
		case 3:  $notification_type_text = "Request Interview"; break;
		case 4:  $notification_type_text = "Make Job Offer"; break;
		case 5:  $notification_type_text = "Reject Application"; break;
		default: $notification_type_text = "Other"; break;
	}

	$query3 = "SELECT job_title FROM jobs WHERE job_id=" . $job_id;
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	$job_title = stripslashes($rs3->job_title);
	@mysql_free_result($result3);

	$query3 = "SELECT first_name,last_name,email FROM members WHERE member_id=" . $candidate_member_id;
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	$members_email = stripslashes($rs2->email); 
	$member_name = stripslashes($rs2->first_name) . "  " . stripslashes($rs2->last_name); 
	@mysql_free_result($result3);

	$query3 = "SELECT company_name FROM members WHERE member_id=" . $employer_member_id;
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	$company_name = stripslashes($rs2->company_name); 
	@mysql_free_result($result3);

	$query3 = "SELECT company_name,contact_email,website_domain FROM company_information";
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	$this_company_name = stripslashes($rs3->company_name);
	$this_company_contact_email = stripslashes($rs3->contact_email);
	$website_domain = stripslashes($rs3->website_domain);
	@mysql_free_result($result3);
	if ($debug_msgs) echo "company_name = $company_name<br />";
	if ($debug_msgs) echo "company_contact_email = $company_contact_email<br />";
	if ($debug_msgs) echo "website_domain = $website_domain<br />";

	// Send the email to the candidate

	$subject = " Notification:" . $notification_type_text . " for position: " . $job_title . " from " . $company_name;

	$email_content = "<html>\n<head>\n</head>\n<body>\n<img src=\"http://www." . $website_domain . "/images/layout/logo-for-emails.png\" border=\"0\">\n<br><br>";
	$email_content .= "$member_name, you have been sent a $notification_type_text notification from $company_name.<br><br>\n";
	$email_content .= "To view details of this notification, please login to your $this_company_name members portal at:<br><br>\n";
	$email_content .= "<a href=\"http://www." . $website_domain . "/login.php?id=" . $employer_sent_notifications_id . "\" target=\"_top\">View this Candidates Profile</a><br><br>";
	$email_content .= "If you have an questions, please contact us at: " . $company_contact_email . "<br><br>\n";
	$email_content .= "</body>\n</html>\n";
	
	$headers = "From: " . $company_name . " Job Application<" . $company_contact_email . ">" . "\r\n" . "Reply-to: " . $company_name . " Job Application<" . $company_contact_email . ">" . "\r\n" . "X-Mailer: PHP/" . phpversion() . "\r\n" . "Content-Type: text/html; charset: us-ascii\r\n";

	if ($debug_msgs)
	{
		echo "members_email = $members_email<br />";	
		echo "subject = $subject<br />";	
		echo "headers = $headers<br />";	
		echo "email_content = $email_content<br />";	
	}
	
	$email_result = mail($members_email, $subject, $email_content, $headers);
	if ($debug_msgs) echo "email_result = $email_result<br />";
}

if (!$debug_msgs) 
{ 	
	header("Location: /my-jobs.php?view_applies_job_id=" . $job_id); 
}
exit;
