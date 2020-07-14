<?php

$columns = isset($columns) ? $columns : 4;

if( ! (isset($shop_now) && $shop_now == 'yes') ) {
    $shop_now = '';
    $shop_now_text = '';
} 

$count = 0;

$layout = 'v1';
 
?>
<?php 
    foreach ($categoriestabs as $tab) {

     	$cat = get_term_by( 'id', $tab['category'], 'product_cat' );
        $cat_count      =   besa_get_product_count_of_category($tab['category']);

        if( isset($tab['images']) && $tab['images'] ) {
        	 $cat_id 		= 	$tab['images'];
        }

        if( isset($tab['type']) && ($tab['type'] !== 'none') ) {
            vc_icon_element_fonts_enqueue( $tab['type'] );
            $type = $tab['type'];
            $iconClass = isset( $tab{'icon_' . $type } ) ? esc_attr( $tab{'icon_' . $type } ) : 'fa fa-adjust';
        }

        if( isset($cat) && $cat ) {
			$cat_name 		= 	$cat->name;    
			$cat_slug 		= 	$cat->slug;   
			$cat_link 		= 	get_term_link($cat->slug, 'product_cat');	
        } else {
        	$cat_name = esc_html__('Shop', 'besa');
        	$cat_link 		= 	get_permalink( wc_get_page_id( 'shop' ) );
        }

       if( isset($tab['check_custom_link']) &&  $tab['check_custom_link'] == 'yes' && isset($tab['custom_link']) && !empty($tab['custom_link']) ) {
        	$cat_link = $tab['custom_link'];
        } 

        ?> 

			<div class="item">

               <?php wc_get_template( 'item-categories/cat-custom-'.$layout.'.php', array('tab'=> $tab, 'count_item'=> $count_item, 'shop_now' => $shop_now,'shop_now_text' => $shop_now_text ) ); ?>

			</div>
		<?php 
		$count++;
		?>
        <?php
    }
?>

<?php wp_reset_postdata(); ?>