<?php

if(!class_exists('WC_Vendors')) return;

if( class_exists('WCV_Vendor_Shop') && ! function_exists( 'besa_tbay_wcv_vendor_shop' ) ) {
    function besa_tbay_wcv_vendor_shop() {

        if( wc_string_to_bool( get_option( 'wcvendors_display_label_sold_by_enable', 'no' ) ) ) {
            remove_action( 'woocommerce_after_shop_loop_item', array( 'WCV_Vendor_Shop', 'template_loop_sold_by' ), 9 );
            add_action( 'woocommerce_after_shop_loop_item_title', array( 'WCV_Vendor_Shop', 'template_loop_sold_by' ), 9 );
        }
        
    }
    add_action( 'besa_woocommerce_before_product_block_grid', 'besa_tbay_wcv_vendor_shop', 10 );
}