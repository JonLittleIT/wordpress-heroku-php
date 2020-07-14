(function ($) {
    'use strict';

    function singleProductGalleryImages() {
        var rtl = $('body').hasClass('rtl') ? true : false;

        var lightbox = $('.single-product .woocommerce-product-gallery__image > a');
        if (lightbox.length) {
            lightbox.attr("data-elementor-open-lightbox", "no");
        }

        if ($('.flex-control-thumbs', '.woocommerce-product-gallery').children().length > 4) {
            $('.woocommerce-product-gallery.woocommerce-product-gallery-horizontal .flex-control-thumbs').css({
                display: "block",
                "max-width": 480,
                "padding-right": 30,
            }).slick({
                rtl: rtl,
                infinite: false,
                slidesToShow: 4,
            });
            $('.woocommerce-product-gallery.woocommerce-product-gallery-vertical .flex-control-thumbs').slick({
                rtl: rtl,
                infinite: false,
                slidesToShow: 4,
                vertical: true,
                verticalSwiping: true,
            });
        }

    }

    function sizechart_popup() {

        $('.sizechart-button').on('click', function (e) {
            e.preventDefault();
            $('.sizechart-popup').toggleClass('active');
        });

        $('.sizechart-close,.sizechart-overlay').on('click', function (e) {
            e.preventDefault();
            $('.sizechart-popup').removeClass('active');
        });
    }

    $('.woocommerce-product-gallery').on('wc-product-gallery-after-init', function () {
        singleProductGalleryImages();
    });
    $(document).ready(function () {
        sizechart_popup();
    });

})(jQuery);