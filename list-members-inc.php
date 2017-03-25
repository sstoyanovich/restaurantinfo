<script type="text/javascript">
function verify_delete() 
{
	var agree=confirm("Are you sure you wish to DELETE this member and all of their products?  \n\nThis operation will permanantly remove the member and all of their products from the website database and cannot be undone! \n\nIf you are absolutely certain you wish to delete this member and all of their products, click OK. \n\nTo cancel this operation, click CANCEL. ");
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

	$listings_per_page = 50;
	$the_page = ($_GET["page"]) ? $_GET["page"] : 1;
	$range_low =  (($the_page - 1) * $listings_per_page); 
	
	$query = "SELECT * FROM members WHERE 
										member_id <> 1
									ORDER BY test_member, date_signedup DESC"; 
/*
	$_GET["order_by"] = "test_member, date";
	switch ($_GET["order_by"])
	{
		case "login":		$sort_order = "last_login"; break;
		case "date":		$sort_order = "date_signedup"; break;
		case "last":		$sort_order = "last_name,first_name"; break;
		case "level":		$sort_order = "member_level"; break;
		case "email":		$sort_order = "email"; break;
		default:			$sort_order = "last_name,first_name"; break;
	}
	$query .= $sort_order; 
*/
	if ($_GET["reverse_order"])
		$query .= " DESC"; 

	//echo $query . "<br>";
	$result = mysql_query($query) or die(mysql_error());
	$number_of_listings = mysql_num_rows($result);

	$query .= " LIMIT $range_low,$listings_per_page";
	$result = mysql_query($query) or die(mysql_error());

	$first_show = $range_low;
	if (!$first_show) $first_show = 1;
	$last_show = $first_show + $listings_per_page - 1;
	if ($last_show > $number_of_listings)
		$last_show = $number_of_listings;
?>

<strong><?=$number_of_listings?> <? if ($view == 1) echo "Indivicual "; else if ($view == 2) echo "Merchant "; ?> Members</strong>.  
<? if ($_GET["hide_test_members"]) echo "(not including test/demo/admin)"; ?>

&nbsp; &nbsp; &nbsp; Showing
		
			<?=$first_show?> - <?=$last_show?>
<br>


<script type="text/javascript" src="/tablesorter-master/jquery-latest.js"></script> 
<script type="text/javascript" src="/tablesorter-master/jquery.tablesorter.js"></script> 

<div style="margin:25px;">
<table width="100%" id="library_table" class="tablesorter"  border="1" bordercolor="#eeeeee" style="font-size:13px; border-collapse:collapse; border-color:#ccc !important; " cellspacing="0" cellpadding="3">
<thead> 
    <tr style="height:26px; background-image:url(/images/cms/tbl-hdr-bkd-mid.jpg); background-repeat:repeat-x; color:#333">
        <th width="175"  align="left">Name, address</th>
        <th width="50"  align="center">Wel Em.</th>
        <th width="30"  align="center">Enable Store</th>
        <th width="30" align="center" >Vfy</th>
        <th width="30" align="center" >Can</th>
        <th width="50"  align="center">PPal Ag.</th>
        <th width="50"  align="center">PPal Em.</th>
        <th width="50"  align="center">Tax</th>
        <th width="50"  align="center">Rate</th>
        <th width="75"  align="center">Signed Up</th>
        <th width="75"  align="center">Last Login</th>
        <th width="75"  align="center">#Prods.</th>
    </tr>
</thead> 
<tbody> 
<?
	if ($number_of_listings > 0) 	// any listings ?
	{
		$td_counter = 0;
		$row_counter = 1;
		while ($rs = mysql_fetch_object($result))
		{
			$the_member_id = $rs->member_id;
			
			$row_color = ($row_counter & 1) ? "FFFFFF" : "f8f8f8";
			
			if ($rs->alt_pay_request == 1 && $rs->alt_pay_accepted == 0)
				$row_color = "FFCCCC";

			$test_member = ($rs->test_member) ? 1 : 0;
			$country = stripslashes($rs->country);
			$state_province = stripslashes($rs->state);
			if (!$state_province) $state_province = stripslashes($rs->province);

			$query3 = "SELECT * FROM seller_settings WHERE member_id=" . $the_member_id;
			$result3 = mysql_query($query3) or die(mysql_error());
			$rs3 = mysql_fetch_object($result3);
			$paypal_agree = stripslashes($rs3->paypal_agree);
			$paypal_email = stripslashes($rs3->paypal_email);
			$allow_sales = stripslashes($rs3->allow_sales);
			$charge_tax = stripslashes($rs3->charge_tax);
			$tax_rate = stripslashes($rs3->tax_rate);
			@mysql_free_result($result3);
			
			if ($test_member) $row_color = "ffeeee";
?>
			<tr bgcolor="#<?=$row_color?>" style="color:#333">

				<td align="left" ><? echo stripslashes($rs->first_name) . " " . stripslashes($rs->last_name); ?>
                				&nbsp;<span style="color:#aaa">(<? echo stripslashes($the_member_id) ?>)</span>
                				<br /><? echo stripslashes($rs->company_name) ?>
                                
                                <? if ($rs->location) { ?>
                					<br /><? echo stripslashes($rs->location); ?>
                                <? } ?>
                                
                   				<br /><a href="mailto:<? echo stripslashes($rs->email); ?>?subject=Welcome to Restaurant Info!" style="color:#3e6eba"><? echo stripslashes($rs->email); ?></a>
                           </td>

				<td align="center" ><? 
									if ($rs->welcome_email_sent) 
										echo $check_mark;
									else
									{
										?><a href="mark-welcome-email-sent.php?id=<?=$the_member_id?>">sent</a><?
									}
								?>
								</td>

				<td align="center" ><? 
									if ($allow_sales) 
									{
										?><a href="/admin/disable-store.php?member_id=<?=$the_member_id?>&token=<?=$_SESSION["token"]?>&sid=<? echo session_id(); ?>"><?=$check_mark?></a><?
									}
									else
									{
										?><a href="/admin/enable-store.php?member_id=<?=$the_member_id?>&token=<?=$_SESSION["token"]?>&sid=<? echo session_id(); ?>"><?=$xmark?></a><?
									}
								?>
								</td>

				<td align="center" ><? 
									if ($rs->email_verified_by_user) 
										echo $check_mark;
									else
										echo $xmark;
								?>
								</td>

				<td align="center" ><? 
									if ($rs->cancelled) 
										echo $check_mark;
									else
										echo '-';
								?>
								</td>

				<td align="center" ><? 
									if ($paypal_agree) 
										echo $check_mark;
									else
										echo $xmark;
								?>
								</td>

				<td align="center" ><? 
									if ($paypal_email) 
										echo $check_mark;
									else
										echo $xmark;
								?>
								</td>

				<td align="center" ><? 
									if ($charge_tax) 
										echo $check_mark;
									else
										echo '-';
								?>
								</td>
				<td align="center" ><? if ($charge_tax) echo $tax_rate . '%'; ?></td>

				<td align="center"><? echo stripslashes($rs->date_signedup); ?></td>

				<td align="center"><? echo str_replace(" ", '<br>', $rs->last_login); ?></td>
                    
				<td align="center" ><? 
					$query2 = "SELECT product_id FROM products WHERE user_id=" . mysql_real_escape_string($the_member_id);
					$result2 = mysql_query($query2) or die(mysql_error());
					$num_presentations = mysql_num_rows($result2);
					echo $num_presentations;
				 ?></td>
<? /*                     
				<td align="center">
				<a class="textlink" href="../edits/edit-member.php?id=<?=$rs->id?>"><img src="/images/cms/button-edit.jpg" width="40" height="15" alt="Edit" border="0" style="margin-bottom:7px" /></a>
				
				<a class="textlink" href="../deletes/delete-member.php?id=<?=$rs->id?>&token=<?=$_SESSION["token"];?>" onclick="return verify_delete('<? echo stripslashes($rs->last_name) . ", " . stripslashes($rs->first_name); ?>');"><img src="../../images/cms/button-delete.jpg" width="40" height="15" alt="Delete"  border="0" /></a>
				
				</td>
*/ ?>				
			</tr>
<?
			$row_counter++;
		}
	}
?> 
</tbody> 
	</table>
<br>

<?

//echo "server string: " . $_SERVER["QUERY_STRING"];

		$prev_page = $the_page;
		if ($prev_page > 1)
			$prev_page--;

		$num_partial_pages = ($number_of_listings % $listings_per_page);
		$num_pages = (int)($number_of_listings / $listings_per_page);
		if ($num_partial_pages)
			$num_pages++;
		$next_page = $the_page;
		if ($next_page < $num_pages)
			$next_page++;

		 if ($the_page > 1) 
		 { ?>
            &nbsp;<a href="list-members.php?<?=$_SERVER["QUERY_STRING"]?>">&lt;&lt; First</a>&nbsp; 
            &nbsp;<a href="list-members.php?page=<?=$prev_page?>&<?=$_SERVER["QUERY_STRING"]?>">&lt; Previous</a>&nbsp; 
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
				&nbsp;<a href="list-members.php?page=<?=$i?>&<?=$_SERVER["QUERY_STRING"]?>"><?=$i?></a>&nbsp; 
	<?
			}
		}
	?>
	
	<? if ($num_pages > 1 && $the_page < $num_pages) { ?>
			&nbsp;<a href="list-members.php?page=<?=$next_page?>&<?=$_SERVER["QUERY_STRING"]?>">Next &gt;</a>&nbsp; 
			&nbsp;<a href="list-members.php?page=<?=$num_pages?>&<?=$_SERVER["QUERY_STRING"]?>">Last &gt;&gt;</a>&nbsp; 
	<? } else { ?>
		<font color="#999999">
			&nbsp;Next &gt;&nbsp; 
			&nbsp;Last &gt;&gt;&nbsp; 
		</font>
	<? } ?>

<br /><br />

<a href="../edits/edit-member.php?id=0&new=1"><img src="../../images/cms/button-add.jpg" width="40" height="15" alt="Add Member" /></a>
