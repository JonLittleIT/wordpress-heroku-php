<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Schemes;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Ekommart_Elementor_Widget_Tabs extends Widget_Base {

	public function get_categories() {
		return array( 'ekommart-addons' );
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve tabs widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'ekommart-tabs';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve tabs widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return esc_html__( 'Ekommart Tabs', 'ekommart' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve tabs widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'eicon-tabs';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @return array Widget keywords.
	 * @since 2.1.0
	 * @access public
	 *
	 */
	public function get_keywords() {
		return [ 'tabs', 'accordion', 'toggle' ];
	}

	/**
	 * Get HTML wrapper class.
	 *
	 * Retrieve the widget container class. Can be used to override the
	 * container class for specific widgets.
	 *
	 * @since 2.0.9
	 * @access protected
	 */
	protected function get_html_wrapper_class() {
		return 'elementor-widget-' . $this->get_name() . ' elementor-widget-tabs';
	}

	public function get_script_depends() {
		return [ 'ekommart-elementor-tabs' ];
	}

	/**
	 * Register tabs widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$templates = Plugin::instance()->templates_manager->get_source( 'local' )->get_items();

		$options = [
			'0' => '— ' . esc_html__( 'Select', 'ekommart' ) . ' —',
		];

		$types = [];

		foreach ( $templates as $template ) {
			$options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
			$types[ $template['template_id'] ]   = $template['type'];
		}

		$this->start_controls_section(
			'section_tabs',
			[
				'label' => esc_html__( 'Tabs', 'ekommart' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label'       => esc_html__( 'Title & Description', 'ekommart' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tab Title', 'ekommart' ),
				'placeholder' => esc_html__( 'Tab Title', 'ekommart' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'source',
			[
				'label'   => esc_html__( 'Source', 'ekommart' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'html',
				'options' => [
					'html'     => esc_html__( 'HTML', 'ekommart' ),
					'template' => esc_html__( 'Template', 'ekommart' )
				]
			]
		);

		$repeater->add_control(
			'tab_template',
			[
				'label'       => esc_html__( 'Choose Template', 'ekommart' ),
				'default'     => 0,
				'type'        => Controls_Manager::SELECT,
				'options'     => $options,
				'types'       => $types,
				'label_block' => 'true',
				'condition'   => [
					'source' => 'template',
				],
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label'       => esc_html__( 'Content', 'ekommart' ),
				'default'     => esc_html__( 'Tab Content', 'ekommart' ),
				'placeholder' => esc_html__( 'Tab Content', 'ekommart' ),
				'type'        => Controls_Manager::WYSIWYG,
				'show_label'  => false,
				'condition'   => [
					'source' => 'html',
				],
			]
		);

		$this->add_control(
			'tabs',
			[
				'label'       => esc_html__( 'Tabs Items', 'ekommart' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'tab_title'   => esc_html__( 'Tab #1', 'ekommart' ),
						'tab_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ekommart' ),
					],
					[
						'tab_title'   => esc_html__( 'Tab #2', 'ekommart' ),
						'tab_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ekommart' ),
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);

		$this->add_control(
			'view',
			[
				'label'   => esc_html__( 'View', 'ekommart' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->add_control(
			'type',
			[
				'label'        => esc_html__( 'Type', 'ekommart' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'horizontal',
				'options'      => [
					'horizontal' => esc_html__( 'Horizontal', 'ekommart' ),
					'vertical'   => esc_html__( 'Vertical', 'ekommart' ),
				],
				'prefix_class' => 'elementor-tabs-view-',
				'separator'    => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tabs_style',
			[
				'label' => esc_html__( 'Tabs', 'ekommart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'navigation_width',
			[
				'label'     => esc_html__( 'Navigation Width', 'ekommart' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'unit' => '%',
				],
				'range'     => [
					'%' => [
						'min' => 10,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-tabs-wrapper' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'type' => 'vertical',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label'     => esc_html__( 'Border Width', 'ekommart' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 1,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title, {{WRAPPER}} .elementor-tab-title:before, {{WRAPPER}} .elementor-tab-title:after, {{WRAPPER}} .elementor-tab-content, {{WRAPPER}} .elementor-tabs-content-wrapper' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'     => esc_html__( 'Border Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-mobile-title, {{WRAPPER}} .elementor-tab-desktop-title.elementor-active, {{WRAPPER}} .elementor-tab-title:before, {{WRAPPER}} .elementor-tab-title:after, {{WRAPPER}} .elementor-tab-content, {{WRAPPER}} .elementor-tabs-content-wrapper' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => esc_html__( 'Background Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-desktop-title.elementor-active' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-tabs-content-wrapper'               => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label'     => esc_html__( 'Title', 'ekommart' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tab_color',
			[
				'label'     => esc_html__( 'Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title' => 'color: {{VALUE}};',
				],
				'scheme'    => [
					'type'  => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
			]
		);

		$this->add_control(
			'tab_active_color',
			[
				'label'     => esc_html__( 'Active Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title.elementor-active' => 'color: {{VALUE}};',
				],
				'scheme'    => [
					'type'  => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_4,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tab_typography',
				'selector' => '{{WRAPPER}} .elementor-tab-title',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'heading_content',
			[
				'label'     => esc_html__( 'Content', 'ekommart' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => esc_html__( 'Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-content' => 'color: {{VALUE}};',
				],
				'scheme'    => [
					'type'  => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .elementor-tab-content',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render tabs widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$tabs = $this->get_settings_for_display( 'tabs' );

		$id_int = substr( $this->get_id_int(), 0, 3 );
		?>
        <div class="elementor-tabs" role="tablist">
            <div class="elementor-tabs-wrapper">
				<?php
				foreach ( $tabs as $index => $item ) :
					$tab_count = $index + 1;
					$class_item = 'elementor-repeater-item-' . $item['_id'];
					$class_content = ( $index == 0 ) ? 'elementor-active' : '';
					$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

					$this->add_render_attribute( $tab_title_setting_key, [
						'id'            => 'elementor-tab-title-' . $id_int . $tab_count,
						'class'         => [
							'elementor-tab-title',
							'elementor-tab-desktop-title',
							$class_content,
							$class_item
						],
						'data-tab'      => $tab_count,
						'role'          => 'tab',
						'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
					] );
					?>
                    <div <?php echo ekommart_elementor_get_render_attribute_string( $tab_title_setting_key , $this); // WPCS: XSS ok.
					?>>
                        <a href=""><?php echo esc_html( $item['tab_title'] ); ?></a></div>
				<?php endforeach; ?>
            </div>
            <div class="elementor-tabs-content-wrapper">
				<?php
				foreach ( $tabs as $index => $item ) :
					$tab_count = $index + 1;
					$class_item = 'elementor-repeater-item-' . $item['_id'];
					$class_content = ( $index == 0 ) ? 'elementor-active' : '';
					$tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

					$tab_title_mobile_setting_key = $this->get_repeater_setting_key( 'tab_title_mobile', 'tabs', $tab_count );

					$this->add_render_attribute( $tab_content_setting_key, [
						'id'              => 'elementor-tab-content-' . $id_int . $tab_count,
						'class'           => [
							'elementor-tab-content',
							'elementor-clearfix',
							$class_content,
							$class_item
						],
						'data-tab'        => $tab_count,
						'role'            => 'tabpanel',
						'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
					] );

					$this->add_render_attribute( $tab_title_mobile_setting_key, [
						'class'         => [
							'elementor-tab-title',
							'elementor-tab-mobile-title',
							$class_content,
							$class_item
						],
						'data-tab'      => $tab_count,
						'role'          => 'tab',
						'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
					] );

					$this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );
					?>
                    <div <?php echo ekommart_elementor_get_render_attribute_string( $tab_title_mobile_setting_key , $this); // WPCS: XSS ok.
					?>><?php echo esc_html( $item['tab_title'] ); ?></div>
                    <div <?php echo ekommart_elementor_get_render_attribute_string( $tab_content_setting_key , $this); // WPCS: XSS ok. ?>>
						<?php if ( 'html' === $item['source'] ): ?>
							<?php echo ekommart_elementor_parse_text_editor( $item['tab_content'], $this ); // WPCS: XSS ok. ?>
						<?php else: ?>
							<?php echo Plugin::instance()->frontend->get_builder_content_for_display( $item['tab_template'] ); ?>
						<?php endif; ?>
                    </div>

				<?php endforeach; ?>
            </div>
        </div>
		<?php
	}
}

$widgets_manager->register_widget_type( new Ekommart_Elementor_Widget_Tabs() );
