<?
$debug_msgs = 0;
require("/home/eartistf/public_html/bootstrap_v1/incld/db.php");

$return_arr = array();

//$query2 = "SELECT description,category_id FROM products WHERE new_master_product=1 AND description LIKE '%" . mysql_real_escape_string($_GET['term']) . "%' ORDER BY description LIMIT 50";

$search_term = trim(stripslashes($_GET['term']));
$query2 = "SELECT pName FROM products WHERE pName LIKE '%" . mysql_real_escape_string($search_term) . "%' OR description LIKE '%" . mysql_real_escape_string($search_term) . "%' ORDER BY pName LIMIT 10";
$result2 = mysql_query($query2) or die(mysql_error());
while ($rs2 = mysql_fetch_object($result2))
{
	$row_array['value'] = stripslashes($rs2->pName);
	array_push($return_arr, $row_array);
}
@mysql_free_result($result2);

echo json_encode($return_arr);

/*
"ActionScript",
"AppleScript",
"Asp",
"BASIC",
"C",
"C++",
"Clojure",
"COBOL",
"ColdFusion",
"Erlang",
"Fortran",
"Groovy",
"Haskell",
"Java",
"JavaScript",
"Lisp",
"Perl",
"PHP",
"Python",
"Ruby",
"Scala",
"Scheme"

$return_arr = array();
$row_array['value'] = "ActionScript";
array_push($return_arr, $row_array);
$row_array['value'] = "AppleScript";
array_push($return_arr, $row_array);
echo json_encode($return_arr);

*/