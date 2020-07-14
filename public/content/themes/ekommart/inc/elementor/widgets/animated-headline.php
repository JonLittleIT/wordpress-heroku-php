<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Ekommart_Elementor_Animated_Headline extends Widget_Base {

	public function __construct( $data = [], $args = null ) {
		global $ekommart_version;
		parent::__construct( $data, $args );

		wp_register_script( 'animated-headline', get_theme_file_uri( '/assets/js/elementor/animated-headline.js' ), array(
			'jquery',
			'elementor-frontend'
		), $ekommart_version, true );
	}

	public function get_name() {
		return 'ekommart-animated-headline';
	}

	public function get_title() {
		return esc_html__( 'Animated Headline', 'ekommart' );
	}

	public function get_icon() {
		return 'eicon-animated-headline';
	}

	public function get_categories() {
		return [ 'ekommart-addons' ];
	}

	public function get_script_depends() {
		return [ 'animated-headline' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'text_elements',
			[
				'label' => esc_html__( 'Headline', 'ekommart' ),
			]
		);

		$this->add_control(
			'headline_style',
			[
				'label'              => esc_html__( 'Style', 'ekommart' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'highlight',
				'options'            => [
					'highlight' => esc_html__( 'Highlighted', 'ekommart' ),
					'rotate'    => esc_html__( 'Rotating', 'ekommart' ),
				],
				'prefix_class'       => 'elementor-headline--style-',
				'render_type'        => 'template',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'animation_type',
			[
				'label'              => esc_html__( 'Animation', 'ekommart' ),
				'type'               => Controls_Manager::SELECT,
				'options'            => [
					'typing'     => 'Typing',
					'clip'       => 'Clip',
					'flip'       => 'Flip',
					'swirl'      => 'Swirl',
					'blinds'     => 'Blinds',
					'drop-in'    => 'Drop-in',
					'wave'       => 'Wave',
					'slide'      => 'Slide',
					'slide-down' => 'Slide Down',
				],
				'default'            => 'typing',
				'condition'          => [
					'headline_style' => 'rotate',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'marker',
			[
				'label'              => esc_html__( 'Shape', 'ekommart' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'circle',
				'options'            => [
					'circle'           => _x( 'Circle', 'Shapes', 'ekommart' ),
					'curly'            => _x( 'Curly', 'Shapes', 'ekommart' ),
					'underline'        => _x( 'Underline', 'Shapes', 'ekommart' ),
					'double'           => _x( 'Double', 'Shapes', 'ekommart' ),
					'double_underline' => _x( 'Double Underline', 'Shapes', 'ekommart' ),
					'underline_zigzag' => _x( 'Underline Zigzag', 'Shapes', 'ekommart' ),
					'diagonal'         => _x( 'Diagonal', 'Shapes', 'ekommart' ),
					'strikethrough'    => _x( 'Strikethrough', 'Shapes', 'ekommart' ),
					'x'                => 'X',
				],
				'render_type'        => 'template',
				'condition'          => [
					'headline_style' => 'highlight',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'before_text',
			[
				'label'       => esc_html__( 'Before Text', 'ekommart' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'This page is', 'ekommart' ),
				'placeholder' => esc_html__( 'Enter your headline', 'ekommart' ),
				'label_block' => true,
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'highlighted_text',
			[
				'label'              => esc_html__( 'Highlighted Text', 'ekommart' ),
				'type'               => Controls_Manager::TEXT,
				'default'            => esc_html__( 'Amazing', 'ekommart' ),
				'label_block'        => true,
				'condition'          => [
					'headline_style' => 'highlight',
				],
				'separator'          => 'none',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'rotating_text',
			[
				'label'              => esc_html__( 'Rotating Text', 'ekommart' ),
				'type'               => Controls_Manager::TEXTAREA,
				'placeholder'        => esc_html__( 'Enter each word in a separate line', 'ekommart' ),
				'separator'          => 'none',
				'default'            => "Better\nBigger\nFaster",
				'rows'               => 5,
				'condition'          => [
					'headline_style' => 'rotate',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'after_text',
			[
				'label'       => esc_html__( 'After Text', 'ekommart' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your headline', 'ekommart' ),
				'label_block' => true,
				'separator'   => 'none',
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'       => esc_html__( 'Alignment', 'ekommart' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'   => [
						'title' => esc_html__( 'Left', 'ekommart' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'ekommart' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'ekommart' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'     => 'center',
				'separator'   => 'before',
				'selectors'   => [
					'{{WRAPPER}} .elementor-headline' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tag',
			[
				'label'   => esc_html__( 'HTML Tag', 'ekommart' ),
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
			'section_style_marker',
			[
				'label'     => esc_html__( 'Shape', 'ekommart' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'headline_style' => 'highlight',
				],
			]
		);

		$this->add_control(
			'marker_color',
			[
				'label'     => esc_html__( 'Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-headline-dynamic-wrapper path' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'stroke_width',
			[
				'label'     => esc_html__( 'Width', 'ekommart' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-headline-dynamic-wrapper path' => 'stroke-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'above_content',
			[
				'label'     => esc_html__( 'Bring to Front', 'ekommart' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					"{{WRAPPER}} .elementor-headline-dynamic-wrapper svg" => 'z-index: 2',
					"{{WRAPPER}} .elementor-headline-dynamic-text"        => 'z-index: auto',
				],
			]
		);

		$this->add_control(
			'rounded_edges',
			[
				'label'     => esc_html__( 'Rounded Edges', 'ekommart' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					"{{WRAPPER}} .elementor-headline-dynamic-wrapper path" => 'stroke-linecap: round; stroke-linejoin: round',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text',
			[
				'label' => esc_html__( 'Headline', 'ekommart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Text Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-headline-plain-text' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .elementor-headline',
			]
		);

		$this->add_control(
			'heading_words_style',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => esc_html__( 'Animated Text', 'ekommart' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'words_color',
			[
				'label'     => esc_html__( 'Text Color', 'ekommart' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-headline-dynamic-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'words_typography',
				'selector' => '{{WRAPPER}} .elementor-headline-dynamic-text',
				'exclude'  => [ 'font_size' ],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		$tag = $settings['tag'];

		$this->add_render_attribute( 'headline', 'class', 'elementor-headline' );

		if ( 'rotate' === $settings['headline_style'] ) {
			$this->add_render_attribute( 'headline', 'class', 'elementor-headline-animation-type-' . $settings['animation_type'] );

			$is_letter_animation = in_array( $settings['animation_type'], [ 'typing', 'swirl', 'blinds', 'wave' ] );

			if ( $is_letter_animation ) {
				$this->add_render_attribute( 'headline', 'class', 'elementor-headline-letters' );
			}
		}

		?>
        <<?php echo esc_html( $tag ); ?><?php echo ekommart_elementor_get_render_attribute_string( 'headline' , $this); // WPCS: XSS ok. ?>>
		<?php if ( ! empty( $settings['before_text'] ) ) : ?>
            <span class="elementor-headline-plain-text elementor-headline-text-wrapper"><?php echo esc_html( $settings['before_text'] ); ?></span>
		<?php endif; ?>

		<?php if ( ! empty( $settings['rotating_text'] ) ) : ?>
            <span class="elementor-headline-dynamic-wrapper elementor-headline-text-wrapper"></span>
		<?php endif; ?>

		<?php if ( ! empty( $settings['after_text'] ) ) : ?>
            <span class="elementor-headline-plain-text elementor-headline-text-wrapper"><?php echo esc_html( $settings['after_text'] ); ?></span>
		<?php endif; ?>
        </<?php echo esc_html( $tag ); ?>>
		<?php
	}

	protected function _content_template() {
		?>
        <#
        var headlineClasses = 'elementor-headline';

        if ( 'rotate' === settings.headline_style ) {
        headlineClasses += ' elementor-headline-animation-type-' + settings.animation_type;

        var isLetterAnimation = -1 !== [ 'typing', 'swirl', 'blinds', 'wave' ].indexOf( settings.animation_type );

        if ( isLetterAnimation ) {
        headlineClasses += ' elementor-headline-letters';
        }
        }
        #>
        <{{{ settings.tag }}} class="{{{ headlineClasses }}}">
        <# if ( settings.before_text ) { #>
        <span class="elementor-headline-plain-text elementor-headline-text-wrapper">{{{ settings.before_text }}}</span>
        <# } #>

        <# if ( settings.rotating_text ) { #>
        <span class="elementor-headline-dynamic-wrapper elementor-headline-text-wrapper"></span>
        <# } #>

        <# if ( settings.after_text ) { #>
        <span class="elementor-headline-plain-text elementor-headline-text-wrapper">{{{ settings.after_text }}}</span>
        <# } #>
        </{{{ settings.tag }}}>
		<?php
	}
}

$widgets_manager->register_widget_type( new Ekommart_Elementor_Animated_Headline() );
