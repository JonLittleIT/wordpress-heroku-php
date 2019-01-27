<?php

/** Envato API check **/

function pixtheme_check_is_activated(){

	$envatoCode = get_theme_mod('pixtheme_licence_settings_code', '');
	
	$option_name = 'pixtheme_licence_is_activated';
	$option_name_code = 'pixtheme_licence_code';
	if ($envatoCode){
		if (!empty( get_option( $option_name )) ){

			if (!empty(get_option( $option_name_code )) && (get_option( $option_name_code ) == $envatoCode)){

				$expiredTime = strtotime(get_option( $option_name ));	
				if ($expiredTime < time()){
					activate_license($envatoCode, $option_name, $option_name_code);
				}
				return true;
			}
		}
	 return	activate_license($envatoCode, $option_name, $option_name_code);
	}
	return false;
}

function activate_license($envatoCode, $option_name, $option_name_code) {

	$theme_id = '20896134';
	$theme = 'Theme Farvis';
	
	$api_params = array(
		'edd_action' => 'activate_license',
		'license_key'    => $envatoCode,
		'theme'  	 => $theme,
		'theme_id'  => $theme_id,
		'url'        => home_url()
	);

	$response = get_api_response( json_encode( $api_params ));

	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

		if ( is_wp_error( $response ) ) {
			$message = $response->get_error_message();
		} else {
			$message = __( 'An error occurred, please try again.', 'farvis' );
		}


	} else {

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		if (is_object($license_data) && false === $license_data->success ) {

		}

	}
	if ( isset($license_data) && isset( $license_data->license ) ) {

		if ($license_data->license !== 'valid') {
			update_option( $option_name, '' );
			update_option( $option_name_code, $envatoCode );
			return false;
		}else{
			update_option( $option_name, $license_data->time );
			update_option( $option_name_code, $envatoCode );	
			return true;
		}
	
	}
	return false;

}
 function get_api_response( $api_params ) {

 	$remote_api_url = 'http://support.templines.com/keyact/';
	$response = wp_remote_post( $remote_api_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

	return $response;
 }


if ( !function_exists( 'pix_admin_notice_activation' ) ) {
  function pix_admin_notice_activation() {
  	if(pixtheme_check_is_activated())return;
  	$envatoCode = get_theme_mod('pixtheme_licence_settings_code') ? get_theme_mod('pixtheme_licence_settings_code') : '';
    $screen = get_current_screen();
    if ( $screen->id != 'appearance_page_adminpanel' ) {
        if ( 1 ) {
            echo "
                <div style='display:block' class='update-nag'>
                    <h3 class='pix_notice_title'>" . esc_html__("Theme activation", "farvis") . "</h3>
                    <p>" . esc_html__("Your code", "farvis") . "<input style='width:280px;margin:0 10px' type='text' name='pix_code' data-activationtheme='1' value='{$envatoCode}'><a data-activationtheme='1' class='button button-primary activation-theme'>" . esc_html__('Activation', 'farvis') . "</a></p><p class='activated' style='display:none'>" . esc_html__("Theme activated", "farvis") . "</p>
                </div>
            ";
        }
    }
  }
}
// add_action( 'init', 'pix_admin_notice_view' );
function pix_admin_notice_view() {
	if (current_user_can('switch_themes')) {
    add_action('admin_notices', 'pix_admin_notice_activation', 2);
	}
}

if( wp_doing_ajax() ){
	add_action('wp_ajax_theme_activation', 'pix_ajax_theme_activation');
	add_action('wp_ajax_delete_key_activation', 'pix_ajax_delete_key_activation');
}
function pix_ajax_theme_activation() {
	global $post;
	if( ! wp_verify_nonce( $_POST['nonce_code'], 'pix-admin-nonce' ) ) die( 'Stop!');
	$json = wp_unslash( $_POST['code']);
	set_theme_mod( 'pixtheme_licence_settings_code', $json );

	if($rez = pixtheme_check_is_activated()){
		echo ''.$rez;
	}else{
		echo ''.$rez;
	}

	wp_die();
}
function pix_ajax_delete_key_activation() {
	global $post;
	if( ! wp_verify_nonce( $_POST['nonce_code'], 'pix-admin-nonce' ) ) die( 'Stop!');

	$envatoCode = get_theme_mod('pixtheme_licence_settings_code', '');
	$theme_id = '15911085';
	$theme = 'Theme farvis';
	$api_params = array(
		'edd_action' => 'delete_key',
		'license_key'    => $envatoCode,
		'theme'  	 => $theme,
		'theme_id'  => $theme_id,
		'url'        => home_url()
	);

	$response = get_api_response( json_encode( $api_params ));
	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

	} else {

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		if (is_object($license_data) && true == $license_data->success ) {
			set_theme_mod( 'pixtheme_licence_settings_code', '' );
			update_option( 'pixtheme_licence_code', '' );
			echo  1 ;
		}else{
			echo  0;
		}

	}



	wp_die();
}

add_action( 'admin_enqueue_scripts', 'activete_theme_ajax_data');
function activete_theme_ajax_data(){
	wp_localize_script( 'jquery', 'pixAjax', 
		array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('pix-admin-nonce')
		)
	);
}

add_action('admin_print_footer_scripts', 'construct_action_javascript', 99);
function construct_action_javascript() {
	?>
	  <script type='text/javascript'>
(function($) {
	jQuery('a.activation-theme').on("click", function(e) {
		if(!jQuery(this).data('activationtheme'))return;
		var $input = jQuery(this).siblings('input');
		var value = $input.val();

	    var str = JSON.stringify(value);
			var data = {
			action: 'theme_activation',
			code: value,
			nonce_code : pixAjax.nonce
		};
		$input.parent().parent().css('opacity', '0.6');
		jQuery.post( pixAjax.url, data, function(response) {
			$input.parent().parent().css('opacity', '1');
			if(response == 1){
				$input.parent().hide().siblings('p.activated').show();
			}else{
			}
			

		});
	});
	jQuery('a.delete_key').on("click", function(e) {
		if(!jQuery(this).data('key_activate'))return;
		var $input = jQuery(this).parent().find('.activation-input');
			var data = {
			action: 'delete_key_activation',
			nonce_code : pixAjax.nonce
		};
		jQuery.post( pixAjax.url, data, function(response) {
			if(response == 1){
				$input.val('');
				alert('<?php echo __('The key deactivated', 'farvis');  ?>');
			}else{
				alert('<?php echo __('Deactivate the key failed', 'farvis');  ?>');
			}
		});
	});
	jQuery('a.pix_hide_notice').on("click", function(e) {
		var $div = jQuery(this).closest('#pix_admin_notice');
			var data = {
			action: 'pix_hide_admin_notice',
			nonce_code : pixAjax.nonce
		};
		jQuery.post( pixAjax.url, data, function(response) {
			$div.detach();
			if(response == 1){
				
			}else{
			}
		});
	});
		jQuery('a.adm_notice_stblock').on("click", function(e) {
			
		var $div = jQuery(this).parent('#pix_admin_notice');
			var data = {
			action: 'pix_hide_notice_stblock',
			nonce_code : pixAjax.nonce
		};
		jQuery.post( pixAjax.url, data, function(response) {
			if(response == 1){
				
			}else{
			}
		});
	});

})(jQuery);
</script>

	<?php
}

