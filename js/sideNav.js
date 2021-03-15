"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var SideMenu = /*#__PURE__*/function () {
  function SideMenu() {
    _classCallCheck(this, SideMenu);

    this.scrollPosition = window.scrollY;
    this.isSticky = null;

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
      this.page.toggleClass('mobile-nav-open');
      var header = $('#sticker');
      var headerHeight = parseInt(header.css('height'));

      if (this.page.hasClass('mobile-nav-open')) {
        if (header.parent().hasClass('is-sticky')) {
          this.headerIsSticky = true;
        } else {
          this.headerIsSticky = false;
        }

        this.scrollPosition = window.scrollY;

        $(window).off('scroll');

        this.page.css({
          transform: 'translateX(-275px)',
          position: 'fixed',
          overflow: 'hidden',
          top: "-".concat(this.scrollPosition, "px"),
          transitionProperty: 'transform',
          transition: '0.5s'
        });

        var headerStent = $('<div id="headerStent"></div>').css({
          height: "".concat(headerHeight, "px"),
          width: '100%',
          display: 'block'
        });

        if (this.headerIsSticky) {
          header.removeClass('slide-up slide-down');

          header.unstick();

          header.parent().css('position', 'relative');

          header.parent().prepend(headerStent);

          header.css({
            position: 'absolute',
            top: "".concat(this.scrollPosition, "px"),
            right: '0',
            zIndex: 5000,
            width: '100%'

          });

          window.scroll(0, 0);
        }
      } else {
          this.page.css({
            transform: 'translateX(0)',
            transitionProperty: 'transform',
            transition: '0.5s'
          });

          setTimeout(function () {
            this.page.removeAttr('style');

            $('#headerStent').remove();

            if (this.headerIsSticky) {
              makeSticky(header);
            }

            window.scroll(0, this.scrollPosition);

            $(window).one('scroll', function () {
              createScrollSpy(header);
            });
          }.bind(this), 500);
        }
    }
  }, {
    key: "triggerSideNav",
    value: function triggerSideNav() {
      var show = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      var pageCover = $('#page-cover');

      this.showHideMobileNav();

      setTimeout(function () {
        this.button.toggleClass('is-active');
      }.bind(this), 5);

      if (show) {
        pageCover.css('display', 'block');

        setTimeout(function () {
          pageCover.css('opacity', '1');
        }, 5);
      } else {
        pageCover.css({
          opacity: 0
        });

        setTimeout(function () {
          pageCover.css('display', 'none');
        }, 500);
      }
    }
  }]);

  return SideMenu;
}();
