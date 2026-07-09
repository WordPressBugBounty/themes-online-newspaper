<?php
/**
 * Builder Control
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
if( ! class_exists( 'Online_Newspaper_WP_Builder_Control' ) ) :
    class Online_Newspaper_WP_Builder_Control extends Online_Newspaper_WP_Base_Control {
        // control type
        public $type = 'builder';
        public $widgets = [];
        public $placement = 'header';
        public $related_section = [
            'count'	=>	'_row_count',
            'layout'	=>	'_row_column_layout'
        ];
        public $builder_settings_section = '';
        public $responsive_builder = '';

        /**
         * Loads the jQuery UI button script and custom scripts/styles
         * 
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function enqueue() {
            wp_enqueue_style( 'online-newspaper-builder-css', get_template_directory_uri() . '/inc/customizer/custom-controls/builder/builder.css', [], ONLINE_NEWSPAPER_VERSION, 'all' );
            wp_enqueue_script( 'online-newspaper-builder-js', get_template_directory_uri() . '/inc/customizer/custom-controls/builder/builder.js', ['jquery'], ONLINE_NEWSPAPER_VERSION, [ 'strategy' => 'defer', 'in_footer' => true ] );
        }
    
        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['widgets'] = $this->widgets;
            $this->json['placement'] = $this->placement;
            $this->json['related_section'] = $this->related_section;
            $this->json['builder_settings_section'] = $this->builder_settings_section;
            $this->json['responsive_builder'] = $this->responsive_builder;
        }
    }
endif;