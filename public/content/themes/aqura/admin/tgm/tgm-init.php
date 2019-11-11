<?php /* Including TGM. */

// Including TGM class.
require get_template_directory() . '/admin/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'aqura_register_required_plugins' );

function aqura_register_required_plugins() {

	$plugins = array(

		array(
			'name'      => esc_html__('Redux Framework','aqura'),
			'slug'      => 'redux-framework',
			'required'  => true,
		),

		array(
			'name'      => esc_html__('MetaBox','aqura'),
			'slug'      => 'meta-box',
			'required'  => true,
		),

		array(
			'name' 	   	=> esc_html__('oAuth Twitter','aqura'),
			'slug' 	   	=> 'oauth-twitter-feed-for-developers',
			'required' 	=> true,
		),

		array(
			'name' 	   	=> esc_html__('WooCommerce','aqura'),
			'slug' 	   	=> 'woocommerce',
			'required' 	=> true,
		),

		array(
			'name' 	   	=> esc_html__('Contact Form 7','aqura'),
			'slug' 	   	=> 'contact-form-7',
			'required' 	=> true,
		),

		array(
			'name'     	=> esc_html__('WPBakery Page Builder','aqura'),
			'slug'     	=> 'vc_composer',
			'source'   	=> get_template_directory() . '/admin/plugins/js_composer.zip',
			'required' 	=> true,
		),

		array(
			'name'     	=> esc_html__('AQURA Plugins Core','aqura'),
			'slug'     	=> 'aqura-plugins-core',
			'source'   	=> get_template_directory() . '/admin/plugins/aqura-plugins-core.zip',
			'required' 	=> true,
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'aqura',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}
