(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/ekommart-tabs.default', ($scope) => {
            let $tabs = $scope.find('.elementor-tabs');
            let $contents = $scope.find('.elementor-tabs-content-wrapper');

            // Active tab
            $contents.find('.elementor-active').show();

            $tabs.find('.elementor-tab-title').on('click', function (e) {
                e.preventDefault();
                $tabs.find('.elementor-tab-title').removeClass('elementor-active');
                $contents.find('.elementor-tab-content').removeClass('elementor-active').hide();
                $(this).addClass('elementor-active');
                let id = $(this).attr('aria-controls');
                $contents.find('#'+ id).addClass('elementor-active').show();

            });
        });
    });

})(jQuery);