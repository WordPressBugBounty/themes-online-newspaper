<?php
/**
 * Includes theme defaults and starter functions
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
 namespace OnlineNewspaper\CustomizerDefault;

 if( !function_exists( 'online_newspaper_get_customizer_option' ) ) :
    /**
     * Gets customizer "theme_mods" value
     * 
     * @package Online Newspaper
     * @since 1.0.0
     * 
     */
    function online_newspaper_get_customizer_option( $key ) {
        return get_theme_mod( $key, online_newspaper_get_customizer_default( $key ) );
    }
 endif;

 if( !function_exists( 'online_newspaper_get_customizer_default' ) ) :
    /**
     * Gets customizer "theme_mods" value
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_get_customizer_default($key) {
        $array_defaults = apply_filters( 'online_newspaper_get_customizer_defaults', array(
            // MARK: Colors
            'theme_color'   => '#d71d4f',
            'solid_color_preset' =>  [
                'color_palettes' => [
                    [ '#40E0D0', '#F4C430', '#FF00FF', '#007BA7', '#DC143C', '#7FFF00' ],
                    [ '#007FFF', '#FFBF00', '#50C878', '#8A2BE2', '#FF7F50' ],
                    [ '#008080', '#FFD700', '#E6E6FA', '#800000', '#808000', '#CCCCFF' ]
                ],
                'active_palette'    =>  '0'
            ],
            'gradient_color_preset' =>  [
                'color_palettes' => [
                    [ 'linear-gradient(135deg, #000000, #FFFF00)', 'linear-gradient(135deg, #191970, #FFD700)', 'linear-gradient(135deg, #4B0082, #FFA500)', 'linear-gradient(135deg, #FF8C00, #483D8B)', 'linear-gradient(135deg, #006400, #8B4513)', 'linear-gradient(135deg, #DC143C, #FFD700)' ],
                    [ 'linear-gradient(135deg, #00FFFF, #FF6347)', 'linear-gradient(135deg, #228B22, #8B4513)', 'linear-gradient(135deg, #F4A460, #DAA520)', 'linear-gradient(135deg, #FFD700, #FF6347)', 'linear-gradient(135deg, #9400D3, #87CEEB)', 'linear-gradient(135deg, #00FF00, #00FFFF)' ],
                    [ 'linear-gradient(135deg, #FFD700, #FFA500)', 'linear-gradient(135deg, #FF7F50, #FFD700)', 'linear-gradient(135deg, #483D8B, #00FFFF)', 'linear-gradient(135deg, #DC143C, #8B008B)', 'linear-gradient(135deg, #228B22, #2E8B57)', 'linear-gradient(135deg, #FF6347, #FFA500)' ],
                ],
                'active_palette'    =>  '0'
            ],
            // MARK: Default Typography
            'default_typo_one'  =>  online_newspaper_get_typography_defaults([
                'font_family'       =>  [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'       =>  [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
            ]),
            'default_typo_two'  =>  online_newspaper_get_typography_defaults([
                'font_family'       =>  [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'       =>  [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
            ]),
            // MARK: Site Background
            'site_background_color'  => online_newspaper_get_color_defaults( [ 'solid' => '#f6f8fa' ] ),
            'site_background_animation' =>  'none',
            // MARK: Global Button
            'global_button_label'   =>  esc_html__( 'Read Full Post', 'online-newspaper' ),
            'global_button_typo'    => online_newspaper_get_typography_defaults(),
            // MARK: Preloader
            'preloader_option'  => false,
            'preloader_type'  => 1,
            // MARK: Website Layout
            'website_layout'    => 'full-width--layout',
            'website_layout_background_color'   =>  online_newspaper_get_color_defaults(),
            'website_box_shadow'    =>  [
                'option'    =>  true,
                'hoffset'   =>  0,
                'voffset'   =>  0,
                'blur'  =>  4,
                'spread'    =>  0,
                'type'  =>  'outset',
                'color' =>  'rgb(0 0 0 / 8%)'
            ],
            'website_layout_horizontal_gap' =>  online_newspaper_get_responsive_defaults(),
            'website_layout_vertical_gap'   =>  online_newspaper_get_responsive_defaults(),
            'website_content_layout'    => 'boxed--layout',
            'site_block_title_typo' =>  online_newspaper_get_typography_defaults([
                'font_weight'       =>  [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size'         =>  online_newspaper_get_responsive_defaults( 19, 19, 19 ),
                'line_height'       =>  online_newspaper_get_responsive_defaults( 25, 25, 25 ),
                'letter_spacing'    =>  online_newspaper_get_responsive_defaults( 0.3, 0.3, 0.3 ),
                'text_transform'    =>  'uppercase'
            ]),
            // MARK: Widget Styles
            'widgets_styles_image_border'   =>  online_newspaper_default_border([
                'type'  =>  'none',
                'color' =>  '#d71d4f'
            ]),
            'widgets_styles_image_border_radius'    =>  online_newspaper_get_responsive_defaults( 0, 0, 0 ),
            'widgets_styles_image_box_shadow'   =>  array(
                'option'    => false,
                'hoffset'   => 0,
                'voffset'   => 4,
                'blur'  => 9,
                'spread'    => -3,
                'type'  => 'outset',
                'color' => 'rgb(7 10 25 / 35%)'
            ),
            // MARK: Sidebar Options
            'frontpage_sidebar_layout'  => 'right-sidebar',
            'frontpage_sidebar_sticky_option'    => false,
            'archive_sidebar_layout'    => 'right-sidebar',
            'archive_sidebar_sticky_option'    => false,
            'single_sidebar_layout' => 'right-sidebar',
            'single_sidebar_sticky_option'    => false,
            'page_sidebar_layout'   => 'right-sidebar',
            'page_sidebar_sticky_option'    => false,
            // MARK: Animation / Hover Effects
            'post_title_hover_effects'  => 'ten',
            'site_image_hover_effects'  => 'none',
            'cursor_animation'  =>  'none',
            // MARK: Breadcrumb
            'site_breadcrumb_option'    => true,
            'site_breadcrumb_type'  => 'default',
            // MARK: SEO / Misc
            'site_schema_ready' => true,
            'site_date_to_show' => 'published',
            'site_date_format'  => 'default',
            'words_to_read_per_minute'  => 200,
            'disable_admin_notices'  => false,
            // MARK: Section Reorder
            'homepage_content_order'    => json_encode([
                'ticker_news_section'    => true,
                'main_banner_section'    => true,
                'web_stories_section'    => true,
                'full_width_section'    => false,
                'leftc_rights_section'  => false,
                'lefts_rightc_section'  => false,
                'latest_posts'  => true,
                'bottom_full_width_section' => true,
                'two_column_section'    => false
            ]),
            // MARK: Site logo and title
            'site_logo_width'    => online_newspaper_get_responsive_defaults( 230, 200, 200 ),
            'site_title_tag_for_frontpage'    => 'h1',
            'site_title_tag_for_innerpage'    => 'h2',
            'blogdescription_option'    => false,
            'site_title_typo'   =>  online_newspaper_get_typography_defaults([
                'font_family'   => ['value' => 'Inter', 'label' => 'Inter'],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  online_newspaper_get_responsive_defaults( 30, 30, 30 ),
                'line_height' =>  online_newspaper_get_responsive_defaults( 41, 41, 41 ),
            ]),
            'site_tagline_typo' =>   online_newspaper_get_typography_defaults([
                'font_family'   => ['value' => 'Inter', 'label' => 'Inter'],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'line_size'   =>  online_newspaper_get_responsive_defaults( 15, 15, 15 ),
                'line_height'   =>  online_newspaper_get_responsive_defaults( 22, 22, 22 )
            ]),
            'site_title_hover_textcolor'=> '#fff',
            'site_description_color'    => '#686868',
            // MARK: Custom Button
            'custom_button_label'   =>  esc_html__( 'Live Now', 'online-newspaper' ),
            'custom_button_link'    =>  home_url(),
            'custom_button_color_group' => online_newspaper_get_color_defaults([ 
                'initial'   =>  [ 'solid' => '#fff' ],
                'hover'     =>  [ 'solid' => '#fff' ]
            ]),
            'custom_button_icon_size'   => online_newspaper_get_responsive_defaults( 11, 11, 11 ),
            'custom_button_text_typo' =>   online_newspaper_get_typography_defaults([
                'font_family'   => ['value' => 'Inter', 'label' => 'Inter' ],
                'font_size'   =>  online_newspaper_get_responsive_defaults( 12, 12, 12 ),
                'line_height'   =>  online_newspaper_get_responsive_defaults( 30, 30, 30 )
            ]),
            // MARK: Newsletter / Subscribe Button
            'newsletter_label'   =>  esc_html__( 'Subscribe', 'online-newspaper' ),
            'header_newsletter_redirect_href_link'  =>  home_url(),
            'header_newsletter_hover_animation' =>  'none',
            'header_newsletter_typography'  =>  online_newspaper_get_typography_defaults([
                'font_family'   => ['value' => 'Inter', 'label' => 'Inter' ],
                'font_size'   =>  online_newspaper_get_responsive_defaults( 14, 14, 14 ),
                'line_height'   =>  online_newspaper_get_responsive_defaults( 20, 20, 20 ),
                'letter_spacing'  =>  online_newspaper_get_responsive_defaults( 0.3, 0.3, 0.3 ),
                'text_transform'  =>  'uppercase'
            ]),
            'header_newsletter_label_color' => online_newspaper_get_color_defaults([
                'initial'   =>  [ 'solid' => '#0a0a0a' ],
                'hover'   =>  [ 'solid' => '--online-newspaper-global-preset-theme-color' ]
            ]),
            // MARK: Random News
            'random_news_label'   =>  esc_html__( 'Random News', 'online-newspaper' ),
            'random_news_typography'  =>  online_newspaper_get_typography_defaults([
                'font_family'   => ['value' => 'Inter', 'label' => 'Inter' ],
                'font_size'   =>  online_newspaper_get_responsive_defaults( 14, 14, 14 ),
                'line_height'   =>  online_newspaper_get_responsive_defaults( 20, 20, 20 ),
                'letter_spacing'  =>  online_newspaper_get_responsive_defaults( 0.3, 0.3, 0.3 ),
                'text_transform'  =>  'uppercase'
            ]),
            'random_news_label_color' => online_newspaper_get_color_defaults([ 
                'initial'   =>  [ 'solid' => '#fff' ],
                'hover'     =>  [ 'solid' => '--online-newspaper-global-preset-theme-color' ]
            ]),
            // MARK: Ads Banner
            'header_ads_banner_responsive_option'  => array(
                'desktop'   => true,
                'tablet'   => true,
                'mobile'   => true
            ),
            'header_ads_banner_image'  => '',
            'header_ads_banner_image_link_url'  => false,
            'header_ads_banner_image_url'  => '',
            'header_ads_banner_custom_target'  => '_self',
            'header_ads_banner_image_rel_attr'  =>  'nofollow',
            // MARK: Off Canvas
            'off_canvas_position'  => 'left',
            'canvas_menu_icon_color' => online_newspaper_get_color_defaults([ 
                'initial'   =>  [ 'solid' => '#a1a1a1' ],
                'hover'     =>  [ 'solid' => '#fff' ]
            ]),
            // MARK: Theme Mode
            'theme_mode_dark_icon' => online_newspaper_default_icon_picker([ 'value' => 'fas fa-moon' ]),
            'theme_mode_light_icon' => online_newspaper_default_icon_picker([ 'value' => 'fas fa-sun' ]),
            'theme_mode_dark_icon_color' => [ 
                'initial'   =>  online_newspaper_get_color_defaults([ 'solid' => '#fff' ]),
                'hover' =>  online_newspaper_get_color_defaults([ 'solid' => '#fff' ])
            ],
            'theme_mode_light_icon_color' => [ 
                'initial'   =>  online_newspaper_get_color_defaults([ 'solid' => '#a1a1a1' ]),
                'hover' =>  online_newspaper_get_color_defaults([ 'solid' => '#a1a1a1' ])
            ],
            // MARK: Menu Options
            'header_menu_hover_effect'  => 'none',
            'header_menu_typo'    => online_newspaper_get_typography_defaults([
                'font_family'   => ['value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'       =>  [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size' =>  online_newspaper_get_responsive_defaults( 14, 14, 14 ),
                'line_height'   => online_newspaper_get_responsive_defaults( 20, 20, 20 ),
                'letter_spacing'   => online_newspaper_get_responsive_defaults( 1, 1, 1 ),
                'text_transform'  =>  'uppercase'
            ]),
            'header_sub_menu_typo'    => online_newspaper_get_typography_defaults([
                'font_family'   => ['value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'       =>  [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size' =>  online_newspaper_get_responsive_defaults( 14, 14, 14 ),
                'line_height'   => online_newspaper_get_responsive_defaults( 20, 20, 20 )
            ]),
            'header_menu_color'    => online_newspaper_get_color_defaults([ 
                'initial'   =>  [ 'solid' => '#fff' ],
                'hover'     =>  [ 'solid' => '--online-newspaper-global-preset-theme-color' ],
            ]),
            'header_sub_menu_color'    => online_newspaper_get_color_defaults([ 
                'initial'   =>  [ 'solid' => '#fff' ],
                'hover'     =>  [ 'solid' => '--online-newspaper-global-preset-theme-color' ],
            ]),
            // MARK: Live Search
            'search_icon_size' =>  online_newspaper_get_responsive_defaults( 16, 16, 16 ),
            'search_icon_color' => online_newspaper_get_color_defaults([ 
                'initial'   =>  [ 'solid' => '#a1a1a1' ],
                'hover'     =>  [ 'solid' => '#fff' ]
            ]),
            // MARK: Social Icons
            'social_icons' => json_encode(array(
                array(
                    'icon_class'    => 'fa-brands fa-facebook-f',
                    'icon_url'      => '',
                    'icon_count'      => '1K',
                    'item_option'   => 'show'
                ),
                array(
                    'icon_class'    => 'fa-brands fa-instagram',
                    'icon_url'      => '',
                    'icon_count'      => '1K',
                    'item_option'   => 'show'
                ),
                array(
                    'icon_class'    => 'fa-brands fa-x-twitter',
                    'icon_url'      => '',
                    'icon_count'      => '1K',
                    'item_option'   => 'show'
                )
            )),
            // MARK: Ticker news
            'ticker_news_frontpage' =>  true,
            'ticker_news_width_layout'  => 'global',
            'ticker_news_order_by'  => 'date-desc',
            'ticker_news_thumbnail_option'   => true,
            'ticker_news_numbers'   => 10,
            'ticker_news_categories' => [],
            'ticker_news_posts' => [],
            'ticker_news_title_color' => online_newspaper_get_color_defaults([ 'solid' => '' ]),
            'ticker_news_date_color' => online_newspaper_get_color_defaults([ 'solid' => '' ]),
            'ticker_news_card_enable'  => true,
            'ticker_news_background_color_group' => online_newspaper_get_color_defaults([ 'solid' => '' ]),
            'ticker_news_border'  =>  online_newspaper_default_border([
                'type'  =>  'none',
                'color' =>  '#000'
            ]),
            'ticker_section_border_radius'   => 0,
            // MARK: Main Banner
            'main_banner_list_posts_title'  => esc_html__( 'Popular News', 'online-newspaper' ),
            'main_banner_list_posts_categories'   => [],
            'main_banner_list_posts_categories_option'  => false,
            'main_banner_list_posts_date_option'  => false,
            'main_banner_list_posts_author_option'  => true,
            'main_banner_slider_order_by'   => 'date-desc',
            'main_banner_slider_categories' => [],
            'main_banner_posts' => [],
            'main_banner_slider_categories_option'  => true,
            'main_banner_slider_date_option'  => true,
            'main_banner_grid_posts_title'  => esc_html__( 'Latest News', 'online-newspaper' ),
            'main_banner_grid_posts_categories'   => [],
            'main_banner_grid_posts_order_by'  => 'rand-desc',
            'main_banner_width_layout'  => 'global',
            'main_banner_background_color_group' => online_newspaper_get_color_defaults([ 'solid' => '' ]),
            'banner_section_three_column_order'  => json_encode([
                'grid_slider'   => true,
                'banner_slider' => true,
                'list_posts'    => true
            ]),
            'main_banner_card_enable'  => true,
            'main_banner_section_border'  =>  online_newspaper_default_border([
                'type'  =>  'none',
                'color' =>  '#000'
            ]),
            'main_banner_section_border_radius'   => 0,
            // MARK: Full Width
            'full_width_blocks'   => [
                [
                    'type'  =>  'news-grid',
                    'blockId'   =>  '',
                    'option'    =>  true,
                    'column'    =>  'four',
                    'layout'    =>  'two',
                    'title' =>  esc_html__( 'Latest posts', 'online-newspaper' ),
                    'thumbOption'   =>  true,
                    'categoryOption'    =>  false,
                    'authorOption'  =>  false,
                    'dateOption'    =>  true,
                    'commentOption' =>  false,
                    'excerptOption' =>  false,
                    'excerptLength' =>  10,
                    'query' =>  [
                        'order' =>  'date-desc',
                        'count' =>  4,
                        'offset'    =>  0,
                        'dateFilter'    =>  'all',
                        'posts' =>  [],
                        'categories'    =>  [],
                        'ids'   =>  []
                    ],
                    'buttonOption'  =>  false,
                    'viewallUrl'    =>  '',
                    'viewallLabelOption'    => true,
                    'viewallLabel'  =>  esc_html__( 'View all', 'online-newspaper' ),
                    'imageRatio'    =>  online_newspaper_get_responsive_defaults(),
                    'imageSize' =>  'medium'
                ]
            ],
            'full_width_blocks_width_layout'  => 'global',
            'full_width_blocks_background_color_group' => online_newspaper_get_color_defaults([ 'solid' => '' ]),
            'full_width_card_enable'  => true,
            'full_width_section_border'  =>  online_newspaper_default_border([
                'type'  =>  'none',
                'color' =>  '#000'
            ]),
            'full_width_section_border_radius'   => 0,
            // MARK: Left Content Right Sidebar
            'leftc_rights_blocks'   => [
                [
                    'type'  =>  'news-filter',
                    'blockId'   =>  '',
                    'option'    =>  true,
                    'layout'    =>  'three',
                    'title' =>  esc_html__( 'Latest posts', 'online-newspaper' ),
                    'categoryOption'    =>  true,
                    'thumbOption'    =>  true,
                    'authorOption'  =>  true,
                    'dateOption'    =>  true,
                    'commentOption' =>  false,
                    'excerptOption' =>  false,
                    'excerptLength' =>  10,
                    'query' =>  [
                        'order' =>  'date-desc',
                        'count' =>  5,
                        'offset'    =>  0,
                        'dateFilter'    =>  'all',
                        'posts' =>  [],
                        'categories'    =>  [],
                        'ids'   =>  []
                    ],
                    'buttonOption'  =>  false,
                    'viewallUrl'    =>  '',
                    'viewallLabelOption' =>  true,
                    'viewallLabel'  =>  esc_html__( 'View all', 'online-newspaper' ),
                    'imageRatio'    =>  online_newspaper_get_responsive_defaults(),
                    'imageSize' =>  'medium'
                ]
            ],
            'leftc_rights_blocks_width_layout'  => 'global',
            'leftc_rights_blocks_background_color_group' => online_newspaper_get_color_defaults([ 'solid' => '' ]),
            'leftc_rights_card_enable'  => true,
            'leftc_rights_section_border'  =>  online_newspaper_default_border([
                'type'  =>  'none',
                'color' =>  '#000'
            ]),
            'leftc_rights_sidebar_background_color_group' => online_newspaper_get_color_defaults([ 'solid' => '' ]),
            'leftc_rights_section_border_radius'   => 0,
            'leftc_rights_sidebar_section_border'  =>  online_newspaper_default_border([
                'type'  =>  'none',
                'color' =>  '#000'
            ]),
            'leftc_rights_section_sidebar_border_radius'   => 0,
            'leftc_rights_section_sidebar_padding'  =>  [
                'desktop' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ]
            ],
            // MARK: Left Sidebar Right Content
            'lefts_rightc_blocks'   => [
                [
                    'type'  =>  'news-list',
                    'blockId'   =>  '',
                    'option'    =>  true,
                    'layout'    =>  'one',
                    'column'    =>  'one',
                    'title' =>  esc_html__( 'Latest posts', 'online-newspaper' ),
                    'thumbOption'   =>  true,
                    'categoryOption'    =>  true,
                    'authorOption'  =>  true,
                    'dateOption'    =>  true,
                    'commentOption' =>  false,
                    'excerptOption' =>  true,
                    'excerptLength' =>  10,
                    'query' =>  [
                        'order' =>  'date-desc',
                        'count' =>  4,
                        'offset'    =>  0,
                        'dateFilter'    =>  'all',
                        'posts' =>  [],
                        'categories'    =>  [],
                        'ids'   =>  []
                    ],
                    'buttonOption'  =>  false,
                    'viewallUrl'    =>  '',
                    'viewallLabelOption' =>  true,
                    'viewallLabel'  =>  esc_html__( 'View all', 'online-newspaper' ),
                    'imageRatio'    =>  online_newspaper_get_responsive_defaults(),
                    'imageSize' =>  'medium'
                ]
            ],
            'lefts_rightc_blocks_width_layout'  => 'global',
            'lefts_rightc_blocks_background_color_group' => online_newspaper_get_color_defaults([ 'solid' => '' ]),
            'lefts_rightc_card_enable'  => true,
            'lefts_rightc_section_border'  =>  online_newspaper_default_border([
                'type'  =>  'none',
                'color' =>  '#000'
            ]),
            'lefts_rightc_section_border_radius'   => 0,
            'lefts_rightc_sidebar_background_color_group' => online_newspaper_get_color_defaults([ 'solid' => '' ]),
            'lefts_rightc_sidebar_section_border'  =>  online_newspaper_default_border([
                'type'  =>  'none',
                'color' =>  '#000'
            ]),
            'lefts_rightc_section_sidebar_border_radius'   => 0,
            'lefts_rightc_section_sidebar_padding'  =>  [
                'desktop' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ]
            ],
            // MARK: Bottom Full Width Section
            'bottom_full_width_blocks'   => [
                [
                    'type'  =>  'news-carousel',
                    'blockId'   =>  '',
                    'option'    =>  true,
                    'layout'    =>  'two',
                    'title' =>  esc_html__( 'You May Have Missed', 'online-newspaper' ),
                    'categoryOption'    =>  false,
                    'thumbOption'   =>  true,
                    'authorOption'  =>  false,
                    'dateOption'    =>  true,
                    'commentOption' =>  false,
                    'excerptOption' =>  false,
                    'excerptLength' =>  10,
                    'columns'   =>  4,
                    'query' =>  [
                        'order' =>  'rand-desc',
                        'count' =>  8,
                        'offset'    =>  0,
                        'dateFilter'    =>  'all',
                        'posts' =>  [],
                        'categories'    =>  [],
                        'ids'   =>  []
                    ],
                    'buttonOption'  =>  false,
                    'viewallUrl'    =>  '',
                    'viewallLabelOption'    =>  true,
                    'viewallLabel'  =>  esc_html__( 'View all', 'online-newspaper' ),
                    'dots'  =>  true,
                    'loop'  =>  false,
                    'arrows'    =>  true,
                    'auto'  =>  false,
                    'imageRatio'    =>  online_newspaper_get_responsive_defaults(),
                    'imageSize' =>  'medium_large'
                ]
            ],
            'bottom_full_width_blocks_width_layout'  => 'global',
            'bottom_full_width_blocks_background_color_group' => online_newspaper_get_color_defaults([ 'solid' => '' ]),
            'bottom_full_width_card_enable'  => true,
            'bottom_full_width_section_border'  =>  online_newspaper_default_border([
                'type'  =>  'none',
                'color' =>  '#000'
            ]),
            'bottom_full_width_section_border_radius'   => 0,
            // MARK: Two Column Section
            'two_column_first_column_blocks'   => [
                [
                    'type'  =>  'news-list',
                    'blockId'   =>  '',
                    'option'    =>  true,
                    'layout'    =>  'one',
                    'title' =>  esc_html__( 'Latest posts', 'online-newspaper' ),
                    'thumbOption'   =>  true,
                    'categoryOption'    =>  true,
                    'authorOption'  =>  true,
                    'dateOption'    =>  true,
                    'commentOption' =>  false,
                    'query' =>  [
                        'order' =>  'date-desc',
                        'count' =>  4,
                        'offset'    =>  0,
                        'dateFilter'    =>  'all',
                        'posts' =>  [],
                        'categories'    =>  [],
                        'ids'   =>  []
                    ],
                    'viewallUrl'    =>  '',
                    'viewallLabelOption'    =>  true,
                    'viewallLabel'  =>  esc_html__( 'View all', 'online-newspaper' ),
                    'imageRatio'    =>  online_newspaper_get_responsive_defaults(),
                    'imageSize' =>  'medium'
                ]
            ],
            'two_column_second_column_blocks'   => [
                [
                    'type'  =>  'news-list',
                    'blockId'   =>  '',
                    'option'    =>  true,
                    'layout'    =>  'one',
                    'title' =>  esc_html__( 'Latest posts', 'online-newspaper' ),
                    'thumbOption'   =>  true,
                    'categoryOption'    =>  true,
                    'authorOption'  =>  true,
                    'dateOption'    =>  true,
                    'commentOption' =>  true,
                    'query' =>  [
                        'order' =>  'date-desc',
                        'count' =>  4,
                        'offset'    =>  0,
                        'dateFilter'    =>  'all',
                        'posts' =>  [],
                        'categories'    =>  [],
                        'ids'   =>  []
                    ],
                    'viewallUrl'    =>  '',
                    'viewallLabelOption'    =>  true,
                    'viewallLabel'  =>  esc_html__( 'View all', 'online-newspaper' ),
                    'imageRatio'    =>  online_newspaper_get_responsive_defaults(),
                    'imageSize' =>  'medium'
                ]
            ],
            'two_column_section_layout'  => 'global',
            'two_column_background_color_group' =>  online_newspaper_get_color_defaults([ 'solid' => '' ]),
            'two_column_card_enable'  => true,
            'two_column_section_border'  =>  online_newspaper_default_border([
                'type'  =>  'none',
                'color' =>  '#000'
            ]),
            'two_column_section_border_radius'   => 0,
            // MARK: Single Post
            'single_layout' =>  'three',
            'single_post_meta_order'    => json_encode([
                'author'    => true,
                'date'  => true,
                'comments'  => true,
                'read-time' =>  true
            ]),
            'single_post_related_posts_option'  => true,
            'single_post_related_posts_title'   => esc_html__( 'Related News', 'online-newspaper' ),
            'single_post_show_original_image_option'=> false,
            'single_post_image_caption'=> false,
            'single_post_image_ratio'   =>  online_newspaper_get_responsive_defaults(),
            'single_post_width_layout'=> 'global',
            'single_post_title_typo' =>  online_newspaper_get_typography_defaults([
                'font_weight'       =>  [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size'         =>  online_newspaper_get_responsive_defaults( 27, 27, 27 ),
                'line_height'       =>  online_newspaper_get_responsive_defaults( 37, 37, 37 )
            ]),
            'single_post_meta_typo' =>  online_newspaper_get_typography_defaults([
                'font_family'       =>  [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'       =>  [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size'       =>  online_newspaper_get_responsive_defaults( 13, 13, 13 ),
                'line_height'       =>  online_newspaper_get_responsive_defaults( 20, 20, 20 ),
                'letter_spacing'    =>  online_newspaper_get_responsive_defaults( 0.48, 0.48, 0.48 ),
                'text_transform'    =>  'capitalize'
            ]),
            'single_post_content_typo' =>  online_newspaper_get_typography_defaults([
                'font_family'       =>  [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'       =>  [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size'       =>  online_newspaper_get_responsive_defaults( 16, 16, 16 ),
                'line_height'       =>  online_newspaper_get_responsive_defaults( 27, 27, 27 )
            ]),
            // MARK: Archive
            'archive_page_title_prefix'   => false,
            'archive_page_layout'   => 'one',
            'archive_page_category_option'   => true,
            'archive_post_element_order'    => json_encode([
                'title' => true,
                'meta'  => true,
                'excerpt'   => true,
                'button'    => false
            ]),
            'archive_post_meta_order'    => json_encode([
                'author'    => true,
                'date'  => true,
                'comments'  => true,
                'read-time' =>  false
            ]),
            'archive_image_ratio'   =>  online_newspaper_get_responsive_defaults(),
            'archive_image_size'   =>  'medium_large',
            'archive_width_layout'=> 'global',
            'archive_card_enable'  => true,
            'archive_color_group' => online_newspaper_get_color_defaults([ 'solid' => '' ]),
            'archive_section_border'  =>  online_newspaper_default_border([
                'type'  =>  'none',
                'color' =>  '#000'
            ]),
            'archive_border_radius'   => 0,
            'sidebar_background' => online_newspaper_get_color_defaults([ 'solid' => '' ]),
            'sidebar_border'  =>  online_newspaper_default_border([
                'type'  =>  'none',
                'color' =>  '#000'
            ]),
            'sidebar_border_radius'   => 0,
            'sidebar_padding'  =>  [
                'desktop' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ]
            ],
            // MARK: Pagination
            'archive_pagination_type'   => 'number',
            'pagination_button_text_color' => [ 
                'initial'   =>  online_newspaper_get_color_defaults([ 'solid' => '#000' ]),
                'hover' =>  online_newspaper_get_color_defaults([ 'solid' => '--online-newspaper-global-preset-theme-color' ])
            ],
            'pagination_button_background_color'    =>  [
                'initial'   => online_newspaper_get_color_defaults(),
                'hover'   => online_newspaper_get_color_defaults()
            ],
            // MARK: Page
            'page_width_layout' => 'global',
            'page_show_original_image_option'  =>  false,
            'page_image_caption'  =>  false,
            'page_image_ratio'   =>  online_newspaper_get_responsive_defaults(),
            // MARK: 404 Page
            'error_page_image'  => 0,
            'error_page_width_layout' => 'global',
            // MARK: Search Page
            'search_page_width_layout' => 'global',
            // MARK: Typography Presets
            'typography_presets'    =>  [
                'typographies'    =>  [
                    online_newspaper_get_typography_defaults([
                        'font_family'   => [ 'value' => 'Inter', 'label' => 'Inter' ],
                        'font_size'   => online_newspaper_get_responsive_defaults( 16, 16, 16 ),
                        'line_height'   => online_newspaper_get_responsive_defaults( 20, 20, 20 ),
                        'letter_spacing'   => online_newspaper_get_responsive_defaults( 0.3, 0.3, 0.3 )
                    ]),
                    online_newspaper_get_typography_defaults([
                        'font_family'   => [ 'value' => 'Outfit', 'label' => 'Outfit' ],
                        'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                        'font_size'   => online_newspaper_get_responsive_defaults( 13, 13, 13 ),
                        'line_height'   => online_newspaper_get_responsive_defaults( 23, 23, 23),
                        'letter_spacing'   => online_newspaper_get_responsive_defaults( 0.3, 0.3, 0.3 ),
                        'text_transform'    => 'uppercase'
                    ]),
                    online_newspaper_get_typography_defaults([
                        'font_family'   => [ 'value' => 'Open Sans', 'label' => 'Open Sans' ],
                        'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                        'font_size'   => online_newspaper_get_responsive_defaults( 14, 14, 14 ),
                        'line_height'   => online_newspaper_get_responsive_defaults( 25, 25, 25 ),
                        'letter_spacing'   => online_newspaper_get_responsive_defaults()
                    ])
                ],
                'labels'    =>  [ esc_html__( 'Typography 1', 'online-newspaper' ), esc_html__( 'Typography 2', 'online-newspaper' ), esc_html__( 'Typography 3', 'online-newspaper' ) ]
            ],
            'site_post_title_typo' =>  online_newspaper_get_typography_defaults([
                'font_family'       =>  [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'       =>  [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size'         =>  online_newspaper_get_responsive_defaults( 22, 21, 20 ),
                'line_height'       =>  online_newspaper_get_responsive_defaults( 24, 32, 30 )
            ]),
            'site_post_meta_typo' =>  online_newspaper_get_typography_defaults([
                'font_family'       =>  [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'       =>  [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size'         =>  online_newspaper_get_responsive_defaults( 13, 13, 13 ),
                'line_height'       =>  online_newspaper_get_responsive_defaults( 20, 20, 20 ),
                'letter_spacing'    =>  online_newspaper_get_responsive_defaults( 0.48, 0.48, 0.48 )
            ]),
            'site_post_content_typo' =>  online_newspaper_get_typography_defaults([
                'font_family'       =>  [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'       =>  [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size'         =>  online_newspaper_get_responsive_defaults( 15, 15, 15 ),
                'line_height'       =>  online_newspaper_get_responsive_defaults( 24, 24, 24 ),
                'letter_spacing'    =>  online_newspaper_get_responsive_defaults( 0, 0, 0 )
            ]),
            // MARK: Scroll To Top
            'stt_responsive_option'    => array(
                'desktop'   => true,
                'tablet'   => true,
                'mobile'   => false
            ),
            'stt_label'   =>  esc_html__( 'Back To Top', 'online-newspaper' ),
            'stt_color_group' => online_newspaper_get_color_defaults([
                'initial'   =>  [ 'solid' => '#fff' ],
                'hover'     =>  [ 'solid' => '#fff' ],
            ]),
            // MARK: Category Colors
            'global_category_typography'    =>  online_newspaper_get_typography_defaults([
                'font_family'       =>  [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'       =>  [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size'         =>  online_newspaper_get_responsive_defaults( 13, 13, 13 ),
                'line_height'       =>  online_newspaper_get_responsive_defaults( 20, 20, 20 ),
                'letter_spacing'    =>  online_newspaper_get_responsive_defaults( 0.48, 0.48, 0.48 )
            ]),
            // MARK: Header builder
            'header_builder'    =>  [
                '00'    =>  [],
                '01'    =>  [],
                '02'    =>  [],
                '03'    =>  [],
                '10'    =>  [ 'social-icons' ],
                '11'    =>  [ 'site-logo' ],
                '12'    =>  [ 'newsletter' ],
                '13'    =>  [],
                '20'    =>  [ 'off-canvas' ],
                '21'    =>  [ 'menu' ],
                '22'    =>  [ 'theme-mode', 'search' ],
                '23'    =>  []
            ],
            'header_builder_section_width'  =>  'boxed--layout',
            'header_buiilder_header_sticky' =>  false,
            'header_first_row_header_sticky'    =>  false,
            'header_second_row_header_sticky'   =>  false,
            'header_third_row_header_sticky'    =>  true,   
            'header_builder_background' =>  online_newspaper_get_color_defaults( [ 'solid' => '#000' ] ),
            // MARK: Header Builder 1st Row
            'header_first_row_column'   =>  2,
            'header_first_row_column_layout'    =>  online_newspaper_get_responsive_defaults( 'one', 'one', 'one' ),
            'header_first_row_full_width' =>  true,
            'header_first_row_background'   =>  online_newspaper_get_color_defaults(),
            'header_first_row_column_one'   =>  online_newspaper_get_responsive_defaults( 'left', 'left', 'center' ),
            'header_first_row_column_two'   =>  online_newspaper_get_responsive_defaults( 'right', 'right', 'center' ),
            'header_first_row_column_three' =>  online_newspaper_get_responsive_defaults( 'right', 'right', 'right' ),
            // MARK: Header Builder 2nd Row
            'header_second_row_column'   =>  3,
            'header_second_row_column_layout'    =>  online_newspaper_get_responsive_defaults( 'three', 'three', 'four' ),
            'header_second_row_full_width' =>  false,
            'header_second_row_background'   =>  online_newspaper_get_color_defaults(),
            'header_second_row_column_one'   =>  online_newspaper_get_responsive_defaults( 'left', 'center', 'center' ),
            'header_second_row_column_two'   =>  online_newspaper_get_responsive_defaults( 'center', 'center', 'center' ),
            'header_second_row_column_three' =>  online_newspaper_get_responsive_defaults( 'right', 'right', 'right' ),
            // MARK: Header Builder 3rd Row
            'header_third_row_column'   =>  3,
            'header_third_row_column_layout'    =>  online_newspaper_get_responsive_defaults( 'four', 'three', 'one' ),
            'header_third_row_full_width' =>  true,
            'header_third_row_background'   =>  online_newspaper_get_color_defaults( [ 'solid' => '#151515' ] ),
            'header_third_row_column_one'   =>  online_newspaper_get_responsive_defaults( 'left', 'left', 'left' ),
            'header_third_row_column_two'   =>  online_newspaper_get_responsive_defaults( 'center', 'center', 'center' ),
            'header_third_row_column_three' =>  online_newspaper_get_responsive_defaults( 'right', 'right', 'right' ),
            // MARK: Responsive Builder
            'responsive_header_builder' =>  [
                '00'    =>  [],
                '01'    =>  [],
                '02'    =>  [],
                '03'    =>  [],
                '10'    =>  [],
                '11'    =>  [ 'site-logo' ],
                '12'    =>  [],
                '13'    =>  [],
                '20'    =>  [ 'toggle-button' ],
                '21'    =>  [],
                '22'    =>  [],
                '23'    =>  [],
                'responsive-canvas' =>  [ 'menu' ]
            ],
            // MARK: Date Time
            'time_option'   =>  false,
            'date_option'   =>  true,
            'date_time_display_block'   =>  false,
            'date_time_typography'  =>  online_newspaper_get_typography_defaults([
                'font_family'   => [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size'   => online_newspaper_get_responsive_defaults( 12, 12, 12 ),
                'line_height'   => online_newspaper_get_responsive_defaults( 20, 20, 20 )
            ]),
            'date_color'    =>  online_newspaper_get_color_defaults(),
            'time_color'    =>  online_newspaper_get_color_defaults(),
            // MARK: Secondary Menu
            'secondary_menu_hover_effect'   =>  'none',
            'secondary_menu_typo'   =>  online_newspaper_get_typography_defaults([
                'font_family'       =>  [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'       =>  [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size'         =>  online_newspaper_get_responsive_defaults( 12, 12, 12 ),
                'line_height'   => online_newspaper_get_responsive_defaults( 20, 20, 20 )
            ]),
            'secondary_menu_color'  =>  online_newspaper_get_color_defaults([ 'solid' => '#000' ]),
            // MARK: Mobile Canvas
            'mobile_canvas_alignment'   =>  'left',
            'mobile_canvas_icon_color'  =>  [
                'initial'   =>  online_newspaper_get_color_defaults([ 'solid' => '--online-newspaper-global-preset-theme-color' ]),
                'hover'   =>  online_newspaper_get_color_defaults([ 'solid' => '--online-newspaper-global-preset-theme-color' ])
            ],
            'mobile_canvas_text_color'  =>  online_newspaper_get_color_defaults([ 'solid' => '#000' ]),
            'mobile_canvas_background'  =>  online_newspaper_get_color_defaults([ 'solid' => '#FBFBFB' ]),
            'mobile_canvas_padding'   =>  [
                'desktop' => [ 'top' => 20, 'right' => 50, 'bottom' => 20, 'left' => 50, 'link' => true ],
                'tablet' => [ 'top' => 20, 'right' => 50, 'bottom' => 20, 'left' => 50, 'link' => true ],
                'smartphone' => [ 'top' => 20, 'right' => 20, 'bottom' => 20, 'left' => 20, 'link' => true ]
            ],
            // MARK: Footer Builder
            'footer_builder'    =>  [
                '00'    =>  [],
                '01'    =>  [],
                '02'    =>  [],
                '03'    =>  [],
                '10'    =>  [],
                '11'    =>  [],
                '12'    =>  [],
                '13'    =>  [],
                '20'    =>  [ 'social-icons' ],
                '21'    =>  [ 'menu' ],
                '22'    =>  [ 'copyright','scroll-to-top' ],
                '23'    =>  [],
            ],
            'footer_builder_section_width'  =>  'boxed--layout',
            'footer_builder_background' =>  online_newspaper_get_color_defaults([ 'solid' => '#000' ]),
            'footer_title_typography'   =>  online_newspaper_get_typography_defaults(),
            'footer_text_typography'    =>  online_newspaper_get_typography_defaults(),
            // MARK: Footer First row
            'footer_first_row_column'  =>  1,
            'footer_first_row_column_layout'  =>  online_newspaper_get_responsive_defaults( 'one', 'two', 'two' ),
            'footer_first_row_full_width' =>  true,
            'footer_first_row_row_direction'  =>  'horizontal',
            'footer_first_row_background'   =>  online_newspaper_get_color_defaults([ 'solid' => '' ]),
            'footer_first_row_column_one'   =>  online_newspaper_get_responsive_defaults( 'center', 'center', 'center' ),
            'footer_first_row_column_two'   =>  online_newspaper_get_responsive_defaults( 'center', 'center', 'center' ),
            'footer_first_row_column_three'   =>  online_newspaper_get_responsive_defaults( 'center', 'center', 'center' ),
            'footer_first_row_column_four'   =>  online_newspaper_get_responsive_defaults( 'right', 'right', 'right' ),
            // MARK: Footer Second row
            'footer_second_row_column'  =>  1,
            'footer_second_row_column_layout'  =>  online_newspaper_get_responsive_defaults( 'one', 'one', 'three' ),
            'footer_second_row_full_width' =>  true,
            'footer_second_row_row_direction'  =>  'horizontal',
            'footer_second_row_background'  =>  online_newspaper_get_color_defaults([ 'solid' => '#ffffff00' ]),
            'footer_second_row_column_one'   =>  online_newspaper_get_responsive_defaults( 'center', 'center', 'center' ),
            'footer_second_row_column_two'   =>  online_newspaper_get_responsive_defaults( 'right', 'right', 'center' ),
            'footer_second_row_column_three'   =>  online_newspaper_get_responsive_defaults( 'center', 'center', 'center' ),
            'footer_second_row_column_four'   =>  online_newspaper_get_responsive_defaults( 'right', 'right', 'right' ),
            // MARK: Footer Third row
            'footer_third_row_column'  =>  3,
            'footer_third_row_column_layout'  =>  online_newspaper_get_responsive_defaults( 'one', 'one', 'one' ),
            'footer_third_row_full_width' =>  true,
            'footer_third_row_row_direction'  =>  'vertical',
            'footer_third_row_background'   =>  online_newspaper_get_color_defaults([ 'solid' => '#ffffff00' ]),
            'footer_third_row_column_one'   =>  online_newspaper_get_responsive_defaults( 'center', 'center', 'center' ),
            'footer_third_row_column_two'   =>  online_newspaper_get_responsive_defaults( 'center', 'center', 'center' ),
            'footer_third_row_column_three'   =>  online_newspaper_get_responsive_defaults( 'center', 'center', 'center' ),
            'footer_third_row_column_four'   =>  online_newspaper_get_responsive_defaults( 'right', 'right', 'right' ),
            // MARK: Footer Logo
            'bottom_footer_logo_option' =>  0,
            'bottom_footer_header_or_custom'    =>  'header',
            'bottom_footer_logo_width'  =>  online_newspaper_get_responsive_defaults( 200, 200, 200 ),
            // MARK: Footer Copyright
            'bottom_footer_site_info'   => esc_html__( 'Online Newspaper - News / Magazine WordPress Theme %year%.', 'online-newspaper' ),
            'bottom_footer_text_typography' =>  online_newspaper_get_typography_defaults([
                'font_family' => [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight' => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' => online_newspaper_get_responsive_defaults( 14, 14, 14 ),
                'line_height' => online_newspaper_get_responsive_defaults( 24, 24, 24 ),
            ]),
            // MARK: Footer Menu
            'footer_menu_hover_effect'  =>  'none',
            'footer_menu_typography'    =>  online_newspaper_get_typography_defaults([
                'font_family'       =>  [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'       =>  [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'line_height'       =>  online_newspaper_get_responsive_defaults( 20, 20, 20 ),
                'letter_spacing'    =>  online_newspaper_get_responsive_defaults( 0.3, 0.3, 0.3 )
            ]),
            'footer_menu_color' =>  [
                'initial'   =>  online_newspaper_get_color_defaults(),
                'hover'   =>  online_newspaper_get_color_defaults( [ 'solid' =>  '#ffffffb3' ] )
            ],
            // MARK: Footer Social Icons
            'footer_social_icons'   =>  json_encode([
                [
                    'icon_class'    => 'fa-brands fa-facebook-f',
                    'icon_url'      => '',
                    'icon_count'      => '1K',
                    'icon_label'      => esc_html__( 'Facebook', 'online-newspaper' ),
                    'item_option'   => 'show'
                ],
                [
                    'icon_class'    => 'fa-brands fa-instagram',
                    'icon_url'      => '',
                    'icon_count'      => '1K',
                    'icon_label'      => esc_html__( 'Instagram', 'online-newspaper' ),
                    'item_option'   => 'show'
                ],
                [
                    'icon_class'    => 'fa-brands fa-whatsapp',
                    'icon_url'      => '',
                    'icon_count'      => '1K',
                    'icon_label'      => esc_html__( 'Twitter', 'online-newspaper' ),
                    'item_option'   => 'show'
                ]
            ]),
            'footer_social_icons_display_label' =>  false,
            // MARK: Advertisement
            'advertisement_repeater'   =>  json_encode([
                [
                    'item_image'    => 0,
                    'item_url'      => home_url(),
                    'item_option'   => 'show',
                    'item_target'   =>  '_blank',
                    'item_rel_attribute'    =>  'nofollow',
                    'item_heading'  =>  esc_html__( 'Display Area', 'online-newspaper' ),
                    'item_checkbox_before_post_content'  => false,
                    'item_checkbox_after_post_content'  =>  false,
                    'item_checkbox_random_post_archives'  =>    false,
                    'item_alignment'    =>  'center',
                    'item_image_option' =>  'original'
                ],
                [
                    'item_image'    => 0,
                    'item_url'      => home_url(),
                    'item_option'   => 'show',
                    'item_target'   =>  '_blank',
                    'item_rel_attribute'    =>  'nofollow',
                    'item_heading'  =>  esc_html__( 'Display Area', 'online-newspaper' ),
                    'item_checkbox_before_post_content'  => false,
                    'item_checkbox_after_post_content'  =>  false,
                    'item_checkbox_random_post_archives'  =>    false,
                    'item_alignment'    =>  'center',
                    'item_image_option' =>  'original'
                ]
            ]),
            // MARK: WEB STORIES
            'web_stories_categories_to_include' =>  [],
            'web_stories_orderby'   =>  'asc-name',
            'web_stories_no_of_cats_to_show'    =>  5,
            'web_stories_max_no_of_inner_stories'   =>  10,
            'web_stories_image_sizes'   =>  'large',
            'web_stories_image_ratio'   =>  online_newspaper_get_responsive_defaults( 1.2, 1.1, 0.9 ),
            'web_stories_full_width_blocks_width_layout'  => 'global',
            'web_stories_background_color_group' => online_newspaper_get_color_defaults([ 'solid' => '' ]),
            'web_stories_preview_count_typo'    =>  online_newspaper_get_typography_defaults([
                'font_size' =>  online_newspaper_get_responsive_defaults( 12, 12, 12 ),
                'line_height' =>  online_newspaper_get_responsive_defaults( 20, 20, 20 ),
                'letter_spacing' =>  online_newspaper_get_responsive_defaults( 0.3, 0.3, 0.3 )
            ]),
            'web_stories_preview_title_typo'    =>  online_newspaper_get_typography_defaults([
                'font_size' =>  online_newspaper_get_responsive_defaults( 16, 16, 20 ),
                'line_height' =>  online_newspaper_get_responsive_defaults( 25, 25, 25 ),
                'letter_spacing' =>  online_newspaper_get_responsive_defaults( 0, 0, 0 )
            ]),
            'web_stories_title_typo'    =>  online_newspaper_get_typography_defaults([
                'font_size' =>  online_newspaper_get_responsive_defaults( 22, 22, 22 ),
                'line_height' =>  online_newspaper_get_responsive_defaults( 30, 30, 30 ),
                'letter_spacing' =>  online_newspaper_get_responsive_defaults( 0, 0, 0 )
            ]),
            'web_stories_card_enable'  => true,
            'web_stories_section_border'  =>  online_newspaper_default_border([
                'type'  =>  'none',
                'color' =>  '#000'
            ]),
            'web_stories_section_border_radius'   => 0,
            // MARK: Sticky Posts
            'sticky_posts_option' =>  false,
            'sticky_posts_position' =>  'left',
            'sticky_posts_posts_to_append' =>  3,
            'sticky_posts_categories' =>  [],
            'sticky_posts_to_include' =>  [],
            'sticky_posts_order' =>  'date-desc',
            'sticky_posts_to_show' =>  6,
            'sticky_hide_empty' =>  false,
            'sticky_posts_label_typography' =>  online_newspaper_get_typography_defaults(),
            'sticky_posts_title_typography' =>  online_newspaper_get_typography_defaults(),
            'single_post_card_enable' =>  true,
            'page_card_enable' =>  true,
        ));

        // MARK: Category Colors
        $totalCats = get_categories([ 'fields' => 'ids' ]);
        if( $totalCats ) :
            foreach( $totalCats as $index => $cat_id ) :
                $array_defaults[ 'category_colors' ][ $cat_id ][ 'color' ] = [
                    'initial'   =>  [
                        'type'  =>  'solid',
                        'solid' =>  '#fff'
                    ],
                    'hover'   =>  [
                        'type'  =>  'solid',
                        'solid' =>  '#fff'
                    ],
                ];
                $array_defaults[ 'category_colors' ][ $cat_id ][ 'background' ] = [
                    'initial'   =>  [
                        'type'  =>  'solid',
                        'solid' => online_newspaper_random_category_colors( $index )
                    ],
                    'hover' =>  [
                        'type'  =>  'solid',
                        'solid' => online_newspaper_random_category_colors( $index )
                    ]
                ];
            endforeach;
        else:
            $array_defaults[ 'category_colors' ] = [];
        endif;

        return $array_defaults[ $key ];
    }
 endif;

if( ! function_exists( 'online_newspaper_get_typography_defaults' ) ) :
    /**
     * Get typography control default values
     * 
     * @since 1.0.0
     */
    function online_newspaper_get_typography_defaults( $value = [] ){
        $default = [
            'font_family'       =>  [ 'value' => 'League Spartan', 'label' => 'League Spartan' ],
            'font_weight'       =>  [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
            'font_size'         =>  online_newspaper_get_responsive_defaults( 14, 14, 14 ),
            'line_height'       =>  online_newspaper_get_responsive_defaults( 21, 21, 21 ),
            'letter_spacing'    =>  online_newspaper_get_responsive_defaults(),
            'text_transform'    =>  'unset',
            'text_decoration'   =>  'none',
            'preset'    =>  '-1'
        ];
        return array_merge( $default, $value );
    }
endif;

if( ! function_exists( 'online_newspaper_get_responsive_defaults' ) ) :
    /**
     * Get default responsive values
     * 
     * @since 1.0.0
     */
    function online_newspaper_get_responsive_defaults( $desktop = 0, $tablet = 0, $smartphone = 0 ){
        $value = [
            'desktop'   => $desktop,
            'tablet'    => $tablet,
            'smartphone' => $smartphone
        ];
        return $value;
    }
endif;

if( ! function_exists( 'online_newspaper_get_color_defaults' ) ) :
    /**
     * Get default responsive values
     * 
     * @since 1.0.0
     */
    function online_newspaper_get_color_defaults( $value = [] ){
        $default = [
            'type'  =>  'solid',
            'solid' =>  '#fff'
        ];
        if( array_key_exists( 'initial', $value ) ) :
            $new_value = [
                'initial'   =>  array_merge( $default, $value[ 'initial' ] ),
                'hover'     =>  array_merge( $default, $value[ 'hover' ] )
            ];
            return $new_value;
        endif;
        return array_merge( $default, $value );
    }
endif;

if( ! function_exists( 'online_newspaper_random_category_colors' ) ) :
    /**
     * Random Category Colors
     */
    function online_newspaper_random_category_colors( $index = 0 ) {
        $colors = [ 
            "#00695C", "#512DA8", "#E65100", "#1565C0", "#C62828", "#1E88E5", "#4A148C", "#2E7D32", "#283593", "#6A1B9A", "#311B92", "#1B5E20", "#B71C1C", "#0D47A1", "#BF360C", "#00897B", "#1976D2", "#D32F2F", "#7B1FA2", "#F57C00" 
        ];
        if( ! isset( $colors[ $index ] ) ) return '#000';
        return $colors[ $index ];
    }
endif;

if( ! function_exists( 'online_newspaper_default_border' ) ) :
    /**
     * Border Default
     * 
     * @since 1.0.0
     */
    function online_newspaper_default_border( $append = [] ) {
        $default = [
            "type"  =>  "none", 
            "width"   =>    [ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1, 'link' => true ],
            "color"   =>    "#000"
        ];
        if( ! empty( $append ) && is_array( $append ) ) return array_merge( $default, $append );
        return $default;
    }
endif;

if( ! function_exists( 'online_newspaper_default_box_shadow' ) ) :
    /**
     * Box Shadow Default
     * 
     * @since 1.0.0
     */
    function online_newspaper_default_box_shadow( $append = [] ) {
        $default = [
            'option'    =>  true,
            'hoffset'   =>  0,
            'voffset'   =>  0,
            'blur'  =>  20,
            'spread'    =>  0,
            'type'  =>  'outset',
            'color' =>  'rgb(0 0 0 / 3%)'
        ];
        if( ! empty( $append ) && is_array( $append ) ) return array_merge( $default, $append );
        return $default;
    }
endif;


if( ! function_exists( 'online_newspaper_default_icon_picker' ) ) :
    /**
     * Icon Picker Default
     * 
     * @since 1.0.0
     */
    function online_newspaper_default_icon_picker( $append = [] ) {
        $default = [
            'type'  => 'icon',
            'value' => 'fa-solid fa-arrow-right'
        ];
        if( ! empty( $append ) && is_array( $append ) ) return array_merge( $default, $append );
        return $default;
    }
endif;