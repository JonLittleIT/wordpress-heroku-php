<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Besa_Elementor_Nav_Menu') ) {
    exit; // Exit if accessed directly.
}


use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;

class Besa_Elementor_Nav_Menu extends Besa_Elementor_Widget_Base {

    protected $nav_menu_index = 1;

    public function get_name() {
        return 'besa-nav-menu';
    }

    public function get_title() {
        return esc_html__('Besa Nav Menu', 'besa');
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_script_depends() {
        $script = [];

        $script[]   = 'jquery-treeview';

        return $script;
    }

    public function on_export($element) {
        unset($element['settings']['menu']);

        return $element;
    }

    protected function get_nav_menu_index() {
        return $this->nav_menu_index++;
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Layout', 'besa'),
            ]
        );

        $menus = $this->get_available_menus();

        if (!empty($menus)) {
            $this->add_control(
                'menu',
                [
                    'label'        => esc_html__('Menu', 'besa'),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys($menus)[0],
                    'save_default' => true,
                    'separator'    => 'after',
                    'description'  => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'besa'), admin_url('nav-menus.php')),
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf(__('<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'besa'), admin_url('nav-menus.php?action=edit&menu=0')),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        $this->add_control(
            'layout',
            [
                'label'              => esc_html__('Layout Menu', 'besa'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'horizontal',
                'options'            => [
                    'horizontal' => esc_html__('Horizontal', 'besa'),
                    'vertical'   => esc_html__('Vertical', 'besa'),
                    'treeview'   => esc_html__('Tree View', 'besa'),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_responsive_control(
            'align_items', 
            [ 
                'label'        => esc_html__('Align', 'besa'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'flex-start'    => [ 
                        'title' => esc_html__('Start', 'besa'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'  => [ 
                        'title' => esc_html__('Center', 'besa'),
                        'icon'  => 'fa fa-align-center',
                    ], 
                    'flex-end'   => [ 
                        'title' => esc_html__('End', 'besa'),
                        'icon'  => 'fa fa-align-right',
                    ], 
                ],
                'prefix_class' => 'elementor-nav-menu%s__align-',
                'default'      => '',
                'condition' => [
                    'layout' => 'horizontal'
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-nav-menu' => 'justify-content: {{VALUE}} !important',
                ]
            ]
        );

        $this->add_control(
            'hidden_indicator',
            [
                'label'        => esc_html__('Hidden Submenu Indicator', 'besa'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => '',
                'prefix_class' => 'hidden-indicator-',
                'condition' => [
                    'layout!' => 'treeview'
                ],
            ]
        );


        $this->add_control(
            'show_toggle_menu',
            [
                'label' => esc_html__( 'Show Toggle Menu', 'besa' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [
                    'layout!' => 'horizontal',
                    'show_canvas_menu!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_canvas_menu',
            [
                'label' => esc_html__( 'Show Canvas Menu', 'besa' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [
                    'layout!' => 'horizontal',
                    'show_toggle_menu!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_canvas_menu_class',
            [
                'label' => esc_html__( 'Show Canvas Menu Class', 'besa' ),
                'type' => Controls_Manager::HIDDEN,
                'prefix_class' => 'width-auto-',
                'default' => 'yes', 
                 'condition' => [
                    'show_canvas_menu' => 'yes',
                ],
            ]
        );
        

        $this->end_controls_section();

        $this->register_section_toggle_menu();

        $this->register_section_vertical_menu();
        $this->register_section_canvas_menu();

        $this->register_section_style_main_menu();
        $this->register_section_style_menu_dropdown();
        $this->register_section_style_menu_canvas();
    }

    private function register_section_style_main_menu() {

        $this->start_controls_section(
            'section_style_main-menu',
            [
                'label' => esc_html__('Main Menu', 'besa'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_menu',
            [
                'label'     => esc_html__('Background Color Full', 'besa'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-nav-menu'    => 'background-color: {{VALUE}}',
                ],
            ]
        );     

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .elementor-nav-menu--main >ul > li> a',
            ]
        );

        $this->start_controls_tabs('tabs_menu_item_style');

        $this->start_controls_tab(
            'tab_menu_item_normal',
            [
                'label' => esc_html__('Normal', 'besa'),
            ]
        );

        $this->add_control(
            'color_menu_item',
            [
                'label'     => esc_html__('Text Color', 'besa'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-nav-menu--main >ul > li> a'=> 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-nav-menu--main >ul > li > a i'=> 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-nav-menu--main >ul > li> .caret:before'  => 'background-color: {{VALUE}}',
                    1  
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'menu_item_box_shadow',
                'selector'  => '{{WRAPPER}} .elementor-nav-menu--main >ul > li> a',
                'condition' => [
                    'layout' => 'horizontal',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_menu_item_hover',
            [
                'label' => esc_html__('Hover', 'besa'),
            ]
        );
        $this->add_control(
            'bg_menu_item_hover',
            [
                'label'     => esc_html__('Background Color', 'besa'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-nav-menu--main >ul > li> a:hover,
                    {{WRAPPER}} .elementor-nav-menu--main >ul > li > a:focus,
                    {{WRAPPER}} .elementor-nav-menu--main >ul > li.active > a'    => 'background-color: {{VALUE}}',
                ],
            ]
        );        

        $this->add_control(
            'color_menu_item_hover',
            [
                'label'     => esc_html__('Text Color', 'besa'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-nav-menu--main >ul > li> a:hover,
                    {{WRAPPER}} .tbay-element-nav-menu .elementor-nav-menu--main >ul > li:hover> a >.caret,
                    {{WRAPPER}} .tbay-element-nav-menu .elementor-nav-menu--main >ul > li:focus> a >.caret,
                    {{WRAPPER}} .tbay-element-nav-menu .elementor-nav-menu--main >ul > li.active> a >.caret,
                    {{WRAPPER}} .elementor-nav-menu--main >ul > li> a:hover i,
                    {{WRAPPER}} .elementor-nav-menu--main >ul > li> a:focus i,
                    {{WRAPPER}} .elementor-nav-menu--main >ul > li> a.active i,
                    {{WRAPPER}} .elementor-nav-menu--main >ul > li > a:focus,
                    {{WRAPPER}} .elementor-nav-menu--main >ul > li.active > a'    => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'menu_item_box_shadow_hover',
                'selector'  => '{{WRAPPER}} .elementor-nav-menu--main >ul > li> a:hover',
                'condition' => [
                    'layout' => 'horizontal',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'padding_horizontal_menu_item',
            [
                'label'     => esc_html__('Horizontal Padding', 'besa'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-nav-menu--main .elementor-item'        => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
                ],
            ]
        );


        $this->add_responsive_control(
            'padding_vertical_menu_item',
            [
                'label'     => esc_html__('Vertical Padding', 'besa'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-nav-menu--main .elementor-item'        => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_space_between',
            [
                'label'     => esc_html__('Space Between', 'besa'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .elementor-nav-menu--layout-horizontal .elementor-nav-menu > li:not(:last-child)'                 => 'margin-right: {{SIZE}}{{UNIT}}',
                    'body.rtl {{WRAPPER}} .elementor-nav-menu--layout-horizontal .elementor-nav-menu > li:not(:last-child)'                       => 'margin-left: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_section_style_menu_canvas() {
        $this->start_controls_section(
            'section_style_canvas',
            [
                'label'     => esc_html__('Canvas', 'besa'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_canvas_menu' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'toggle_canvas_icon_color',
            [
                'label' => esc_html__('Color Icon', 'besa'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-canvas-menu i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_section_style_menu_dropdown() {
        $this->start_controls_section(
            'section_style_dropdown',
            [
                'label'     => esc_html__('Dropdown', 'besa'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'dropdown_typography',
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'exclude'   => ['line_height'],
                'selector'  => '{{WRAPPER}} .navbar-nav .dropdown-menu > li > a',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'dropdown_Heading',
            [
                'label'     => esc_html__('Heading sub title megamenu', 'besa'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .active-mega-menu .elementor-widget-wp-widget-nav_menu > .elementor-widget-container > h5'       => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );


        $this->start_controls_tabs('tabs_dropdown_item_style');

        $this->start_controls_tab(
            'tab_dropdown_item_normal',
            [
                'label' => esc_html__('Normal', 'besa'),
            ]
        );

        $this->add_control(
            'color_dropdown_item',
            [
                'label'     => esc_html__('Text Color', 'besa'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dropdown-menu > li > a, 
                    {{WRAPPER}} .active-mega-menu .elementor-nav-menu > li > a, 
                    {{WRAPPER}} .active-mega-menu .menu > li> a' => 'color: {{VALUE}}',
                ],
            ]
        ); 

        $this->add_control(
            'background_color_dropdown_item',
            [
                'label'     => esc_html__('Background Color', 'besa'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [ 
                    '{{WRAPPER}} .active-mega-menu > .dropdown-menu, 
                    {{WRAPPER}} .elementor-nav-menu > li.dropdown > .dropdown-menu' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
                ],
                'separator' => 'none',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dropdown_item_hover',
            [
                'label' => esc_html__('Hover', 'besa'),
            ]
        );

        $this->add_control(
            'color_dropdown_item_hover',
            [
                'label'     => esc_html__('Text Color', 'besa'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dropdown-menu > li > a:hover, 
                    {{WRAPPER}} .dropdown-menu > li:hover > a,
                    {{WRAPPER}} .active-mega-menu .menu > li> a:hover,
                    {{WRAPPER}} .active-mega-menu .menu > li:hover > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'background_color_dropdown_item_hover',
            [
                'label'     => esc_html__('Background Color', 'besa'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dropdown-menu > li:hover,
                    {{WRAPPER}} .active-mega-menu .menu > li:hover' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'none',
            ]
        );

        $this->end_controls_tab();

         $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'dropdown_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .navbar-nav li:hover > .dropdown-menu',
            ]
        );

        $this->add_responsive_control(
            'padding_horizontal_dropdown_item',
            [
                'label'     => esc_html__('Horizontal Padding', 'besa'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .dropdown-menu > li, {{WRAPPER}} .active-mega-menu .menu > li'       => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'before',

            ]
        );

        $this->add_responsive_control(
            'padding_vertical_dropdown_item',
            [
                'label'     => esc_html__('Vertical Padding', 'besa'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dropdown-menu > li, {{WRAPPER}} .active-mega-menu .menu > li'       => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control( 
            'dropdown_padding',
            [
                'label'      => esc_html__('Padding', 'besa'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dropdown-menu, {{WRAPPER}} .active-mega-menu .menu'       => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->end_controls_section();
    }

    private function register_section_toggle_menu() {

        $this->start_controls_section(
            'section_toggle_menu',
            [
                'label' => esc_html__( 'Toggle Menu', 'besa' ),
                'condition' => [
                    'show_toggle_menu!' => '',
                    'layout!' => 'horizontal',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_menu_align',
            [
                'label' => esc_html__('Alignment', 'besa'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'besa'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'besa'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'besa'),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'besa'),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .toggle-menu-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'toggle_menu_title_heading',
            [
                'label' => esc_html__('Title', 'besa'),
                'type' => Controls_Manager::HEADING,
            ]
        );        

        $this->add_control(
            'toggle_menu_title',
            [
                'label' => esc_html__('Title', 'besa'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Title', 'besa' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'toggle_menu_title_tag',
            [
                'label' => esc_html__( 'Title HTML Tag', 'besa' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h3',
            ]
        );

        $this->add_responsive_control(
            'toggle_menu_title_size',
            [
                'label' => esc_html__('Font Size Title', 'besa'),
                'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .toggle-menu-title span' => 'font-size: {{SIZE}}{{UNIT}};',
				],
            ]
        );
        $this->add_responsive_control(
            'toggle_menu_title_line_height',
            [
                'label' => esc_html__('Line Height Title', 'besa'),
                'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .toggle-menu-title span' => 'line-height: {{SIZE}}{{UNIT}};',
				],
            ]
        );
        $this->add_responsive_control(
            'toggle_menu_title_font_weight',
            [
                'label' => esc_html__('Font Weight Title', 'besa'),
                'type' => Controls_Manager::SELECT,
				'options' => [
                    '100' => '100',
                    '200' => '200',
                    '300' => '300',
                    '400' => '400',
                    '500' => '500',
                    '600' => '600',
                    '700' => '700',
                    '800' => '800',
                ],
                'default' => '700',
				'selectors' => [
					'{{WRAPPER}} .toggle-menu-title span' => 'font-weight: {{VALUE}}',
				],
            ]
        );

        $this->add_control(
            'toggle_content_menu',
            [
                'label' => esc_html__( 'Toggle content menu', 'besa' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'elementor-toggle-content-menu-',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_content_menu',
            [
                'label' => esc_html__( 'Show content menu', 'besa' ),
                'description' => esc_html__( 'Show content menu on home page', 'besa' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'elementor-show-content-menu-',
                'default'      => 'no',
                'condition' => [
                    'toggle_content_menu!' => '', 
                ],
            ]
        );

        $this->add_control(
            'show_toggle_menu_icon',
            [
                'label' => esc_html__( 'Show Icon', 'besa' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );


        $this->add_control(
            'toggle_menu_icon_heading',
            [
                'label' => esc_html__('Icon', 'besa'),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'show_toggle_menu_icon!' => '',
                ],
            ]
        );    

        $this->add_responsive_control(
            'toggle_menu_icon',
            [
                'label' => esc_html__('Icon', 'besa'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_toggle_menu_icon!' => '',
                ],
            ]
        );

        $this->add_control(
            'toggle_menu_icon_size',
            [
                'label' => esc_html__('Font Size Icon', 'besa'),
                'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
                    '{{WRAPPER}} .toggle-menu-title i,
                    {{WRAPPER}} .toggle-menu-title svg' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_toggle_menu_icon!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->register_section_style_toggle_menu();
    }

    private function register_section_vertical_menu() {

        $this->start_controls_section(
            'section_vertical_menu',
            [
                'label' => esc_html__( 'Vertical Menu', 'besa' ),
                'condition' => [
                    'layout' => 'vertical',
                    'show_canvas_menu!' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_vertical_submenu_align',
            [
                'label' => esc_html__('Alignment Sub Menu', 'besa'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'besa'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'besa'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'right',
            ]
        );

        $this->end_controls_section();
    }

    private function register_section_canvas_menu() {

        $this->start_controls_section(
            'section_canvas_menu',
            [
                'label' => esc_html__( 'Canvas Menu', 'besa' ),
                'condition' => [
                    'show_canvas_menu' => 'yes',
                    'layout!' => 'horizontal',
                ],
            ]
        );

        $this->add_control(
            'toggle_canvas_icon_heading',
            [
                'label' => esc_html__('Icon', 'besa'),
                'type' => Controls_Manager::HEADING,
            ]
        );  

        $this->add_responsive_control(
            'toggle_canvas_menu_icon',
            [
                'label' => esc_html__('Icon', 'besa'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
				'default' => [
					'value' => 'tb-icon tb-icon-text-align-right',
					'library' => 'tbay-custom',
                ],
            ]
        );

        $this->add_control(
            'toggle_canvas_icon_size',
            [
                'label' => esc_html__('Font Size Icon', 'besa'),
                'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
                    '{{WRAPPER}} .btn-canvas-menu i,
                    {{WRAPPER}} .btn-canvas-menu svg' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_canvas_content_align',
            [
                'label' => esc_html__('Positioning Content', 'besa'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'besa'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'besa'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => '', 
                'prefix_class' => 'canvas-position-',
            ]
        );        

        $this->add_control(
            'toggle_canvas_title_heading',
            [
                'label' => esc_html__('Title Content', 'besa'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );        

        $this->add_control(
            'toggle_canvas_title',
            [
                'label' => esc_html__('Title', 'besa'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Title', 'besa' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'toggle_canvas_title_tag',
            [
                'label' => esc_html__( 'Title HTML Tag', 'besa' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h3',
            ]
        );

        $this->add_responsive_control(
            'toggle_canvas_title_size',
            [
                'label' => esc_html__('Font Size Title', 'besa'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .toggle-canvas-title' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'toggle_canvas_title_line_height',
            [
                'label' => esc_html__('Line Height Title', 'besa'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .toggle-canvas-title' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_canvas_title_align',
            [
                'label' => esc_html__('Alignment Title', 'besa'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'besa'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'besa'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => '', 
                'selectors' => [
                    '{{WRAPPER}} .toggle-canvas-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_section_style_toggle_menu() {
        $this->start_controls_section(
            'section_style_toggle_menu',
            [
                'label' => esc_html__( 'Toggle Menu', 'besa' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_toggle_menu!' => '',
                    'layout!' => 'horizontal',
                ],
            ]
        );

        $this->add_control(
            'style_toggle_menu',
            [
                'label'     => esc_html__('Background Color', 'besa'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .toggle-menu-title'    => 'background-color: {{VALUE}}',
                ],
            ]
        );     

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'style_toggle_menu_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .toggle-menu-title span',
            ]
        );

        
        $this->add_control(
            'toggle_menu_color',
            [
                'label'     => esc_html__('Text Color', 'besa'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .toggle-menu-title, {{WRAPPER}} .toggle-menu-title > *'=> 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'toggle_menu_color_hover',
            [
                'label'     => esc_html__('Hover Text Color', 'besa'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .toggle-menu-title:hover, {{WRAPPER}} .toggle-menu-title a:hover,
                    {{WRAPPER}} .open .toggle-menu-title a'=> 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
			'toggle_menu_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'besa' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .toggle-menu-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'toggle_menu_padding',
			[
				'label' => esc_html__( 'Padding', 'besa' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .toggle-menu-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'toggle_menu_margin',
			[
				'label' => esc_html__( 'Margin', 'besa' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .toggle-menu-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->end_controls_section();
    }

    public function render_get_toggle_menu() {
        $settings = $this->get_settings();

        extract( $settings );

        $ouput = '';

        if( $layout === 'horizontal' || !$show_toggle_menu ) return;

        if( empty($toggle_menu_title) && !$show_toggle_menu_icon ) return;

        $ouput .= '<'. $toggle_menu_title_tag .'  class="toggle-menu-title category-inside-title">';

            if( !empty($toggle_content_menu) ) {
                $ouput .= '<a href="javascript:void(0);" class="click-show-menu">';
            }

                if( $show_toggle_menu_icon ) {
                    $ouput .= '<i class="'. $toggle_menu_icon['value'] .'"></i>';
                }
 
                if( !empty($toggle_menu_title) )  $ouput .= '<span>'. $toggle_menu_title .'</span>';

            if( !empty($toggle_content_menu) ) {
                $ouput .= '</a>';
            }
        
        $ouput .= '</'. $toggle_menu_title_tag .'>';

        return $ouput;
    }

    public function render_canvas_button_menu() {
        $settings = $this->get_settings();
        extract($settings);

        $ouput = '';

        if( $layout === 'horizontal' || !$show_canvas_menu ) return; 

        $ouput .= '<div class="canvas-menu-btn-wrapper">';
            $ouput .= '<a href="javascript:void(0);" class="btn-canvas-menu"><i class="'. $toggle_canvas_menu_icon['value'] .'"></i></a>';
        $ouput .= '</div>';
        $ouput .= '<div class="canvas-overlay-wrapper"></div>';
      
        return $ouput;
    }

    public function render_get_toggle_canvas_menu() {
        $settings = $this->get_settings();

        extract( $settings );

        $ouput = '';

        if( $layout === 'horizontal' || !$show_canvas_menu ) return; 

        if( empty($toggle_canvas_title) ) return;

        $ouput .= '<'. $toggle_canvas_title_tag .'  class="toggle-canvas-title">';

 
            $ouput .= $toggle_canvas_title;

        
        $ouput .= '</'. $toggle_canvas_title_tag .'>';

        return $ouput; 
    }
}
$widgets_manager->register_widget_type(new Besa_Elementor_Nav_Menu());

