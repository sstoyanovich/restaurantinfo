<?
session_start(); 
require("../bootstrap_v1/incld/db.php");
require_once("../bootstrap_v1/incld/utils.php");	
	
// 	url = /members/change_seeker_fav_status.php?candidate_id=15&sid=abde9598f8a306c27fc40a521ae26521&employer_id=8&status=1

$debug_msgs = 0;

$sid         	= clean_post_var($_GET["sid"]); 
$status    		= clean_post_var($_GET["status"]); 
$candidate_member_id   = clean_post_var($_GET["candidate_id"]); 
$employer_member_id    = clean_post_var($_GET["employer_id"]); 

if (!$candidate_member_id) $candidate_member_id = 0;
if (!$employer_member_id) $employer_member_id = 0;
if (!$status) $status = 0;
if (!$sid) $sid = 0;

if ($debug_msgs)
{
	echo "sid = $sid<br />";	
	echo "session sid = " . session_id() . "<br />";	
	echo "session member_id = " . $_SESSION["member_id"]. "<br />";	
	echo "employer_member_id = $employer_member_id<br />";	
	echo "candidate_member_id = $candidate_member_id<br />";	
	echo "status = $status<br />";	
}

if ($sid && $sid == session_id() && $candidate_member_id && $employer_member_id)
{
	// Is there an entry in the db for this job / member combo?
	
	$query3 = "SELECT favorites_candidates_id FROM favorites_candidates WHERE employer_member_id=" . $employer_member_id . " AND  candidate_member_id='" . $candidate_member_id . "'";
	if ($debug_msgs) echo $query3 . "<br>";
	$result3 = mysql_query($query3) or die(mysql_error());
	$has_entry = (mysql_num_rows($result3)) ? 1 : 0;
	if ($debug_msgs) echo "has_entry = $has_entry<br>";
	if (!$has_entry && $status == 1)
	{
		$query3 = "INSERT INTO favorites_candidates SET employer_member_id=" . $employer_member_id . ",  candidate_member_id='" . $candidate_member_id . "'";
		if ($debug_msgs) echo $query3 . "<br />";
		$result3 = mysql_query($query3) or die(mysql_error());
	}
	else if ($status == 0)
	{
		$query3 = "DELETE FROM favorites_candidates WHERE employer_member_id=" . $employer_member_id . " AND  candidate_member_id='" . $candidate_member_id . "' LIMIT 1";
		if ($debug_msgs) echo $query3 . "<br />";
		$result3 = mysql_query($query3) or die(mysql_error());
	}
}
else
{
  header("Location: ../index.php");
  exit;
}