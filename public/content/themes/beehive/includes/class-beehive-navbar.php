<?php
/**
 * Renders navbar along with optiions
 *
 * @author     thunder-team
 * @copyright  (c) Copyright by Thunder Team
 * @link       https://themeforest.net/user/thunder-team/
 * @package    WordPress
 * @subpackage beehive
 * @since      1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * Beehive_Navbar class.
 *
 * @since 1.0.0
 */
class Beehive_Navbar {

	/**
	 * Navbar
	 *
	 * @access public
	 * @var string
	 */
	public $navbar = 'default';

	/**
	 * Show Navbar
	 *
	 * @access public
	 * @var bool
	 */
	public $show = true;

	/**
	 * The class constructor
	 *
	 * @access public
	 */
	public function __construct() {

		// Display the post header.
		add_action( 'wp_head', array( $this, 'post_navbar_display' ), 99 );
		// Render Navbar.
		add_action( 'wp_head', array( $this, 'render' ), 110 );

	}

	/**
	 * Set the navbar
	 *
	 * @access public
	 * @param string $navbar navbar name.
	 * @return void
	 * @since 1.0.0
	 */
	public function set( $navbar ) {
		$this->navbar = $navbar;
	}

	/**
	 * Get the navbar
	 *
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function get() {
		return $this->navbar;
	}

	/**
	 * Show or hide
	 *
	 * @access public
	 * @param bool $show whether or not show the navbar.
	 * @return void
	 * @since 1.0.0
	 */
	public function show( $show ) {
		$this->show = $show;
	}

	/**
	 * Render Navbar
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function render() {

		// Return early if $show is not true.
		if ( true !== $this->show ) {
			return;
		}

		// Hook into the template.
		add_action( 'beehive_before_page', array( $this, 'get_template' ) );

		// Add body class.
		add_filter( 'body_class', array( $this, 'add_body_classes' ) );
	}

	/**
	 * Get navbar template
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function get_template() {

		// Get the template.
		if ( $this->get() === 'social' ) {
			get_template_part( 'template-parts/social', 'header' );
		} else {
			get_template_part( 'template-parts/default', 'header' );
		}
	}

	/**
	 * Show/hide navbar
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function post_navbar_display() {
		if ( beehive()->options->get( 'key=show-header&meta=1&options=0' ) === 'hide' ) {
			$this->show( false );
		} elseif ( beehive()->options->get( 'key=show-header&meta=1&options=0' ) === 'show' ) {
			$this->show( true );
		}
	}

	/**
	 * Add body class
	 *
	 * @param array $classes array of body class.
	 * @return array
	 * @since 1.0.0
	 */
	public function add_body_classes( $classes ) {

		// Push classes.
		if ( 'default' === $this->navbar && beehive()->options->get( 'key=desktop-slidenav&meta=1&options=0' ) ) {
			array_push( $classes, 'desktop-slidenav' );
		}

		// Return classes.
		return $classes;
	}

}
