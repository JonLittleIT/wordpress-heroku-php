<?php
/**
 * Beehive Image Slider Elementor Widget.
 *
 * Elementor widget that inserts WordPress image slider into the page
 *
 * @package WordPress
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); }

/**
 * Beehive_Image_Slider_Element class.
 *
 * @extends \Elementor\Widget_Base.
 * @since 1.0.0
 */
class Beehive_Image_Slider_Element extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve image slider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'beehive-image-slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve image slider widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Image Slider(a)', 'beehive' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve image slider widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-slider-3d';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the image slider widget belongs to.
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
	 * Register image slider widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() { // @codingStandardsIgnoreLine

		$this->start_controls_section(
			'image_slider',
			array(
				'label' => esc_html__( 'Image Slider', 'beehive' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'alignment',
			array(
				'label'     => esc_html__( 'Content Alignment', 'beehive' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => array(
					'left'   => esc_html__( 'Left', 'beehive' ),
					'center' => esc_html__( 'Center', 'beehive' ),
					'right'  => esc_html__( 'Right', 'beehive' ),
				),
				'separator' => 'after',
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Choose Image', 'beehive' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			'slide_subtitle',
			array(
				'label'       => esc_html__( 'Slide Top Subtitle', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Slide subtitle', 'beehive' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'slide_title',
			array(
				'label'       => esc_html__( 'Slide Main Title', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Slide title', 'beehive' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'slide_texts',
			array(
				'label'       => esc_html__( 'Slide text content', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti.', 'beehive' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'slide_action',
			array(
				'label'        => esc_html__( 'Action Button', 'beehive' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'beehive' ),
				'label_off'    => esc_html__( 'No', 'beehive' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$repeater->add_control(
			'button_text',
			array(
				'label'       => esc_html__( 'Button Text', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Action', 'beehive' ),
				'label_block' => false,
				'condition'   => array(
					'slide_action' => 'yes',
				),
			)
		);

		$repeater->add_control(
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
				'condition'   => array(
					'slide_action' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'page',
			array(
				'label'       => esc_html__( 'Select a page', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => '',
				'options'     => beehive_get_pages(),
				'label_block' => true,
				'condition'   => array(
					'slide_action' => array( 'yes' ),
					'link_to'      => array( 'page' ),
				),
			)
		);

		$repeater->add_control(
			'action_link',
			array(
				'label'         => esc_html__( 'Button Url', 'beehive' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'beehive' ),
				'show_external' => false,
				'label_block'   => false,
				'default'       => array(
					'url' => '',
				),
				'condition'     => array(
					'slide_action' => array( 'yes' ),
					'link_to'      => 'url',
				),
			)
		);

		$this->add_control(
			'slide_list',
			array(
				'label'       => esc_html__( 'Slides', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'slide_title' => esc_html__( 'Slide title #1', 'beehive' ),
					),
					array(
						'slide_title' => esc_html__( 'Slide title #2', 'beehive' ),
					),
				),
				'title_field' => '{{{ slide_title }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style',
			array(
				'label' => esc_html__( 'Image Slider', 'beehive' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'height',
			array(
				'label'      => esc_html__( 'Height', 'beehive' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vh' ),
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
					'vh' => array(
						'min'  => 0,
						'max'  => 110,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => '100',
				),
				'selectors'  => array(
					'{{WRAPPER}} .beehive-element-image-slider .swiper-slide' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'overlay',
			array(
				'label'     => esc_html__( 'Overlay Background Color', 'beehive' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .beehive-element-image-slider .swiper-slide::before' => 'background-color: {{VALUE}};',
				),
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
					'{{WRAPPER}} .beehive-element-image-slider .swiper-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .beehive-element-image-slider .swiper-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render image slider widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings    = $this->get_settings_for_display();
		$slides      = $settings['slide_list'];
		$slide_count = count( $slides ); ?>

		<div class="beehive-element-image-slider beehive-element slider-alignment-<?php echo esc_attr( $settings['alignment'] ); ?>">
			<div class="swiper-slider-container">
				<div class="swiper-wrapper">
					<?php foreach ( $slides as $slide ) : ?>
						<div class="swiper-slide"<?php echo ( isset( $slide['image']['url'] ) && '' !== $slide['image']['url'] ) ? sprintf( ' style="background-image: url(%s);"', esc_url( $slide['image']['url'] ) ) : ''; ?>>
							<div class="slide-wrapper">
								<?php if ( $slide['slide_subtitle'] ) : ?>
									<h3 class="slide-subtitle"><?php echo wp_kses_post( $slide['slide_subtitle'] ); ?></h3>
								<?php endif; ?>
								<?php if ( $slide['slide_title'] ) : ?>
									<h2 class="slide-title"><?php echo wp_kses_post( $slide['slide_title'] ); ?></h2>
								<?php endif; ?>
								<?php if ( $slide['slide_texts'] ) : ?>
									<p class="slide-text"><?php echo wp_kses_post( $slide['slide_texts'] ); ?></p>
								<?php endif; ?>
								<?php if ( 'yes' === $slide['slide_action'] ) : ?>
									<?php if ( 'page' === $slide['link_to'] && $slide['page'] ) : ?>
										<a href="<?php echo esc_url( get_permalink( $slide['page'] ) ); ?>" class="button button-primary round action"><?php echo wp_kses_post( $slide['button_text'] ); ?></a>
									<?php elseif ( 'url' === $slide['link_to'] && $slide['action_link']['url'] ) : ?>
										<a href="<?php echo esc_url( $slide['action_link']['url'] ); ?>" class="button button-primary round action"><?php echo wp_kses_post( $slide['button_text'] ); ?></a>
									<?php else : ?>
										<a href="#" class="button button-primary round action"><?php echo wp_kses_post( $slide['button_text'] ); ?></a>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<?php if ( $slide_count > 1 ) : ?>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
