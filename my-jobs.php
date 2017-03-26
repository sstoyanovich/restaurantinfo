<?
session_start();

$in_dashboard = 1;
$this_page = "jobs";

require("bootstrap_v1/incld/config.php");
require("incld/isloggedin.php");
require("bootstrap_v1/incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("members/get-member-info-inc.php");
require("bootstrap_v1/incld/page_start_inc.php");
require("bootstrap_v1/incld/top-banner-inc2.php");

?>
<div class="container marketing">

    <div class="row">

        <div class="info_page_content" style="width:95% !important">
			<?
				if ($member_type == "C")
					require("members/my-jobs-candidate-inc.php");
				else if ($member_type == "E")
				{
					require("members/my-jobs-employer-inc.php");
					if ($_GET["view_applies_job_id"]) require("members/my-jobs-employer-applicants-inc.php");
				}
				else
					require("members/my-jobs-inc.php");
			?>
        </div>
        <div  class="info_page_content" style="width:95% !important">
          require("members/edit-job-inc.php");
        </div>

    <div style="clear:both"></div>

    <? require("bootstrap_v1/incld/footer_inc.php"); ?>

    </div>

</div>
<?
require("bootstrap_v1/incld/page_end_inc.php");
