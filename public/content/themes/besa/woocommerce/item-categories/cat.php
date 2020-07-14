<?php 

$cat_id         =   $cat->term_id;    
$cat_name       =   $cat->name;    
$cat_slug       =   $cat->slug;   
$cat_count      =   $cat->count; 

$thumbnail_id = get_term_meta( $cat_id, 'thumbnail_id', true );

?>

<div class="item-cat">
    <?php if ( !empty($image) ) { ?>
        <a class="cat-img tbay-image-loaded" href="<?php echo esc_url( get_term_link($cat->slug, 'product_cat') ); ?>">
        	<?php echo wp_get_attachment_image($thumbnail_id, 'full'); ?>
        </a>
    <?php } ?>

    <a class="cat-name" href="<?php echo esc_url( get_term_link($cat_slug, 'product_cat') ); ?>">
        <?php echo trim($cat_name); ?>

        <span class="count-item">(<?php echo trim($cat_count).' '.apply_filters( 'besa_tbay_categories_count_item', esc_html__('items','besa') ); ?>)</span>
    </a>


</div>