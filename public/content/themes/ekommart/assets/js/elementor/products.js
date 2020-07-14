(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/ekommart-products.default', ($scope) => {
            let $carousel = $('.woocommerce-carousel', $scope);
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