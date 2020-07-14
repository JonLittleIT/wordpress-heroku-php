
		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'ekommart_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
		/**
		 * Functions hooked in to ekommart_footer action
		 *
		 * @see ekommart_footer_default - 20
         * @see ekommart_handheld_footer_bar - 25 - woo
		 *
		 */
		do_action( 'ekommart_footer' );

		?>

	</footer><!-- #colophon -->

	<?php

		/**
		 * Functions hooked in to ekommart_after_footer action
		 * @see ekommart_sticky_single_add_to_cart 	- 999 - woo
		 */
		do_action( 'ekommart_after_footer' );
	?>

</div><!-- #page -->

<?php

/**
 * Functions hooked in to wp_footer action
 * @see ekommart_template_account_dropdown 	- 1
 * @see ekommart_mobile_nav - 1
 * @see ekommart_render_woocommerce_shop_canvas - 1 - woo
 */

wp_footer();
?>

</body>
</html>
