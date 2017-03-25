<img src="/images/headers/contact.jpg" width="84" height="27" alt="Contact Us" />
<br><br />
If you would like to contact us, please send us an e-mail:
<br /><br />

<p>General Information: <a href="mailto:info@<?=$g_website_domain?>">info@<?=$g_website_domain?></a><br>
<br>
Customer Support: <a href="mailto:support@<?=$g_website_domain?>">support@<?=$g_website_domain?></a><br>
<br>

<strong>Or use this contact form</strong>:<br>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
<form name="form1" method="post" action="contact_submit.php">
<tr>
  <td width="25%" align="left" valign="top">Name:</td>
  <td width="75%"><input type="text" name="name" style="width:100%"></td>
</tr>
<tr>
  <td align="left" valign="top">Phone:</td>
  <td><input type="text" name="phone" style="width:100%"></td>
</tr>
<tr>
  <td align="left" valign="top">Cell Phone:</td>
  <td><input type="text" name="cell" style="width:100%" value=""></td>
</tr>
<tr>
  <td align="left" valign="top">Email:</td>
  <td><input type="text" name="email" style="width:100%"></td>
</tr>
<tr>
  <td colspan="2" align="left" valign="top">
  	Preferred  Contact Method: 
    &nbsp;&nbsp;&nbsp;<input name="contact_method" type="radio" value="Phone"> Phone
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="contact_method" type="radio" value="E-mail"> E-mail
    </td>
  </tr>
<tr>
  <td align="left" valign="top">Comments / Questions:</td>
  <td><textarea name="comments" rows="7" style="width:100%"></textarea></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td><input name="Submit" type="submit" class="button1" value="Submit">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="Submit2" type="reset" class="button2" value="Reset"></td>
</tr></form>
</table>