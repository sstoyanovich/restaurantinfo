<style type="text/css">
.tbl_data {font-size: 12px}
</style>

<?
$debug_msgs = 0;

if ($debug_msgs)
{
	echo "search_type = $search_type<br />";	
	echo "search_terms = $search_terms<br />";	
	echo "state = $state<br />";	
	echo "category = $category<br />";	
	echo "candidate_title_id = $candidate_title_id<br />";	
	echo "candidate_title = $candidate_title<br />";	
	echo "hourly_rate_min = $hourly_rate_min<br />";	
	echo "hourly_rate_max = $hourly_rate_max<br />";	
	echo "salary_min = $salary_min<br />";	
	echo "salary_max = $salary_max<br />";	
	echo "years_min = $years_min<br />";	
	echo "years_max = $years_max<br />";	
}
		
$candidates_per_page = 50;
$the_page = ($_GET["page"]) ? $_GET["page"] : 1;
$range_low = 0 + (($the_page - 1) * $candidates_per_page); 
	
if ($token == $_SESSION['token'] && $sid == session_id())
{
	if ($search_terms)
	{
		//****************************************************************************************
		// Clear out the search results from the DB temp table
		//****************************************************************************************
		
		$query3 = "DELETE FROM search_results_candidates WHERE session_id='" . session_id() . "'";
		if ($debug_msgs) echo "$query3<br />";
		$result3 = mysql_query($query3) or die(mysql_error());
		
		$now_time = time();
		$one_hour_window = $now_time - (60 * 60);
		$query3 = "DELETE FROM search_results_candidates WHERE unix_time < '" . $one_hour_window . "'";
		if ($debug_msgs) echo "$query3<br />";
		$result3 = mysql_query($query3) or die(mysql_error());
	
		//****************************************************************************************
		// Now search db for all matches to the keywords
		//****************************************************************************************
		
		if (trim($search_terms))
		{	
			if ($debug_msgs) echo "<strong>KEYWORDS</strong><br />";

			$query2 = "SELECT 
							* 
						FROM 
							members 
						WHERE 
							members.member_type='C' AND
							(
								members.job_title LIKE '%" . mysql_real_escape_string($search_terms) . "%' OR
								members.profile_bio LIKE '%" . mysql_real_escape_string($search_terms) . "%' OR
								members.education LIKE '%" . mysql_real_escape_string($search_terms) . "%' OR
								members.work_experience LIKE '%" . mysql_real_escape_string($search_terms) . "%' OR
								members.key_words LIKE '%" . mysql_real_escape_string($search_terms) . "%' OR
								members.key_words LIKE '%" . mysql_real_escape_string($search_terms) . "%' 
							)";
			if ($state)
				$query2 .= " AND members.state='" . mysql_real_escape_string($state) . "'";
			if ($category)
				$query2 .= " AND members.category_id='" . mysql_real_escape_string($category) . "'";
				
			if ($hourly_rate_min || $hourly_rate_max)
			{
				if ($hourly_rate_min)
					$query2 .= " AND members.required_hourly_rate >= '" . mysql_real_escape_string($hourly_rate_min) . "'";
				if ($hourly_rate_max)
					$query2 .= " AND members.required_hourly_rate <= '" . mysql_real_escape_string($hourly_rate_max) . "'";
			}
			else 
			{
				if ($salary_min)
					$query2 .= " AND members.required_salary >= '" . mysql_real_escape_string($salary_min) . "'";
				if ($salary_max)
					$query2 .= " AND members.required_salary <= '" . mysql_real_escape_string($salary_max) . "'";
			}
		
			if ($years_min)
				$query2 .= " AND members.years_experience >= '" . mysql_real_escape_string($years_min) . "'";
			if ($years_max)
				$query2 .= " AND members.years_experience <= '" . mysql_real_escape_string($years_max) . "'";

			if ($debug_msgs) echo "$query2<br />";
			$result2 = mysql_query($query2) or die(mysql_error());
			$num_found = mysql_num_rows($result2);
			if ($debug_msgs) echo "num_found = $num_found<br />";
			while ($rs2 = mysql_fetch_object($result2))
			{
				$member_id = stripslashes($rs2->member_id);
				
				$query3 = "SELECT search_results_candidates_id FROM search_results_candidates WHERE session_id='" . session_id() . "' AND member_id=" . $member_id;
				if ($debug_msgs) echo "$query3<br />";
				$result3 = mysql_query($query3) or die(mysql_error());
				$have_this_one = mysql_num_rows($result3);
				if (!$have_this_one)
				{
					$query3 = "INSERT INTO search_results_candidates SET session_id='" . mysql_real_escape_string(session_id()) . "', unix_time='" . time() . "', member_id=" . $member_id;
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
						search_results_candidates.member_id,
						members.*
					FROM 
						search_results_candidates,
						members
					WHERE
						search_results_candidates.session_id='" . session_id() . "' AND
						search_results_candidates.member_id = members.member_id";
		
		//****************************************************************************************
		// Set up the order by part.
		//****************************************************************************************
/*	
		$desc_for_rev = ($_GET["rev"]) ? "DESC" : "";
		switch ($_GET["sort"])
		{
			case "state":		$sort_order = " members.state $desc_for_rev, members.last_name,first_name";
			
			case "salary":		$salary_min_or_max = ($_GET["rev"]) ? "salary_max" : "salary_min";
								$rate_type = ($hourly_rate) ? "hourly_rate" : $salary_min_or_max;
								$sort_order = " members.$rate_type $desc_for_rev, members.last_name,first_name";
								break;
	
			case "expires":		$sort_order = " members.date_expires $desc_for_rev, members.last_name,first_name";
								break;
	
			case "title":		
			default:			$sort_order = " members.last_name,first_name $desc_for_rev";
								break;
		}
		$query .= " ORDER BY " . $sort_order;
*/	
	
		
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
		$number_of_candidates = mysql_num_rows($result);
		if ($debug_msgs) echo "number_of_candidates = $number_of_candidates<br />";
		if ($number_of_candidates == 0) 	// any candidates ?
		{
			?>We're sorry, but we can't seem to find any candidates that match your search criteria.<br /><br /><?
		}
		else
		{
			$first_show = $range_low;
			$last_show = $first_show + $candidates_per_page - 1;
			if ($last_show > $number_of_candidates)
				$last_show = $number_of_candidates;
	?>
	
			<table width="100%"  border="0"  cellspacing="0" cellpadding="2" align="center">
			<tr>
			  <td align="left" width="50%" valign="top">
              	Showing candidates <? echo $first_show + 1; ?> - <? if ($last_show < $number_of_candidates) echo $last_show + 1 ; else echo $last_show; ?> of <?=$number_of_candidates?>
			  </td>
			  <td align="right" width="50%" valign="top">
				Click =name to view profile. 
				</td>
			  </tr>
			</table>
			<br>
	<?
			//****************************************************************************************
			// RE-Submit the query with pagination.
			//****************************************************************************************
	
			$query .= " LIMIT $range_low,$candidates_per_page";
			if ($debug_msgs) echo "$query<br />";
			$result = db_query($query);
	?>
			<div align="center">
				<table width="100%"   border="1" bordercolor="#dddddd" style="border-collapse:collapse;" cellspacing="0" cellpadding="2">
				<tr bgcolor="#dddddd" height="24">
				  <td align="left"><strong>Name</strong> </td>
				  <td align="center"><strong>State</strong></td>
				  <td align="center"><strong>Compensation</strong></td>
				  <td align="center"><strong>Experience</strong></td>
				  <td align="center"><strong>Favorites</strong></td>
				</tr>
	<?
				$fav_array_content = '';
				$td_counter = 0;
				$row_counter = 0;
				$js_fav_array_index = 0;
				$candidate_counter = $first_show + 1;
				while ($rs = mysql_fetch_object($result))
				{
					$member_id = $rs->member_id;  
								
					$state = stripslashes($rs->state);
					$first_name = stripslashes($rs->first_name);
					$last_name = stripslashes($rs->last_name);
					$required_hourly_rate = stripslashes($rs->required_hourly_rate);
					$required_salary = stripslashes($rs->required_salary);
					$this_candidate_title_id = stripslashes($rs->candidate_title_id);
					$this_candidate_title = stripslashes($rs->candidate_title);
					$years_experience = stripslashes($rs->years_experience);
					
					if (!$this_candidate_title) $this_candidate_title = $candidate_title_helper;
					if (!$required_hourly_rate) $required_hourly_rate = 0;
					if (!$required_salary) $required_salary = "TBD";
	?>
					 <tr <? if ($row_counter & 1) { ?> bgcolor="#eeeeee"<? } ?>  class="tbl_data">
			
					   <td valign="middle" height="24" align="left">
							  <a href="/search-candidate-details.php?member_id=<?=$member_id?>&title=<?=$this_candidate_title?>" class="textlink"><?=$first_name?> <?=$last_name?></a> <span style="color:#ccc">(<?=$member_id?>)</span>
						 </td>      
					   
					   <td valign="middle" align="center"> 
						  <?=$state?>
					  </td>
	
					   <td valign="middle" align="center">
							<? 
								if ($required_hourly_rate) 
									echo '$' . $required_hourly_rate . "/hr";
								else
									echo '$' . $required_salary . 'K';
							?>
					   </td>
					   
					   <td valign="middle" align="center"> 
						  <?=$years_experience?> years
					  </td>
	
					   <td valign="middle" align="center"><? 
							$query3 = "SELECT favorites_candidates_id FROM favorites_candidates WHERE employer_member_id=" . $_SESSION["member_id"] . " AND  candidate_member_id='" . $member_id . "'";
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
							<img id="fav_status_<?=$member_id?>" src="/images/members/<?=$fav_img?>" width="19" height="19" onclick="return change_seeker_fav_status('<?=$member_id?>', '<?=$js_fav_array_index?>');" /></td>
	
					</tr>
	<?
					$row_counter++;
					$candidate_counter++;
					$js_fav_array_index++;
	
				//	$query3 = "DELETE FROM search_results_candidates WHERE session_id='" . session_id() . "' AND member_id=" . $member_id;
				//	$result3 = mysql_query($query3) or die(mysql_error());
				}
	?>
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
  		&nbsp; &nbsp; Select a candidate title<br />
  		&nbsp; &nbsp; Enter a candidate title<br />
     <?  
	}
}

// NOTE: The javascript below needs to be in the file and below the above PHP code, since $fav_array_content is set above, and used below:
?>
<script type="text/javascript">
var fav_array = [<?=$fav_array_content?>]; 
function change_seeker_fav_status(member_id, fav_index)
{
	var current_status = fav_array[fav_index];
	var img_id = "fav_status_" + member_id;
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
	
	url = "/members/change_seeker_fav_status.php?candidate_id=" + member_id + "&sid=<? echo session_id(); ?>&employer_id=<?=$_SESSION["member_id"]?>&status=" + fav_array[fav_index];
//	alert(url);
	issue_query(url, ajax_debug_msg_call_back); 
}
</script>
<br /><br />


