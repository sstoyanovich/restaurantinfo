<style type="text/css">
<!--
.style1 {
	color: #665665;
	font-style: italic;
	font-size: 11px;
}
.style2 {color: #FF0000}
.style3 {color: #0000cc}
-->
</style>

<? 
$job_id = $_GET["job_id"];
if (!$job_id) $job_id = 0;

$candidate_member_id = $_SESSION["member_id"];
if (!$candidate_member_id) $candidate_member_id = 0;

if ($job_id && $candidate_member_id)
{	
	$query3 = "SELECT * FROM members WHERE member_id='" . mysql_real_escape_string($candidate_member_id) . "'";
	if ($debug_msgs) echo $query3 . "<br />";
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	$first_name = stripslashes($rs3->first_name);
	$last_name = stripslashes($rs3->last_name);
	$address = stripslashes($rs3->address);
	$address2 = stripslashes($rs3->address2);
	$city = stripslashes($rs3->city);
	$state = stripslashes($rs3->state);
	$zip = stripslashes($rs3->zip);
	$email = stripslashes($rs3->email);
	$phone_area_code = stripslashes($rs3->phone_area_code);
	$phone_prefix = stripslashes($rs3->phone_prefix);
	$phone_last_4 = stripslashes($rs3->phone_last_4);
	$cell_phone_area_code = stripslashes($rs3->cell_phone_area_code);
	$cell_phone_prefix = stripslashes($rs3->cell_phone_prefix);
	$cell_phone_last_4 = stripslashes($rs3->cell_phone_last_4);
	$resume_file = stripslashes($rs3->resume_file);
	$resume_upload_date = stripslashes($rs3->resume_upload_date);
	@mysql_free_result($result3);

	$query3 = "SELECT job_code,apply_locally,apply_remotely,member_id FROM jobs WHERE job_id='" . mysql_real_escape_string($job_id) . "'";
	if ($debug_msgs) echo $query3 . "<br />";
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	$job_code = stripslashes($rs3->job_code);
	$apply_locally = stripslashes($rs3->apply_locally);
	$apply_remotely = stripslashes($rs3->apply_remotely);
	$employer_member_id = stripslashes($rs3->member_id);
	@mysql_free_result($result3);
 ?>

    <form action="apply-for-job-submit.php" method="post" name="register_form" enctype="multipart/form-data">
 	<input type="hidden" name="token"      value="<? $_SESSION["token"] = sha1(uniqid(rand(), TRUE)); echo $_SESSION["token"]; ?>" />
    <input type="hidden" name="sid"        value="<? echo session_id(); ?>">
    <input type="hidden" name="candidate_member_id"  value="<?=$candidate_member_id?>">
    <input type="hidden" name="employer_member_id"  value="<?=$employer_member_id?>">
    <input type="hidden" name="job_id"     value="<?=$job_id?>">
    <input type="hidden" name="job_code"     value="<?=$job_code?>">
    <table width="800"  border="0" cellpadding="0" cellspacing="0">
      <tr style="background-color:#EEEEEE">
        <td height="27"  align="left" colspan="2">&nbsp; <strong>Contact Information for Job Application</strong></td>
      </tr>
      <tr>
        <td colspan="2" height="12"></td>
      </tr>
      <tr>
        <td  align="right"><sup style="color:#FF0000">*</sup><strong>First Name</strong> &nbsp; </td>
        <td  align="left"><input type="text" name="first_name" size="40" maxlength="255" value="<?=$first_name?>" onfocus="this.select();"></td>
      </tr>
      <tr>
        <td align="right"><sup style="color:#FF0000">*</sup><strong>Last Name</strong> &nbsp; </td>
        <td align="left"><input type="text" name="last_name" size="40" maxlength="255" value="<?=$last_name?>" onfocus="this.select();"></td>
      </tr>
      <tr>
        <td colspan="2" height="10" ></td>
      </tr>
      <tr>
        <td align="right"><sup style="color:#FF0000">*</sup><strong>Address</strong> &nbsp; </td>
        <td align="left"><input type="text" name="address" size="40" maxlength="255" value="<?=$address?>" onfocus="this.select();"></td>
      </tr>
      <tr>
        <td align="right">Address 2</strong> &nbsp; </td>
        <td align="left"><input type="text" name="address2" size="40" maxlength="255" value="<?=$address2?>" onfocus="this.select();"></td>
      </tr>

      <tr>
        <td align="right"><sup style="color:#FF0000">*</sup><strong>City</strong> &nbsp; </td>
        <td align="left"><input type="text" name="city" size="40" maxlength="255" value="<?=$city?>" onfocus="this.select();"></td>
      </tr>
      <tr>
        <td align="right"><div id="state_star"><sup style="color:#FF0000">*</sup><strong>State</strong> &nbsp; </div></td>
        <td align="left"><select name="state">
            <option value=''>Select</option>
            <? $state = $_GET["state"]; require("incld/state_list_inc.php"); ?>
        </select></td>
      </tr>

      <tr>
        <td align="right"><sup style="color:#FF0000">*</sup><strong>Zip Code</strong> &nbsp; </td>
        <td align="left"><input type="text" name="zip" size="5" maxlength="5" value="<?=$zip?>"></td>
      </tr>

      <tr>
        <td colspan="2" height="10" ></td>
      </tr>
      <tr>
        <td align="right"><strong>Phone</strong> &nbsp; </td>
        <td align="left">
(<input type="text" name="phone_area_code" size="3" maxlength="3" style="width:32px;" value="<?=$phone_area_code?>" onfocus="this.select();">)&nbsp;
<input  type="text" name="phone_prefix"    size="3" maxlength="3" style="width:32px;" value="<?=$phone_prefix?>"    onfocus="this.select();"> - 
<input  type="text" name="phone_last_4"    size="4" maxlength="4" style="width:45px;" value="<?=$phone_last_4?>"    onfocus="this.select();">
        </td>
      </tr>
      <tr>
        <td align="right"><strong>Mobile Phone</strong> &nbsp; </td>
        <td align="left">
(<input type="text" name="cell_phone_area_code" size="3" maxlength="3" style="width:32px;" value="<?=$cell_phone_area_code?>" onfocus="this.select();">)&nbsp;
<input  type="text" name="cell_phone_prefix"    size="3" maxlength="3" style="width:32px;" value="<?=$cell_phone_prefix?>"    onfocus="this.select();"> - 
<input  type="text" name="cell_phone_last_4"    size="4" maxlength="4" style="width:45px;" value="<?=$cell_phone_last_4?>"    onfocus="this.select();">
        </td>
      </tr>
      <tr>
        <td colspan="2" height="10" ></td>
      </tr>
      <tr>
        <td align="right"><sup style="color:#FF0000">*</sup><strong>Email</strong> &nbsp; </td>
        <td align="left"><input type="text" name="email" size="40" maxlength="255" value="<?=$email?>" onfocus="this.select();" onBlur="return check_email_used();"></td>
      </tr>

<? /*
      <tr>
        <td colspan="2" height="19"></td>  
      </tr>
      <tr style="background-color:#EEEEEE">
        <td height="27"  align="left" colspan="2">&nbsp; <strong>Resume</strong> (select one option below):</td>
      </tr>
      <tr>
        <td colspan="2" height="12"></td>
      </tr>
      
<? if ($resume_file) { ?>
      <tr>
          <td align="left"  valign="top"><input name="resume_option" type="radio" value="1" checked="checked" /> Use Resume on File:</strong>: &nbsp;</td>
          <td align="left" resume_file="top">
              <? if (strstr($resume_file, ".pdf"))
				 	$icon = "/images/layout/pdf.gif";
				else
				 	$icon = "/images/layout/word-doc.gif";
			  ?>
				  <img src="<?=$icon?>" height="50" border="0">
                  Resume uploaded: <?=$resume_upload_date?>
          </td>
      </tr>
      <tr>
        <td colspan="2" height="12"></td>
      </tr>
      <tr>
          <td align="left"  valign="top"><input name="resume_option" type="radio" value="2"  /> Or Upload other Resume</strong>: &nbsp;</td>
          <td align="left" resume_file="top"><input type="file" name="resume_file" size="20"></td>
      </tr>
  <? } else { ?>
      <tr>
          <td align="left"  valign="top"><input name="resume_option" type="radio" value="2" checked="checked" /> Upload Your Resume</strong>: &nbsp;</td>
          <td align="left" resume_file="top"><input type="file" name="resume_file" size="20"></td>
      </tr>
  <? } ?>
      <tr>
        <td colspan="2" height="12"></td>
      </tr>
      <tr>
          <td align="left"  valign="top"><input name="resume_option" type="radio" value="3"  /> Or paste Resume below</strong>: &nbsp;</td>
          <td align="left" resume_file="top"></td>
      </tr>
    <tr>
      <td colspan="2" align="left"><textarea name="pasted_resume" style="width:100%" rows="5" onfocus="this.select();"></textarea></td>
    </tr>
 */
 ?> 
  
      <tr>
        <td colspan="2" height="19"></td>  
      </tr>
      <tr style="background-color:#EEEEEE">
        <td height="27"  align="left" colspan="2">&nbsp; <strong>Comments to Employer </strong></td>
      </tr>
      <tr>
        <td colspan="2" height="12"></td>
      </tr>
    <tr>
      <td colspan="2" align="left"><textarea name="comments" style="width:100%" rows="5" onfocus="this.select();"></textarea></td>
    </tr>
      <tr>
        <td colspan="2" height="12"></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left">
      
        <input type="submit" name="submit" value="Apply for Job" onClick="return check_apply_form();"> 
      </tr>
      <tr>
        <td colspan="2" height="20" >&nbsp;</td>
      </tr>
    </table>
    </form>			
<?
}
?>
