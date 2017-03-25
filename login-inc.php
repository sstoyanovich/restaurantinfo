<? if (!$suppress_login_hdr) { ?>
        <img src="/images/headers/login.jpg" width="300" height="27" alt="Login to your account" />
          <br><br />
<? } ?>
          
<?
if ($_GET["password_reset"] == "done")
{
?>
	Your password has been reset, and an email has been sent to you with that temporary password. <br />
    You may change your password at any time.<br /><br />
<?	
}
if ($_GET["failed"] == 1) 
{
	if ($_GET["notvfy"] == "1")
	{
		?><strong style="color:#900">We are sorry, but you have not yet verified your email address.<br /><br /></strong><?	
	}
	else if ($_GET["bademail"] == "1")
	{
		?><strong style="color:#900">We are sorry, but we cannot find that email address in our member's database<br /><br /></strong><?	
	}
	else if ($_GET["badpass"] == "1")
	{
		?><strong style="color:#900">We're sorry, but the password you entered was incorrect.<br /><br /></strong><?	
	}
	else 
	{
		?><strong style="color:#900">One or more fields in the login form were empty.<br /><br /></strong><?	
	}
}
?>


<form action="/login_check.php" method="post" name="register_form">

<input type="hidden" name="token"      value="<? $_SESSION["token"] = sha1(uniqid(rand(), TRUE)); echo $_SESSION["token"]; ?>" />
<input type="hidden" name="sid"        value="<? echo session_id(); ?>">
<input type="hidden" name="self"       value="<?=$_SERVER["PHP_SELF"]?>">
<input type="hidden" name="server"     value="<?=$_SERVER["SERVER_NAME"]?>">
<input type="hidden" name="ip_address" value="<?=$_SERVER["REMOTE_ADDR"]?>">
<input type="hidden" name="apply_for_job_id" value="<?=$_SESSION["apply_for_job_id"]?>">

<table width="700"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><sup style="color:#FF0000">*</sup>Email &nbsp; </td>
    <td align="left"><input type="text" name="email" size="40" maxlength="255" style="width:275px" value="<?=$_GET["email"]?>" onfocus="this.select();" onBlur="return check_email_used();"></td>
  </tr>
  <tr>
    <td align="right"><sup style="color:#FF0000">*</sup>Password  &nbsp; </td>
    <td align="left"><input class="password" type="password" name="password" size="40" maxlength="255" style="width:275px" value="<?=$_GET["password"]?>" onfocus="this.select();"></td>
  </tr>
  <tr>
    <td colspan="2" height="19"></td>  
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="left">
                <input name="submit" type="submit" value="Login" />
            </td>
  </tr>
</table>
</form>		

<? if (!$suppress_login_hdr) { ?>	
<br />
<a class="textlink" href="/register.php" style="text-decoration:underline !important" >Not a member? Sign up now.</a>
<br><br>
<a class="textlink" href="/forgot-password.php"  style="text-decoration:underline !important">Forgot Password?</a><br>

<br /><br /><br /><br />
<? } ?>
