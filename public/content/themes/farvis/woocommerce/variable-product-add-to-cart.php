<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    <form class="variations_form cart form-cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $available_variations ) ) ?>">
        <?php do_action( 'woocommerce_before_variations_form' ); ?>

        <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
            <p class="stock out-of-stock"><?php esc_attr_e( 'This product is currently out of stock and unavailable.', 'farvis' ); ?></p>
        <?php else : ?>

            <div class="table-container">
                <table class="form-cart-table variations">
                    <thead>
                        <tr>
                            <th colspan="2"><?php echo esc_html__( 'Item Name', 'farvis' ); ?></th>
                            <th><?php echo esc_html__( 'Unit Price', 'farvis' ); ?></th>
                            <?php foreach ( $attributes as $attribute_name => $options ) : ?>
                            <th><?php echo wc_attribute_label( $attribute_name ); ?></th>
                            <?php endforeach;?>
                            <th><?php echo esc_html__( 'Quantity', 'farvis' ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                            <?php echo '<a href="' . get_the_permalink() . '" class="woocommerce-LoopProduct-link">'.get_the_title().'</a>'; ?>
                            </td>
                            <td>
                            <?php
                                $columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
                                $post_thumbnail_id = get_post_thumbnail_id( $post->ID );
                                $full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
                                $image_title       = get_post_field( 'post_excerpt', $post_thumbnail_id );
                                $placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
                                $wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
                                    'woocommerce-product-gallery',
                                    'woocommerce-product-gallery--' . $placeholder,
                                    'woocommerce-product-gallery--columns-' . absint( $columns ),
                                    'images',
                                ) );
                            ?>
                                <div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
                                    <figure class="woocommerce-product-gallery__wrapper">
                                        <?php
                                        $attributes_img = array(
                                            'title'                   => $image_title,
                                            'data-src'                => $full_size_image[0],
                                            'data-large_image'        => $full_size_image[0],
                                            'data-large_image_width'  => $full_size_image[1],
                                            'data-large_image_height' => $full_size_image[2],
                                        );

                                        if ( has_post_thumbnail() ) {
                                            $html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
                                            $html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes_img );
                                            $html .= '</a></div>';
                                        } else {
                                            $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
                                            $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'farvis' ) );
                                            $html .= '</div>';
                                        }

                                        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );

                                        do_action( 'woocommerce_product_thumbnails' );
                                        ?>
                                    </figure>
                                </div>
                            </td>
                            <td>
                                <div class="single_variation_wrap">
                                    <?php

                                        /**
                                         * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
                                         * @since 2.4.0
                                         * @hooked woocommerce_single_variation - 10 Empty div for variation data.
                                         * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
                                         */
                                        do_action( 'woocommerce_single_variation_shopping_cart' );

                                    ?>
                                </div>

                            </td>
                            <?php foreach ( $attributes as $attribute_name => $options ) : ?>
                                    <td class="value">
                                        <?php
                                            $selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $product->get_variation_default_attribute( $attribute_name );
                                            wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
                                        ?>
                                    </td>
                            <?php endforeach;?>
                            <td>
                                <div class="shopping_cart-quantity">
                                <?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1, 'min_value' => 1, 'max_value' => 999, ) ); ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>


            </div>
            <div class="form-cart__section form-cart__price clearfix">
                <div class="form-cart__price-title form-cart__title"><i class="icon pe-7s-cart"></i><?php echo esc_html__( 'Subtotal', 'farvis' ); ?></div>
                <div class="form-cart__price-total"></div>
                <?php
                if( !empty( $available_variations ) )
                foreach($available_variations as $val){
                    $sufix = '';
                    foreach($val['attributes'] as $va){
                        $sufix .= '_'.$va;
                    }
                    echo '<input type="hidden" class="exproduct_woo_price'.esc_attr($sufix).'" value="'.esc_attr( $val['display_price'] ).'">';
                }
                ?>
                <input type="hidden" class="farvis_woo_currency" value="<?php echo esc_attr( get_woocommerce_currency_symbol() ) ?>">
                <input type="hidden" class="farvis_woo_decimal_separator" value="<?php echo esc_attr( wc_get_price_decimal_separator() ) ?>">
                <input type="hidden" class="farvis_woo_thousand_separator" value="<?php echo esc_attr( wc_get_price_thousand_separator() ) ?>">
                <input type="hidden" class="farvis_woo_decimals" value="<?php echo esc_attr( wc_get_price_decimals() ) ?>">
                <input type="hidden" class="farvis_woo_currency_pos" value="<?php echo esc_attr(get_option( 'woocommerce_currency_pos' )) ?>">
            </div>
            <div class="single_variation_wrap text-center">
                <div class="woocommerce-variation-add-to-cart variations_button">
                    <button type="submit" class="single_add_to_cart_button button alt form-cart__submit btn btn-info btn-lg btn-effect btn-buy-alert"><?php echo esc_html__( 'Continue with checkout', 'farvis' ); ?></button>
                    <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
                    <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
                    <input type="hidden" name="variation_id" class="variation_id" value="0" />
                </div>
                <div class="form-cart__note"><?php echo esc_html__( 'You\'ll be redirected to our secure payment server', 'farvis' ); ?></div>
            </div>

            <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>




        <?php endif; ?>

        <?php do_action( 'woocommerce_after_variations_form' ); ?>
    </form>
</div>


<?php
do_action( 'woocommerce_after_add_to_cart_form' );
