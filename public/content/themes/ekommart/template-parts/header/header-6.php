<header id="masthead" class="site-header header-6" role="banner" style="<?php ekommart_header_styles(); ?>">
	<div class="header-container">
		<div class="header-top desktop-hide-down">
			<div class="container header-top-inner d-flex">
				<?php
				ekommart_site_welcome();
				ekommart_language_switcher();
				?>
			</div>
		</div>
		<div class="container header-main d-flex">
			<div class="header-left d-flex align-items-center justify-content-between">
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
				<?php
				ekommart_header_contact_info();
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
			<div class="header-right desktop-hide-down">
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
		<div class="header-divider desktop-hide-down"></div>
		<div class="container header-navigation desktop-hide-down">
			<div class="row">
				<div class="column-desktop-3">
					<?php ekommart_vertical_navigation();?>
				</div>
				<div class="column-desktop-9">
					<?php ekommart_primary_navigation(); ?>
				</div>
			</div>
		</div>
	</div>
</header><!-- #masthead -->
