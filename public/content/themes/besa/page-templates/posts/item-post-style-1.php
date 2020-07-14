<?php 
$style           = isset($style) ? $style : 'post-style-1';
$thumbsize       = isset($thumbnail_size_size) ? $thumbnail_size_size : 'medium';
$show_title      = besa_switcher_to_boolean($show_title); ;
$show_category   = besa_switcher_to_boolean($show_category); 
$show_author     =  besa_switcher_to_boolean($show_author); 
$show_date       =  besa_switcher_to_boolean($show_date); 
$show_comments   =  besa_switcher_to_boolean($show_comments); 
$show_comments_text   =  besa_switcher_to_boolean($show_comments_text); 
$post_title_tag       = isset($post_title_tag) ? $post_title_tag : 'h3';
$show_excerpt    =  besa_switcher_to_boolean($show_excerpt); 
$excerpt_length  = isset($excerpt_length) ? $excerpt_length : 15;
$show_read_more  =  besa_switcher_to_boolean($show_read_more); 
$read_more_text  = isset($read_more_text) ? $read_more_text : esc_html__('Read More', 'besa');


$text_domain               = esc_html__(' comments','besa');    
if( get_comments_number() == 1) {
    $text_domain = esc_html__(' comment','besa');
}

?>
<article class="post item-post <?php echo esc_attr($style); ?>">   
    <figure class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
        <a href="<?php the_permalink(); ?>"  class="entry-image">
          <?php
            if ( besa_is_elementor_activated() ) {
                
                the_post_thumbnail($thumbsize);
                besa_tbay_icon_post_formats();
            } else {
                the_post_thumbnail();
                besa_tbay_icon_post_formats();
            }

          ?>
        </a> 
    </figure>
    <div class="entry-header">

        <?php if ( $show_title && get_the_title() ) : ?>
            <<?php echo trim($post_title_tag); ?> class="entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <?php besa_post_meta_comment($show_comments, $show_comments_text); ?>
            </<?php echo trim($post_title_tag); ?>>
        <?php endif; ?>

        <?php do_action('besa_blog_before_meta_list'); ?>

        <?php besa_post_meta(array(
            'date'          => $show_date,
            'author'        => $show_author,
            'author_img'    => 0,
            'comments'      => 0,
            'comments_text' => 0,
            'tags'          => 0,
            'cats'          => $show_category,
            'edit'          => 0,
        )); ?>

      

        <?php if( $show_excerpt ) : ?>
            <div class="entry-description"><?php echo besa_tbay_substring( get_the_excerpt(), $excerpt_length, '...' ); ?></div>
        <?php endif; ?>

        <?php if( $show_read_more ) : ?>
            <a href="<?php the_permalink(); ?>" class="readmore" title="<?php echo esc_attr($read_more_text); ?>"><?php echo trim($read_more_text); ?></a>
        <?php endif; ?>

        <?php do_action('besa_blog_after_meta_list'); ?>
    </div>
</article>
