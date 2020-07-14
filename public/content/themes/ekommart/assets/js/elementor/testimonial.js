(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/ekommart-testimonials.default', ($scope) => {
            let $carousel = $('.ekommart-carousel', $scope);
            if ($carousel.length > 0) {
                let data = $carousel.data('settings');
                $carousel.slick(
                    {
                        dots: data.navigation == 'both' || data.navigation == 'dots' ? true : false,
                        arrows: data.navigation == 'both' || data.navigation == 'arrows' ? true : false,
                        infinite: data.loop,
                        speed: 300,
                        slidesToShow: parseInt(data.items),
                        autoplay: false,
                        autoplaySpeed: 5000,
                        slidesToScroll: 1,
                        lazyLoad: 'ondemand',
                        rtl: data.rtl,
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
                );
            }
        });
    });

})(jQuery);