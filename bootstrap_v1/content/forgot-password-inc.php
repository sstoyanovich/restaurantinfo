<img src="/images/headers/forgot-password.jpg" width="300" height="27" alt="Forgot your password" />
<br><br />

To have your password reset and emailed to you, please enter the following information:<br><br>

<?
if (!$_SESSION["token"])
	$_SESSION["token"] = sha1(uniqid(rand(), TRUE)); 
?>
<form name="forgot_passwd_form" action="/forgot_passwd_submit.php" method="post">
<input type="hidden" name="token" value="<?=$_SESSION["token"]?>" />
<input type="hidden" name="sid" value="<? echo session_id(); ?>" />
    <table border="0" cellpadding="2" cellspacing="0" style="width:600px !important">
      <tr>
        <td width="118" height="22" align="right">Email Address:&nbsp;</td>
        <td width="474"><input type="text" name="email" style="width:300px"  maxlength="50"></td>
      </tr>
      <tr>
        <td height="22" align="right">Zip Code:&nbsp;</td>
        <td><input type="text" name="zip" style="width:70px"   maxlength="25"></td>
      </tr>
      <tr>
        <td >&nbsp;</td>
        <td></td>
      </tr>
      <tr>
          <td></td>
          <td align="left"><input type="submit" name="submit" value="Request Password Reset" > 
        </td>
      </tr>
	
    
    </table>
</form>
<br><br>