function makeSticky(target) {

  $(document).ready(() => {
    target.sticky({
      topSpacing: 0,
      zIndex: 5000,            // Ensures sits above all other elements on page
      getWidthFrom: 'body',    // Prevents bug where resizing causes x-overflow/scroll
      responsiveWidth: true
    });
  });
}


function createScrollSpy() {
  const stickyTarget = $('#sticker');
  //makeSticky(stickyTarget);

  let lastScrollTop = 0;

  // Save processing by only executing on scroll direction change
  let lastDirection = null;

  return $(window).scroll(() => {
    let scrollTop = $(this).scrollTop();

    // If at top of the page
    if (scrollTop === 0) {
      stickyTarget.unstick();
      stickyTarget.removeClass('slide-up slide-down');
    }

    // If past header height
    else if (scrollTop > 211) {

      // On scroll down
      if (scrollTop > lastScrollTop) {

        // If changed direction of scroll
        if (lastDirection !== 'down') {
          stickyTarget.addClass('slide-up').removeClass('slide-down');
        }

        lastDirection = 'down';
      }

      // On scroll up, if changed direction of scroll
      else if (lastDirection !== 'up') {

        // Show the header
        stickyTarget.addClass('slide-down').removeClass('slide-up');
        makeSticky(stickyTarget);

        lastDirection = 'up';
      }

      lastScrollTop = scrollTop;

    }
  });
}




function createMediaQuery(on, width, callback) {
  const mediaQuery = window.matchMedia(`(${on}: ${width}px)`);
  // Watch for event and execute code passed in the callback
  mediaQuery.addListener(callback);
}

// Fix bug where changing width causes incorrect adjustment of header height.
createMediaQuery('min-width', 768, (event) => {
  console.log('Changed');
});

  /*
  const stickyWrapper = $('#sticker-sticky-wrapper');

  // Medium breakpoint (~ tablet) or above
  if (event.matches) {
    stickyWrapper.css('height', '95px');
  }
  // Mobile (below medium breakpoint)
  else {
    stickyWrapper.css('height', '130px');
  }
  */


// When MQ changed: uopdate


// Google Chrome
// XL: 211
// M : 110
// S : 171
