<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! ekommart_is_revslider_activated() ) {
	return;
}

use Elementor\Controls_Manager;

class Ekommart_Elementor_RevSlider extends Elementor\Widget_Base {

	public function get_name() {
		return 'ekommart-revslider';
	}

	public function get_title() {
		return esc_html__( 'Ekommart Revolution Slider', 'ekommart' );
	}

	public function get_categories() {
		return array( 'ekommart-addons' );
	}

	public function get_icon() {
		return 'ekommart-icon-sync';
	}


	protected function _register_controls() {
		$this->start_controls_section(
			'rev_slider',
			[
				'label' => __( 'General', 'ekommart' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$slider     = new RevSlider();
		$arrSliders = $slider->getArrSliders();

		$revsliders = array();
		if ( $arrSliders ) {
			foreach ( $arrSliders as $slider ) {
				/** @var $slider RevSlider */
				$revsliders[ $slider->getAlias() ] = $slider->getTitle();
			}
		} else {
			$revsliders[0] = __( 'No sliders found', 'ekommart' );
		}

		$this->add_control(
			'rev_alias',
			[
				'label'   => __( 'Revolution Slider', 'ekommart' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $revsliders,
				'default' => ''
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( ! $settings['rev_alias'] ) {
			return;
		}
		echo apply_filters( 'opal_revslider_shortcode', do_shortcode( '[rev_slider ' . $settings['rev_alias'] . ']' ) );
	}
}

$widgets_manager->register_widget_type( new Ekommart_Elementor_RevSlider() );