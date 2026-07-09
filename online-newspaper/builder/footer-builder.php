<?php
    /**
     * Footer Builder
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    namespace Online_Newspaper_Builder;
    // require 'base.php';
    use OnlineNewspaper\CustomizerDefault as ONP;
    if( ! class_exists( 'Footer_Builder_Render' ) ) :
        /**
         * Builder Base class
         * 
         * @since 1.0.0
         */
        class Footer_Builder_Render extends Builder_Base {
            /**
             * Method that gets called when class is instantiated
             * 
             * @since 1.0.0
             */
            public function __construct() {
                $this->original_value = ONP\online_newspaper_get_customizer_option( 'footer_builder' );
                $this->builder_value = $this->original_value;
                $this->assign_values();
                $this->prepare_value_for_render();
                $this->render();
            }

            /**
             * Assign values
             * 
             * @since 1.0.0
             */
            public function assign_values() {
                /* Column count */
                $footer_first_row_column = ONP\online_newspaper_get_customizer_option( 'footer_first_row_column' );
                $footer_second_row_column = ONP\online_newspaper_get_customizer_option( 'footer_second_row_column' );
                $footer_third_row_column = ONP\online_newspaper_get_customizer_option( 'footer_third_row_column' );
                $this->columns_array = [ $footer_first_row_column, $footer_second_row_column, $footer_third_row_column ];
                /* Columns layout */
                $footer_first_row_column_layout = ONP\online_newspaper_get_customizer_option( 'footer_first_row_column_layout' );
                $footer_second_row_column_layout = ONP\online_newspaper_get_customizer_option( 'footer_second_row_column_layout' );
                $footer_third_row_column_layout = ONP\online_newspaper_get_customizer_option( 'footer_third_row_column_layout' );
                $this->column_layouts_array = [ $footer_first_row_column_layout, $footer_second_row_column_layout, $footer_third_row_column_layout];
                /* Column Alignments */
                $this->column_alignments_array = $this->organize_column_alignments();
            }
            
            /**
             * Column alignments
             * 
             * @since 1.0.0
             */
            public function organize_column_alignments() {
                $column_alignments = [
                    [
                        /* First Row */
                        ONP\online_newspaper_get_customizer_option( 'footer_first_row_column_one' ),
                        ONP\online_newspaper_get_customizer_option( 'footer_first_row_column_two' ),
                        ONP\online_newspaper_get_customizer_option( 'footer_first_row_column_three' ),
                        ONP\online_newspaper_get_customizer_option( 'footer_first_row_column_four' )
                    ],
                    [
                        /* Second Row */
                        ONP\online_newspaper_get_customizer_option( 'footer_second_row_column_one' ),
                        ONP\online_newspaper_get_customizer_option( 'footer_second_row_column_two' ),
                        ONP\online_newspaper_get_customizer_option( 'footer_second_row_column_three' ),
                        ONP\online_newspaper_get_customizer_option( 'footer_second_row_column_four' )
                    ],
                    [
                        /* Third Row */
                        ONP\online_newspaper_get_customizer_option( 'footer_third_row_column_one' ),
                        ONP\online_newspaper_get_customizer_option( 'footer_third_row_column_two' ),
                        ONP\online_newspaper_get_customizer_option( 'footer_third_row_column_three' ),
                        ONP\online_newspaper_get_customizer_option( 'footer_third_row_column_four' )
                    ]
                ];

                $structured_alignements = [];
                if( count( $this->columns_array ) > 0 ) :
                    $columns_array_count = count( $this->columns_array );
                    for( $i = 0; $i < $columns_array_count; $i++ ) :
                        $structured_alignements[ $i ] = $column_alignments[ $i ];
                    endfor;
                endif;

                return $structured_alignements;
            }

            /**
             * Extra row classes
             * 
             * @since 1.0.0
             */
            public function get_extra_row_classes( $row_index ) {
                $row_direction_array = [
                    ONP\online_newspaper_get_customizer_option( 'footer_first_row_row_direction' ),
                    ONP\online_newspaper_get_customizer_option( 'footer_second_row_row_direction' ),
                    ONP\online_newspaper_get_customizer_option( 'footer_third_row_row_direction' )
                ];

                $row_widgets = $this->builder_value[ $row_index ];
                $only_widgets = array_reduce( $row_widgets, 'array_merge', [] );
                $classes = ' vertical-align--top';
                if( array_key_exists( $row_index, $row_direction_array ) ) $classes .= ' is-' . $row_direction_array[ $row_index ];
                $classes .= ' tablet-layout-' . $this->column_layouts_array[ $row_index ]['tablet'];
                $classes .= ' smartphone-layout-' . $this->column_layouts_array[ $row_index ]['smartphone'];
                $allow_full_width = ONP\online_newspaper_get_customizer_option( 'footer_'. $this->get_ordinals( $row_index + 1 ) .'_row_full_width' );
                if( ! $allow_full_width ) $classes .= ' full-width';
                return $classes;
            }

            /**
             * Extra row wrap classes
             * 
             * @since 1.0.0
             */
            public function get_extra_row_wrap_classes( $row_index ) {
                $classes = '';
                $allow_full_width = ONP\online_newspaper_get_customizer_option( 'footer_'. $this->get_ordinals( $row_index + 1 ) .'_row_full_width' );
                if( $allow_full_width ) $classes .= ' full-width';
                return $classes;
            }

            /**
             * Extra column classes
             * 
             * @since 1.0.0
             */
            public function get_extra_column_classes( $row, $column ) {
                $column_alignments = $this->column_alignments_array[ $row ][ $column ];
                $classes = '';
                $classes .= ' tablet-alignment--' . $this->column_alignments_array[ $row ][ $column ][ 'tablet' ];
                $classes .= ' smartphone-alignment--' . $this->column_alignments_array[ $row ][ $column ][ 'smartphone' ];
                return $classes;
            }

            /**
             * Get widget html
             * 
             * @since 1.0.0
             */
            public function get_widget_html( $widget ) {
                require get_template_directory() . '/inc/hooks/footer-hooks.php';
                if( ! $widget ) return;
                switch( $widget ) :
                    case 'logo':
                        /**
                         * hook - online_newspaper_footer_logo_hook
                         * 
                         * @hooked - online_newspaper_footer_logo_html - 10
                         */
                        if( has_action( 'online_newspaper_footer_logo_hook' ) ) do_action( 'online_newspaper_footer_logo_hook' );
                        break;
                    case 'social-icons':
                        /**
                         * hook - online_newspaper_footer_social_hook
                         * 
                         * @hooked - online_newspaper_footer_social_html - 10
                         */
                        if( has_action( 'online_newspaper_footer_social_hook' ) ) do_action( 'online_newspaper_footer_social_hook' );
                        break;
                    case 'copyright':
                        /**
                         * hook - online_newspaper_copyright_hook
                         * 
                         * @hooked - online_newspaper_copyright_html - 10
                         */
                        if( has_action( 'online_newspaper_copyright_hook' ) ) do_action( 'online_newspaper_copyright_hook' );
                        break;
                    case 'menu':
                        /**
                         * hook - online_newspaper_footer_menu_hook
                         * 
                         * @hooked - online_newspaper_footer_menu_html - 10
                         */
                        if( has_action( 'online_newspaper_footer_menu_hook' ) ) do_action( 'online_newspaper_footer_menu_hook' );
                        break;
                    case 'sidebar-one':
                        /**
                         * sidebar-id = 'footer-sidebar--column-1'
                         */
                        dynamic_sidebar( 'footer-sidebar--column-1' );
                        break;
                    case 'sidebar-two':
                        /**
                         * sidebar-id = 'footer-sidebar--column-2'
                         */
                        dynamic_sidebar( 'footer-sidebar--column-2' );
                        break;
                    case 'sidebar-three':
                        /**
                         * sidebar-id = 'footer-sidebar--column-3'
                         */
                        dynamic_sidebar( 'footer-sidebar--column-3' );
                        break;
                    case 'sidebar-four':
                        /**
                         * sidebar-id = 'footer-sidebar--column-4'
                         */
                        dynamic_sidebar( 'footer-sidebar--column-4' );
                        break;
                    case 'scroll-to-top':
                         /**
                         * hook - online_newspaper_scroll_to_top_hook
                         * 
                         * @hooked - online_newspaper_scroll_to_top_html - 10
                         */
                        if( has_action( 'online_newspaper_scroll_to_top_hook' ) ) do_action( 'online_newspaper_scroll_to_top_hook' );
                        break;
                endswitch;
            }
        }
    endif;