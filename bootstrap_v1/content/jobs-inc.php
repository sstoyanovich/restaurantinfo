<?
$query = "SELECT job_titles.job_title, jobs.description, jobs.meta_description,jobs.contact_company, jobs.city, jobs.state, members.company_culture from jobs, job_titles, members WHERE job_titles.job_title_id = jobs.job_title_id AND members.member_id = jobs.member_id AND jobs.description IS NOT NULL ORDER BY jobs.date_listed DESC LIMIT 7";

$result = mysql_query($query) or die(mysql_error());
?>
<ul id="jobs-listing">

<?  
    $counter = 0;
    
    while ($rs = mysql_fetch_object($result)): ?>
    <li<? if (0 == $counter) { echo ' class="current"'; } ?>>
        <dl>
            <dt><? echo $rs->job_title; ?></dt>
            <dd><? echo $rs->contact_company . " &mdash; " . $rs->city . ", " . $rs->state; ?>
            </dd>
            <dd class="long-description">
                <h3>Short Description</h3>
                <p><? echo $rs->description; ?>
                </p>
                <h3>Company Culture</h3>
                <p><? echo $rs->company_culture; ?>
                </p>
                <h3>Job Details</h3>
                <p><? echo $rs->meta_description; ?>
                </p>
            </dd>
        </dl>
    </li>
<?  $counter = $counter + 1;
    endwhile; ?>
</ul><!--/ .jobs-listing-->
<?
    mysql_free_result($result)
?>
