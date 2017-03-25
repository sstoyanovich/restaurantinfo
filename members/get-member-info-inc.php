<?
$member_id = $_SESSION["member_id"];
if ($member_id)
{
	$query3 = "SELECT * FROM members WHERE member_id='" . mysql_real_escape_string($member_id) . "'";
	if ($debug_msgs) echo $query3 . "<br />";
	$result3 = mysql_query($query3) or die(mysql_error());
	$rs3 = mysql_fetch_object($result3);
	
	$member_type = stripslashes($rs3->member_type);
	$job_title = stripslashes($rs3->job_title);
	
	$company_name = stripslashes($rs3->company_name);
	$first_name = stripslashes($rs3->first_name);
	$last_name = stripslashes($rs3->last_name);
	$address = stripslashes($rs3->address);
	$address2 = stripslashes($rs3->address2);
	$city = stripslashes($rs3->city);
	$state = stripslashes($rs3->state);
	$zip = stripslashes($rs3->zip);
	
	$email = stripslashes($rs3->email);
	
	$phone_area_code = stripslashes($rs3->phone_area_code);
	$phone_prefix = stripslashes($rs3->phone_prefix);
	$phone_last_4 = stripslashes($rs3->phone_last_4);
	$cell_phone_area_code = stripslashes($rs3->cell_phone_area_code);
	$cell_phone_prefix = stripslashes($rs3->cell_phone_prefix);
	$cell_phone_last_4 = stripslashes($rs3->cell_phone_last_4);
	
	$website_address = stripslashes($rs3->website_address);
	
	$security_question = stripslashes($rs3->security_question);
	$security_response = stripslashes($rs3->security_response);
	
	$company_logo = stripslashes($rs3->company_logo);
	$profile_photo = stripslashes($rs3->profile_photo);
	$resume_file = stripslashes($rs3->resume_file);
	$resume_upload_date = stripslashes($rs3->resume_upload_date);
	
	
	$profile_bio = stripslashes($rs3->profile_bio);
	$work_experience = stripslashes($rs3->work_experience);
	$education = stripslashes($rs3->education);
	$key_words = stripslashes($rs3->key_words);
	
	$show_profile = (stripslashes($rs3->show_profile)) ? 1 : 0;
	@mysql_free_result($result3);
}

