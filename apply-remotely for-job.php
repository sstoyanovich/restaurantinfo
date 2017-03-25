<?
session_start(); 
require("bootstrap_v1/incld/db.php");
require_once("bootstrap_v1/incld/utils.php");	
	
$debug_msgs = 1;

http://eysdev.com/apply-remotely-for-job.php?job_id=1019&job_code=RJ-1019&member_id=7&token=6c4da56596efe90ff91aafeb9bef7f28dfecd86f&sid=295310b672a4e2f37add39aadb60753e&submit=Apply+for+this+job

$token       		= clean_post_var($_POST["token"]); 
$sid         		= clean_post_var($_POST["sid"]); 

$member_id 			= clean_post_var($_POST["member_id"]);
$job_id	     		= clean_post_var($_POST["jobid"]); 
$job_code     		= clean_post_var($_POST["job_code"]); 


// resume_file

if ($debug_msgs)
{
	echo "token = $token<br />";	
	echo "session token = " . $_SESSION["token"] . "<br />";	
	echo "sid = $sid<br />";	
	echo "session sid = " . session_id() . "<br />";	

	echo "job_code = $job_code<br />";	
	echo "jobid = $jobid<br />";
	echo "member_id = $member_id<br />";
}

if ($token && $token == $_SESSION['token'] && $sid && $sid == session_id() && $member_id && $job_id && $job_code) 
{
	$query = "INSERT INTO job_applications_local ";

	$query .= "SET 
				  enabled='" . mysql_real_escape_string($enabled) . "',  
				  category_id='" . mysql_real_escape_string($category_id) . "',  
				  job_title='" . mysql_real_escape_string($job_title) . "',  
				  job_title_id='" . mysql_real_escape_string($job_title_id) . "',  
				  job_code='" . mysql_real_escape_string($job_code) . "',  
				  
				  apply_locally='" . mysql_real_escape_string($apply_locally) . "',  
				  email_for_job_applies='" . mysql_real_escape_string($email_for_job_applies) . "',  
				  apply_remotely='" . mysql_real_escape_string($apply_remotely) . "',  
				  apply_url='" . mysql_real_escape_string($apply_url) . "',  
				  
				  run_duration='" . mysql_real_escape_string($run_duration) . "',  
				  hourly_rate='" . mysql_real_escape_string($hourly_rate) . "',  
				  salary_min='" . mysql_real_escape_string($salary_min) . "',  
				  salary_max='" . mysql_real_escape_string($salary_max) . "',  
				  tips_min='" . mysql_real_escape_string($tips_min) . "',  
				  tips_max='" . mysql_real_escape_string($tips_max) . "',
				  travel='" . mysql_real_escape_string($travel) . "',
				  description='" . mysql_real_escape_string($description) . "',
				  benefits='" . mysql_real_escape_string($benefits) . "',
				  required_education='" . mysql_real_escape_string($required_education) . "',
				  required_experience='" . mysql_real_escape_string($required_experience) . "',
				  qualifications='" . mysql_real_escape_string($qualifications) . "',
				  meta_description='" . mysql_real_escape_string($meta_description) . "',
				  meta_keywords='" . mysql_real_escape_string($meta_keywords) . "',
				  respond='" . mysql_real_escape_string($respond) . "',
				  contact_name='" . mysql_real_escape_string($contact_name) . "',
				  contact_company='" . mysql_real_escape_string($contact_company) . "',
				  contact_email='" . mysql_real_escape_string($contact_email) . "',
				  contact_url='" . mysql_real_escape_string($contact_url) . "',
				  contact_phone_area_code='" . mysql_real_escape_string($contact_phone_area_code) . "',
				  contact_phone_prefix='" . mysql_real_escape_string($contact_phone_prefix) . "',
				  contact_phone_last_4='" . mysql_real_escape_string($contact_phone_last_4) . "',
				  contact_cell_area_code='" . mysql_real_escape_string($contact_cell_area_code) . "',
				  contact_cell_prefix='" . mysql_real_escape_string($contact_cell_prefix) . "',
				  contact_cell_last_4='" . mysql_real_escape_string($contact_cell_last_4) . "',
				  contact_fax='" . mysql_real_escape_string($contact_fax) . "'";

	if ($jobid)
		$query .= " WHERE id='" . $jobid . "' AND member_id='" . $member_id . "' LIMIT 1";
	else
		$query .= ", member_id='" . mysql_real_escape_string($member_id) . "'";
		
	if ($debug_msgs) echo $query . "<br>";
//	$result = mysql_query($query) or die(mysql_error());


echo "EXITING";
exit;

	
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


	if (!$debug_msgs) { header("Location: my-jobs.php"); }
	exit;
}
else if (!$debug_msgs)
{
  header("Location: ../index.php");
  exit;
}