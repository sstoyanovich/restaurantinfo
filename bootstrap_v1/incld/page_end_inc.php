<? if ($this_page == "home") { ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <script src="http://getbootstrap.com/assets/js/vendor/holder.min.js"></script>
    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript" src="/tablesorter-master/jquery.tablesorter.js"></script> 

    <script type="text/javascript" src="/js2/jquery.cycle2.min.js"></script>
    
    <script type="text/javascript">
		if (document.images) {
			img1 = new Image();
			img1.src = "/slideshow/slideshow1.jpg";
			img2 = new Image();
			img2.src = "/slideshow/slideshow2.jpg";
			img3 = new Image();
			img3.src = "/slideshow/slideshow3.jpg";
		}
		
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
		
	</script>
   
    <script type="text/javascript">
		$(document).ready(function() 
		{
			$("#myTable").tablesorter(); 
			$("#myTable2").tablesorter(); 
		
		});
	</script>

<? } else { ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="http://getbootstrap.com/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <script src="http://getbootstrap.com/assets/js/vendor/holder.min.js"></script>
    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript" src="/tablesorter-master/jquery.tablesorter.js"></script> 

<? } ?>


  </body>
</html>

