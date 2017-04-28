<? if ($_SESSION["logged_in"]) {
	//*************************************************************
	// Navigation for Logged in Members and Admin (1)
	//*************************************************************
?>
    <? if ($_SESSION["member_id"] == 1) { ?>
    <li><a href="/members.php" class="<? if ($this_page == "dashboard") echo "active"; ?>">members</a></li>
    <li><a href="/list-jobs.php" class="<? if ($this_page == "jobs") echo "active"; ?>">jobs</a></li>
    <li><a href="/banner-ads.php" class="<? if ($this_page == "banner-ads") echo "active"; ?>">banner ads</a></li>
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

       <a href="/change-password.php" class="<? if ($this_page == "logout") echo "active"; ?>">password</a>
       <a href="/logout.php" class="<? if ($this_page == "logout") echo "active"; ?>">logout</a>

<? } else {

	//*************************************************************
	// Navigation for NON-Logged in Visitors
	//*************************************************************
?>
        <li>
            <ul class="profile">
                <li id="nav-signup">
                    <a href="/register.php" class="<? if ($this_page == "signup")  echo "active"; ?>">Sign Up</a>
                </li>
                <li id="nav-login">
                    <a href="/login.php" title="Log In" class="<? if ($this_page == "login") echo "active"; ?>">Login</a>
                </li>
            </ul>
        </li>
        <li>
            <ul class="tools">
                <li id="nav-jobs"><a href="/jobs.php" class="<? if ($this_page == "jobs") echo "active"; ?>">Jobs</a></li>
                <li id="nav-lookup"><a href="/search.php" class="<? if ($this_page == "search") echo "active"; ?>">Lookup</a></li>
                <li id="nav-companies"><a href="/companies.php" class="<? if ($this_page == "companies") echo "active"; ?>">Companies</a></li>
            </ul>
        </li>
<?
    /**
     * =toodoo: create companies page
     */

    } ?>

<?
/*
       <a href="/my-settings.php" class="<? if ($this_page == "products") echo "active"; ?>">settings</a>

*/
?>
