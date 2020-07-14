<?php

if(!function_exists('ekommart_dokan_sold_store')){
    function ekommart_dokan_sold_store(){
        if ( ! function_exists( 'dokan_get_store_url' ) ) {
            return;
        }

        global $product;
        $author_id = get_post_field( 'post_author', $product->get_id() );
        $author    = get_user_by( 'id', $author_id );
        if ( empty( $author ) ) {
            return;
        }

        ?>
        <div class="sold-by-meta">
            <span class="sold-by-label"><?php esc_html_e( 'Sold By:', 'ekommart' ); ?> </span>
            <a href="<?php echo esc_url( dokan_get_store_url( $author_id ) ); ?>"><?php echo esc_html( $author->display_name ); ?></a>
        </div>
        <?php
    }
}