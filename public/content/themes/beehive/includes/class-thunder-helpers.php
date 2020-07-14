<?php
/**
 * Some helper methods for the theme
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
 * TH_Helpers class.
 * Helper methods
 *
 * @since 1.0.0
 */
class TH_Helpers {

	/**
	 * Check for body class
	 *
	 * @static
	 * @access public
	 * @param string $class class.
	 * @return bool
	 * @since 1.0.0
	 */
	public static function has_body_class( $class ) {
		if ( is_string( $class ) && '' !== $class ) {
			return (bool) in_array( $class, get_body_class(), true );
		}
	}

	/**
	 * Trim a string
	 *
	 * @static
	 * @access public
	 * @param string $string string to be trimmed.
	 * @return string
	 * @since 1.0.0
	 */
	public static function trim_it( $string ) {
		return trim( preg_replace( '/\s+/', ' ', $string ) );
	}

	/**
	 * Convert name to ID
	 *
	 * @static
	 * @access public
	 * @param string $name string to be converted.
	 * @return string
	 * @since 1.0.0
	 */
	public static function name_to_id( $name ) {
		if ( is_string( $name ) ) {
			$name      = strtolower( $name );
			$sanitized = sanitize_title( $name );
			$id        = str_replace( array( '-' ), '_', self::trim_it( $sanitized ) );
			return $id;
		}
	}

	/**
	 * Check valid hex color code
	 *
	 * @static
	 * @access public
	 * @param string $folder folder path.
	 * @return bool
	 * @since 1.0.0
	 */
	public static function is_folder_exists( $folder ) {

		// Path.
		$path = realpath( $folder );
		if ( false !== $path && is_dir( $path ) ) {
			return $path;
		}

		// False.
		return false;
	}

	/**
	 * Check valid hex color code
	 *
	 * @static
	 * @access public
	 * @param string $hex_color hex color code.
	 * @return bool
	 * @since 1.0.0
	 */
	public static function is_valid_color( $hex_color ) {

		// Return early if not valid color.
		if ( ! is_string( $hex_color ) && ! '#' === $hex_color[0] ) {
			return false;
		}

		if ( strlen( $hex_color ) == 4 ) {
			if ( preg_match( '/^#[a-f0-9]{3}$/i', $hex_color ) ) {
				return true;
			}
		} elseif ( strlen( $hex_color ) == 7 ) {
			if ( preg_match( '/^#[a-f0-9]{6}$/i', $hex_color ) ) {
				return true;
			}
		} else {
			return false;
		}

	}

	/**
	 * Convert hex color to rgb
	 *
	 * @static
	 * @access public
	 * @param string $color hex color code.
	 * @return array
	 * @since 1.0.0
	 */
	public static function hex2rgb( $color ) {

		// Return early if not valid color.
		if ( ! is_string( $color ) && ! $color[0] == '#' ) {
			return false;
		}

		if ( $color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		if ( strlen( $color ) == 6 ) {
			list( $r, $g, $b ) = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
			list( $r, $g, $b ) = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return false;
		}
		$r = hexdec( $r );
		$g = hexdec( $g );
		$b = hexdec( $b );

		return array(
			'red'   => $r,
			'green' => $g,
			'blue'  => $b,
		);

	}

	/**
	 * Check if post has shorcode
	 *
	 * @static
	 * @access public
	 * @param array $shortcodes array of shortcodes to be checked.
	 * @return bool
	 * @since 1.0.0
	 */
	public static function has_shortcodes( $shortcodes = array() ) {

		// Return early.
		if ( empty( $shortcodes ) || ! is_array( $shortcodes ) ) {
			return;
		}

		// Do things.
		if ( is_singular() ) {
			global $post;
			$content = $post->post_content;

			if ( ! empty( $content ) ) {
				foreach ( $shortcodes as $shortcode ) {
					if ( has_shortcode( $content, $shortcode ) ) {
						return true;
					}
				}
			}
		}

		return false;

	}

	/**
	 * Check for job manager screen
	 * Non admin
	 *
	 * @static
	 * @access public
	 * @return bool
	 * @since 1.0.0
	 */
	public static function is_job_manager() {
		if ( class_exists( 'WP_Job_Manager' ) ) {
			if ( self::has_shortcodes( array( 'beehive_wpjm_categories' ) ) ) {
				return true;
			}
			if ( has_wpjm_shortcode() || is_wpjm_job_listing() || is_wpjm_taxonomy() || is_post_type_archive( 'job_listing' ) ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Check for woocommerce screen
	 * Non admin
	 *
	 * @static
	 * @access public
	 * @return bool
	 * @since 1.0.0
	 */
	public static function is_woocommerce() {
		if ( class_exists( 'WooCommerce' ) ) {
			if ( is_woocommerce() ) {
				return true;
			} elseif ( is_shop() ) {
				return true;
			} elseif ( is_product_category() ) {
				return true;
			} elseif ( is_product_tag() ) {
				return true;
			} elseif ( is_product() ) {
				return true;
			} elseif ( is_cart() ) {
				return true;
			} elseif ( is_checkout() ) {
				return true;
			} elseif ( is_account_page() ) {
				return true;
			} elseif ( self::has_shortcodes( array( 'product_categories', 'woocommerce_order_tracking' ) ) ) {
				return true;
			} else {
				return false;
			}
		}

		return false;
	}

	/**
	 * Check for buddypress screen
	 * Non admin
	 *
	 * @static
	 * @access public
	 * @return bool
	 * @since 1.0.0
	 */
	public static function is_buddypress() {
		if ( function_exists( 'bp_is_active' ) ) {
			return (bool) is_buddypress();
		}
		return false;
	}

	/**
	 * Check for bbpress forum screesn
	 * Non admin
	 *
	 * @static
	 * @access public
	 * @return bool
	 * @since 1.0.0
	 */
	public static function is_bbpress() {
		if ( class_exists( 'bbPress' ) ) {
			if ( function_exists( 'bp_is_active' ) ) {
				if ( bp_is_user() || bp_is_group() ) {
					return false;
				}
			}
			return (bool) is_bbpress();
		}

		return false;
	}

	/**
	 * Check for wp advert screen
	 * Non admin
	 *
	 * @static
	 * @access public
	 * @return bool
	 * @since 1.0.0
	 */
	public static function is_advert() {

		if ( defined( 'ADVERTS_FILE' ) ) {

			/** Single ad */
			if ( is_singular( 'advert' ) ) {
				return true;
			}

			/** Advert taxonomy */
			if ( is_tax( 'advert_category' ) ) {
				return true;
			}

			/** Pages with shortcodes */
			if ( self::has_shortcodes( array( 'adverts_list', 'adverts_categories', 'adverts_add', 'adverts_manage', 'adverts_payments_checkout' ) ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Check for media screens
	 * Non admin
	 *
	 * @static
	 * @access public
	 * @return bool
	 * @since 1.0.0
	 */
	public static function is_media() {
		if ( class_exists( 'RTMedia' ) ) {
			if ( self::has_shortcodes( array( 'rtmedia_gallery' ) ) ) {
				return true;
			}
		}
		return false;
	}

}
