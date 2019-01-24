<?php
/**
 * Config
 *
 * @package WordPress
 * @subpackage seed_cspv5
 * @since 0.1.0
 */

/**
 * Config Settings
 */
function seed_cspv5_get_options(){

    /**
     * Create new menus
     */

    $seed_cspv5_options[ ] = array(
        "type" => "menu",
        "menu_type" => "add_options_page",
        "page_name" => __( "Coming Soon", 'seedprod-coming-soon-pro' ),
        "menu_slug" => "seed_cspv5",
        "layout" => "2-col"
    );

    /**
     * Settings Tab
     */
    $seed_cspv5_options[ ] = array(
        "type" => "tab",
        "id" => "seed_cspv5_setting",
        "label" => __( "Coming Soon & Maintenance Page", 'seedprod-coming-soon-pro' ),
        "icon" => 'fa fa-clock-o',
    );

    $seed_cspv5_options[ ] = array(
        "type" => "setting",
        "id" => "seed_cspv5_settings_content",
    );

    $seed_cspv5_options[ ] = array(
        "type" => "section",
        "id" => "seed_cspv5_section_general",
        "label" => __( "General Settings", 'seedprod-coming-soon-pro' ),
        "icon" => 'fa fa-cogs',
    );

    $seed_cspv5_options[ ] = array(
        "type" => "custom_status",
        "id" => "status",
        "label" => __( "Status", 'seedprod-coming-soon-pro' ),
        "option_values" => array(
            '0' => __( 'Disabled', 'seedprod-coming-soon-pro' ),
            '1' => __( 'Enable Coming Soon Mode', 'seedprod-coming-soon-pro' ),
            '2' => __( 'Enable Maintenance Mode', 'seedprod-coming-soon-pro' ),
            '3' => __( 'Enable Redirect Mode', 'seedprod-coming-soon-pro' )
        ),
        "desc" => __( "<span class='highlight'>When you are logged in you'll see your normal website. Logged out visitors will see the Coming Soon or Maintenance page.</span><br><strong>Coming Soon Mode</strong> will be available to search engines if your site is not private in WordPress.<br><strong>Maintenance Mode</strong> will notify search engines that the site is unavailable. <br><strong>Redirect Mode</strong> will redirect traffic to the designated url.", 'seedprod-coming-soon-pro' ),
        "default_value" => "0"
    );
    
    $seed_cspv5_options[ ] = array(
        "type" => "custom_editpage",
        "id" => "edit_page",
        "label" => __( "", 'seedprod-coming-soon-pro' ),

    );




   
    // Scripts
    $seed_cspv5_options[ ] = array(
        "type" => "section",
        "id" => "seed_cspv5_section_scripts",
        "label" => __( "Advanced Settings", 'seedprod-coming-soon-pro' ),
        "icon" => 'fa fa-code',
    );



    $seed_cspv5_options[ ] = array(
        "type" => "checkbox",
        "id" => "disable_default_excluded_urls",
        "label" => __( "Disable Default Excluded URLs", 'seedprod-coming-soon-pro' ),
        "desc" => __("By default we exclude urls with the terms: login, admin, dashboard and account to prevent lockouts. Check to disable.", 'seedprod-coming-soon-pro'),
        "option_values" => array(
             '1' => __( 'Disable', 'seedprod-coming-soon-pro' ),
        ),
        "default" => "1",
    );

    $seed_cspv5_options[ ] = array(
        "type" => "radio",
        "id" => "include_exclude_options",
        "label" => __( "Include/Exclude URLs", 'seedprod-coming-soon-pro' ),
        "desc" => __("By default the Coming Soon/Maintenance page is shown on every page. Use the <strong>'Show on the Home Page Only'</strong> option to only show on the home page. Alternatively Include or Exclude URLs.", 'seedprod-coming-soon-pro'),
        "option_values" => array(
             '0' => __( 'Show on Coming Soon/Maintenance Page on the Entire Site', 'seedprod-coming-soon-pro' ),
             '1' => __( 'Show on the Home Page Only', 'seedprod-coming-soon-pro' ),
             '2' => __( 'Include URLs', 'seedprod-coming-soon-pro' ),
             '3' => __( 'Exclude URLs', 'seedprod-coming-soon-pro' ),
        ),
    );


    $seed_cspv5_options[ ] = array(
        'id'        => 'include_url_pattern',
        'type'      => 'textarea',
        'label'     => __( "Include URLs", 'seedprod' ),
        'desc'  => __( 'Include certain urls to display the Coming Soon or Maintenance Page. One per line. You may also enter a page or post id.', 'seedprod' ),
        'class' => 'large-text'
    );

    $seed_cspv5_options[ ] = array(
        'id'        => 'exclude_url_pattern',
        'type'      => 'textarea',
        'label'     => __( "Exclude URLs", 'seedprod' ),
        'desc'  => __( 'Exclude certain urls from displaying the Coming Soon or Maintenance Page. One per line. You may also enter a page or post id.', 'seedprod' ),
        'class' => 'large-text'
    );

    // Scripts
    $seed_cspv5_options[ ] = array(
        "type" => "section",
        "id" => "seed_cspv5_section_access",
        "label" => __( "Access Controls", 'seedprod-coming-soon-pro' ),
        "icon" => 'fa fa-lock',
    );
    $seed_cspv5_options[ ] = array(
        'id'        => 'client_view_url',
        'type'      => 'custom_clientview',
        'label'     => __( "Bypass URL", 'seedprod' ),
    );
    
    $seed_cspv5_options[ ] = array(
        'id'        => 'bypass_expires',
        'type'      => 'textbox',
        'label'     => __( "Bypass Expires", 'seedprod' ),
        'desc'  => __( 'Leave blank to use the default which is 2 days. Set how long the user has access in seconds. ', 'seedprod' ),
    );


    $seed_cspv5_options[ ] = array(
        "type" => "checkbox",
        "id" => "alt_bypass",
        "label" => __( "Use Cookies for Bypass", 'seedprod-coming-soon-pro' ),
        "desc" => __("Use cookies instead of creating a WordPress user for the bypass. Note: this may not work on sites that are cached. <a href='http://support.seedprod.com/article/99-how-the-bypass-url-works' target='_blank'>Learn More</a>", 'seedprod-coming-soon-pro'),
        "option_values" => array(
             '1' => __( 'Enable', 'seedprod-coming-soon-pro' ),
        ),
        "default" => "1",
    );
    
    $seed_cspv5_options[ ] = array(
        'id'        => 'ip_access',
        'type'      => 'textarea',
        'label'     => __( "Access by IP", 'seedprod' ),
        'desc'  => __( "All visitors from certain IP's to bypass the Coming Soon page. Put each IP on it's own line. Your current IP is: ", 'seedprod' ). seed_cspv5_get_ip(),
    );
    
    
    $seed_cspv5_options[ ] = array(
        'id'        => 'include_roles',
        'type'      => 'multiselect',
        'option_values' => array('anyone' => "Anyone Logged In") + seed_cspv5_get_roles(),
        'label'     => __( "Access by Role", 'seedprod' ),
        'desc'  => __( 'By default anyone logged in will see the regular site and not the coming soon page. To override this select Roles that will be given access to see the regular site.', 'seedprod' ),
    );
    




    
    
    /**
     * Pages Tab
     */
    if(seed_cspv5_cu('lp')){
    $seed_cspv5_options[ ] = array(
        "type" => "tab",
        "id" => "seed_cspv5_tab_pages",
        "label" => __( "Landing Pages", 'seedprod-coming-soon-pro' ),
        "icon" => 'fa fa-file-o'
    );
    }
    
    /**
     * Subscribers Tab
     */
    
    $seed_cspv5_options[ ] = array(
        "type" => "tab",
        "id" => "seed_cspv5_tab_subscribers",
        "label" => __( "Subscribers", 'seedprod-coming-soon-pro' ),
        "icon" => 'fa fa-users',
    );


    return $seed_cspv5_options;

}
