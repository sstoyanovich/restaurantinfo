<script type="text/javascript">
function verify_delete(title)
{
	var agree=confirm("Are you sure you wish to DELETE this job entitled '" + title + "'?  \n\nThis operation will permanantly remove the job from the website database and cannot be undone! \n\nIf you are absolutely certain you wish to delete this job, click OK. \n\nTo cancel this operation, click CANCEL. ");
	if (agree) {
		return true;
	} else {
		return false;
	}
}
</script>
<style>
.editfocus {
	background-color:#ffffdd;
}

.editblur {
	background-color:#fff;
}
</style>
<img src="/images/headers/jobs.jpg" width="113" height="27" alt="My Jobs" /><br /><br />
<a href="edit-job.php"><img src="/images/members/button-add-job.jpg"> </a>
<?
	if (!$is_admin_user)
		require("my-jobs-employer-filter-inc.php");

	$debug_msgs = 0;

	$check_mark = "<img src=\"/images/layout/checkmark.gif\">";
	$xmark = "<img src=\"/images/layout/xmark.jpg\">";

//    $query2 = "SELECT * FROM categories ORDER BY category_name";
//	if ($debug_msgs) echo $query2 . "<br />";
//    $result2 = mysql_query($query2) or die(mysql_error());
//    while ($rs2 = mysql_fetch_object($result2))
//    {
//		$category_id = $rs2->category_id;

/*
?>
        <div style="line-height:7px;"><br></div>
        <strong><? echo stripslashes($rs2->cat_name); ?></strong>
        <div style="line-height:7px;"><br></div>
<?
*/
		$category_id = 1;
		if ($is_admin_user == "743812947309")
        	$query3 = "SELECT * FROM jobs WHERE category_id='" . $category_id . "' ";
		else
		{
        	$query3 = "SELECT * FROM jobs WHERE member_id='" . $member_id . "' AND category_id='" . $category_id . "' ";
			if ($_SESSION["hide_jobs_new"])
				$query3 .= " AND job_status != 0 ";
			if ($_SESSION["hide_jobs_open"])
				$query3 .= " AND job_status != 1 ";
			if ($_SESSION["hide_jobs_offer"])
				$query3 .= " AND job_status != 2 ";
			if ($_SESSION["hide_jobs_filled"])
				$query3 .= " AND job_status != 3 ";
			if ($_SESSION["hide_jobs_closed"])
				$query3 .= " AND job_status != 4 ";
			if ($_SESSION["hide_jobs_archived"])
				$query3 .= " AND job_status != 5 ";
		}
		$query3 .= " ORDER BY job_title";
		if ($debug_msgs) echo $query3 . "<br />";
        $result3 = db_query($query3);
        if (mysql_num_rows($result3))
        {
    ?>
			<table id="myTable" class="tablesorter" width="99%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse; border-color:#888; box-shadow: 5px 5px 5px #ddd; margin-right:5px">
    		<thead>
              <tr style="background-color:#CCC">
                <th align="left">Job Title</th>
                <th align="center">Job Code</th>
                <th align="center">Added on</th>
                <th align="center">#Days</th>
                <th align="center">Expires</th>
                <th align="center">#Applies</th>
                <th align="center">Show</th>
           <? 	if (!$is_admin_user) { ?>
                <th align="center">Status</th>
                <th align="center">Manage</th>
           <? } ?>
              </tr>
			</thead>
			<tbody>
    <?
            $row_cnt = 0;
            while ($rs3 = mysql_fetch_object($result3))
            {
				$job_id = $rs3->job_id;
				$job_title_id = $rs3->job_title_id;
				$job_code = $rs3->job_code;
				$enabled = $rs3->enabled;
				$job_status = $rs3->job_status;
				$date_listed = $rs3->date_listed;
				$date_renewed = $rs3->date_renewed;
				$run_duration = $rs3->run_duration;
				$date_expires = $rs3->date_expires;

				$hourly_rate = $rs3->hourly_rate;
				$salary_min = $rs3->salary_min;
				$salary_max = $rs3->salary_max;

				if ($hourly_rate)
					$pays = '$' . $hourly_rate . '/hour';
				else
					$pays = '$' . $salary_min . 'K - ' . '$' . $salary_max . 'K';

				if ($debug_msgs) echo "job_title_id = $job_title_id<br />";
				if ($job_title_id)
				{
					$query4 = "SELECT job_title FROM job_titles WHERE job_title_id=" . $job_title_id;
					if ($debug_msgs) echo $query4 . "<br />";
					$result4 = mysql_query($query4) or die(mysql_error());
					$rs4 = mysql_fetch_object($result4);
					$job_title = stripslashes($rs4->job_title);
					@mysql_free_result($result4);
					if ($debug_msgs) echo "job_title = $job_title<br />";
				}
				else
					$job_title = stripslashes($rs3->job_title);

				if (!$run_duration) $run_duration = 7;

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
				if ($date_renewed != '0000-00-00')
					$unix_time_renewed = strtotime($date_renewed);
				else
					$unix_time_renewed = 0;

				if ($date_renewed != '0000-00-00' && $unix_time_renewed && $unix_time_today > $unix_time_expires)
					$job_expired = 1;
				else if ($unix_time_expires && $unix_time_today > $unix_time_expires)
					$job_expired = 1;
				else
					$job_expired = 0;

				$query5 = "SELECT job_applications_local_id FROM job_applications_local WHERE job_id=" . mysql_real_escape_string($job_id);
				$result5 = mysql_query($query5) or die(mysql_error());
				$num_job_applications_local = mysql_num_rows($result5);

				$query5 = "SELECT job_applications_remote_id FROM job_applications_remote WHERE job_id=" . mysql_real_escape_string($job_id);
				$result5 = mysql_query($query5) or die(mysql_error());
				$num_job_applications_remote = mysql_num_rows($result5);

				$num_job_applications = $num_job_applications_local + $num_job_applications_remote;
        ?>
          	  <tr onmouseover="this.className='editfocus';" onmouseout="this.className='editblur';">
                <td align="left">&nbsp;<?=$job_title?></td>
                <td align="center"><?=$job_code?></td>
                <td align="center"><?=$date_listed?></td>
                <td align="center"><?=$run_duration?></td>

                <td align="center"><? if ($job_expired) echo "<span style='color:#900'>Expired</span>";  else echo $date_expires; ?></td>

                <td align="center"><?
                						if ($num_job_applications)
										{
											echo $num_job_applications;

											if (!$is_admin_user) {
											?> <a href="/my-jobs.php?view_applies_job_id=<?=$job_id?>"><img src="/images/layout/icon-magnifying-glass.jpg" width="17" height="17" alt="View order details"></a><?
											}
										}
										else
											echo '-';
									?></td>

                <td align="center"><?
									if ($job_expired)
										echo '-';
									else if ($enabled)
									{
										?><a href="/update-publish-status.php?publish=0&job_id=<?=$job_id?>&member_id=<?=$member_id?>&token=<?=$_SESSION["token"]?>&sid=<?=session_id()?>"><?=$check_mark?></a><?
									}
									else
									{
										?><a href="/update-publish-status.php?publish=1&job_id=<?=$job_id?>&member_id=<?=$member_id?>&token=<?=$_SESSION["token"]?>&sid=<?=session_id()?>"><?=$xmark?></a><?
									}
									?></td>
     	<? 	if (!$is_admin_user) { ?>

                <td align="center">
                    <form action="/update-job-status.php" method="get" name="status_<?=$job_id?>">
                    <input type="hidden" name="job_id" value="<?=$job_id ?>" />
                    <input type="hidden" name="member_id" value="<?=$member_id ?>" />
                    <input type="hidden" name="token"     value="<? echo $_SESSION["token"]; ?>" />
                    <input type="hidden" name="sid"       value="<? echo session_id(); ?>">
                    <select name="status" style="width:90px" onchange="submit();">
                    <option value='0'>New</option>
                    <option value='1' <? if ($job_status == 1) echo "selected"; ?>>Open</option>
                    <option value='2' <? if ($job_status == 2) echo "selected"; ?>>Offer</option>
                    <option value='3' <? if ($job_status == 3) echo "selected"; ?>>Filled</option>
                    <option value='4' <? if ($job_status == 4) echo "selected"; ?>>Closed</option>
                    <option value='5' <? if ($job_status == 5) echo "selected"; ?>>Archived</option>
                    </select>
                    </form>
				</td>

                <td align="center">
                <a href="edit-job.php?job_id=<?=$job_id?>" class="textlink"><img src="/images/members/button-edit.jpg" width="40" height="15" alt="Edit" /></a>

                <a href="delete-job.php?job_id=<?=$job_id?>&member_id=<?=$member_id?>&token=<?=$_SESSION["token"]?>&sid=<?=session_id()?>"  class="textlink" onClick="return verify_delete('<?=$job_title?>');"><img src="../images/members/button-delete.jpg" width="40" height="15" alt="Delete" style="margin-left:4px; margin-right:4px;" /></a>

                <? if ($job_expired) { ?>
                	<a href="renew-job.php?job_id=<?=$job_id?>&member_id=<?=$member_id?>&token=<?=$_SESSION["token"]?>&sid=<?=session_id()?>"  class="textlink"><img src="../images/members/button-repost.jpg" width="40" height="15" alt="Renew" /></a>
                <? } else { ?>
                	<img src="../images/members/button-repost-gray-out.jpg" width="40" height="15" />
                <? } ?>
                </td>
           <? } ?>
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
            echo "<em>There are no job jobs yet.</em>";
//    }
//    @mysql_free_result($result2);

?>
