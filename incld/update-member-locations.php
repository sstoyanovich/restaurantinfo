<?
session_start(); 
require("../bootstrap_v1/incld/db.php");

$query2 = "SELECT * FROM members WHERE location=''";
if ($debug_msgs) echo $query2 . "<br>";
$result2 = mysql_query($query2) or die(mysql_error());
while ($rs2 = mysql_fetch_object($result2))
{
	$ip_address = stripslashes($rs2->ip_address);
	echo "ip_address = $ip_address<br>";
	
	if ($ip_address)
	{
		$tags = json_decode(file_get_contents('http://getcitydetails.geobytes.com/GetCityDetails?fqcn='. $ip_address), true);
		echo "location = " . $tags["geobytesfqcn"] . "<br />";

		$query3 = "UPDATE members category_selections SET location='" . mysql_real_escape_string($tags["geobytesfqcn"]) . "' WHERE member_id=" . $rs2->member_id;
		echo $query3 . "<br>";
		$result3 = mysql_query($query3) or die(mysql_error());
	}
}
@mysql_free_result($result2);


