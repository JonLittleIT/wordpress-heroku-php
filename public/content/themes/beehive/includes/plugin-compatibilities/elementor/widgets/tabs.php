<?php
/**
 * Beehive elementor tabs Widget.
 *
 * Elementor widget that inserts an tabs into the page
 *
 * @package WordPress
 * @since 1.0.0
 */

/**
 * Beehive_Tabs_Element class.
 *
 * @extends \Elementor\Widget_Base.
 * @since 1.0.0
 */
class Beehive_Tabs_Element extends \Elementor\Widget_Base {

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
		return 'beehive-tabs';
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
		return esc_html__( 'Content tabs(a)', 'beehive' );
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
		return 'eicon-tabs';
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
			'content_section',
			array(
				'label' => esc_html__( 'Content tabs', 'beehive' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'tab_icon',
			array(
				'label'   => esc_html__( 'Tab icon', 'beehive' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value' => 'far fa-gem',
				),
			)
		);

		$repeater->add_control(
			'tab_title',
			array(
				'label'       => esc_html__( 'Tab title', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tab title', 'beehive' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'tab_subtitle',
			array(
				'label'       => esc_html__( 'Tab subtitle', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tab subtitle', 'beehive' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'tab_contents_heading',
			array(
				'label'     => esc_html__( 'Tab contents', 'beehive' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$repeater->add_control(
			'tab_image',
			array(
				'label'   => esc_html__( 'Choose Image', 'beehive' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => '',
				),
			)
		);

		$repeater->add_control(
			'tab_contents',
			array(
				'label'      => esc_html__( 'Content', 'beehive' ),
				'type'       => \Elementor\Controls_Manager::WYSIWYG,
				'default'    => esc_html__( 'Tab content', 'beehive' ),
				'show_label' => true,
			)
		);

		$this->add_control(
			'tabs',
			array(
				'label'       => esc_html__( 'Tab list', 'beehive' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'tab_title'    => esc_html__( 'Title #1', 'beehive' ),
						'tab_contents' => esc_html__( 'Item content. Click the edit button to change this text.', 'beehive' ),
						'tab_icon'     => 'far fa-gem',
					),
					array(
						'tab_title'    => esc_html__( 'Title #2', 'beehive' ),
						'tab_contents' => esc_html__( 'Item content. Click the edit button to change this text.', 'beehive' ),
						'tab_icon'     => 'far fa-gem',
					),
				),
				'title_field' => '{{{ tab_title }}}',
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

		$tabs   = $this->get_settings_for_display( 'tabs' );
		$id_int = substr( $this->get_id_int(), 0, 3 );

		if ( $tabs ) :
			$count = count( $tabs );
			if ( $count % 2 != 0 ) { // @codingStandardsIgnoreLine
				$middle_index = ceil( $count / 2 );
			} ?>
			<div class="beehive-tabs-element beehive-element">
				<div class="nav nav-tabs" role="tablist">
					<?php foreach ( $tabs as $index => $item ) : ?>
						<?php
						$tab_count                = $index + 1;
						$tab_title_setting_key    = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
						$tab_subtitle_setting_key = $this->get_repeater_setting_key( 'tab_subtitle', 'tabs', $index );
						$this->add_render_attribute(
							$tab_title_setting_key . '_wrapper',
							array(
								'id'            => 'beehive-nav-tab-' . $id_int . $tab_count,
								'class'         => array( 'nav-item' ),
								'data-toggle'   => 'tab',
								'href'          => '#tab-content-' . $id_int . $tab_count,
								'role'          => 'tab',
								'aria-controls' => 'tab-content-' . $id_int . $tab_count,
							)
						);
						if ( isset( $middle_index ) ) {
							if ( $middle_index == $tab_count ) { // @codingStandardsIgnoreLine
								$this->add_render_attribute(
									$tab_title_setting_key . '_wrapper',
									array(
										'class'         => array( 'active' ),
										'aria-selected' => 'true',
									)
								);
							}
						} else {
							if ( $tab_count == 1 ) { // @codingStandardsIgnoreLine
								$this->add_render_attribute(
									$tab_title_setting_key . '_wrapper',
									array(
										'class'         => array( 'active' ),
										'aria-selected' => 'true',
									)
								);
							}
						}
						$this->add_render_attribute(
							$tab_title_setting_key,
							array(
								'class' => 'nav-item-title',
							)
						);
						$this->add_inline_editing_attributes( $tab_title_setting_key, 'none' );
						$this->add_render_attribute(
							$tab_subtitle_setting_key,
							array(
								'class' => 'sub-title mute',
							)
						);
						$this->add_inline_editing_attributes( $tab_subtitle_setting_key, 'none' );
						?>
					<a <?php $this->print_render_attribute_string( $tab_title_setting_key . '_wrapper' ); ?>>
						<div class="nav-item-wrapper">
							<span class="nav-item-icon"><?php \Elementor\Icons_Manager::render_icon( $tabs[ $index ]['tab_icon'], array( 'aria-hidden' => 'true' ) ); ?></span>
							<h4 <?php $this->print_render_attribute_string( $tab_title_setting_key ); ?>><?php echo wp_kses_post( $item['tab_title'] ); ?></h4>
							<span <?php $this->print_render_attribute_string( $tab_subtitle_setting_key ); ?>><?php echo wp_kses_post( $item['tab_subtitle'] ); ?></span>
						</div>
					</a>
					<?php endforeach; ?>
				</div>

				<div class="tab-content">

					<?php foreach ( $tabs as $index => $item ) : ?>
						<?php
						$tab_count               = $index + 1;
						$tab_content_setting_key = $this->get_repeater_setting_key( 'tab_contents', 'tabs', $index );
						$this->add_render_attribute(
							$tab_content_setting_key . '_wrapper',
							array(
								'id'              => 'tab-content-' . $id_int . $tab_count,
								'class'           => array( 'tab-pane', 'fade' ),
								'role'            => 'tabpanel',
								'aria-labelledby' => 'beehive-nav-tab-' . $id_int . $tab_count,
							)
						);
						if ( isset( $middle_index ) ) {
							if ( $middle_index == $tab_count ) { // @codingStandardsIgnoreLine
								$this->add_render_attribute(
									$tab_content_setting_key . '_wrapper',
									array(
										'class' => array( 'show', 'active' ),
									)
								);
							}
						} else {
							if ( $tab_count == 1 ) { // @codingStandardsIgnoreLine
								$this->add_render_attribute(
									$tab_content_setting_key . '_wrapper',
									array(
										'class' => array( 'show', 'active' ),
									)
								);
							}
						}
						$this->add_render_attribute(
							$tab_content_setting_key,
							array(
								'class' => 'pane-texts',
							)
						);
						$this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );
						?>
					<div <?php $this->print_render_attribute_string( $tab_content_setting_key . '_wrapper' ); ?>>
						<div class="pane-wrapper">
							<?php if ( isset( $item['tab_image'] ) && '' !== $item['tab_image']['url'] ) : ?>
								<div class="pane-image">
									<img src="<?php echo esc_url( $item['tab_image']['url'] ); ?>" alt="<?php esc_attr_e( 'Tab image', 'beehive' ); ?>">
								</div>
							<?php endif; ?>
							<div <?php $this->print_render_attribute_string( $tab_content_setting_key ); ?>>
								<?php echo wp_kses_post( $this->parse_text_editor( $item['tab_contents'] ) ); ?>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
		<?php
	}
}
