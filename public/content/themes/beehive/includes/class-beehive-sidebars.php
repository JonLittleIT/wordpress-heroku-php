<?php
/**
 * Beehive Sidebars
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
 * Beehive_Sidebars class.
 *
 * @since 1.0.0
 */
class Beehive_Sidebars {

	/**
	 * Post sidebar
	 *
	 * @access public
	 * @var string
	 */
	public $sidebar;

	/**
	 * Show sidebar
	 *
	 * @access public
	 * @var bool
	 */
	public $show;

	/**
	 * Sidebar empty
	 *
	 * @access public
	 * @var bool
	 */
	public $active;

	/**
	 * The class constructor
	 *
	 * @access public
	 */
	public function __construct() {

		// Default sidebar.
		$this->sidebar = 'Default Sidebar';
		// Show sidebar.
		$this->show = true;
		// Is sidebar active.
		$this->active = is_active_sidebar( $this->get_sidebar_id( $this->sidebar ) );

		// Register sidebars.
		add_action( 'widgets_init', array( $this, 'init' ) );
		// Add sidebars from option panel.
		add_action( 'after_setup_theme', array( $this, 'new_sidebars' ) );
		// Remove sidebars from option panel.
		add_action( 'redux/options/' . Beehive::get_option_name() . '/validate', array( $this, 'remove_new_sidebar' ) );
	}

	/**
	 * Set the sidebar
	 *
	 * @access public
	 * @param string $name name of the sidebar.
	 * @param bool   $show whether or not display the sidebar.
	 * @return void
	 * @since 1.0.0
	 */
	public function set( $name, $show = true ) {
		if ( ( is_string( $name ) && '' !== $name ) && is_active_sidebar( $this->get_sidebar_id( $name ) ) ) {
			$this->sidebar = $name;
			$this->show    = $show;
			$this->active  = true;
		}
	}

	/**
	 * Set current sidebar
	 *
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function get() {
		if ( ! empty( $this->sidebar ) ) {
			return $this->sidebar;
		}
	}

	/**
	 * Show or hide
	 *
	 * @access public
	 * @param bool $show whether to show the sidebar or not.
	 * @return void
	 * @since 1.0.0
	 */
	public function show( $show ) {
		$this->show = $show;
	}

	/**
	 * Adds sidebars
	 *
	 * @access public
	 * @param array $names names of the sidebar.
	 * @return void
	 * @since 1.0.0
	 */
	public function add( $names ) {

		// return early.
		if ( empty( $names ) ) {
			return;
		}

		// Conver string.
		if ( is_string( $names ) ) {
			$names = array( $names );
		}

		// Return if not array.
		if ( ! is_array( $names ) ) {
			return;
		}

		// Loop through the names.
		foreach ( $names as $name ) {

			// Return if not valid string.
			if ( ! is_string( $name ) || '' === $name ) {
				return;
			}

			// Construct safe name, and id from name.
			$name = sanitize_text_field( TH_Helpers::trim_it( $name ) );
			$id   = TH_Helpers::name_to_id( $name );

			// Get the sidebars.
			$sidebars = $this->get_sidebars();

			// Update sidebars if not exists.
			if ( ! array_key_exists( $id, $sidebars ) ) {
				$sidebars[ $id ] = $name;
				$this->update_sidebars( $sidebars );
			}
		}
	}

	/**
	 * Remove sidebars
	 *
	 * @access public
	 * @param array $names names of the sidebars.
	 * @return void
	 * @since 1.0.0
	 */
	public function remove( $names ) {

		// Convert string.
		if ( is_string( $names ) ) {
			$names = array( $names );
		}

		// Return if not array.
		if ( ! is_array( $names ) ) {
			return;
		}

		// Loop through the names.
		foreach ( $names as $name ) {

			// Trim name.
			$name = sanitize_text_field( TH_helpers::trim_it( $name ) );

			// Get the id.
			$id = $this->get_sidebar_id( $name );

			// Get the sidebars.
			$sidebars = $this->get_sidebars();

			// Unset.
			if ( isset( $sidebars[ $id ] ) ) {
				unset( $sidebars[ $id ] );
			}

			// Update.
			$this->update_sidebars( $sidebars );
		}
	}

	/**
	 * Add new sidebars from settings
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function new_sidebars() {
		if ( beehive()->options->get( 'key=add-sidebars' ) ) {
			$this->add( beehive()->options->get( 'key=add-sidebars' ) );
		}
	}

	/**
	 * Remove new sidebars from settings
	 *
	 * @access public
	 * @param array $data array of sidebars.
	 * @return void
	 * @since 1.0.0
	 */
	public function remove_new_sidebar( $data ) {
		$removed = array_diff( beehive()->options->get( 'key=add-sidebars' ), '' == $data['add-sidebars'] ? array() : $data['add-sidebars'] );
		beehive()->sidebars->remove( $removed );
	}

	/**
	 * Registers sidebars
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function init() {

		// Get the theme sidebars.
		$sidebars = $this->get_sidebars();

		// Return if no sidebar found.
		if ( empty( $sidebars ) ) {
			return;
		}

		// Register the sidebars.
		foreach ( $sidebars as $id => $name ) {
			register_sidebar(
				array(
					'name'          => $name,
					'id'            => $id,
					'description'   => esc_html__( 'Add widgets here.', 'beehive' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget-title">',
					'after_title'   => '</h5>',
				)
			);
		}
	}

	/**
	 * Get a sidebar template
	 *
	 * @access public
	 * @param string $name name of the sidebar.
	 * @return void
	 * @since 1.0.0
	 */
	public function get_template( $name ) {

		// Return early if name is not a string.
		if ( ! is_string( $name ) ) {
			return;
		}

		// id and class.
		$id      = $this->get_sidebar_id( $name );
		$classes = sanitize_title( $name );

		// Sticky sidebar.
		if ( beehive()->options->get( 'key=sticky-sidebar&meta=1&default=1' ) ) {
			$classes = ' sticky-sidebar';
		}

		// Return if sidebar doesn't exists.
		if ( empty( $id ) ) {
			return;
		}

		// Include.
		include locate_template( 'template-parts/sidebar.php' );
	}

	/**
	 * Updates sidebar in option table
	 *
	 * @access private
	 * @param array $sidebars sidebars array.
	 * @return void
	 * @since 1.0.0
	 */
	private function update_sidebars( $sidebars ) {
		update_option( 'beehive_sidebars', $sidebars );
	}

	/**
	 * Get sidebars
	 *
	 * @access private
	 * @return array
	 * @since 1.0.0
	 */
	public function get_sidebars() {
		if ( get_option( 'beehive_sidebars' ) ) {
			return get_option( 'beehive_sidebars' );
		} else {
			return array();
		}
	}

	/**
	 * Get sidebar ID by name
	 *
	 * @access public
	 * @param string $name name of the sidebar.
	 * @return string
	 * @since 1.0.0
	 */
	public function get_sidebar_id( $name ) {

		// Get and return ID.
		if ( ! empty( $name ) && is_string( $name ) ) {
			return array_search( $name, $this->get_sidebars(), true );
		}

		// False.
		return false;
	}

	/**
	 * Get sidebar name by id
	 *
	 * @access public
	 * @param string $id sidebar id.
	 * @return string
	 * @since 1.0.0
	 */
	public function get_sidebar_name( $id ) {

		// Return early.
		if ( empty( $id ) ) {
			return;
		}

		// Get sidebars.
		$sidebars = $this->get_sidebars();

		// Conditionally return name.
		if ( array_key_exists( $id, $sidebars ) ) {
			return $sidebars[ $id ];
		} else {
			return false;
		}

	}

	/**
	 * Set post sidebar
	 *
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function post_sidebar() {
		$id = beehive()->options->get( 'key=page-sidebar&meta=1&options=0' );
		if ( $id && array_key_exists( $id, $this->get_sidebars() ) ) {
			return $this->get_sidebar_name( $id );
		}
	}

	/**
	 * Renders sidebar
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

		if ( ! empty( $this->sidebar ) ) {
			$this->get_template( $this->sidebar );
		}
	}

	/**
	 * Check if a post has a
	 * specific widget
	 *
	 * @access public
	 * @param string $widget name of the widget.
	 * @return bool
	 * @since 1.0.0
	 */
	public function current_post_has_widget( $widget ) {

		// Return early if not valid widget is passed.
		if ( ! is_string( $widget ) || empty( $widget ) ) {
			return false;
		}

		// Get all sidebar.
		$all_sidebars = get_option( 'sidebars_widgets' );
		$post_sidebar = $this->get_sidebar_id( $this->sidebar );

		// Loop through the sidebar widgets and return true if found.
		if ( is_array( $all_sidebars ) && array_key_exists( $post_sidebar, $all_sidebars ) ) {
			if ( is_array( $all_sidebars[ $post_sidebar ] ) ) {
				foreach ( $all_sidebars[ $post_sidebar ] as $sidebar_widget ) {
					if ( strpos( $sidebar_widget, $widget ) !== false ) {
						return true;
					}
				}
			}
		}

		// False.
		return false;
	}
}
