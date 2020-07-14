<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Ekommart_Elementor_Countdown extends Elementor\Widget_Base {

	public function get_name() {
		return 'ekommart-countdown';
	}

	public function get_title() {
		return esc_html__( 'Ekommart Countdown', 'ekommart' );
	}

	public function get_categories() {
		return array( 'ekommart-addons' );
	}

	public function get_icon() {
		return 'eicon-countdown';
	}

	public function get_script_depends() {
		return [ 'ekommart-elementor-countdown' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_countdown',
			[
				'label' => esc_html__( 'Countdown', 'ekommart' ),
			]
		);

		$this->add_control(
			'due_date',
			[
				'label'       => esc_html__( 'Due Date', 'ekommart' ),
				'type'        => Controls_Manager::DATE_TIME,
				'default'     => date( 'Y-m-d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
				/* translators: %s: Time zone. */
				'description' => sprintf( esc_html__( 'Date set according to your timezone: %s.', 'ekommart' ), Utils::get_timezone_string() ),
			]
		);

		$this->add_control(
			'show_days',
			[
				'label'     => esc_html__( 'Days', 'ekommart' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'ekommart' ),
				'label_off' => esc_html__( 'Hide', 'ekommart' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'show_hours',
			[
				'label'     => esc_html__( 'Hours', 'ekommart' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'ekommart' ),
				'label_off' => esc_html__( 'Hide', 'ekommart' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'show_minutes',
			[
				'label'     => esc_html__( 'Minutes', 'ekommart' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'ekommart' ),
				'label_off' => esc_html__( 'Hide', 'ekommart' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'show_seconds',
			[
				'label'     => esc_html__( 'Seconds', 'ekommart' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'ekommart' ),
				'label_off' => esc_html__( 'Hide', 'ekommart' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'show_labels',
			[
				'label'     => esc_html__( 'Show Label', 'ekommart' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'ekommart' ),
				'label_off' => esc_html__( 'Hide', 'ekommart' ),
				'default'   => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'custom_labels',
			[
				'label'     => esc_html__( 'Custom Label', 'ekommart' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'show_labels!' => '',
				],
			]
		);

		$this->add_control(
			'label_days',
			[
				'label'       => esc_html__( 'Days', 'ekommart' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Days', 'ekommart' ),
				'placeholder' => esc_html__( 'Days', 'ekommart' ),
				'condition'   => [
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_days'      => 'yes',
				],
			]
		);

		$this->add_control(
			'label_hours',
			[
				'label'       => esc_html__( 'Hours', 'ekommart' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Hours', 'ekommart' ),
				'placeholder' => esc_html__( 'Hours', 'ekommart' ),
				'condition'   => [
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_hours'     => 'yes',
				],
			]
		);

		$this->add_control(
			'label_minutes',
			[
				'label'       => __( 'Minutes', 'ekommart' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Minutes', 'ekommart' ),
				'placeholder' => __( 'Minutes', 'ekommart' ),
				'condition'   => [
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_minutes'   => 'yes',
				],
			]
		);

		$this->add_control(
			'label_seconds',
			[
				'label'       => __( 'Seconds', 'ekommart' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Seconds', 'ekommart' ),
				'placeholder' => __( 'Seconds', 'ekommart' ),
				'condition'   => [
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_seconds'   => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Boxes', 'ekommart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'container_width',
			[
				'label'      => __( 'Container Width', 'ekommart' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 100,
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-ekommart-countdown' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'items_width',
			[
				'label'      => __( 'Items Width', 'ekommart' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-countdown-item' => 'width: {{SIZE}}{{UNIT}}; flex-basis: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'items_height',
			[
				'label'      => __( 'Items Height', 'ekommart' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-countdown-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_background_color',
			[
				'label'     => __( 'Background Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-countdown-item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'show_dots',
			[
				'label'     => __( 'Show Dots', 'ekommart' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .elementor-countdown-item:after' => 'content: "";',
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'show_divider',
			[
				'label'     => __( 'Show Divider', 'ekommart' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .elementor-countdown-item'            => 'border-right: 1px solid;',
					'{{WRAPPER}} .elementor-countdown-item:last-child' => 'border-right: 0;',
				],
			]
		);

		$this->add_control(
			'decor_color',
			[
				'label'     => __( 'Dots & Divider Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-countdown-item:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-countdown-item'       => 'border-right-color: {{VALUE}};',
				],
				'separator' => 'after'
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Padding', 'ekommart' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-countdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'ekommart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'digits_color',
			[
				'label'     => __( 'Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-countdown-digits, {{WRAPPER}} .elementor-countdown-item:after' => 'color: {{VALUE}};',
				],
				'default'   => ''
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'digits_typography',
				'selector' => '{{WRAPPER}} .elementor-countdown-digits',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'border_digits',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .elementor-countdown-digits',
			]
		);

		$this->add_responsive_control(
			'digits_padding',
			[
				'label'      => __( 'Padding', 'ekommart' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-countdown-digits' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_label',
			[
				'label'     => __( 'Label', 'ekommart' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'label_color',
			[
				'label'     => __( 'Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-countdown-label' => 'color: {{VALUE}};',
				],
				'default'   => ''
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} .elementor-countdown-label',
			]
		);

		$this->add_responsive_control(
			'label_padding',
			[
				'label'      => __( 'Padding', 'ekommart' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-countdown-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	private function get_strftime( $instance ) {
		$string = '';
		if ( $instance['show_days'] ) {
			$string .= $this->render_countdown_item( $instance, 'label_days', 'elementor-countdown-days' );
		}
		if ( $instance['show_hours'] ) {
			$string .= $this->render_countdown_item( $instance, 'label_hours', 'elementor-countdown-hours' );
		}
		if ( $instance['show_minutes'] ) {
			$string .= $this->render_countdown_item( $instance, 'label_minutes', 'elementor-countdown-minutes' );
		}
		if ( $instance['show_seconds'] ) {
			$string .= $this->render_countdown_item( $instance, 'label_seconds', 'elementor-countdown-seconds' );
		}

		return $string;
	}

	private $_default_countdown_labels;

	private function _init_default_countdown_labels() {
		$this->_default_countdown_labels = [
			'label_months'  => __( 'Months', 'ekommart' ),
			'label_weeks'   => __( 'Weeks', 'ekommart' ),
			'label_days'    => __( 'Days', 'ekommart' ),
			'label_hours'   => __( 'Hours', 'ekommart' ),
			'label_minutes' => __( 'Minutes', 'ekommart' ),
			'label_seconds' => __( 'Seconds', 'ekommart' ),
		];
	}

	public function get_default_countdown_labels() {
		if ( ! $this->_default_countdown_labels ) {
			$this->_init_default_countdown_labels();
		}

		return $this->_default_countdown_labels;
	}

	public function render_countdown_item( $instance, $label, $part_class ) {
		$string = '<div class="elementor-countdown-item"><span class="elementor-countdown-digits ' . esc_attr( $part_class ) . '"></span>';

		if ( $instance['show_labels'] ) {
			$default_labels = $this->get_default_countdown_labels();
			$label          = ( $instance['custom_labels'] ) ? $instance[ $label ] : $default_labels[ $label ];
			$string         .= ' <span class="elementor-countdown-label">' . esc_html( $label ) . '</span>';
		}

		$string .= '</div>';

		return $string;
	}

	protected function render() {
		$instance = $this->get_settings();

		$due_date = $instance['due_date'];

		// Handle timezone ( we need to set GMT time )
		$due_date = strtotime( $due_date ) - ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
		?>
        <div class="elementor-ekommart-countdown" data-date="<?php echo esc_attr( $due_date ); ?>">
			<?php echo ekommart_elementor_get_strftime( $instance, $this ); // WPCS: XSS ok. ?>
        </div>
		<?php
	}
}

$widgets_manager->register_widget_type( new Ekommart_Elementor_Countdown() );