(function($){
    "use strict";
    function bitther_isotope(){
        var $grid =$('.affect-isotope').isotope({
            masonry: {
                columnWidth:'.col-item'
            },
            transitionDuration: '0.4s',
            fitWidth: true,
        });
        $grid.imagesLoaded().progress( function() {
            $grid.isotope('layout');
        });
    }
    jQuery(document).ready(function($) {
        $('.lazy').lazy({
            effect: "fadeIn",
            effectTime: 400,
            threshold: 0
        });
        bitther_isotope();
    });

    function resizeLayout() {
        var number              =jQuery('.products-block').data('number');
        var w_warp_product      =jQuery('.products-block').outerWidth();
        if(w_warp_product > 640 ) {
            var w_width   =Math.floor(w_warp_product/number);
        }else{
            var w_width =Math.floor(w_warp_product/2);
        }
        jQuery('.products-block .col-item').css({"width": (w_width-1)+"px"});
    }

    jQuery(window).on( 'resize', function() {
        resizeLayout()
        bitther_isotope();
    }).resize();

    jQuery(window).load(function(){
        bitther_isotope();
        $('.lazy').lazy({
            effect: "fadeIn",
            effectTime: 400,
            threshold: 0
        });
    });

})(jQuery);


