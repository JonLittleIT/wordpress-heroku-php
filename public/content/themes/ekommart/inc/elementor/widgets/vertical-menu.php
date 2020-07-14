<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class Ekommart_Elementor_Vertical_Menu extends Elementor\Widget_Base
{

    public function get_name()
    {
        return 'ekommart-vertical-menu';
    }

    public function get_title()
    {
        return __('Vertical Menu', 'ekommart');
    }

    public function get_icon()
    {
        return 'eicon-nav-menu';
    }

    public function get_categories()
    {
        return array('ekommart-addons');
    }

    protected function _register_controls(){
        $this->start_controls_section(
            'menu_content',
            [
                'label' => __('Menu','ekommart'),
            ]
        );

        $this->add_control(
            'type_menu',
            [
                'label'     => __('Type', 'ekommart'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'default',
                'options'   => [
                    'default'    => __('Default', 'ekommart'),
                    'hover'     => __('Hover', 'ekommart'),
                ],
                'prefix_class'  => 'menu-vertical-type-'
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        ekommart_vertical_navigation();
    }

}

$widgets_manager->register_widget_type(new Ekommart_Elementor_Vertical_Menu());
