<?
if ($_GET["stid"])
{
	$_SESSION["store_member_id"] = $_GET["stid"];
}
else if ($_GET["prod"])
{
	$query3 = "SELECT user_id FROM products WHERE product_id=" . $_GET["prod"];
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	$user_id = stripslashes($rs3->user_id);
	@mysql_free_result($result3);
	
	$_SESSION["store_member_id"] = $user_id;
}
if (!$_SESSION["store_member_id"]) $_SESSION["store_member_id"] = 0;

$query3 = "SELECT * FROM members WHERE member_id='" . $_SESSION["store_member_id"] . "'";
if ($debug_msgs) echo $query3 . "<br />";
$result3 = mysql_query($query3) or die(mysql_error());
$rs3 = mysql_fetch_object($result3);
$company_name = stripslashes($rs3->company_name);
$first_name = stripslashes($rs3->first_name);
$last_name = stripslashes($rs3->last_name);
$zip = stripslashes($rs3->zip);
$email = stripslashes($rs3->email);
$members_session_id = stripslashes($rs3->session_id);
$phone_number = trim(stripslashes($rs3->phone_number));
$business_website = stripslashes($rs3->business_website);
$store_sub_url = stripslashes($rs3->store_sub_url);
$profile_photo = stripslashes($rs3->profile_photo);
$store_logo = stripslashes($rs3->store_logo);
$profile_bio = trim(stripslashes($rs3->profile_bio));
$show_profile = (stripslashes($rs3->show_profile)) ? 1 : 0;
$show_first_name_on_site = ($rs3->show_first_name_on_site) ? 1 : 0;
$show_last_name_on_site = ($rs3->show_last_name_on_site) ? 1 : 0;
$show_phone_number_on_site = ($rs3->show_phone_number_on_site) ? 1 : 0;
$show_email_on_site = ($rs3->show_email_on_site) ? 1 : 0;
$show_business_website_on_site = ($rs3->show_business_website_on_site) ? 1 : 0;
@mysql_free_result($result3);

if ($_GET["ksdb"] == 735) echo "_SESSION[store_member_id] = " . $_SESSION["store_member_id"] . "<br />";
		

