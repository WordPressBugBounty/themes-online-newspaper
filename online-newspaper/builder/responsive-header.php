<?php
    /**
     * Base class for responsive header builder
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    namespace Online_Newspaper_Builder;
    require 'header-builder.php';
    use OnlineNewspaper\CustomizerDefault as ONP;
    if( ! class_exists( 'Responsive_Header_Builder_Render' ) ) :
        /**
         * Builder Base class
         * 
         * @since 1.0.0
         */
        class Responsive_Header_Builder_Render extends Header_Builder_Render {
            /**
             * Method that gets called when class is instantiated
             * 
             * @since 1.0.0
             */
            public function __construct() {
                $this->original_value = ONP\online_newspaper_get_customizer_option( 'responsive_header_builder' );
                $this->builder_value = $this->original_value;
                $this->responsive = 'tablet';
                $this->assign_values();
                $this->prepare_value_for_render();
                $this->render();
            }

            /**
             * Opening div
             * 
             * @since 1.0.0
             */
            protected function opening_div() {
                $wrapperClass = $this->prefix_class . '-responsive';
                echo '<div class="'. esc_attr( $wrapperClass ) .'">';
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
                        if( has_action( 'online_newspaper_ticker_news_hook' ) ) do_action( 'online_newspaper_ticker_news_hook' );
                        break;
                    case 'toggle-button':
                        /**
                         * Function - online_newspaper_get_toggle_button_html
                         */
                        return online_newspaper_get_toggle_button_html();
                        break;
                endswitch;
            }

            /**
             * Mobile canvas
             * 
             * @since 1.0.0
             */
            public function get_mobile_canvas() {
                $rowClass = $this->prefix_class . 'row';
                $rowClass .= ' mobile-canvas';
                $responsive_header_builder = ONP\online_newspaper_get_customizer_option( 'responsive_header_builder' );
                $mobile_canvas_alignment = ONP\online_newspaper_get_customizer_option( 'mobile_canvas_alignment' );
                $rowClass .= ' alignment--' . $mobile_canvas_alignment;
                $canvas = $responsive_header_builder['responsive-canvas'];
                $only_widgets = array_reduce( $this->original_value, 'array_merge', [] );
                if( ! in_array( 'toggle-button', $only_widgets ) ) return;
                ?>
                    <div class="<?php echo esc_attr( $rowClass ); ?>">
                        <?php
                            if( ! empty( $canvas ) && is_array( $canvas ) ) :
                                foreach( $canvas as $widget_index => $widget ) :
                                    $this->render_widget( $widget, $widget_index );
                                endforeach;
                            endif;
                        ?>
                    </div>
                <?php
            }
        }
    endif;