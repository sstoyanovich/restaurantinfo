<?
function date_listed($date) {
    $now = time(); // or your date as well
    $your_date = strtotime($date);
    $datediff = $now - $your_date;

    return floor($datediff / (60 * 60 * 24));
}

$query = "SELECT job_titles.job_title, jobs.description, jobs.meta_description, jobs.years_min, jobs.years_max, jobs.date_listed, jobs.contact_company, jobs.city, jobs.state, members.company_culture from jobs, job_titles, members WHERE job_titles.job_title_id = jobs.job_title_id AND members.member_id = jobs.member_id AND jobs.description IS NOT NULL ORDER BY jobs.date_listed DESC LIMIT 7";

$result = mysql_query($query) or die(mysql_error());
?>
<ul id="jobs-listing">

<?  
    $counter = 0;
    
    while ($rs = mysql_fetch_object($result)):
        $days_listed = date_listed($rs->date_listed);
?>
    <li<? if (0 == $counter) { echo ' class="current"'; } ?>>
        <dl>
            <dt class="job-title"><? echo $rs->job_title; ?></dt>
            <dd><? echo $rs->contact_company . " &mdash; " . $rs->city . ", " . $rs->state; ?>
            </dd>
            <dd class="est-salary">Est. Salary: $<? echo $rs->years_min . "k&mdash;$" . $rs->years_max . "k"; ?>
            </dd>
            <dd class="date-listed"><? echo $days_listed; ?> Days Ago
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
                <p class="apply-now"><a href="#">Apply Now</a>
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
