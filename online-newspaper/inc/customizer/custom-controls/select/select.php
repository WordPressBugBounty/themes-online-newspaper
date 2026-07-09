<?php
/**
 * Select Control
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */

if( class_exists( 'Online_Newspaper_WP_Base_Control' ) ) :
    class Online_Newspaper_WP_Select_Control extends \Online_Newspaper_WP_Base_Control {
        /**
         * Control type
         * 
         * @since 1.0.0
         */
        public $type = 'online-newspaper-select';

        /**
         * Render the control's content
         * 
         * @since 1.0.0
         */
        public function render_content() {
            if ( empty( $this->choices ) ) return;
            if ( ! empty( $this->label ) ) echo '<span class="customize-control-title">', esc_html( $this->label ), '</span>';
            if ( ! empty( $this->description ) ) echo '<p class="customize-control-description">', esc_html( $this->description ), '</p>';
           ?>
                <select <?php $this->link(); ?>>
                    <?php
                        foreach ( $this->choices as $value => $label ) :
                            echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html( $label ) . '</option>';
                        endforeach
                    ?>
                </select>
           <?php
        }
    }
endif;