<?php

if ( !function_exists('besa_before_render_sticky_header')) {
    function besa_before_render_sticky_header( $widget ) {

        if ( function_exists( 'is_product' ) ) {
            $menu_bar = besa_get_product_menu_bar();

            if( is_product() &&  $menu_bar)  return;
        }
 
        $settings = $widget->get_settings_for_display();
 
        if( !isset($settings['enable_sticky_headers']) ) return;

        if( $settings['enable_sticky_headers'] === 'yes' ) {
            $widget->add_render_attribute('_wrapper', 'class', 'element-sticky-header');
        }

    }

    add_action('elementor/frontend/section/before_render', 'besa_before_render_sticky_header', 10, 2 );
}

