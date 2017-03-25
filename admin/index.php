<?
session_start();
$_SESSION["store_member_id"] = 1; 
header("Location: /products.php?id=ALL&stid=1");
