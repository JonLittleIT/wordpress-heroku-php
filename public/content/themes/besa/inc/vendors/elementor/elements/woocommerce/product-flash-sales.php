<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Besa_Elementor_Product_Flash_Sales') ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

 
class Besa_Elementor_Product_Flash_Sales extends Besa_Elementor_Carousel_Base {

    public function get_name() {
        return 'besa-product-flash-sales';
    }

    public function get_title() {
        return esc_html__( 'Besa Product Flash Sales', 'besa' );
    }

    public function get_categories() {
        return [ 'besa-elements', 'woocommerce-elements'];
    }

    public function get_icon() {
        return 'eicon-flash';
    }

    /**
     * Retrieve the list of scripts the image carousel widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return ['slick', 'besa-custom-slick', 'jquery-countdowntimer'];
    }

    public function get_keywords() {
        return [ 'woocommerce-elements', 'product', 'products', 'Flash Sales', 'Flash' ];
    }

    protected function _register_controls() {
        $this->register_controls_heading(['position_displayed' => 'main']);

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'besa' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'position_displayed',
            [
                'label'     => esc_html__('Position Displayed', 'besa'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'header',
                'options'   => [
                    'header'      => esc_html__('Header', 'besa'), 
                    'main'  => esc_html__('Main Content', 'besa'), 
                ],
            ]
        ); 

        $this->register_control_header();
        $this->register_control_main();

        $this->end_controls_section(); 

        $this->register_control_viewall();

        $this->add_control_responsive(['position_displayed' => 'main']);

        $this->add_control_carousel(['layout_type' => 'carousel']);
    }

    private function register_control_header() {
        $prefix = 'header_';
        $this->add_control(
            $prefix .'advanced',
            [
                'label' => esc_html__('Header', 'besa'),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'position_displayed' => 'header'
                ],
            ]
        );

        $this->add_control(
            $prefix .'display_type',
            [
                'label' => esc_html__('Display type', 'besa'),
                'type' => Controls_Manager::SELECT,
                'default' => 'text',
                'label_block' => true,
                'condition' => [
                    'position_displayed' => 'header'
                ],
                'options' => [
                    'text' => esc_html__('Text', 'besa'),
                    'image' => esc_html__('Image', 'besa')
                ]
            ]
        );  

        $this->add_control(
            $prefix .'icon',
            [
                'label'     => esc_html__('Icon', 'besa'),
                'type'      => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'tb-icon tb-icon-history',
					'library' => 'tbay-custom',
                ],
                'conditions' => [
					'relation' => 'AND',
					'terms' => [
						[
							'name' => $prefix .'display_type',
							'operator' => '===',
							'value' => 'text',
						],
						[
							'name' => 'position_displayed',
							'operator' => '===',
							'value' => 'header',
						],
					],
				],
            ]
        );  

        $this->add_control(
            $prefix .'text',
            [
                'label'     => esc_html__('Text', 'besa'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('Flash Sale', 'besa'),
                'conditions' => [
					'relation' => 'AND',
					'terms' => [
						[
							'name' => $prefix .'display_type',
							'operator' => '===',
							'value' => 'text',
						],
						[
							'name' => 'position_displayed',
							'operator' => '===',
							'value' => 'header',
						],
					],
				],
            ]
        );  

        $this->add_control(
            $prefix .'image',
            [
                'label'     => esc_html__('Image', 'besa'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'conditions' => [
					'relation' => 'AND',
					'terms' => [
						[
							'name' => $prefix .'display_type',
							'operator' => '===',
							'value' => 'image',
						],
						[
							'name' => 'position_displayed',
							'operator' => '===',
							'value' => 'header',
						],
					],
				],
            ]
        );  

        $pages = $this->get_available_pages();

        if (!empty($pages)) {
            $this->add_control(
                $prefix .'page',
                [
                    'label'        => esc_html__('Select Page', 'besa'),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $pages,
                    'default'      => array_keys($pages)[0],
                    'save_default' => true,
                    'separator'    => 'after',
                    'condition' => [
                        'position_displayed' => 'header'
                    ],
                ]
            );
        } else {
            $this->add_control(
                $prefix .'page',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf(__('<strong>There are no pages in your site.</strong><br>Go to the <a href="%s" target="_blank">pages screen</a> to create one.', 'besa'), admin_url('edit.php?post_type=page')),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                    'condition' => [
                        'position_displayed' => 'header'
                    ],
                ]
            );
        }

    }

    private function register_control_main() {
        $prefix = 'main_';
        $this->add_control(
            $prefix .'advanced',
            [
                'label' => esc_html__('Main', 'besa'),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        );

        $this->add_control(
            'date_title',
            [
                'label' => esc_html__('Title Date', 'besa'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Deals end in:', 'besa'),
                'label_block' => true,
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        );  

        $this->add_control(
            'date_title_ended',
            [
                'label' => esc_html__('Title deal ended', 'besa'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Deal ended.', 'besa'),
                'label_block' => true,
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        );  


        $this->add_control(
            'end_date',
            [
                'label' => esc_html__('End Date', 'besa'),
                'type' => Controls_Manager::DATE_TIME,
                'label_block' => true,
                'placeholder' => esc_html__( 'Choose the end time', 'besa' ),
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        );  

        $this->add_control(
            'bg_top_flash_sale',
            [
                'label' => esc_html__('Background Top Flash Sale', 'besa'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .top-flash-sale-wrapper' => 'background: {{VALUE}};',
                ],
            ]
        );  

        $this->add_control(
            'layout_type',
            [
                'label'     => esc_html__('Layout Type', 'besa'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'grid',
                'options'   => [
                    'grid'      => esc_html__('Grid', 'besa'), 
                    'carousel'  => esc_html__('Carousel', 'besa'), 
                ],
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        ); 

        $this->add_control(
            'product_style',
            [
                'label' => esc_html__('Product Style', 'besa'),
                'type' => Controls_Manager::SELECT,
                'default' => 'v1',
                'options' => $this->get_template_product(),
                'prefix_class' => 'elementor-product-',
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        );

        $products = $this->get_available_on_sale_products();
        
        if (!empty($products)) {
            $this->add_control(
                $prefix .'products',
                [
                    'label'        => esc_html__('Products', 'besa'),
                    'type'         => Controls_Manager::SELECT2,
                    'options'      => $products,
                    'default'      => array_keys($products)[0],
                    'label_block' => true,
                    'multiple' => true,
                    'save_default' => true,
                    'description' => esc_html( 'Only search for sale products', 'besa' ),
                    'condition' => [
                        'position_displayed' => 'main'
                    ],
                ]
            );
        } else {
            $this->add_control(
                $prefix .'html_products',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf(__('You do not have any discount products. <br>Go to the <strong><a href="%s" target="_blank">Products screen</a></strong> to create one.', 'besa'), admin_url('edit.php?post_type=product')),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                    'condition' => [
                        'position_displayed' => 'main'
                    ],
                ]
            );
        }

        $this->add_control(
            'enable_readmore',
            [
                'label' => esc_html__( 'Enable Button "Read More" ', 'besa' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        );

    }

    protected function register_control_viewall() {
        $this->start_controls_section(
            'section_readmore',
            [
                'label' => esc_html__( 'Read More Options', 'besa' ),
                'type'  => Controls_Manager::SECTION,
                'condition' => [
                    'enable_readmore' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'readmore_text',
            [
                'label' => esc_html__('Button "Read More" Custom Text', 'besa'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'besa'),
                'label_block' => true,
            ]
        );  

        $pages = $this->get_available_pages();

        if (!empty($pages)) {
            $this->add_control(
                'readmore_page',
                [
                    'label'        => esc_html__('Page', 'besa'),
                    'type'         => Controls_Manager::SELECT2,
                    'options'      => $pages,
                    'default'      => array_keys($pages)[0],
                    'label_block' => true,
                    'save_default' => true,
                    'separator'    => 'after',
                ]
            );
        } else {
            $this->add_control(
                'readmore_page',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf(__('<strong>There are no pages in your site.</strong><br>Go to the <a href="%s" target="_blank">pages screen</a> to create one.', 'besa'), admin_url('edit.php?post_type=page')),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }
        $this->end_controls_section();
    }

    public function render_content_header() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        if( $position_displayed !== 'header' ) return;

        if( !empty($header_page) ) {
            $link = get_permalink($header_page);
        }


        if( $header_display_type === 'text' ) {
            $this->render_content_header_text($link);
        } else {
            $this->render_content_header_image($link);
        }

    }

    protected function render_btn_readmore() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        if( !empty($readmore_page) ) {
            $link = get_permalink($readmore_page);
        }

        if( $enable_readmore && !empty($link) ) : ?>
            <a class="show-all" href="<?php echo esc_url($link); ?>" title="<?php esc_attr( $readmore_text ); ?>"><?php echo trim($readmore_text); ?></a>
        <?php endif;
    }

    private function render_content_header_text($link) {
        $settings = $this->get_settings_for_display();
        extract($settings);

        if( !empty($header_icon['value']) ) {
            echo '<a class="flash-sale" href="'. esc_url($link) .'" title="'. esc_attr( $header_text ) .'"><i class="'. esc_attr($header_icon['value']) .'"></i>'. trim($header_text) .'</a>';
        } else {
            echo '<a class="flash-sale" href="'. esc_url($link) .'" title="'. esc_attr( $header_text ) .'">'. trim($header_text) .'</a>';
        }
    }

    private function render_content_header_image($link) {
        $settings = $this->get_settings_for_display();
        extract($settings);
        
        $image_id           = $header_image['id'];

        echo '<a class="flash-sale" href="'. esc_url($link) .'">'. wp_get_attachment_image($image_id, 'full') .'</a>'; 
    }

    public function render_content_main() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        if( $position_displayed !== 'main' ) return;

        $prefix = 'main_';

        $ids = ${$prefix.'products'};


        if( !is_array($ids) ){
            $atts['ids'] = $ids;
        } else {
            if( count($ids) === 0 ) {
                echo '<div class="not-product-flash-sales">'. esc_html__('Please select the show product', 'besa')  .'</div>';
                return;
            }

            $atts['ids'] = implode(',', $ids);
        }

        $type = 'products';

        $shortcode = new WC_Shortcode_Products($atts, $type);
        $args = $shortcode->get_query_args();

        $loop = new WP_Query($args); 

        $end_date     = strtotime($end_date);
        if( !$loop->have_posts() ) return;

        $attr_row = $this->get_render_attribute_string('row');

        wc_get_template( 'layout-products/layout-products.php' , array( 'loop' => $loop, 'product_style' => $product_style, 'flash_sales' => true, 'end_date' => $end_date, 'attr_row' => $attr_row) );
        
        $this->render_btn_readmore();
    }
    public function deal_end_class() {
        $settings = $this->get_settings_for_display();
        extract($settings);


        $class_deal_ended   = '';
        $end_date           = strtotime($end_date);
        $today              = strtotime("today");
        if ( !empty($end_date) &&  ($today > $end_date) ) {
            $class_deal_ended = 'deal-ended';
        }

        return $class_deal_ended;
    }

}
$widgets_manager->register_widget_type(new Besa_Elementor_Product_Flash_Sales());