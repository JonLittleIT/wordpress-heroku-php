<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Functions hooked in to ekommart_loop_post action.
	 *
	 * @see ekommart_post_thumbnail       - 10
	 * @see ekommart_post_header          - 15
	 * @see ekommart_post_content         - 30
	 */
	do_action( 'ekommart_loop_post' );
	?>

</article><!-- #post-## -->

