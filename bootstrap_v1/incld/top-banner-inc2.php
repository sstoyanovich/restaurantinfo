<div id="header-wrap">
    <div id="header-inner-wrap">
        <div class="navbar-wrapper" >
            <div class="container">
                <?
                /***********************************************************
                * Top bar that shows up for wide viewports, i.e. computer
                ***********************************************************/
                ?>
                <div class="wide_only">
                    <div style="float:left" align="center">
                           <a href="/index.php"><img src="/images/layout/small-logo.jpg" width="200" height="40" alt="Restaurant Info" style="margin-right:20px;" /></a>
                    </div>
                    <div style="float:left; margin-top:7px; margin-left:50px;" align="center">
                       <? require("bootstrap_v1/incld/navigtation-inc.php"); ?>
                    </div>
                </div>

                <?
                /***********************************************************
                * Top bar that shows up for wide viewports, i.e. mobile devices
                ***********************************************************/
                ?>
                <div class="small_only">
                   <nav class="navbar navbar-inverse navbar-static-top">
                        <?
                        /***********************************************************
                        * Small screen logo, displays on left-hand size of nav bar
                        ***********************************************************/
                        ?>
                        <div class="small_logo">
                           <a href="/index.php"><img src="/images/layout/small-logo.jpg" width="200" height="40" alt="Restaurant Info" style="margin-left:20px;" /></a>
                        </div>

                        <?
                        /***********************************************************
                        * Small screen pop-up for drop-down navigation
                        ***********************************************************/
                        ?>
                        <div class="navbar-header" style="background-color:#fff !important; padding-right:10px !important; padding-left:10px !important; ">
                            <button type="button" class="navbar-toggle collapsed" style=" background-color:#555; margin-right:0px !important" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <? require("bootstrap_v1/incld/navigtation-inc.php"); ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
