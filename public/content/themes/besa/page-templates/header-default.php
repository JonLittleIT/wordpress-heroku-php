
<div class="header-default">
    <div class="container">
        <div class="row">
			<!-- //LOGO -->
            <div class="header-logo col-md-2">
                <?php 
                	besa_tbay_get_page_templates_parts('logo'); 
                ?> 
            </div>
			
			<div class="header-mainmenu col-md-9">
				<?php besa_tbay_get_page_templates_parts('nav'); ?>
			</div>

			<div class="col-md-1">

				<?php if ( !(defined('BESA_WOOCOMMERCE_CATALOG_MODE_ACTIVED') && BESA_WOOCOMMERCE_CATALOG_MODE_ACTIVED) && defined('BESA_WOOCOMMERCE_ACTIVED') && BESA_WOOCOMMERCE_ACTIVED ): ?>
				<!-- Cart -->
				<div class="top-cart hidden-xs">
					<?php besa_tbay_get_woocommerce_mini_cart(); ?>
				</div>
				<?php endif; ?>

			</div>
        </div>
    </div>
</div>
