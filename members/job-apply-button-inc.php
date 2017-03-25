<? 
$job_id = $_GET["job_id"];
if (!$job_id) $job_id = 0; 

$member_id = $_SESSION["member_id"];
if (!$member_id) $member_id = 0; 

$debug_msgs_this_code_only = 0;
$debug_msgs = 0;

if ($job_id && $member_id)
{
	//***************************************************************
	// See if this member has already applied for this job
	//***************************************************************
	
	$query3 = "SELECT job_applications_local_id FROM job_applications_local WHERE candidate_member_id='" . mysql_real_escape_string($member_id) . "' AND job_id='" . $job_id . "'";;
	$result3 = mysql_query($query3) or die(mysql_error());
	$locally_applied = (mysql_num_rows($result3)) ? 1 : 0;

	$query3 = "SELECT job_applications_remote_id FROM job_applications_remote WHERE candidate_member_id='" . mysql_real_escape_string($member_id) . "' AND job_id='" . $job_id . "'";;
	$result3 = mysql_query($query3) or die(mysql_error());
	$remotely_applied = (mysql_num_rows($result3)) ? 1 : 0;

	if ($debug_msgs || $debug_msgs_this_code_only)
	{
		echo "locally_applied = $locally_applied<br />";
		echo "remotely_applied = $remotely_applied<br />";
	}

	if ($locally_applied || $remotely_applied)
	{
		?><img src="/images/members/applied.jpg" width="108" height="27" alt="Applied for job" /><?		
	}
	else
	{
		//***************************************************************
		// If not applied yet, show button.
		//***************************************************************
		
		$query3 = "SELECT job_code,apply_locally,apply_remotely,apply_url,email_for_job_applies FROM jobs WHERE job_id='" . mysql_real_escape_string($job_id) . "'";
		if ($debug_msgs || $debug_msgs_this_code_only) echo $query3 . "<br />";
		$result3 = mysql_query($query3) or die(mysql_error());
		$rs3 = mysql_fetch_object($result3);
		$job_code = stripslashes($rs3->job_code);
		$apply_locally = stripslashes($rs3->apply_locally);
		$apply_remotely = stripslashes($rs3->apply_remotely);
		$apply_url = stripslashes($rs3->apply_url);
		$email_for_job_applies = stripslashes($rs3->email_for_job_applies);
		@mysql_free_result($result3);
		
		if ($debug_msgs || $debug_msgs_this_code_only)
		{
			echo "job_code = $job_code<br />";	
			echo "apply_locally = $apply_locally<br />";	
			echo "apply_remotely = $apply_remotely<br />";	
			echo "apply_url = $apply_url<br />";	
			echo "email_for_job_applies = $email_for_job_applies<br />";	
		}
	
		if ($_SESSION["logged_in"])
		{	
			if ($apply_locally && $email_for_job_applies)
			{
	?>
				<form action="apply-for-job.php" method="get">
				<input type="hidden" name="job_id" value="<?=$job_id?>">
				<input type="hidden" name="job_code" value="<?=$job_code?>">
				<input type="hidden" name="member_id" value="<?=$_SESSION["member_id"]?>">
				<input type="hidden" name="token"  value="<? $_SESSION["token"] = sha1(uniqid(rand(), TRUE)); echo $_SESSION["token"]; ?>" />
				<input type="hidden" name="sid"    value="<? echo session_id(); ?>">
				<input name="submit" type="submit" value="Apply for this job"> <span style="color:#ccc">locally</span>
				</form>
	<?
			}
			else if ($apply_remotely && $apply_url)
			{
	?>
				<form action="apply-remotely-for-job.php" method="get" target="_blank">
				<input type="hidden" name="job_id" value="<?=$job_id?>">
				<input type="hidden" name="job_code" value="<?=$job_code?>">
				<input type="hidden" name="member_id" value="<?=$_SESSION["member_id"]?>">
				<input type="hidden" name="token"  value="<? $_SESSION["token"] = sha1(uniqid(rand(), TRUE)); echo $_SESSION["token"]; ?>" />
				<input type="hidden" name="sid"    value="<? echo session_id(); ?>">
				<input name="submit" type="submit" value="Apply for this job"> <span style="color:#ccc">remotely</span>
				</form>
	<?
			}
		}
		else
		{
	?>
				<form action="apply-for-job.php" method="get">
				<input type="hidden" name="job_id" value="<?=$job_id?>">
				<input type="hidden" name="job_code" value="<?=$job_code?>">
				<input type="hidden" name="member_id" value="<?=$_SESSION["member_id"]?>">
				<input type="hidden" name="token"  value="<? $_SESSION["token"] = sha1(uniqid(rand(), TRUE)); echo $_SESSION["token"]; ?>" />
				<input type="hidden" name="sid"    value="<? echo session_id(); ?>">
				<input name="submit" type="submit" value="Apply for this job">
				</form>
	<?
		}
	}
}

$debug_msgs_this_code_only = 0;
