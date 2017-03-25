<table width="400" border="0" bordercolor="#ffffff" style="border-collapse:collapse" cellspacing="0" cellpadding="0">
<tr style="background-image:url(/images/layout/dashboard-header-bkgnd2.png); background-repeat:no-repeat">
<td align="center" height="26">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td align="center" width="25%" height="25%" >&nbsp;</td>
    <td align="center" width="50%" style="color:#fff;">&nbsp;<strong>Account Summary</strong></td>
    <td align="center" width="25%" >
    </td>
    </tr>
    </table>
</td>
</tr>
</table>
<table width="400" border="1" bordercolor="#555555" style="border-collapse:collapse; font-size:12px; background-color:#FFF; color:#000; box-shadow: 5px 5px 5px #888888;  margin-bottom:7px;" cellspacing="0" cellpadding="4">
<tr style="background-color:#f8f8f8; color:#333">
  <td align="left" valign="top" height="150" width="100%">

<strong style="color:#02619f">Welcome <?=$first_name?> <?=$last_name?></strong><br /><br />
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Store Name</td>
    <td><?=$company_name?></td>
  </tr>
  <tr>
    <td>Store URL</td>
    <td>www.restaurantinfo.com/<?=$store_sub_url?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?=$email?></td>
  </tr>
  <tr>
    <td>Zip</td>
    <td><?=$zip?></td>
  </tr>
  <tr>
    <td>Date Signed Up</td>
    <td><?=$date_signedup?></td>
  </tr>
  <tr>
    <td>Last Login</td>
    <td><?=$last_login?></td>
  </tr>
  <tr>
    <td>Email Verified</td>
    <td><? if ($email_verified_by_user) echo "Yes"; else echo "n"; ?></td>
  </tr>
</table>
  
  
  </td>
</tr>
</table> 
