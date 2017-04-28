<?
session_start();
$use_CDN = 1;
$this_page = "home";
//ini_set('error_reporting', E_ALL);
//error_reporting(E_ALL);

require("bootstrap_v1/incld/config.php");
require("bootstrap_v1/incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("bootstrap_v1/incld/page_start_inc.php");
?>
<div id="home">
    <? require("bootstrap_v1/incld/top-banner-inc2.php"); ?>
    <? //require("members/search-form-new.php"); ?>
    <? require("bootstrap_v1/incld/footer_inc.php"); ?>
</div><!--/ .home-->
<div style="width: 100%; height: 1450px; background: transparent url(/images/overlay/home-page.png) no-repeat 50% 0; opacity: .3; position: absolute; top: 0; left: 0; z-index: 100000000; display: none;"></div>
<?
require("bootstrap_v1/incld/page_end_inc.php");
