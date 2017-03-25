<?
$member_id = $_SESSION["member_id"];
if (!$member_id || !$_SESSION["logged_in"])
{
	?>Your login session may have expired.  <a href="https://restaurantinfo.com/login.php">Please login again</a><br /><?
}
else
{
	$query2 = "SELECT member_settings_id FROM member_settings WHERE member_id='" . mysql_real_escape_string($member_id) . "'";
	$result2 = mysql_query($query2) or die(mysql_error());
	$has_entry = mysql_num_rows($result2);
	if (!$has_entry)
	{
		$query2 = "INSERT INTO member_settings SET member_id='" . mysql_real_escape_string($member_id) . "'";
		$result2 = mysql_query($query2) or die(mysql_error());
	}
	
	$query3 = "SELECT * FROM member_settings WHERE member_id='" . mysql_real_escape_string($member_id) . "'";
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	$setting1 = stripslashes($rs3->setting1);
	@mysql_free_result($result3);

	if (!$_SESSION["token"])
		$_SESSION["token"] = sha1(uniqid(rand(), TRUE)); 
?>
    
    <strong>SETTINGS TBD</strong><br /><br />
    
    <br />

  <? } ?> 
   
