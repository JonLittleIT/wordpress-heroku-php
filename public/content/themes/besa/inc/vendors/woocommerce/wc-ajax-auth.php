<?php

if(!class_exists('WooCommerce')) return;

if ( !function_exists('besa_ajax_auth_init') ) {
    function besa_ajax_auth_init(){  
        $suffix = (besa_tbay_get_config('minified_js', false)) ? '.min' : BESA_MIN_JS;
        wp_register_script( 'jquery-validate', BESA_SCRIPTS . '/jquery.validate' . $suffix . '.js', array( ), '1.0', true );
        wp_register_script( 'besa-auth-script', BESA_SCRIPTS . '/ajax-auth-script' . $suffix . '.js', array( 'jquery-validate' ), '1.0', true );
        wp_enqueue_script('besa-auth-script');

        wp_localize_script( 'besa-auth-script', 'besa_ajax_auth_object', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'redirecturl' => home_url(),
            'loadingmessage' => esc_html__('Sending user info, please wait...', 'besa'),
            'validate'          => array( 
                'required'      => esc_html__('This field is required.', 'besa'),
                'remote'        => esc_html__('Please fix this field.', 'besa'),
                'email'         => esc_html__('Please enter a valid email address.', 'besa'),
                'url'           => esc_html__('Please enter a valid URL.', 'besa'),
                'date'          => esc_html__('Please enter a valid date.', 'besa'),
                'dateISO'       => esc_html__('Please enter a valid date (ISO).', 'besa'),
                'number'        => esc_html__('Please enter a valid number.', 'besa'),
                'digits'        => esc_html__('Please enter only digits.', 'besa'),
                'creditcard'    => esc_html__('Please enter a valid credit card number.', 'besa'),
                'equalTo'       => esc_html__('Please enter the same value again.', 'besa'),
                'accept'        => esc_html__('Please enter a value with a valid extension.', 'besa'),
                'maxlength'     => esc_html__('Please enter no more than {0} characters.', 'besa'),
                'minlength'     => esc_html__('Please enter at least {0} characters.', 'besa'),
                'rangelength'   => esc_html__('Please enter a value between {0} and {1} characters long.', 'besa'),
                'range'         => esc_html__('Please enter a value between {0} and {1}.', 'besa'),
                'max'           => esc_html__('Please enter a value less than or equal to {0}.', 'besa'),
                'min'           => esc_html__('Please enter a value greater than or equal to {0}.', 'besa'),
            ),
        ));

        // Enable the user with no privileges to run ajax_login() in AJAX
        add_action( 'wp_ajax_nopriv_ajaxlogin', 'besa_ajax_login' );
        // Enable the user with no privileges to run ajax_register() in AJAX
        add_action( 'wp_ajax_nopriv_ajaxregister', 'besa_ajax_register' );
    }
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'besa_ajax_auth_init');
}
 
if ( !function_exists('besa_ajax_login') ) { 
    function besa_ajax_login(){

        // First check the nonce, if it fails the function will break
        check_ajax_referer( 'ajax-login-nonce', 'security' );

        // Nonce is checked, get the POST data and sign user on
        // Call auth_user_login
        besa_auth_user_login($_POST['username'], $_POST['password'], $_POST['rememberme'], 'Login'); 
        
        die();
    }
}

if ( !function_exists('besa_ajax_register') ) { 
    function besa_ajax_register(){

        // First check the nonce, if it fails the function will break
        check_ajax_referer( 'ajax-register-nonce', 'security' );
            
        // Nonce is checked, get the POST data and sign user on
        $info = array();
        $info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($_POST['username']) ;
        $info['user_pass'] = sanitize_text_field($_POST['password']);
        $info['user_email'] = sanitize_email( $_POST['email']);
        $rememberme =  ( isset($_POST['remember']) ) ? $_POST['remember'] : '' ;

         if($rememberme == 'forever'){
            $remember = true;
            $info['remember'] = true;
         }else{
            $remember = false;
            $info['remember'] = false;
         }   
        
        // Register the user
        $user_register = wp_insert_user( $info );
        if ( is_wp_error($user_register) ){ 
            $error  = $user_register->get_error_codes() ;
            
            if(in_array('empty_user_login', $error))
                echo json_encode(array('loggedin'=>false, 'message'=>$user_register->get_error_message('empty_user_login') ));
            elseif(in_array('existing_user_login',$error))
                echo json_encode(array('loggedin'=>false, 'message'=> esc_html__('This username is already registered.', 'besa')));
            elseif(in_array('existing_user_email',$error))
            echo json_encode(array('loggedin'=>false, 'message'=> esc_html__('This email address is already registered.', 'besa')));
        } else {
          besa_auth_user_login($info['nickname'], $info['user_pass'], $info['remember'], 'Registration');       
        }

        die();
    }
}

if ( !function_exists('besa_auth_user_login') ) { 
    function besa_auth_user_login($user_login, $password, $remember, $login) {
        $info = array();
        $info['user_login'] = $user_login;
        $info['user_password'] = $password;

        $rememberme =  ( isset($_POST['remember']) ) ? $_POST['remember'] : '';
    
         if($rememberme == 'forever'){
            $remember = true;
            $info['remember'] = true;
         }else{
            $remember = false;
            $info['remember'] = false;
         }         
        // From false to '' since v 4.9
        $user_signon = wp_signon( $info, '' );
        if ( is_wp_error($user_signon) ){
            echo json_encode(array('loggedin'=>false, 'message'=> esc_html__('Wrong username or password.', 'besa')));
        } else {
            wp_set_current_user($user_signon->ID); 
            echo json_encode(array('loggedin'=>true, 'message'=> esc_html__('Login successful, redirecting...', 'besa')));
        }
        
        die();
    }
} 