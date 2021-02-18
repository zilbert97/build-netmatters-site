function createScrollSpy() {
  let lastScrollTop = 0;

  // Save processing by only executing on scroll direction change
  let lastDirection = null;

  return $(window).scroll(() => {
    let scrollTop = $(this).scrollTop();

    // Scrolls down
    if (scrollTop > lastScrollTop) {

      if (lastDirection !== 'down') {
        $('#sticker').addClass('slide-up');
        $('#sticker').removeClass('slide-down');

        setTimeout(() => {
          $('#sticker').unstick();
          lastDirection = 'down';
        }, 300);
      }
    }

    // Scrolls up
    else if (lastDirection !== 'up') {
      // Show the header
      $('#sticker').addClass('slide-down');
      $('#sticker').removeClass('slide-up');

      $(document).ready(() => {
        $('#sticker').sticky({
          topSpacing: 0,
          zIndex: 5000
        });
      });
      lastDirection = 'up';
    }

    lastScrollTop = scrollTop;
  });
}
