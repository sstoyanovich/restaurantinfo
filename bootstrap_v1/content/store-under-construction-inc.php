<?

//echo "stid = " . $_GET["stid"] . "<br />";
if ($_GET["stid"])
{
	$query3 = "SELECT * FROM members WHERE member_id=" . $_GET["stid"];
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	$company_name = stripslashes($rs3->company_name);
	@mysql_free_result($result3);
}
?>
<span style="color:#936; font-size:14px; background-color:#FFC">'<? echo $company_name; ?>' is currently stocking their shop.</span>
<br><br />
In the meantime, please browse some items offered by other artisans<br><br>

<a href="/products.php?id=ALL&clrstid=1">Browse</a>
<br>