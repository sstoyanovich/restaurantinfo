<?
session_start(); 
require("../bootstrap_v1/incld/db.php");
require_once("../bootstrap_v1/incld/utils.php");	
	
$debug_msgs = 1;

$query2 = "SELECT job_id,run_duration,date_listed,date_renewed FROM jobs WHERE expired=0 AND archived=0 ORDER BY job_id";
$result2 = mysql_query($query2) or die(mysql_error());
$num_found = mysql_num_rows($result2);
if ($debug_msgs) echo "num_found = $num_found<br />";
while ($rs2 = mysql_fetch_object($result2))
{
	$job_id = stripslashes($rs2->job_id);
	$date_listed = stripslashes($rs2->date_listed);
	$date_renewed = stripslashes($rs2->date_renewed);
	$run_duration = stripslashes($rs2->run_duration);

	if ($date_renewed != '0000-00-00') 
	{
		$query4 = "SELECT DATE_ADD('" . $date_renewed . "', INTERVAL " . $run_duration . " DAY) AS calculate_date_expires";
		$result4 = mysql_query($query4) or die(mysql_error());
		$rs4 = mysql_fetch_object($result4);
		$calculate_date_expires = stripslashes($rs4->calculate_date_expires);
		@mysql_free_result($result4);
	}
	else
	{
		$query4 = "SELECT DATE_ADD('" . $date_listed . "', INTERVAL " . $run_duration . " DAY) AS calculate_date_expires";
		$result4 = mysql_query($query4) or die(mysql_error());
		$rs4 = mysql_fetch_object($result4);
		$calculate_date_expires = stripslashes($rs4->calculate_date_expires);
		@mysql_free_result($result4);
	}
	$date_expires = $calculate_date_expires;

	$unix_time_today = time();
	$unix_time_expires =  strtotime($date_expires);
	
	if ($unix_time_today >= $unix_time_expires)
		$job_expired = 1;
	else
		$job_expired = 0;

	if ($debug_msgs) echo "$job_id, listed = $date_listed, renewed = $date_renewed, date_expires = $date_expires, job_expired = $job_expired<br />";

	$query3 = "UPDATE jobs SET expired=$job_expired WHERE job_id=" . $job_id . " LIMIT 1";
	$result3 = mysql_query($query3) or die(mysql_error());
}
@mysql_free_result($result2);
