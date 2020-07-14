(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        let Countdown = function( $countdown, endTime, $ ) {
            let timeInterval,
                elements = {
                    $daysSpan: $countdown.find( '.elementor-countdown-days' ),
                    $hoursSpan: $countdown.find( '.elementor-countdown-hours' ),
                    $minutesSpan: $countdown.find( '.elementor-countdown-minutes' ),
                    $secondsSpan: $countdown.find( '.elementor-countdown-seconds' )
                };

            let updateClock = function() {
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

            let initializeClock = function() {
                updateClock();

                timeInterval = setInterval( updateClock, 1000 );
            };

            initializeClock();
        };

        Countdown.getTimeRemaining = function( endTime ) {
            let timeRemaining = endTime - new Date(),
                seconds = Math.floor( ( timeRemaining / 1000 ) % 60 ),
                minutes = Math.floor( ( timeRemaining / 1000 / 60 ) % 60 ),
                hours = Math.floor( ( timeRemaining / ( 1000 * 60 * 60 ) ) % 24 ),
                days = Math.floor( timeRemaining / ( 1000 * 60 * 60 * 24 ) );

            if ( days < 0 || hours < 0 || minutes < 0 ) {
                seconds = minutes = hours = days = 0;
            }

            return {
                total: timeRemaining,
                parts: {
                    days: days,
                    hours: hours,
                    minutes: minutes,
                    seconds: seconds
                }
            };
        };

        elementorFrontend.hooks.addAction('frontend/element_ready/ekommart-countdown.default', ($scope) => {
            let $element = $scope.find( '.elementor-ekommart-countdown' ),
                date = new Date( $element.data( 'date' ) * 1000 );

            new Countdown( $element, date, $ );

        });
    });

})(jQuery);