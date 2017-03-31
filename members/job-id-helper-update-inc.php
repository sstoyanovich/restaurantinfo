<?
$query2 = "SELECT job_id,job_title_id,job_title FROM jobs ORDER BY job_id DESC LIMIT 100";
$result2 = mysql_query($query2) or die(mysql_error());

echo "outside of loop";
while ($rs2 = mysql_fetch_object($result2))
{

	$job_id = stripslashes($rs2->job_id);
	$job_title_id = stripslashes($rs2->job_title_id);
	$job_title = stripslashes($rs2->job_title);
	echo($job_title_id);
	echo("<br><br>");

	$query3 = "SELECT job_id_helper_id FROM job_id_helper WHERE job_id=" . $job_id;
	$result3 = mysql_query($query3) or die(mysql_error());
	$has_entry = mysql_num_rows($result3);

	if (!$has_entry)
	{
		$query3 = "INSERT INTO job_id_helper SET job_id=" . $job_id . ",job_title_id=" . $job_title_id . ",job_title_helper=" . $job_title;
		$result3 = mysql_query($query3) or die(mysql_error());
		echo "inserted new jobs into job id helper";
	}
	if ($job_title_id)
	{
		echo "inside of job title id if";
		$query3 = "SELECT job_title FROM job_titles WHERE job_title_id=" . $job_title_id;
		$result3 = mysql_query($query3) or die(mysql_error());
		$rs3 = mysql_fetch_object($result3);
		$job_title = stripslashes($rs3->job_title);
		@mysql_free_result($result3);

		if ($job_title)
		{
			echo "Inside of job title if";
			$query3 = "UPDATE job_id_helper SET job_title_id='" . mysql_real_escape_string($job_title_id) . "', job_title_helper='" . mysql_real_escape_string($job_title) . "' WHERE job_id=" . $job_id . " LIMIT 1";
			$result3 = mysql_query($query3) or die(mysql_error());
		}
	}
}

echo "reached end of file";
@mysql_free_result($result2);
