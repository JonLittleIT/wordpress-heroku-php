(function ($) {
    'use strict';

    $(function () {
        var $body = $('body');
        $body.on('click', '.filter-toggle', function (e) {
            e.preventDefault();
            $('html').toggleClass('off-canvas-active');
        });

        $body.on('click', '.filter-close, .ekommart-overlay-filter', function (e) {
            e.preventDefault();
            $('html').toggleClass('off-canvas-active');
        });
    });
})(jQuery);