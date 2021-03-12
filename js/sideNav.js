class SideMenu {
  /**
   *
   */

  // scroll position and sticky status are being defined here, with getters and
  // setters, because their values need to be remembered at the start of the
  // open event and used on the close event (between which changes to the DOM
  // are made)

  constructor() {
    this.scrollPosition = window.scrollY;
    this.isSticky = null;   // This is set to true on open event
  }
  set scrollPosition(scrollPosition) {
    this._scrollPosition = scrollPosition;
  }
  get scrollPosition() {
    return this._scrollPosition;
  }

  set headerIsSticky(headerIsSticky) {
    this._headerIsSticky = headerIsSticky;
  }
  get headerIsSticky() {
    return this._headerIsSticky;
  }

  showHideMobileNav() {
    /**
     *
     */

    const page = $('#page-content');
    page.toggleClass('mobile-nav-open');

    const header = $('#sticker');
    const headerHeight = parseInt(header.css('height'));

    //====================
    // OPEN THE SIDE MENU
    //====================
    if (page.hasClass('mobile-nav-open')) {

      // Set sticky status at start of open side menu (because always unstuck
      // during open)
      if (header.parent().hasClass('is-sticky')) {
        this.headerIsSticky = true;
      } else {
        this.headerIsSticky = false;
      }

      // Call the setter method to set the current scroll position
      this.scrollPosition = window.scrollY;

      // Disable scrollspy event listening - otherwise scrolling the side menu
      // causes header slide up/down transition
      $(window).off('scroll');

      // Set styles to adjust page position
      page.css({
        transform: 'translateX(-275px)',
        position: 'fixed',
        overflow: 'hidden',
        top: `-${this.scrollPosition}px`        // Keep position on page (otherwise jumpos to top)
      });

      // Define a 'stent', which is the same size as the header element and
      // will replace it while the header is taken out of the element flow
      const headerStent = $('<div id="headerStent"></div>').css({
        height: `${headerHeight}px`,
        width: '100%',
        display: 'block',
      });

      // If header is sticky
      if (this.headerIsSticky) {
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

        // Ensure the scroll position of the side menu is at the top
        window.scroll(0, 0);
      }
    }

    //=====================
    // CLOSE THE SIDE MENU
    //=====================
    else {
      // Remove styles that adjusted page position, i.e. put back in place
      page.removeAttr('style');

      // Remove any instance of the header stent that was added when the side
      // menu was opened
      $('#headerStent').remove();

      // If header was sticky at side menu open, re-enable header stickyness
      if (this.headerIsSticky) {
        // Make header sticky again
        makeSticky(header);
      }

      // Scroll down to the last known scroll position
      window.scroll(0, this.scrollPosition);

      // On first scroll
      $(window).one('scroll', function() {
        // Re-enable scrollspy event listening
        createScrollSpy(header);
      });
    }
  }
}
