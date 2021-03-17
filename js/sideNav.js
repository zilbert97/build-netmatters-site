/**
 * The side menu handler class.
 *
 * This file defines the SideMenu class, which controls the opening/closing of
 * the side navigation for the Netmatters site JS reflection.
 *
 * @link   /js/uncompiled/sideNav.js
 * @file   This files defines the SideMenu class.
 * @author Zach Gilbert.
 */


class SideMenu {
  /**
   * Calls, opens, and closes the site side-navigation menu.
   *
   * Requires that the entire page contents that are to be moved by the menu
   * open/close be wrapped in a container (prefferably a <div>) with the ID
   * "page-content".
   *
   * @type {object}
   * @property {number} scrollPosition - the last known vertical scroll
   *                                     position of the page contents.
   * @property {boolean} isSticky      - whether, at the time of menu opening,
   *                                     the sticky header is sticky.
   * @property {element} page          - the container (with ID "page-content"
   *                                     wrapping the page contents to be moved
   *                                     by the open/close of the side menu.
   * @property {element} button        - the button element (with ID "hamburger
   *                                     -button") which opens the side menu.
   *
   */

  // Scroll position and sticky status are being defined here, with getters and
  // setters, because their values need to be remembered at the start of the
  // open event and used on the close event (between which changes to the DOM
  // are made).

  constructor() {
    this.scrollPosition = window.pageYOffset;
    this.isSticky = null;   // This is set to true on open event
    this.page = $('#page-content');
    this.button = $('#hamburger-button');
    this.mediaQuery = window.matchMedia('(min-width: 992px)');

    /**
     * Listen for viewport width change and adjust the side nav width if open.
     *
     * Adjusts the perceived side nav width by moving the page contents. This
     * only occurs if the side nav is already open. These changes are instant
     * without any transition.
     *
     * @return {void} - Nothing.
     */
    this.init = function() {
      // Add a black alpha overlay to the DOM (set to hidden) for use in open/close
        $('#page-content').parent().append(
          $('<div id="page-cover"></div>').css({
            display: 'none',
            position: 'fixed',
            top: 0,
            right: 0,
            width: '100%',
            height: '100%',
            backgroundColor: 'rgba(0,0,0,.5)',
            cursor: 'pointer',
            zIndex: 5001,
            opacity: 0,
            transitionPorperty: 'opacity',
            transition: '0.5s'
          })
        );

      // Listen for changes in viewport width above/below L breakpoint (992px)
      this.mediaQuery.addListener(function() {

        // If the side nav is open
        if (this.page.hasClass('mobile-nav-open')) {

          // Adjust apparent width of the side nav (by moving page contents)
          // Transition is removed for instant change on viewport width change
          this.page.css({
            transform: `translateX(-${this.sideNavWidth()}px)`,
            transitionProperty: '',
            transition: ''
          });

          $('#page-cover').css({
            transform: `translateX(-${this.sideNavWidth()}px)`,
            transitionProperty: 'opacity',
          });
        }
      }.bind(this));
    }.bind(this);

    this.init();
  }

  /**
   * Set the horizontal scroll position.
   * @return {void} - Nothing.
   */
  set scrollPosition(scrollPosition) {
    this._scrollPosition = scrollPosition;
  }
  /**
   * Get the most recently recorded horizontal scroll position.
   * @return {number} - The ScrollY position
   */
  get scrollPosition() {
    return this._scrollPosition;
  }

  /**
   * Set the sticky state of the sticky header as bool.
   * @return {void} - Nothing.
   */
  set headerIsSticky(headerIsSticky) {
    this._headerIsSticky = headerIsSticky;
  }
  /**
   * Get the sticky state of the sticky header.
   * @return {bool} - Whether the last known state of the header is sticky (true)
   *                  or static (false)
   */
  get headerIsSticky() {
    return this._headerIsSticky;
  }

  /**
   * Shows and hides the side nav, adjusting the rest of the page with it.
   *
   * Opens and closes the side menu, by toggling a class for the page contents
   * and adjusting the page contents position. This also requires adapting the
   * sticky header stickyness and page position based on scroll location.
   *
   * @return {void} Nothing.
   */
  showHideMobileNav() {
    this.page.toggleClass('mobile-nav-open');

    const header = $('#sticker');
    const headerHeight = parseInt(header.css('height'));

    //====================
    // OPEN THE SIDE MENU
    //====================
    if (this.page.hasClass('mobile-nav-open')) {

      // Set sticky status at start of open side menu (because always unstuck
      // during open)
      if (header.parent().hasClass('is-sticky')) {
        this.headerIsSticky = true;
      } else {
        this.headerIsSticky = false;
      }

      // Call the setter method to set the current scroll position
      this.scrollPosition = window.pageYOffset;

      // Disable scrollspy event listening - otherwise scrolling the side menu
      // causes header slide up/down transition
      $(window).off('scroll');

      // Set styles to adjust page position
      this.page.css({
        transform: `translateX(-${this.sideNavWidth()}px)`,
        position: 'fixed',
        overflowY: 'scroll',
        overflowX: 'hidden',
        top: `-${this.scrollPosition}px`,  // Keep position on page (otherwise jumpos to top)
        width: '100%',
        minHeight: '100%',
        transitionProperty: 'transform',
        transition: '500ms'
      });

      // Define a 'stent', which is the same size as the header element and
      // will replace it while the header is taken out of the element flow
      const headerStent = $('<div id="header-stent"></div>').css({
        height: `${headerHeight + 25}px`,
        width: '100%',
        display: 'block',
        backgroundColor: '#fff'
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
      // Re-translate page back into place
      this.page.css({
        transform: 'translateX(0)',
        transitionProperty: 'transform',
        transition: '500ms'
      });

      // After translate transition, do cleanup
      setTimeout(function() {
        // Remove styles that adjusted page position
        this.page.removeAttr('style');

        // Remove any instance of the header stent that was added when the side
        // menu was opened
        $('#header-stent').remove();

        // If header was sticky at open, make it sticky again at close
        if (this.headerIsSticky) {
          makeSticky(header);
        }

        // Scroll down to the last known scroll position
        window.scroll(0, this.scrollPosition);

        // On first scroll
        $(window).one('scroll', function() {
          // Re-enable scrollspy event listening
          createScrollSpy(header);
        });

      }.bind(this), 510);
    }
  }

  /**
   * Calls the open/close of the side menu based on click events.
   *
   * Intended to be triggered upon click events on the hamburger button and the
   * overlay (on open) to open/close the side menu. Opening and closing
   * triggers the hamburger button icon animation. Opening shows the overlay to
   * prevent UI with the page contents, which once clicked triggers closing of
   * the side menu.
   *
   * @param {bool} show - whether to show or hide the overlay.
   *
   * @return {void} - Nothing.
   */
  triggerSideNav(show = false) {
    const pageCover = $('#page-cover');

    // Call the show/hide method
    this.showHideMobileNav();

    // Trigger hamburger animation. Timeout required - otherewise when sticky,
    // transition appears instant
    setTimeout(function() {
      this.button.toggleClass('is-active');
    }.bind(this), 15);

    // Whether to show/hide the overlay
    if (show) {
      // Show the element in the DOM (opacity is already set to 0)
      pageCover.css('display', 'block');
      // Make visible after click (setTimeout required else acts immediately)
      setTimeout(function() {
        pageCover.css({
          transitionProperty: 'opacity, transform',
          opacity: 1,
          transform: `translateX(-${this.sideNavWidth()}px)`
        });
      }.bind(this), 15);
    } else {
      // Make visibly hidden over 500ms
      pageCover.css({
        opacity: 0,
        transform: `translateX(0)`
      });
      // After made visible, hide element from DOM
      setTimeout(function() {
        pageCover.css('display', 'none');
      }, 510);
    }
  }

  /**
   * Sets the width of the side navigation menu
   *
   * Uses a media query from this class' constructor to look at the viewport
   * size, and return the width for the side navigation.
   *
   * @return {number} - 335 or 275, depending on viewport size.
   */
  sideNavWidth() {
    // If side nav is at L/XL (desktop) breakpoint
    if (this.mediaQuery.matches) {
      return 335;
    }
    // Else if below L breakpoint (mobile/tablet devices)
    else {
      return 275;
    }
  }
}
