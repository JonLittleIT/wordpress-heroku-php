<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Besa_Elementor_Banner') ) {
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
class Besa_Elementor_Banner extends  Besa_Elementor_Widget_Base{
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
        return 'besa-banner';
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
        return esc_html__( 'Besa Banner', 'besa' );
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
                'label' => esc_html__( 'Banner', 'besa' ),
            ]
        );
        $this->register_image_controls();
        $this->add_control(
            'add_link',
            [
                'label' => esc_html__( 'Add Link', 'besa' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->register_title_controls();
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

    protected function register_title_controls() {
        $this->add_control(
            'banner_title',
            [
                'label' => esc_html__( 'Title', 'besa' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'banner_sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'besa' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'banner_desc',
            [
                'label' => esc_html__( 'Description', 'besa' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
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
                'default' => [
					'url' => 'https://your-link.com',
				],
                'placeholder' => esc_html__( 'https://your-link.com', 'besa' ),
            ]
        );
        $this->add_control(
            'style_link',
            [
                'label' => esc_html__( 'Style Link', 'besa' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'button' => esc_html__('Button','besa'),
                    'icon' => esc_html__('Icon','besa'),
                    'none' => esc_html__('None','besa')
                ],
                'default' => 'none',
            ]
        );
        $this->add_control(
            'style_button',
            [
                'label' => esc_html__( 'Text Button', 'besa' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => array(
                    'style_link' => 'button',
                ),
            ]
        );
        $this->add_control(
            'style_icon',
            [
                'label' => esc_html__( 'Choose Icon', 'besa' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'tb-icon tb-icon-plus',
					'library' => 'tbay-custom',
                ],
                'condition' => array(
                    'style_link' => 'icon',
                ),
            ]
        );
        
        $this->end_controls_section();
    }

    protected function render_item_image() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        $id            = $banner_image['id'];
        
        if( empty($id) ) return;
        
        echo wp_get_attachment_image($id, 'full');
    }
    protected function render_item_content($link,$banner_link,$style_link,$style_icon,$style_button,$add_link) {
        if ($add_link === 'no') {
            $this->render_item_image(); 
            return;
        }
        if( isset($link) && !empty($link) ) {
            $link = $link;
        }
        if( $banner_link['is_external'] === 'on' ) {
            $this->add_render_attribute('link', 'target', '_blank');
        }

        if( $banner_link['nofollow'] === 'on' ) {
            $this->add_render_attribute('link', 'rel', 'nofollow');
        }

        if($style_link === 'icon') {
            ?>
                <a <?php echo trim($this->get_render_attribute_string('link')) ?> href="<?php echo esc_url($link) ?>" class="style-icon">
                    <?php 
                        $this->render_item_image(); 
                    ?>
                </a>
                <?php $this->render_item_icon($style_icon); ?>
            <?php
        }
        elseif($style_link === 'button') {
            ?>  
                <?php $this->render_item_image(); ?>
                <a <?php echo trim($this->get_render_attribute_string('link')) ?> href="<?php echo esc_url($link) ?>" class="style-btn">
                    <?php echo trim($style_button) ?>
                </a>
            <?php
        }
        else {
            ?>
                <a <?php echo trim($this->get_render_attribute_string('link')) ?> href="<?php echo esc_url($link) ?>" class="style-none">
                    <?php $this->render_item_image(); ?>
                </a>
            <?php
        }
    }

    protected function render_item_title($banner_title,$banner_sub_title,$banner_desc) {
        $this->add_render_attribute('title', 'class', 'banner-title');
        if(!empty($banner_title) && isset($banner_title) || !empty($banner_sub_title) && isset($banner_sub_title) || !empty($banner_desc) && isset($banner_desc)) {
            ?>
            <div <?php echo trim($this->get_render_attribute_string('title')) ?>>
                <?php if (!empty($banner_title) && isset($banner_title)) : ?>
                    <div class="title"><?php echo trim($banner_title); ?></div>
                <?php endif; ?>

                <?php if (!empty($banner_sub_title) && isset($banner_sub_title)) : ?>
                    <div class="subtitle"><?php echo trim($banner_sub_title); ?></div>
                <?php endif; ?>

                <?php if (!empty($banner_desc) && isset($banner_desc)) : ?>
                    <div class="description"><?php echo trim($banner_desc); ?></div>
                <?php endif; ?>
            </div>
            
        <?php
        }
    }
}
$widgets_manager->register_widget_type(new Besa_Elementor_Banner());
