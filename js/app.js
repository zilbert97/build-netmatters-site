// Cookies modal
checkAcceptCookies();           // see js/cookies.js

// Sticky header
const header = $('#sticker');
let scrollSpy = createScrollSpy(header);        // see js/stickyHeader.js

// Carousel
$(document).ready(function(){
  $(".slider").simpleSlider({
    interval: 4000,
    animateDuration: 300
  });
});

class SideMenu {
  constructor() {
    this.scrollPosition = window.scrollY;
  }
  set scrollPosition(scrollPosition) {
    this._scrollPosition = scrollPosition;
  }
  get scrollPosition() {
    return this._scrollPosition;
  }


  showHideMobileNav() {
    const page = $('#page-content');
    page.toggleClass('mobile-nav-open');

    const header = $('#sticker');
    const headerHeight = parseInt(header.css('height'));

    // If closed, in the process of being opened
    if (page.hasClass('mobile-nav-open')) {

      // Call the setter method to set the current scroll position
      this.scrollPosition = window.scrollY;

      // Disable scrollspy event listening
      $(window).off('scroll');

      // Set styles to adjust page position
      page.css({
        'transform': 'translateX(-275px)',
        'position': 'fixed',
        'overflow': 'hidden',
        'top': `-${this.scrollPosition}px`        // Keep position on page (otherwise jumpos to top)
      });


      const headerStent = $('<div id="headerStent"></div>').css({
        height: `${headerHeight}px`,
        width: '100%',
        display: 'block',
      });

      // If scrolled past the height of the header element
      if (this.scrollPosition > headerHeight) {
        header.removeClass('slide-up slide-down');

        // Stop the header from being sticky, removing its sticky wrapper
        header.unstick()

        // As the header is by deafult at the top of the page, set its parent
        // to be position relative so that we can set the position of the
        // header to be absolute, a certain number of pixels (the known scroll
        // position) from the top of the page
        header.parent().css('position', 'relative');

        // When we take the header out of the document flow its container will
        // collapse - therefore provide an element as a placeholder
        header.parent().prepend(headerStent);

        // Remove element from the document flow
        header.css({
          position: 'absolute',
          top: `${this.scrollPosition}px`,
          right: '0',
          zIndex: 5000,
          width: '100%'  // Added due to bug where width would be smaller on open
        });
      }

      // Ensure the scroll position of the side menu is at the top
      window.scroll(0, 0);
    }

    // If open, in the process of being closed
    else {
      // Remove styles that adjusted page position, i.e. put back in place
      page.removeAttr('style');

      // Remove any instance of the header stent that was added when the side
      // menu was opened
      $('#headerStent').remove();

      // Scroll down to the last known scroll position
      window.scroll(0, this.scrollPosition);

      if (this.scrollPosition > headerHeight) {
        // Re-enable sticky behaviour
        makeSticky(header);
      }

      // On first scroll
      $(window).one('scroll', function() {
        // Re-enable scrollspy event listening
        createScrollSpy(header);
      });
    }
  }
}

const sideNavHandler = new SideMenu();

$('#hamburger-button').click(function () {
  sideNavHandler.showHideMobileNav();
});
