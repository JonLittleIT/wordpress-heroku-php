<?php

if(!class_exists('WCMp')) return;


if ( !function_exists('besa_wc_marketplace_widgets_init') ) {
    function besa_wc_marketplace_widgets_init() {
        register_sidebar( array(
            'name'          => esc_html__( 'WC Marketplace Store Sidebar ', 'besa' ),
            'id'            => 'wc-marketplace-store',
            'description'   => esc_html__( 'Add widgets here to appear in your site.', 'besa' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );                
    }
    add_action( 'widgets_init', 'besa_wc_marketplace_widgets_init' );
}

if ( !function_exists( 'besa_wcmp_vendor_form_password_repeat' ) ) {
  function besa_wcmp_vendor_form_password_repeat() {
    if( 'yes' === get_option( 'woocommerce_registration_generate_password' ) )  return;

    ?>
    <div class="wcmp-regi-12">
        <label for="reg_password2"><?php _e('Confirm Password', 'besa'); ?> <span class="required">*</span></label>
         <input type="password" class="input-text" name="password2" id="reg_password2" required="required" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
    </div>
    <?php
  } 
  add_action( 'wcmp_vendor_register_form', 'besa_wcmp_vendor_form_password_repeat', 0 );
}


if( ! function_exists( 'besa_tbay_regiter_vendor_wcmp_popup' ) ) {
    function besa_tbay_regiter_vendor_wcmp_popup() {
        if( !wcmp_vendor_registration_page_id() ) return;

        $outputs = '<div class="vendor-register">';
        $outputs .= sprintf( __( 'Are you a vendor? <a href="%s">Register here.</a>', 'besa' ), get_permalink(get_option('wcmp_product_vendor_registration_page_id')) );
        $outputs .= '</div>';
        echo trim($outputs);
    }
    add_action( 'besa_custom_woocommerce_register_form_end', 'besa_tbay_regiter_vendor_wcmp_popup', 5 );
}

if( ! function_exists( 'besa_wcmp_woo_remove_product_tabs' ) ) {
    add_filter( 'woocommerce_product_tabs', 'besa_wcmp_woo_remove_product_tabs', 98 );
    function besa_wcmp_woo_remove_product_tabs( $tabs ) {

        unset( $tabs['questions'] );    

        return $tabs;
    }
}


if(!function_exists('besa_wcmp_vendor_name')){
    function besa_wcmp_vendor_name() {
        $active = besa_tbay_get_config('show_vendor_name', true);

        if( !$active ) return;

        if ( 'Enable' !== get_wcmp_vendor_settings( 'sold_by_catalog', 'general' ) ) {
            return;
        }

        global $product;
        $product_id = $product->get_id();

        $vendor = get_wcmp_product_vendors( $product_id );

        if ( empty( $vendor ) ) {
            return;
        }

        $sold_by_text = apply_filters( 'vendor_sold_by_text', esc_html__( 'Sold by:', 'besa' ) );
        ?> 

        <div class="sold-by-meta sold-wcmp">
            <span class="sold-by-label"><?php echo trim($sold_by_text); ?> </span>
            <a href="<?php echo esc_url( $vendor->permalink ); ?>"><?php echo esc_html( $vendor->user_data->display_name ); ?></a>
        </div>

        <?php
    }
    add_filter( 'wcmp_sold_by_text_after_products_shop_page', '__return_false' );
    add_action( 'woocommerce_after_shop_loop_item_title', 'besa_wcmp_vendor_name', 0 );
    add_action( 'woocommerce_single_product_summary', 'besa_wcmp_vendor_name', 5 );

}