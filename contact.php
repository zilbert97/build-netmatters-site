<?php
/**
 * File contact.php - Netmatters /contact.php page
 *
 * PHP version 8
 *
 * @category
 * @package
 * @author
 * @license
 * @link
 *
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('html_errors', 1);

require 'src/functions.php';
require 'src/ContactForm.php';

require 'src/inc/head.php';
?>
<body>
    <div id="page-content">
        <?php
        require 'src/inc/header.php';
        //require 'src/inc/jumbotron.php');
        ?>

        <main>
            <section id="contact">
                <h2 id="contact--title">Get In Touch</h2>

                <div class="error--wrapper">
                    <div class="error--message-body">
                        <p class="error--copy">Placeholder warning message!</p>
                    </div>
                </div>

                <form id="contact--form" class="contact--form" action="src/submitContactForm.php" method="post">

                    <div class="form--text-field-wrapper">
                        <div class="form--field">
                            <label>
                                <span class="form--label-copy required--label">Name</span>
                                <input class="form--text-input required--input" type="text" name="name" placeholder="Jane Smith">
                            </label>
                        </div>

                        <div class="form--field">
                            <label>
                                <span class="form--label-copy required--label">Email Address</span>
                                <input class="form--text-input required--input" type="email" name="email" placeholder="example@domain.com">
                            </label>
                        </div>

                        <div class="form--field">
                            <label>
                                <span class="form--label-copy">Contact Number</span>
                                <input class="form--text-input" type="tel" name="phone" placeholder="07123456789">
                            </label>
                        </div>

                        <div class="form--field">
                            <label>
                                <span class="form--label-copy required--label">Message</span>
                                <textarea class="form--text-input required--input" type="text" name="message" placeholder="Lorem ipsum..."></textarea>
                            </label>
                        </div>
                    </div>

                    <div id="gdpr-field">
                        <div class="form--gdpr-field">
                            <input id="gdpr-checkbox--contact" class="form--checkbox-input" type="checkbox" name="agree_terms_contact">
                            <span class="icon-check" onclick="$('#gdpr-checkbox--contact').prop('checked', false)"></span>
                        </div>
                        <label class="form--gdpr-statement" for="gdpr-checkbox--contact">Please tick this box if you wish to receive marketing information from us. Please see our <a class="form--gdpr-privacy-policy" href="#">Privacy Policy</a> for more information on how we use your data.</label>
                    </div>

                    <button class="form--submit g-recaptcha">Submit enquiry</button>

                </form>
            </section> <!-- #section-form -->
        </main>
        <?php
        require 'src/inc/footer.php';
        ?>

    </div> <!-- #page-content -->

    <?php
    require 'src/inc/mobileNav.php';
    require 'src/inc/cookies.php';
    require 'src/inc/scripts.php';
    ?>
</body>
</html>
