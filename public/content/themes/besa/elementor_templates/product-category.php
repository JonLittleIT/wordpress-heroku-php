<?php 
/**
 * Templates Name: Elementor
 * Widget: Products Category
 */
$category =  $cat_operator = $product_type = $limit = $orderby = $order = '';
extract( $settings );

if (empty($settings['category'])) {
    return;
}

$layout_type = $settings['layout_type'];
$this->settings_layout();
 
/** Get Query Products */
$loop = $this->get_query_products($category,  $cat_operator, $product_type, $limit, $orderby, $order);

$attr_row = $this->get_render_attribute_string('row');

?>

<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>
    <?php $this->render_element_heading(); ?>

    <?php if( !empty($feature_image['id']) ) : ?>

    	<div class="product-category-content row">

    		<div class="col-md-3 d-md-block d-sm-none d-xs-none">
    			<?php $this->render_item_image($settings) ?>
    		</div>    		

    		<div class="col-md-9">
    			    <?php wc_get_template( 'layout-products/layout-products.php' , array( 'loop' => $loop, 'product_style' => $product_style, 'attr_row' => $attr_row) ); ?>
    		</div>

    	</div>
 
	<?php  else : ?>

	<?php wc_get_template( 'layout-products/layout-products.php' , array( 'loop' => $loop, 'product_style' => $product_style, 'attr_row' => $attr_row) ); ?>

	<?php endif; ?>



    <?php $this->render_item_button($settings)?>
</div>