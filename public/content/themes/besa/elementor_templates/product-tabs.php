<?php 
/**
 * Templates Name: Elementor
 * Widget: Products Tabs
 */

extract( $settings );

$this->settings_layout();
 
$_id = besa_tbay_random_key();

?>

<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>
    
    <?php $this->render_element_heading(); ?>

    <ul class="tabs-list nav nav-tabs">
        <?php $__count = 0;?>
        <?php foreach ($list_product_tabs as $key) {
            $active = ($__count==0)? 'active':'';

            $product_tabs = $key['product_tabs'];
            $title = $this->get_title_product_type($product_tabs);
            if(!empty($key['product_tabs_title']) ) {
                $title = $key['product_tabs_title'];
            }
            $this->render_product_tabs($product_tabs, $_id, $title, $active); 
            $__count++;   
        }
        ?>
    </ul>
    
    <div class="tbay-addon-content tab-content woocommerce">
        <?php $__count = 0;?>
        <?php foreach ($list_product_tabs as $key) {
            $tab_active = ($__count==0)? 'active':'';
            $product_tabs = $key['product_tabs'];
                $this->render_content_tab($product_tabs,$tab_active,$_id); 
            $__count++;   
        }
        ?>
    </div>

</div>