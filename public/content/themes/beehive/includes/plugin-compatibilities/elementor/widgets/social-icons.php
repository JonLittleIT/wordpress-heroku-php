<?php
/**
 * Beehive Social Icons Elementor Widget.
 *
 * Elementor widget that inserts social icons into the page
 *
 * @package WordPress
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); }

/**
 * Beehive_Social_Icons_Element class.
 *
 * @extends \Elementor\Widget_Base.
 * @since 1.0.0
 */
class Beehive_Social_Icons_Element extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve social icons widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'beehive-social-icons';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve social icons widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Social Icons(a)', 'beehive' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve social icons widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-social-icons';
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
	 * Register social icons widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() { // @codingStandardsIgnoreLine

		$this->start_controls_section(
			'socialicons',
			array(
				'label' => esc_html__( 'Social icons', 'beehive' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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

	}

	/**
	 * Render social icons widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'social-icon-class', 'class', 'beehive-social-icons beehive-element' );
		$this->add_render_attribute( 'social-icon-class', 'class', $settings['align'] ); ?>

		<div <?php $this->print_render_attribute_string( 'social-icon-class' ); ?>>
			<?php echo beehive_get_other_networks(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
		<?php
	}
}
