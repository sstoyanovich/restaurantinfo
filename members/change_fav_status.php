<?
session_start(); 
require("../bootstrap_v1/incld/db.php");
require_once("../bootstrap_v1/incld/utils.php");	
	
$debug_msgs = 0;
$path_base = "/home/eysdev/public_html/";

$sid         	= clean_post_var($_GET["sid"]); 
$job_id     	= clean_post_var($_GET["job_id"]); 
$status    		= clean_post_var($_GET["status"]); 

$member_id     	= clean_post_var($_SESSION["member_id"]); 
$fav_email	    = clean_post_var($_SESSION["fav_email"]); 

// 	url = "/members/change_fav_status.php?job_id=" + job_id + "&sid=45643245643&member_id=456&status=1

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
	echo "status = $status<br />";	
}

if ($sid && $sid == session_id() && $job_id)
{
	// Is there an entry in the db for this job / member combo?
	
	$query3 = "SELECT favorites_id FROM favorites WHERE job_id=" . $job_id . " AND (session_id='" . mysql_real_escape_string(session_id()) . "' OR member_id='" . $member_id . "' OR email='" . mysql_real_escape_string($fav_email) . "')";
	if ($debug_msgs) echo $query3 . "<br>";
	$result3 = mysql_query($query3) or die(mysql_error());
	$has_entry = (mysql_num_rows($result3)) ? 1 : 0;
	if ($debug_msgs) echo "has_entry = $has_entry<br>";

	if (!$has_entry)
	{
		$query3 = "INSERT INTO favorites SET job_id=" . $job_id . ", session_id='" . mysql_real_escape_string(session_id()) . "', member_id='" . $member_id . "', email='" . mysql_real_escape_string($fav_email) . "'";
		$result3 = mysql_query($query3) or die(mysql_error());
	}
	
	$query3 = "UPDATE favorites SET status=" . $status . " WHERE job_id=" . $job_id . " AND (session_id='" . mysql_real_escape_string(session_id()) . "' OR member_id='" . $member_id . "' OR email='" . mysql_real_escape_string($fav_email) . "')";
	if ($debug_msgs) echo $query3 . "<br>";
	$result = mysql_query($query3) or die(mysql_error());

}
else
{
  header("Location: ../index.php");
  exit;
}