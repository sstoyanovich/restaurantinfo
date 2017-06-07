<?
session_start();

$use_CDN = 1;
$this_page = "register";

require("bootstrap_v1/incld/config.php");
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

?>
<div class="container marketing">
    <h1><strong>Sign up</strong></h1>
    <? require("members/register_form_inc.php"); ?>
    <div style="clear:both"></div>
</div><!--/ .container.marketing-->
<? require("bootstrap_v1/incld/footer_inc.php"); ?>
<? require("bootstrap_v1/incld/page_end_inc.php");
