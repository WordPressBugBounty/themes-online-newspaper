<?php
    /**
     * Cache Manager
     * 
     * @package 1.0.0
     * @since 1.0.0
     */
    namespace OnlineNewspaper;

    use OnlineNewspaper\CustomizerDefault as ONP;
    use Online_Newspaper_Builder\Builder_Base as Builder_Base;

    if( ! class_exists( __NAMESPACE__ . '\\Cache_Manager' ) ) {
        /**
         * Cache_Manager class
         */
        class Cache_Manager {
            /**
             * Dynamic css transient
             * 
             * @since 1.0.0
             */
            private static $dynamic_css_transient = 'online_newspaper_dynamic_css';

            /**
             * Constructor
             * 
             * @since 1.0.0
             */
            public function __construct() {
                /**
                 * Hook executes after value of a control changes
                 */
                add_action( 'customize_save_after', [ $this, 'clear_transient' ] );
                /**
                 * Hooks executes after value of a control changes and customizer resets
                 */
                add_action( "updated_option", [ $this, 'clear_transient' ] );
                /**
                 * Set transient
                 */
                add_action( 'init', [ $this, 'init' ] );
            }

            /**
             * Clear transient
             * 
             * @since 1.0.0
             */
            public function clear_transient() {
                $contexts = [ 'single', 'page', 'home', 'archive', 'search', '404', 'other' ];
                foreach ( $contexts as $ctx ) {
                    delete_transient( self::$dynamic_css_transient . '_' . $ctx );
                }
            }

            /**
             * Initialization
             * 
             * @since 1.0.0
             */
            public function init() {
                $this->get_dynamic_css();
            }
            
            /**
             * Get dynamic css
             * 
             * @since 1.0.0
             */
            public static function get_dynamic_css() {
                // Create a unique key per page context
                $key = self::$dynamic_css_transient . '_' . self::get_page_context();
                $cached = get_transient( $key );
                if ( $cached !== false ) {
                    return $cached;
                }
                $css = self::online_newspaper_current_styles();
                set_transient( $key, $css, HOUR_IN_SECONDS );
                return $css;
            }

            /**
             * Get page context
             * 
             * @since 1.0.0
             */
            private static function get_page_context() {
                if ( is_single() )       return 'single';
                if ( is_page() )         return 'page';
                if ( is_home() )         return 'home';
                if ( is_archive() )      return 'archive';
                if ( is_search() )       return 'search';
                if ( is_404() )          return '404';
                return 'other';
            }

            /**
             * Generates the current changes in styling of the theme.
             * 
             * @package Online Newspaper Pro
             * @since 1.0.0
             */
            private static function online_newspaper_current_styles() {
                $website_layout = ONP\online_newspaper_get_customizer_option('website_layout');
                $archive_post_element_order = json_decode( ONP\online_newspaper_get_customizer_option('archive_post_element_order'), true );
                $homepage_content_order = json_decode( ONP\online_newspaper_get_customizer_option('homepage_content_order'), true );
                $sticky_posts_option = ONP\online_newspaper_get_customizer_option( 'sticky_posts_option' );
                $site_background_animation = ONP\online_newspaper_get_customizer_option( 'site_background_animation' );
                
                // Header Builder
                $header_site_logo_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'header_builder', 'site-logo' );
                $header_off_canvas_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'header_builder', 'off-canvas' );
                $header_custom_button_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'header_builder', 'button' );
                $header_search_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'header_builder', 'search' );
                $header_menu_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'header_builder', 'menu' );
                $header_random_news_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'header_builder', 'random-news' );
                $header_newsletter_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'header_builder', 'newsletter' );
                $header_date_time_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'header_builder', 'date-time' );
                $header_theme_mode_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'header_builder', 'theme-mode' );
                $header_secondary_menu_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'header_builder', 'secondary-menu' );
                $header_ticker_news_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'header_builder', 'ticker-news' );
                
                // Responsive Header Builder
                $hr_site_logo_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'site-logo' );
                $hr_off_canvas_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'off-canvas' );
                $hr_custom_button_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'button' );
                $hr_search_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'search' );
                $hr_menu_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'menu' );
                $hr_random_news_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'random-news' );
                $hr_newsletter_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'newsletter' );
                $hr_date_time_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'date-time' );
                $hr_theme_mode_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'theme-mode' );
                $hr_secondary_menu_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'secondary-menu' );
                $hr_ticker_news_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'ticker-news' );
                
                // Footer Builder
                $footer_menu_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'footer_builder', 'menu' );
                $footer_copyright_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'footer_builder', 'copyright' );
                $footer_logo_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'footer_builder', 'logo' );
                $footer_scroll_to_top_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'footer_builder', 'scroll-to-top' );

                // enqueue inline style
                ob_start();
                    // site colors
                    online_newspaper_assign_variable( 'theme_color', '--online-newspaper-global-preset-theme-color' );
                    online_newspaper_preset_color_css( 'solid_color_preset', '--online-newspaper-global-preset-color-' );
                    online_newspaper_preset_color_css( 'gradient_color_preset', '--online-newspaper-global-preset-gradient-color-' );

                    // Mobile Menu
                    online_newspaper_color_css( 'mobile_canvas_icon_color', 'body.online-newspaper-light-mode .site .toggle-button-wrapper .canvas-menu-icon', 'color' );
                    online_newspaper_color_css( 'mobile_canvas_text_color', 'body.online-newspaper-light-mode .main-navigation.toggled #header-menu li > a, body.online-newspaper-light-mode nav.main-navigation.toggled ul.menu > li > a, body.online-newspaper-light-mode nav.main-navigation.toggled ul.nav-menu > li > a', 'color' );
                    online_newspaper_color_css( 'mobile_canvas_background', ' nav.main-navigation.toggled ul.menu, nav.main-navigation.toggled ul.nav-menu' );

                    online_newspaper_visibility_options( 'header_ads_banner_responsive_option', '.ads-banner' );
                    online_newspaper_visibility_options( 'stt_responsive_option', 'body #online-newspaper-scroll-to-top.show' );

                    // Widget Styles
                    online_newspaper_border_option( 'widgets_styles_image_border', '.widget .post_thumb_image, .widget .opinions-items-wrap .opinion-item figure, .widget .widget-tabs-content .post-thumb, .widget .popular-posts-wrap article .post-thumb, .widget.widget_online_newspaper_news_filter_tabbed_widget .tabs-content-wrap .post-thumb, .widget .online-newspaper-widget-carousel-posts .post-thumb-wrap, .author-wrap.layout-two .post-thumb, .widget_online_newspaper_category_collection_widget .categories-wrap .category-item, .widget .online-newspaper-advertisement-block img', 'border' );
                    online_newspaper_value_change_responsive( 'widgets_styles_image_border_radius', '.widget .post_thumb_image, .widget .opinions-items-wrap .opinion-item figure, .widget .widget-tabs-content .post-thumb, .widget .popular-posts-wrap article .post-thumb, .widget.widget_online_newspaper_news_filter_tabbed_widget .tabs-content-wrap .post-thumb, .widget .online-newspaper-widget-carousel-posts .post-thumb-wrap, .author-wrap.layout-two .post-thumb, .widget .online-newspaper-widget-carousel-posts.layout--two .slick-list, .widget_online_newspaper_category_collection_widget .categories-wrap .category-item, .widget .online-newspaper-advertisement-block img', 'border-radius' );
                    online_newspaper_box_shadow_styles( 'widgets_styles_image_box_shadow', '.widget .post_thumb_image, .widget .opinions-items-wrap .opinion-item figure, .widget .widget-tabs-content .post-thumb, .widget .popular-posts-wrap article .post-thumb, .widget.widget_online_newspaper_news_filter_tabbed_widget .tabs-content-wrap .post-thumb, .widget .online-newspaper-widget-carousel-posts.layout--two .slick-list, .author-wrap.layout-two .post-thumb, .widget_online_newspaper_category_collection_widget .categories-wrap .category-item, .widget .online-newspaper-advertisement-block img' );

                    // Website Layout
                    if( $website_layout === 'boxed--layout' ) :
                        online_newspaper_color_css( 'website_layout_background_color', 'body .site' );
                        online_newspaper_box_shadow_styles( 'website_box_shadow', 'body.site-boxed--layout #page.site' );
                        online_newspaper_responsive_range_css( 'website_layout_horizontal_gap', 'body #page.site', 'margin-inline' );
                        online_newspaper_responsive_range_css( 'website_layout_vertical_gap', 'body #page.site', 'margin-top' );
                        online_newspaper_responsive_range_css( 'website_layout_vertical_gap', 'body #page.site', 'margin-bottom' );

                    endif;
                    online_newspaper_typography_control( 'site_block_title_typo', "--block-title" );

                    // Global button
                    if( ( is_archive() || is_date() || is_search() || is_home() || is_front_page() ) && $archive_post_element_order[ 'button' ] ) :
                        online_newspaper_typography_control( 'global_button_typo', "--post-link-btn" );
                    endif;

                    // category Colors
                    online_newspaper_typography_control( 'global_category_typography', "--category" );
                    online_newspaper_category_colors_styles();

                    // Global Typography
                    online_newspaper_typography_preset();
                    online_newspaper_typography_control( 'site_post_title_typo', "--post-title" );
                    online_newspaper_typography_control( 'site_post_meta_typo', "--meta" );
                    online_newspaper_typography_control( 'site_post_content_typo', "--content" );

                    // Header Builder
                    online_newspaper_color_css( 'header_builder_background', 'body.online-newspaper-light-mode .site .site-header' );

                    // Header Builder 1st Row
                    online_newspaper_color_css( 'header_first_row_background', 'body.online-newspaper-light-mode .site .site-header .row-one.full-width, body.online-newspaper-light-mode .site .site-header .row-one .full-width' );

                    // Header Builder 2nd Row
                    online_newspaper_color_css( 'header_second_row_background', 'body.online-newspaper-light-mode .site .site-header .row-two.full-width, body.online-newspaper-light-mode .site .site-header .row-two .full-width' );

                    // Header Builder 3rd Row
                    online_newspaper_color_css( 'header_third_row_background', 'body.online-newspaper-light-mode .site .site-header .row-three.full-width, body.online-newspaper-light-mode .site .site-header .row-three .full-width' );

                    // Secondary Menu Options
                    if( $header_secondary_menu_option || $hr_secondary_menu_option ) :
                        online_newspaper_typography_control( 'secondary_menu_typo', 'body .site header.site-header .top-nav-menu:not(.use-primary) ul li a', false );
                        online_newspaper_color_css( 'secondary_menu_color', 'body.online-newspaper-variables.online-newspaper-light-mode', '--secondary-menu-color' );
                    endif;

                    // Site logo and Title
                    if( $header_site_logo_option || $hr_site_logo_option ) :
                        if( get_theme_mod( 'custom_logo' ) ) online_newspaper_responsive_range_css( 'site_logo_width', "body .site-header .site-branding img" );
                        online_newspaper_typography_control( 'site_title_typo', "--site-title" );
                        online_newspaper_typography_control( 'site_tagline_typo', "--site-tagline" );
                    endif;

                    // Off canvas
                    if( $header_off_canvas_option || $hr_site_logo_option ) online_newspaper_color_css( 'canvas_menu_icon_color', 'body.online-newspaper-variables.online-newspaper-light-mode', '--sidebar-toggle-color' );

                    // Primary Menu Options
                    if( $header_menu_option || $hr_menu_option ) :
                        online_newspaper_typography_control( 'header_menu_typo', "--menu" );
                        online_newspaper_typography_control( 'header_sub_menu_typo', "--submenu" );
                        online_newspaper_color_css( 'header_menu_color', 'body.online-newspaper-variables.online-newspaper-light-mode', '--menu-color' );
                        online_newspaper_color_css( 'header_sub_menu_color', 'body.online-newspaper-variables.online-newspaper-light-mode', '--menu-color-submenu' );
                    endif;

                    // Random News
                    if( $header_random_news_option || $hr_random_news_option ) :
                        online_newspaper_typography_control( 'random_news_typography', ".site .site-header .random-news-element a", false );
                        online_newspaper_color_css( 'random_news_label_color', 'body.online-newspaper-variables.online-newspaper-light-mode', '--random-news-color' );
                    endif;

                    // Header Search
                    if( $header_search_option || $hr_search_option ) :
                        online_newspaper_responsive_range_css( 'search_icon_size', '.site .site-header .search-wrap .search-action i', 'font-size' );
                        online_newspaper_color_css( 'search_icon_color', 'body.online-newspaper-variables.online-newspaper-light-mode', '--search-color' );
                    endif;

                    // Custom Button
                    if( $header_custom_button_option || $hr_custom_button_option ) :
                        online_newspaper_responsive_range_css( 'custom_button_icon_size', "body.online-newspaper-variables", '--custom-btn-icon-size' );
                        online_newspaper_typography_control( 'custom_button_text_typo', "--custom-btn" );
                        online_newspaper_color_css( 'custom_button_color_group', 'body.online-newspaper-variables.online-newspaper-light-mode', '--custom-btn-color' );
                    endif;

                    // Newsletter / subscribe button
                    if( $header_newsletter_option || $hr_newsletter_option ) :
                        online_newspaper_color_css( 'header_newsletter_label_color', 'body.online-newspaper-variables.online-newspaper-light-mode', '--newsletter-color' );
                        online_newspaper_typography_control( 'header_newsletter_typography', '.site .site-header .newsletter-element a', false );
                    endif;

                    // Date Time
                    if( $header_date_time_option || $hr_date_time_option ) :
                        online_newspaper_typography_control( 'date_time_typography', ".site .site-header .top-date-time .top-date-time-inner", false );
                        online_newspaper_color_css( 'date_color', 'body.online-newspaper-variables.online-newspaper-light-mode', '--top-header-date-color' );
                        online_newspaper_color_css( 'time_color', 'body.online-newspaper-variables.online-newspaper-light-mode', '--top-header-time-color' );
                    endif;

                    // Theme Mode
                    if( $header_theme_mode_option || $hr_theme_mode_option ) :
                        online_newspaper_color_css( 'theme_mode_light_icon_color', 'body.online-newspaper-light-mode .site-header .mode-toggle .light','color' );
                        online_newspaper_color_css( 'theme_mode_dark_icon_color', 'body.online-newspaper-dark-mode .site-header .mode-toggle .dark','color' );
                    endif;

                    // Ticker News Section
                    if( $header_ticker_news_option || $hr_ticker_news_option ) :
                        online_newspaper_color_css( 'ticker_news_background_color_group', 'body.online-newspaper-light-mode .site #online-newspaper-ticker-news' );
                        online_newspaper_color_css( 'ticker_news_title_color', '.site .ticker-news-wrap.online-newspaper-ticker .ticker-item h2.post-title a', 'color' );
                        online_newspaper_color_css( 'ticker_news_date_color', '.site .ticker-item-wrap .post-date a, .ticker-item-wrap span.post-date:before ', 'color' );
                        online_newspaper_border_option( 'ticker_news_border', 'body .site #online-newspaper-ticker-news', 'border' );
                        online_newspaper_number_control( 'ticker_section_border_radius', 'body #online-newspaper-ticker-news .feature_image , body .site #online-newspaper-ticker-news', 'border-radius' );
                    endif;

                    // Sticky Posts
                    if( $sticky_posts_option ) :
                        online_newspaper_typography_control( 'sticky_posts_label_typography', "body .online-newspaper-sticky-posts .label-wrapper .label", false );
                        online_newspaper_typography_control( 'sticky_posts_title_typography', "body .online-newspaper-sticky-posts .post-list article .post-content .post-title", false );
                    endif;

                    // Main Banner
                    if( $homepage_content_order[ 'main_banner_section' ] ) :
                        online_newspaper_color_css( 'main_banner_background_color_group', 'body.online-newspaper-light-mode .site #main-banner-section' );
                        online_newspaper_border_option( 'main_banner_section_border', 'body .site #main-banner-section', 'border' );
                        online_newspaper_number_control( 'main_banner_section_border_radius', 'body.online-newspaper-light-mode .site #main-banner-section, body #main-banner-section:not(.banner-layout--one):not(.banner-layout--two):not(.banner-layout--five) article, .banner-layout--five .main-banner-wrap article, .banner-layout--five .grid-posts-wrap article, .banner-layout--five .list-posts-wrap article:first-child, .banner-layout--five .list-posts-wrap article:not(:first-child) .post-thumb, body #main-banner-section .row > div', 'border-radius' );
                    endif;

                    // Web stories
                    if( $homepage_content_order[ 'web_stories_section' ] ) :
                        online_newspaper_color_css( 'web_stories_background_color_group', 'body.online-newspaper-light-mode .site .online-newspaper-web-stories' );
                        online_newspaper_border_option( 'web_stories_section_border', 'body .site .online-newspaper-web-stories', 'border' );
                        online_newspaper_number_control( 'web_stories_section_border_radius', 'body .online-newspaper-web-stories .preview-thumb, body .site .online-newspaper-web-stories, body .site .online-newspaper-web-stories.card--on .row', 'border-radius' );
                        online_newspaper_image_ratio( 'web_stories_image_ratio', 'body .online-newspaper-web-stories .stories-wrap .preview:before' );
                        online_newspaper_typography_control( 'web_stories_preview_count_typo', ".site .online-newspaper-web-stories .stories-wrap .preview .story-count", false );
                        online_newspaper_typography_control( 'web_stories_preview_title_typo', ".site .online-newspaper-web-stories .stories-wrap .story-title", false );
                        online_newspaper_typography_control( 'web_stories_title_typo', ".site .online-newspaper-web-stories .inner-stories-wrap .content-wrap .title", false );
                    endif;

                    // Full widget section
                    if( $homepage_content_order[ 'full_width_section' ] ) :
                        online_newspaper_color_css( 'full_width_blocks_background_color_group', 'body.online-newspaper-light-mode .site #full-width-section' );
                        online_newspaper_border_option( 'full_width_section_border', 'body .site #full-width-section', 'border' );
                        online_newspaper_number_control( 'full_width_section_border_radius', 'body #full-width-section, body .site #full-width-section .post-thumb-wrap, body .site #full-width-section.card--on .row > div', 'border-radius' );
                    endif;

                    // Left content - right sidebar
                    if( $homepage_content_order[ 'leftc_rights_section' ] ) :
                        online_newspaper_color_css( 'leftc_rights_blocks_background_color_group', 'body.online-newspaper-light-mode .site #leftc-rights-section' );
                        online_newspaper_border_option( 'leftc_rights_section_border', 'body .site #leftc-rights-section', 'border' );
                        online_newspaper_number_control( 'leftc_rights_section_border_radius', 'body #leftc-rights-section, body .site #leftc-rights-section .post-thumb-wrap , body .site #leftc-rights-section.card--on .row > div', 'border-radius' );

                        online_newspaper_color_css( 'leftc_rights_sidebar_background_color_group', 'body.online-newspaper-light-mode .site #leftc-rights-section .secondary-sidebar ' );
                        online_newspaper_border_option( 'leftc_rights_sidebar_section_border', 'body .site #leftc-rights-section .secondary-sidebar', 'border' );
                        online_newspaper_number_control( 'leftc_rights_section_sidebar_border_radius', 'body .site #leftc-rights-section .secondary-sidebar ', 'border-radius' );
                        online_newspaper_spacing_control( 'leftc_rights_section_sidebar_padding', 'body .site #leftc-rights-section .secondary-sidebar', 'padding' );
                    endif;

                    // Left sidebar - right content
                    if( $homepage_content_order[ 'lefts_rightc_section' ] ) :
                        online_newspaper_color_css( 'lefts_rightc_blocks_background_color_group', 'body.online-newspaper-light-mode .site #lefts-rightc-section' );
                        online_newspaper_border_option( 'lefts_rightc_section_border', 'body .site #lefts-rightc-section', 'border' );
                        online_newspaper_number_control( 'lefts_rightc_section_border_radius', 'body #lefts-rightc-section, body .site #lefts-rightc-section .post-thumb-wrap , body .site #lefts-rightc-section.card--on .row > div', 'border-radius' );

                        online_newspaper_color_css( 'lefts_rightc_sidebar_background_color_group', 'body.online-newspaper-light-mode .site #lefts-rightc-section .secondary-sidebar ' );
                        online_newspaper_border_option( 'lefts_rightc_sidebar_section_border', 'body .site #lefts-rightc-section .secondary-sidebar', 'border' );
                        online_newspaper_number_control( 'lefts_rightc_section_sidebar_border_radius', 'body .site #lefts-rightc-section .secondary-sidebar ', 'border-radius' );
                        online_newspaper_spacing_control( 'lefts_rightc_section_sidebar_padding', 'body .site #lefts-rightc-section .secondary-sidebar', 'padding' );
                    endif;

                    // Bottom full width
                    if( $homepage_content_order[ 'bottom_full_width_section' ] ) :
                        online_newspaper_color_css( 'bottom_full_width_blocks_background_color_group', 'body.online-newspaper-light-mode .site #bottom-full-width-section' );
                        online_newspaper_border_option( 'bottom_full_width_section_border', 'body .site #bottom-full-width-section', 'border' );
                        online_newspaper_number_control( 'bottom_full_width_section_border_radius', 'body #bottom-full-width-section, body .site #bottom-full-width-section .post-thumb-wrap , body .site #bottom-full-width-section.card--on .row > div', 'border-radius' );
                    endif;

                    // Two column section
                    if( $homepage_content_order[ 'two_column_section' ] ) :
                        online_newspaper_color_css( 'two_column_background_color_group', 'body.online-newspaper-light-mode .site #two-column-section' );
                        online_newspaper_border_option( 'two_column_section_border', 'body .site #two-column-section', 'border' );
                        online_newspaper_number_control( 'two_column_section_border_radius', 'body #two-column-section, body .site #two-column-section .post-thumb-wrap , body .site #two-column-section.card--on .row > div', 'border-radius' );
                    endif;

                    // Archive || Latest Posts
                    if( ( is_home() || is_front_page() || is_archive() || is_search() || is_date() ) && $homepage_content_order[ 'latest_posts' ] ) :
                        online_newspaper_image_ratio_variable( 'archive_image_ratio', '--online-newspaper-archive-image-ratio' );

                        online_newspaper_color_css( 'archive_color_group', 'body.online-newspaper-light-mode .site #theme-content' );
                        online_newspaper_border_option( 'archive_section_border', 'body .site #theme-content', 'border' );
                        online_newspaper_number_control( 'archive_border_radius', 'body #theme-content, body .site #theme-content .post-thumb-wrap, body .site #theme-content.card--on .row > div', 'border-radius' );
                    endif;

                    online_newspaper_color_css( 'sidebar_background', 'body.online-newspaper-light-mode .site #theme-content .widget-area' );
                    online_newspaper_border_option( 'sidebar_border', ' body .site #theme-content .widget-area', 'border' );
                    online_newspaper_number_control( 'sidebar_border_radius', 'body #theme-content .widget-area ', 'border-radius' );
                    online_newspaper_spacing_control( 'sidebar_padding', 'body #theme-content .widget-area ', 'padding' );

                    // Pagination Settings
                    online_newspaper_get_pagination_text_color();

                    // Single
                    if( is_single() ) :
                        online_newspaper_image_ratio_variable( 'single_post_image_ratio', '--online-newspaper-single-image-ratio' );
                        online_newspaper_typography_control( 'single_post_title_typo', "--single-title" );
                        online_newspaper_typography_control( 'single_post_meta_typo', "--single-meta" );
                        online_newspaper_typography_control( 'single_post_content_typo', "--single-content" );
                    endif;

                    // Page
                    if( is_page() ) online_newspaper_image_ratio_variable( 'page_image_ratio', '--online-newspaper-page-image-ratio' );

                    // Footer builder
                    online_newspaper_color_css( 'footer_builder_background', 'body.online-newspaper-light-mode footer.site-footer ' );
                    online_newspaper_typography_control( 'footer_title_typography', '.site .site-footer h2.online-newspaper-block-title, .site .site-footer h2.online-newspaper-block-title span, .site .site-footer h2.widget-title span, .site .site-footer h2.online-newspaper-widget-title span', false );
                    online_newspaper_typography_control( 'footer_text_typography', '.site-footer .post-item .post-element .post-title a, .site-footer .widget_online_newspaper_opinions_widget .your-opinions-block-widget .opinion-content .post-title a, .site-footer .widget .posts-wrap .post-item .post-title a ', false );

                    // Footer Builder 1st Row
                    online_newspaper_color_css( 'footer_first_row_background', 'body.online-newspaper-light-mode .site-footer .bb-bldr--normal .row-one.full-width, body.online-newspaper-light-mode .site-footer .bb-bldr--normal .row-one .full-width' );

                    // Footer Builder 2nd Row
                    online_newspaper_color_css( 'footer_second_row_background', 'body.online-newspaper-light-mode .site-footer .bb-bldr--normal .row-two.full-width, body.online-newspaper-light-mode .site-footer .bb-bldr--normal .row-two .full-width' );

                    // Footer Builder 3rd Row
                    online_newspaper_color_css( 'footer_third_row_background', 'body.online-newspaper-light-mode .site-footer .bb-bldr--normal .row-three.full-width, body.online-newspaper-light-mode .site-footer .bb-bldr--normal .row-three .full-width' );

                    // Footer Menu
                    if( $footer_menu_option ) :
                        online_newspaper_typography_control( 'footer_menu_typography', '.site footer.site-footer .bb-bldr-widget:not(.has-sidebar) .menu li a', False );
                        online_newspaper_color_css( 'footer_menu_color', 'body.online-newspaper-light-mode .site footer.site-footer .bb-bldr-widget:not(.has-sidebar) .menu li a', 'color' );
                    endif;

                    // Copyright
                    if( $footer_copyright_option ) online_newspaper_typography_control( 'bottom_footer_text_typography', 'footer.site-footer .site-info', False );

                    // Footer Logo
                    if( $footer_logo_option ) online_newspaper_responsive_range_css( 'bottom_footer_logo_width', '.site .site-footer .footer-logo img ', 'width' );

                    // Scroll to Top
                    if( $footer_scroll_to_top_option ) online_newspaper_color_css( 'stt_color_group', 'body.online-newspaper-variables', '--move-to-top-color' );

                    // Site Background
                    online_newspaper_color_css( 'site_background_color', 'body.online-newspaper-variables', '--site-bk-color' );

                    // front sections image settings styles
                $current_styles = ob_get_clean();
                return apply_filters( 'online_newspaper_current_styles', wp_strip_all_tags( online_newspaper_minifyCSS( $current_styles ) ) );
            }
        }
        new Cache_Manager();
    }