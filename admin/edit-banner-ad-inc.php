<script LANGUAGE='JavaScript'>
function verify_delete(title) 
{
	var agree=confirm("Are you sure you wish to DELETE the banner ad entitled " + title + "?  \n\nThis operation will permanantly remove the banner ad from the website database and cannot be undone! \n\nIf you are absolutely certain you wish to delete this banner ad, click OK. \n\nTo cancel this operation, click CANCEL. ");
	if (agree) {
		return true;
	} else {
		return false;
	}
}
</script>

<?
$ads_idbanner_ads_id = ($_GET["id"]) ? $_GET["id"] : 0;

    if ($ads_idbanner_ads_id)
    {
        $query = "SELECT * FROM banner_ads WHERE ads_idbanner_ads_id=" . $ads_idbanner_ads_id . "";
        $result = db_query($query);
        if (!$result) // query failed
            exit;
        $rs = mysql_fetch_object($result);
        $title = trim(stripslashes($rs->title));
        $banner_ad_image = trim(stripslashes($rs->banner_ad_image));
        @mysql_free_result($result);
    }
?>
    <form name="listing_form" method="post" action="update-job.php">
 	<input type="hidden" name="token" value="<? $_SESSION["token"] = sha1(uniqid(rand(), TRUE)); echo $_SESSION["token"]; ?>" />
    <input type="hidden" name="sid"   value="<? echo session_id(); ?>">
    <input name="banner_ad_id" type="hidden" value="<?=$banner_ad_id?>">
    <input name="new" type="hidden" value="<?=$_GET["new"]?>">
  <table width="100%" style=" width:100%; max-width:800px"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right">Title:&nbsp;&nbsp;</td>
      <td align="left"><input type="text" name="title" size="100" maxlength="20" value="<? echo stripslashes($title); ?>" onfocus="this.select();" onChange="return mark_changed();"></td>
    </tr>
    
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>

    <tr>
        <td align="right"  valign="top">Banner Ad</strong>: &nbsp;</td>
        <td align="left" valign="top">
            <? if ($banner_ad_image) { ?>
                <img src="/ad_banners/<?=$banner_ad_image?>" height="75" border="0">
                <br>
                <input name="delete_banner_ad" type="checkbox" value="1">
                Delete this Banner Ad Image<br><em>To change your Banner Ad Image, delete the current one, then upload the new one.</em>
            <? } else { ?>
                <input type="file" name="banner_ad_image" size="20">
            <? } ?>
        </td>
    </tr>
    
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>

    <tr>
      <td align="right">&nbsp;</td>
      <td align="left"><input name="submit" type="submit" value="<? if ($_GET["new"] == 1) echo "Add Listing"; else echo "Save Changes To Listing"; ?>" onClick="return check_listing_form();">&nbsp;</td>
    </tr>
</table>
</form>
  <br><br>

<? @mysql_free_result($result); ?>
