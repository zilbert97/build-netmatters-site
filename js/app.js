// Cookies modal
checkAcceptCookies();           // see js/cookies.js

// Sticky header
const header = $('#sticker');
createScrollSpy(header);        // see js/stickyHeader.js

// Carousel
$(document).ready(function(){
  $(".slider").simpleSlider({
    interval: 4000,
    animateDuration: 300
  });
});
