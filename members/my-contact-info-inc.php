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
	$member_token = stripslashes($rs3->token);
	$member_type = stripslashes($rs3->member_type);
	$job_title = stripslashes($rs3->job_title);
	$company_name = stripslashes($rs3->company_name);
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
	$website_address = stripslashes($rs3->website_address);
	$security_question = stripslashes($rs3->security_question);
	$security_response = stripslashes($rs3->security_response);
	$profile_photo = stripslashes($rs3->profile_photo);
	$resume_file = stripslashes($rs3->resume_file);
	$company_logo = stripslashes($rs3->company_logo);
	$profile_bio = stripslashes($rs3->profile_bio);
	$key_words = stripslashes($rs3->key_words);
	$show_profile = (stripslashes($rs3->show_profile)) ? 1 : 0;
	@mysql_free_result($result3);
	
	//echo "member_type = $member_type<br />";
	
	if (!$_SESSION["token"])
		$_SESSION["token"] = sha1(uniqid(rand(), TRUE)); 
?>
    <img src="/images/headers/contact-info.jpg" width="150" height="27" alt="My Profile" />
    <br />
    
    <form action="update-contact-info.php" method="post"  name="profile" enctype="multipart/form-data">
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
        <td  align="right">First Name: &nbsp; </td>
        <td  align="left"><input type="text" name="first_name" size="40" maxlength="255" style="width:275px" value="<?=$first_name?>" onfocus="this.select();"> 
       				 &nbsp;</td>
      </tr>
      <tr>
        <td align="right">Last Name: &nbsp; </td>
        <td align="left"><input type="text" name="last_name" size="40" maxlength="255" style="width:275px" value="<?=$last_name?>" onfocus="this.select();"> 
        				 &nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>

	  <? if ($member_type == "E") { ?>
          <tr>
            <td align="right">Company Name: &nbsp; </td>
            <td align="left"><input type="text" name="company_name" size="40" maxlength="255" value="<?=$company_name?>" onfocus="this.select();"></td>
          </tr>
      <? } ?>

      <tr>
        <td align="right"><? if ($member_type == "E") echo "Company"; ?> Address: &nbsp; </td>
        <td align="left"><input type="text" name="address" size="40" maxlength="255" value="<?=$address?>" onfocus="this.select();"></td>
      </tr>
      <tr>
        <td align="right">Address 2: &nbsp; </td>
        <td align="left"><input type="text" name="address2" size="40" maxlength="255" value="<?=$address2?>" onfocus="this.select();"></td>
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
        <td align="right">Zip Code: &nbsp; </td>
        <td align="left"><input type="text" name="zip" size="5" maxlength="5" value="<?=$zip?>"></td>
      </tr>
      <tr>
        <td colspan="2" height="20" ></td>
      </tr>
      </tr>
      <tr>
        <td align="right">Phone Number: &nbsp; </td>
        <td align="left">
(<input type="text" name="phone_area_code" size="3" maxlength="3" style="width:32px;" value="<?=$phone_area_code?>" onfocus="this.select();">)&nbsp;<input  type="text" name="phone_prefix"    size="3" maxlength="3" style="width:32px;" value="<?=$phone_prefix?>"    onfocus="this.select();">-<input  type="text" name="phone_last_4"    size="4" maxlength="4" style="width:45px;" value="<?=$phone_last_4?>"    onfocus="this.select();"></td>
      </tr>
      <tr>
        <td align="right">Mobile Number: &nbsp; </td>
        <td align="left">
(<input type="text" name="cell_phone_area_code" size="3" maxlength="3" style="width:32px;" value="<?=$cell_phone_area_code?>" onfocus="this.select();">)&nbsp;<input  type="text" name="cell_phone_prefix"    size="3" maxlength="3" style="width:32px;" value="<?=$cell_phone_prefix?>" onfocus="this.select();">-<input  type="text" name="cell_phone_last_4"    size="4" maxlength="4" style="width:45px;" value="<?=$cell_phone_last_4?>" onfocus="this.select();">
</td>
      </tr>
      <tr>
        <td colspan="2" height="10" ></td>
      </tr>
      <tr>
        <td align="right">Contact Email Address: &nbsp; </td>
        <td align="left"><input type="text" name="email" size="40" maxlength="255" style="width:275px" value="<?=$email?>" onfocus="this.select();" onBlur="return check_email_used();"> 
       				 &nbsp;</td>
      </tr>
      <tr>
        <td align="right"><? if ($member_type == "E") echo "Business"; else echo "Personal"; ?> Website: &nbsp; </td>
        <td align="left">http://www.<input type="text" name="website_address" size="40" maxlength="255" style="width:275px" value="<?=$website_address?>" onfocus="this.select();" onBlur="return check_email_used();"> 
       				 &nbsp;</td>
      </tr>

      <tr>
        <td colspan="2" height="20" ></td>
      </tr>
      <tr>
        <td align="right"><sup style="color:#FF0000">*</sup>Security Question &nbsp; </td>
        <td align="left"><select name="security_question" style="width:275px" >
		<option value='0'>Select</option>
                <option value='7' <? if ($security_question == 7) echo "selected"; ?>>In what city did you meet your spouse?</option>
				<option value='2' <? if ($security_question == 2) echo "selected"; ?>>In what city were you born?</option>
				<option value='8' <? if ($security_question == 8) echo "selected"; ?>>What is your favorite hobby?</option>
				<option value='3' <? if ($security_question == 3) echo "selected"; ?>>What is your favorite vacation destination?</option>
				<option value='1' <? if ($security_question == 1) echo "selected"; ?>>What was the model of your first car?</option>
				<option value='4' <? if ($security_question == 4) echo "selected"; ?>>What was the name of your favorite pet?</option>
				<option value='6' <? if ($security_question == 6) echo "selected"; ?>>What was the name of your favorite teacher?</option>
				<option value='5' <? if ($security_question == 5) echo "selected"; ?>>What was your High School mascot?</option>
	</select></td>
      </tr>
      <tr>
        <td align="right"><sup style="color:#FF0000">*</sup>Answer &nbsp; </td>
        <td align="left"><input type="text" name="security_response" size="40" maxlength="255" style="width:275px"  onfocus="this.select();" value="<?=$security_response?>"></td>
      </tr>
      <tr>
          <td colspan="2" height="10">&nbsp;</td>
      </tr>
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
