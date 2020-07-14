(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', function(){

        var Countdown = function( $countdown, endTime, $ ) {
            let timeInterval,
                elements = {
                    $hoursSpan: $countdown.find( '.countdown-hours' ),
                    $minutesSpan: $countdown.find( '.countdown-minutes' ),
                    $secondsSpan: $countdown.find( '.countdown-seconds' )
                };

            var updateClock = function() {
                let timeRemaining = Countdown.getTimeRemaining( endTime );

                $.each( timeRemaining.parts, function( timePart ) {
                    let $element = elements[ '$' + timePart + 'Span' ],
                        partValue = this.toString();

                    if ( 1 === partValue.length ) {
                        partValue = 0 + partValue;
                    }

                    if ( $element.length ) {
                        $element.text( partValue );
                    }
                } );

                if ( timeRemaining.total <= 0 ) {
                    clearInterval( timeInterval );
                }
            };

            var initializeClock = function() {
                updateClock();

                timeInterval = setInterval( updateClock, 1000 );
            };

            initializeClock();
        };

        Countdown.getTimeRemaining = function( endTime ) {
            let timeRemaining = endTime - new Date(),
                seconds = Math.floor( ( timeRemaining / 1000 ) % 60 ),
                minutes = Math.floor( ( timeRemaining / 1000 / 60 ) % 60 ),
                hours = Math.floor( ( timeRemaining / ( 1000 * 60 * 60 )) );

            if ( hours < 0 || minutes < 0 ) {
                seconds = minutes = hours = 0;
            }

            return {
                total: timeRemaining,
                parts: {
                    hours: hours,
                    minutes: minutes,
                    seconds: seconds
                }
            };
        };


        elementorFrontend.hooks.addAction('frontend/element_ready/ekommart-products-deals.default', function($scope) {

            var $element = $scope.find( '.deal-count' ),
                date = new Date( $element.data( 'date' ) * 1000 );

            new Countdown( $element, date, $ );

            var $carousel = $('.woocommerce-carousel', $scope);
            if ($carousel.length > 0) {
                let data = $carousel.data('settings'),
                    rtl = $('body').hasClass('rtl') ? true : false;

                $('ul.products', $carousel).slick(
                    {   rtl: rtl,
                        dots: data.navigation == 'both' || data.navigation == 'dots' ? true : false,
                        arrows: data.navigation == 'both' || data.navigation == 'arrows' ? true : false,
                        infinite: data.loop,
                        speed: 300,
                        slidesToShow: parseInt(data.items),
                        autoplay: data.autoplay,
                        autoplaySpeed: parseInt(data.autoplayTimeout),
                        slidesToScroll: 1,
                        lazyLoad: 'ondemand',
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: parseInt(data.items_tablet),
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: parseInt(data.items_mobile),
                                }
                            }
                        ]
                    }
                ).on('setPosition', function (event, slick) {
                    slick.$slides.css('height', slick.$slideTrack.height() + 'px');
                });
            }
        });
    });

})(jQuery);