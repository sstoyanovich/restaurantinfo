<?
if ($profile_employer_member_id)
{
	$query3 = "SELECT 
					*
				FROM 
					jobs
				WHERE 
					jobs.member_id='" . $profile_employer_member_id . "'  
					ORDER BY 
						jobs.job_title";
	if ($debug_msgs || $local_debug_msgs) echo $query3 . "<br />";
	$result3 = mysql_query($query3) or die(mysql_error());
	$num_found = mysql_num_rows($result3);
	if ($debug_msgs || $local_debug_msgs) echo "num_found = $num_found<br />";
	if ($num_found)
	{
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
			$city = $rs3->city;
			$state = $rs3->state;
	
			if ($job_title_id)
			{
				$query4 = "SELECT job_title FROM job_titles WHERE job_title_id=" . $job_title_id;
				$result4 = mysql_query($query4) or die(mysql_error());
				$rs4 = mysql_fetch_object($result4);
				$job_title = stripslashes($rs4->job_title);
				@mysql_free_result($result4);
			}
			
			if (!$job_title && !$job_title_id)
			{
				$query4 = "SELECT job_title_helper FROM job_title_id_helper_id WHERE job_id=" . $job_id;
				$result4 = mysql_query($query4) or die(mysql_error());
				$rs4 = mysql_fetch_object($result4);
				$job_title = stripslashes($rs4->job_title_helper);
				@mysql_free_result($result4);
			}
			
			if ($job_id == $_GET["job_id"]) 
			{
				$fmt_start = '<span style="background-color:#FFC; color:#900">';
				$fmt_end = "</span>";
				$fmt_bld_start = "<strong style='color:#900'>";
				$fmt_bld_end = "</strong>";
			}
			else
			{
				$fmt_start = '';
				$fmt_end = '';
				$fmt_bld_start = '';
				$fmt_bld_end = '';
			}
			
			echo $fmt_start; ?><a href="/<?=$profile_folder?>/index.php?job_id=<?=$job_id?>&job=<?=$job_title?>" class="textlink" style="text-decoration:underline"><?=$fmt_bld_start?><?=$job_title?><?=$fmt_bld_end?></a>
            <br /><? if ($city) echo $city; ?><? if ($city && $state) echo ", "; ?><? if ($state) echo $state; 
			echo $fmt_end;
			if ($city || $state) echo "<br>"; 
			?>
            <br />
			<?
		}
		@mysql_free_result($result3);
	}
}
?>
