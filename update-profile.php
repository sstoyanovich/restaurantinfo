<?
session_start(); 
require("bootstrap_v1/incld/db.php");
require_once("bootstrap_v1/incld/utils.php");	
	
$debug_msgs = 0;
$path_base = "/home/eysdev/public_html/";

$token       			= clean_post_var($_POST["token"]); 
$sid         			= clean_post_var($_POST["sid"]); 
$admin_edit       		= clean_post_var($_POST["admin_edit"]); 
$member_id     			= clean_post_var($_POST["member_id"]); 
$member_token     		= clean_post_var($_POST["member_token"]); 
$job_title_id     		= clean_post_var($_POST["job_title_id"]); 
$job_title     			= clean_post_var($_POST["job_title"]); 
$years_experience   	= clean_post_var($_POST["years_experience"]); 
$show_profile       	= ($_POST["show_profile"]) ? 1 : 0;
$profile_bio     		= clean_post_var($_POST["profile_bio"], 1); 
$work_experience    	= clean_post_var($_POST["work_experience"], 1); 
$education     			= clean_post_var($_POST["education"], 1); 
$key_words     			= clean_post_var($_POST["key_words"]); 
$required_hourly_rate   = clean_post_var($_POST["required_hourly_rate"]); 
$required_salary  		= clean_post_var($_POST["required_salary"]); 

if ($debug_msgs)
{
	echo "token = $token<br />";	
	echo "session token = " . $_SESSION["token"] . "<br />";	
	echo "sid = $sid<br />";	
	echo "session sid = " . session_id() . "<br />";	

	echo "member_id = $member_id<br />";	
	echo "member_token = $member_token<br />";	
	echo "job_title_id = $job_title_id<br />";	
	echo "job_title = $job_title<br />";	
	echo "years_experience = $years_experience<br />";	
	echo "show_profile = $show_profile<br />";	
	echo "profile_bio = $profile_bio<br />";	
	echo "required_hourly_rate = $required_hourly_rate<br />";	
	echo "required_salary = $required_salary<br />";	
}

if ($token && $token == $_SESSION['token'] && $sid && $sid == session_id() && $member_id)
{
	$query = "UPDATE members SET 
							  show_profile='" . mysql_real_escape_string($show_profile) . "',  
							  job_title_id='" . mysql_real_escape_string($job_title_id) . "',  
							  job_title='" . mysql_real_escape_string($job_title) . "',  
							  years_experience='" . mysql_real_escape_string($years_experience) . "',  
							  required_hourly_rate='" . mysql_real_escape_string($required_hourly_rate) . "',  
							  required_salary='" . mysql_real_escape_string($required_salary) . "',  
							  profile_bio='" . mysql_real_escape_string($profile_bio) . "',
							  work_experience='" . mysql_real_escape_string($work_experience) . "',
							  education='" . mysql_real_escape_string($education) . "',
							  key_words='" . mysql_real_escape_string($key_words) . "',
							  show_profile='" . mysql_real_escape_string($show_profile) . "'";
		$query .= " WHERE member_id=" . $member_id . " LIMIT 1";
	if ($debug_msgs) echo $query . "<br>";
	$result = mysql_query($query) or die(mysql_error());

	//*******************************************************************
	// Deleting company logo?
	//*******************************************************************
	
	if ($debug_msgs) echo "delete_company_logo = " . $_POST["delete_company_logo"] . "<br />";
	
	if ($_POST["delete_company_logo"] == 1)
	{
		$query = "SELECT company_logo FROM members WHERE member_id=" . $member_id;
		if ($debug_msgs) echo $query . "<br>"; 
		$result = mysql_query($query) or die("Could not get company_logo - " . mysql_error() . "<br><br>");
		$rs = mysql_fetch_object($result);
		$company_logo = stripslashes($rs->company_logo);
		@mysql_free_result($result);
	
		if ($company_logo)
		{
			$img_path = $path_base . "/company_logos/" . $company_logo;
			if ($debug_msgs) echo "deleting image at: $img_path...<br />";
			@unlink($img_path);	
		}	

		$query = "UPDATE members SET company_logo='' WHERE member_id=" . $member_id . " LIMIT 1";
		if ($debug_msgs) echo str_replace(",", ",<br>", $query) . "<br />";
		$result = mysql_query($query) or die(mysql_error());
	}	

	//*******************************************************************
	// Deleting Profile PHoto?
	//*******************************************************************
	
	if ($debug_msgs) echo "delete_profile_photo = " . $_POST["delete_profile_photo"] . "<br />";
	
	if ($_POST["delete_profile_photo"] == 1)
	{
		$query = "SELECT profile_photo FROM members WHERE member_id=" . $member_id;
		if ($debug_msgs) echo $query . "<br>"; 
		$result = mysql_query($query) or die("Could not get profile_photo - " . mysql_error() . "<br><br>");
		$rs = mysql_fetch_object($result);
		$profile_photo = stripslashes($rs->profile_photo);
		@mysql_free_result($result);
	
		if ($profile_photo)
		{
			$img_path = $path_base . "/profile_photos/" . $profile_photo;
			if ($debug_msgs) echo "deleting image at: $img_path...<br />";
			@unlink($img_path);	
		}	

		$query = "UPDATE members SET profile_photo='' WHERE member_id=" . $member_id . " LIMIT 1";
		if ($debug_msgs) echo str_replace(",", ",<br>", $query) . "<br />";
		$result = mysql_query($query) or die(mysql_error());
	}	

	//*******************************************************************
	// Deleting Resume?
	//*******************************************************************
	
	if ($debug_msgs) echo "delete_resume_file = " . $_POST["delete_resume_file"] . "<br />";
	
	if ($_POST["delete_resume_file"] == 1)
	{
		$query = "SELECT resume_file FROM members WHERE member_id=" . $member_id;
		if ($debug_msgs) echo $query . "<br>"; 
		$result = mysql_query($query) or die("Could not get resume_file - " . mysql_error() . "<br><br>");
		$rs = mysql_fetch_object($result);
		$resume_file = stripslashes($rs->resume_file);
		@mysql_free_result($result);
	
		if ($resume_file)
		{
			$img_path = $path_base . "/resumes/" . $resume_file;
			if ($debug_msgs) echo "deleting image at: $img_path...<br />";
			@unlink($img_path);	
		}	

		$query = "UPDATE members SET resume_file='' WHERE member_id=" . $member_id . " LIMIT 1";
		if ($debug_msgs) echo str_replace(",", ",<br>", $query) . "<br />";
		$result = mysql_query($query) or die(mysql_error());
	}	

	//*******************************************************************
	// Uploaded company logo?
	//*******************************************************************
	
	if ($_FILES['company_logo']['name'])
	{
		$filename = "company_logo_" . $member_id . ".jpg";	
		if (strlen($filename) > 30)
		{
			list($filename, $fileext) = explode(".", $filename);
			$length_of_extension = strlen($fileext);
			$filename = substr($filename, 0, 30 - $length_of_extension);
			$filename = $filename . "." . $fileext;
		}
		
		$dest = $path_base . "company_logos/" . $filename;
		$r = move_uploaded_file ($_FILES['company_logo']['tmp_name'], $dest);
		if ($debug_msgs) echo "Moving " . $_FILES['company_logo']['tmp_name'] . " to $dest;<br />";

		$query = "UPDATE members SET company_logo='" . $filename . "' WHERE member_id=" . $member_id . " LIMIT 1";
		if ($debug_msgs) echo str_replace(",", ",<br>", $query) . "<br />";
		$result = mysql_query($query) or die(mysql_error());
	}			

	//*******************************************************************
	// Uploaded Profile PHoto?
	//*******************************************************************
	
	if ($_FILES['profile_photo']['name'])
	{
		$filename = "profile_photo_" . $member_id . ".jpg";	
		if (strlen($filename) > 30)
		{
			list($filename, $fileext) = explode(".", $filename);
			$length_of_extension = strlen($fileext);
			$filename = substr($filename, 0, 30 - $length_of_extension);
			$filename = $filename . "." . $fileext;
		}
		
		$dest = $path_base . "profile_photos/" . $filename;
		$r = move_uploaded_file ($_FILES['profile_photo']['tmp_name'], $dest);
		if ($debug_msgs) echo "Moving " . $_FILES['profile_photo']['tmp_name'] . " to $dest;<br />";

		$query = "UPDATE members SET profile_photo='" . $filename . "' WHERE member_id=" . $member_id . " LIMIT 1";
		if ($debug_msgs) echo str_replace(",", ",<br>", $query) . "<br />";
		$result = mysql_query($query) or die(mysql_error());
	}			

	//*******************************************************************
	// Uploaded resume?
	//*******************************************************************
	
	if ($_FILES['resume_file']['name'])
	{
		if (strstr($_FILES['resume_file']['name'], ".pdf"))
			$extension = ".pdf";
		else if (strstr($_FILES['resume_file']['name'], ".doc"))
			$extension = ".doc";
		else 
			$extension = ".txt";
			
		$filename = "resume_file_" . $member_id . $extension;	
		if (strlen($filename) > 30)
		{
			list($filename, $fileext) = explode(".", $filename);
			$length_of_extension = strlen($fileext);
			$filename = substr($filename, 0, 30 - $length_of_extension);
			$filename = $filename . "." . $fileext;
		}
		
		$dest = $path_base . "resumes/" . $filename;
		$r = move_uploaded_file ($_FILES['resume_file']['tmp_name'], $dest);
		if ($debug_msgs) echo "Moving " . $_FILES['resume_file']['tmp_name'] . " to $dest;<br />";

		$query = "UPDATE members SET resume_upload_date=NOW(), resume_file='" . $filename . "' WHERE member_id=" . $member_id . " LIMIT 1";
		if ($debug_msgs) echo str_replace(",", ",<br>", $query) . "<br />";
		$result = mysql_query($query) or die(mysql_error());
	}			

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