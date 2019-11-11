<!-- ================================================== -->
<!-- =============== START BREADCRUMB JS ================ -->
<!-- ================================================== -->
	
	var wH = jQuery(window).height();

	jQuery('.breadcrumb-fullscreen').css('height',wH);

	jQuery('.breadcrumb:not(.breadcrumb-fullscreen)').each(function(){
        
        jQuery('header.header').addClass('no-breadcrumb-fullscreen');

    });

    jQuery('.breadcrumb.breadcrumb-video-content').each(function(){
        
        jQuery('header.header').removeClass('no-breadcrumb-fullscreen');

    });
<!-- ================================================== -->
<!-- =============== END BREADCRUMB JS ================ -->
<!-- ================================================== -->

<!-- ================================================== -->
<!-- =============== START BREACRUMB OPTIONS ================ -->
<!-- ================================================== -->

jQuery(function(){

    "use strict";

    var breadcrumbH = jQuery(window).height();

    if (jQuery(window).width() >= 1200){  
      jQuery('.breadcrumb-video-content').each(function(){

        breadcrumbH = (jQuery('.breadcrumb').outerHeight() - 250);

      });
    };

    if ( jQuery('.link-yaku').length > 0 ) {

      var breadcrumbLength = jQuery('.link-yaku').html();

      jQuery('.link-yaku').html('');

      for (var i = 0, len = breadcrumbLength.length; i < len; i++) {
        var actualTitleString = jQuery('.link-yaku').html();

        jQuery('.link-yaku').html(actualTitleString + '<span>' + breadcrumbLength[i] + '</span>');
      }

    }

    jQuery('.breadcrumb-video-content').each(function(){

      breadcrumbH = (jQuery('.breadcrumb').outerHeight() - 75);

    });

    jQuery('.breadcrumb-fullscreen-parent').after('<div class="before-affix-breadcrumb"></div>');

    var wH = jQuery(window).height();

    jQuery('.starTitle > *').each(function(){

      var fadeStart= 0
          ,fadeUntil= 400
          ,fading = jQuery(this);

      jQuery(window).bind('scroll', function(){
          var offset = jQuery(document).scrollTop()
              ,opacity=0
          ;
          if( offset<=fadeStart ){
              opacity=1;
          }else if( offset<=fadeUntil ){
              opacity=1-offset/fadeUntil;
          }
          fading.css('opacity',opacity);
      });

    });

    function affixPhoneMenu() {

      jQuery('header.header').addClass('phone-menu-bg');

      jQuery('.phone-menu-bg').affix({
          offset: {
            top: 50
          }
      });

    };

    function unAffixPhoneMenu() {

      jQuery('header.header').removeClass('phone-menu-bg');

    };

    if (jQuery(window).width() <= 768){
          affixPhoneMenu();
        } else {
         jQuery(window).resize(function(){
          if (jQuery(window).width() <= 768){
            affixPhoneMenu();
          }
      });
    };

    if (jQuery(window).width() >= 768){
          unAffixPhoneMenu();
        } else {
         jQuery(window).resize(function(){
          if (jQuery(window).width() >= 768){
            unAffixPhoneMenu();
          }
      });
    };

    jQuery('.breadcrumb-fullscreen-parent').affix({
        offset: {
          top: function () {
            return (this.top = (breadcrumbH - 75))
          }
        }
    });

    jQuery('header.header').affix({
        offset: {
          top: function () {
            return (this.top = (breadcrumbH - 120))
          }
        }
    });

    jQuery('header.header').on('affix.bs.affix', function () {

            jQuery('.project-single').addClass('affix');

        });

        jQuery('header.header').on('affix-top.bs.affix', function () {

            jQuery('.project-single').removeClass('affix');

        });

    function fullScreenBreadcrumb() {

        jQuery('.breadcrumb-fullscreen-parent').on('affix-top.bs.affix', function () {

            jQuery('.before-affix-breadcrumb').css('height',0);

            if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {

              jQuery(this).css('bottom',0);

            };

        });

        jQuery('.breadcrumb-fullscreen-parent').on('affix.bs.affix', function () {

            jQuery('.before-affix-breadcrumb').css('height',breadcrumbH);

            if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {

              jQuery(this).css('bottom',wH - 69);

            };

        });

    };

    function splitEqual() {

        jQuery('.split-equal').each(function(){

          var bigImageH = jQuery(this).find('.big-image').outerHeight();

          jQuery('.padding-content > div').css('height', bigImageH - 160 );

        });

    };

    fullScreenBreadcrumb();

    jQuery(window).resize(function(){

        fullScreenBreadcrumb();

        splitEqual();

    });

});

<!-- ================================================== -->
<!-- =============== END BREACRUMB OPTIONS ================ -->
<!-- ================================================== -->

<!-- ================================================== -->
<!-- =============== START STARTER JS ================ -->
<!-- ================================================== -->
  
jQuery(document).ready(function(){

  "use strict";

  // FitVides Option
  jQuery("html").fitVids({ customSelector: "iframe"});

  // LightBox Options
  jQuery(".attachment").find('a > img:not(.attachment-thumbnail)').parent().attr('rel','gallery').fancybox({
    fitToView: true,
    autoSize :  true,
    margin : 30,
    autoScale : true,
    width : '100%',
    height : '100%',
    showNavArrows: true,
    showCloseButton: true,
    helpers : {
      media : {}
    }
  });

  //Page Loader

  jQuery('.page-loader').delay(800).fadeOut('slow');

  jQuery(".lightbox").attr('rel','gallery').fancybox({
    fitToView: true,
    autoSize :  true,
    margin : 30,
    autoScale : true,
    width : '100%',
    height : '100%',
    showNavArrows: true,
    showCloseButton: true,
    helpers : {
      media : {}
    }
  });
  
  // "single-post-content" is the class of blog-single content container
  jQuery(".single-post-content").find('a > img').parent().attr('rel','gallery').fancybox({
    fitToView: true,
    autoSize :  true,
    margin : 30,
    autoScale : true,
    width : '100%',
    height : '100%',
    showNavArrows: true,
    showCloseButton: true,
    helpers : {
      media : {}
    }
  });

  //Activate the "star" plugin from StarHomePage
  jQuery(".star").each(function() {
      postars(jQuery('.cover').get(0)).init();
  });

  //Start Home-Video-Player
  jQuery(function(){
    jQuery(".player").YTPlayer();
  });

  jQuery(window).load(function(){

    //Start RyalSlider
    function royalSliderAva() {

      jQuery('#ava-slider').each(function(){

        var wH = jQuery(window).height();

        jQuery(this).parent().css('height',wH);
        
        jQuery(this).css('height',wH);

        jQuery(this).royalSlider({
          arrowsNav: true,
          loop: false,
          keyboardNavEnabled: true,
          controlsInside: false,
          fadeinLoadedSlide: true,
          imageScaleMode: 'fill',
          arrowsNavAutoHide: false,
          autoScaleSlider: false,
          controlNavigation: false,
          thumbsFitInViewport: false,
          navigateByClick: true,
          startSlideId: 0,
          autoPlay: false,
          transitionType:'move',
          globalCaption: false,
          slidesSpacing: 0,
          deeplinking: {
          enabled: true,
          change: false,

          },
        });
      });
    };

    function afterRSInit() {

      jQuery('.rsContent .rsImg').each(function(){

        var thisSrc = jQuery(this).attr('src');

        jQuery(this).hide();

      });

      jQuery(window).scroll(function(){

        var actualScroll = jQuery(window).scrollTop() * 0.5;

        jQuery('.rsContent').css({
          'background-position': '50% ' + actualScroll + 'px'
        });

      });

    }

    afterRSInit();

    royalSliderAva();

    jQuery(window).resize(function(){

      afterRSInit();

      royalSliderAva();

    });

  });

  /***********************************************************************************************/
  /* MENU */
  /***********************************************************************************************/
  jQuery('.open-menu').on('click', function(){

    jQuery(this).toggleClass('active');

    jQuery('.menu-fixed-container').toggleClass('open');

  });

  jQuery('.x-filter').on('click',function(){

    jQuery('.open-menu').toggleClass('active');

    jQuery('.menu-fixed-container').toggleClass('open');

  });

  jQuery('.menu-fixed-container > nav > ul > li > a').on('click',function(){

        jQuery(this).parent().siblings().toggleClass('no-hovered');
        jQuery(this).parent().toggleClass('click');
        jQuery(this).parent().siblings().removeClass('click'); 
    });

  jQuery('.menu-fixed-container > nav > ul > li > .sub-menu').parent().addClass('hover-sub-menu');

  jQuery('.menu-fixed-container > nav > ul > li > .sub-menu').on('click',function(){

      jQuery(this).parent().toggleClass('hovered-sub-menu ');

  });

  jQuery('.menu-fixed-container nav ul li .sub-menu').parent().find('> a').on('click', function(e){

    e.preventDefault();

  });
/***********************************************************************************************/
/* END MENU */
/***********************************************************************************************/
/***********************************************************************************************/
/* COUNTER */
/***********************************************************************************************/
   jQuery('.clock').each(function(){
    var aquraDate = jQuery(this).attr("data-date");
    jQuery(this).countdown(aquraDate)
    .on('update.countdown', function(event) {
     var format = '%H:%M:%S';
     if(event.offset.days > 0) {
        format = '%-d <p><span>d</span><span>a</span><span>y</span><span>%!d</span></p> ' + format;
      }
      if(event.offset.weeks > 0) {
        format = '%-w <p><span>w</span><span>e</span><span>e</span><span>k</span><span>%!w</span></p> ' + format;
      }
     jQuery(this).html(event.strftime(format));
   })
   .on('finish.countdown', function(event) {
     jQuery(this).html('The show had Start!')
       .parent().addClass('disabled');
   });
   })
/***********************************************************************************************/
/* END COUNTER */
/***********************************************************************************************/
/***********************************************************************************************/
  /* GO TO TOP BUTTON */
  /***********************************************************************************************/
  // Go to top button
      jQuery(window).load(function(){
         jQuery(window).scroll(function(){

            if(jQuery(document).scrollTop() > 300)
            {    
                jQuery('.goTop').css({bottom:"50px"});
            }
            else
            {  
               jQuery('.goTop').css({bottom:"-80px"});
            }
        }); 
        jQuery('#overlay').fadeOut();
      });
       
    jQuery('.goTop').on("click",function(){
        jQuery('html, body').animate({scrollTop:0}, 'slow');
        return false;
    }); 
  // End button top
  /***********************************************************************************************/
  /* END GO TO TOP BUTTON */
  /***********************************************************************************************/

/***********************************************************************************************/
  /* COUNTER */
  /***********************************************************************************************/
  if ( jQuery( '.sm-countdown' ).length > 0 ) {
  
      jQuery( '.sm-countdown' ).each( function() {
        var $this = jQuery( this );
        var mode = $this.hasClass( 'sm-style1' ) ? 'val' : 'text';
        $this.ccountdown( $this.data( 'date' ), mode );
      } );
      jQuery( '.sm-countdown.sm-style1 .element' ).knob({
        draw : function () {
          var a = this.angle(this.cv)  // Angle
            , sa = this.startAngle     // Start angle
            , ea = sa + a        // End angle
            , r = true
            , delta_deg = 6
            , delta_rad = delta_deg / 180 * Math.PI;
  
          this.g.lineWidth = this.lineWidth;
  
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
          var sa_deg = parseInt(sa / Math.PI * 180) % 360;
          var ea_deg = parseInt(ea / Math.PI * 180) % 360;
          var idx =0 ;
          if (ea_deg < sa_deg) ea_deg += 360;
          var ea_deg_round = Math.round(ea_deg / delta_deg) * delta_deg;
          for (var ta_deg = sa_deg; ta_deg <= ea_deg_round; ta_deg += delta_deg) {
            this.g.beginPath();
            var ta_rad = ta_deg / 180 * Math.PI;
            this.g.arc(this.xy, this.xy, this.radius, -( ta_rad - delta_rad / 4 ), -( ta_rad + delta_rad / 4 ), true); 
            this.g.stroke();
          }
          var rs_deg = ea_deg_round + delta_deg;
          for (var ta_deg = rs_deg; ta_deg < sa_deg + 360; ta_deg += delta_deg) {
            this.g.beginPath();
            var ta_rad = ta_deg / 180 * Math.PI;
            this.g.strokeStyle = this.o.bgColor;
            this.g.arc(this.xy, this.xy, this.radius, -( ta_rad - delta_rad / 4) , -( ta_rad + delta_rad / 4 ), true); 
            this.g.stroke();
          }
          return false;
        }
      } );
    }
  /***********************************************************************************************/
  /* END COUNTER */
  /***********************************************************************************************/



  /***********************************************************************************************/
  /* HIDE FUCTIONS */
  /***********************************************************************************************/
  jQuery(window).scroll(function(){
    if(jQuery(document).scrollTop() > 200){
      jQuery('.mb_YTPBar').css({'display': 'none'});

    }
    else{
        jQuery('.mb_YTPBar').css({'display': 'block'});
      }
  });
  /***********************************************************************************************/
  /* END HIDE FUNCTIONS */
  /***********************************************************************************************/

  /***********************************************************************************************/
  /* START ISOTOPE */
  /***********************************************************************************************/
  function isotope() {

    var container = jQuery('.aqura-filter-content > ul');
    var second_container = jQuery('.single-photo-album-container > .row');
    var third_container = jQuery('ul.products');

    container.imagesLoaded(function() {

     container.isotope();

    });

    second_container.imagesLoaded(function() {
     second_container.isotope({
        masonry: {

          columnWidth: 1

        }
      });
    });

     third_container.imagesLoaded(function() {
     third_container.isotope();
    });

    container.isotope();
    second_container.isotope({
      masonry: {

        columnWidth: 1

      }
    });
    third_container.isotope();

    var jQueryoptionSets = jQuery('.categories ul'),

    jQueryoptionLinks = jQueryoptionSets.find('a');

    jQueryoptionLinks.on("click", function(){

     var jQuerythis = jQuery(this);

     if ( jQuerythis.hasClass('selected') ) {

      return false;

     }
     var jQueryoptionSet = jQuerythis.parents('.categories ul');

     jQueryoptionSet.find('.selected').removeClass('selected');

     jQuerythis.addClass('selected');

     var options = {},

      key = jQueryoptionSet.attr('data-option-key'),

      value = jQuerythis.attr('data-option-value');

     value = value === 'false' ? false : value;

     options[ key ] = value;

     if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {

      changeLayoutMode( jQuerythis, options )

     } else {

      container.isotope( options );

     }

     return false;

    });

   };

   isotope();

   jQuery(window).resize(function(){

    isotope();

   });
  /***********************************************************************************************/
  /* END ISOTOPE */
  /***********************************************************************************************/

  /***********************************************************************************************/
  /* START CAROUSEL */
  /***********************************************************************************************/
  jQuery(".blogSingle .owl-carousel").imagesLoaded(function() {

    jQuery(".blogSingle .owl-carousel").owlCarousel({
      items:1,
      nav:true,
      navText: ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
      autoHeight: true
    });

  });
  jQuery(".blogSidebarRight .owl-carousel").imagesLoaded(function() {

    jQuery(".blogSidebarRight .owl-carousel").owlCarousel({
      items:1,
      nav:true,
      navText: ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
      autoHeight: true
    });

  });
  jQuery(".owl-carousel").imagesLoaded(function() {

    jQuery(".owl-carousel").owlCarousel({
      items:1,
      nav:true,
      navText: ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>']
    });

  });
  /***********************************************************************************************/
  /* END CAROUSEL */
  /***********************************************************************************************/
  
  /***********************************************************************************************/
  /* INSTAGRAM */
  /***********************************************************************************************/
    if (jQuery('#instagram-sidebar-widget').length>0) {
      var userIdVal = parseInt(jQuery('#instagram-sidebar-widget').attr('data-userID'), 10);
      var feedSidebar = new Instafeed({
          get: 'user',
          userId: userIdVal, // your user id
          accessToken: jQuery('#instagram-sidebar-widget').attr('data-userToken'), // your access token
          sortBy: 'most-liked',
          template: '<li><a href="{{link}}" target="_blank"><img class="img-responsive" src="{{image}}" /></a></li>',
          target: 'instagram-sidebar-widget',
          limit: 9,
          resolution: 'low_resolution'
      });
        feedSidebar.run();
    }
    /***********************************************************************************************/
    /* END INSTAGRAM */
    /***********************************************************************************************/
      
    /***********************************************************************************************/
    /* START RATING SYSTEM */
    /***********************************************************************************************/
       // SHOP ELEMENT
      /**
     * Demo in action!
     */
    
    /***********************************************************************************************/
    /* END RATING SYSTEM */
    /***********************************************************************************************/

    /***********************************************************************************************/
    /* JPLAYER */
    /***********************************************************************************************/
    //Toggle Playlist
    // jQuery('.jplayerButton').on('click', function(){

    //   jQuery(this).toggleClass('active');

    //   jQuery('.playlist-toggle').toggleClass('open');

    // });

    jQuery('.jplayerButton').on('click', function(){

      jQuery(this).toggleClass('active');

      jQuery('.playlist-wrapper').fadeToggle('open');

      jQuery('body').toggleClass('opacityPlaylist');

    });

    // Open Close Player on scroll
    jQuery(".homeNormal").addClass("close-down");
    jQuery(window).on("scroll", function () {
    //      if (jQuery(this).scrollTop() > -1) {
    //          jQuery(".homeNormal").addClass("close-down");
    //          jQuery("#h-player").addClass("rotate");
    //      }
    //      else {
    //          jQuery(".homeNormal").removeClass("close-down");
    //          jQuery("#h-player").removeClass("rotate");
    //      }
    });
    jQuery(window).on("scroll", function () {
        if (jQuery(this).scrollTop() > 5500) {
            jQuery(".homeCustom").addClass("close-down");
            jQuery("#h-player").addClass("rotate");
        }
        else {
            jQuery(".homeCustom").removeClass("close-down");
            jQuery("#h-player").removeClass("rotate");
        }
    });
    // Open Close Player Button
    jQuery('#h-player').on('click', function() {
        jQuery(this).toggleClass("rotate")
        jQuery(".jplayer-home").toggleClass("close-down");
    });

    jQuery(window).on("scroll", function () {
        if (jQuery(this).scrollTop() > 5) {
            jQuery(".buttonBar").addClass("close-video");
        }
        else {
            jQuery(".buttonBar").removeClass("close-video");
        }
    });


    /***********************************************************************************************/
    /* END JPLAYER */
    /***********************************************************************************************/
});
<!-- ================================================== -->
<!-- =============== END STARTER JS ================ -->
<!-- ================================================== -->

//Start Home-Video-Player
jQuery(function(){
  jQuery(".player").YTPlayer();
   jQuery(window).scroll(function(){
    if(jQuery(document).scrollTop() > 200){
      jQuery('.mb_YTPBar').css({'display': 'none'});

    }
    else{
        jQuery('.mb_YTPBar').css({'display': 'block'});
      }
  });
   // Shop remove sizes
  jQuery('.shopHomePage ul li figure figcaption img, .shop-products ul li figure figcaption img').each(function(){

    jQuery(this).attr('sizes','');

  });
});