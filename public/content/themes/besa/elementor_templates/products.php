<?php 
/**
 * Templates Name: Elementor
 * Widget: Products
 */

extract( $settings );

if( isset($limit) && !((bool) $limit) ) return;

$this->settings_layout();

/** Get Query Products */
$loop = $this->get_query_products($categories,  $cat_operator, $product_type, $limit, $orderby, $order);

$attr_row = $this->get_render_attribute_string('row');

?>

<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>

    <?php $this->render_element_heading(); ?>

    <?php wc_get_template( 'layout-products/layout-products.php' , array( 'loop' => $loop, 'product_style' => $product_style, 'attr_row' => $attr_row) ); ?>
    <?php $this->render_item_button(); ?>
</div>