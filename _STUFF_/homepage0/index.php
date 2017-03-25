<!doctype html>
<html lang="en">
<head>
    <title>Home | DEMO</title>
    <meta name="description" content="">
	<meta name="keywords" content="">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" media="all" href="/css2/style2.css" />
    <link rel="stylesheet" type="text/css" href="/homepage/css2/home.css" media="all">
 
    <link type="text/css" rel="stylesheet" media="all" href="/css2/footer.css" />

<script type="text/javascript">
if (document.images) {
	img1 = new Image();
	img1.src = "/slideshow/slideshow1.jpg";
	img2 = new Image();
	img2.src = "/slideshow/slideshow2.jpg";
	img3 = new Image();
	img3.src = "/slideshow/slideshow3.jpg";
}
</script>
</head>
<body >


<div id="home">


	<script type="text/javascript" src="/js2/jquery.min.js"></script>
    <script type="text/javascript" src="/js2/jquery.cycle.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() 
    {
        $('.slideshow').cycle({
            width: '100%',
            fx: 'fade',
            fit: '1',
            slideResize: '1',
             prev:   '#prevButton', 
            next:   '#nextButton', 
        });
    });
    
    document.body.onresize = function (){
        $('.slideshow').cycle({
            width: '100%'
        })
    }
    </script>
   
   <style>
   	#slideshow{ width:50% !important}
    </style> 
    
    <div id="slide-show-wrap"   align="center" >
        <div class="slideshow"  style="width:75% !important;">
                <img src="/slideshow/slideshow1.jpg" style="width:100% !important" />
                <img src="/slideshow/slideshow2.jpg" style="width:100% !important" />
                <img src="/slideshow/slideshow3.jpg" style="width:100% !important" />
        </div>
    </div>
    
  <div id="header-logo" align="center">
    <img src="/homepage0/search-form-place-holder.jpg" width="347" height="198" alt="Search">
   	  <? //require("../homepage - Copy/get-hired-search-box-inc.php"); ?>
    </div>

<? /*
	<div id="header">
		<? require("../bootstrap_v1/incld/top-banner-inc.php"); ?>
    </div>
 */ ?>
      
    <div class="clear"></div>

	<? require("../homepage - Copy/footer-inc.php"); ?>

</div>
        
<div class="clear"></div>
    

</body>
</html>


