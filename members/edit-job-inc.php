<script LANGUAGE='JavaScript'>
function verify_delete(title) 
{
	var agree=confirm("Are you sure you wish to DELETE the job listing entitled " + title + "?  \n\nThis operation will permanantly remove the job listing from the website database and cannot be undone! \n\nIf you are absolutely certain you wish to delete this listing, click OK. \n\nTo cancel this operation, click CANCEL. ");
	if (agree) {
		return true;
	} else {
		return false;
	}
}
</script>

<strong><? if ($_GET["new"] == 1) echo "Add a New Job Listing"; else echo "Edit Job Listing"; ?></strong> &nbsp; &nbsp; &nbsp; <a href="jobs.php">Return to jobs...</a> <br>
  <br>

<?
if (!$member_id) $member_id = $_SESSION["member_id"];
if (!$member_id) $member_id = 0;

$job_id = ($_GET["job_id"]) ? $_GET["job_id"] : 0;
if ($job_id)
{
	$query = "SELECT * FROM jobs WHERE member_id=" . $member_id . " AND job_id=" . $job_id . "";
	//echo $query . "<br>";
	$result = db_query($query);
	if (!$result) // query failed
		exit;
	$rs = mysql_fetch_object($result);

	$category_id = trim(stripslashes($rs->category_id));
	$enabled = ($rs->enabled) ? 1 : 0;
	$job_title_id = trim(stripslashes($rs->job_title_id));
	$job_title = trim(stripslashes($rs->job_title));
	$job_code = trim(stripslashes($rs->job_code));
	$city = trim(stripslashes($rs->city));
	$state = trim(stripslashes($rs->state));
	
	$apply_locally = ($rs->apply_locally) ? 1 : 0;
	$email_for_job_applies = trim(stripslashes($rs->email_for_job_applies));
	$apply_remotely = ($rs->apply_remotely) ? 1 : 0;
	$apply_url = trim(stripslashes($rs->apply_url));
	
	$run_duration = trim(stripslashes($rs->run_duration));
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
	
	if ($job_id && !$job_code)
		$job_code = "RJ-" . $job_id;
}

if (!$job_id && $member_id)
{
	$query = "SELECT * FROM members WHERE member_id=" . $member_id . "";
	//echo $query . "<br>";
	$result = db_query($query);
	if (!$result) // query failed
		exit;
	$rs = mysql_fetch_object($result);
	$contact_name = trim(stripslashes($rs->first_name)) . " " . trim(stripslashes($rs->last_name));
	$contact_company = trim(stripslashes($rs->company_name));
	$contact_email = trim(stripslashes($rs->email));
	$contact_url = trim(stripslashes($rs->website_address));
	$contact_phone_area_code = trim(stripslashes($rs->phone_area_code));
	$contact_phone_prefix = trim(stripslashes($rs->phone_prefix));
	$contact_phone_last_4 = trim(stripslashes($rs->phone_last_4));
	$contact_cell_area_code = trim(stripslashes($rs->cell_phone_area_code));
	$contact_cell_prefix = trim(stripslashes($rs->cell_phone_prefix));
	$contact_cell_last_4 = trim(stripslashes($rs->cell_phone_last_4));
	@mysql_free_result($result);

	$email_for_job_applies = $contact_email;
	$apply_url = $contact_url;
	
	
	$contact_url = str_replace("http://", "", $contact_url);
	$contact_url = str_replace("www.", "", $contact_url);
}
?>
<form name="listing_form" method="post" action="update-job.php">
<input type="hidden" name="token" value="<? $_SESSION["token"] = sha1(uniqid(rand(), TRUE)); echo $_SESSION["token"]; ?>" />
<input type="hidden" name="sid"   value="<? echo session_id(); ?>">
<input name="job_id" type="hidden" value="<?=$job_id?>">
<input name="member_id" type="hidden" value="<?=$member_id?>">
<input name="new" type="hidden" value="<?=$_GET["new"]?>">
<table width="100%" style=" width:100%; max-width:800px"  border="0" cellspacing="0" cellpadding="0">
<tr>
  <td colspan="2" height="7"></td>
</tr>
<tr style="background-color:#EEEEEE">
  <td height="27"  align="left" colspan="2">&nbsp; <strong>Listing Control</strong></td>
</tr>
<tr>
  <td colspan="2" height="12"></td>
</tr>
<tr>
  <td align="right"><strong>Publish Job</strong>:&nbsp;&nbsp;</td>
  <td align="left"><input name="enabled" type="checkbox" value="1" <? if ($enabled) echo "checked"; ?> /> <em style="color:#CCC">Check this box to show this job on the site</em></td>
</tr>
<tr>
	<td colspan="2" height="12"></td>
</tr>
<tr>
  <td align="right">Listing Duration:&nbsp;&nbsp;</td>
  <td align="left"><select name="run_duration" id="run_duration"  style="width:120px;">
  <option value="7"  <? if ($run_duration == 7)  echo "selected"; ?> >7 Days</option>
  <option value="15"  <? if ($run_duration == 15)  echo "selected"; ?> >15 Days</option>
  <option value="30"  <? if ($run_duration == 30)  echo "selected"; ?> >30 Days</option>
  <option value="45"  <? if ($run_duration == 45)  echo "selected"; ?> >45 Days</option>
  <option value="60"  <? if ($run_duration == 60)  echo "selected"; ?> >60 Days</option>
  <option value="90"  <? if ($run_duration == 90)  echo "selected"; ?> >90 Days</option>
</select></td>
</tr>
<tr>
	<td colspan="2" height="12">&nbsp;</td>
</tr>
<tr style="background-color:#EEEEEE">
  <td height="27" align="left" colspan="2">&nbsp; <strong>Job Information</strong></td>
</tr>
<tr>
  <td colspan="2" height="12"></td>
</tr>

<? /*    
<tr>
  <td height="22" align="right" >Job Category:&nbsp;&nbsp;</td>
  <td  align="left"><select name="category_id" id="category_id"  style="width:220px;">
					<option value="0"  selected >All Categories</option>
					<?
						$query2 = "SELECT * FROM categories ORDER BY category_name";
						$result2 = mysql_query($query2) or die(mysql_error());
						while ($rs2 = mysql_fetch_object($result2))
						{ ?>
							<option value="<?=$rs2->category_id?>"  <? if ($category == $rs2->category_id) echo "selected"; ?>><? echo stripslashes($rs2->category_name); ?></option>
					<? }
						@mysql_free_result($result2);
					?>
					<option value="99" <? if ($category == 99) echo "selected"; ?>>Other</option>
					</select>
		  </td>
  </tr>
  
	  <tr>
		<td colspan="2" height="7"></td>
	  </tr>
*/ ?>         

<tr>
  <td height="22" align="right" >Job Title:&nbsp;&nbsp;</td>
  <td  align="left"><select name="job_title_id" id="job_title_id"  style="width:220px;">
					<option  value="0">Select</option>
					<?
						$query2 = "SELECT * FROM job_titles ORDER BY job_title";
						$result2 = mysql_query($query2) or die(mysql_error());
						while ($rs2 = mysql_fetch_object($result2))
						{ ?>
							<option value="<?=$rs2->job_title_id?>"  <? if ($job_title_id == $rs2->job_title_id) echo "selected"; ?>><? echo stripslashes($rs2->job_title); ?></option>
					<? }
						@mysql_free_result($result2);
					?>
					<option value="99" <? if ($category == 99) echo "selected"; ?>>Other</option>
					</select>
		  </td>
  </tr>
<tr>
  <td align="right">or enter:&nbsp;&nbsp;</td>
  <td align="left"><input type="text" name="job_title" size="50" maxlength="255" onfocus="this.select();" value="<? echo stripslashes($job_title); ?>"></td>
</tr>
<tr>
  <td colspan="2" height="15"></td>
</tr>
<tr>
  <td align="right">Job Code:&nbsp;&nbsp;</td>
  <td align="left"><input type="text" name="job_code" size="20" maxlength="20" value="<? echo stripslashes($job_code); ?>" onfocus="this.select();" onChange="return mark_changed();"></td>
</tr>
<tr>
  <td align="right">&nbsp;</td>
  <td align="left"><em style="color:#CCC">If Job Code is not entered, it will automatically be created for you</em></td>
</tr>
<tr>
	<td colspan="2" height="12">&nbsp;</td>
</tr>


  
</tr>
  <td align="right">Hourly Rate:&nbsp;&nbsp;</td>
  <td align="left">$<input type="text" name="hourly_rate" size="10" maxlength="10" value="<? echo stripslashes($hourly_rate); ?>" onfocus="this.select();" onChange="return mark_changed();"></td>
</tr>
<tr>
	<td colspan="2" height="5"></td>
</tr>
  <tr>
  <td align="right">Or Annaul Salary:&nbsp;&nbsp;</td>
  <td align="left">
	  <select name="salary_min" id="salary_min" onfocus="this.select();" onChange="return mark_changed();">
	  <option value="0">0</option>
	  <? for ($dollar_value = 10; $dollar_value <= 400; $dollar_value += 5) { ?>
		<option value="<?=$dollar_value?>" <? if ($salary_min == $dollar_value) echo "selected"; ?>>$<?=$dollar_value?>K<? if ($dollar_value == 400) echo "+"; ?></option>
	  <? } ?>
	  <option value="1" <? if ($salary_min == 1) echo "selected"; ?>>TBD</option>
	  </select> <span class="min_max">(min)</span> - 
	  
	  <select name="salary_max" id="salary_max" onfocus="this.select();" onChange="return mark_changed();">
	  <option value="0">0</option>
	  <? for ($dollar_value = 10; $dollar_value <= 400; $dollar_value += 5) { ?>
		<option value="<?=$dollar_value?>" <? if ($salary_max == $dollar_value) echo "selected"; ?>>$<?=$dollar_value?>K<? if ($dollar_value == 400) echo "+"; ?></option>
	  <? } ?>
	  <option value="1" <? if ($salary_max == 1) echo "selected"; ?>>TBD</option>
	  </select> <span class="min_max">(max)</span>
  </td>
  </tr>
  <tr>
  <td align="right">Tips:&nbsp;&nbsp;</td>
  <td align="left">
		  <select name="tips_min" id="tips_min" onfocus="this.select();" onChange="return mark_changed();">
		  <option value="0">0</option>
		  <? for ($dollar_value = 10; $dollar_value <= 400; $dollar_value += 5) { ?>
			<option value="<?=$dollar_value?>" <? if ($tips_min == $dollar_value) echo "selected"; ?>>$<?=$dollar_value?>K<? if ($dollar_value == 400) echo "+"; ?></option>
		  <? } ?>
		  
		  </select> <span class="min_max">(min)</span> - 
		  
		  <select name="tips_max" id="tips_max" onfocus="this.select();" onChange="return mark_changed();">
		  <option value="0">0</option>
		  <? for ($dollar_value = 10; $dollar_value <= 400; $dollar_value += 5) { ?>
			<option value="<?=$dollar_value?>" <? if ($tips_max == $dollar_value) echo "selected"; ?>>$<?=$dollar_value?>K<? if ($dollar_value == 400) echo "+"; ?></option>
		  <? } ?>
		  </select> <span class="min_max">(max)</span>
  </td>
  </tr>
<tr>
	<td colspan="2" height="12">&nbsp;</td>
</tr>
  <tr>
	<td align="right">Travel:&nbsp;&nbsp;</td>
	<td align="left">
	<select name="travel" id="travel">
	  <option value="0">Select</option>
	  <option value="1"  <? if ($travel == 1)  echo "selected"; ?>>No Travel</option>
	  <option value="2"  <? if ($travel == 2)  echo "selected"; ?>>0% to 25%</option>
	  <option value="3"  <? if ($travel == 3)  echo "selected"; ?>>25% to 50%</option>
	  <option value="4"  <? if ($travel == 4)  echo "selected"; ?>>50% to 75%</option>
	  <option value="5"  <? if ($travel == 5)  echo "selected"; ?>>75% to 100%</option>
	</select>
	</td>
  </tr>

<tr>
	<td colspan="2" height="12">&nbsp;</td>
</tr>

<tr style="background-color:#EEEEEE">
  <td height="27" align="left" colspan="2">&nbsp; <strong>Job Location</strong></td>
</tr>
<tr>
  <td colspan="2" height="12"></td>
</tr>
  <tr>
	<td align="right">City: &nbsp; </td>
	<td align="left"><input type="text" name="city" size="40" maxlength="255" value="<?=$city?>" onfocus="this.select();"></td>
  </tr>
  <tr>
	<td align="right">State: &nbsp; </div></td>
	<td align="left"><select name="state">
		<option value=''>Select</option>
		<? require("incld/state_list_inc.php"); ?>
	</select></td>
  </tr>
<tr>
  <td colspan="2" height="7"></td>
</tr>



<tr style="background-color:#EEEEEE">
  <td height="27" align="left" colspan="2">&nbsp; <strong>Job Application</strong></td>
</tr>
<tr>
  <td colspan="2" height="12"></td>
</tr>
<tr>
  <td align="right">Apply for job:&nbsp;&nbsp;</td>
  <td align="left">
			  <input name="apply_locally" type="checkbox" value="1" <? if ($apply_locally || !$job_id) echo "checked"; ?>> 
			  On this website
		  </td>
</tr>
<tr>
  <td colspan="2" height="7"></td>
</tr>
<tr>
  <td align="right"><sup>*</sup>Email to:&nbsp;&nbsp;</td>
  <td align="left"><input type="text" name="email_for_job_applies" size="60" maxlength="150" value="<?=$email_for_job_applies?>" onfocus="this.select();" onChange="return mark_changed();"></td>
</tr>
<tr>
  <td colspan="2" height="7"></td>
</tr>
<tr>
  <td></td>
  <td align="left">&nbsp; <em><sup>*</sup>Email address to send applications to</em></td>
</tr>
<tr>
  <td colspan="2" height="18"></td>
</tr>
<tr>
  <td align="right">Apply for job:&nbsp;&nbsp;</td>
  <td align="left">
			  <input name="apply_remotely" type="checkbox" value="1" <? if ($apply_remotely) echo "checked"; ?>> 
			  On Company's website
		  </td>
</tr>
<tr>
  <td colspan="2" height="7"></td>
</tr>
<tr>
  <td align="right"><sup>**</sup>Apply URL:&nbsp;&nbsp;</td>
  <td align="left"><input type="text" name="apply_url" size="60" maxlength="150" value="<? if ($job_id && $apply_remotely) echo stripslashes($apply_url); ?>" onfocus="this.select();" onChange="return mark_changed();"></td>
</tr>
<tr>
  <td colspan="2" height="7"></td>
</tr>
<tr>
  <td></td>
  <td align="left"> &nbsp;<em><sup>**</sup>Web Address of job application page on your website</td>
</tr>
<tr>
  <td colspan="2" height="18"></td>
</tr>



<tr style="background-color:#EEEEEE">
  <td height="27" align="left" colspan="2">&nbsp; <strong>Descriptions and Details</strong></td>
</tr>
<tr>
  <td colspan="2" height="12"></td>
</tr>
  <td align="right">Benefits:&nbsp;&nbsp;</td>
  <td align="left"><input type="text" name="benefits" size="60" maxlength="150" value="<? echo stripslashes($benefits); ?>" onfocus="this.select();" onChange="return mark_changed();"></td>
</tr>
<tr>
  <td colspan="2" height="7"></td>
</tr>

<tr>
  <td align="right">Job Description:&nbsp;&nbsp;</td>
  <td align="left"><textarea name="description" cols="60" rows="5" onfocus="this.select();" onChange="return mark_changed();"><? echo stripslashes($description); ?></textarea></td>
</tr>
<tr>
  <td colspan="2" height="7"></td>
</tr>
<tr>
  <td align="right">Required Education:&nbsp;&nbsp;</td>
  <td align="left"><textarea name="required_education" cols="60" rows="5" onfocus="this.select();" onChange="return mark_changed();"><? echo stripslashes($required_education); ?></textarea></td>
</tr>
<tr>
  <td colspan="2" height="7"></td>
</tr>
<tr>
  <td align="right">Required Experience:&nbsp;&nbsp;</td>
  <td align="left"><textarea name="required_experience" cols="60" rows="5" onfocus="this.select();" onChange="return mark_changed();"><? echo stripslashes($required_experience); ?></textarea></td>
</tr>
<tr>
  <td colspan="2" height="7"></td>
</tr>
<tr>
  <td align="right">Other Qualifications:&nbsp;&nbsp;</td>
  <td align="left"><textarea name="qualifications" cols="60" rows="5" onfocus="this.select();" onChange="return mark_changed();"><? echo stripslashes($qualifications); ?></textarea></td>
</tr>
<tr>
  <td colspan="2" height="7"></td>
</tr>
<tr>
  <td align="right">Ad Meta Description:&nbsp;&nbsp;</td>
  <td align="left"><textarea name="meta_description" cols="60" rows="3" onfocus="this.select();" onChange="return mark_changed();"><? echo stripslashes($meta_description); ?></textarea></td>
</tr>
<tr>
  <td colspan="2" height="7"></td>
</tr>
<tr>
  <td align="right">Ad Meta Keywords:&nbsp;&nbsp;</td>
  <td align="left"><textarea name="meta_keywords" cols="60" rows="3" onfocus="this.select();" onChange="return mark_changed();"><? echo stripslashes($meta_keywords); ?></textarea></td>
</tr>
<tr>
  <td colspan="2" height="19"></td>
</tr>



<tr style="background-color:#EEEEEE">
  <td height="27" align="left" colspan="2">&nbsp; <strong>Job Contact Information</strong></td>
</tr>
  <tr>
	<td>&nbsp;</td>
	<td  height="25" class="form_top">Contact information is filled in for your convenience.  You may edit or delete <br>
	  this information to remain confidential.</td>
</tr>
<tr>
  <td colspan="2">&nbsp;</td>
</tr>
  <tr>
	<td  align="right"><span class="style1"></span><strong>Respond Via:</strong> &nbsp; </td>
	<td  align="left">
		<input name="respond" type="radio" value="1" <? if ($respond != 2) echo "checked"; ?>>Email &nbsp; 
		<input name="respond" type="radio" value="2" <? if ($respond == 2) echo "checked"; ?>>Website &nbsp; 
		
		</td>
  </tr>
<tr>
  <td colspan="2">&nbsp;</td>
</tr>
  <tr>
	<td  align="right"><span class="style1"></span><strong>Name</strong> &nbsp; </td>
	<td  align="left"><input type="text" name="contact_name" size="40" maxlength="255" value="<?=$contact_name?>" onfocus="this.select();" onChange="return mark_changed();"></td>
  </tr>
  <tr>
	<td align="right"><strong>Company Name</strong> &nbsp; </td>
	<td align="left"><input type="text" name="contact_company" size="40" maxlength="255" value="<?=$contact_company?>" onfocus="this.select();" onChange="return mark_changed();"></td>
  </tr>
  <tr>
	<td colspan="2" height="10" class="form_top">&nbsp;</td>
  </tr>

  <tr>
	<td align="right"><span class="style1"><sup>**</sup></span><strong>Email</strong> &nbsp; </td>
	<td align="left"><input type="text" name="contact_email" size="40" maxlength="255" value="<?=$contact_email?>" onfocus="this.select();" onChange="return mark_changed();"> 
	</td>
</tr>
  <tr>
	<td align="right"><span class="style1"><sup>**</sup></span><strong>Website</strong> &nbsp; </td>
	<td align="left">http://www.<input type="text" name="contact_url" size="40" maxlength="255" value="<?=$contact_url?>" onfocus="this.select();" onChange="return mark_changed();"></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
	<td><span class="style1"><sup>**</sup></span><em>Note:  Either valid email or company website required, not both.</em></td>
</tr>
  <tr>
	<td colspan="2" height="10" class="form_top"></td>
  </tr>
  <tr>
	<td align="right"><strong>Phone</strong> &nbsp; </td>
	<td align="left">
(<input type="text" name="contact_phone_area_code" size="3" maxlength="3" style="width:32px;" value="<?=$contact_phone_area_code?>" onfocus="this.select();">)&nbsp;
<input  type="text" name="contact_phone_prefix"    size="3" maxlength="3" style="width:32px;" value="<?=$contact_phone_prefix?>"    onfocus="this.select();"> - 
<input  type="text" name="contact_phone_last_4"    size="4" maxlength="4" style="width:45px;" value="<?=$contact_phone_last_4?>"    onfocus="this.select();">
	</td>
  </tr>
  <tr>
	<td align="right"><strong>Mobile Phone</strong> &nbsp; </td>
	<td align="left">
(<input type="text" name="contact_cell_area_code" size="3" maxlength="3" style="width:32px;" value="<?=$contact_cell_area_code?>" onfocus="this.select();">)&nbsp;
<input  type="text" name="contact_cell_prefix"    size="3" maxlength="3" style="width:32px;" value="<?=$contact_cell_prefix?>"    onfocus="this.select();"> - 
<input  type="text" name="contact_cell_last_4"    size="4" maxlength="4" style="width:45px;" value="<?=$contact_cell_last_4?>"    onfocus="this.select();">
	</td>
  </tr>


<tr>
  <td colspan="2">&nbsp;</td>
</tr>
<tr>
  <td align="right">&nbsp;</td>
  <td align="left"><input name="submit" type="submit" value="<? if ($_GET["new"] == 1) echo "Add Listing"; else echo "Save Changes To Listing"; ?>" onClick="return check_listing_form();">&nbsp;</td>
</tr>
</table>
</form>
  <br><br>

<? @mysql_free_result($result); ?>
