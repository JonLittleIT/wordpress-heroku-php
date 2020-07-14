<?php
/**
 * Beehive Contact Info Elementor Widget.
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
 * Beehive_Contact_Info_Element class.
 *
 * @extends \Elementor\Widget_Base.
 * @since 1.0.0
 */
class Beehive_Contact_Info_Element extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve contact info widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'beehive-contactinfo';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve contact info widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Contact Info(a)', 'beehive' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve contact info widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-headphones';
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
	 * Register Contact info widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() { // @codingStandardsIgnoreLine

		$this->start_controls_section(
			'contactinfo',
			array(
				'label' => esc_html__( 'Contact Info', 'beehive' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'address',
			array(
				'label'       => esc_html__( 'Address', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( '22 Park Eve, City, Country', 'beehive' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'email',
			array(
				'label'       => esc_html__( 'Email', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'support@youremail.com', 'beehive' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'phone',
			array(
				'label'       => esc_html__( 'Phone', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( '+7 (777) 777 7777', 'beehive' ),
				'label_block' => true,
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Render contact info widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'address', 'class', 'item-info' );
		$this->add_inline_editing_attributes( 'address', 'none' );
		$this->add_render_attribute( 'email', 'class', 'item-info' );
		$this->add_inline_editing_attributes( 'email', 'none' );
		$this->add_render_attribute( 'phone', 'class', 'item-info' );
		$this->add_inline_editing_attributes( 'phone', 'none' ); ?>

		<div class="beehive-contactinfo-element beehive-element">
			<div class="contact-wrapper">
				<?php if ( $settings['address'] ) : ?>
				<div class="address item">
					<div class="inner">
						<span class="item-icon"><i class="uil-location-point"></i></span>
						<h4 class="title"><?php esc_html_e( 'Address', 'beehive' ); ?></h4>
						<div <?php $this->print_render_attribute_string( 'address' ); ?>><?php echo wp_kses_post( $settings['address'] ); ?></div>
					</div>
				</div>
				<?php endif; ?>
				<?php if ( $settings['email'] ) : ?>
				<div class="email item">
					<div class="inner">
						<span class="item-icon"><i class="uil-envelope-open"></i></span>
						<h4 class="title"><?php esc_html_e( 'Email', 'beehive' ); ?></h4>
						<div <?php $this->print_render_attribute_string( 'email' ); ?>><?php echo wp_kses_post( $settings['email'] ); ?></div>
					</div>
				</div>
				<?php endif; ?>
				<?php if ( $settings['phone'] ) : ?>
				<div class="phone item">
					<div class="inner">
						<span class="item-icon"><i class="uil-phone-volume"></i></span>
						<h4 class="title"><?php esc_html_e( 'Phone', 'beehive' ); ?></h4>
						<div <?php $this->print_render_attribute_string( 'phone' ); ?>><?php echo wp_kses_post( $settings['phone'] ); ?></div>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
