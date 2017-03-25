<?
if (isset($_SERVER['HTTPS']) || $_SERVER["HTTPS"] == "on")
	$is_ssl = 1;
else
	$is_ssl = 0;
	
if ($_SESSION["logged_in"] != "logged_in" || !$_SESSION["member_id"])
{
	header("Location: /login.php");
	exit;
}
