
<?php
/**
 * This template is for displaying part of blog.
 *
 * @package Pix-Theme
 * @since 1.0
 */

	global $post;
	$size = (is_front_page()) && !is_home() ? 'portfolio-3col' : 'blog-post';
	$gallery = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('post_standared', 'type=image&size='.$size.'') : '';
	
 	
	if ($gallery): 
		$images = [];
		foreach ( $gallery as $item ) {
			array_push( $images, $item['url'] );
		} ?>

		<div class="tmpl-post-flex">
		    <div class="tmpl-flex-box-big" >
		       <div class="tmpl-flex-image-big">
		       		<img src="<?php echo esc_url($images[0]); ?>" class="img-responsive">
		       		<?php unset( $images[0] ); ?>
		       </div>
		    </div>
			<?php if ( count( $images ) ) { ?>
				<div class="tmpl-flex-box-small">
		    		<?php foreach ( $images as $image ) { ?>
		    			<div class="tmpl-flex-image-small">
			            	<img src="<?php echo esc_url($image); ?>" class="img-responsive">
			            </div>
		    		<?php } ?>
			    </div>
			<?php } ?>
		</div>
	 
	<?php elseif ( ( class_exists( 'RW_Meta_Box' ) && ( !empty( rwmb_meta( 'excerpt_image_img', array( 'size' => 'full' ) ) ) ) ) ):
		$images = rwmb_meta( 'excerpt_image_img', array( 'size' => 'full' ) )  ; ?>
		<a href="<?php esc_url(the_permalink())?>">
			<?php
				foreach ( $images as $image ) {
			    	echo '<img src="'. $image['url']. '" class="img-responsive">';
				} 
			?>
		</a>
	<?php				
	elseif ( has_post_thumbnail() ):?>
		<a href="<?php esc_url(the_permalink())?>">
			<?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
			
		</a>
	<?php endif; ?>
