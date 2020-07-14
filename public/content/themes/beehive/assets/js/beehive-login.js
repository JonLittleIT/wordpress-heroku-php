'use strict';

//On document ready
(function($) {
    $('#panel-login-form, #modal-login-form, #element-login-form').on('submit', function(e) {
        const formID = $(this).attr('id');
        if( ! formID.length ) {
            return;
        }
        const $this = $(this);
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.addClass('loading');
        const result = $(this).find('.beehive-login-result');
        let data = $(this).serialize();
        data += '&action=beehive_ajaxlogin';
        data += '&form_id=' + formID;
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: beehive_data.ajaxurl,
            data: data,
            success: function(data){
                result.html(data.message).show();
                if (data.loggedin == true){
                    document.location.href = beehive_data.redirecturl;
                }
            },
            complete: function () {
                submitBtn.removeClass('loading');
            },
            error: function () {
                submitBtn.removeClass('loading');
                $this.off('submit').submit();
            }
        });
        e.preventDefault();
    });
})( jQuery );

