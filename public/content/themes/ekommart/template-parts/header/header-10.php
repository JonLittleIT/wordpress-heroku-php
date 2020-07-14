<header id="masthead" class="site-header header-10" role="banner" style="<?php ekommart_header_styles(); ?>">
	<div class="header-container">
		<div class="container header-main">
			<div class="row align-items-center">
				<div class="column-12 header-left column-desktop-3 desktop-hide-down">
					<?php
					ekommart_language_switcher();
					?>
				</div>
				<div class="column-12 header-center column-desktop-6 d-flex align-items-center">
					<?php
					ekommart_site_branding();
					if ( ekommart_is_woocommerce_activated() ) {
						?>
                        <div class="site-header-cart header-cart-mobile">
							<?php ekommart_cart_link();?>
                        </div>
						<?php
					}
					?>
					<?php ekommart_mobile_nav_button(); ?>
				</div>
				<div class="column-desktop-3 header-right tablet-hide-down desktop-hide-down">
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
		<div class="header-divider desktop-hide-down"></div>
		<div class="container header-navigation desktop-hide-down">
			<?php ekommart_primary_navigation();?>
		</div>
	</div>
</header><!-- #masthead -->
