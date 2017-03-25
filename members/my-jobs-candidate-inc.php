<style>
.editfocus {
	background-color:#ffffdd;
}

.editblur {
	background-color:#fff;
}
</style>

<script type="text/javascript">
function verify_remove(title) 
{
	var agree=confirm("Are you sure you wish to REMOVE this job from your '" + title + "' list?  \n\nThis operation will permanantly REMOVE the job from your list and cannot be undone! \n\nIf you are absolutely certain you wish to REMOVE this job from your list, click OK. \n\nTo cancel this operation, click CANCEL. ");
	if (agree) {
		return true;
	} else {
		return false;
	}
}
</script>


<img src="/images/headers/jobs.jpg" width="113" height="27" alt="My Jobs" />
<br /><br />
<div style="margin-left:12px;">
<strong>MY SAVED JOBS</strong><br /><br />

<? require("members/my-saved-jobs-inc.php"); ?>

<br />
<strong>JOBS I HAVE APPLIED FOR</strong><br /><br />

<? require("members/my-applied-jobs-inc.php"); ?>
<br />

<em>Note: click on any column title to resort the table</em>.
</div>
