<?php
use OnlineNewspaper\CustomizerDefault as ONP;
/**
 * Class that handles everything related to customizer
 * 
 * @since 1.0.0
 * @package Online Newspaper
 */
 require get_template_directory() . '/inc/customizer/helpers.php';
 if( ! class_exists( 'Online_Newspaper_Customizer' ) ) :
    class Online_Newspaper_Customizer extends Online_Newspaper_Customizer_List {
        /**
         * Instance of this class
         * 
        * @since 1.0.0
        */
        private static $_instance = null;

        /**
         * customizer variable
         * 
        * @since 1.0.0
        */
        protected $customize;

        /**
         * Has current Section id
         * 
         * @since 1.0.0
         */
        public $section;

        /**
         * Holds current tab
         * 
         * @since 1.0.0
         */
        public $tab = 'general';

        /**
         * Creates only one instance of class
         * 
         * @since 1.0.0
         */
        static function instance( $wp_customize ) {
            if( is_null( self::$_instance ) ) self::$_instance = new self( $wp_customize );
            return self::$_instance;
        }

        /**
         * Function that gets called when class is instantiated
         * 
         * @since 1.0.0
         */
        public function __construct( $wp_customize ) {
            $this->customize = $wp_customize;
            $this->customize();
            $this->register();
        }

        /**
         * Function to customizer predefined panels, sections and controls
         * 
         * @since 1.0.0
         */
        public function customize() {
            $this->customize->get_section( 'title_tagline' )->title = esc_html__( 'Site Identity', 'online-newspaper' );
            $this->customize->get_control( 'custom_logo' )->priority = 10;
            $this->customize->get_control( 'site_icon' )->priority = 20;
            $this->customize->get_control( 'header_textcolor' )->section = 'title_tagline';
            $this->customize->get_control( 'header_textcolor' )->priority = 20;
            $this->customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Title Color', 'online-newspaper' );
            $this->customize->get_control( 'blogname' )->section = 'title_tagline';
            $this->customize->get_control( 'blogname' )->priority = 30;
            $this->customize->get_control( 'blogdescription' )->section = 'title_tagline';
            $this->customize->get_control( 'blogdescription' )->priority = 30;
            $this->customize->get_control( 'display_header_text' )->section = 'title_tagline';
            $this->customize->get_control( 'display_header_text' )->label = esc_html__( 'Display site title', 'online-newspaper' );
            $this->customize->get_control( 'display_header_text' )->priority = 40;
        }

        /**
         * Register panels, sections and control in the customizer
         * 
         * @since 1.0.0
         */
        protected function register() {
            // MARK: About theme section
            $this->add_section( 'about_section' );
            $this->add_control( 'site_documentation_info', 'info_box' );
            $this->add_control( 'site_support_info', 'info_box' );
            // MARK: Global Panel
            $this->add_panel( 'global_panel' );
            // MARK: SEO / Misc
            $this->add_section( 'seo_misc_section' );
            $this->add_control( 'site_schema_ready', 'toggle' );
            $this->add_control( 'site_date_to_show', 'select' );
            $this->add_control( 'site_date_format', 'select' );
            $this->add_control( 'words_to_read_per_minute', 'predefined_number' );
            $this->add_control( 'disable_admin_notices_heading', 'section_heading' );
            $this->add_control( 'disable_admin_notices', 'toggle' );
            // MARK: Preloader
            $this->add_section( 'preloader_section' );
            $this->add_control( 'preloader_option', 'toggle' );
            $this->add_control( 'preloader_type', 'select' );
            // MARK: Widget styles
            $this->add_section( 'widget_styles_section' );
            $this->add_control( 'widgets_styles_image_settings_heading', 'section_heading' );
            $this->add_control( 'widgets_styles_image_border', 'border' );
            $this->add_control( 'widgets_styles_image_border_radius', 'number' );
            $this->add_control( 'widgets_styles_image_box_shadow', 'box_shadow' );
            // MARK: Website Layout
            $this->add_section( 'website_layout_section' );
            $this->add_control( 'website_layout_header', 'section_heading' );
            $this->add_control( 'website_layout', 'radio_image' );
            $this->add_control( 'website_layout_container_setting_heading', 'section_heading' );
            $this->add_control( 'website_layout_background_color', 'color' );
            $this->add_control( 'website_box_shadow', 'box_shadow' );
            $this->add_control( 'website_layout_horizontal_gap', 'number' );
            $this->add_control( 'website_layout_vertical_gap', 'number' );
            $this->add_control( 'website_content_layout_header', 'section_heading' );
            $this->add_control( 'website_content_layout', 'radio_image' );
            // MARK: Animation / Hover Effect
            $this->add_section( 'animation_section' );
            $this->add_control( 'post_title_hover_effects', 'select' );
            $this->add_control( 'site_image_hover_effects', 'select' );
            $this->add_control( 'cursor_animation', 'select' );
            // MARK: Social Icons
            $this->add_section( 'social_icons_section' );
            $this->add_control( 'social_icons', 'custom_repeater' );
            // MARK: Buttons
            $this->add_section( 'buttons_section' );
            $this->add_control( 'global_button_redirect', 'redirect_control' );
            $this->add_control( 'global_button_label', 'text' );
            $this->add_control( 'global_button_typo', 'typography' );
            // MARK: Sidebar Options
            $this->add_section( 'sidebar_options_section' );
            $this->add_control( 'frontpage_sidebar_section_tab', 'section_tab' );
            $this->add_control( 'frontpage_sidebar_layout_header', 'section_heading' );
            $this->add_control( 'frontpage_sidebar_layout', 'radio_image' );
            $this->add_control( 'frontpage_sidebar_sticky_option', 'simple_toggle' );
            $this->add_control( 'archive_sidebar_layout_header', 'section_heading' );
            $this->add_control( 'archive_sidebar_layout', 'radio_image' );
            $this->add_control( 'archive_sidebar_sticky_option', 'simple_toggle' );
            $this->add_control( 'single_sidebar_layout_header', 'section_heading' );
            $this->add_control( 'single_sidebar_layout', 'radio_image' );
            $this->add_control( 'single_sidebar_sticky_option', 'simple_toggle' );
            $this->add_control( 'page_sidebar_layout_header', 'section_heading' );
            $this->add_control( 'page_sidebar_layout', 'radio_image' );
            $this->add_control( 'page_sidebar_sticky_option', 'simple_toggle' );
            $this->tab = 'design';
            $this->add_control( 'sidebar_background', 'color' );
            $this->add_control( 'sidebar_border', 'border' );
            $this->add_control( 'sidebar_border_radius', 'predefined_number' );
            $this->add_control( 'sidebar_padding', 'spacing' );
            // MARK: Breadcrumb Options
            $this->add_section( 'breadcrumb_options_section' );
            $this->add_control( 'site_breadcrumb_option', 'simple_toggle' );
            $this->add_control( 'site_breadcrumb_type', 'select' );
            // MARK: Site Logo & Title
            $this->section = 'title_tagline';
            $this->add_control( 'site_title_section_tab', 'section_tab' );
            $this->add_control( 'logo_and_icon_section_toggle', 'section_heading_toggle' );
            $this->add_control( 'site_logo_width', 'number' );
            $this->add_control( 'site_title_section_toggle', 'section_heading_toggle' );
            $this->add_control( 'site_title_tag_for_frontpage', 'select' );
            $this->add_control( 'site_title_tag_for_innerpage', 'select' );
            $this->add_control( 'blogdescription_option', 'checkbox' );
            $this->tab = 'design';
            $this->add_control( 'site_title_typo', 'typography' );
            $this->add_control( 'site_tagline_typo', 'typography' );
            $this->add_control( 'site_title_hover_textcolor', 'predefined_color' );
            $this->add_control( 'site_description_color', 'predefined_color' );
            // MARK: Colors Panel
            $this->add_panel( 'colors_panel' );
            // MARK: Theme Colors / Preset
            $this->add_section( 'theme_presets_section' );
            $this->add_control( 'theme_color', 'preset_color' );
            $this->add_control( 'solid_color_preset', 'preset' );
            $this->add_control( 'gradient_color_preset', 'preset' );
            // MARK: Category Colors
            $this->add_section( 'category_colors_section' );
            $this->add_control( 'category_colors_section_tab', 'section_tab' );
            $this->add_control( 'global_category_typography', 'typography' );
            $this->tab = 'design';
            $this->add_control( 'category_colors', 'term_colors' );
            // MARK: Advertisement Section
            $this->add_section( 'advertisement_section' );
            $this->add_control( 'advertisement_repeater', 'custom_repeater' );
            // MARK: Typography Section
            $this->add_section( 'typography_section' );
            $this->add_control( 'typography_presets', 'typography_preset' );
            $this->add_control( 'site_block_title_typo', 'typography' );
            $this->add_control( 'site_post_title_typo', 'typography' );
            $this->add_control( 'site_post_meta_typo', 'typography' );
            $this->add_control( 'site_post_content_typo', 'typography' );
            // MARK: Date Time
            $this->add_section( 'date_time_section' );
            $this->add_control( 'date_time_section_tab', 'section_tab' );
            $this->add_control( 'time_option', 'simple_toggle' );
            $this->add_control( 'date_option', 'simple_toggle' );
            $this->add_control( 'date_time_display_block', 'simple_toggle' );
            $this->tab = 'design';
            $this->add_control( 'date_time_typography', 'typography' );
            $this->add_control( 'date_color', 'color' );
            $this->add_control( 'time_color', 'color' );
            // MARK: Menu Options Section
            $this->add_section( 'header_menu_options_section' );
            $this->add_control( 'menu_options_section_tab', 'section_tab' );
            $this->add_control( 'header_menu_hover_effect', 'select' );
            $this->tab = 'design';
            $this->add_control( 'header_menu_typo', 'typography' );
            $this->add_control( 'header_sub_menu_typo', 'typography' );
            $this->add_control( 'header_main_menu_header', 'section_heading' );
            $this->add_control( 'header_menu_color', 'color' );
            $this->add_control( 'header_sub_menu_header', 'section_heading' );
            $this->add_control( 'header_sub_menu_color', 'color' );
            // MARK: Live Search Section
            $this->add_section( 'header_live_search_section' );
            $this->add_control( 'search_section_tab', 'section_tab' );
            $this->add_control( 'search_icon_size', 'number' );
            $this->tab = 'design';
            $this->add_control( 'search_icon_color', 'color' );
            // MARK: Newsletter / Subscribe Button
            $this->add_section( 'header_newsletter_section' );
            $this->add_control( 'subscribe_button_section_tab', 'section_tab' );
            $this->add_control( 'newsletter_label', 'text' );
            $this->add_control( 'header_newsletter_redirect_href_link', 'url' );
            $this->add_control( 'header_newsletter_hover_animation', 'select' );
            $this->tab = 'design';
            $this->add_control( 'header_newsletter_typography', 'typography' );
            $this->add_control( 'header_newsletter_label_color', 'color' );
            // MARK: Theme Mode Section
            $this->add_section( 'theme_mode_section' );
            $this->add_control( 'theme_mode_section_tab', 'section_tab' );            
            $this->add_control( 'theme_mode_dark_icon', 'icon_picker' );
            $this->add_control( 'theme_mode_light_icon', 'icon_picker' );
            $this->tab = 'design';
            $this->add_control( 'theme_mode_dark_icon_color', 'color' );
            $this->add_control( 'theme_mode_light_icon_color', 'color' );
            // MARK: Canvas Menu Section
            $this->add_section( 'canvas_menu_section' );
            $this->add_control( 'canvas_menu_setting', 'section_tab' );
            $this->add_control( 'off_canvas_position', 'radio_tab' );
            $this->add_control( 'canvas_menu_redirects', 'redirect_control' );
            $this->tab = 'design';
            $this->add_control( 'canvas_menu_icon_color', 'color' );
            // MARK: Advertisement Banner Section
            $this->add_section( 'header_advertisement_banner_section' );
            $this->add_control( 'header_ads_banner_responsive_option', 'responsive_multiselect_tab' );
            $this->add_control( 'header_ads_banner_image', 'media' );
            $this->add_control( 'header_ads_banner_image_link_url', 'simple_toggle' );
            $this->add_control( 'header_ads_banner_image_url', 'url' );
            $this->add_control( 'header_ads_banner_custom_target', 'radio_tab' );
            $this->add_control( 'header_ads_banner_image_rel_attr', 'select' );
            // MARK: Random News
            $this->add_section( 'random_news_section' );
            $this->add_control( 'random_news_section_tab', 'section_tab' );
            $this->add_control( 'random_news_label', 'text' );
            $this->tab = 'design';
            $this->add_control( 'random_news_typography', 'typography' );
            $this->add_control( 'random_news_label_color', 'color' );
            // MARK: Custom Button
            $this->add_section( 'custom_button_section' );
            $this->add_control( 'custom_button_section_tab', 'section_tab' );
            $this->add_control( 'custom_button_label', 'text' );
            $this->add_control( 'custom_button_link', 'url' );
            $this->add_control( 'custom_button_icon_size', 'number' );
            $this->tab = 'design';
            $this->add_control( 'custom_button_text_typo', 'typography' );
            $this->add_control( 'custom_button_color_group', 'color' );
            // MARK: Sticky Posts
            $this->add_section( 'sticky_posts_section' );
            $this->add_control( 'sticky_posts_section_heading', 'section_tab' );
            $this->add_control( 'sticky_posts_option', 'toggle' );
            $this->add_control( 'sticky_posts_position', 'radio_tab' );
            $this->add_control( 'sticky_posts_posts_to_append', 'predefined_number' );
            $this->add_control( 'sticky_posts_posts_query_section_toggle', 'section_heading_toggle' );
            $this->add_control( 'sticky_posts_categories', 'multiselect' );
            $this->add_control( 'sticky_posts_to_include', 'multiselect' );
            $this->add_control( 'sticky_posts_order', 'select' );
            $this->add_control( 'sticky_posts_to_show', 'predefined_number' );
            $this->add_control( 'sticky_hide_empty', 'simple_toggle' );
            $this->tab = 'design';
            $this->add_control( 'sticky_posts_label_typography', 'typography' );
            $this->add_control( 'sticky_posts_title_typography', 'typography' );
            // MARK: Ticker News Section
            $this->add_section( 'ticker_news_section' );
            $this->add_control( 'ticker_news_section_heading', 'section_tab' );
            $this->add_control( 'ticker_news_frontpage', 'simple_toggle' );
            $this->add_control( 'ticker_news_content_header', 'section_heading' );
            $this->add_control( 'ticker_news_order_by', 'select' );
            $this->add_control( 'ticker_news_categories', 'multiselect' );
            $this->add_control( 'ticker_news_posts', 'multiselect' );
            $this->add_control( 'ticker_news_thumbnail_option', 'simple_toggle' );
            $this->add_control( 'ticker_news_numbers', 'predefined_number' );
            $this->tab = 'design';
            $this->add_control( 'ticker_news_width_layout', 'radio_image' );
            $this->add_control( 'ticker_news_title_color', 'color' );
            $this->add_control( 'ticker_news_date_color', 'color' );
            $this->add_control( 'ticker_section_settings_header', 'section_heading' );
            $this->add_control( 'ticker_news_background_color_group', 'color' );
            $this->add_control( 'ticker_news_border', 'border' );
            $this->add_control( 'ticker_section_border_radius', 'predefined_number' );
            $this->add_control( 'ticker_news_card_settings', 'section_heading' );
            $this->add_control( 'ticker_news_card_enable', 'simple_toggle' );
            // MARK: Main Banner Section
            $this->add_section( 'main_banner_section' );
            $this->add_control( 'main_banner_section_tab', 'section_tab' );
            $this->add_control( 'main_banner_list_posts_settings_header', 'section_heading' );
            $this->add_control( 'main_banner_list_posts_title', 'text' );
            $this->add_control( 'main_banner_list_posts_categories', 'multiselect' );
            $this->add_control( 'main_banner_list_posts_categories_option', 'simple_toggle' );
            $this->add_control( 'main_banner_list_posts_date_option', 'simple_toggle' );
            $this->add_control( 'main_banner_list_posts_author_option', 'simple_toggle' );
            $this->add_control( 'main_banner_slider_settings_header', 'section_heading' );
            $this->add_control( 'main_banner_slider_order_by', 'select' );
            $this->add_control( 'main_banner_slider_categories', 'multiselect' );
            $this->add_control( 'main_banner_posts', 'multiselect' );
            $this->add_control( 'main_banner_slider_categories_option', 'simple_toggle' );
            $this->add_control( 'main_banner_slider_date_option', 'simple_toggle' );
            $this->add_control( 'main_banner_grid_posts_settings_header', 'section_heading' );
            $this->add_control( 'main_banner_grid_posts_title', 'text' );
            $this->add_control( 'main_banner_grid_posts_categories', 'multiselect' );
            $this->add_control( 'main_banner_grid_posts_order_by', 'select' );
            $this->tab = 'design';
            $this->add_control( 'main_banner_width_layout_header', 'section_heading' );
            $this->add_control( 'main_banner_width_layout', 'radio_image' );
            $this->add_control( 'banner_section_three_column_order', 'item_sortable' );
            $this->add_control( 'main_banner_section_settings_header', 'section_heading' );
            $this->add_control( 'main_banner_background_color_group', 'color' );
            $this->add_control( 'main_banner_section_border', 'border' );
            $this->add_control( 'main_banner_section_border_radius', 'predefined_number' );
            $this->add_control( 'main_banner_card_settings', 'section_heading' );
            $this->add_control( 'main_banner_card_enable', 'simple_toggle' );
            // MARK: Front Sections
            $this->add_panel( 'frontpage_panel' );
            // MARK: Web Stories
            $this->add_section( 'web_stories_section' );
            $this->add_control( 'web_stories_section_tab', 'section_tab' );
            $this->add_control( 'web_stories_query_settings_heading_toggle', 'section_heading_toggle' );
            $this->add_control( 'web_stories_categories_to_include', 'multiselect' );
            $this->add_control( 'web_stories_orderby', 'select' );
            $this->add_control( 'web_stories_no_of_cats_to_show', 'predefined_number' );
            $this->add_control( 'web_stories_max_no_of_inner_stories', 'predefined_number' );
            $this->add_control( 'web_stories_image_settings', 'section_heading_toggle' );
            $this->add_control( 'web_stories_image_sizes', 'select' );
            $this->add_control( 'web_stories_image_ratio', 'number' );
            $this->tab = 'design';
            $this->add_control( 'web_stories_full_width_blocks_width_layout', 'radio_image' );
            $this->add_control( 'web_stories_preview_count_typo', 'typography' );
            $this->add_control( 'web_stories_preview_title_typo', 'typography' );
            $this->add_control( 'web_stories_title_typo', 'typography' );
            $this->add_control( 'web_stories_section_settings_header', 'section_heading' );
            $this->add_control( 'web_stories_background_color_group', 'color' );
            $this->add_control( 'web_stories_section_border', 'border' );
            $this->add_control( 'web_stories_section_border_radius', 'predefined_number' );
            $this->add_control( 'web_stories_card_settings', 'section_heading' );
            $this->add_control( 'web_stories_card_enable', 'simple_toggle' );
            // MARK: Full Width
            $this->add_section( 'full_width_section' );
            $this->add_control( 'full_width_section_tab', 'section_tab' );
            $this->add_control( 'full_width_blocks', 'block_repeater' );
            $this->tab = 'design';
            $this->add_control( 'full_width_blocks_width_layout_header', 'section_heading' );
            $this->add_control( 'full_width_blocks_width_layout', 'radio_image' );
            $this->add_control( 'full_width_section_settings_header', 'section_heading' );
            $this->add_control( 'full_width_blocks_background_color_group', 'color' );
            $this->add_control( 'full_width_section_border', 'border' );
            $this->add_control( 'full_width_section_border_radius', 'predefined_number' );
            $this->add_control( 'full_width_card_settings', 'section_heading' );
            $this->add_control( 'full_width_card_enable', 'simple_toggle' );
            // MARK: Left Content Right Sidebar
            $this->add_section( 'leftc_rights_section' );
            $this->add_control( 'leftc_rights_section_tab', 'section_tab' );
            $this->add_control( 'leftc_rights_section_sidebar_redirect', 'redirect_control' );
            $this->add_control( 'leftc_rights_blocks', 'block_repeater' );
            $this->tab = 'design';
            $this->add_control( 'leftc_rights_blocks_width_layout_header', 'section_heading' );
            $this->add_control( 'leftc_rights_blocks_width_layout', 'radio_image' );
            $this->add_control( 'leftc_rights_section_settings_header', 'section_heading' );
            $this->add_control( 'leftc_rights_blocks_background_color_group', 'color' );
            $this->add_control( 'leftc_rights_section_border', 'border' );
            $this->add_control( 'leftc_rights_section_border_radius', 'predefined_number' );
            $this->add_control( 'leftc_rights_card_settings', 'section_heading' );
            $this->add_control( 'leftc_rights_card_enable', 'simple_toggle' );
            $this->add_control( 'leftc_rights_section_sidebar_settings_header', 'section_heading' );
            $this->add_control( 'leftc_rights_sidebar_background_color_group', 'color' );
            $this->add_control( 'leftc_rights_sidebar_section_border', 'border' );
            $this->add_control( 'leftc_rights_section_sidebar_border_radius', 'predefined_number' );
            $this->add_control( 'leftc_rights_section_sidebar_padding', 'spacing' );
            // MARK: Left Sidebar Right Content
            $this->add_section( 'lefts_rightc_section' );
            $this->add_control( 'lefts_rightc_section_tab', 'section_tab' );
            $this->add_control( 'lefts_rightc_section_sidebar_redirect', 'redirect_control' );
            $this->add_control( 'lefts_rightc_blocks', 'block_repeater' );
            $this->tab = 'design';
            $this->add_control( 'lefts_rightc_blocks_width_layout_header', 'section_heading' );
            $this->add_control( 'lefts_rightc_blocks_width_layout', 'radio_image' );
            $this->add_control( 'lefts_rightc_section_settings_header', 'section_heading' );
            $this->add_control( 'lefts_rightc_blocks_background_color_group', 'color' );
            $this->add_control( 'lefts_rightc_section_border', 'border' );
            $this->add_control( 'lefts_rightc_section_border_radius', 'predefined_number' );
            $this->add_control( 'lefts_rightc_card_settings', 'section_heading' );
            $this->add_control( 'lefts_rightc_card_enable', 'simple_toggle' );
            $this->add_control( 'lefts_rightc_section_sidebar_settings_header', 'section_heading' );
            $this->add_control( 'lefts_rightc_sidebar_background_color_group', 'color' );
            $this->add_control( 'lefts_rightc_sidebar_section_border', 'border' );
            $this->add_control( 'lefts_rightc_section_sidebar_border_radius', 'predefined_number' );
            $this->add_control( 'lefts_rightc_section_sidebar_padding', 'spacing' );
            // MARK: Bottom Full Width
            $this->add_section( 'bottom_full_width_section' );
            $this->add_control( 'bottom_full_width_section_tab', 'section_tab' );
            $this->add_control( 'bottom_full_width_blocks', 'block_repeater' );
            $this->tab = 'design';
            $this->add_control( 'bottom_full_width_blocks_width_layout_header', 'section_heading' );
            $this->add_control( 'bottom_full_width_blocks_width_layout', 'radio_image' );
            $this->add_control( 'bottom_full_width_section_settings_header', 'section_heading' );
            $this->add_control( 'bottom_full_width_blocks_background_color_group', 'color' );
            $this->add_control( 'bottom_full_width_section_border', 'border' );
            $this->add_control( 'bottom_full_width_section_border_radius', 'predefined_number' );
            $this->add_control( 'bottom_full_width_card_settings', 'section_heading' );
            $this->add_control( 'bottom_full_width_card_enable', 'simple_toggle' );
            // MARK: 2 Column Section
            $this->add_section( 'two_column_section' );
            $this->add_control( 'two_column_section_tab', 'section_tab' );
            $this->add_control( 'two_column_first_column_blocks_header', 'section_heading' );
            $this->add_control( 'two_column_first_column_blocks', 'block_repeater' );
            $this->add_control( 'two_column_second_column_blocks_header', 'section_heading' );
            $this->add_control( 'two_column_second_column_blocks', 'block_repeater' );
            $this->tab = 'design';
            $this->add_control( 'two_column_section_layout_header', 'section_heading' );
            $this->add_control( 'two_column_section_layout', 'radio_image' );
            $this->add_control( 'two_column_settings_header', 'section_heading' );
            $this->add_control( 'two_column_background_color_group', 'color' );
            $this->add_control( 'two_column_section_border', 'border' );
            $this->add_control( 'two_column_section_border_radius', 'predefined_number' );
            $this->add_control( 'two_column_card_settings', 'section_heading' );
            $this->add_control( 'two_column_card_enable', 'simple_toggle' );
            // MARK: Reorder Sections
            $this->add_section( 'front_sections_reorder_section' );
            $this->add_control( 'homepage_content_order', 'item_sortable' );
            // MARK: Blog / Archives Panel
            $this->add_panel( 'archive_panel' );
            // General Settings Section
            $this->add_section( 'archive_general_section' );
            $this->add_control( 'archive_section_tab', 'section_tab' );
            $this->add_control( 'archive_page_layout_header', 'section_heading_toggle' );
            $this->add_control( 'archive_page_title_prefix', 'simple_toggle' );
            $this->add_control( 'archive_page_layout', 'radio_image' );
            $this->add_control( 'archive_page_elements_setting_header', 'section_heading_toggle' );
            $this->add_control( 'archive_page_category_option', 'simple_toggle' );
            $this->add_control( 'archive_post_element_order', 'item_sortable' );
            $this->add_control( 'archive_button_redirect', 'redirect_control' );
            $this->add_control( 'archive_post_meta_order', 'item_sortable' );
            $this->add_control( 'archive_image_settings_header', 'section_heading_toggle' );
            $this->add_control( 'archive_image_ratio', 'number' );
            $this->add_control( 'archive_image_size', 'select' );
            $this->tab = 'design';
            $this->add_control( 'archive_width_layout', 'radio_image' );
            $this->add_control( 'archive_settings_header', 'section_heading' );
            $this->add_control( 'archive_color_group', 'color' );
            $this->add_control( 'archive_section_border', 'border' );
            $this->add_control( 'archive_border_radius', 'predefined_number' );
            $this->add_control( 'archive_card_settings', 'section_heading' );
            $this->add_control( 'archive_card_enable', 'simple_toggle' );
            // MARK: Pagination
            $this->add_section( 'pagination_settings_section' );
            $this->add_control( 'archive_pagination_type', 'select' );
            $this->add_control( 'pagination_button_text_color', 'color' );
            $this->add_control( 'pagination_button_background_color', 'color' );
            //MARK: Single Post Panel
            $this->add_panel( 'single_section_panel' );
            //MARK: General Settings Section
            $this->add_section( 'single_general_settings' );
            $this->add_control( 'single_post_section_tab', 'section_tab' );
            $this->add_control( 'single_layout', 'radio_image' );
            $this->add_control( 'single_post_meta_order', 'item_sortable' );
            $this->add_control( 'single_post_show_original_image_option', 'simple_toggle' );
            $this->add_control( 'single_post_image_caption', 'simple_toggle' );
            $this->add_control( 'single_post_image_settings_header', 'section_heading' );
            $this->add_control( 'single_post_image_ratio', 'number' );
            $this->tab = 'design';
            $this->add_control( 'single_post_width_layout_header', 'section_heading' );
            $this->add_control( 'single_post_width_layout', 'radio_image' );
            $this->add_control( 'single_post_typo_heading', 'section_heading_toggle' );
            $this->add_control( 'single_post_title_typo', 'typography' );
            $this->add_control( 'single_post_meta_typo', 'typography' );
            $this->add_control( 'single_post_card_settings', 'section_heading_toggle' );
            $this->add_control( 'single_post_card_enable', 'simple_toggle' );
            //MARK: Related Posts Section
            $this->add_section( 'single_related_posts_section' );
            $this->add_control( 'single_post_related_posts_option', 'toggle' );
            $this->add_control( 'single_post_related_posts_title', 'text' );
            // MARK: Page Settings panel
            $this->add_panel( 'page_setting_panel' );
            // MARK: Page Settings Section
            $this->add_section( 'page_settings_section' );
            $this->add_control( 'page_width_layout_header', 'section_heading' );
            $this->add_control( 'page_width_layout', 'radio_image' );
            $this->add_control( 'page_show_original_image_option', 'simple_toggle' );
            $this->add_control( 'page_image_caption', 'simple_toggle' );
            $this->add_control( 'page_image_settings_header', 'section_heading' );
            $this->add_control( 'page_image_ratio', 'number' );
            $this->add_control( 'page_card_settings', 'section_heading_toggle' );
            $this->add_control( 'page_card_enable', 'simple_toggle' );
            // MARK: 404 Page
            $this->add_section( '404_section' );
            $this->add_control( '404_section_tab', 'section_tab' );
            $this->add_control( 'error_page_image', 'media' );
            $this->tab = 'design';
            $this->add_control( 'error_page_width_layout', 'radio_image' );
            // MARK: Search Page
            $this->add_section( 'search_page_settings' );
            $this->add_control( 'search_page_width_layout', 'radio_image' );
            // MARK: Background
            $this->section = 'background_image';
            $this->add_control( 'site_background_color', 'color' );
            $this->add_control( 'site_background_animation_settings_heading', 'section_heading' );
            $this->add_control( 'site_background_animation', 'select' );
            /* Header Builder Section */
            // MARK: Header Builder
            $this->add_section( 'header_builder_section' );
            $this->add_control( 'header_builder', 'builder' );
            $this->add_control( 'responsive_header_builder', 'responsive_builder' );
            // MARK: Header Builder settings
            $this->add_section( 'header_builder_section_settings' );
            $this->add_control( 'header_builder_section_tab', 'section_tab' );
            $this->add_control( 'header_builder_section_width', 'radio_image' );
            $this->add_control( 'header_buiilder_header_sticky', 'simple_toggle' );
            $this->add_control( 'header_first_row_header_sticky', 'simple_toggle' );
            $this->add_control( 'header_second_row_header_sticky', 'simple_toggle' );
            $this->add_control( 'header_third_row_header_sticky', 'simple_toggle' );
            $this->tab = 'design';
            $this->add_control( 'header_builder_background', 'color' );
            // MARK: Header builder 1st row section
            $this->add_section( 'header_first_row' );
            $this->add_control( 'header_first_row_section_tab', 'section_tab' );
            $this->add_control( 'header_first_row_column', 'number' );
            $this->add_control( 'header_first_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'header_first_row_reflector', 'builder_reflector' );
            $this->tab = 'design';
            $this->add_control( 'header_first_row_full_width', 'simple_toggle' );
            $this->add_control( 'header_first_row_background', 'color' );
            $this->tab = 'column';
            $this->add_control( 'header_first_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'header_first_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'header_first_row_column_three', 'responsive_radio_tab' );
            // MARK: Header second 2nd row section
            $this->add_section( 'header_second_row' );
            $this->add_control( 'header_second_row_section_tab', 'section_tab' );
            $this->add_control( 'header_second_row_column', 'number' );
            $this->add_control( 'header_second_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'header_second_row_reflector', 'builder_reflector' );
            $this->tab = 'design';
            $this->add_control( 'header_second_row_full_width', 'simple_toggle' );
            $this->add_control( 'header_second_row_background', 'color' );
            $this->tab = 'column';
            $this->add_control( 'header_second_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'header_second_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'header_second_row_column_three', 'responsive_radio_tab' );
            // MARK: Header third 3rd row section
            $this->add_section( 'header_third_row' );
            $this->add_control( 'header_third_row_section_tab', 'section_tab' );
            $this->add_control( 'header_third_row_column', 'number' );
            $this->add_control( 'header_third_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'header_third_row_reflector', 'builder_reflector' );
            $this->tab = 'design';
            $this->add_control( 'header_third_row_full_width', 'simple_toggle' );
            $this->add_control( 'header_third_row_background', 'color' );
            $this->tab = 'column';
            $this->add_control( 'header_third_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'header_third_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'header_third_row_column_three', 'responsive_radio_tab' );
            // MARK: Mobile Canvas
            $this->add_section( 'mobile_canvas_section' );
            $this->add_control( 'mobile_canvas_section_tab', 'section_tab' );
            $this->add_control( 'mobile_canvas_reflector', 'builder_reflector' );
            $this->add_control( 'mobile_canvas_alignment', 'radio_tab' );
            $this->tab = 'design';
            $this->add_control( 'mobile_canvas_icon_color', 'color' );
            $this->add_control( 'mobile_canvas_text_color', 'color' );
            $this->add_control( 'mobile_canvas_background', 'color' );
            $this->add_control( 'mobile_canvas_padding', 'spacing' );
            // MARK: Secondary Menu
            $this->add_section( 'secondary_menu_options' );
            $this->add_control( 'secondary_menu_options_section_tab', 'section_tab' );
            $this->add_control( 'secondary_menu_hover_effect', 'select' );
            $this->tab = 'design';
            $this->add_control( 'secondary_menu_typo', 'typography' );
            $this->add_control( 'secondary_menu_color', 'color' );
            // MARK: Footer Builder Section
            $this->add_section( 'footer_builder_section' );
            $this->add_control( 'footer_builder', 'builder' );
            // MARK: Footer Builder Settings
            $this->add_section( 'footer_builder_section_settings' );
            $this->add_control( 'footer_section_tab', 'section_tab' );
            $this->add_control( 'footer_builder_section_width', 'radio_image' );
            $this->tab = 'design';
            $this->add_control( 'footer_title_typography', 'typography' );
            $this->add_control( 'footer_text_typography', 'typography' );
            $this->add_control( 'footer_builder_background', 'color' );
            // MARK: Footer builder row 1st sections
            $this->add_section( 'footer_first_row' );
            $this->add_control( 'footer_first_row_section_tab', 'section_tab' );
            $this->add_control( 'footer_first_row_column', 'number' );
            $this->add_control( 'footer_first_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'footer_first_row_reflector', 'builder_reflector' );
            $this->add_control( 'footer_first_row_row_direction', 'radio_tab' );
            $this->tab = 'design';
            $this->add_control( 'footer_first_row_full_width', 'simple_toggle' );
            $this->add_control( 'footer_first_row_background', 'color' );
            $this->tab = 'column';
            $this->add_control( 'footer_first_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'footer_first_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'footer_first_row_column_three', 'responsive_radio_tab' );
            $this->add_control( 'footer_first_row_column_four', 'responsive_radio_tab' );
            // MARK: Footer Builder 2nd row section
            $this->add_section( 'footer_second_row' );
            $this->add_control( 'footer_second_row_column', 'number' );
            $this->add_control( 'footer_second_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'footer_second_row_reflector', 'builder_reflector' );
            $this->add_control( 'footer_second_row_row_direction', 'radio_tab' );
            $this->tab = 'design';
            $this->add_control( 'footer_second_row_full_width', 'simple_toggle' );
            $this->add_control( 'footer_second_row_section_tab', 'section_tab' );
            $this->add_control( 'footer_second_row_background', 'color' );
            $this->tab = 'column';
            $this->add_control( 'footer_second_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'footer_second_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'footer_second_row_column_three', 'responsive_radio_tab' );
            $this->add_control( 'footer_second_row_column_four', 'responsive_radio_tab' );
            // MARK: Footer Builder 3rd row section
            $this->add_section( 'footer_third_row' );
            $this->add_control( 'footer_third_row_section_tab', 'section_tab' );
            $this->add_control( 'footer_third_row_column', 'number' );
            $this->add_control( 'footer_third_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'footer_third_row_reflector', 'builder_reflector' );
            $this->add_control( 'footer_third_row_row_direction', 'radio_tab' );
            $this->tab = 'design';
            $this->add_control( 'footer_third_row_full_width', 'simple_toggle' );
            $this->add_control( 'footer_third_row_background', 'color' );
            $this->tab = 'column';
            $this->add_control( 'footer_third_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'footer_third_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'footer_third_row_column_three', 'responsive_radio_tab' );
            $this->add_control( 'footer_third_row_column_four', 'responsive_radio_tab' );
            // MARK: Footer Copyright
            $this->add_section( 'footer_copyright' );
            $this->add_control( 'bottom_footer_section_tab', 'section_tab' );
            $this->add_control( 'bottom_footer_site_info', 'textarea' );
            $this->tab = 'design';
            $this->add_control( 'bottom_footer_text_typography', 'typography' );
            // MARK: Footer Logo
            $this->add_section( 'footer_logo' );
            $this->add_control( 'bottom_footer_logo_option', 'media' );
            $this->add_control( 'bottom_footer_header_or_custom', 'select' );
            $this->add_control( 'bottom_footer_logo_width', 'number' );
            // MARL: Footer Menu Options
            $this->add_section( 'footer_menu_options_section' );
            $this->add_control( 'footer_menu_section_tab', 'section_tab' );
            $this->add_control( 'footer_menu_hover_effect', 'select' );
            $this->tab = 'design';
            $this->add_control( 'footer_menu_typography', 'typography' );
            $this->add_control( 'footer_menu_color', 'color' );
            // MARL: Footer Social Icons
            $this->add_section( 'footer_social_icons_section' );
            $this->add_control( 'footer_social_icons', 'custom_repeater' );
            $this->add_control( 'footer_social_icons_display_label', 'simple_toggle' );
            // MARK: Scroll to Top
            $this->add_section( 'stt_options_section' );
            $this->add_control( 'stt_section_tab', 'section_tab' );
            $this->add_control( 'stt_responsive_option', 'responsive_multiselect_tab' );
            $this->add_control( 'stt_label', 'text' );
            $this->tab = 'design';
            $this->add_control( 'stt_color_group', 'color' );
        }

        /**
         * Add a panel in the customizer
         * 
         * @since 1.0.0
         */
        public function add_panel( $id ) {
            if( $id ) :
                $params = $this->get_panels( $id );
                $this->customize->add_panel( $id, $params );
            endif;
        }

        /**
         * Add a section in the customizer
         * 
         * @since 1.0.0
         */
        public function add_section( $id ) {
            if( $id ) :
                $this->section = $id;
                $this->tab = 'general';
                $params = $this->get_sections( $id );
                $this->customize->add_section( $id, $params );
            endif;
        }

        /**
         * Add Control
         * 
         * @since 1.0.0
         */
        public function add_control( $id, $type ) {
            if( ! in_array( $type, [ 'info_box', 'section_heading_toggle', 'section_heading', 'redirect_control', 'builder_reflector', 'section_tab', 'popup' ] ) ) :
                $settings_array = [
                    'default'   =>  ONP\online_newspaper_get_customizer_option( $id ) 
                ];
            endif;
            $params = [ 
                'section'   =>  $this->section,
                'tab'   =>  $this->tab
            ];
            switch( $type ) :
                case 'typography' :
                        $params = array_merge( $params, $this->get_typography( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_typo_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Typography_Control( $this->customize, $id, $params ) );
                    break;
                case 'box_shadow' :
                        $params = array_merge( $params, $this->get_box_shadow( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_box_shadow_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Box_Shadow_Control( $this->customize, $id, $params ) );
                    break;
                case 'checkbox' :
                        $params = array_merge( $params, $this->get_checkbox( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_checkbox';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Checkbox_Control( $this->customize, $id, $params ) );
                    break;
                case 'toggle' :
                        $params = array_merge( $params, $this->get_toggle( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_toggle_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Toggle_Control( $this->customize, $id, $params ) );
                    break;
                case 'simple_toggle' :
                        $params = array_merge( $params, $this->get_simple_toggle( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_toggle_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Simple_Toggle_Control( $this->customize, $id, $params ) );
                    break;
                case 'section_tab': 
                        $params = array_merge( $params, $this->get_section_tab( $id ) );
                        $params[ 'section' ] = $this->section;
                        $settings_array[ 'default' ] = 'general';
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_text_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Section_Tab_Control( $this->customize, $id, $params ) );
                    break;
                case 'spacing': 
                        $params = array_merge( $params, $this->get_spacing( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_spacing_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Spacing_Control( $this->customize, $id, $params ) );
                    break;
                case 'radio_tab': 
                        $params = array_merge( $params, $this->get_radio_tab( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_text_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Radio_Tab_Control( $this->customize, $id, $params ) );
                    break;
                case 'info_box':
                        $params = array_merge( $params, $this->get_info_box( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_text_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Info_Box_Control( $this->customize, $id, $params ) );
                    break;
                case 'section_heading_toggle': 
                        $params = array_merge( $params, $this->get_section_heading_toggle( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_text_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Section_Heading_Toggle_Control( $this->customize, $id, $params ) );
                    break;
                case 'item_sortable': 
                        $params = array_merge( $params, $this->get_item_sortable( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_sortable_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Item_Sortable_Control( $this->customize, $id, $params ) );
                    break;
                case 'number': 
                        $params = array_merge( $params, $this->get_number( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = ( array_key_exists( 'responsive', $params ) && $params[ 'responsive' ] ) ? 'online_newspaper_sanitize_responsive_range' : 'absint';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Number_Range_Control( $this->customize, $id, $params ) );
                    break;
                case 'section_heading': 
                        $params = array_merge( $params, $this->get_section_heading( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_text_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Section_Heading_Control( $this->customize, $id, $params ) );
                    break;
                case 'redirect_control': 
                        $params = array_merge( $params, $this->get_redirect_control( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_text_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Redirect_Control( $this->customize, $id, $params ) );
                    break;
                case 'radio_image': 
                        $params = array_merge( $params, $this->get_radio_image( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_select_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Radio_Image_Control( $this->customize, $id, $params ) );
                    break;
                case 'icon_picker': 
                        $params = array_merge( $params, $this->get_icon_picker( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_icon_picker_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Icon_Picker_Control( $this->customize, $id, $params ) );
                    break;
                case 'editor_control': 
                        $params = array_merge( $params, $this->get_editor_control( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'wp_kses_post';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Editor_Control( $this->customize, $id, $params ) );
                    break;
                case 'text': 
                        $params = array_merge( $params, $this->get_text( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_text_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Text_Control( $this->customize, $id, $params ) );
                    break;
                case 'select':
                        $params = array_merge( $params, $this->get_select( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_select_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Select_Control( $this->customize, $id, $params ) );
                    break;
                case 'border': 
                        $params = array_merge( $params, $this->get_border( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_array';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Border_Control( $this->customize, $id, $params ) );
                    break;
                case 'preset': 
                        $params = array_merge( $params, $this->get_preset_colors( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_preset_colors';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Preset_Control( $this->customize, $id, $params ) );
                    break;
                case 'color': 
                        $params = array_merge( $params, $this->get_colors( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_color_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Color_Control( $this->customize, $id, $params ) );
                    break;
                case 'media': 
                        $params = array_merge( $params, $this->get_media_control( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'absint';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new WP_Customize_Media_Control( $this->customize, $id, $params ) );
                    break;
                case 'predefined_color': 
                        $params = array_merge( $params, $this->get_predefined_colors( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_hex_color';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Default_Color_Control( $this->customize, $id, $params ) );
                    break;
                case 'custom_repeater':
                        $params = array_merge( $params, $this->get_custom_repeaters( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_repeater_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Custom_Repeater( $this->customize, $id, $params ) );
                    break;
                case 'predefined_number': 
                        $params = array_merge( $params, $this->get_custom_number_controls( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'absint';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Number_Control( $this->customize, $id, $params ) );
                    break;
                case 'url': 
                        $params = array_merge( $params, $this->get_url( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_url';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Url_Control( $this->customize, $id, $params ) );
                    break;
                case 'multiselect': 
                        $params = array_merge( $params, $this->get_multiselect_controls( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_async_multiselect_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Post_Multiselect_Control( $this->customize, $id, $params ) );
                    break;
                case 'multiselect_normal':
                        $params = array_merge( $params, $this->get_normal_multiselect_controls( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_normal_multiselect_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Multiselect_Control( $this->customize, $id, $params ) );
                    break;
                case 'typography_preset':
                        $params = array_merge( $params, $this->get_typography_preset_controls( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_typography_preset_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Typography_Preset_Control( $this->customize, $id, $params ) );
                    break;
                case 'textarea': 
                        $params = array_merge( $params, $this->get_textareas( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_textarea_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( $id, $params );
                    break;
                case 'preset_color': 
                        $params = array_merge( $params, $this->get_theme_colors( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_text_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Theme_Color_Control( $this->customize, $id, $params ) );
                    break;
                case 'builder_reflector': 
                        $params = array_merge( $params, $this->get_builder_reflector_controls( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Builder_Reflector_Control( $this->customize, $id, $params ) );
                    break;
                case 'responsive_radio_image': 
                        $params = array_merge( $params, $this->get_responsive_radio_image( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_responsive_radio_image';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Responsive_Radio_Image( $this->customize, $id, $params ) );
                    break;
                case 'responsive_radio_tab':
                        $params = array_merge( $params, $this->get_responsive_radio_tab( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_responsive_radio_tab';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Responsive_Radio_Tab_Control( $this->customize, $id, $params ) );
                    break;
                case 'builder': 
                        $params = array_merge( $params, $this->get_builder_controls( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_builder_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Builder_Control( $this->customize, $id, $params ) );
                    break;
                case 'responsive_builder': 
                        $params = array_merge( $params, $this->get_responsive_builder_controls( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_builder_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Responsive_Builder_Control( $this->customize, $id, $params ) );
                    break;
                case 'term_colors': 
                        $params = array_merge( $params, $this->get_term_colors( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        // $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_builder_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Term_Colors( $this->customize, $id, $params ) );
                    break;
                case 'block_repeater': 
                        $params = array_merge( $params, $this->get_block_repeater_controls( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_repeater_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Block_Repeater_Control( $this->customize, $id, $params ) );
                    break;
                case 'responsive_multiselect_tab': 
                        $params = array_merge( $params, $this->get_responsive_multiselect_tab_controls( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'online_newspaper_sanitize_responsive_multiselect_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Online_Newspaper_WP_Responsive_Multiselect_Tab_Control( $this->customize, $id, $params ) );
                    break;
            endswitch;
        }   // End of get_class_or_sanitize_function() Method
    }
    add_action( 'customize_register', function( $wp_customize ){
        new Online_Newspaper_Customizer( $wp_customize );
    }, 10 );
endif;