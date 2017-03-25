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
    
    <div class="row">
    
        <div class="info_page_content">
        
        <img src="/images/headers/register.jpg" width="92" height="27" alt="Support" />
<br /><br />
			<? require("members/register_form_inc.php"); ?>
        </div>

    <div style="clear:both"></div>
        
    <? require("bootstrap_v1/incld/footer_inc.php"); ?>
        
    </div>
    
</div>
<?
require("bootstrap_v1/incld/page_end_inc.php");
