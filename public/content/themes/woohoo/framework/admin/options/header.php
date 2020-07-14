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

$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Topbar Options",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Topbar",
	"id"    	=> "bdaia_topbar",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Disable Current Time",
	"id"    	=> "bdaia_current_time",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Current Time Format",
	"id"    	=> "bdaia_ct_format",
	"type"  	=> "text",
	"exp"  	    => 'Change date format click <a href="http://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">here</a> to see how to change it.',
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Left Content",
	"id"    	=> "bdaia_tb_left_content",
	"type"  	=> "sellist",
	"options"   => array(
		""           => "- Select an item -" ,
		"menu"       => "Menu" ,
		"social"     => "Social links",
		"custom"     => "Custom Content",
		"trending"   => "Trending now"
	),
	"js"		=>
		'<script type="text/javascript">
            jQuery(document).ready(function() {
               	var bdaia_tb_lc_js_selected = jQuery( "select[name=\'bdaia_tb_left_content\'] option:selected" ).val();
               	var bdaia_tb_lc_js_class    = jQuery( ".bdaia_tb_lc_class" );

			    if( bdaia_tb_lc_js_selected == "custom" ) {
			        bdaia_tb_lc_js_class.fadeIn().removeClass("hidden");
			    }
			    jQuery( "select[name=\'bdaia_tb_left_content\']" ).change(function() {
			        var e = jQuery( "select[name=\'bdaia_tb_left_content\'] option:selected" ).val();
			        if( e == "custom" ) {
			            bdaia_tb_lc_js_class.fadeIn().removeClass( "hidden" );
			        }
			        if( e == "menu" || e == "social" || e == "" || e== "trending" ) {
			            bdaia_tb_lc_js_class.hide().addClass( "hidden" );
			        }
			    });
            });
        </script>',
	"class"     => "fadeToggle"
);
// Custom
$bdaia_tb_lc_class = ( woohoo_get_option( 'bdaia_tb_left_content' ) != 'custom' ) ? 'hidden' : '';
$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Enter a text or HTML markup to display in this area.",
	"id"		=> "bdaia_tb_lc_custom",
	"type"  	=> "textarea",
	"class" 	=> $bdaia_tb_lc_class . " bdaia_tb_lc_class fadeToggle ",
);

$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Right Content",
	"id"    	=> "bdaia_tb_right_content",
	"type"  	=> "sellist",
	"options"   => array(
		""           => "- Select an item -" ,
		"menu"       => "Menu" ,
		"social"     => "Social links",
		"custom"     => "Custom Content",
		"trending"   => "Trending now"
	),
	"js"		=>
		'<script type="text/javascript">
            jQuery(document).ready(function() {
               	var bdaia_tb_rc_js_selected = jQuery( "select[name=\'bdaia_tb_right_content\'] option:selected" ).val();
               	var bdaia_tb_rc_js_class    = jQuery( ".bdaia_tb_rc_class" );

			    if( bdaia_tb_rc_js_selected == "custom" ) {
			        bdaia_tb_rc_js_class.fadeIn( "fast" ).removeClass("hidden");
			    }
			    jQuery( "select[name=\'bdaia_tb_right_content\']" ).change(function() {
			        var e = jQuery( "select[name=\'bdaia_tb_right_content\'] option:selected" ).val();
			        if( e == "custom" ) {
			            bdaia_tb_rc_js_class.fadeIn( "fast" ).removeClass( "hidden" );
			        }
			        if( e == "menu" || e == "social" || e == "" || e== "trending" ) {
			            bdaia_tb_rc_js_class.hide().addClass( "hidden" );
			        }
			    });
            });
        </script>',
	"class"     => "fadeToggle"
);
// Custom
$bdaia_tb_rc_class = ( woohoo_get_option( 'bdaia_tb_right_content' ) != 'custom' ) ? 'hidden' : '';
$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Enter the text that displays/HTML markup can be used.",
	"id"		=> "bdaia_tb_rc_custom",
	"type"  	=> "textarea",
	"class" 	=> $bdaia_tb_rc_class . " bdaia_tb_rc_class fadeToggle ",
);
// Trending
$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Trending options",
	"type"  	=> "subTT",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Title",
	"id"  	    => "bdaia_t_title",
	"type"  	=> "text",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Limit post number",
	"id"    	=> "bdaia_t_nop",
	"type"  	=> "ui_slider",
	"unit" 		=> "(post)",
	"max" 		=> 100,
	"min" 		=> 0,
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Excerpt length",
	"id"  	    => "woohoo_trending_news_excerpt_length",
	"type"  	=> "ui_slider",
	"max" 		=> 1000,
	"min" 		=> 0,
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Area Width.",
	"id"  	    => "woohoo_trending_news_area_width",
	"type"  	=> "ui_slider",
	"unit" 		=> "(px) <em style='font-size: 10px'>Default 360px</em>",
	"max" 		=> 1240,
	"min" 		=> 0,
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Sort Order",
	"id"  	    => "bdaia_t_so",
	"type"  	=> "sellist",
	"class"     => "fadeToggle",
	"options"   => array(
		""                      => "- Latest -",
		"popular"               => "Popular (all time)",
		"alphabetical_order"    => "Alphabetical A -&gt; Z",
		"review_high"           => "Highest rated (reviews)",
		"comment_count"         => "Most Commented",
		"random_posts"          => "Random Posts",
		"random_today"          => "Random posts Today",
		"random_7_day"          => "Random posts from last 7 Day"
	),
);
$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Category Filter",
	"id"		=> "bdaia_t_cat",
	"type"  	=> "select",
	"class"     => "fadeToggle",
	"list"		=> "cats"
);
$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Multiple categories filter",
	"id"  	    => "bdaia_t_cat_uids",
	"type"  	=> "cats",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Filter by tag slug",
	"id"  	    => "bdaia_t_tag_slug",
	"type"  	=> "tags",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_topbar_options"][] = array(
	"name" 		=> "Multiple Posts filter",
	"id"  	    => "bdaia_t_mposts",
	"type"  	=> "text",
	"exp"       => "Filter multiple posts by ID( ex: 41, 352 ).",
	"class"     => "fadeToggle"
);

/**
 * Logo options
 * ----------------------------------------------------------------------------- *
 */
$bd_options["header_options"]["logo_options"][] = array(
    "name" 		=> "Logo options",
    "type"  	=> "subtitle",
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["logo_options"][] = array(
	"name" 		=> "Logo Center",
	"id"    	=> "bdaia_logo_center",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["logo_options"][] = array(
    "name" 		=> "What kind of logo?",
    "id" 		=> "logo_displays",
    "type"  	=> "radio",
    "options"   => array(
        "logo_title"       => "Display Site Title" ,
        "logo_image"       => "Custom Image" ,
    ),
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["logo_options"][] = array(
    "name" 		=> "Upload Logo",
    "id"    	=> "logo_upload",
    "type"  	=> "upload",
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["logo_options"][] = array(
    "name" 		=> "Logo (Retina Version @2x)",
    "id"    	=> "logo_retina",
    "exp"		=> "Please choose an image file for the retina version of the logo. It should be 2x the size of main logo.",
    "type"  	=> "upload",
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["logo_options"][] = array(
    "name" 		=> "Standard Logo Width for Retina Logo",
    "id"    	=> "retina_logo_width",
    "exp"       =>  "If retina logo is uploaded, please enter the standard logo (1x) version width, do not enter the retina logo width.",
    "type"  	=> "ui_slider",
    "unit" 		=> "(pixels)",
    "max" 		=> 1000,
    "min" 		=> 0,
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["logo_options"][] = array(
    "name" 		=> "logo Top Margin",
    "id"    	=> "margin_logo_top",
    "type"  	=> "ui_slider",
    "unit" 		=> "(in pixels)",
    "max" 		=> 300,
    "min" 		=> 0,
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["logo_options"][] = array(
    "name" 		=> "logo Right Margin",
    "id"    	=> "margin_logo_right",
    "type"  	=> "ui_slider",
    "unit" 		=> "(in pixels)",
    "max" 		=> 300,
    "min" 		=> 0,
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["logo_options"][] = array(
    "name" 		=> "logo Bottom Margin",
    "id"    	=> "margin_logo_bottom",
    "type"  	=> "ui_slider",
    "unit" 		=> "(in pixels)",
    "max" 		=> 300,
    "min" 		=> 0,
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["logo_options"][] = array(
    "name" 		=> "logo Left Margin",
    "id"    	=> "margin_logo_left",
    "type"  	=> "ui_slider",
    "unit" 		=> "(in pixels)",
    "max" 		=> 300,
    "min" 		=> 0,
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["logo_options"][] = array(
    "name" 		=> "Logo Typography",
    "id"    	=> "logo_typography",
    "type"  	=> "tybo",
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["logo_options"][] = array(
	"name" 		=> "Logo Text color",
	"id"    	=> "logo_text_color",
	"type"  	=> "color",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["logo_options"][] = array(
    "name" 		=> "Display tagline in logo display site title ?",
    "id"    	=> "logo_tagline",
    "type"  	=> "checkbox",
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["logo_options"][] = array(
    "name" 		=> "Tagline Text color",
    "id"    	=> "tagline_color",
    "type"  	=> "color",
    "class"     => "fadeToggle"
);

/**
 * Breaking News options
 * ----------------------------------------------------------------------------- *
 */
$bd_options["header_options"]["bdaia_breaking_news"][] = array(
	"name" 		=> "Breaking News options",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_breaking_news"][] = array(
	"name" 		=> "Breaking News",
	"id"    	=> "bdaia_head_bn",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_breaking_news"][] = array(
	"name" 		=> "Show in Homepage Only",
	"id"    	=> "bdaia_head_bn_home",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_breaking_news"][] = array(
	"name" 		=> "Breaking News Position",
	"id" 		=> "bdaia_head_bn_position",
	"type"  	=> "radio",
	"options"   => array(
		"above_content"         => "Above Content",
		"below_header"          => "Below Header",
		"below_feature_posts"   => "Below Featured Posts"
	),
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_breaking_news"][] = array(
	"name" 		=> "Title",
	"id"  	    => "bdaia_head_bn_title",
	"type"  	=> "text",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_breaking_news"][] = array(
	"name" 		=> "Title Backgorund color",
	"id"    	=> "bdaia_head_bn_title_bg",
	"type"  	=> "color",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_breaking_news"][] = array(
	"name" 		=> "Limit post number",
	"id"    	=> "bdaia_head_bn_nop",
	"type"  	=> "ui_slider",
	"unit" 		=> "(post)",
	"max" 		=> 100,
	"min" 		=> 0,
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_breaking_news"][] = array(
	"name" 		=> "Sort Order",
	"id"  	    => "bdaia_head_bn_so",
	"type"  	=> "sellist",
	"class"     => "fadeToggle",
	"options"   => array(
		""                      => "- Latest -",
		"popular"               => "Popular (all time)",
		"alphabetical_order"    => "Alphabetical A -&gt; Z",
		"review_high"           => "Highest rated (reviews)",
		"comment_count"         => "Most Commented",
		"random_posts"          => "Random Posts",
		"random_today"          => "Random posts Today",
		"random_7_day"          => "Random posts from last 7 Day"
	),
);
$bd_options["header_options"]["bdaia_breaking_news"][] = array(
	"name" 		=> "Category Filter",
	"id"		=> "bdaia_head_bn_cat",
	"type"  	=> "select",
	"class"     => "fadeToggle",
	"list"		=> "cats"
);
$bd_options["header_options"]["bdaia_breaking_news"][] = array(
	"name" 		=> "Multiple categories filter",
	"id"  	    => "bdaia_head_bn_cat_uids",
	"type"  	=> "cats",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_breaking_news"][] = array(
	"name" 		=> "Filter by tag slug",
	"id"  	    => "bdaia_head_bn_tag_slug",
	"type"  	=> "tags",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["bdaia_breaking_news"][] = array(
	"name" 		=> "Multiple Posts filter",
	"id"  	    => "bdaia_head_bn_mposts",
	"type"  	=> "text",
	"exp"       => "Filter multiple posts by ID( ex: 41, 352 ).",
	"class"     => "fadeToggle"
);

/**
 * Main Nav options
 * ----------------------------------------------------------------------------- *
 */
$bd_options["header_options"]["main_nav_options"][] = array(
    "name" 		=> "Main Navigation options",
    "type"  	=> "subtitle",
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["main_nav_options"][] = array(
	"name" 		=> "Main Navigation Position",
	"id" 		=> "bdaia_mn_position",
	"type"  	=> "radio",
	"options"   => array(
		"above_header"       => "Above Header" ,
		"below_header"       => "Below Header" ,
		"hibryd_menu"        => "Hibryd menu on right with logo" ,
	),
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["main_nav_options"][] = array(
	"name" 		=> "Main Navigation Skin",
	"id" 		=> "bdaia_mn_skin",
	"type"  	=> "radio",
	"options"   => array(
		"dark"          => "Dark" ,
		"light"         => "Light" ,
	),
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["main_nav_options"][] = array(
	"name" 		=> "Drop Down Skin",
	"id" 		=> "bdaia_mn_dd_skin",
	"type"  	=> "radio",
	"options"   => array(
		"dark"          => "Dark" ,
		"light"         => "Light" ,
	),
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["main_nav_options"][] = array(
	"name" 		=> "Center Item Navigation Menu",
	"id"    	=> "bd_center_nav_menu",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);

$bd_options["header_options"]["main_nav_options"][] = array(
    "name" 		=> "Stick The Navigation menu",
    "id"    	=> "header_fix",
    "type"  	=> "checkbox",
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["main_nav_options"][] = array(
	"name" 		=> "Disable Search",
	"id"    	=> "bdaia_mn_search",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["main_nav_options"][] = array(
	"name" 		=> "Login in popup",
	"id"    	=> "bdaia_login_icon",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["main_nav_options"][] = array(
	"name" 		=> "Shop Cart",
	"id"    	=> "bdaia_shop_cart",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["main_nav_options"][] = array(
	"name" 		=> "Random Article",
	"id"    	=> "bdaia_random_article",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["main_nav_options"][] = array(
	"name" 		=> "Logo in the sticky Navigation menu",
	"id"    	=> "bdaia_nav_logo",
	"type"  	=> "upload",
	"class"     => "fadeToggle"
);

/* New Article */
$bd_options["header_options"]["main_nav_options"][] = array(
	"name" 		=> "Navigation New Articles",
	"type"  	=> "subTT",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["main_nav_options"][] = array(
	"name" 		=> "Navigation New Articles",
	"id"    	=> "bdaia_new_articles",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["main_nav_options"][] = array(
	"name" 		=> "Disable In sticky Navigation menu",
	"id"    	=> "bdaia_new_articles_in_sticky_nav",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["main_nav_options"][] = array(
	"name" 		=> "Navigation New Articles Limit post number",
	"id"    	=> "bdaia_new_articles_npost",
	"type"  	=> "sellist",
	"options"   => array(
		"3"     => "3" ,
		"6"     => "6" ,
		"9"     => "9",
		"12"    => "12",
		"15"    => "15",
		"18"    => "18",
		"21"    => "21"
	),
	"class"     => "fadeToggle"
);


/**
 * Mobile Menu options
 * ----------------------------------------------------------------------------- *
 */
$bd_options["header_options"]["mobile"][] = array(
	"name" 		=> "Mobile Menu options",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["mobile"][] = array(
	"name" 		=> "Disable Mobile Menu",
	"id"    	=> "dis_mobile_menu",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["mobile"][] = array(
	"name" 		=> "Enable Top menu",
	"id"    	=> "mobile_topmenu",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["mobile"][] = array(
	"name" 		=> "Search",
	"id"    	=> "mobile_search",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["header_options"]["mobile"][] = array(
	"name" 		=> "Social links",
	"id"    	=> "mobile_social",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);

/**
 * Favicon Icons
 * ----------------------------------------------------------------------------- *
 */
$bd_options["header_options"]["bd_favicon"][] = array(
    "name" 		=> "Favicon Icons",
    "type"  	=> "subtitle",
    "class"     => "fadeToggle"

);
$bd_options["header_options"]["bd_favicon"][] = array(
    "name" 		=> "Custom Favicon",
    "id"    	=> "favicon",
    "exp"		=> "You can put url of an ico image that will represent your website favicon (16px x 16px)",
    "type"  	=> "upload",
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["bd_favicon"][] = array(
    "name" 		=> "Apple iPhone Icon Upload",
    "id"    	=> "iphoneIconUpload",
    "exp"		=> "Icon for Apple iPhone (57px x 57px)",
    "type"  	=> "upload",
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["bd_favicon"][] = array(
    "name" 		=> "Apple iPhone Retina Icon Upload",
    "id"    	=> "iphoneIconRetinaUpload",
    "exp"		=> "Icon for Apple iPhone Retina Version (114px x 114px)",
    "type"  	=> "upload",
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["bd_favicon"][] = array(
    "name" 		=> "Apple iPad Icon Upload",
    "id"    	=> "ipadIconUpload",
    "exp"		=> "Icon for Apple iPhone (72px x 72px)",
    "type"  	=> "upload",
    "class"     => "fadeToggle"
);
$bd_options["header_options"]["bd_favicon"][] = array(
    "name" 		=> "Apple iPad Retina Icon Upload",
    "id"    	=> "ipadIconRetinaUpload",
    "exp"		=> "Icon for Apple iPad Retina Version (144px x 144px)",
    "type"  	=> "upload",
    "class"     => "fadeToggle"
);