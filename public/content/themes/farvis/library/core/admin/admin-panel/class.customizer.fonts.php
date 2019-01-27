<?php 

if( class_exists( 'WP_Customize_Control' ) ) :
	class farvis_Google_Fonts_Control extends WP_Customize_Control {
 
		public function render_content() {

		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?> class="pix-google-font" data-value="<?php echo esc_attr( $this->value() ) ?>">
					<option value=""><?php esc_attr_e('Select Google Font', 'farvis') ?></option>
				</select>
			</label>
		<?php
		}
	}
endif;


if( class_exists( 'WP_Customize_Control' ) ) :
	class farvis_Google_Font_Weight_Control extends WP_Customize_Control {

		public $hidden_class = '';
		public $container_class = '';

		public function render_content() {

		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<input type="text" <?php $this->link(); ?> id="<?php echo esc_attr( $this->hidden_class ) ?>" value="<?php echo esc_attr( $this->value() ) ?>">
			</label>
			<div id="<?php echo esc_attr( $this->container_class ) ?>" class="pix-font-wight-content"></div>
		<?php
		}
	}
endif;


if( class_exists( 'WP_Customize_Control' ) ) :
	class farvis_Google_Font_Weight_Single_Control extends WP_Customize_Control {

		public $container_class = '';

		public function render_content() {

		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?> id="<?php echo esc_attr( $this->container_class ) ?>_weight" data-value="<?php echo esc_attr( $this->value() ) ?>">
					<option value=""><?php esc_attr_e('Default', 'farvis') ?></option>
				</select>
			</label>
		<?php
		}
	}
endif;


if( class_exists( 'WP_Customize_Control' ) ) :
	class farvis_Slider_Single_Control extends WP_Customize_Control {

		public $min = '';
		public $max = '';

		public function enqueue() {
            wp_enqueue_script('farvis-custom-slider', get_template_directory_uri() . '/library/core/admin/js/custom-slider.js', array('jquery'), false, true);
        }

		public function render_content() {
		?>
			<label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <input type="text" <?php $this->link(); ?> class="range-slider-single" data-min="<?php echo esc_attr( $this->min ) ?>" data-max="<?php echo esc_attr( $this->max ) ?>" value="<?php echo esc_attr( $this->value() ) ?>">
                <div class="range-values range-single-input">
                    <input data-type="number" class="range-value">
                </div>
            </label>
		<?php
		}
	}
endif;


if( class_exists( 'WP_Customize_Control' ) ) :
	class farvis_Slider_Double_Control extends WP_Customize_Control {

		public $min = '';
		public $max = '';

		public function enqueue() {
            wp_enqueue_script('farvis-custom-slider', get_template_directory_uri() . '/library/core/admin/js/custom-slider.js', array('jquery'), false, true);
        }

		public function render_content() {
		?>
			<label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <input type="text" <?php $this->link(); ?> class="range-slider-double" data-min="<?php echo esc_attr( $this->min ) ?>" data-max="<?php echo esc_attr( $this->max ) ?>" value="<?php echo esc_attr( $this->value() ) ?>">
                <div class="range-values">
                    <input data-type="number" disabled class="range-value-1">
                    <span>-</span>
                    <input data-type="number" disabled class="range-value-2">
                    <span>-</span>
                    <input data-type="number" disabled class="range-value-3">
                </div>
            </label>
		<?php
		}
	}
endif;


if( class_exists( 'WP_Customize_Control' ) ) :
class farvis_Multiple_Select_Control extends WP_Customize_Control {

    public function render_content() {

    if ( empty( $this->choices ) )
        return;

    ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
                <?php
                    foreach ( $this->choices as $value => $label ) {
                        $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
                        echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
                    }
                ?>
            </select>
        </label>
    <?php }
}
endif;