<?
if (!$_SESSION["token"])
    $_SESSION["token"] = sha1(uniqid(rand(), TRUE)); 
?>
<table width="175" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="175" height="25" valign="middle" style="background-image:url(/images/headers/header-bar-175.jpg); background-repeat:no-repeat; color:#fff"> &nbsp; SEARCH</td>
</tr>
</table>

<form name="searchform" method="get" action="/search.php">
<input type="hidden" name="sid"       value="<? echo session_id(); ?>">
<input type="hidden" name="token"     value="<? echo $_SESSION["token"]; ?>" />
<input type="hidden" name="search_type"     value="s" />
<table width="175" border="0" cellspacing="0" cellpadding="0"  style="border-collapse:collapse; border-color:#888; background-color:#fbfbf9; box-shadow: 2px 2px 2px #dddddd;  margin-bottom:12px;">
  <tr>
    <td align="left" height="25"><strong>Select Job Type:</strong></td>
</tr>

  <tr>
    <td align="left"><select name="job_title_id" id="job_title_id"  style="width:174px;">
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
						</select> </td>
</tr>

  <tr>
    <td align="left" height="35"><input type="submit" name="Submit" value="Go"></td>
</tr>
</table>
</form>

