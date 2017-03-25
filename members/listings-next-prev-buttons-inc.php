<form action="" method="get">
<br>
<?
	if ($number_of_jobs)
	{
		$prev_page = $the_page;
		if ($prev_page > 1)
			$prev_page--;

		$num_partial_pages = ($number_of_jobs % $jobs_per_page);
		$num_pages = (int)($number_of_jobs / $jobs_per_page);
		if ($num_partial_pages)
			$num_pages++;
		$next_page = $the_page;
		if ($next_page < $num_pages)
			$next_page++;
		
		if ($_GET["co_more"])
			$co_more_parms = "&co_more=" . $_GET["co_more"] . "&id=" . $_GET["id"] . "&company=" . $_GET["company"];
		else
			$co_more_parms = "";

		$get_parm_str = "&search_type=$search_type&state=$state&category=$category&job_title_id=$job_title_id&title2=$title2&hourly_rate=$hourly_rate&salary_min=$salary_min&salary_max=$salary_max&years_min=$years_min&years_max=$years_max&search_terms=$search_terms&sid=$sid&token=$token&rev=$rev&sort=$sort";
   
   		 if ($the_page > 1) 
		 { ?>
			<input name="first"    type="button" value="&lt;&lt; First Page" onclick="document.location.href='/search.php?page=1<?=$get_parm_str?>'" /> &nbsp; 
			<input name="previous" type="button" value="&lt; Previous Page"  onclick="document.location.href='/search.php?page=<?=$prev_page?><?=$get_parm_str?>'" /> &nbsp; 
		<? } else { ?>
			<font color="#999999">
			<input name="first"    type="button" value="&lt;&lt; First Page" onclick="document.location.href='/search.php?page=1<?=$get_parm_str?>'" /> &nbsp; 
			<input name="previous" type="button" value="&lt; Previous Page"  onclick="document.location.href='/search.php?page=<?=$prev_page?><?=$get_parm_str?>'" /> &nbsp; 
			</font>
	  <? } ?>
	  
	<? if ($num_pages > 1 && $the_page < $num_pages) { ?>

			<input name="first"    type="button" value="Next Page &gt;" onclick="document.location.href='/search.php?page=<?=$next_page?><?=$get_parm_str?>'" /> &nbsp; 
			<input name="previous" type="button" value="Last Page &gt;&gt;"     onclick="document.location.href='/search.php?page=<?=$num_pages?><?=$get_parm_str?>'" /> &nbsp; 
	<? } else { ?>
		<font color="#999999">
			<input name="first"    type="button" value="Next Page &gt;" onclick="document.location.href='/search.php?page=<?=$next_page?><?=$get_parm_str?>'" /> &nbsp; 
			<input name="previous" type="button" value="Last Page &gt;&gt;"     onclick="document.location.href='/search.php?page=<?=$num_pages?><?=$get_parm_str?>'" /> &nbsp; 
		</font>
	<? } ?>

	<?
	}
	?>
<br />

</form>
