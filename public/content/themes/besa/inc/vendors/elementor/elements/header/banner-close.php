<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Besa_Elementor_Banner_Close') ) {
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
class Besa_Elementor_Banner_Close extends  Besa_Elementor_Widget_Base{
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
        return 'besa-banner-close';
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
        return esc_html__( 'Besa Banner Close', 'besa' );
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
        return 'eicon-banner';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__( 'General', 'besa' ),
            ]
        );
        $this->register_image_controls();
        $this->add_control(
            'add_link',
            [
                'label' => esc_html__( 'Add Link', 'besa' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );
        $this->add_control(
            'close_button',
            [
                'label' => esc_html__( 'Show Close Button', 'besa' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );
        $this->end_controls_section();
        $this->add_control_link();
    }

    protected function register_image_controls() {
        $this->add_control(
            'banner_image',
            [
                'label' => esc_html__( 'Choose Image', 'besa' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );
    }

    
    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function add_control_link() {
        $this->start_controls_section(
            'section_link_options',
            [
                'label' => esc_html__( 'Add Link Option', 'besa' ),
                'type'  => Controls_Manager::SECTION,
                'condition' => array(
                    'add_link' => 'yes', 
                ),
            ]
        );
        $this->add_control(
            'banner_link',
            [
                'label' => esc_html__( 'Link to', 'besa' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'besa' ),
            ]
        );
        
        $this->end_controls_section();
    }

    protected function render_item_content() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        if( isset($banner_link['url']) && !empty($banner_link['url']) ) {
            $this->add_render_attribute('link', 'class', 'btn-link');
            $this->add_render_attribute('link', 'href', $banner_link['url']);

            if( $banner_link['is_external'] === 'on' ) {
                $this->add_render_attribute('link', 'target', '_blank');
            }
            if( $banner_link['nofollow'] === 'on' ) {
                $this->add_render_attribute('link', 'rel', 'nofollow');
            }
        }

        $id     = $banner_image['id'];
        $_id = $this->get_id();
        if( empty($id) ) return;
        
        if( !empty($banner_link['url']) ) echo '<a '.trim($this->get_render_attribute_string('link')).'>';
            echo wp_get_attachment_image($id, 'full');
            $this->render_item_close_button($_id);
        if( !empty($banner_link['url']) ) echo '</a>';
    }

    protected function render_item_close_button($_id) {
        $enable_btn = $this->get_settings_for_display('close_button');

        if( empty( $enable_btn ) ) return;

        echo '<div class="container"><button data-id="'. esc_attr($_id) .'" id="banner-remove-'. esc_attr($_id) .'" class="banner-remove"><i class="tb-icon tb-icon-cross"></i></button></div>';
        
    }
}
$widgets_manager->register_widget_type(new Besa_Elementor_Banner_Close());
