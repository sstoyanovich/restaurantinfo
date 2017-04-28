<?
session_start();
$use_CDN = 1;
$this_page = "home";
//ini_set('error_reporting', E_ALL);
//error_reporting(E_ALL);

require("bootstrap_v1/incld/config.php");
require("bootstrap_v1/incld/utils.php");
require("bootstrap_v1/incld/db.php");
require("bootstrap_v1/incld/page_start_inc.php");
?>
<div id="home">
    <? require("bootstrap_v1/incld/top-banner-inc2.php"); ?>
    <? //require("members/search-form-new.php"); ?>

    <h1><strong>Grab a Job</strong></h1>

    <ul class="company-logos">
        <li><img alt="Red Rooster Logo" src="/images/company-logo/red-rooster.png">
        </li>
        <li><img alt="North Italia Logo" src="/images/company-logo/north-italia.png">
        </li>
        <li><img alt="ChowNow Logo" src="/images/company-logo/chow-now.png">
        </li>
        <li><img alt="Morimoto Logo" src="/images/company-logo/morimoto.png">
        </li>
        <li><img alt="Cartel Logo" src="/images/company-logo/cartel.png">
        </li>
        <li><img alt="Black Barn Logo" src="/images/company-logo/black-barn.png">
        </li>
    </ul><!--/ .company-logos-->

    <article class="featured-company clearfix">
        <dl>
            <dt class="featured-company-image">
                <img alt="Blue Hill" src="/images/company-image/example-company.jpg">
            </dt>
            <dd class="featured-company-description">
                <h2>
                    <strong>Blue Hill</strong>
                    <em>75 Washington Pl,</em>
                    <em>New York, NY 10011</em>
                </h2>
                <p>Locally sourced, seasonal ingredients abound on the American menu served at this townhouse-set spot.
                </p>
            </dd>
        </dl>
    </article><!--/ .featured-company-->

    <section class="more-featured-companies clearfix">
        <dl>
            <dt class="featured-company-image">
                <img alt="blue hill" src="/images/company-image/example-company.jpg">
            </dt>
            <dd class="featured-company-description">
                <h2>
                    <strong>Black Barn</strong>
                    <em>75 washington pl,</em>
                    <em>new york, ny 10011</em>
                </h2>
                <p>Dipsum is simply dummy text of type and scrambled to make a type specimen book.
                </p>
            </dd>
        </dl>
        <dl>
            <dt class="featured-company-image">
                <img alt="Morimoto" src="/images/company-image/example-company.jpg">
            </dt>
            <dd class="featured-company-description">
                <h2>
                    <strong>Morimoto</strong>
                    <em>75 washington pl,</em>
                    <em>new york, ny 10011</em>
                </h2>
                <p>Lorem ipsum is simply dummy text of the printing and typesetting industry. lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>
            </dd>
        </dl>
        <dl>
            <dt class="featured-company-image">
                <img alt="north italia" src="/images/company-image/example-company.jpg">
            </dt>
            <dd class="featured-company-description">
                <h2>
                    <strong>North Italia</strong>
                    <em>75 washington pl,</em>
                    <em>new york, ny 10011</em>
                </h2>
                <p>lorem ipsum is simply dummy text of the printing and typesetting industry. lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>
            </dd>
        </dl>
        <dl>
            <dt class="featured-company-image">
                <img alt="red Rooster" src="/images/company-image/example-company.jpg">
            </dt>
            <dd class="featured-company-description">
                <h2>
                    <strong>Red Rooster</strong>
                    <em>75 washington pl,</em>
                    <em>new york, ny 10011</em>
                </h2>
                <p>Since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>
            </dd>
        </dl>
        <dl>
            <dt class="featured-company-image">
                <img alt="ChowNow" src="/images/company-image/example-company.jpg">
            </dt>
            <dd class="featured-company-description">
                <h2>
                    <strong>ChowNow</strong>
                    <em>75 washington pl,</em>
                    <em>new york, ny 10011</em>
                </h2>
                <p>Lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>
            </dd>
        </dl>

    </section><!--/ .more-featured-companies-->

    <? require("bootstrap_v1/incld/footer_inc.php"); ?>
</div><!--/ .home-->
<div style="width: 100%; height: 1450px; background: transparent url(/images/overlay/home-page.png) no-repeat 50% 0; opacity: .3; position: absolute; top: 0; left: 0; z-index: 100000000; display: none;">
</div>

<?
    require("bootstrap_v1/incld/page_end_inc.php");
