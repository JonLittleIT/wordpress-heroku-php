<?php
/**
 * Beehive Icon Box Elementor Widget.
 *
 * Elementor widget that inserts icon + text box into the page
 *
 * @package WordPress
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); }

/**
 * Beehive_Iconbox_Element class.
 *
 * @extends \Elementor\Widget_Base.
 * @since 1.0.0
 */
class Beehive_Iconbox_Element extends \Elementor\Widget_Base {

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
		return 'beehive-iconbox';
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
		return esc_html__( 'Icon Box(a)', 'beehive' );
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
		return 'eicon-icon-box';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the widget belongs to.
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
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() { // @codingStandardsIgnoreLine

		$this->start_controls_section(
			'icon_box',
			array(
				'label' => esc_html__( 'Icon Box', 'beehive' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'   => esc_html__( 'Icon', 'beehive' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value' => '',
				),
			)
		);

		$this->add_control(
			'icon_view',
			array(
				'label'   => esc_html__( 'Icon View', 'beehive' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default' => esc_html__( 'Default', 'beehive' ),
					'stacked' => esc_html__( 'Stacked', 'beehive' ),
					'framed'  => esc_html__( 'Framed', 'beehive' ),
				),
			)
		);

		$this->add_control(
			'icon_shape',
			array(
				'label'     => esc_html__( 'Icon Shape', 'beehive' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'rounded',
				'options'   => array(
					'square'  => esc_html__( 'Square', 'beehive' ),
					'rounded' => esc_html__( 'Rounded', 'beehive' ),
					'circle'  => esc_html__( 'Circle', 'beehive' ),
				),
				'condition' => array(
					'icon_view' => array( 'stacked', 'framed' ),
				),
			)
		);

		$this->add_control(
			'box_title',
			array(
				'label'       => esc_html__( 'Icon Box Title', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Box title', 'beehive' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'   => esc_html__( 'Title Tag', 'beehive' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'h4',
				'options' => array(
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				),
			)
		);

		$this->add_control(
			'box_desc',
			array(
				'label'       => esc_html__( 'Description', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'At vero eos et accusamus et iusto odio dignissimos ducimus qui.', 'beehive' ),
				'label_block' => true,
			)
		);

		$this->add_responsive_control(
			'alignment',
			array(
				'label'        => esc_html__( 'Alignment', 'beehive' ),
				'type'         => \Elementor\Controls_Manager::CHOOSE,
				'options'      => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'beehive' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'beehive' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'beehive' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'prefix_class' => 'elementor%s-align-',
				'default'      => '',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tabs_style',
			array(
				'label' => esc_html__( 'Icon Box', 'beehive' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'icon_bg',
			array(
				'label'     => esc_html__( 'Background color', 'beehive' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .sko-nav-tabs' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'icon_view' => array( 'stacked', 'framed' ),
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Color', 'beehive' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .beehive-iconbox-element .icon-wrapper i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .beehive-iconbox-element .icon-wrapper svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .beehive-iconbox-element.icon-view-stacked .icon-wrapper' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .beehive-iconbox-element.icon-view-framed .icon-wrapper i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .beehive-iconbox-element.icon-view-framed .icon-wrapper svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .beehive-iconbox-element.icon-view-framed .icon-wrapper' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'beehive' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .beehive-iconbox-element .iconbox-info .title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .beehive-iconbox-element .iconbox-info .description' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_size',
			array(
				'label'      => esc_html__( 'Icon size', 'beehive' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 10,
						'max'  => 150,
						'step' => 2,
					),
				),
				'default'    => array(
					'size' => 24,
				),
				'selectors'  => array(
					'{{WRAPPER}} .beehive-iconbox-element .icon-wrapper' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .beehive-iconbox-element .icon-wrapper i::before' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icon_padding',
			array(
				'label'      => esc_html__( 'Padding', 'beehive' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 70,
						'step' => 2,
					),
				),
				'default'    => array(
					'size' => 16,
				),
				'selectors'  => array(
					'{{WRAPPER}} .beehive-iconbox-element.icon-view-stacked .icon-wrapper' => 'padding: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .beehive-iconbox-element.icon-view-framed .icon-wrapper' => 'padding: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'icon_view' => array( 'stacked', 'framed' ),
				),
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
		$this->add_render_attribute( 'beehive-iconbox', 'class', 'beehive-iconbox-element beehive-element' );
		if ( isset( $settings['icon_view'] ) && $settings['icon_view'] ) {
			$this->add_render_attribute( 'beehive-iconbox', 'class', 'icon-view-' . $settings['icon_view'] );
		}
		if ( isset( $settings['icon_shape'] ) && $settings['icon_shape'] ) {
			$this->add_render_attribute( 'beehive-iconbox', 'class', 'icon-shape-' . $settings['icon_shape'] );
		}
		$this->add_render_attribute( 'box_title', 'class', 'title' );
		$this->add_inline_editing_attributes( 'box_title', 'none' );
		$this->add_render_attribute( 'box_desc', 'class', 'description' );
		$this->add_inline_editing_attributes( 'box_desc', 'none' ); ?>

		<div <?php $this->print_render_attribute_string( 'beehive-iconbox' ); ?>>
			<div class="icon-wrapper">
				<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) ); ?>
			</div>
			<div class="iconbox-info">
				<?php if ( isset( $settings['title_tag'] ) ) : ?>
					<?php if ( 'h2' === $settings['title_tag'] ) : ?>
						<h2 <?php $this->print_render_attribute_string( 'box_title' ); ?>><?php echo wp_kses_post( $settings['box_title'] ); ?></h2>
					<?php elseif ( 'h3' === $settings['title_tag'] ) : ?>
						<h3 <?php $this->print_render_attribute_string( 'box_title' ); ?>><?php echo wp_kses_post( $settings['box_title'] ); ?></h3>
					<?php elseif ( 'h4' === $settings['title_tag'] ) : ?>
						<h4 <?php $this->print_render_attribute_string( 'box_title' ); ?>><?php echo wp_kses_post( $settings['box_title'] ); ?></h4>
					<?php elseif ( 'h5' === $settings['title_tag'] ) : ?>
						<h5 <?php $this->print_render_attribute_string( 'box_title' ); ?>><?php echo wp_kses_post( $settings['box_title'] ); ?></h5>
					<?php elseif ( 'h6' === $settings['title_tag'] ) : ?>
						<h6 <?php $this->print_render_attribute_string( 'box_title' ); ?>><?php echo wp_kses_post( $settings['box_title'] ); ?></h6>
					<?php else : ?>
						<h4 <?php $this->print_render_attribute_string( 'box_title' ); ?>><?php echo wp_kses_post( $settings['box_title'] ); ?></h4>
					<?php endif; ?>
				<?php else : ?>
					<h4 <?php $this->print_render_attribute_string( 'box_title' ); ?>><?php echo wp_kses_post( $settings['box_title'] ); ?></h4>
				<?php endif; ?>
				<p <?php $this->print_render_attribute_string( 'box_desc' ); ?>><?php echo wp_kses_post( $settings['box_desc'] ); ?></p>
			</div>
		</div>
		<?php
	}
}
