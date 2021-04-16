<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('html_errors', 1);

include('src/functions.php');

include('src/inc/head.php');
?>
<body>
    <div id="page-content">
        <?php
        include('src/inc/header.php');
        //include('src/inc/jumbotron.php');
        ?>

        <main>
            <section id="contact">
                <h2 id="contact--title">Get In Touch</h2>
                <form id="contact--form" class="contact--form" action="" method="post">

                    <div class="form--text-field-wrapper">
                        <div class="form--field">
                            <label>
                                <span class="form--label-copy required--label">Name:</span>
                                <input class="form--text-input required--input" type="text" name="name" placeholder="Jane Smith">
                            </label>
                        </div>

                        <div class="form--field">
                            <label>
                                <span class="form--label-copy required--label">Email Address:</span>
                                <input class="form--text-input required--input" type="email" name="email" placeholder="example@domain.com">
                            </label>
                        </div>

                        <div class="form--field">
                            <label>
                                <span class="form--label-copy">Contact Number:</span>
                                <input class="form--text-input" type="tel" name="phone" placeholder="07123456789">
                            </label>
                        </div>

                        <div class="form--field">
                            <label>
                                <span class="form--label-copy required--label">Message:</span>
                                <textarea class="form--text-input required--input" type="text" name="message" placeholder="Lorem ipsum..."></textarea>
                            </label>
                        </div>
                    </div>

                    <div id="gdpr-field">
                        <div class="form--gdpr-field">
                            <input id="gdpr-checkbox" class="form--checkbox-input" type="checkbox" name="agree_terms">
                            <span class="icon-check" onclick="$('#gdpr-checkbox').prop('checked', false)"></span>
                        </div>
                        <label class="form--gdpr-statement" for="gdpr-checkbox">Please tick this box if you wish to receive marketing information from us. Please see our <a class="form--gdpr-privacy-policy" href="#">Privacy Policy</a> for more information on how we use your data.</label>
                    </div>

                    <button class="form--submit g-recaptcha">Submit enquiry</button>

                </form>
            </section> <!-- #section-form -->
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
