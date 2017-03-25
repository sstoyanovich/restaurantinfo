<table width="300" border="0" cellspacing="3" cellpadding="0">
<tr>
  <td width="47%" align='right'><strong>Order by:&nbsp;</strong></td>
  <td width="53%" align='left'>
      <select name="order_by" onchange="document.members.submit()">
          <option value="date"   <? if ($_GET["order_by"] == "date") echo "selected"; ?>>Date Signed Up </option>
          <option value="level"  <? if ($_GET["order_by"] == "level") echo "selected"; ?>>Member Level </option>
          <option value="last"   <? if ($_GET["order_by"] == "last") echo "selected"; ?>>Last Name </option>
          <option value="email"  <? if ($_GET["order_by"] == "email") echo "selected"; ?>>Email </option>
          <option value="login"  <? if ($_GET["order_by"] == "login") echo "selected"; ?>>Last Login </option>
      </select>
  </td>
</tr>

<tr>
  <td align='right'><span <? if ($_GET["reverse_order"]) { ?> style="background-color:#FFC"<? } ?>>Reverse Order:</span></td>
  <td align='left'>
<input name="reverse_order" type="checkbox" value="1" <? if ($_GET["reverse_order"]) echo "checked"; ?>  onchange="document.members.submit()" />
  </td>
</tr>

</table>

   