# build-netmatters-site
My HTML and CSS review

## To-do:

### Phase 1 - missing content:
- [x] Apply set-content-width mixin to nav, jumbo, and service cards (if applicable)
- [x] Add box shadow to Google Partner logo
- [x] Add description boxes for clients and news card categories on hover state
- [x] Add sub-navigation
- [x] Jumbotron owl buttons

### Pahse 2 - layout tweaks and other minor changes:
- [ ] Remove transition from Hamburger
- [ ] Remove background from page title logo
- [ ] Search icon is too small - look to change or increase size while maintaining 23px font size
- [ ] Hide checkbox overlay when search is expanded at the large breakpoint
- [ ] Navigation text vertical position
- [ ] Jumbotron border top colour
- [x] Jumbotron gradient ***Still not 100% identical but a closer approximation***
- [ ] Slight difference in button size and position

###### Header
- [ ] Site logo size
- [ ] Vertical positioning of text in header buttons
- [ ] Positioning within hamburger
- [ ] Search placehodler text alignment, and colour?

###### Cards
- [ ] Glyph size
- [ ] Paragraph wrapping
- [ ] Minor differences in the positioning of card content

###### About section
- [ ] Body text wrapping
- [ ] Button height
- [ ] Very slight difference in section height
- [ ] Very slight background image position difference

###### Latest news cards
- [ ] Title tab - position of items slightly right
- [ ] Bar position slightly too low
- [ ] Bar box-shadow causing a not-sharp-enough look
- [ ] Category tag - move right by 1px
- [ ] Images sightly smaller, because positioned within a border - consider changing box-sizing to content-box?
- [ ] Card title margin-bottom needs extending
- [ ] Button size needs to be slightly larger

###### Footer
- [ ] At XL breakpoint slight vertical positioning of logos
- [ ] Main footer positioning of text and buttons
- [ ] Height, size and positioning of accreditation images

### Phase 3 - streamlining Sass/CSS:
- [ ] Look at condensing media queries - e.g. breakpoints assigning width of items at 750px, 970px, 1200px (M/L/XL)
- [ ] Look at condensing button base styles
- [ ] Assess whether a base card style could be established
- [ ] Split Sass into partials for each major section?

### Phase 4 - final checks before submission:
- [ ] Research and integrate best practices for accessibility of HTML
- [ ] Go through selectors and properties, check usable with caniuse.com
- [ ] Remove bootstrap function from jumbotron (consider needing to re-introduce bootstrap)
