$(document).ready(function(){
  //===== Cookies modal - js/cookies.js =====
  checkAcceptCookies();

  //===== Carousel =====
  $(".slider").simpleSlider({
    interval: 4000,
    animateDuration: 300
  });

  //===== Sticky header - js/stickyHeader.js =====
  const scrollSpy = createScrollSpy($('#sticker'));

  //===== Side menu - js/sideNav.js =====
  const sideNavHandler = new SideMenu();

  // Add a black alpha overlay to the DOM (set to hidden) for use in open/close
  $('#page-content').append($('<div id="page-cover"></div>').css({
    display: 'none',
    position: 'fixed',
    top: 0,
    right: 0,
    width: '100%',
    height: '100%',
    backgroundColor: 'rgba(0,0,0,.5)',
    cursor: 'pointer',
    zIndex: 5001
  }));

  const hamburgerButton = $('#hamburger-button');
  hamburgerButton.on('click', function() {
    sideNavHandler.triggerShowHideSideNav(true);
  });

  const pageCover = $('#page-cover');
  pageCover.on('click', function() {
    sideNavHandler.triggerShowHideSideNav(false);
  });

  /*
const pageCover = $('<div id="page-cover"></div>').css({
    display: 'none',
    position: 'fixed',
    top: 0,
    right: 0,
    width: '100%',
    height: '100%',
    backgroundColor: 'rgba(0,0,0,.5)',
    cursor: 'pointer',
    zIndex: 5001
  });

  const hamburgerButton = $('#hamburger-button');
  const page = $('#page-content');

  page.append(pageCover);

  function triggerSideNav(show = true) {
    sideNavHandler.showHideMobileNav();

    // Trigger hamburger animation
    // Timeout required - otherewise when sticky transition appears instant
    setTimeout(function() {hamburgerButton.toggleClass('is-active')}, 50);

    if (show) {
      $('#page-cover').css('display', 'block');
    } else {
      $('#page-cover').css('display', 'none');
    }
  }

  hamburgerButton.on('click', function () {
    triggerSideNav(true);
  });

  pageCover.on('click', function() {
    triggerSideNav(false);
  });*/


});
