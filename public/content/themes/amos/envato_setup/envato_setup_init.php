<?php

if ( ! defined( 'ABSPATH' ) ) exit;


add_filter('envato_setup_logo_image','envato_setup_logo_image');
function envato_setup_logo_image($old_image_url){
	return get_template_directory_uri().'/images/light/logo.png';
}



if ( ! function_exists( 'envato_theme_setup_wizard' ) ) :
	function envato_theme_setup_wizard() {

		if(class_exists('Envato_Theme_Setup_Wizard')) {
			class Elle_Envato_Theme_Setup_Wizard extends Envato_Theme_Setup_Wizard {

				/**
				 * Holds the current instance of the theme manager
				 *
				 * @since 1.1.3
				 * @var Envato_Theme_Setup_Wizard
				 */
				private static $instance = null;

				/**
				 * @since 1.1.3
				 *
				 * @return Envato_Theme_Setup_Wizard
				 */
				public static function get_instance() {
					if ( ! self::$instance ) {
						self::$instance = new self;
					}

					return self::$instance;
				}

				public function get_default_theme_style(){
					return 'dark';
				}

			}

			Elle_Envato_Theme_Setup_Wizard::get_instance();
		}else{
			// log error?
		}
	}
endif;