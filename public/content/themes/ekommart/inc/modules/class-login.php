<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Ekommart_Login' ) ) :
	class Ekommart_Login {
		public function __construct() {
			add_action( 'wp_ajax_ekommart_login', array( $this, 'ajax_login' ) );
			add_action( 'wp_ajax_nopriv_ekommart_login', array( $this, 'ajax_login' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 10 );
		}

		public function scripts(){
			global $ekommart_version;
			wp_enqueue_script( 'ekommart-ajax-login', get_template_directory_uri() . '/assets/js/frontend/login.js', array('jquery'), $ekommart_version, true );
		}

		public function ajax_login() {
			do_action( 'ekommart_ajax_verify_captcha' );
			check_ajax_referer( 'ajax-ekommart-login-nonce', 'security-login' );
			$info                  = array();
			$info['user_login']    = $_REQUEST['username'];
			$info['user_password'] = $_REQUEST['password'];
			$info['remember']      = $_REQUEST['remember'];

			$user_signon = wp_signon( $info, false );
			if ( is_wp_error( $user_signon ) ) {
				wp_send_json( array(
					'status' => false,
					'msg'    => esc_html__( 'Wrong username or password. Please try again!!!', 'ekommart' )
				) );
			} else {
				wp_set_current_user( $user_signon->ID );
				wp_send_json( array(
					'status' => true,
					'msg'    => esc_html__( 'Signin successful, redirecting...', 'ekommart' )
				) );
			}
		}
	}
new Ekommart_Login();
endif;
