<?php

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Besa 1.0
 */
define( 'BESA_THEME_VERSION', '1.0' );

/**
 * ------------------------------------------------------------------------------------------------
 * Define constants.
 * ------------------------------------------------------------------------------------------------
 */
define( 'BESA_THEME_DIR', 		get_template_directory_uri() );
define( 'BESA_THEMEROOT', 		get_template_directory() );
define( 'BESA_IMAGES', 			BESA_THEME_DIR . '/images' );
define( 'BESA_SCRIPTS', 		BESA_THEME_DIR . '/js' );

define( 'BESA_SCRIPTS_SKINS', 	BESA_SCRIPTS . '/skins' );
define( 'BESA_STYLES', 			BESA_THEME_DIR . '/css' );
define( 'BESA_STYLES_SKINS', 	BESA_STYLES . '/skins' );

define( 'BESA_INC', 				     'inc' );
define( 'BESA_CLASSES', 			     BESA_INC . '/classes' );
define( 'BESA_VENDORS', 			     BESA_INC . '/vendors' );
define( 'BESA_ELEMENTOR', 		         BESA_THEMEROOT . '/inc/vendors/elementor' );
define( 'BESA_ELEMENTOR_TEMPLATES',     BESA_THEMEROOT . '/elementor_templates' );
define( 'BESA_PAGE_TEMPLATES',          BESA_THEMEROOT . '/page-templates' );
define( 'BESA_WIDGETS', 			     BESA_INC . '/widgets' );

define( 'BESA_ASSETS', 			         BESA_THEME_DIR . '/inc/assets' );
define( 'BESA_ASSETS_IMAGES', 	         BESA_ASSETS    . '/images' );

define( 'BESA_MIN_JS', 	'' );

if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

function besa_tbay_get_config($name, $default = '') {
	global $besa_options;
    if ( isset($besa_options[$name]) ) {
        return $besa_options[$name];
    }
    return $default;
}

function besa_tbay_get_global_config($name, $default = '') {
	$options = get_option( 'besa_tbay_theme_options', array() );
	if ( isset($options[$name]) ) {
        return $options[$name];
    }
    return $default;
}
