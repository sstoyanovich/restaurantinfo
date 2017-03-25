<?
session_start(); 
require("incld/isloggedin.php");
require("incld/isadmin.php");
require("bootstrap_v1/incld/db.php");
require_once("bootstrap_v1/incld/utils.php");	
	
$debug_msgs = 0;

$adm       			= clean_post_var($_GET["adm"]); 
$member_token       = clean_post_var($_GET["mt"]); 
$token         		= clean_post_var($_GET["tk"]); 
$member_id     		= clean_post_var($_GET["id"]); 

if ($debug_msgs)
{
	echo "token = $token<br />";	
	echo "session token = " . $_SESSION['token'] . "<br />";	
	echo "adm   = $adm<br />";	
	echo "member_id   = $member_id<br />";	
	echo "member_token   = $member_token<br />";	
}


$query7 = "SELECT member_id FROM members WHERE member_id=" . $member_id . " AND token='" .mysql_real_escape_string($member_token) . "'";
if ($debug_msgs) echo $query7 . "<br>";
$result7 = mysql_query($query7) or die(mysql_error());
$mid_and_token_valid = mysql_num_rows($result7);
if ($debug_msgs) echo "mid_and_token_valid  = $mid_and_token_valid<br />";	

if ($mid_and_token_valid && $_SESSION['logged_in'] && $member_id && $_SESSION["member_id"] == 1)
{  
	  $query7 = "DELETE FROM members WHERE member_id=" . $member_id . " LIMIT 1";
	  if ($debug_msgs) echo $query7 . "<br>";
	  $result7 = mysql_query($query7) or die(mysql_error());
  }

$return_url = "/members.php?deleted=1";
if ($debug_msgs) 
	echo "would normally return to: $return_url...<br />";
else
{ header("Location: " . $return_url); }
exit;
