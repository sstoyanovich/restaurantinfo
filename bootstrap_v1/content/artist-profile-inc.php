<? if (!$_GET["clrstid"]) { ?>
    <table width="200" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" height="25" valign="middle" style="background-image:url(/images/headers/artist-profile-top-header-200.jpg); background-repeat:no-repeat; color:#fff"> &nbsp; ARTISAN'S PROFILE</td>
    </tr>
    </table><table width="200" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#888; background-color:#fbfbf9; box-shadow: 2px 2px 2px #dddddd;  margin-bottom:7px;">
      <tr>
        <td align="left"><div style="width:200px; overflow:hidden"><div style="margin:5px;">
        
        <span style="color:#333; font-size:20px; font-family: 'Poiret One', cursive;"><?=$company_name?></span>
    	<br />
    
    <?
    if ($show_profile)
    {	
    ?>
        <? if ($profile_photo)
        {
            ?><br /><img src="/logos/<?=$profile_photo?>" width="175" border="0"><?
        }
        ?>
        <br />
        
        <strong><? if ($show_first_name_on_site && $first_name) echo $first_name; ?> <? if ($show_last_name_on_site && $last_name) echo $last_name; ?></strong> 
        <br />
        <br />
        
        <? if ($profile_bio) echo nl2br($profile_bio) . "<br /><br />"; ?> 
        
        <img src="/images/headers/contact-this-artist2.jpg" width="150" height="27" style="margin-bottom:7px;" />
    
        <? if ($show_phone_number_on_site && $phone_number) echo  "<br>Phone: " . $phone_number; ?>
        <? if ($show_email_on_site && $email) { ?><br>Email: <a href="mailto:<?=$email?>" target="_blank"><?=$email?></a><? } ?>
        <? if ($show_business_website_on_site && $phone_number) { ?><br>Web: <a href="<?=$business_website?>" target="_blank"><?=$business_website?></a><? } ?>
    <?
    }
    ?>
    
    <br /><br />
    
    <? if ($_GET["contact_sent"]) { ?>
    
        <strong>Your inquiry has been emailed to the artist</strong>.<br />
    <? } else { ?>
        <form action="/send-message-to-user.php" method="POST">
            <strong>Ask this artist a question</strong>:<br /><br />
            <input type="hidden" name="token"      value="<?=$_SESSION["token"]?>">
            <input type="hidden" name="sid" 	   value="<? echo session_id(); ?>">
            <input type="hidden" name="self"       value="<?=$_SERVER["PHP_SELF"]?>">
            <input type="hidden" name="server"     value="<?=$_SERVER["SERVER_NAME"]?>">
            <input type="hidden" name="ip_address" value="<?=$_SERVER["REMOTE_ADDR"]?>">
            <input type="hidden" name="msid"       value="<?=$members_session_id?>">
            <input type="hidden" name="mkd83"      value="<?=$_SESSION["store_member_id"]?>">
            <input type="hidden" name="fwd"        value="<?=$_SERVER["PHP_SELF"]?>">
            Your Name:<br />
             <input type="text" name="inquirers_name" style="width:175px;"><br />
            Your Email:<br />
             <input type="text" name="inquirers_email" style="width:175px;"><br />
             Your Question:<br />
            <textarea name="inquirers_question" style="width:175px; height:50px;"></textarea><br />
            <input type="submit" name="mailing_list" value="Send">
        </form>
    <? } ?>
    
    </div></div>
        </td>
    </tr>
    </table>
<? } ?>
