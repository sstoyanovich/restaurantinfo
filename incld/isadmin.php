<?
if ($_SESSION["member_type"] != "A")
{
	header("Location: /login.php");
	exit;
}
