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
                <img alt="Blue Hill" src="/images/company-image/example-company-01.jpg">
            </dt>
            <dd class="featured-company-description">
                <h2>
                    <strong>Odeon</strong>
                    <em>80 Spring St</em>
                    <em>New York, NY 10012</em>
                </h2>
                <p>Restaurateur Keith McNally's enduring Soho brasserie is the best everyday restaurant in New York City. Period. The Balth is a terrific choice for a breakfast meeting, a steak frites lunch, or special occasion dinner. If you're splurging, get the Balthazar plateaux and the chicken for two.
                </p>
            </dd>
        </dl>
    </article><!--/ .featured-company-->

    <section class="more-featured-companies clearfix">
        <dl>
            <dt class="featured-company-image">
                <img alt="Blue Hill" src="/images/company-image/example-company-01.jpg" class="current">
            </dt>
            <dd class="featured-company-description">
                <h2>
                    <strong>Odeon</strong>
                    <em>80 Spring St</em>
                    <em>New York, NY 10012</em>
                </h2>
                <p>Restaurateur Keith McNally's enduring Soho brasserie is the best everyday restaurant in New York City. Period. The Balth is a terrific choice for a breakfast meeting, a steak frites lunch, or special occasion dinner. If you're splurging, get the Balthazar plateaux and the chicken for two.
                </p>
            </dd>
        </dl>
        <dl>
            <dt class="featured-company-image">
                <img alt="Morimoto" src="/images/company-image/example-company-02.jpg">
            </dt>
            <dd class="featured-company-description">
                <h2>
                    <strong>The Dutch</strong>
                    <em>131 Sullivan St</em>
                    <em>New York, NY 10012</em>
                </h2>
                <p>Over the last five years, The Dutch has turned into the quintessential American restaurant that chef Andrew Carmellini and partners Josh Pickard and Luke Ostrom sought to evoke when it first opened. It’s a great choice when you’re craving a steak, a burger, or oysters, and the menu always includes plentiful seafood options as well as pastas. The Dutch is now an indelible part of the Soho landscape.
                </p>
            </dd>
        </dl>
        <dl>
            <dt class="featured-company-image">
                <img alt="north italia" src="/images/company-image/example-company-03.jpg">
            </dt>
            <dd class="featured-company-description">
                <h2>
                    <strong>Estela</strong>
                    <em>47 E Houston St</em>
                    <em>New York, NY 10012</em>
                </h2>
                <p>At Estela, Ignacio Mattos serves a set of rustic dishes that don't easily fit into any one classification. Standouts include the mussels escabeche on toast, the ricotta dumplings, and the excellent beef tartare with sunchokes. Over the last few years, the Nolita restaurant has become a popular oenophile hangout, thanks to the thoughtful wine list from Blue Hill veteran Thomas Carter. If you want to sample Estela without spending too much money or battling the crowds, go during weekend brunch.                </p>
            </dd>
        </dl>
        <dl>
            <dt class="featured-company-image">
                <img alt="red Rooster" src="/images/company-image/example-company-04.jpg">
            </dt>
            <dd class="featured-company-description">
                <h2>
                    <strong>Oiji</strong>
                    <em>119 1st Ave</em>
                    <em>New York, NY 10003</em>
                </h2>
                <p>At this small East Village restaurant, chefs Tae Kyung Ku and Brian Kim serve traditional Korean dishes executed with a few modern touches. The ideal meal starts with the house-made soba noodles, braised beef, and mackerel smoked over pine needles, ended sweetly by the honey butter chips with ice cream. Most of the shareable small plates are priced in the teens, and the menu also includes a $38 ssam platter for two.
                </p>
            </dd>
        </dl>
        <dl>
            <dt class="featured-company-image">
                <img alt="ChowNow" src="/images/company-image/example-company-05.jpg">
            </dt>
            <dd class="featured-company-description">
                <h2>
                    <strong>The Breslin</strong>
                    <em>16 W 29th St</em>
                    <em>New York, NY 10001</em>
                </h2>
                <p>The Breslin has become much more than just the gastropub in the Ace Hotel. After seven years, it can now rightly be considered one of New York City’s most accomplished meat restaurants. From large format lamb feasts to full English breakfasts to the game-changing lamb burger to what is quite possibly NYC’s finest rib steak, The Breslin is firing on all cylinders.
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
