<script>
function check_email_entered() {
	var email_entered = document.getElementById("save_fav_email").value;
	
    if (email_entered) {
		return true;
    } else {
		return false;
    }
}
</script>

<div id="sign_in_to_save_fav">
    <p>To view previous favorites or save new favorites, enter your email address below:</p>

    <form action="/members/save_fav_email.php" method="post" name="save_fav">
      <input type="hidden" id="sid" name="sid" value="<?=session_id(); ?>" />
      <input type="hidden" id="token" name="token" value="<?=$token?>" />
      <input type="hidden" id="search_type" name="search_type" value="<?=$search_type?>" />
      <input type="hidden" id="search_terms" name="search_terms" value="<?=$search_terms?>" />
      <input type="hidden" id="state" name="state" value="<?=$state?>" />
      <input type="hidden" id="category" name="category" value="<?=$category?>" />
      <input type="hidden" id="job_title_id" name="job_title_id" value="<?=$job_title_id?>" />
      <input type="hidden" id="job_title" name="job_title" value="<?=$job_title?>" />
      <input type="hidden" id="hourly_rate" name="hourly_rate" value="<?=$hourly_rate?>" />
      <input type="hidden" id="salary_min" name="salary_min" value="<?=$salary_min?>" />
      <input type="hidden" id="salary_max" name="salary_max" value="<?=$salary_max?>" />
      <input type="hidden" id="years_min" name="years_min" value="<?=$years_min?>" />
      <input type="hidden" id="years_max" name="years_max" value="<?=$years_max?>" />
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="33%" align="right" valign="top">Email:&nbsp;</td>
        <td width="67%" align="left" valign="top"><input id="fav_email" type="text" name="fav_email" size="40" maxlength="255" onfocus="this.select();"></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left"><input type="submit" name="submit" value="View / Save Favorites" onClick="return check_email_entered();"></td>
      </tr>
    </table>  
 </form>
</div><!--/ #sign_in_to_save_fav-->
