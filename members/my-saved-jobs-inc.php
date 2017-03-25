<?
$debug_msgs = 0;

$local_debug_msgs = 0;

$candideate_member_id = $_SESSION["member_id"];
if (!$candideate_member_id) $candideate_member_id = 0;
if ($candideate_member_id)
{
	$query3 = "SELECT email FROM members WHERE member_id=" . $candideate_member_id;
	if ($debug_msgs || $local_debug_msgs) echo $query3 . "<br />";
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	$candidate_email = stripslashes($rs3->email);
	@mysql_free_result($result3);
}

$category_id = 1;
$query3 = "SELECT 
				DISTINCT favorites.job_id,
				jobs.job_title, 
				jobs.job_title_id, 
				jobs.job_code, 
				jobs.job_status, 
				jobs.job_title_id, 
				jobs.date_listed,
				jobs.hourly_rate,
				jobs.salary_min,
				jobs.salary_max
			FROM 
				favorites,
				jobs
			WHERE 
				favorites.job_id = jobs.job_id AND
				favorites.status = 1 AND
				(
					favorites.member_id='" . $candideate_member_id . "' OR 
					favorites.email='" . mysql_real_escape_string($candidate_email) . "' 
				)
				ORDER BY 
					job_title";
if ($debug_msgs || $local_debug_msgs) echo $query3 . "<br />";
$result3 = mysql_query($query3) or die(mysql_error());
$num_found = mysql_num_rows($result3);
if ($debug_msgs || $local_debug_msgs) echo "num_found = $num_found<br />";
if ($num_found)
{
?>
	<table id="myTable" class="tablesorter" width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead> 
        <tr style="background-color:#CCC">
          <th>&nbsp;Job Title</th>
          <th>&nbsp;Job Code</th>
          <th>&nbsp;Job Status</th>
          <th>&nbsp;Listed</th>
          <th>&nbsp;Salary</th>
          <th>&nbsp;Remove</th>
        </tr>
	</thead> 
	<tbody> 
<?
	$row_cnt = 0;
	while ($rs3 = mysql_fetch_object($result3))
	{ 
		$job_id = $rs3->job_id;
		$job_title = $rs3->job_title;
		$job_title_id = $rs3->job_title_id;
		$job_code = $rs3->job_code;
		$job_status = $rs3->job_status;
		$date_listed = $rs3->date_listed;
		$run_duration = $rs3->run_duration;
		$date_expires = $rs3->date_expires;
		$hourly_rate = $rs3->hourly_rate;
		$salary_min = $rs3->salary_min;
		$salary_max = $rs3->salary_max;

		if ($hourly_rate)
			$pays = '$' . $hourly_rate . '/hour';
		else
			$pays = '$' . $salary_min . 'K - ' . '$' . $salary_max . 'K';
		
		if ($debug_msgs || $local_debug_msgs) echo "job_title_id = $job_title_id<br />";
		if ($job_title_id)
		{
			$query4 = "SELECT job_title FROM job_titles WHERE job_title_id=" . $job_title_id;
			if ($debug_msgs || $local_debug_msgs) echo $query4 . "<br />";
			$result4 = mysql_query($query4) or die(mysql_error());
			$rs4 = mysql_fetch_object($result4);
			$job_title = stripslashes($rs4->job_title);
			@mysql_free_result($result4);
			if ($debug_msgs) echo "job_title = $job_title<br />";
		}
		else
			$job_title = stripslashes($rs3->job_title);
		
		if (!$run_duration) $run_duration = 7;
		$query4 = "SELECT DATE_ADD('" . $date_listed . "', INTERVAL " . $run_duration . " DAY) AS calculate_date_expires";
		if ($debug_msgs || $local_debug_msgs) echo $query4 . "<br />";
		$result4 = mysql_query($query4) or die(mysql_error());
		$rs4 = mysql_fetch_object($result4);
		$calculate_date_expires = stripslashes($rs4->calculate_date_expires);
		@mysql_free_result($result4);
		
		if ($date_expires == '0000-00-00' || $date_expires != $calculate_date_expires)
			$date_expires = $calculate_date_expires;
?>
	  <tr onmouseover="this.className='editfocus';" onmouseout="this.className='editblur';">
		<td align="left">&nbsp;<a href="/search-details.php?job_id=<?=$job_id?>&title=<?=$job_title?>" style="text-decoration:underline"><?=$job_title?></a></td>
		<td align="left">&nbsp;<?=$job_code?></td>
        
		<td align="left">&nbsp;<?
        					switch ($job_status)
							{
								case 0:		$the_status = "New"; break;
								case 1:		$the_status = "Open"; break;
								case 2:		$the_status = "Offered"; break;
								case 3:		$the_status = "Filled"; break;
								case 4:		$the_status = "Closed"; break;
								case 5:		$the_status = "Archived"; break;
								default:	$the_status = "New"; break;
							}
							echo $the_status;
		?></td>

		<td align="left">&nbsp;<?=$date_listed?></td>
		<td align="left">&nbsp;<?=$pays?></td>
		
		<td align="left">&nbsp;<a href="/members/remove_fav_status.php?job_id=<?=$job_id?>&member_id=<?=$member_id?>&token=<?=$_SESSION["token"]?>&sid=<?=session_id()?>"  class="textlink" onClick="return verify_remove('My Saved Jobs');"><img src="../images/members/button-remove.jpg" width="50" height="15" alt="Remove" /></a>
		</td>
	  </tr>
<?
		$row_cnt++;
	}
	@mysql_free_result($result3);
?>
 </tbody> 
 </table>
<?
}
else
	echo "<em>You do not yet have any saved jobs.</em><br>";
