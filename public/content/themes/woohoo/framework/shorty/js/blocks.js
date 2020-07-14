function woohoo_blocks_ajax_js( $block_id, prev )
{
    var block               = jQuery( '.bdaia-block-id-'+$block_id );
    var bd_wait             = jQuery( '.bdaia-block-id-'+$block_id+' .bdayh-posts-load-wait'        );
    var bd_more             = jQuery( '.bdaia-block-id-'+$block_id+' .bdaia-load-more-news-btn'     );
    var bd_next             = jQuery( '.bdaia-block-id-'+$block_id+' .carousel-nav .mo-next'        );
    var bd_prev             = jQuery( '.bdaia-block-id-'+$block_id+' .carousel-nav .mo-prev'        );
    var bd_content          = jQuery( '.bdaia-block-id-'+$block_id+' .bdaia-blocks-container'       );

    var bd_paged            = parseInt( block.attr( 'data-paged'            ) );
    var bd_num_posts        = parseInt( block.attr( 'data-num_posts'        ) );
    var bd_cat_uid          = parseInt( block.attr( 'data-cat_uid'          ) );

    var bd_sort_order       = block.attr( 'data-sort_order'       );
    var bd_paged1           = block.attr( 'data-paged'       );

    var bd_tag_slug         = block.attr( 'data-tag_slug'         );
    var bd_cat_uids         = block.attr( 'data-cat_uids'         );
    var bd_offset           = block.attr( 'data-offset'           );
    var bd_ajax_pagination  = block.attr( 'data-ajax_pagination'  );
    var bd_block_nu         = block.attr( 'data-block_nu'         );
    var bd_max_nu           = block.attr( 'data-max_nu'           );
    var bd_total_posts_num  = block.attr( 'data-total_posts_num'  );
    var bd_page_nav         = bd_offset - bd_total_posts_num;
    var bd_offset_t         = ( bd_paged > 1) ? ( bd_num_posts * ( bd_paged - 1 ) + 1 ) - bd_num_posts : 0;

    if( bd_ajax_pagination == "load_more" )
    {
        if( bd_paged < bd_max_nu ){
            bd_paged++;
        }
    }
    else if( bd_ajax_pagination = "next_prev" )
    {
        if( prev == 'next' ) {
            if( bd_paged < bd_max_nu ){
                bd_paged++;
            }
        }
        else {
            if ( bd_paged != 1 ) {
                bd_paged = bd_paged - 1;
            }
            else {
                return false;
            }
        }
    }

    block.attr( 'data-paged', bd_paged  );

    jQuery.ajax({
        type        : "POST",
        url         : bd_blocks.bdaia_ajax_url,
        dataType    : 'html',
        data        : "action=bdaia_blocks&nonce="+bd_blocks.bdaia_ajaxnonce+"&paged="+bd_paged+"&sort_order="+bd_sort_order+"&num_posts="+bd_num_posts+"&tag_slug="+bd_tag_slug+"&cat_uid="+bd_cat_uid+"&cat_uids="+bd_cat_uids+"&ajax_pagination="+bd_ajax_pagination+"&block_nu="+bd_block_nu+"&offset="+bd_offset,
        cache       : false,

        beforeSend : function ()
        {
            bd_wait.css( "display", "block"     );

            if ( bd_block_nu == 'b1' || bd_block_nu == 'b2' || bd_block_nu == 'b6' ) {
                bd_content.css( "opacity", "1" );
            }
            else if ( bd_block_nu == 'b3' || bd_block_nu == 'b4' || bd_block_nu == 'b5' || bd_block_nu == 'b7' || bd_block_nu == 'b12' || bd_block_nu == 'b13' )  {
                if( bd_ajax_pagination == "load_more" ) {
                    bd_content.css( "opacity", "1" );
                }
                else if( bd_ajax_pagination = "next_prev" ) {
                    bd_content.css( "opacity", "0.4" );
                }
            }
            else if ( bd_block_nu == 'b8' || bd_block_nu == 'b9' || bd_block_nu == 'b10' || bd_block_nu == 'b11' )  {
                bd_content.css( "opacity", "0.4" );
            }
        },

        success: function(data)
        {
            var content = jQuery(data);

            content.each(function(index){
                if(jQuery().mediaelementplayer){
                    jQuery(this).find('.wp-audio-shortcode, .wp-video-shortcode').mediaelementplayer();
                }
            });

            i_refresh.refresh();
            content.fitVids();
            content.flexslider();

            jQuery('.ttip').tipsy({fade: true, gravity: 's'});

            if ( data.trim() !== '' )
            {
                if ( bd_block_nu == 'b1' || bd_block_nu == 'b2' || bd_block_nu == 'b6' ) {
                    bd_content.append(content).fadeIn('fast');
                }

                else if ( bd_block_nu == 'b3' || bd_block_nu == 'b4' || bd_block_nu == 'b5' || bd_block_nu == 'b7' || bd_block_nu == 'b12' || bd_block_nu == 'b13' ) {

                    if( bd_ajax_pagination == "load_more" ) {
                        bd_content.append(content).fadeIn('fast');
                    }
                    else if( bd_ajax_pagination = "next_prev" ) {
                        bd_content.html(content).fadeIn('fast');
                        bd_content.css( "opacity", "1" );
                    }
                }

                else if ( bd_block_nu == 'b8' || bd_block_nu == 'b9' || bd_block_nu == 'b10' || bd_block_nu == 'b11' )  {
                    bd_content.html(content).fadeIn('fast');
                    bd_content.css( "opacity", "1" );
                }

                bd_more.css( "display", "block" );

                var bd_re   = bd_content.find( '.block-article-img-container' );
                bd_re.addClass( 'bdaia-img-show' );
            }

            bd_wait.css( "display", "none" );

            if( bd_max_nu == bd_paged ){
                bd_more.remove();
                bd_next.addClass('ajax-page-disabled');
            }
            else {
                bd_next.removeClass('ajax-page-disabled');
            }

            if( 1 == bd_paged ){
                bd_prev.addClass('ajax-page-disabled');
            }
            else {
                bd_prev.removeClass('ajax-page-disabled');
            }
        }

    }, 'html');
    return false;
}