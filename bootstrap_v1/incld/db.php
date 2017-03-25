<?
require("/home/sstoyanovich/private/incld/db_def.php");

$db_debug_msgs = 0;

if ($_def_db_host && $_def_db_user && $_def_db_pass && $_def_db_name)
{
	if ($db_debug_msgs) echo "Connecting...<br />";

	$conn_ID = @mysql_connect($_def_db_host, $_def_db_user, $_def_db_pass, true); 
	if (!$conn_ID)
	{
		print ("ERROR: Could not connect to the database, result = ");
		if (mysql_errno())
			printf("%s (%d)<br>", htmlspecialchars(mysql_error()), mysql_errno());
		else
			print(htmlspecialchars($php_errormsg) . "<br><br>");
			
		print("<br>This may have been caused by network congestion.<br>");
		print("Please click the BACK button on your browser and try the operation again.<br>");
		return false;
	}
	else if ($db_debug_msgs)
		echo "Connected<br />";

	if ($db_debug_msgs) echo "Selecting...<br />";

	if (!@mysql_select_db($_def_db_name, $conn_ID))
	{
		print ("ERROR: Could not select the database, result = ");
		if (mysql_errno())
			printf("%s (%d)<br>", htmlspecialchars(mysql_error()), mysql_errno());
		else
			print(htmlspecialchars($php_errormsg) . "<br><br>");
			
		print("<br>This may have been caused by network congestion.<br>");
		print("Please click the BACK button on your browser and try the operation again.<br>");  
		return false;
	}
	else if ($db_debug_msgs)
		echo "Connected<br />";
}

if ($db_debug_msgs) echo "conn_ID = $conn_ID<br />";


function db_query($query7, $display_query=0)
{
	global $g_trace_db_queries, $conn_ID;
	if ($g_trace_db_queries)
		save_trace($query7);
	if ($display_query) echo $query7 . "<br>";
	$result7 = mysql_query($query7, $conn_ID) or die(mysql_error());
	return $result7;
}

