<?php
$theme            = wp_get_theme( 'ekommart' );
$ekommart_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}
require 'inc/class-tgm-plugin-activation.php';
$ekommart = (object) array(
	'version' => $ekommart_version,
	/**
	 * Initialize all the things.
	 */
	'main'    => require 'inc/class-main.php',
);

require 'inc/functions.php';
require 'inc/template-hooks.php';
require 'inc/template-functions.php';

require_once 'inc/merlin/vendor/autoload.php';
require_once 'inc/merlin/class-merlin.php';
require_once 'inc/merlin-config.php';

$ekommart->options = require 'inc/options/class-options.php';

if ( ekommart_is_woocommerce_activated() ) {
	$ekommart->woocommerce = require 'inc/woocommerce/class-woocommerce.php';

	require 'inc/woocommerce/class-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/woocommerce-functions.php';
	require 'inc/woocommerce/woocommerce-template-functions.php';
	require 'inc/woocommerce/woocommerce-template-hooks.php';
	require 'inc/woocommerce/template-hooks.php';
	require 'inc/woocommerce/class-woocommerce-size-chart.php';
	require 'inc/woocommerce/class-woocommerce-extra.php';

    if (class_exists('WeDevs_Dokan')) {
        require 'inc/dokan/class-dokan.php';
        require 'inc/dokan/dokan-template-functions.php';
        require 'inc/dokan/dokan-template-hooks.php';
    }
}

if ( ekommart_is_elementor_activated() ) {
	require 'inc/elementor/functions-elementor.php';
	$ekommart->elementor = require 'inc/elementor/class-elementor.php';
	$ekommart->megamenu  = require 'inc/megamenu/megamenu.php';

	if ( ekommart_get_theme_option( 'enable-footer-builder', false ) ) {
		require 'inc/builder/class-footer-builder.php';
	}

	require 'inc/elementor/class-elementor-pro.php';
}

if ( ! is_user_logged_in() ) {
	require 'inc/modules/class-login.php';
}

if ( is_admin() ) {
	$ekommart->admin = require 'inc/admin/class-admin.php';
}
