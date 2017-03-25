<style>
.editfocus {
	background-color:#ffffdd;
}

.editblur {
	background-color:#fff;
}
</style>
<script type="text/javascript">
function verify_delete(member_name) 
{
	var agree=confirm("Are you sure you wish to DELETE member '" + member_name + "'?  \n\nThis operation will permanantly remove the member from the website database and cannot be undone! \n\nIf you are absolutely certain you wish to delete this member, click OK. \n\nTo cancel this operation, click CANCEL. ");
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
	
	$query = "SELECT * FROM members WHERE member_id <> 1 ";
	
	if ($_GET["member_type"] == 'c' || $_GET["member_type"] == 'C')
		$query .= " AND member_type = 'c'";
	else if ($_GET["member_type"] == 'e' || $_GET["member_type"] == 'E')
		$query .= " AND member_type = 'e'";

	if ($_GET["company_name"])
		$query .= " AND company_name LIKE '%" . stripslashes($_GET["company_name"]) . "%'";

	if ($_GET["first_name"])
		$query .= " AND first_name LIKE '%" . stripslashes($_GET["first_name"]) . "%'";
	if ($_GET["last_name"])
		$query .= " AND last_name LIKE '%" . stripslashes($_GET["last_name"]) . "%'";

	if ($_GET["state"])
		$query .= " AND state LIKE '%" . stripslashes($_GET["state"]) . "%'";

	$query .= " ORDER BY member_type"; 
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

	if ($debug_msgs) echo $query . "<br>";
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

<? require("list-members-filter-inc.php"); ?>

<strong><?=$number_of_listings?> Members</strong>.  &nbsp; &nbsp; &nbsp; Showing <?=$first_show?> - <?=$last_show?>
<br>

<table width="100%"   border="1" bordercolor="#eeeeee" style="font-size:13px; border-collapse:collapse; border-color:#ccc !important; " cellspacing="0" cellpadding="3">
    <tr style="height:26px; background-image:url(/images/cms/tbl-hdr-bkd-mid.jpg); background-repeat:repeat-x; color:#333">
        <td width="175"  align="left">&nbsp;<strong>Name</strong></td>
        <td width="50"  align="center"><strong>Type</strong>.</td>
        <td width="50" align="center" ><strong>Vfy'd</strong></td>
        <td width="75"  align="center"><strong>Signed </strong>Up</td>
        <td width="100"  align="center"><strong>Last Login</strong></td>
        <td width="75"  align="center"><strong>Jobs Posted</strong></td>
        <td width="75"  align="center"><strong>Jobs Applied</strong></td>
        <td width="50"  align="center"><strong>Info</strong></td>
        <td width="50"  align="center"><strong>Profile</strong></td>
        <td width="50"  align="center"><strong>Remove</strong></td>
    </tr>
<?
	if ($number_of_listings > 0) 	// any listings ?
	{
		$td_counter = 0;
		$row_counter = 1;
		while ($rs = mysql_fetch_object($result))
		{
			$member_token = stripslashes($rs->token);
			$the_member_id = $rs->member_id;
			$member_type = $rs->member_type;
			$first_name = stripslashes($rs->first_name);
			$last_name = stripslashes($rs->last_name);
			$email = stripslashes($rs->email);
			$company_name = stripslashes($rs->company_name);
			
			if ($the_member_id)
			{
?>
	  <tr onmouseover="this.className='editfocus';" onmouseout="this.className='editblur';">

				<td align="left" >&nbsp;<? echo stripslashes($rs->first_name) . " " . stripslashes($rs->last_name); ?>
                				  <? if ($member_type == "E" && $company_name)
								  		echo "<br>&nbsp;<strong>" . $company_name . "</strong>";
								?>
                </td>

				<td align="center" ><? echo stripslashes($rs->member_type); ?></td>

				<td align="center" ><? 
									if ($rs->email_verified_by_user) 
										echo $check_mark;
									else
										echo $xmark;
								?>
								</td>

				<td align="center"><? echo stripslashes($rs->date_signedup); ?></td>

				<td align="center"><? echo stripslashes($rs->last_login); ?></td>

				<td align="center">
									<? if ($member_type == 'E') 
									{ 
										$query3 = "SELECT job_id FROM jobs WHERE member_id=" . mysql_real_escape_string($the_member_id);
										$result3 = mysql_query($query3) or die(mysql_error());
										$num_jobs = mysql_num_rows($result3);
										echo $num_jobs;
									}
									else
										echo "<span style='color:#ccc'>n/a</span>"; ?>
                                  </td>

				<td align="center">
									<? if ($member_type == 'C') 
									{ 
										$query3 = "SELECT job_applications_local_id FROM job_applications_local WHERE candidate_member_id=" . mysql_real_escape_string($the_member_id);
										$result3 = mysql_query($query3) or die(mysql_error());
										$num_job_applications_local = mysql_num_rows($result3);

										$query3 = "SELECT job_applications_remote_id FROM job_applications_remote WHERE candidate_member_id=" . mysql_real_escape_string($the_member_id);
										$result3 = mysql_query($query3) or die(mysql_error());
										$num_job_applications_remote = mysql_num_rows($result3);
										
										$num_job_applications = $num_job_applications_local + $num_job_applications_remote;
										echo $num_job_applications;
									}
									else
										echo "<span style='color:#ccc'>n/a</span>"; ?>
                                  </td>
   
				<td align="center">
				<a class="textlink" href="edit-member.php?id=<?=$the_member_id?>&adm=1&mt=<?=$member_token?>&tk=<?=$_SESSION["token"];?>"><img src="/images/members/button-edit.jpg" width="40" height="15" alt="Edit" border="0"  /></a>
                   </td>

				<td align="center">
				<a class="textlink" href="edit-profile.php?id=<?=$the_member_id?>&adm=1&mt=<?=$member_token?>&tk=<?=$_SESSION["token"];?>"><img src="/images/members/button-edit.jpg" width="40" height="15" alt="Edit" border="0"  /></a>
                   </td>

				<td align="center">
				<a class="textlink" href="delete-member.php?id=<?=$the_member_id?>&adm=1&mt=<?=$member_token?>&tk=<?=$_SESSION["token"];?>" onclick="return verify_delete('<? echo stripslashes($rs->last_name) . ", " . stripslashes($rs->first_name); ?>');"><img src="/images/members/button-delete.jpg" width="40" height="15" alt="Delete"  border="0" /></a>
                   </td>

				</tr>
<?
				$row_counter++;
			}
		}
	}
?> 
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
            &nbsp;<a href="members.php?<?=$_SERVER["QUERY_STRING"]?>">&lt;&lt; First</a>&nbsp; 
            &nbsp;<a href="members.php?page=<?=$prev_page?>&<?=$_SERVER["QUERY_STRING"]?>">&lt; Previous</a>&nbsp; 
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
				&nbsp;<a href="members.php?page=<?=$i?>&<?=$_SERVER["QUERY_STRING"]?>"><?=$i?></a>&nbsp; 
	<?
			}
		}
	?>
	
	<? if ($num_pages > 1 && $the_page < $num_pages) { ?>
			&nbsp;<a href="members.php?page=<?=$next_page?>&<?=$_SERVER["QUERY_STRING"]?>">Next &gt;</a>&nbsp; 
			&nbsp;<a href="members.php?page=<?=$num_pages?>&<?=$_SERVER["QUERY_STRING"]?>">Last &gt;&gt;</a>&nbsp; 
	<? } else { ?>
		<font color="#999999">
			&nbsp;Next &gt;&nbsp; 
			&nbsp;Last &gt;&gt;&nbsp; 
		</font>
	<? } ?>

<br /><br />
