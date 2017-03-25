<?
$member_id = $_GET["member_id"];
if ($member_id)
{
	$query3 = "SELECT * FROM members WHERE member_id='" . mysql_real_escape_string($member_id) . "'";
	if ($debug_msgs) echo $query3 . "<br />";
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	$member_type = stripslashes($rs3->member_type);
	$job_title = stripslashes($rs3->job_title);
	$job_title_id = stripslashes($rs3->job_title_id);
	$profile_photo = stripslashes($rs3->profile_photo);
	$resume_file = stripslashes($rs3->resume_file);
	$resume_upload_date = stripslashes($rs3->resume_upload_date);
	$required_hourly_rate = stripslashes($rs->required_hourly_rate);
	$required_salary = stripslashes($rs->required_salary);
	$years_experience = stripslashes($rs->years_experience);
	$first_name = stripslashes($rs3->first_name);
	$last_name = stripslashes($rs3->last_name);
	$city = stripslashes($rs3->city);
	$state = stripslashes($rs3->state);
	$work_experience = stripslashes($rs3->work_experience);
	$education = stripslashes($rs3->education);
	$company_logo = stripslashes($rs3->company_logo);
	$profile_bio = stripslashes($rs3->profile_bio);
	$key_words = stripslashes($rs3->key_words);
	$show_profile = (stripslashes($rs3->show_profile)) ? 1 : 0;
	@mysql_free_result($result3);
	
	//echo "member_type = $member_type<br />";
	
	if (!$_SESSION["token"])
		$_SESSION["token"] = sha1(uniqid(rand(), TRUE)); 
?>
    <form action="update-profile.php" method="post"  name="profile" enctype="multipart/form-data">
    <input type="hidden" name="member_id" value="<?=$member_id?>" />
    <input type="hidden" name="token"     value="<? echo $_SESSION["token"]; ?>" />
    <input type="hidden" name="sid"       value="<? echo session_id(); ?>">
    
    <table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="right" width="20%"><strong>Name</strong>: &nbsp; </td>
        <td align="left" width="80%"><?=$first_name?> <?=$last_name?></td>
      </tr>
      <tr>
        <td align="right"> </td>
        <td align="left"><? if ($city) echo $city; ?><? if ($city && $state) echo ", "; ?><? if ($state) echo $state; ?></td>
      </tr>
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>

      <tr>
        <td align="right" width="20%"><strong># Years</strong>: &nbsp; </td>
        <td align="left" width="80%"><?=$years_experience?></td>
      </tr>
      <tr>
        <td align="right" width="20%"><strong>Compensation</strong>: &nbsp; </td>
        <td align="left" width="80%"><? 
								if ($required_hourly_rate) 
									echo '$' . $required_hourly_rate . "/hr";
								else
									echo '$' . $required_salary . 'K';
							?></td>
      </tr>
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>

      <tr>
          <td align="right"  valign="top"><strong>Resume</strong>: &nbsp;</td>
          <td align="left" resume_file="top">
              <? if ($resume_file) { 
			  
			  	 if (strstr($resume_file, ".pdf"))
				 	$icon = "/images/layout/pdf.gif";
				else
				 	$icon = "/images/layout/word-doc.gif";
			  ?>
				  <img src="<?=$icon?>" height="50" border="0">
              <? } ?>
          </td>
      </tr>
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>
      
      <tr>
          <td align="right"  valign="top"></td>
          <td align="left" valign="top">
              <? if ($profile_photo) { ?>
				  <img src="/profile_photos/<?=$profile_photo?>" height="200" border="0">
              <? } ?>
          </td>
      </tr>

      <tr>
        <td colspan="2" height="20" ></td>
      </tr>
      <tr>
        <td align="right" valign="top"><strong>Bio</strong>: &nbsp; </td>
        <td align="left" valign="top"><?=$profile_bio?></td>
      </tr>
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>
      <tr>
        <td align="right" valign="top"><strong>Education</strong>: &nbsp;  </td>
        <td align="left" valign="top"><?=$education?></td>
      </tr>
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>
      <tr>
        <td align="right" valign="top"><strong>Experience</strong>: &nbsp;  </td>
        <td align="left" valign="top"><?=$work_experience?></td>
      </tr>
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>
      <tr>
        <td align="right" valign="top"><strong>Key Words</strong>: &nbsp; </td>
        <td align="left" valign="top"><?=$key_words?></td>
      </tr>
      <tr>
          <td colspan="2" height="10">&nbsp;</td>
      </tr>
    </table>
<?
}
