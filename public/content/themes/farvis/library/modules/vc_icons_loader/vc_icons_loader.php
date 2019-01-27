<?php

/**
 * Iconc loader for VC
 * version 1.15.11
 */

function farvis_init_vc_icons(){
    $pix_libs = $pix_fonts = $pix_fonts_str = $params = $params1 = $params2 = array();

    if(function_exists('fil_init')) {

        if( array_key_exists( 'vc_iconpicker-type-pixflaticon' , $GLOBALS['wp_filter']) ) {
            $pix_libs[esc_html__( 'Flaticon', 'farvis' )] = 'pixflaticon';
        }
        if( array_key_exists( 'vc_iconpicker-type-pixfontawesome' , $GLOBALS['wp_filter']) ) {
            $pix_libs[esc_html__( 'Font Awesome', 'farvis' )] = 'pixfontawesome';
        }
        if( array_key_exists( 'vc_iconpicker-type-pixelegant' , $GLOBALS['wp_filter']) ) {
            $pix_libs[esc_html__( 'Elegant', 'farvis' )] = 'pixelegant';
        }
        if( array_key_exists( 'vc_iconpicker-type-pixicomoon' , $GLOBALS['wp_filter']) ) {
            $pix_libs[esc_html__( 'Icomoon', 'farvis' )] = 'pixicomoon';
        }
        if( array_key_exists( 'vc_iconpicker-type-pixsimple' , $GLOBALS['wp_filter']) ) {
            $pix_libs[esc_html__( 'Simple', 'farvis' )] = 'pixsimple';
        }
        if( array_key_exists( 'vc_iconpicker-type-pixstroke' , $GLOBALS['wp_filter']) ) {
            $pix_libs[esc_html__( 'Stroke-Gap-Icons', 'farvis' )] = 'pixstroke';
        }
        if( array_key_exists( 'vc_iconpicker-type-pixcustom' , $GLOBALS['wp_filter']) ) {
            $pix_libs[esc_html__( 'Custom', 'farvis' )] = 'pixcustom';
        }
        if( array_key_exists( 'vc_iconpicker-type-pixcustom1' , $GLOBALS['wp_filter']) ) {
            $pix_libs[esc_html__( 'Custom 1', 'farvis' )] = 'pixcustom1';
        }
        if( array_key_exists( 'vc_iconpicker-type-pixcustom2' , $GLOBALS['wp_filter']) ) {
            $pix_libs[esc_html__( 'Custom 2', 'farvis' )] = 'pixcustom2';
        }
        if( array_key_exists( 'vc_iconpicker-type-pixcustom3' , $GLOBALS['wp_filter']) ) {
            $pix_libs[esc_html__( 'Custom 3', 'farvis' )] = 'pixcustom3';
        }
        if( array_key_exists( 'vc_iconpicker-type-pixcustom4' , $GLOBALS['wp_filter']) ) {
            $pix_libs[esc_html__( 'Custom 4', 'farvis' )] = 'pixcustom4';
        }
        if( array_key_exists( 'vc_iconpicker-type-pixcustom5' , $GLOBALS['wp_filter']) ) {
            $pix_libs[esc_html__( 'Custom 5', 'farvis' )] = 'pixcustom5';
        }
        if( array_key_exists( 'vc_iconpicker-type-fontawesome' , $GLOBALS['wp_filter']) ) {
            $pix_libs[esc_html__( 'VC Font Awesome', 'farvis' )] = 'fontawesome';
        }
        if( get_option('fil_use_vc_icons') ) {
            if (array_key_exists('vc_iconpicker-type-openiconic', $GLOBALS['wp_filter'])) {
                $pix_libs[esc_html__('VC Open Iconic', 'farvis')] = 'openiconic';
            }
            if (array_key_exists('vc_iconpicker-type-typicons', $GLOBALS['wp_filter'])) {
                $pix_libs[esc_html__('VC Typicons', 'farvis')] = 'typicons';
            }
            if (array_key_exists('vc_iconpicker-type-entypo', $GLOBALS['wp_filter'])) {
                $pix_libs[esc_html__('VC Entypo', 'farvis')] = 'entypo';
            }
            if (array_key_exists('vc_iconpicker-type-linecons', $GLOBALS['wp_filter'])) {
                $pix_libs[esc_html__('VC Linecons', 'farvis')] = 'linecons';
            }
        }
        $add_icon_libs = array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon library', 'farvis' ),
            'param_name' => 'type',
            'value' => $pix_libs,
            'admin_label' => true,
            'description' => esc_html__( 'Select icon library.', 'farvis' ),
        );

        if (is_array($pix_libs)) {
            $pix_fonts_str[] = $add_icon_libs;

            foreach ($pix_libs as $val) {
                if ($val != ''){
                    $pix_fonts[$val] = array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__('Icon', 'farvis'),
                        'param_name' => 'icon_' . $val,
                        'value' => '',
                        'settings' => array(
                            'emptyIcon' => true,
                            'type' => $val,
                            'iconsPerPage' => 4000,
                        ),
                        'dependency' => array(
                            'element' => 'type',
                            'value' => $val,
                        ),
                        'description' => esc_html__('Select icon from library.', 'farvis'),
                    );
                }

                $pix_fonts_str[] = $pix_fonts[$val];
            }
        }
    }
    return $pix_fonts_str;
}



function farvis_get_vc_icons($pix_fonts_str){
    $result = array();
    if (!empty($pix_fonts_str) && function_exists('fil_init'))
        $result = apply_filters('farvis_vc_icons_loader_show',$pix_fonts_str);
    return array_values($result);

}






?>