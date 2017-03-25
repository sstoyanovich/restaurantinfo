<?
session_start(); 
require("../bootstrap_v1/incld/db.php");
require_once("../bootstrap_v1/incld/utils.php");	
	
$debug_msgs = 0;
$sid         	= clean_post_var($_GET["sid"]); 
$job_id     	= clean_post_var($_GET["job_id"]); 

$member_id     	= clean_post_var($_SESSION["member_id"]); 
$fav_email	    = clean_post_var($_SESSION["fav_email"]); 

if (!$job_id) $job_id = 0;
if (!$member_id) $member_id = 0;
if (!$status) $status = 0;
if (!$fav_email) $fav_email = '';

if ($debug_msgs)
{
	echo "sid = $sid<br />";	
	echo "session sid = " . session_id() . "<br />";	
	echo "session fav_email = " . $_SESSION["fav_email"] . "<br />";	
	echo "session member_id = " . $_SESSION["member_id"]. "<br />";	

	echo "member_id = $member_id<br />";	
	echo "job_id = $job_id<br />";	
}

if ($sid && $sid == session_id() && $job_id)
{
	$query3 = "DELETE FROM job_applications_local WHERE job_id=" . $job_id . " AND candidate_member_id='" . $member_id . "'";
	if ($debug_msgs) echo $query3 . "<br>";
	$result = mysql_query($query3) or die(mysql_error());

	$query3 = "DELETE FROM job_applications_remote WHERE job_id=" . $job_id . " AND candidate_member_id='" . $member_id . "'";
	if ($debug_msgs) echo $query3 . "<br>";
	$result = mysql_query($query3) or die(mysql_error());
}

if (!$debug_msgs)
 	header("Location: /my-jobs.php");
