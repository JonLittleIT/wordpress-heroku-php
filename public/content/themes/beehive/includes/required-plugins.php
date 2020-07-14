<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Beehive for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once BEEHIVE_INC . '/install-plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'beehive_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function beehive_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// Redux framwork.
		array(
			'name'               => 'Redux Framework', // The plugin name.
			'slug'               => 'redux-framework', // The plugin slug (typically the folder name).
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		// CMB2.
		array(
			'name'               => 'CMB2', // The plugin name.
			'slug'               => 'cmb2', // The plugin slug (typically the folder name).
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		// BuddyPress.
		array(
			'name'               => 'BuddyPress', // The plugin name.
			'slug'               => 'buddypress', // The plugin slug (typically the folder name).
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		// Elementor.
		array(
			'name'               => 'Elementor', // The plugin name.
			'slug'               => 'elementor', // The plugin slug (typically the folder name).
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		// RTmedia.
		array(
			'name'               => 'rtMedia', // The plugin name.
			'slug'               => 'buddypress-media', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		// WooCommerce.
		array(
			'name'               => 'WooCommerce', // The plugin name.
			'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		// Buddypcommerce.
		array(
			'name'               => 'BuddyCommerce', // The plugin name.
			'slug'               => 'buddycommerce', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		// WP Job Manager.
		array(
			'name'               => 'WP Job Manager', // The plugin name.
			'slug'               => 'wp-job-manager', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		// WPAdverts.
		array(
			'name'               => 'WPAdverts', // The plugin name.
			'slug'               => 'wpadverts', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		// BBpress.
		array(
			'name'               => 'bbPress', // The plugin name.
			'slug'               => 'bbpress', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		// Contact form 7.
		array(
			'name'               => 'Contact Form 7', // The plugin name.
			'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		// Envato Market.
		array(
			'name'               => 'Envato Market', // The plugin name.
			'slug'               => 'envato-market', // The plugin slug (typically the folder name).
			'source'             => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip', // The plugin source.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		// Buddychat.
		array(
			'name'               => 'BuddyChat', // The plugin name.
			'slug'               => 'buddy-chat', // The plugin slug (typically the folder name).
			'source'             => 'https://themified.com/beehive/bundle/buddy-chat.zip', // The plugin source.
			'version'            => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		// Beehive Widgets.
		array(
			'name'               => 'Beehive Widgets', // The plugin name.
			'slug'               => 'beehive-widgets', // The plugin slug (typically the folder name).
			'source'             => 'https://themified.com/beehive/bundle/beehive-widgets.zip', // The plugin source.
			'version'            => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		// Beehive Widgets.
		array(
			'name'               => 'Beehive Job Categories', // The plugin name.
			'slug'               => 'beehive-job-categories', // The plugin slug (typically the folder name).
			'source'             => 'https://themified.com/beehive/bundle/beehive-job-categories.zip', // The plugin source.
			'version'            => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		// One click demo import.
		array(
			'name'               => 'One Click Demo Import', // The plugin name.
			'slug'               => 'one-click-demo-import', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
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
		'id'           => 'beehive',               // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
