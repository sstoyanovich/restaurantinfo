<?
session_start(); 
$this_page = "checkout";
require("incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("page_start_inc.php");
require("page_header_all.php");
	require("main_content_wrapper_start_inc.php");
		require("bootstrap_v1/incld/left_column.php");
	 require("main_content_wrapper_mid_inc.php");
?>
          	<div align="left" style="margin-left:30px;">
        <img src="/images/headers/about.jpg" width="225" height="27" alt="Login to your account" />
          <br>
          <br>
                ABOUT TEXT GOES HERE, <a href="/signup.php">sign up now</a>
</div>
<?
	require("main_content_wrapper_end_inc.php");
require("page_footer.php"); 
require("page_end_inc.php"); 

