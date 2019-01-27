<?php

$farvis_layout = farvis_get_option('blog_settings_sidebar_type', '2');
$farvis_sidebar = farvis_get_option('blog_settings_sidebar_content', 'sidebar-1');


if ( ! is_active_sidebar($farvis_sidebar) ) $farvis_layout = '1';

    $custom = isset ($wp_query) ? get_post_custom($wp_query->get_queried_object_id()) : '';
?>

<?php get_header(); ?>

<section class="blog-content-section" id="main">
	<div class="container">
	    <div class="row">
	        <?php farvis_show_sidebar( 'left', $farvis_layout, $farvis_sidebar ); ?>
	        <div class="<?php if ( $farvis_layout == 1 ) : ?>col-lg-12 col-md-12<?php else : ?>col-lg-9 col-md-8<?php endif; ?> col-sm-12 col-xs-12 left-column sidebar-type-<?php echo esc_attr($farvis_layout == 2 ? 'right' : ($farvis_layout == 3 ? 'left' : 'hide')); ?>">
	           <?php if ( have_posts() ) : ?>

                         <?php
                             if ( have_posts() )
                                the_post();
                             rewind_posts();
                             get_template_part( 'loop', 'archive' );
                         ?>
                    <?php endif ?>
				
				<?php farvis_num_pagination(); ?>
				
	        </div>
	        <?php farvis_show_sidebar( 'right', $farvis_layout, $farvis_sidebar ); ?>
	    </div>
	</div>
</section>

<?php get_footer(); ?>