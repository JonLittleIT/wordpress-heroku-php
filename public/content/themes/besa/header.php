<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Besa
 * @since Besa 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="//gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="wrapper-container" class="wrapper-container">
 
	<?php besa_tbay_get_page_templates_parts('device/offcanvas-smartmenu'); ?>

	<?php besa_tbay_the_topbar_mobile(); ?>
	
		<?php 
		if( besa_active_mobile_footer_icon() ) {
			besa_tbay_get_page_templates_parts('device/footer-mobile');
		}
	 ?>

	<?php get_template_part( 'page-templates/header' ); ?>

	<div id="tbay-main-content">