
<? if ($_SESSION["logged_in"]) 
{ 
	//*************************************************************
	// Navigation for Logged in Members and Admin
	//*************************************************************
?>
    <? if ($_SESSION["member_id"] == 1) { ?>
      <li><a href="/members.php" class="<? if ($this_page == "dashboard") echo "active"; ?>">members</a> </li>
      <li><a href="/list-jobs.php" class="<? if ($this_page == "jobs") echo "active"; ?>">jobs</a> </li>
      <li><a href="/banner-ads.php" class="<? if ($this_page == "banner-ads") echo "active"; ?>">banner ads</a> </li>
    <? } ?>

 	<? if ($_SESSION["member_id"] != 1) { ?>
        
          <li><a href="/my-jobs.php?showset=init" class="<? if ($this_page == "jobs") echo "active"; ?>">my jobs</a> </li>
    
        <? if ($_SESSION["member_type"] == 'E') { ?>
            <li><a href="/search-candidates.php" class="<? if ($this_page == "search") echo "active"; ?>">search candidates</a> </li>
        <? } else { ?>
            <li><a href="/search.php" class="<? if ($this_page == "search") echo "active"; ?>">search jobs</a> </li>
        <? } ?>
          
          
          <li><a href="/my-profile.php" class="<? if ($this_page == "products") echo "active"; ?>">profile</a> </li>
          <li><a href="/my-contact-info.php" class="<? if ($this_page == "contact-info") echo "active"; ?>">contact info</a> </li>
          
 	<? } ?>
 
      <li><a href="/change-password.php"    class="<? if ($this_page == "logout") echo "active"; ?>">password</a> </li>
      <li><a href="/logout.php"    class="<? if ($this_page == "logout") echo "active"; ?>">logout</a> </li>
  
<? } else { 

	//*************************************************************
	// Navigation for NON-Logged in Visitors
	//*************************************************************
?>
      <li><a href="/index.php" class="<? if ($this_page == "index") echo "active"; ?>">home</a> </li>
      <li><a href="/search.php" class="<? if ($this_page == "search") echo "active"; ?>">search jobs</a> </li>
      <li><a href="/contact.php" class="<? if ($this_page == "contact") echo "active"; ?>">contact</a> </li>
      <li><a href="/support.php" class="<? if ($this_page == "support") echo "active"; ?>">support</a> </li>
      <li><a href="/privacy.php" class="<? if ($this_page == "privacy") echo "active"; ?>">privacy</a> </li>
      <li><a href="/login.php"  class="<? if ($this_page == "login")   echo "active"; ?>">login</a> </li> 
      <li><a href="/register.php" class="<? if ($this_page == "signup")  echo "active"; ?>">signup</a>
  
  <? } ?>

<?
/*
      <li><a href="/my-settings.php" class="<? if ($this_page == "products") echo "active"; ?>">settings</a> </li>

*/
?>