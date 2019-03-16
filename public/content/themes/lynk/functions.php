<?php
/**
 *
 * This theme uses PSR-4 and OOP logic instead of procedural coding
 * Every function, hook and action is properly divided and organized inside related folders and files
 * Use the file `config/Custom/Custom.php` to write your custom functions
 *
 *
 */

!defined( 'JVBPD_IW_SKIP_ADDONS' ) && define( 'JVBPD_IW_SKIP_ADDONS', true );

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

if ( class_exists( 'Awps\\Init' ) ) :
	Awps\Init::register_services();
endif;


if ( !function_exists( 'bp_dtheme_enqueue_styles' ) ) :
    function bp_dtheme_enqueue_styles() {}
endif;