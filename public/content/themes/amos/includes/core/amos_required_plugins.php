<?php
require_once get_template_directory() . '/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'amos_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function amos_required_plugins() {

  /**
   * Array of plugin arrays. Required keys are name and slug.
   * If the source is NOT from the .org repo, then source is also required.
   */
  $plugins = array(


     // This is an example of how to include a plugin pre-packaged with a theme
    array(
      'name'            => 'Elle Custom Post Type', // The plugin name
      'slug'            => 'elle-custom-posts', // The plugin slug (typically the folder name)
      'source'          => get_stylesheet_directory() . '/plugins/elle-custom-posts.zip', // The plugin source
      'required'        => true, // If false, the plugin is only 'recommended' instead of required
      'version'         => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
      'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
      'force_deactivation'  => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
      'external_url'      => '', // If set, overrides default API URL and points to an external URL
    ),

    array(
      'name'            => 'Ellethemes Social Shares', // The plugin name
      'slug'            => 'elle-shares', // The plugin slug (typically the folder name)
      'source'          => get_stylesheet_directory() . '/plugins/elle-shares.zip', // The plugin source
      'required'        => true, // If false, the plugin is only 'recommended' instead of required
      'version'         => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
      'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
      'force_deactivation'  => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
      'external_url'      => '', // If set, overrides default API URL and points to an external URL
    ),


      array(
      'name'            => 'Elle Register Shortcodes', // The plugin name
      'slug'            => 'elle-shortcodes', // The plugin slug (typically the folder name)
      'source'          => get_stylesheet_directory() . '/plugins/elle-shortcodes.zip', // The plugin source
      'required'        => true, // If false, the plugin is only 'recommended' instead of required
      'version'         => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
      'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
      'force_deactivation'  => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
      'external_url'      => '', // If set, overrides default API URL and points to an external URL
    ),
 
      array(
      'name'            => 'Elle Post Likes', // The plugin name
      'slug'            => 'post-likes', // The plugin slug (typically the folder name)
      'source'          => get_stylesheet_directory() . '/plugins/post-likes.zip', // The plugin source
      'required'        => true, // If false, the plugin is only 'recommended' instead of required
      'version'         => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
      'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
      'force_deactivation'  => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
      'external_url'      => '', // If set, overrides default API URL and points to an external URL
    ),
 
       // This is an example of how to include a plugin pre-packaged with a theme
    array(
      'name'            => 'Templatera', // The plugin name
      'slug'            => 'templatera', // The plugin slug (typically the folder name)
      'source'          => get_stylesheet_directory() . '/plugins/templatera.zip', // The plugin source
      'required'        => false, // If false, the plugin is only 'recommended' instead of required
      'version'         => '1.1.11', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
      'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
      'force_deactivation'  => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
      'external_url'      => '', // If set, overrides default API URL and points to an external URL
    ),



    array(
        'name' => 'Envato Market',
        'slug' => 'envato-market',
        'source' => get_template_directory() . '/plugins/envato-market.zip',
        'required' => true,
        'version' => '2.0.0',
        'force_activation' => false,
        'force_deactivation' => false,
        'external_url' => '',
    ),
    
    array(
      'name'            => 'Revolution Slider', // The plugin name
      'slug'            => 'revslider', // The plugin slug (typically the folder name)
      'source'          => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
      'required'        => false, // If false, the plugin is only 'recommended' instead of required
      'version'         => '5.4.6.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
      'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
      'force_deactivation'  => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
      'external_url'      => '', // If set, overrides default API URL and points to an external URL
    ), 

    // This is an example of how to include a plugin from the WordPress Plugin Repository
    array(
      'name'    => 'WP Retina 2x',
      'slug'    => 'wp-retina-2x',
      'required'  => false,
    ),
    

     array(
            'name'      => 'WPBakery Visual Composer', // The plugin name
            'slug'      => 'js_composer', // The plugin slug (typically the folder name)
            'source'      => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
            'required'      => true, // If false, the plugin is only 'recommended' instead of required
            'version'     => '5.5.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'  => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'    => '', // If set, overrides default API URL and points to an external URL
        ),

     array(
            'name'      => 'Elle Framework', // The plugin name
            'slug'      => 'elle-framework', // The plugin slug (typically the folder name)
            'source'      => get_stylesheet_directory() . '/plugins/elle-framework.zip', // The plugin source
            'required'      => true, // If false, the plugin is only 'recommended' instead of required
            'version'     => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'  => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'    => '', // If set, overrides default API URL and points to an external URL
        ),

  array(
            'name'      => 'Contact Form 7', // The plugin name
            'slug'      => 'contact-form-7', // The plugin slug (typically the folder name)
            'required'      => true, // If false, the plugin is only 'recommended' instead of required
        ),




    array(
    'name'      => 'MailChimp List Subscribe Form',
    'slug'       => 'mailchimp',
    'required'  => false
    )
  );

  // Change this to your theme text domain, used for internationalising strings
 

  /**
   * Array of configuration settings. Amend each line as needed.
   * If you want the default strings to be available under your own theme domain,
   * leave the strings uncommented.
   * Some of the strings are added into a sprintf, so see the comments at the
   * end of each line for what each argument will be.
   */
  $config = array(
    'domain'          => 'amos',          // Text domain - likely want to be the same as your theme.
    'default_path'    => '',                          // Default absolute path to pre-packaged plugins
    'parent_slug'  => 'themes.php',        // Default parent menu slug
    'menu'            => 'install-required-plugins',  // Menu slug
    'has_notices'       => true,                        // Show admin notices or not
    'is_automatic'      => false,             // Automatically activate plugins after installation or not
    'message'       => '',              // Message to output right before the plugins table
    'strings'         => array(
      'page_title'                            => __( 'Install Required Plugins', 'amos' ),
      'menu_title'                            => __( 'Install Plugins', 'amos' ),
      'installing'                            => __( 'Installing Plugin: %s', 'amos' ), // %1$s = plugin name
      'oops'                                  => __( 'Something went wrong with the plugin API.', 'amos' ),
      'notice_can_install_required'           => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'amos' ), // %1$s = plugin name(s)
      'notice_can_install_recommended'      => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'amos' ), // %1$s = plugin name(s)
      'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'amos' ), // %1$s = plugin name(s)
      'notice_can_activate_required'          => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.',  'amos' ), // %1$s = plugin name(s)
      'notice_can_activate_recommended'     => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'amos' ), // %1$s = plugin name(s)
      'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'amos' ), // %1$s = plugin name(s)
      'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'amos' ), // %1$s = plugin name(s)
      'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'amos' ), // %1$s = plugin name(s)
      'install_link'                  => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'amos' ),
      'activate_link'                 => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'amos' ),
      'return'                                => __( 'Return to Required Plugins Installer', 'amos'),
      'plugin_activated'                      => __( 'Plugin activated successfully.', 'amos' ),
      'complete'                  => __( 'All plugins installed and activated successfully. %s', 'amos' ), // %1$s = dashboard link
      'nag_type'                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
    )
  );

  tgmpa( $plugins, $config );

}
?>