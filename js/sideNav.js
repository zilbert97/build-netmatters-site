"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var SideMenu = /*#__PURE__*/function () {
  /**
   *
   */
  // scroll position and sticky status are being defined here, with getters and
  // setters, because their values need to be remembered at the start of the
  // open event and used on the close event (between which changes to the DOM
  // are made)
  function SideMenu() {
    _classCallCheck(this, SideMenu);

    this.scrollPosition = window.scrollY;
    this.isSticky = null; // This is set to true on open event

    this.page = $('#page-content');
    this.button = $('#hamburger-button');
  }

  _createClass(SideMenu, [{
    key: "scrollPosition",
    get: function get() {
      return this._scrollPosition;
    },
    set: function set(scrollPosition) {
      this._scrollPosition = scrollPosition;
    }
  }, {
    key: "headerIsSticky",
    get: function get() {
      return this._headerIsSticky;
    },
    set: function set(headerIsSticky) {
      this._headerIsSticky = headerIsSticky;
    }
  }, {
    key: "showHideMobileNav",
    value: function showHideMobileNav() {
      /**
       * Shows and hides the side nav, adjusting the rest of the page with it
       *
       */
      this.page.toggleClass('mobile-nav-open');
      var header = $('#sticker');
      var headerHeight = parseInt(header.css('height')); //====================
      // OPEN THE SIDE MENU
      //====================

      if (this.page.hasClass('mobile-nav-open')) {
        // Set sticky status at start of open side menu (because always unstuck
        // during open)
        if (header.parent().hasClass('is-sticky')) {
          this.headerIsSticky = true;
        } else {
          this.headerIsSticky = false;
        } // Call the setter method to set the current scroll position


        this.scrollPosition = window.scrollY; // Disable scrollspy event listening - otherwise scrolling the side menu
        // causes header slide up/down transition

        $(window).off('scroll'); // Set styles to adjust page position

        this.page.css({
          transform: 'translateX(-275px)',
          position: 'fixed',
          overflow: 'hidden',
          top: "-".concat(this.scrollPosition, "px"),
          // Keep position on page (otherwise jumpos to top)
          transitionProperty: 'transform',
          transition: '0.5s'
        }); // Define a 'stent', which is the same size as the header element and
        // will replace it while the header is taken out of the element flow

        var headerStent = $('<div id="headerStent"></div>').css({
          height: "".concat(headerHeight, "px"),
          width: '100%',
          display: 'block'
        }); // If header is sticky

        if (this.headerIsSticky) {
          header.removeClass('slide-up slide-down'); // Stop the header from being sticky, removing its sticky wrapper

          header.unstick(); // As the header is by deafult at the top of the page, set its parent
          // to be position relative so that we can set the position of the
          // header to be absolute, a certain number of pixels (the known scroll
          // position) from the top of the page

          header.parent().css('position', 'relative'); // When we take the header out of the document flow its container will
          // collapse - therefore provide an element as a placeholder

          header.parent().prepend(headerStent); // Remove element from the document flow

          header.css({
            position: 'absolute',
            top: "".concat(this.scrollPosition, "px"),
            right: '0',
            zIndex: 5000,
            width: '100%' // Added due to bug where width would be smaller on open

          }); // Ensure the scroll position of the side menu is at the top

          window.scroll(0, 0);
        }
      } //=====================
      // CLOSE THE SIDE MENU
      //=====================
      else {
          // Re-translate page back into place
          this.page.css({
            transform: 'translateX(0)',
            transitionProperty: 'transform',
            transition: '0.5s'
          }); // After translate transition, do cleanup

          setTimeout(function () {
            // Remove styles that adjusted page position
            this.page.removeAttr('style'); // Remove any instance of the header stent that was added when the side
            // menu was opened

            $('#headerStent').remove(); // If header was sticky at open, make it sticky again at close

            if (this.headerIsSticky) {
              makeSticky(header);
            } // Scroll down to the last known scroll position


            window.scroll(0, this.scrollPosition); // On first scroll

            $(window).one('scroll', function () {
              // Re-enable scrollspy event listening
              createScrollSpy(header);
            });
          }.bind(this), 500);
        }
    }
  }, {
    key: "triggerSideNav",
    value: function triggerSideNav() {
      var show = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      var pageCover = $('#page-cover'); // Call the show/hide method

      this.showHideMobileNav(); // Trigger hamburger animation. Timeout required - otherewise when sticky,
      // transition appears instant

      setTimeout(function () {
        this.button.toggleClass('is-active');
      }.bind(this), 5); // Whether to show/hide the overlay

      if (show) {
        // Show the element in the DOM (opacity is already set to 0)
        pageCover.css('display', 'block'); // Make visible after click (setTimeout required else acts immediately)

        setTimeout(function () {
          pageCover.css('opacity', '1');
        }, 5);
      } else {
        // Make visibly hidden over 500ms
        pageCover.css({
          opacity: 0
        }); // After made visible, hide element from DOM

        setTimeout(function () {
          pageCover.css('display', 'none');
        }, 500);
      }
    }
  }]);

  return SideMenu;
}();
