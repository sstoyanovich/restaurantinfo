<style>
.editfocus {
	background-color:#ffffdd;
}

.editblur {
	background-color:#fff;
}
</style>
<script type="text/javascript">
function verify_delete(add_banner) 
{
	var agree=confirm("Are you sure you wish to DELETE add banner for '" + add_banner + "'?  \n\nThis operation will permanantly remove the add banner from the website database and cannot be undone! \n\nIf you are absolutely certain you wish to delete this add banner, click OK. \n\nTo cancel this operation, click CANCEL. ");
	if (agree) {
		return true;
	} else {
		return false;
	}
}
</script>
<? 
    $_SESSION["token"] = sha1(uniqid(rand(), TRUE)); 

	$check_mark = "<img src=\"/images/layout/checkmark.gif\">";
	$xmark = "<img src=\"/images/layout/xmark.jpg\">";
	$page_title = "Members";

	$ads_per_page = 50;
	$the_page = ($_GET["page"]) ? $_GET["page"] : 1;
	$range_low =  (($the_page - 1) * $ads_per_page); 
	
	$query = "SELECT * FROM banner_ads ORDER BY title"; 
	if ($debug_msgs) echo $query . "<br>";
	$result = mysql_query($query) or die(mysql_error());
	$number_of_ads = mysql_num_rows($result);
	$query .= " LIMIT $range_low,$ads_per_page";
	$result = mysql_query($query) or die(mysql_error());

	$first_show = $range_low;
	if (!$first_show) $first_show = 1;
	$last_show = $first_show + $ads_per_page - 1;
	if ($last_show > $number_of_ads)
		$last_show = $number_of_ads;
?>

<strong><?=$number_of_ads?> Banner Ad(s)</strong>.  &nbsp; &nbsp; &nbsp; Showing <?=$first_show?> - <?=$last_show?>
<br>
<br />

<table width="100%"   border="1" bordercolor="#eeeeee" style="font-size:13px; border-collapse:collapse; border-color:#ccc !important; " cellspacing="0" cellpadding="3">
    <tr style="height:26px; background-image:url(/images/cms/tbl-hdr-bkd-mid.jpg); background-repeat:repeat-x; color:#333">
        <td width="125"  align="center"><strong>Title</strong></td>
        <td width="125"  align="center"><strong>Image</strong></td>
        <td width="100"  align="center"><strong>Manage</strong></td>
    </tr>
<?
	if ($number_of_ads > 0) 	// any ads ?
	{
		$td_counter = 0;
		$row_counter = 1;
		while ($rs = mysql_fetch_object($result))
		{
			$ads_idbanner_ads_id = $rs->ads_idbanner_ads_id;
			$title = $rs->title;
			$banner_ad_image = stripslashes($rs->banner_ad_image);
?>
  			<tr onmouseover="this.className='editfocus';" onmouseout="this.className='editblur';">
                <td align="left" >&nbsp;<?=$title?></td>
                <td align="left" ><img src="/ad_banners/<?=$banner_ad_image?>" height="50" /></td>
    
                <td align="center">
                <a class="textlink" href="edit-banner-ad.php?id=<?=$ads_idbanner_ads_id?>&tk=<?=$_SESSION["token"];?>"><img src="/images/members/button-edit.jpg" width="40" height="15" alt="Edit" border="0"  /></a>
                <a class="textlink" href="delete-banner-ad.php?id=<?=$ads_idbanner_ads_id?>&tk=<?=$_SESSION["token"];?>" onclick="return verify_delete('<?=$title?>');"><img src="/images/members/button-delete.jpg" width="40" height="15" alt="Delete"  border="0" /></a>
              </td>
            </tr>
<?
            $row_counter++;
		}
	}
?> 
	</table>
<br>

<?
		$prev_page = $the_page;
		if ($prev_page > 1)
			$prev_page--;

		$num_partial_pages = ($number_of_ads % $ads_per_page);
		$num_pages = (int)($number_of_ads / $ads_per_page);
		if ($num_partial_pages)
			$num_pages++;
		$next_page = $the_page;
		if ($next_page < $num_pages)
			$next_page++;

		 if ($the_page > 1) 
		 { ?>
            &nbsp;<a href="ads.php?<?=$_SERVER["QUERY_STRING"]?>">&lt;&lt; First</a>&nbsp; 
            &nbsp;<a href="ads.php?page=<?=$prev_page?>&<?=$_SERVER["QUERY_STRING"]?>">&lt; Previous</a>&nbsp; 
        <? } else { ?>
            <font color="#999999">
				&nbsp;&lt; First&nbsp; 
				&nbsp;&lt;&lt; Previous&nbsp; 
			</font>
	  <? }

		for ($i = 1; $i <= $num_pages; $i++)
		{
			if ($the_page == $i)
				echo " <strong>&nbsp;" . $i . "&nbsp;</strong>";
			else {
	?>
				&nbsp;<a href="ads.php?page=<?=$i?>&<?=$_SERVER["QUERY_STRING"]?>"><?=$i?></a>&nbsp; 
	<?
			}
		}
	?>
	
	<? if ($num_pages > 1 && $the_page < $num_pages) { ?>
			&nbsp;<a href="ads.php?page=<?=$next_page?>&<?=$_SERVER["QUERY_STRING"]?>">Next &gt;</a>&nbsp; 
			&nbsp;<a href="ads.php?page=<?=$num_pages?>&<?=$_SERVER["QUERY_STRING"]?>">Last &gt;&gt;</a>&nbsp; 
	<? } else { ?>
		<font color="#999999">
			&nbsp;Next &gt;&nbsp; 
			&nbsp;Last &gt;&gt;&nbsp; 
		</font>
	<? } ?>

<br /><br />
<a href="/edit-banner-ad.php?id=0&new=1"><img src="/images/members/button-add-ad-banner.jpg" width="40" height="15" alt="Add Advertisement Banner" /></a>
