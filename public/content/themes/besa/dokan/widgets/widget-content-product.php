<?php
/**
 * Dokan Widget Content Product Template
 *
 * @since 2.4
 *
 * @package dokan
 */

$img_kses = apply_filters( 'dokan_product_image_attributes', array(
    'img' => array(
        'alt'    => array(),
        'class'  => array(),
        'height' => array(),
        'src'    => array(),
        'width'  => array(),
    ),
) );

?>

<?php if ( $r->have_posts() ) : ?>
    <div class="dokan-bestselling-product-widget widget-carousel-vertical product_list_widget">
    <?php while ( $r->have_posts() ): $r->the_post() ?>
        <?php global $product; ?>
        <div class="product-block vertical-v1 product">
            <div class="product-content">
                <div class="block-inner">
                    <figure class="image ">
                        <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
                            <?php echo wp_kses( $product->get_image(), $img_kses ); ?>
                        </a>
                    </figure>
                </div>
                <div class="caption">

                <h3 class="name"><a href="<?php echo esc_url( get_permalink( dokan_get_prop( $product, 'id' ) ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>"><?php echo esc_html( $product->get_title() ); ?></a></h3>

                <span class="price"><?php echo trim($product->get_price_html());  // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?></span>
                
                </div>
            </div>
            
        </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <p><?php esc_html_e( 'No products found', 'besa' ); ?></p>
<?php endif; ?>
