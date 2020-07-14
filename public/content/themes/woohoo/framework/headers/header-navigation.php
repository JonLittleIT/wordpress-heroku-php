<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

/**
 * Main menu
 * ========================================================= */

$bdaia_main_menu_bg_color_css = "";
$bdaia_main_menu_bg_color           = woohoo_get_option( 'bdaia_main_menu_bg_color' );
$bdaia_main_menu_text_color         = woohoo_get_option( 'bdaia_main_menu_text_color' );
$bdaia_main_menu_text_hover_color   = woohoo_get_option( 'bdaia_main_menu_text_hover_color' );
$bdaia_main_menu_active_bg          = woohoo_get_option( 'bdaia_main_menu_active_bg' );
$bdaia_main_menu_top_border         = woohoo_get_option( 'bdaia_main_menu_top_border' );
$bdaia_mn_dd_skin                   = woohoo_get_option( 'bdaia_mn_dd_skin' );
$bdaia_mn_skin                      = woohoo_get_option( 'bdaia_mn_skin' );
$bd_center_nav_menu                 = woohoo_get_option( 'bd_center_nav_menu' );

$mn_dd_skin = $mn_mn_skin = $bd_center_nav_menu_class = '';
if ( $bdaia_mn_dd_skin   == 'light' ) $mn_dd_skin = 'dropdown-light ';
if ( $bdaia_mn_skin      == 'dark'  ) $mn_mn_skin = 'mainnav-dark';
if ( !empty( $bd_center_nav_menu ) ) $bd_center_nav_menu_class = ' center-item-menu ';
if ( !empty( $bdaia_main_menu_bg_color ) ) $bdaia_main_menu_bg_color_css = ' style="background: '.$bdaia_main_menu_bg_color.'; border-top-color:transparent !important"';

$main_css = "";
if( !empty( $bdaia_main_menu_text_color ) || !empty( $bdaia_main_menu_text_hover_color ) || !empty( $bdaia_main_menu_active_bg ) ) { $main_css  = '<style type="text/css">';
	if( !empty( $bdaia_main_menu_text_color ) ) $main_css .= '.bdaia-header-default #navigation .primary-menu #menu-primary > li > a, #navigation .bdaia-cart, .bdaia-nav-search, #navigation .bdaia-random-post{color: '.$bdaia_main_menu_text_color.';} .bdaia-header-default #navigation .primary-menu #menu-primary > li.bd_mega_menu > a:before, .bdaia-header-default #navigation .primary-menu #menu-primary > li.menu-item-object-category > a:before, .bdaia-header-default #navigation .primary-menu #menu-primary > li.menu-item-has-children > a:before, .bdaia-header-default #navigation .primary-menu #menu-primary > li.bd_mega_menu > a:before, .bdaia-header-default #navigation .primary-menu #menu-primary > li.menu-item-object-category.bd_cats_menu > a:before, .bdaia-header-default #navigation .primary-menu #menu-primary > li.menu-item-has-children > a:before{border-top-color:'.$bdaia_main_menu_text_color.';}';
	if( !empty( $bdaia_main_menu_text_hover_color ) ) $main_css .= '.bdaia-header-default #navigation .primary-menu #menu-primary > li > a:hover, .bdaia-header-default #navigation .primary-menu #menu-primary > li:hover > a {color: '.$bdaia_main_menu_text_hover_color.';}';
	if( !empty( $bdaia_main_menu_active_bg ) || !empty( $bdaia_main_menu_text_hover_color ) ) $main_css .= '.bdaia-header-default #navigation .primary-menu ul#menu-primary > li:hover > a, .bdaia-header-default #navigation .primary-menu ul#menu-primary > li.current-menu-item > a, .bdaia-header-default #navigation .primary-menu ul#menu-primary > li.current-menu-ancestor > a, .bdaia-header-default #navigation .primary-menu ul#menu-primary > li.current-menu-parent > a, #navigation .bdaia-cart, .bdaia-nav-search, #navigation .bdaia-random-post {background: '.$bdaia_main_menu_active_bg.'; border : 0 none !important; color: '.$bdaia_main_menu_text_hover_color.';}';
	if( !empty( $bdaia_main_menu_top_border ) ) $main_css .= '.bdaia-header-default #navigation .primary-menu ul#menu-primary > li >.bd_mega.sub-menu, .bdaia-header-default #navigation .primary-menu ul#menu-primary > li > .sub-menu, .bdaia-header-default #navigation .primary-menu ul#menu-primary .sub_cats_posts{border-top-color:'.$bdaia_main_menu_top_border.';} .bdaia-ns-wrap:after, .bdaia-header-default #navigation .primary-menu ul#menu-primary > li:hover > a:after, .bdaia-header-default #navigation .primary-menu ul#menu-primary > li.current-menu-item > a:after, .bdaia-header-default #navigation .primary-menu ul#menu-primary > li.current-menu-ancestor > a:after, .bdaia-header-default #navigation .primary-menu ul#menu-primary > li.current-menu-parent > a:after{background:'.$bdaia_main_menu_top_border.';}';
	$main_css .= '</style>';
}
echo $main_css; ?>

<div class="cfix"></div>
<nav id="navigation" class="<?php echo $mn_dd_skin, $mn_mn_skin, $bd_center_nav_menu_class; ?>"<?php echo $bdaia_main_menu_bg_color_css; ?>>
	<div class="navigation-wrapper"<?php echo $bdaia_main_menu_bg_color_css; ?>>
		<div class="bd-container">
			<div class="primary-menu">
				<?php if( woohoo_get_option( 'bdaia_mn_position' ) != "hibryd_menu" ) { ?>
					<?php if( woohoo_get_option( 'bdaia_nav_logo' ) ) { ?>
						<a class="nav-logo" title="<?php bloginfo('name'); ?>" href="<?php echo esc_url(home_url()); ?>/">
							<img src="<?php echo woohoo_get_option( 'bdaia_nav_logo' ) ?>" width="195" height="48" alt="<?php bloginfo( 'name' ); ?>" />
						</a>
					<?php } ?>
				<?php } ?>
				<?php if( woohoo_get_option( 'bdaia_mn_position' ) == "hibryd_menu" ) { ?>
					<?php get_template_part( 'framework/global/logo' ); ?>
				<?php } ?>
				<ul id="menu-primary">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 5, 'container' => false, 'echo' => true, 'menu_class' => '','menu_id'=> 'menu-primary', 'items_wrap' => '%3$s', 'walker' => new WOOHOO_Walker() ) ); ?>
				</ul>
			</div>

            <div class="nav-right-area">
			<?php
			$bdaia_new_articles_npost = woohoo_get_option( 'bdaia_new_articles_npost' );
			if( woohoo_get_option( 'bdaia_new_articles' ) ){ ?>
				<span class="bdaia-alert-new-posts">
					<span class="n"><?php if( !empty( $bdaia_new_articles_npost ) ) echo $bdaia_new_articles_npost; else echo '12'; ?></span>
					<span class="t">
						<small><?php woohoo_tr( 'New' ); ?></small>
						<small><?php woohoo_tr( 'Articles' ); ?></small>
					</span>
				</span>
			<?php } ?>

			<?php if( woohoo_get_option( 'bdaia_mn_search' ) == 0 ) { ?>
				<div class="bdaia-nav-search">
					<span class="bdaia-ns-btn bdaia-io bdaia-io-search"></span>
					<div class="bdaia-ns-wrap">
						<div class="bdaia-ns-content">
							<div class="bdaia-ns-inner">
								<form method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>/">
									<input type="text" class="bbd-search-field search-live" id="s" name="s" value="<?php woohoo_tr('Search') ?>" onfocus="if (this.value == '<?php woohoo_tr('Search') ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php woohoo_tr('Search') ?>';}"  />
									<button type="submit" class="bbd-search-btn"><span class="bdaia-io bdaia-io-search"></span></button>
								</form>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>

			<?php if( woohoo_get_option( 'bdaia_login_icon' ) == 1 ) { ?>
				<a href="#woohoo-login-join" class="bdaia-login-icon woohoo-login-join-btn ttip"><span class="bdaia-io bdaia-io-user"></span></a>
			<?php } ?>

			<?php
            if ( woohoo_get_option( 'bdaia_shop_cart' ) && WOOHOO_WOOCOMMERCE_IS_ACTIVE ) :
                $cart_count_items = WC()->cart->get_cart_contents_count(); ?>
					<a class="bdaia-cart ttip" href="<?php echo WC()->cart->get_cart_url() ?>" title="<?php woohoo_tr( 'View your shopping cart' ); ?>">
						<?php if( ! empty( $cart_count_items ) ) { ?>
							<span class="shooping-count pulse"><?php echo $cart_count_items; ?></span>
						<?php } ?>
						<span class="shooping-count-outer"><span class="bdaia-io bdaia-io-cart"></span></span>
					</a>
			<?php endif; ?>

			<?php if( woohoo_get_option( 'bdaia_random_article' ) == 1 ) { ?>
				<a href="<?php echo esc_url( home_url() ); ?>/?randpost=1" class="bdaia-random-post ttip" title="<?php woohoo_tr( 'Random Article' ) ?>"><span class="bdaia-io bdaia-io-newspaper"></span></a>
			<?php } ?>

            </div>

			<?php if( woohoo_get_option( 'bdaia_new_articles' ) ){ ?>
				<div class="cfix"></div>
				<div class="bdaia-alert-new-posts-content">
					<div class="bdaia-alert-new-posts-inner">
						<div class="bdaia-anp-inner">
							<ul>
							<?php
							global $post;
							$original_post = $post;
							$anp_i = 1;

							if( !empty( $bdaia_new_articles_npost ) ) {
								$bdaia_alert_new_posts_args['posts_per_page'] = $bdaia_new_articles_npost;
							}
							else {
								$bdaia_alert_new_posts_args['posts_per_page'] = 12;
							}

							$bdaia_alert_new_posts_args['post_status']        = 'publish';
							$bdaia_alert_new_posts_args['cache_results']      = false;
							$bdaia_alert_new_posts_args['no_found_rows']      = true;
							$bdaia_alert_new_posts_args['ignore_sticky_posts']= true;
							$bdaia_alert_new_posts_query = new WP_Query( $bdaia_alert_new_posts_args );
							if ( $bdaia_alert_new_posts_query->have_posts() ) :
								while ( $bdaia_alert_new_posts_query->have_posts() ) : $bdaia_alert_new_posts_query->the_post();
									//if ( $anp_i % 3 == 1 ) echo '<ul>'; ?>
								<li>
									<a href="<?php the_permalink(); ?>">
										<span class="ti"><?php woohoo_get_time(); //echo get_the_time( 'g:i:s a', get_the_ID() ); ?></span>
										<span class="tit"><?php the_title(); ?></span>
									</a>
								</li>
								<?php //if ( $anp_i % 3 == 0 ) echo '</ul>'; ?>
							<?php $anp_i++; endwhile; wp_reset_query(); endif; $post = $original_post; ?>
							<?php //if ( $anp_i % 3 != 1 ) echo "</ul>";?>
							</ul>
						</div>
						<div class="cfix"></div>
					</div>
				</div>
			<?php } ?>

			<div class="cfix"></div>
		</div>
	</div>
</nav>
<div class="cfix"></div>
