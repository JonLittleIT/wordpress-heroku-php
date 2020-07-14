<?php
/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php adverts_flash( $adverts_flash ); ?>

<div class="adverts-grid adverts-grid-closed-top">
	<div class="adverts-grid-row">
		<div class="adverts-grid-col adverts-col-65">
			<?php echo esc_html( $listing->post_title ); ?>
		</div>
		<div class="adverts-grid-col adverts-col-35">
			<?php echo esc_html( adverts_price( $price ) ); ?>
		</div>
	</div>  

	<div class="adverts-grid-row">
		<div class="adverts-grid-col adverts-col-65">
			<strong><?php esc_html_e( 'Total', 'adverts' ); ?></strong>
		</div>
		<div class="adverts-grid-col adverts-col-35">
			<strong><?php echo esc_html( adverts_price( $price ) ); ?></strong>
		</div>
	</div>        

</div>

<?php $gateways = adext_payment_gateway_get(); ?>
<?php if ( empty( $gateways ) ) : ?>
<div class="adverts-flash-error">
	<span><?php esc_html_e( 'No Payment Gateway Enabled!', 'adverts' ); ?></span>
</div>
<?php else : ?>

<br/>

<ul class="adverts-tabs adverts-payment-data" data-page-id="<?php echo esc_attr( get_the_ID() ); ?>" data-listing-id="<?php echo esc_attr( $listing->ID ); ?>" data-object-id="<?php echo esc_attr( $post->ID ); ?>">
	<?php foreach ( $gateways as $g_name => $gateway ) : ?>
	<li class="hello adverts-tab-link 
		<?php
		if ( $g_name == adverts_config( 'payments.default_gateway' ) ) :
			?>
		current<?php endif; ?>" data-tab="<?php echo esc_attr( $g_name ); ?>"><?php echo esc_html( $gateway['title'] ); ?></li>
	<?php endforeach; ?>
</ul>
<div class="adverts-tab-content hello	">

</div>

<br/>

<a href="#" class="adverts-button adext-payments-place-order"><?php esc_html_e( 'Place Order', 'adverts' ); ?></a>

<?php endif; ?>
