<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function beehive_child_theme_enqueue_styles() {
	wp_enqueue_style( 'beehive-child', get_stylesheet_directory_uri() . '/style.css', array( 'beehive' ) );
}
add_action( 'wp_enqueue_scripts', 'beehive_child_theme_enqueue_styles', 20 );

function beehive_child_theme_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'beehive', $lang );
}
add_action( 'after_setup_theme', 'beehive_child_theme_lang_setup' );
