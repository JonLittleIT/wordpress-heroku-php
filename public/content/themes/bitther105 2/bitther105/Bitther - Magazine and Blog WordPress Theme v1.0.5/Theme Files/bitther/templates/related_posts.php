<?php 

$orig_post = $post;
$class = '';
$categories = get_the_category($post->ID);
$number = get_theme_mod('bitther_related_number',3);
$rows = get_theme_mod('bitther_related_rows',3);
switch ($rows) {
	case '2':
		$class .= "col-xs-12 col-sm-6";
		break;
	case '3':
		$class .= "col-xs-12 col-sm-4 col-md-4";
		break;
	case '4':
		$class .= "col-xs-12 col-sm-3 col-md-3";
		break;
	case '6':
		$class .= "col-xs-12 col-sm-2 col-md-2";
		break;
}
if ($categories) {

	$category_ids = array();

	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
	
	$args = array(
		'category__in'     => $category_ids,
		'post__not_in'     => array($post->ID),
		'posts_per_page'   =>$number, // Number of related posts that will be shown.
		'ignore_sticky_posts' => 1,
		'orderby' => 'rand'
	);

	$my_query = new wp_query( $args );
	if( $my_query->have_posts() ) { ?>
		<div class="archive-blog post-related description-s">
			<h4 class="widgettitle box-title ">
				<?php esc_html_e(' You may also like ', 'bitther'); ?>
			</h4>
			<div class="row">
				<?php while( $my_query->have_posts() ) {
					$my_query->the_post();?>
						<div class="<?php echo esc_attr($class);?> item-related hidden-meta">
							<?php get_template_part( 'templates/layout/content-grid'); ?>
						</div>
				<?php } ?>
			</div>
		</div>
	<?php }
}
$post = $orig_post;
wp_reset_postdata(); ?>