
<table width="187" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="187" height="25" valign="middle" style="background-image:url(../images/headers/header-bar-small.jpg); background-repeat:no-repeat; color:#fff"> &nbsp; NEWSLETTER SIGNUP</td>
</tr>
</table><table width="187" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#888; background-color:#fbfbf9; box-shadow: 2px 2px 2px #dddddd;  margin-bottom:7px;">
<tr>
<td width="100%" align="left" valign="top">


<? if ($_GET["signup"] == "complete") { ?>
<br />
Thank you for signing up for our newsletter!<br /><br /><br />
<? } else { ?>

<font color="#000066" size="2" face="Times New Roman, Times, serif">Join 
          our mailing list and receive a monthly e-mail newsletter with specials, 
          discounts and coupons. </font>
          
          <br />
          <br><font color="#000066" size="2" face="Times New Roman, Times, serif">Enter your e-mail address: </font>
            <br>
                <FORM action="/newsletter-signup.php" method="POST">
                    <input type="hidden" name="token" value="<?=$_SESSION["token"]?>">
                    <input type="hidden" name="sid" value="<? echo session_id(); ?>">
                     
                    <input type="text" name="email" style="width:185px"><br>
                    <input type="submit" name="mailing_list" value="Join">
                    <br />
                    <font color="#000066" size="2" face="Times New Roman, Times, serif">Worried about your 
            <a href="privacy.php">privacy</a>?</font>
                </form>
  <? } ?>              
                
</td>
</tr>
</table>
