<?php
/**
 * Renders title along with optiions
 *
 * @author     thunder-team
 * @copyright  (c) Copyright by Thunder Team
 * @link       https://themeforest.net/user/thunder-team/
 * @package    WordPress
 * @subpackage beehive
 * @since      1.0.0
 */

/**
 * Beehive_Title_Bar class.
 *
 * @since 1.0.0
 */
class Beehive_Title_Bar {

	/**
	 * Title Bar
	 *
	 * @access public
	 * @var string
	 */
	public $title_bar = 'default';

	/**
	 * Show Title Bar
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

		// Load breadcrumb.
		$this->load_breadcrumb();

		// Display the title bar.
		add_action( 'wp_head', array( $this, 'post_titlebar_display' ), 99 );

		// Render title bar.
		add_action( 'wp_head', array( $this, 'render' ), 110 );

	}

	/**
	 * Set the title_bar
	 *
	 * @access public
	 * @param string $title_bar title bar type.
	 * @return void
	 * @since 1.0.0
	 */
	public function set( $title_bar ) {
		$this->title_bar = $title_bar;
	}

	/**
	 * Get the title_bar
	 *
	 * @access public
	 * @since 1.0.0
	 * @return string
	 */
	public function get() {
		return $this->title_bar;
	}

	/**
	 * Show or hide
	 *
	 * @access public
	 * @param bool $show Whether or not show the titlebar.
	 * @return void
	 * @since 1.0.0
	 */
	public function show( $show ) {
		$this->show = $show;
	}

	/**
	 * Load breadcrumb
	 *
	 * @access private
	 * @since 1.0.0
	 * @return void
	 */
	private function load_breadcrumb() {
		require_once BEEHIVE_INC . '/breadcrumb/class-trail-breadcrumb.php';
		require_once BEEHIVE_INC . '/breadcrumb/class-bp-trail-breadcrumb.php';
		require_once BEEHIVE_INC . '/breadcrumb/class-bbp-trail-breadcrumb.php';
	}

	/**
	 * Get the page title
	 *
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function get_the_title() {

		// Get the title.
		$title = get_the_title();

		// Title for blog loop.
		if ( is_home() ) {
			if ( get_option( 'page_for_posts' ) ) {
				$title = get_the_title( get_option( 'page_for_posts' ) );
			} else {
				$title = get_bloginfo( 'name' );
			}
		}

		// Single title.
		if ( is_single() ) {
			$single_post = get_post_type_object( get_post_type() );
			if ( isset( $single_post->labels->singular_name ) ) {
				$title = implode( ' ', array( $single_post->labels->singular_name, esc_html__( 'detail', 'beehive' ) ) );
			}
		}

		// Title for error page.
		if ( is_404() ) {
			$title = esc_html__( 'Not Found!', 'beehive' );
		}

		// Title for archive.
		if ( is_archive() ) {
			$title = get_the_archive_title();
			if ( is_post_type_archive() ) {
				$title = post_type_archive_title( '', false );
			}
		}

		// Title for search.
		if ( is_search() ) {
			// translators: %s: search query.
			$title = sprintf( esc_html__( 'Search Results for: %s', 'beehive' ), get_search_query() );
		}

		// Return Title.
		if ( isset( $title ) && ! empty( $title ) ) {
			return $title;
		}

		// False.
		return false;
	}

	/**
	 * Get breadcrumb
	 *
	 * @since  1.0.0
	 * @param  array $args Arguments to pass to Breadcrumb_Trail.
	 * @return string
	 */
	public function get_breadcrumb( $args = array() ) {
		// Trail.
		$trail = '';
		// Get seo options.
		$seo_opts = get_option( 'wpseo_internallinks' );
		// Return yoast breadcumb if active or use beehive default breadcumb.
		if ( function_exists( 'yoast_breadcrumb' ) && $seo_opts && true === $seo_opts['breadcrumbs-enable'] ) {
			ob_start();
			yoast_breadcrumb( '<div class="beehive-breadcrumb breadcrumbs">', '</div>' );
			$trail = ob_get_clean();
		} else {
			if ( function_exists( 'bp_is_active' ) && ! bp_is_blog_page() ) {
				$breadcrumb = new Beehive_Buddypress_Breadcrumb_Trail( $args );
			} elseif ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
				$breadcrumb = new Beehive_BpPress_Breadcrumb_Trail( $args );
			} else {
				$breadcrumb = new Beehive_Breadcrumb_Trail( $args );
			}
			$trail = $breadcrumb->trail();
		}

		// Return trail.
		return $trail;
	}

	/**
	 * Render title bar
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
		if ( 'social' === $this->get() ) {
			add_action( 'beehive_before_main_content', array( $this, 'get_template' ), 5 );
		} else {
			add_action( 'beehive_before_content', array( $this, 'get_template' ) );
		}

		// Add body class.
		add_filter( 'body_class', array( $this, 'add_body_classes' ) );

	}

	/**
	 * Get title bar template
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function get_template() {
		if ( 'social' === $this->get() ) {
			get_template_part( 'template-parts/social', 'titlebar' );
		} else {
			get_template_part( 'template-parts/default', 'titlebar' );
		}
	}

	/**
	 * Show/hide title bar
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function post_titlebar_display() {
		if ( beehive()->options->get( 'key=remove-title-bar&meta=1' ) ) {
			$this->show = false;
		}
	}

	/**
	 * Add body class
	 *
	 * @param array $classes Array of classes.
	 * @return array
	 * @since 1.0.0
	 */
	public function add_body_classes( $classes ) {

		// Push classes.
		array_push( $classes, 'title-bar-active' );

		// Return classes.
		return $classes;
	}
}
