<?
if ($product_id)
{
	$photo = '';
	$query2 = "SELECT * FROM products WHERE product_id='" . $product_id . "'";
	if ($debug_msgs) echo $query2 . "<br>";
	$result2 = mysql_query($query2) or die(mysql_error());
	$rs2 = mysql_fetch_object($result2);
	$display = ($rs2->pDisplay) ? 1 : 0;
	$sell = ($rs2->pSell) ? 1 : 0;
	$featured = ($rs2->featured) ? 1 : 0;
	$quantity_in_stock = stripslashes($rs2->quantity_in_stock);
	$user_id = stripslashes($rs2->user_id);
	$category_id = stripslashes($rs2->pSection);
	$sku = stripslashes($rs2->sku);
	$title = stripslashes($rs2->pName);
	$short_description = stripslashes($rs2->pDescription);
	$long_description = stripslashes($rs2->pLongdescription);
	$description = stripslashes($rs2->pDescription);
	$sale_price = stripslashes($rs2->pPrice);
	$list_price = stripslashes($rs2->pListPrice);
	$wholesale_priace = stripslashes($rs2->pWholesalePrice);
	$shipping_cost = stripslashes($rs2->pShipping);
	$weight = stripslashes($rs2->pWeight);
	$seo_title = stripslashes($rs2->seo_title);
	$seo_keywords = stripslashes($rs2->seo_keywords);
	$seo_description = stripslashes($rs2->seo_description);
	$thumbnail_from_products_table = stripslashes($rs2->pImage);
	$image_from_products_table = stripslashes($rs2->pLargeimage);
	@mysql_free_result($result2);
	
	if (!$sale_price) $sale_price = $list_price;
	
	if ($debug_msgs) echo "image_from_products_table = $image_from_products_table<br>";

	$query2 = "SELECT photo,alt_tag FROM product_photos WHERE photo <> '' AND product_id='" . $product_id . "' ORDER BY photo_num LIMIT 1";
	if ($debug_msgs) echo $query2 . "<br />";
	$result2 = mysql_query($query2) or die(mysql_error());
	$found_photo = mysql_num_rows($result2);
	if ($found_photo)
	{
		$rs2 = mysql_fetch_object($result2);
		$photo = stripslashes($rs2->photo);
		$alt_tag = stripslashes($rs2->alt_tag);
		@mysql_free_result($result2);
		if ($debug_msgs) echo "photo = $photo<br />";
		
		if ($photo)
			$photo = "prodimages/" . $photo;
	}
	if (!$photo)
		$photo = $image_from_products_table;

	$store_base_folder = "/";
	$photo_relative_url     = $store_base_folder . $photo;
	$photo_relative_url     = str_replace("../", "/", $photo_relative_url);
	$photo_relative_url     = str_replace("//", "/", $photo_relative_url);
	
	list($image_width, $image_height) = @getimagesize("." . $photo_relative_url);
	
	$image_is_portrait = 0;
	$image_is_landscape = 0;
	
	if (1 || $image_width > 0 && $image_height > 0 && ($image_height * .9) > $image_width)
		$image_is_portrait = 1;
	else
		$image_is_landscape = 1;

	if ($debug_msgs) echo "photo_relative_url = $photo_relative_url<br />";
	if ($debug_msgs) echo "image_width = $image_width<br />";
	if ($debug_msgs) echo "image_height = $image_height<br />";
	if ($debug_msgs) echo "image_is_portrait = $image_is_portrait<br />";
	if ($debug_msgs) echo "image_is_landscape = $image_is_landscape<br />";
}
