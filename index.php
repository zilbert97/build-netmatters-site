<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('html_errors', 1);

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

                    <!-- Kati 25th Birthday card -->
                    <div class="news-card" id="kati-25th-birthday">
                        <div class="news-card-cover">
                            <a href="#">
                                <div class="image-wrapper">
                                    <img class="news-card-image" src="img/kati-leeson.jpeg" alt="Kati Leeson - Happy 25th Birthday">
                                </div>
                                <span class="description-box">View all: IT Support / News</span>
                            </a>
                            <a class="news-card-category" href="#">News</a>
                        </div>
                        <div class="news-card-summary">
                            <a class="title-link" href="#">
                                <h6>Happy 25th Birthday Kati!</h6>
                            </a>
                            <p class="card-description">Since joining Netmatters Kati has done a fantastic job keeping our IT projects progressing&hellip;</p>
                            <a class="read-more" href="#">Read more</a>
                            <hr />
                            <img class="logo-small" src="img/netmatters-logo-small.png" alt="NetMatters logo">
                            <div class="card-publish-info">
                                <p><strong>Posted by Netmatters Ltd</strong></p>
                                <p>18th December 2020</p>
                            </div>
                        </div>
                    </div> <!-- #kati-25th-birthday -->

                    <!-- ZSEA Case Study card -->
                    <div class="news-card" id="zsea-case-study">
                        <div class="news-card-cover">
                            <a href="#">
                                <div class="image-wrapper">
                                    <img class="news-card-image" src="img/it-support-case-study.jpeg" alt="IT Support Case Study - Zoological Society of East Anglia">
                                </div>
                                <span class="description-box">View all: IT Support / Case Studies</span>
                            </a>
                            <a class="news-card-category" href="#">Case studies</a>
                        </div>
                        <div class="news-card-summary">
                            <a class="title-link" href="#">
                                <h6>ZSEA IT Support Case Study</h6>
                            </a>
                            <p class="card-description">As the world continues to change, and businesses evolve, they need to look to ways of futurep&hellip;</p>
                            <a class="read-more" href="#">Read more</a>
                            <hr />
                            <img class="logo-small" src="img/netmatters-logo-small.png" alt="NetMatters logo">
                            <div class="card-publish-info">
                                <p><strong>Posted by Netmatters Ltd</strong></p>
                                <p>10th December 2020</p>
                            </div>
                        </div>
                    </div> <!-- #zsea-case-study -->

                    <!-- Now Hiring card -->
                    <div class="news-card" id="now-hiring">
                        <div class="news-card-cover">
                            <a href="#">
                                <div class="image-wrapper">
                                    <img class="news-card-image" src="img/now-hiring.jpeg" alt="Now hiring senior web developer">
                                </div>
                                <span class="description-box">View all: Bespoke Software / Careers</span>
                            </a>
                            <a class="news-card-category" href="#">Careers</a>
                        </div>
                        <div class="news-card-summary">
                            <a class="title-link" href="#">
                                <h6>Senior Web Developer</h6>
                            </a>
                            <p class="card-description">Salary range: £30,000 - £40,000 (DOE) + Bonus Hours: 40 hours per week, Monday - Friday Loc&hellip;</p>
                            <a class="read-more" href="#">Read more</a>
                            <hr />
                            <img class="logo-small" src="img/simon-wright.jpeg" alt="Simon Wright headshot">
                            <div class="card-publish-info">
                                <p><strong>Posted by Simon Wright</strong></p>
                                <p>10th December 2020</p>
                            </div>
                        </div>
                    </div> <!-- #now-hiring -->

                </div> <!-- #news-board -->

            </section> <!-- #latest-news -->
        </main>

        <footer>

            <!-- Clients -->
            <section id="clients" class="footer-subsection">
                <div class="footer-subsection-inner">

                    <div class="footer-subsection-item" id="client-busseys">
                        <div class="client-description">
                            <h3>Busseys</h3>
                            <hr />
                            <p>One of the UK's leading Ford dealerships.</p>
                        </div>
                        <img src="img/busseys-color.png" alt="" class="item-color">
                        <img src="img/busseys-greyscale.jpeg" alt="" class="item-greyscale">
                    </div>

                    <div class="footer-subsection-item" id="client-crane">
                        <div class="client-description">
                            <h3>Crane Garden Builders</h3>
                            <hr />
                            <p>Leading manufacturer and supplier of high-end garden rooms, summerhouses, workshops and sheds in the UK.</p>
                        </div>
                        <a href="#">
                            <img src="img/crane-color.png" alt="" class="item-color">
                            <img src="img/crane-greyscale.jpeg" alt="" class="item-greyscale">
                        </a>
                    </div>

                    <div class="footer-subsection-item" id="client-beat">
                        <div class="client-description">
                            <h3>Beat</h3>
                            <hr />
                            <p>The UK's eating disorder charity founded in 1989.</p>
                        </div>
                        <img src="img/beat-color.png" alt="" class="item-color">
                        <img src="img/beat-greyscale.jpeg" alt="" class="item-greyscale">
                    </div>

                    <div class="footer-subsection-item" id="client-northern-diver">
                        <div class="client-description">
                            <h3>Northern Diver</h3>
                            <hr />
                            <p>Global water based equipment manufacturers for sport, military, commercial and rescue businesses.</p>
                        </div>
                        <a href="#">
                            <img src="img/northern-diver-color.png" alt="" class="item-color">
                            <img src="img/northern-diver-greyscale.jpeg" alt="" class="item-greyscale">
                        </a>
                    </div>

                </div> <!-- footer-subsection-inner -->
            </section> <!-- .footer-subsection -->

            <!-- Newsletter signup -->
            <section id="footer-signup">
                <div id="footer-signup-inner">
                    <h2>Email newsletter sign-up</h2>
                    <form>

                        <div class="input-field">
                            <label for="signup-name">Your Name</label>
                            <input id="signup-name" type="text" name="user">
                        </div>

                        <div class="input-field">
                            <label for="signup-email">Your Email</label>
                            <input id="signup-email" type="email" name="email_addr">
                        </div>

                        <div id="signup-confirm">
                            <div id="signup-checkbox">
                                <input type="checkbox" name="agree_terms" id="signup-checkbox-input">
                                <span class="icon-check" onclick="$('#signup-checkbox-input').prop('checked', false)"></span>
                            </div>
                            <label id="signup-terms" for="signup-checkbox-input">Please tick this box if you wish to receive marketing information from us. Please see our <a id="privacy-policy" href="#">Privacy Policy</a> for more information on how
                                we use your data.</label>
                        </div>

                        <button id="signup-submit" type="submit">Subscribe</button>

                    </form>
                </div> <!-- #footer-signup-inner -->
            </section> <!-- #footer-signup -->

            <!-- Contact info and links -->
            <section id="main-footer">
                <div id="main-footer-inner">

                    <!-- Contact -->
                    <div class="main-footer-content">
                        <h6>Contact us</h6>
                        <address>
                            11 Penfold Drive<br>
                            Wymondham<br>
                            Norfolk<br>
                            NR18 0WZ
                        </address>
                        <span id="tempspan"></span>
                        <address>
                            Tel:&nbsp;<a href="tel:+441603704020">01603 70 40 20</a><br>
                            Email:&nbsp;<a href="mailto:support@netmatters.com">support@netmatters.com</a>
                        </address>
                    </div>

                    <!-- About - links -->
                    <div class="main-footer-content">
                        <h6>About netmatters</h6>
                        <ul>
                            <li><a href="#">News</a></li>
                            <li><a href="#">Our Careers</a></li>
                            <li><a href="#">Our Team</a></li>
                            <li><a href="#">Our Office Tour</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Cookie Policy</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">UK Domains</a></li>
                        </ul>
                    </div>

                    <!-- Copyright and sitemap -->
                    <div class="main-footer-content">
                        <h6>Website</h6>
                        <a href="#">Sitemap</a><br> <!-- ? -->
                        <span>&copy; Copyright Netmatters Ltd. 2021<br>All rights reserved</span>
                    </div>

                    <!-- Social links -->
                    <div class="main-footer-content">
                        <h6>Social media</h6>
                        <div id="button-grid">
                            <a class="social-button" id="facebook-button" href="https://en-gb.facebook.com/netmatters/" target="_blank">
                                <span class="icon-facebook"></span>
                            </a>
                            <a class="social-button" id="twitter-button" href="https://twitter.com/netmattersltd" target="_blank">
                                <span class="icon-twitter"></span>
                            </a>
                            <a class="social-button" id="linkedin-button" href="https://www.linkedin.com/company/netmatters-ltd/" target="_blank">
                                <span class="icon-linkedin"></span>
                            </a>
                        </div>
                    </div>

                </div> <!-- #main-footer-inner -->
            </section> <!-- #main-footer -->

            <!-- Accreditations -->
            <section class="footer-subsection">
                <div class="footer-subsection-inner">

                    <div class="footer-subsection-item">
                        <img src="img/google-partner.jpg" alt="Google Partner badge" id="google-partner-badge">
                    </div>

                    <div class="footer-subsection-item">
                        <img src="img/microsoft-silver-partner.jpeg" alt="Microsoft silver partner badge">
                    </div>

                    <div class="footer-subsection-item">
                        <img src="img/future-50-color.jpeg" alt="Future 50 Member badge" class="item-color">
                        <img src="img/future-50-greyscale.jpeg" alt="Future 50 Member badge" class="item-greyscale">
                    </div>

                    <div class="footer-subsection-item">
                        <img src="img/qms-color.jpeg" alt="QMS ISO 27001 Registered badge (certficate number 14132796)" class="item-color">
                        <img src="img/qms-greyscale.jpeg" alt="QMS ISO 27001 Registered badge (certficate number 14132796)" class="item-greyscale">
                    </div>

                    <div class="footer-subsection-item">
                        <img src="img/ncc-color.jpeg" alt="Norfolk Carbon Charter (2019) Silver badge" class="item-color">
                        <img src="img/ncc-greyscale.jpeg" alt="Norfolk Carbon Charter (2019) Silver badge" class="item-greyscale">
                    </div>

                </div> <!-- .footer-subsection-inner -->
            </section> <!-- .footer-subsection -->
        </footer>
    </div> <!-- #page-content -->

    <?php
    include('src/inc/mobileNav.php');
    include('src/inc/cookies.php');
    include('src/inc/scripts.php');
    ?>
</body>
</html>
