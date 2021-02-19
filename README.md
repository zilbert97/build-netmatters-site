# build-netmatters-site
JS reflection:
- Banner slider
- Mobile menu
- Sticky header
- Pop-up notifying the user the website uses cookies, this should store locally and prevent the pop-up reappearing on page reload

## To-do:
- [x] Get jQuery from CDN

#### Branch `sticky-header`:
- [x] Get sticky header plugin
- [x] Make stick to top of viewort
- [x] Show on scroll up, hide on scroll down
- [x] Animate show/hide
- [x] Test X-browser

#### Branch `mobile-menu`:

#### Branch `banner-slider`:
- [x] Get slick carousels plugin

#### Branch `cookies-popup`:
- [x] Get modals plugin
- [ ] Create some session storage object which stores a boolean value, key `acceptedCookies`
- [ ] Generate a modal
- [ ] Modal copy - see below
- [ ] Modal only opens if session storage `acceptedCookies === false`
- [ ] Prevent modal from closing

<q>We use cookies to obtain aggregate data regarding site traffic and interaction, in order to identify user trends and obtain insights in order to continually improve our site. These cookies enable us to improve your customer experience as you use our site and help provide you with relevant online marketing.</q><br>
<q>You can see a list of the other companies who use cookies on this website, by visiting cookie settings at the bottom of each page. For full details of how we use your personal information, and your rights in relation to it, view our privacy policy.</q>
