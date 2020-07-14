(function($){
    'use strict';
    function createCookie(name, value, days) {
        var expires;

        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        } else {
            expires = "";
        }
        document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
    }

    $(document).ready(function () {

        setTimeout(function () {
            $('.ekommart-deal-topbar').show();
        },1500);

        $('.deal-topbar-close').click(function(e){
            e.preventDefault();
            $('.ekommart-deal-topbar').addClass('hide-up');
            createCookie('deal-topbar-hide', false, 1);
        });
    });
})(jQuery);

