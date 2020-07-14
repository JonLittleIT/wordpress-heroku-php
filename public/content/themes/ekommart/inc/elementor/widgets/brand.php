<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Ekommart_Elementor_Brand extends Elementor\Widget_Base {

    public function get_categories() {
        return array('ekommart-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'ekommart-brand';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Brands', 'ekommart');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-tabs';
    }

    /**
     * Enqueue scripts.
     *
     * Registers all the scripts defined as element dependencies and enqueues
     * them. Use `get_script_depends()` method to add custom script dependencies.
     *
     * @since 1.3.0
     * @access public
     */

    public function get_script_depends() {
        return ['ekommart-elementor-brand', 'slick'];
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
            'section_brands',
            [
                'label' => esc_html__('Brands', 'ekommart'),
            ]
        );

        $this->add_control(
            'brands',
            [
                'label'       => esc_html__('Brand Items', 'ekommart'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => [
                    [
                        'name'        => 'brand_title',
                        'label'       => esc_html__('Brand name', 'ekommart'),
                        'type'        => Controls_Manager::TEXT,
                        'default'     => esc_html__('Brand Name', 'ekommart'),
                        'placeholder' => esc_html__('Brand Name', 'ekommart'),
                        'label_block' => true,
                    ],
                    [
                        'name'    => 'type_brand',
                        'label'   => esc_html__('Type', 'ekommart'),
                        'type'    => Controls_Manager::SELECT,
                        'options' => [
                            'image' => esc_html__('Image', 'ekommart'),
                            'icon'  => esc_html__('Icon & SVG', 'ekommart'),
                        ],
                        'default' => 'image',
                    ],
                    [
                        'name'      => 'brand_image',
                        'label'     => esc_html__('Choose Image', 'ekommart'),
                        'type'      => Controls_Manager::MEDIA,
                        'dynamic'   => [
                            'active' => true,
                        ],
                        'default'   => [
                            'url' => Elementor\Utils::get_placeholder_image_src(),
                        ],
                        'condition' => [
                            'type_brand' => 'image'
                        ]
                    ],
                    [
                        'name'      => 'selected_icon',
                        'label'     => esc_html__('Icon', 'ekommart'),
                        'type'      => Controls_Manager::ICONS,
                        'default'   => [
                            'value'   => 'fas fa-star',
                            'library' => 'fa-solid',
                        ],
                        'condition' => [
                            'type_brand' => 'icon'
                        ]
                    ],
                    [
                        'name'        => 'link',
                        'label'       => esc_html__('Link to', 'ekommart'),
                        'type'        => Controls_Manager::URL,
                        'dynamic'     => [
                            'active' => true,
                        ],
                        'placeholder' => esc_html__('https://your-link.com', 'ekommart'),
                    ]
                ],
                'title_field' => '{{{ brand_title }}}',
            ]
        );

        $this->add_control(
            'heading_settings',
            [
                'label'     => esc_html__('Settings', 'ekommart'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'brand_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `brand_image_size` and `brand_image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'   => esc_html__('Columns', 'ekommart'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 3,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
            ]
        );

        $this->add_responsive_control(
            'brand_align',
            [
                'label'     => esc_html__('Alignment', 'ekommart'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start'   => [
                        'title' => esc_html__('Left', 'ekommart'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'ekommart'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end'  => [
                        'title' => esc_html__('Right', 'ekommart'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-brand-wrapper .row' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_spacing',
            [
                'label' => esc_html__('Spacing', 'ekommart'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-brand-wrapper .row' => 'margin-left: calc(-{{SIZE}}{{UNIT}}/2); margin-right: calc(-{{SIZE}}{{UNIT}}/2);',
                    '{{WRAPPER}} .elementor-brand-wrapper .column-item' => 'padding-left: calc({{SIZE}}{{UNIT}}/2); padding-right: calc({{SIZE}}{{UNIT}}/2); margin-bottom: calc({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_brand_wrapper',
            [
                'label' => esc_html__('Wrapper', 'ekommart'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label'      => esc_html__('Padding', 'ekommart'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-brand-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => esc_html__('Margin', 'ekommart'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-brand-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_brand_wrapper');

        $this->start_controls_tab(
            'tab_wrapper_normal',
            [
                'label' => esc_html__('Normal', 'ekommart'),
            ]
        );

        $this->add_control(
            'image_opacity',
            [
                'label'     => esc_html__('Opacity', 'ekommart'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-brand-image img, {{WRAPPER}} .elementor-brand-image i, {{WRAPPER}} .elementor-brand-image svg' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'brand_wrapper',
                'selector' => '{{WRAPPER}} .elementor-brand-image',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_brand_wrapper_hover',
            [
                'label' => esc_html__('Hover', 'ekommart'),
            ]
        );

        $this->add_control(
            'image_opacity_hover',
            [
                'label'     => esc_html__('Opacity', 'ekommart'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'default'   => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-brand-image a:hover img, {{WRAPPER}} .elementor-brand-image a:hover i, {{WRAPPER}} .elementor-brand-image a:hover svg' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'brand_wrapper_hover',
                'selector' => '{{WRAPPER}} .elementor-brand-image:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'style_brand_icon',
            [
                'label' => esc_html__('Icon & SVG', 'ekommart'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label'     => esc_html__('Size', 'ekommart'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 200,
                        'min'  => 0,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-brand-image i'   => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-brand-image svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_icon_style');
        $this->start_controls_tab(
            'tab_icon_normal',
            [
                'label' => esc_html__('Normal', 'ekommart'),
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'ekommart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-brand-image i'                    => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-brand-image:not(:hover) svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_icon_hover',
            [
                'label' => esc_html__('Hover', 'ekommart'),
            ]
        );
        $this->add_control(
            'icon_color_hover',
            [
                'label'     => esc_html__('Primary Color', 'ekommart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-brand-image:hover i'        => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-brand-image:hover svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();

        $this->add_control_carousel();

    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['brands']) && is_array($settings['brands'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-brand-wrapper');

            // Row
            $this->add_render_attribute('row', 'class', 'row');

            $this->add_render_attribute('item', 'class', 'elementor-brand-item column-item');

            if ($settings['enable_carousel'] === 'yes') {
                $this->add_render_attribute('row', 'class', 'ekommart-carousel');
                $carousel_settings = $this->get_carousel_settings();
                $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
                $this->add_render_attribute('row', 'data-elementor-columns', 1);
            }else {
                $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
                if (!empty($settings['column_tablet'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['column_tablet']);
                }
                if (!empty($settings['column_mobile'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['column_mobile']);
                }
            }


        }

        $migrated = isset($settings['__fa4_migrated']['selected_icon']);
        $is_new   = empty($settings['icon']) && Icons_Manager::is_migration_allowed();

        if (empty($settings['icon']) && !Icons_Manager::is_migration_allowed()) {
            $settings['icon'] = 'fa fa-star';
        }

        if (!empty($settings['icon'])) {
            $this->add_render_attribute('icon', 'class', $settings['icon']);
            $this->add_render_attribute('icon', 'aria-hidden', 'true');
        }

        ?>
        <div class="elementor-brands">
            <div <?php echo ekommart_elementor_get_render_attribute_string('wrapper', $this); // WPCS: XSS ok. ?>>

                <div <?php echo ekommart_elementor_get_render_attribute_string('row', $this); // WPCS: XSS ok. ?>>
                    <?php foreach ($settings['brands'] as $item) : ?>
                        <div <?php echo ekommart_elementor_get_render_attribute_string('item', $this); // WPCS: XSS ok. ?>>
                            <div class="elementor-brand-image">
                                <?php
                                if (!empty($item['link'])) {
                                    if (!empty($item['link']['is_external'])) {
                                        $this->add_render_attribute('brand-image', 'target', '_blank');
                                    }

                                    if (!empty($item['link']['nofollow'])) {
                                        $this->add_render_attribute('brand-image', 'rel', 'nofollow');
                                    }

                                    echo '<a href="' . esc_url($item['link']['url'] ? $item['link']['url'] : '#') . '" ' . ekommart_elementor_get_render_attribute_string('brand-image', $this) . ' title="' . esc_attr($item['brand_title']) . '">';
                                }

                                if ($item['type_brand'] == 'image') {
                                    $item['image_size']             = $settings['brand_image_size'];
                                    $item['image_custom_dimension'] = $settings['brand_image_custom_dimension'];

                                    if (!empty($item['brand_image']['url'])) {
                                        echo Elementor\Group_Control_Image_Size::get_attachment_image_html($item, 'image', 'brand_image');
                                    }

                                } else {
                                    if ($is_new || $migrated) {
                                        Icons_Manager::render_icon($item['selected_icon'], ['aria-hidden' => 'true']);
                                    } else { ?>
                                        <i <?php echo ekommart_elementor_get_render_attribute_string('icon', $this); // WPCS: XSS ok. ?>></i>
                                        <?php
                                    }
                                }
                                if (!empty($item['link'])) {
                                    echo '</a>';
                                }
                                ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
    }

    protected function add_control_carousel($condition = array()) {
        $this->start_controls_section(
            'section_carousel_options',
            [
                'label'     => esc_html__('Carousel Options', 'ekommart'),
                'type'      => Controls_Manager::SECTION,
                'condition' => $condition,
            ]
        );

        $this->add_control(
            'enable_carousel',
            [
                'label' => esc_html__('Enable', 'ekommart'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label'     => esc_html__('Navigation', 'ekommart'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'dots',
                'options'   => [
                    'both'   => esc_html__('Arrows and Dots', 'ekommart'),
                    'arrows' => esc_html__('Arrows', 'ekommart'),
                    'dots'   => esc_html__('Dots', 'ekommart'),
                    'none'   => esc_html__('None', 'ekommart'),
                ],
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label'     => esc_html__('Pause on Hover', 'ekommart'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'     => esc_html__('Autoplay', 'ekommart'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'     => esc_html__('Autoplay Speed', 'ekommart'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5000,
                'condition' => [
                    'autoplay'        => 'yes',
                    'enable_carousel' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
                ],
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label'     => esc_html__('Infinite Loop', 'ekommart'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function get_carousel_settings() {
        $settings = $this->get_settings_for_display();

        return array(
            'navigation'         => $settings['navigation'],
            'autoplayHoverPause' => $settings['pause_on_hover'] === 'yes' ? true : false,
            'autoplay'           => $settings['autoplay'] === 'yes' ? true : false,
            'autoplayTimeout'    => $settings['autoplay_speed'],
            'items'              => $settings['column'],
            'items_tablet'       => $settings['column_tablet'] ? $settings['column_tablet'] : $settings['column'],
            'items_mobile'       => $settings['column_mobile'] ? $settings['column_mobile'] : 1,
            'loop'               => $settings['infinite'] === 'yes' ? true : false,
        );
    }
}

$widgets_manager->register_widget_type(new Ekommart_Elementor_Brand());
