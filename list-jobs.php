<?
session_start();

$in_dashboard = 1;
$this_page = "jobs";

require("bootstrap_v1/incld/config.php");
require("incld/isloggedin.php");
require("incld/isadmin.php");
require("bootstrap_v1/incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("bootstrap_v1/incld/page_start_inc.php");
require("bootstrap_v1/incld/top-banner-inc2.php");

?>
<div class="container marketing">
    
    <div class="row">
    
        <div class="info_page_content" style="width:97% !important">
    <? 
		if ($_SESSION["member_id"] == 1 && $_SESSION["logged_in"] == "logged_in")
		{
			$is_admin_user = "743812947309";
			require("members/my-jobs-employer-inc.php"); 
		}
	?>
        </div>

    <div style="clear:both"></div>
        
    <? require("bootstrap_v1/incld/footer_inc.php"); ?>
        
    </div>
    
</div>
<?
require("bootstrap_v1/incld/page_end_inc.php");

