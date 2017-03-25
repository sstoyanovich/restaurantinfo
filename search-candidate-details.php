<?
session_start();

$use_CDN = 1;
$this_page = "search-candidate-details";

require("bootstrap_v1/incld/config.php");
require("bootstrap_v1/incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("bootstrap_v1/incld/page_start_inc.php");
require("bootstrap_v1/incld/top-banner-inc2.php");

?>
<div class="container marketing">
    
    <div class="row">

        <div class="column1" style="width:25% !important">
        	<img src="/images/headers/candidates.jpg" width="128" height="27" alt="Search" />
          	<br><br>
			<? require("members/search-candidates-saved-inc.php"); ?>
</div>
        
        <div class="two_column_divider">
        	<img src="/images/layout/vertical-dashed-line.gif" width="3" height="300" />
        </div>

        <div class="column2" style="width:74% !important">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left"><img src="/images/headers/candidate-profile.jpg" width="200" height="27" alt="Candidate Profile" /></td>
              <td align="center"><? require("members/job-apply-button-inc.php"); ?></td>
              <td align="right"><?  require("members/details-fav-buttons-inc.php"); ?></td>
            </tr>
          </table>
        	
          	<br>
			<? require("members/search-candidate-details-inc.php"); ?>
  	   </div>
        
    <div style="clear:both"></div>
        
    <? require("bootstrap_v1/incld/footer_inc.php"); ?>
        
    </div>
    
</div>
<?
require("bootstrap_v1/incld/page_end_inc.php");


