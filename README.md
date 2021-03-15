# build-netmatters-site
JS reflection:
- Banner slider
- Mobile menu
- Sticky header
- Cookies Pop-up (store locally to prevent reappearing on page reload)

## Notes to reviewer
- JS has been compiled to ES5 without comments - see js/uncompiled for commented and documented code.
- Due to being on Mac, my initial HTML/CSS reflection was completed with limited IE testing and several IE bugs present (lack of ability to test was considered at submission). Since then i've been able to test on IE and have tried to fix all major HTML/CSS issues not relating to this reflection, but some other bugs may persist.

## Known issues (last updated 15/03/21 16:21)

### Major
- [x] When user closes cookies modal, carousel position is off
- [x] Carousel positioning incorrect when opening index.html in browser via filepath instead of localhost
- [x] On some tablets and mobile devices carousel height is incorrect
- [x] IE - No JS is triggered
- [x] IE - Opening menu causes overlay to sit above side-menu
- [x] IE - Open side-menu - various major layout issues

### Minor
- [x] IE - Open side-menu always jumps to page top
- [ ] IE - Open side-menu does not transition (but close does)
