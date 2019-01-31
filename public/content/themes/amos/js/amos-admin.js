/* Visual Composer Setup Blocks */
jQuery(document).ready(function($) {
    "use strict";

    $('.sortable_templates.setup li').on('click', function() {

        $('.sortable_templates.setup li').removeClass('active');
        $(this).addClass('active');
        var category = '.' + $(this).data('sort');
        if (category != '.all') {
            $('.amos_templates').hide();
            $(category).show();
        } else {

            $('.amos_templates').show();
        }


    });




});