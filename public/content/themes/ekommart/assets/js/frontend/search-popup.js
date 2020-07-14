(function ($) {
    'use strict';
    $( document ).ready(function() {
        $('.button-search-popup').on('click', function (e) {
            e.preventDefault();
            $('html').toggleClass('search-popup-active');
        });

        $('.site-search-popup-close').on('click', function (e) {
            e.preventDefault();
            $('html').toggleClass('search-popup-active');
        });
    });
})(jQuery);