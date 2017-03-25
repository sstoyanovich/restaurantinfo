<img src="/images/headers/change-password.jpg" width="200" height="27" alt="Change Password" /><br /><br />

<style type="text/css">
<!--
.style1 {color: #0000cc}
-->
</style>

<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="400" valign="top" align="left">
    
 <? if ($_GET["foundemail"] == "failed") { ?>
      <span class="style1">We're sorry, but we cannot find email address "<?=$_GET["email"]?>" in our database</span>.<br><br>
 <? } ?>
 
 <? if ($_GET["password"] == "failed") { ?>
      <span class="style1">We're sorry, but the password you entered for email "<?=$_GET["email"]?>" does not match the current email address for that account.</span>.<br><br>
 <? } ?>

 <? if ($_GET["expired"] == "1") { ?>
      <span class="style1">We are sorry, but your 6-month membership has expired. <br><br>
      To automatically renew your membership, simply change your password. After successfully changing your password, your membership will be valid for an additional 6 months.
      <br><br>Failure to renew your membership may result in your account data being removed from the system</span>.<br><br>
 <? } ?>
      
    <?     $_SESSION["token"] = sha1(uniqid(rand(), TRUE)); 
?>
      <form name="change_passwd_form" action="change-password-submit.php" method="post">
      <input type="hidden" name="token"     value="<? echo $_SESSION["token"]; ?>" />
      <input type="hidden" name="sid"       value="<? echo session_id(); ?>">
      <input type="hidden" name="expired" value="<?=$_GET["expired"]?>">
      <input type="hidden" name="member_id"     value="<? echo $_SESSION["member_id"]; ?>" />
      <input type="hidden" name="email"     value="<? echo $_SESSION["email"]; ?>" />

          <table width="440" border="0" cellpadding="2" cellspacing="0">
            <tr>
              <td height="22" align="right" class="bodyText12">Old Password:&nbsp;</td>
              <td><input type="password" name="old_passwd" size="20" maxlength="40" ></td>
            </tr>
            <tr>
              <td height="22" align="right" class="bodyText12">New Password:&nbsp;</td>
              <td><input type="password" name="new_passwd" size="20" maxlength="40" ></td>
            </tr>
            <tr>
              <td height="22" align="right" class="bodyText12">Repeat New Password:&nbsp;</td>
              <td><input type="password" name="new_passwd2" size="20" maxlength="40" ></td>
            </tr>
            <tr>
              <td height="40" colspan="2" align="center"><input name="submit" type="submit" value="Change Password" onClick="return check_change_pass_form();">
              </td>
            </tr>
          </table>
      </form>
      
    </td>
  </tr>
</table>

