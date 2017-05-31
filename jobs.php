<?
session_start();

$use_CDN = 1;
$this_page = "jobs";

require("bootstrap_v1/incld/config.php");
require("bootstrap_v1/incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("bootstrap_v1/incld/page_start_inc.php");
require("bootstrap_v1/incld/top-banner-inc2.php");

?>
<div class="container marketing">
    <h1><strong>Jobs</strong></h1>
    <h2>Search Results</h2>
    <? require("bootstrap_v1/content/jobs-inc.php"); ?>
            
</div>

<div style="clear:both"></div>
        
<? require("bootstrap_v1/incld/footer_inc.php");
require("bootstrap_v1/incld/page_end_inc.php");
