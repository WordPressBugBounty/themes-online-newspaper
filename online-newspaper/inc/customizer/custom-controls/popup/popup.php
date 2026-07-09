<?php
/**
 * Popup Control
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */

if( class_exists( 'WP_Customize_Control' ) ) :
    class Online_Newspaper_WP_Popup_Control extends \Online_Newspaper_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'popup';

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
        }

        /**
         * Enqueue scripts/styles.
         *
         * @since 3.4.0
         */
        public function enqueue() {
            wp_enqueue_style( 'online-newspaper-customizer-popup-control', get_template_directory_uri() . '/inc/customizer/custom-controls/popup/popup.css', array(), ONLINE_NEWSPAPER_VERSION, 'all' );
            wp_enqueue_script( 'online-newspaper-customizer-popup-control', get_template_directory_uri() . '/inc/customizer/custom-controls/popup/popup.js', array('jquery'), ONLINE_NEWSPAPER_VERSION, [ 'strategy' => 'defer', 'in_footer' => true ] );
        }

        /**
         * Render the control's content.
         *
         */
        public function render_content() {
            ?>
                <div class="popup-control-wrapper">
                    <?php
                    
                        echo '<div class="customize-control-head">';

                            if ( ! empty( $this->label ) ) echo '<span class="customize-control-title">', esc_html( $this->label ), '</span>';

                            echo '<span class="customize-control-icon dashicons dashicons-edit"></span>';

                        echo '</div>';

                        if ( ! empty( $this->description ) ) echo '<p class="customize-control-description">', esc_html( $this->description ), '</p>';

                        echo '<div class="popup-wrapper"></div>';

                    ?>
                </div>
            <?php
        }
    }
endif;