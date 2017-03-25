<style>
.editfocus {
	background-color:#ffffdd;
}

.editblur {
	background-color:#fff;
}
</style>
<?
$debug_msgs = 0;
$local_debug_msgs = 0;

$candidate_member_id = $_SESSION["member_id"];
if (!$candidate_member_id) $candidate_member_id = 0;
if ($candidate_member_id)
{
	$query3 = "SELECT email FROM members WHERE member_id=" . $candidate_member_id;
	if ($debug_msgs || $local_debug_msgs) echo $query3 . "<br />";
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	$candidate_email = stripslashes($rs3->email);
	@mysql_free_result($result3);
}

$query2  = "SELECT 
				job_applications_local.job_id 
			FROM 
				job_applications_local
			WHERE 
				job_applications_local.candidate_member_id =  " . $candidate_member_id . " 
			UNION	
				SELECT 
					job_applications_remote.job_id 
				FROM 
					job_applications_remote
				WHERE 
					job_applications_remote.candidate_member_id =  " . $candidate_member_id . "";

if ($debug_msgs) echo $query2 . "<br>";
$result2 = mysql_query($query2) or die(mysql_error());
$num_found = mysql_num_rows($result2);
if ($debug_msgs || $local_debug_msgs) echo "num_found = $num_found<br />";
if ($num_found)
{
?>	
	<table id="myTable2" class="tablesorter" width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead> 
        <tr style="background-color:#CCC">
          <th>&nbsp;Job Title</th>
          <th>&nbsp;Job Code</th>
          <th>&nbsp;Job Status</th>
          <th>&nbsp;Listed</th>
          <th>&nbsp;Salary</th>
          <th>&nbsp;Notifications</th>
          <th>&nbsp;Remove</th>
        </tr>
	</thead> 
	<tbody> 
<?
	$row_cnt = 0;
	while ($rs2 = mysql_fetch_object($result2))
	{ 
		$job_id = $rs2->job_id;
		
		$query4 = "SELECT * FROM jobs WHERE job_id=" . $job_id;
		if ($debug_msgs || $local_debug_msgs) echo $query4 . "<br />";
		$result4 = mysql_query($query4) or die(mysql_error());
		$rs4 = mysql_fetch_object($result4);
		$job_title = $rs4->job_title;
		$employer_member_id = $rs4->member_id;
		$job_title_id = $rs4->job_title_id;
		$job_code = $rs4->job_code;
		$job_status = $rs4->job_status;
		$date_listed = $rs4->date_listed;
		$run_duration = $rs4->run_duration;
		$date_expires = $rs4->date_expires;
		$hourly_rate = $rs4->hourly_rate;
		$salary_min = $rs4->salary_min;
		$salary_max = $rs4->salary_max;
		@mysql_free_result($result4);

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

		<td align="left">&nbsp;<?
        
        			  $notify_counter = 1;
					  $query5 = "SELECT * FROM employer_sent_notifications 
					  					  WHERE
										  	job_id='" . $job_id . "' AND
										  	employer_member_id='" . $employer_member_id . "' AND
										  	candidate_member_id='" . $candidate_member_id . "'
										  ORDER BY
										  	unix_time_sent 
											";
					  if ($debug_msgs) echo $query5 . "<br>";
					  $result5 = mysql_query($query5) or die(mysql_error());
					  while ($rs5 = mysql_fetch_object($result5))
					  {
						  $date_sent = stripslashes($rs5->date_sent);
						  $time_sent = stripslashes($rs5->time_sent);
						  $notification_type = stripslashes($rs5->notification_type);
						  $notification_comments = stripslashes($rs5->notification_comments);
					
                    	  switch ($notification_type)
						  {
							  case 1:  $type_text = "Request Application"; break;
							  case 2:  $type_text = "Request Phone Interview"; break;
							  case 3:  $type_text = "Request Interview"; break;
							  case 4:  $type_text = "Make Job Offer"; break;
							  case 5:  $type_text = "Reject Application"; break;
							  default: $type_text = "Other"; break;

						  }
						  echo $notify_counter . ")&nbsp;" . $date_sent . " " . $time_sent;
						  echo "<br>&nbsp;&nbsp;&nbsp; " . $type_text;
						  if ($notification_comments)
						  	echo "<br>&nbsp;&nbsp;&nbsp; " . $notification_comments . "<br />";
						  $notify_counter++;
					  }
					  @mysql_free_result($result5);

		?></td>
        
		<td align="left">&nbsp;<a href="/members/remove_applied_status.php?job_id=<?=$job_id?>&member_id=<?=$member_id?>&token=<?=$_SESSION["token"]?>&sid=<?=session_id()?>"  class="textlink" onClick="return verify_remove('Jobs I have applied for');"><img src="../images/members/button-remove.jpg" width="50" height="15" alt="Remove" /></a>
		</td>
	  </tr>
<?
		$row_cnt++;
	}
	@mysql_free_result($result2);
?>
	</tbody> 
 </table>
<?
}
else
	echo "<em>You have not yet applied for any jobs.</em>";

?>

