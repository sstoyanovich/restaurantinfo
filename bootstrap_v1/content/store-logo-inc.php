<?  
if ($_SESSION["store_member_id"]) 
{ 
	$query2a = "SELECT store_logo, company_name, profile_photo, first_name, last_name, profile_bio FROM members WHERE member_id=" . $_SESSION["store_member_id"];
	if ($debug_msgs) echo $query2a . "<br />";
	$result2a = mysql_query($query2a) or die(mysql_error());
	$rs2a = mysql_fetch_object($result2a);
	$company_name = stripslashes($rs2a->company_name);
	$store_logo = stripslashes($rs2a->store_logo);
	$profile_photo = stripslashes($rs2a->profile_photo);
	$first_name = stripslashes($rs2a->first_name);
	$last_name = stripslashes($rs2a->last_name);
	$profile_bio = stripslashes($rs2a->profile_bio);
	@mysql_free_result($result2a);

	$full_photo_path = "/home/eartistf/public_html/logos/" . $store_logo;
	$logo_image_exists = file_exists($full_photo_path);

	if ($logo_image_exists)
	{
		list($banner_logo_width, $banner_logo_height) = @getimagesize($full_photo_path);
		
	//echo "banner_logo_width = $banner_logo_width<br />";
	//echo "banner_logo_height = $banner_logo_height<br />";
	
		if ($store_logo)
		{
			?><div style="width:100%; <? if ($banner_logo_height > 250) { ?>height:250px;<? } ?> overflow:hidden; margin-bottom:10px;"><img src="/logos/<?=$store_logo?>" width="100%" border="0"></div"><?
		}
		else
		{
		?>
            <table width="100%" border="0" style="back" cellspacing="0" cellpadding="0">
            <tr>
              <td height="50" style=" background-image:url(/images/layout/main-navigation-responsive-bkgnd.jpg); color:#FFF; font-size:30px; font-family: 'Poiret One', cursive;">&nbsp<?=$company_name?></td>
            </tr>
          </table>
        <?	
		}
	}
}
