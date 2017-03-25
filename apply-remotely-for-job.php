<?
session_start(); 
require("bootstrap_v1/incld/db.php");
require_once("bootstrap_v1/incld/utils.php");	
	
$debug_msgs = 0;

//http://eysdev.com/apply-remotely-for-job.php?job_id=1019&job_code=RJ-1019&member_id=7&token=6c4da56596efe90ff91aafeb9bef7f28dfecd86f&sid=295310b672a4e2f37add39aadb60753e&submit=Apply+for+this+job

$token       		= clean_post_var($_GET["token"]); 
$sid         		= clean_post_var($_GET["sid"]); 

$member_id 			= clean_post_var($_GET["member_id"]);
$job_id	     		= clean_post_var($_GET["job_id"]); 
$job_code     		= clean_post_var($_GET["job_code"]); 


// resume_file

if ($debug_msgs)
{
	echo "token = $token<br />";	
	echo "session token = " . $_SESSION["token"] . "<br />";	
	echo "sid = $sid<br />";	
	echo "session sid = " . session_id() . "<br />";	

	echo "job_code = $job_code<br />";	
	echo "job_id = $job_id<br />";
	echo "member_id = $member_id<br />";
}

if ($token && $token == $_SESSION['token'] && $sid && $sid == session_id() && $member_id && $job_id && $job_code) 
{
	$query3 = "SELECT apply_url,member_id FROM jobs WHERE apply_remotely=1 AND job_id='" . mysql_real_escape_string($job_id) . "'";
	if ($debug_msgs) echo $query3 . "<br />";
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	$apply_url = stripslashes($rs3->apply_url);
	$employer_member_id = stripslashes($rs3->member_id);
	@mysql_free_result($result3);
	if ($debug_msgs) echo "apply_url = $apply_url<br />";
	if ($apply_url)
	{
		if (!strstr($apply_url, "http:") && !strstr($apply_url, "https://"))
			$apply_url = "http://" . $apply_url;
			
		$query = "INSERT INTO job_applications_remote SET 
					  candidate_member_id='" . mysql_real_escape_string($member_id) . "',  
					  employer_member_id='" . mysql_real_escape_string($employer_member_id) . "',  
					  job_id='" . mysql_real_escape_string($job_id) . "',  
					  job_code='" . mysql_real_escape_string($job_code) . "',
					  apply_url='" . mysql_real_escape_string($apply_url) . "',
					  date_applied=NOW(),
					  time_applied=NOW(),
					  unix_time_applied='" . time() . "'";
		if ($debug_msgs) echo $query . "<br>";
		$result = mysql_query($query) or die(mysql_error());
	
		if (!$debug_msgs) { header("Location: $apply_url"); }
		exit;
	}
}
else if (!$debug_msgs)
{
  header("Location: ../index.php");
  exit;
}