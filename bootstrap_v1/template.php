<?
session_start();

require("incld/utils.php");
require("incld/db.php");

$use_CDN = 1;

require("incld/page_start_inc.php");
require("incld/navbar_inc.php");
?>
<div class="container marketing">
    
    <div class="row">
    
        <div class="left_column">
            <? require("../left_column.php"); ?>
        </div>
        
        <div class="content_column">
        	<div align="center">
            <? 
				$num_product_columns = 3;
	  			$show_featured = 1;
	  			require("../show-products-inc.php");
			?>
            </div>
        </div>
        
        <div class="right_column">
            <? require("../right_column.php"); ?>
        </div>
      
    </div>
    
    <div style="clear:both"></div>
        
    <? require("bootstrap_v1/incld/footer_inc.php"); ?>
    
</div>
<?
require("bootstrap_v1/incld/page_end_inc.php");

