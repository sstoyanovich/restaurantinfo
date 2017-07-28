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
    <h2>Search Results <span class="jobs-filter"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="30.6 44.1 551.4 550.8"  width="25" height="25" style="enable-background:new 30.6 44.1 551.4 550.8;" xml:space="preserve">
<g>
	<path d="M555.1,293.2h-53.2c-11-30-39.2-51.4-72.8-51.4c-33.7,0-61.8,21.4-72.8,51.4H56.3c-14.1,0-25.7,11.6-25.7,26.3
		s11.6,26.3,26.3,26.3h299.9c11,30,39.2,51.4,72.8,51.4c33.7,0,61.8-21.4,72.8-51.4h53.2c14.7,0,26.3-11.6,26.3-26.3
		C581.4,304.8,569.8,293.2,555.1,293.2z"/>
	<path d="M555.1,491.5H250.3c-11-30-39.2-51.4-72.8-51.4c-33.7,0-61.8,21.4-72.8,51.4H56.9c-14.7,0-26.3,11.6-26.3,25.7
		c0,14.7,11.6,26.3,26.3,26.3h48.3c10.4,30,38.6,51.4,72.2,51.4c33.7,0,61.8-21.4,72.8-51.4h304.8c14.7,0,26.3-11.6,26.3-26.3
		C581.4,503.1,569.8,491.5,555.1,491.5z"/>
	<path d="M56.9,147.5h176.3c11,30,39.2,51.4,72.8,51.4s61.8-21.4,72.8-51.4h176.3c14.7,0,26.3-11.6,26.3-26.3s-11.6-26.3-26.3-26.3
		H378.8c-11-29.4-39.2-50.8-72.8-50.8s-61.8,21.4-72.8,51.4H56.9c-14.7,0-26.3,11.6-26.3,26.3C30.6,135.9,42.2,147.5,56.9,147.5z"/>
</g>
</svg>&nbsp;&nbsp;Filters</span></h2>

    <? require("bootstrap_v1/content/jobs-inc.php"); ?>
</div><!--/ .contain.marketing-->
<div style="clear:both"></div>
        
<? require("bootstrap_v1/incld/footer_inc.php");
require("bootstrap_v1/incld/page_end_inc.php");
