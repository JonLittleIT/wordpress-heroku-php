<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


if (!ekommart_is_woocommerce_activated()) {
    return;
}

use Elementor\Controls_Manager;

/**
 * Elementor Product deals
 *
 *
 * @since 1.0.0
 */
class Ekommart_Elementor_Widget_Products_Deals extends \Elementor\Widget_Base {


    public function get_categories() {
        return array('ekommart-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'ekommart-products-deals';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Products Deal Of The Day', 'ekommart');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-tabs';
    }


    public function get_script_depends() {
        return [
            'ekommart-elementor-product-deal',
            'slick',
            'tooltipster'
        ];
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function _register_controls() {

        //Section Query
        $this->start_controls_section(
            'section_setting',
            [
                'label' => esc_html__('Settings', 'ekommart'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Element Title', 'ekommart'),
                'type'  => Controls_Manager::TEXT,
            ]
        );


        $this->add_control(
            'limit',
            [
                'label'   => esc_html__('Posts Per Page', 'ekommart'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'          => esc_html__('Columns', 'ekommart'),
                'type'           => \Elementor\Controls_Manager::SELECT,
                'default'        => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'options'        => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5],
            ]
        );


        $this->add_control(
            'advanced',
            [
                'label' => esc_html__('Advanced', 'ekommart'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__('Order By', 'ekommart'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date'       => esc_html__('Date', 'ekommart'),
                    'id'         => esc_html__('Post ID', 'ekommart'),
                    'menu_order' => esc_html__('Menu Order', 'ekommart'),
                    'popularity' => esc_html__('Number of purchases', 'ekommart'),
                    'rating'     => esc_html__('Average Product Rating', 'ekommart'),
                    'title'      => esc_html__('Product Title', 'ekommart'),
                    'rand'       => esc_html__('Random', 'ekommart'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__('Order', 'ekommart'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => esc_html__('ASC', 'ekommart'),
                    'desc' => esc_html__('DESC', 'ekommart'),
                ],
            ]
        );

        $this->add_responsive_control(
            'product_gutter',
            [
                'label'      => esc_html__('Gutter', 'ekommart'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} ul.products li.product'      => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2); margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} ul.products li.product-item' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2); margin-bottom: calc({{SIZE}}{{UNIT}} - 1px);',
                    '{{WRAPPER}} ul.products'                 => 'margin-left: calc({{SIZE}}{{UNIT}} / -2); margin-right: calc({{SIZE}}{{UNIT}} / -2);',
                ],
            ]
        );

        $this->end_controls_section();
        // End Section Query

        // Carousel Option
        $this->add_control_carousel();
    }


    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $class = 'woocommerce';

        if ($settings['enable_carousel'] === 'yes') {

            $class = "woocommerce-carousel";
            $this->add_render_attribute('wrapper', 'data-settings', json_encode(wp_slash($this->get_carousel_settings())));

        } else {
            $class .= ' columns-' . $settings['column'];

            if (!empty($settings['column_tablet'])) {
                $class .= ' columns-tablet-' . $settings['column_tablet'];
            }

            if (!empty($settings['column_mobile'])) {
                $class .= ' columns-mobile-' . $settings['column_mobile'];
            }
        }

        $this->add_render_attribute('wrapper', 'class', $class);


        $args = array(
            'posts_per_page' => $settings['limit'],
            'post_type'      => 'product',
            'orderby'        => $settings['orderby'],
            'order'          => $settings['order'],
            'meta_key'       => '_deal_quantity',
            'meta_value'     => ' ',
            'meta_compare'   => '!=',
            'meta_query'     => array(
                array( // Simple products type
                       'key'     => '_sale_price',
                       'value'   => 0,
                       'compare' => '>',
                       'type'    => 'numeric'
                )
            )
        );

        $wp_query = new WP_Query($args);

        $date      = ekommart_get_theme_option('wocommerce_product_deal_time');
        $data_date = 0;
        if ($date) {
            $data_date = strtotime($date);
        }

        if ($data_date != 0 && $data_date > current_time('timestamp')) {

            ?>
            <div class="fieldset">
                <div class="legend">
                    <div class="legend-wrap">
                        <div class="element-deal-title"><?php echo wp_kses_post($settings['title']); ?></div>
                        <div class="deal-time">
                            <i class="ekommart-icon ekommart-icon-clock"></i>
                            <div class="deal-count" data-date="<?php echo esc_html($data_date); ?>">
                                <div class="countdown-item">
                                    <span class="countdown-digits countdown-hours">00</span>
                                </div>
                                <div class="countdown-item">
                                    <span> : </span><span class="countdown-digits countdown-minutes">00</span>
                                </div>
                                <div class="countdown-item">
                                    <span> : </span><span class="countdown-digits countdown-seconds">00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php if ($wp_query->have_posts()) : ?>
                    <div <?php echo ekommart_elementor_get_render_attribute_string('wrapper', $this); ?>>
                        <ul class="products">
                            <?php while ($wp_query->have_posts()) : $wp_query->the_post();
                                global $product;
                                if (empty($product) || !$product->is_visible()) {
                                    return;
                                }
                                ?>
                                <li <?php wc_product_class('', $product); ?>>
                                    <?php
                                    do_action('woocommerce_before_shop_loop_item');
                                    do_action('woocommerce_before_shop_loop_item_title');
                                    do_action('woocommerce_shop_loop_item_title');
                                    do_action('woocommerce_after_shop_loop_item_title');
                                    ekommart_woocommerce_deal_progress();
                                    do_action('woocommerce_after_shop_loop_item');
                                    ?>
                                </li>
                            <?php
                            endwhile; ?>
                        </ul>
                    </div>
                <?php endif;
                ?>
            </div>
            <?php
        }
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

        $this->start_controls_section(
            'carousel_arrows',
            [
                'label'      => esc_html__('Carousel Arrows', 'ekommart'),
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'enable_carousel',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'none',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'dots',
                        ],
                    ],
                ],
            ]
        );

        //Style arrow
        $this->add_control(
            'style_arrow',
            [
                'label' => esc_html__('Style Arrow', 'ekommart'),
                'type'  => Controls_Manager::HEADING,
            ]
        );
        //add icon next size
        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => esc_html__('Size', 'ekommart'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        //add icon next color
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'ekommart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:before' => 'color: {{VALUE}};',
                ],
                'separator' => 'after'

            ]
        );

        $this->add_control(
            'next_heading',
            [
                'label' => esc_html__('Next button', 'ekommart'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'next_vertical',
            [
                'label'       => esc_html__('Next Vertical', 'ekommart'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'top'    => [
                        'title' => esc_html__('Top', 'ekommart'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'ekommart'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ]
            ]
        );

        $this->add_responsive_control(
            'next_vertical_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-next' => 'top: unset; bottom: unset; {{next_vertical.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'next_horizontal',
            [
                'label'       => esc_html__('Next Horizontal', 'ekommart'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'  => [
                        'title' => esc_html__('Left', 'ekommart'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'ekommart'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'defautl'     => 'right'
            ]
        );
        $this->add_responsive_control(
            'next_horizontal_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => -45,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-next' => 'left: unset; right: unset;{{next_horizontal.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );


        $this->add_control(
            'prev_heading',
            [
                'label'     => esc_html__('Prev button', 'ekommart'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'prev_vertical',
            [
                'label'       => esc_html__('Prev Vertical', 'ekommart'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'top'    => [
                        'title' => esc_html__('Top', 'ekommart'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'ekommart'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ]
            ]
        );

        $this->add_responsive_control(
            'prev_vertical_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-prev' => 'top: unset; bottom: unset; {{prev_vertical.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'prev_horizontal',
            [
                'label'       => esc_html__('Prev Horizontal', 'ekommart'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'  => [
                        'title' => esc_html__('Left', 'ekommart'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'ekommart'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'defautl'     => 'left'
            ]
        );
        $this->add_responsive_control(
            'prev_horizontal_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => -45,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-prev' => 'left: unset; right: unset; {{prev_horizontal.value}}: {{SIZE}}{{UNIT}};',
                ]
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

    protected function render_carousel_template() {
        ?>
        var carousel_settings = {
        navigation: settings.navigation,
        autoplayHoverPause: settings.pause_on_hover === 'yes' ? true : false,
        autoplay: settings.autoplay === 'yes' ? true : false,
        autoplayTimeout: settings.autoplay_speed,
        items: settings.column,
        items_tablet: settings.column_tablet ? settings.column_tablet : settings.column,
        items_mobile: settings.column_mobile ? settings.column_mobile : 1,
        loop: settings.infinite === 'yes' ? true : false,
        };
        <?php
    }
}

$widgets_manager->register_widget_type(new Ekommart_Elementor_Widget_Products_Deals());
