<?
session_start();

$use_CDN = 1;
$this_page = "search candidates";

require("bootstrap_v1/incld/config.php");
require("bootstrap_v1/incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("bootstrap_v1/incld/page_start_inc.php");
require("bootstrap_v1/incld/top-banner-inc2.php");

?>
<div class="container marketing">
    
    <div class="row">
    
        <div class="column1">
        	<img src="/images/headers/search-candidates-criteria.jpg" width="276" height="27" alt="Search Candidates Criteria" />
          	<br><br>
			<? require("members/job-id-helper-update-inc.php"); ?>
			<? require("members/search-form-candidates-inc.php"); ?>
        </div>
        
        <div class="two_column_divider">
        	<img src="/images/layout/vertical-dashed-line.gif" width="3" height="300" />
        </div>

      <div class="column2">
        	<img src="/images/headers/search-results.jpg" width="150" height="27" alt="Search" />
          	<br><br>
			<? require("members/search-candidate-results-inc.php"); ?>
        </div>

    <div style="clear:both"></div>
        
    <? require("bootstrap_v1/incld/footer_inc.php"); ?>
        
    </div>
    
</div>
<?
require("bootstrap_v1/incld/page_end_inc.php");


