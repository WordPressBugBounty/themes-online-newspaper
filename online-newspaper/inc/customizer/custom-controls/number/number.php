<?php
/**
 * Number Control
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */

if( class_exists( 'Online_Newspaper_WP_Base_Control' ) ) :
    class Online_Newspaper_WP_Number_Control extends \Online_Newspaper_WP_Base_Control {
        /**
         * Control type
         * 
         * @since 1.0.0
         */
        public $type = 'online-newspaper-number';
        public $full_width = false;

        /**
         * Render the control's content
         * 
         * @since 1.0.0
         */
        public function render_content() {
            if ( ! empty( $this->label ) ) echo '<span class="customize-control-title">', esc_html( $this->label ), '</span>';
            if ( ! empty( $this->description ) ) echo '<p class="customize-control-description">', esc_html( $this->description ), '</p>';
            ?>
                <input type="number" <?php $this->input_attrs(); ?>
                    <?php if ( ! isset( $this->input_attrs['value'] ) ) : ?>
                            value="<?php echo esc_attr( $this->value() ); ?>"
                    <?php endif; ?>
                    <?php $this->link(); ?>
                    <?php if( $this->full_width ) echo 'class="online-newspaper-full-width"';?>
                />
            <?php
        }
    }
endif;