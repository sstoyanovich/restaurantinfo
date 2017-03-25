<?
session_start();
$is_cms = 1;

$_SESSION["logged_in"]     = "";
$_SESSION["email"]         = "";		
$_SESSION["member_id"]     = "";
$_SESSION["member_type"]   = "";

$fwd_url = "index.php";
header("Location: $fwd_url");
