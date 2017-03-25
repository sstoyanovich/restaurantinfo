<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="p:domain_verify" content="711378967addf14bde3c691a30ec3dd5"/>
     
    <title>Job Site</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="icon" href="/favicon.ico">

    <link rel="stylesheet" type="text/css" href="/homepage/css2/home.css" media="all">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
	<link href="/bootstrap_v1/css/custom.css" rel="stylesheet">
    <link href="/bootstrap_v1/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="/bootstrap_v1/css/style.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" media="all" href="/css2/style2.css" />
    <? /*
    <link href="/bootstrap_v1/css/custom-home.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" media="all" href="/css2/footer.css" />
*/ ?>
    <style>
   	   #slideshow{ width:50% !important}
    </style> 

	<? require("slide-show-javascript-inc.php"); ?>
</head>
<body >


<div id="home">


     <div id="header-wrap">
		<div id="header-inner-wrap" style="width:95% !important">
            <? require("../bootstrap_v1/incld/top-banner-inc2.php"); ?>
        </div>
    </div>
   
    <div id="slide-show-wrap"   align="center" style="width:92% !important; margin:auto; margin-top:40px;" >
        <div class="slideshow"  style="width:75% !important; height:500px !important">
                <img src="/slideshow/slideshow1.jpg" style="width:100% !important" />
                <img src="/slideshow/slideshow2.jpg" style="width:100% !important" />
                <img src="/slideshow/slideshow3.jpg" style="width:100% !important" />
        </div>
    </div>

<style>
#home #home-search-box {
  	position: absolute;
	top: 10%;
  	left: 0;
  	right: 0;
    margin:0 auto;
	display: block;
	width: 500px;
	height:250px !important;
	z-index: 25;
    background: linear-gradient(to top, rgba(0,192,65,.7), rgba(0,40,216,.7)); 
	box-shadow:5px 5px 5px #333;
	border:1px solid #000;
}

</style>    
  <div id="home-search-box" align="center">
    <img src="search-form-place-holder.jpg" width="347" height="198" alt="Search" style="padding-top:50px">
   	  <? //require("get-hired-search-box-inc.php"); ?>
    </div>

      
    <div class="clear"></div>

    <? require("../bootstrap_v1/incld/footer_inc.php"); ?>

</div>
        
<div class="clear"></div>
    

</body>
</html>


