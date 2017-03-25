<form action="/members.php" method="get" name="members">
<table width="100%" border="0" cellspacing="3" cellpadding="0" style="margin-bottom:12px;">
<tr>
  <td align="left" width="50%" valign="top">
      <table width="100%"  border="0" cellpadding="0" cellspacing="3">
      <tr>
        <td width="39%" height="33" align='right'><strong>Filter Results:&nbsp;</strong></td>
        <td width="61%" align='left'><input name="submit" type="submit" value="Go"></td>
      </tr>
      <tr>
        <td align='right'>Account Type:&nbsp;</td>
        <td align='left'><select name="member_type" style="width:150px">
                    <option value='a'>All</option>
                    <option value='c' <? if ($_GET["member_type"] == 'c') echo "selected"; ?>>Candidates Only</option>
                    <option value='e' <? if ($_GET["member_type"] == 'e') echo "selected"; ?>>Employers Only</option>
                </select>
        </td>
      </tr>
      <tr>
        <td align='right'>Company:&nbsp;</td>
        <td align='left'><input name="company_name" type="text" value="<?=$_GET["company_name"]?>"  style="width:150px" maxlength="255"></td>
      </tr>
      </table>
  </td>
  
  <td width="5" style="background-image:url(/images/layout/vertical-black-line.jpg); background-repeat:repeat-y"></td>
  
  <td align="left" valign="top">
        <table width="100%"  border="0" cellpadding="0" cellspacing="3">
        <tr>
          <td align='right'>First Name:&nbsp;</td>
          <td align='left'><input name="first_name" type="text" value="<?=$_GET["first_name"]?>"  style="width:150px" maxlength="255"></td>
        </tr>
        <tr>
          <td align='right'>Last Name:&nbsp;</td>
          <td align='left'><input name="last_name" type="text" value="<?=$_GET["last_name"]?>"  style="width:150px" maxlength="255"></td>
        </tr>
        <tr>
          <td align='right'>State:&nbsp;</td>
          <td align='left'><select name="state" style="width:150px">
                  <option value=''>Select</option>
                  <? $state = $_GET["state"]; require("incld/state_list_inc.php"); ?>
              </select></td>
        </tr>
        </table>
  
  </td>
</tr>
</table>
</form>







