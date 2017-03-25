<?

$query2 = "SELECT * FROM search_results_candidates WHERE session_id='" . session_id() . "' ORDER BY search_results_candidates_id DESC";
if ($debug_msgs) echo $query2 . "<br>";
$result2 = mysql_query($query2) or die(mysql_error());
while ($rs2 = mysql_fetch_object($result2))
{
	$member_id = stripslashes($rs2->member_id);

	$query = "SELECT * FROM members WHERE member_id=" . $member_id . "";
	$result = db_query($query);
	if (!$result) // query failed
		exit;
	$rs = mysql_fetch_object($result);
	$first_name = trim(stripslashes($rs->first_name));
	$last_name = trim(stripslashes($rs->last_name));
	@mysql_free_result($result);

	?><a href="/search-candidate-details.php?member_id=<?=$member_id?>" class="textlink" style="text-decoration:underline"><?=$first_name?> <?=$last_name?></a><br /><?
}
@mysql_free_result($result2);
?>
<br /><br /><br />
<a href="search-candidates.php?restore_search=1" style="text-decoration:underline"><strong>Resume previous search</strong></a><br />
<a href="search-candidates.php?new_search=1" style="text-decoration:underline"><strong>Start new search</strong></a><br />
<br />

