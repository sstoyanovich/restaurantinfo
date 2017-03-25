<?
session_start();
$use_CDN = 1;
$this_page = "home";

require("bootstrap_v1/incld/config.php");
require("bootstrap_v1/incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("bootstrap_v1/incld/page_start_inc.php");
require("bootstrap_v1/incld/slide_show_inc.php"); 
?>

<div id="home">

   <div id="header-wrap">
      <div id="header-inner-wrap" style="width:95% !important">
		<? require("bootstrap_v1/incld/top-banner-inc2.php"); ?>
      </div>
    </div>
   
   	<? require("bootstrap_v1/incld/slide_show_inc2.php"); ?>

   	<? require("bootstrap_v1/incld/home_search_box_inc.php"); ?>

    <div class="clear"></div>

    <? require("bootstrap_v1/incld/footer_inc.php"); ?>

</div>
        
<div class="clear"></div>
    
<?
require("bootstrap_v1/incld/page_end_inc.php");

