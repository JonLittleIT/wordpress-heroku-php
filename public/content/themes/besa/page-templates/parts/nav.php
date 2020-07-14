<?php if ( has_nav_menu( 'primary' ) ) : ?>
    <nav data-duration="400" class="hidden-xs hidden-sm tbay-megamenu slide animate navbar tbay-horizontal-default">
    <?php
        $args = array(
            'theme_location' => 'primary',
            'menu_class' => 'nav navbar-nav megamenu',
            'fallback_cb' => '',
            'menu_id' => 'primary-menu',
			'walker' => new besa_Tbay_Nav_Menu()
        );
        wp_nav_menu($args);
    ?>
    </nav>
<?php endif; ?>