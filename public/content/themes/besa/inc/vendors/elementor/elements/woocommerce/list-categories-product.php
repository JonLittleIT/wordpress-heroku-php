<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Besa_Elementor_List_Categories_Product') ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Besa_Elementor_List_Categories_Product extends  Besa_Elementor_Carousel_Base{
    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'besa-list-categories-product';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Besa List Categories Product', 'besa' );
    }

    public function get_categories() {
        return [ 'besa-elements', 'woocommerce-elements'];
    }
    
    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-product-categories';
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    public function get_script_depends()
    {
        return ['slick', 'besa-custom-slick'];
    }

    public function get_keywords() {
        return [ 'woocommerce-elements', 'list-categories-product' ];
    }

    protected function _register_controls() {
        $this->register_controls_heading();

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__( 'List Categories Product', 'besa' ),
            ]
        );
        $this->add_control(
            'limit',
            [
                'label' => esc_html__('Number of categories', 'besa'),
                'type' => Controls_Manager::NUMBER,
                'description' => esc_html__( 'Number of categories to show ( -1 = all )', 'besa' ),
                'min'  => -1,
                'default' => 6,
            ]
        );

        $this->add_control(
            'advanced',
            [
                'label' => esc_html__('Advanced', 'besa'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'layout_type',
            [
                'label'     => esc_html__('Layout Type', 'besa'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'grid',
                'options'   => [
                    'grid'      => esc_html__('Grid', 'besa'), 
                    'carousel'  => esc_html__('Carousel', 'besa'), 
                ],
            ]
        );  
        $this->register_button();
        $this->end_controls_section();
        $this->add_control_responsive();
        $this->add_control_carousel(['layout_type' => 'carousel']);
    }

    protected function register_button() {
        $this->add_control(
            'show_all',
            [
                'label'     => esc_html__('Display Show All', 'besa'),
                'type'      => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'no' => esc_html__('No','besa'),
                    'show' => esc_html__('Show All','besa')
                ]
            ]
        );  
        $this->add_control(
            'text_button',
            [
                'label'     => esc_html__('Text Button', 'besa'),
                'type'      => Controls_Manager::TEXT,
                'condition' => [
                    'show_all' => 'show'
                ]
            ]
        );  
        $this->add_control(
            'icon_button',
            [
                'label'     => esc_html__('Icon Button', 'besa'),
                'type'      => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'tb-icon tb-icon-arrow-right',
					'library' => 'tbay-custom',
                ],
                'condition' => [
                    'show_all' => 'show'
                ]
            ]
        );  
    }
    
    public function render_list_category() {
        $settings = $this->get_settings_for_display();
        extract($settings);
        $array = $this->get_product_categories($limit);
        
        $this->add_render_attribute('item', 'class', 'item');
        foreach ($array as $key => $value) {
            ?>
                <div <?php echo trim($this->get_render_attribute_string('item')); ?> >
                    <div class="item-cat">
                        <?php 
                            $category = get_term_by('slug', $key, 'product_cat');
                            $name  = $category->name; 
                            $count = $category->count;
                            $url_category =  get_term_link($category);

                            $term_id = $category ->term_id;
                            $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
                            $image        = wp_get_attachment_url( $thumbnail_id );


                            

                            if(!empty($image) && isset($image) ) {
                                ?>
                                    <a href="<?php echo esc_url($url_category) ?>">
                                        <?php echo '<img src="'. esc_url($image) .'" alt="'. esc_attr($name) .'" />'; ?>
                                    </a>
                                    
                                <?php
                            } 

                            echo '<div class="cat-content">';
                                ?>
                                    <a href="<?php echo esc_url($url_category) ?>" class="cat-name"><?php echo trim($name) ?></a>
                                    <span class="count-item"><?php echo trim($count).' '.esc_html__('items', 'besa'); ?></span>
                                <?php
                            
                            echo '</div>';
                        ?>    
                               
                    </div>
                </div>

            <?php

        }
    }

    public function render_item_button() {
        $settings = $this->get_settings_for_display();
        extract( $settings );
        
        $url_category =  get_permalink(wc_get_page_id('shop'));
        if(isset($text_button) && !empty($text_button)) {?>
            <a href="<?php echo esc_url($url_category)?>" class="btn"><?php echo trim($text_button) ?>
                <?php 
                    $this->render_item_icon($icon_button);
                ?>
                
            </a>
            <?php
        }
        
    }

}
$widgets_manager->register_widget_type(new Besa_Elementor_List_Categories_Product());
