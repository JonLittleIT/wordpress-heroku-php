<?php 

$cat            =   get_term_by( 'id', $tab['category'], 'product_cat' );
$cat_count      =   besa_get_product_count_of_category($tab['category']);
 

if( isset($cat) && $cat ) {
    $cat_name       =   $cat->name;    
    $cat_slug       =   $cat->slug;   
    $cat_link       =   get_term_link($cat->slug, 'product_cat');
} else {
    $cat_name = esc_html__('Shop', 'besa');
    $cat_link       =   get_permalink( wc_get_page_id( 'shop' ) );
}

if( isset($tab['type']) && ($tab['type'] !== 'none') ) {
    vc_icon_element_fonts_enqueue( $tab['type'] );
    $type = $tab['type'];
    $iconClass = isset( $tab{'icon_' . $type } ) ? esc_attr( $tab{'icon_' . $type } ) : 'fa fa-adjust';
}

if( isset($tab['check_custom_link']) &&  $tab['check_custom_link'] == 'yes' && isset($tab['custom_link']) && !empty($tab['custom_link']) ) {
    $cat_link = $tab['custom_link'];
}

$have_icon = (isset($iconClass) && $iconClass) ? 'cat-icon' : 'cat-img';

?>
<div class="item-cat tbay-image-loaded <?php echo esc_attr($have_icon); ?>">
<?php if ( isset($tab['images']) && !empty($tab['images']) ): ?>

    <?php
        $cat_id         =   $tab['images'];    
    ?>

    <a href="<?php echo esc_url($cat_link); ?>"><?php echo wp_get_attachment_image($cat_id, 'full', false, array('alt'=> $cat_name )); ?></a>

<?php elseif ( isset($iconClass) && $iconClass ): ?>

    <a href="<?php echo esc_url($cat_link); ?>"><i class="<?php echo esc_attr($iconClass); ?>"></i></a>

<?php endif; ?>
    <div class="content">
        <a href="<?php echo esc_url($cat_link); ?>" class="cat-name"><?php echo trim($cat_name); ?></a>

        <?php if ( (isset($shop_now) && $shop_now == 'yes') ) { ?>
            <div class="cat-hover">
                <?php if ( $count_item == 'yes' ) { ?>
                    <span class="count-item"><?php echo trim($cat_count).' '. apply_filters( 'besa_tbay_categories_count_item', esc_html__('items','besa') ); ?></span>
                <?php } ?>
                <a href="<?php echo esc_url($cat_link); ?>" class="shop-now"><?php echo trim($shop_now_text); ?></a>
            </div>
            <?php }
            else { ?>
            <?php if ( $count_item == 'yes' ) { ?>
                <span class="count-item"><?php echo trim($cat_count).' '.apply_filters( 'besa_tbay_categories_count_item', esc_html__('items','besa') ); ?></span>
            <?php } ?>      
        <?php } ?>
   </div>
</div>