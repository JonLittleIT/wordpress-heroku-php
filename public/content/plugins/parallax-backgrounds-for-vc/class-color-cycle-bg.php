<?php
/**
 * Color Cycle BG routines.
 *
 * @version 1.1
 * @package Parallax Backgrounds for VC
 */

// Initializes the Color Cycle BG functionality.
if ( ! class_exists( 'GambitColorCycleBG' ) ) {

	/**
	 * This is where all the actions of the colors happen.
	 */
	class GambitColorCycleBG {
		/**
		 * Uniquely identifies rendered bg.
		 *
		 * @var string $elementID - The ID used.
		 */
		public static $elementID = 1;

		/**
		 * Hook into WordPress.
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {
			// Initialize as a Visual Composer addon.
			add_filter( 'init', array( $this, 'create_row_shortcodes' ), 999 );

			// Makes the plugin function accessible as a shortcode.
			add_shortcode( 'color_cycle_bg', array( $this, 'create_shortcode' ) );

			// Our admin-side scripts & styles.
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		}


		/**
		 * Includes admin scripts and styles needed.
		 *
		 * @return	void
		 * @since	1.0
		 */
		public function admin_enqueue_scripts() {
			wp_enqueue_style( 'gambit_parallax_admin', plugins_url( 'css/admin.css', __FILE__ ), array(), VERSION_GAMBIT_VC_PARALLAX_BG );
		}


		/**
		 * Generate a completely random color.
		 *
		 * @return string - A randomized color in #XXXXXX, where X can be 1-9, a to f.
		 * @since	1.0
		 */
		public function random_colors() {
			return '#' . strtoupper( dechex( rand( 0x000000, 0xFFFFFF ) ) );
		}


		/**
		 * Creates our shortcode settings in Visual Composer.
		 *
		 * @return	void
		 * @since	1.0
		 */
		public function create_row_shortcodes() {
			if ( ! function_exists( 'vc_map' ) ) {
				return;
			}

			vc_map( array(
				'name' => __( 'Color Cycle BG', GAMBIT_VC_PARALLAX_BG ),
				'base' => 'color_cycle_bg',
				'icon' => plugins_url( 'parallax/images/vc-background.png', __FILE__ ),
				'description' => __( 'Add a background color with cycling colors.', GAMBIT_VC_PARALLAX_BG ),
				'category' => __( 'Row Adjustments', GAMBIT_VC_PARALLAX_BG ),
				'params' => array(
				array(
					'type' => 'colorpicker',
					'class' => '',
					'heading' => __( 'Color 1', GAMBIT_VC_PARALLAX_BG ),
					'param_name' => 'color1',
					'value' => '#22A7F0',
					'description' => __( 'Choose the first color to render.', GAMBIT_VC_PARALLAX_BG ),
				),
				array(
					'type' => 'colorpicker',
					'class' => '',
					'heading' => __( 'Color 2', GAMBIT_VC_PARALLAX_BG ),
					'param_name' => 'color2',
					'value' => '#913D88',
					'description' => __( 'Choose the second color to render.', GAMBIT_VC_PARALLAX_BG ),
				),
				array(
					'type' => 'colorpicker',
					'class' => '',
					'heading' => __( 'Color 3', GAMBIT_VC_PARALLAX_BG ),
					'param_name' => 'color3',
					'value' => '',
					'description' => __( 'Choose the third color to render.', GAMBIT_VC_PARALLAX_BG ),
				),
				array(
					'type' => 'colorpicker',
					'class' => '',
					'heading' => __( 'Color 4', GAMBIT_VC_PARALLAX_BG ),
					'param_name' => 'color4',
					'value' => '',
					'description' => __( 'Choose the fourth color to render.', GAMBIT_VC_PARALLAX_BG ),
				),
				array(
					'type' => 'checkbox',
					'class' => '',
					'param_name' => 'shuffle',
					'value' => array( __( 'Check this to shuffle the colors in rendering.', GAMBIT_VC_PARALLAX_BG ) => 'true' ),
					'description' => '',
				),
				array(
					'type' => 'textfield',
					'class' => '',
					'heading' => __( 'Color cycling duration', GAMBIT_VC_PARALLAX_BG ),
					'param_name' => 'duration',
					'value' => '30',
					'description' => __( 'The duration of the color cycling overall, in seconds.', GAMBIT_VC_PARALLAX_BG ),
				),
				array(
					'type' => 'textfield',
					'class' => '',
					'heading' => __( 'Extra selectors for background', GAMBIT_VC_PARALLAX_BG ),
					'param_name' => 'classes',
					'value' => '',
					'description' => __( "If you want more selectors to be affected by the color cycling, enter their CSS element selector names here, separated by commas. This selector will affect the element's CSS background.", GAMBIT_VC_PARALLAX_BG ),
				),
				array(
					'type' => 'textfield',
					'class' => '',
					'heading' => __( 'Extra selectors for color', GAMBIT_VC_PARALLAX_BG ),
					'param_name' => 'classes_color',
					'value' => '',
					'description' => __( "To make the color cycling apply to color-driven elements, enter their selectors here. This selector will affect the element's CSS color.", GAMBIT_VC_PARALLAX_BG ),
				),
				array(
					'type' => 'checkbox',
					'class' => '',
					'param_name' => 'nobg',
					'value' => array( __( 'Check this box to suppress background color cycling, and instead render it with the extra selectors. Handy for special designs.', GAMBIT_VC_PARALLAX_BG ) => 'true' ),
					'description' => '',
				),
				),
			) );
		}


		/**
		 * Shortcode logic.
		 *
		 * @param array  $atts - The attributes of the shortcode.
		 * @param string $content - The content enclosed inside the shortcode if any.
		 * @return string - The rendered html.
		 * @since 1.0
		 */
		public function create_shortcode( $atts, $content = null ) {

			$color = array();
			$output = '';

			$defaults = array(
				'color1' => '',
				'color2' => '',
				'color3' => '',
				'color4' => '',
				'duration' => '30',
				'shuffle' => 'false',
				'classes' => '',
				'classes_color' => '',
				'nobg' => 'false',
			);

			if ( empty( $atts ) ) {
				$atts = array();
			}

			$atts = array_merge( $defaults, $atts );

			// Identify the colors and assign them.
			if ( ! empty( $atts['color1'] ) ) {
				$color[] = $atts['color1'];
			}
			if ( ! empty( $atts['color2'] ) ) {
				$color[] = $atts['color2'];
			}
			if ( ! empty( $atts['color3'] ) ) {
				$color[] = $atts['color3'];
			}
			if ( ! empty( $atts['color4'] ) ) {
				$color[] = $atts['color4'];
			}

			// Shuffle the colors if so specified.
			if ( 'false' != $atts['shuffle'] ) {
				shuffle( $color );
			}

			// Prepare prefixes and classes.
			$prefix = array( '-webkit-', '-moz-', '-ms-', '-o-', '' );
			$classes = ( empty( $atts['nobg'] ) || 'false' == $atts['nobg'] ? array( '.gambit_colorcycle_vc_row_' . self::$elementID ) : array() ) ;
			$extraClasses = array();
			$extraClassesColor = array();

			if ( ! empty( $atts['classes'] ) ) {
				$extraClasses = explode( ',', $atts['classes'] );
			}

			if ( ! empty( $atts['classes_color'] ) ) {
				$extraClassesColor = explode( ',', $atts['classes_color'] );
			}

			$classes = array_merge( $classes, $extraClasses );

			wp_enqueue_script( 'gambit_parallax', plugins_url( 'parallax/js/min/script-min.js', __FILE__ ), array( 'jquery' ), VERSION_GAMBIT_VC_PARALLAX_BG, true );
			wp_enqueue_style( 'gambit_parallax', plugins_url( 'parallax/css/style.css', __FILE__ ), array(), VERSION_GAMBIT_VC_PARALLAX_BG );

			if ( ! count( $color ) ) {
				return '';
			}

			$output .= '<style>';

			$output .= implode( ',', $classes ) . ' {';
			foreach ( $prefix as $thePrefix ) {
				$output .= $thePrefix . 'animation: gp-colorcycle-' . self::$elementID . ' ' . $atts['duration'] .  's infinite;';
			}
			$output .= '}';

			if ( count( $extraClassesColor ) > 0 ) {
				$output .= implode( ',', $extraClassesColor ) . ' {';
				foreach ( $prefix as $thePrefix ) {
					$output .= $thePrefix . 'animation: gp-colorcycle-colors-' . self::$elementID . ' ' . $atts['duration'] .  's infinite;';
				}
				$output .= '}';
			}

			foreach ( $prefix as $thePrefix ) {
				$output .= '@' . $thePrefix . 'keyframes gp-colorcycle-' . self::$elementID . ' {';
				$output .= '0%, 100% {background: ' . $color[0] . ';}';
				if ( 2 == count( $color ) ) {
					$output .= '50% {background: ' . $color[1] . ';}';
				} elseif ( 3 == count( $color ) ) {
					$output .= '33% {background: ' . $color[1] . ';}';
					$output .= '66% {background: ' . $color[2] . ';}';
				} elseif ( 4 == count( $color ) ) {
					$output .= '25% {background: ' . $color[1] . ';}';
					$output .= '50% {background: ' . $color[2] . ';}';
					$output .= '75%  {background: ' . $color[3] . ';}';
				}
				$output .= '}';
			}

			if ( count( $extraClassesColor ) > 0 ) {
				foreach ( $prefix as $thePrefix ) {
					$output .= '@' . $thePrefix . 'keyframes gp-colorcycle-colors-' . self::$elementID . ' {';
					$output .= '0%, 100% {color: ' . $color[0] . '; fill: ' . $color[0] . ';}';
					if ( 2 == count( $color ) ) {
						$output .= '50%  {color: ' . $color[1] . '; fill: ' . $color[1] . ';}';
					} elseif ( 3 == count( $color ) ) {
						$output .= '33%  {color: ' . $color[1] . '; fill: ' . $color[1] . ';}';
						$output .= '66%  {color: ' . $color[2] . '; fill: ' . $color[2] . ';}';
					} elseif ( 4 == count( $color ) ) {
						$output .= '25%  {color: ' . $color[1] . '; fill: ' . $color[1] . ';}';
						$output .= '50%  {color: ' . $color[2] . '; fill: ' . $color[2] . ';}';
						$output .= '75%  {color: ' . $color[3] . '; fill: ' . $color[3] . ';}';
					}
					$output .= '}';
				}
			}

			$output .= '</style>';

			$output .= "<div class='gambit_colorcycle' data-animclass='gambit_colorcycle_vc_row_" . self::$elementID . "'></div>";

			self::$elementID++;

			return $output;
		}
	}

	new GambitColorCycleBG();

}
