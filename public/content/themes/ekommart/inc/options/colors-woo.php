<?php
if(isset($primary) && $primary){
    $cssCode .= <<<CSS
        .ekommart-product-pagination .product-item .price, ul.products li.product .price,
ul.products .wc-block-grid__product .price,
.wc-block-grid__products li.product .price,
.wc-block-grid__products .wc-block-grid__product .price, .single-product div.product form.cart table.group_table .woocommerce-Price-amount, .single-product div.product p.price, .single-product div.product .single_variation .price, .single-product .woocommerce-tabs ul.tabs li.active a, .ekommart-sticky-add-to-cart__content-price, .single-product-countdown .deal-sold-count span, .product_list_widget .product-content .amount, .widget_shopping_cart .mini_cart_item .quantity .amount, .widget_price_filter .price_slider_amount .price_label span, .ekommart_widget_layered_nav ul.woocommerce-widget-layered-nav-list li .ekommart-button-type:hover, .ekommart_widget_layered_nav ul.woocommerce-widget-layered-nav-list li.chosen .ekommart-button-type, .cart_totals .order-total .amount, ul#shipping_method input[type="radio"]:first-child:checked + label:after, #order_review .woocommerce-checkout-review-order-table .order-total .amount, #payment .payment_methods li.woocommerce-PaymentMethod > input[type=radio]:first-child:checked + label::before, #payment .payment_methods li.wc_payment_method > input[type=radio]:first-child:checked + label::before, .woocommerce-order .woocommerce-table--order-details tfoot tr:last-child .amount, #yith-quick-view-modal.open p.price, .hentry .entry-content .woocommerce-MyAccount-navigation ul li.woocommerce-MyAccount-navigation-link.is-active a, .product-list .price {
    color: $primary; 
}
CSS;

}
if(isset($primary) && $primary){
    $cssCode .= <<<CSS
        .wc-block-grid__product-onsale,
.onsale, .deal-progress .progress-value, .widget_price_filter .ui-slider .ui-slider-range, .yith_woocompare_colorbox #cboxLoadedContent ::-webkit-scrollbar-thumb, .yith_woocompare_colorbox #cboxLoadedContent :window-inactive::-webkit-scrollbar-thumb {
    background-color: $primary; 
}
CSS;

}
if(isset($primary) && $primary){
    $cssCode .= <<<CSS
        .widget_price_filter .ui-slider .ui-slider-handle, .ekommart_widget_layered_nav ul.woocommerce-widget-layered-nav-list li .ekommart-button-type:hover, .ekommart_widget_layered_nav ul.woocommerce-widget-layered-nav-list li.chosen .ekommart-button-type, .ekommart_widget_layered_nav ul.woocommerce-widget-layered-nav-list li .ekommart-color-type:after,
.ekommart_widget_layered_nav ul.woocommerce-widget-layered-nav-list li .ekommart-image-type:after, table.cart td.actions .coupon .input-text:focus, .checkout_coupon .input-text:focus, .site-header-cart-side .widget_shopping_cart .buttons a.checkout {
    border-color: $primary; 
}
CSS;

}
if(isset($primary) && $primary){
    $cssCode .= <<<CSS
        .site-header-cart .widget.widget_shopping_cart {
    border-top-color: $primary; 
}
CSS;

}
if(isset($primary_hover) && $primary_hover){
    $cssCode .= <<<CSS
        .ekommart-product-pagination a:hover, ul.products li.product h2 a:hover,
ul.products li.product h3 a:hover,
ul.products li.product .woocommerce-loop-product__title a:hover,
ul.products li.product .wc-block-grid__product-title a:hover,
ul.products .wc-block-grid__product h2 a:hover,
ul.products .wc-block-grid__product h3 a:hover,
ul.products .wc-block-grid__product .woocommerce-loop-product__title a:hover,
ul.products .wc-block-grid__product .wc-block-grid__product-title a:hover,
.wc-block-grid__products li.product h2 a:hover,
.wc-block-grid__products li.product h3 a:hover,
.wc-block-grid__products li.product .woocommerce-loop-product__title a:hover,
.wc-block-grid__products li.product .wc-block-grid__product-title a:hover,
.wc-block-grid__products .wc-block-grid__product h2 a:hover,
.wc-block-grid__products .wc-block-grid__product h3 a:hover,
.wc-block-grid__products .wc-block-grid__product .woocommerce-loop-product__title a:hover,
.wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-title a:hover, ul.products li.product .posted-in a:hover,
ul.products .wc-block-grid__product .posted-in a:hover,
.wc-block-grid__products li.product .posted-in a:hover,
.wc-block-grid__products .wc-block-grid__product .posted-in a:hover, .single-product div.product form.cart .quantity button:hover, .single-product .woocommerce-tabs ul.tabs li a:hover, .sizechart-popup .sizechart-close:hover i, .sizechart-button:hover, .product_list_widget .product-title span:hover, .product_list_widget a:hover, .widget_shopping_cart .mini_cart_item a:hover, .widget_shopping_cart .buttons a:not(.checkout):hover, table.cart td.product-name a:hover, .woocommerce-order .woocommerce-table--order-details .product-name a:hover, .hentry .entry-content .woocommerce-MyAccount-navigation ul li.woocommerce-MyAccount-navigation-link a:hover, .yith_woocompare_colorbox #cboxClose:hover:before, .yith_woocompare_colorbox #cboxClose:active:before, .product-list .posted-in a:hover, .wishlist-title.wishlist-title-with-form h2:hover {
    color: $primary_hover; 
}
CSS;

}
if(isset($primary_hover) && $primary_hover){
    $cssCode .= <<<CSS
        .product-style-1 ul.products li.product a[class*="product_type_"]:hover, .product-style-4 ul.products li.product a[class*="product_type_"]:hover, .product-style-6 ul.products li.product a[class*="product_type_"]:hover, .product-style-2 ul.products li.product a[class*="product_type_"]:hover, .product-style-3 ul.products li.product a[class*="product_type_"]:hover, .product-style-3 ul.products li.product a.loading[class*="product_type_"], .product-style-5 ul.products li.product a[class*="product_type_"]:hover, body #yith-woocompare table.compare-list tr.add-to-cart a:hover, body #yith-woocompare table.compare-list tr.add-to-cart a:active, .product-list .add_to_cart_button:hover {
    background-color: $primary_hover; 
}
CSS;

}
if(isset($primary_hover) && $primary_hover){
    $cssCode .= <<<CSS
        .yith_woocompare_colorbox #cboxClose:hover:before, .yith_woocompare_colorbox #cboxClose:active:before {
    border-color: $primary_hover; 
}
CSS;

}
if(isset($body) && $body){
    $cssCode .= <<<CSS
        .form-row .select2-container--default .select2-selection--single .select2-selection__rendered, p.stars a::before, p.stars a:hover ~ a::before, p.stars.selected a.active ~ a::before, .gridlist-toggle a, .single-product div.product .woocommerce-product-rating a, table.woocommerce-checkout-review-order-table .variation,
table.woocommerce-checkout-review-order-table .product-quantity, .woocommerce-order .woocommerce-table--order-details .product-name a, form.woocommerce-form-login .woocommerce-LostPassword a, .yith_woocompare_colorbox #cboxClose:before, table.wishlist_table td.product-stock-status .wishlist-in-stock, ul.wishlist_table.mobile .item-wrapper .product-name h3:before, ul.wishlist_table.mobile .remove_from_wishlist:before {
    color: $body; 
}
CSS;

}
if(isset($body) && $body){
    $cssCode .= <<<CSS
        .yith_woocompare_colorbox #cboxClose:before {
    border-color: $body; 
}
CSS;

}
if(isset($heading) && $heading){
    $cssCode .= <<<CSS
        .site-header-cart .cart-contents::before, .site-header-cart .cart-contents .amount, .ekommart-handheld-footer-bar ul li > a:before, .ekommart-handheld-footer-bar ul li > a .title, .form-row label, .gridlist-toggle a.active, .gridlist-toggle a:hover, .ekommart-product-pagination a, .ekommart-product-pagination .product-item .ekommart-product-pagination__title, .woocommerce-ordering select, .woocommerce-result-count, ul.products li.product h2 a,
ul.products li.product h3 a,
ul.products li.product .woocommerce-loop-product__title a,
ul.products li.product .wc-block-grid__product-title a,
ul.products .wc-block-grid__product h2 a,
ul.products .wc-block-grid__product h3 a,
ul.products .wc-block-grid__product .woocommerce-loop-product__title a,
ul.products .wc-block-grid__product .wc-block-grid__product-title a,
.wc-block-grid__products li.product h2 a,
.wc-block-grid__products li.product h3 a,
.wc-block-grid__products li.product .woocommerce-loop-product__title a,
.wc-block-grid__products li.product .wc-block-grid__product-title a,
.wc-block-grid__products .wc-block-grid__product h2 a,
.wc-block-grid__products .wc-block-grid__product h3 a,
.wc-block-grid__products .wc-block-grid__product .woocommerce-loop-product__title a,
.wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-title a, .single-product div.product .woocommerce-product-gallery .flex-control-thumbs .slick-prev:before, .single-product div.product .woocommerce-product-gallery .flex-control-thumbs .slick-next:before, .single-product div.product form.cart table.group_table .woocommerce-grouped-product-list-item__label a, .single-product div.product p.price del, .single-product div.product .product_meta .sku_wrapper,
.single-product div.product .product_meta .posted_in,
.single-product div.product .product_meta .tagged_as, .single-product .woocommerce-tabs ul.tabs li a, #reviews .commentlist li p.meta strong, table.shop_attributes th, .ekommart-sticky-add-to-cart__content-title strong, .sizechart-popup .sizechart-close i, .sizechart-button, .single-product-countdown .deal-time .deal-text, .single-product-countdown .deal-time .deal-count .countdown-label, .product_list_widget .product-title span, .widget_shopping_cart .mini_cart_item a, .widget_shopping_cart .mini_cart_item .quantity, .widget_shopping_cart p.total strong, .widget_shopping_cart p.total .amount, .widget_shopping_cart .buttons a:not(.checkout), table.cart th, table.cart tr td[data-title]::before, table.cart td.product-name a, table.cart td.product-quantity .qty, table.cart td.product-subtotal .amount, .cart_totals table th, .cart_totals .cart-subtotal .amount, ul#shipping_method input[type="radio"] + label, .woocommerce-cart .cart-empty, #order_review .woocommerce-checkout-review-order-table th, #order_review .woocommerce-checkout-review-order-table .amount, #payment .payment_methods li > label, table.woocommerce-checkout-review-order-table .product-name, .woocommerce-order .woocommerce-table--order-details th, .woocommerce-order .woocommerce-table--order-details tfoot, form.woocommerce-form-track-order label, #yith-quick-view-close:hover, .hentry .entry-content .woocommerce-MyAccount-navigation ul li.woocommerce-MyAccount-navigation-link a, ul.order_details li strong, .woocommerce-MyAccount-content table th, .woocommerce-MyAccount-content .order_details a:not(.button), .woocommerce-MyAccount-content .order_details tfoot .amount, .product-list .woocommerce-loop-product__title a, .wcml-horizontal-list li.wcml-cs-active-currency a,
.wcml-vertical-list li.wcml-cs-active-currency a, ul.wishlist_table.mobile .amount, .site-header-cart-side .cart-side-title, .site-header-cart-side .close-cart-side {
    color: $heading; 
}
CSS;

}
if(isset($heading) && $heading){
    $cssCode .= <<<CSS
        .shop-action .yith-wcqv-button:hover,
.shop-action .yith-wcwl-add-to-wishlist > div > a:hover,
.shop-action .compare:hover, .single-product .woocommerce-tabs ul.tabs li::after, .site-header-cart-side .close-cart-side:before, .site-header-cart-side .close-cart-side:after {
    background-color: $heading; 
}
CSS;

}
if(isset($heading) && $heading){
    $cssCode .= <<<CSS
        .shop-action .yith-wcqv-button,
.shop-action .yith-wcwl-add-to-wishlist > div > a,
.shop-action .compare, .shop-action .yith-wcqv-button:hover,
.shop-action .yith-wcwl-add-to-wishlist > div > a:hover,
.shop-action .compare:hover {
    border-color: $heading; 
}
CSS;

}
if(isset($light) && $light){
    $cssCode .= <<<CSS
        ul.products li.product .price del,
ul.products .wc-block-grid__product .price del,
.wc-block-grid__products li.product .price del,
.wc-block-grid__products .wc-block-grid__product .price del, ul.products li.product .posted-in a,
ul.products .wc-block-grid__product .posted-in a,
.wc-block-grid__products li.product .posted-in a,
.wc-block-grid__products .wc-block-grid__product .posted-in a, #reviews .commentlist li time, .product_list_widget .product-content del, .product_list_widget .product-content del .amount, .widget_rating_filter .wc-layered-nav-rating a, .woocommerce-MyAccount-content .order_details .product-quantity {
    color: $light; 
}
CSS;

}
if(isset($dark) && $dark){
    $cssCode .= <<<CSS
        .product-style-1 ul.products li.product a[class*="product_type_"], .product-style-4 ul.products li.product a[class*="product_type_"], .product-style-6 ul.products li.product a[class*="product_type_"], .product-style-2 ul.products li.product a[class*="product_type_"] {
    background-color: $dark; 
}
CSS;

}
if(isset($border) && $border){
    $cssCode .= <<<CSS
        .single-product div.product .woocommerce-product-gallery .woocommerce-product-gallery__wrapper, .single-product div.product .woocommerce-product-gallery .flex-viewport {
    color: $border; 
}
CSS;

}
if(isset($border) && $border){
    $cssCode .= <<<CSS
        .form-row .select2-container--default .select2-selection--single, .product-style-1 ul.products li.product .product-block, .product-style-2 ul.products li.product .product-block, .single-product div.product .woocommerce-product-gallery .flex-control-thumbs .slick-prev, .single-product div.product .woocommerce-product-gallery .flex-control-thumbs .slick-next, .single-product div.product .woocommerce-product-gallery .flex-control-thumbs li img, .single-product div.product form.cart table.group_table tr, .ekommart_widget_layered_nav ul.woocommerce-widget-layered-nav-list li .ekommart-button-type, .ekommart_widget_layered_nav ul.woocommerce-widget-layered-nav-list li .ekommart-color-type,
.ekommart_widget_layered_nav ul.woocommerce-widget-layered-nav-list li .ekommart-image-type, table.cart tr td, table.cart td.actions .coupon, table.cart td.actions .coupon .input-text, .cart_totals, .site-header-cart .widget_shopping_cart, #order_review, .yith-wcqv-wrapper .woocommerce-product-gallery__wrapper, ul.order_details li, .wcml-dropdown li,
.wcml-dropdown .wcml-cs-submenu li, table.wishlist_table tbody tr {
    border-color: $border; 
}
CSS;

}
if(isset($border) && $border){
    $cssCode .= <<<CSS
        .ekommart-handheld-footer-bar, .single-product div.product .product_meta, .widget_shopping_cart p.total, .cart_totals .order-total, #order_review .woocommerce-checkout-review-order-table th, #order_review .woocommerce-checkout-review-order-table td, .woocommerce-order .woocommerce-table--order-details td, .woocommerce-order .woocommerce-table--order-details th, .hentry .entry-content .woocommerce-MyAccount-navigation ul {
    border-top-color: $border; 
}
CSS;

}
if(isset($border) && $border){
    $cssCode .= <<<CSS
        .ekommart-sorting, .single-product .woocommerce-tabs, .single-product .woocommerce-tabs ul.tabs, .single-product.ekommart-full-width-content .woocommerce-tabs:after, .single-product.ekommart-full-width-content .woocommerce-tabs ul.tabs:before, .product_list_widget li, .widget_shopping_cart .mini_cart_item, div[class$='filter'], div[class$='filters'], table.cart thead, table.cart .cart_item, .cart_totals > h2, .cart_totals .cart-subtotal, #payment .payment_methods > .woocommerce-PaymentMethod,
#payment .payment_methods > .wc_payment_method, .woocommerce-order .woocommerce-table--order-details thead td,
.woocommerce-order .woocommerce-table--order-details thead th, .hentry .entry-content .woocommerce-MyAccount-navigation ul li, .product-list, .product-item-search, .ekommart-canvas-filter .widget, .filter-close, .site-header-cart-side .cart-side-heading {
    border-bottom-color: $border; 
}
CSS;

}
if(isset($border) && $border){
    $cssCode .= <<<CSS
        .ekommart-handheld-footer-bar ul li > a, .login-form-col {
    border-right-color: $border; 
}
CSS;

}
if(isset($background) && $background){
    $cssCode .= <<<CSS
        .site-header-cart .widget_shopping_cart, .ekommart-handheld-footer-bar ul li > a, .ekommart-handheld-footer-bar ul li.search .site-search, .form-row .select2-container--default .select2-selection--single, .product-style-1 li.product:hover .product-block, .product-style-4 li.product:hover .product-block, .product-style-6 li.product:hover .product-block, .product-style-1 li.product:hover .woocommerce-loop-product__link, .product-style-4 li.product:hover .woocommerce-loop-product__link, .product-style-6 li.product:hover .woocommerce-loop-product__link, .product-style-2 ul.products li.product .product-block, .ekommart-sticky-add-to-cart, .checkout-review-order-table-wrapper, #yith-quick-view-modal .yith-wcqv-main, .site-header-cart-side {
    background-color: $background; 
}
CSS;

}
if(isset($background2) && $background2){
    $cssCode .= <<<CSS
        #order_review {
    background-color: $background2; 
}
CSS;

}
if(isset($white) && $white){
    $cssCode .= <<<CSS
        table.wishlist_table td.product-name a.add_to_cart_button {
    color: $white; 
}
CSS;

}

return $cssCode;
