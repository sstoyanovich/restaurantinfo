<?
session_start(); 
require("bootstrap_v1/incld/db.php");
require_once("bootstrap_v1/incld/utils.php");	
	
$debug_msgs = 0;

$token       		= clean_post_var($_POST["token"]); 
$sid         		= clean_post_var($_POST["sid"]); 
$email  	= clean_post_var($_POST["email"]); 

if ($debug_msgs)
{
	echo "token = $token<br />";	
	echo "session token = " . $_SESSION["token"] . "<br />";	
	echo "sid = $sid<br />";	
	echo "session sid = " . session_id() . "<br />";	
	echo "email = $email<br />";	
}

if ($token && $token == $_SESSION['token'] && $sid && $sid == session_id() && $email)
{
	$query = "INSERT INTO newsletter_signups SET email='" . mysql_real_escape_string($email) . "', date_signed_up=NOW()";
	if ($debug_msgs) echo $query . "<br>";
	$result = mysql_query($query) or die(mysql_error());

	if (!$debug_msgs) { header("Location: index.php?signup=complete"); }
	exit;
}
else
{
  header("Location: index.php");
  exit;
}