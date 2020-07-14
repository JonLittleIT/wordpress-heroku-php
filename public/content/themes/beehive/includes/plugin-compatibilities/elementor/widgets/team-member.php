<?php
/**
 * Beehive Team Member Elementor Widget.
 *
 * Elementor widget that inserts team member into the page
 *
 * @package WordPress
 * @since 1.0.0
 */

/**
 * Beehive_Team_Member class.
 *
 * @extends \Elementor\Widget_Base.
 * @since 1.0.0
 */
class Beehive_Team_Member extends \Elementor\Widget_Base {

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
		return 'beehive-team-member';
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
		return esc_html__( 'Team Member(a)', 'beehive' );
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
		return 'eicon-lock-user';
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
			'team_member',
			array(
				'label' => esc_html__( 'Team Member', 'beehive' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Member Image', 'beehive' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'name',
			array(
				'label'   => esc_html__( 'Name', 'beehive' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'John Doe', 'beehive' ),
			)
		);

		$this->add_control(
			'position',
			array(
				'label'   => esc_html__( 'Position', 'beehive' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Marketing Executive', 'beehive' ),
			)
		);

		$this->add_control(
			'facebook',
			array(
				'label'         => esc_html__( 'Facebook profile link', 'beehive' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'show_external' => false,
				'default'       => array(
					'url' => 'https://facebook.com/',
				),
			)
		);

		$this->add_control(
			'twitter',
			array(
				'label'         => esc_html__( 'Twitter profile link', 'beehive' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'default'       => array(
					'url' => 'https://twitter.com/',
				),
			)
		);

		$this->add_control(
			'linkedin',
			array(
				'label'         => esc_html__( 'Linkedin profile link', 'beehive' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'default'       => array(
					'url' => 'https://linkedin.com/',
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

		$facebook = ( isset( $settings['facebook']['url'] ) ) ? $settings['facebook']['url'] : '';
		$twitter  = ( isset( $settings['twitter']['url'] ) ) ? $settings['twitter']['url'] : '';
		$linkedin = ( isset( $settings['linkedin']['url'] ) ) ? $settings['linkedin']['url'] : '';

		$this->add_render_attribute( 'name', 'class', 'member-name' );
		$this->add_inline_editing_attributes( 'name', 'none' );
		$this->add_render_attribute( 'position', 'class', 'position-name mute' );
		$this->add_inline_editing_attributes( 'position', 'none' ); ?>

		<div class="beehive-team-member-element beehive-element">
			<div class="member-wrapper">
				<div class="member-photo">
					<?php echo wp_get_attachment_image( $settings['image']['id'], array( 800, 800 ) ); ?>
				</div>
				<div class="member-info">
					<?php if ( $facebook || $twitter || $linkedin ) : ?>
						<ul class="find-on">
							<?php if ( $facebook ) : ?>
								<li class="item facebook">
									<a href="<?php echo esc_url( $settings['facebook']['url'] ); ?>" target="_blank"><i class="icon ion-social-facebook"></i></a> 
								</li>
							<?php endif; ?>
							<?php if ( $twitter ) : ?>
								<li class="item twitter">
									<a href="<?php echo esc_url( $settings['twitter']['url'] ); ?>" target="_blank"><i class="icon ion-social-twitter"></i></a> 
								</li>
							<?php endif; ?>
							<?php if ( $linkedin ) : ?>
								<li class="item linkedin">
									<a href="<?php echo esc_url( $settings['linkedin']['url'] ); ?>" target="_blank"><i class="icon ion-social-linkedin"></i></a> 
								</li>
							<?php endif; ?>
						</ul>
					<?php endif; ?>
					<h4 <?php $this->print_render_attribute_string( 'name' ); ?>><?php echo wp_kses_post( $settings['name'] ); ?></h4>
					<p <?php $this->print_render_attribute_string( 'position' ); ?>><?php echo wp_kses_post( $settings['position'] ); ?></p>
				</div>
			</div>
		</div>
		<?php
	}
}
