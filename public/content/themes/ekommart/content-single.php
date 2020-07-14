<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Functions hooked in to ekommart_single_post_top action
	 *
	 * @see ekommart_post_thumbnail       - 10
	 */
	do_action( 'ekommart_single_post_top' );

	/**
	 * Functions hooked in to ekommart_single_post action
	 *
	 * @see ekommart_post_header          - 10
	 * @see ekommart_post_content         - 30
	 */
	do_action( 'ekommart_single_post' );

	/**
	 * Functions hooked in to ekommart_single_post_bottom action
	 *
	 * @see ekommart_post_taxonomy      - 5
	 * @see ekommart_post_nav         	- 10
	 * @see ekommart_display_comments 	- 20
	 */
	do_action( 'ekommart_single_post_bottom' );
	?>

</article><!-- #post-## -->
