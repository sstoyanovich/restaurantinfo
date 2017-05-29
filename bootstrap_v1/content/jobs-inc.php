<?
$query = "SELECT
                *
            FROM 
                jobs 
            WHERE 
                jobs.expired=0";

$result = mysql_query($query) or die(mysql_error());
?>
<pre>
<?  var_dump($result);
?>   
</pre>
<?
    while ($rs = mysql_fetch_object($result)) {
?>
<pre>
<?
        var_dump($rs);
?>
</pre>
<?
  }
?>
<?    
    mysql_free_result($result)
?>
