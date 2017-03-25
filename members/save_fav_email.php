<?
session_start(); 
require("../bootstrap_v1/incld/db.php");
require_once("../bootstrap_v1/incld/utils.php");	
	
$debug_msgs = 0;
$path_base = "/home/eysdev/public_html/";

$sid         		= clean_post_var($_POST["sid"]); 
$token         		= clean_post_var($_POST["token"]); 
$ksdb         		= clean_post_var($_POST["ksdb"]); 
$search_type	    = clean_post_var($_POST["search_type"]); 
$search_terms	    = clean_post_var($_POST["search_terms"]); 
$state	     		= clean_post_var($_POST["state"]); 
$category	     	= clean_post_var($_POST["category"]); 
$job_title_id	    = clean_post_var($_POST["job_title_id"]); 
$job_title	     	= clean_post_var($_POST["job_title"]); 
$hourly_rate	    = clean_post_var($_POST["hourly_rate"]); 
$salary_min	     	= clean_post_var($_POST["salary_min"]); 
$salary_max	     	= clean_post_var($_POST["salary_max"]); 
$years_min	     	= clean_post_var($_POST["years_min"]); 
$years_max	     	= clean_post_var($_POST["years_max"]); 
$fav_email	    = clean_post_var($_POST["fav_email"]); 
if (!$fav_email) $fav_email = '';
$_SESSION["fav_email"] = $fav_email;


if ($debug_msgs)
{
	echo "token = $token<br />";	
	echo "sid = $sid<br />";	
	echo "session sid = " . session_id() . "<br />";	
	echo "ksdb = $ksdb<br />";	

	echo "search_type = $search_type<br />";	
	echo "search_terms = $search_terms<br />";	
	echo "state = $state<br />";	
	echo "category = $category<br />";	
	echo "job_title_id = $job_title_id<br />";	
	echo "job_title = $job_title<br />";	
	echo "hourly_rate = $hourly_rate<br />";	
	echo "salary_min = $salary_min<br />";	
	echo "salary_max = $salary_max<br />";	
	echo "years_min = $years_min<br />";	
	echo "years_max = $years_max<br />";	
	echo "fav_email = $fav_email<br />";	
}

if ($sid && $sid == session_id() && $fav_email)
{
	// If there were any favorites saved during this current session, update them with the email address.
	
	$query3 = "UPDATE favorites SET email='" . mysql_real_escape_string($fav_email) . "' WHERE session_id='" . mysql_real_escape_string(session_id()) . "'";
	if ($debug_msgs) echo $query3 . "<br>";
	$result = mysql_query($query3) or die(mysql_error());
	$num_new_favorites = mysql_affected_rows();
	if ($debug_msgs) echo "num_new_favorites = $num_new_favorites<br>";

	// If there were any PREVIOUS favorites, update them so they have the same session ID as the current one.
	
	$query3 = "UPDATE favorites SET session_id='" . mysql_real_escape_string($sid) . "' WHERE email='" . mysql_real_escape_string($fav_email) . "'";
	if ($debug_msgs) echo $query3 . "<br>";
	$result = mysql_query($query3) or die(mysql_error());
	$num_old_favorites = mysql_affected_rows();
	if ($debug_msgs) echo "num_old_favorites = $num_old_favorites<br>";

	// If no previous ones, or no new ones yet, just put a placeholder in the db.

	if (!$num_new_favorites && !$num_old_favorites)
	{
		$query3 = "SELECT favorites_id FROM favorites WHERE job_id=0 AND (session_id='" . mysql_real_escape_string(session_id()) . "' OR email='" . mysql_real_escape_string($fav_email) . "')";
		if ($debug_msgs) echo $query3 . "<br>";
		$result3 = mysql_query($query3) or die(mysql_error());
		$has_entry = (mysql_num_rows($result3)) ? 1 : 0;
		if ($debug_msgs) echo "has_entry = $has_entry<br>";
		if (!$has_entry)
		{
			$query3 = "INSERT INTO favorites SET job_id=0, session_id='" . mysql_real_escape_string(session_id()) . "', email='" . mysql_real_escape_string($fav_email) . "'";
			if ($debug_msgs) echo $query3 . "<br>";
			$result3 = mysql_query($query3) or die(mysql_error());
		}
	}
	
	// See if this member has registerd, if so, update the member ID.

	$query3 = "SELECT member_id FROM members WHERE email='" . mysql_real_escape_string($fav_email) . "'";
	if ($debug_msgs) echo $query3 . "<br>";
	$result3 = mysql_query($query3) or die(mysql_error());
	$is_a_member = (mysql_num_rows($result3)) ? 1 : 0;
	if ($debug_msgs) echo "is_a_member = $is_a_member<br>";
	if ($is_a_member)
	{
		$rs3 = mysql_fetch_object($result3);
		$member_id = stripslashes($rs3->member_id);
		@mysql_free_result($result3);
		
		$query3 = "UPDATE favorites SET member_id='" . mysql_real_escape_string($member_id) . "' WHERE email='" . mysql_real_escape_string($fav_email) . "'";
		if ($debug_msgs) echo $query3 . "<br>";
		$result = mysql_query($query3) or die(mysql_error());
		$_SESSION["member_id"] = $member_id;
	}
}

$return_url = 	"http://eysdev.com/search.php?token=" . $token . "&sid=" . $sid . "&search_type=" . $search_type . "&search_terms=" . $search_terms . "&job_title_id=" . $job_title_id . "&job_title=" . $job_title . "&state=" . $state . "&hourly_rate=" . $hourly_rate . "&salary_min=" . $salary_min . "&salary_max=" . $salary_max . "&years_min=" . $years_min . "&years_max=" . $years_max . "&submit=Search&ksdb=" . $ksdb;

if (!$debug_msgs)
	header("Location: " . $return_url);
else
	echo "return_url = $return_url<br />";