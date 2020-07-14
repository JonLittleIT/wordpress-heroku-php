<header id="masthead" class="site-header header-12" role="banner" style="<?php ekommart_header_styles(); ?>">
	<div class="header-container">
		<div class="container header-main d-flex align-items-center">
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
			<div class="header-center desktop-hide-down">
				<?php ekommart_primary_navigation(); ?>
			</div>
			<div class="header-right desktop-hide-down">
				<div class="header-group-action">
					<?php
					ekommart_header_search_button();
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
</header><!-- #masthead -->
