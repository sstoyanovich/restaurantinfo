<?
session_start();

$use_CDN = 1;
$this_page = "search";

require("bootstrap_v1/incld/config.php");
require("bootstrap_v1/incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("bootstrap_v1/incld/page_start_inc.php");
require("bootstrap_v1/incld/top-banner-inc2.php");
//var_dump($_GET);
if ($_GET) {
?>

<div class="container marketing">
    <h1><strong>Lookup</strong></h1>
    <h2>Search Results</h2>

    <? require("bootstrap_v1/content/jobs-inc.php"); ?>

</div><!--/ .contain.marketing-->
<div style="clear:both"></div>
<?  }  ?>

<!--div class="container marketing">
    <?  require("members/job-id-helper-update-inc.php");
        require("members/search-results-inc.php");
        
        if ($_SESSION["fav_email"]):
    ?>
        <em style="color:#00c">Your favorites are saved with email address: <?=$_SESSION["fav_email"]?></em><br />
    <?
        else:
            require("members/save-fav-email-form-inc.php");
        endif;
    ?>
</div--><!--/ .container.marketing-->
<!--div style="clear:both"></div-->

    <? require("bootstrap_v1/incld/footer_inc.php"); ?>
    <? require("bootstrap_v1/incld/page_end_inc.php");
