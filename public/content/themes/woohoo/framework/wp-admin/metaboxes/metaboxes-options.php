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

// include the class in your theme or plugin
if ( file_exists( get_template_directory().'/framework/wp-admin/wpalchemy/MetaBox.php' ) ) {
    require_once( get_template_directory().'/framework/wp-admin/wpalchemy/MetaBox.php' );
}

// include css to help style our custom meta boxes
add_action( 'init', 'metabox_styles_bd' );
function metabox_styles_bd() {
    if ( is_admin() ) {
        wp_enqueue_style( 'wpalchemy-metabox', get_stylesheet_directory_uri() . '/framework/wp-admin/metaboxes/meta.css' );
    }
}

// Load template
$temp_bd = get_template_directory() . '/framework/wp-admin/metaboxes/';

// featured video
$meta_video_bd = new WPAlchemy_MetaBox(array(
	'id'            => 'bdaia_meta_soundcloud_embed',
	'title'         => 'Featured EMBED Code',
	'types'         => array('post'),
	'priority'      => 'low',
	'context'       => 'side',
	'template'      => $temp_bd . 'bdaia_meta_soundcloud_embed.php',
));

// featured video
$meta_video_bd = new WPAlchemy_MetaBox(array(
    'id'            => 'post_video_bd',
    'title'         => 'Featured Video',
    'types'         => array('post'),
    'priority'      => 'low',
    'context'       => 'side',
    'template'      => $temp_bd . 'video_meta_bd.php',
));

//Page options
$meta_page_options_bd = new WPAlchemy_MetaBox(array(
	'id'            => 'meta_page_options_bd',
	'title'         => 'Page Options',
	'types'         => array('page'),
	'priority'      => 'high',
	//'view'          => WPALCHEMY_VIEW_START_CLOSED, // WPALCHEMY_VIEW_START_CLOSED WPALCHEMY_VIEW_ALWAYS_OPENED
	'template'      => $temp_bd . 'page_options.php',
));


//post options
$meta_post_options_bd = new WPAlchemy_MetaBox(array(
    'id'            => 'meta_post_options_bd',
    'title'         => 'Post Options',
    'types'         => array('post'),
    'priority'      => 'high',
    'template'      => $temp_bd . 'post_options.php',
));


//Post Review
$meta_post_review_bd = new WPAlchemy_MetaBox(array(
    'id'            => 'meta_post_review_bd',
    'title'         => 'Post Review',
    'types'         => array('post'),
    'priority'      => 'high',
    'mode'          => WPALCHEMY_MODE_EXTRACT,
    //'view'          => WPALCHEMY_VIEW_START_CLOSED, // WPALCHEMY_VIEW_START_CLOSED WPALCHEMY_VIEW_ALWAYS_OPENED
    'template'      => $temp_bd . 'post_review.php',
));

$meta_page_options_bd = new WPAlchemy_MetaBox(array(
    'id'            => 'custom_styles_bd',
    'title'         => 'Custom Style',
    'types'         => array('page','post'),
    'priority'      => 'high',
    //'view'          => WPALCHEMY_VIEW_START_CLOSED, // WPALCHEMY_VIEW_START_CLOSED WPALCHEMY_VIEW_ALWAYS_OPENED
    'template'      => $temp_bd . 'custom_styles.php',
));

//Page options
$meta_page_options_bd = new WPAlchemy_MetaBox(array(
	'id'            => 'meta_page_custom_bd',
	'title'         => 'More options',
	'types'         => array('page'),
	'priority'      => 'low',
	//'view'          => WPALCHEMY_VIEW_START_CLOSED, // WPALCHEMY_VIEW_START_CLOSED WPALCHEMY_VIEW_ALWAYS_OPENED
	'template'      => $temp_bd . 'page_custom_options.php',
));