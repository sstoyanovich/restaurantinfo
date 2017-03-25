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

<? $need_job_url_pkid = 0; ?>

<?
	if ($_GET["mid"] == 2)
	{
		$_GET["first_name"] = "Ken";	
		$_GET["last_name"] = "Siemers";	
		$_GET["company_name"] = "ExpressYourSite, LLC";	
		$_GET["address"] = "690 Grape Ave";	
		$_GET["address2"] = "#142";	
		$_GET["city"] = "Sunnyvale";	
		$_GET["state"] = "CA";	
		$_GET["zip"] = "94087";	
		$_GET["phone"] = "408-530-8620";	
		$_GET["cell_phone"] = "408-555-1212";	
		$_GET["email"] = "expressyoursite@comcast.net";	
		$_GET["email2"] = "expressyoursite@comcast.net";	
		$_GET["password"] = "12345";	
		$_GET["password2"] = "12345";	
		$_GET["security_question"] = "2";	
		$_GET["security_response"] = "Palo Alto";	
	}
	
	if ($member_will_be_candidate)
		$_GET["member_type"] = 'C';
?>

<? if ($_GET["member_type"]) { ?>

    <form action="<? if ($admin_adding) echo "add_this_member"; else echo "register_submit"; ?>.php" method="post" name="register_form">
 	<input type="hidden" name="token"      value="<? $_SESSION["token"] = sha1(uniqid(rand(), TRUE)); echo $_SESSION["token"]; ?>" />
    <input type="hidden" name="sid"        value="<? echo session_id(); ?>">
  	<input type="hidden" name="self"       value="<?=$_SERVER["PHP_SELF"]?>">
  	<input type="hidden" name="server"     value="<?=$_SERVER["SERVER_NAME"]?>">
    <input type="hidden" name="ip_address" value="<?=$_SERVER["REMOTE_ADDR"]?>">
    <input type="hidden" name="reg_code_ref" value="<?=$rand_number?>">
    <input type="hidden" name="member_type" value="<?=$_GET["member_type"]?>">
    <table width="800"  border="0" cellpadding="0" cellspacing="0">
    
	 <? if (!$admin_adding) { ?>
        <tr>
          <td align="left" colspan="2"><em>All information is completely confidential and is not made available to any outside parties</em></td>
        </tr>
        </tr>
        <tr>
          <td colspan="2" height="10" align="right">&nbsp;</td>
        </tr>
    <? } ?>
      <tr>
        <td></td>
        <td align="left"height="19"><sup style="color:#FF0000">*</sup><em>Denotes required fields </em></td>
      </tr>
      <tr>
        <td  align="right"><sup style="color:#FF0000">*</sup><strong>First Name</strong> &nbsp; </td>
        <td  align="left"><input type="text" name="first_name" size="40" maxlength="255" value="<?=$_GET["first_name"]?>" onfocus="this.select();"></td>
      </tr>
      <tr>
        <td align="right"><sup style="color:#FF0000">*</sup><strong>Last Name</strong> &nbsp; </td>
        <td align="left"><input type="text" name="last_name" size="40" maxlength="255" value="<?=$_GET["last_name"]?>" onfocus="this.select();"></td>
      </tr>
      <tr>
        <td colspan="2" height="10" ></td>
      </tr>

	  <? if ($_GET["member_type"] != "C") { ?>
          <tr>
            <td align="right"><sup style="color:#FF0000">*</sup><strong>Company Name</strong> &nbsp; </td>
            <td align="left"><input type="text" name="company_name" size="40" maxlength="255" value="<?=$_GET["company_name"]?>" onfocus="this.select();"></td>
          </tr>
      <? } ?>

      <tr>
        <td align="right"><sup style="color:#FF0000">*</sup><strong><? if ($_GET["member_type"] != "C") echo "Company"; ?> Address</strong> &nbsp; </td>
        <td align="left"><input type="text" name="address" size="40" maxlength="255" value="<?=$_GET["address"]?>" onfocus="this.select();"></td>
      </tr>
      <tr>
        <td align="right">Address 2</strong> &nbsp; </td>
        <td align="left"><input type="text" name="address2" size="40" maxlength="255" value="<?=$_GET["address2"]?>" onfocus="this.select();"></td>
      </tr>

      <tr>
        <td align="right"><sup style="color:#FF0000">*</sup><strong>City</strong> &nbsp; </td>
        <td align="left"><input type="text" name="city" size="40" maxlength="255" value="<?=$_GET["city"]?>" onfocus="this.select();"></td>
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
        <td align="left"><input type="text" name="zip" size="5" maxlength="5" value="<?=$_GET["zip"]?>"></td>
      </tr>

      <tr>
        <td colspan="2" height="10" ></td>
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

    <? if ($_GET["emailused"]) { ?>
      <tr>
        <td colspan="2" height="10" ></td>
      </tr>
      <tr>
        <td align="left" colspan="2"><span class="style2">We're sorry, but the email address: 
          <strong><?=$_GET["email"]?></strong>
          is already in use by another member</span>.
          <div style="line-height:5px;"><br></div>
    If you believe this to be an error, then please <a href="contact.php">contact us</a> for assistance.
          <div style="line-height:5px;"></div>
    </td>
      </tr>
      <tr>
        <td colspan="2" height="10" ></td>
      </tr>
    <? } ?>

      <tr>
        <td align="right"><sup style="color:#FF0000">*</sup><strong>Email</strong> &nbsp; </td>
        <td align="left"><input type="text" name="email" size="40" maxlength="255" value="<?=$_GET["email"]?>" onfocus="this.select();" onBlur="return check_email_used();"></td>
      </tr>
      <tr>
        <td align="right"><sup style="color:#FF0000">*</sup><strong>Re-enter Email</strong> &nbsp; </td>
        <td align="left"><input type="text" name="email2" size="40" maxlength="255" value="<?=$_GET["email"]?>" onfocus="this.select();"></td>
      </tr>
      <tr>
        <td align="right">&nbsp; </td>
        <td align="left"><span class="style1">Your email address will serve as your login username.</span></td>
      </tr>
      <tr>
        <td align="right"><sup style="color:#FF0000">*</sup><strong>Password</strong>  &nbsp; </td>
        <td align="left"><input type="password" name="password" size="40" maxlength="255" value="<?=$_GET["password"]?>" onfocus="this.select();"></td>
      </tr>
      <tr>
        <td align="right"><sup style="color:#FF0000">*</sup><strong>Re-enter Password</strong>&nbsp; </td>
        <td align="left"><input type="password" name="password2" size="40" maxlength="255" value="<?=$_GET["password"]?>" onfocus="this.select();"></td>
      </tr>
      <tr>
        <td align="right">&nbsp; </td>
        <td align="left"><span class="style1">Passwords are case sensitive.</span></td>
      </tr>
      <tr>
        <td colspan="2" height="10" ></td>
      </tr>

      <tr>
        <td align="right">Referred By &nbsp; </td>
        <td align="left"><input type="text" name="referred_by" size="40" maxlength="255" style="width:275px" value="<?=$_GET["referred_by"]?>" onfocus="this.select();" >
       <em> how did you hear about us?</em></td>
      </tr>
      <tr>
        <td colspan="2" height="10" ></td>
      </tr>
    
      <tr>
        <td align="right"><sup style="color:#FF0000">*</sup>Security Question &nbsp; </td>
        <td align="left"><select name="security_question" style="width:275px" >
		<option value='0'>Select</option>
                <option value='7' <? if ($_GET["security_question"] == 7) echo "selected"; ?>>In what city did you meet your spouse?</option>
				<option value='2' <? if ($_GET["security_question"] == 2) echo "selected"; ?>>In what city were you born?</option>
				<option value='8' <? if ($_GET["security_question"] == 8) echo "selected"; ?>>What is your favorite hobby?</option>
				<option value='3' <? if ($_GET["security_question"] == 3) echo "selected"; ?>>What is your favorite vacation destination?</option>
				<option value='1' <? if ($_GET["security_question"] == 1) echo "selected"; ?>>What was the model of your first car?</option>
				<option value='4' <? if ($_GET["security_question"] == 4) echo "selected"; ?>>What was the name of your favorite pet?</option>
				<option value='6' <? if ($_GET["security_question"] == 6) echo "selected"; ?>>What was the name of your favorite teacher?</option>
				<option value='5' <? if ($_GET["security_question"] == 5) echo "selected"; ?>>What was your High School mascot?</option>
	</select></td>
      </tr>
      <tr>
        <td align="right"><sup style="color:#FF0000">*</sup>Answer &nbsp; </td>
        <td align="left"><input type="text" name="security_response" size="40" maxlength="255" style="width:275px"  onfocus="this.select();" value="<?=$_GET["security_response"]?>"></td>
      </tr>
      <tr>
        <td colspan="2" height="10" ></td>
      </tr>
      <tr>
        <td ></td>
        <td align="left"><em style="font-size:10px">The security response is needed if you forget your password, or which email address you register with.</em></td>
      </tr>
 
	  <? if (!$admin_adding) { ?>
            <tr> 
              <td align="left" colspan="2" height="12"></td>
            </tr>
            <tr><td align="right"><sup style="color:#FF0000">*</sup><strong>User Agreement</strong> &nbsp; </td>
            <td align="left"><input name="accept" type="checkbox" value="yes"> <span class="style5reg">I have completely read and agree to the  
  
           <a href='javascript:void(0)' onClick="window.open('view-terms-conditions.php', 'Terms','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=1,width=600,height=500')">Terms and Conditions</a>.</span></td>
            </tr>
            <tr>
              <td colspan="2" height="19"></td>
            </tr>
          <? if ($_GET["regcode"] == "bad") { ?>    
            <tr>
              <td align="left" colspan="2"><span class="style2">We're sorry, but the registration code you entered was incorrect. Please enter the new code below:</span>
                <div style="line-height:5px;"><br></div>
          </td>
            </tr>
          <? } ?>
           <tr>
              <td align="right"><sup style="color:#FF0000">*</sup><strong>Registration Code</strong> &nbsp; </td>
              <td align="left"><table width="400" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="40"><input name="reg_code" type="text" id="reg_code" size="4" maxlength="4"  onfocus="this.select();" /></td>
              <td width="37"><img src="/images/layout/code-arrow.gif" width="32" height="13"  align="absmiddle"></td>
              <td width="315">
              <img src="/images/layout/<? echo get_reg_code_fname($rnd_num1); ?>.gif" border="0" align="absmiddle">
              <img src="/images/layout/<? echo get_reg_code_fname($rnd_num2); ?>.gif" border="0" align="absmiddle">
              <img src="/images/layout/<? echo get_reg_code_fname($rnd_num3); ?>.gif" border="0" align="absmiddle">
              <img src="/images/layout/<? echo get_reg_code_fname($rnd_num4); ?>.gif" border="0" align="absmiddle">
              </td>
            </tr>
          </table></td>
            </tr>
            <tr>
              <td colspan="2" height="17" class="form_bot">
              <br>
          
              <span class="style3">Important!  An email with a link to Activate Your Account will be sent to the email listed above.  <br />
              Please add info@<?=$g_domain?> to your list of approved email senders.</span></td>
            </tr>
	 <? } ?>
 
      <tr>
        <td colspan="2" height="19"></td>  
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left">
      
        <input type="submit" name="submit" value="<? if (1) echo "Register"; else echo "Continue to Payment Screen"; ?>" 
        onClick="return check_register_form('<?=$rand_number?>', '<?=$admin_adding?>', '<?=$_GET["member_type"]?>');"> 
        <input name="cancel" type="reset" value="Cancel"></td>
      </tr>
      <tr>
        <td colspan="2" height="20" >&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" height="20" align="left"><span class="style4">
        In order to receive the membership verification email you need to add <strong>info@<?=$g_website_domain?></strong>  to your email address book.  
        Please do this before completing the registration process. Otherwise the membership verification email may be captured by a spam filter or quarantined in your "junk" email folder.   
        If you do not receive the activation email please contact us.
	
        </span></td>
      </tr>
    </table>
    </form>			

<? } else { ?>
    
    <form action="register.php" method="get" name="register_form">
    <table width="665" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" colspan="2"><em>Please select the type of membership you would like to register for:</em></td>
      </tr>
      <tr>
        <td colspan="2" height="20" >&nbsp;</td>
      </tr>
      </tr>
      <tr>
        <td width="184" align="right" valign="top">Membership Type  &nbsp; </td>
        <td width="476" align="left" valign="top"><table width="400" border="0" cellpadding="0" cellspacing="0">
                <tr>

                    <td height="20" align="left"><input type="radio" name="member_type" id="member_type" value="C" /> <strong>Candidate</strong> - Seeking a Job
                    </td>
                </tr>
                <tr>
                    <td height="35" align="left"><input type="radio" name="member_type" id="member_type" value="E" /> <strong>Employer / Recruiter</strong> - Posting a Job</td>
                </tr>
   				 </table>
		</td>
      </tr>
      <tr>
        <td colspan="2" height="20" >&nbsp;</td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left"><input type="submit" name="submit" value="Continue" onClick="return check_type_selected('<?=$rand_number?>', '0', '<?=$_GET["member_type"]?>');"></td>
      </tr>
      <tr>
        <td colspan="2" height="20">&nbsp;</td>
      </tr>
    </table>  
    <div align="left">
     <br />
    </div>
 </form>			

<? }  ?>
    

