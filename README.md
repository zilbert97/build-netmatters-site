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
- [ ] Modal only opens if session storage `acceptedCookies === false`
- [ ] Prevent modal from closing
