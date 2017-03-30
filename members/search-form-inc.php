<?
if ($_GET["restore_search"] == 1)
{
	 $page 			= $_SESSION["page"];
	 $sort 			= $_SESSION["sort"];
	 $rev 			= $_SESSION["rev"];
	 $token 		= $_SESSION["token"];
	 $sid 			= $_SESSION["sid"];
	 $search_type 	= $_SESSION["search_type"];	// 'a' = advanced, 's' = simple
	 $search_terms 	= $_SESSION["search_terms"];
	 $state 		= $_SESSION["state"];
	 $category 		= $_SESSION["category"];
	 $job_title_id 	= $_SESSION["job_title_id"];
	 $job_title 	= $_SESSION["job_title"];
	 $hourly_rate 	= $_SESSION["hourly_rate"];
	 $salary_min 	= $_SESSION["salary_min"];
	 $salary_max 	= $_SESSION["salary_max"];
	 $years_min 	= $_SESSION["years_min"];
	 $years_max 	= $_SESSION["years_max"];
}
else if ($_GET["new_search"] == 1)
{
	$_SESSION["page"] 			= $page 			= '';
	$_SESSION["sort"] 			= $sort 			= '';
	$_SESSION["rev"] 			= $rev 				= '';
	$_SESSION["token"] 			= $token 			= '';
	$_SESSION["sid"] 			= $sid 				= '';
	$_SESSION["search_type"] 	= $search_type 		= '';
	$_SESSION["search_terms"] 	= $search_terms 	= '';
	$_SESSION["state"] 			= $state 			= '';
	$_SESSION["category"] 		= $category 		= '';
	$_SESSION["job_title_id"] 	= $job_title_id 	= '';
	$_SESSION["job_title"] 		= $job_title 		= '';
	$_SESSION["hourly_rate"] 	= $hourly_rate 		= '';
	$_SESSION["salary_min"] 	= $salary_min 		= '';
	$_SESSION["salary_max"] 	= $salary_max 		= '';
	$_SESSION["years_min"] 		= $years_min 		= '';
	$_SESSION["years_max"] 		= $years_max 		= '';
}
else // Search has been submitted from search form, so save parms.
{
	$_SESSION["page"] 			= $page 			= clean_post_var($_GET["page"]);
	$_SESSION["sort"] 			= $sort 			= clean_post_var($_GET["sort"]);
	$_SESSION["rev"] 			= $rev 				= clean_post_var($_GET["rev"]);
	$_SESSION["token"] 			= $token 			= clean_post_var($_GET["token"]);
	$_SESSION["sid"] 			= $sid 				= clean_post_var($_GET["sid"]);
	$_SESSION["search_type"] 	= $search_type 		= clean_post_var($_GET["search_type"]);	// 'a' = advanced, 's' = simple
	$_SESSION["search_terms"] 	= $search_terms 	= clean_post_var($_GET["search_terms"]);
	$_SESSION["state"] 			= $state 			= clean_post_var($_GET["state"]);
	$_SESSION["category"] 		= $category 		= clean_post_var($_GET["category"]);
	$_SESSION["job_title_id"] 	= $job_title_id 	= clean_post_var($_GET["job_title_id"]);
	$_SESSION["job_title"] 		= $job_title 		= clean_post_var($_GET["job_title"]);
	$_SESSION["hourly_rate"] 	= $hourly_rate 		= clean_post_var($_GET["hourly_rate"]);
	$_SESSION["salary_min"] 	= $salary_min 		= clean_post_var($_GET["salary_min"]);
	$_SESSION["salary_max"] 	= $salary_max 		= clean_post_var($_GET["salary_max"]);
	$_SESSION["years_min"] 		= $years_min 		= clean_post_var($_GET["years_min"]);
	$_SESSION["years_max"] 		= $years_max 		= clean_post_var($_GET["years_max"]);
}

if (!$search_type) $search_type = 's';

if (!$_SESSION["token"])
    $_SESSION["token"] = sha1(uniqid(rand(), TRUE));

if ($debug_msgs)
{
	echo "token = $token<br />";
	echo "session token = " . $_SESSION["token"] . "<br />";
	echo "sid = $sid<br />";
	echo "session sid = " . session_id() . "<br />";
	echo "page = $page<br />";
	echo "sort = $sort<br />";
	echo "rev = $rev<br />";
	echo "search_type = $search_type<br />";
	echo "search_terms = $search_terms<br />";
	echo "state = $state<br />";
	echo "category = $category<br />";
	echo "job_title_id = $job_title_id<br />";
	echo "job_title = $job_title<br />";
	echo "hourly_rate = $hourly_rate<br />";
	echo "salary_min = $salary_min<br />";
	echo "salary_max = $salary_max<br />";
	echo "years_min = $years_min<br />";
	echo "years_max = $years_max<br />";
	echo "fav_email = $fav_email<br />";
}

?>
<script type="text/javascript" src="/js/hide_node.js"></script>

<script type="text/javascript">
function change_search_type(which)
{
	if (which == 'a')
	{
 		showNode("form_category");
 		showNode("form_sallary");
	}
	else
	{
 		hideNode("form_category");
 		hideNode("form_sallary");
	}
}
</script>

<table width="350" border="<? if ($this_page == "home") echo '1'; else echo '0'; ?>" style="background-color:#fff; box-shadow:5px 5px 5px #333; border-collapse:collapse;">
    <tr>
      <td>

    <form action="search.php" method="get"  name="search">
    <input type="hidden" name="member_id" value="<? echo $_SESSION["member_id"]; ?>" />
    <input type="hidden" name="token"     value="<? echo $_SESSION["token"]; ?>" />
    <input type="hidden" name="sid"       value="<? echo session_id(); ?>">
<? if ($this_page == "home") { ?>
    <input type="hidden" name="search_type" value="s">
<? } ?>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="ffffff" style="background-color:#fff;">
  <tr>
    <td colspan="2" height="15"></td>
  </tr>
<? if ($this_page != "home") { ?>
  <tr>
    <td width="30%" align="right" >Search Type&nbsp; </td>
    <td width="70%" align="left">
            <input name="search_type" type="radio" value="s" <? if ($search_type != 'a') echo "checked"; ?> onclick="return change_search_type('s');" /> Simple
            <input name="search_type" type="radio" value="a" <? if ($search_type == 'a') echo "checked"; ?> onclick="return change_search_type('a');" /> Advanced
    </td>
  </tr>
  <tr>
    <td colspan="2" height="15"></td>
  </tr>
<? } ?>
  <tr>
    <td width="30%" align="right" >Keywords&nbsp; </td>
    <td width="70%" align="left"><input name="search_terms" id="search_terms" type="text" value="<?=$search_terms?>" style="width:200px;"></td>
  </tr>
  <tr>
    <td colspan="2" height="15"></td>
  </tr>

  </table>
<span id="form_category" style="display:<? if ($search_type == 'a') echo 'block'; else echo "none"; ?>">
<?
    <table width="400" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="30%" align="right" >Job Category&nbsp; </td>
      <td width="70%" align="left"><select name="category" id="category" style="width:220px;">
                    <option value="0"  selected >All Categories</option>
                    <?
                        $query2 = "SELECT * FROM categories ORDER BY category_name";
                        $result2 = mysql_query($query2) or die(mysql_error());
                        while ($rs2 = mysql_fetch_object($result2))
                        { ?>
                            <option value="<?=$rs2->category_id?>"  <? if ($category == $rs2->category_id) echo "selected"; ?>><? echo stripslashes($rs2->category_name); ?></option>
                    <? }
                        @mysql_free_result($result2);
                    ?>
                    <option value="99" <? if ($category == 99) echo "selected"; ?>>Other</option>
              </select></td>
    </tr>
      <tr>
      <td colspan="2" height="7"></td>
    </tr>
    </table>
 ?>
</span>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30%" align="right" ><sup>*</sup>Job Title&nbsp; </td>
    <td width="70%" align="left"><select name="job_title_id" id="job_title_id"  style="width:200px;">
    					<option  value="0">Select</option>
                        <?
                            $query2 = "SELECT * FROM job_titles ORDER BY job_title";
                            $result2 = mysql_query($query2) or die(mysql_error());
                            while ($rs2 = mysql_fetch_object($result2))
                            { ?>
                                <option value="<?=$rs2->job_title_id?>"  <? if ($job_title_id == $rs2->job_title_id) echo "selected"; ?>><? echo stripslashes($rs2->job_title); ?></option>
                        <? }
                            @mysql_free_result($result2);
                        ?>
                    	<option value="99" <? if ($category == 99) echo "selected"; ?>>Other</option>
						</select>
            </td>
  </tr>
  <tr>
    <td height="22" align="right"> <sup>*</sup>Job Title&nbsp; </td>
    <td  align="left"><input type="text" name="job_title" size="40" maxlength="255" style="width:200px" value="<?=$job_title?>"  onfocus="this.select();"></td>
  </tr>
  <tr>
    <td  height="29"></td>
    <td align="left"><sup>*</sup><em style="color:#999">Select and/or enter the job title above.</em></td>
  </tr>
    </table>

<span id="form_sallary" style="display:<? if ($search_type == 'a') echo 'block'; else echo "none"; ?>">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30%" align="right">State&nbsp; </td>
    <td width="70%" align="left">
    <select name="state" id="state" style="width:150px;">
      <option selected="selected" value="">All</option>
        <option value='AL' <? if ($state == 'AL') echo "selected"; ?>>Alabama</option>
        <option value='AK' <? if ($state == 'AK') echo "selected"; ?>>Alaska</option>
        <option value='AZ' <? if ($state == 'AZ') echo "selected"; ?>>Arizona</option>
        <option value='AR' <? if ($state == 'AR') echo "selected"; ?>>Arkansas</option>
        <option value='CA' <? if ($state == 'CA') echo "selected"; ?>>California</option>
        <option value='CO' <? if ($state == 'CO') echo "selected"; ?>>Colorado</option>
        <option value='CT' <? if ($state == 'CT') echo "selected"; ?>>Connecticut</option>
        <option value='DE' <? if ($state == 'DE') echo "selected"; ?>>Delaware</option>
        <option value='DC' <? if ($state == 'DC') echo "selected"; ?>>District Of Columbia</option>
        <option value='FL' <? if ($state == 'FL') echo "selected"; ?>>Florida</option>
        <option value='GA' <? if ($state == 'GA') echo "selected"; ?>>Georgia</option>
        <option value='HI' <? if ($state == 'HI') echo "selected"; ?>>Hawaii</option>
        <option value='ID' <? if ($state == 'ID') echo "selected"; ?>>Idaho</option>
        <option value='IL' <? if ($state == 'IL') echo "selected"; ?>>Illinois</option>
        <option value='IN' <? if ($state == 'IN') echo "selected"; ?>>Indiana</option>
        <option value='IA' <? if ($state == 'IA') echo "selected"; ?>>Iowa</option>
        <option value='KS' <? if ($state == 'KS') echo "selected"; ?>>Kansas</option>
        <option value='KY' <? if ($state == 'KY') echo "selected"; ?>>Kentucky</option>
        <option value='LA' <? if ($state == 'LA') echo "selected"; ?>>Louisiana</option>
        <option value='ME' <? if ($state == 'ME') echo "selected"; ?>>Maine</option>
        <option value='MD' <? if ($state == 'MD') echo "selected"; ?>>Maryland</option>
        <option value='MA' <? if ($state == 'MA') echo "selected"; ?>>Massachusetts</option>
        <option value='MI' <? if ($state == 'MI') echo "selected"; ?>>Michigan</option>
        <option value='MN' <? if ($state == 'MN') echo "selected"; ?>>Minnesota</option>
        <option value='MS' <? if ($state == 'MS') echo "selected"; ?>>Mississippi</option>
        <option value='MO' <? if ($state == 'xx') echo "selected"; ?>>Missouri</option>
        <option value='MT' <? if ($state == 'MT') echo "selected"; ?>>Montana</option>
        <option value='NE' <? if ($state == 'NE') echo "selected"; ?>>Nebraska</option>
        <option value='NV' <? if ($state == 'NV') echo "selected"; ?>>Nevada</option>
        <option value='NH' <? if ($state == 'NH') echo "selected"; ?>>New Hampshire</option>
        <option value='NJ' <? if ($state == 'NJ') echo "selected"; ?>>New Jersey</option>
        <option value='NM' <? if ($state == 'NM') echo "selected"; ?>>New Mexico</option>
        <option value='NY' <? if ($state == 'NY') echo "selected"; ?>>New York</option>
        <option value='NC' <? if ($state == 'NC') echo "selected"; ?>>North Carolina</option>
        <option value='ND' <? if ($state == 'ND') echo "selected"; ?>>North Dakota</option>
        <option value='OH' <? if ($state == 'OH') echo "selected"; ?>>Ohio</option>
        <option value='OK' <? if ($state == 'OK') echo "selected"; ?>>Oklahoma</option>
        <option value='OR' <? if ($state == 'OR') echo "selected"; ?>>Oregon</option>
        <option value='PA' <? if ($state == 'PA') echo "selected"; ?>>Pennsylvania</option>
        <option value='PR' <? if ($state == 'PR') echo "selected"; ?> >Puerto Rico</option>
        <option value='RI' <? if ($state == 'RI') echo "selected"; ?>>Rhode Island</option>
        <option value='SC' <? if ($state == 'SC') echo "selected"; ?>>South Carolina</option>
        <option value='SD' <? if ($state == 'SD') echo "selected"; ?>>South Dakota</option>
        <option value='TN' <? if ($state == 'TN') echo "selected"; ?>>Tennessee</option>
        <option value='TX' <? if ($state == 'TX') echo "selected"; ?>>Texas</option>
        <option value='UT' <? if ($state == 'UT') echo "selected"; ?>>Utah</option>
        <option value='VT' <? if ($state == 'VT') echo "selected"; ?>>Vermont</option>
        <option value='VA' <? if ($state == 'VA') echo "selected"; ?>>Virginia</option>
        <option value='WA' <? if ($state == 'WA') echo "selected"; ?>>Washington</option>
        <option value='WV' <? if ($state == 'WV') echo "selected"; ?>>West Virginia</option>
        <option value='WI' <? if ($state == 'WI') echo "selected"; ?>>Wisconsin</option>
        <option value='WY' <? if ($state == 'WY') echo "selected"; ?>>Wyoming</option>
    </select>
    </td>
  </tr>
  <tr>
    <td colspan="2" height="12"></td>
  </tr>
  <tr>
    <td align="right" >Hourly Rate&nbsp; </td>
    <td align="left">$<input name="hourly_rate" id="hourly_rate" type="text" value="<?=$hourly_rate?>" style="width:50px"></td>
  </tr>
  <tr>
    <td colspan="2" height="7"></td>
  </tr>
  <tr>
    <td align="right" >Annual Salary: &nbsp; </td>
    <td align="left">
    <?
		$max_for_sallary_range = 250;
	?>
    $<select name="salary_min" id="salary_min" style="width:70px;">
        <option selected="selected" value="0">Any</option>
        <?
          for ($sallary = 10; $sallary <= $max_for_sallary_range; $sallary += 10)
          {
              ?><option value="<?=$sallary?>" <? if ($salary_min == $sallary) echo "selected"; ?>><?=$sallary?>K<? if ($sallary == $max_for_sallary_range) echo '+'; ?></option><?
          }
          ?>
        </select>
        to:
        $<select name="salary_max" id="salary_max"  style="width:70px;">
      <option selected="selected" value="0">Any</option>
        <?
          for ($sallary = 10; $sallary <= $max_for_sallary_range; $sallary += 10)
          {
              ?><option value="<?=$sallary?>" <? if ($salary_max == $sallary) echo "selected"; ?>><?=$sallary?>K<? if ($sallary == $max_for_sallary_range) echo '+'; ?></option><?
          }
          ?>
    </select>
    </td>
  </tr>
  <tr>
    <td colspan="2" height="18"></td>
  </tr>
  <tr>
    <td align="right" >Years Experience: &nbsp; </td>
    <?
		$max_for_years_range = 25;
	?>
    <td align="left">&nbsp; <select name="years_min" id="years_min" style="width:70px;" >
      <option selected="selected" value="0">Any</option>
        <?
          for ($years = 1; $years <= $max_for_years_range; $years++)
          {
              ?><option value="<?=$years?>" <? if ($years_min == $years) echo "selected"; ?>><?=$years?><? if ($years == $max_for_years_range) echo '+'; ?></option><?
          }
          ?>
        </select>
    to: &nbsp; <select name="years_max" id="years_max"  style="width:70px;">
      <option selected="selected" value="0">Any</option>
        <?
          for ($years = 1; $years <= $max_for_years_range; $years++)
          {
              ?><option value="<?=$years?>" <? if ($years_max == $years) echo "selected"; ?>><?=$years?><? if ($years == $max_for_years_range) echo '+'; ?></option><?
          }
          ?>
        </select>
    </td>
  </tr>
  <tr>
    <td colspan="2" height="7"></td>
  </tr>
    </table>
</span>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30%" align="left" ></td>
    <td width="70%" align="left" ><input name="submit" type="submit" value="Search"></td>
  </tr>
  <tr>
    <td colspan="2" height="7"></td>
  </tr>
  <tr>
    <td colspan="2" align="left" ></td>
  </tr>
</table>
</form>
      </td>
    </tr>
</table>
