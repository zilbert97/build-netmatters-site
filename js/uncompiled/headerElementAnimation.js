const createHeaderAnimator = function() {
  /**
   * Listens to screen width and applies animations to header elements.
   *
   * Listens to media query changes, and applies a function to set CSS
   * animations that fade in/out header buttons/input fields based on the
   * checked status of an invisible checkbox overlay in the header. The
   * function applied to the media query listener is also returned to be
   * executed on a click event firing.
   *
   * @return {function} - sets the animation style for the header button
   *                      and search input fields. Intended to be triggered
   *                      on an event firing (like a click event).
   */

  const mediaQuery = window.matchMedia('(max-width: 1260px) and (min-width: 992px)');
  const searchButton = $('#search-button');
  const searchInput = $('#search-input');
  const buttonsContainer = $('#buttons-container');

  const fadeIn = {
    'animation'           : 'fade-in ease-in-out .6s',
    '-webkit-animation'   : 'fade-in ease-in-out .6s',
    '-moz-animation'      : 'fade-in ease-in-out .6s',
    '-o-animation'        : 'fade-in ease-in-out .6s',
    '-ms-animation'       : 'fade-in ease-in-out .6s',
    'transition-delay'    : '.3s',
    'transition-property' : 'visibility',
    'visibility'          : 'visible'
  };
  const fadeOut = {
    'animation'           : 'fade-out ease-in-out .3s',
    '-webkit-animation'   : 'fade-out ease-in-out .3s',
    '-moz-animation'      : 'fade-out ease-in-out .3s',
    '-o-animation'        : 'fade-out ease-in-out .3s',
    '-ms-animation'       : 'fade-out ease-in-out .3s',
    'transition-delay'    : '.3s',
    'transition-property' : 'visibility',
    'visibility'          : 'hidden'
  };
  const noAnimation = {
    'animation'           : '',
    '-webkit-animation'   : '',
    '-moz-animation'      : '',
    '-o-animation'        : '',
    '-ms-animation'       : '',
    'transition-delay'    : '',
    'transition-property' : '',
  }

  function applyStyles() {
    /**
     * Add animations to buttons/search for the header toggle activity.
     * @return {void} - Nothing.
     */

    if (mediaQuery.matches) {
      if (document.getElementById('toggle').checked) {
        searchButton.css({
          transition: 'border-radius .2s ease-out .2s',
          borderRadius: '0 3px 3px 0'
        });

        searchInput.css(fadeIn);
        buttonsContainer.css(fadeOut);

        // After execution, remove animations/transitions - otherwise
        // elements will fade in/out on menu open/close and header sticking
        setTimeout(function() {
          searchButton.css('transition', '');
          searchInput.css(noAnimation);
          buttonsContainer.css(noAnimation);
        }, 600);

      } else {
        searchButton.css({
          transition: '',
          borderRadius: ''
        });

        searchInput.css(fadeOut);
        buttonsContainer.css(fadeIn);

        setTimeout(function() {
          searchInput.css(noAnimation);
          buttonsContainer.css(noAnimation);
        }, 600);
      }
    } else {
      searchButton.removeAttr('style');
      searchInput.removeAttr('style');
      buttonsContainer.removeAttr('style');
    }
  }

  // Listen for media query and apply animations
  mediaQuery.addListener(applyStyles);

  return applyStyles;
}

// Add to app.js
const animateHeaderElements = createHeaderAnimator();

$('#toggle').click(function() {
  animateHeaderElements();
});
