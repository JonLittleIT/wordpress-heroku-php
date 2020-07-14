'use strict';

//On document ready
(function($) {

	// Global consts
	const body           = $('body.beehive'),
		  header         = $('.site-header'),
		  navbar         = $('nav.beehive-navbar'),
		  page           = $('#beehive-page'),
		  preloader      = $('.beehive-preloader'),
		  ilogoSrc       = $('#beehive-social-panel .panel-logo img').attr('src'),
		  defaultLogoSrc = $('.beehive-navbar .default-logo').attr('src');

	// For better navbar scrolling for fixed nav
	if( navbar.hasClass('fixed-top') ) {
		let lastScrollTop = 0;
		$(window).on('scroll', function() {
			if ($(this).scrollTop() > 50) {
				navbar.addClass('nav-scrolling');
			  if ($(this).scrollTop() > lastScrollTop){
					navbar.addClass('to-bottom');
					navbar.removeClass('to-top');
			  } else {
					navbar.addClass('to-top');
					navbar.removeClass('to-bottom');
			  }
			 lastScrollTop = $(this).scrollTop();
			} else {
				navbar.removeClass('nav-scrolling');
			}
		});
	}
	
	// Default navbar 
	if(navbar.hasClass('default')) {

		// Main menu container
		const navbarMainContainer = $('.navbar-main-container'),
			  navbarDropdownToggle = navbarMainContainer.find('.dropdown > a.dropdown-toggle'),
			  navbarBreakingPoint = 991.98;

		// Slidenav and mobile nav
		if(body.hasClass('desktop-slidenav')) {
			navbarMainContainer.hiraku({
				btn: '.beehive-navbar.default .beehive-toggler',
				direction: 'right',
			});
		} else {
			navbarMainContainer.hiraku({
				btn: '.beehive-navbar.default .beehive-toggler',
				direction: 'right',
				breakpoint: navbarBreakingPoint
			});
			navbarMainContainer.find('ul.navbar-main').flexMenu({
				showOnHover: false,
				cutoff: 0,
				linkText: beehive_data.more_text,
				linkClass: 'nav-item dropdown',
				disableClick: true,
				shouldApply: function () {
					if(window.innerWidth < navbarBreakingPoint) {
						return false;
					} else {
						return true;
					}
				},
			});
		}

		// Prevent bootstrap navbar propagation
		navbarMainContainer.find('.dropdown').on('hide.bs.dropdown', function(e){
			e.preventDefault();
			e.stopPropagation();
		}, false);

		// Trigger menu dropdowns
		let dropDownTimer;
		$(window).on('load resize', function() {
			clearTimeout(dropDownTimer);
			dropDownTimer = setTimeout(beehiveMainMenuDropdowns, 250);
		});

		// Function navbar dropdowns.
		function beehiveMainMenuDropdowns() {
			if(navbarDropdownToggle.length) {
				navbarDropdownToggle.off('click', beehiveMenuDropdownToggle);
				navbarDropdownToggle.on('click', beehiveMenuDropdownToggle);
				body.off('mouseup', beehiveDropdownMouseUp);
				body.on('mouseup', beehiveDropdownMouseUp);
				if(!navbarMainContainer.closest('.js-hiraku-offcanvas').hasClass('js-hiraku-offcanvas-active')) {
					navbarDropdownToggle.attr('aria-expanded', 'false');
				}
			}
		}

		// Function menu dropdown toggle
		function beehiveMenuDropdownToggle() {
			if( navbarMainContainer.closest('.js-hiraku-offcanvas').hasClass('js-hiraku-offcanvas-active') ) {
				$('.dropdown > a.dropdown-toggle', $(this).parent().parent()).not(this).attr('aria-expanded', 'false');
				if( 'false' == $(this).attr('aria-expanded') ) {
					$(this).attr('aria-expanded', 'true');
				} else {
					$(this).attr('aria-expanded', 'false');
				}
			}
		}

		// Function dropdown mouse up 
		function beehiveDropdownMouseUp(e) {
			if(navbarDropdownToggle && navbarDropdownToggle.length > 0) {
				if (!navbarDropdownToggle.is(e.target) && navbarDropdownToggle.has(e.target).length === 0) {
					navbarDropdownToggle.attr('aria-expanded', 'false');
				}
			}
		}

		// Switch logo on mobile
		swithDefaultLogoOnMobile();
		$(window).on('resize', swithDefaultLogoOnMobile);
	}

	// Social navbar
	if(navbar.hasClass('social')) {

		// Ajax Search
		const ajaxSearch = {
			form: $('#ajax-search-form'),
			results: $('#ajax-search-result'),
			delay: 400,
			minCars: 3,
			timeOut: false,
			doSearch: function() {
	
				// Search field
				const searchField = this.form.find('#ajax-search-textfield');
	
				// Return early
				if(!searchField.length) {
					return;
				}

				// Prevent the form from being submitted
				this.form.on('submit', function(e) {
					e.preventDefault();
				});
	
				// Perform ajax
				searchField.on('keyup', function(e){
					clearTimeout(this.timeOut);
					if( $.trim( e.target.value ) !== '' && $.trim( e.target.value.length ) >= this.minCars ) {
						this.timeOut = setTimeout($.proxy(this.ajaxRequest, this, e.target.value), this.delay);
					} else {
						this.results.fadeOut();
					}
				}.bind(this));
	
				// Hide results on body click
				body.on('mousedown', function(e) {
					let results = this.results;
					if (!results.is(e.target) && results.has(e.target).length === 0) {
						results.fadeOut();
					}
				}.bind(this));
	
				// Show results on input click
				searchField.on('click focus', function (e) {
					if( $.trim( e.target.value ) !== '' && $.trim( e.target.value.length ) >= this.minCars && ! this.results.is(':empty') ) {
						this.results.show();
					}
				}.bind(this));
			},
			ajaxRequest: function(searchStr) {
	
				// Clear timeout
				clearTimeout(this.timeOut);
				
				// Query
				let query   = searchStr,
					running = false;
				
				// Return if another query is taking place
				if(running === true ) {
					return;
				}
				
				// Elements
				let results = this.results,
					loading = this.form.find('.beehive-loading-ring');
	
				// Send request and get response
				$.ajax({
					type: 'POST',
					data: {
						action: 'beehive_ajax_search',
						search: query,
						search_nonce: beehive_data.beehive_search_nonce,
					},
					datatype: 'json',
					url: beehive_data.ajaxurl,
					beforeSend: function() {
						loading.show();
						running = true;
					},
					success: function(response) {
						results.html(response).show();
					},
					complete: function() {
						loading.fadeOut();
						running = false;
					}
				});
			},
			
		}
		
		// Do ajax search
		ajaxSearch.doSearch();
	}

	// Social template magics
	if (body.hasClass('beehive-social-layout')) {
		
		// Switch social template view on smaller screen
		beehiveSwitchSocialView();
		$(window).on('resize', beehiveSwitchSocialView);
		
		// Append hiraku off canvas panel button
		if(navbar.hasClass('social')) {
			$('nav.beehive-navbar > div').prepend($('<button>').addClass('beehive-toggler panel-toggler').attr('type','button').append('<span class="icon-bar bar1"></span>').append('<span class="icon-bar bar2"></span>').append('<span class="icon-bar bar3"></span>'));
		}
		
		// Trigger hiraku sidebar
		$('#beehive-social-panel').hiraku({
			btn: '.panel-toggler',
			direction: 'left',
			breakpoint: 767.98
		});
		
		// App style navigation
		beehiveAppStyleNavbar();
		$(window).on('resize', beehiveAppStyleNavbar);
		
		// Trigger hiraku sidebar
		$('#navbar-account-sidebar').hiraku({
			btn: '.account-toggler',
			direction: 'right',
			breakpoint: 767.98
		});
		
		// Fix for hiraku
		if(window.innerWidth < 767.98) {
			if(!$('#beehive-page + .js-hiraku-offcanvas').hasClass('js-hiraku-offcanvas-active')) {
				$('#beehive-page + .js-hiraku-offcanvas').addClass('js-hiraku-offcanvas-active');
			}
		}
		
		// Add title attr on collapsed panel menu link
		if(body.hasClass('panel-collapsed')) {
			$('.panel-icon-only ul.navbar-panel li a').each(function() {
				$(this).attr('title', $(this).text());
			});
		}
	}

	// Initialize sticky sidebar
	let stickyTimer;
	$(window).on('load resize', function() {
		clearTimeout(stickyTimer);
		stickyTimer = setTimeout(beehiveStickySidebar, 500);
	});

	// Fire login modal
	if(!body.hasClass('logged-in') && (beehive_data.light_modal === 'on' || body.hasClass('bp-user') || (body.hasClass('single-item') && body.hasClass('groups')))) {
		$(window).on('load',function(){
        	$('#login-modal').modal('show');
    	});
	}
	
	// Initialize custom scrollbar
	$(window).on('load',function(){
		$('.ass-scrollbar, #message-threads').mCustomScrollbar({
			theme:'minimal-dark',
			mouseWheel:{ preventDefault:true }
		});
	});

	// Trigger component flex menu
	$('.nav-component .nav-component-list').flexMenu({
		showOnHover: false,
		cutoff: 0,
		popupClass: "dropdown-menu-right",
		linkText: '<i class="uil-ellipsis-h"></i>',
		hOverflow: true,
	});

	//Initialize scroll animation
	const wow = new WOW({
		boxClass: 'animate-item',
	});
	wow.init();

	// Blog masonry
	let masonryTimer;
	$(window).on('load resize', function() {
		clearTimeout(masonryTimer);
		masonryTimer = setTimeout(function() {
			$('.blog-layout-grid.masonry').masonry({
				itemSelector: '.beehive-post'
			});
		}, 250);
	});

	// On window load
	$(window).on('load', function() {

		// Preloader
		const preloaderFadeOutTime = 500;
		function hidePreloader() {
			preloader.fadeOut(preloaderFadeOutTime);
		}
		hidePreloader();

		// Responsive video
		$(".entry-content .is-type-video").fitVids();

		// Admin bar fixed
		$('#wpadminbar').css('position', 'fixed');
	});

	// Functions and definations
	// @since 1.0.0
	
	// Sticky sidebar
	// Stick on larger screen
	// And unstick on smaller screen
	function beehiveStickySidebar () {
		
		// Sticky selectors
		const stickyWidget   = $('aside.sticky-sidebar > .widget:last-of-type'),
			  stickyNavmenu  = $('aside.sticky-sidebar > .sidebar-nav-menu');

		// Stick and unstick
		if( stickyWidget.length || stickyNavmenu.length ) {
			if(window.innerWidth > 991.98) {
			
				if(body.hasClass('beehive-social-layout')) {
					stickyWidget.stick_in_parent({
						offset_top: Number(beehive_data.stick_offset),
						bottoming: false,
					});
					stickyNavmenu.stick_in_parent({
						offset_top: stickyWidget.outerHeight(true) + Number(beehive_data.stick_offset),
						bottoming: false,
					});
					if( 90 == beehive_data.stick_offset ) {
						$(window).on('scroll', function() {
							if( stickyWidget.css('position') == 'fixed' && parseFloat( stickyWidget.css('top') ) < beehive_data.stick_offset ) {
								stickyWidget.css('top', beehive_data.stick_offset + 'px' );
								stickyNavmenu.css('top', (stickyWidget.outerHeight(true) + Number(beehive_data.stick_offset)) + 'px');
							}
						});
					}
				} else {
					stickyWidget.stick_in_parent({
						offset_top: Number(beehive_data.stick_offset),
					});
					$(document).ajaxComplete(function(){
						stickyWidget.trigger('sticky_kit:recalc');
					});
				}
			} else {
				stickyWidget.trigger('sticky_kit:detach');
				stickyNavmenu.trigger('sticky_kit:detach');
			}
		}
	}
	
	// Switch expanded social templte view
	// on smaller screens
	function beehiveSwitchSocialView() {
		const panelLogo = $('#beehive-social-panel .panel-logo img');
		if(body.hasClass('panel-expanded')) {
			if(window.innerWidth < 1199.98) {
				body.addClass('panel-collapsed');
			} else if(window.innerWidth > 1920.98) {
				body.addClass('panel-collapsed');
			} else {
				body.removeClass('panel-collapsed');
			}
		}
		if(window.innerWidth > 767.98) {
			if( ilogoSrc && beehive_data.icon_logo_url ) {
				if( body.hasClass('panel-collapsed')) {
					if( panelLogo.attr('src') !== beehive_data.icon_logo_url ) {
						panelLogo.attr('src', beehive_data.icon_logo_url);
					}
				} else {
					if( panelLogo.attr('src') !== ilogoSrc ) {
						panelLogo.attr('src', ilogoSrc);
					}
				}
			}
		} else {
			if( panelLogo.attr('src') !== ilogoSrc ) {
				panelLogo.attr('src', ilogoSrc);
			}
		}
	}

	// Navbar account sidebar
	// This function takes care of app style menu bar for social template 
	// if certain conditions are met
	function beehiveAppStyleNavbar() {

		// Return if buddypress is not active
		if( ! beehive_data.bp_is_active ) {
			return;
		}
			
		// Execute code if conditions are met
		if(body.hasClass('logged-in') && body.hasClass('beehive-social-layout') && navbar.hasClass('social')) {
			
			// return early if menu not exists
			if(!$('ul#navbar-user').length) {
				return;
			}
			
			// Append hiraku off canvas navbar account sidebar button
			if(!$('nav.beehive-navbar button.account-toggler').length && navbar.hasClass('social')) {
				$('nav.beehive-navbar > div').prepend($('<button>').addClass('beehive-toggler account-toggler').attr('type','button').append(beehive_data.avatar));
			}
			
			// Add sidebar container
			if(!$('#navbar-account-sidebar').length) {
				page.after('<div id="navbar-account-sidebar"></div>');
			}
			
			// Sidebar container
			const accountSlidebar = $('#navbar-account-sidebar');
			//Navbar account
			const navbarAccount = $('#navbar-user li#myaccount-url-list');
			
			// Do the magic
			if(window.innerWidth < 767.98) {
				if(!$('#navbar-account-sidebar ul.member-account-menu').length) {
					header.addClass('mobile-header');
					accountSlidebar.addClass('navbar-account-sidebar').append(navbarAccount.find('ul.member-account-menu'));
					navbarAccount.hide();
					
					if(!$('.nav-top-bar').length) {
						const navContainer = $('nav.beehive-navbar > div');
						navContainer.prepend('<div class="nav-top-bar"></div>');
						const navTop = $('.nav-top-bar');
						navTop.append(navContainer.find('button.account-toggler')).append(navContainer.find('button.panel-toggler')).append(navContainer.find('#beehive-ajax-search'));
					}
					
					if(!header.hasClass('overlay-header') && navbar.hasClass('fixed-top')) {
						if(header.css('transition')) {
							header.on('transitionend', () => {
								header.css({'height': navbar.outerHeight()});
								header.off('transitionend');
							})
						} else {
							header.css({'height': navbar.outerHeight()});
						}
					}
					
					if(navbar.hasClass('fixed-top')) {
						$(window).on('scroll', function() {
							if(navbar.hasClass('nav-scrolling') && navbar.hasClass('to-bottom')) {
								if(body.hasClass('admin-bar')) {
									navbar.css({'top': ($('#wpadminbar').outerHeight() - $('.nav-top-bar').outerHeight())});
								} else {
									navbar.css({'top': $('.nav-top-bar').outerHeight() * -1});
								}
							} else {
								navbar.removeAttr('style');
							}
						});
					}
				}
			} else {
				if(!$('#navbar-user li#myaccount-url-list ul.member-account-menu').length) {
					navbar.removeClass('mobile-header');
					navbarAccount.find('div.dropdown-menu').append(accountSlidebar.find('ul.member-account-menu'));
					navbarAccount.show();
					accountSlidebar.removeClass('navbar-account-sidebar').html('');
					
					if($('.nav-top-bar').length) {
						const topbarContent = $('.nav-top-bar').contents();
						$('.nav-top-bar').replaceWith(topbarContent);
					}
					
					if(!header.hasClass('overlay-header') && navbar.hasClass('fixed-top')) {
						header.removeAttr('style');
					}
				}
			}
		}
	}

	// Switch logo on mobile
	// If mobile logo is set on the page, then switch default logo on mobile
	function swithDefaultLogoOnMobile() {
		const defaultLogo = $('.beehive-navbar .default-logo');
		if(!defaultLogo.length) {
			return;
		}
		if( beehive_data.mobile_logo_url ) {
			// Elementor breaking point
			if(window.innerWidth < 768) {
				defaultLogo.attr('src', beehive_data.mobile_logo_url);
			} else {
				if( defaultLogo.attr('src') !== defaultLogoSrc ) {
					defaultLogo.attr('src', defaultLogoSrc);
				}
			}
		}
	}

})( jQuery );
