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

  $('#hamburger-button').click(function () {
    sideNavHandler.showHideMobileNav();

    // Trigger hamburger animation
    const button = $(this);

    // Timeout required - otherewise when sticky transition appears instant
    setTimeout(function() {button.toggleClass('is-active')}, 50);
  });
});
