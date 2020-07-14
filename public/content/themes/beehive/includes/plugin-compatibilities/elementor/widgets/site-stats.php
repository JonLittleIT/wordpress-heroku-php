<?php
/**
 * Beehive Site Stats Elementor Widget.
 *
 * Elementor widget that inserts site stats into the page
 *
 * @package WordPress
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); }

/**
 * Beehive_Stats class.
 *
 * @extends \Elementor\Widget_Base.
 * @since 1.0.0
 */
class Beehive_Stats extends \Elementor\Widget_Base {

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
		return 'beehive-stats';
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
		return esc_html__( 'Site Stats(a)', 'beehive' );
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
		return 'eicon-counter-circle';
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
			'site_stats',
			array(
				'label' => esc_html__( 'Site Stats', 'beehive' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'item_value',
			array(
				'label'       => esc_html__( 'Item value', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( '50M+', 'beehive' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'item_title',
			array(
				'label'       => esc_html__( 'Title', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'List Title', 'beehive' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'stats_list',
			array(
				'label'       => esc_html__( 'Statistics List', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'item_title' => esc_html__( 'Title #1', 'beehive' ),
						'item_value' => esc_html__( '50M+', 'beehive' ),
					),
					array(
						'item_title' => esc_html__( 'Title #2', 'beehive' ),
						'item_value' => esc_html__( '50M+', 'beehive' ),
					),
					array(
						'item_title' => esc_html__( 'Title #3', 'beehive' ),
						'item_value' => esc_html__( '50M+', 'beehive' ),
					),
					array(
						'item_title' => esc_html__( 'Title #4', 'beehive' ),
						'item_value' => esc_html__( '50M+', 'beehive' ),
					),
				),
				'title_field' => '{{{ item_title }}}',
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
		$lists    = $settings['stats_list'];
		if ( $lists ) : ?>
		<div class="beehive-stats-element beehive-element">
			<ul class="stats-list">
				<?php foreach ( $lists as $index => $list ) : ?>
					<?php
					$item_value_setting_key = $this->get_repeater_setting_key( 'item_value', 'stats_list', $index );
					$this->add_render_attribute(
						$item_value_setting_key,
						array(
							'class' => 'count h1 color-primary',
						)
					);
					$this->add_inline_editing_attributes( $item_value_setting_key, 'none' );
					$item_title_setting_key = $this->get_repeater_setting_key( 'item_title', 'stats_list', $index );
					$this->add_render_attribute(
						$item_title_setting_key,
						array(
							'class' => 'item-description',
						)
					);
					$this->add_inline_editing_attributes( $item_title_setting_key, 'none' );
					?>
				<li class="item column">
					<div class="item-wrapper">
						<?php if ( isset( $list['item_value'] ) ) : ?>
							<div <?php $this->print_render_attribute_string( $item_value_setting_key ); ?>><?php echo wp_kses_post( $list['item_value'] ); ?></div>
						<?php endif; ?>
						<?php if ( isset( $list['item_title'] ) ) : ?>
							<p <?php $this->print_render_attribute_string( $item_title_setting_key ); ?>><?php echo wp_kses_post( $list['item_title'] ); ?></p>
						<?php endif; ?>
					</div>                      
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
		<?php
	}
}
