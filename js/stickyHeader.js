function createScrollSpy() {
  let lastScrollTop = 0;

  // Save processing by only executing on scroll direction change
  let lastDirection = null;

  return $(window).scroll(function(event) {
    let scrollTop = $(this).scrollTop();

    // Scrolls down
    if (scrollTop > lastScrollTop) {

      if (lastDirection !== 'down') {
        $('#sticker').unstick();
        lastDirection = 'down';
      }
    }

    // Scrolls up
    else {
      if (lastDirection !== 'up') {
        // Show the header
        $(document).ready(() => {
          $('#sticker').sticky({
            topSpacing: 0,
            zIndex: 5000
          });
        });
        lastDirection = 'up';
      }
    }

    lastScrollTop = scrollTop;
  });
}
