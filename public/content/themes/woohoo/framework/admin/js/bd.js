jQuery(document).ready( function($)
{
    //Color Picker field
    jQuery('.bdayh-color-field').wpColorPicker();
    jQuery(document).on("click", "*" , function(){
        jQuery('#menu-to-edit li').find(".bdayh-color-field").not('.wp-color-picker').wpColorPicker();
    });

    // Icons Modal
    var idm = '';
    var iconm = '';

    jQuery(document).on("click", ".media-modal-icon" , function(){
        jQuery('.icons-modal-box').hide();
        jQuery('.icons-modal-box-overlay').hide();
    });

    jQuery(document).on("click", ".selectIconMenu" , function(){
        var t = jQuery(this);
        idm = t.data('id');
        jQuery('.icons-modal-box').fadeIn('fast');
        jQuery('.icons-modal-box-overlay').fadeIn('fast');

        jQuery.ajax({
            type: "post",
            url: 'admin-ajax.php',
            dataType: 'html',
            data: "action=getlisticon&nonce=",
            beforeSend: function(){},
            success: function(data){
                jQuery('.icons-modal-box').find('.icons-modal-content').html(data);
            }
        });


        jQuery(document).on("click", ".iconsModalSave" , function(){
            iconm = jQuery('.icons-modal-box').find('input[name="pMenuItemIcon"]:checked').val();
            jQuery('#edit-menu-itemIcon-'+idm).val(iconm);
            jQuery('#icon-preview-'+idm).removeClass().addClass(iconm);
            jQuery('.icons-modal-box').fadeOut();
            jQuery('.icons-modal-box-overlay').fadeOut();
        });
        return false;
    });


    jQuery(document).on("click", ".removeIcon" , function(){
        var idm = jQuery(this).data('id');
        jQuery('#edit-menu-itemIcon-'+idm).val('');
        jQuery('#icon-preview-'+idm).removeClass();

    });

    jQuery(document).on("click", ".fa-hover" , function(){
        jQuery(this).parent('.row').find('.fa-hover').removeClass('selectd');
        jQuery(this).addClass('selectd');
        jQuery(this).parent('.row').find('input').removeAttr('checked');
        jQuery(this).find('input').attr('checked','checked');
        return false;
    });


    //icon live search
    jQuery("body").on('keyup', '#bdaia_icons_filter', function(){

        // Retrieve the input field text and reset the count to zero
        var filter = jQuery(this).val(), count = 0;

        var regex = new RegExp(filter, "i"); // Create a regex variable outside the loop statement

        // Loop through the icons
        jQuery(".fontawesome-icon-list .col-md-3 ").each(function(){
            var classname = jQuery('i', this).attr('class');
            // If the list item does not contain the text phrase fade it out
            if (classname.search(regex) < 0) { // use the variable here
                jQuery(this).hide();

                // Show the list item if the phrase matches and increase the count by 1
            } else {
                jQuery(this).fadeIn();
                count++;
            }
        });

    });


    jQuery( ".media-modal-icon, .removeIcon, .icons-modal-box-footer .button-primary, .media-modal-icon" ).click( function(event) {
        event.preventDefault(event);
    });
});