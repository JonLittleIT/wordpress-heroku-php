(function($){
    "use strict";
    jQuery(document).ready(function(){
        // CANVAS MENU ------------------------------------------------------------------------------------------------/
        var menuWrap = jQuery('body').find('.slicknav_icon'),
            mainWrapper = jQuery('body'),
            //iconClose = jQuery('.canvas-menu .btn-close'),
            canvasOverlay = jQuery('.canvas-overlay');

        // Function Canvas Menu
        function menuCanvas(){
            mainWrapper.toggleClass('canvas-open');
        }
        // Call Function Canvas
        menuWrap.on( 'click', function(){
            menuCanvas();
        });

        //// Click icon close
        //iconClose.on( 'click', function(){
        //    menuCanvas();
        //});

        // Click canvas
        canvasOverlay.on( 'click', function(){
            menuCanvas();
        });
    });
})(jQuery);
