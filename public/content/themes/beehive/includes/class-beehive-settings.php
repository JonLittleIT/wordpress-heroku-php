<?php
/**
 * Class Beehive Options
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
 * Beehive_Settings class.
 *
 * @since 1.0.0
 */
class Beehive_Settings {

	/**
	 * The class constructor
	 *
	 * @access public
	 */
	public function __construct() {
		// Load redux options.
		$this->load_options();
		// Load metaboxes.
		$this->load_metaboxes();
	}

	/**
	 * Get the option
	 * synced with the meta option
	 *
	 * @access public
	 * @param array $args arguments.
	 * @return mixed
	 * @since 1.0.0
	 */
	public function get( $args = array() ) {

		// Default arguments.
		$defaults = array(
			'key'     => null,         // Option key.
			'nested'  => '',           // Provide nested array key to get the value. For example 'url'.
			'meta'    => '0',          // Whether or not check for page meta.
			'options' => '1',          // Whether or not check for global theme option.
			'post_id' => null,         // Post ID.
			'default' => null,         // Default value to return if nothing found.
		);

		// Merge arguments.
		$settings = wp_parse_args( $args, $defaults );

		// return early if option is empty.
		if ( empty( $settings['key'] ) ) {
			return;
		}

		// Look for the post meta option.
		if ( ! empty( $settings['meta'] ) ) {
			$meta_value = $this->get_meta_option( $settings['key'], $settings['post_id'] );
			if ( '0' === $meta_value ) {
				return;
			} else {
				$meta_value = $meta_value;
			}
		}

		// Get the value to return.
		if ( isset( $meta_value ) && $meta_value ) {
			$value = $meta_value;
		} elseif ( ! empty( $settings['options'] ) ) {
			$value = $this->get_theme_option( $settings['key'], $settings['nested'], $settings['default'] );
		} else {
			$value = $settings['default'];
		}

		// Return value.
		return $value;

	}

	/**
	 * Get the post meta option
	 *
	 * @access public
	 * @param string $meta_key  Meta key of the option.
	 * @param int    $post_id   id of the post.
	 * @return mixed
	 * @since 1.0.0
	 */
	public function get_meta_option( $meta_key = null, $post_id = null ) {

		// return early if meta is empty.
		if ( empty( $meta_key ) ) {
			return;
		}

		// Set the ID to get meta option value.
		if ( is_null( $post_id ) ) {

			// set ID null.
			$id = null;

			// ID for blog page.
			if ( ! in_the_loop() && is_home() && get_option( 'page_for_posts' ) ) {
				$id = get_option( 'page_for_posts' );
			}

			// ID for singular post.
			if ( ( is_singular() || in_the_loop() ) ) {
				$id = get_the_ID();
			}

			// ID for BP pages.
			if ( function_exists( 'bp_is_active' ) && ( bp_is_directory() || bp_is_register_page() || bp_is_activation_page() ) ) {
				$id = get_option( 'bp-pages' )[ bp_current_component() ];
			}
		} else {
			$id = $post_id;
		}

		// Get the meta value.
		$value = get_post_meta( $id, beehive()->get_meta_prefix() . $meta_key, true );

		// Return value.
		return $value;

	}

	/**
	 * Get the global theme option
	 *
	 * @access public
	 * @param string $key     option key.
	 * @param string $nested  nested key.
	 * @param mixed  $default default value.
	 * @return mixed
	 * @since 1.0.0
	 */
	public function get_theme_option( $key = null, $nested = '', $default = false ) {

		// return early if $option is empty.
		if ( empty( $key ) ) {
			return;
		}

		// Get option values.
		$options = get_option( Beehive::get_option_name() );

		// Get THE option value.
		if ( ! empty( $nested ) && is_string( $nested ) ) {
			if ( isset( $options[ $key ][ $nested ] ) && '' !== $options[ $key ][ $nested ] ) {
				$value = $options[ $key ][ $nested ];
			} else {
				$value = $default;
			}
		} else {
			if ( isset( $options[ $key ] ) && '' !== $options[ $key ] ) {
				$value = $options[ $key ];
			} else {
				$value = $default;
			}
		}

		// Retrun value.
		return $value;

	}

	/**
	 * Load redux options
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function load_options() {
		require_once BEEHIVE_INC . '/theme-options.php';
	}

	/**
	 * Load metaboxes
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function load_metaboxes() {
		if ( is_admin() ) {
			require_once BEEHIVE_INC . '/theme-metaboxes.php';
		}
	}
}
