<?php
/**
 * Admin Page
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */

require_once(get_template_directory() .'/inc/backend/settings.php');
if( ! class_exists( 'bitther_Admin_Pages' ) ) {

    class bitther_Admin_Pages
    {

        // Construct ===================================================================================================
        function __construct()
        {

            add_action( 'register_sidebar',array( $this, 'bitther_theme_admin_init' ) );
            add_action( 'admin_menu',array( $this, 'bitther_theme_admin_menu' ) );
            add_action( 'admin_menu',array( $this, 'bitther_theme_admin_install' ) );
            add_action( 'admin_menu',array( $this, 'bitther_theme_admin_customize' ) );
            add_action( 'after_switch_theme',array( $this, 'bitther_theme_admin_redirect' ) );
            add_action( 'admin_enqueue_scripts',array( $this, 'bitther_theme_admin_scripts' ) );


        }

        // Admin init ==================================================================================================
        function bitther_theme_admin_init() {

            if ( isset( $_GET['nano-deactivate'] ) && $_GET['nano-deactivate'] == 'deactivate-plugin' ) {
                check_admin_referer( 'nano-deactivate', 'nano-deactivate-nonce' );
                if ( ! function_exists( 'get_plugins' ) ) {
                    require_once ABSPATH . 'wp-admin/includes/plugin.php';
                }
                $plugins = get_plugins();
                foreach ( $plugins as $plugin_name => $plugin ) {

                    if ( $plugin['Name'] == $_GET['plugin_name'] ) {
                        deactivate_plugins( $plugin_name );
                    }
                }
            }
            if ( isset( $_GET['nano-activate'] ) && $_GET['nano-activate'] == 'activate-plugin' ) {
                check_admin_referer( 'nano-activate', 'nano-activate-nonce' );
                if ( ! function_exists( 'get_plugins' ) ) {
                    require_once ABSPATH . 'wp-admin/includes/plugin.php';
                }
                $plugins = get_plugins();
                foreach ( $plugins as $plugin_name => $plugin ) {
                    if ( $plugin['Name'] == $_GET['plugin_name'] ) {
                        activate_plugin( $plugin_name );
                    }
                }
            }
        }

        // Menus =======================================================================================================
        //add menu Agency
        function bitther_theme_admin_menu()
        {
            $menu = 'add_menu_' . 'page';
            $menu(
                esc_html__( 'Bitther Tools ', 'bitther' ),
                esc_html__( 'Bitther Tools ', 'bitther' ),
                'manage_options',
                'bitther_theme',
                array( $this, 'bitther_theme_install' ),
                '',
                2
            );
        }
        //add subpage install
        function bitther_theme_admin_install() {
            $sub_menu = 'add_submenu_' . 'page';
            $sub_menu(
                'bitther_theme',
                esc_html__( 'Install', 'bitther' ),
                esc_html__( 'Install', 'bitther' ),
                'administrator',
                'bitther_theme',
                array( $this, 'bitther_theme_install' )
            );
        }
        //add subpage customize
        function bitther_theme_admin_customize() {
            $sub_menu = 'add_submenu_' . 'page';
            $sub_menu(
                'bitther_theme',
                esc_html__( 'Customize', 'bitther' ),
                esc_html__( 'Customize', 'bitther' ),
                'administrator',
                'customize.php',
                ''
            );
        }

        // Admin Redirect ==============================================================================================
        function bitther_theme_admin_redirect(){
            if ( current_user_can( 'edit_theme_options' ) ) {
                header('Location:'.admin_url().'admin.php?page=bitther_theme');
            }
        }

        // Enqueue_scripts =============================================================================================
        function bitther_theme_admin_scripts() {
            wp_enqueue_style("bitther_theme_admin_css",get_template_directory_uri() . "/inc/backend/assets/css/style.css",false, null, "all" );
            wp_enqueue_script("bitther_theme_demos_js", get_template_directory_uri() . "/inc/backend/assets/js/script.js",array(), false, null );
        }

        // Plugins links ===============================================================================================
        function bitther_theme_plugin_links( $item )
        {
            $installed_plugins = get_plugins();
            $item['sanitized_plugin'] = $item['name'];
            if ( ! $item['version'] ) {
                $item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $item['slug'] );
            }
            //install
            if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
                $actions = array(
                    'install' => sprintf(
                        '<a href="%1$s" class="button button-primary">'.esc_attr__('Install','bitther').'</a>',
                        esc_url( wp_nonce_url(
                            add_query_arg(
                                array(
                                    'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
                                    'plugin'        => urlencode( $item['slug'] ),
                                    'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
                                    'plugin_source' => urlencode( $item['source'] ),
                                    'tgmpa-install' => 'install-plugin',
                                ),
                                TGM_Plugin_Activation::$instance->get_tgmpa_url()
                            ),
                            'tgmpa-install',
                            'tgmpa-nonce'
                        ) ),
                        $item['sanitized_plugin']
                    ),
                );
            }
            //activate
            elseif ( is_plugin_inactive( $item['file_path'] ) ) {
                $actions = array(
                    'activate' => sprintf(
                        '<a href="%1$s" class="button button-primary">'.esc_attr__('Activate','bitther').'</a>',
                        esc_url( add_query_arg(
                            array(
                                'plugin'               => urlencode( $item['slug'] ),
                                'plugin_name'          => urlencode( $item['sanitized_plugin'] ),
                                'plugin_source'        => urlencode( $item['source'] ),
                                'nano-activate'       => 'activate-plugin',
                                'nano-activate-nonce' => wp_create_nonce( 'nano-activate' ),
                            ),
                            admin_url( 'admin.php?page=bitther_theme#plugins' )
                        ) ),
                        $item['sanitized_plugin']
                    ),
                );
            }
            //update
            elseif ( version_compare( $installed_plugins[$item['file_path']]['Version'], $item['version'], '<' ) ) {
                $actions = array(
                    'update' => sprintf(
                        '<a href="%1$s" class="button button-update" title="Install %2$s"><span class="dashicons dashicons-update"></span>'.esc_attr__('Update','bitther').'</a>',
                        wp_nonce_url(
                            add_query_arg(
                                array(
                                    'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
                                    'plugin'        => urlencode( $item['slug'] ),
                                    'tgmpa-update'  => 'update-plugin',
                                    'plugin_source' => urlencode( $item['source'] ),
                                    'version'       => urlencode( $item['version'] ),
                                ),
                                TGM_Plugin_Activation::$instance->get_tgmpa_url()
                            ),
                            'tgmpa-update',
                            'tgmpa-nonce'
                        ),
                        $item['sanitized_plugin']
                    ),
                );
            }
            elseif ( is_plugin_active( $item['file_path'] ) ) {
                $actions = array(
                    'deactivate' => sprintf(
                        '<a href="%1$s" class="button button-primary" title="Deactivate %2$s">'.esc_attr__('Deactivate','bitther').'</a>',
                        esc_url( add_query_arg(
                            array(
                                'plugin'                 => urlencode( $item['slug'] ),
                                'plugin_name'            => urlencode( $item['sanitized_plugin'] ),
                                'plugin_source'          => urlencode( $item['source'] ),
                                'nano-deactivate'       => 'deactivate-plugin',
                                'nano-deactivate-nonce' => wp_create_nonce( 'nano-deactivate' ),
                            ),
                            admin_url( 'admin.php?page=bitther_theme#plugins')
                        ) ),
                        $item['sanitized_plugin']
                    ),
                );
            }
            return $actions;
        }

        // Slug Pages ==================================================================================================
        function bitther_get_id_by_slug($page_slug) {
            $page = get_page_by_path($page_slug);
            if ($page) {
                return $page->ID;
            } else {
                return null;
            }
        }

        // Page back-end ===============================================================================================

        // Install
        function bitther_theme_install() {
            require_once(get_template_directory() .'/inc/backend/templates/install_theme.php' );
        }

        // Welcome =====================================================================================================
        function bitther_welcome_page(){
            require_once(get_template_directory() .'/inc/backend/templates/welcome_page.php' );
        }

        // Plugins =====================================================================================================
        function bitther_plugins_page(){
           require_once(get_template_directory() .'/inc/backend/templates/plugins_page.php' );
        }

        // Sample data =================================================================================================
        function bitther_sample_page(){
            global  $bitther_settings;
            $settings = $bitther_settings;
            require_once(get_template_directory() .'/inc/backend/templates/sample_page.php' );
        }

        // Support =====================================================================================================
        function bitther_support_page(){
             require_once(get_template_directory() .'/inc/backend/templates/support_page.php' );
        }
    }
    new bitther_Admin_Pages;

}

