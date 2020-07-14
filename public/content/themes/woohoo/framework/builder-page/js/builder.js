jQuery(document).ready(function()
{
    jQuery("#bdaia_page_builder").click( function()
    {
        if( jQuery(this).hasClass( 'builder_active' ) ){
            jQuery(this).removeClass( 'button-primary builder_active' );

            jQuery( '#postdivrich, #pageparentdiv, #postimagediv, #revisionsdiv' ).fadeIn('fast');
            jQuery( '#bdaia_home_builder' ).hide();

            jQuery( '#bdaia_builder_p_active' ).val( '' );
        }else{
            jQuery(this).addClass( 'button-primary builder_active' );

            jQuery( '#bdaia_home_builder' ).fadeIn();
            jQuery( '#postdivrich, #pageparentdiv, #postimagediv, #revisionsdiv' ).hide();

            jQuery( '#bdaia_builder_p_active' ).val( 'yes' );

            //Page templates
            jQuery( '#page_template option:first-child' ).attr("selected","selected");
        }
        return false;
    });

    if ( jQuery("#bdaia_builder_p_active").val() == 'yes')
    {
        jQuery('#postdivrich, #pageparentdiv, #postimagediv, #revisionsdiv').hide();
    }

    jQuery(document).on("click", ".bdaia_box_item .bdaia_boxes_title a.bdaia_toggle" , function(event){
        event.preventDefault(event);
        var elm_id = jQuery(this).parent().parent().attr('id');
        if(jQuery('#'+elm_id).find('.bdaia_boxes_wrapper').hasClass( 'on' )) {
            jQuery('#'+elm_id).find('.bdaia_boxes_wrapper').removeClass( "on" );
            jQuery('#'+elm_id).find('.bdaia_boxes_wrapper').addClass( "of" );
            jQuery('#'+elm_id).find('a.bdaia_toggle').addClass('bdaia_toggle_of');
            jQuery('#'+elm_id).find('a.bdaia_toggle').removeClass('bdaia_toggle_on');
        } else {
            jQuery('#'+elm_id).find('.bdaia_boxes_wrapper').addClass( "on" );
            jQuery('#'+elm_id).find('.bdaia_boxes_wrapper').removeClass( "of" );
            jQuery('#'+elm_id).find('a.bdaia_toggle').addClass('bdaia_toggle_on');
            jQuery('#'+elm_id).find('a.bdaia_toggle').removeClass('bdaia_toggle_of');

        }
    });

    jQuery(document).on("click", ".bdaia_box_item .bdaia_boxes_title a.bdaia_del" , function(event){
        event.preventDefault(event);
        var box_id = jQuery(this).attr('id').replace('remove_','');
        jQuery('#home_box_'+box_id).fadeOut( 'fast' ).remove();
    });

    jQuery(document).on("click", ".bdaia_box_item .bdaia_boxes_title .bdaia_handle" , function(event){
        event.preventDefault(event);
    });

    var bdaia_blocks_obj = { block1:1, block2:2, block3:3, block4:4, block5:5, block6:6, block7:7, block8:8, block9:9, block10:10, block11:11, block12:12, block13:13, block23:23, block24:24 };

    jQuery.each( bdaia_blocks_obj, function( i, val )
    {
        jQuery(document).on("click", "#bdaia_home_block"+val+"_btn" , function(event)
        {
            event.preventDefault(event);

            var str_cats = bdaia.added_box_cats;
            var res_cats = str_cats.replace( new RegExp( '__total_boxes__', 'g') , total_boxes );

            var str_tags = bdaia.added_box_tags;
            var res_tags = str_tags.replace( new RegExp( '__total_boxes__', 'g') , total_boxes );

            var form = jQuery('<div id="bdaia_home_block'+ val +'_tmpl">\
                <div class="bdaia_box_item bdaia_home_block'+ val +'_tmpl" id="home_box_'+ total_boxes +'">\
                    <input type="hidden" name="bdaia_home_cats['+ total_boxes +'][type]" value="block'+ val +'" />\
                    <div class="bdaia_boxes_title">\
                        <a href="#" class="bdaia_handle"><i class="handle"></i></a>\
                        <a href="#" class="bdaia_del" id="remove_'+ total_boxes +'"><i class="del"></i></a>\
                        <a href="#" class="bdaia_toggle"><i class="toggle"></i></a>\
                    </div>\
                    <div class="bdaia_boxes_content">\
                        <div class="bdaia_boxes_title_cu">Custom Title</div>\
                        <div class="bdaia_boxes_wrapper of">\
                            <div class="bd_item_content">\
                                <div class="my_meta_control">\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Custom title:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][block_title]" id="bdaia_block'+ total_boxes +'-block_title" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Custom title -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Title url:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][title_url]" id="bdaia_block'+ total_boxes +'-title_url" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Title url -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Title Text Color:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][title_text_color]" id="bdaia_block'+ total_boxes +'-title_text_color" class="bdaia-input-color" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Title Text Color -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Dot Background Color:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][title_bg_color]" id="bdaia_block'+ total_boxes +'-title_bg_color" class="bdaia-input-color" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Dot Background Color -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Margin top:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][margin_t]" id="bdaia_block'+ total_boxes +'-margin_t" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Margin top -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Margin Bottom:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][margin_b]" id="bdaia_block'+ total_boxes +'-margin_b" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Margin Bottom -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Category Filter:</th>\
                                                <td>\
                                                    <select name="bdaia_home_cats['+ total_boxes +'][cat]" id="bdaia_block'+ total_boxes +'-cat">\
                                                        '+$cats+'\
                                                    </select>\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Category Filter -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Multiple categories filter:</th>\
                                                <td>\
                                                    <input style="width: 100%" name="bdaia_home_cats['+ total_boxes +'][cat_uids]" id="bdaia_block'+ total_boxes +'-cat_uids" type="text" value="" />\
                                                    '+res_cats+'\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Multiple categories filter -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Filter by tag slug:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][tag_slug]" id="bdaia_block'+ total_boxes +'-tag_slug" type="text" value="" />\
                                                    '+res_tags+'\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Filter by tag slug -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Sort order:</th>\
                                                <td>\
                                                    <select name="bdaia_home_cats['+ total_boxes +'][sort_order]" id="bdaia_block'+ total_boxes +'-sort_order">\
                                                        <option value="" selected="selected">- Latest -</option>\
                                                        <option value="popular">Popular (all time)</option>\
                                                        <option value="alphabetical_order">Alphabetical A -&gt; Z</option>\
                                                        <option value="review_high">Highest rated (reviews)</option>\
                                                        <option value="comment_count">Most Commented</option>\
                                                        <option value="random_posts">Random Posts</option>\
                                                        <option value="random_today">Random posts Today</option>\
                                                        <option value="random_7_day">Random posts from last 7 Day</option>\
                                                    </select>\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Sort order -->\
                                    <div class="box_meta_inner num_posts">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Limit post number:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][num_posts]" id="bdaia_block'+ total_boxes +'-num_posts" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Limit post number -->\
                                    <div class="box_meta_inner offset">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Offset posts:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][offset]" id="bdaia_block'+ total_boxes +'-offset" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Offset posts -->\
                                    <div class="box_meta_inner ajax_pagination">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Pagination:</th>\
                                                <td>\
                                                    <select name="bdaia_home_cats['+ total_boxes +'][ajax_pagination]" id="bdaia_block'+ total_boxes +'-ajax_pagination">\
                                                        <option value="" selected="selected">- No pagination -</option>\
                                                        <option value="load_more">Load More button</option>\
                                                        <option class="pbnext_prev" value="next_prev">Next/Prev</option>\
                                                    </select>\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Pagination -->\
                                </div>\
                            </div>\
                        </div><!-- .Wrapper -->\
                    </div>\
                </div>\
            </div>');

            form.find('.bdaia-input-color').wpColorPicker();

            var pb_next_prev    = form.find( '.bdaia_home_block1_tmpl, .bdaia_home_block2_tmpl, .bdaia_home_block6_tmpl' );
            var pbb_next_prev   = pb_next_prev.find( '.pbnext_prev' );
            pbb_next_prev.remove();

            var pb_ajax_p23    = form.find( '.bdaia_home_block23_tmpl' );
            var pbb_ajax_p23   = pb_ajax_p23.find( '.box_meta_inner.ajax_pagination, .box_meta_inner.num_posts, .box_meta_inner.offset' );
            pbb_ajax_p23.remove();

            var pb_ajax_p24    = form.find( '.bdaia_home_block24_tmpl' );
            var pbb_ajax_p24   = pb_ajax_p24.find( '.box_meta_inner.ajax_pagination' );
            pbb_ajax_p24.remove();

            jQuery( '.bdaia_boxes_sortable' ).append(form);
            jQuery( '#home_box_'+ total_boxes +' .bdaia_boxes_wrapper' ).addClass( 'on' );
            total_boxes ++;
        });
    });

    jQuery( '.bdaia_box_item_block1 .pbnext_prev, .bdaia_box_item_block2 .pbnext_prev, .bdaia_box_item_block6 .pbnext_prev, .bdaia_box_item_block23 .box_meta_inner.ajax_pagination, .bdaia_box_item_block23 .box_meta_inner.num_posts, .bdaia_box_item_block23 .box_meta_inner.offset, .bdaia_box_item_block24 .box_meta_inner.ajax_pagination' ).remove();

    jQuery(document).on( "click", "#bdaia_home_ad_btn", function(event)
    {
        event.preventDefault(event);

        var form = jQuery('<div class="bdaia_home_blog_tmpl">\
                <div class="bdaia_box_item bdaia_home_blog" id="home_box_'+ total_boxes +'">\
                    <input type="hidden" name="bdaia_home_cats['+ total_boxes +'][type]" value="ad" />\
                    <div class="bdaia_boxes_title">\
                        <a href="#" class="bdaia_handle"><i class="handle"></i></a>\
                        <a href="#" class="bdaia_del" id="remove_'+ total_boxes +'"><i class="del"></i></a>\
                        <a href="#" class="bdaia_toggle"><i class="toggle"></i></a>\
                    </div>\
                    <div class="bdaia_boxes_content">\
                        <div class="bdaia_boxes_title_cu">Text Or HTML Code</div>\
                        <div class="bdaia_boxes_wrapper of">\
                        <div class="box_meta_inner">\
                            <table class="meta_box_table">\
                                <tbody>\
                                <tr>\
                                    <th>Margin top:</th>\
                                    <td>\
                                        <input name="bdaia_home_cats['+ total_boxes +'][margin_t]" id="bdaia_block'+ total_boxes +'-margin_t" type="text" value="" />\
                                    </td>\
                                </tr>\
                                </tbody>\
                            </table>\
                        </div><!-- Margin top -->\
                        <div class="box_meta_inner">\
                            <table class="meta_box_table">\
                                <tbody>\
                                <tr>\
                                    <th>Margin Bottom:</th>\
                                    <td>\
                                        <input name="bdaia_home_cats['+ total_boxes +'][margin_b]" id="bdaia_block'+ total_boxes +'-margin_b" type="text" value="" />\
                                    </td>\
                                </tr>\
                                </tbody>\
                            </table>\
                        </div><!-- Margin Bottom -->\
                        <br class="cfix">\
                        <textarea style="width: 100%; max-width: 100%;" class="textarea_full" name="bdaia_home_cats['+ total_boxes +'][text_code]" rows="7"></textarea>\
                        <div class="box_meta_info">Text, HTML and Shortcodes</div>\
                        </div><!-- .Wrapper -->\
                    </div>\
                </div>\
            </div>');
        jQuery( '.bdaia_boxes_sortable' ).append(form);
        jQuery( '#home_box_'+ total_boxes +' .bdaia_boxes_wrapper' ).addClass( 'on' );
        total_boxes ++;
    });

    jQuery(document).on( "click", "#bdaia_home_blog_btn", function(event)
    {
        event.preventDefault(event);

        var str_cats = bdaia.added_box_cats;
        var res_cats = str_cats.replace( new RegExp( '__total_boxes__', 'g') , total_boxes );

        var str_tags = bdaia.added_box_tags;
        var res_tags = str_tags.replace( new RegExp( '__total_boxes__', 'g') , total_boxes );

        var form = jQuery('<div class="bdaia_home_blog_tmpl">\
                <div class="bdaia_box_item bdaia_home_blog" id="home_box_'+ total_boxes +'">\
                    <input type="hidden" name="bdaia_home_cats['+ total_boxes +'][type]" value="blog" />\
                    <div class="bdaia_boxes_title">\
                        <a href="#" class="bdaia_handle"><i class="handle"></i></a>\
                        <a href="#" class="bdaia_del" id="remove_'+ total_boxes +'"><i class="del"></i></a>\
                        <a href="#" class="bdaia_toggle"><i class="toggle"></i></a>\
                    </div>\
                    <div class="bdaia_boxes_content">\
                        <div class="bdaia_boxes_title_cu">Custom Title</div>\
                        <div class="bdaia_boxes_wrapper of">\
                            <div class="bd_item_content">\
                                <div class="my_meta_control">\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Custom title:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][block_title]" id="bdaia_block'+ total_boxes +'-block_title" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Custom title -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Title url:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][title_url]" id="bdaia_block'+ total_boxes +'-title_url" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Title url -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Title Text Color:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][title_text_color]" id="bdaia_block'+ total_boxes +'-title_text_color" class="bdaia-input-color" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Title Text Color -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Dot Background Color:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][title_bg_color]" id="bdaia_block'+ total_boxes +'-title_bg_color" class="bdaia-input-color" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Dot Background Color -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Margin top:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][margin_t]" id="bdaia_block'+ total_boxes +'-margin_t" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Margin top -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Margin Bottom:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][margin_b]" id="bdaia_block'+ total_boxes +'-margin_b" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Margin Bottom -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Category Filter:</th>\
                                                <td>\
                                                    <select name="bdaia_home_cats['+ total_boxes +'][cat]" id="bdaia_block'+ total_boxes +'-cat">\
                                                        '+$cats+'\
                                                    </select>\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Category Filter -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Multiple categories filter:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][cat_uids]" id="bdaia_block'+ total_boxes +'-cat_uids" type="text" value="" />\
                                                    '+res_cats+'\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Multiple categories filter -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Filter by tag slug:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][tag_slug]" id="bdaia_block'+ total_boxes +'-tag_slug" type="text" value="" />\
                                                    '+res_tags+'\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Filter by tag slug -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Limit post number:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][num_posts]" id="bdaia_block'+ total_boxes +'-num_posts" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Limit post number -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                                <tr>\
                                                    <th>Display:</th>\
                                                    <td>\
                                                        <select name="bdaia_home_cats['+ total_boxes +'][display]" id="bdaia_block'+ total_boxes +'-display">\
                                                            <option value="blog1" selected="selected">- Blog -</option>\
                                                            <option value="blog2">Blog 2</option>\
                                                            <option value="blog3">Blog 3</option>\
                                                            <option value="blog4">Blog 4</option>\
                                                            <option value="blog5">Blog 5</option>\
                                                            <option value="blog6">Blog 6</option>\
                                                            <option value="blog7">Blog 7</option>\
                                                            <option value="blog8">Blog 8</option>\
                                                            <option value="blog9">Timeline</option>\
                                                        </select>\
                                                    </td>\
                                                </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- box_meta_inner -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Pagination:</th>\
                                                <td>\
                                                    <select name="bdaia_home_cats['+ total_boxes +'][pagination]" id="bdaia_block'+ total_boxes +'-pagination">\
                                                        <option value="" selected="selected">- No pagination -</option>\
                                                        <option value="show_pagi">Show Pagination</option>\
                                                    </select>\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Pagination -->\
                                </div>\
                            </div>\
                        </div><!-- .Wrapper -->\
                    </div>\
                </div>\
            </div>');

        form.find('.bdaia-input-color').wpColorPicker();

        jQuery( '.bdaia_boxes_sortable' ).append(form);
        jQuery( '#home_box_'+ total_boxes +' .bdaia_boxes_wrapper' ).addClass( 'on' );
        total_boxes ++;
    });

    jQuery(document).on( "click", "#bdaia_home_slider_btn", function(event)
    {
        event.preventDefault(event);

        var str_cats = bdaia.added_box_cats;
        var res_cats = str_cats.replace( new RegExp( '__total_boxes__', 'g') , total_boxes );

        var str_tags = bdaia.added_box_tags;
        var res_tags = str_tags.replace( new RegExp( '__total_boxes__', 'g') , total_boxes );

        var form = jQuery('<div class="bdaia_home_slider_tmpl">\
                <div class="bdaia_box_item bdaia_home_slider" id="home_box_'+ total_boxes +'">\
                    <input type="hidden" name="bdaia_home_cats['+ total_boxes +'][type]" value="slider" />\
                    <div class="bdaia_boxes_title">\
                        <a href="#" class="bdaia_handle"><i class="handle"></i></a>\
                        <a href="#" class="bdaia_del" id="remove_'+ total_boxes +'"><i class="del"></i></a>\
                        <a href="#" class="bdaia_toggle"><i class="toggle"></i></a>\
                    </div>\
                    <div class="bdaia_boxes_content">\
                        <div class="bdaia_boxes_title_cu">Slider</div>\
                        <div class="bdaia_boxes_wrapper of">\
                            <div class="bd_item_content">\
                                <div class="my_meta_control">\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Margin top:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][margin_t]" id="bdaia_block'+ total_boxes +'-margin_t" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Margin top -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Margin Bottom:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][margin_b]" id="bdaia_block'+ total_boxes +'-margin_b" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Margin Bottom -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Category Filter:</th>\
                                                <td>\
                                                    <select name="bdaia_home_cats['+ total_boxes +'][cat]" id="bdaia_block'+ total_boxes +'-cat">\
                                                        '+$cats+'\
                                                    </select>\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Category Filter -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Multiple categories filter:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][cat_uids]" id="bdaia_block'+ total_boxes +'-cat_uids" type="text" value="" />\
                                                    '+res_cats+'\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Multiple categories filter -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Filter by tag slug:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][tag_slug]" id="bdaia_block'+ total_boxes +'-tag_slug" type="text" value="" />\
                                                    '+res_tags+'\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Filter by tag slug -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Multiple Posts filter:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][post_in]" id="bdaia_block'+ total_boxes +'-post_in" type="text" value="" />\
                                                    <div class="box_meta_info">Filter multiple posts by ID( ex: 41, 352 ).</div>\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Multiple Posts filter -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Sort order:</th>\
                                                <td>\
                                                    <select name="bdaia_home_cats['+ total_boxes +'][sort_order]" id="bdaia_block'+ total_boxes +'-sort_order">\
                                                        <option value="" selected="selected">- Latest -</option>\
                                                        <option value="popular">Popular (all time)</option>\
                                                        <option value="alphabetical_order">Alphabetical A -&gt; Z</option>\
                                                        <option value="review_high">Highest rated (reviews)</option>\
                                                        <option value="comment_count">Most Commented</option>\
                                                        <option value="random_posts">Random Posts</option>\
                                                        <option value="random_today">Random posts Today</option>\
                                                        <option value="random_7_day">Random posts from last 7 Day</option>\
                                                    </select>\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Sort order -->\
                                    <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Limit post number:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][num_posts]" id="bdaia_block'+ total_boxes +'-num_posts" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Limit post number -->\
                                     <div class="box_meta_inner">\
                                        <table class="meta_box_table">\
                                            <tbody>\
                                            <tr>\
                                                <th>Offset posts:</th>\
                                                <td>\
                                                    <input name="bdaia_home_cats['+ total_boxes +'][offset]" id="bdaia_block'+ total_boxes +'-offset" type="text" value="" />\
                                                </td>\
                                            </tr>\
                                            </tbody>\
                                        </table>\
                                    </div><!-- Offset posts -->\
                                </div>\
                            </div>\
                        </div><!-- .Wrapper -->\
                    </div>\
                </div>\
            </div>');
        jQuery( '.bdaia_boxes_sortable' ).append(form);
        jQuery( '#home_box_'+ total_boxes +' .bdaia_boxes_wrapper' ).addClass( 'on' );
        total_boxes ++;
    });
});