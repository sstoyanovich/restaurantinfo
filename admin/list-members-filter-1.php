<table width="337"  border="0" cellpadding="0" cellspacing="3">
<tr>
  <td width="39%" height="33" align='right'><strong>Filter Results:&nbsp;</strong></td>
  <td width="61%" align='left'><input name="submit" type="submit" value="Go"></td>
</tr>
<tr>
  <td align='right'>Account Type:&nbsp;</td>
  <td align='left'><select name="member_level" style="width:200px">
              <option value='a'>All</option>
              <option value='c'>Candidates Only</option>
              <option value='e'>Employers Only</option>
          </select>
  </td>
</tr>
<tr>
  <td align='right'>Company:&nbsp;</td>
  <td align='left'><input name="company_name" type="text" value="<?=$_GET["company_name"]?>"  style="width:200px" maxlength="255"></td>
</tr>
<tr>
  <td align='right'>First Name:&nbsp;</td>
  <td align='left'><input name="first_name" type="text" value="<?=$_GET["first_name"]?>"  style="width:200px" maxlength="255"></td>
</tr>
<tr>
  <td align='right'>Last Name:&nbsp;</td>
  <td align='left'><input name="last_name" type="text" value="<?=$_GET["last_name"]?>"  style="width:200px" maxlength="255"></td>
</tr>
<tr>
  <td align='right'>Zip Code:&nbsp;</td>
  <td align='left'><input name="zip" type="text" value="<?=$_GET["zip"]?>" size="7" maxlength="255"></td>
</tr>
    <tr>
      <td align='right'>State:&nbsp;</td>
      <td align='left'><select name="state" style="width:200px">
              <option value=''>Select</option>
              <? $state = $_GET["state"]; require("incld/state_list_inc.php"); ?>
          </select></td>
    </tr>
</table>
