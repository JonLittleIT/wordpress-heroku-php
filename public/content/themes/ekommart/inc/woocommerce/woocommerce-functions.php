<?php
/**
 * Checks if the current page is a product archive
 *
 * @return boolean
 */
function ekommart_is_product_archive() {
    if (is_shop() || is_product_taxonomy() || is_product_category() || is_product_tag()) {
        return true;
    } else {
        return false;
    }
}

/**
 * @param $product WC_Product
 */
function ekommart_product_get_image($product){
	return $product->get_image();
}

/**
 * @param $product WC_Product
 */
function ekommart_product_get_price_html($product){
	return $product->get_price_html();
}

/**
 * Retrieves the previous product.
 *
 * @param bool $in_same_term Optional. Whether post should be in a same taxonomy term. Default false.
 * @param array|string $excluded_terms Optional. Comma-separated list of excluded term IDs. Default empty.
 * @param string $taxonomy Optional. Taxonomy, if $in_same_term is true. Default 'product_cat'.
 * @return WC_Product|false Product object if successful. False if no valid product is found.
 * @since 2.4.3
 *
 */
function ekommart_get_previous_product($in_same_term = false, $excluded_terms = '', $taxonomy = 'product_cat') {
    $product = new Ekommart_WooCommerce_Adjacent_Products($in_same_term, $excluded_terms, $taxonomy, true);
    return $product->get_product();
}

/**
 * Retrieves the next product.
 *
 * @param bool $in_same_term Optional. Whether post should be in a same taxonomy term. Default false.
 * @param array|string $excluded_terms Optional. Comma-separated list of excluded term IDs. Default empty.
 * @param string $taxonomy Optional. Taxonomy, if $in_same_term is true. Default 'product_cat'.
 * @return WC_Product|false Product object if successful. False if no valid product is found.
 * @since 2.4.3
 *
 */
function ekommart_get_next_product($in_same_term = false, $excluded_terms = '', $taxonomy = 'product_cat') {
    $product = new Ekommart_WooCommerce_Adjacent_Products($in_same_term, $excluded_terms, $taxonomy);
    return $product->get_product();
}


function ekommart_is_woocommerce_extension_activated($extension = 'WC_Bookings') {
    if ($extension == 'YITH_WCQV') {
        return class_exists($extension) && class_exists('YITH_WCQV_Frontend') ? true : false;
    }

    return class_exists($extension) ? true : false;
}

function osf_woocommerce_pagination_args($args) {
    $args['prev_text'] = '<span>' . __('PREVIOUS', 'ekommart').'</span>';
    $args['next_text'] ='<span>'. __('NEXT', 'ekommart') . '</span>';
    return $args;
}

add_filter('woocommerce_pagination_args', 'osf_woocommerce_pagination_args', 10, 1);

/**
 * Check if a product is a deal
 *
 * @param int|object $product
 *
 * @return bool
 */
function ekommart_woocommerce_is_deal_product($product)
{
    $product = is_numeric($product) ? wc_get_product($product) : $product;

    // It must be a sale product first
    if (!$product->is_on_sale()) {
        return false;
    }

    if (!$product->is_in_stock()) {
        return false;
    }

    // Only support product type "simple" and "external"
    if (!$product->is_type('simple') && !$product->is_type('external')) {
        return false;
    }

    $deal_quantity = get_post_meta($product->get_id(), '_deal_quantity', true);

    if ($deal_quantity > 0) {
        return true;
    }

    return false;
}