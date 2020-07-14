<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly


$categories = get_categories( 'hide_empty=0&orderby=name' );
$wp_cats = array();
$wp_cate = array();

foreach ($categories as $category_list ) {
    $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}

/*  -----------------------------------------------------------------------------
    All Functions
 */
require_once (get_template_directory().'/framework/admin/functions/post_side_bd.php' ); // post_side_bd
require_once (get_template_directory().'/framework/admin/functions/post_layouts_bd.php' ); // post_layouts_bd
require_once (get_template_directory().'/framework/admin/functions/pattrens_bg.php' ); // pattrens_bg
require_once (get_template_directory().'/framework/admin/functions/theme_colors.php' ); // theme_colors
require_once (get_template_directory().'/framework/admin/functions/bgop.php' ); // bgop
require_once (get_template_directory().'/framework/admin/functions/tybo.php' ); // tybo
require_once (get_template_directory().'/framework/admin/functions/sellist.php' ); // sellist
require_once (get_template_directory().'/framework/admin/functions/color.php' ); // color
require_once (get_template_directory().'/framework/admin/functions/images.php' ); // images
require_once (get_template_directory().'/framework/admin/functions/tags_input.php' ); // tags_input
require_once (get_template_directory().'/framework/admin/functions/cats_input.php' ); // cats_input
require_once (get_template_directory().'/framework/admin/functions/radio_input.php' ); // radio_input
require_once (get_template_directory().'/framework/admin/functions/select.php' ); // select
require_once (get_template_directory().'/framework/admin/functions/upload_input.php' ); // upload_input
require_once (get_template_directory().'/framework/admin/functions/ui_slider.php' ); // ui_slider
require_once (get_template_directory().'/framework/admin/functions/textarea.php' ); // textarea
require_once (get_template_directory().'/framework/admin/functions/subtitle.php' ); // subtitle
require_once (get_template_directory().'/framework/admin/functions/subtitleTwo.php' ); // subtitleTwo
require_once (get_template_directory().'/framework/admin/functions/msg_info.php' ); // msg_info
require_once (get_template_directory().'/framework/admin/functions/checkbox_input.php' ); // checkbox_input
require_once (get_template_directory().'/framework/admin/functions/txt.php' ); // txt
require_once (get_template_directory().'/framework/admin/functions/text_input.php' ); // text_input
require_once (get_template_directory().'/framework/admin/functions/blog_styles.php' ); // blog_styles_bd
require_once (get_template_directory().'/framework/admin/functions/column.php' ); // column
require_once (get_template_directory().'/framework/admin/functions/blocks.php' ); // blocks
require_once (get_template_directory().'/framework/admin/functions/translations.php' ); // translations
require_once (get_template_directory().'/framework/admin/functions/web-notification.php' ); // web notification

function woohoo_get_admin_tab( $input, $head = true )
{

    switch( $input['type'] )
    {

        case"upload":
	        woohoo_upload_input($input,$head);
            break;

        case"text":
	        woohoo_text_input($input,$head);
            break;

        case"color":
	        woohoo_color($input,$head);
            break;

        case"tags":
	        woohoo_tags_input($input,$head);
            break;

	    case"cats":
		    woohoo_cats_input($input,$head);
            break;

        case"textarea":
	        woohoo_textarea($input,$head);
            break;

        case"checkbox":
	        woohoo_checkbox_input($input,$head);
            break;

        case"radio":
	        woohoo_radio_input($input,$head);
            break;

        case"select":
	        woohoo_select($input,$head);
            break;

        case"ui_slider":
	        woohoo_ui_slider($input,$head);
            break;

        case"txt":
	        woohoo_txt($input,$head);
            break;

        case"subtitle":
	        woohoo_subtitle($input,$head);
            break;

        case"subTT":
	        woohoo_subtitleTwo($input,$head);
            break;

        case"msginfo":
	        woohoo_msg_info( $input, $head );
            break;

        case"images":
	        woohoo_images($input,$head);
            break;

        case"sellist":
	        woohoo_sellist($input,$head);
            break;

        case"bgop":
	        woohoo_bgop($input,$head);
            break;

        case"tybo":
	        woohoo_tybo($input,$head);
            break;

        case"theme_colors":
	        woohoo_theme_colors($input,$head);
            break;

        case"pattrens_bg":
	        woohoo_pattrens_bg($input,$head);
            break;

        case"post_layouts":
	        woohoo_post_layouts_bd( $input, $head );
            break;

        case"post_sidebars":
	        woohoo_post_side_bd( $input, $head );
            break;

        case"blog_styles":
	        woohoo_blog_styles_bd( $input, $head );
            break;

        case"column":
	        woohoo_column_bd( $input, $head );
            break;

	    case"cat_block":
		    woohoo_cat_blocks( $input, $head );
		    break;

	    case"trans":
		    woohoo_trans( $input, $head );
		    break;

	    case"web_notification":
		    woohoo_get_web_notification( $input, $head );
		    break;
    }
}