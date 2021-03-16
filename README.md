# build-netmatters-site
JS reflection:
- Banner slider
- Mobile menu
- Sticky header
- Cookies Pop-up (store locally to prevent reappearing on page reload)

## Notes to reviewer
- JS has been compiled to ES5 without comments - see js/uncompiled for commented and documented code.
- Due to being on Mac, my initial HTML/CSS reflection was completed with limited IE testing and several IE bugs present (lack of ability to test was considered at submission). Since then i've been able to test on IE and have tried to fix all major HTML/CSS issues not relating to this reflection, but some other bugs may persist.

## Known issues (last updated 16/03/21 17:26)

### Major :bangbang:
- [x] When user closes cookies modal, carousel position is off
- [x] Carousel positioning incorrect when opening index.html in browser via filepath instead of localhost
- [x] On some tablets and mobile devices carousel height is incorrect
- [x] IE - No JS is triggered
- [x] IE - Opening menu causes overlay to sit above side-menu
- [x] IE - Open side-menu - various major layout issues
- [x] IE - Opening with local filepath causes issues as does not have access to web storage API. Use cookies instead to store info?
- [x] Contents of side menu should show extra nav for medium (tablet)
- [x] Width of side menu should change for above/below medium (tablet)

### Minor :exclamation:
- [x] IE - Open side-menu always jumps to page top
- [ ] IE - Open side-menu translate does not transition all necessary elements (but close does)
- [x] Header buttons and search fade in/out on scroll and side menu open/close events
- [ ] IE - Header buttons and search fading in/out appear to fire twice
- [x] On side menu open the main page contents lacks a scroll bar
- [ ] IE - On side menu close brief flash of content
- [ ] Subtle sticky header transition difference: transitions should fire when scroll events stop, not immediately
- [ ] IE, FF - *Very slight* carousel button positional differences
