<?php
/**
 * Beehive Menu Elementor Widget.
 *
 * Elementor widget that inserts WordPress menu into the page
 *
 * @package WordPress
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); }

/**
 * Beehive_Menu_Element class.
 *
 * @extends \Elementor\Widget_Base.
 * @since 1.0.0
 */
class Beehive_Menu_Element extends \Elementor\Widget_Base {

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
		return 'beehive-inline-menu';
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
		return esc_html__( 'Inline Menu(a)', 'beehive' );
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
		return 'eicon-nav-menu';
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
			'inline_menu',
			array(
				'label' => esc_html__( 'Inline Menu', 'beehive' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'select_menu',
			array(
				'label'   => esc_html__( 'Select Menu', 'beehive' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => beehive_get_menus(),
			)
		);

		$this->add_responsive_control(
			'align',
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
			'menu_styles',
			array(
				'label' => esc_html__( 'Button', 'beehive' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'btn_typography',
				'selector' => '{{WRAPPER}} .beehive-element-menu',
			)
		);

		$this->add_control(
			'menu_link_color',
			array(
				'label'     => esc_html__( 'Link Color', 'beehive' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .beehive-element-menu .navbar-element .nav-item > .nav-link' => 'color: {{VALUE}}; fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'menu_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'beehive' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .beehive-element-menu' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'beehive' ),
				'selector' => '{{WRAPPER}} .beehive-element-menu',
			)
		);

		$this->add_control(
			'border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'beehive' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .beehive-element-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'padding',
			array(
				'label'      => esc_html__( 'Padding', 'beehive' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .beehive-element-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render menu widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$menu     = ( ! empty( $settings['select_menu'] ) ) ? wp_get_nav_menu_object( $settings['select_menu'] ) : false;
		if ( ! $menu ) {
			return;
		} ?>

		<div class="beehive-element-menu beehive-element">
			<nav class="navbar navbar-inline">
				<?php
					wp_nav_menu(
						array(
							'menu'        => $menu,
							'depth'       => 2,
							'container'   => '',
							'menu_class'  => 'navbar-nav navbar-element',
							'fallback_cb' => 'Beehive_Navwalker::fallback',
							'walker'      => new Beehive_Navwalker(),
						)
					);
				?>
			</nav>
		</div>
		<?php
	}
}
