$(document).ready(function(){
  //===== Cookies modal - js/cookies.js =====
  checkAcceptCookies();

  //===== Carousel =====
  $('.slider').simpleSlider({
    interval: 4000,
    animateDuration: 300
  });

  //===== Sticky header - js/stickyHeader.js =====
  const scrollSpy = createScrollSpy($('#sticker'));

  //===== Side menu - js/sideNav.js =====
  const sideNavHandler = new SideMenu();

  // Add a black alpha overlay to the DOM (set to hidden) for use in open/close
  $('#page-content').append(
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

  const hamburgerButton = $('#hamburger-button');
  hamburgerButton.on('click', function(event) {
    sideNavHandler.triggerSideNav(true);
  });

  // There was a bug where double-clicking the cover would cause the side nav
  // and header to do unexpected behaviours. Using a setTimeout and a gate to
  // wait until processes complete before allowing another event to fire
  const pageCover = $('#page-cover');
  let shouldRespond = true;

  pageCover.on('click', function(event) {
    if (shouldRespond) {
      sideNavHandler.triggerSideNav(false);
      shouldRespond = false;
      setTimeout(function() {
        shouldRespond = true;
      }, 500);
    }
  });
});
