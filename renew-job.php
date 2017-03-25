<?
session_start(); 
require("bootstrap_v1/incld/db.php");
require_once("bootstrap_v1/incld/utils.php");	
	
$debug_msgs = 0;

$token       = clean_post_var($_GET["token"]); 
$sid         = clean_post_var($_GET["sid"]); 
$member_id   = clean_post_var($_GET["member_id"]); 
$job_id      = clean_post_var($_GET["job_id"]); 

if ($debug_msgs)
{
	echo "token = $token<br />";	
	echo "session token = " . $_SESSION["token"] . "<br />";	
	echo "sid = $sid<br />";	
	echo "session sid = " . session_id() . "<br />";	

	echo "member_id = $member_id<br />";	
	echo "job_id = $job_id<br />";	
}

if ($token == $_SESSION['token'] && $sid == session_id() && $member_id && $job_id && $member_id == $_SESSION["member_id"])
{
	$query = "UPDATE jobs SET date_renewed=NOW(), expired=0, times_renewed = times_renewed + 1 WHERE job_id=" . $job_id . " LIMIT 1";
	if ($debug_msgs) echo $query . "<br>";
	$result = mysql_query($query) or die(mysql_error());

	if (!$debug_msgs) { header("Location: /my-jobs.php"); }
	exit;
}
else
{
  header("Location: ../index.php");
  exit;
}
