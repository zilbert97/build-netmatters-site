"use strict";$(document).ready(function(){checkAcceptCookies(),$(".slider").simpleSlider({interval:4e3,animateDuration:300}),createScrollSpy($("#sticker"));var e=new SideMenu;$("#page-content").append($('<div id="page-cover"></div>').css({display:"none",position:"absolute",top:0,right:0,width:"100%",height:"100%",backgroundColor:"rgba(0,0,0,.5)",cursor:"pointer",zIndex:5001,opacity:0,transitionPorperty:"opacity",transition:"0.5s"})),$("#hamburger-button").on("click",function(i){e.triggerSideNav(!0)});var i=$("#page-cover"),t=!0;i.on("click",function(i){t&&(e.triggerSideNav(!1),t=!1,setTimeout(function(){t=!0},500))})});
