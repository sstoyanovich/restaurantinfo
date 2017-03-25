<div class="navbar-wrapper">

	<div class="container">
    	<div class="wide_only">
            <div style="float:left" align="center">
                <? require("logo-tagline-inc.php"); ?>
            </div>
            <div style="float:right" align="center">
                <? require("banner-right-area-inc.php"); ?>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
    
    <div class="container" style="padding:0 !important;">
       <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
            
            <? 
				/***********************************************************
				* Small screen logo (displays on left-hand size of nav bar
				***********************************************************/
			?>
                <div class="small_logo">
                   <a href="/index.php"><img src="/images/layout/mobile-device-logo.jpg" width="153" height="43" alt="Jobs" style="margin-right:20px;" /></a>
                </div>
                
            <? 
				/***********************************************************
				* Small screen Search Form
				***********************************************************/
			?>
                <div class="banner_search_form">
                   <form name="searchform_small" method="get" action="/search.php">
          			<input name="term" id="term" type="text" style="width:100px; margin-bottom:5px; margin-top:5px; border: thin 1px #0099CC; padding:0 !important">
          			<input type="submit" name="Submit" value="Find">
					</form>
                </div>
                                
            <? 
				/***********************************************************
				* Small screen pop-up for drop-down navigation
				***********************************************************/
			?>
                <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" style="padding-right:10px !important; margin-right:0px !important" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                 </div>
                 
            <? 
				/*********************************************************** 
				* Large drop-down navigation
				***********************************************************/
			?>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav" style="font-family: 'Poiret One', cursive; font-size:20px">
						<? require("/home/sstoyanovich/public_html/bootstrap_v1/incld/navigtation-inc.php"); ?>
                    </ul>
                </div>
                
            </div>
        </nav>
	</div>
    
</div>
