<?
session_start();

$use_CDN = 1;
$this_page = "apply";

require("bootstrap_v1/incld/config.php");
require("incld/isloggedin.php");
require("bootstrap_v1/incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("bootstrap_v1/incld/page_start_inc.php");
require("bootstrap_v1/incld/top-banner-inc2.php");
require("members/registration-utils-inc.php");

$rnd_num1 = rand(1, 9);
$rnd_num2 = rand(1, 9);
$rnd_num3 = rand(1, 9);
$rnd_num4 = rand(1, 9);
$rand_number = ($rnd_num1 * 1000) + ($rnd_num2 * 100) + ($rnd_num3 * 10) + $rnd_num4; 

$_SESSION["apply_for_job_id"] = ($_GET["job_id"]) ? $_GET["job_id"] : 0;

?>
<div class="container marketing">
    
    <div class="row">

        <div class="column1" style="width:25% !important">
        	<img src="/images/headers/apply-for-job.jpg" width="200" height="27" alt="Apply for job" />
          	<br><br>
			<? $summary_only = 1; require("members/search-details-inc.php"); ?>
      </div>
        
        <div class="two_column_divider">
        	<img src="/images/layout/vertical-dashed-line.gif" width="3" height="300" />
        </div>

        <div class="column2" style="width:74% !important">
			<? require("members/apply-for-job-inc.php"); ?>
  	   </div>
        
    <div style="clear:both"></div>
        
    <? require("bootstrap_v1/incld/footer_inc.php"); ?>
        
    </div>
    
</div>
<?
require("bootstrap_v1/incld/page_end_inc.php");


