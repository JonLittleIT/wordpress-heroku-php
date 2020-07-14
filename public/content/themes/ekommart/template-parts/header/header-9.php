<header id="masthead" class="site-header header-9" role="banner" style="<?php ekommart_header_styles(); ?>">
	<div class="header-container">
		<div class="header-top desktop-hide-down">
			<div class="container d-flex">
				<?php
				ekommart_site_welcome();
				ekommart_language_switcher();
				?>
			</div>
		</div>
		<div class="header-divider tablet-hide-down"></div>
		<div class="header-main">
			<div class="container">
				<div class="row align-items-center">
					<div class="header-left column-12 column-desktop-3 d-flex align-items-center justify-content-between">
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
					<div class="header-center column-desktop-6 desktop-hide-down">
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
					<div class="header-right column-desktop-3 desktop-hide-down">
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
		</div>
		<div class="header-navigation header-navigation-background desktop-hide-down">
			<div class="container">
				<?php ekommart_primary_navigation();?>
			</div>
		</div>
	</div>
</header><!-- #masthead -->
