var $doc     = jQuery(document),
    $window  = jQuery(window);

$doc.ready(function()
{
    jQuery(document).on("click", ".del-img" , function(event)
    {
        event.preventDefault(event);

        jQuery(this).parent().fadeOut(function()
        {
            jQuery(this).hide();
            jQuery(this).parent().find('input[class="img-path"]').attr('value', '' );
        });
    });

    jQuery('.on-of').checkbox({empty: ''});

    jQuery(document).on("click", ".layouts-inner li" , function(event)
    {
        event.preventDefault();

        jQuery(this).parent('ul').find('li').removeClass('selectd');
        jQuery(this).addClass('selectd');
        jQuery(this).parent('ul').find('input').removeAttr('checked');
        jQuery(this).find('input').attr('checked','checked');

        return false;
    });

    var linkOptions     = jQuery('#item-bd_post_link_text, #item-bd_post_link_url, #link_options'),
        linkTrigger     = jQuery('#post-format-link'),
        quoteOptions    = jQuery('#item-bd_post_quote_author, #quote_options'),
        quoteTrigger    = jQuery('#post-format-quote'),
        group           = jQuery('#post-formats-select input');

    woohoo_hide(null);

    jQuery(document).on('change', '#post-formats-select input', function(event)
    {
        event.preventDefault(event);

        $that = jQuery(this);
        woohoo_hide(null);

        if( $that.val() =="link" )
        {
            linkOptions.stop().fadeIn('fast');
        }
        else if( $that.val() =='quote' )
        {
            quoteOptions.stop().fadeIn('fast');
        }
    });

    if(linkTrigger.is(':checked')) linkOptions.stop().fadeIn('fast');
    if(quoteTrigger.is(':checked')) quoteOptions.stop().fadeIn('fast');

    function woohoo_hide(notThisOne) {
        linkOptions.css('display', 'none');
        quoteOptions.css('display', 'none');
    }
});

function add_cat(input_id, cat) {
    var input_id;
    var cat;
    if (cat != '') {
        var input_val = jQuery('#' + input_id).val();
        if (input_val == '') {
            jQuery('#' + input_id).val(cat);
        } else {
            jQuery('#' + input_id).val(input_val + ',' + cat);
        }
    }
}
function add_tag(input_id, tag) {
    var input_id;
    var tag;
    if (tag != '') {
        var input_val = jQuery('#' + input_id).val();
        if (input_val == '') {
            jQuery('#' + input_id).val(tag);
        } else {
            jQuery('#' + input_id).val(input_val + ',' + tag);
        }
    }
}

// image Uploader Functions
function woohoo_set_uploader(field, styling ) {
    var bd_bg_uploader;
    jQuery(document).on("click", "#upload_"+field+"_button" , function( event ){
        event.preventDefault();
        bd_bg_uploader = wp.media.frames.bd_bg_uploader = wp.media({
            title: 'Choose Image',
            library: {type: 'image'},
            button: {text: 'Select'},
            multiple: false
        });

        bd_bg_uploader.on( 'select', function() {
            var selection = bd_bg_uploader.state().get('selection');
            selection.map( function( attachment ) {
                attachment = attachment.toJSON();

                if( styling )
                    jQuery('#'+field+'-img').val(attachment.url);
                else
                    jQuery('#'+field).val(attachment.url);

                jQuery('#'+field+'-preview').show();
                jQuery('#'+field+'-preview img').attr("src", attachment.url );
            });
        });
        bd_bg_uploader.open();
    });
}

(function($){var i=function(e){if(!e)var e=window.event;e.cancelBubble=true;if(e.stopPropagation)e.stopPropagation()};$.fn.checkbox=function(f){try{document.execCommand('BackgroundImageCache',false,true)}catch(e){}var g={cls:'jquery-checkbox',empty:'empty.png'};g=$.extend(g,f||{});var h=function(a){var b=a.checked;var c=a.disabled;var d=$(a);if(a.stateInterval)clearInterval(a.stateInterval);a.stateInterval=setInterval(function(){if(a.disabled!=c)d.trigger((c=!!a.disabled)?'disable':'enable');if(a.checked!=b)d.trigger((b=!!a.checked)?'check':'uncheck')},10);return d};return this.each(function(){var a=this;var b=h(a);if(a.wrapper)a.wrapper.remove();a.wrapper=$('<span class="'+g.cls+'"><span class="mark"></span></span>');a.wrapperInner=a.wrapper.children('span:eq(0)');a.wrapper.hover(function(e){a.wrapperInner.addClass(g.cls+'-hover');i(e)},function(e){a.wrapperInner.removeClass(g.cls+'-hover');i(e)});b.css({position:'absolute',zIndex:-1,visibility:'hidden'}).after(a.wrapper);var c=false;if(b.attr('id')){c=$('label[for='+b.attr('id')+']');if(!c.length)c=false}if(!c){c=b.closest?b.closest('label'):b.parents('label:eq(0)');if(!c.length)c=false}if(c){c.hover(function(e){a.wrapper.trigger('mouseover',[e])},function(e){a.wrapper.trigger('mouseout',[e])});c.click(function(e){b.trigger('click',[e]);i(e);return false})}a.wrapper.click(function(e){b.trigger('click',[e]);i(e);return false});b.click(function(e){i(e)});b.bind('disable',function(){a.wrapperInner.addClass(g.cls+'-disabled')}).bind('enable',function(){a.wrapperInner.removeClass(g.cls+'-disabled')});b.bind('check',function(){a.wrapper.addClass(g.cls+'-checked')}).bind('uncheck',function(){a.wrapper.removeClass(g.cls+'-checked')});$('img',a.wrapper).bind('dragstart',function(){return false}).bind('mousedown',function(){return false});if(window.getSelection)a.wrapper.css('MozUserSelect','none');if(a.checked)a.wrapper.addClass(g.cls+'-checked');if(a.disabled)a.wrapperInner.addClass(g.cls+'-disabled')})}})(jQuery);