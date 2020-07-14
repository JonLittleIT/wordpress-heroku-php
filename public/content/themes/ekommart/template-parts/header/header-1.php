<header id="masthead" class="site-header header-1" role="banner" style="<?php ekommart_header_styles(); ?>">
    <div class="header-container container">
        <div class="header-left">
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
        <div class="header-right desktop-hide-down">
            <div class="col-fluid d-flex">
				<?php
				if ( ekommart_is_woocommerce_activated() ) {
					ekommart_product_search();
				} else {
					?>
                    <div class="site-search">
						<?php get_search_form(); ?>
                    </div>
					<?php
				}
				ekommart_header_contact_info();
				?>
                <div class="header-group-action">
					<?php
					ekommart_header_account();
					if ( ekommart_is_woocommerce_activated() ) {
						ekommart_header_wishlist();
						ekommart_header_cart();
					}
					?>
                </div>
            </div>
            <div class="col-fluid">
				<?php ekommart_primary_navigation(); ?>
            </div>
        </div>
    </div>
</header><!-- #masthead -->
