<?php   global $woocommerce; 

    if( defined('BESA_WOOCOMMERCE_CATALOG_MODE_ACTIVED') || !defined('BESA_WOOCOMMERCE_ACTIVED') || is_product() || is_cart() || is_checkout() ) return;

?>

<?php
    /**
     * besa_before_topbar_mobile hook
     */
    do_action( 'besa_before_footer_mobile' );
?>
<div class="footer-device-mobile d-xl-none clearfix">

    <?php
        /**
        * besa_before_footer_mobile hook
        */
        do_action( 'besa_before_footer_mobile' );

        /**
        * Hook: besa_footer_mobile_content.
        *
        * @hooked besa_the_icon_home_footer_mobile - 5
        * @hooked besa_the_icon_wishlist_footer_mobile - 10
        * @hooked besa_the_icon_mini_cart_footer_mobile - 15
        * @hooked besa_the_icon_recent_footer_mobile - 20
        * @hooked besa_the_icon_account_footer_mobile - 25
        */

        do_action( 'besa_footer_mobile_content' );

        /**
        * besa_after_footer_mobile hook
        */
        do_action( 'besa_after_footer_mobile' );
    ?>

</div>