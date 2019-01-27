(function($) {

    "use strict";
    
    






/* doubleTapToGo mobile menu fix*/


;(function(e,t,n,r){e.fn.doubleTapToGo=function(r){if(!("ontouchstart"in t)&&!navigator.msMaxTouchPoints&&!navigator.userAgent.toLowerCase().match(/windows phone os 7/i))return false;this.each(function(){var t=false;e(this).on("click",function(n){var r=e(this);if(r[0]!=t[0]){n.preventDefault();t=r}});e(n).on("click touchstart MSPointerDown",function(n){var r=true,i=e(n.target).parents();for(var s=0;s<i.length;s++)if(i[s]==t[0])r=false;if(r)t=false})});return this}})(jQuery,window,document);

/**
 * jquery.dlmenu.js v1.0.1
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */
;( function( $, window, undefined ) {

	'use strict';

	// global
	var Modernizr = window.Modernizr, $body = $( 'body' );

	$.DLMenu = function( options, element ) {
		this.$el = $( element );
		this._init( options );
	};

	// the options
	$.DLMenu.defaults = {
		// classes for the animation effects
		animationClasses : { classin : 'dl-animate-in-1', classout : 'dl-animate-out-1' },
		// callback: click a link that has a sub menu
		// el is the link element (li); name is the level name
		onLevelClick : function( el, name ) { return false; },
		// callback: click a link that does not have a sub menu
		// el is the link element (li); ev is the event obj
		onLinkClick : function( el, ev ) { return false; }
	};

	$.DLMenu.prototype = {
		_init : function( options ) {

			// options
			this.options = $.extend( true, {}, $.DLMenu.defaults, options );
			// cache some elements and initialize some variables
			this._config();
			
			var animEndEventNames = {
					'WebkitAnimation' : 'webkitAnimationEnd',
					'OAnimation' : 'oAnimationEnd',
					'msAnimation' : 'MSAnimationEnd',
					'animation' : 'animationend'
				},
				transEndEventNames = {
					'WebkitTransition' : 'webkitTransitionEnd',
					'MozTransition' : 'transitionend',
					'OTransition' : 'oTransitionEnd',
					'msTransition' : 'MSTransitionEnd',
					'transition' : 'transitionend'
				};
			// animation end event name
			this.animEndEventName = animEndEventNames[ Modernizr.prefixed( 'animation' ) ] + '.dlmenu';
			// transition end event name
			this.transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ] + '.dlmenu',
			// support for css animations and css transitions
			this.supportAnimations = Modernizr.cssanimations,
			this.supportTransitions = Modernizr.csstransitions;

			this._initEvents();

		},
		_config : function() {
			this.open = false;
			this.$trigger = this.$el.children( '.dl-trigger' );
			this.$menu = this.$el.children( 'ul.dl-menu' );
			this.$menuitems = this.$menu.find( 'li:not(.dl-back)' );
			this.$el.find( 'ul.dl-submenu' ).prepend( '<li class="dl-back"><a href="#"><i class="theme-fonts-arrow_carrot-left"></i></a></li>' );
			this.$back = this.$menu.find( 'li.dl-back' ); 
		},
		_initEvents : function() {

			var self = this;

			this.$trigger.on( 'click.dlmenu', function() {
				
				if( self.open ) {
					self._closeMenu();
				} 
				else {
					self._openMenu();
				}
				return false;

			} );

			this.$menuitems.on( 'click.dlmenu', function( event ) {
				
				event.stopPropagation();

				var $item = $(this),
					$submenu = $item.children( 'ul.dl-submenu' );

				if( $submenu.length > 0 ) {

					var $flyin = $submenu.clone().css( 'opacity', 0 ).insertAfter( self.$menu ),
						onAnimationEndFn = function() {
							self.$menu.off( self.animEndEventName ).removeClass( self.options.animationClasses.classout ).addClass( 'dl-subview' );
							$item.addClass( 'dl-subviewopen' ).parents( '.dl-subviewopen:first' ).removeClass( 'dl-subviewopen' ).addClass( 'dl-subview' );
							$flyin.remove();
						};

					setTimeout( function() {
						$flyin.addClass( self.options.animationClasses.classin );
						self.$menu.addClass( self.options.animationClasses.classout );
						if( self.supportAnimations ) {
							self.$menu.on( self.animEndEventName, onAnimationEndFn );
						}
						else {
							onAnimationEndFn.call();
						}

						self.options.onLevelClick( $item, $item.children( 'a:first' ).text() );
					} );

					return false;

				}
				else {
					self.options.onLinkClick( $item, event );
				}

			} );

			this.$back.on( 'click.dlmenu', function( event ) {
				
				var $this = $( this ),
					$submenu = $this.parents( 'ul.dl-submenu:first' ),
					$item = $submenu.parent(),

					$flyin = $submenu.clone().insertAfter( self.$menu );

				var onAnimationEndFn = function() {
					self.$menu.off( self.animEndEventName ).removeClass( self.options.animationClasses.classin );
					$flyin.remove();
				};

				setTimeout( function() {
					$flyin.addClass( self.options.animationClasses.classout );
					self.$menu.addClass( self.options.animationClasses.classin );
					if( self.supportAnimations ) {
						self.$menu.on( self.animEndEventName, onAnimationEndFn );
					}
					else {
						onAnimationEndFn.call();
					}

					$item.removeClass( 'dl-subviewopen' );
					
					var $subview = $this.parents( '.dl-subview:first' );
					if( $subview.is( 'li' ) ) {
						$subview.addClass( 'dl-subviewopen' );
					}
					$subview.removeClass( 'dl-subview' );
				} );

				return false;

			} );
			
		},
		closeMenu : function() {
			if( this.open ) {
				this._closeMenu();
			}
		},
		_closeMenu : function() {
			var self = this,
				onTransitionEndFn = function() {
					self.$menu.off( self.transEndEventName );
					self._resetMenu();
				};
			
			this.$menu.removeClass( 'dl-menuopen' );
			this.$menu.addClass( 'dl-menu-toggle' );
			this.$trigger.removeClass( 'dl-active' );
			
			if( this.supportTransitions ) {
				this.$menu.on( this.transEndEventName, onTransitionEndFn );
			}
			else {
				onTransitionEndFn.call();
			}

			this.open = false;
		},
		openMenu : function() {
			if( !this.open ) {
				this._openMenu();
			}
		},
		_openMenu : function() {
			var self = this;
			// clicking somewhere else makes the menu close
			$body.off( 'click' ).on( 'click.dlmenu', function() {
				self._closeMenu() ;
			} );
			this.$menu.addClass( 'dl-menuopen dl-menu-toggle' ).on( this.transEndEventName, function() {
				$( this ).removeClass( 'dl-menu-toggle' );
			} );
			this.$trigger.addClass( 'dl-active' );
			this.open = true;
		},
		// resets the menu to its original state (first level of options)
		_resetMenu : function() {
			this.$menu.removeClass( 'dl-subview' );
			this.$menuitems.removeClass( 'dl-subview dl-subviewopen' );
		}
	};

	var logError = function( message ) {
		if ( window.console ) {
			window.console.error( message );
		}
	};

	$.fn.dlmenu = function( options ) {
		if ( typeof options === 'string' ) {
			var args = Array.prototype.slice.call( arguments, 1 );
			this.each(function() {
				var instance = $.data( this, 'dlmenu' );
				if ( !instance ) {
					logError( "cannot call methods on dlmenu prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for dlmenu instance" );
					return;
				}
				instance[ options ].apply( instance, args );
			});
		} 
		else {
			this.each(function() {	
				var instance = $.data( this, 'dlmenu' );
				if ( instance ) {
					instance._init();
				}
				else {
					instance = $.data( this, 'dlmenu', new $.DLMenu( options, this ) );
				}
			});
		}
		return this;
	};

} )( jQuery, window );






    var Core = {


        initialized: false,
        initialize: function() {
            if (this.initialized)
                return;
            this.initialized = true;
            this.build();
        },


        build: function() {

            this.fixedHeader();
            // Init toggle menu
            this.initToggleMenu();
            // Search
            this.initSearchModal();
            // Dropdown menu
            this.dropdownhover();
            // Submenu
            this.submenuControll();



        },
        
        
        
        



        // Searc Modal

        initSearchModal: function(options) {



            $(".btn_header_search").click(function() {
                $(".header-search").addClass("open");
            });


            $(document).on("click", ".search-form_close", function(event) {

                $(".header-search").removeClass("open");
            });



            $(document).on("click", ".btn_header_subscribe", function(event) {


                $(".header-subscribe").addClass("open");
            });
            $(document).on("click", ".search-form_close", function(event) {

                $(".header-subscribe").removeClass("open");
            });





        },

        // Toggle Menu

        initToggleMenu: function() {
            
            
            


            $('#toggle-theme-menu.toggle-menu-button').each(function(i) {


                var trigger = $(this);
                var isClosed = true;



                function showMenu() {



                    $('#nav').addClass('navbar-scrolling-fixing');
                    
    

                    if (trigger.hasClass("js-toggle-screen")) {

                        $('#fixedMenu').delay(0).fadeIn(300);

                    }

                    trigger.addClass('is-open');
                    isClosed = false;
                }


                function hideMenu() {
                    $('#fixedMenu').fadeOut(100);
                    $('#nav').removeClass('navbar-scrolling-fixing');
                    trigger.removeClass('is-open');
                    isClosed = true;
                }




                $('.fullmenu-close').on('click', function(e) {
                    e.preventDefault();
                    if (isClosed === true) {
                        hideMenu();
                    } else {
                        hideMenu();
                    }
                });

                trigger.on('click', function(e) {
                    e.preventDefault();
                    if (isClosed === true) {
                        showMenu();
                    } else {
                        hideMenu();
                    }
                });


            });
            
            
            
            
        },

        // Dropdown
        
        
        


        dropdownhover: function(options) {
            
     
         

            $(".dropdown").on({
                mouseenter: function() {
                    $(this).toggleClass('open');
                },
                mouseleave: function() {
                    $(this).toggleClass('open');
                }
            });
            


            
         $(".full-width").on({
                mouseenter: function() {
                    
                    $(".yamm").removeClass('hover-relative');
                },
                mouseleave: function() {
                    //$(".yamm").removeClass('hover-relative');
                }
            });
            
            
            

    
    $("li.menu-width").on("mouseenter", function() {
        
         
         $(".full-width .dropdown-menu").hide();
        
         $(".yamm").addClass('hover-relative');
        
     
        
        }).on('mouseleave', function() {
        
         $(".full-width .dropdown-menu").show();
        
        function relFunction(){
               $(".yamm").removeClass('hover-relative');
            }
            setTimeout(relFunction, 300);    
        
});
    
    
    
    
    
   $( '.mobile-slidebar-menu li.menu-item-has-children' ).doubleTapToGo();
            
            

        },



        //Fixed header

        fixedHeader: function(options) {
            if ($(window).width() > 767) {
                // Fixed Header
                var topOffset = $(window).scrollTop();
                if (topOffset > 90) {


                    if ($(".header").is(".navbar-fixed-js")) {

                        $('.header').addClass('navbar-scrolling');


                    }


                }
                $(window).on('scroll', function() {
                    var fromTop = $(this).scrollTop();
                    if (fromTop > 90) {
                        
                         if ($(".header").is(".navbar-fixed-js")) {
                             
                        $('body').addClass('fixed-header');
                        $('.header').addClass('navbar-scrolling');
                             
                                }
                        
                    } else {
                        $('body').removeClass('fixed-header');
                        $('.header').removeClass('navbar-scrolling');
                    }

                });
            }
        },
        
        
        
        // Submenu

        submenuControll: function(options) {

            $('li.menu-item-has-children .menu-parent-link').prepend('<span class="submenu-controll"></span>')


            $(".submenu-controll").click(function() {

                $(this).parent().toggleClass('dropdown-open');

            });


            $('li.menu-item-has-children li.menu-item-has-children').prepend('<span class="submenu-controll-inner"><i class="fa fa-angle-right" aria-hidden="true"></i></span>');


            $('[data-off-canvas]   li.menu-item-has-children').prepend('<span class="submenu-controll-inner"><i class="fa fa-angle-right" aria-hidden="true"></i></span>');


        },



    };




    Core.initialize();
    
    // Fixed promo

	$(window).on('scroll', function() {
		var fromTopPromo = $(this).scrollTop();
		if (fromTopPromo > 190) {
			$('.promo-set').addClass('promo-set-view');
		} else {
			$('.promo-set').removeClass('promo-set-view');
		}

	});
    
    

      $( '#dl-menu' ).dlmenu();


})(jQuery);


