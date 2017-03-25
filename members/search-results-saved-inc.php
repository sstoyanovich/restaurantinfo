<?

$query2 = "SELECT * FROM search_results WHERE session_id='" . session_id() . "' ORDER BY search_results_id DESC";
if ($debug_msgs) echo $query2 . "<br>";
$result2 = mysql_query($query2) or die(mysql_error());
while ($rs2 = mysql_fetch_object($result2))
{
	$job_id = stripslashes($rs2->job_id);

	$query = "SELECT * FROM jobs WHERE job_id=" . $job_id . "";
	$result = db_query($query);
	if (!$result) // query failed
		exit;
	$rs = mysql_fetch_object($result);
	$job_title_id = trim(stripslashes($rs->job_title_id));
	$job_title = trim(stripslashes($rs->job_title));
	@mysql_free_result($result);

	if ($job_title_id)
	{
		$query3 = "SELECT job_title FROM job_titles WHERE job_title_id=" . $job_title_id;
		$result3 = mysql_query($query3) or die(mysql_error());
		$rs3 = mysql_fetch_object($result3);
		$job_title = stripslashes($rs3->job_title);
		@mysql_free_result($result3);
	}
	
	if (!$job_title && !$job_title_id)
	{
		$query3 = "SELECT job_title_helper FROM job_title_id_helper_id WHERE job_id=" . $job_id;
		$result3 = mysql_query($query3) or die(mysql_error());
		$rs3 = mysql_fetch_object($result3);
		$job_title = stripslashes($rs3->job_title_helper);
		@mysql_free_result($result3);
	}
	
	?><a href="/search-details.php?job_id=<?=$job_id?>&title=<?=$job_title?>" class="textlink" style="text-decoration:underline"><?=$job_title?></a><br /><?
}
@mysql_free_result($result2);
?>
<br /><br /><br />
<a href="search.php?restore_search=1" style="text-decoration:underline"><strong>Resume previous search</strong></a><br />
<a href="search.php?new_search=1" style="text-decoration:underline"><strong>Start new search</strong></a><br />
