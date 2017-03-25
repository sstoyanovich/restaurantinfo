<?
if ($_SESSION["logged_in"])
{
	require("apply-for-job-form-inc.php");
}
else 
{
?>
<span style="font-size:16px">To apply for this job, please login to your account below</span>:<br><br>

<? 
	$suppress_login_hdr = 1;
	require("login-inc.php"); 
?>
<br /><br />

<span style="font-size:16px">If you do not have an account yet, please <a href="register.php?member_type=C&apply_for_job_id=<?=$_SESSION["apply_for_job_id"]?>" style="text-decoration:underline">signup now</a>.</span><br><br>

<? 
}
