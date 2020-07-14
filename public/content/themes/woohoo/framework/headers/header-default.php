<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

/**
 * Top Border Color
 * ========================================================= */

$bdaia_top_bar_border_color_css = "";
$bdaia_top_bar_border_color = woohoo_get_option( 'bdaia_top_bar_border_color' );
if( !empty( $bdaia_top_bar_border_color ) ) $bdaia_top_bar_border_color_css = ' style ="border-top-color: '.$bdaia_top_bar_border_color.'"';

/**
 * Header
 * ========================================================= */

$header_bg  = woohoo_get_option( 'bdaia_header_bg' );
$header_css = "";
if( !empty( $header_bg['color'] ) || !empty( $header_bg['img'] ) ) { $header_css  = ' style ="';
	if( !empty( $header_bg['color'] ) ) $header_css .= 'background-color:'.$header_bg['color'].';';
	if( !empty( $header_bg['img'] ) ) $header_css .= 'background-image: url('.$header_bg['img'].');';
	if( !empty( $header_bg['repeat'] ) ) $header_css .= 'background-repeat:'.$header_bg['repeat'].';';
	if( !empty( $header_bg['attachment'] ) ) $header_css .= 'background-attachment:'.$header_bg['attachment'].';';
	if( !empty( $header_bg['hor'] ) || !empty( $header_bg['ver'] ) ) $header_css .= 'background-position:'.$header_bg['hor'].' '.$header_bg['ver'].';';
	$header_css .= '"';
}

$header_class = "";
if( woohoo_get_option( 'bdaia_mn_position' ) == "hibryd_menu" ) $header_class = " bdaia-hibryd-menu"; ?>

<div class="header-wrapper<?php echo $header_class; ?>"<?php echo $bdaia_top_bar_border_color_css; ?>>

	<?php if ( ! woohoo_get_option( 'dis_mobile_menu' ) ) { ?>
		<div class="bdayh-click-open">
			<div class="bd-ClickOpen bd-ClickAOpen">
				<span></span>
			</div>
		</div>
	<?php } ?>

	<?php
	// Topbar.
	get_template_part( 'framework/headers/header-topbar' ); ?>

	<?php
	// Above Header Ad.
	$bdaia_above_header_ad = woohoo_get_option( 'bdaia_above_header_ad'      );

	if( $bdaia_above_header_ad ) { ?>
		<div class="cfix"></div><div class="bdaia-header-e3-desktop bdaia-above-header"><div class="bdaia-e3-container"><?php echo do_shortcode( ( stripslashes( $bdaia_above_header_ad ) ) ); ?></div></div><div class="cfix"></div>
	<?php } ?>

	<?php
	// Main navigation.
	if( woohoo_get_option( 'bdaia_mn_position' ) == "above_header" ) get_template_part( 'framework/headers/header-navigation' ); ?>

	<?php if( woohoo_get_option( 'bdaia_mn_position' ) != "hibryd_menu" ) { ?>
		<header class="header-container"<?php echo $header_css; ?>>
			<div class="bd-container">
				<?php get_template_part( 'framework/global/logo' ); ?>
				<?php get_template_part( 'framework/headers/header-e3' ); ?>
			</div>
		</header>
	<?php } ?>

	<?php
	// Main navigation.
	if( woohoo_get_option( 'bdaia_mn_position' ) == "" || woohoo_get_option( 'bdaia_mn_position' ) == "below_header" || woohoo_get_option( 'bdaia_mn_position' ) == "hibryd_menu" ) get_template_part( 'framework/headers/header-navigation' ); ?>

</div>

<?php
// Bellow Header Ad.
$bdaia_bellow_header_ad = woohoo_get_option( 'bdaia_bellow_header_ad'      );

if( $bdaia_bellow_header_ad ) { ?>
	<div class="cfix"></div><div class="bdaia-header-e3-desktop bdaia-bellow-header"><div class="bdaia-e3-container"><?php echo do_shortcode( ( stripslashes( $bdaia_bellow_header_ad ) ) ); ?></div></div><div class="cfix"></div>
<?php } ?>

<?php
// Below Header Box.
if( is_home() || is_front_page() || is_page() )
{
	$b_h_b = $b_h_b_t = $b_h_b_b = "";
	$get_page_more = get_post_meta( get_the_ID(), 'meta_page_custom_bd', true );

	if( isset( $get_page_more['bdaia_code_below_header'] ) ) $b_h_b = $get_page_more['bdaia_code_below_header'];
	if( isset( $get_page_more['bdaia_code_below_header_t'] ) ) $b_h_b_t = $get_page_more['bdaia_code_below_header_t'];
	if( isset( $get_page_more['bdaia_code_below_header_b'] ) ) $b_h_b_b = $get_page_more['bdaia_code_below_header_b'];

	$b_h_b_m = '';
	if ( ! empty( $b_h_b_t ) || ! empty( $b_h_b_b ) ) {
		$b_h_b_m = ' style="';
		if ( ! empty( $b_h_b_t ) ) {
			$b_h_b_m .= ' margin-top:' . $b_h_b_t . 'px;';
		}
		if ( ! empty( $b_h_b_b ) ) {
			$b_h_b_m .= ' margin-bottom:' . $b_h_b_b . 'px;';
		}
		$b_h_b_m .= '"';
	}

	if ( ! empty( $b_h_b ) ) {
		?>
		<div class="cfix"></div>
		<div class="bdaia-custom-area"<?php echo $b_h_b_m; ?>>
			<div class="bd-container">
				<?php echo do_shortcode( htmlspecialchars_decode( stripslashes( $b_h_b ) ) ); ?>
			</div>
		</div>
		<div class="cfix"></div>
		<?php
	}
}
?>

<?php
// Breaking News.
if( woohoo_get_option( 'bdaia_head_bn_position' ) == "" || woohoo_get_option( 'bdaia_head_bn_position' ) == "below_header" ) get_template_part( 'framework/global/bdaia-breaking-news' ); ?>
