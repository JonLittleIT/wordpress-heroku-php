<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $style
 * @var $posts_per_page
 * @var $dynamic_from_where
 * @var $dynamic_cat
 * Shortcode class
 * @var  WPBakeryShortCode_Home_Blog
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

        ob_start();
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;

        if($dynamic_from_where == 'all_cat')
          query_posts('posts_per_page='.(int)$posts_per_page.'&paged='.$paged); 
        else
          query_posts('posts_per_page='.(int)$posts_per_page.'&cat='.$dynamic_cat.'&paged='.$paged );
        

        global $for_element;
        $for_element = true;
        $GLOBALS['paged'] = $paged;
        get_template_part( 'includes/view/blog/loop', $style);

        wp_reset_query();
        $output .= ob_get_clean();
        echo  $output;
?>