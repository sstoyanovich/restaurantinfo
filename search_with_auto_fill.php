<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Autocomplete - Default functionality</title>
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
  <script>
	  $(function() 
	  {
            $("#term").autocomplete({
                source: "/bootstrap_v1/incld/get_search_suggestions.php",
                minLength: 1,
            });
	  });
</script>

</head>
<body>
 
<form name="searchform" method="get" action="/search.php">
    <font size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;Enter keyword or item #.</font> 
    <br>&nbsp;&nbsp;<input name="term" id="term" type="text" style="width:175px">
    <br>&nbsp;&nbsp;<input type="submit" name="Submit" value="Go">
  </form>
 
 
</body>
</html>



<?
/*

 <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" />

<script src="../js/jquery.min.js"></script>
<script src="../js/jquery-ui.min.js"></script>

<script type="text/javascript">
$(function() {
            $("#term").autocomplete({
                source: "get_search_suggestions.php",
                minLength: 1,
            });
        });
</script>

    <form action="#"  method="post" id="search_form">
    
      <input type="text" id="term"  name="term" size="60" maxlength="255" />
      
      
    </form>

*/