<?
session_start();

$use_CDN = 1;
$num_product_columns = 3;
$show_featured = 1;
$this_page = "home";
				
require("bootstrap_v1/incld/config.php");
require("bootstrap_v1/incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("bootstrap_v1/incld/page_start_inc.php");
?>
<style>
.hover-search-box 
{
	position:
	position: absolute;
	top: 30%;
	left: 0;
	right: 0;
	margin:0 auto;
	display: block;
	width: 650px;
	height:250px !important;
	z-index: 25;
	background: linear-gradient(to top, rgba(255,0,0,.7), rgba(0,40,216,.7));
	box-shadow:5px 5px 5px #333;
	border:1px solid #000;
}

</style>

<div id="home">

    <div class="container marketing">

		<? require("bootstrap_v1/incld/top-banner-inc.php"); ?>
    
        <div class="row">
        
			<? require("slideshow-inc.php"); ?>
        </div>

        <div class="hover-search-box" align="center">
        	<img src="/homepage/search-form-place-holder.jpg" width="347" height="198" alt="Search">
        </div>
        
        <div class="row">
            <? require("bootstrap_v1/incld/footer_inc.php"); ?>
        </div>

    </div>
</div>

<?
require("bootstrap_v1/incld/page_end_inc.php");

