<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('html_errors', 1);

include('src/functions.php');

include('src/inc/head.php');
?>
<body>
    <div id="page-content">
        <div class="full-viewport">
            <?php
            include('src/inc/header.php');
            include('src/inc/jumbotron.php');
            ?>
        </div> <!-- .full-viewport -->

        <main>
            <section class="nm-cards">

                <div class="nm-cards-bespoke-software">
                    <a href="#">
                        <span class="icon-apps"></span>
                        <h5>Bespoke Software</h5>
                        <hr />
                        <p>Tailored software solutions to improve business productivity and online profits. Our expert team will ensure a software solution.</p>
                        <span class="read-more">Read more</span>
                    </a>
                </div>

                <div class="nm-cards-it-support">
                    <a href="#">
                        <span class="icon-display"></span>
                        <h5>IT Support</h5>
                        <hr />
                        <p>Remotely managed IT services that is catered to your business needs, adds value and reduces costs.</p>
                        <span class="read-more">Read more</span>
                    </a>
                </div>

                <div class="nm-cards-digital-marketing">
                    <a href="#">
                        <span class="icon-bar-graph"></span>
                        <h5>Digital Marketing</h5>
                        <hr />
                        <p>Driving brand awareness and ROI through creative digital marketing campaigns. We review and monitor online performaces.</p>
                        <span class="read-more">Read more</span>
                    </a>
                </div>

                <div class="nm-cards-break"></div> <!-- break to a new row (at larger breakpoints) -->

                <div class="nm-cards-telecoms-services">
                    <a href="#">
                        <span class="icon-phone_in_talk"></span>
                        <h5>Telecoms Services</h5>
                        <hr />
                        <p>Stary connected with bespoke telecoms solutions when you need it most.</p>
                        <span class="read-more">Read more</span>
                    </a>
                </div>

                <div class="nm-cards-web-design">
                    <a href="#">
                        <span class="icon-code"></span>
                        <h5>Web Design</h5>
                        <hr />
                        <p>User-centric design for business looking to make a lasting first impression.</p>
                        <span class="read-more">Read more</span>
                    </a>
                </div>

                <div class="nm-cards-cyber-security">
                    <a href="#">
                        <span class="icon-security"></span>
                        <h5>Cyber Security</h5>
                        <hr />
                        <p>Ensuring your online business stays secure 24/7, 365 days of the year.</p>
                        <span class="read-more">Read more</span>
                    </a>
                </div>

                <div class="nm-cards-web-design">
                    <!-- Same styling as web design card -->
                    <a href="#">
                        <span class="icon-school"></span>
                        <h5>Developer Training</h5>
                        <hr />
                        <p>Have you considered a career in web development but you aren't sure where to start?</p>
                        <span class="read-more">Read more</span>
                    </a>
                </div>

            </section> <!-- .nm-cards -->

            <section id="about">
                <div id='about-wrapper'>
                    <div id="about-contents">
                        <h2>Netmatters</h2>
                        <p><strong>Netmatters Ltd is a leading web design, IT support and digital marketing agency based in Wymondham, Norfolk.</strong></p>
                        <p>Founded in 2008, we work with businesses from a variety of industries to gain new prospects, nurture existing leads and further grow their sales.</p>
                        <p>We provide cost effective, reliable solutions to a range of services; from bespoke cloud-based management systems, workflow and IT solutions through to creative website development and integrated digital campaigning.</p>
                        <a href="#">
                            <span class="button-text">Our culture</span>
                            <span class="icon-arrow-right2"></span>
                        </a>
                    </div> <!-- #about-contents -->
                </div> <!-- #about-wrapper -->
            </section> <!-- #about -->

            <section id="latest-news">
                <header id="latest-news-header">
                    <div id="latest-news-inner">
                        <div id="latest-news-label">
                            <span>Latest</span>
                            <hr />
                        </div>
                    </div>
                </header>
                <!-- Latest News cards -->
                <div id="news-board">
                <?php
                foreach (get_latest_news() as $news_item) {
                    echo display_latest_news($news_item);
                }
                ?>
                </div> <!-- #news-board -->

            </section> <!-- #latest-news -->
        </main>
    <?php
    include('src/inc/footer.php');
    ?>

    </div> <!-- #page-content -->

    <?php
    include('src/inc/mobileNav.php');
    include('src/inc/cookies.php');
    include('src/inc/scripts.php');
    ?>
</body>
</html>
