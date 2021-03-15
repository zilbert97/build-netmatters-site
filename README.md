# build-netmatters-site
JS reflection:
- Banner slider
- Mobile menu
- Sticky header
- Pop-up notifying the user the website uses cookies, this should store locally and prevent the pop-up reappearing on page reload

## Known issues (last updated 15/03/21 09:10)

### Major :bangbang:
- [x] When user closes cookies modal, carousel position is off
- [x] Carousel positioning incorrect when opening index.html in browser via filepath instead of localhost
- [x] On some tablets and mobile devices carousel height is incorrect
- [ ] Not tested for IE

### Minor :heavy_exclamation_mark:
- [ ] Header buttons refresh (transitions in opacity with their changes in visibility and display properties)
- [ ] On open side nav while header is sticky followed by close, first scroll-up triggers header slide-down once
- [ ] Carousel digital marketing button very wide - overflows the carousel slide
