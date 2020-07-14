<?php
if(isset($primary) && $primary){
    $cssCode .= <<<CSS
        .elementor-widget-ekommart-countdown .elementor-countdown-digits, .ekommart-image-box-sub-title, .post-style-1 .categories-link a, .post-style-2 .entry-meta .posted-on a:hover,
.post-style-2 .entry-meta .post-author a:hover, .post-style-3 .post-inner:hover .entry-title a:hover, .post-style-3 .entry-title a:hover, .post-style-4 .entry-meta a:hover, .elementor-widget-ekommart-product-categories .cat-title a:hover, .product-cat-style-5 .cat-total, .elementor-widget-ekommart-products-tabs .elementor-tab-title:hover, .elementor-widget-ekommart-products-tabs .elementor-tab-title.elementor-active, .woocommerce-product-list ul.products .product-content .amount, .woocommerce-product-list ul.products .product-title span:hover, .woocommerce-product-list ul.products .price, .woocommerce-product-list.producs-list-5 ul.products .product-list-inner .posted-in a:hover, .elementor-widget-container .elementor-teams-wrapper .team-name a:hover, .elementor-widget-container .elementor-teams-wrapper .team-name:hover, .elementor-widget-container .elementor-teams-wrapper .team-icon-socials ul li.social a:hover, .elementor-testimonial-item-wrapper .title, .elementor-view-framed .elementor-icon,
.elementor-view-default .elementor-icon, .elementor-widget-container .elementor-accordion .elementor-accordion-item .elementor-tab-title .elementor-accordion-icon .elementor-accordion-icon-opened {
    color: $primary; 
}
CSS;

}
if(isset($primary) && $primary){
    $cssCode .= <<<CSS
        .elementor-view-framed .elementor-icon,
.elementor-view-default .elementor-icon {
    fill: $primary; 
}
CSS;

}
if(isset($primary) && $primary){
    $cssCode .= <<<CSS
        .instagram-widget .wrapp-box, .post-style-1 .post-inner:hover .entry-meta, .post-style-3 .post-inner:hover .entry-meta, .elementor-widget-ekommart-product-categories .product-cat:hover .cat-total, .product-cat-style-3 .cat-total, .time-sale .ekommart-countdown .countdown-item .countdown-digits, .animated-slide-column:after, .elementor-element.elementor-button-primary .elementor-button, .elementor-view-stacked .elementor-icon {
    background-color: $primary; 
}
CSS;

}
if(isset($primary) && $primary){
    $cssCode .= <<<CSS
        .elementor-widget-container .form-style .mc4wp-form .mc4wp-form-fields input[type="email"]:focus, .elementor-widget-ekommart-products-deals .fieldset, .elementor-widget-ekommart-products-deals .legend:before, .elementor-widget-ekommart-products-deals .legend:after, .elementor-widget-ekommart-products-tabs .elementor-tab-title:hover, .elementor-widget-ekommart-products-tabs .elementor-tab-title.elementor-active, .elementor-widget-container .elementor-teams-wrapper .team-icon-socials ul li.social a:hover, .elementor-view-framed .elementor-icon,
.elementor-view-default .elementor-icon {
    border-color: $primary; 
}
CSS;

}
if(isset($body) && $body){
    $cssCode .= <<<CSS
        .elementor-widget-container .elementor-teams-wrapper .team-icon-socials ul li.social a, .elementor-widget-container .elementor-teams-wrapper .team-description {
    color: $body; 
}
CSS;

}
if(isset($heading) && $heading){
    $cssCode .= <<<CSS
        .elementor-widget-ekommart-products-deals .element-deal-title, .elementor-widget-ekommart-products-tabs .elementor-tab-title, .woocommerce-product-list ul.products .product-title span, .time-sale .deal-text, .time-sale .ekommart-countdown .countdown-item .countdown-label, .elementor-widget-container .elementor-teams-wrapper .team-name, .elementor-widget-container .elementor-teams-wrapper .team-name a, .elementor-testimonial-item-wrapper .content, .elementor-testimonial-item-wrapper .details, .elementor-widget-container .elementor-accordion .elementor-accordion-item .elementor-tab-title, .elementor-widget-container .elementor-accordion .elementor-accordion-item .elementor-tab-title .elementor-accordion-icon, .elementor-widget-container .elementor-accordion .elementor-accordion-item .elementor-tab-title a, .elementor-widget-container .elementor-accordion .elementor-accordion-item .elementor-tab-title.elementor-active, .elementor-widget-container .elementor-accordion .elementor-accordion-item .elementor-tab-title.elementor-active a {
    color: $heading; 
}
CSS;

}
if(isset($heading) && $heading){
    $cssCode .= <<<CSS
        .elementor-widget-ekommart-countdown .elementor-countdown-item:after, .elementor-widget-ekommart-products-tabs .elementor-tab-title:before {
    background-color: $heading; 
}
CSS;

}
if(isset($light) && $light){
    $cssCode .= <<<CSS
        .post-style-1 .entry-meta, .post-style-2 .entry-meta, .post-style-2 .entry-meta .posted-on a,
.post-style-2 .entry-meta .post-author a, .post-style-4 .entry-meta, .post-style-4 .entry-meta a, .woocommerce-product-list ul.products .product-content del, .woocommerce-product-list ul.products .product-content del .amount, .elementor-widget-container .elementor-teams-wrapper .team-job {
    color: $light; 
}
CSS;

}
if(isset($dark) && $dark){
    $cssCode .= <<<CSS
        .post-style-3 .entry-meta {
    background-color: $dark; 
}
CSS;

}
if(isset($border) && $border){
    $cssCode .= <<<CSS
        .post-style-3 .entry-content, .post-style-4 .post-inner, .product-cat-style-3 .cat-image, .product-cat-style-4 .cat-image, .woocommerce-product-list.producs-list-2 ul.products .product-list-inner, .woocommerce-product-list.producs-list-4 ul.products .product-list-inner, .woocommerce-product-list.producs-list-5 ul.products .product-list-inner, .elementor-widget-container .elementor-teams-wrapper .team-icon-socials ul li.social a {
    border-color: $border; 
}
CSS;

}
if(isset($border) && $border){
    $cssCode .= <<<CSS
        .woocommerce-product-list ul.products .product-list-inner, .time-sale {
    border-top-color: $border; 
}
CSS;

}
if(isset($border) && $border){
    $cssCode .= <<<CSS
        .elementor-widget-container .elementor-accordion .elementor-accordion-item {
    border-bottom-color: $border; 
}
CSS;

}
if(isset($border) && $border){
    $cssCode .= <<<CSS
        .border-wrapper-yes .woocommerce-carousel ul.products {
    border-left-color: $border; 
}
CSS;

}
if(isset($border) && $border){
    $cssCode .= <<<CSS
        .border-wrapper-yes .woocommerce-carousel ul.products {
    border-right-color: $border; 
}
CSS;

}
if(isset($background) && $background){
    $cssCode .= <<<CSS
        .post-style-1 .post-header-content, .woocommerce-product-list ul.products .product-list-inner {
    background-color: $background; 
}
CSS;

}
if(isset($white) && $white){
    $cssCode .= <<<CSS
        .instagram-widget .instagram-box-title {
    color: $white; 
}
CSS;

}

return $cssCode;
