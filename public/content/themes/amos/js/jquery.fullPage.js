/**
 * fullPage 2.6.3
 * https://github.com/alvarotrigo/fullPage.js
 * MIT licensed
 *
 * Copyright (C) 2015 alvarotrigo.com - A project by Alvaro Trigo
 */
(function(d,k,n,m,H){var l=d(k),y=d(n);d.fn.fullpage=function(c){function Da(a){a.find(".fp-slides").after('<div class="fp-controlArrow fp-prev"></div><div class="fp-controlArrow fp-next"></div>');"#fff"!=c.controlArrowColor&&(a.find(".fp-controlArrow.fp-next").css("border-color","transparent transparent transparent "+c.controlArrowColor),a.find(".fp-controlArrow.fp-prev").css("border-color","transparent "+c.controlArrowColor+" transparent transparent"));c.loopHorizontal||a.find(".fp-controlArrow.fp-prev").hide()}
function Ea(){q.append('<div id="fp-nav"><ul></ul></div>');z=d("#fp-nav");z.addClass(function(){return c.showActiveTooltip?"fp-show-active "+c.navigationPosition:c.navigationPosition});for(var a=0;a<d(".fp-section").length;a++){var b="";c.anchors.length&&(b=c.anchors[a]);var b='<li><a href="#'+b+'"><span></span></a>',g=c.navigationTooltips[a];"undefined"!==typeof g&&""!==g&&(b+='<div class="fp-tooltip '+c.navigationPosition+'">'+g+"</div>");b+="</li>";z.find("ul").append(b)}}function ba(){d(".fp-section").each(function(){var a=
d(this).find(".fp-slide");a.length?a.each(function(){I(d(this))}):I(d(this))});d.isFunction(c.afterRender)&&c.afterRender.call(this)}function ca(){var a;if(!c.autoScrolling||c.scrollBar){for(var b=l.scrollTop(),g=0,h=m.abs(b-n.querySelectorAll(".fp-section")[0].offsetTop),e=n.querySelectorAll(".fp-section"),f=0;f<e.length;++f){var k=m.abs(b-e[f].offsetTop);k<h&&(g=f,h=k)}a=d(e).eq(g)}if(!c.autoScrolling||c.scrollBar){if(!a.hasClass("active")){T=!0;b=d(".fp-section.active");g=b.index(".fp-section")+
1;h=U(a);e=a.data("anchor");f=a.index(".fp-section")+1;k=a.find(".fp-slide.active");if(k.length)var q=k.data("anchor"),p=k.index();r&&(a.addClass("active").siblings().removeClass("active"),d.isFunction(c.onLeave)&&c.onLeave.call(b,g,f,h),d.isFunction(c.afterLoad)&&c.afterLoad.call(a,e,f),J(e,f-1),c.anchors.length&&(A=e,V(p,q,e,f)));clearTimeout(da);da=setTimeout(function(){T=!1},100)}c.fitToSection&&(clearTimeout(ea),ea=setTimeout(function(){r&&(d(".fp-section.active").is(a)&&(u=!0),t(a),u=!1)},1E3))}}
function fa(a){return a.find(".fp-slides").length?a.find(".fp-slide.active").find(".fp-scrollable"):a.find(".fp-scrollable")}function K(a,b){if(v[a]){var c,d;"down"==a?(c="bottom",d=e.moveSectionDown):(c="top",d=e.moveSectionUp);if(0<b.length)if(c="top"===c?!b.scrollTop():"bottom"===c?b.scrollTop()+1+b.innerHeight()>=b[0].scrollHeight:void 0,c)d();else return!0;else d()}}function Fa(a){var b=a.originalEvent;if(!ga(a.target)&&W(b)){c.autoScrolling&&a.preventDefault();a=d(".fp-section.active");var g=
fa(a);r&&!B&&(b=ha(b),E=b.y,L=b.x,a.find(".fp-slides").length&&m.abs(M-L)>m.abs(F-E)?m.abs(M-L)>l.width()/100*c.touchSensitivity&&(M>L?v.right&&e.moveSlideRight():v.left&&e.moveSlideLeft()):c.autoScrolling&&m.abs(F-E)>l.height()/100*c.touchSensitivity&&(F>E?K("down",g):E>F&&K("up",g)))}}function ga(a,b){b=b||0;var g=d(a).parent();return b<c.normalScrollElementTouchThreshold&&g.is(c.normalScrollElements)?!0:b==c.normalScrollElementTouchThreshold?!1:ga(g,++b)}function W(a){return"undefined"===typeof a.pointerType||
"mouse"!=a.pointerType}function Ga(a){a=a.originalEvent;c.fitToSection&&w.stop();W(a)&&(a=ha(a),F=a.y,M=a.x)}function ia(a,b){for(var c=0,d=a.slice(m.max(a.length-b,1)),e=0;e<d.length;e++)c+=d[e];return m.ceil(c/b)}function C(a){var b=(new Date).getTime();if(c.autoScrolling){a=k.event||a;var g=a.wheelDelta||-a.deltaY||-a.detail,h=m.max(-1,m.min(1,g));149<D.length&&D.shift();D.push(m.abs(g));c.scrollBar&&(a.preventDefault?a.preventDefault():a.returnValue=!1);a=d(".fp-section.active");a=fa(a);g=b-ja;
ja=b;200<g&&(D=[]);r&&(b=ia(D,10),g=ia(D,70),b>=g&&(0>h?K("down",a):K("up",a)));return!1}c.fitToSection&&w.stop()}function ka(a){var b=d(".fp-section.active").find(".fp-slides");if(b.length&&!B){var g=b.find(".fp-slide.active"),h=null,h="prev"===a?g.prev(".fp-slide"):g.next(".fp-slide");if(!h.length){if(!c.loopHorizontal)return;h="prev"===a?g.siblings(":last"):g.siblings(":first")}B=!0;G(b,h)}}function la(){d(".fp-slide.active").each(function(){X(d(this))})}function t(a,b,g){var h=a.position();if("undefined"!==
typeof h&&(b={element:a,callback:b,isMovementUp:g,dest:h,dtop:h.top,yMovement:U(a),anchorLink:a.data("anchor"),sectionIndex:a.index(".fp-section"),activeSlide:a.find(".fp-slide.active"),activeSection:d(".fp-section.active"),leavingSection:d(".fp-section.active").index(".fp-section")+1,localIsResizing:u},!(b.activeSection.is(a)&&!u||c.scrollBar&&l.scrollTop()===b.dtop))){if(b.activeSlide.length)var e=b.activeSlide.data("anchor"),f=b.activeSlide.index();c.autoScrolling&&c.continuousVertical&&"undefined"!==
typeof b.isMovementUp&&(!b.isMovementUp&&"up"==b.yMovement||b.isMovementUp&&"down"==b.yMovement)&&(b.isMovementUp?d(".fp-section.active").before(b.activeSection.nextAll(".fp-section")):d(".fp-section.active").after(b.activeSection.prevAll(".fp-section").get().reverse()),x(d(".fp-section.active").position().top),la(),b.wrapAroundElements=b.activeSection,b.dest=b.element.position(),b.dtop=b.dest.top,b.yMovement=U(b.element));a.addClass("active").siblings().removeClass("active");r=!1;V(f,e,b.anchorLink,
b.sectionIndex);d.isFunction(c.onLeave)&&!b.localIsResizing&&c.onLeave.call(b.activeSection,b.leavingSection,b.sectionIndex+1,b.yMovement);Ha(b);A=b.anchorLink;J(b.anchorLink,b.sectionIndex)}}function Ha(a){if(c.css3&&c.autoScrolling&&!c.scrollBar)ma("translate3d(0px, -"+a.dtop+"px, 0px)",!0),setTimeout(function(){na(a)},c.scrollingSpeed);else{var b=Ia(a);d(b.element).animate(b.options,c.scrollingSpeed,c.easing).promise().done(function(){na(a)})}}function Ia(a){var b={};c.autoScrolling&&!c.scrollBar?
(b.options={top:-a.dtop},b.element=".fullpage-wrapper"):(b.options={scrollTop:a.dtop},b.element="html, body");return b}function Ja(a){a.wrapAroundElements&&a.wrapAroundElements.length&&(a.isMovementUp?d(".fp-section:first").before(a.wrapAroundElements):d(".fp-section:last").after(a.wrapAroundElements),x(d(".fp-section.active").position().top),la())}function na(a){Ja(a);d.isFunction(c.afterLoad)&&!a.localIsResizing&&c.afterLoad.call(a.element,a.anchorLink,a.sectionIndex+1);r=!0;setTimeout(function(){d.isFunction(a.callback)&&
a.callback.call(this)},600)}function oa(){if(!T){var a=k.location.hash.replace("#","").split("/"),b=a[0],a=a[1];if(b.length){var c="undefined"===typeof A,d="undefined"===typeof A&&"undefined"===typeof a&&!B;(b&&b!==A&&!c||d||!B&&Y!=a)&&Z(b,a)}}}function Ka(a){r&&(a.pageY<N?e.moveSectionUp():a.pageY>N&&e.moveSectionDown());N=a.pageY}function G(a,b){var g=b.position(),h=b.index(),e=a.closest(".fp-section"),f=e.index(".fp-section"),k=e.data("anchor"),l=e.find(".fp-slidesNav"),m=pa(b),n=u;if(c.onSlideLeave){var q=
e.find(".fp-slide.active"),p=q.index(),r;r=p==h?"none":p>h?"left":"right";n||"none"===r||d.isFunction(c.onSlideLeave)&&c.onSlideLeave.call(q,k,f+1,p,r)}b.addClass("active").siblings().removeClass("active");!c.loopHorizontal&&c.controlArrows&&(e.find(".fp-controlArrow.fp-prev").toggle(0!==h),e.find(".fp-controlArrow.fp-next").toggle(!b.is(":last-child")));e.hasClass("active")&&V(h,m,k,f);var t=function(){n||d.isFunction(c.afterSlideLoad)&&c.afterSlideLoad.call(b,k,f+1,m,h);B=!1};c.css3?(g="translate3d(-"+
g.left+"px, 0px, 0px)",qa(a.find(".fp-slidesContainer"),0<c.scrollingSpeed).css(ra(g)),setTimeout(function(){t()},c.scrollingSpeed,c.easing)):a.animate({scrollLeft:g.left},c.scrollingSpeed,c.easing,function(){t()});l.find(".active").removeClass("active");l.find("li").eq(h).find("a").addClass("active")}function sa(){ta();if(O){var a=d(n.activeElement);a.is("textarea")||a.is("input")||a.is("select")||(a=l.height(),m.abs(a-aa)>20*m.max(aa,a)/100&&(e.reBuild(!0),aa=a))}else clearTimeout(ua),ua=setTimeout(function(){e.reBuild(!0)},
500)}function ta(){if(c.responsive){var a=f.hasClass("fp-responsive");l.width()<c.responsive?a||(e.setAutoScrolling(!1,"internal"),e.setFitToSection(!1,"internal"),d("#fp-nav").hide(),f.addClass("fp-responsive")):a&&(e.setAutoScrolling(P.autoScrolling,"internal"),e.setFitToSection(P.autoScrolling,"internal"),d("#fp-nav").show(),f.removeClass("fp-responsive"))}}function qa(a){var b="all "+c.scrollingSpeed+"ms "+c.easingcss3;a.removeClass("fp-notransition");return a.css({"-webkit-transition":b,transition:b})}
function La(a,b){if(825>a||900>b){var c=m.min(100*a/825,100*b/900).toFixed(2);q.css("font-size",c+"%")}else q.css("font-size","100%")}function J(a,b){c.menu&&(d(c.menu).find(".active").removeClass("active"),d(c.menu).find('[data-menuanchor="'+a+'"]').addClass("active"));c.navigation&&(d("#fp-nav").find(".active").removeClass("active"),a?d("#fp-nav").find('a[href="#'+a+'"]').addClass("active"):d("#fp-nav").find("li").eq(b).find("a").addClass("active"))}function U(a){var b=d(".fp-section.active").index(".fp-section");
a=a.index(".fp-section");return b==a?"none":b>a?"up":"down"}function I(a){a.css("overflow","hidden");var b=a.closest(".fp-section"),d=a.find(".fp-scrollable"),e;d.length?e=d.get(0).scrollHeight:(e=a.get(0).scrollHeight,c.verticalCentered&&(e=a.find(".fp-tableCell").get(0).scrollHeight));b=p-parseInt(b.css("padding-bottom"))-parseInt(b.css("padding-top"));e>b?d.length?d.css("height",b+"px").parent().css("height",b+"px"):(c.verticalCentered?a.find(".fp-tableCell").wrapInner('<div class="fp-scrollable" />'):
a.wrapInner('<div class="fp-scrollable" />'),a.find(".fp-scrollable").slimScroll({allowPageScroll:!0,height:b+"px",size:"10px",alwaysVisible:!0})):va(a);a.css("overflow","")}function va(a){a.find(".fp-scrollable").children().first().unwrap().unwrap();a.find(".slimScrollBar").remove();a.find(".slimScrollRail").remove()}function wa(a){a.addClass("fp-table").wrapInner('<div class="fp-tableCell" style="height:'+xa(a)+'px;" />')}function xa(a){var b=p;if(c.paddingTop||c.paddingBottom)b=a,b.hasClass("fp-section")||
(b=a.closest(".fp-section")),a=parseInt(b.css("padding-top"))+parseInt(b.css("padding-bottom")),b=p-a;return b}function ma(a,b){b?qa(f):f.addClass("fp-notransition");f.css(ra(a));setTimeout(function(){f.removeClass("fp-notransition")},10)}function Z(a,b){var c;"undefined"===typeof b&&(b=0);c=isNaN(a)?d('[data-anchor="'+a+'"]'):d(".fp-section").eq(a-1);a===A||c.hasClass("active")?ya(c,b):t(c,function(){ya(c,b)})}function ya(a,b){if("undefined"!=typeof b){var c=a.find(".fp-slides"),d=c.find('[data-anchor="'+
b+'"]');d.length||(d=c.find(".fp-slide").eq(b));d.length&&G(c,d)}}function Ma(a,b){a.append('<div class="fp-slidesNav"><ul></ul></div>');var d=a.find(".fp-slidesNav");d.addClass(c.slidesNavPosition);for(var e=0;e<b;e++)d.find("ul").append('<li><a href="#"><span></span></a></li>');d.css("margin-left","-"+d.width()/2+"px");d.find("li").first().find("a").addClass("active")}function V(a,b,d,e){e="";c.anchors.length&&(a?("undefined"!==typeof d&&(e=d),"undefined"===typeof b&&(b=a),Y=b,za(e+"/"+b)):("undefined"!==
typeof a&&(Y=b),za(d)));Aa()}function za(a){if(c.recordHistory)location.hash=a;else if(O||Q)history.replaceState(H,H,"#"+a);else{var b=k.location.href.split("#")[0];k.location.replace(b+"#"+a)}}function pa(a){var b=a.data("anchor");a=a.index();"undefined"===typeof b&&(b=a);return b}function Aa(){var a=d(".fp-section.active"),b=a.find(".fp-slide.active"),e=a.data("anchor"),h=pa(b),a=a.index(".fp-section"),a=String(a);c.anchors.length&&(a=e);b.length&&(a=a+"-"+h);a=a.replace("/","-").replace("#","");
q[0].className=q[0].className.replace(RegExp("\\b\\s?fp-viewing-[^\\s]+\\b","g"),"");q.addClass("fp-viewing-"+a)}function Na(){var a=n.createElement("p"),b,c={webkitTransform:"-webkit-transform",OTransform:"-o-transform",msTransform:"-ms-transform",MozTransform:"-moz-transform",transform:"transform"};n.body.insertBefore(a,null);for(var d in c)a.style[d]!==H&&(a.style[d]="translate3d(1px,1px,1px)",b=k.getComputedStyle(a).getPropertyValue(c[d]));n.body.removeChild(a);return b!==H&&0<b.length&&"none"!==
b}function Oa(){if(O||Q){var a=Ba();d(".fullpage-wrapper").off("touchstart "+a.down).on("touchstart "+a.down,Ga);d(".fullpage-wrapper").off("touchmove "+a.move).on("touchmove "+a.move,Fa)}}function Pa(){if(O||Q){var a=Ba();d(".fullpage-wrapper").off("touchstart "+a.down);d(".fullpage-wrapper").off("touchmove "+a.move)}}function Ba(){return k.PointerEvent?{down:"pointerdown",move:"pointermove"}:{down:"MSPointerDown",move:"MSPointerMove"}}function ha(a){var b=[];b.y="undefined"!==typeof a.pageY&&(a.pageY||
a.pageX)?a.pageY:a.touches[0].pageY;b.x="undefined"!==typeof a.pageX&&(a.pageY||a.pageX)?a.pageX:a.touches[0].pageX;Q&&W(a)&&(b.y=a.touches[0].pageY,b.x=a.touches[0].pageX);return b}function X(a){e.setScrollingSpeed(0,"internal");G(a.closest(".fp-slides"),a);e.setScrollingSpeed(P.scrollingSpeed,"internal")}function x(a){c.scrollBar?f.scrollTop(a):c.css3?ma("translate3d(0px, -"+a+"px, 0px)",!1):f.css("top",-a)}function ra(a){return{"-webkit-transform":a,"-moz-transform":a,"-ms-transform":a,transform:a}}
function Qa(){x(0);d("#fp-nav, .fp-slidesNav, .fp-controlArrow").remove();d(".fp-section").css({height:"","background-color":"",padding:""});d(".fp-slide").css({width:""});f.css({height:"",position:"","-ms-touch-action":"","touch-action":""});d(".fp-section, .fp-slide").each(function(){va(d(this));d(this).removeClass("fp-table active")});f.addClass("fp-notransition");f.find(".fp-tableCell, .fp-slidesContainer, .fp-slides").each(function(){d(this).replaceWith(this.childNodes)});w.scrollTop(0)}function R(a,
b,d){c[a]=b;"internal"!==d&&(P[a]=b)}function S(a,b){console&&console[a]&&console[a]("fullPage: "+b)}var w=d("html, body"),q=d("body"),e=d.fn.fullpage;c=d.extend({menu:!1,anchors:[],navigation:!1,navigationPosition:"right",navigationTooltips:[],showActiveTooltip:!1,slidesNavigation:!1,slidesNavPosition:"bottom",scrollBar:!1,css3:!0,scrollingSpeed:700,autoScrolling:!0,fitToSection:!0,easing:"easeInOutCubic",easingcss3:"ease",loopBottom:!1,loopTop:!1,loopHorizontal:!0,continuousVertical:!1,normalScrollElements:null,
scrollOverflow:!1,touchSensitivity:5,normalScrollElementTouchThreshold:5,keyboardScrolling:!0,animateAnchor:!0,recordHistory:!0,controlArrows:!0,controlArrowColor:"#fff",verticalCentered:!0,resize:!1,sectionsColor:[],paddingTop:0,paddingBottom:0,fixedElements:null,responsive:0,sectionSelector:".section",slideSelector:".slide",afterLoad:null,onLeave:null,afterRender:null,afterResize:null,afterReBuild:null,afterSlideLoad:null,onSlideLeave:null},c);(function(){c.continuousVertical&&(c.loopTop||c.loopBottom)&&
(c.continuousVertical=!1,S("warn","Option `loopTop/loopBottom` is mutually exclusive with `continuousVertical`; `continuousVertical` disabled"));c.continuousVertical&&c.scrollBar&&(c.continuousVertical=!1,S("warn","Option `scrollBar` is mutually exclusive with `continuousVertical`; `continuousVertical` disabled"));d.each(c.anchors,function(a,b){(d("#"+b).length||d('[name="'+b+'"]').length)&&S("error","data-anchor tags can not have the same value as any `id` element on the site (or `name` element for IE).")})})();
d.extend(d.easing,{easeInOutCubic:function(a,b,c,d,e){return 1>(b/=e/2)?d/2*b*b*b+c:d/2*((b-=2)*b*b+2)+c}});d.extend(d.easing,{easeInQuart:function(a,b,c,d,e){return d*(b/=e)*b*b*b+c}});e.setAutoScrolling=function(a,b){R("autoScrolling",a,b);var g=d(".fp-section.active");c.autoScrolling&&!c.scrollBar?(w.css({overflow:"hidden",height:"100%"}),e.setRecordHistory(c.recordHistory,"internal"),f.css({"-ms-touch-action":"none","touch-action":"none"}),g.length&&x(g.position().top)):(w.css({overflow:"visible",
height:"initial"}),e.setRecordHistory(!1,"internal"),f.css({"-ms-touch-action":"","touch-action":""}),x(0),g.length&&w.scrollTop(g.position().top))};e.setRecordHistory=function(a,b){R("recordHistory",a,b)};e.setScrollingSpeed=function(a,b){R("scrollingSpeed",a,b)};e.setFitToSection=function(a,b){R("fitToSection",a,b)};e.setMouseWheelScrolling=function(a){a?(a=d(".fullpage-wrapper")[0],n.addEventListener?(a.addEventListener("mousewheel",C,!1),a.addEventListener("wheel",C,!1)):a.attachEvent("onmousewheel",
C)):(a=d(".fullpage-wrapper")[0],n.addEventListener?(a.removeEventListener("mousewheel",C,!1),a.removeEventListener("wheel",C,!1)):a.detachEvent("onmousewheel",C))};e.setAllowScrolling=function(a,b){"undefined"!=typeof b?(b=b.replace(/ /g,"").split(","),d.each(b,function(b,c){switch(c){case "up":v.up=a;break;case "down":v.down=a;break;case "left":v.left=a;break;case "right":v.right=a;break;case "all":e.setAllowScrolling(a)}})):a?(e.setMouseWheelScrolling(!0),Oa()):(e.setMouseWheelScrolling(!1),Pa())};
e.setKeyboardScrolling=function(a){c.keyboardScrolling=a};e.moveSectionUp=function(){var a=d(".fp-section.active").prev(".fp-section");a.length||!c.loopTop&&!c.continuousVertical||(a=d(".fp-section").last());a.length&&t(a,null,!0)};e.moveSectionDown=function(){var a=d(".fp-section.active").next(".fp-section");a.length||!c.loopBottom&&!c.continuousVertical||(a=d(".fp-section").first());a.length&&t(a,null,!1)};e.moveTo=function(a,b){var c="",c=isNaN(a)?d('[data-anchor="'+a+'"]'):d(".fp-section").eq(a-
1);"undefined"!==typeof b?Z(a,b):0<c.length&&t(c)};e.moveSlideRight=function(){ka("next")};e.moveSlideLeft=function(){ka("prev")};e.reBuild=function(a){if(!f.hasClass("fp-destroyed")){u=!0;var b=l.width();p=l.height();c.resize&&La(p,b);d(".fp-section").each(function(){var a=d(this).find(".fp-slides"),b=d(this).find(".fp-slide");c.verticalCentered&&d(this).find(".fp-tableCell").css("height",xa(d(this))+"px");d(this).css("height",p+"px");c.scrollOverflow&&(b.length?b.each(function(){I(d(this))}):I(d(this)));
1<b.length&&G(a,a.find(".fp-slide.active"))});b=d(".fp-section.active");b.index(".fp-section")&&t(b);u=!1;d.isFunction(c.afterResize)&&a&&c.afterResize.call(f);d.isFunction(c.afterReBuild)&&!a&&c.afterReBuild.call(f)}};var B=!1,O=navigator.userAgent.match(/(iPhone|iPod|iPad|Android|playbook|silk|BlackBerry|BB10|Windows Phone|Tizen|Bada|webOS|IEMobile|Opera Mini)/),Q="ontouchstart"in k||0<navigator.msMaxTouchPoints||navigator.maxTouchPoints,f=d(this),p=l.height(),u=!1,A,Y,r=!0,D=[],z,v={up:!0,down:!0,
left:!0,right:!0},P=d.extend(!0,{},c);d(this).length?(f.css({height:"100%",position:"relative"}),f.addClass("fullpage-wrapper")):S("error","Error! Fullpage.js needs to be initialized with a selector. For example: $('#myContainer').fullpage();");c.css3&&(c.css3=Na());e.setAllowScrolling(!0);f.removeClass("fp-destroyed");d(c.sectionSelector).each(function(){d(this).addClass("fp-section")});d(c.slideSelector).each(function(){d(this).addClass("fp-slide")});c.navigation&&Ea();d(".fp-section").each(function(a){var b=
d(this),e=d(this).find(".fp-slide"),f=e.length;a||0!==d(".fp-section.active").length||d(this).addClass("active");d(this).css("height",p+"px");c.paddingTop&&d(this).css("padding-top",c.paddingTop);c.paddingBottom&&d(this).css("padding-bottom",c.paddingBottom);"undefined"!==typeof c.sectionsColor[a]&&d(this).css("background-color",c.sectionsColor[a]);"undefined"!==typeof c.anchors[a]&&(d(this).attr("data-anchor",c.anchors[a]),d(this).hasClass("active")&&J(c.anchors[a],a));if(0<f){a=100*f;var k=100/
f;e.wrapAll('<div class="fp-slidesContainer" />');e.parent().wrap('<div class="fp-slides" />');d(this).find(".fp-slidesContainer").css("width",a+"%");c.controlArrows&&1<f&&Da(d(this));c.slidesNavigation&&Ma(d(this),f);e.each(function(a){d(this).css("width",k+"%");c.verticalCentered&&wa(d(this))});b=b.find(".fp-slide.active");b.length?X(b):e.eq(0).addClass("active")}else c.verticalCentered&&wa(d(this))}).promise().done(function(){e.setAutoScrolling(c.autoScrolling,"internal");var a=d(".fp-section.active").find(".fp-slide.active");
a.length&&(0!==d(".fp-section.active").index(".fp-section")||0===d(".fp-section.active").index(".fp-section")&&0!==a.index())&&X(a);c.fixedElements&&c.css3&&d(c.fixedElements).appendTo(q);c.navigation&&(z.css("margin-top","-"+z.height()/2+"px"),z.find("li").eq(d(".fp-section.active").index(".fp-section")).find("a").addClass("active"));c.menu&&c.css3&&d(c.menu).closest(".fullpage-wrapper").length&&d(c.menu).appendTo(q);c.scrollOverflow?("complete"===n.readyState&&ba(),l.on("load",ba)):d.isFunction(c.afterRender)&&
c.afterRender.call(f);ta();if(!c.animateAnchor&&(a=k.location.hash.replace("#","").split("/")[0],a.length)){var b=d('[data-anchor="'+a+'"]');b.length&&(c.autoScrolling?x(b.position().top):(x(0),w.scrollTop(b.position().top)),J(a,null),d.isFunction(c.afterLoad)&&c.afterLoad.call(b,a,b.index(".fp-section")+1),b.addClass("active").siblings().removeClass("active"))}Aa();l.on("load",function(){var a=k.location.hash.replace("#","").split("/"),b=a[0],a=a[1];b&&Z(b,a)})});var da,ea,T=!1;l.on("scroll",ca);
var F=0,M=0,E=0,L=0,ja=(new Date).getTime();l.on("hashchange",oa);y.keydown(function(a){clearTimeout(Ca);var b=d(n.activeElement);b.is("textarea")||b.is("input")||b.is("select")||!c.keyboardScrolling||!c.autoScrolling||(-1<d.inArray(a.which,[40,38,32,33,34])&&a.preventDefault(),Ca=setTimeout(function(){var b=a.shiftKey;switch(a.which){case 38:case 33:e.moveSectionUp();break;case 32:if(b){e.moveSectionUp();break}case 40:case 34:e.moveSectionDown();break;case 36:e.moveTo(1);break;case 35:e.moveTo(d(".fp-section").length);
break;case 37:e.moveSlideLeft();break;case 39:e.moveSlideRight()}},150))});var Ca;f.mousedown(function(a){2==a.which&&(N=a.pageY,f.on("mousemove",Ka))});f.mouseup(function(a){2==a.which&&f.off("mousemove")});var N=0;y.on("click touchstart","#fp-nav a",function(a){a.preventDefault();a=d(this).parent().index();t(d(".fp-section").eq(a))});y.on("click touchstart",".fp-slidesNav a",function(a){a.preventDefault();a=d(this).closest(".fp-section").find(".fp-slides");var b=a.find(".fp-slide").eq(d(this).closest("li").index());
G(a,b)});c.normalScrollElements&&(y.on("mouseenter",c.normalScrollElements,function(){e.setMouseWheelScrolling(!1)}),y.on("mouseleave",c.normalScrollElements,function(){e.setMouseWheelScrolling(!0)}));d(".fp-section").on("click touchstart",".fp-controlArrow",function(){d(this).hasClass("fp-prev")?e.moveSlideLeft():e.moveSlideRight()});l.resize(sa);var aa=p,ua;e.destroy=function(a){e.setAutoScrolling(!1,"internal");e.setAllowScrolling(!1);e.setKeyboardScrolling(!1);f.addClass("fp-destroyed");l.off("scroll",
ca).off("hashchange",oa).off("resize",sa);y.off("click","#fp-nav a").off("mouseenter","#fp-nav li").off("mouseleave","#fp-nav li").off("click",".fp-slidesNav a").off("mouseover",c.normalScrollElements).off("mouseout",c.normalScrollElements);d(".fp-section").off("click",".fp-controlArrow");a&&Qa()}}})(jQuery,window,document,Math);