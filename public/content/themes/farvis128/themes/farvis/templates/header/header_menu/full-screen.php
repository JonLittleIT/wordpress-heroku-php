<!-- ========================== --> 
<!-- FULL SCREEN MENU  --> 
<!-- ========================== -->

<div class="wrap-fixed-menu" id="fixedMenu">
	<nav class="fullscreen-center-menu">

		<button type="button" class="fullmenu-close"><i class="theme-fonts-icon_close"></i></button>

		<?php
			if(farvis_get_option('header_menu_add','')) {
				wp_nav_menu(array(
					'menu'          => farvis_get_option('header_menu_add',''),
					'theme_location' => 'primary_nav',
					'container' 	=> 'div',
					'container_class' => 'dl-menuwrapper',
					'container_id'    => 'dl-menu',
					'menu_class'    => 'dl-menu menu-item list-unstyled',
					'link_before'     => '<span>',
					'link_after'      => '</span>',
					'walker' 		=> new farvis_Walker_FullScreen_Menu(),
				));
			} else {
				esc_attr_e('Additional menu has not been selected. Do this in the Customize &rarr; Header &rarr; Additional Menu.', 'farvis');
			}
		?>

    </nav>
</div>
