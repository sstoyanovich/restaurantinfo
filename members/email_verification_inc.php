<?
$debug_msgs = 0;

if ($_GET["id"] && $_GET["token"])
{
	$query = "SELECT first_name,last_name,email FROM members WHERE member_id='" . $_GET["id"] . "' AND token='" . $_GET["token"] . "' LIMIT 1";
	if ($debug_msgs) echo $query . "<br>";
	$result = mysql_query($query) or die("Could not verify member's email address - " . mysql_error() . "<br><br>");
	$found_email = mysql_num_rows($result);
	if ($debug_msgs) echo "found_email = $found_email<br>";
	if ($found_email)
	{
		$rs = mysql_fetch_object($result);
		$first_name = stripslashes($rs->first_name);
		$last_name = stripslashes($rs->last_name);
		$email = stripslashes($rs->email);
		@mysql_free_result($result);

		if ($debug_msgs) echo "first_name = $first_name<br>";
		if ($debug_msgs) echo "last_name = $last_name<br>";
		if ($debug_msgs) echo "email = $email<br>";

		$query = "UPDATE members set email_verified_by_user=1 WHERE member_id=" . $_GET["id"] . " AND token='" . $_GET["token"] . "' LIMIT 1";
		if ($debug_msgs) echo $query . "<br>";
		$result = mysql_query($query) or die("Could not verify member's email address - " . mysql_error() . "<br><br>");
	}
}
?>
<div style="margin:30px;">

<? if ($found_email) { ?>
      <?=$first_name?> <?=$last_name?>, your email address (<?=$email?>) has been verified and your account is now active. <br><br>
      
      To login, <a class="textlink" href="login.php?id=<?=$_GET["id"]?>&token=<?=$_GET["token"]?>">click here</a>. 
      If you have any trouble login into your account, please <a class="textlink" href="../contact.php">contact us</a> and we will be glad to assist you.
      <br>
      <br>
      We hope you enjoy being a member at <?=$g_company_name?>.  <br>
      <br>
<? } else { ?>
      <span class="style1">We're sorry, but we could not find your email address in our database</span>.  <br>
      <br>
    Please <a class="textlink" href="../contact.php">contact us</a> for assistance.
<? } ?>

</div>
