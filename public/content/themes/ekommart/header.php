<!doctype html>
<html <?php language_attributes(); ?> class="<?php echo ekommart_get_theme_option( 'site_mode' ) == 'dark' ? esc_attr( 'site-dark' ) : ''; ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
	<link rel="profile" href="//gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php do_action( 'ekommart_before_site' ); ?>

<div id="page" class="hfeed site">
	<?php
	/**
	 * Functions hooked in to ekommart_before_header action
	 *
	 * @see ekommart_deal_topbar - 5
     * @see ekommart_header_sticky - 10
	 *
	 */
	do_action( 'ekommart_before_header' );

	get_template_part( 'template-parts/header/header', ekommart_get_theme_option( 'header-type', 1 ) );

	/**
	 * Functions hooked in to ekommart_before_content action
	 *
	 * @see ekommart_breadcrumb - 10
	 *
	 */
	do_action( 'ekommart_before_content' );
	?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="col-full">

<?php
/**
 * Functions hooked in to ekommart_content_top action
 *
 * @see ekommart_shop_messages - 10 - woo
 */
do_action( 'ekommart_content_top' );
