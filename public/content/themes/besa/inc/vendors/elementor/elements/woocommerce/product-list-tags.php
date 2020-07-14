<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Besa_Elementor_Product_List_Tags') ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;


class Besa_Elementor_Product_List_Tags extends Besa_Elementor_Carousel_Base {

    public function get_name() {
        return 'besa-product-list-tags';
    }

    public function get_title() {
        return esc_html__( 'Besa Image List Tags', 'besa' );
    }

    public function get_script_depends() {
        return [ 'besa-custom-slick', 'slick' ];
    }

    public function get_categories() {
        return [ 'besa-elements', 'woocommerce-elements'];
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_keywords() {
        return [ 'woocommerce-elements', 'list-tags' ];
    }

    protected function _register_controls() {
        $this->register_controls_heading();

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'besa' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );


        $tag_slug = $this->get_woocommerce_tags();
        $repeater = new \Elementor\Repeater();

        if ( is_array($tag_slug) && count($tag_slug) ) {
            $tag_default = array_rand($tag_slug);
            $repeater->add_control(
                'tag_slug',
                [
                    'label'     => esc_html__('Tag', 'besa'),
                    'type'      => Controls_Manager::SELECT,
                    'options'   => $tag_slug,
                    'default'   => $tag_default
                ]
            );
        } else {
            $repeater->add_control(
                'tag_slug',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf(__('<strong>There are no tags in your site.</strong><br>Go to the <a href="%s" target="_blank">Tags screen</a> to create one.', 'besa'), admin_url('edit-tags.php?taxonomy=product_tag&post_type=product')),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }


        $this->add_control(
            'tags', 
            [
                'label' => esc_html__( 'List Tags', 'besa' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        ); 

        $this->end_controls_section();
    }

    public function render_item( $item ) {
        extract($item); 
        $settings = $this->get_settings_for_display();
        extract($settings);
        
        $layout = 'v2';

        $tag   = get_term_by( 'slug', $tag_slug, 'product_tag' );

        if( !$tag ) return;

        $tag_name       = $tag->name;

        $tag_link       =   get_term_link($tag_slug, 'product_tag');
        
        ?> 
    
        <?php wc_get_template( 'item-tag/tag-custom-'.$layout.'.php', array('tag_link' => $tag_link, 'tag_name' => $tag_name ) ); ?>

        <?php

    }

}
$widgets_manager->register_widget_type(new Besa_Elementor_Product_List_Tags());