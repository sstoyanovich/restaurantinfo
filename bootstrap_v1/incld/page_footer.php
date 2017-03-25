<?  date_default_timezone_set("America/Los_Angeles"); ?>

<? if (!$_SESSION["logged_in"]) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr style="background-image:url(/images/footer-bkgnd2.jpg); background-repeat:repeat-x; height:25px;"> 
    <td height="25" align="center"> 
		<a href="/index.php" class="topnavlink">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<a href="/privacy.php" class="topnavlink">Privacy</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="/contact.php" class="topnavlink">Contact</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<? /* <a href="/affiliates.php" class="topnavlink">Affiliates</a> */ ?>
    </td>
  </tr>
</table>

<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" width="100%" style="font-size:10px;">Copyright &copy; <? echo date("Y"); ?> restaurantinfo.com. &nbsp;All rights reserved.</td>
  </tr>
</table>
<? } ?>
<br /><br />
<?
if ($_GET["ksdb"] == 735 || $_SESSION["member_id"] == 1097) 
{
	echo "logged_in = " . $_SESSION["logged_in"]    . "<br>";
	echo "email = " . $_SESSION["email"]        . "<br>";		
	echo "member_id = " . $_SESSION["member_id"]    . "<br>";
	echo "member_type = " . $_SESSION["member_type"]  . "<br>";
	echo "member_name = " . $_SESSION["member_name"]  . "<br>";
	echo "store_member_id = " . $_SESSION["store_member_id"] . "<br />";
	echo "sid = " . session_id() . "<br />";
}
