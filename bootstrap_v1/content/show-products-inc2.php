<?
	if ($_GET["ksdb"] == "735")
		$debug_msgs = 1;
		
	$the_session_id = session_id();
	$query3 = "DELETE FROM scratch_pad WHERE session_id='" . $the_session_id . "'";
	$result3 = mysql_query($query3) or die(mysql_error());
	
	$column_count = 1;
	$box_count = 0;
	$query3 = "SELECT product_id,user_id FROM products WHERE pName <> '' AND (pPrice > 0 OR pListPrice > 0) AND pDisplay=1 AND user_id <> 1 ORDER BY RAND() LIMIT 25";
	$result3 = mysql_query($query3) or die(mysql_error());
	while ($rs3 = mysql_fetch_object($result3))
	{
		$product_id = stripslashes($rs3->product_id);
		$this_user_id = stripslashes($rs3->user_id);
		
		// see if we already have a couple from this user
		$query4 = "SELECT scratch_pad_id FROM scratch_pad WHERE session_id='" . $the_session_id . "' AND user_id=" . $this_user_id;
		$result4 = mysql_query($query4) or die(mysql_error());
		$num_shown_for_this_user = mysql_num_rows($result4);
		if ($num_shown_for_this_user > 1)
			continue;

		// see if this product has an image

		$query4 = "SELECT product_photo_id FROM product_photos WHERE photo <> '' AND product_id=" . $product_id . " ORDER BY photo_num LIMIT 1";
		if ($debug_msgs) echo $query4 . "<br />";
		$result4 = mysql_query($query4) or die(mysql_error());
		$product_has_photo = mysql_num_rows($result4);
		if (!$product_has_photo)
			continue;
?>
	   	<div class="product_column" align="center">
		  <? require("show-product-box-inc.php"); ?>
	  	</div>
<?      
		if ($the_session_id && $user_id)
		{
			$query4 = "INSERT INTO scratch_pad SET session_id='" . $the_session_id . "', user_id=" . $this_user_id;
			$result4 = mysql_query($query4) or die(mysql_error());
		}

		$box_count++;
		if ($box_count >= 12)
			break;
	}
	@mysql_free_result($result2);

// SELECT photo FROM product_photos WHERE photo <> '' AND product_id=219 ORDER BY photo_num LIMIT 1
