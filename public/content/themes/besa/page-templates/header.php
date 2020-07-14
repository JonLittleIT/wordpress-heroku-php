<?php 

$header 	= apply_filters( 'besa_tbay_get_header_layout', 'header_default' );

if ( !(defined('BESA_WOOCOMMERCE_CATALOG_MODE_ACTIVED') && BESA_WOOCOMMERCE_CATALOG_MODE_ACTIVED) && defined('BESA_WOOCOMMERCE_ACTIVED') && BESA_WOOCOMMERCE_ACTIVED ) {
	wc_get_template_part('myaccount/custom-form-login'); 
}

?>

<header id="tbay-header" class="tbay_header-template site-header">

	<?php if ( $header != 'header_default' ) : ?>	

		<?php besa_tbay_display_header_builder(); ?> 

	<?php else : ?>
	
	<?php get_template_part( 'page-templates/header-default' ); ?>

	<?php endif; ?>
	<div id="nav-cover"></div>
</header>