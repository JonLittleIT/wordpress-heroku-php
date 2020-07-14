<?php
/**
 * ElitePack Theme Updater
 *
 * Version 1.0.0
 * Last Update: 02 Feb 2020
 */

/**
 * Access the object
 */
function bd_updater()
{

	global $bd_updater;

	if( ! isset( $bd_updater ) ){

		// Include ElitePack SDK.
		//include( dirname( __FILE__ ) . '/updater/ep-updater-admin-class.php' );
		require_once ( get_template_directory() . '/framework/admin/updater/ep-updater-admin-class.php' );

		// Loads the updater classes
		$bd_updater = new ElitePack_Theme_Updater_Admin(

		// Config settings
			$config = array(
				'api_url'          => 'https://www.bdaia.com/', // Site where Elitepack is hosted
				'item_id'          => '13570398', // Envato Item ID
				'name'             => 'Newspaper WooHoo', // Default wp_get_theme()->name
				'version'          => WOOHOO_THEME_VER, // The current version of installed item.
				'purchase_url'     => 'https://themeforest.net/item/i/13570398',
				// Theme
				'theme_folder'     => 'woohoo', // The theme slug (typically the folder name).
				// Plugin
				//'is_plugin'        => true,
				//'plugin_file'      => __FILE__,
				'capability'       => 'manage_options',
				//'redirect_url'     => add_query_arg( array( 'page' => 'bd-registration' ), admin_url( 'admin.php' ) ), // default admin_url()
				'notice_pages'     => false, //array( 'plugins', 'toplevel_page_arqam_lite' ), default false, show the notices everywhere
			),

			// Strings
			$strings = array(
				'purchase-license'            => esc_html__( 'Purchase a License', '@@textdomain' ),
				'renew-support'               => esc_html__( 'Renew Support', '@@textdomain' ),
				'need-help'                   => esc_html__( 'Need Help?', '@@textdomain' ),
				'try-again'                   => esc_html__( 'Try Again', '@@textdomain' ),
				'register-item'               => esc_html__( 'Register %s', '@@textdomain' ),
				'register-message'            => esc_html__( 'Thank you for choosing %s! Your product must be registered to import our awesome demos, install bundeled plugins, recive automatic updates and access to support.', '@@textdomain' ),
				'register-button'             => esc_html__( 'Register Now!', '@@textdomain' ),
				'register-success-title'      => esc_html__( 'Congratulations', '@@textdomain' ),
				'register-success-text'       => esc_html__( 'Your License is now registerd!, Demo import and bundeled plugins are now unlocked.', '@@textdomain' ),
				'api-error'                   => esc_html__( 'An error occurred, please try again.', '@@textdomain' ),
				'inline-register-item-notice' => esc_html__( 'Register the theme to unlock automatic updates.', '@@textdomain' ),
				'inline-renew-support-notice' => esc_html__( 'Renew your support to unlock automatic updates.', '@@textdomain' ),
				'date-at-time'                => esc_html__( '%1$s at %2$s', '@@textdomain' ),
				'support-expiring-notice'     => esc_html__( 'Your support will Expire in %s. Renew your license today and save 25%% to keep getting auto updates and premium support, remember purchasing a new license extends support for all licenses. ', '@@textdomain' ),
				'support-update-failed'       => esc_html__( 'Failed, try again later.', '@@textdomain' ),
				'support-not-updated'         => esc_html__( 'Did not updated, Your support expires on %s', '@@textdomain' ),
				'support-updated'             => esc_html__( 'Updated successfully, your support expires on %s', '@@textdomain' ),
				/* translators: 1: Item name, 2: Link tag start <a>, 3: Version number, 4: Link tag end </a> */
				'update-available'            => esc_html__( 'There is a new version of %1$s available, %2$sView version %3$s details%4$s.', '@@textdomain' ),
				'update-now'                  => esc_html__( 'update now', '@@textdomain' ),
				'revoke-license-success'      => esc_html__( 'License Deactivated Succefuly.', '@@textdomain' ),
				'cancel'                      => esc_html__( 'Cancel', '@@textdomain' ),
				'skip'                        => esc_html__( 'Skip & Switch', '@@textdomain' ),
				'send'                        => esc_html__( 'Send & Switch', '@@textdomain' ),
				'feedback'                    => esc_html__( '%s feedback', '@@textdomain' ),
				'deactivation-share-reason'   => esc_html__( 'May we have a little info about why you are switching?', '@@textdomain' ),
			)
		);
	}

	return $bd_updater;
}


bd_updater();


/**
 * Disable the notices in the Registeration page
 */
add_filter( 'bd/notice/show', 'bd_updater_notices', 10, 2 );
function bd_updater_notices( $status, $id ){

	if( get_current_screen()->id == 'theme-options_page_bd-registration' ){
		if( $id == 'bd-activated' || $id == 'woohoo-activation-notice' ){
			return false;
		}
	}

	return $status;
}


/**
 * Add the Registeration custom page
 */
add_action( 'admin_menu', 'bd_registeration_menu' );
function bd_registeration_menu() {
	add_submenu_page( 'bdaia_welcome', 'Registration', 'Registration', 'manage_options', 'bd-registration', 'bd_registeration_page' );
}


/**
 * The registeration page content
 */
function bd_registeration_page(){

	if ( bd_updater()->is_active() ) {
		$intro = esc_html__( 'Thank you for choosing Woohoo! Your product is already registered, so you have access to the Woohoo demos, auto theme updates and included premium plugins.', 'woohoo' );
		$title = esc_html__( 'Congratulations! Your product is registered now.', 'woohoo' );
		$icon  = 'yes';
		$class = 'is-registered';
	}
	else{
		$intro = esc_html__( 'Thank you for choosing Woohoo! Your product must be registered to import our awesome demos, install premium plugins, recive automatic updates and access to support.', 'woohoo' );
		$title = esc_html__( 'Click on the button below to begin the registration process.', 'woohoo' );
		$icon  = 'no';
		$class = 'not-registered';
	}
	?>
    <style type="text/css">

        #wpbody-content{
            background: transparent !important;
        }

        .notice:not(.bd-notice){
            display: none;
        }

        h1.bd-dash-heading-secondary{
            margin-top: 0;
        }

        #bd-library_product_registration h2{
            line-height: 30px;
        }

        #bd-library_product_registration hr{
            margin: 30px 0 10px;
        }

        #bd-library_product_registration.not-registered h2{
            margin-bottom: 20px !important;
        }

        .is-registered .dashicons{
            color: green;
        }

        .not-registered .dashicons{
            color: red;
        }

        #bd-library_product_registration .library-icon-key{
            font-size: 30px;
            width: 30px;
            height: 30px;
        }

        .bd-support-status{
            width: 50%;
            float: left;
        }

        .bd-support-status span{
            font-weight: bold;
            font-size: 14px;
            line-height: 30px
        }

        .bd-support-status-expiring span{
            color: orange;
        }

        .bd-support-status-active span{
            color: green;
        }

        .bd-support-status-expired span{
            color: red;
        }

        .bd-support-status .button{
            margin: 0 5px;
        }


        .bd-install-demos,
        .bd-registration {
            background: #FCFCFC;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility; }
        .bd-install-demos .dashicons.dashicons-admin-network.library-icon-key,
        .bd-registration .dashicons.dashicons-admin-network.library-icon-key {
            line-height: 30px;
            height: 30px;
            margin-right: 10px;
            width: 30px; }
        .bd-install-demos .bd-library_product_registration #bd-library_product_registration,
        .bd-registration .bd-library_product_registration #bd-library_product_registration {
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            -webkit-align-items: center;
            -ms-align-items: center;
            align-items: center; }
        .bd-install-demos .bd-library_product_registration #bd-library_product_registration p.submit,
        .bd-registration .bd-library_product_registration #bd-library_product_registration p.submit {
            margin: 0;
            padding: 0; }
        .bd-install-demos .bd-library_product_registration #bd-library_product_registration .dashicons,
        .bd-registration .bd-library_product_registration #bd-library_product_registration .dashicons {
            margin: 0;
            color: #333333;
            width: 30px; }
        .bd-install-demos .bd-library_product_registration #bd-library_product_registration .dashicons-yes,
        .bd-registration .bd-library_product_registration #bd-library_product_registration .dashicons-yes {
            color: #43A047; }
        .bd-install-demos .bd-library_product_registration #bd-library_product_registration .dashicons-no,
        .bd-registration .bd-library_product_registration #bd-library_product_registration .dashicons-no {
            color: #c00; }
        .bd-install-demos .bd-library_product_registration input[type="text"],
        .bd-install-demos .bd-library_product_registration input#submit,
        .bd-registration .bd-library_product_registration input[type="text"],
        .bd-registration .bd-library_product_registration input#submit {
            margin: 0 1em;
            padding: 10px 15px;
            width: calc(100% - 2em - 180px);
            height: 40px; }
        .bd-install-demos .bd-library_product_registration .dashicons,
        .bd-registration .bd-library_product_registration .dashicons {
            display: block;
            float: left;
            width: 46px;
            height: 32px;
            line-height: 32px;
            font-size: 36px;
            text-align: left; }
        .bd-install-demos .bd-library_product_registration input#submit,
        .bd-registration .bd-library_product_registration input#submit {
            margin: 0;
            width: 150px;
            line-height: 1; }
        .bd-install-demos .bd-library_product_registration p.error-invalid-token,
        .bd-registration .bd-library_product_registration p.error-invalid-token {
            margin: 1em 0 0 0;
            padding: 1em;
            color: #fff;
            background-color: #c00;
            text-align: center; }
        .bd-install-demos, .bd-install-demos *,
        .bd-registration,
        .bd-registration * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box; }
        .bd-install-demos audio, .bd-install-demos canvas, .bd-install-demos img, .bd-install-demos video,
        .bd-registration audio,
        .bd-registration canvas,
        .bd-registration img,
        .bd-registration video {
            max-width: 100%;
            height: auto;
            box-sizing: border-box; }
        .bd-install-demos audio, .bd-install-demos canvas, .bd-install-demos iframe, .bd-install-demos img, .bd-install-demos svg, .bd-install-demos video,
        .bd-registration audio,
        .bd-registration canvas,
        .bd-registration iframe,
        .bd-registration img,
        .bd-registration svg,
        .bd-registration video {
            vertical-align: middle; }
        .bd-install-demos a,
        .bd-registration a {
            touch-action: manipulation;
            color: #1e87f0;
            text-decoration: none;
            cursor: pointer; }
        .bd-install-demos #wpcontent,
        .bd-registration #wpcontent {
            padding: 0;
            font-weight: 300; }
        .bd-install-demos #wpbody-content,
        .bd-registration #wpbody-content {
            padding: 0; }
        .bd-install-demos #wpfooter,
        .bd-registration #wpfooter {
            bottom: 20px;
            padding: 10px 40px;
            color: #aaa; }
        .bd-install-demos .bd-demos-container,
        .bd-registration .bd-demos-container {
            background: #FFF;
            padding: 20px;
            margin: 0 auto; }
        @media (min-width: 900px) {
            .bd-install-demos .bd-demos-container,
            .bd-registration .bd-demos-container {
                padding: 40px;
                margin: 0 auto; } }
        .bd-install-demos .uninstall-demo,
        .bd-registration .uninstall-demo {
            display: none; }

        .bd-dash-container-medium {
            max-width: 1360px; }

        .bd-dash-container {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto; }

        .bd-dash-row {
            margin-left: -15px;
            margin-right: -15px; }
        @media (min-width: 1200px) {
            .bd-dash-row {
                margin-left: -20px;
                margin-right: -20px; } }

        .bd-dash-col4 {
            float: left;
            padding-left: 15px;
            padding-right: 15px; }
        @media (min-width: 960px) {
            .bd-dash-col4 {
                padding-left: 20px;
                padding-right: 20px; } }

        .bd-dash-col4 {
            width: 100%;
            margin-bottom: 60px; }
        @media (min-width: 900px) {
            .bd-dash-col4 {
                width: 50%; } }
        @media (min-width: 1200px) {
            .bd-dash-col4 {
                width: 33.33333333%; } }

        .bd-dash-grid {
            display: flex;
            flex-wrap: wrap;
            list-style: none; }

        .bd-dash-thumb-card {
            display: inline-block;
            position: relative;
            max-width: 100%;
            vertical-align: middle;
            box-shadow: 3px 5px 30px 0 rgba(0, 0, 0, 0.15);
            -webkit-transition: .25s ease-out;
            transition: .25s ease-out;
            overflow: hidden;
            border-radius: 6px; }
        .bd-dash-thumb-card .bdaia-demo-image-frame {
            display: block;
            padding-top: 24px;
            position: relative;
            background-color: #e9e9e9;
            -webkit-transition: .25s ease-out;
            transition: .25s ease-out; }
        .bd-dash-thumb-card .bdaia-demo-image-frame::before {
            display: block;
            width: 6px;
            height: 6px;
            position: absolute;
            z-index: 1;
            left: 10px;
            right: auto;
            top: 8px;
            content: "";
            border-radius: 50%;
            box-shadow: 10px 0 0 #fff, 20px 0 0 #fff;
            background-color: #fff; }
        .bd-dash-thumb-card:hover {
            -webkit-transition: .25s ease-out;
            transition: .25s ease-out;
            box-shadow: 0 30px 65px rgba(0, 0, 0, 0.12); }

        .bd-dash-pos-cover {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.75); }

        .bd-dash-overlay {
            padding: 30px 30px; }

        .bd-dash-transition-fade {
            -webkit-transition: .25s ease-out;
            transition: .25s ease-out; }

        .bd-dash-transition-fade {
            opacity: 0; }

        .bd-dash-transition-toggle:hover .bd-dash-transition-fade {
            opacity: 1; }

        .bd-dash-pos-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: table;
            width: -moz-max-content;
            max-width: 100%;
            box-sizing: border-box; }

        .bd-dash-text-center {
            text-align: center !important; }

        .bd-dash-button,
        a.bd-dash-button {
            margin: 0 !important;
            border: none !important;
            overflow: visible !important;
            font: inherit !important;
            color: inherit !important;
            display: inline-block !important;
            box-sizing: border-box !important;
            padding: 0 35px !important;
            vertical-align: middle !important;
            font-size: 15px !important;
            line-height: 40px !important;
            text-align: center !important;
            text-decoration: none !important;
            text-transform: none !important;
            transition: .1s ease-in-out !important;
            transition-property: color,background-color,border-color !important;
            border-radius: 2px !important;
            min-width: 140px !important;
        }
        .bd-dash-button:not(:disabled),
        a.bd-dash-button:not(:disabled) {
            cursor: pointer !important;
        }

        .bd-dash-button-default,
        a.bd-dash-button-default {
            background-color: #fff !important;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08) !important;
            color: #555 !important;
        }
        .bd-dash-button-default:hover,
        .bd-dash-button-default:focus,
        a.bd-dash-button-default:hover,
        a.bd-dash-button-default:focus {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
            color: #333 !important;
        }

        .bd-dash-button-primary,
        a.bd-dash-button-primary {
            background-color: #e33a2c !important;
            color: #fff !important;
            border: 1px solid transparent;
        }
        .bd-dash-button-primary:hover,
        .bd-dash-button-primary:focus,
        a.bd-dash-button-primary:hover,
        a.bd-dash-button-primary:focus {
            background-color: #000001 !important;
            color: #fff !important;
        }

        .bd-dash-button-red,
        a.bd-dash-button-red {
            background-color: #DE1400 !important;
            color: #fff !important;
            border: 1px solid transparent !important;
        }
        .bd-dash-button-red:not(.uk-button-small),
        a.bd-dash-button-red:not(.uk-button-small) {
            min-width: 140px !important;
        }
        .bd-dash-button-red:hover, .bd-dash-button-red:focus,
        a.bd-dash-button-red:hover,
        a.bd-dash-button-red:focus {
            background-color: #ac0f00 !important;
            color: #fff !important;
        }

        .bd-dash-button-F9C100,
        a.bd-dash-button-F9C100 {
            background-color: #F9C100 !important;
            color: #fff !important;
            border: 1px solid transparent !important;
        }
        .bd-dash-button-F9C100:not(.uk-button-small),
        a.bd-dash-button-F9C100:not(.uk-button-small) {
            min-width: 140px !important;
        }
        .bd-dash-button-F9C100:hover, .bd-dash-button-F9C100:focus,
        a.bd-dash-button-F9C100:hover,
        a.bd-dash-button-F9C100:focus {
            background-color: #f99c21 !important;
            color: #fff !important;
        }

        .bd-dash-margin-remove {
            margin: 0 !important; }

        .bd-dash-text-lead {
            font-size: 16px;
            line-height: 1.5;
            font-weight: 300;
            color: #555; }

        .bd-dash-heading-secondary {
            font-weight: 300; }
        @media (min-width: 960px) {
            .bd-dash-heading-secondary {
                font-size: 42px;
                line-height: 1.3; } }

        .bd-dash-text-color-828282 {
            color: #828282; }

        .bd-dash-margin-bottom {
            margin-bottom: 24px !important; }

        @media (min-width: 900px) {
            .bd-dash-margin-bottom {
                margin-bottom: 40px !important; } }

        .bd-dash-margin-bottom-0 {
            margin-bottom: 0 !important; }

        .bd-dash-margin-top {
            margin-top: 24px !important; }

        @media (min-width: 900px) {
            .bd-dash-margin-top {
                margin-top: 40px !important; } }

        .bd-dash-margin-top-0 {
            margin-top: 0 !important; }

        .bd-dash-box {
            padding: 26px;
            background: #FFF;
            border-radius: 8px;
            box-shadow: 3px 5px 30px 0 rgba(0, 0, 0, 0.15);
            transition: all 0.3s cubic-bezier(0.2, 0.5, 0.3, 1);
            border: 1px solid rgba(0, 0, 0, 0.1);
            color: #828282; }

        ul.bd-dash-list1 {
            padding: 0;
            margin: 0;
            color: #828282; }
        ul.bd-dash-list1 li {
            list-style: none !important;
            padding-left: 25px;
            line-height: 25px; }
        ul.bd-dash-list1 li::before {
            margin-left: -25px;
            font-family: "dashicons";
            float: left;
            content: "\f147";
            color: #1e87f0; }
        ul.bd-dash-list1 li:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: 0 none; }

        .bdaia-modal-outer .bd-dash-box {
            border-radius: 0; }

        .page_loading {
            display: none;
            background: #053d4e;
            overflow: hidden;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom right, rgba(6, 0, 255, 0.3), rgba(255, 0, 0, 0.3)); }

        .page_loading .success {
            display: none; }

        .page_loading .success h1 {
            color: #fff;
            text-align: center;
            line-height: 50px;
            margin-top: 80px !important; }

        .page_loading .success h4 {
            color: #fff;
            text-align: center;
            margin-top: 20px !important; }

        .page_loading .container {
            position: absolute;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            width: 100%; }

        .page_loading .right {
            float: left;
            color: #FFF;
            width: 50%;
            text-align: right; }

        .page_loading .left {
            float: left;
            color: #7a7a7a;
            width: 50%;
            text-align: right;
            -moz-transform: scale(-1, 1);
            -webkit-transform: scale(-1, 1);
            -o-transform: scale(-1, 1);
            -ms-transform: scale(-1, 1);
            transform: scale(-1, 1);
            margin-top: 40px; }

        .page_loading h1,
        .page_loading h4 {
            -webkit-transition: opacity .25s;
            -moz-transition: opacity .25s;
            -o-transition: opacity .25s;
            -ms-transition: opacity .25s;
            transition: opacity .25s;
            font-family: "FARCRY", Verdana, Tahoma; }

        .page_loading h1 {
            font-size: 6vw; }

        .page_loading h4 {
            font-size: 3vw; }

        .page_loading h4:first-child {
            margin-bottom: -2vw; }

        .page_loading h4:last-child {
            margin-top: -1.7vw; }

        .bd-page-overlay {
            cursor: zoom-out;
            background: #000000;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9990;
            opacity: 0;
            transition: opacity 0.2s; }

        body.has-page-overlay {
            overflow: hidden; }
        body.has-page-overlay .bd-page-overlay {
            bottom: 0;
            opacity: 0.6; }

        .bd-overlay-box {
            display: none; }

        .bd-dash-alert-color {
            display: inline-block;
            background: #fde8d8;
            color: #cc5d5d;
            padding: 0 10px;
            font-style: italic;
            cursor: unset;
            border-radius: 2px;
            margin: 0 4px; }

        .important-notice {
            padding: 30px;
            background: #fff;
            margin: 0 0 30px; }

        #recommended-plugins td {
            padding: 15px; }

        #recommended-plugins .plugin-name {
            width: 220px; }

    </style>

    <div id="bd-library_product_registration" class="bd-demos-container <?php echo $class ?>">
        <div class="bd-dash-container bd-dash-container-medium">

            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            
            <h1 class="bd-dash-heading-secondary"><?php echo esc_html__( 'Welcome to', 'woohoo' ). ' '. WOOHOO_THEME_NAME. '!'; ?></h1>

            <div class="bd-dash-box bd-dash-margin-bottom clear">
                <h2 class="bd-dash-margin-remove"><span class="dashicons dashicons-<?php echo esc_attr( $icon ); ?> library-icon-key"></span> <?php echo $title; ?></h2>
                <p class="bd-dash-text-lead"><?php echo $intro; ?></p>

				<?php if ( ! bd_updater()->is_active() ) { ?>
                    <div class="bd-library_product_registration">
                        <a href="<?php echo bd_updater()->activate_link(); ?>" class="bd-dash-button bd-dash-button-primary"><?php esc_html_e( 'Register Now!' , 'woohoo' ); ?></a>
                        <a href="<?php echo bd_updater()->purchase_url(); ?>" class="bd-dash-button" target="_blank"><?php esc_html_e( 'Purchase a License' , 'woohoo' ); ?></a>
                    </div>
					<?php

				}
				else{

					echo '<hr />';

					?>
                    <div class="bd-support-status bd-support-status-active">
						<?php esc_html_e( 'License Status:', 'woohoo' ); ?> <span><?php esc_html_e( 'Active', 'woohoo' ) ?></span>
                        <a class="button" href="<?php echo bd_updater()->deactivate_license_link() ?>"><?php esc_html_e( 'Revoke License', 'woohoo' ) ?></a>
                    </div>
					<?php

					$support_info = bd_updater()->support_period_info();

					if( ! empty( $support_info['status'] ) ){

						switch ( $support_info['status'] ) {

							case 'expiring':
								$support_message = sprintf( esc_html__( 'Expiring! will expire on %s', 'woohoo' ), $support_info['date'] );
								break;

							case 'active':
								$support_message = esc_html__( 'Active', 'woohoo' );
								break;

							default:
								$support_message = esc_html__( 'Expired', 'woohoo' );
								break;
						}
					}

					if( ! empty( $support_message ) ){
						?>
                        <div class="bd-support-status bd-support-status-<?php echo $support_info['status'] ?>">
							<?php esc_html_e( 'Support Status:', 'woohoo' ); ?> <span><?php echo $support_message ?></span>
                            <a class="button" href="<?php echo bd_updater()->refresh_support_expiration_link() ?>"><?php esc_html_e( 'Refresh Expiration Date', 'woohoo' ) ?></a>
                        </div>
						<?php
					}
				}
				?>

            </div>

        </div><!-- .bd-dash-container -->
    </div><!-- .bd-demos-container -->
	<?php
}
