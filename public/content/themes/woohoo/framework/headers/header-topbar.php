<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

if( woohoo_get_option( 'bdaia_topbar' ) == 1 )
{
	/**
	 * Top Bar
	 * ========================================================= */

	$bdaia_top_bar_bg_color_css = "";
	$bdaia_top_bar_bg_color         = woohoo_get_option( 'bdaia_top_bar_bg_color' );
	$bdaia_top_bar_text_color       = woohoo_get_option( 'bdaia_top_bar_text_color' );
	$bdaia_top_bar_text_hover_color = woohoo_get_option( 'bdaia_top_bar_text_hover_color' );

	if( !empty( $bdaia_top_bar_bg_color ) ) $bdaia_top_bar_bg_color_css = ' style="background: '.$bdaia_top_bar_bg_color.'"';

	$top_css = "";
	if( !empty( $bdaia_top_bar_text_color ) || !empty( $bdaia_top_bar_text_hover_color ) ) { $top_css  = '<style type="text/css">';
		if( !empty( $bdaia_top_bar_text_color ) ) $top_css .= '.bdaia-header-default .topbar ul.webticker li span, .bdaia-header-default .topbar, .bdaia-header-default .topbar a, .bdaia-header-default .topbar .top-nav > li > a{color: '.$bdaia_top_bar_text_color.';} .bdaia-header-default .topbar .top-nav > li.menu-item-has-children:after{border-top-color: '.$bdaia_top_bar_text_color.';}';
		if( !empty( $bdaia_top_bar_text_hover_color ) ) $top_css .= '.bdaia-header-default .topbar a:hover,.bdaia-header-default .topbar .top-nav > li > a:hover{color: '.$bdaia_top_bar_text_hover_color.';}';
		$top_css .= '</style>';
	}

	echo $top_css; ?>

	<div class="cfix"></div>
	<div class="topbar" <?php echo $bdaia_top_bar_bg_color_css; ?>>
		<div class="bd-container">

			<?php
			// Left Content.
			$bdaia_tb_left_content = woohoo_get_option( 'bdaia_tb_left_content' ); ?>

			<div class="top-left-area">
				<?php
				if( woohoo_get_option( 'bdaia_current_time' ) == 0 )
				{
					if ( woohoo_get_option( 'bdaia_ct_format' ) ) $date_format = woohoo_get_option( 'bdaia_ct_format' );
					else $date_format = 'l ,  j  F Y';

					echo '<span class="bdaia-current-time"> ' . date_i18n( $date_format, strtotime( "11/15-1976" ) ) . '</span>';
				}
				?>

				<?php
				switch ( $bdaia_tb_left_content )
				{
					case 'menu':
						?>
						<?php if ( has_nav_menu( 'topmenu' ) ) { ?>
						<?php wp_nav_menu( array( 'container' => 'ul', 'theme_location' => 'topmenu', 'menu_class' => 'top-nav', 'menu_id'=> 'bdaia-top-nav' ) ); ?>
					<?php } else { ?>
						<span class="menu-info"><?php woohoo_tr( 'Select your Top Menu from wp menus' ); ?></span>
					<?php } ?>
						<?php
						break;

					case 'social':
						echo woohoo_social( 'yes', '32', '' );
						break;

					case 'custom':
						if( woohoo_get_option( 'bdaia_tb_lc_custom' ) ) echo '<div class="top-area-custom">' . do_shortcode( htmlspecialchars_decode( woohoo_get_option( 'bdaia_tb_lc_custom' ) ) ) . '</div>';
						break;

					case 'trending':
						get_template_part( 'framework/global/bdaia-trending' );
						break;
				}
				?>
			</div>

			<?php
			// Right Content.
			$bdaia_tb_right_content = woohoo_get_option( 'bdaia_tb_right_content' ); ?>

			<div class="top-right-area">
				<?php
				switch ( $bdaia_tb_right_content )
				{
					case 'menu':
						?>
						<?php if ( has_nav_menu( 'topmenu' ) ) { ?>
						<?php wp_nav_menu( array( 'container' => 'ul', 'theme_location' => 'topmenu', 'menu_class' => 'top-nav', 'menu_id'=> 'bdaia-top-nav' ) ); ?>
					<?php } else { ?>
						<span class="menu-info"><?php woohoo_tr( "Select your Top Menu from wp menus" ); ?></span>
					<?php } ?>
						<?php
						break;

					case 'social':
						echo woohoo_social( 'yes', '32', '' );
						break;

					case 'custom':
						if( woohoo_get_option( 'bdaia_tb_rc_custom' ) ) echo '<div class="top-area-custom">' . do_shortcode( htmlspecialchars_decode( woohoo_get_option( 'bdaia_tb_rc_custom' ) ) ) . '</div>';
						break;

					case 'trending':
						get_template_part( 'framework/global/bdaia-trending' );
						break;
				}
				?>
			</div>
		</div>
	</div>
	<div class="cfix"></div>
<?php } ?>