<?php
/**
 *
 * The default template for displaying content
 * @since 1.0
 * @version 1.2.0
 *
 */

$columns					= besa_tbay_blog_loop_columns('');
$date 						= besa_tbay_get_boolean_query_var('enable_date');
$author 					= besa_tbay_get_boolean_query_var('enable_author');
$categories 				= besa_tbay_get_boolean_query_var('enable_categories');
$cat_type 					= besa_tbay_categories_blog_type();
$short_descriptions 		= besa_tbay_get_boolean_query_var('enable_short_descriptions');
$read_more 					= besa_tbay_get_boolean_query_var('enable_readmore');

$image_position   			= apply_filters( 'besa_archive_image_position', 10,2 );

$class_main = $class_left = '';
if( $image_position == 'left' ) {
	$class_main = 'row';
	$class_left = ' col-md-6';
}

$audiolink =  get_post_meta( get_the_ID(),'tbay_post_audio_link', true );

if( isset($audiolink) && $audiolink ) {

} else {
	$content = apply_filters( 'the_content', get_the_content() );
	$audio = false;
	// Only get audio from the content if a playlist isn't present.
	if ( false === strpos( $content, 'wp-playlist-script' ) ) {
		$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
	}
}

$class_blog = ($columns > 1) ? 'post-grid' : 'post-list';
?>
<!-- /post-standard -->
<?php if ( ! is_single() ) : ?>
<div  class="<?php echo esc_attr( $class_blog ); ?> clearfix position-image-<?php echo esc_attr($class_main); ?>">
<?php endif; ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class($class_main); ?>>
<?php if ( is_single() ) : ?>
	<div class="entry-single">
	<?php echo besa_tbay_post_media( get_the_excerpt() ); ?>
<?php endif; ?>
		<?php
			if ( is_single() ) : ?>
				
	        	<div class="entry-header">
	        		<?php
		                if (get_the_title()) {
		                ?>
		                    <h1 class="entry-title">
		                       <?php the_title(); ?>
		                    </h1>
		                <?php
		            	}
		            ?>

				    <?php besa_post_meta(array(
						'date'     		=> 1,
						'author'   		=> 1,
						'comments' 		=> 1,
						'comments_text' => 1,
						'tags'     		=> 0,
						'cats'     		=> 1,
						'edit'     		=> 0,
					)); ?>
		            
		            <?php 
						besa_tbay_post_share_box();
					?>
				</div>
				<?php if( $audiolink ) : ?>
					<div class="audio-wrap audio-responsive"><?php echo wp_oembed_get( $audiolink ); ?></div>
				<?php elseif( has_post_thumbnail() ) : ?>
					<?php besa_tbay_post_thumbnail(); ?>
				<?php endif; ?>
				<div class="post-excerpt entry-content">
					 

					<?php the_content( esc_html__( 'Continue reading', 'besa' ) ); ?>

					<?php do_action('besa_tbay_post_bottom') ?>
					
				</div><!-- /entry-content -->

				<?php
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'besa' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'besa' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					) );
				?>
		<?php endif; ?>

    <?php if ( ! is_single() ) : ?>

		<?php
		 	if ( has_post_thumbnail() ) {
		  	?>
		  	<figure class="entry-thumb <?php echo esc_attr( $class_left ); ?> <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
				   <?php besa_tbay_post_thumbnail(); 
				 	besa_tbay_icon_post_formats();  
				   ?>
		  	</figure>
		  	<?php
		 	}
		?>
		<div class="entry-content <?php echo esc_attr( $class_left ); ?> <?php echo ( !has_post_thumbnail() ) ? 'no-thumb' : ''; ?>">

			<div class="entry-header">

				<?php besa_post_archive_the_title(); 
				?>

				<?php besa_post_meta(array(
					'date'     => $date,
					'author'     => $author,
					'tags'     => 0,
					'cats'     => $categories,
					'edit'     => 0,
				)); ?>

				<?php if( $short_descriptions ) : ?>
					<?php besa_post_archive_the_short_description(); ?>
				<?php endif; ?>

				<?php if( $read_more ) : ?>
					<?php besa_post_archive_the_read_more(); ?>
				<?php endif; ?>

		    </div>

		</div>

    <?php endif; ?>
    <?php if ( is_single() ) : ?>
</div>
<?php endif; ?>
</article>

<?php if ( ! is_single() ) : ?>
</div>
<?php endif; ?>