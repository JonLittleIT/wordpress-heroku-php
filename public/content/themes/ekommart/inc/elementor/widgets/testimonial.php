<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;

class Ekommart_Elementor_Testimonials extends Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve testimonial widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'ekommart-testimonials';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve testimonial widget title.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Ekommart Testimonials', 'ekommart' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve testimonial widget icon.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_script_depends() {
		return [ 'ekommart-elementor-testimonial', 'slick' ];
	}

	public function get_categories() {
		return array( 'ekommart-addons' );
	}

	/**
	 * Register testimonial widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => __( 'Testimonials', 'ekommart' ),
			]
		);

		$this->add_control(
			'testimonials',
			[
				'label'       => __( 'Testimonials Item', 'ekommart' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => [
					[
						'name'  => 'testimonial_icon',
						'label' => __( 'Icon', 'ekommart' ),
						'type'  => Controls_Manager::ICON,
					],

					[
						'name'    => 'testimonial_title',
						'label'   => __( 'Title', 'ekommart' ),
						'type'    => Controls_Manager::TEXT,
						'default' => 'Testimonial title',
					],

					[
						'name'        => 'testimonial_content',
						'label'       => __( 'Content', 'ekommart' ),
						'type'        => Controls_Manager::TEXTAREA,
						'default'     => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
						'label_block' => true,
						'rows'        => '10',
					],
					[
						'name'       => 'testimonial_image',
						'label'      => __( 'Choose Image', 'ekommart' ),
						'type'       => Controls_Manager::MEDIA,
						'show_label' => false,
					],
					[
						'name'    => 'testimonial_name',
						'label'   => __( 'Name', 'ekommart' ),
						'default' => 'John Doe',
						'type'    => Controls_Manager::TEXT,
					],
					[
						'name'    => 'testimonial_job',
						'label'   => __( 'Job', 'ekommart' ),
						'default' => 'Design',
						'type'    => Controls_Manager::TEXT,
					],
					[
						'name'        => 'testimonial_link',
						'label'       => __( 'Link to', 'ekommart' ),
						'placeholder' => __( 'https://your-link.com', 'ekommart' ),
						'type'        => Controls_Manager::URL,
					],

				],
				'title_field' => '{{{ testimonial_name }}}',
			]
		);

		$this->add_group_control(
			Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'      => 'testimonial_image',
				// Usage: `{name}_size` and `{name}_custom_dimension`, in this case `testimonial_image_size` and `testimonial_image_custom_dimension`.
				'default'   => 'full',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'testimonial_alignment',
			[
				'label'       => __( 'Alignment', 'ekommart' ),
				'type'        => Controls_Manager::CHOOSE,
				'default'     => 'center',
				'options'     => [
					'left'   => [
						'title' => __( 'Left', 'ekommart' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ekommart' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'ekommart' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'label_block' => false,
				'selectors'   => [
					'{{WRAPPER}} .item-box' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'column',
			[
				'label'   => __( 'Columns', 'ekommart' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 1,
				'options' => [ 1 => 1, 2 => 2, 3 => 3, 4 => 4, 6 => 6 ],
			]
		);

		$this->add_control(
			'view',
			[
				'label'   => __( 'View', 'ekommart' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);
		$this->end_controls_section();


		// WRAPPER STYLE
		$this->start_controls_section(
			'section_style_testimonial_wrapper',
			[
				'label' => __( 'Wrapper', 'ekommart' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_responsive_control(
			'padding_estimonial_wrapper',
			[
				'label'      => __( 'Padding', 'ekommart' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .item-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_testimonial_wrapper',
			[
				'label'      => __( 'Margin', 'ekommart' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .item-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'color_testimonial_wrapper',
			[
				'label'     => __( 'Background Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .item-box' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'wrapper_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .item-box',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'wrapper_radius',
			[
				'label'      => __( 'Border Radius', 'ekommart' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .item-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'wrapper_box_shadow',
				'selector' => '{{WRAPPER}} .item-box',
			]
		);

		$this->add_control(
			'show_decor',
			[
				'label' => __( 'Show Decor', 'ekommart' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->end_controls_section();

		// Title
		$this->start_controls_section(
			'section_style_testimonial_title',
			[
				'label' => __( 'Title', 'ekommart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_title_color',
			[
				'label'     => __( 'Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_title_color_hover',
			[
				'label'     => __( 'Color Hover', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .item-box:hover .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .title',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'     => __( 'Spacing', 'ekommart' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial-item .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Icon
		$this->start_controls_section(
			'section_style_testimonial_icon',
			[
				'label' => __( 'Icon', 'ekommart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .icon-inner' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label'     => __( 'Color Hover', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .item-box:hover .icon-inner' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label'     => __( 'Spacing', 'ekommart' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => __( 'Size', 'ekommart' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-inner' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_margin',
			[
				'label'      => __( 'Margin', 'ekommart' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label'      => __( 'Padding', 'ekommart' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Content style
		$this->start_controls_section(
			'section_style_testimonial_style',
			[
				'label' => __( 'Content', 'ekommart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_content_color',
			[
				'label'     => __( 'Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_content_color_hover',
			[
				'label'     => __( 'Color Hover', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .item-box:hover .content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .content',
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label'     => __( 'Spacing', 'ekommart' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Image.
		$this->start_controls_section(
			'section_style_testimonial_image',
			[
				'label' => __( 'Image', 'ekommart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'image_border',
				'selector'  => '{{WRAPPER}} .elementor-testimonial-image img',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label'      => __( 'Border Radius', 'ekommart' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_margin',
			[
				'label'      => __( 'Margin', 'ekommart' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-testimonial-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Name.
		$this->start_controls_section(
			'section_style_testimonial_name',
			[
				'label' => __( 'Name', 'ekommart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_text_color',
			[
				'label'     => __( 'Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .name, {{WRAPPER}} .name a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'name_text_color_hover',
			[
				'label'     => __( 'Color Hover', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .item-box:hover .name, {{WRAPPER}} .item-box:hover .name a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'selector' => '{{WRAPPER}} .name',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'name_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .name',
				'separator'   => 'before',
			]
		);

		$this->add_responsive_control(
			'name_padding',
			[
				'label'      => __( 'Padding', 'ekommart' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Job.
		$this->start_controls_section(
			'section_style_testimonial_job',
			[
				'label' => __( 'Job', 'ekommart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'job_text_color',
			[
				'label'     => __( 'Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .job' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'job_text_color_hover',
			[
				'label'     => __( 'Color Hover', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .item-box:hover .job' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'job_typography',
				'selector' => '{{WRAPPER}} .job',
			]
		);

		$this->end_controls_section();

		// Carousel options
		$this->add_control_carousel();

	}

	/**
	 * Render testimonial widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['testimonials'] ) && is_array( $settings['testimonials'] ) ) {

			$this->add_render_attribute( 'wrapper', 'class', 'elementor-testimonial-item-wrapper' );

			// Row
			$this->add_render_attribute( 'row', 'class', 'row' );

			// Carousel
			if ( $settings['enable_carousel'] === 'yes' ) {

				$this->add_render_attribute( 'row', 'class', 'ekommart-carousel' );
				$carousel_settings = $this->get_carousel_settings();
				$this->add_render_attribute( 'row', 'data-settings', wp_json_encode( $carousel_settings ) );

			} else {

				$this->add_render_attribute( 'row', 'data-elementor-columns', $settings['column'] );
				if ( ! empty( $settings['column_tablet'] ) ) {
					$this->add_render_attribute( 'row', 'data-elementor-columns-tablet', $settings['column_tablet'] );
				}
				if ( ! empty( $settings['column_mobile'] ) ) {
					$this->add_render_attribute( 'row', 'data-elementor-columns-mobile', $settings['column_mobile'] );
				}

			}

			foreach ( $settings['testimonials'] as $testimonial1 ):
				$this->add_render_attribute( 'ic', 'class', $testimonial1['testimonial_icon'] );
				$this->add_render_attribute( 'ic', 'aria-hidden', 'true' );
			endforeach;

			// Item
			$this->add_render_attribute( 'item', 'class', 'column-item elementor-testimonial-item' );


			?>
            <div <?php echo ekommart_elementor_get_render_attribute_string( 'wrapper', $this ); // WPCS: XSS ok. ?>>
                <div <?php echo ekommart_elementor_get_render_attribute_string( 'row', $this ); // WPCS: XSS ok. ?>>
					<?php foreach ( $settings['testimonials'] as $testimonial ): ?>
                        <div <?php echo ekommart_elementor_get_render_attribute_string( 'item', $this ); // WPCS: XSS ok. ?>>
                            <div class="item-box">

                                <span class="title">
                                    <?php echo esc_html( $testimonial["testimonial_title"] ) ?>
                                </span>

                                <div class="icon">
                                    <span class="icon-inner">
                                        <i class="<?php echo esc_attr( $testimonial['testimonial_icon'] ); ?>"></i>
                                    </span>
                                </div>

                                <div class="content">
									<?php echo wp_kses_post( $testimonial['testimonial_content'] ); ?>
                                </div>

								<?php if ( $settings['show_decor'] ): ?>
                                    <span class="testimonial-decor"></span>
								<?php endif; ?>

								<?php $this->render_image( $settings, $testimonial ); ?>

                                <div class="details">
									<?php
									$testimonial_name_html = $testimonial['testimonial_name'];
									if ( ! empty( $testimonial['testimonial_link']['url'] ) ) :
										$testimonial_name_html = '<a href="' . esc_url( $testimonial['testimonial_link']['url'] ) . '">' . esc_html( $testimonial_name_html ) . '</a>';
									endif;
									?>
                                    <div class="name"><?php echo esc_html( $testimonial_name_html ); ?></div>
                                    <div class="job"><?php echo esc_html( $testimonial['testimonial_job'] ); ?></div>
                                </div>

                            </div>
                        </div>
					<?php endforeach; ?>
                </div>
            </div>
			<?php
		}
	}

	private function render_image( $settings, $testimonial ) {
		if ( ! empty( $testimonial['testimonial_image']['url'] ) ) :
			?>
            <div class="elementor-testimonial-image">
				<?php
				$testimonial['testimonial_image_size']             = $settings['testimonial_image_size'];
				$testimonial['testimonial_image_custom_dimension'] = $settings['testimonial_image_custom_dimension'];
				echo Group_Control_Image_Size::get_attachment_image_html( $testimonial, 'testimonial_image' );
				?>
            </div>
		<?php
		endif;
	}

	protected function add_control_carousel( $condition = array() ) {
		$this->start_controls_section(
			'section_carousel_options',
			[
				'label'     => __( 'Carousel Options', 'ekommart' ),
				'type'      => Controls_Manager::SECTION,
				'condition' => $condition,
			]
		);

		$this->add_control(
			'enable_carousel',
			[
				'label' => __( 'Enable', 'ekommart' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);


		$this->add_control(
			'navigation',
			[
				'label'     => __( 'Navigation', 'ekommart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'dots',
				'options'   => [
					'both'   => __( 'Arrows and Dots', 'ekommart' ),
					'arrows' => __( 'Arrows', 'ekommart' ),
					'dots'   => __( 'Dots', 'ekommart' ),
					'none'   => __( 'None', 'ekommart' ),
				],
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'     => __( 'Pause on Hover', 'ekommart' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'     => __( 'Autoplay', 'ekommart' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => __( 'Autoplay Speed', 'ekommart' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'autoplay'        => 'yes',
					'enable_carousel' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label'     => __( 'Infinite Loop', 'ekommart' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'carousel_arrows',
			[
				'label'      => __( 'Carousel Arrows', 'ekommart' ),
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'enable_carousel',
							'operator' => '==',
							'value'    => 'yes',
						],
						[
							'name'     => 'navigation',
							'operator' => '!==',
							'value'    => 'none',
						],
						[
							'name'     => 'navigation',
							'operator' => '!==',
							'value'    => 'dots',
						],
					],
				],
			]
		);

		$this->add_control(
			'next_heading',
			[
				'label' => __( 'Next button', 'ekommart' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'next_vertical',
			[
				'label'       => __( 'Next Vertical', 'ekommart' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'top'    => [
						'title' => __( 'Top', 'ekommart' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'ekommart' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				]
			]
		);

		$this->add_responsive_control(
			'next_vertical_value',
			[
				'type'       => Controls_Manager::SLIDER,
				'show_label' => false,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-next' => 'top: unset; bottom: unset; {{next_vertical.value}}: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'next_horizontal',
			[
				'label'       => __( 'Next Horizontal', 'ekommart' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'  => [
						'title' => __( 'Left', 'ekommart' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'ekommart' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'defautl'     => 'right'
			]
		);
		$this->add_responsive_control(
			'next_horizontal_value',
			[
				'type'       => Controls_Manager::SLIDER,
				'show_label' => false,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => - 45,
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-next' => 'left: unset; right: unset;{{next_horizontal.value}}: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'prev_heading',
			[
				'label'     => __( 'Prev button', 'ekommart' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'prev_vertical',
			[
				'label'       => __( 'Prev Vertical', 'ekommart' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'top'    => [
						'title' => __( 'Top', 'ekommart' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'ekommart' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				]
			]
		);

		$this->add_responsive_control(
			'prev_vertical_value',
			[
				'type'       => Controls_Manager::SLIDER,
				'show_label' => false,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-prev' => 'top: unset; bottom: unset; {{prev_vertical.value}}: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'prev_horizontal',
			[
				'label'       => __( 'Prev Horizontal', 'ekommart' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'  => [
						'title' => __( 'Left', 'ekommart' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'ekommart' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'defautl'     => 'left'
			]
		);
		$this->add_responsive_control(
			'prev_horizontal_value',
			[
				'type'       => Controls_Manager::SLIDER,
				'show_label' => false,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => - 45,
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-prev' => 'left: unset; right: unset; {{prev_horizontal.value}}: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();
	}

	protected function get_carousel_settings() {
		$settings = $this->get_settings_for_display();

		return array(
			'navigation'         => $settings['navigation'],
			'autoplayHoverPause' => $settings['pause_on_hover'] === 'yes' ? true : false,
			'autoplay'           => $settings['autoplay'] === 'yes' ? true : false,
			'autoplayTimeout'    => $settings['autoplay_speed'],
			'items'              => $settings['column'],
			'items_tablet'       => $settings['column_tablet'] ? $settings['column_tablet'] : $settings['column'],
			'items_mobile'       => $settings['column_mobile'] ? $settings['column_mobile'] : 1,
			'loop'               => $settings['infinite'] === 'yes' ? true : false,
			'rtl'                => is_rtl() ? true : false,
		);
	}

}

$widgets_manager->register_widget_type( new Ekommart_Elementor_Testimonials() );

