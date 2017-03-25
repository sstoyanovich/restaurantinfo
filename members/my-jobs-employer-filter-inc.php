<?
	if ($_GET["submit"] == "Go")
	{
		$_SESSION["hide_jobs_new"]      = ($_GET["show_jobs_new"]) ? 0 : 1;
		$_SESSION["hide_jobs_open"]     = ($_GET["show_jobs_open"]) ? 0 : 1;
		$_SESSION["hide_jobs_offer"]    = ($_GET["show_jobs_offer"]) ? 0 : 1;
		$_SESSION["hide_jobs_filled"]   = ($_GET["show_jobs_filled"]) ? 0 : 1;
		$_SESSION["hide_jobs_closed"]   = ($_GET["show_jobs_closed"]) ? 0 : 1;
		$_SESSION["hide_jobs_archived"] = ($_GET["show_jobs_archived"]) ? 0 : 1;
	}
?>
<form action="/my-jobs.php" method="get" name="members">
<strong>Show Jobs That Are:</strong>  &nbsp;
<input name="show_jobs_new" type="checkbox" value="1" <? if (!$_SESSION["hide_jobs_new"]) echo "checked"; ?>> New &nbsp;
<input name="show_jobs_open" type="checkbox" value="1" <? if (!$_SESSION["hide_jobs_open"]) echo "checked"; ?>> Open &nbsp;
<input name="show_jobs_offer" type="checkbox" value="1" <? if (!$_SESSION["hide_jobs_offer"]) echo "checked"; ?>> Offered &nbsp;
<input name="show_jobs_filled" type="checkbox" value="1" <? if (!$_SESSION["hide_jobs_filled"]) echo "checked"; ?>> Filled &nbsp;
<input name="show_jobs_closed"  type="checkbox" value="1" <? if (!$_SESSION["hide_jobs_closed"]) echo "checked"; ?>> Closed &nbsp;
<input name="show_jobs_archived" type="checkbox" value="1" <? if (!$_SESSION["hide_jobs_archived"]) echo "checked"; ?>> Archived &nbsp; &nbsp;
<input name="submit" type="submit" value="Go">
</form>


<br />