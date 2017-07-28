<?php
	$check_mark     = "<img src='/images/layout/checkmark.gif' width='16' height='16' align='absmiddle' border='0' >";
	$check_mark_red = "<img src='/images/layout/checkmark_red.jpg' width='16' height='16' border='0'>";
	$xmark          = "<img src='/images/layout/xmark.jpg' width='16' height='16' border='0'>";

function clean_post_var($the_var, $allow_links=0) {
	global $g_clean_money;
	global $g_allow_HTML;

	$the_var  = stripslashes($the_var);

	if (!$g_allow_HTML) {
		
        if ($allow_links) {
			$the_var  = strip_tags($the_var, '<a>');
        } else {
			$the_var  = strip_tags($the_var);
			$the_var  = htmlentities($the_var);
		}
	}

	$the_var  = str_replace("text/javascript", "", $the_var);
	$the_var  = str_replace("script type=", "", $the_var);
	$the_var  = str_replace("<script", "", $the_var);
	$the_var  = str_replace("<!--", "", $the_var);
	$the_var  = str_replace(");", "", $the_var);
	$the_var  = str_replace("<?", "xxxx", $the_var);

	if ($g_clean_money) { // if parm being cleaned is a money value, get rid of any dollar signs, commas, spaces, etc.
		$the_var  = str_replace("$", "", $the_var);
		$the_var  = str_replace(",", "", $the_var);
		$the_var  = str_replace(" ", "", $the_var);
	}

	$the_var  = trim($the_var);
	
    return $the_var;
}


function clean_filename($filename) {
	$filename = str_replace(" ", "", $filename);
	$filename = str_replace("'", "", $filename);
	$filename = str_replace("!", "", $filename);
	$filename = str_replace("\"", "", $filename);
	$filename = str_replace("@", "", $filename);
	$filename = str_replace("#", "", $filename);
	$filename = str_replace("$", "", $filename);
	$filename = str_replace("%", "", $filename);
	$filename = str_replace("^", "", $filename);
	$filename = str_replace("&", "", $filename);
	$filename = str_replace("*", "", $filename);
	$filename = str_replace("(", "", $filename);
	$filename = str_replace(")", "", $filename);
	$filename = str_replace("~", "", $filename);
	$filename = str_replace("`", "", $filename);
	$filename = str_replace("{", "", $filename);
	$filename = str_replace("}", "", $filename);
	$filename = str_replace("[", "", $filename);
	$filename = str_replace("]", "", $filename);
	$filename = str_replace(";", "", $filename);
	$filename = str_replace(":", "", $filename);
	$filename = str_replace("<", "", $filename);
	$filename = str_replace(">", "", $filename);
	$filename = str_replace("/", "", $filename);
	$filename = str_replace("?", "", $filename);
	
    return $filename;
}
