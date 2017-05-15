<!DOCTYPE html>
<html>
<body>
<?
require("bootstrap_v1/incld/db.php");
  $query3 = "SELECT * FROM resumes WHERE member_id=23";
  if ($debug_msgs) echo $query3 . "<br />";
  $result3 = mysql_query($query3) or die(mysql_error());
  while ($rs3 = mysql_fetch_object($result3))
  {
    echo stripslashes($rs3->resume_path);
    echo "<br>";
  }
?>
</body>
</html>
