<?php

if ( !function_exists('besa_section_stretch_row')) {
    function besa_section_stretch_row( $widget ) {

        $widget->start_controls_section(
            'section_stretch_row',
            [
                'label' => esc_html__( 'Stretch Row', 'besa' ),
                'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED, 
                 'condition' => [
                    'stretch_section!' => '',
                ],
            ]
        );
  
        $widget->add_responsive_control(
            'section_stretch_margin', 
            [
                'label' => esc_html__( 'Margin', 'besa' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],  
                'selectors' => [
                    '{{WRAPPER}} >.elementor-container >.elementor-row' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );        

        $widget->add_responsive_control(
            'section_stretch_padding', 
            [
                'label' => esc_html__( 'Padding', 'besa' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],  
                'selectors' => [
                    '{{WRAPPER}} >.elementor-container >.elementor-row' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
 
        $widget->end_controls_section();  

    }

    add_action( 'elementor/element/section/section_effects/before_section_start', 'besa_section_stretch_row', 10, 1 );
}

