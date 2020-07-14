<?php
/**
 * Beehive Footer Class
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
 * Beehive_Footer class.
 *
 * @since 1.0.0
 */
class Beehive_Footer {

	/**
	 * Footer
	 *
	 * @access public
	 * @var string
	 */
	public $footer = 'default';

	/**
	 * Show footer
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

		// Display the post footer.
		add_action( 'wp_head', array( $this, 'post_footer_display' ), 99 );
		// Render Footer.
		add_action( 'wp_head', array( $this, 'render' ), 110 );

	}

	/**
	 * Set the footer
	 *
	 * @access public
	 * @param string $footer set the footer.
	 * @return void
	 * @since 1.0.0
	 */
	public function set( $footer ) {
		$this->footer = $footer;
	}

	/**
	 * Get footer
	 *
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function get() {
		return $this->footer;
	}

	/**
	 * Show or hide
	 *
	 * @access public
	 * @param bool $show whether or not show the footer.
	 * @return void
	 * @since 1.0.0
	 */
	public function show( $show ) {
		$this->show = $show;
	}

	/**
	 * Render template
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

		add_action( 'beehive_after_page', array( $this, 'get_template' ) );
	}

	/**
	 * Get footer template
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function get_template() {
		get_template_part( 'template-parts/default', 'footer' );
	}

	/**
	 * Show/hide footer from options
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function post_footer_display() {
		if ( beehive()->options->get( 'key=show-footer&meta=1&options=0' ) === 'hide' ) {
			$this->show( false );
		} elseif ( beehive()->options->get( 'key=show-footer&meta=1&options=0' ) === 'show' ) {
			$this->show( true );
		}
	}

}
