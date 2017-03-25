<? if ($this_page != "home") { ?>
<style>
.footer_navlink
{
	color:#333 !important;
}
</style>
<? } ?>
<footer>
    	<div class="wide_only">

<?  date_default_timezone_set("America/Los_Angeles"); ?>

<div id="footer-wrap" style="border-top:#333 solid 1px;">


<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr style="height:25px;"> 
    <td height="25" align="center"> 
		<a href="/index.php" class="footer_navlink">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<a href="/search.php" class="footer_navlink">Search Jobs</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<a href="/contact.php" class="footer_navlink">Contact</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<a href="/privacy.php" class="footer_navlink">Privacy</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="/register.php" class="footer_navlink">Sign Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="/login.php" class="footer_navlink">Login</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </td>
  </tr>
  <tr>
    <td align="center" width="100%" style="font-size:10px; color:#333">Copyright &copy; <? echo date("Y"); ?> Restaurant Info. &nbsp;All rights reserved.</td>
  </tr>
</table>
</div>
</div>
</footer>

