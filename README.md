# build-netmatters-site

## To Do:
- [ ] Add form validation and submit to subscribe
- [ ] Log failed connection to database (`./src/functions.php` function `connectToDatabase()`)
- [ ] Log failed connection to database (`./src/functions.php` function `getLatestNews()`)
- [x] Add form to database
- [ ] Autoload classes
- [ ] Prevent user access to any files except index.php and contact.php
- [x] Add filter input before form validation

## Reflection Plan

### INITIAL SETUP
1. Set up new branch on origin `add-php` and merge from `add-js`
2. Set up additional dirs (`./src/`, `./src/inc/`)
3. Create `head.php`, `header.php`, `footer.php` in `./src/inc/`; create `functions.php` in `./src/`
4. Rename `index.html` > `index.php` and add includes for head, header, footer
5. Set up database with tables `news_posts`, `subscribers`, `contact_form`

### LATEST NEWS POSTS
6. Seed database with latest news post data
7. Get top 3 latest news items from database and display

### SUBSCRIBE FORM
8. Recreate error and success messages displayed for subscribe form on home page in HTML/Sass to determine style and structure
9. Add validation to form submit - move html error/success messages to validation script in PHP
10. Store new form submissions in database `subscribers` table

### CONTACT FORM
11. Create new `./contact.php` with head, header, and footer includes
12. Create `./.env` for env vars
13. Require dotenv package using Composer
14. Build contact form in HTML/Sass: Name, Email, Contact Number, Message, ReCaptcha, GDPR Compliance, Error Messages (same style as subscribers form)
15. Add validation to form submit - move html error/success messages to validation script in PHP, move validation functions to `functions.php`

### CLEAN UP
16. Add links between `index.php` and `contact.php`
