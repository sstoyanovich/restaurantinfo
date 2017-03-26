
<? if ($_SESSION["logged_in"])
{
	//*************************************************************
	// Navigation for Logged in Members and Admin
	//*************************************************************
?>
    <? if ($_SESSION["member_id"] == 1) { ?>
      <a href="/members.php" class="<? if ($this_page == "dashboard") echo "active"; ?>">members</a>
      <a href="/list-jobs.php" class="<? if ($this_page == "jobs") echo "active"; ?>">jobs</a>
      <a href="/banner-ads.php" class="<? if ($this_page == "banner-ads") echo "active"; ?>">banner ads</a>
    <? } ?>

 	<? if ($_SESSION["member_id"] != 1) { ?>

        <a href="/my-jobs.php?showset=init" class="<? if ($this_page == "jobs") echo "active"; ?>">my jobs</a>

        <? if ($_SESSION["member_type"] == 'E') { ?>
            <a href="/search-candidates.php" class="<? if ($this_page == "search") echo "active"; ?>">search candidates</a>
        <? } else { ?>
             <a href="/search.php" class="<? if ($this_page == "search") echo "active"; ?>">search jobs</a>
        <? } ?>


           <a href="/my-profile.php" class="<? if ($this_page == "products") echo "active"; ?>">profile</a>
           <a href="/my-contact-info.php" class="<? if ($this_page == "contact-info") echo "active"; ?>">contact info</a>

 	<? } ?>

       <a href="/change-password.php"    class="<? if ($this_page == "logout") echo "active"; ?>">password</a>
       <a href="/logout.php"    class="<? if ($this_page == "logout") echo "active"; ?>">logout</a>

<? } else {

	//*************************************************************
	// Navigation for NON-Logged in Visitors
	//*************************************************************
?>
       <a href="/index.php" class="<? if ($this_page == "index") echo "active"; ?>">home</a>
       <a href="/search.php" class="<? if ($this_page == "search") echo "active"; ?>">search jobs</a>
       <a href="/contact.php" class="<? if ($this_page == "contact") echo "active"; ?>">contact</a>
       <a href="/support.php" class="<? if ($this_page == "support") echo "active"; ?>">support</a>
       <a href="/privacy.php" class="<? if ($this_page == "privacy") echo "active"; ?>">privacy</a>
       <a href="/login.php"  class="<? if ($this_page == "login")   echo "active"; ?>">login</a>
       <a href="/register.php" class="<? if ($this_page == "signup")  echo "active"; ?>">signup</a>

  <? } ?>

<?
/*
       <a href="/my-settings.php" class="<? if ($this_page == "products") echo "active"; ?>">settings</a>

*/
?>
