# build-netmatters-site
JS reflection:
- Banner slider
- Mobile menu
- Sticky header
- Pop-up notifying the user the website uses cookies, this should store locally and prevent the pop-up reappearing on page reload

## Known issues:

### Major :bangbang:
- [x] When user closes cookies modal, carousel position is off
- [x] Carousel positioning incorrect when opening index.html in browser via filepath instead of localhost
- [ ] Carousel markers too high on some mobile views
- [ ] On some tablets and mobile devices carousel height is incorrect
- [ ] Not tested for IE
- [ ] Header buttons refresh (transitions in opacity with their changes in visibility and display properties)
- [ ] Carousel digital marketing button wraps strange - too big

### Minor :heavy_exclamation_mark:
- [ ] Header buttons refresh (transitions in opacity with their changes in visibility and display properties)
- [ ] On open side nav while header is sticky followed by close, first scroll-up triggers header slide-down once
