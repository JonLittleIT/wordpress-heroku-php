<?php
/**
 * Beehive functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * Define theme CONSTANTS
 *
 * @since 1.0.0
 */

// Version.
define( 'BEEHIVE_VERSION', '1.0.0' );
// Parent dir path.
define( 'BEEHIVE_ROOT', get_template_directory() );
// Includes dir path.
define( 'BEEHIVE_INC', BEEHIVE_ROOT . '/includes' );
// Functions dir path.
define( 'BEEHIVE_FUNC', BEEHIVE_INC . '/functions' );
// Theme stylesheet dir.
define( 'BEEHIVE_DIR', get_stylesheet_directory() );
// Theme directory URI.
define( 'BEEHIVE_URI', get_template_directory_uri() );

/**
 * Class with some helper methods
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/class-thunder-helpers.php';

/**
 * Main class
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/class-beehive.php';

/**
 * Instantiates the Beehive class.
 * The Class is a singleton
 * Access the Beehive object directly
 *
 * @return object Beehive
 */
function beehive() {
	return Beehive::get_instance();
}

/**
 * Call the function with Beehive class
 *
 * @since 1.0.0
 */
beehive();

/**
 * Add sidebars
 *
 * @since 1.0.0
 */
beehive()->sidebars->add( 'Default Sidebar' );

/**
 * Load required and recommended
 * plugins
 */
if ( is_admin() ) {
	require_once BEEHIVE_INC . '/required-plugins.php';
}

/**
 * Load admin
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/class-beehive-admin.php';

/**
 * Add blog functions
 * Contains all the template related function used in the theme
 *
 * @since 1.0.0
 */
require_once BEEHIVE_FUNC . '/beehive-functions.php';

/**
 * Load sass compiler
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/class-beehive-compile-sass.php';

/**
 * Scripts
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/class-beehive-scripts.php';

/**
 * Load Menu Walker
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/class-beehive-nav-walker.php';

/**
 * Include Menu Icons
 * Creates custom field in
 * appearance menu for icons class
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/menu-icons/menu-icon.php';

/**
 * Include user nav
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/class-beehive-user-nav.php';

/**
 * Load ajax login
 *
 * @since 1.0.0
 */
if ( beehive()->options->get( 'key=ajax-login' ) ) {
	require_once BEEHIVE_INC . '/class-beehive-login.php';
}

/**
 * Include plugins functions
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/plugin-compatibilities/plugins.php';

/**
 * Include importer data
 *
 * @since 1.0.0
 */
if ( class_exists( 'OCDI_Plugin' ) ) {
	require_once BEEHIVE_INC . '/class-beehive-import.php';
}

/**
 * Set content width
 */

global $content_width;
if ( ! isset( $content_width ) ) {
	$content_width = 1140;
}

/**
 * Customizer additions.
 */
require BEEHIVE_INC . '/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require BEEHIVE_INC . '/jetpack.php';
}
