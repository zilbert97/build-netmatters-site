"use strict";var createHeaderAnimator=function(){var i=window.matchMedia("(max-width: 1260px) and (min-width: 992px)"),t=$("#search-button"),e=$("#search-input"),n=$("#buttons-container"),a={animation:"fade-in ease-in-out .6s","-webkit-animation":"fade-in ease-in-out .6s","-moz-animation":"fade-in ease-in-out .6s","-o-animation":"fade-in ease-in-out .6s","-ms-animation":"fade-in ease-in-out .6s","transition-delay":".3s","transition-property":"visibility",visibility:"visible"},s={animation:"fade-out ease-in-out .3s","-webkit-animation":"fade-out ease-in-out .3s","-moz-animation":"fade-out ease-in-out .3s","-o-animation":"fade-out ease-in-out .3s","-ms-animation":"fade-out ease-in-out .3s","transition-delay":".3s","transition-property":"visibility",visibility:"hidden"},o={animation:"","-webkit-animation":"","-moz-animation":"","-o-animation":"","-ms-animation":"","transition-delay":"","transition-property":""};function r(){i.matches?document.getElementById("toggle").checked?(t.css({transition:"border-radius .2s ease-out .2s",borderRadius:"0 3px 3px 0"}),e.css(a),n.css(s),setTimeout(function(){t.css("transition",""),e.css(o),n.css(o)},600)):(t.css({transition:"",borderRadius:""}),e.css(s),n.css(a),setTimeout(function(){e.css(o),n.css(o)},600)):(t.removeAttr("style"),e.removeAttr("style"),n.removeAttr("style"))}return i.addListener(r),r},animateHeaderElements=createHeaderAnimator();$("#toggle").click(function(){animateHeaderElements()});
