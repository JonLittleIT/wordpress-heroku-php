<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to ekommart_page action
	 *
	 * @see ekommart_page_header          - 10
	 * @see ekommart_page_content         - 20
	 *
	 */
	do_action( 'ekommart_page' );
	?>
</article><!-- #post-## -->
