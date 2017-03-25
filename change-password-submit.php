<?php 
session_start();
require("bootstrap_v1/incld/db.php");
require_once("bootstrap_v1/incld/utils.php");	

$debug_msgs = 0;

$token        = clean_post_var($_POST["token"]); 
$sid          = clean_post_var($_POST["sid"]); 
$member_id    = clean_post_var($_POST["member_id"]); 
$email        = clean_post_var($_POST["email"]); 
$old_passwd   = clean_post_var($_POST["old_passwd"]); 
$new_passwd   = clean_post_var($_POST["new_passwd"]);
$new_passwd2  = clean_post_var($_POST["new_passwd2"]);

if ($debug_msgs)
{
	echo "token = $token<br />";	
	echo "session token = " . $_SESSION["token"] . "<br />";	
	echo "sid = $sid<br />";	
	echo "session sid = " . session_id() . "<br />";	

	echo "member_id = $member_id<br />";	
	echo "email = $email<br />";	
	echo "old_passwd = $old_passwd<br />";	
	echo "new_passwd = $new_passwd<br />";	
	echo "new_passwd2 = $new_passwd2<br />";	
}

if ($token && $token == $_SESSION["token"] && 
    $sid && $sid == session_id() && 
	$email && $member_id && $old_passwd && $new_passwd && $new_passwd2
	&& $new_passwd == $new_passwd2)
{
	//****************************************************************************
	// First see if that email address matches one in the database.
	//****************************************************************************
	
	$query = "SELECT member_id FROM members WHERE member_id='" . $member_id . "' AND email='" . addslashes($email) . "'";
	if ($debug_msgs) echo $query . "<br />";
	$result = mysql_query($query) or die(mysql_error());
	$found_in_members = mysql_num_rows($result);
	if (!$found_in_members)
	{
		if ($debug_msgs)
			echo "Cannot find email in the database<br />";
		else
			header("Location: change-password.php?email=" . $email . "&foundemail=failed&expired=" . $expired);
	}
	else
	{
		//****************************************************************************
		// Now check to see if their old password is correct.
		//****************************************************************************
		
		$query2 = "SELECT member_id FROM members WHERE member_id='" . $member_id . "' AND email='" . mysql_real_escape_string($email) . "' AND password = '" . sha1($old_passwd) . "'";
		if ($debug_msgs) echo $query2 . "<br />";
		$result2 = mysql_query($query2) or die(mysql_error());
		$found_in_members = mysql_num_rows($result2);
		if ($debug_msgs) echo "found_in_members = $found_in_members<br />";
		if (!$found_in_members)
		{
			if ($debug_msgs)
				echo "Password is incorrect<br />";
			else
				header("Location: change-password.php?email=" . $email . "&password=failed&expired=" . $expired);
		}
		else
		{
			if ($debug_msgs) echo "Password is correct<br />";
			
			//****************************************************************************
			// Email and old password are correct, okay to change new password.
			//****************************************************************************

			if ($debug_msgs) echo "<strong>Changing Password...</strong><br />";
				
			$query = "UPDATE members SET password='" . sha1($new_passwd) . "' WHERE member_id='" . $member_id . "' AND email='" . mysql_real_escape_string($email) . "'";
			$result = mysql_query($query) or die(mysql_error());
			
			
			$the_url = "my-jobs.php?password=changed";
			header("Location: $the_url");
		}
	}
}
else
{
	if ($debug_msgs)
		echo "One or more parms is missing or incorrect.<br />";
	else
		header("Location: change-password.php?email=" . $email . "&parms=failed&expired=" . $expired);
}
