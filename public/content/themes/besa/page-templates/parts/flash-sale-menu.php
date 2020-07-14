<?php if ( has_nav_menu( 'flash-sale' ) ): ?>
    <div class="top-flashsale">
		<nav class="flash-sale-topmenu">
			<?php
				$args = array(
					'theme_location'  => 'flash-sale',
					'container_class' => 'collapse navbar-collapse',
					'fallback_cb'     => '',
					'menu_id'         => 'flash-sale',
					'walker' => new Besa_Tbay_Nav_Menu()
				);
				wp_nav_menu($args);
			?>
		</nav>
    </div>
<?php endif; ?>