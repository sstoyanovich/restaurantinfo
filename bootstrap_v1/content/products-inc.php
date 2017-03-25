 <?
$debug_msgs = 0;
$search       = clean_post_var($_GET["search"]); 
$category_id  = clean_post_var($_GET["id"]); 
$terms        = clean_post_var($_GET["terms"]); 
$price_from   = clean_post_var($_GET["price_from"]); 
$price_to     = clean_post_var($_GET["price_to"]); 

if ($_GET["clrstid"])
	$_SESSION["store_member_id"] = 0;

if ($category_id == 'all') $category_id = "ALL";
	
if ($_GET["ksdb"] == 735)
	$debug_msgs = 1;

$start_range = 0;
$number_products_per_page = 20;

$php_root_folder = "/";

if ($_SESSION["store_member_id"])
{
	$query2a = "SELECT paypal_email,allow_sales,paypal_agree FROM seller_settings WHERE member_id=" . $_SESSION["store_member_id"];
	if ($debug_msgs) echo $query2a . "<br />";
	$result2a = mysql_query($query2a) or die(mysql_error());
	$rs2a = mysql_fetch_object($result2a);
	$paypal_email = stripslashes($rs2a->paypal_email);
	$allow_sales = ($rs2a->allow_sales) ? 1 : 0;
	$paypal_agree = ($rs2a->paypal_agree) ? 1 : 0;
	@mysql_free_result($result2a);
}
else
{
	$paypal_email = '';
	$allow_sales = 0;
	$paypal_agree = 0;
}
if ($debug_msgs) echo "paypal_email = $paypal_email<br />";
if ($debug_msgs) echo "allow_sales = $allow_sales<br />";
if ($debug_msgs) echo "paypal_agree = $paypal_agree<br />";


if ($category_id && $category_id != 'ALL')
{
	$query2a = "SELECT category_name FROM categories WHERE category_id=" . $category_id;
	if ($debug_msgs) echo $query2a . "<br />";
	$result2a = mysql_query($query2a) or die(mysql_error());
	$rs2a = mysql_fetch_object($result2a);
	$category_name = stripslashes($rs2a->category_name);
	@mysql_free_result($result2a);
}
if ($debug_msgs) echo "category_name = $category_name<br />";

// 						(always_in_stock = 1 OR quantity_in_stock > 0 OR quantity_in_stock = -1 OR ignore_stock_count = 1) 


$query2 = "SELECT * FROM 
						products 
					WHERE 
						(pDisplay = 1 OR pSell = 1) 
					  AND 
						user_id > 1  ";
						
if ($show_only_product_id)
	$query2 .= " AND product_id='" . $show_only_product_id . "'";
else
{
	if ($_SESSION["store_member_id"])
		$query2 .= " AND user_id='" . $_SESSION["store_member_id"] . "'";
		
	if ($category_id && $category_id != 'ALL')
		$query2 .= " AND category_id='" . $category_id . "'";
		
	if ($sub_category_id)
		$query2 .= " AND sub_category_id='" . $sub_category_id . "'";
		
	if ($search == 1)
	{
		if ($terms)
			$query2 .= " AND (title LIKE '%" . $terms . "%' OR short_description LIKE '%" . $terms . "%' OR description LIKE '%" . $terms . "%')";   
		if ($price_from)
			$query2 .= " AND price >= '" . $price_from . "'";
		if ($price_to)
			$query2 .= " AND price <= '" . $price_to . "'";
	}
}

if ($shop_under_construction)
	$query2 .= " ORDER BY RAND()";
else
	$query2 .= " ORDER BY pSell DESC, pName";


if ($debug_msgs) echo $query2 . "<br />";
$result2 = mysql_query($query2) or die(mysql_error());
$number_products = mysql_num_rows($result2);
if ($debug_msgs) echo "number_products = $number_products<br />";
if ($number_products == 0)
{
?>
	<br /><br />
	Sorry, but we could not find any items listed with the specified search criteria.<br /><br /><br />
<?
}
else
{
	$query2 .= " LIMIT " . $start_range . ", " . $number_products_per_page;
	if ($debug_msgs) echo $query2 . "<br />";
	$result2 = mysql_query($query2) or die(mysql_error());
	
	if ($number_products > $number_products_per_page)
	{
		$total_pages = (int)($number_products / $number_products_per_page);
		if ($number_products % $number_products_per_page)
			$total_pages++;
	}
	else
		$total_pages = 1;
		
	if (!$current_page)
		$current_page = 1;
	
	$number_showing = ($number_products >= $number_products_per_page) ? $number_products_per_page : $number_products;
	
	if ($debug_msgs) echo "number_products_per_page = $number_products_per_page<br />";
	if ($debug_msgs) echo "number_showing = $number_showing<br />";
	if ($debug_msgs) echo "total_pages = $total_pages<br />";
	if ($debug_msgs) echo "current_page = $current_page<br />";
	if ($debug_msgs) echo "store_base_folder = $store_base_folder<br />";


	while ($rs2 = mysql_fetch_object($result2))
	{
		//*****************************************************************************************************
		// Get info about this product.
		//*****************************************************************************************************
		
		$product_id = $rs2->product_id;
		$user_id = $rs2->user_id;
		$title = stripslashes($rs2->pName);
		$short_description = stripslashes($rs2->pDescription);
		$long_description = trim(stripslashes($rs2->pLongdescription));
		$price = stripslashes($rs2->pPrice);
		$list_price = stripslashes($rs2->pListPrice);
		$date_listed = stripslashes($rs2->date_listed);
		$date_modified = stripslashes($rs2->date_modified);
		$quantity_in_stock = stripslashes($rs2->quantity_in_stock);
		$always_in_stock = stripslashes($rs2->always_in_stock);
		$pSell = stripslashes($rs2->pSell);

		if (!$price || $price == 0) $price = $list_price;

		if ($debug_msgs) echo "product_id = $product_id<br />";
		if ($debug_msgs) echo "user_id = $user_id<br />";
		if ($debug_msgs) echo "title = $title<br />";
		if ($debug_msgs) echo "pSell = $pSell<br />";
		if ($debug_msgs) echo "price = $price<br />";

		//*****************************************************************************************************
		// Make sure this seller has thier store enabled and configured properly.
		//*****************************************************************************************************

		if ($product_id)
		{
			$query3 = "SELECT user_id FROM products WHERE product_id=" . $product_id;
			if ($debug_msgs) echo $query3 . "<br />";
			$result3 = mysql_query($query3) or die(mysql_error());
			$rs3 = mysql_fetch_object($result3);
			$user_id = stripslashes($rs3->user_id);
			@mysql_free_result($result3);
		}
		else
			$user_id = 0;
	
		if ($debug_msgs) echo ">>> <strong>user_id = $user_id</strong><br />";
	
		$query3 = "SELECT paypal_email,allow_sales,paypal_agree FROM seller_settings WHERE member_id=" . $user_id;
		if ($debug_msgs) echo $query3 . "<br />";
		$result3 = mysql_query($query3) or die(mysql_error());
		$rs3 = mysql_fetch_object($result3);
		$paypal_email = stripslashes($rs3->paypal_email);
		$allow_sales = ($rs3->allow_sales) ? 1 : 0;
		$paypal_agree = ($rs3->paypal_agree) ? 1 : 0;
		@mysql_free_result($result3);
		
		if ($debug_msgs)
		{
			echo "user_id = $user_id<br />";	
			echo "product_id = $product_id<br />";	
			echo "paypal_email = $paypal_email<br />";	
			echo "allow_sales = $allow_sales<br />";	
			echo "paypal_agree = $paypal_agree<br />";	
		}
	
		//*****************************************************************************************************
		// Get the photo.
		//*****************************************************************************************************
		
		$query3 = "SELECT photo FROM product_photos WHERE photo <> '' AND product_id=" . $product_id . " ORDER BY photo_num LIMIT 1";
		if ($debug_msgs) echo $query3 . "<br />";
		$result3 = mysql_query($query3) or die(mysql_error());
		$rs3 = mysql_fetch_object($result3);
		$photo = stripslashes($rs3->photo);
		@mysql_free_result($result3);
		
		if ($photo)
			$photo = "prodimages/" . $photo;

		if ($debug_msgs) echo "<strong>photo = $photo</strong><br />";

		if ($photo)
		{
			if (strstr($photo, "../"))
				$photo = str_replace("../", "/", $photo);
			if ($debug_msgs) echo "photo = $photo<br />";
			$relative_photo_path =  "/" . $photo;
			if (strstr($relative_photo_path, "//"))
				$relative_photo_path = str_replace("//", "/", $relative_photo_path);
			if ($debug_msgs) echo "relative_photo_path = $relative_photo_path<br />";
			
			$full_photo_path = "/home/eartistf/public_html/" . $relative_photo_path;
			if (strstr($full_photo_path, "//"))
				$full_photo_path = str_replace("//", "/", $full_photo_path);
			if ($debug_msgs) echo "full_photo_path = $full_photo_path<br />";
			
			if ($show_details)
			{
				$max_width = 400;
				$max_height = 400;
			}
			else
			{
				$max_width = 200;
				$max_height = 200;
			}
			
			if ($full_photo_path)
				list($width, $height) = @getimagesize($full_photo_path);
			else
			{
				$width = $max_width;
				$height = $max_height;
			}

			if ($debug_msgs) echo "width = $width<br />";
			if ($debug_msgs) echo "height = $height<br />";


			$new_width = $width;
			$new_height = $height;
			if ($new_width > $max_width)
			{
				$adjust_factor = $max_width / $width;
				$new_width = $width * $adjust_factor;
				$new_height = $height * $adjust_factor;
			}
			
			if ($new_height > $max_height)
			{
				$adjust_factor = $max_height / $new_height;
				$new_width = $new_width * $adjust_factor;
				$new_height = $new_height * $adjust_factor;
			}

			$new_width = (int)$new_width;
			$new_height = (int)$new_height;

			if ($debug_msgs) echo "new_width = $new_width<br />";
			if ($debug_msgs) echo "new_height = $new_height<br />";
		}
		
		$price = sprintf("%1.2f", $price);
		
		//$details_url = "product-details.php?id=$product_id&title=$title&search=$search&catid=$catid&terms=$terms&price_from=$price_from&price_to=$price_to";
		
		$details_url = "/product-detail.php?prod=" . $product_id;
?>
		<div class="businessBox payRequired">
		<table  border="<? if ($debug_msgs) echo '1'; else echo '0'; ?>" cellspacing="0" cellpadding="0" style="width:575px;">
		<form action="/cart/add-to-cart.php" method="post" name="buy_<?=$product_id?>">
		<input type="hidden" name="product_id" value="<?=$product_id?>" />
		<input type="hidden" name="user_id" value="<?=$user_id?>" />
		<input type="hidden" name="session_id" value="<?=session_id()?>" />
		<input type="hidden" name="token" value="<? echo $_SESSION['token']; ?>" />
		<tr>
			<? if (!$show_details) { ?>
			  <td style="width:200px" valign="top" align="right">
			  <div style="margin-right:10px;">
				   <? if ($photo) { ?>
					  <a href="<?=$details_url?>"><img src="<? if ($is_ssl) echo $ssl_folder; else echo $store_base_folder; ?><?=$relative_photo_path?>" alt="<?=$business_name?>" style="width:<?=$new_width?>px !important; height:<?=$new_height?>px !important"   /></a>
				   <? } else { ?>
					  <a href="<?=$details_url?>"><img src="<? if ($is_ssl) echo $ssl_folder; else echo $store_base_folder; ?>products/img/no-image-small.jpg?" alt="No image" title="No image" /></a>
				   <? } ?>
				   </div>
			  </td>
			<? } ?>	
				
		 <td valign="top" align="left">
			<div class="busName">
			
				<? if ($show_details) { ?>

					<img src="<? if ($is_ssl) echo $ssl_folder; else echo $store_base_folder; ?><?=$relative_photo_path?>" alt="<?=$business_name?>"  width="<?=$new_width?>"  height="<?=$new_height?>"  />
				
					<br /><br />
<span class="store_rcol_banner_text"><?=$title?></span><br />
					<?=$long_description?>
				
				<? } else { ?>
				
					<strong><?=$title?></strong> <br style="line-height:20px;" />
					<?=$short_description?><br style="line-height:20px;" />
					<br />
					<input name="details" type="button" value="View Details" style="width:125px;" onclick="document.location.href='<?=$details_url?>'" /> 
					<br /><br />

				<? } ?>
				
				<? 

				if ($debug_msgs) echo "paypal_email = $paypal_email<br />";
				if ($debug_msgs) echo "allow_sales = $allow_sales<br />";
				if ($debug_msgs) echo "paypal_agree = $paypal_agree<br />";
				
				//  || !$paypal_email || !$allow_sales || !$paypal_agree
				if ($pSell == 0 || $paypal_email == '' || !$allow_sales || !$paypal_agree) { 
				
				?>
				
					<strong style="color:#00c">This item is not currently for sale</strong>
					
				<? } else { ?>
					
					<strong>Price:</strong> $<? echo number_format($price, 2); ?>
					<br />
					<br />
					
					<? if ($quantity_in_stock <= 0 && $always_in_stock == 0) { ?>
					
						<strong style="color:#900">Sorry, temporariliy out of stock</strong><br /><br />
						
					<? } else { ?>
					
						Quantity: 
						<? if ($quantity_in_stock == 1 && $always_in_stock == 0) { ?>
							<strong>1</strong> <strong style="color:#900">(only one available)</strong> 
							<input type="hidden" name="quantity" value="1" />
						<? } else { 
							if (!$quantity_in_stock)
								$quantity_in_stock = 1;
						?>
							<select name="quantity" id="quantity" style="width:60px;">
								<? for ($opt_select_val = 1; $opt_select_val <= $quantity_in_stock; $opt_select_val++) { ?>
									<option value="<?=$opt_select_val?>"><?=$opt_select_val?></option>
								<? } ?>
							</select> 
							<? if ($quantity_in_stock <= 5) { ?><strong style="color:#900">Only <?=$quantity_in_stock?> left!</strong><? } ?>
						<? } ?>
						<br /><br />
						
						<input name="submit" type="submit" value="Add To Cart" style="width:125px;" /> 
						<? /*
						<input name="wishlist" type="submit" value="Add To Wishlist" style="width:125px;" onclick="document.buy_<?=$product_id?>.submit()" /> 
						*/ ?>
					<? } ?>
	
				<? } ?>
			</div></td>
		</tr>
		
		<? if (!$show_details) { ?>
			<tr>
				<td colspan="2" height="5" style="background-image:url(/images/layout/horizontal-dashed-line.gif); background-repeat:repeat-x"></td>
			</tr>
	   <? } ?>

		</form>
		 </table>
		 
		 <? if ($show_details) { ?>
			<br /><br /><br />
		<? } ?>

		</div>

<?
	}
}
/*
product_id
user_id
pName
pName2
pName3
pSection
pDescription
pDescription2
pDescription3
pLongdescription
pLongdescription2
pLongdescription3
pImage
pLargeimage
pPrice
pListPrice
pWholesalePrice
pShipping
pShipping2
pWeight
pDisplay
pSell
pStaticPage
pStockByOpts
pExemptions
pInStock
pDropship
pDims
pTax
quantity_in_stock
always_in_stock
seo_title
seo_description
seo_keywords
*/


?>            