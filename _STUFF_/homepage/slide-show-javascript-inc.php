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
