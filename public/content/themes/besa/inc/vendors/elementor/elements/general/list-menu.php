<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Besa_Elementor_List_Menu') ) {
    exit; // Exit if accessed directly.
}


use Elementor\Controls_Manager;


class Besa_Elementor_List_Menu extends Besa_Elementor_Widget_Base {

    public function get_name() {
        return 'besa-list-menu';
    }

    public function get_title() {
        return esc_html__('Besa List Menu', 'besa');
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function on_export($element) {
        unset($element['settings']['menu']);

        return $element;
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('General', 'besa'),
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
                    'description'  => esc_html__('Note does not apply to Mega Menu.', 'besa'),
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
            'list_menu_separator',
            [
                'label' => esc_html__('Separator Between', 'besa'),
                'type' => Controls_Manager::TEXT,
                'default'  =>  ', ',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
    }

}
$widgets_manager->register_widget_type(new Besa_Elementor_List_Menu());

