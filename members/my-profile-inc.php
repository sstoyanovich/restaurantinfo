<?
if ($_GET["adm"] == 1 && $_SESSION["member_id"] == 1 && $_SESSION["member_type"] == "A")
	$member_id = $_GET["id"];
else
	$member_id = $_SESSION["member_id"];

if (!$member_id || !$_SESSION["logged_in"])
{
	?>Your login session may have expired.  <a href="https://restaurantinfo.com/login.php">Please login again</a><br /><?
}
else
{
	$query3 = "SELECT * FROM members WHERE member_id='" . mysql_real_escape_string($member_id) . "'";
	if ($debug_msgs) echo $query3 . "<br />";
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	$member_type = stripslashes($rs3->member_type);
	$job_title_id = stripslashes($rs3->job_title_id);
	$job_title = stripslashes($rs3->job_title);
	$years_experience = stripslashes($rs3->years_experience);
	$required_hourly_rate = stripslashes($rs3->required_hourly_rate);
	$required_salary = stripslashes($rs3->required_salary);
	$profile_photo = stripslashes($rs3->profile_photo);
	$resume_file = stripslashes($rs3->resume_file);
	$resume_upload_date = stripslashes($rs3->resume_upload_date);
	$first_name = stripcslashes($rs3->first_name);
	$last_name = stripcslashes($rs3->last_name);
	$work_experience = stripslashes($rs3->work_experience);
	$education = stripslashes($rs3->education);
	$company_logo = stripslashes($rs3->company_logo);
	$profile_bio = stripslashes($rs3->profile_bio);
	$key_words = stripslashes($rs3->key_words);
	$show_profile = (stripslashes($rs3->show_profile)) ? 1 : 0;
	@mysql_free_result($result3);

	if (!$_SESSION["token"])
		$_SESSION["token"] = sha1(uniqid(rand(), TRUE));
?>
          <img src="/images/headers/profile.jpg" width="300" height="27" alt="My Profile" />
    <br />

    <form action="update-profile.php" method="post"  name="profile" enctype="multipart/form-data">
    <input type="hidden" name="member_id" value="<?=$member_id?>" />
    <input type="hidden" name="member_token" value="<?=$member_token?>" />
    <input type="hidden" name="admin_edit" value="<?=$_GET["adm"]?>" />
    <input type="hidden" name="token"     value="<? echo $_SESSION["token"]; ?>" />
    <input type="hidden" name="sid"       value="<? echo session_id(); ?>">

    <table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>
      <tr>
				<? echo "Welcome " . $first_name . " " . $last_name; ?>
        <td align="right" width="25%">Show Profile: &nbsp; </td>
        <td align="left" width="75%"><input name="show_profile" type="checkbox" value="1" <? if ($show_profile) echo "checked"; ?> />
        				  <em>Check this box to show your  profile</em></td>
      </tr>
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>

<? if ($member_type == "C") { ?>
	<tr>
      <td height="22" align="right" >Job Title:&nbsp;&nbsp;</td>
      <td  align="left"><select name="job_title_id" id="job_title_id"  style="width:250px;">
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
						</select> (select or enter below)
              </td>
      </tr>

      <tr>
        <td align="right"></td>
        <td align="left"><input type="text" name="job_title" size="40" maxlength="255" style="width:250px" value="<?=$job_title?>" onfocus="this.select();">
       				 &nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>
	<tr>
      <td height="22" align="right" >Experience:&nbsp;&nbsp;</td>
      <td  align="left"><select name="years_experience" id="years_experience"  style="width:75px;">
    					<option  value="0">0</option>
                        <?
							for ($year_count = 1; $year_count <= 50; $year_count++)
                            { ?>
                                <option value="<?=$year_count?>"  <? if ($year_count == $years_experience) echo "selected"; ?>><?=$year_count?></option>
                        <? }
                            @mysql_free_result($result2);
                        ?>
						</select> year(s)
              </td>
      </tr>
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>

    </tr>
      <td align="right">Required Rate:&nbsp;&nbsp;</td>
      <td align="left">$<input type="text" name="required_hourly_rate" style="width:75px;" value="<? echo stripslashes($required_hourly_rate); ?>" onfocus="this.select();" onChange="return mark_changed();"> per hour</td>
    </tr>
    <tr>
        <td colspan="2" height="5"></td>
    </tr>
      <tr>
      <td align="right">Required Salary:&nbsp;&nbsp;</td>
      <td align="left">$<select name="required_salary" id="salary_min" onfocus="this.select();" onChange="return mark_changed();" style="width:75px;" >
          <option value="0">0</option>
          <?
		  for ($dollar_value = 10; $dollar_value <= 400; $dollar_value += 5)
		  {
		  	  ?><option value="<?=$dollar_value?>" <? if ($required_salary == $dollar_value) echo "selected"; ?>>$<?=$dollar_value?>K<? if ($dollar_value == 400) echo "+"; ?></option><?
		  }
		  ?>
          <option value="1" <? if ($salary_min == 1) echo "selected"; ?>>TBD</option>
          </select> per year
      </td>
      </tr>
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>




      <tr>
          <td align="right"  valign="top">Resume</strong>: &nbsp;</td>
          <td align="left" resume_file="top">
              <? if ($resume_file) {

			  	 if (strstr($resume_file, ".pdf"))
				 	$icon = "/images/layout/pdf.gif";
				else
				 	$icon = "/images/layout/word-doc.gif";
			  ?>
              	<table border="0" cellspacing="0" cellpadding="5">
                <tr>
                  <td width="64"><img src="<?=$icon?>" height="50" border="0"></td>
                  <td width="36"><a href="/resumes/<?=$resume_file?>" target="_blank"><? if (strstr($resume_file, ".pdf")) echo "View"; else echo "Download"; ?></a></td>
                </tr>
              </table>
                  Resume uploaded: <?=$resume_upload_date?>
                  <br />
                  <input name="delete_resume_file" type="checkbox" value="1">
                  Delete this Resume<br><em>To change your Resume, delete the current one, then upload the new one.</em>
              <? } else { ?>
            	  <input type="file" name="resume_file" size="20">
              <? } ?>
          </td>
      </tr>
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>
<? } ?>

<? if ($member_type == "E") { ?>

          <tr>
              <td align="right"  valign="top">Company Logo</strong>: &nbsp; <br /><em style="color:#999">(optional)</em> &nbsp;</td>
              <td align="left" valign="top" >
                  <? if ($company_logo) { ?>
					 <img src="/company_logos/<?=$company_logo?>" width="100%" border="0">
                      <br>
                      <input name="delete_company_logo" type="checkbox" value="1">
                      Delete this Logo/Banner<br><em>To change your logo/banner, delete the current one, then upload the new one.</em>
                  <? } else { ?>
                      <input type="file" name="company_logo" size="20">
                  <? } ?>
              </td>
          </tr>

<? } else if ($member_type == "C") { ?>

      <tr>
          <td align="right"  valign="top">Profile Photo</strong>: &nbsp;</td>
          <td align="left" valign="top">
              <? if ($profile_photo) { ?>
				  <img src="/profile_photos/<?=$profile_photo?>" height="200" border="0">
                  <br>
                  <input name="delete_profile_photo" type="checkbox" value="1">
                  Delete this Profile Photo<br><em>To change your profile photograph, delete the current one, then upload the new one.</em>
              <? } else { ?>
            	  <input type="file" name="profile_photo" size="20">
              <? } ?>
          </td>
      </tr>

<? } ?>

      <tr>
        <td colspan="2" height="20" ></td>
      </tr>
      <tr>
        <td align="right" valign="top">Profile Bio: &nbsp;  <br /><em style="color:#999">(optional)</em> &nbsp;</td>
        <td align="left" valign="top"><textarea name="profile_bio" style="width:100%; height:150px"><?=$profile_bio?></textarea></td>
      </tr>
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>

<? if ($member_type == "C") { ?>
      <tr>
        <td align="right" valign="top">Education: &nbsp;  <br /><em style="color:#999">(optional)</em> &nbsp;</td>
        <td align="left" valign="top"><textarea name="education" style="width:100%; height:150px"><?=$education?></textarea></td>
      </tr>
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>
      <tr>
        <td align="right" valign="top">Work Experience: &nbsp;  <br /><em style="color:#999">(optional)</em> &nbsp;</td>
        <td align="left" valign="top"><textarea name="work_experience" style="width:100%; height:150px"><?=$work_experience?></textarea></td>
      </tr>
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>
      <tr>
        <td align="right" valign="top">Key Words: &nbsp;  <br /><em style="color:#999">(optional)</em> &nbsp;</td>
        <td align="left" valign="top"><textarea name="key_words" style="width:100%; height:75px"><?=$key_words?></textarea></td>
      </tr>
      <tr>
          <td colspan="2" height="10">&nbsp;</td>
      </tr>

<? } ?>

      <tr>
        <td align="right">&nbsp;</td>
        <td align="left">
                	<input name="submit" type="submit" value="Save" />
		        </td>
      </tr>
    </table>
    </form>
<?
}
