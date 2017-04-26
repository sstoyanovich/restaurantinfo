<?
session_start();
$use_CDN = 1;
$this_page = "home";

require("bootstrap_v1/incld/config.php");
require("bootstrap_v1/incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("bootstrap_v1/incld/page_start_inc.php");
?>

<div id="home">

    <? require("bootstrap_v1/incld/top-banner-inc2.php"); ?>
    <? require("members/search-form-inc.php"); ?>
    <? require("bootstrap_v1/incld/footer_inc.php"); ?>

</div>

<?
require("bootstrap_v1/incld/page_end_inc.php");
