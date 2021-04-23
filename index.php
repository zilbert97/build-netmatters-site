<?php
/**
 * Netmatters home page
 *
 * PHP version 8
 *
 * @category
 * @package
 * @author   Z Gilbert <zach.gilbert@netmatters-scs.co.uk>
 * @license  github.com/zilbert97/build-netmatters-site/blob/add-php/LICENSE LICENSE
 * @link     https://www.github.com/zilbert97/build-netmatters-site/blob/add-php/index.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('html_errors', 1);

require_once __DIR__ . '/src/bootstrap.php';
require __DIR__ . '/src/inc/head.php';

?>
<body>
    <div id="page-content">
        <div class="full-viewport">
            <?php
            require __DIR__ . '/src/inc/header.php';
            require __DIR__ . '/src/inc/jumbotron.php';
            ?>
        </div> <!-- .full-viewport -->

        <main>
            <section class="nm-cards">
                <?php
                $allCardsData = [
                    [
                        'title'=>'Bespoke Software',
                        'category'=>'bespoke-software',
                        'icon'=>'apps',
                        'description'=>'Tailored software solutions to improve business productivity and online profits. Our expert team will ensure a software solution.',
                    ],
                    [
                        'title'=>'IT Support',
                        'category'=>'it-support',
                        'icon'=>'display',
                        'description'=>'Remotely managed IT services that is catered to your business needs, adds value and reduces costs.',
                    ],
                    [
                        'title'=>'Digital Marketing',
                        'category'=>'digital-marketing',
                        'icon'=>'bar-graph',
                        'description'=>'Driving brand awareness and ROI through creative digital marketing campaigns. We review and monitor online performaces.',
                    ],
                    [
                        'title'=>'Telecoms Services',
                        'category'=>'telecoms-services',
                        'icon'=>'phone_in_talk',
                        'description'=>'Stary connected with bespoke telecoms solutions when you need it most.',
                    ],
                    [
                        'title'=>'Web Design',
                        'category'=>'web-design',
                        'icon'=>'code',
                        'description'=>'User-centric design for business looking to make a lasting first impression.',
                    ],
                    [
                        'title'=>'Cyber Security',
                        'category'=>'cyber-security',
                        'icon'=>'security',
                        'description'=>'Ensuring your online business stays secure 24/7, 365 days of the year.',
                    ],
                    [
                        'title'=>'Developer Training',
                        'category'=>'web-design',
                        'icon'=>'school',
                        'description'=>'Have you considered a career in web development but you aren\'t sure where to start?',
                    ]
                ];

                for ($i = 0; $i < count($allCardsData); $i++) {
                    $cardData = $allCardsData[$i];
                    $card = <<<EOD
                    <div class="nm-cards-{$cardData['category']}">
                        <a href="#">
                            <span class="icon-{$cardData['icon']}"></span>
                            <h5>{$cardData['title']}</h5>
                            <hr />
                            <p>{$cardData['description']}</p>
                            <span class="read-more">Read more</span>
                        </a>
                    </div>
                    EOD;

                    echo $card;

                    if ($i == 2) {
                        echo '<div class="nm-cards-break"></div>';
                    }
                }
                ?>
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
                foreach (getLatestNews() as $news_item) {
                    echo displayLatestNews($news_item);
                }
                ?>
                </div> <!-- #news-board -->

            </section> <!-- #latest-news -->
        </main>
    <?php
    require __DIR__ . '/src/inc/footer.php';
    ?>

    </div> <!-- #page-content -->

    <?php
    require __DIR__ . '/src/inc/mobileNav.php';
    require __DIR__ . '/src/inc/cookies.php';
    require __DIR__ . '/src/inc/scripts.php';
    ?>
</body>
</html>
