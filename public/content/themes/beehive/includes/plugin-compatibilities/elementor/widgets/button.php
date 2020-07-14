<?php
/**
 * Beehive button Elementor Widget.
 *
 * Elementor widget that inserts beehive button into the page
 *
 * @package WordPress
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); }

/**
 * Beehive_Button_Element class.
 *
 * @extends \Elementor\Widget_Base.
 * @since 1.0.0
 */
class Beehive_Button_Element extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'beehive-button';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Button(a)', 'beehive' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-button';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the this belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'beehive-elements' );
	}

	/**
	 * Register controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() { // @codingStandardsIgnoreLine

		$this->start_controls_section(
			'button',
			array(
				'label' => esc_html__( 'Button', 'beehive' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => esc_html__( 'Style', 'beehive' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default'     => esc_html__( 'Default', 'beehive' ),
					'outline'     => esc_html__( 'Outline', 'beehive' ),
					'transparent' => esc_html__( 'Transparent', 'beehive' ),
				),
			)
		);

		$this->add_control(
			'btn_type',
			array(
				'label'   => esc_html__( 'Type', 'beehive' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default' => esc_html__( 'Default', 'beehive' ),
					'success' => esc_html__( 'Success', 'beehive' ),
					'warning' => esc_html__( 'Warning', 'beehive' ),
					'danger'  => esc_html__( 'Danger', 'beehive' ),
				),
			)
		);

		$this->add_control(
			'btn_text',
			array(
				'label'       => esc_html__( 'Text', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Click Here', 'beehive' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'link_to',
			array(
				'label'       => esc_html__( 'Link to', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'page',
				'options'     => array(
					'page' => esc_html__( 'Page', 'beehive' ),
					'url'  => esc_html__( 'URL', 'beehive' ),
				),
				'label_block' => true,
			)
		);

		$this->add_control(
			'page',
			array(
				'label'       => esc_html__( 'Select a page', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => '',
				'options'     => beehive_get_pages(),
				'label_block' => true,
				'condition'   => array(
					'link_to' => array( 'page' ),
				),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'         => esc_html__( 'Custom link', 'beehive' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'beehive' ),
				'show_external' => true,
				'default'       => array(
					'url' => '',
				),
				'condition'     => array(
					'link_to' => array( 'url' ),
				),
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'        => esc_html__( 'Alignment', 'beehive' ),
				'type'         => \Elementor\Controls_Manager::CHOOSE,
				'options'      => array(
					'left'    => array(
						'title' => esc_html__( 'Left', 'beehive' ),
						'icon'  => 'fa fa-align-left',
					),
					'center'  => array(
						'title' => esc_html__( 'Center', 'beehive' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'   => array(
						'title' => esc_html__( 'Right', 'beehive' ),
						'icon'  => 'fa fa-align-right',
					),
					'justify' => array(
						'title' => esc_html__( 'Justified', 'beehive' ),
						'icon'  => 'fa fa-align-justify',
					),
				),
				'prefix_class' => 'elementor%s-align-',
				'default'      => '',
			)
		);

		$this->add_control(
			'btn_size',
			array(
				'label'   => esc_html__( 'Size', 'beehive' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => array(
					'small'  => esc_html__( 'Small', 'beehive' ),
					'normal' => esc_html__( 'Normal', 'beehive' ),
					'large'  => esc_html__( 'Large', 'beehive' ),
				),
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'       => esc_html__( 'Icon', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => array(
					'value' => '',
				),
			)
		);

		$this->add_control(
			'icon_postion',
			array(
				'label'   => esc_html__( 'Icon Position', 'beehive' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'left',
				'options' => array(
					'left'  => esc_html__( 'Left', 'beehive' ),
					'right' => esc_html__( 'Right', 'beehive' ),
				),
			)
		);

		$this->add_control(
			'button_id',
			array(
				'label'       => esc_html__( 'Button ID', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '',
				'title'       => esc_html__( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'beehive' ),
				'label_block' => false,
				'description' => esc_html__( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'beehive' ),
				'separator'   => 'before',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style',
			array(
				'label' => esc_html__( 'Button', 'beehive' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'btn_typography',
				'selector' => '{{WRAPPER}} .beehive-button-element a.button',
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'btn_tab_normal',
			array(
				'label' => esc_html__( 'Normal', 'beehive' ),
			)
		);

		$this->add_control(
			'btn_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'beehive' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .beehive-button-element a.button' => 'color: {{VALUE}}; fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'beehive' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .beehive-button-element a.button' => 'background-color: {{VALUE}}; background-image: none;',
				),
			)
		);

		$this->add_control(
			'btn_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'beehive' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .beehive-button-element a.button' => 'border: 1px solid {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'beehive' ),
				'selector' => '{{WRAPPER}} .beehive-button-element a.button',
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'btn_tab_Hover',
			array(
				'label' => esc_html__( 'Hover', 'beehive' ),
			)
		);

		$this->add_control(
			'btn_text_color_hover',
			array(
				'label'     => esc_html__( 'Hover Text Color', 'beehive' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .beehive-button-element a.button:hover' => 'color: {{VALUE}}; fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_bg_color_hover',
			array(
				'label'     => esc_html__( 'Hover background Color', 'beehive' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .beehive-button-element a.button:hover' => 'background-color: {{VALUE}}; background-image: none;',
				),
			)
		);

		$this->add_control(
			'btn_border_color_hover',
			array(
				'label'     => esc_html__( 'Border Color Hover', 'beehive' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .beehive-button-element a.button:hover' => 'border: 1px solid {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow_hover',
				'label'    => esc_html__( 'Box Shadow Hover', 'beehive' ),
				'selector' => '{{WRAPPER}} .beehive-button-element a.button:hover',
			)
		);

		$this->add_control(
			'hover_animation',
			array(
				'label' => esc_html__( 'Hover Animation', 'beehive' ),
				'type'  => \Elementor\Controls_Manager::HOVER_ANIMATION,
			)
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'beehive' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .beehive-button-element a.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'btn_padding',
			array(
				'label'      => esc_html__( 'Padding', 'beehive' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .beehive-button-element a.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		// button link.
		if ( 'page' === $settings['link_to'] && $settings['page'] ) {
			$this->add_render_attribute( 'beehive-button', 'href', esc_url( get_permalink( $settings['page'] ) ) );
		} elseif ( 'url' === $settings['link_to'] && $settings['link']['url'] ) {
			$this->add_render_attribute( 'beehive-button', 'href', esc_url( $settings['link']['url'] ) );
			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'beehive-button', 'target', '_blank' );
			}
			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'beehive-button', 'rel', 'nofollow' );
			}
		} else {
			$this->add_render_attribute( 'beehive-button', 'href', '#' );
		}

		// Button id.
		if ( $settings['button_id'] ) {
			$this->add_render_attribute( 'beehive-button', 'id', $settings['button_id'] );
		}

		// button style.
		if ( 'outline' === $settings['style'] ) {
			$this->add_render_attribute( 'beehive-button', 'class', 'button button-outline' );
		} elseif ( 'transparent' === $settings['style'] ) {
			$this->add_render_attribute( 'beehive-button', 'class', 'button button-transparent' );
		} else {
			$this->add_render_attribute( 'beehive-button', 'class', 'button button-primary' );
		}

		// button type.
		if ( 'success' === $settings['btn_type'] ) {
			$this->add_render_attribute( 'beehive-button', 'class', 'success' );
		} elseif ( 'warning' === $settings['btn_type'] ) {
			$this->add_render_attribute( 'beehive-button', 'class', 'warning' );
		} elseif ( 'danger' === $settings['btn_type'] ) {
			$this->add_render_attribute( 'beehive-button', 'class', 'danger' );
		} else {
			$this->add_render_attribute( 'beehive-button', 'class', 'default' );
		}

		// button size.
		if ( $settings['btn_size'] ) {
			$this->add_render_attribute( 'beehive-button', 'class', $settings['btn_size'] );
		}

		// Button role.
		$this->add_render_attribute( 'beehive-button', 'role', 'button' );

		// Button icon.
		ob_start();
		\Elementor\Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) );
		$icon_html = ob_get_clean();

		if ( $icon_html ) {
			$this->add_render_attribute( 'beehive-button', 'class', 'has-icon' );
		}

		if ( 'right' === $settings['icon_postion'] ) {
			$this->add_render_attribute( 'beehive-button', 'class', 'icon-right' );
		} else {
			$this->add_render_attribute( 'beehive-button', 'class', 'icon-left' );
		}

		if ( $settings['hover_animation'] ) {
			$this->add_render_attribute( 'beehive-button', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}

		$this->add_render_attribute( 'btn_text', 'class', 'button-text' );
		$this->add_inline_editing_attributes( 'btn_text', 'none' ); ?>

		<div class="beehive-button-element beehive-element">
			<a <?php $this->print_render_attribute_string( 'beehive-button' ); ?>>
				<span class="button-text-wrapper">
					<?php if ( $icon_html ) : ?>
					<span class="button-icon">
						<?php echo wp_kses_post( $icon_html ); ?>
					</span>
					<?php endif; ?>
					<span <?php $this->print_render_attribute_string( 'btn_text' ); ?>>
						<?php echo wp_kses_post( $settings['btn_text'] ); ?>
					</span>
				</span>
			</a>
		</div>
		<?php
	}
}
