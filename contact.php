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

require_once __DIR__ . '/src/bootstrap.php';
require_once __DIR__ . '/src/ContactForm.php';

require __DIR__ . '/src/inc/head.php';
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

                <!--
                <div class="error--wrapper">
                    <div class="error--message-body">
                        <p class="error--copy">Placeholder warning message!</p>
                    </div>
                </div>
                -->

                <?php displayFormErrorMessages(); ?>

                <form id="contact--form" class="contact--form" action="src/submitContactForm.php" method="post" novalidate>

                    <div class="form--text-field-wrapper">
                        <div class="form--field">
                            <label>
                                <span class="form--label-copy required--label">Name</span>
                                <input
                                    class="form--text-input required--input"
                                    type="text"
                                    name="name_contact"
                                    placeholder="Jane Smith"
                                    value="<?php echo $contactFormValuesBag->get('name'); ?>"
                                >
                            </label>
                        </div>

                        <div class="form--field">
                            <label>
                                <span class="form--label-copy required--label">Email Address</span>
                                <input
                                    class="form--text-input required--input"
                                    type="email"
                                    name="email_contact"
                                    placeholder="example@domain.com"
                                    value="<?php echo $contactFormValuesBag->get('email'); ?>"
                                >
                            </label>
                        </div>

                        <div class="form--field">
                            <label>
                                <span class="form--label-copy">Contact Number</span>
                                <input
                                    class="form--text-input"
                                    type="tel"
                                    name="phone_contact"
                                    placeholder="07123456789"
                                    value="<?php echo $contactFormValuesBag->get('phone'); ?>"
                                >
                            </label>
                        </div>

                        <div class="form--field">
                            <label>
                                <span class="form--label-copy required--label">Message</span>
                                <textarea
                                    class="form--text-input required--input"
                                    type="text"
                                    name="message_contact"
                                    placeholder="Lorem ipsum..."><?php echo $contactFormValuesBag->get('message'); ?></textarea>
                            </label>
                        </div>
                    </div>

                    <div id="gdpr-field">
                        <div class="form--gdpr-field">
                            <input id="gdpr-checkbox--contact" class="form--checkbox-input" type="checkbox" name="agree_terms_contact" value="accepted">
                            <span class="icon-check" onclick="$('#gdpr-checkbox--contact').prop('checked', false)"></span>
                        </div>
                        <label class="form--gdpr-statement" for="gdpr-checkbox--contact">Please tick this box if you wish to receive marketing information from us. Please see our <a class="form--gdpr-privacy-policy" href="#">Privacy Policy</a> for more information on how we use your data.</label>
                    </div>

                    <button class="form--submit">Submit enquiry</button>

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
