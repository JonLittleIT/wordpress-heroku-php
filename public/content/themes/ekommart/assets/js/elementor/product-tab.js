(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/ekommart-products-tabs.default', ($scope) => {

            let $tabs = $scope.find('.elementor-tabs-wrapper');
            let $contents = $scope.find('.elementor-tabs-content-wrapper');
            $contents.find('.elementor-tab-content').hide();
            // Active tab
            $contents.find('.elementor-active').show();
            let $carousel = $('.woocommerce-carousel ul', $scope);
            let $carousel_setting = $('.elementor-tabs-content-wrapper', $scope);
            let data = $carousel_setting.data('settings');

            $tabs.find('.elementor-tab-title').on('click', function () {
                $tabs.find('.elementor-tab-title').removeClass('elementor-active');
                $contents.find('.elementor-tab-content').removeClass('elementor-active').hide();
                $(this).addClass('elementor-active');
                let id = $(this).attr('aria-controls');
                $contents.find('#' + id).addClass('elementor-active').show();
                $carousel.slick('refresh');
            });


            if (typeof data === 'undefined') {
                return;
            }
            $carousel.slick(
                {
                    dots: data.navigation === 'both' || data.navigation === 'dots' ? true : false,
                    arrows: data.navigation === 'both' || data.navigation === 'arrows' ? true : false,
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

        });
    });
})(jQuery);