<?
$debug_msgs = 0;

if ($debug_msgs)
{
	echo "search_type = $search_type<br />";	
	echo "search_terms = $search_terms<br />";	
	echo "state = $state<br />";	
	echo "category = $category<br />";	
	echo "job_title_id = $job_title_id<br />";	
	echo "job_title = $job_title<br />";	
	echo "hourly_rate = $hourly_rate<br />";	
	echo "salary_min = $salary_min<br />";	
	echo "salary_max = $salary_max<br />";	
	echo "years_min = $years_min<br />";	
	echo "years_max = $years_max<br />";	
}
		
$jobs_per_page = 50;
$the_page = ($_GET["page"]) ? $_GET["page"] : 1;
$range_low = 0 + (($the_page - 1) * $jobs_per_page); 
	
if ($token == $_SESSION['token'] && $sid == session_id())
{
	if ($job_title || $job_title_id || $search_terms)
	{
		//****************************************************************************************
		// Clear out the search results from the DB temp table
		//****************************************************************************************
		
		$query3 = "DELETE FROM search_results WHERE session_id='" . session_id() . "'";
		$result3 = mysql_query($query3) or die(mysql_error());
		
		$now_time = time();
		$one_hour_window = $now_time - (60 * 60);
		$query3 = "DELETE FROM search_results WHERE unix_time < '" . $one_hour_window . "'";
		$result3 = mysql_query($query3) or die(mysql_error());
	
		//****************************************************************************************
		// First search db for all matches for the job Title (if specified in the title box)
		//****************************************************************************************
	
		if ($job_title)
		{
			$query2 = "SELECT 
							jobs.job_id 
						FROM 
							jobs 
						WHERE 
							jobs.expired=0 AND
							(
								jobs.job_title LIKE '%" . mysql_real_escape_string($job_title) . "%' OR 					  
								jobs.description LIKE '%" . mysql_real_escape_string($job_title) . "%' 
							)";
			if ($debug_msgs) echo "<strong>JOB TITLE</strong>: $query2<br />";
			$result2 = mysql_query($query2) or die(mysql_error());
			$num_found = mysql_num_rows($result2);
			if ($debug_msgs) echo "num_found = $num_found<br />";
			while ($rs2 = mysql_fetch_object($result2))
			{
				$job_id = stripslashes($rs2->job_id);
				
				$query3 = "SELECT search_results_id FROM search_results WHERE job_id=" . $job_id;
				if ($debug_msgs) echo "$query3<br />";
				$result3 = mysql_query($query3) or die(mysql_error());
				$have_this_one = mysql_num_rows($result3);
				if (!$have_this_one)
				{
					$query3 = "INSERT INTO search_results SET session_id='" . mysql_real_escape_string(session_id()) . "', unix_time='" . time() . "', job_id=" . $job_id;
					if ($debug_msgs) echo "$query3<br />";
					$result3 = mysql_query($query3) or die(mysql_error());
				}
			}
			@mysql_free_result($result2);
	
			if (!$search_terms)
			{	
				$query2 = "SELECT 
								job_id 
							FROM 
								job_id_helper 
							WHERE 
								job_title_helper LIKE '%" . mysql_real_escape_string($job_title) . "%'";
				if ($debug_msgs) echo "<strong>JOB TITLE</strong>: $query2<br />";
				$result2 = mysql_query($query2) or die(mysql_error());
				$num_found = mysql_num_rows($result2);
				if ($debug_msgs) echo "num_found = $num_found<br />";
				while ($rs2 = mysql_fetch_object($result2))
				{
					$job_id = stripslashes($rs2->job_id);
					
					$query3 = "SELECT search_results_id FROM search_results WHERE job_id=" . $job_id;
					if ($debug_msgs) echo "$query3<br />";
					$result3 = mysql_query($query3) or die(mysql_error());
					$have_this_one = mysql_num_rows($result3);
					if (!$have_this_one)
					{
						$query3 = "INSERT INTO search_results SET session_id='" . mysql_real_escape_string(session_id()) . "', unix_time='" . time() . "', job_id=" . $job_id;
						if ($debug_msgs) echo "$query3<br />";
						$result3 = mysql_query($query3) or die(mysql_error());
					}
				}
				@mysql_free_result($result2);
			}
		}
		
		//****************************************************************************************
		// Now search db for all matches for the job Title ID (if selected using selector)
		//****************************************************************************************
		
		if ($job_title_id)
		{	
			$query2 = "SELECT 
							jobs.job_id 
						FROM 
							jobs,job_titles 
						WHERE 
							jobs.expired=0 AND
							jobs.job_title_id = job_titles.job_title_id AND 
							jobs.job_title_id='" . mysql_real_escape_string($job_title_id) . "'";
			if ($debug_msgs) echo "<strong>JOB TITLE ID</strong>: $query2<br />";
			$result2 = mysql_query($query2) or die(mysql_error());
			$num_found = mysql_num_rows($result2);
			if ($debug_msgs) echo "num_found = $num_found<br />";
			while ($rs2 = mysql_fetch_object($result2))
			{
				$job_id = stripslashes($rs2->job_id);
				
				$query3 = "SELECT search_results_id FROM search_results WHERE job_id=" . $job_id;
				if ($debug_msgs) echo "$query3<br />";
				$result3 = mysql_query($query3) or die(mysql_error());
				$have_this_one = mysql_num_rows($result3);
				if (!$have_this_one)
				{
					$query3 = "INSERT INTO search_results SET session_id='" . mysql_real_escape_string(session_id()) . "', unix_time='" . time() . "', job_id=" . $job_id;
					if ($debug_msgs) echo "$query3<br />";
					$result3 = mysql_query($query3) or die(mysql_error());
				}
			}
			@mysql_free_result($result2);
	
			$query3 = "SELECT job_title FROM job_titles WHERE job_title_id=" . $job_title_id;
			$result3 = mysql_query($query3) or die(mysql_error());
			$rs3 = mysql_fetch_object($result3);
			$job_title = stripslashes($rs3->job_title);
			@mysql_free_result($result3);
			if ($job_title)
			{
				$query2 = "SELECT 
								jobs.job_id 
							FROM 
								jobs 
							WHERE 
								jobs.expired=0 AND
								(
									jobs.job_title LIKE '%" . mysql_real_escape_string($job_title) . "%' OR 					  
									jobs.description LIKE '%" . mysql_real_escape_string($job_title) . "%' 
								)";
				if ($debug_msgs) echo "<strong>JOB TITLE</strong>: $query2<br />";
				$result2 = mysql_query($query2) or die(mysql_error());
				$num_found = mysql_num_rows($result2);
				if ($debug_msgs) echo "num_found = $num_found<br />";
				while ($rs2 = mysql_fetch_object($result2))
				{
					$job_id = stripslashes($rs2->job_id);
					
					$query3 = "SELECT search_results_id FROM search_results WHERE job_id=" . $job_id;
					if ($debug_msgs) echo "$query3<br />";
					$result3 = mysql_query($query3) or die(mysql_error());
					$have_this_one = mysql_num_rows($result3);
					if (!$have_this_one)
					{
						$query3 = "INSERT INTO search_results SET session_id='" . mysql_real_escape_string(session_id()) . "', unix_time='" . time() . "', job_id=" . $job_id;
						if ($debug_msgs) echo "$query3<br />";
						$result3 = mysql_query($query3) or die(mysql_error());
					}
				}
				@mysql_free_result($result2);
			}
		}
	
		//****************************************************************************************
		// Now search db for all matches to the keywords
		//****************************************************************************************
		
		if (trim($search_terms))
		{	
			$query2 = "SELECT 
							jobs.job_id,
							members.company_name 
						FROM 
							jobs, 
							members
						WHERE 
							jobs.expired=0 AND
							members.member_id = jobs.member_id AND
							(
						  		jobs.job_title LIKE '%" . mysql_real_escape_string($search_terms) . "%' OR
						  		members.company_name LIKE '%" . mysql_real_escape_string($search_terms) . "%' 
							)
						  ";
			if ($debug_msgs) echo "<strong>KEYWORDS</strong>: $query2<br />";
			$result2 = mysql_query($query2) or die(mysql_error());
			$num_found = mysql_num_rows($result2);
			if ($debug_msgs) echo "num_found = $num_found<br />";
			while ($rs2 = mysql_fetch_object($result2))
			{
				$job_id = stripslashes($rs2->job_id);
				
				$query3 = "SELECT search_results_id FROM search_results WHERE job_id=" . $job_id;
				if ($debug_msgs) echo "$query3<br />";
				$result3 = mysql_query($query3) or die(mysql_error());
				$have_this_one = mysql_num_rows($result3);
				if (!$have_this_one)
				{
					$query3 = "INSERT INTO search_results SET session_id='" . mysql_real_escape_string(session_id()) . "', unix_time='" . time() . "', job_id=" . $job_id;
					if ($debug_msgs) echo "$query3<br />";
					$result3 = mysql_query($query3) or die(mysql_error());
				}
			}
			@mysql_free_result($result2);
			
			$query2 = "SELECT 
							job_id 
						FROM 
							job_id_helper 
						WHERE 
							job_title_helper LIKE '%" . mysql_real_escape_string($search_terms) . "%'";
			if ($debug_msgs) echo "<strong>KEYWORDS</strong>: $query2<br />";
			$result2 = mysql_query($query2) or die(mysql_error());
			$num_found = mysql_num_rows($result2);
			if ($debug_msgs) echo "num_found = $num_found<br />";
			while ($rs2 = mysql_fetch_object($result2))
			{
				$job_id = stripslashes($rs2->job_id);
				
				$query3 = "SELECT search_results_id FROM search_results WHERE job_id=" . $job_id;
				if ($debug_msgs) echo "$query3<br />";
				$result3 = mysql_query($query3) or die(mysql_error());
				$have_this_one = mysql_num_rows($result3);
				if (!$have_this_one)
				{
					$query3 = "INSERT INTO search_results SET session_id='" . mysql_real_escape_string(session_id()) . "', unix_time='" . time() . "', job_id=" . $job_id;
					if ($debug_msgs) echo "$query3<br />";
					$result3 = mysql_query($query3) or die(mysql_error());
				}
			}
			@mysql_free_result($result2);
		}
		
		//****************************************************************************************
		// Create the query and add in any other specified parameters.
		//****************************************************************************************
	
		$query = "SELECT 
						search_results.job_id,
						jobs.*
					FROM 
						search_results,
						jobs
					WHERE
						jobs.expired=0 AND
						search_results.session_id='" . session_id() . "' AND
						search_results.job_id = jobs.job_id";
	
		if ($state)
			$query .= " AND jobs.state='" . mysql_real_escape_string($state) . "'";
		if ($category)
			$query .= " AND jobs.category_id='" . mysql_real_escape_string($category) . "'";
			
		if ($hourly_rate)
			$query .= " AND jobs.hourly_rate >= '" . mysql_real_escape_string($hourly_rate) . "'";
		else 
		{
			if ($salary_min)
				$query .= " AND jobs.salary_min >= '" . mysql_real_escape_string($salary_min) . "'";
			if ($salary_max)
				$query .= " AND jobs.salary_max <= '" . mysql_real_escape_string($salary_max) . "'";
		}
	
		if ($years_min)
			$query .= " AND jobs.years_min >= '" . mysql_real_escape_string($years_min) . "'";
		if ($years_max)
			$query .= " AND jobs.years_max <= '" . mysql_real_escape_string($years_max) . "'";
	
		
		//****************************************************************************************
		// Set up the order by part.
		//****************************************************************************************
	
		$desc_for_rev = ($_GET["rev"]) ? "DESC" : "";
		switch ($_GET["sort"])
		{
			case "state":		if ($job_title_id)
									$sort_order = " jobs.state $desc_for_rev, job_titles.job_title $desc_for_rev";
								else
									$sort_order = " jobs.state $desc_for_rev, jobs.job_title $desc_for_rev";
			
			case "salary":		$salary_min_or_max = ($_GET["rev"]) ? "salary_max" : "salary_min";
								$rate_type = ($hourly_rate) ? "hourly_rate" : $salary_min_or_max;
								if ($job_title_id)
									$sort_order = " jobs.$rate_type $desc_for_rev, job_titles.job_title $desc_for_rev";
								else
									$sort_order = " jobs.$rate_type $desc_for_rev, jobs.job_title $desc_for_rev";
								break;
	
			case "expires":		$sort_order = " jobs.date_expires $desc_for_rev";
								break;
	
			case "title":		
			default:			$sort_order = " jobs.job_title $desc_for_rev";
								break;
		}
		$query .= " ORDER BY " . $sort_order;
	
	
		
		//****************************************************************************************
		// Submit the query and determine the TOTAL number of results.
		//****************************************************************************************
	
		$display_query = str_replace("SELECT", "SELECT<br>", $query);
		$display_query = str_replace("FROM ", "<br>FROM<br>&nbsp; &nbsp; ", $query);
		$display_query = str_replace("WHERE ", "<br>WHERE<br>&nbsp; &nbsp; ", $display_query);
		$display_query = str_replace("AND ", "AND<br> ", $display_query);
		$display_query = str_replace("OR ", " OR<br>", $display_query);
		$display_query = str_replace("<br>ORDER BY", " ORDER BY&nbsp; &nbsp; <br>", $display_query);
		if ($debug_msgs) echo  $display_query . "<br>";
						
		$result = mysql_query($query) or die(mysql_error());
		$number_of_jobs = mysql_num_rows($result);
		if ($debug_msgs) echo "number_of_jobs = $number_of_jobs<br />";
		if ($number_of_jobs == 0) 	// any jobs ?
		{
			?>We're sorry, but we can't seem to find any jobs that match your search criteria.<br /><br /><?
		}
		else
		{
			$first_show = $range_low;
			$last_show = $first_show + $jobs_per_page - 1;
			if ($last_show > $number_of_jobs)
				$last_show = $number_of_jobs;
	?>
	
			<table width="100%"  border="0"  cellspacing="0" cellpadding="2" align="center">
			<tr>
			  <td align="left" width="50%" valign="top">
				  We found <strong><?=$number_of_jobs?> Jobs</strong> that match your search criteria.  
				  <br />Showing Jobs <? echo $first_show + 1; ?> - <? if ($last_show < $number_of_jobs) echo $last_show + 1 ; else echo $last_show; ?> of <?=$number_of_jobs?>
			  </td>
			  <td align="right" width="50%" valign="top">
				Click on any job title to see job details.<br />
				Click on any column heading to sort the list. 
				</td>
			  </tr>
			</table>
			<br>
	<?
			//****************************************************************************************
			// RE-Submit the query with pagination.
			//****************************************************************************************
	
			$query .= " LIMIT $range_low,$jobs_per_page";
			if ($debug_msgs) echo "$query<br />";
			$result = db_query($query);
	?>
			<div align="center">
				<table id="myTable" class="tablesorter" width="100%"   border="1" bordercolor="#dddddd" style="border-collapse:collapse;" cellspacing="0" cellpadding="2">
    			<thead> 


				<tr bgcolor="#dddddd" height="24">
				  <th align="left"><strong>Job Title / Company</strong> </th>
				  <th align="center"><strong>State</strong></th>
				  <th align="center"><strong>Compensation</strong></th>
				  <th align="center"><strong>Expires</strong></th>
				  <th align="center"><strong>Favorites</strong></th>
				</tr>
                </thead> 
                <tbody> 
	<?
				$fav_array_content = '';
				$td_counter = 0;
				$row_counter = 0;
				$js_fav_array_index = 0;
				$job_counter = $first_show + 1;
				while ($rs = mysql_fetch_object($result))
				{
					$job_id = $rs->job_id;  
					$company_name = $rs->company_name;  
								
					$query3 = "SELECT member_id,job_title,job_title_id,hourly_rate,salary_min,salary_max,date_listed,date_renewed,run_duration FROM jobs WHERE job_id=" . $job_id;
				//	if ($debug_msgs) echo "$query3<br />";
					$result3 = mysql_query($query3) or die(mysql_error());
					$rs3 = mysql_fetch_object($result3);
					$this_hourly_rate = stripslashes($rs3->hourly_rate);
					$this_salary_min = stripslashes($rs3->salary_min);
					$this_salary_max = stripslashes($rs3->salary_max);
					$this_job_title_id = stripslashes($rs3->job_title_id);
					$this_job_title = stripslashes($rs3->job_title);
					$employer_member_id = stripslashes($rs3->member_id);
					$date_listed = stripslashes($rs3->date_listed);
					$date_renewed = stripslashes($rs3->date_renewed);
					$run_duration = stripslashes($rs3->run_duration);
					@mysql_free_result($result3);

					if ($employer_member_id)
					{
						$query3 = "SELECT company_name FROM members WHERE member_id=" . $employer_member_id;
					//	if ($debug_msgs) echo "$query3<br />";
						$result3 = mysql_query($query3) or die(mysql_error());
						$rs3 = mysql_fetch_object($result3);
						$company_name = stripslashes($rs3->company_name);
						@mysql_free_result($result3);
					}
					else
						$company_name = '???';
					
					if ($this_job_title_id)
					{
						$query3 = "SELECT job_title FROM job_titles WHERE job_title_id=" . $this_job_title_id;
						$result3 = mysql_query($query3) or die(mysql_error());
						$rs3 = mysql_fetch_object($result3);
						$this_job_title = stripslashes($rs3->job_title);
						@mysql_free_result($result3);
					}
					
					if (!$this_job_title) $this_job_title = $job_title_helper;
					if (!$this_hourly_rate) $this_hourly_rate = 0;
					if (!$this_salary_min) $this_salary_min = "TBD";
					if (!$this_salary_max) $this_salary_max = "TBD";
		
					//****************************************************************************************
					// Determine the expiration date.
					//****************************************************************************************

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
					$date_expires_unix_time = strtotime ($date_expires);
					$now_unix_time = time();
					if ($now_unix_time > $date_expires_unix_time)
					{
						$query4 = "UPDATE jobs SET expired=1 WHERE job_id=$job_id LIMIT 1";
						$result4 = mysql_query($query4) or die(mysql_error());
						continue;
					}
	?>
					 <tr <? if ($row_counter & 1) { ?> bgcolor="#eeeeee"<? } ?>  class="tbl_data">
			
					   <td valign="middle" height="24" align="left">
							  <a href="/search-details.php?job_id=<?=$job_id?>&title=<?=$this_job_title?>" class="textlink"><?=$this_job_title?></a> <span style="color:#ccc">(<?=$job_id?>)</span><br />
                              <?=$company_name?>
						 </td>      
					   
					   <td valign="middle" align="center"> 
						  <? echo stripslashes($rs->state); ?>
					  </td>
	
					   <td valign="middle" align="center">
							<? 
								if ($this_hourly_rate) 
									echo '$' . $this_hourly_rate . "/hr";
								else
									echo '$' . $this_salary_min . 'K - ' . $this_salary_max . 'K';
							?>
					   </td>
					   
					   <td valign="middle" align="center"><? 
							list($the_year, $the_month, $the_day) = explode("-", $date_expires); 
							$the_year = substr(trim($the_year), 2, 2);
							echo $the_month . "/" . $the_day . "/" . $the_year;
							?></td>
	
					   <td valign="middle" align="center"><? 
							$query3 = "SELECT favorites_id FROM favorites WHERE 
																			status=1 AND 
																			job_id=" . $job_id . " AND 
																			(session_id='" . session_id() . "' OR 
																			email='" . $_SESSION["fav_email"] . "' OR
																			email='" . $_SESSION["email"] . "')";
							$result3 = mysql_query($query3) or die(mysql_error());
							$is_favorite = (mysql_num_rows($result3)) ? 1 : 0;
							if ($is_favorite)
								$fav_img = "favorites-checked.png";
							else
								$fav_img = "favorites-add.png";
	
							if ($js_fav_array_index > 0)
								$fav_array_content .= ", ";
							$fav_array_content .= "'" . $is_favorite . "'";
	
							?>
							<img id="fav_status_<?=$job_id?>" src="/images/members/<?=$fav_img?>" width="19" height="19" onclick="return change_fav_status('<?=$job_id?>', '<?=$js_fav_array_index?>');" /></td>
	
					</tr>
	<?
					$row_counter++;
					$job_counter++;
					$js_fav_array_index++;
	
				//	$query3 = "DELETE FROM search_results WHERE session_id='" . session_id() . "' AND job_id=" . $job_id;
				//	$result3 = mysql_query($query3) or die(mysql_error());
				}
	?>
 				</tbody> 
			   </table>
			</div>
		
			<div align="center">
				<? require("listings-next-prev-buttons-inc.php"); ?>
			</div>
	<?
		}
	}
	else
	{
	?>
    	<strong style="color:#900">Please enter/specify at least one of the following fields in the search form:</strong>:<br /><br />
        
  		&nbsp; &nbsp; Enter one or more keywords<br />
  		&nbsp; &nbsp; Select a job title<br />
  		&nbsp; &nbsp; Enter a job title<br />
     <?  
	}
}

// NOTE: The javascript below needs to be in the file and below the above PHP code, since $fav_array_content is set above, and used below:
?>
<script type="text/javascript">
var fav_array = [<?=$fav_array_content?>]; 
function change_fav_status(job_id, fav_index)
{
	var current_status = fav_array[fav_index];
	var img_id = "fav_status_" + job_id;
	var url = '';
	
	if (current_status == 1)
	{
		fav_array[fav_index] = 0;
        document.getElementById(img_id).src = "/images/members/favorites-add.png";
	}
	else
	{
		fav_array[fav_index] = 1;
        document.getElementById(img_id).src = "/images/members/favorites-checked.png";
	}
	
	url = "/members/change_fav_status.php?job_id=" + job_id + "&sid=<? echo session_id(); ?>&member_id=<?=$_SESSION["member_id"]?>&status=" + fav_array[fav_index];
//	alert(url);
	issue_query(url, ajax_debug_msg_call_back); 
}
</script>
<br /><br />


