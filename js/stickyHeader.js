function makeSticky(target) {
  /**
   * Initialises an element to be sticky (such as a header).
   *
   * @param {element} target - the element that will be made sticky when called
   */

  $(document).ready(() => {
    target.sticky({
      topSpacing: 0,
      zIndex: 5000,            // Ensures sits above all other elements on page
      getWidthFrom: 'body',    // Prevents bug where resizing causes x-overflow/scroll
      responsiveWidth: true
    });
  });
}


function createScrollSpy(target) {
  /**
   * Creates an instance of listening for scroll events to show/hide header.
   *
   * Closure that returns a function to listen for user scrolling, and on
   * scroll direction change shows or hides a DOM element. If past the height
   * of the element, on scroll down the element is slid up out of view, while
   * on scroll up the element is slid down into view.
   *
   * @param {element} target - the element that will be manipulated on scroll
   *
   * @return {function}      - event listener to listen for scroll events and
   *                           show/hide the target element via animation if
   *                           scroll direction has changed.
   */

  // Remember the last scroll position
  let lastScrollTop = 0;

  // Save processing by only executing on scroll direction change
  let lastDirection = null;

  return $(window).scroll(() => {
    // On scroll event set the scroll position
    let scrollTop = $(this).scrollTop();

    // Get the height (in px) of the target element as a number. Helps with
    // responsiveness as this may change at different breakpoints.
    const targetHeight = parseInt(target.css('height'));

    // If at top of the page
    if (scrollTop === 0) {
      target.unstick();
      target.removeClass('slide-up slide-down');
    }

    // If scrolled past the height of the target element
    else if (scrollTop > targetHeight) {

      // On scroll down
      if (scrollTop > lastScrollTop) {

        // If changed direction of scroll
        if (lastDirection !== 'down') {
          target.addClass('slide-up').removeClass('slide-down');
        }

        lastDirection = 'down';
      }

      // On scroll up, if changed direction of scroll
      else if (lastDirection !== 'up') {

        // Show the header
        target.addClass('slide-down').removeClass('slide-up');
        makeSticky(target);

        lastDirection = 'up';
      }

      lastScrollTop = scrollTop;
    }
  });
}
