<?
session_start();
$is_cms = 1;
require("bootstrap_v1/incld/db.php");
require_once("bootstrap_v1/incld/utils.php");	

$debug_msgs = 0;
	
//********************************************************************************************************
// Collect and clean parms
//********************************************************************************************************

$token          = clean_post_var($_POST["token"]);
$session_token  = $_SESSION["token"];
$session_id     = clean_post_var($_POST["sid"]);
$session_sid    = session_id();
$ip_address     = clean_post_var($_POST["ip_address"]);
$this_ip_addr   = $_SERVER["REMOTE_ADDR"];
$self           = clean_post_var($_POST["self"]);
$server         = clean_post_var($_POST["server"]);

$email 			= clean_post_var($_POST["email"]);
$password     	= clean_post_var($_POST["password"]);
$fwd          	= clean_post_var($_POST["fwd"]);

$apply_for_job_id = clean_post_var($_POST["apply_for_job_id"]);

//if (session_id() == "c52a3e9d0312695cc17940f8b1d14731")
//	$debug_msgs = 1;

//if ($email == "ken2")
//	$debug_msgs = 1;

if ($debug_msgs)
{
	echo "token = $token<br />";	
	echo "session_token = " . $_SESSION["token"] . "<br />";	
	echo "session_id = $session_id<br />";	
	echo "session_sid = $session_sid<br />";	
	echo "ip_address = $ip_address<br />";	
	echo "this_ip_addr = $this_ip_addr<br />";	
	echo "self = $self<br />";	
	echo "server = $server<br />";	
	echo "email = $email<br />";	
	echo "password = $password<br />";	
	echo "fwd = $fwd<br />";	
	echo "apply_for_job_id = $apply_for_job_id<br />";	
}

// Protect against cross site scripting
if ($session_token != $token        || !$token      || !$session_token || 
	$session_id    != $session_sid  || !$session_id || !$session_sid   ||
	$ip_address    != $this_ip_addr 
	)
{
	header("Location: login.php?username=" . $username . "&token=bad&fwd=" . $fwd);
	exit;
}

$query = "SELECT login_tokens_id FROM login_tokens WHERE session_id = '" . mysql_real_escape_string($session_id) . "'";
if ($debug_msgs) echo "$query<br />";
$result = mysql_query($query) or die(mysql_error());
$found_in_tokens = mysql_num_rows($result);
if (!$found_in_tokens)
{
	$query7 = "INSERT INTO login_tokens SET session_id='" . mysql_real_escape_string($session_id) . "'";
	if ($debug_msgs) echo "$query7<br />";
	$result7 = mysql_query($query7) or die(mysql_error());
}

$query7 = "UPDATE login_tokens SET login_attempts = login_attempts + 1 WHERE session_id='" . mysql_real_escape_string($session_id) . "'";
if ($debug_msgs) echo "$query7<br />";
$result7 = mysql_query($query7) or die(mysql_error());


//********************************************************************************************************
// check to see if username/password combo is correct
//********************************************************************************************************

$query = "SELECT member_id FROM members WHERE email='" . addslashes($email) . "' OR username='" . addslashes($email) . "'";
if ($debug_msgs) echo "$query<br />";
$result = mysql_query($query) or die(mysql_error());
$email_address_is_in_db = (mysql_num_rows($result)) ? 1 : 0;
if ($debug_msgs) echo "email_address_is_in_db = $email_address_is_in_db<br />";
if (!$email_address_is_in_db) 	
{
	$fwd_url = "login.php?email=" . $email . "&failed=1&bademail=1&fwd=" . $fwd;
		
	if ($debug_msgs)
		echo "login failed, would normally forward to $fwd_url<br />";
	else
	{
		header("Location: $fwd_url");
		exit;
	}
}

$query = "SELECT 
			  member_id, 
			  member_type, 
			  email_verified_by_user, 
			  first_name, 
			  last_name,
			  email,
			  profile_folder,
			  company_name,
			  token
		  FROM 
			  members 
		  WHERE 
			  (
				  email='" . addslashes($email) . "' OR
				  username='" . addslashes($email) . "' 
			  )";
$query .= " AND password = '" . sha1($password) . "'";
if ($debug_msgs) echo "$query<br />";
$result = mysql_query($query) or die(mysql_error());
$found_in_members = mysql_num_rows($result);
if ($debug_msgs) echo "found_in_members = $found_in_members<br />";
if ($found_in_members) 	// match in the database for username/password commbination ?
{
	$rs = mysql_fetch_object($result);
	$member_id = $rs->member_id;
	$the_member_type = $rs->member_type;
	$email_verified_by_user = $rs->email_verified_by_user;
	$member_first_name = $rs->first_name;
	$member_last_name = $rs->last_name;
	$email = $rs->email;
	$member_token = $rs->token;
	$profile_folder = $rs->profile_folder;
	$company_name = $rs->company_name;
	@mysql_free_result($result);
	
	if ($debug_msgs)
	{
		echo "member_id = $member_id<br />";	
		echo "the_member_type = $the_member_type<br />";	
		echo "email_verified_by_user = $email_verified_by_user<br />";	
		echo "member_first_name = $member_first_name<br />";	
		echo "member_last_name = $member_last_name<br />";	
		echo "email = $email<br />";	
		echo "member_token = $member_token<br />";	
		echo "profile_folder = $profile_folder<br />";	
		echo "company_name = $company_name<br />";	
	}
	
	//****************************************************************************************************
	// Make sure the email address has been verified
	//***************************************************************************************************

	if (!$email_verified_by_user)
	{
		$fwd_url = "login.php?failed=1&notvfy=1&fwd=" . $fwd;
		
		if ($debug_msgs)
			echo "login failed, would normally forward to $fwd_url<br />";
		else
		{
			header("Location: $fwd_url");
			exit;
		}
	}

	//****************************************************************************************************
	// If Employer Type, make sure the members folder has been created
	//***************************************************************************************************

	if ($the_member_type == 'E' && $member_id == 8)
	{
		if ($debug_msgs) echo "<br><strong>Making sure the members profile folder has been created</strong>...<br />";
		if (1 || $company_name && !$profile_folder)
		{
			$members_profile_folder = strtolower($company_name);
			$members_profile_folder = str_replace(' ', '-', $members_profile_folder);				// remove spaces
			$members_profile_folder = str_replace('"', '',  $members_profile_folder);				// remove special characters
			$members_profile_folder = str_replace('\'', '', $members_profile_folder);				
			$members_profile_folder = str_replace('!', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('@', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('#', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('$', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('%', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('^', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('&', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('*', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('(', '',  $members_profile_folder);				
			$members_profile_folder = str_replace(')', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('_', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('+', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('=', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('{', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('}', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('[', '',  $members_profile_folder);				
			$members_profile_folder = str_replace(']', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('|', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('\\', '', $members_profile_folder);				
			$members_profile_folder = str_replace(';', '',  $members_profile_folder);				
			$members_profile_folder = str_replace(':', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('<', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('>', '',  $members_profile_folder);				
			$members_profile_folder = str_replace(',', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('.', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('?', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('/', '',  $members_profile_folder);				
			$members_profile_folder = str_replace('-----', '-', $members_profile_folder);				
			$members_profile_folder = str_replace('----', '-', $members_profile_folder);				
			$members_profile_folder = str_replace('---', '-', $members_profile_folder);				
			$members_profile_folder = str_replace('--', '-', $members_profile_folder);		
					
			if ($debug_msgs) echo "members_profile_folder = $members_profile_folder<br />";		
	
			$members_folder_exists = file_exists($members_profile_folder);	
			if ($debug_msgs) echo "members_folder_exists = $members_folder_exists<br />";	
			if (!$members_folder_exists)
			{
				mkdir($members_profile_folder, 0755);
				$members_folder_exists = file_exists($members_profile_folder);					
				if ($debug_msgs) echo "members_folder_exists = $members_folder_exists<br />";	

				$query3 = "UPDATE members SET profile_folder='" . mysql_real_escape_string($members_profile_folder) . "' WHERE member_id=" . $member_id . " LIMIT 1";
				if ($debug_msgs) echo $query3 . "<br />";
				$result3 = mysql_query($query3) or die(mysql_error());
			}
			
			// Make sure the index file is in their folder
	
			$relative_index_pathname = $members_profile_folder . "/index.php";
			$members_index_exists = file_exists($relative_index_pathname);	
			if ($debug_msgs) echo "members_index_exists = $members_index_exists<br />";	
			if (!$members_index_exists)
			{
				$source_index = "members-index-template.php";
				copy($source_index, $relative_index_pathname);	
	
				$members_index_exists = file_exists($relative_index_pathname);	
				if ($debug_msgs) echo "members_index_exists = $members_index_exists<br />";	
		
				if ($members_index_exists)
				{
					$fp = fopen($relative_index_pathname, "r");
					if ($fp)
					{
						$template_content = "";
						while(!feof($fp))
							$template_content .= fread($fp, 4096);
						fclose($fp);
						if ($debug_msgs) echo "template_content = " . $template_content . "<br>";
						
						// The contents of the index file should look something like:
						// $_SESSION["store_member_id"] = {ID}; 
						
						$template_content = str_replace("{ID}", $member_id, $template_content);
						
						if ($debug_msgs) echo "template_content = " . $template_content . "<br>";
		
						$fp = fopen($relative_index_pathname, "w");	
						if ($fp)
						{
							fwrite($fp, $template_content);
							fclose($fp);
						}
					}
				}
			}
		}
	}

	
	//****************************************************************************************************
	// Set up session variables
	//***************************************************************************************************

	$_SESSION["logged_in"]     		= "logged_in";
	$_SESSION["email"]         		= $email;		
	$_SESSION["member_id"]     		= $member_id;
	$_SESSION["member_type"]   		= $the_member_type;
	$_SESSION["member_name"]   		= $member_first_name . ' ' . $member_last_name;
	$_SESSION["member_token"]   	= $member_token;
	$_SESSION["apply_for_job_id"] 	= $apply_for_job_id;

	$_SESSION["hide_jobs_new"] = 0;
	$_SESSION["hide_jobs_open"] = 0;
	$_SESSION["hide_jobs_offer"] = 0;
	$_SESSION["hide_jobs_filled"] = 1;
	$_SESSION["hide_jobs_closed"] = 1;
	$_SESSION["hide_jobs_archived"] = 1;

	//****************************************************************************************************
	// Forward to members page
	//***************************************************************************************************

	$query7 = "DELETE FROM login_tokens WHERE session_id='" . mysql_real_escape_string($session_id) . "'";
	if ($debug_msgs) echo "$query7<br />";	
	$result7 = mysql_query($query7) or die(mysql_error());	
	
	if ($the_member_type == 'A')
		$fwd_url = "members.php";	
	else if ($apply_for_job_id)
		$fwd_url = "apply-for-job.php?job_id=" . $apply_for_job_id;	
	else
		$fwd_url = "my-jobs.php";	
	
	if ($debug_msgs) 
		echo "About to forward to $fwd_url...<br />";	
	if (!$debug_msgs) header("Location: $fwd_url");	exit;
}
else  // if login fails, take user to login failed page.
{	
	$fwd_url = "login.php?email=" . $email . "&failed=1&badpass=1&fwd=" . $fwd;			
	if ($debug_msgs)		
		echo "login failed, would normally forward to $fwd_url<br />";	
	else	
	{		
		header("Location: $fwd_url");		
		exit;	
	}
}