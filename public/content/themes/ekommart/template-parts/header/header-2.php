<header id="masthead" class="site-header header-2" role="banner" style="<?php ekommart_header_styles(); ?>">
    <div class="header-top desktop-hide-down">
        <div class="container">
            <div class="row">
                <div class="column-tablet-6">
                    <?php ekommart_site_welcome(); ?>
                </div>
                <div class="column-tablet-6 text-right">
                    <?php ekommart_language_switcher(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container header-main">
        <div class="row align-items-center">
            <div class="column-desktop-3 column-12 header-group-mobile">
	            <?php

	            ekommart_site_branding();
	            if ( ekommart_is_woocommerce_activated() ) {
		            ?>
                    <div class="site-header-cart header-cart-mobile">
			            <?php ekommart_cart_link();?>
                    </div>
		            <?php
	            }
	            ekommart_mobile_nav_button();
	            ?>
            </div>
            <div class="column-desktop-6 desktop-hide-down">
                <?php
                if(ekommart_is_woocommerce_activated()) {
	                ekommart_product_search();
                }else {
	                ?>
                    <div class="site-search">
		                <?php get_search_form(); ?>
                    </div>
	                <?php
                }
                ?>
            </div>
            <div class="column-desktop-3 desktop-hide-down">
                <div class="header-group-action">
                    <?php
                    ekommart_header_account();
                    if(ekommart_is_woocommerce_activated()) {
	                    ekommart_header_wishlist();
	                    ekommart_header_cart();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom desktop-hide-down header-navigation-background">
        <div class="container">
            <div class="row">
                <div class="column-3">
                    <?php ekommart_vertical_navigation()?>
                </div>
                <div class="column-9">
                    <?php ekommart_primary_navigation(); ?>
                </div>
            </div>
        </div>
    </div>
</header><!-- #masthead -->
