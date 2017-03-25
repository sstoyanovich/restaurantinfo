<style>
.tagline
{
	font-size:12px;
}
</style>
<a name="top"></a>
<table width="1000" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td width="1000"> 
		<table width="1000" height="61" border="0" cellpadding="0" cellspacing="0">
        <tr>
          	
          <td width="298" height="61">
          <div align="center">
          <img src="/images/layout/logo-place-holder.jpg" width="306" height="71" />
          <br />
          <span class="tagline">
                    <? 
						if ($_SESSION["logged_in"])  
							echo "Store Management Portal";
						else
							echo "eMarket Place for Today's Artists";
                    ?>
                    </span>
            </div></td>
          	
          <td valign="bottom" width="508" align="center"><table border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="42"> 
                <div align="center">
                    </div></td>
              </tr>
            </table> </td>
          	
          <td align="center" width="181" valign="middle">
            </td>
		</tr>
        </table>
    </td>
</tr>

<tr style=" height:35px;" valign="middle">
    <td align="left" colspan="2"><? require("bootstrap_v1/incld/navigtation-inc.php"); ?></td>
</tr>

<tr style="background-image:url(/images/layout/footer-divider.jpg); background-repeat:repeat-x; height:5px;" valign="middle">
	<td align="left" colspan="2">&nbsp;</td>
</tr>
</table>