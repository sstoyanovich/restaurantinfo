<?
session_start(); 
require("bootstrap_v1/incld/db.php");
require_once("bootstrap_v1/incld/utils.php");	
	
$debug_msgs = 0;

$token       		= clean_post_var($_GET["token"]); 
$sid         		= clean_post_var($_GET["sid"]); 
$job_id	     		= clean_post_var($_GET["job_id"]); 
$member_id     		= clean_post_var($_GET["member_id"]); 

if ($debug_msgs)
{
	echo "token = $token<br />";	
	echo "session token = " . $_SESSION['token'] . "<br />";	
	echo "job_id = $job_id<br />";	
	echo "member_id   = $member_id<br />";	
}

$query7 = "SELECT job_id FROM jobs WHERE job_id=" . $job_id . " AND member_id=" . $member_id;
if ($debug_msgs) echo $query7 . "<br>";
$result7 = mysql_query($query7) or die(mysql_error());
$this_is_mine = mysql_num_rows($result7);
if ($debug_msgs) echo "this_is_mine  = $this_is_mine<br />";	

if ($this_is_mine && $_SESSION['logged_in'] && $job_id && $member_id && $member_id == $_SESSION["member_id"])
{  
	  $query7 = "DELETE FROM jobs WHERE job_id=" . $job_id . " LIMIT 1";
	  if ($debug_msgs) echo $query7 . "<br>";
	  $result7 = mysql_query($query7) or die(mysql_error());
  }

$return_url = "/my-jobs.php?deleted=1";
if ($debug_msgs) 
	echo "would normally return to: $return_url...<br />";
else
{ header("Location: " . $return_url); }
exit;
