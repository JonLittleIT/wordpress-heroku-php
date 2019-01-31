<?php

do_action('amos_excecute_query_var_action','loop-page');

if (have_posts()) :

	while (have_posts()) : the_post();

        $post_id    = get_the_ID();

        $title   	= get_the_title();

        $content 	= get_the_content();

        $content    = str_replace(']]>', ']]&gt;', apply_filters('the_content', $content ));

		echo amos_output($content); 

    endwhile;

endif;
 
// Pagination
wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'amos' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'amos' ) . ' </span>%',
            'separator'   => '<span class="screen-reader-text">, </span>',
) );

?>