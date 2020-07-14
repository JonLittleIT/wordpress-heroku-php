<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Besa_Elementor_Product_Categories_Tabs') ) {
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
class Besa_Elementor_Product_Categories_Tabs extends  Besa_Elementor_Carousel_Base{
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
        return 'besa-product-categories-tabs';
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
        return esc_html__( 'Besa Product Categories Tabs', 'besa' );
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
        return 'eicon-product-tabs';
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
        return [ 'woocommerce-elements', 'product-categories' ];
    }
    protected function _register_controls_heading() {
        $this->start_controls_section(
            'section_general_heading',
            [
                'label' => esc_html__( 'Heading', 'besa' ),
            ]
        );
        $this->add_control(
            'title_cat_tab',
            [
                'label' => esc_html__('Title', 'besa'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $this->add_responsive_control(
            'title_cat_tab_size',
            [
                'label' => esc_html__('Font Size', 'besa'),
                'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tbay-element-product-category .title' => 'font-size: {{SIZE}}{{UNIT}};',
				],
            ]
        );
        $this->add_responsive_control(
            'title_cat_tab_size_line_height',
            [
                'label' => esc_html__('Line Height', 'besa'),
                'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tbay-element-product-category .title' => 'line-height: {{SIZE}}{{UNIT}};',
				],
            ]
        );
        $this->add_control(
            'sub_title_cat_tab',
            [
                'label' => esc_html__('Sub Title', 'besa'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_responsive_control(
            'sub_title_cat_tab_size',
            [
                'label' => esc_html__('Font Size', 'besa'),
                'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tbay-element-product-category .subtitle' => 'font-size: {{SIZE}}{{UNIT}};',
				],
            ]
        );
        $this->add_responsive_control(
            'sub_title_cat_tab_size_line_height',
            [
                'label' => esc_html__('Line Height', 'besa'),
                'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tbay-element-product-category .subtitle' => 'line-height: {{SIZE}}{{UNIT}};',
				],
            ]
        );
        $this->end_controls_section();
    }

    protected function _register_controls_image_banner(){
      
        $this->start_controls_section(
            'section_general_image',
            [
                'label' => esc_html__( 'Image Banner', 'besa' ),
            ]
        );
        $this->add_control(
            'enable_image',
            [
                'label' => esc_html__('Enable Image Banner', 'besa'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control(
            'position_image_banner', 
            [
                'label' => esc_html__('Position Image', 'besa'),
                'description' => esc_html__( 'Only for desktop', 'besa' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'right' => esc_html__('Left','besa'),
                    'left' => esc_html__('Right','besa'),
                ],
                'default' => 'right',

                'selectors' => [
					'{{WRAPPER}} .tbay-element-product-categories-tabs .tbay-addon-content' => 'float: {{VALUE}};',
					'{{WRAPPER}} .tbay-element-product-categories-tabs .tbay-addon-content' => 'float: {{VALUE}};',
				],
                'condition' => [
                    'enable_image' => 'yes',
                ] 
            ]
        );

        $this->add_control(
            'width_image',
            [
                'label' => esc_html__('Width Image Banner', 'besa'),
                'description' => esc_html__( 'Only for desktop', 'besa' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
					'px' => [
						'min' => 100,
						'max' => 400,
					],
					'%' => [
						'min' => 10,
						'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => '%',
					'size' => 20,
                ],
                'selectors' => [
					'{{WRAPPER}} .content-product-category-tab > img' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tbay-element-product-categories-tabs .tbay-addon-content' => 'width: calc(100% - {{SIZE}}{{UNIT}});',
				],
                'condition' => [
                    'enable_image' => 'yes'
                ]                
            ]
        );
        $this->add_control(
            'image_banner_desktop',
            [
                'label' => esc_html__('Image Banner Desktop', 'besa'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'enable_image' => 'yes'
                ]      
            ]
        );
        $this->add_control(
            'image_banner_tablet',
            [
                'label' => esc_html__('Image Banner Tablet', 'besa'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'enable_image' => 'yes'
                ]      
            ]
        );
        $this->add_control(
            'image_banner_mobile',
            [
                'label' => esc_html__('Image Banner Mobile', 'besa'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'enable_image' => 'yes'
                ]      
            ]
        );
        $this->add_control(
            'link_image_banner',
            [
                'label' => esc_html__('Link Image Banner', 'besa'),
                'type' => Controls_Manager::URL,
                'condition' => [
                    'enable_image' => 'yes'
                ]      
            ]
        );
        $this->end_controls_section();
    }
    protected function _register_controls() {
        $this->_register_controls_heading();
        $this->_register_controls_image_banner();
        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__( 'Product Categories', 'besa' ),
            ]
        );        

        $this->add_control(
            'limit',
            [
                'label' => esc_html__('Number of products', 'besa'),
                'type' => Controls_Manager::NUMBER,
                'description' => esc_html__( 'Number of products to show ( -1 = all )', 'besa' ),
                'default' => 6,
                'min'  => -1,
            ]
        );

        $this->add_control(
            'advanced',
            [
                'label' => esc_html__('Advanced', 'besa'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->register_woocommerce_order();
        $this->add_control(
            'product_type',
            [   
                'label'   => esc_html__('Product Type','besa'),
                'type'     => Controls_Manager::SELECT,
                'options' => $this->get_product_type(),
                'default' => 'newest'
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

        $categories = $this->get_product_categories();
        $this->add_control(
            'categories',
            [
                'label'     => esc_html__('Categories', 'besa'),
                'type'      => Controls_Manager::SELECT2,
                'default'   => [array_keys($categories)[0]],
                'label_block' => true,
                'options'   => $categories,   
                'multiple' => true,
            ]
        );  
        $this->add_control(
            'product_style',
            [
                'label' => __('Product Style', 'besa'),
                'type' => Controls_Manager::SELECT,
                'default' => 'v1',
                'options' => $this->get_template_product(),
                'prefix_class' => 'elementor-product-'
            ]
        );

        $this->register_button();
        $this->end_controls_section();
        $this->add_control_responsive();
        $this->add_control_carousel(['layout_type' => 'carousel']);
        $this->register_style_heading();
    }
    protected function register_style_heading() {
        $this->start_controls_section(
            'section_style_text',
            [
                'label' => esc_html__('Style Heading Product Categories Tabs', 'besa'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'bg_heading',
            [
                'label'     => esc_html__('Background', 'besa'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbay-element-product-categories-tabs .heading-product-category-tabs'    => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'heading_padding',
            [
                'label'      => esc_html__( 'Padding', 'besa' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tbay-element-product-categories-tabs .heading-product-category-tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

    }
    protected function register_button() {
        $this->add_control(
            'show_more',
            [
                'label'     => esc_html__('Display Show More', 'besa'),
                'type'      => Controls_Manager::SWITCHER,
                'default' => 'no'
            ]
        );  
        $this->add_control(
            'text_button',
            [
                'label'     => esc_html__('Text Button', 'besa'),
                'type'      => Controls_Manager::TEXT,
                'condition' => [
                    'show_more' => 'yes'
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
                    'show_more' => 'yes'
                ]
            ]
        );  
    }
   

    public function get_template_product() {
        return apply_filters( 'besa_get_template_product', 'v1' );
    }
    public function render_product_tab($categories,$_id, $settings) {
        extract($settings);
        ?>
        
        <div class="heading-product-category-tabs">
            <?php
                if(!empty($title_cat_tab) || !empty($sub_title_cat_tab) ) {
                    ?>
                    <h3 class="heading-tbay-title">
                        <?php if( !empty($title_cat_tab) ) : ?>
                            <span class="title"><?php echo trim($title_cat_tab); ?></span>
                        <?php endif; ?>	    	
                        <?php if( !empty($sub_title_cat_tab) ) : ?>
                            <span class="subtitle"><?php echo trim($sub_title_cat_tab); ?></span>
                        <?php endif; ?>
                    </h3>
                    <?php
                }
            ?>
            <?php $this->render_item_button() ?>
            <ul class="tabs-list nav nav-tabs">
                <?php 
                    $__count=0;
                ?>

                <?php foreach ($categories as $key) { ?>
                        <?php 
                            $active = ($__count==0)? 'active':''; 
                            
                            $category = get_term_by( 'slug', $key, 'product_cat' );


                            if( !empty($category->name) ) {
                                $title = $category->name;
                            } else {
                                $title = '';
                            }

                        ?>
                        <li>
                            <a class="<?php echo esc_attr( $active ); ?>" href="#<?php echo esc_attr($key.'-'.$_id); ?>" data-toggle="tab" data-title="<?php echo esc_attr($title);?>"><?php echo trim($title);?></a>
                        </li>
                    <?php $__count++; ?>
                <?php } ?>
            </ul>
            
        </div>
        

       <?php
    }
    public function render_image_banner($screen) {
        $settings = $this->get_settings_for_display();
        extract($settings);

        switch ($screen) {
            case 'mobile':
                $image_id       = $image_banner_mobile['id'];
                $image_class    = 'd-block d-sm-none ';
                break;
            case 'tablet':
                $image_id       = $image_banner_tablet['id'];
                $image_class    = 'd-none d-xl-none d-md-block';
                break;
            
            default:
                $image_id       = $image_banner_desktop['id'];
                $image_class    = 'd-none d-xl-inline-block';
                break;
        }
        $link               = $link_image_banner['url'];
        $is_external        = $link_image_banner['is_external'];
        $nofollow           = $link_image_banner['nofollow'];

        $get_img = wp_get_attachment_image($image_id, 'full', false, array('class' => $image_class) );
        if($enable_image === 'yes') {
            if( isset($link) && !empty($link) ) : ?>
                <?php 
                
                    $this->add_render_attribute('banner_wrapper', 'href', $link);

                    if( $is_external === 'on' ) {
                        $this->add_render_attribute('banner_wrapper', 'target', '_blank');
                    }  
                    if( $nofollow === 'on' ) {
                        $this->add_render_attribute('banner_wrapper', 'rel', 'nofollow');
                    }  
                ?>
                <a <?php echo trim($this->get_render_attribute_string('banner_wrapper')); ?> >
                    <?php echo trim($get_img); ?>
                </a>
            <?php else: ?>
                <?php echo trim($get_img); ?>
            <?php endif;
        }
    }
    public function render_product_tabs_content($categories, $_id) {
        ?>
            <div class="content-product-category-tab">
                <?php $this->render_image_banner('desktop'); ?>
                <div class="tbay-addon-content tab-content woocommerce">
                 <?php 
                 $__count=0;
                 foreach ($categories as $key ) {
                     $tab_active = ($__count == 0) ? ' show active' : '';
                         $this->render_content_tab($key, $tab_active, $_id);
                     $__count++;
                 }
                 ?>
                </div>
            </div>
        <?php
 
    }
    private function  render_content_tab($key, $tab_active, $_id) {
        $settings = $this->get_settings_for_display();
        $cat_operator = $product_type = $limit = $orderby = $order = '';
        extract( $settings );
        
        /** Get Query Products */
        $loop = $this->get_query_products($key,  $cat_operator, $product_type, $limit, $orderby, $order);

        $attr_row = $this->get_render_attribute_string('row');
        ?>
        <div class="tab-pane fade <?php echo esc_attr( $tab_active ); ?>" id="<?php echo esc_attr($key).'-'.$_id; ?>">
        
        <?php wc_get_template( 'layout-products/layout-products.php' , array( 'loop' => $loop, 'product_style' => $product_style, 'attr_row' => $attr_row) ); ?>
        </div>
        <?php
        
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
$widgets_manager->register_widget_type(new Besa_Elementor_Product_Categories_Tabs());
