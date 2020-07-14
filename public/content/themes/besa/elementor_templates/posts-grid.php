<?php 
/**
 * Templates Name: Elementor
 * Widget: Post Grid
 */

$query = $this->query_posts();

if (!$query->found_posts) {
    return;
}
$this->settings_layout();
$this->add_render_attribute('item', 'class', 'item');

$style = $settings['style'];

$configs = array(
    'style',
    'thumbnail_size_size',
    'show_title',
    'show_category',
    'post_title_tag',
    'show_excerpt',
    'excerpt_length',
    'show_read_more',
    'read_more_text',
    'show_author',
    'show_date',
    'show_comments',
    'show_comments_text',
);
foreach ($configs as $value) {
   set_query_var($value, $settings[$value]);
}

?>

<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>

    <?php $this->render_element_heading(); ?>

    <div <?php echo trim($this->get_render_attribute_string('row')); ?>>

        <?php while ( $query->have_posts() ) : $query->the_post(); global $product; ?>
            <div <?php echo trim($this->get_render_attribute_string('item')); ?>>
                <?php get_template_part('page-templates/posts/item-'. $style); ?>     
            </div>
        <?php endwhile; ?> 
    </div>
</div>

<?php wp_reset_postdata(); ?>