<?
session_start();

$use_CDN = 1;
$this_page = "search";

require("bootstrap_v1/incld/config.php");
require("bootstrap_v1/incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("bootstrap_v1/incld/page_start_inc.php");
require("bootstrap_v1/incld/top-banner-inc2.php");

?>
<div class="container marketing">

    <div class="row">

        <div class="column1">
        	<img src="/images/headers/search-jobs-criteria.jpg" width="200" height="27" alt="Search Jobs Criteria" />
          	<br><br>
		 // <? require("members/job-id-helper-update-inc.php"); ?>
			<? require("members/search-form-inc.php"); ?>
        </div>

        <div class="two_column_divider">
        	<img src="/images/layout/vertical-dashed-line.gif" width="3" height="300" />
        </div>

      <div class="column2">
        	<img src="/images/headers/search-results.jpg" width="150" height="27" alt="Search" />
          	<br><br>
			<? require("members/search-results-inc.php"); ?>
			<?
				if ($_SESSION["fav_email"])
				{
					?><em style="color:#00c">Your favorites are saved with email address: <?=$_SESSION["fav_email"]?></em><br /><?
				}
				else
					require("members/save-fav-email-form-inc.php");
			?>
        </div>

    <div style="clear:both"></div>

    <? require("bootstrap_v1/incld/footer_inc.php"); ?>

    </div>

</div>
<?
require("bootstrap_v1/incld/page_end_inc.php");
