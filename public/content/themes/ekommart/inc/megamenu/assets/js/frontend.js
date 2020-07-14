(function ($) {
    $(function () {
        $('.main-navigation .has-mega-menu.has-stretchwidth').hover(function (e) {
            let $body = $('body'),
                pleft = $(this).offset().left,
                bodyleft = $body.offset().left;
            $('.mega-stretchwidth', this).css({
                left: -pleft + bodyleft,
                width: $body.width()
            });
        });

        $('.main-navigation .has-mega-menu.has-containerwidth').hover(function (e) {
            let $parent = $(this).closest('.container , .col-full, .header-container'),
                pleft = $parent.offset().left + parseInt($parent.css('padding-left')),
                cleft = $(this).offset().left;
            $('.mega-containerwidth', this).css({
                left: pleft - cleft,
                width: $parent.width()
            });
        });
    });
})(jQuery);