<style>
.editfocus {
	background-color:#ffffdd;
}

.editblur {
	background-color:#fff;
}
</style>
<? 
	$debug_msgs = 0;

	$check_mark = "<img src=\"/images/layout/checkmark.gif\">";
	$xmark = "<img src=\"/images/layout/xmark.jpg\">";

	$employer_member_id = $_SESSION["member_id"];
?>
<br />
    <img src="/images/headers/applicants.jpg" width="128" height="27" alt="Applicants" /><br />
<br />
    
    <table id="myTable2" class="tablesorter" width="99%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse; border-color:#888; box-shadow: 5px 5px 5px #ddd; margin-right:5px; margin-bottom:5px">
    <thead> 
        <tr style="background-color:#CCC">
          <th align="left">&nbsp;<strong>Name</strong></th>
          <th align="center">&nbsp;Job Code</th>
          <th align="center">&nbsp;Applied on</th>
          <th align="center" style="width:200px !important">&nbsp;Notifications</th>
          <th align="center" style="width:20px !important">&nbsp;<strong>+</strong></th>
          <th align="center" style="width:30px !important">&nbsp;</th>
        </tr>
      </thead> 
      <tbody> 
      <?
          $query4  = "SELECT 
                          DISTINCT job_applications_local.candidate_member_id,
						  job_applications_local.job_id,
						  date_applied
                      FROM 
                          job_applications_local
                      WHERE 
                          job_applications_local.employer_member_id = '" . $employer_member_id . "' ";
						  
		if ($_GET["view_applies_job_id"])
			  $query4 .= "				  
						  AND job_applications_local.job_id = '" . $_GET["view_applies_job_id"] . "'"; 
		$query4 .= "				  
                      UNION	
                          SELECT 
                              DISTINCT job_applications_remote.candidate_member_id,
						  	  job_applications_remote.job_id,
						  	  date_applied
                          FROM 
                              job_applications_remote
                          WHERE 
                              job_applications_remote.employer_member_id = '" . $employer_member_id . "' ";
		if ($_GET["view_applies_job_id"])
			  $query4 .= "				  
							  AND
                              job_applications_remote.job_id = '" . $_GET["view_applies_job_id"] . "' 
                          ";
          if ($debug_msgs) echo $query4 . "<br>";
          $result4 = mysql_query($query4) or die(mysql_error());
          $num_found = mysql_num_rows($result4);
          while ($rs4 = mysql_fetch_object($result4))
          {
              $candidate_member_id = stripslashes($rs4->candidate_member_id);
              $job_id = stripslashes($rs4->job_id);
              $date_applied = stripslashes($rs4->date_applied);
              
              $query5 = "SELECT first_name,last_name,city,state,email FROM members WHERE member_id=" . $candidate_member_id;
              $result5 = mysql_query($query5) or die(mysql_error());
              $rs5 = mysql_fetch_object($result5);
              $candidate_name = stripslashes($rs5->last_name) . ", " . stripslashes($rs5->first_name);
              $city = stripslashes($rs5->city);
              $state = stripslashes($rs5->state);
              $email = stripslashes($rs5->email);
              @mysql_free_result($result5);
              
              $query5 = "SELECT job_code FROM jobs WHERE job_id=" . $job_id;
              $result5 = mysql_query($query5) or die(mysql_error());
              $rs5 = mysql_fetch_object($result5);
              $job_code = stripslashes($rs5->job_code);
              @mysql_free_result($result5);
              ?>
    			<tr onmouseover="this.className='editfocus';" onmouseout="this.className='editblur';">
                  <td align="left"><?
				  					echo $candidate_name;
                  				  	if ($city || $state)
								  		echo "<br />";
								  	if ($city) 
										echo $city;
									if ($city && $state) 
										echo ", ";
									if ($state) 
										echo $state; 
									if ($email)
									{
										?><br /><a href="mailto:<?=$email?>?subject=Your Job Application"><?=$email?></a><?
									}
									?>
                  </td>
                  <td align="left"><?=$job_code?></td>
                  <td align="left"><?=$date_applied?></td>
                  
                  <td align="left" style="font-size:12px !important">
				  <?
				  	  $notify_counter = 1;
					  $query5 = "SELECT * FROM employer_sent_notifications 
					  					  WHERE
										  	job_id='" . $job_id . "' AND
										  	employer_member_id='" . $employer_member_id . "' AND
										  	candidate_member_id='" . $candidate_member_id . "'
										  ORDER BY
										  	unix_time_sent 
											";
					  if ($debug_msgs) echo $query5 . "<br>";
					  $result5 = mysql_query($query5) or die(mysql_error());
					  while ($rs5 = mysql_fetch_object($result5))
					  {
						  $date_sent = stripslashes($rs5->date_sent);
						  $time_sent = stripslashes($rs5->time_sent);
						  $notification_type = stripslashes($rs5->notification_type);
						  $notification_comments = stripslashes($rs5->notification_comments);
					
                    	  switch ($notification_type)
						  {
							  case 1:  $type_text = "Request Application"; break;
							  case 2:  $type_text = "Request Phone Interview"; break;
							  case 3:  $type_text = "Request Interview"; break;
							  case 4:  $type_text = "Make Job Offer"; break;
							  case 5:  $type_text = "Reject Application"; break;
							  default: $type_text = "Other"; break;

						  }
						  echo $notify_counter . ")&nbsp;" . $date_sent . " " . $time_sent;
						  echo "<br>&nbsp;&nbsp;&nbsp; " . $type_text;
						  if ($notification_comments)
						  	echo "<br>&nbsp;&nbsp;&nbsp; " . $notification_comments . "<br />";
						  $notify_counter++;
					  }
					  @mysql_free_result($result5);
	
					  if ($candidate_member_id == $_GET["enotmid"])
					  {
					  ?>
						  <form name="notification_form" method="post" action="send-notification-job.php">
						  <input type="hidden" name="token" value="<? $_SESSION["token"] = sha1(uniqid(rand(), TRUE)); echo $_SESSION["token"]; ?>" />
						  <input type="hidden" name="sid"   value="<? echo session_id(); ?>">
						  <input name="job_id" type="hidden" value="<?=$job_id?>">
						  <input name="candidate_member_id" type="hidden" value="<?=$candidate_member_id?>">
						  <input name="employer_member_id" type="hidden" value="<?=$employer_member_id?>">
						  
                          
                            <strong>Notification Type</strong>:<br />
							<select name="notification_type" id="notification_type"  style="width:200px;">
							  <option  value="0">Select</option>
							  <option  value="1">Request Application</option>
							  <option  value="2">Request Phone Interview</option>
							  <option  value="3">Request Interview</option>
							  <option  value="4">Make Job Offer</option>
							  <option  value="5">Reject Application</option>
							  <option  value="9">Other</option>
							  </select>
							  <br />
							  <strong>Comments</strong>:<br />
							<input type="text" name="notification_comments" size="32" maxlength="40" onfocus="this.select();">
						  <br />
						  <input name="submit" type="submit" value="Send">&nbsp; 
                          <input name="cancel" type="button" value="Cancel" onclick="return document.location.href='/my-jobs.php?view_applies_job_id=<?=$_GET["view_applies_job_id"]?>'"></td>

						  </form>
					  <?	
					  }
					  else
					  {
						  
					  }
					?></td>
                  
                  <td align="center"><a href="/my-jobs.php?enotmid=<?=$candidate_member_id?>&view_applies_job_id=<?=$_GET["view_applies_job_id"]?>&tk=<?=$_SESSION["token"]?>"><img src="/images/members/edit-icon.jpg" width="16" height="16" alt="Edit Notification" /></a></td>
                  <td align="center"><a href="/search-candidate-details.php?member_id=<?=$candidate_member_id?>"><img src="/images/layout/icon-magnifying-glass.jpg" width="17" height="17" alt="View order details"></a></td>
              </tr>
            <?
          }
          @mysql_free_result($result4);
        ?>
      </tbody> 
      </table>