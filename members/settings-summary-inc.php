<table width="400" border="0" bordercolor="#ffffff" style="border-collapse:collapse" cellspacing="0" cellpadding="0">
<tr style="background-image:url(/images/layout/dashboard-header-bkgnd2.png); background-repeat:no-repeat">
<td align="center" height="26">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td align="center" width="25%" height="25%" >&nbsp;</td>
    <td align="center" width="50%" style="color:#fff;">&nbsp;<strong>Settings Summary</strong></td>
    <td align="center" width="25%" ><a href="my-settings.php" style="color:#FF9; text-decoration:underline">Change</a> &nbsp;</td>
    </tr>
    </table>
</td>
</tr>
</table><table width="400" border="1" bordercolor="#555555" style="border-collapse:collapse; font-size:12px; background-color:#FFF; color:#000; box-shadow: 5px 5px 5px #888888;  margin-bottom:7px;" cellspacing="0" cellpadding="4">
<tr style="background-color:#f8f8f8; color:#333">
  <td align="left" valign="top" height="150" width="100%">
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="53%">Paypal Email</td>
    <td width="47%"><? if ($paypal_email) echo $paypal_email; else { ?> <strong style="color:#900">Not configured<sup>*</sup></strong><? } ?></td>
  </tr>
  <tr>
    <td>Agree Pay Pal Terms</td>
    <td><? if ($paypal_agree) echo "Yes"; else { ?> <strong style="color:#900">No<sup>*</sup></strong><? } ?></td>
  </tr>
  <tr>
    <td>Enable Sales</td>
    <td><? if ($allow_sales) echo "Yes"; else { ?> <strong style="color:#900">No<sup>*</sup></strong><? } ?></td>
  </tr>
  <tr>
    <td>Add Sales Tax</td>
    <td><? if ($charge_tax) echo "Yes"; else echo "No"; ?></td>
  </tr>
  <tr>
    <td>Sales Tax Rate</td>
    <td><?=$tax_rate?>%</td>
  </tr>
</table>
<? if (!$paypal_email || !$paypal_agree || !$allow_sales) { ?>
<br />
<strong style="color:#900"><sup>*</sup>Must be corrected before your store is active</strong>
<? } ?>
</td>
</tr>
</table> 

