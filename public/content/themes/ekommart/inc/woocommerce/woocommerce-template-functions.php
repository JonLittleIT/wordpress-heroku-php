<?php

if (!function_exists('ekommart_before_content')) {
    /**
     * Before Content
     * Wraps all WooCommerce content in wrappers which match the theme markup
     *
     * @return  void
     * @since   1.0.0
     */
    function ekommart_before_content() {
        echo <<<HTML
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
HTML;

    }
}


if (!function_exists('ekommart_after_content')) {
    /**
     * After Content
     * Closes the wrapping divs
     *
     * @return  void
     * @since   1.0.0
     */
    function ekommart_after_content() {
        echo <<<HTML
	</main><!-- #main -->
</div><!-- #primary -->
HTML;

        do_action('ekommart_sidebar');
    }
}

if (!function_exists('ekommart_cart_link_fragment')) {
    /**
     * Cart Fragments
     * Ensure cart contents update when products are added to the cart via AJAX
     *
     * @param array $fragments Fragments to refresh via AJAX.
     *
     * @return array            Fragments to refresh via AJAX
     */
    function ekommart_cart_link_fragment($fragments) {
        ob_start();
        ekommart_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        ob_start();
        ekommart_handheld_footer_bar_cart_link();
        $fragments['a.footer-cart-contents'] = ob_get_clean();

        return $fragments;
    }
}

if (!function_exists('ekommart_cart_link')) {
    /**
     * Cart Link
     * Displayed a link to the cart including the number of items present and the cart total
     *
     * @return void
     * @since  1.0.0
     */
    function ekommart_cart_link() {
        ?>
        <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'ekommart'); ?>">
            <?php /* translators: %d: number of items in cart */ ?>
            <span class="count"><?php echo wp_kses_data(sprintf(_n('%d', '%d', WC()->cart->get_cart_contents_count(), 'ekommart'), WC()->cart->get_cart_contents_count())); ?></span>
            <?php echo wp_kses_post(WC()->cart->get_cart_subtotal()); ?>
        </a>
        <?php
    }
}

if (!function_exists('ekommart_product_search')) {
    /**
     * Display Product Search
     *
     * @return void
     * @uses  ekommart_is_woocommerce_activated() check if WooCommerce is activated
     * @since  1.0.0
     */
    function ekommart_product_search() {
        if (!ekommart_get_theme_option('show-header-search', true)) {
            return;
        }
        if (ekommart_is_woocommerce_activated()) {
            ?>
            <div class="site-search">
                <?php the_widget('WC_Widget_Product_Search', 'title='); ?>
            </div>
            <?php
        }
    }
}

if (!function_exists('ekommart_header_cart')) {
    /**
     * Display Header Cart
     *
     * @return void
     * @uses  ekommart_is_woocommerce_activated() check if WooCommerce is activated
     * @since  1.0.0
     */
    function ekommart_header_cart() {
        if (ekommart_is_woocommerce_activated()) {
            if (!ekommart_get_theme_option('show-header-cart', true)) {
                return;
            }
            ?>
            <div class="site-header-cart menu">
                <?php ekommart_cart_link(); ?>
                <?php

                if (!apply_filters('woocommerce_widget_cart_is_hidden', is_cart() || is_checkout())) {

                    if (ekommart_get_theme_option('header-cart-dropdown', 'side') == 'side') {
                        wp_enqueue_script('ekommart-cart-canvas');
                        add_action('wp_footer', 'ekommart_header_cart_side');
                    } else {
                        the_widget('WC_Widget_Cart', 'title=');
                    }

                }

                ?>
            </div>
            <?php
        }
    }
}

if (!function_exists('ekommart_header_cart_side')) {
    function ekommart_header_cart_side() {
        if (ekommart_is_woocommerce_activated()) {
            ?>
            <div class="site-header-cart-side">
                <div class="cart-side-heading">
                    <span class="cart-side-title"><?php echo esc_html__('Shopping cart', 'ekommart'); ?></span>
                    <a href="#" class="close-cart-side"><?php echo esc_html__('close', 'ekommart') ?></a></div>
                <?php the_widget('WC_Widget_Cart', 'title='); ?>
            </div>
            <div class="cart-side-overlay"></div>
            <?php
        }
    }
}

if (!function_exists('ekommart_upsell_display')) {
    /**
     * Upsells
     * Replace the default upsell function with our own which displays the correct number product columns
     *
     * @return  void
     * @since   1.0.0
     * @uses    woocommerce_upsell_display()
     */
    function ekommart_upsell_display() {
        $columns = apply_filters('ekommart_upsells_columns', 4);
        if (is_active_sidebar('sidebar-woocommerce-detail')) {
            $columns = 3;
        }
        woocommerce_upsell_display(-1, $columns);
    }
}

if (!function_exists('ekommart_sorting_wrapper')) {
    /**
     * Sorting wrapper
     *
     * @return  void
     * @since   1.4.3
     */
    function ekommart_sorting_wrapper() {
        echo '<div class="ekommart-sorting">';
    }
}

if (!function_exists('ekommart_sorting_wrapper_close')) {
    /**
     * Sorting wrapper close
     *
     * @return  void
     * @since   1.4.3
     */
    function ekommart_sorting_wrapper_close() {
        echo '</div>';
    }
}

if (!function_exists('ekommart_product_columns_wrapper')) {
    /**
     * Product columns wrapper
     *
     * @return  void
     * @since   2.2.0
     */
    function ekommart_product_columns_wrapper() {
        $columns = ekommart_loop_columns();
        echo '<div class="columns-' . absint($columns) . '">';
    }
}

if (!function_exists('ekommart_loop_columns')) {
    /**
     * Default loop columns on product archives
     *
     * @return integer products per row
     * @since  1.0.0
     */
    function ekommart_loop_columns() {
        $columns = 3; // 3 products per row

        if (function_exists('wc_get_default_products_per_row')) {
            $columns = wc_get_default_products_per_row();
        }

        return apply_filters('ekommart_loop_columns', $columns);
    }
}

if (!function_exists('ekommart_product_columns_wrapper_close')) {
    /**
     * Product columns wrapper close
     *
     * @return  void
     * @since   2.2.0
     */
    function ekommart_product_columns_wrapper_close() {
        echo '</div>';
    }
}

if (!function_exists('ekommart_shop_messages')) {
    /**
     * ThemeBase shop messages
     *
     * @since   1.4.4
     * @uses    ekommart_do_shortcode
     */
    function ekommart_shop_messages() {
        if (!is_checkout()) {
            echo wp_kses_post(ekommart_do_shortcode('woocommerce_messages'));
        }
    }
}

if (!function_exists('ekommart_woocommerce_pagination')) {
    /**
     * ThemeBase WooCommerce Pagination
     * WooCommerce disables the product pagination inside the woocommerce_product_subcategories() function
     * but since ThemeBase adds pagination before that function is excuted we need a separate function to
     * determine whether or not to display the pagination.
     *
     * @since 1.4.4
     */
    function ekommart_woocommerce_pagination() {
        if (woocommerce_products_will_display()) {
            woocommerce_pagination();
        }
    }
}

if (!function_exists('ekommart_handheld_footer_bar')) {
    /**
     * Display a menu intended for use on handheld devices
     *
     * @since 2.0.0
     */
    function ekommart_handheld_footer_bar() {
        $links = array(
            'shop'       => array(
                'priority' => 5,
                'callback' => 'ekommart_handheld_footer_bar_shop_link',
            ),
            'my-account' => array(
                'priority' => 10,
                'callback' => 'ekommart_handheld_footer_bar_account_link',
            ),
            'search'     => array(
                'priority' => 20,
                'callback' => 'ekommart_handheld_footer_bar_search',
            ),
            'wishlist'   => array(
                'priority' => 30,
                'callback' => 'ekommart_handheld_footer_bar_wishlist',
            ),
        );

        if (wc_get_page_id('myaccount') === -1) {
            unset($links['my-account']);
        }

        if (!function_exists('yith_wcwl_count_all_products')) {
            unset($links['wishlist']);
        }

        $links = apply_filters('ekommart_handheld_footer_bar_links', $links);
        ?>
        <div class="ekommart-handheld-footer-bar">
            <ul class="columns-<?php echo count($links); ?>">
                <?php foreach ($links as $key => $link) : ?>
                    <li class="<?php echo esc_attr($key); ?>">
                        <?php
                        if ($link['callback']) {
                            call_user_func($link['callback'], $key, $link);
                        }
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    }
}

if (!function_exists('ekommart_handheld_footer_bar_search')) {
    /**
     * The search callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function ekommart_handheld_footer_bar_search() {
        ?>
        <a href=""><span class="title"><?php echo esc_attr__('Search', 'ekommart'); ?></span></a>
        <div class="site-search">
            <?php the_widget('WC_Widget_Product_Search', 'title='); ?>
        </div>
        <?php
    }
}

if (!function_exists('ekommart_handheld_footer_bar_cart_link')) {
    /**
     * The cart callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function ekommart_handheld_footer_bar_cart_link() {
        ?>
        <a class="footer-cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'ekommart'); ?>">
            <span class="count"><?php echo wp_kses_data(WC()->cart->get_cart_contents_count()); ?></span>
        </a>
        <?php
    }
}

if (!function_exists('ekommart_handheld_footer_bar_account_link')) {
    /**
     * The account callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function ekommart_handheld_footer_bar_account_link() {
        echo '<a href="' . esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) . '"><span class="title">' . esc_attr__('My Account', 'ekommart') . '</span></a>';
    }
}

if (!function_exists('ekommart_handheld_footer_bar_shop_link')) {
    /**
     * The shop callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function ekommart_handheld_footer_bar_shop_link() {
        echo '<a href="' . esc_url(get_permalink(get_option('woocommerce_shop_page_id'))) . '"><span class="title">' . esc_attr__('Shop', 'ekommart') . '</span></a>';
    }
}

if (!function_exists('ekommart_handheld_footer_bar_wishlist')) {
    /**
     * The wishlist callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function ekommart_handheld_footer_bar_wishlist() {
        if (function_exists('yith_wcwl_count_all_products')) {
            ?>
            <a class="footer-wishlist" href="<?php echo esc_url(get_permalink(get_option('yith_wcwl_wishlist_page_id'))); ?>">
                <span class="title"><?php echo esc_html__('Wishlist', 'ekommart'); ?></span>
                <span class="count"><?php echo esc_html(yith_wcwl_count_all_products()); ?></span>
            </a>
            <?php
        }
    }
}

if (!function_exists('ekommart_single_product_pagination')) {
    /**
     * Single Product Pagination
     *
     * @since 2.3.0
     */
    function ekommart_single_product_pagination() {
//		if ( get_theme_mod( 'ekommart_product_pagination' ) !== true ) {
//			return;
//		}

        // Show only products in the same category?
        $in_same_term   = apply_filters('ekommart_single_product_pagination_same_category', true);
        $excluded_terms = apply_filters('ekommart_single_product_pagination_excluded_terms', '');
        $taxonomy       = apply_filters('ekommart_single_product_pagination_taxonomy', 'product_cat');

        $previous_product = ekommart_get_previous_product($in_same_term, $excluded_terms, $taxonomy);
        $next_product     = ekommart_get_next_product($in_same_term, $excluded_terms, $taxonomy);

        if ((!$previous_product && !$next_product) || !is_product()) {
            return;
        }

        ?>
        <div class="ekommart-product-pagination-wrap">
            <nav class="ekommart-product-pagination" aria-label="<?php esc_attr_e('More products', 'ekommart'); ?>">
                <?php if ($previous_product) : ?>
                    <a href="<?php echo esc_url($previous_product->get_permalink()); ?>" rel="prev">
                        <i class="ekommart-icon-arrow-circle-left"></i>
                        <div class="product-item">
                            <?php echo wp_kses_post($previous_product->get_image()); ?>
                            <div class="ekommart-product-pagination-content">
                                <span class="ekommart-product-pagination__title"><?php echo wp_kses_post($previous_product->get_name()); ?></span>
                                <?php if ($price_html = $previous_product->get_price_html()) : ?>
                                    <span class="price"><?php echo $price_html; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
                <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_shop_page_id'))) ?>"><i class="ekommart-icon-grip-horizontal shop-tooltip" title="<?php esc_attr_e('Back to shop', 'ekommart') ?>"></i></a>
                <?php if ($next_product) : ?>
                    <a href="<?php echo esc_url($next_product->get_permalink()); ?>" rel="next">
                        <i class="ekommart-icon-arrow-circle-right"></i>
                        <div class="product-item">
                            <?php echo wp_kses_post($next_product->get_image()); ?>
                            <div class="ekommart-product-pagination-content">
                                <span class="ekommart-product-pagination__title"><?php echo wp_kses_post($next_product->get_name()); ?></span>
                                <?php if ($price_html = $next_product->get_price_html()) : ?>
                                    <span class="price"><?php echo $price_html; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
            </nav><!-- .ekommart-product-pagination -->
        </div>
        <?php

    }
}

if (!function_exists('ekommart_sticky_single_add_to_cart')) {
    /**
     * Sticky Add to Cart
     *
     * @since 2.3.0
     */
    function ekommart_sticky_single_add_to_cart() {
        global $product;

        if (!is_product()) {
            return;
        }

        $show = false;

        if ($product->is_purchasable() && $product->is_in_stock()) {
            $show = true;
        } else if ($product->is_type('external')) {
            $show = true;
        }

        if (!$show) {
            return;
        }

        $params = apply_filters(
            'ekommart_sticky_add_to_cart_params', array(
                'trigger_class' => 'entry-summary',
            )
        );

        wp_localize_script('ekommart-sticky-add-to-cart', 'ekommart_sticky_add_to_cart_params', $params);
        wp_dequeue_script('ekommart-sticky-header');
        wp_enqueue_script('ekommart-sticky-add-to-cart');
        ?>

        <section class="ekommart-sticky-add-to-cart">
            <div class="col-full">
                <div class="ekommart-sticky-add-to-cart__content">
                    <?php echo wp_kses_post(woocommerce_get_product_thumbnail()); ?>
                    <div class="ekommart-sticky-add-to-cart__content-product-info">
						<span class="ekommart-sticky-add-to-cart__content-title"><?php esc_attr_e('You\'re viewing:', 'ekommart'); ?>
							<strong><?php the_title(); ?></strong></span>
                        <span class="ekommart-sticky-add-to-cart__content-price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
                        <?php echo wp_kses_post(wc_get_rating_html($product->get_average_rating())); ?>
                    </div>
                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="ekommart-sticky-add-to-cart__content-button button alt">
                        <?php echo esc_attr($product->add_to_cart_text()); ?>
                    </a>
                </div>
            </div>
        </section><!-- .ekommart-sticky-add-to-cart -->
        <?php
    }
}


if (!function_exists('ekommart_woocommerce_product_loop_start')) {
    function ekommart_woocommerce_product_loop_start() {
        echo '<div class="product-block">';
    }
}

if (!function_exists('ekommart_woocommerce_product_loop_end')) {
    function ekommart_woocommerce_product_loop_end() {
        echo '</div>';
    }
}

if (!function_exists('ekommart_woocommerce_product_loop_image')) {
    function ekommart_woocommerce_product_loop_image() {
        ?>
        <div class="product-transition"><?php do_action('ekommart_woocommerce_product_loop_image') ?></div>
        <?php
    }
}

if (!function_exists('ekommart_woocommerce_product_loop_action')) {
    function ekommart_woocommerce_product_loop_action() {
        ?>
        <div class="group-action">
            <div class="shop-action">
                <?php do_action('ekommart_woocommerce_product_loop_action'); ?>
            </div>
        </div>
        <?php
    }
}
if (!function_exists('ekommart_stock_label')) {
    function ekommart_stock_label() {
        global $product;
        if ($product->is_in_stock()) {
            echo '<span class="inventory_status">' . esc_html__('In Stock', 'ekommart') . '</span>';
        } else {
            echo '<span class="inventory_status out-stock">' . esc_html__('Out of Stock', 'ekommart') . '</span>';
        }
    }
}

if (!function_exists('ekommart_get_loop_product_thumbnail')) {
    function ekommart_get_loop_product_thumbnail($size = 'woocommerce_thumbnail', $deprecated1 = 0, $deprecated2 = 0) {
        global $product;
        if (!$product) {
            return '';
        }
        $gallery    = $product->get_gallery_image_ids();
        $hover_skin = ekommart_get_theme_option('woocommerce_product_hover', 'none');
        if ($hover_skin == '0' || count($gallery) <= 0) {
            echo '<div class="product-image">' . $product->get_image('shop_catalog') . '</div>';

            return '';
        }
        $image_featured = '<div class="product-image">' . $product->get_image('shop_catalog') . '</div>';
        $image_featured .= '<div class="product-image second-image">' . wp_get_attachment_image($gallery[0], 'shop_catalog') . '</div>';

        echo <<<HTML
<div class="product-img-wrap {$hover_skin}">
    <div class="inner">
        {$image_featured}
    </div>
</div>
HTML;
    }
}

if (!function_exists('ekommart_woocommerce_single_product_image_thumbnail_html')) {
    function ekommart_woocommerce_single_product_image_thumbnail_html($image, $attachment_id) {
        return wc_get_gallery_image_html($attachment_id, true);
    }
}

if (!function_exists('ekommart_template_loop_product_thumbnail')) {
    function ekommart_template_loop_product_thumbnail($size = 'woocommerce_thumbnail', $deprecated1 = 0, $deprecated2 = 0) {
        echo ekommart_get_loop_product_thumbnail();

    }
}

if (!function_exists('woocommerce_template_loop_product_title')) {

    /**
     * Show the product title in the product loop.
     */
    function woocommerce_template_loop_product_title() {
        echo '<h3 class="woocommerce-loop-product__title"><a href="' . esc_url_raw(get_the_permalink()) . '">' . get_the_title() . '</a></h3>';
    }
}

if (!function_exists('ekommart_woocommerce_get_product_category')) {
    function ekommart_woocommerce_get_product_category() {
        global $product;
        echo wc_get_product_category_list($product->get_id(), ', ', '<div class="posted-in">', '</div>');
    }
}

if (!function_exists('ekommart_woocommerce_get_product_description')) {
    function ekommart_woocommerce_get_product_description() {
        global $post;

        $short_description = apply_filters('woocommerce_short_description', $post->post_excerpt);

        if ($short_description) {
            ?>
            <div class="short-description">
                <?php echo wp_kses_post($short_description); ?>
            </div>
            <?php
        }
    }
}

if (!function_exists('ekommart_woocommerce_get_product_short_description')) {
    function ekommart_woocommerce_get_product_short_description() {
        global $post;
        $short_description = wp_trim_words(apply_filters('woocommerce_short_description', $post->post_excerpt), 15);
        if ($short_description) {
            ?>
            <div class="short-description">
                <?php echo wp_kses_post($short_description); ?>
            </div>
            <?php
        }
    }
}


if (!function_exists('ekommart_woocommerce_product_loop_wishlist_button')) {
    function ekommart_woocommerce_product_loop_wishlist_button() {
        if (ekommart_is_woocommerce_extension_activated('YITH_WCWL')) {
            echo ekommart_do_shortcode('yith_wcwl_add_to_wishlist');
        }
    }
}

if (!function_exists('ekommart_woocommerce_product_loop_compare_button')) {
    function ekommart_woocommerce_product_loop_compare_button() {
        if (ekommart_is_woocommerce_extension_activated('YITH_Woocompare')) {
            global $yith_woocompare;
            if (get_option('yith_woocompare_compare_button_in_products_list', 'no') == 'yes') {
                remove_action('woocommerce_after_shop_loop_item', array(
                    $yith_woocompare->obj,
                    'add_compare_link'
                ), 20);
            }

            echo ekommart_do_shortcode('yith_compare_button');
        }
    }
}

if (!function_exists('ekommart_header_wishlist')) {
    function ekommart_header_wishlist() {
        if (function_exists('yith_wcwl_count_all_products')) {
            if (!ekommart_get_theme_option('show-header-wishlist', true)) {
                return;
            }
            ?>
            <div class="site-header-wishlist">
                <a class="header-wishlist" href="<?php echo esc_url(get_permalink(get_option('yith_wcwl_wishlist_page_id'))); ?>">
                    <i class="ekommart-icon-heart"></i>
                    <span class="count"><?php echo esc_html(yith_wcwl_count_all_products()); ?></span>
                </a>
            </div>
            <?php
        }
    }
}

if (defined('YITH_WCWL') && !function_exists('yith_wcwl_ajax_update_count')) {
    function yith_wcwl_ajax_update_count() {
        wp_send_json(array(
            'count' => yith_wcwl_count_all_products()
        ));
    }

    add_action('wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count');
    add_action('wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count');
}

if (!function_exists('ekommart_button_grid_list_layout')) {
    function ekommart_button_grid_list_layout() {
        ?>
        <div class="gridlist-toggle desktop-hide-down">
            <a href="<?php echo esc_url(add_query_arg('layout', 'grid')); ?>" id="grid" class="<?php echo isset($_GET['layout']) && $_GET['layout'] == 'list' ? '' : 'active'; ?>" title="<?php echo esc_html__('Grid View', 'ekommart'); ?>"><i class="ekommart-icon-th-large"></i></a>
            <a href="<?php echo esc_url(add_query_arg('layout', 'list')); ?>" id="list" class="<?php echo isset($_GET['layout']) && $_GET['layout'] == 'list' ? 'active' : ''; ?>" title="<?php echo esc_html__('List View', 'ekommart'); ?>"><i class="ekommart-icon-th-list"></i></a>
        </div>
        <?php
    }
}

if (!function_exists('ekommart_woocommerce_change_path_shortcode')) {
    function ekommart_woocommerce_change_path_shortcode($template, $slug, $name) {
        wc_get_template('content-widget-product.php', apply_filters('ekommart_product_template_arg', array('show_rating' => false)));
    }
}

if (!function_exists('ekommart_woocommerce_list_show_rating_arg')) {
    function ekommart_woocommerce_list_show_rating_arg($arg) {
        $arg['show_rating'] = true;

        return $arg;
    }
}

if (!function_exists('ekommart_woocommerce_list_get_excerpt')) {
    function ekommart_woocommerce_list_show_excerpt() {
        echo '<div class="product-excerpt">' . get_the_excerpt() . '</div>';
    }
}

if (!function_exists('ekommart_woocommerce_list_get_rating')) {
    function ekommart_woocommerce_list_show_rating() {
        global $product;
        echo wc_get_rating_html($product->get_average_rating());
    }
}

if (!function_exists('ekommart_single_product_quantity_label')) {
    function ekommart_single_product_quantity_label() {
        echo '<label class="quantity_label">' . __('Quantity', 'ekommart') . ' </label>';
    }
}

if (!function_exists('ekommart_woocommerce_time_sale')) {
    function ekommart_woocommerce_time_sale() {
        /**
         * @var $product WC_Product
         */
        global $product;

        if (!$product->is_on_sale()) {
            return;
        }

        $time_sale = get_post_meta($product->get_id(), '_sale_price_dates_to', true);
        if ($time_sale) {
            $time_sale += (get_option('gmt_offset') * HOUR_IN_SECONDS);
            wp_enqueue_script('ekommart-countdown');
            ?>
            <div class="time-sale">
                <div class="deal-text"><?php echo esc_html__('Deal ends in', 'ekommart'); ?></div>
                <div class="ekommart-countdown" data-countdown="true" data-date="<?php echo esc_html($time_sale); ?>">
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-days"></span>
                        <span class="countdown-label"><?php echo esc_html__('DAYS', 'ekommart') ?></span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-hours"></span>
                        <span class="countdown-label"><?php echo esc_html__('HRS', 'ekommart') ?></span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-minutes"></span>
                        <span class="countdown-label"><?php echo esc_html__('MIN', 'ekommart') ?></span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-seconds"></span>
                        <span class="countdown-label"><?php echo esc_html__('SEC', 'ekommart') ?></span>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

if (!function_exists('ekommart_button_shop_canvas')) {
    function ekommart_button_shop_canvas() {
        if (is_active_sidebar('sidebar-woocommerce-shop')) { ?>
            <button class="filter-toggle" aria-expanded="false">
                <i class="ekommart-icon-filter"></i><span><?php esc_html_e('Filter', 'ekommart'); ?></span></button>
            <?php
        }
    }
}
if (!function_exists('ekommart_render_woocommerce_shop_canvas')) {
    function ekommart_render_woocommerce_shop_canvas() {
        if (is_active_sidebar('sidebar-woocommerce-shop') && ekommart_is_product_archive()) {
            ?>
            <div id="ekommart-canvas-filter" class="ekommart-canvas-filter">
                <span class="filter-close"><?php esc_html_e('CLOSE', 'ekommart'); ?></span>
                <div class="ekommart-canvas-filter-wrap">
                    <?php dynamic_sidebar('sidebar-woocommerce-shop'); ?>
                </div>
            </div>
            <div class="ekommart-overlay-filter"></div>
            <?php
        }
    }
}

if (!function_exists('woocommerce_checkout_order_review_start')) {

    function woocommerce_checkout_order_review_start() {
        echo '<div class="checkout-review-order-table-wrapper">';
    }
}

if (!function_exists('woocommerce_checkout_order_review_end')) {

    function woocommerce_checkout_order_review_end() {
        echo '</div>';
    }
}

if (!function_exists('ekommart_woocommerce_get_product_label_stock')) {
    function ekommart_woocommerce_get_product_label_stock() {
        /**
         * @var $product WC_Product
         */
        global $product;
        if ($product->get_stock_status() == 'outofstock') {
            echo '<span class="stock-label">' . esc_html__('Out Of Stock', 'ekommart') . '</span>';
        }
    }
}

if (!function_exists('ekommart_woocommerce_deal_progress')) {
    function ekommart_woocommerce_deal_progress() {
        global $product;

        $limit = get_post_meta($product->get_id(), '_deal_quantity', true);
        $sold  = intval(get_post_meta($product->get_id(), '_deal_sales_counts', true));
        if (empty($limit)) {
            return;
        }

        ?>

        <div class="deal-sold">
            <div class="deal-progress">
                <div class="progress-bar">
                    <div class="progress-value" style="width: <?php echo trim($sold / $limit * 100) ?>%"></div>
                </div>
            </div>
            <div class="deal-sold-text"><?php echo esc_html__('Sold: ', 'ekommart') . esc_html($sold); ?></div>
        </div>

        <?php
    }
}

if (!function_exists('ekommart_woocommerce_deal_progress_single')) {
    function ekommart_woocommerce_deal_progress_single() {
        global $product;

        $limit = get_post_meta($product->get_id(), '_deal_quantity', true);
        $sold  = intval(get_post_meta($product->get_id(), '_deal_sales_counts', true));

        $date      = $product->get_date_on_sale_to();
        $data_date = 0;
        if ($date) {
            $data_date = strtotime($date) - (get_option('gmt_offset') * HOUR_IN_SECONDS);
        }
        if ($data_date != 0) {
            wp_enqueue_script('ekommart-countdown');
            ?>
            <div class="single-product-countdown">
                <div class="deal-time">
                    <div class="deal-text"><?php esc_html_e('Hurry up before the offer ends', 'ekommart') ?></div>
                    <div class="deal-count" data-countdown="true" data-date="<?php echo esc_html($data_date); ?>">
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-days">0</span>
                            <span class="countdown-label"><?php echo esc_html__('days', 'ekommart') ?></span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-hours">00</span>
                            <span class="countdown-label"><?php echo esc_html__('hours', 'ekommart') ?></span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-minutes">00</span>
                            <span class="countdown-label"><?php echo esc_html__('mins', 'ekommart') ?></span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-seconds">00</span>
                            <span class="countdown-label"><?php echo esc_html__('secs', 'ekommart') ?></span>
                        </div>
                    </div>
                </div>
                <?php if (ekommart_woocommerce_is_deal_product($product)) { ?>

                    <div class="deal-sold">
                        <div class="deal-progress">
                            <div class="progress-bar">
                                <div class="progress-value" style="width: <?php echo trim($sold / $limit * 100) ?>%"></div>
                            </div>
                        </div>
                        <div class="deal-sold-count"><?php echo '<span>' . esc_html($sold) . '/' . esc_html($limit) . '</span> ' . esc_html__('Sold ', 'ekommart'); ?></div>
                    </div>

                    <?php
                }
                ?>
            </div>
            <?php
        }
    }
}

?>
