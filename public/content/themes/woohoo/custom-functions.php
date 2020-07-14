<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

/**
 * Custom Functions PHP.
 * You can add here any custom php code.
 * ----------------------------------------------------------------------------- */
if( ! function_exists( 'woohoo_cu' ) ) {
	function woohoo_cu(){

	}
	add_action( 'after_setup_theme', 'woohoo_cu' );
}
