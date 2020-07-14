var $doc          = jQuery(document),
    $window       = jQuery(window),
    $html         = jQuery('html'),
    $body         = jQuery('body');

$doc.ready(function() {

    'use strict';

    /** MISC */
    jQuery( "input, textarea" ).placeholder();
    jQuery("body").fitVids();
    jQuery(".prev, .nxt, .flex-next, .flex-prev, .bdaia-load-comments-btn a").click(function(event){ event.preventDefault(); });

});


/** IMAGES SCROLL */
jQuery(function() {

    var win_height_padded = $window.height() * .9;

    $window.on('scroll', woohoo_images_scroll);

    function woohoo_images_scroll() {
        var scrolled = $window.scrollTop(),
            win_height_padded = $window.height() * .9;

        jQuery( ".bdaia-lazyload .post-thumb, .bdaia-lazyload .block-article-img-container, .bdaia-lazyload .bdaia-fp-post-img-container, .bdaia-lazyload .big-grids, .bdaia-lazyload .bd-post-carousel, .bdaia-lazyload .post-image, .bdaia-lazyload .bdaia-post-featured-image, .bdaia-lazyload .bdaia-post-content img, .bdaia-lazyload .bd-block-mega-menu-post, .bdaia-lazyload .bdaia-featured-img-cover, .bdaia-lazyload .thumbnail-cover, .bdaia-lazyload .ei-slider, .bdaia-lazyload .bd-post-thumb, .bdaia-lazyload .bwb-article-img-container" ).each(function (){
            var thiss     = jQuery(this);
            var offsetTop = thiss.offset().top;

            if (scrolled + win_height_padded > offsetTop) {
                jQuery(this).addClass( 'bdaia-img-show' );
            }
        });
    }

    woohoo_images_scroll();
});