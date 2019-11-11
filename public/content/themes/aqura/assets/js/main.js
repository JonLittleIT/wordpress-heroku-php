function initMap() {

	if ( jQuery('#map').length ) {

		if ( aqura_static_resources.aqura_theme__api__google_maps != '' ) {

			var map;
		
			var title = jQuery('#map').data('title');
			var color = jQuery('#map').data('color');
			var zoom = jQuery('#map').data('zoom') ? jQuery('#map').data('zoom') : 12;
			var description = jQuery('#map').data('description');
			
			var lat = jQuery('#map').data('lat');
			var long = jQuery('#map').data('long');
			var myLatLng = new google.maps.LatLng(lat,long);

			function initialize() {

				var roadAtlasStyles = [
						{elementType: 'geometry', stylers: [{color: '#242f3e'}]},
						{elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
						{elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
						{
							featureType: 'administrative.locality',
							elementType: 'labels.text.fill',
							stylers: [{color: '#d59563'}]
						},
						{
							featureType: 'poi',
							elementType: 'labels.text.fill',
							stylers: [{color: '#d59563'}]
						},
						{
							featureType: 'poi.park',
							elementType: 'geometry',
							stylers: [{color: '#263c3f'}]
						},
						{
							featureType: 'poi.park',
							elementType: 'labels.text.fill',
							stylers: [{color: '#6b9a76'}]
						},
						{
							featureType: 'road',
							elementType: 'geometry',
							stylers: [{color: '#38414e'}]
						},
						{
							featureType: 'road',
							elementType: 'geometry.stroke',
							stylers: [{color: '#212a37'}]
						},
						{
							featureType: 'road',
							elementType: 'labels.text.fill',
							stylers: [{color: '#9ca5b3'}]
						},
						{
							featureType: 'road.highway',
							elementType: 'geometry',
							stylers: [{color: '#746855'}]
						},
						{
							featureType: 'road.highway',
							elementType: 'geometry.stroke',
							stylers: [{color: '#1f2835'}]
						},
						{
							featureType: 'road.highway',
							elementType: 'labels.text.fill',
							stylers: [{color: '#f3d19c'}]
						},
						{
							featureType: 'transit',
							elementType: 'geometry',
							stylers: [{color: '#2f3948'}]
						},
						{
							featureType: 'transit.station',
							elementType: 'labels.text.fill',
							stylers: [{color: '#d59563'}]
						},
						{
							featureType: 'water',
							elementType: 'geometry',
							stylers: [{color: '#17263c'}]
						},
						{
							featureType: 'water',
							elementType: 'labels.text.fill',
							stylers: [{color: '#515c6d'}]
						},
						{
							featureType: 'water',
							elementType: 'labels.text.stroke',
							stylers: [{color: '#17263c'}]
						}
					];

				var mapOptions = {
					zoom: zoom,
					center: myLatLng,
					disableDefaultUI: true,
					scrollwheel: false,
					navigationControl: false,
					mapTypeControl: false,
					scaleControl: false,
					draggable: false,
					mapTypeControlOptions: {
						mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'usroadatlas']
					}
				};

				var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

				var img = jQuery('#map').data('img');

				var marker = new google.maps.Marker({
					position: myLatLng,
					map: map,
					icon: img,
					title: ''
				});
			
				var contentString = '<div style="max-width: 300px" id="content">'+
										'<div id="bodyContent">'+
										'<h5 class="color-primary">'+
											'<strong>'+
											title +
											'</strong>'+
											'</h5>' +
										'<p style="font-size: 12px">' +
											description +
										'</p>'+
										'</div>'+
									'</div>';

				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
			
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});

				var styledMapOptions = {
					name: 'US Road Atlas'
				};

				var usRoadMapType = new google.maps.StyledMapType(
					roadAtlasStyles, styledMapOptions);

				map.mapTypes.set('usroadatlas', usRoadMapType);
				map.setMapTypeId('usroadatlas');

			}
			google.maps.event.addDomListener(window, 'load', initialize);
		}
	}
}

function firstInit() {

	//Start Page Loader
	jQuery('.page-loader').delay(800).fadeOut('slow');
	//End Page Loader

	//Burger - Menu
	jQuery('.opened-menu, .opened-menu-2').on('click', function() {

		jQuery(this).toggleClass('active');
		jQuery('.burger-menu').toggleClass('open');

	});

	jQuery('.x-filter').on('click', function() {

		jQuery('.opened-menu, .opened-menu-2').toggleClass('active');
		jQuery('.burger-menu').toggleClass('open');

	});

	jQuery('.trigger-header .burger-menu > nav > ul > li').on('click', function() {

		jQuery(this).parent().siblings().toggleClass('no-hovered');
		jQuery(this).toggleClass('click');
		jQuery(this).parent().siblings().removeClass('click');

	});

	jQuery('.burger-menu > nav > ul > li > .sub-menu').parent().addClass('hover-sub-menu');

	jQuery('.burger-menu nav ul li .sub-menu').parent().find('> a').on('click', function(e){

		e.preventDefault();

	});
	//End Burger - Menu

	jQuery('.widget_wp_popular_articles').contents().filter(function() {
	    return this.nodeType == 3
	}).each(function(){
	    this.textContent = null;
	});

	//Inline - Menu
	jQuery('.inline-header .opened-menu-2').click(function() {

		jQuery('.inline-header').toggleClass('reveal-menu', 300, 'easeIn');

	});
	//End Inline - Menu

	//Start Go - Top
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
	//End Go - Top

	jQuery('.jplayerButton').on('click', function(){

		jQuery(this).toggleClass('active');

		jQuery('.playlist-wrapper').fadeToggle('open');

		jQuery('body').toggleClass('opacityPlaylist');

	});

}

function reinitJS() {

	var wH = jQuery(window).height();

	jQuery('.breadcrumb-fullscreen').css('height',wH);

	jQuery('.breadcrumb:not(.breadcrumb-fullscreen)').each(function(){

		jQuery('header.header').addClass('no-breadcrumb-fullscreen');

	});

	if ( jQuery('.woo-products').length ) {

		jQuery('.woo-products').isotope();

		jQuery('.woo-products').imagesLoaded(function(){

			jQuery('.woo-products').isotope();

		});

	}

	if ( jQuery('.gallery-section-type-1').length ) {

		var aqura_gallery_masonry_container = jQuery('.gallery-section-type-1 article').parent();

		aqura_gallery_masonry_container.isotope({masonry: {
		  columnWidth: 1
		}});

		aqura_gallery_masonry_container.imagesLoaded(function(){

			aqura_gallery_masonry_container.isotope({masonry: {
			  columnWidth: 1
			}});

		});

	}

	if ( jQuery('.shop-type-1, .shop-single-type-1').length ) {

		jQuery('.main-music-player').addClass('active-forced');

	} else {

		jQuery('.main-music-player').removeClass('active-forced');

	}

	var aqura_header_words = jQuery(".hero-title-3 h1");

	for (i = 0; i < aqura_header_words.length; i++) {
		var words = aqura_header_words[i].innerHTML.split(" ");

		for (j = 0; j < words.length; j++) {
			if(words[j][0] != "&") {
				words[j] = "<span>" + words[j][0] + "</span>" + words[j].substring(1);
			}
		}

		aqura_header_words[i].innerHTML=words.join(" ");
	}

	jQuery('.hero-content-type-2 h1').each(function(index, element) {
		var heading = jQuery(element), word_array, last_word, first_part;

		word_array = heading.html().split(/\s+/); // split on spaces
		last_word = word_array.pop();             // pop the last word
		first_part = word_array.join(' ');        // rejoin the first words together

		heading.html([first_part, ' <span>', last_word, '</span>'].join(''));
	});

	var breadcrumbH = jQuery(window).height();

	if (jQuery(window).width() >= 1200){  

		jQuery('.breadcrumb-video-content').each(function(){

			breadcrumbH = (jQuery('.breadcrumb').outerHeight() - 250);

		});

	};

	if ( jQuery('.link-yaku').length > 0 ) {

		jQuery('.link-yaku').each(function(){

				var $this = jQuery(this),

						breadcrumbLength = $this.text();

				$this.html('');

				for (var i = 0, len = breadcrumbLength.length; i < len; i++) {

					var actualTitleString = $this.html();

					$this.html(actualTitleString + '<span>' + breadcrumbLength[i] + '</span>');
				}
		});
	}

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

	function unAffixPhoneMenu() {

		jQuery('header.header').removeClass('phone-menu-bg');

	};

	jQuery('.breadcrumb-fullscreen-parent').affix({

			offset: {

				top: function () {

					return (this.top = (breadcrumbH - 75))

				}

			}

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

	jQuery(window).scroll(function(){

		var actualScroll = jQuery(window).scrollTop() * 0.5;

		jQuery('.breadcrumb').css({
			'background-position': '50% ' + actualScroll + 'px'
		});

	});

	//Fluid - Box Options
	jQuery('.fluidbox').fluidbox();
	//End Fluid - Box Options

	//Parallax
	jQuery('.parallax').parallax();
	//End Parallax

	//Light - Box Options
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

	jQuery(".lightbox").attr('rel','gallery').fancybox({
		fitToView: true,
		autoSize :  true,
		margin : 30,
		autoScale : true,
		width : '100%',
		height : '100%',
		showNavArrows: true,
		showCloseButton: true,
		 helpers:  {
				thumbs : {
						width: 50,
						height: 50
				}
		}
	});
	//End Light - Box Options

	if ( jQuery('.scale-bgk').length ) {

			jQuery('.scale-bgk').each(function(){

				jQuery(this).closest('.vc_column_container').css('position', 'initial');

				var $this       	= jQuery(this),
					scaleExtra    	= 0.3,
					originSclae   	= 1,
					biggestScale  	= originSclae + scaleExtra,
					offsetGap     	= 200;

				jQuery(window).scroll(function(){

				var actualScroll    	= jQuery(window).scrollTop(),
					windowH       		= jQuery(window).height(),
					bottomScroll    	= actualScroll + windowH,
					bgHeight      		= $this.parent().outerHeight(),
					offsetTop       	= $this.offset().top,
					offsetTopStart  	= offsetTop - offsetGap,
					offsetBottom    	= offsetTop + bgHeight,
					offsetBottomEnd 	= offsetBottom + offsetGap,
					totalAnimation  	= offsetBottomEnd - offsetTopStart + windowH,
					scaleAddUnit    	= scaleExtra / totalAnimation,
					scrollStopFromStart = actualScroll - offsetTopStart;

				if ( (bottomScroll > offsetTopStart) && (actualScroll < offsetBottomEnd) ) {

					var scrollIncreaseUnit = scrollStopFromStart * scaleAddUnit,
						scrollDecreaseUnit = biggestScale - scrollIncreaseUnit;

					$this.css({
						'transform': 'scale(' + scrollDecreaseUnit + ')',
					})

				}

			});

		});

	}

	jQuery('.bio-years .au-img li a').on("click", function(e) {
		
		var $descriptions = jQuery("div[class^='about-']");
		var $links = jQuery("a[id^='year-desc-']");

		var descIndex = 0;
		$links.each(function(index, value) {
			if (this.id === e.currentTarget.id) {
				descIndex = index;
			}
		});

		$descriptions.addClass('hide-content');
		$links.each(function(index) {
			jQuery(this).parent().removeClass('active');
		});

		$descriptions.each(function(index) {
			if(index === descIndex) {
				jQuery(this).removeClass('hide-content');
			}
		});
		$links.each(function(index) {
			if(index === descIndex) {
				jQuery(this).parent().addClass('active');
			}
		});

	});

	jQuery('.shop-single-thumbnails .au-img li a').on("click", function(e) {

		var $this =	jQuery(this),
			theParent = $this.closest('.woocommerce-product-gallery'),
			theIndex = $this.attr('data-index');

		$this.parent().siblings().removeClass('active');
		$this.parent().addClass('active');

		theParent.find('.bio-description > div').addClass('hide-content');
		theParent.find('.bio-description > div[data-index="' + theIndex + '"]').removeClass('hide-content');

	});
	/* end biography trigger */

	/*Diverse*/
	jQuery('.glitch-hover .glitch').addClass('glitch--vertical');
	/*Divers*/

	/* start click album tracklist*/
	jQuery('.tracklist ul li').on('click', function(){

		jQuery('.tracklist ul li.active').removeClass('active'); 

		jQuery(this).toggleClass('active');

	});
	/* end click album tracklist */

	//Band-Header
	jQuery('.band-bgk').each(function(){

		var bgk = jQuery(this).attr('data-image-src'); 

		jQuery(this).css('background-image', 'url('+ bgk +')');

	});
	
	jQuery( ".band-members li" ).each(function( ) {
	
		var $this = jQuery(this),
				srcHeader = $this.attr('data-image-src');
		
		$this.append('<span class="improv"></span>');
		
		var improvApp = $this.find('.improv');
		
		improvApp.css({
			
			'background-image' : 'url(' + srcHeader + ')'
		
		});
		
	});

	
	jQuery('.band-members li').hover(function(){

		var value = jQuery(this).attr('data-image-src');

		jQuery('.band-bgk').css('background-image', 'url('+ value +')');

	});

	jQuery('.band-members ul').hover(function(){


	},function(){

		var inheritBgk = jQuery('.band-bgk').attr('data-image-src');

		jQuery('.band-bgk').css('background-image', 'url('+ inheritBgk +')');

	});
	//End Band Header

	//Start Isotope & Filter
	function isotope() {

		var container = jQuery('.aqura-filter-content ul');

		if ( container.length ) {

			container.imagesLoaded(function() {

			 container.isotope();
			 container.isotope('layout');

			});

			container.isotope();

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

		}

	 };

	 isotope();

	 jQuery(window).resize(function(){

		isotope();
	});
	// END Isotope & Filter

	//Hover Functions
	jQuery('.simple-block .block-container').hover(
		 function(){ jQuery(this).addClass('active') },
		 function(){ jQuery(this).removeClass('active') }
	);

	jQuery('.curtain-image-container').each(function(){

		var $this = jQuery(this),
			numberOfElements = $this.find('.curtain-image').size();

		if ( numberOfElements === 3 ) {

			$this.addClass('curtain-image-container--3-elements');

		} else if ( numberOfElements === 2 ) {

			$this.addClass('curtain-image-container--2-elements');

		} else if ( numberOfElements === 1 ) {

			$this.addClass('curtain-image-container--1-elements');

		}

	});

	jQuery('.curtain-image-container .curtain-image').hover(function() {

		jQuery(this).parent().toggleClass('active');
		jQuery(this).toggleClass('active');

	});
	//End Hover

	/***********************************************************************************************/
	/* JPLAYER */
	/***********************************************************************************************/
	jQuery('.trak-item audio').each(function(){
		
			var seconds = jQuery(this)[0].duration;
			var duration = moment.duration(seconds, "seconds");
			
			var time = "";
			var hours = duration.hours();
			if (hours > 0) { time = hours + ":" ; }
			
			time = time + duration.minutes() + ":" + duration.seconds();
			jQuery(this).parent().find('.trak-duration').text(time);
	});
	/***********************************************************************************************/
	/* END JPLAYER */
	/***********************************************************************************************/

	/* start blog masonry load image*/
	jQuery('.blog-type-3-masonry .blog-type-3-masonry-content .fix-margin').isotope();
	var container = jQuery('.blog-type-3-masonry .blog-type-3-masonry-content .fix-margin');
	/* end blog masonry load image*/

	//Activate the "star" plugin from StarHomePage
	jQuery(".star").each(function() {
			postars(jQuery('.cover').get(0)).init();
	});
	//End Star Plugin

	//Start Events Counter
	jQuery('#clock').each(function(){

		var $this 	= jQuery(this),
			theDate = $this.attr('data-countdown');

		$this.countdown(theDate, function(event) {
			var $this = jQuery(this).html(event.strftime(''
				+ '<div class="column"><span class="text">%D</span> <span class="label-counter">days</span></div>'
				+ '<div class="column"><span class="text">%H</span> <span class="label-counter">hrs</span></div>'
				+ '<div class="column"><span class="text">%M</span> <span class="label-counter">mins</span></div>'
				+ '<div class="column"><span class="text">%S</span> <span class="label-counter">sec</span></div>'));
		});

	});

	//Toggle Form
	jQuery('.trigger-form').click(function () {

		jQuery('.comment-form, .comments-section').toggleClass('show-content');

		jQuery(this).toggleClass('active');

	});;
	//End Toggle Form

	//Change Plus Icon
	jQuery('.lyrics .panel .panel-heading .panel-title a').click(function(){

		jQuery(this).toggleClass('active');

	});
	//End Change Plus Icon

	// Start Owl-Carousel
	jQuery(".custom-arrow-carousel").owlCarousel({
		items:1,
		nav:true,
		navText: ['<a class="arrow-left"></a>','<a class="arrow-right"></a>']
	});
	//End Owl-Carousel

	//Insta Carousel Type-1
	jQuery(".insta-carousel").owlCarousel({
			
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		items : 4,
		itemsDesktop : [1199,3],
		itemsDesktopSmall : [979,3],

	});
	//End Insta Carousel Type-1

	//Insta Carousel Type-2
	jQuery("#insta-gallery-carousel").owlCarousel({
			
		loop:true,
		items: 3,
		nav:true,
		navText: ['<a class="arrow-left"></a>','<a class="arrow-right"></a>']

	});
	//End Insta Carousel Type-2

	//Insta Carousel Type-3
	jQuery(".insta-carousel-type-3").owlCarousel({
			
		left: true,	
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		items: 4

	});
	//End Insta Carosuel Type-3

	//Start Fade Elements
	jQuery(window).scroll(function() {

		jQuery('.fade-element').css('opacity', 1 - jQuery(window).scrollTop() / 250);

	});
	//End Fade Elements

	//Add Bgk Shop Menu
	jQuery(window).scroll(function() {

		var scroll = jQuery(window).scrollTop();

		if (scroll > 62) {

			jQuery('.shop-type-1-menu .inline-header, .shop-type-1-menu .trigger-header, .shop-type-1-menu .trigger-header-type-2').addClass('active');

		}

		else {

			jQuery('.shop-type-1-menu .inline-header, .shop-type-1-menu .trigger-header, .shop-type-1-menu .trigger-header-type-2').removeClass('active');

		}
	});
	//End Add Bgk Shop Menu

	//Start Fade bgkBread
	jQuery(window).scroll(function() {

		var scroll = jQuery(window).scrollTop();

		if ( scroll > 500 ) {

			jQuery('.body-cherry .inline-header').addClass('active');

		}

		else {

			jQuery('.body-cherry .inline-header').removeClass('active');
		
		}

	});
	//End Fade bgkBread

	//Unit Testin JS
	if (jQuery('p input').hasClass('file')){
		jQuery('.file').addClass('active');
	}

	jQuery('.article-post').find('.file').each(function(index,element){
		var id = jQuery(element).attr('id');
		jQuery("label[for='"+id+"']").addClass('label-error-class');
	});

	//End Unit Testing JS

	//Start Instagram Widget
	if ( (jQuery('#instagram-sidebar-widget').length) && (aqura_static_resources.aqura_theme__api__instagram_user != '') && (aqura_static_resources.aqura_theme__api__instagram != '') ) {
		var feedSidebar = new Instafeed({
			get: 'user',
			userId: parseInt( aqura_static_resources.aqura_theme__api__instagram_user ), // your user id
			accessToken: aqura_static_resources.aqura_theme__api__instagram, // your access token
			sortBy: 'most-recent',
			template: '<li><a href="{{link}}" target="_blank"><img class="img-responsive" src="{{image}}" /></a></li>',
			target: 'instagram-sidebar-widget',
			limit: 9,
			resolution: 'low_resolution'
		});
		if (jQuery('#instagram-sidebar-widget').length>0) {
				feedSidebar.run();
		}
	}
	//End Instagram Widget

	// Kadar JS

	if ( jQuery('.blog-single-type-2-article').length && jQuery('.blog-single-type-2-article article p').length ) {

		jQuery('.blog-single-type-2-article > article p:first-of-type').addClass('f-letter');

	}

	jQuery(".aqura_ajax-update-content").fitVids({ customSelector: "iframe:not([src~='soundcloud.com']):not([src~='bandsintown.com'])"});

}

<!-- ================================================== -->
<!-- =============== START BASIC JS ================ -->
<!-- ================================================== -->
	
jQuery(document).ready(function(){
	
	"use strict";

	firstInit();
	setTimeout(function(){
		reinitJS();
		if (typeof playerPlayOne !== 'undefined') {
			playerPlayOne.init();
		}
	},10);

	if ( jQuery('.aqura-dark-header-is-displayed , .shop-type-1 , .shop-single-type-1').length ) {

		jQuery('body').addClass('shop-type-1-menu');

	}



});

<!-- ================================================== -->
<!-- =============== END BASIC JS ================ -->
<!-- ================================================== -->

var ajaxLoadOneTime = 'isTrue';

function customVcCss(custom_style) {

	jQuery('[class*="vc_custom_"]').remove();

	if ( custom_style.length ) {

		jQuery(custom_style).appendTo("head");

	}

}

var transition = function($newEl) {
	var $oldEl = this;
	$newEl.hide();

	setTimeout(function(){
		$oldEl.replaceWith($newEl);
		$newEl.show();
	},200);
}

var ignored = ['.pdf','.doc','.eps','.png','.jpg','.zip','admin','wp-','wp-admin','feed','#' , 'event_tickets' , '?lang=', '&lang=', '&add-to-cart=', '?add-to-cart=', '?remove_item', 'download_file=', 'download_ticket'];

if ( typeof aqura_non_ajax_links === "object" && aqura_non_ajax_links.length >= 1 ) {
	ignored = ignored.concat( aqura_non_ajax_links )
}

jQuery('body:not(.djax-disabled)').djax('.aqura_ajax-update-content', ignored, transition);

jQuery(window).bind('djaxClick', function(e, data) {

	e.preventDefault();

	// jQuery('.page-loader').show();

	jQuery('html').addClass('loading');

	jQuery('html').addClass('transition-time');

	jQuery('.burger-menu').removeClass('open');
	jQuery('.opened-menu').removeClass('active');

});

jQuery(window).bind('djaxLoad', function(e, data) {

	/**
	* Let's get the custom CSS added by Visual Composer and append it in the page.
	*/
	var vc_custom_style = jQuery(jQuery.parseHTML(data.response)).filter('[data-type="vc_shortcodes-custom-css"]');

	customVcCss(vc_custom_style);

	jQuery(window).scrollTop(0);

	/* Start VC JS */
	if( typeof vc_js == 'function' ) {
		setTimeout(function(){
			window.vc_js();
		},200);
	}

	initMap();

	setTimeout(function(){
		reinitJS();
		playerPlayOne.init();
	},200);

	setTimeout(function() {

		// jQuery('.page-loader').fadeOut('slow');

		jQuery('html').removeClass('loading');

		// Replace the body classes
		var parser = new DOMParser();
		var doc = parser.parseFromString(data.response, "text/html");
		// Your class(es)
		var docClass = doc.body.getAttribute('class');
		var finalClass = docClass.replace('firstLoad', '');
		// Garbage collection, you don't need this anymore.
		parser = doc = null;
		// Replace the body classes now
		document.body.className = finalClass;

		if ( jQuery('.aqura-dark-header-is-displayed , .shop-type-1').length ) {

			jQuery('body').addClass('shop-type-1-menu');

		} else {

			jQuery('body').removeClass('shop-type-1-menu');

		}

	}, 400);

});

