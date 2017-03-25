<div style="margin-left:20px;">
<?
$debug_msgs = 0;
  
  $job_id = $_GET["job_id"];
  if (!$job_id) $job_id = 0;
  if ($job_id && $job_id > 0)
  {
        $query = "SELECT * FROM jobs WHERE job_id=" . $job_id . "";
        $result = db_query($query);
        if (!$result) // query failed
            exit;
        $rs = mysql_fetch_object($result);
        $category_id = trim(stripslashes($rs->category_id));
        $enabled = ($rs->enabled) ? 1 : 0;
        $member_id = trim(stripslashes($rs->member_id));
        $job_title_id = trim(stripslashes($rs->job_title_id));
        $job_title = trim(stripslashes($rs->job_title));
        $job_code = trim(stripslashes($rs->job_code));
        $city = trim(stripslashes($rs->city));
        $state = trim(stripslashes($rs->state));
        $run_duration = trim(stripslashes($rs->run_duration));
        $date_expires = trim(stripslashes($rs->date_expires));
        $hourly_rate = trim(stripslashes($rs->hourly_rate));
        $salary_min = trim(stripslashes($rs->salary_min));
        $salary_max = trim(stripslashes($rs->salary_max));
        $tips_min = trim(stripslashes($rs->tips_min));
        $tips_max = trim(stripslashes($rs->tips_max));
        $travel = trim(stripslashes($rs->travel));
        $benefits = trim(stripslashes($rs->benefits));
        $description = trim(stripslashes($rs->description));
        $required_education = trim(stripslashes($rs->required_education));
        $required_experience = trim(stripslashes($rs->required_experience));
        $qualifications = trim(stripslashes($rs->qualifications));
        $respond = trim(stripslashes($rs->respond));
        $meta_description = trim(stripslashes($rs->meta_description));
        $meta_keywords = trim(stripslashes($rs->meta_keywords));
		$contact_name = trim(stripslashes($rs->contact_name));
		$contact_company = trim(stripslashes($rs->contact_company));
		$contact_email = trim(stripslashes($rs->contact_email));
		$contact_url = trim(stripslashes($rs->contact_url));
		$contact_phone_area_code = trim(stripslashes($rs->contact_phone_area_code));
		$contact_phone_prefix = trim(stripslashes($rs->contact_phone_prefix));
		$contact_phone_last_4 = trim(stripslashes($rs->contact_phone_last_4));
		$contact_cell_area_code = trim(stripslashes($rs->contact_cell_area_code));
		$contact_cell_prefix = trim(stripslashes($rs->contact_cell_prefix));
		$contact_cell_last_4 = trim(stripslashes($rs->contact_cell_last_4));
		$contact_fax = trim(stripslashes($rs->contact_fax));
        @mysql_free_result($result);
		
		if ($debug_msgs) echo "member_id = $member_id<br />";

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
	}
	
	$query = "UPDATE jobs set view_counter = view_counter + 1 WHERE job_id=" . $job_id;
	if ($debug_msgs) echo $query . "<br />";
	$result = db_query($query);

	list($the_year, $the_month, $the_day) = explode("-", $date_expires);
	switch($the_month)
	{
		case 1:		$the_month = "January"; break;
		case 2:		$the_month = "February"; break;
		case 3:		$the_month = "March"; break;
		case 4:		$the_month = "April"; break;
		case 5:		$the_month = "May"; break;
		case 6:		$the_month = "June"; break;
		case 7:		$the_month = "July"; break;
		case 8:		$the_month = "August"; break;
		case 9:		$the_month = "September"; break;
		case 10:	$the_month = "October"; break;
		case 11:	$the_month = "November"; break;
		case 12:	$the_month = "December"; break;
	}


	// make sure the website URL has the "http://" in front of it
	 $website_url = stripslashes($contact_url); 
	 $website_url = str_replace("http://", "", $website_url);
	 $website_url = "http://" . $website_url;
	 
	$query2 = "SELECT company_logo FROM members WHERE member_id=" . $member_id;
	if ($debug_msgs) echo $query2 . "<br />";
	$result2 = mysql_query($query2) or die(mysql_error());
	$rs2 = mysql_fetch_object($result2);
	$company_logo = trim(stripslashes($rs2->company_logo));
	@mysql_free_result($result2);

	$query2 = "SELECT bookmarks_jobs_id FROM bookmarks_jobs WHERE member_id=" . $member_id;
	if ($debug_msgs) echo $query2 . "<br />";
	$result2 = mysql_query($query2) or die(mysql_error());
	$num_bookmarks = mysql_num_rows($result2);
	
	//echo "respond = $respond<br />";

?>

<? /*
<table width="870" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="150" align="left"></td>
    <td width="700" align="right">
    
      <a href="search-jobs.php<?=$_SESSION["search_parms"]?>" class="textlink3">Start a New Search</a> &nbsp; 
      <a href="search-results.php<?=$_SESSION["search_parms"]?>" class="textlink3">Return to Search Results</a> &nbsp; 
    
    
    </td>
  </tr>
</table>

	<div style="line-height:5px;"><br></div>

<table width="875" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="33" style="background-image:url(../images/details-bar2.gif); background-repeat:repeat"  align="center"><h4><? echo stripslashes($rs->job_title); ?> </h4></td>
  </tr>
</table>
*/ ?>

<style type="text/css">
<!--
.greyed_out {color: #cccccc}
-->
</style>
<? 
	if ($logo) 
	{ 
		if (isset($_SESSION["logged_in"])) 
			$back_path = "../";
		else
			$back_path = "";
		list($width, $height) = @getimagesize($back_path . $logo);
		$new_width = $width;
		$new_height = $height;
	
		//echo "image starting dimensions: width = $width, height = $height<br>";
		
		if ($width > 200)
		{
			$adjust_factor = 200 / $width;
			$new_width = (int)($width * $adjust_factor);
			$new_height = (int)($height * $adjust_factor);
		}
		
		if ($height > 200)
		{
			$adjust_factor = 200 / $height;
			$new_width = (int)($width * $adjust_factor);
			$new_height = (int)($height * $adjust_factor);
		}
	?>
	
		<? if (isset($_SESSION["logged_in"])) { ?>
			<img src="<? if (isset($_SESSION["logged_in"])) echo "../"; ?><?=$logo?>" hspace="0" vspace="0" border="0" width="<?=$new_width?>" height="<?=$new_height?>"><br><br>
		<? } 
	}	
	
		
	?>

	<span style="font-size:14px; color:00476d">
    <strong>Job Title</strong>: <?=$job_title?><br>
    <strong>Job Code:</strong> <?=$job_code?><br>
    
<? if ($date_expires != '0000-00-00') { ?>
    <strong>Listing Expires: </strong> <?=$the_month?> <?=$the_day?>, <?=$the_year?>.<br>
  <? } ?>                      
	<br />
    <strong>Company:</strong> <?=$contact_company?><br>
    <strong>Location</strong>: <? 
                                if ($city) 
                                    echo $city; 
                                if ($city && $state)
                                    echo ", ";
                                if ($state)
                                    echo $state;
                                ?><br />

    <strong>Compensation</strong> 
    
  <? 	if ($hourly_rate) 
        { 
            ?>$<?=$hourly_rate?>/hr<? 
        } 
        else if ($salary_min || $salary_max) 
        {
            ?>$<?=$compenstation_min?>K</strong> (<?=$rs->salary_min?>K/<?=$rs->bonus_min?>K/<?=$rs->commission_min?>K)<? 
        }
     ?> 
    <br />
    <br />
    
<? if (!$summary_only) { ?>

    <strong>Description:</strong> <? echo nl2br($description); ?>
    <br />
    <br />
    <strong>Qualifications:</strong> <? echo nl2br($qualifications); ?>
    <br />
    <br />
    <strong>Required Education:</strong> <? echo nl2br($required_education); ?>
    <br />
    <br />
    <strong>Required Experience:</strong> <? echo nl2br($required_experience); ?>
    <br />
    <br />
    <strong>Benefits:</strong> <?=$benefits?>
    <br />
    <strong>Travel: </strong><? 
		switch($travel)
		{
			  case 1: echo "No Travel";  break;
			  case 2: echo "0% to 25%";  break;
			  case 3: echo "25% to 50%";  break;
			  case 4: echo "50% to 75%";  break;
			  case 5: echo "75% to 100%";  break;
		}
	 ?>
    <br />


	
</div>
<br>

<? } ?>

    

</div>