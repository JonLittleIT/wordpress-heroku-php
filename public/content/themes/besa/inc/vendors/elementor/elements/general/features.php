<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Besa_Elementor_Features') ) {
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
class Besa_Elementor_Features extends  Besa_Elementor_Carousel_Base{
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
        return 'besa-features';
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
        return esc_html__( 'Besa Features', 'besa' );
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
        return 'eicon-star-o';
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__( 'General', 'besa' ),
            ]
        );
 
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'feature_title',
            [
                'label' => esc_html__( 'Title', 'besa' ),
                'type' => Controls_Manager::TEXT,
            ]
        );
        
        $repeater->add_control(
            'feature_desc',
            [
                'label' => esc_html__( 'Description', 'besa' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        
        $repeater->add_control(
            'feature_type',
            [
                'label' => esc_html__( 'Display Type', 'besa' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'icon',
                'options' => [
                    'image' => [
                        'title' => esc_html__('Image', 'besa'),
                        'icon' => 'fa fa-image',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'besa'),
                        'icon' => 'fa fa-info',
                    ],
                ],
                'default' => 'images',
            ]
        );
        
        $repeater->add_control(
            'type_icon',
            [
                'label' => esc_html__('Choose Icon','besa'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'tb-icon tb-icon-gift',
					'library' => 'tbay-custom',
                ],
                'condition' => [
                    'feature_type' => 'icon'
                ]
            ]
        );
        $repeater->add_control(
            'type_image',
            [
                'label' => esc_html__('Choose Image','besa'),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'feature_type' => 'image'
                ]
            ]
        );
    
        $repeater->add_responsive_control(
			'feature_margin_icon',
			[
				'label' => esc_html__( 'Margin "Icon"', 'besa' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .features .fbox-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'feature_type' => 'icon'
                ]
			]
		);
        $this->add_control(
            'features',
            [
                'label' => esc_html__('Feature Item','besa'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ feature_title }}}',
            ]
        );
        $this->add_control(
            'feature_title_font',
            [
                'label' => esc_html__( 'Font Title', 'besa' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .features .ourservice-heading' => 'font-size: {{SIZE}}{{UNIT}};',
				],

            ]
        );
        $this->add_control(
            'feature_title_line_height',
            [
                'label' => esc_html__( 'Line Height', 'besa' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .features .ourservice-heading' => 'line-height: {{SIZE}}{{UNIT}};',
				],

            ]
        );
        $this->add_control(
            'spacing_title',
            [
                'label' => esc_html__('Spacing title','besa'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ], 
                'selectors' => [
                    '{{WRAPPER}} .tbay-element-features .ourservice-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'feature_desc_font',
            [
                'label' => esc_html__( 'Font Description', 'besa' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .features .description' => 'font-size: {{SIZE}}{{UNIT}};',
				],

            ]
        );
        $this->add_control(
            'feature_desc_line-height',
            [
                'label' => esc_html__( 'Line Height', 'besa' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .features .description' => 'line-height: {{SIZE}}{{UNIT}};',
				],

            ]
        );
        $this->add_control(
            'spacing_desc',
            [
                'label' => esc_html__('Spacing Description','besa'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ], 
                'selectors' => [
                    '{{WRAPPER}} .tbay-element-features .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'feature_align',
            [
                'label' => esc_html__('Align','besa'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left','besa'),
                        'icon' => 'fas fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__('Center','besa'),
                        'icon' => 'fas fa-align-center'
                    ],
                    'right' => [
                        'title' => esc_html__('Right','besa'),
                        'icon' => 'fas fa-align-right'
                    ],   
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .item .inner' => 'text-align: {{VALUE}} !important',
                ]
            ]
        );
        $this->end_controls_section();
        $this->add_control_responsive();
    }

    protected function render_item($item) {
        extract($item);
        ?> 
        <div class="inner"> 
            <?php
                $this->render_item_fbox($feature_type,$type_image,$type_icon);
                $this->render_item_content($feature_title,$feature_desc);     
            ?>
        </div>
        <?php
    }      
    public function render_item_content($feature_title,$feature_desc) {
        ?>
            <div class="fbox-content">
                <?php

                if( isset($feature_title) && !empty($feature_title) ) {
                    echo '<h3 class="ourservice-heading">'. trim($feature_title) .'</h3>';
                }

                if(isset($feature_desc) && !empty($feature_desc)) {
                    echo '<p class="description">'. trim($feature_desc) .'</p>';
                } 

                ?>
            </div>
        <?php
    }
    
    public function render_item_fbox($feature_type,$type_image,$type_icon){
        $image_id = $type_image['id'];

        $fbox_class = '';
        $fbox_class .= 'fbox-'.$feature_type;
        if($feature_type === 'image') {
            $type_icon = '';
        } 

        ?>
        <div class="<?php echo esc_attr($fbox_class); ?>">
            <?php if(isset($type_icon) && !empty($type_icon)): ?>
                <?php $this->render_item_icon($type_icon) ?>
            <?php elseif(isset($image_id) && !empty($image_id)): ?>
                <?php echo  wp_get_attachment_image($image_id, 'full'); ?>
            <?php endif;?>
        </div>

        <?php

    }

}
$widgets_manager->register_widget_type(new Besa_Elementor_Features());
