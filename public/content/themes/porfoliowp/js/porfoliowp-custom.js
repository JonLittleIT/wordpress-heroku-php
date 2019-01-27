/*
 Project name:       MODELTHEME
 Project author:     ModelTheme
 File name:          Custom JS
*/

(function ($) {
    'use strict';


    // INITIALIZE SCROLLIT JS
    jQuery.scrollIt({
      upKey: 38,             // key code to navigate to the next section
      downKey: 40,           // key code to navigate to the previous section
      easing: 'easeInOutCirc',      // the easing function for animation
      scrollTime: 600,       // how long (in ms) the animation takes
      activeClass: 'active', // class given to the active nav element
      onPageChange: null,    // function(pageIndex) that is called when page is changed
      topOffset: -90           // offste (in px) for fixed top navigation
    });


    // ScrollingInit DOTS FROM SINGLE PORTFOLIO PAGE
    function ScrollingInit() {
        [].slice.call(document.querySelectorAll('.nav-scroll')).forEach(function(nav) {
            var navItems = [].slice.call(nav.querySelectorAll('.nav--fixed-scrolling')),
                itemsTotal = navItems.length,
                setCurrent = function(item) {
                    // return if already current
                    if( item.classList.contains('nav--fixed-scrolling--current') ) {
                        return false;
                    }
                    // remove current
                    var currentItem = nav.querySelector('.nav--fixed-scrolling--current');
                    currentItem.classList.remove('nav--fixed-scrolling--current');
                    
                    // set current
                    item.classList.add('nav--fixed-scrolling--current');
                };
            
            navItems.forEach(function(item) {
                item.addEventListener('click', function() { setCurrent(item); });
            });
        });
    }
    ScrollingInit();


    new WOW().init();

    // jQuery preloader
    jQuery(window).load(function(){
        jQuery( '.porfoliowp_preloader_holder' ).fadeOut( 1000, function() {
            jQuery( this ).fadeOut();
        });
    });


    jQuery( document ).ready(function() {

        jQuery('a.print-portfolio').on( "click", function(event) {
            event.preventDefault();
        });

        jQuery('[data-toggle="tooltip"]').tooltip();

        // virtual tour
        if (jQuery('.popup-vimeo-youtube').length) {
            jQuery(".popup-vimeo-youtube").magnificPopup({
                type:"iframe",
                disableOn: 700,
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        }

        // LISTING GALLERY POPUP
        if (jQuery('.mt_car--gallery').length) {
            jQuery('.mt_car--gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true
                },
                // other options
            });
        }

        if(window.matchMedia('(min-width: 992px)').matches) {

            jQuery(".stickit_sidebar, .main_stickit").stick_in_parent({
                offset_top: 120
            });
            jQuery('.stickit_sidebar')
            .on('sticky_kit:bottom', function(e) {
                jQuery(this).parent().css('position', 'static');
            })

        }
    });


    // FIXED SEARCH FORM
    jQuery('.mt-search-icon').on( "click", function() {
        jQuery('.fixed-search-overlay').toggleClass('visible');
    });

    jQuery('.fixed-search-overlay .icon-close').on( "click", function() {
        jQuery('.fixed-search-overlay').removeClass('visible');
    });
    jQuery(document).keyup(function(e) {
         if (e.keyCode == 27) { // escape key maps to keycode `27`
            jQuery('.fixed-search-overlay').removeClass('visible');
            jQuery('.fixed-sidebar-menu').removeClass('open');
            jQuery('.fixed-sidebar-menu-overlay').removeClass('visible');
        }
    });



    jQuery('#mt-nav-burger').on( "click", function() {
        jQuery('.fixed-sidebar-menu').toggleClass('open');
        jQuery(this).parent().find('#navbar').toggleClass('hidden');
        jQuery('.fixed-sidebar-menu-overlay').addClass('visible');
    });

    jQuery('.button_actions_label_open').on( "click", function() {
        jQuery('.fixed-sidebar-menu').toggleClass('open');
        jQuery(this).parent().find('#navbar').toggleClass('hidden');
        jQuery('.fixed-sidebar-menu-overlay').addClass('visible');
    });

    /* Click on Overlay - Hide Overline / Slide Back the Sidebar header */
    jQuery('.fixed-sidebar-menu-overlay').on( "click", function() {
        jQuery('.fixed-sidebar-menu').removeClass('open');
        jQuery(this).removeClass('visible');
    });    
    /* Click on Overlay - Hide Overline / Slide Back the Sidebar header */
    jQuery('.fixed-sidebar-menu .icon-close').on( "click", function() {
        jQuery('.fixed-sidebar-menu').removeClass('open');
        jQuery('.fixed-sidebar-menu-overlay').removeClass('visible');
    });




    // 9th MENU Toggle - Hamburger
    var toggles = document.querySelectorAll(".c-hamburger");

    for (var i = toggles.length - 1; i >= 0; i--) {
      var toggle = toggles[i];
      toggleHandler(toggle);
    };

    function toggleHandler(toggle) {
      toggle.addEventListener( "click", function(e) {
        e.preventDefault();
        (this.classList.contains("is-btn-active") === true) ? this.classList.remove("is-btn-active") : this.classList.add("is-btn-active");
      });
    }


    $(document).ready(function() {

        jQuery( ".see_map_button" ).on( "click", function() {
            jQuery( "#map_wrapper_overlay" ).fadeOut('slow');
        });


        jQuery( ".fixed-sidebar-menu .menu-button" ).on( "click", function() {
            jQuery(this).parent().parent().parent().parent().toggleClass('open');
            jQuery(this).toggleClass('open');
        });

        var expand = '<span class="expand"><a class="action-expand"></a></span>';
        jQuery('.fixed-sidebar-menu .navbar-collapse .menu-item-has-children').append(expand);
        jQuery(".fixed-sidebar-menu .menu-item-has-children .expand a").click(function() {
         jQuery(this).parent().parent().find(' > ul').toggle();
         jQuery(this).toggleClass("show-menu");
        });


        
        
        
        //Begin: Validate and Submit contact form via Ajax
        jQuery("#contact_form").validate({
            //Ajax validation rules
            validClass:'validated',
            rules: {
                user_name: {
                    required: true,
                    minlength: 2
                },
                user_message: {
                    required: true,
                    minlength: 10
                },
                user_subject: {
                    required: true,
                    minlength: 5
                },
                user_email: {
                    required: true,
                    email: true
                }
            },
            //Ajax validation messages
            messages: {
                user_name: {
                    required: "Please enter a name",
                    minlength: "Your name must consist of at least 2 characters"
                },
                user_message: {
                    required: "Please enter a message",
                    minlength: "Your message must consist of at least 10 characters"
                },
                user_subject: {
                    required: "Please provide a subject",
                    minlength: "Your subject must be at least 5 characters long"
                },
                user_email: "Please enter a valid email address"
            },
            //Submit via Ajax Form
            submitHandler: function() {
                jQuery('#contact_form').ajaxSubmit();
                jQuery('.success_message').fadeIn('slow');
            }
        });
        //End: Validate and Submit contact form via Ajax

        jQuery("#contact01_form").validate({
            //Ajax validation rules
            validClass:'validated',
            rules: {
                user_first_name: {
                    required: true,
                    minlength: 2
                },
                user_last_name: {
                    required: true,
                    minlength: 2
                },
                user_message: {
                    required: true,
                    minlength: 10
                },
                user_subject: {
                    required: true,
                    minlength: 5
                },
                user_email: {
                    required: true,
                    email: true
                }
            },
            //Ajax validation messages
            messages: {
                user_first_name: {
                    required: "Please your first name",
                    minlength: "Your first name must consist of at least 2 characters"
                },
                user_last_name: {
                    required: "Please your last name",
                    minlength: "Your last name must consist of at least 2 characters"
                },
                user_message: {
                    required: "Please enter a message",
                    minlength: "Your message must consist of at least 10 characters"
                },
                user_subject: {
                    required: "Please provide a subject",
                    minlength: "Your subject must be at least 5 characters long"
                },
                user_email: {
                    required: "Please enter a valid email address"
                } 
            },
       
        });
        //End: Validate and Submit contact form via Ajax



        //Begin: Validate and Submit contact form 2 via Ajax
        jQuery("#contact_form2").validate({
            //Ajax validation rules
            validClass:'validated',
            rules: {
                user_name: {
                    required: true,
                    minlength: 2
                },
                user_message: {
                    required: true,
                    minlength: 10
                },
                user_subject: {
                    required: true,
                    minlength: 5
                },
                user_email: {
                    required: true,
                    email: true
                },
                user_phone: {
                    required: true,
                    minlength: 6,
                    number: true
                },
                user_city: {
                    required: true
                }
            },
            //Ajax validation messages
            messages: {
                user_name: {
                    required: "Please enter a name",
                    minlength: "Your name must consist of at least 2 characters"
                },
                user_message: {
                    required: "Please enter a message",
                    minlength: "Your message must consist of at least 10 characters"
                },
                user_subject: {
                    required: "Please provide a subject",
                    minlength: "Your subject must be at least 5 characters long"
                },
                user_phone: {
                    required: "Please provide a phone number",
                    minlength: "Your phone must be at least 6 numbers long",
                    number: "You must enter a number"
                },
                user_city: {
                    required: "Please provide a city"
                },
                user_email: {
                    required: "Please provide a email",
                    email: "Please enter a valid email address"
                }
            },
            //Submit via Ajax Form
            submitHandler: function() {
                jQuery('#contact_form2').ajaxSubmit();
                jQuery('.success_message').fadeIn('slow');
            }
        });
        //End: Validate and Submit contact form via Ajax

        
        //Begin: Sticky Head
        jQuery(function(){
           if (jQuery('body').hasClass('is_nav_sticky')) {
                jQuery(window).resize(function() {
                    if (jQuery(window).width() <= 768) {
                    // console.log('smaller-than-767');
                    } else {
                        jQuery("#modeltheme-main-head").sticky({
                            topSpacing:0
                        });
                    }
                });
                if (jQuery(window).width() >= 768) {
                    jQuery("#modeltheme-main-head").sticky({
                        topSpacing:0
                    });
                }
           }
        });


        // Shop button
        jQuery('.shop_cart').hover(function() {
            /* Stuff to do when the mouse enters the element */
            jQuery('.header_mini_cart').addClass('visible_cart');
        }, function() {
            /* Stuff to do when the mouse leaves the element */
            jQuery('.header_mini_cart').removeClass('visible_cart');
        });

        jQuery('.header_mini_cart').hover(function() {
            /* Stuff to do when the mouse enters the element */
            jQuery(this).addClass('visible_cart');
        }, function() {
            /* Stuff to do when the mouse leaves the element */
            jQuery(this).removeClass('visible_cart');
        });


        jQuery('#contact01_form input[name="user_first_name"]').on('change keyup paste', function() {
            if(jQuery(this).hasClass("validated")){
                jQuery(".cf-progress").addClass("user_first_name-validated");
            }else if(!jQuery(this).hasClass("validated")){
                jQuery(".cf-progress").removeClass("user_first_name-validated");
            }
        });
        jQuery('#contact01_form input[name="user_last_name"]').on('change keyup paste', function() {
            if(jQuery(this).hasClass("validated")){
                jQuery(".cf-progress").addClass("user_last_name-validated");
            }else if(!jQuery(this).hasClass("validated")){
                jQuery(".cf-progress").removeClass("user_last_name-validated");
            }
        });
        jQuery('#contact01_form input[name="user_email"]').on('change keyup paste', function() {
            if(jQuery(this).hasClass("validated")){
                jQuery(".cf-progress").addClass("email-validated");
            }else if(!jQuery(this).hasClass("validated")){
                jQuery(".cf-progress").removeClass("email-validated");
            }
        });
        // $("#textbox").on('change keyup paste', function() {
        jQuery('#contact01_form input[name="user_subject"]').on('change keyup paste', function() {
            if(jQuery(this).hasClass("validated")){
                jQuery(".cf-progress").addClass("subject-validated");
            }else if(!jQuery(this).hasClass("validated")){
                jQuery(".cf-progress").removeClass("subject-validated");
            }
        });
        jQuery('#contact01_form input[name="user_message"]').on('change keyup paste', function() {
            if(jQuery(this).hasClass("validated")){
                jQuery(".cf-progress").addClass("message-validated");
            }else if(!jQuery(this).hasClass("validated")){
                jQuery(".cf-progress").removeClass("message-validated");
            }
        });

        
        //Begin: Parallax
        jQuery('.parralax-background').parallax("50%", 0.5);
        //End: Parallax


        /*Begin: Testimonials slider*/
        jQuery(".quotes-slider").owlCarousel({
            navigation      : false, // Show next and prev buttons
            pagination      : false,
            autoPlay        : true,
            rewindNav       : true,
            slideSpeed      : 700,
            paginationSpeed : 700,
            singleItem      : true
        });

        jQuery(".quotes-container").owlCarousel({
            navigation      : false, // Show next and prev buttons
            pagination      : false,
            autoPlay        : false,
            slideSpeed      : 700,
            paginationSpeed : 700,
            singleItem      : true
        });
        /*Begin: Pastors slider*/
        jQuery(".pastor_slider").owlCarousel({
            navigation      : false, // Show next and prev buttons
            pagination      : false,
            autoPlay        : false,
            slideSpeed      : 700,
            paginationSpeed : 700,
            itemsCustom : [
                [0,     1],
                [450,   1],
                [600,   2],
                [700,   2],
                [1000,  4],
                [1200,  4],
                [1400,  4],
                [1600,  4]
            ]
        });
        /*End: Pastors slider*/
        /*Begin: Clients slider*/
        jQuery(".categories_shortcode").owlCarousel({
            navigation      : false, // Show next and prev buttons
            pagination      : false,
            autoPlay        : false,
            slideSpeed      : 700,
            paginationSpeed : 700,
            navigationText  : ["<i class='fa fa-arrow-left'></i>","<i class='fa fa-arrow-right'></i>"],
            itemsCustom : [
                [0,     1],
                [450,   2],
                [600,   2],
                [700,   5],
                [1000,  5],
                [1200,  5],
                [1400,  5],
                [1600,  5]
            ]
        });
        /*Begin: Products by category*/
        jQuery(".clients-container").owlCarousel({
            navigation      : false, // Show next and prev buttons
            pagination      : false,
            autoPlay        : true,
            slideSpeed      : 700,
            paginationSpeed : 700,
            itemsCustom : [
                [0,     1],
                [450,   2],
                [600,   2],
                [700,   3],
                [1000,  5],
                [1200,  5],
                [1400,  5],
                [1600,  5]
            ]
        });
        /*Begin: Portfolio single slider*/
        jQuery(".portfolio_thumbnails_slider").owlCarousel({
            navigation      : true, // Show next and prev buttons
            pagination      : true,
            autoPlay        : false,
            slideSpeed      : 700,
            paginationSpeed : 700,
            navigationText  : ["",""],
            singleItem      : true
        });
        /*End: Portfolio single slider*/
        /*Begin: Testimonials slider*/
        jQuery(".post_thumbnails_slider").owlCarousel({
            navigation      : false, // Show next and prev buttons
            pagination      : false,
            autoPlay        : false,
            slideSpeed      : 700,
            paginationSpeed : 700,
            singleItem      : true
        });
        var owl = jQuery(".post_thumbnails_slider");
        jQuery( ".next" ).on( "click", function() {
            owl.trigger('owl.next');
        })
        jQuery( ".prev" ).on( "click", function() {
            owl.trigger('owl.prev');
        })
        /*End: Testimonials slider*/
        
        /*Begin: Testimonials slider*/
        jQuery(".testimonials_slider").owlCarousel({
            navigation      : true, // Show next and prev buttons
            pagination      : true,
            autoPlay        : false,
            slideSpeed      : 700,
            paginationSpeed : 700,
            singleItem      : true
        });
        /*End: Testimonials slider*/
        /* Animate */
        jQuery('.animateIn').animateIn();
        // browser window scroll (in pixels) after which the "back to top" link is shown
        var offset = 300,
        //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
        offset_opacity = 1200,
        //duration of the top scrolling animation (in ms)
        scroll_top_duration = 700,
        //grab the "back to top" link
        $back_to_top = jQuery('.back-to-top');




        //hide or show the "back to top" link
        jQuery(window).scroll(function(){
            ( jQuery(this).scrollTop() > offset ) ? $back_to_top.addClass('modeltheme-is-visible') : $back_to_top.removeClass('modeltheme-is-visible modeltheme-fade-out');
            if( jQuery(this).scrollTop() > offset_opacity ) { 
                $back_to_top.addClass('modeltheme-fade-out');
            }
        });



        //smooth scroll to top
        $back_to_top.on('click', function(event){
            event.preventDefault();
            $('body,html').animate({
                scrollTop: 0 ,
                }, scroll_top_duration
            );
        });



        //Begin: Skills
        jQuery('.statistics').appear(function() {
            jQuery('.percentage').each(function(){
                var dataperc = jQuery(this).attr('data-perc');
                jQuery(this).find('.skill-count').delay(6000).countTo({
                    from: 0,
                    to: dataperc,
                    speed: 5000,
                    refreshInterval: 100
                });
            });
        }); 
        //End: Skills 

    })
} (jQuery) )


//revolution slider buttons delete effect
jQuery('.rev_slider_wrapper .rev_slider .modeltheme_button').removeClass('animateIn').removeClass('animated');




// contact form effect
(function() {
    if (!String.prototype.trim) {
      (function() {
        // Make sure we trim BOM and NBSP
        var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
        String.prototype.trim = function() {
          return this.replace(rtrim, '');
        };
      })();
    }

    [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
      // in case the input is already filled..
      if( inputEl.value.trim() !== '' ) {
        classie.add( inputEl.parentNode, 'input--filled' );
      }

      // events:
      inputEl.addEventListener( 'focus', onInputFocus );
      inputEl.addEventListener( 'blur', onInputBlur );
    } );

    function onInputFocus( ev ) {
      classie.add( ev.target.parentNode, 'input--filled' );
    }

    function onInputBlur( ev ) {
      if( ev.target.value.trim() === '' ) {
        classie.remove( ev.target.parentNode, 'input--filled' );
      }
    }
  })();