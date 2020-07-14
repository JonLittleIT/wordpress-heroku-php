<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
if (!ekommart_is_contactform_activated()) {
    return;
}
use Elementor\Controls_Manager;


class Ekommart_Elementor_ContactForm extends Elementor\Widget_Base {

    public function get_name() {
        return 'ekommart-contactform';
    }

    public function get_title() {
        return __('Ekommart Contact Form', 'ekommart');
    }

    public function get_categories() {
        return array('ekommart-addons');
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'contactform7',
            [
                'label' => __('General', 'ekommart'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');
        $contact_forms[''] = __('Please select form', 'ekommart');
        if ($cf7) {
            foreach ($cf7 as $cform) {
                $contact_forms[$cform->ID] = $cform->post_title;
            }
        } else {
            $contact_forms[0] = __('No contact forms found', 'ekommart');
        }

        $this->add_control(
            'cf_id',
            [
                'label'   => __('Select contact form', 'ekommart'),
                'type'    => Controls_Manager::SELECT,
                'options' => $contact_forms,
                'default' => ''
            ]
        );

        $this->add_control(
            'form_name',
            [
                'label'   => __('Form name', 'ekommart'),
                'type'    => Controls_Manager::TEXT,
                'default' => __('Contact form', 'ekommart'),
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if(!$settings['cf_id']){
            return;
        }
        $args['id']    = $settings['cf_id'];
        $args['title'] = $settings['form_name'];

        echo ekommart_do_shortcode('contact-form-7', $args);
    }
}
$widgets_manager->register_widget_type(new Ekommart_Elementor_ContactForm());