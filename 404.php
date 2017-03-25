<?
session_start();

$use_CDN = 1;
$num_product_columns = 3;
$show_featured = 1;
$this_page = "home";
$_SESSION["store_member_id"] = 0;
				
require("bootstrap_v1/incld/config.php");
require("bootstrap_v1/incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("bootstrap_v1/incld/page_start_inc.php");
require("bootstrap_v1/incld/top-banner-inc2.php");
?>
<div class="container marketing">
    
    <div class="row">
        <div class="left_column">
            <? require("bootstrap_v1/incld/left_column.php"); ?>
        </div>
        <div class="content_column">
        	<div align="center">
            <img src="images/layout/oops.png" width="230" height="238" alt="oops" /><br />
    <br />
     <strong>We are sorry, but we cannot seem to find the page you are looking for.</strong> 
     <br /><br />
     <?
     $the_uri = str_replace("/", "", $_SERVER["REQUEST_URI"]);

	$query2 = "SELECT member_id,company_name,store_sub_url FROM members WHERE email_verified_by_user=1 ORDER BY company_name";
	if ($debug_msgs) echo $query2 . "<br>";
	$result2 = mysql_query($query2) or die(mysql_error());
	while ($rs2 = mysql_fetch_object($result2))
	{
		$member_id = stripslashes($rs2->member_id);
		$company_name = stripslashes($rs2->company_name);
		$store_sub_url = stripslashes($rs2->store_sub_url);
		
		$store_sub_url_less_dash = str_replace("-", "", $store_sub_url);
		
		if ($the_uri == $store_sub_url_less_dash)
		{
			?>
            	Were you looking for: <strong style="color:#900"><?=$company_name?></strong> ? If so, <a href="/<?=$store_sub_url?>" style="text-decoration:underline">click here</a>
            <?
		}
	}
	@mysql_free_result($result2);

?>
 
 </div>
        </div>
        <div class="right_column">
            <? require("right_column.php"); ?>
        </div>
    	<div style="clear:both"></div>
    </div>
    
    <div class="row">
    	<? require("bootstrap_v1/incld/footer_inc.php"); ?>
    </div>

</div>
<?
require("bootstrap_v1/incld/page_end_inc.php");

