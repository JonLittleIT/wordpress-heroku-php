/*
 Project name:       MODELTHEME
 Project author:     ModelTheme
 File name:          Custom Admin JS
*/






(function ($) {
  'use strict';

	jQuery( document ).ready(function() {

		// ... Start Admin JS here ...





		/**
		*
		* ||---------------------------------> Header Options: Rewrite Theme Options <---------------------------------||
		*
		*/
		var font = jQuery('#smartowl_select_font').val();
		if (font == "font-awesome-icons" ){
			jQuery(".cmb_id_smartowl_font-simple-line-icons").hide();
		}else if (font == "simple-line-icons" ){
			jQuery(".cmb_id_smartowl_font-awesome-icons").hide();
		}



		jQuery('#smartowl_select_font').on('change', function() {
			var font = jQuery(this).val();
			if (font == "font-awesome-icons" ){
				jQuery(".cmb_id_smartowl_font-simple-line-icons").fadeIn();
				jQuery(".cmb_id_smartowl_font-awesome-icons").fadeOut();
			}else if (font == "simple-line-icons" ){
				jQuery(".cmb_id_smartowl_font-awesome-icons").fadeOut();
				jQuery(".cmb_id_smartowl_font-simple-line-icons").fadeIn();
			}
		});




		/**
		*
		* ||---------------------------------> Header Options: Rewrite Theme Options <---------------------------------||
		*
		*/
		var header_custom = jQuery('#smartowl_custom_header_options_status').val();
		if (header_custom == "no" ){
			jQuery(".cmb_id_smartowl_header_custom_fixed_navigation").hide();
			jQuery(".cmb_id_smartowl_header_custom_logo").hide();
			jQuery(".cmb_id_smartowl_header_custom_variant").hide();
		}
		jQuery('#smartowl_custom_header_options_status').on('change', function() {
			var header_custom = jQuery(this).val();
			if (header_custom == "no" ){
				jQuery(".cmb_id_smartowl_header_custom_fixed_navigation").hide();
				jQuery(".cmb_id_smartowl_header_custom_logo").hide();
				jQuery(".cmb_id_smartowl_header_custom_variant").hide();
			}else{
				jQuery(".cmb_id_smartowl_header_custom_fixed_navigation").show();
				jQuery(".cmb_id_smartowl_header_custom_logo").show();
				jQuery(".cmb_id_smartowl_header_custom_variant").show();
			}
		});


		/**
		*
		* ||---------------------------------> Footer Options: ROW1 <---------------------------------||
		*
		*/
		// var row1_status = jQuery('.cmb_id_smartowl_footer_custom_row1_status #smartowl_footer_custom_row1_status').val();
		// if (row1_status == "enabled" ){
		// 	jQuery(".cmb_id_smartowl_footer_custom_row1_layout").show();
		// }else{
		// 	jQuery(".cmb_id_smartowl_footer_custom_row1_layout").hide();
		// }

		// jQuery('.cmb_id_smartowl_footer_custom_row1_status #smartowl_footer_custom_row1_status').on('change', function() {
		// 	var row1_status = jQuery(this).val();
		// 	if (row1_status == "enabled" ){
		// 		jQuery(".cmb_id_smartowl_footer_custom_row1_layout").show();
		// 	}else{
		// 		jQuery(".cmb_id_smartowl_footer_custom_row1_layout").hide();
		// 	}
		// });


		/**
		*
		* ||---------------------------------> Footer Options: ROW2 <---------------------------------||
		*
		*/
		// var row2_status = jQuery('.cmb_id_smartowl_footer_custom_row2_status #smartowl_footer_custom_row2_status').val();
		// if (row2_status == "enabled" ){
		// 	jQuery(".cmb_id_smartowl_footer_custom_row2_layout").show();
		// }else{
		// 	jQuery(".cmb_id_smartowl_footer_custom_row2_layout").hide();
		// }

		// jQuery('.cmb_id_smartowl_footer_custom_row2_status #smartowl_footer_custom_row2_status').on('change', function() {
		// 	var row2_status = jQuery(this).val();
		// 	if (row2_status == "enabled" ){
		// 		jQuery(".cmb_id_smartowl_footer_custom_row2_layout").show();
		// 	}else{
		// 		jQuery(".cmb_id_smartowl_footer_custom_row2_layout").hide();
		// 	}
		// });


		/**
		*
		* ||---------------------------------> Footer Options: ROW3 <---------------------------------||
		*
		*/
		// var row3_status = jQuery('.cmb_id_smartowl_footer_custom_row3_status #smartowl_footer_custom_row3_status').val();
		// if (row3_status == "enabled" ){
		// 	jQuery(".cmb_id_smartowl_footer_custom_row3_layout").show();
		// }else{
		// 	jQuery(".cmb_id_smartowl_footer_custom_row3_layout").hide();
		// }

		// jQuery('.cmb_id_smartowl_footer_custom_row3_status #smartowl_footer_custom_row3_status').on('change', function() {
		// 	var row3_status = jQuery(this).val();
		// 	if (row3_status == "enabled" ){
		// 		jQuery(".cmb_id_smartowl_footer_custom_row3_layout").show();
		// 	}else{
		// 		jQuery(".cmb_id_smartowl_footer_custom_row3_layout").hide();
		// 	}
		// });


		/**
		*
		* ||---------------------------------> Footer Options: Rewrite Theme Options <---------------------------------||
		*
		*/
		var header_custom = jQuery('#mt_custom_footer_options_status').val();
		if (header_custom == "no" ){
			jQuery(".cmb_id_mt_footer_custom_row1_status").hide();
			jQuery(".cmb_id_mt_footer_custom_row2_status").hide();
			jQuery(".cmb_id_mt_footer_custom_row3_status").hide();
			// jQuery(".cmb_id_smartowl_footer_custom_row1_layout").hide();
			// jQuery(".cmb_id_smartowl_footer_custom_row2_layout").hide();
			// jQuery(".cmb_id_smartowl_footer_custom_row3_layout").hide();
		}
		jQuery('#mt_custom_footer_options_status').on('change', function() {
			var header_custom = jQuery(this).val();
			if (header_custom == "no" ){
				jQuery(".cmb_id_mt_footer_custom_row1_status").hide();
				jQuery(".cmb_id_mt_footer_custom_row2_status").hide();
				jQuery(".cmb_id_mt_footer_custom_row3_status").hide();
				// jQuery(".cmb_id_smartowl_footer_custom_row1_layout").hide();
				// jQuery(".cmb_id_smartowl_footer_custom_row2_layout").hide();
				// jQuery(".cmb_id_smartowl_footer_custom_row3_layout").hide();
			}else{
				jQuery(".cmb_id_mt_footer_custom_row1_status").show();
				jQuery(".cmb_id_mt_footer_custom_row2_status").show();
				jQuery(".cmb_id_mt_footer_custom_row3_status").show();
				// jQuery(".cmb_id_smartowl_footer_custom_row1_layout").show();
				// jQuery(".cmb_id_smartowl_footer_custom_row2_layout").show();
				// jQuery(".cmb_id_smartowl_footer_custom_row3_layout").show();
			}
		});



		// ... Add custom js here ...









	});
} (jQuery) )