jQuery(function ($) {

    "use strict";




    /******************************************************* 
     *****  Gallerys  *****
     *********************************************************/


    $('.fancybox').fancybox();

    $(".fancybox-video,.big-view .fancybox , .popup-youtube").on("click", function () {
        $.fancybox({
            'padding': 0,
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'title': this.title,
            'width': 680,
            'height': 495,
            'href': this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
            'type': 'swf',
            'swf': {
                'wmode': 'transparent',
                'allowfullscreen': 'true'
            }
        });

        return false;
    });



    /******************************************************* 
     *****   Dropdown  *****
     *********************************************************/


    $(function () {
        var $selects = $('.home-template select');

        $selects.easyDropDown({
            cutOff: 10,
            wrapperClass: 'tmp-select-dropdown',
            onChange: function (selected) {
                // do something
            }
        });
    });


    $(".home-template  #btc_calc").next().next("a").hide();







    /******************************************************* 
     *****  Carousel  *****
     *********************************************************/


    /****  Owl ****/


    $(".enable-owl-carousel").each(function (i) {
        var $owl = $(this);
        var navigationData = $owl.data('navigation');
        var paginationData = $owl.data('pagination');
        var singleItemData = $owl.data('single-item');
        var autoPlayData = $owl.data('autoplay');
        var transitionStyleData = $owl.data('transition-style');
        var mainSliderData = $owl.data('main-text-animation');
        var afterInitDelay = $owl.data('after-init-delay');
        var stopOnHoverData = $owl.data('stop-on-hover');
        var min600 = $owl.data('min600');
        var min800 = $owl.data('min800');
        var itemsData = $owl.data('items');
        var animateOutData = $owl.data('animate-out');
        var animateInData = $owl.data('animate-in');
        var min1200 = $owl.data('min1200');
        var responsiveItems = $owl.data('responsive-items');
        var navTextData = $owl.data('nav-text') == null ? ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"] : $owl.data('nav-text');
        $owl.owlCarousel({
            nav: navigationData,
            dots: paginationData,
            singleItem: singleItemData,
            autoHeight: false,
            autoplay: autoPlayData,
            transitionStyle: transitionStyleData,
            stopOnHover: stopOnHoverData,
            animateOut: animateOutData,
            animateIn: animateInData,
            items: itemsData,
            navText: navTextData,
            loop: true,

            responsive: {
                0: {
                    items: responsiveItems
                },
                767: {
                    items: itemsData
                }

            },
            itemsCustom: [
                [0, 1],
                [600, min600],
                [800, min800],
                [1200, min1200]
            ],
            afterInit: function (elem) {
                if (mainSliderData) {
                    setTimeout(function () {
                        $('.main-slider_zoomIn').css('visibility', 'visible').removeClass('zoomIn').addClass('zoomIn');
                        $('.main-slider_fadeInLeft').css('visibility', 'visible').removeClass('fadeInLeft').addClass('fadeInLeft');
                        $('.main-slider_fadeInLeftBig').css('visibility', 'visible').removeClass('fadeInLeftBig').addClass('fadeInLeftBig');
                        $('.main-slider_fadeInRightBig').css('visibility', 'visible').removeClass('fadeInRightBig').addClass('fadeInRightBig');
                    }, afterInitDelay);
                }
            },
            beforeMove: function (elem) {
                if (mainSliderData) {
                    $('.main-slider_zoomIn').css('visibility', 'hidden').removeClass('zoomIn');
                    $('.main-slider_slideInUp').css('visibility', 'hidden').removeClass('slideInUp');
                    $('.main-slider_fadeInLeft').css('visibility', 'hidden').removeClass('fadeInLeft');
                    $('.main-slider_fadeInRight').css('visibility', 'hidden').removeClass('fadeInRight');
                    $('.main-slider_fadeInLeftBig').css('visibility', 'hidden').removeClass('fadeInLeftBig');
                    $('.main-slider_fadeInRightBig').css('visibility', 'hidden').removeClass('fadeInRightBig');
                }
            },
            afterMove: sliderContentAnimate,
            afterUpdate: sliderContentAnimate,
        });
    });

    function sliderContentAnimate(elem) {
        var $elem = elem;
        var afterMoveDelay = $elem.data('after-move-delay');
        var mainSliderData = $elem.data('main-text-animation');
        if (mainSliderData) {
            setTimeout(function () {
                $('.main-slider_zoomIn').css('visibility', 'visible').addClass('zoomIn');
                $('.main-slider_slideInUp').css('visibility', 'visible').addClass('slideInUp');
                $('.main-slider_fadeInLeft').css('visibility', 'visible').addClass('fadeInLeft');
                $('.main-slider_fadeInRight').css('visibility', 'visible').addClass('fadeInRight');
                $('.main-slider_fadeInLeftBig').css('visibility', 'visible').addClass('fadeInLeftBig');
                $('.main-slider_fadeInRightBig').css('visibility', 'visible').addClass('fadeInRightBig');
            }, afterMoveDelay);
        }
    }



    function carouselStarts() {


        var owlCarouselBox = $('.b-single-gallery-carousel');
        if (owlCarouselBox && owlCarouselBox.length) {
            owlCarouselBox.each(function (i) {
                var $owl = $(this);

                var loopData = $owl.data('loop');
                var centerData = $owl.data('center');
                var autoWidthData = $owl.data('auto-width');
                var dotsData = $owl.data('dots');
                var navData = $owl.data('nav');
                var marginData = $owl.data('margin');
                var responsiveClassData = $owl.data('responsive-class');
                var responsiveData = $owl.data('responsive');
                var sliderNext = $owl.data('slider-next');
                var sliderPrev = $owl.data('slider-prev');

                $owl.owlCarousel({
                    loop: loopData,
                    center: centerData,
                    autoWidth: autoWidthData,
                    dots: dotsData,
                    nav: navData,
                    autoplay: true,
                    margin: marginData,
                    responsiveClass: responsiveClassData,
                    responsive: responsiveData
                });


                $(sliderNext).on("click", function () {
                    $owl.trigger('next.owl.carousel');
                });


                $(sliderPrev).on("click", function () {
                    $owl.trigger('prev.owl.carousel');
                });



            });
        }




    }

    setTimeout(carouselStarts, 100);


    /**** Bxslider ****/


    if ($('.bxslider-services').length > 0) {


        $('.bxslider-services').bxSlider({
            mode: 'horizontal',
            captions: true,
            pager: false,
            infiniteLoop: false,
            nextSelector: '#pager-services-next',
            prevSelector: '#pager-services-prev',
            nextText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
            prevText: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
        });
    }




    //with custom pager
    if ($('.bxslider-services').length > 0) {









        $('.bxslider-services').bxSlider({
            pagerCustom: ".bx-pager-services",
            minSlides: 1,
            maxSlides: 1,
            nextSelector: '#pager-services-next',
            prevSelector: '#pager-services-prev',
            nextText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
            prevText: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
        });





    }



    if ($('.bxslider-history').length > 0) {


        $('.bxslider-history').bxSlider({
            mode: 'horizontal',
            captions: true,
            pager: false,
            infiniteLoop: false,
            nextSelector: '#pager-history-next',
            prevSelector: '#pager-history-prev',
            nextText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
            prevText: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
        });
    }


    //with custom pager
    if ($('.bxslider-history').length > 0) {

        $('.bxslider-history').bxSlider({
            pagerCustom: '.bx-pager-history',
            minSlides: 1,
            maxSlides: 1,
            infiniteLoop: false,
            nextSelector: '#pager-history-next',
            prevSelector: '#pager-history-prev',
            nextText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
            prevText: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
        });
    }



    if ($('.bxslider-reviews').length > 0) {


        $('.bxslider-reviews').bxSlider({
            mode: 'horizontal',
            captions: true,
            pager: false,
            infiniteLoop: false,
            nextSelector: '#pager-reviews-next',
            prevSelector: '#pager-reviews-prev',
            nextText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
            prevText: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
        });
    }


    //with custom pager
    if ($('.bxslider-reviews').length > 0) {


        var bxReviewPager = $('.bxslider-reviews .bx-pager');

        $('.bxslider-reviews').bxSlider({
            pagerCustom: '.bx-pager-reviews',
            minSlides: 1,
            maxSlides: 1,
            infiniteLoop: false,
            nextSelector: '#pager-reviews-next',
            prevSelector: '#pager-reviews-prev',
            nextText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
            prevText: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
        });
    }




    $(".carousel-post").bxSlider({
        adaptiveHeight: true,
        auto: true,
        nextText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        prevText: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
    });


    /****  Footer fixed ****/



    if ($('.fixed-footer').length) {


        var fixedFooter = $(".fixed-footer").height();

        $(".layout-theme").css("marginBottom", fixedFooter);



    }






    /****  Slick slider ****/



    if ($('.b-home-slider').length > 0) {

        $('.b-home-slider').slick({
            prevArrow: $('#home-slider-prev'),
            nextArrow: $('#home-slider-next')
                // other settings can be set using the data-slick attribute on the slick element in the HTML markup
        });

    }

    if ($('.b-latest-carousel').length > 0) {

        $('.b-latest-carousel').slick({
            variableWidth: true,
            centerMode: true,
            centerPadding: '80px',
            slidesToShow: 1,
            prevArrow: $('#slick-slideshow-prev'),
            nextArrow: $('#slick-slideshow-next'),
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 1,
                    centerPadding: '20px',
                    arrows: true
                }
            }, {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    centerPadding: '10px',
                    arrows: true
                }
            }, {
                breakpoint: 639,
                settings: {
                    slidesToShow: 1,
                    centerPadding: '0',
                    arrows: true,
                    variableWidth: false,
                    centerMode: false
                }
            }]
        });
    }

    if ($('.b-team-carousel').length > 0) {

        $('.b-team-carousel').slick({
            infinite: true,
            slidesToShow: 1,
            centerMode: true,
            variableWidth: true,
            prevArrow: $('#team-slideshow-prev'),
            nextArrow: $('#team-slideshow-next')
        });
    }

    if ($('.b-recent-carousel').length > 0) {

        $('.b-recent-carousel').slick({
            infinite: true,
            slidesToShow: 1,
            centerMode: true,
            centerPadding: '0px',
            variableWidth: true,
            prevArrow: $('#recent-slideshow-prev'),
            nextArrow: $('#recent-slideshow-next')
        });
    }



    /****  Sly slider  ****/


    if ($('.b-sly-slider').length > 0) {


        (function () {
            var $frame = $('#frame');
            var $wrap = $frame.parent();

            // Call Sly on frame
            $frame.sly({
                horizontal: 1,
                itemNav: 'basic',
                activateOn: 'click',
                mouseDragging: 1,
                touchDragging: 1,
                releaseSwing: 1,
                scrollBar: $wrap.find('.scrollbar'),
                scrollBy: 1,
                speed: 300,
                elasticBounds: 1,
                easing: 'easeOutExpo',
                dragHandle: 1,
                dynamicHandle: 0,
                clickBar: 1
            });

            // Sly to be reloaded when the user resizes the browser
            $(window).resize(function (e) {
                $frame.sly('reload');
            });

        }());
    }




    /******************************************************* 
     *****   Big adaptive title   ***
     *********************************************************/



    $(".b-upper-title").slabText({
        // Don't slabtext the headers if the viewport is under 380px
        "viewportBreakpoint": 380
    });



    /******************************************************* 
     *****   Full Width, Verticale Title ,  SVG Creator   ***
     *********************************************************/



    function fullWidthSection() {

        var windowWidth = $(window).width();

        var widthContainer = $('.home-template > .container, .portfolio-section  > .container , .page-content > .container').width();
        var widthContainerTitle = $('.home-template > .container, .portfolio-section  > .container , .page-content > .container').width();

        var fullWidth1 = windowWidth - widthContainer;
        var fullWidth2 = fullWidth1 / 2;

        var fullWidthTitle1 = windowWidth - widthContainerTitle;
        var fullWidthTitle2 = fullWidthTitle1 / 2;

        $('.js_stretch_anchor').css("width", windowWidth + 30);
        $('.js_stretch_anchor').css("margin-left", -fullWidth2 - 15);

        $(' .jarallax-full-width').css("min-width", windowWidth);
        $(' .jarallax-full-width').css("margin-left", -fullWidth2 + 15);


        var widthContainerFooter = $('.footer  > .container').width();


        var fullWidthFoot = windowWidth - widthContainerFooter;
        var fullWidthFoot2 = fullWidthFoot / 2;


        $(' .footer  .jarallax-full-width').css("min-width", windowWidth + 30);
        $(' .footer  .jarallax-full-width').css("margin-left", -fullWidthFoot2);


        $('.vertical-left').css("left", -fullWidthTitle2);
        $('.vertical-right').css("right", -fullWidthTitle2);




        $('circle.pix-decor-circle').each(function (index) {
            var hor = $(this).data('horizontal') * windowWidth / 100;
            $(this).attr('cx', hor);
        });

        if (windowWidth <= 768) {
            $('.section-decor-wrap').each(function (index) {
                var top, height;
                top = $(this).data('top');
                $(this).css('top', -(top / 2 - 1));
                height = $(this).data('height');
                $(this).css('height', height / 2);
            });
            $('.section-decor-wrap svg').each(function (index) {
                var height;
                height = $(this).data('height');
                $(this).height(height / 2);
            });
            $('.section-decor-wrap pattern').each(function (index) {
                var height;
                height = $(this).data('height');
                $(this).attr('height', height / 2 * 10);
            });
            $('.section-decor-wrap rect').each(function (index) {
                var height;
                height = $(this).data('height');
                $(this).attr('height', height / 2);
            });
            $('circle.pix-decor-circle').each(function (index) {
                var ver = $(this).data('vertical') / 2;
                $(this).attr('cy', ver);
            });
        } else {
            $('.section-decor-wrap').each(function (index) {
                $(this).css('top', -($(this).data('top') - 1));
                $(this).css('height', $(this).data('height'));
            });
            $('.section-decor-wrap svg').each(function (index) {
                $(this).height($(this).data('height'));
            });
            $('.section-decor-wrap pattern').each(function (index) {
                $(this).attr('height', $(this).data('height') * 10);
            });
            $('.section-decor-wrap rect').each(function (index) {
                $(this).attr('height', $(this).data('height'));
            });
            $('circle.pix-decor-circle').each(function (index) {
                $(this).attr('cy', $(this).data('vertical'));
            });
        }

    }

    fullWidthSection();
    $(window).resize(function () {
        fullWidthSection()
    });


    /******************************************************* 
     **********   jarallax   ***************
     *********************************************************/



    $(".vc_row").children().each(function (i) {

        var rowChecker = $(this);

        if (rowChecker.is(".jarallax")) {

            var rowPadTop = $(this).parent().css("padding-top");
            var rowPadBot = $(this).parent().css("padding-bottom");

            $(this).parent().addClass("jarallax-nopadding");

            $(this).css("padding-top", rowPadTop);
            $(this).css("padding-bottom", rowPadBot);

        }

    });





       /******************************************************* 
     *****   LOAD MORE PORTFOLIO   *****
     *********************************************************/

  function loadMore() {
        "use strict";
			$('.load-more a').on('click', function(e) {
            e.preventDefault();

            var current_page = $(this).parent().attr('data-current');
            var max_pages = $(this).parent().attr('data-max-pages');
            var wrapper_id = '#' + $(this).parents('.portfolio-list-section').attr('id');
            var link = $(this).attr('href');
            var $container = wrapper_id + ' .portfolio-masonry-holder';
            var container = $($container);
            var $anchor = wrapper_id + ' .portfolio-pagination .load-more a';
            var next_href = $(this).attr('href'); // Get URL for the next set of posts
            var btn = $(this);

            var load_more_holder = $(this).parents('.portfolio-pagination');
            var loading_holder = $(this).parents('.portfolio-pagination').next();
				
			var current_link = $(location).attr('href');
						
				
            load_more_holder.hide();
            loading_holder.show();

            $('.folio-isotop-filter li').find('.selected').removeClass('selected');
            $('.folio-isotop-filter ul li:first a').addClass('selected');

            container.isotope({
                filter: '*'
            });

            $.get(link + '', function(data) {
				
                console.log(wrapper_id);

                var new_content = $($container, data).wrapInner('').html(); // Grab just the content
                next_href = $($anchor, data).attr('href'); // Get the new href

                $(container, data).waitForImages(function() {

                    container.append(new_content);
                    // trigger isotope again after images have been loaded
                    container.imagesLoaded(function() {
                        container.isotope('reloadItems').isotope({
                            sortBy: 'original-order'
                        });
                    });

                    container.children().removeClass('wow');
					
					
					
                    current_page++;
					if (current_page == 2){
					  var next_page_link = current_link + 'page/3/';
					}else {
						current_page++;
					  var next_page_link = current_link + 'page/' + current_page-- + '/';	
						
					}
					
                    if (max_pages > current_page) {
                        btn.attr('href', next_page_link); // Change the next URL
                    } else {
                        btn.parent().remove();
                    }

                    container.children('.portfolio-pagination:last').remove(); // Remove the original navigation

                    load_more_holder.show();
                    loading_holder.hide();

                    btn.parent().attr('data-current', current_page);
                });

            });
        });
    }
    loadMore();






    /******************************************************* 
     *****  SCROLL HREF  *****
     *********************************************************/




    $("a.rev-btn[href*='#'],  a[href*='#'].tp-caption").on("click", function (event) {
        event.preventDefault();

        var id = $(this).attr('href'),

            top = $(id).offset().top;

        $('body,html').animate({
            scrollTop: top
        }, 1500);
    });









    /******************************************************* 
     *****  Hover application  *****
     *********************************************************/




    $(".app-features").on('hover', function (e) {
        var value = $(this).attr('data-src');
        $(".service-application-img img").attr("src", value);
    });







    $(".app-features").on("click", "p", function () {
        $owl.trigger('next.owl.carousel');
    });



    /******************************************************* 
     *****  sticky sidebar  *****
     *********************************************************/



    var windowWidth = $(window).width();

    if (windowWidth > 1000) {


        if ($('#work-body-sticky').length > 0) {

            (function () {
                var a = document.querySelector('#work-body-sticky'),
                    b = null,
                    P = 0;
                window.addEventListener('scroll', Ascroll, false);
                document.body.addEventListener('scroll', Ascroll, false);

                function Ascroll() {
                    if (b == null) {
                        var Sa = getComputedStyle(a, ''),
                            s = '';
                        for (var i = 0; i < Sa.length; i++) {
                            if (Sa[i].indexOf('overflow') == 0 || Sa[i].indexOf('padding') == 0 || Sa[i].indexOf('border') == 0 || Sa[i].indexOf('outline') == 0 || Sa[i].indexOf('box-shadow') == 0 || Sa[i].indexOf('background') == 0) {
                                s += Sa[i] + ': ' + Sa.getPropertyValue(Sa[i]) + '; '
                            }
                        }
                        b = document.createElement('div');
                        b.style.cssText = s + ' box-sizing: border-box; width: ' + a.offsetWidth + 'px;';
                        a.insertBefore(b, a.firstChild);
                        var l = a.childNodes.length;
                        for (var i = 1; i < l; i++) {
                            b.appendChild(a.childNodes[1]);
                        }
                        a.style.height = b.getBoundingClientRect().height + 'px';
                        a.style.padding = '0';
                        a.style.border = '0';
                    }
                    var Ra = a.getBoundingClientRect(),
                        R = Math.round(Ra.top + b.getBoundingClientRect().height - document.querySelector('footer').getBoundingClientRect().top + 100);
                    if ((Ra.top - P) <= 0) {
                        if ((Ra.top - P) <= R) {
                            b.className = 'stop';
                            b.style.top = -R + 'px';
                        } else {
                            b.className = 'sticky';
                            b.style.top = P + 'px';
                        }
                    } else {
                        b.className = '';
                        b.style.top = '';
                    }
                    window.addEventListener('resize', function () {
                        a.children[0].style.width = getComputedStyle(a, '').width
                    }, false);
                }
            })()

        }


        var DelayLoad = function () {



            $(".sticky-bar").stick_in_parent();

        };

        setTimeout(DelayLoad, 2000);





    }









    /******************************************************* 
     *****  scrollie background color  *****
     *********************************************************/



    var wHeight = $(window).height();

    $('.scrollie')
        .height(wHeight)
        .scrollie({
            scrollOffset: -250,
            scrollingInView: function (elem) {
                var bgColor = elem.data('background');
                $('body').css('background-color', bgColor);

            }
        });




    /******************************************************* 
     *****  ISOTOPE FILTER  *****
     *********************************************************/






    var portfolio_container = $('.portfolio-masonry-holder');

    portfolio_container.imagesLoaded(function () {
        portfolio_container.isotope({
            // options
            itemSelector: '.item',
            layoutMode: 'masonry',
        });
    });





    $('.folio-isotop-filter a').on('click', function () {

        var container = $('.portfolio-masonry-holder');
        var filterValue = $(this).attr('data-filter');

        //don't proceed if already selected
        if ($(this).hasClass('selected')) {
            return false;
        }
        var $portfolio_optionSet = $(this).parents('.folio-option-set');
        $portfolio_optionSet.find('.selected').removeClass('selected');
        $(this).addClass('selected');

        filterValue = filterValue === 'false' ? false : filterValue;
        portfolio_container.isotope({
            filter: filterValue
        });
        return false;
    });









    var blog_container = $('.blog-masonry-holder');


    blog_container.isotope({
        // options
        itemSelector: '.item',
        layoutMode: 'masonry',
    });






    var $container = $('#gallery-items');

    $(window).load(function () {
        $container.isotope({
            //		    resizable: false, // disable normal resizing
            transitionDuration: '0.65s',
            masonry: {
                columnWidth: $container.find('.gallery-item:not(.wide)')[0]
            }
        });

        $(window).resize(function () {
            $container.isotope('layout');
        });
    });









    /////////////////////////////////////
    //  Chars Start
    /////////////////////////////////////

    if ($('body').length) {
        $(window).on('scroll', function () {
            var winH = $(window).scrollTop();

            $('.tmpl-stats').waypoint(function () {
                $('.js-chart').each(function () {
                    CharsStart();
                });
            }, {
                offset: '120%'
            });
        });
    }


    function CharsStart() {
        $('.js-chart').easyPieChart({
            barColor: false,
            trackColor: false,
            scaleColor: false,
            scaleLength: false,
            lineCap: false,
            lineWidth: false,
            size: false,
            animate: 7000,

            onStep: function (from, to, percent) {
                $(this.el).find('.js-percent').text(Math.round(percent));
            }
        });

    }



    /////////////////////////////////////////////////////////////////
    // Map/Form Switcher
    /////////////////////////////////////////////////////////////////

    $(".map-form-switcher .switcher-toggle").on('click', function (e) {
        e.preventDefault();
        $('.b-map-form-holder .b-contact-form').fadeToggle("300", "linear");
        $('.b-map-form-holder').toggleClass("map-active");
    });





    /////////////////////////////////////////////////////////////////
    // Map/Form Switcher
    /////////////////////////////////////////////////////////////////

    $(".panel-heading").on('click', function (e) {

        $(".panel-heading").removeClass("active");
        $(this).addClass("active");

    });





    /**
     * WooCommerce Variation Dynamic SubTotal
     */
    function addThousandSep(n, thousand_separator) {

        var rx = /(\d+)(\d{3})/;
        return String(n).replace(/^\d+/, function (w) {
            while (rx.test(w)) {
                w = w.replace(rx, '$1' + thousand_separator + '$2');
            }
            return w;
        });

    };

    function sub_total_change(price, count) {
        var currency, decimal_separator, thousand_separator, decimals, currency_pos;
        currency = $('.fixar_woo_currency').val();
        decimal_separator = $('.fixar_woo_decimal_separator').val();
        thousand_separator = $('.fixar_woo_thousand_separator').val();
        decimals = $('.fixar_woo_decimals').val();
        currency_pos = $('.fixar_woo_currency_pos').val();

        var totalPrice = parseFloat(price) * count,
            htmlPrice;

        totalPrice = totalPrice.toFixed(decimals);
        htmlPrice = totalPrice.toString().replace('.', decimal_separator);
        if (thousand_separator.length > 0) {
            htmlPrice = addThousandSep(htmlPrice, thousand_separator);
        }
        if (currency_pos == 'right') {
            htmlPrice = htmlPrice + currency;
        } else if (currency_pos == 'right_space') {
            htmlPrice = htmlPrice + ' ' + currency;
        } else if (currency_pos == 'left_space') {
            htmlPrice = currency + ' ' + htmlPrice;
        } else {
            htmlPrice = currency + htmlPrice;
        }

        $('.form-cart__price-total').html(htmlPrice);
    }


    $('.shopping_cart-quantity input').on('change', function () {
        var currency = $('.fixar_woo_currency').val();
        var sufix = '';
        $.each($('.tawcvs-swatches span.selected'), function () {
            sufix = sufix + '_' + $(this).data('value');
        });
        var price = $('.fixar_woo_price' + sufix).val();
        sub_total_change(price, $(this).val());
        //alert( "Handler for .change() called: "+ price );
    });

    $('.table-container .single_variation_wrap').on('bind', 'DOMSubtreeModified', function () {


        var currency = $('.fixar_woo_currency').val();
        var sufix = '';
        $.each($('.tawcvs-swatches span.selected'), function () {
            sufix = sufix + '_' + $(this).data('value');
        });
        var price = $('.fixar_woo_price' + sufix).val();
        var count = $('.shopping_cart-quantity input').val();
        if (price !== 'undefined' && price != '')
            sub_total_change(price, count);


    });









});


new WOW().init();