<?php
/**
 * Beehive ajax login
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
 * Beehive_Ajax_Login class.
 *
 * @since 1.0.0
 */
class Beehive_Ajax_Login {

	/**
	 * Instance
	 * The single instance of this class
	 *
	 * @access private
	 * @static
	 * @var object
	 * @since 1.0.0
	 */
	private static $_instance = null;

	/**
	 * Instance
	 * Ensures only one instance of the class is loaded or can be loaded
	 *
	 * @access public
	 * @static
	 * @return an instance of this class
	 * @since 1.0.0
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * The class constructor
	 *
	 * @access public
	 */
	public function __construct() {

		// Return if user is logged int.
		if ( is_user_logged_in() ) {
			return;
		}

		// Ajax login init.
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Init method
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function init() {

		// Add scripts.
		add_filter( 'beehive_scripts', array( $this, 'add_scripts' ), 10, 2 );
		// do ajax login.
		add_action( 'wp_ajax_nopriv_beehive_ajaxlogin', array( $this, 'ajax_login' ) );

	}

	/**
	 * Do ajax login
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function ajax_login() {

		// Return early.
		if ( ( ! isset( $_POST['action'] ) || empty( $_POST['action'] ) ) || empty( $_POST['form_id'] ) ) {
			return;
		}

		// Varify nonce.
		if ( 'panel-login-form' === $_POST['form_id'] ) {
			check_ajax_referer( 'beehive-panel-ajax-login-nonce', 'panel-login-security' );
		} elseif ( 'modal-login-form' === $_POST['form_id'] ) {
			check_ajax_referer( 'beehive-modal-ajax-login-nonce', 'modal-login-security' );
		} elseif ( 'element-login-form' === $_POST['form_id'] ) {
			check_ajax_referer( 'beehive-element-ajax-login-nonce', 'element-login-security' );
		} else {
			die();
		}

		// Log the user in.
		$user_signon = wp_signon( '' );
		if ( is_wp_error( $user_signon ) ) {
			$error_msg = $user_signon->get_error_message();
			if ( $error_msg ) {
				$message = $error_msg;
			} else {
				$message = esc_attr__( 'Wrong username or Password.', 'beehive' );
			}
			echo wp_json_encode(
				array(
					'loggedin' => false,
					'message'  => sprintf( '<span class="login-message error">%s</span>', $message ),
				)
			);
		} else {
			$message = esc_attr__( 'Login successful, redirecting...', 'beehive' );
			echo wp_json_encode(
				array(
					'loggedin' => true,
					'message'  => sprintf( '<span class="login-message success">%s</span>', $message ),
				)
			);
		}

		// Kill the function.
		die();
	}

	/**
	 * Add scripts
	 *
	 * @access public
	 * @param array  $scripts  array of scripts.
	 * @param string $min      Minified version of the script.
	 * @return array
	 * @since 1.0.0
	 */
	public function add_scripts( $scripts, $min ) {

		// Beehive ajax login script.
		$scripts['beehive-login'] = array(
			'src'       => BEEHIVE_URI . '/assets/js/beehive-login' . $min . '.js',
			'deps'      => array(),
			'in_footer' => true,
			'enqueue'   => true,
		);

		// Return scripts.
		return $scripts;

	}

}

// Single instance of this class.
Beehive_Ajax_Login::instance();
