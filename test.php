<!doctype html>
<html lang="en">
<head>
    <title></title>
    <meta name="description" content="">
	<meta name="keywords" content="">
    <meta charset="UTF-8">
        
    <link type="text/css" rel="stylesheet" media="all" href="/css2/style2.css" />
    <link rel="stylesheet" type="text/css" href="/css2/home.css" media="all">
</head>
<body >

<script type="text/javascript">
if (document.images) {
	img1 = new Image();
	img1.src = "/steve/slideshow/slideshow1.jpg";
	img2 = new Image();
	img2.src = "/steve/slideshow/slideshow2.jpg";
	img3 = new Image();
	img3.src = "/steve/slideshow/slideshow3.jpg";
	img4 = new Image();
	img4.src = "/steve/slideshow/slideshow4.jpg";
	img5 = new Image();
	img5.src = "/steve/slideshow/slideshow5.jpg";
}
</script>

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
    
    <div id="slide-show-wrap">
        <div class="slideshow"  style="background-color:#414142 !important;">
                <img src="/steve/slideshow/slideshow4.jpg"  />
                <img src="/steve/slideshow/slideshow1.jpg"  />
                <img src="/steve/slideshow/slideshow5.jpg"  />
                <img src="/steve/slideshow/slideshow2.jpg"  />
                <img src="/steve/slideshow/slideshow3.jpg"  />
        </div>
    </div>
        
</div>
  
<div class="clear"></div>

</body>
</html>

