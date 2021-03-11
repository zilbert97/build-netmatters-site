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
    let page = $('#page-content');
    page.toggleClass('mobile-nav-open');

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

      //=======================================
      let targetHeight = parseInt($('#sticker').css('height'));

      // If scrolled past the height of the target element
      if (this.scrollPosition > targetHeight) {
        $('#sticker').removeClass('slide-up slide-down');

        // If still jQuery-sticky, #sticker is the only child wrapped by a
        // #sticker-sticky-wrapper. Calling .unstick() removes that wrapper -
        // as a result #sticker is not the only child in the parent. This is
        // important because in order for `position: sticky` to work the
        // element must not be an only child.
        $('#sticker').unstick();

        $('#sticker').css({
          position: 'sticky',
          top: this.scrollPosition,
          zIndex: 100000000
        });
        //$('#sticker').sticky({topSpacing: targetHeight}).sticky('update');
        // #sticker is the only element inside its wrapper (sticker-sticky-wrapper)
      }
      //=======================================

      // Ensure the scroll position of the side menu is at the top
      window.scroll(0, 0);
    }

    // If open, in the process of being closed
    else {
      // Remove styles that adjusted page position, i.e. put back in place
      page.removeAttr('style');

      // Scroll down to the last known scroll position
      window.scroll(0, this.scrollPosition);

      $('#sticker').sticky('update');

      // Re-enable scrollspy event listening
      createScrollSpy(header);
    }
  }
}

const sideNavHandler = new SideMenu();

$('#hamburger-button').click(function () {
  sideNavHandler.showHideMobileNav();
});
