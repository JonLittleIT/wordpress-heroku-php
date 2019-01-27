/*global wc_enhanced_select_params */
jQuery( function( $ ) {
    
    "use strict";

	function getEnhancedSelectFormatString() {
		var formatString = {
			formatMatches: function( matches ) {
				if ( 1 === matches ) {
					return wc_enhanced_select_params.i18n_matches_1;
				}

				return wc_enhanced_select_params.i18n_matches_n.replace( '%qty%', matches );
			},
			formatNoMatches: function() {
				return wc_enhanced_select_params.i18n_no_matches;
			},
			formatAjaxError: function( jqXHR, textStatus, errorThrown ) {
				return wc_enhanced_select_params.i18n_ajax_error;
			},
			formatInputTooShort: function( input, min ) {
				var number = min - input.length;

				if ( 1 === number ) {
					return wc_enhanced_select_params.i18n_input_too_short_1;
				}

				return wc_enhanced_select_params.i18n_input_too_short_n.replace( '%qty%', number );
			},
			formatInputTooLong: function( input, max ) {
				var number = input.length - max;

				if ( 1 === number ) {
					return wc_enhanced_select_params.i18n_input_too_long_1;
				}

				return wc_enhanced_select_params.i18n_input_too_long_n.replace( '%qty%', number );
			},
			formatSelectionTooBig: function( limit ) {
				if ( 1 === limit ) {
					return wc_enhanced_select_params.i18n_selection_too_long_1;
				}

				return wc_enhanced_select_params.i18n_selection_too_long_n.replace( '%qty%', limit );
			},
			formatLoadMore: function( pageNumber ) {
				return wc_enhanced_select_params.i18n_load_more;
			},
			formatSearching: function() {
				return wc_enhanced_select_params.i18n_searching;
			}
		};

		return formatString;
	}

	$( 'body' )

		.on( 'wc_enhanced_select-init2', function() {



			// Regular select boxes
			$( ':input.wc_enhanced_select, :input.chosen_select' ).filter( ':not(.enhanced)' ).each( function() {
				var select2_args = $.extend({
					minimumResultsForSearch: 10,
					allowClear:  $( this ).data( 'allow_clear' ) ? true : false,
					placeholder: $( this ).data( 'placeholder' )
				}, getEnhancedSelectFormatString() );

				$( this ).select2( select2_args ).addClass( 'enhanced' );
			});

			$( ':input.wc_enhanced_select-nostd, :input.chosen_select_nostd' ).filter( ':not(.enhanced)' ).each( function() {
				var select2_args = $.extend({
					minimumResultsForSearch: 10,
					allowClear:  true,
					placeholder: $( this ).data( 'placeholder' )
				}, getEnhancedSelectFormatString() );

				$( this ).select2( select2_args ).addClass( 'enhanced' );
			});

			// Ajax product search box
			$( ':input.wc_product_search' ).filter( ':not(.enhanced)' ).each( function() {
				var select2_args = {
					allowClear:  $( this ).data( 'allow_clear' ) ? true : false,
					placeholder: $( this ).data( 'placeholder' ),
					minimumInputLength: $( this ).data( 'minimum_input_length' ) ? $( this ).data( 'minimum_input_length' ) : '3',
					escapeMarkup: function( m ) {
						return m;
					},
					ajax: {
				        url:         wc_enhanced_select_params.ajax_url,
				        dataType:    'json',
				        quietMillis: 250,
				        data: function( term, page ) {
				            return {
								term:     term,
								action:   $( this ).data( 'action' ) || 'woocommerce_json_search_products_and_variations',
								security: wc_enhanced_select_params.search_products_nonce
				            };
				        },
				        results: function( data, page ) {
				        	var terms = [];
					        if ( data ) {
								$.each( data, function( id, text ) {
									terms.push( { id: id, text: text } );
								});
							}
				            return { results: terms };
				        },
				        cache: true
				    }
				};

				if ( $( this ).data( 'multiple' ) === true ) {
					select2_args.multiple = true;
					select2_args.initSelection = function( element, callback ) {
						var data     = $.parseJSON( element.attr( 'data-selected' ) );
						var selected = [];

						$( element.val().split( "," ) ).each( function( i, val ) {
							selected.push( { id: val, text: data[ val ] } );
						});
						return callback( selected );
					};
					select2_args.formatSelection = function( data ) {
						return '<div class="selected-option" data-id="' + data.id + '">' + data.text + '</div>';
					};
				} else {
					select2_args.multiple = false;
					select2_args.initSelection = function( element, callback ) {
						var data = {id: element.val(), text: element.attr( 'data-selected' )};
						return callback( data );
					};
				}

				select2_args = $.extend( select2_args, getEnhancedSelectFormatString() );

				$( this ).select2( select2_args ).addClass( 'enhanced' );
			});

			// Ajax customer search boxes
			$( ':input.wc-customer-search' ).filter( ':not(.enhanced)' ).each( function() {
				var select2_args = {
					allowClear:  $( this ).data( 'allow_clear' ) ? true : false,
					placeholder: $( this ).data( 'placeholder' ),
					minimumInputLength: $( this ).data( 'minimum_input_length' ) ? $( this ).data( 'minimum_input_length' ) : '3',
					escapeMarkup: function( m ) {
						return m;
					},
					ajax: {
				        url:         wc_enhanced_select_params.ajax_url,
				        dataType:    'json',
				        quietMillis: 250,
				        data: function( term, page ) {
				            return {
								term:     term,
								action:   'woocommerce_json_search_customers',
								security: wc_enhanced_select_params.search_customers_nonce
				            };
				        },
				        results: function( data, page ) {
				        	var terms = [];
					        if ( data ) {
								$.each( data, function( id, text ) {
									terms.push( { id: id, text: text } );
								});
							}
				            return { results: terms };
				        },
				        cache: true
				    }
				};
				if ( $( this ).data( 'multiple' ) === true ) {
					select2_args.multiple = true;
					select2_args.initSelection = function( element, callback ) {
						var data     = $.parseJSON( element.attr( 'data-selected' ) );
						var selected = [];

						$( element.val().split( ',' ) ).each( function( i, val ) {
							selected.push( { id: val, text: data[ val ] } );
						});
						return callback( selected );
					};
					select2_args.formatSelection = function( data ) {
						return '<div class="selected-option" data-id="' + data.id + '">' + data.text + '</div>';
					};
				} else {
					select2_args.multiple = false;
					select2_args.initSelection = function( element, callback ) {
						var data = {id: element.val(), text: element.attr( 'data-selected' )};
						return callback( data );
					};
				}

				select2_args = $.extend( select2_args, getEnhancedSelectFormatString() );

				$( this ).select2( select2_args ).addClass( 'enhanced' );
			});
		})

		// WooCommerce Backbone Modal
		.on( 'wc_backbone_modal_before_remove', function() {
			$( ':input.wc_enhanced_select, :input.wc-product-search, :input.wc-customer-search' ).select2( 'close' );
		})

		.trigger( 'wc_enhanced_select-init' );

});

jQuery(function($){
    
    "use strict";
    

    
    
    $('.customize-control select').on('change', function () {
    alert(1);
});
    
    

	var postType = $('#post-formats-select').find('input:checked').val();
	$('#post_format_options .rwmb-field').fadeOut();
	if ( postType == 0 ) {
		postType = 'standared';
	}
	$( 'label[for*="' + postType + '"]' ).closest('.rwmb-field').fadeIn();

	$('#post-formats-select').find('input').change( function() {

		var postType = $(this).val();
		if ( postType == 0 ) {
			$('#post_format_options .rwmb-field').fadeOut();
		}

		if ( postType == 0 ) {
			postType = 'standared';
		}

		$( 'label[for*="' + postType + '"]' ).closest('.rwmb-field').siblings('.rwmb-field').hide();
		$( 'label[for*="' + postType + '"]' ).closest('.rwmb-field').fadeIn();


	});

	

	// portfolio type toogle
	var portfolioType = $("#post_types_select :selected").val();
	$('#post_types .rwmb-meta-box .rwmb-field').not(':eq(0)').hide();
	if(portfolioType != "link"){
		$( 'label[for*="' + portfolioType + '"]' ).closest('.rwmb-field').siblings('.rwmb-field').hide();
		$( 'label[for*="' + portfolioType + '"]' ).closest('.rwmb-field').fadeIn();
		$('#post_types .rwmb-meta-box .rwmb-field').eq(0).show();
	}
	$('#post_types_select').change( function() {

		var portfolioType = $(this).val();
		if(portfolioType == "link"){
			$('#post_types .rwmb-meta-box .rwmb-field').not(':eq(0)').hide();
		}
		else{
			$( 'label[for*="' + portfolioType + '"]' ).closest('.rwmb-field').siblings('.rwmb-field').hide();
			$( 'label[for*="' + portfolioType + '"]' ).closest('.rwmb-field').fadeIn();
			$('#post_types .rwmb-meta-box .rwmb-field').eq(0).show();
		}
	});
    
    
  

	$('.pix-reset').on("click", function(event) {
		$(this).parent().find('input').val('');
	});

    
    

});


jQuery(document).ready(function($){
    
    
    "use strict";

    // Instantiates the variable that holds the media library frame.
    var meta_image_frame;
    var img_input;
    
    
    

    

   // Runs when the image button is clicked.
    $('.pix-image-upload').click(function(e){

	    img_input = $('#'+$(this).data('input'));
        // Prevents the default action from occuring.
        e.preventDefault();

        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }

        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });

        // Runs when an image is selected.
        meta_image_frame.on('select', function(){
            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
	        $(img_input).val(media_attachment.url);
        });

        // Opens the media library frame.
        meta_image_frame.open();
    });


	var font_opt = [];
	var $dropdown = $('#pix-google-font');
	var $dropdown_title = $('#pix-google-font-title');
	var $hid_index = $('#pix-google-family').val();
	var $hid_index_title = $('#pix-google-family-title').val();
	$.getJSON('https://www.googleapis.com/webfonts/v1/webfonts?key='+meta_image.font_api, function(data) {
        //console.log(data["items"]);
        $.each(data["items"], function(i,item){
            var temp = [];
            var selected = $hid_index == item.family ? 'selected="selected"' : '';
            var selected_title = $hid_index_title == item.family ? 'selected="selected"' : '';
            temp['category'] = item.category;
            temp['family'] = item.family;
            temp['subsets'] = item.subsets;
            temp['variants'] = item.variants;
            font_opt[i] = temp;
            $dropdown.append("<option value='" + i + "' "+selected+">" + item.family + "</option>");
            $dropdown_title.append("<option value='" + i + "' "+selected_title+">" + item.family + "</option>");
	        //console.log(font_opt[i]);
	        if(selected != ''){
	            $('#pix-font-content').html('');
	            var $hid_font_var = $('#pix-font-variants').val().split(',');
	            console.log($hid_font_var);
	            $.each(temp['variants'], function(j,item){
		            if(item == 'italic'){
			            var val = item.replace("italic", "400i");
			            var title = '400italic';
		            } else if(item == 'regular') {
			            var val = item.replace("regular", "400");
			            var title = val;
		            } else {
			            var val = item.replace("italic", "i");
			            var title = item;
		            }
		            var checked = $.inArray( val, $hid_font_var ) >= 0 ? 'checked="checked"' : '';
		            $('#pix-font-content').append('<input type="checkbox" name="font_variants[]" value="' + val + '" ' + checked + '>' + title + '</br>');
		        });
	        }
	        if(selected_title != ''){
	            $('#pix-font-content-title').html('');
	            var $hid_font_var = $('#pix-font-variants-title').val().split(',');
	            //console.log($hid_font_var);
	            $.each(temp['variants'], function(j,item){
		            if(item == 'italic'){
			            var val = item.replace("italic", "400i");
			            var title = '400italic';
		            } else if(item == 'regular') {
			            var val = item.replace("regular", "400");
			            var title = val;
		            } else {
			            var val = item.replace("italic", "i");
			            var title = item;
		            }
		            var checked = $.inArray( val, $hid_font_var ) >= 0 ? 'checked="checked"' : '';
		            $('#pix-font-content-title').append('<input type="checkbox" name="font_variants_title[]" value="' + val + '" ' + checked + '>' + title + '</br>');
		        });
	        }
        });

        var $dropdowns = $('.pix-google-font');
	    $dropdowns.each(function(){
	        $dropdown = $(this);
	        var $data_value = $dropdown.data('value');
	        var $data_customize = $dropdown.data('customize-setting-link');
	        var $container_id = $data_customize.replace(/farvis_/i, '');
	        $.each(font_opt, function(i,item){
		        var selected = $data_value === item['family'] ? 'selected="selected"' : '';
		        $dropdown.append("<option value='" + item['family'] + "' "+selected+">" + item['family'] + "</option>");
		        if( selected != '' ){
					$('#'+$container_id).html('');
					var $weight_single_value = $('#'+$container_id+'_weight').data('value');
					$('#'+$container_id+'_weight').html('<option value="">Default</option>');
					var weight_arr = [];
		            var $hid_font_var = typeof $('#'+$container_id+'_value').val() !== "undefined" ? $('#'+$container_id+'_value').val().split(',') : '';
		            //console.log($hid_font_var);
		            $.each(item['variants'], function(j,itm){
			            if(itm == 'italic'){
				            var val = itm.replace("italic", "400i");
				            var title = '400italic';
			            } else if(itm == 'regular') {
				            var val = itm.replace("regular", "400");
				            var title = val;
			            } else {
				            var val = itm.replace("italic", "i");
				            var title = itm;
			            }
			            var checked = $.inArray( val, $hid_font_var ) >= 0 ? 'checked="checked"' : '';
			            $('#'+$container_id).append('<input type="checkbox" class="font_variants_checkbox" data-hidden="'+$container_id+'_value" data-weight="'+$container_id+'_weight" name="'+$container_id+'_variants" value="' + val + '" ' + checked + '>' + title + '</br>');
			            var weight = val.replace("i", "");
			            if(checked != '' && $.inArray(weight, weight_arr) < 0){
			                weight_arr.push(weight);
			                console.log($weight_single_value);
			                console.log(weight);
			                var weight_selected = $weight_single_value == weight ? 'selected="selected"' : '';
			                $('#'+$container_id+'_weight').append('<option value="'+weight+'" '+weight_selected+'>'+weight+'</option>');
			            }
			        });
		        }
	        });
	    });

	    $(".font_variants_checkbox").on('change', function(e){
			var $hidden = $(this).data('hidden');
			var $weight_single = $(this).data('weight');
			var $name = $(this).attr('name');
		    //console.log($hidden);
		    //console.log($name);
		    $('#'+$weight_single).html('<option value="">Default</option>');
		    var weight_arr = [];
		    var str = '';
	        $( "input[name='"+$name+"']:checked" ).each( function(i,item){
	            if(i == 0)
	                str = $(this).val()
	            else
	                str = str + ',' + $(this).val();
	            var weight = $(this).val().replace("i", "");
	            if($.inArray(weight, weight_arr) < 0){
	                weight_arr.push(weight);
	                $('#'+$weight_single).append('<option value="'+weight+'">'+weight+'</option>');
	            }
	        });
	        $( '#'+$hidden).val(str);
	        $( '#'+$hidden).change();
		});

    });




    //console.log(font_opt[i]);
	$('#pix-google-font').on('change', function(e){
		$('#pix-google-family').val($('#pix-google-font option:selected').text());
		$('#pix-font-content').html('');
        $.each(font_opt[$(this).val()]['variants'], function(j,item){
            if(item == 'italic'){
	            var val = item.replace("italic", "400i");
	            var title = '400italic';
            } else if(item == 'regular') {
	            var val = item.replace("regular", "400");
	            var title = val;
            } else {
	            var val = item.replace("italic", "i");
	            var title = item;
            }
            $('#pix-font-content').append("<input type='checkbox' name='font_variants[]' value='" + val + "'>" + title + "</br>");
        });

	});

	$('#pix-google-font-title').on('change', function(e){
		$('#pix-google-family-title').val($('#pix-google-font-title option:selected').text());
		$('#pix-font-content-title').html('');
        $.each(font_opt[$(this).val()]['variants'], function(j,item){
            if(item == 'italic'){
	            var val = item.replace("italic", "400i");
	            var title = '400italic';
            } else if(item == 'regular') {
	            var val = item.replace("regular", "400");
	            var title = val;
            } else {
	            var val = item.replace("italic", "i");
	            var title = item;
            }
            $('#pix-font-content-title').append("<input type='checkbox' name='font_variants_title[]' value='" + val + "'>" + title + "</br>");
        });
	});

	if ( $('.pix-tabs').length != 0 ) {
        
           
        
        
		$('.pix-tabs li a').on("click", function(e) {
			e.preventDefault();
			var target = $(this).attr('href');
			$('.pix-tabs li').removeClass('ui-state-active');
			$(this).parent().addClass('ui-state-active');
			$('.pix_tabs_section').hide();
			$(target).show();
		});
	}

	$('#pix_admin_notice .pix_hide_notice').on('click', function(e) {
		e.preventDefault();
		$('#pix_admin_notice').attr('style', 'display: none !important');
		$.ajax({
			"type" : "POST",
			"url" : ajaxurl,
			data : {
				'action' : 'pix_hide_admin_notice'
			}
		});
	});
    
    
     function activationTimeout(){
      location.reload();
}

    
    $('.activation-theme').click(function() {
        
           
setTimeout(activationTimeout, 2000);
    
});
    
       
    

    
    
    
    
    
});
