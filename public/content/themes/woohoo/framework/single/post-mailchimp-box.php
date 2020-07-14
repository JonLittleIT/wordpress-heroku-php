<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

if ( woohoo_can_use_plugin( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ) { ?>
	<div class="widget bdaia-widget widget_mc4wp_form_widget">
		<div class="widget-inner">
			<div class="bdaia-mc4wp-form-icon"><span class="bdaia-io bdaia-io-envelop"></span></div>
			<p class="bdaia-mc4wp-bform-p"><?php woohoo_tr( 'Want more stuff like this?' ); ?></p>
			<p class="bdaia-mc4wp-bform-p2"><?php woohoo_tr( 'Get the best viral stories straight into your inbox!' ); ?></p>
			<?php
			remove_filter( 'mc4wp_form_before_fields', 'woohoo_mc4wp_form_before_form', 10, 2 );
			echo do_shortcode( '[mc4wp_form]' );
			add_filter( 'mc4wp_form_before_fields', 'woohoo_mc4wp_form_before_form', 10, 2 );
			?>
		</div>
	</div>
<?php } ?>