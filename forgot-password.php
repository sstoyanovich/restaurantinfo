<?
session_start();

$use_CDN = 1;
$this_page = "forgot-password";

require("bootstrap_v1/incld/config.php");
require("bootstrap_v1/incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("bootstrap_v1/incld/page_start_inc.php");
require("bootstrap_v1/incld/top-banner-inc2.php");

?>
<div class="container marketing">
    
    <div class="row">
    
        <div class="info_page_content">
			<? require("bootstrap_v1/content/forgot-password-inc.php"); ?>
        </div>

    <div style="clear:both"></div>
        
    <? require("bootstrap_v1/incld/footer_inc.php"); ?>
        
    </div>
    
</div>
<?
require("bootstrap_v1/incld/page_end_inc.php");

