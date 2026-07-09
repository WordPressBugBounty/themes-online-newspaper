<?php
    /**
     * Base class for header and footer builder
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    namespace Online_Newspaper_Builder;
    use OnlineNewspaper\CustomizerDefault as ONP;
    if( ! class_exists( 'Header_Builder_Render' ) ) :
        /**
         * Builder Base class
         * 
         * @since 1.0.0
         */
        class Header_Builder_Render extends Builder_Base {
            /**
             * Method that gets called when class is instantiated
             * 
             * @since 1.0.0
             */
            public function __construct() {
                $this->original_value = ONP\online_newspaper_get_customizer_option( 'header_builder' );
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
                /* Columns count */
                $this->columns_array = [ 
                    ONP\online_newspaper_get_customizer_option( 'header_first_row_column' ),
                    ONP\online_newspaper_get_customizer_option( 'header_second_row_column' ),
                    ONP\online_newspaper_get_customizer_option( 'header_third_row_column' )
                ];
                /* Columns layout */
                $this->column_layouts_array = [
                    ONP\online_newspaper_get_customizer_option( 'header_first_row_column_layout' ),
                    ONP\online_newspaper_get_customizer_option( 'header_second_row_column_layout' ),
                    ONP\online_newspaper_get_customizer_option( 'header_third_row_column_layout' )
                ];
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
                        ONP\online_newspaper_get_customizer_option( 'header_first_row_column_one' ),
                        ONP\online_newspaper_get_customizer_option( 'header_first_row_column_two' ),
                        ONP\online_newspaper_get_customizer_option( 'header_first_row_column_three' )
                    ],
                    [
                        /* Second Row */
                        ONP\online_newspaper_get_customizer_option( 'header_second_row_column_one' ),
                        ONP\online_newspaper_get_customizer_option( 'header_second_row_column_two' ),
                        ONP\online_newspaper_get_customizer_option( 'header_second_row_column_three' )
                    ],
                    [
                        /* Third Row */
                        ONP\online_newspaper_get_customizer_option( 'header_third_row_column_one' ),
                        ONP\online_newspaper_get_customizer_option( 'header_third_row_column_two' ),
                        ONP\online_newspaper_get_customizer_option( 'header_third_row_column_three' )
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
                $row_widgets = $this->builder_value[ $row_index ];
                $only_widgets = array_reduce( $row_widgets, 'array_merge', [] );
                $classes = '';
                if( in_array( 'menu', $only_widgets ) ) $classes .= ' has-menu';
                $allow_full_width = ONP\online_newspaper_get_customizer_option( 'header_'. $this->get_ordinals( $row_index + 1 ) .'_row_full_width' );
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
                $allow_full_width = ONP\online_newspaper_get_customizer_option( 'header_'. $this->get_ordinals( $row_index + 1 ) .'_row_full_width' );
                if( $allow_full_width ) $classes .= ' full-width';
                return $classes;
            }

            /**
             * Get widget html
             * 
             * @since 1.0.0
             */
            public function get_widget_html( $widget ) {
                require get_template_directory() . '/inc/hooks/header-hooks.php';
                if( ! $widget ) return;
                switch( $widget ) :
                    case 'site-logo':
                        /**
                        * hook - online_newspaper_header__site_branding_section_hook
                        * 
                        * @hooked - online_newspaper_header_site_branding_part - 10
                        */
                        if( has_action( 'online_newspaper_header__site_branding_section_hook' ) ) do_action( 'online_newspaper_header__site_branding_section_hook' );
                        break;
                    case 'date-time':
                        /**
                        * hook - online_newspaper_date_time_hook
                        * 
                        * @hooked - online_newspaper_date_time_html - 10
                        */
                        if( has_action( 'online_newspaper_date_time_hook' ) ) do_action( 'online_newspaper_date_time_hook' );
                        break;
                    case 'social-icons':
                        /**
                        * hook - online_newspaper_social_icons_hook
                        * 
                        * @hooked - online_newspaper_social_icons_html - 10
                        */
                        if( has_action( 'online_newspaper_social_icons_hook' ) ) do_action( 'online_newspaper_social_icons_hook' );
                        break;
                    case 'search':
                        /**
                         * hook - online_newspaper_header_search_hook
                         * 
                         * @hooked - online_newspaper_header_search_html - 10
                         */
                        if( has_action( 'online_newspaper_header_search_hook' ) ) do_action( 'online_newspaper_header_search_hook' );
                        break;
                    case 'menu':
                        /**
                         * hook - online_newspaper_primary_menu_hook
                         * 
                         * @hooked - online_newspaper_primary_menu_html - 10
                         */
                        if( has_action( 'online_newspaper_primary_menu_hook' ) ) do_action( 'online_newspaper_primary_menu_hook' );
                        break;
                    case 'button':
                        /**
                         * hook - online_newspaper_custom_button_hook
                         * 
                         * @hooked - online_newspaper_custom_button_html - 10
                         */
                        if( has_action( 'online_newspaper_custom_button_hook' ) ) do_action( 'online_newspaper_custom_button_hook' );
                        break;
                    case 'theme-mode':
                        /**
                         * hook - online_newspaper_theme_mode_hook
                         * 
                         * @hooked - online_newspaper_theme_mode_html - 10
                         */
                        if( has_action( 'online_newspaper_theme_mode_hook' ) ) do_action( 'online_newspaper_theme_mode_hook' );
                        break;
                    case 'off-canvas':
                        /**
                         * hook - online_newspaper_off_canvas_hook
                         * 
                         * @hooked - online_newspaper_off_canvas_html - 10
                         */
                        if( has_action( 'online_newspaper_off_canvas_hook' ) ) do_action( 'online_newspaper_off_canvas_hook' );
                        break;
                    case 'image':
                        /**
                         * hook - online_newspaper_header_advertisement_hook
                         * 
                         * @hooked - online_newspaper_header_advertisement_html - 10
                         */
                        if( has_action( 'online_newspaper_header_advertisement_hook' ) ) do_action( 'online_newspaper_header_advertisement_hook' );
                        break;
                    case 'secondary-menu':
                        /**
                         * hook - online_newspaper_secondary_menu_hook
                         * 
                         * @hooked - online_newspaper_secondary_menu_html - 10
                         */
                        if( has_action( 'online_newspaper_secondary_menu_hook' ) ) do_action( 'online_newspaper_secondary_menu_hook' );
                        break;
                    case 'newsletter':
                        /**
                         * hook - online_newspaper_newsletter_hook
                         * 
                         * @hooked - online_newspaper_newsletter_html - 10
                         */
                        if( has_action( 'online_newspaper_newsletter_hook' ) ) do_action( 'online_newspaper_newsletter_hook' );
                        break;
                    case 'random-news':
                        /**
                         * hook - online_newspaper_random_news_hook
                         * 
                         * @hooked - online_newspaper_random_news_html - 10
                         */
                        if( has_action( 'online_newspaper_random_news_hook' ) ) do_action( 'online_newspaper_random_news_hook' );
                        break;
                    case 'ticker-news':
                        /**
                         * hook - online_newspaper_ticker_news_hook
                         * 
                         * @hooked - online_newspaper_ticker_news_html - 10
                         */
                        if( has_action( 'online_newspaper_ticker_news_hook' ) && ! ONP\online_newspaper_get_customizer_option('ticker_news_frontpage' ) ) do_action( 'online_newspaper_ticker_news_hook' );
                        break;
                    case 'widget-area':
                        /**
                         * sidebar-id = 'header-builder-widget-area'
                         */
                        dynamic_sidebar( 'header-builder-widget-area' );
                        break;
                endswitch;
            }
        }
    endif;