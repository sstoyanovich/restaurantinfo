<?
session_start();

$use_CDN = 1;
$num_product_columns = 3;
$show_featured = 1;
$this_page = "profile";
				
require("bootstrap_v1/incld/config.php");
require("bootstrap_v1/incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("bootstrap_v1/incld/page_start_inc.php");
require("bootstrap_v1/incld/top-banner-inc2.php");
?>
<div class="container marketing">
<?
    if ($profile_employer_member_id)
    {
        $query3 = "SELECT profile_folder,company_logo FROM members WHERE member_id=" . $profile_employer_member_id;
        $result3 = mysql_query($query3) or die(mysql_error());
        $rs3 = mysql_fetch_object($result3);
        $profile_folder = stripslashes($rs3->profile_folder);
        $company_logo = stripslashes($rs3->company_logo);
        @mysql_free_result($result3);
		if ($company_logo) 
		{
?>
			<div class="row">
                <div class="content_column" style="width:100% !important">
	  				<table border="1" bordercolor="#dddddd" style="border-color:#CCC; border-collapse:collapse; box-shadow: 5px 5px 5px #888888; margin-bottom:7px; width:99% !important; " cellspacing="0" cellpadding="3">
                      <tr>
                        <td align="left"><img src="/company_logos/<?=$company_logo?>" height="75" /></td>
                      </tr>
                    </table>
                </div>
                <div style="clear:both"></div>
			</div>
<? 
		} 
    }
?>    
    <div class="row">
        <div class="left_column"> 
          <table border="1" bordercolor="#dddddd" style="border-color:#CCC; border-collapse:collapse; box-shadow: 5px 5px 5px #888888; margin-bottom:7px; width:99% !important; " cellspacing="0" cellpadding="3">
            <tr>
              <td align="left"><? require("members/profile-job-list-inc.php"); ?></td>
            </tr>
          </table>
        </div>
        <div class="content_column">
            	<table width="50%" border="0" cellspacing="0" cellpadding="12">
                <tr>
                  <td align="left" valign="top"><? 
                                  if ($_GET["job_id"])
                                      require("members/search-details-inc.php"); 
                                  else
                                      echo "Click any job to view here.";
                              ?></td>
                </tr>
              </table>
        </div>
    	<div style="clear:both"></div>
    </div>
    
    <div class="row">
    	<? require("bootstrap_v1/incld/footer_inc.php"); ?>
    </div>

</div>
<?
require("bootstrap_v1/incld/page_end_inc.php");

