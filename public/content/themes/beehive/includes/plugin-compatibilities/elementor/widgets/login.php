<?php
/**
 * Beehive Login Elementor Widget.
 *
 * Elementor widget that inserts login form into the page
 *
 * @package WordPress
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); }

/**
 * Beehive_Login_Form_Element class.
 *
 * @extends \Elementor\Widget_Base.
 * @since 1.0.0
 */
class Beehive_Login_Form_Element extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve login form widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'beehive-login';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve login form widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Login Form(a)', 'beehive' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve login form widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-form-horizontal';
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
	 * Register login form widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() { // @codingStandardsIgnoreLine

		$this->start_controls_section(
			'login',
			array(
				'label' => esc_html__( 'Login Form', 'beehive' ),
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
					'default' => esc_html__( 'Default', 'beehive' ),
					'compact' => esc_html__( 'Compact', 'beehive' ),
				),
			)
		);

		$this->add_control(
			'on_dark',
			array(
				'label'        => esc_html__( 'On Dark BG?', 'beehive' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'beehive' ),
				'label_off'    => esc_html__( 'No', 'beehive' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_control(
			'signup',
			array(
				'label'        => esc_html__( 'Signup Link', 'beehive' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'beehive' ),
				'label_off'    => esc_html__( 'Hide', 'beehive' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'btn_text',
			array(
				'label'       => esc_html__( 'Button Text', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Log Into Your Account', 'beehive' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'max-width',
			array(
				'label'      => esc_html__( 'Max Width', 'beehive' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => '100',
				),
				'selectors'  => array(
					'{{WRAPPER}} .beehive-login-element .login-form-wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
				),
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
	 * Render login form widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'form-element-class', 'class', 'beehive-login-element beehive-element' );
		if ( $settings['style'] ) {
			$this->add_render_attribute( 'form-element-class', 'class', $settings['style'] );
		}
		if ( 'yes' === $settings['on_dark'] ) {
			$this->add_render_attribute( 'form-element-class', 'class', 'on-dark' );
		}

		$this->add_render_attribute(
			'btn_text',
			array(
				'type'  => 'submit',
				'id'    => 'element_login_submit',
				'class' => 'wide submit-login ellipsis',
				'name'  => 'wp-submit',
			)
		);
		$this->add_inline_editing_attributes( 'btn_text', 'none' ); ?>

		<?php if ( ! is_user_logged_in() || current_user_can( 'manage_options' ) ) : ?>
			<div <?php $this->print_render_attribute_string( 'form-element-class' ); ?>>
				<div class="login-form-wrapper">
					<form action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post" id="element-login-form" class="beehive-login-form element-login-form" name="element-login">
						<div class="form-group">
							<div class="user-name">
								<label class="screen-reader-text"><?php esc_html_e( 'Email/username', 'beehive' ); ?></label>
								<span class="icon"><i class="uil-user"></i></span>
								<input type="text" id="element-username" class="username-control" required name="log" value="" placeholder="<?php esc_attr_e( 'Email or username', 'beehive' ); ?>">
							</div>
						</div>
						<div class="form-group">
							<div class="pass">
								<label class="screen-reader-text"><?php esc_html_e( 'Password', 'beehive' ); ?></label>
								<span class="icon"><i class="uil-key-skeleton-alt"></i></span>
								<input type="password" id="element-password" class="password-control" required name="pwd" value="" placeholder="<?php esc_attr_e( 'Password', 'beehive' ); ?>">
							</div>
						</div>
						<?php do_action( 'login_form' ); ?>
						<div class="form-options">
							<div class="row">
								<div class="col-6">
									<div class="forgetmenot">
										<label for="element-rememberme">
											<input id="element-rememberme" name="rememberme" type="checkbox" value="forever" /> <?php esc_html_e( 'Remember', 'beehive' ); ?>
										</label>
									</div>
								</div>
								<div class="col-6">
									<div class="forgot-password">
										<a href="<?php echo esc_url( wp_lostpassword_url( get_permalink() ) ); ?>">
											<?php esc_html_e( 'Lost Password?', 'beehive' ); ?>
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php if ( beehive()->options->get( 'key=ajax-login' ) ) : ?>
							<div class="beehive-login-result"></div>
						<?php endif; ?>
						<div class="submit">
							<button <?php $this->print_render_attribute_string( 'btn_text' ); ?>><?php echo esc_html( $settings['btn_text'] ); ?></button>
						</div>
						<?php wp_nonce_field( 'beehive-element-ajax-login-nonce', 'element-login-security' ); ?>
						<?php if ( 'yes' === $settings['signup'] && get_option( 'users_can_register' ) ) : ?> 
							<div class="register-link">
								<a href="<?php echo esc_url( wp_registration_url() ); ?>" class="register color-primary" target="_blank" ><?php esc_html_e( 'Create an account', 'beehive' ); ?></a>
							</div>
						<?php else : ?>
							<div class="register-link">
							<p class="color-primary"><?php esc_html_e( 'Signup is disabled', 'beehive' ); ?></p>
							</div>
						<?php endif; ?>
					</form>
					<?php do_action( 'beehive_after_login_form' ); ?>
				</div>
			</div>
		<?php else : ?>
			<div class="beehive-login-element beehive-element">
				<div class="alert alert-light" role="alert">
					<?php echo esc_html__( 'Howdy, ', 'beehive' ) . esc_html( beehive_get_current_user_display_name() ) . '<a href="' . esc_url( wp_logout_url() ) . '" class="logout color-primary">' . esc_html__( 'Logout', 'beehive' ) . '</a>'; ?>
				</div>
			</div>
		<?php endif; ?>
		<?php
	}
}
