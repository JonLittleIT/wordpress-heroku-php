<?php
/**
 * Class Beehive Fonts
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
 * Beehive_Fonts class.
 *
 * @since 1.0.0
 */
class Beehive_Fonts {

	/**
	 * Google fonts array
	 *
	 * @access private
	 * @var array
	 * @since 1.0.0
	 */
	private $gfonts = array();

	/**
	 * Fonts array
	 *
	 * @access private
	 * @var array
	 * @since 1.0.0
	 */
	private $fonts = array();

	/**
	 * The array of subsets
	 *
	 * @access private
	 * @var array
	 * @since 1.0.0
	 */
	private $subsets = array();

	/**
	 * Google fonts url
	 *
	 * @access private
	 * @var string
	 * @since 1.0.0
	 */
	private $url = '';

	/**
	 * The class constructor.
	 *
	 * @access public
	 */
	public function __construct() {

		// Call init method.
		$this->init();
	}

	/**
	 * Init method
	 *
	 * @access protected
	 * @return void
	 * @since 1.0.0
	 */
	protected function init() {
		// populate google fonts.
		$this->set_google_fonts();
		// Prepare fonts.
		$this->prepare_fonts();
		// Set Url.
		$this->set_url();
	}

	/**
	 * Set google fonts
	 *
	 * @access private
	 * @return void
	 * @since 1.0.0
	 */
	private function set_google_fonts() {

		// construct google fonts array.
		if ( empty( $this->gfonts ) ) {
			// get redux google fonts lib.
			$fonts = require BEEHIVE_INC . '/google-fonts/googlefonts.php';
			if ( is_array( $fonts ) && ! empty( $fonts ) ) {
				$gfonts = array();
				foreach ( $fonts as $name => $font ) {
					$gfonts[ $name ] = array(
						'family'   => $name,
						'variants' => $font['variants'],
						'subsets'  => $font['subsets'],
					);
				}
			}
		}

		// Set google fonts.
		if ( isset( $gfonts ) && ! empty( $gfonts ) ) {
			$this->gfonts = $gfonts;
		}
	}

	/**
	 * Prepare fonts
	 *
	 * @access private
	 * @return void
	 * @since 1.0.0
	 */
	private function prepare_fonts() {

		// Option typography fields.
		$option_font_fields = array(
			'body-font',
			'heading-font',
		);

		// Loop through the fields and get font values.
		foreach ( $option_font_fields as $field ) {
			$font = beehive()->options->get( array( 'key' => $field ) );
			if ( isset( $font['font-family'] ) && ! empty( $font['font-family'] ) ) {

				// font variants.
				$variants = array();

				if ( isset( $font['font-weight'] ) && ! empty( $font['font-weight'] ) ) {
					$variants[] = $font['font-weight'];
				} else {
					$variants[] = '400';
				}

				if ( 'body-font' === $field ) {
					$variants[] = '300';
					$variants[] = '300italic';
					$variants[] = '400';
					$variants[] = '400italic';
					$variants[] = '600';
					$variants[] = '600italic';
					$variants[] = '700';
					$variants[] = '700italic';
				}

				// Add valid fonts to $this->fonts array.
				if ( array_key_exists( $font['font-family'], $this->gfonts ) ) {

					// google font variants.
					$gvariant = array();

					// loop through the google font variants and populate $gvariant.
					if ( isset( $this->gfonts[ $font['font-family'] ]['variants'] ) ) {
						foreach ( $this->gfonts[ $font['font-family'] ]['variants'] as $variant ) {
							if ( isset( $variant['id'] ) ) {
								array_push( $gvariant, $variant['id'] );
							}
						}
					}

					// valid font variants.
					$valid_variants = array_intersect( $gvariant, $variants );

					// Set the font family if not set.
					if ( ! isset( $this->fonts[ $font['font-family'] ] ) ) {
						$this->fonts[ $font['font-family'] ] = array();
					}

					// Push variants into the font family.
					if ( ! empty( $valid_variants ) ) {
						foreach ( $valid_variants as $valid_variant ) {
							array_push( $this->fonts[ $font['font-family'] ], $valid_variant );
						}
					}

					// Make sure the array is unique.
					$this->fonts[ $font['font-family'] ] = array_unique( $this->fonts[ $font['font-family'] ] );

					// Add valid subsets to $this->subsets array.
					if ( isset( $font['subsets'] ) ) {
						$subsets = array();
						if ( is_array( $font['subsets'] ) ) {
							foreach ( $font['subsets'] as $subset ) {
								array_push( $subsets, $subset );
							}
						} else {
							$subsets[] = $font['subsets'];
						}

						// google subsets.
						$gsubsets = array();
						if ( isset( $this->gfonts[ $font['font-family'] ]['subsets'] ) ) {
							foreach ( $this->gfonts[ $font['font-family'] ]['subsets'] as $subset ) {
								if ( isset( $subset['id'] ) ) {
									array_push( $gsubsets, $subset['id'] );
								}
							}
						}

						// Valid subsets.
						$valid_subsets = array_intersect( $gsubsets, $subsets );

						// Set $this->subsets.
						foreach ( $valid_subsets as $valid_subset ) {
							array_push( $this->subsets, $valid_subset );
						}
					}
				}
			}
		}
	}

	/**
	 * Set google fonts url
	 *
	 * @access private
	 * @return void
	 * @since 1.0.0
	 */
	private function set_url() {

		// Return early if fonts is empty.
		if ( ! empty( $this->fonts ) ) {

			// Merge fonts.
			$fonts_array = array();
			foreach ( $this->fonts as $font => $variants ) {
				$variants    = implode( ',', $variants );
				$font_string = str_replace( ' ', '+', $font );
				if ( ! empty( $variants ) ) {
					$merge_font = sprintf( '%s:%s', $font_string, $variants );
				}
				array_push( $fonts_array, $merge_font );
			}

			// Unique subsets.
			if ( ! empty( $this->subsets ) ) {
				$this->subsets = array_unique( $this->subsets );
			}

			// Create url.
			$url = add_query_arg(
				array(
					'family' => str_replace( '%2B', '+', rawurlencode( implode( '|', $fonts_array ) ) ),
					'subset' => rawurlencode( implode( ',', $this->subsets ) ),
				),
				'https://fonts.googleapis.com/css'
			);
		} else {
			$fonts_array = array( 'Nunito+Sans:300,400,600,700,300italic,400italic,600italic,700italic', 'Quicksand:500,700' );
			$subsets     = array();

			// Create url.
			$url = add_query_arg(
				array(
					'family' => str_replace( '%2B', '+', rawurlencode( implode( '|', $fonts_array ) ) ),
					'subset' => rawurlencode( implode( ',', $subsets ) ),
				),
				'https://fonts.googleapis.com/css'
			);
		}

		// Set font url.
		$this->url = $url;
	}

	/**
	 * Get google fonts url
	 *
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function get_url() {
		return esc_url( $this->url );
	}
}
