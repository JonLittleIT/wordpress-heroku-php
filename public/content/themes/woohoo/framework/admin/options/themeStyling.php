<?php
/**
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Woohoo News Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$bd_options["theme_styling"]["custom_theme_color_options"][] = array(
    "name"      => "General",
    "type"      => "subtitle",
    "class"     => "fadeToggle"
);

$bd_options["theme_styling"]["custom_theme_color_options"][] = array(
    "name" 		=> "Select theme accent color",
    "id"    	=> "custom_theme_color",
    "type"  	=> "color",
    "class"     => "fadeToggle"
);

/**
 * Background
 * ========================================================= */

$bd_options["theme_styling"]["bg"][] = array(
	"name"      => "Background",
	"type"      => "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bg"][] = array(

	"name" 		=> "Background",
	"id" 		=> "background_displays",
	"type"  	=> "radio",
	"class"     => "fadeToggle",
	"options"   => array(
		"bg_cutsom"       => "Custom Background" ,
		"bg_pattren"      => "Pattern",
	),
	"js"		=>
		'<script type="text/javascript">
        jQuery(document).ready(function() {
		    jQuery( ".r_background_displays" ).change(function(){
		        var e = jQuery(this).val();
		        var b = jQuery( ".bd_custom_background, .bd_custom_background_full" );
		        var p = jQuery( ".bd_custom_pattrens_color, .bd_custom_pattrens" );
		        if( e == "bg_cutsom" ) {
		            b.stop().fadeIn("fast").removeClass( "hidden" );
		            p.stop().hide().addClass( "hidden" );
		        }
		        else if( e == "bg_pattren" ) {
		            p.stop().fadeIn("fast").removeClass( "hidden" );
		            b.stop().hide().addClass( "hidden" );
		        }
		    });
        });
    </script>',
);

$bg_cus = ( woohoo_get_option( 'background_displays' ) != 'bg_cutsom' ) ? 'hidden' : '';
$bd_options["theme_styling"]["bg"][] = array(
	"name" 		=> "Custom Background",
	"id"    	=> "custom_background",
	"type"  	=> "bgop",
	"class" 	=> $bg_cus . " bd_custom_background fadeToggle"
);

$bg_cus_full = ( woohoo_get_option( 'background_displays' ) != 'bg_cutsom' ) ? 'hidden' : '';
$bd_options["theme_styling"]["bg"][] = array(
	"name" 		=> "Full Screen",
	"id"    	=> "custom_background_full",
	"type"  	=> "checkbox",
	"class" 	=> $bg_cus_full . " bd_custom_background_full fadeToggle"
);

$bg_pat_color = ( woohoo_get_option( 'background_displays' ) != 'bg_pattren' ) ? 'hidden' : '';
$bd_options["theme_styling"]["bg"][] = array(
	"name" 		=> "Background Color",
	"id"    	=> "custom_pattrens_color",
	"type"  	=> "color",
	"class" 	=> $bg_pat_color . " bd_custom_pattrens_color fadeToggle"
);

$bg_pat = ( woohoo_get_option( 'background_displays' ) != 'bg_pattren' ) ? 'hidden' : '';
$bd_options["theme_styling"]["bg"][] = array(
	"name" 		=> "Choose Pattern",
	"id"    	=> "custom_pattrens",
	"type"  	=> "pattrens_bg",
	"class" 	=> $bg_pat . " bd_custom_pattrens fadeToggle"
);

/**
 * Body
 * ========================================================= */

$bd_options["theme_styling"]["bdaia_styling_body"][] = array(
	"name"      => "Body",
	"type"      => "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_body"][] = array(
	"name" 		=> "Text Color",
	"id"    	=> "bdaia_sbody_text_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_body"][] = array(
	"name" 		=> "Links Color",
	"id"    	=> "bdaia_sbody_links_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_body"][] = array(
	"name" 		=> "Links Hover Color",
	"id"    	=> "bdaia_sbody_links_hover_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);

/**
 * Top bar
 * ========================================================= */

$bd_options["theme_styling"]["bdaia_styling_top_bar"][] = array(
	"name"      => "Top Bar",
	"type"      => "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_top_bar"][] = array(
	"name" 		=> "Background Color",
	"id"    	=> "bdaia_top_bar_bg_color",
	"type"  	=> "color",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_top_bar"][] = array(
	"name" 		=> "Top Border Color",
	"id"    	=> "bdaia_top_bar_border_color",
	"type"  	=> "color",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_top_bar"][] = array(
	"name" 		=> "Text Color",
	"id"    	=> "bdaia_top_bar_text_color",
	"type"  	=> "color",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_top_bar"][] = array(
	"name" 		=> "Text Hover Color",
	"id"    	=> "bdaia_top_bar_text_hover_color",
	"type"  	=> "color",
	"class"     => "fadeToggle"
);

/**
 * Header
 * ========================================================= */

$bd_options["theme_styling"]["bdaia_styling_header"][] = array(
	"name"      => "Header",
	"type"      => "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_header"][] = array(
	"name" 		=> "Background",
	"id"    	=> "bdaia_header_bg",
	"type"  	=> "bgop",
	"class" 	=> "fadeToggle"
);

/**
 * Main menu
 * ========================================================= */

$bd_options["theme_styling"]["bdaia_styling_main_menu"][] = array(
	"name"      => "Main Menu",
	"type"      => "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_main_menu"][] = array(
	"name" 		=> "Background Color",
	"id"    	=> "bdaia_main_menu_bg_color",
	"type"  	=> "color",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_main_menu"][] = array(
	"name" 		=> "Text Color",
	"id"    	=> "bdaia_main_menu_text_color",
	"type"  	=> "color",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_main_menu"][] = array(
	"name" 		=> "Text Hover Color",
	"id"    	=> "bdaia_main_menu_text_hover_color",
	"type"  	=> "color",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_main_menu"][] = array(
	"name" 		=> "Active & Hover Background Color",
	"id"    	=> "bdaia_main_menu_active_bg",
	"type"  	=> "color",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_main_menu"][] = array(
	"name" 		=> "Drop Down Top border",
	"id"    	=> "bdaia_main_menu_top_border",
	"type"  	=> "color",
	"class"     => "fadeToggle"
);

/**
 * Footer
 * ========================================================= */

$bd_options["theme_styling"]["bdaia_styling_footer"][] = array(
	"name"      => "Footer",
	"type"      => "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_footer"][] = array(
	"name" 		=> "Background",
	"id"    	=> "bdaia_footer_bg",
	"type"  	=> "bgop",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_footer"][] = array(
	"name" 		=> "Text Color",
	"id"    	=> "bdaia_footer_text_color",
	"type"  	=> "color",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_footer"][] = array(
	"name" 		=> "Text Hover Color",
	"id"    	=> "bdaia_footer_text_hover_color",
	"type"  	=> "color",
	"class"     => "fadeToggle"
);

/**
 * Sub Footer
 * ========================================================= */

$bd_options["theme_styling"]["bdaia_styling_sub_footer"][] = array(
	"name"      => "Sub Footer",
	"type"      => "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_sub_footer"][] = array(
	"name" 		=> "Background",
	"id"    	=> "bdaia_sub_footer_bg",
	"type"  	=> "bgop",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_sub_footer"][] = array(
	"name" 		=> "Text Color",
	"id"    	=> "bdaia_sub_footer_text_color",
	"type"  	=> "color",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_styling_sub_footer"][] = array(
	"name" 		=> "Text Hover Color",
	"id"    	=> "bdaia_sub_footer_text_hover_color",
	"type"  	=> "color",
	"class"     => "fadeToggle"
);

/**
 * Post content
 * ========================================================= */

$bd_options["theme_styling"]["bdaia_post_content"][] = array(
	"name"      => "Post Content",
	"type"      => "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_post_content"][] = array(
	"name" 		=> "Text Color",
	"id"    	=> "bdaia_post_content_text_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_post_content"][] = array(
	"name" 		=> "Links Color",
	"id"    	=> "bdaia_post_content_links_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_post_content"][] = array(
	"name" 		=> "Links Hover Color",
	"id"    	=> "bdaia_post_content_links_hover_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["bdaia_post_content"][] = array(
	"name" 		=> "Default blockqoute text color",
	"id"    	=> "bdaia_post_content_blockqoute_text_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);

/**
 * Widget
 * ========================================================= */
$bd_options["theme_styling"]["woohoo_des_sidebar_widgets"][] = array(
	"name"      => "Sidebar Widgets",
	"type"      => "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_sidebar_widgets"][] = array(
	"name" 		=> "Background",
	"id"    	=> "woohoo_sidebar_widget_bg",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_sidebar_widgets"][] = array(
	"name" 		=> "Text color",
	"id"    	=> "woohoo_sidebar_widget_text_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_sidebar_widgets"][] = array(
	"name" 		=> "Links color",
	"id"    	=> "woohoo_sidebar_widget_links_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_sidebar_widgets"][] = array(
	"name" 		=> "Links :hover color",
	"id"    	=> "woohoo_sidebar_widget_links_hover_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_sidebar_widgets"][] = array(
	"name" 		=> "Title Background",
	"id"    	=> "woohoo_sidebar_widget_title_bg",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_sidebar_widgets"][] = array(
	"name" 		=> "Title text color",
	"id"    	=> "woohoo_sidebar_widget_title_text_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);

## Social counter --- --- --- --- ---
$bd_options["theme_styling"]["woohoo_des_sidebar_widgets"][] = array(
	"name" 		=> "Widget : Social Counter",
	"type"  	=> "subTT",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_sidebar_widgets"][] = array(
	"name" 		=> "Grid Border color",
	"id"    	=> "woohoo_sw_sc_gbc", // sidebar_widget_social_counter_grid_border_color ---
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_sidebar_widgets"][] = array(
	"name" 		=> "Count text color",
	"id"    	=> "woohoo_sw_sc_ctc", // sidebar_widget_social_counter_grid_border_color ---
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);

## tabs --- --- --- --- ---
$bd_options["theme_styling"]["woohoo_des_sidebar_widgets"][] = array(
	"name" 		=> "Widget : Tabs",
	"type"  	=> "subTT",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_sidebar_widgets"][] = array(
	"name" 		=> "Active tab background color",
	"id"    	=> "woohoo_sw_t_bc", // sidebar_widget_tabs_background_color
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_sidebar_widgets"][] = array(
	"name" 		=> "Nav text color",
	"id"    	=> "woohoo_sw_tn_tc", // sidebar_widget_tabs_nav_text_color
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);

/**
 * Blocks
 * ========================================================= */
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name"      => "Blocks",
	"type"      => "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Background",
	"id"    	=> "woohoo_blocks_bg",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Text color",
	"id"    	=> "woohoo_blocks_text_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Links color",
	"id"    	=> "woohoo_blocks_links_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Links :hover color",
	"id"    	=> "woohoo_blocks_links_hover_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Title Background",
	"id"    	=> "woohoo_blocks_title_bg",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Title color",
	"id"    	=> "woohoo_blocks_title_text_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Post Title color",
	"id"    	=> "woohoo_blocks_post_title_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Post Title :hover color",
	"id"    	=> "woohoo_blocks_post_title_hover_color",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Post meta text color",
	"id"    	=> "woohoo_blocks_post_meta_tc",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Post excerpt text color",
	"id"    	=> "woohoo_blocks_post_etc",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);

## Timeline --- --- --- --- ---
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Timeline",
	"type"  	=> "subTT",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Date Background color",
	"id"    	=> "woohoo_blocks_tl_bc",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Date Text color",
	"id"    	=> "woohoo_blocks_tl_tc",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);

## Block 13 --- --- --- --- ---
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Block 13",
	"type"  	=> "subTT",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Footer Background color",
	"id"    	=> "woohoo_blocks_b13_bc",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Footer text color",
	"id"    	=> "woohoo_blocks_b13_tc",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);

## Read more --- --- --- --- ---
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Read more",
	"type"  	=> "subTT",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Background color",
	"id"    	=> "woohoo_blocks_rm_bc",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks"][] = array(
	"name" 		=> "Text color",
	"id"    	=> "woohoo_blocks_rm_tc",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);

## Block Load More & Next/Prev --- --- --- --- ---
$bd_options["theme_styling"]["woohoo_des_blocks_widgets"][] = array(
	"name" 		=> "Load more & Next/Prev",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks_widgets"][] = array(
	"name" 		=> "In Blocks boxes & Widget boxes",
	"type"  	=> "msginfo",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks_widgets"][] = array(
	"name" 		=> "Load more",
	"type"  	=> "subTT",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks_widgets"][] = array(
	"name" 		=> "Background color",
	"id"    	=> "woohoo_blocks_lm_bc",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks_widgets"][] = array(
	"name" 		=> "Text color",
	"id"    	=> "woohoo_blocks_lm_tc",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);

## Block Next/Prev --- --- --- --- ---
$bd_options["theme_styling"]["woohoo_des_blocks_widgets"][] = array(
	"name" 		=> "Next/Prev",
	"type"  	=> "subTT",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks_widgets"][] = array(
	"name" 		=> "Background color",
	"id"    	=> "woohoo_blocks_nv_bc",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_blocks_widgets"][] = array(
	"name" 		=> "Arrow color",
	"id"    	=> "woohoo_blocks_nv_tc",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);

## Post templates --- --- --- --- ---
$bd_options["theme_styling"]["woohoo_des_post_template"][] = array(
	"name" 		=> "Post Template",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_post_template"][] = array(
	"name" 		=> "Main Content Background",
	"id"    	=> "woohoo_post_template1_mc_b",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_post_template"][] = array(
	"name" 		=> "Main Content Text Color",
	"id"    	=> "woohoo_post_template1_mc_tc",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_post_template"][] = array(
	"name" 		=> "Main Content Links Color",
	"id"    	=> "woohoo_post_template1_mc_lc",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);
$bd_options["theme_styling"]["woohoo_des_post_template"][] = array(
	"name" 		=> "Main Content Links Hover Color",
	"id"    	=> "woohoo_post_template1_mc_lhc",
	"type"  	=> "color",
	"class" 	=> "fadeToggle"
);