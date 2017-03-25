<?
session_start(); 
require("bootstrap_v1/incld/db.php");
require_once("bootstrap_v1/incld/utils.php");	
	
$debug_msgs = 0;

$token       		= clean_post_var($_POST["token"]); 
$sid         		= clean_post_var($_POST["sid"]); 

$category_id 		= clean_post_var($_POST["category_id"]);
$job_id	     		= clean_post_var($_POST["job_id"]); 
$member_id     		= clean_post_var($_POST["member_id"]); 

$job_title = clean_post_var($_POST["job_title"]);
$job_title_id = clean_post_var($_POST["job_title_id"]);
$job_code = clean_post_var($_POST["job_code"]);
$city = clean_post_var($_POST["city"]);
$state = clean_post_var($_POST["state"]);
$enabled = ($_POST["enabled"]) ? 1 : 0;

$apply_locally = ($_POST["apply_locally"]) ? 1 : 0;
$email_for_job_applies = clean_post_var($_POST["email_for_job_applies"]);
$apply_remotely = ($_POST["apply_remotely"]) ? 1 : 0;
$apply_url = clean_post_var($_POST["apply_url"]);

$run_duration = clean_post_var($_POST["run_duration"]);
$hourly_rate = clean_post_var($_POST["hourly_rate"]);
$salary_min = clean_post_var($_POST["salary_min"]);
$salary_max = clean_post_var($_POST["salary_max"]);
$tips_min = clean_post_var($_POST["tips_min"]);
$tips_max = clean_post_var($_POST["tips_max"]);

$travel = clean_post_var($_POST["travel"]);
$benefits = clean_post_var($_POST["benefits"]);
$description = clean_post_var($_POST["description"]);
$required_education = clean_post_var($_POST["required_education"]);
$required_experience = clean_post_var($_POST["required_experience"]);
$qualifications = clean_post_var($_POST["qualifications"]);
$meta_description = clean_post_var($_POST["meta_description"]);
$meta_keywords = clean_post_var($_POST["meta_keywords"]);
$respond = clean_post_var($_POST["respond"]);

$contact_name = clean_post_var($_POST["contact_name"]);
$contact_company = clean_post_var($_POST["contact_company"]);
$contact_email = clean_post_var($_POST["contact_email"]);
$contact_url = clean_post_var($_POST["contact_url"]);
$contact_phone_area_code = clean_post_var($_POST["contact_phone_area_code"]);
$contact_phone_prefix = clean_post_var($_POST["contact_phone_prefix"]);
$contact_phone_last_4 = clean_post_var($_POST["contact_phone_last_4"]);
$contact_cell_area_code = clean_post_var($_POST["contact_cell_area_code"]);
$contact_cell_prefix = clean_post_var($_POST["contact_cell_prefix"]);
$contact_cell_last_4 = clean_post_var($_POST["contact_cell_last_4"]);
$contact_fax = clean_post_var($_POST["contact_fax"]);

if ($category_id == 0) $category_id = 1;
if (!$run_duration) $run_duration = 0;
if (!$hourly_rate) $hourly_rate = 0;
if (!$salary_min) $salary_min = 0;
if (!$salary_max) $salary_max = 0;
if (!$tips_min) $tips_min = 0;
if (!$tips_max) $tips_max = 0;

if ($debug_msgs)
{
	echo "token = $token<br />";	
	echo "session token = " . $_SESSION["token"] . "<br />";	
	echo "sid = $sid<br />";	
	echo "session sid = " . session_id() . "<br />";	

	echo "category_id = $category_id<br />";	
	echo "job_id = $job_id<br />";
	echo "member_id = $member_id<br />";
	
	echo "job_title = $job_title<br />";	
	echo "job_code = $job_code<br />";	
	echo "city = $city<br />";	
	echo "state = $state<br />";	
	
	echo "apply_locally = $apply_locally<br />";	
	echo "email_for_job_applies = $email_for_job_applies<br />";	
	echo "apply_remotely = $apply_remotely<br />";	
	echo "apply_url = $apply_url<br />";	

	echo "run_duration = $run_duration<br />";	
	echo "hourly_rate = $hourly_rate<br />";	
	echo "salary_min = $salary_min<br />";	
	echo "salary_max = $salary_max<br />";	
	echo "tips_min = $tips_min<br />";	
	echo "tips_max = $tips_max<br />";	
	echo "travel = $travel<br />";	
	echo "benefits = $benefits<br />";	
	echo "qualifications = $qualifications<br />";	
	echo "respond = $respond<br />";	

	echo "contact_name = $contact_name<br />";	
	echo "contact_company = $contact_company<br />";	
	echo "contact_email = $contact_email<br />";	
	echo "contact_url = $contact_url<br />";	
	echo "contact_phone = $contact_phone<br />";	
	echo "contact_cell_phone = $contact_cell_phone<br />";	
	echo "contact_fax = $contact_fax<br />";	
}

if ($token && $token == $_SESSION['token'] && $sid && $sid == session_id() && $member_id) 
{
	if ($job_id)
		$query = "UPDATE jobs ";
	else
		$query = "INSERT INTO jobs ";

	$query .= "SET 
				  enabled='" . mysql_real_escape_string($enabled) . "',  
				  category_id='" . mysql_real_escape_string($category_id) . "',  
				  job_title='" . mysql_real_escape_string($job_title) . "',  
				  job_title_id='" . mysql_real_escape_string($job_title_id) . "',  
				  job_code='" . mysql_real_escape_string($job_code) . "',  
				  city='" . mysql_real_escape_string($city) . "',  
				  state='" . mysql_real_escape_string($state) . "',  
				  
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

	if ($job_id)
		$query .= " WHERE job_id='" . $job_id . "' AND member_id='" . $member_id . "' LIMIT 1";
	else
		$query .= ", date_listed=NOW(), member_id='" . mysql_real_escape_string($member_id) . "'";
		
	if ($debug_msgs) echo $query . "<br>";
	$result = mysql_query($query) or die(mysql_error());
	
	if (!$job_id)
		$job_id = mysql_insert_id();

	if (!$job_code)
	{
		$job_code = "RJ-" . $job_id;
		$query2 = "UPDATE jobs SET job_code='" . mysql_real_escape_string($job_code) . "' WHERE job_id=" . $job_id;
		$result2 = mysql_query($query2) or die(mysql_error());
	}

	if (!$debug_msgs) { header("Location: my-jobs.php"); }
	exit;
}
else if (!$debug_msgs)
{
  header("Location: ../index.php");
  exit;
}