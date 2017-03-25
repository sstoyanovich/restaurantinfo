<?
session_start(); 
require("../bootstrap_v1/incld/db.php");
$debug_msgs = 1;

for ($loop_counter == 1; $loop_counter <= 2; $loop_counter++)
{
	switch ($loop_counter)
	{
		case 1:		$scrub_counter = "China"; break;
		case 2:		$scrub_counter = "Vietnam"; break;
	}
	
	if (!$scrub_counter)
		continue;
	
	$query2 = "SELECT * FROM pages_viewed WHERE location LIKE '%" . $scrub_counter . "%' AND ip_address <> ''";
	if ($debug_msgs) echo $query2 . "<br>";
	$result2 = mysql_query($query2) or die(mysql_error());
	$num_found = mysql_num_rows($result2);
	if ($debug_msgs) echo "num_found =  $num_found<br>";
	
	if ($num_found)
	{
		while ($rs2 = mysql_fetch_object($result2))
		{
			$id = stripslashes($rs2->id);
			$location = stripslashes($rs2->location);
			$ip_address = stripslashes($rs2->ip_address);
			
			echo "$id, $ip_address, $location<br>";
	
			if (!$ip_address || !$location)
				continue;
			
			// see if this IP address is already in the block table
		
			$query3 = "SELECT ip_addresses_to_block_id FROM ip_addresses_to_block WHERE ip_address='" . mysql_real_escape_string($ip_address) . "'";
			if ($debug_msgs) echo $query3 . "<br>";
			$result3 = mysql_query($query3) or die(mysql_error());
			$have_this_ip = mysql_num_rows($result3);
			if (!$have_this_ip)
			{
				$query3 = "INSERT INTO ip_addresses_to_block SET ip_address='" . mysql_real_escape_string($ip_address) . "', location='" . mysql_real_escape_string($location) . "'";
				echo $query3 . "<br>";
				$result3 = mysql_query($query3) or die(mysql_error());
			}
		
			$query3 = "DELETE FROM pages_viewed WHERE id='" . $id . "' LIMIT 1";
			if ($debug_msgs) echo $query3 . "<br>";
			$result3 = mysql_query($query3) or die(mysql_error());
		}
		@mysql_free_result($result2);
	}
}


$query2 = "SELECT ip_address,location FROM ip_addresses_to_block WHERE scrubbed=0 ORDER BY ip_address";
if ($debug_msgs) echo $query2 . "<br>";
$result2 = mysql_query($query2) or die(mysql_error());
while ($rs2 = mysql_fetch_object($result2))
{
	$ip_address = stripslashes($rs2->ip_address);
	$location = stripslashes($rs2->location);

	echo "'" . $ip_address . "',  " . $location . "  <br>";
}

$query2 = "UPDATE ip_addresses_to_block SET scrubbed=1";
if ($debug_msgs) echo $query2 . "<br>";
$result2 = mysql_query($query2) or die(mysql_error());


