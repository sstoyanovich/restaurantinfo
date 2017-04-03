<?
session_start();
require("bootstrap_v1/incld/db.php");
require_once("bootstrap_v1/incld/utils.php");
require_once("bootstrap_v1/incld/config.php");

$debug_msgs = 0;

$token       		= clean_post_var($_POST["token"]);
$sid         		= clean_post_var($_POST["sid"]);

$employer_member_id = clean_post_var($_POST["employer_member_id"]);
$candidate_member_id = clean_post_var($_POST["candidate_member_id"]);
$job_id	     		= clean_post_var($_POST["job_id"]);
$job_code     		= clean_post_var($_POST["job_code"]);

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

$resume_option		= clean_post_var($_POST["resume_option"]);
$pasted_resume		= clean_post_var($_POST["pasted_resume"]);
$comments			= clean_post_var($_POST["comments"]);
$resume_file_name		= $_FILES['resume_file']['name'];
$resume_file_tmp_name	= $_FILES['resume_file']['tmp_name'];


// resume_file

if ($debug_msgs)
{
	echo "token = $token<br />";
	echo "session token = " . $_SESSION["token"] . "<br />";
	echo "sid = $sid<br />";
	echo "session sid = " . session_id() . "<br />";

	echo "job_code = $job_code<br />";
	echo "job_id = $job_id<br />";
	echo "employer_member_id = $employer_member_id<br />";
	echo "candidate_member_id = $candidate_member_id<br />";

	echo "first_name = $first_name<br />";
	echo "last_name = $last_name<br />";
	echo "address = $address<br />";
	echo "address2 = $address2<br />";
	echo "city = $city<br />";
	echo "state = $state<br />";
	echo "zip = $zip<br />";
	echo "email = $email<br />";
	echo "phone =  ($phone_area_code) $phone_prefix - $phone_last_4<br />";
	echo "cell_phone =  ($cell_phone_area_code) $cell_phone_prefix - $cell_phone_last_4<br /><br />";
	echo "comments =  $comments<br /><br />";
}

if ($token && $token == $_SESSION['token'] && $sid && $sid == session_id() && $employer_member_id && $job_id && $job_code && $candidate_member_id)
{
	$query3 = "SELECT email_for_job_applies,job_title,job_title_id,member_id FROM jobs WHERE apply_locally=1 AND job_id='" . mysql_real_escape_string($job_id) . "'";
	if ($debug_msgs) echo $query3 . "<br />";
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	$email_for_job_applies = stripslashes($rs3->email_for_job_applies);
	$job_title = stripslashes($rs3->job_title);
	$job_title_id = stripslashes($rs3->job_title_id);
	$employer_member_id = stripslashes($rs3->member_id);
	@mysql_free_result($result3);

	if ($debug_msgs) echo "email_for_job_applies = $email_for_job_applies<br />";
	if ($debug_msgs) echo "job_title = $job_title<br />";
	if ($debug_msgs) echo "job_title_id = $job_title_id<br />";
	if ($debug_msgs) echo "employer_member_id = $employer_member_id<br />";

	if ($email_for_job_applies)
	{
		if ($job_title_id)
		{
			$query3 = "SELECT job_title FROM job_titles WHERE job_title_id=" . $job_title_id;
			$result3 = mysql_query($query3) or die(mysql_error());
			$rs3 = mysql_fetch_object($result3);
			$job_title = stripslashes($rs3->job_title);
			@mysql_free_result($result3);
		}
		if ($debug_msgs) echo "job_title = $job_title<br />";

		$query3 = "SELECT token FROM members WHERE member_id=" . $employer_member_id;
		$result3 = mysql_query($query3) or die(mysql_error());
		$rs3 = mysql_fetch_object($result3);
		$member_token = stripslashes($rs3->token);
		@mysql_free_result($result3);
		if ($debug_msgs) echo "member_token = $member_token<br />";

		$query3 = "SELECT company_name,contact_email FROM company_information";
		$result3 = mysql_query($query3) or die(mysql_error());
		$rs3 = mysql_fetch_object($result3);
		$company_name = stripslashes($rs3->company_name);
		$company_contact_email = stripslashes($rs3->contact_email);
		@mysql_free_result($result3);
		if ($debug_msgs) echo "company_name = $company_name<br />";
		if ($debug_msgs) echo "company_contact_email = $company_contact_email<br />";
		if ($debug_msgs) echo "g_website_domain = $g_website_domain<br />";



		$query = "INSERT INTO job_applications_local SET
					  employer_member_id='" . mysql_real_escape_string($employer_member_id) . "',
					  candidate_member_id='" . mysql_real_escape_string($candidate_member_id) . "',
					  job_id='" . mysql_real_escape_string($job_id) . "',
					  job_code='" . mysql_real_escape_string($job_code) . "',
					  email_for_job_applies='" . mysql_real_escape_string($email_for_job_applies) . "',
					  date_applied=NOW(),
					  time_applied=NOW(),
					  unix_time_applied='" . time() . "'";
		if ($debug_msgs) echo $query . "<br>";
		$result = mysql_query($query) or die(mysql_error());

		$job_applications_local_id = mysql_insert_id();
		if ($debug_msgs) echo "job_applications_local_id = $job_applications_local_id<br />";

		// Send the email to the employer

		$subject = "RestaurantInfo Application for " . $job_title . " - Job Code: " . $job_code;

		$email_content = "<html>\n<head>\n</head>\n<body>\n<img src=\"http://www." . $g_website_domain . "/images/layout/logo-for-emails.png\" border=\"0\">\n<br><br>";

		$email_content .= "A candidate has applied for $job_title (Job code: $job_code) at your restaurant.<br><br>\n";

		$email_content .= "Candidate:<br><br>\n";
		$email_content .= "Name: $first_name $last_name<br>\n";
		$email_content .= "Address: $address $address2<br>\n";
		$email_content .= "         $city, $state, $zip<br>\n";
		$email_content .= "Email: $email<br>\n";
		$email_content .= "Phone:  ($phone_area_code) $phone_prefix - $phone_last_4<br>\n";
		$email_content .= "Cell Phone:  ($cell_phone_area_code) $cell_phone_prefix - $cell_phone_last_4<br>\n";
		$email_content .= "Comments: $comments<br>\n";

		$email_content .= "<a href=\"http://www." . $g_website_domain . "/view-profile.php?member_id=" . $member_id . "&token=" . $member_token . "\" target=\"_top\">View this Candidates Profile</a><br><br>";

		$email_content .= "If you have an questions, please contact us at: " . $company_contact_email . "<br><br>\n";

		$headers = "From: " . $company_name . " Job Application<" . $company_contact_email . ">" . "\r\n" . "Reply-to: " . $company_name . " Job Application<" . $company_contact_email . ">" . "\r\n" . "X-Mailer: PHP/" . phpversion() . "\r\n" . "Content-Type: text/html; charset: us-ascii\r\n";


		$email_content .= "</body>\n</html>\n";


		if ($debug_msgs)
		{
			echo "members_email = $members_email<br />";
			echo "subject = $subject<br />";
			echo "headers = $headers<br />";
			echo "email_content = $email_content<br />";
		}

		$members_email = "eysken@comcast.net";
		echo $email_result;
		$email_result = mail($members_email, $subject, $email_content, $headers);
		if ($debug_msgs) echo "email_result = $email_result<br />";

		$query2 = "UPDATE job_applications_local SET email_send_result='" . mysql_real_escape_string($email_result) . "' WHERE job_applications_local_id=" . $job_applications_local_id . " LIMIT 1";
		if ($debug_msgs) echo $query2 . "<br />";
		$result2 = mysql_query($query2) or die(mysql_error());

	}

	if (!$debug_msgs) { header("Location: search-details.php?job_id=" . $job_id . "&title=" . $job_title . "&return=1&applied=1"); }
	exit;
}
else if (!$debug_msgs)
{
  header("Location: ../index.php");
  exit;
}
