<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if (!ekommart_is_mailchimp_activated()) {
    return;
}

use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;


class OSF_Elementor_Mailchimp extends Elementor\Widget_Base {

    public function get_name() {
        return 'opal-mailchimp';
    }

    public function get_title() {
        return esc_html__( 'MailChimp Sign-Up Form', 'ekommart' );
    }

    public function get_categories() {
        return array( 'ekommart-addons' );
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    protected function _register_controls() {

        //INPUT
        $this->start_controls_section(
            'mailchip_style_input',
            [
                'label' => esc_html__( 'Input', 'ekommart' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_input_style' );

        $this->start_controls_tab(
            'tab_input_normal',
            [
                'label' => esc_html__( 'Normal', 'ekommart' ),
            ]
        );

        $this->add_control(
            'input_color',
            [
                'label'     => esc_html__( 'Color', 'ekommart' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]::placeholder' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'input_background',
            [
                'label'     => esc_html__( 'Background Color', 'ekommart' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_color_border',
            [
                'label'     => esc_html__( 'Color Border', 'ekommart' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'border-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_input_focus',
            [
                'label' => esc_html__( 'Focus', 'ekommart' ),
            ]
        );

        $this->add_control(
            'input_background_focus',
            [
                'label'     => esc_html__( 'Background Color', 'ekommart' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_border_color_focus',
            [
                'label'     => esc_html__( 'Border Color', 'ekommart' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]:focus' => 'border-color: {{VALUE}}  !important;',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'align_input',
            [
                'label'     => esc_html__( 'Alignment', 'ekommart' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'ekommart' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'ekommart' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'ekommart' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(

            Group_Control_Border::get_type(),
            [
                'name'        => 'border_input',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .mc4wp-form-fields input[type="email"]',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'input_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'ekommart' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //Button
        $this->start_controls_section(
            'mailchip_style_button',
            [
                'label' => esc_html__( 'Button', 'ekommart' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'ekommart' ),
            ]
        );

        $this->add_control(
            'button_bacground',
            [
                'label'     => esc_html__( 'Background Color', 'ekommart' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__( 'Text Color', 'ekommart' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]:not(:hover)' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'ekommart' ),
            ]
        );

        $this->add_control(
            'button_bacground_hover',
            [
                'label'     => esc_html__( 'Background Color', 'ekommart' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label'     => esc_html__( 'Color', 'ekommart' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_hover',
            [
                'label'     => esc_html__( 'Border Color', 'ekommart' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_button',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'ekommart' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        echo '<div class="form-style">';
        mc4wp_show_form();
        echo '</div>';
    }
}
$widgets_manager->register_widget_type(new OSF_Elementor_Mailchimp());