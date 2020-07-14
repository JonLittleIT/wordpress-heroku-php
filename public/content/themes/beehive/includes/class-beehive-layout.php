<?php
/**
 * Layout handler.
 * This class handles theme layout
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
	exit( 'Direct script access denied.' ); }

/**
 * Beehive_Layout class.
 *
 * @since 1.0.0
 */
class Beehive_Layout {

	/**
	 * Layout type
	 *
	 * @access public
	 * @since 1.0.0
	 * @var string
	 */
	public $layout = '';

	/**
	 * Body classes
	 *
	 * @access public
	 * @since 1.0.0
	 * @var object
	 */
	public $body_classes = array();

	/**
	 * The class constructor
	 *
	 * @access public
	 */
	public function __construct() {
		// Init into wp_head.
		add_action( 'wp_head', array( $this, 'layout_init' ) );
		// Add body classes.
		add_action( 'body_class', array( $this, 'add_body_classes' ), 20 );
	}

	/**
	 * Set Page Layout
	 *
	 * @access public
	 * @param string $layout page layout.
	 * @return void
	 * @since 1.0.0
	 */
	public function set( $layout = '' ) {
		if ( is_string( $layout ) ) {
			$this->layout = $layout;
		}
	}

	/**
	 * Get Page Layout
	 *
	 * @access public
	 * @return mixed
	 * @since 1.0.0
	 */
	public function get() {
		return $this->layout;
	}

	/**
	 * Prepare Layout
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function layout_init() {

		// Set post sidebar.
		if ( $this->get_post_sidebar() ) {
			beehive()->sidebars->set( $this->get_post_sidebar() );
		}

		// get the layout.
		$layout = $this->layout;

		if ( 'right' === $layout ) {
			$width = $this->get_layout_widths();
			if ( ! empty( $width['sidebar'] ) ) {
				$this->body_classes[] = 'right-sidebar';
				add_filter(
					'beehive_layout_wrapper',
					function() {
						return 'right';
					}
				);
				add_filter(
					'beehive_main_content_width',
					function() use ( $width ) {
						return 'col-lg-' . $width['content'];
					}
				);
				add_filter(
					'beehive_sidebar_width',
					function() use ( $width ) {
						return 'col-lg-' . $width['sidebar'];
					}
				);
				add_action( 'beehive_after_content_grid', 'get_sidebar' );
			} else {
				$this->body_classes[] = 'full-width';
				add_filter(
					'beehive_layout_wrapper',
					function() {
						return 'full';
					}
				);
				add_filter(
					'beehive_main_content_width',
					function() use ( $width ) {
						return 'col-lg-' . $width['content'];
					}
				);
			}
		} elseif ( 'left' === $layout ) {
			$width = $this->get_layout_widths();
			if ( ! empty( $width['sidebar'] ) ) {
				$this->body_classes[] = 'left-sidebar';
				add_filter(
					'beehive_layout_wrapper',
					function() {
						return 'left';
					}
				);
				add_filter(
					'beehive_main_content_width',
					function() use ( $width ) {
						return 'col-lg-' . $width['content'];
					}
				);
				add_filter(
					'beehive_sidebar_width',
					function() use ( $width ) {
						return 'col-lg-' . $width['sidebar'];
					}
				);
				add_action( 'beehive_before_content_grid', 'get_sidebar' );
			} else {
				$this->body_classes[] = 'full-width';
				add_filter(
					'beehive_layout_wrapper',
					function() {
						return 'full';
					}
				);
				add_filter(
					'beehive_main_content_width',
					function() use ( $width ) {
						return 'col-lg-' . $width['content'];
					}
				);
			}
		} elseif ( 'full' === $layout ) {
			beehive()->sidebars->show( false );
			$width                = $this->get_layout_widths();
			$this->body_classes[] = 'full-width';
			add_filter(
				'beehive_layout_wrapper',
				function() {
					return 'full';
				}
			);
			add_filter(
				'beehive_main_content_width',
				function() use ( $width ) {
					return 'col-lg-' . $width['content'];
				}
			);
		} elseif ( 'blank' === $layout ) {
			beehive()->titlebar->show( false );
			beehive()->sidebars->show( false );
			$width                = $this->get_layout_widths();
			$this->body_classes[] = 'blank-template';
			add_filter(
				'beehive_layout_wrapper',
				function() {
					return 'blank';
				}
			);
			add_filter(
				'beehive_main_content_width',
				function() use ( $width ) {
					return 'col-md-' . $width['content'];
				}
			);
		} elseif ( 'social' === $layout ) {
			beehive()->navigation->set( 'social' );
			beehive()->titlebar->set( 'social' );
			$this->body_classes[] = 'beehive-social-layout';
			$this->body_classes[] = 'panel-expanded';
			$width                = $this->get_layout_widths();
			add_action(
				'beehive_before_page_starts',
				function() {
					get_template_part( 'template-parts/social-panel' );
				}
			);
			add_filter(
				'beehive_layout_wrapper',
				function() {
					return 'social';
				}
			);
			add_filter(
				'beehive_container_class',
				function() {
					return 'container-fluid';
				}
			);
			if ( ! empty( $width['sidebar'] ) ) {
				$this->body_classes[] = 'has-page-sidebar';
				add_filter(
					'beehive_main_content_width',
					function() use ( $width ) {
						return 'col-lg-' . $width['content'];
					}
				);
				add_filter(
					'beehive_sidebar_width',
					function() use ( $width ) {
						return 'col-lg-' . $width['sidebar'];
					}
				);
				add_action( 'beehive_after_content_grid', 'get_sidebar' );
			} else {
				$this->body_classes[] = 'no-sidebar';
				add_filter(
					'beehive_main_content_width',
					function() use ( $width ) {
						return 'col-lg-' . $width['content'];
					}
				);
			}
			beehive()->footer->show( false );
			add_filter(
				'bpc_template',
				function() {
					return 'dash';
				}
			);
		} elseif ( 'social-12' === $layout ) {
			beehive()->navigation->set( 'social' );
			beehive()->titlebar->set( 'social' );
			beehive()->sidebars->show( false );
			$this->body_classes[] = 'beehive-social-layout';
			$this->body_classes[] = 'panel-expanded';
			$this->body_classes[] = 'no-sidebar';
			$width                = $this->get_layout_widths();
			add_action(
				'beehive_before_page_starts',
				function() {
					get_template_part( 'template-parts/social-panel' );
				}
			);
			add_filter(
				'beehive_layout_wrapper',
				function() {
					return 'social';
				}
			);
			add_filter(
				'beehive_container_class',
				function() {
					return 'container-fluid';
				}
			);
			add_filter(
				'beehive_main_content_width',
				function() use ( $width ) {
					return 'col-lg-' . $width['content'];
				}
			);
			beehive()->footer->show( false );
			add_filter(
				'bpc_template',
				function() {
					return 'dash';
				}
			);
		} elseif ( 'social-collapsed' === $layout ) {
			beehive()->navigation->set( 'social' );
			beehive()->titlebar->set( 'social' );
			beehive()->sidebars->show( false );
			$this->body_classes[] = 'beehive-social-layout';
			$this->body_classes[] = 'panel-collapsed';
			$this->body_classes[] = 'no-sidebar';
			$width                = $this->get_layout_widths();
			add_action(
				'beehive_before_page_starts',
				function() {
					get_template_part( 'template-parts/social-panel' );
				}
			);
			add_filter(
				'beehive_layout_wrapper',
				function() {
					return 'social-wide';
				}
			);
			add_filter(
				'beehive_main_content_width',
				function() use ( $width ) {
					return 'col-lg-' . $width['content'];
				}
			);
			beehive()->footer->show( false );
			add_filter(
				'bpc_template',
				function() {
					return 'dash';
				}
			);
		} else {
			$width = $this->get_layout_widths();
			if ( ! empty( $width['sidebar'] ) ) {
				$this->body_classes[] = 'right-sidebar';
				add_filter(
					'beehive_layout_wrapper',
					function() {
						return 'right';
					}
				);
				add_filter(
					'beehive_main_content_width',
					function() use ( $width ) {
						return 'col-lg-' . $width['content'];
					}
				);
				add_filter(
					'beehive_sidebar_width',
					function() use ( $width ) {
						return 'col-lg-' . $width['sidebar'];
					}
				);
				add_action( 'beehive_after_content_grid', 'get_sidebar' );
			} else {
				$this->body_classes[] = 'full-width';
				add_filter(
					'beehive_layout_wrapper',
					function() {
						return 'full';
					}
				);
				add_filter(
					'beehive_main_content_width',
					function() use ( $width ) {
						return 'col-lg-' . $width['content'];
					}
				);
			}
		}
	}

	/**
	 * Get contents widths for
	 * main content and sidebar
	 *
	 * @access private
	 * @return array
	 * @since 1.0.0
	 */
	private function get_layout_widths() {
		$width = array();
		if ( true === beehive()->sidebars->show && true === beehive()->sidebars->active ) {
			$width['content'] = 8;
			$width['sidebar'] = 4;
		} else {
			$width['content'] = 12;
			$width['sidebar'] = 0;
		}
		return $width;
	}

	/**
	 * Get post sidebar
	 *
	 * @return string
	 * @since 1.0.0
	 */
	private function get_post_sidebar() {
		$id = beehive()->options->get( 'key=page-sidebar&meta=1&options=0' );
		if ( $id && array_key_exists( $id, beehive()->sidebars->get_sidebars() ) ) {
			return beehive()->sidebars->get_sidebar_name( $id );
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

		// Add body classes.
		if ( ! empty( $this->body_classes ) ) {
			foreach ( $this->body_classes as $class ) {
				array_push( $classes, $class );
			}
		}

		// Return classes.
		return $classes;
	}
}
