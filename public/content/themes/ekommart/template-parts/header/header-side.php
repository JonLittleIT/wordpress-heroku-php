<header id="masthead" class="site-header header-side" role="banner" style="<?php ekommart_header_styles(); ?>">
	<div class="header-container container">
		<div class="header-top">
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
        <div class="header-middle desktop-hide-down">
            <?php
            ekommart_primary_navigation();
            ?>
        </div>
        <div class="header-bottom desktop-hide-down">
            <?php
            ekommart_social();
            ?>
        </div>
	</div>
</header><!-- #masthead -->
