<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor image box widget.
 *
 * Elementor widget that displays an image, a headline and a text.
 *
 * @since 1.0.0
 */
class Ekommart_Widget_Image_Box extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve image box widget name.
	 *
	 * @return string Widget name.
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'ekommart-image-box';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve image box widget title.
	 *
	 * @return string Widget title.
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Ekommart Image Box', 'ekommart' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve image box widget icon.
	 *
	 * @return string Widget icon.
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'eicon-image-box';
	}

	public function get_categories() {
		return array( 'ekommart-addons' );
	}

	/**
	 * Register image box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => __( 'Image Box', 'ekommart' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => __( 'Choose Image', 'ekommart' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],

			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'separator' => 'none',
			]
		);


		$this->add_control(
			'title_text',
			[
				'label'       => __( 'Title & Description', 'ekommart' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( 'This is the heading', 'ekommart' ),
				'placeholder' => __( 'Enter your title', 'ekommart' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'sub_title_text',
			[
				'label'       => __( 'Sub Title', 'ekommart' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your sub-title', 'ekommart' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description_text',
			[
				'label'       => __( 'Description', 'ekommart' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ekommart' ),
				'placeholder' => __( 'Enter your description', 'ekommart' ),
				'separator'   => 'none',
				'rows'        => 10,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'   => __( 'Button Text', 'ekommart' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'ekommart' ),
			]
		);

		$this->add_control(
			'link_button',
			[
				'label'       => __( 'Link', 'ekommart' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ekommart' ),
				'default'     => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'title_size',
			[
				'label'   => __( 'Title HTML Tag', 'ekommart' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_wrap_style',
			[
				'label' => __( 'Wrap', 'ekommart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'wrap_padding',
			[
				'label'      => __( 'Padding', 'ekommart' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ekommart-image-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'ekommart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .ekommart-image-box-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ekommart-image-box-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_space',
			[
				'label'      => __( 'Space', 'ekommart' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ekommart-image-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// sub

		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' => __( 'Sub Title', 'ekommart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .ekommart-image-box-sub-title',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => __( 'Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ekommart-image-box-sub-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'subtitle_space',
			[
				'label'      => __( 'Space', 'ekommart' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ekommart-image-box-sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			[
				'label' => __( 'Description', 'ekommart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .ekommart-image-box-description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => __( 'Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ekommart-image-box-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'description_space',
			[
				'label'      => __( 'Space', 'ekommart' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ekommart-image-box-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		$has_content = ! empty( $settings['title_text'] ) || ! empty( $settings['description_text'] );
		$this->add_render_attribute( 'wrapper', 'class', 'ekommart-image-box-wrapper' );
		if ( ! empty( $settings['link_button']['url'] ) ) {
			$this->add_render_attribute( 'button_text', 'href', $settings['link_button']['url'] );

			if ( ! empty( $settings['link_button']['is_external'] ) ) {
				$this->add_render_attribute( 'button_text', 'target', '_blank' );
			}
		}
		$this->add_render_attribute( 'button_text', 'class', 'ekommart-image-box-button' );
		$this->add_render_attribute( 'image-wrapper', 'class', 'ekommart-image-box-img' );
		if ( ! empty( $settings['image']['url'] ) ) {
			$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
			$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
			$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );
		}
		if ( $has_content ) {
			if ( ! empty( $settings['sub_title_text'] ) ) {
				$this->add_render_attribute( 'sub_title_text', 'class', 'ekommart-image-box-sub-title' );
			}
			if ( ! empty( $settings['title_text'] ) ) {
				$this->add_render_attribute( 'title_text', 'class', 'ekommart-image-box-title' );
				$this->add_inline_editing_attributes( 'title_text', 'none' );
			}
			if ( ! empty( $settings['description_text'] ) ) {
				$this->add_render_attribute( 'description_text', 'class', 'ekommart-image-box-description' );
				$this->add_inline_editing_attributes( 'description_text' );
			}
		}

		?>
        <div <?php echo ekommart_elementor_get_render_attribute_string( "wrapper", $this ); ?>>
            <div class="ekommart-image-framed">
                <figure <?php echo ekommart_elementor_get_render_attribute_string( "image-wrapper", $this ); ?>>
					<?php
					if ( ! empty( $settings['image']['url'] ) ) {
						echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
					}
					?>
                </figure>
				<?php if ( $has_content ): ?>
                    <div class="ekommart-image-box-content">
						<?php if ( ! empty( $settings['sub_title_text'] ) ): ?>
                            <div <?php echo ekommart_elementor_get_render_attribute_string( "sub_title_text", $this ); ?>>
								<?php echo wp_kses_post( $settings["sub_title_text"] ); ?>
                            </div>
						<?php endif; ?>

						<?php if ( ! empty( $settings['title_text'] ) ): ?>
							<?php printf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_size'], ekommart_elementor_get_render_attribute_string( 'title_text', $this ),  $settings['title_text'] ); ?>
						<?php endif; ?>

						<?php if ( ! empty( $settings['description_text'] ) ): ?>
							<?php printf( '<p %1$s>%2$s</p>', ekommart_elementor_get_render_attribute_string( 'description_text', $this ),  $settings['description_text'] ); ?>
						<?php endif; ?>

                    </div>
				<?php endif; ?>
				<?php if ( ! empty( $settings['link_button']['url'] ) ): ?>
                    <a <?php echo ekommart_elementor_get_render_attribute_string( 'button_text', $this ); ?>>
						<?php echo esc_html( $settings['button_text'] ); ?>
                    </a>
				<?php endif; ?>
            </div>
        </div>
		<?php
	}
}

$widgets_manager->register_widget_type( new Ekommart_Widget_Image_Box() );