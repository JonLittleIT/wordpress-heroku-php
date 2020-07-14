<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('OTF_Dokan')) :
    class OTF_Dokan {
        static $instance;

        public static function getInstance() {
            if (!isset(self::$instance) && !(self::$instance instanceof OTF_Dokan)) {
                self::$instance = new OTF_Dokan();
            }

            return self::$instance;
        }

        public function __construct() {

            add_filter('ekommart_customizer_buttons', array($this, 'customizer_buttons'));

            // Store List
            add_filter('dokan_store_listing_per_page', array($this, 'store_list_config_default'));

            add_action('wp_enqueue_scripts', array($this, 'dokan_scripts'), 10);

            add_filter('ekommart_theme_sidebar', array($this, 'set_sidebar'), 20);

            add_filter('body_class', array($this, 'body_classes'));
        }

        public function store_list_config_default($atts) {
            $atts['per_page'] = get_theme_mod('ekommart_dokan_store_list_vendor_number', 10);
            $atts['per_row']  = get_theme_mod('ekommart_dokan_store_list_vendor_columns', 3);
            return $atts;
        }

        public function customizer_buttons($buttons) {
            $buttons = wp_parse_args($buttons, array(
                '.dokan-store #dokan-content' => array(
                    array(
                        'id'   => 'ekommart_dokan_store_detail',
                        'icon' => 'default',
                        'type' => 'section',
                    ),
                ),
                '#dokan-seller-listing-wrap'  => array(
                    array(
                        'id'   => 'ekommart_dokan_store_list',
                        'icon' => 'default',
                        'type' => 'section',
                    ),
                )
            ));

            return $buttons;
        }

        public function set_sidebar($name) {
            if (dokan_is_store_page()) {
                $name = '';
            }
            return $name;
        }

        public function body_classes($classes) {
            if (dokan_is_store_page()) {
                $classes[] = 'ekommart-full-width-content';
            }

            return $classes;
        }

        public function dokan_scripts() {
            global $ekommart_version;
            wp_enqueue_style('ekommart-dokan-style', get_template_directory_uri() . '/assets/css/dokan/dokan.css', array(), $ekommart_version);
            wp_style_add_data('ekommart-dokan-style', 'rtl', 'replace');

            wp_deregister_style('dokan-style');
            wp_deregister_style('dokan-fontawesome');

        }
    }
endif;

OTF_Dokan::getInstance();