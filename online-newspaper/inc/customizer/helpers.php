<?php
/**
 * Includes panel, section and controls ids and parameters
 * 
 * @since 1.0.0
 * @package Online Newspaper
*/

if( ! class_exists( 'Online_Newspaper_Customizer_List' ) ) :
    class Online_Newspaper_Customizer_List {
        /**
         * Returns panels array
         * 
         * @since 1.0.0
         */
        public function get_panels( $id = '' ) {
            $panels_array = [
                'global_panel'    =>  [
                    'title' =>  __( 'Global', 'online-newspaper' ),
                    'priority'  => 6
                ],
                'colors_panel'    =>  [
                    'title' =>  __( 'Colors', 'online-newspaper' ),
                    'priority'  => 20
                ],
                'frontpage_panel'    =>  [
                    'title' =>  __( 'Frontpage Sections', 'online-newspaper' ),
                    'priority'  =>  80
                ],
                'archive_panel'    =>  [
                    'title' =>  __( 'Blog / Archives', 'online-newspaper' ),
                    'priority'  =>  80
                ],
                'single_section_panel'    =>  [
                    'title' =>  __( 'Single Post', 'online-newspaper' ),
                    'priority'  =>  80
                ],
                'page_setting_panel'    =>  [
                    'title' =>  __( 'Page Settings', 'online-newspaper' ),
                    'priority'  =>  80
                ]
            ];
            return ( $id ? $panels_array[ $id ] : $panels_array );
        }

        /**
         * Returns sections array
         * 
         * @since 1.0.0
         */
        public function get_sections( $id = '' ) {
            $sections_array =  [
                'about_section' => [
                    'title' => esc_html__( 'About Theme', 'online-newspaper' ),
                    'priority'  => 1
                ],
                'header_builder_section' => [
                    'title' => esc_html__( 'Header Builder', 'online-newspaper' ),
                    'active_callback'   =>  function(){ return false; }
                ],
                'footer_builder_section' => [
                    'title' => esc_html__( 'Footer Builder', 'online-newspaper' ),
                    'active_callback'   =>  function(){ return false; }
                ],
                'header_builder_section_settings' => [
                    'title' => esc_html__( 'Header Builder', 'online-newspaper' ),
                    'priority'  => 70
                ],
                'footer_builder_section_settings' => [
                    'title' => esc_html__( 'Footer Builder', 'online-newspaper' ),
                    'priority'  => 80
                ],
                'seo_misc_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'SEO / Misc', 'online-newspaper' ),
                ],
                'preloader_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Preloader', 'online-newspaper' ),
                ],
                'widget_styles_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Widget Styles', 'online-newspaper' ),
                ],
                'website_layout_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Website Layout', 'online-newspaper' ),
                ],
                'sidebar_options_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Sidebar Options', 'online-newspaper' ),
                ],
                'animation_section' => [
                    'title' => esc_html__( 'Animation / Hover Effects', 'online-newspaper' ),
                    'panel' => 'global_panel'
                ],
                'social_icons_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Social Icons', 'online-newspaper' ),
                ],
                'footer_social_icons_section' => [
                    'title' => esc_html__( 'Social Icons', 'online-newspaper' ),
                ],
                'buttons_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Buttons', 'online-newspaper' ),
                ],
                'global_icon_pickers' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Icon Pickers', 'online-newspaper' ),
                ],
                'breadcrumb_options_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Breadcrumb Options', 'online-newspaper' ),
                ],
                'stt_options_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Scroll To Top', 'online-newspaper' ),
                ],
                'global_icon_pickers' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Icon Pickers', 'online-newspaper' ),
                ],
                'advertisement_section' => [
                    'title' =>  esc_html__( 'Advertisement', 'online-newspaper' ),
                    'priority'  =>  29
                ],
                'typography_section' => [
                    'title' => esc_html__( 'Typography', 'online-newspaper' ),
                    'priority'  => 30
                ],
                'theme_presets_section' => [
                    'panel' =>  'colors_panel',
                    'title' =>  esc_html__( 'Theme Colors / Presets', 'online-newspaper' ),
                ],
                'category_colors_section' => [
                    'panel' => 'colors_panel',
                    'title' => esc_html__( 'Category Colors', 'online-newspaper' ),
                ],
                'tag_colors_section' => [
                    'title' => esc_html__( 'Tag Colors', 'online-newspaper' ),
                    'panel' => 'colors_panel',
                ],
                'date_time_section' => [
                    'title' =>  esc_html__( 'Date / Time', 'online-newspaper' )
                ],
                'random_news_section' => [
                    'title' =>  esc_html__( 'Random News', 'online-newspaper' )
                ],
                'header_menu_options_section' => [
                    'title' =>  esc_html__( 'Menu Options', 'online-newspaper' )
                ],
                'footer_menu_options_section' => [
                    'title' =>  esc_html__( 'Menu Options', 'online-newspaper' )
                ],
                'header_live_search_section' => [
                    'title' =>  esc_html__( 'Search', 'online-newspaper' )
                ],
                'header_newsletter_section' => [
                    'title' =>  esc_html__( 'Newsletter / Subscribe Button', 'online-newspaper' )
                ],
                'custom_button_section' => [
                    'title' =>  esc_html__( 'Custom Button', 'online-newspaper' )
                ],
                'theme_mode_section' => [
                    'title' =>  esc_html__( 'Theme Mode', 'online-newspaper' )
                ],
                'canvas_menu_section' => [
                    'title' =>  esc_html__( 'Off canvas', 'online-newspaper' )
                ],
                'header_advertisement_banner_section' => [
                    'title' =>  esc_html__( 'Advertisement Banner', 'online-newspaper' )
                ],
                'sticky_posts_section' => [
                    'title' =>  esc_html__( 'Sticky Posts', 'online-newspaper' ),
                    'priority'  => 70
                ],
                'ticker_news_section' => [
                    'title' =>  esc_html__( 'Ticker News', 'online-newspaper' ),
                ],
                'main_banner_section' => [
                    'title' =>  esc_html__( 'Main Banner', 'online-newspaper' ),
                    'panel' =>  'frontpage_panel'
                ],
                'archive_general_section' => [
                    'panel'  =>  'archive_panel',
                    'title' =>  esc_html__( 'General Settings', 'online-newspaper' ),
                ],
                'pagination_settings_section' => [
                    'panel'  =>  'archive_panel',
                    'title' =>  esc_html__( 'Pagination Settings', 'online-newspaper' ),
                ],
                'single_general_settings' => [
                    'panel' =>  'single_section_panel',
                    'title' =>  esc_html__( 'General Settings', 'online-newspaper' ),
                ],
                'single_related_posts_section' => [
                    'panel' =>  'single_section_panel',
                    'title' =>  esc_html__( 'Related Posts', 'online-newspaper' )
                ],
                'page_settings_section' => [
                    'panel' =>  'page_setting_panel',
                    'title' =>  esc_html__( 'Page Settings', 'online-newspaper' )
                ],
                '404_section' => [
                    'panel' =>  'page_setting_panel',
                    'title' =>  esc_html__( '404 Page', 'online-newspaper' )
                ],
                'search_page_settings' => [
                    'panel' =>  'page_setting_panel',
                    'title' =>  esc_html__( 'Search Page', 'online-newspaper' )
                ],
                /* Header builder row settings section */
                'header_first_row' => [
                    'title' => esc_html__( 'Header First Row', 'online-newspaper' )
                ],
                'header_second_row' => [
                    'title' => esc_html__( 'Header Second Row', 'online-newspaper' )
                ],
                'header_third_row' => [
                    'title' => esc_html__( 'Header Third Row', 'online-newspaper' )
                ],
                /* Footer builder row settings section */
                'footer_first_row' => [
                    'title' => esc_html__( 'Footer First Row', 'online-newspaper' )
                ],
                'footer_second_row' => [
                    'title' => esc_html__( 'Footer Second Row', 'online-newspaper' )
                ],
                'footer_third_row' => [
                    'title' => esc_html__( 'Footer Third Row', 'online-newspaper' )
                ],
                'footer_logo' => [
                    'title' => esc_html__( 'Footer Logo Settings', 'online-newspaper' )
                ],
                'footer_copyright' => [
                    'title' => esc_html__( 'Footer Copyright', 'online-newspaper' )
                ],
                'mobile_canvas_section' => [
                    'title' => esc_html__( 'Mobile Canvas', 'online-newspaper' )
                ],
                'secondary_menu_options' => [
                    'title' => esc_html__( 'Menu Options', 'online-newspaper' )
                ],
                'web_stories_section'    =>  [
                    'title' =>  esc_html__( 'Web Stories', 'online-newspaper' ),
                    'panel' =>  'frontpage_panel'
                ],
                'full_width_section'    =>  [
                    'title' =>  esc_html__( 'Full Width', 'online-newspaper' ),
                    'panel' =>  'frontpage_panel'
                ],
                'leftc_rights_section'  =>  [
                    'title' =>  esc_html__( 'Left Content - Right Sidebar', 'online-newspaper' ),
                    'panel' =>  'frontpage_panel'
                ],
                'lefts_rightc_section'  =>  [
                    'title' =>  esc_html__( 'Left Sidebar - Right Content', 'online-newspaper' ),
                    'panel' =>  'frontpage_panel'
                ],
                'bottom_full_width_section' =>  [
                    'title' =>  esc_html__( 'Bottom Full Width', 'online-newspaper' ),
                    'panel' =>  'frontpage_panel'
                ],
                'two_column_section'    =>  [
                    'title' =>  esc_html__( 'Two Column Section', 'online-newspaper' ),
                    'panel' =>  'frontpage_panel'
                ],
                'front_sections_reorder_section'  =>  [
                    'title' =>  esc_html__( 'Reorder Sections', 'online-newspaper' ),
                    'panel' =>  'frontpage_panel'
                ],
            ];
            return ( $id ? $sections_array[ $id ] : $sections_array );
        }

        /**
         * Returns typography array
         * 
         * @since 1.0.0
         */
        public function get_typography( $id = '' ) {
            $default = [
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ],
                'transport' =>  'postMessage',
                'label' =>  esc_html__( 'Typography', 'online-newspaper' ),
            ];
            $control_array = [
                'site_title_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Site Title Typography', 'online-newspaper' ),
                ]),
                'site_tagline_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Site Description Typography', 'online-newspaper' ),
                    'bottom_separator'  =>  true
                ]),
                'date_time_typography' =>  $this->get_params( $default, []),
                'random_news_typography' =>  $this->get_params( $default, []),
                'header_newsletter_typography' =>  $this->get_params( $default, []),
                'header_menu_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Main Menu Typography', 'online-newspaper' ),
                ]),
                'header_sub_menu_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Sub Menu Typography', 'online-newspaper' )
                ]),
                'global_button_typo'    =>  $this->get_params( $default, [
                    'bottom_separator'  =>  true
                ]),
                'footer_title_typography'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Block Title Typo', 'online-newspaper' ),
                ]),
                'footer_text_typography'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Text Typo', 'online-newspaper' )
                ]),
                'bottom_footer_text_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Text Typo', 'online-newspaper' ),
                ]),
                'footer_menu_typography'  =>  $this->get_params( $default, []),
                'global_category_typography'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Typo', 'online-newspaper' ),
                ]),
                'sticky_posts_label_typography'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Label', 'online-newspaper' ),
                ]),
                'sticky_posts_title_typography'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Post Title', 'online-newspaper' ),
                ]),
                'secondary_menu_typo'  =>  $this->get_params( $default, []),
                'site_block_title_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Block Title', 'online-newspaper' ),
                ]),
                'site_post_title_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Post Title', 'online-newspaper' ),
                ]),
                'site_post_meta_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Post Meta', 'online-newspaper' ),
                ]),
                'site_post_content_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Post Content', 'online-newspaper' ),
                ]),
                'custom_button_text_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Text Typo', 'online-newspaper' ),
                ]),
                'single_post_title_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Post Title', 'online-newspaper' )
                ]),
                'single_post_meta_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Post Meta', 'online-newspaper' )
                ]),
                'single_post_content_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Post Content', 'online-newspaper' )
                ]),
                'web_stories_preview_count_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Preview count', 'online-newspaper' ),
                ]),
                'web_stories_preview_title_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Preview title', 'online-newspaper' ),
                ]),
                'web_stories_title_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Title', 'online-newspaper' ),
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_typography()

        /**
         * Returns Box shadow array
         * 
         * @since 1.0.0
         */
        public function get_box_shadow( $id = '' ) {
            $default = [
                'label' => esc_html__( 'Box Shadow', 'online-newspaper' ),
                'transport' =>  'postMessage'
            ];
            $control_array = [
                'website_box_shadow'    =>  $this->get_params( $default, [
                    'active_callback'   =>   function( $control ){
                        return ( $control->manager->get_setting( 'website_layout' )->value() == 'boxed--layout' );
                    }
                ]),
                'widgets_styles_image_box_shadow'   =>  $this->get_params( $default, [])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns checkbox array
         * 
         * @since 1.0.0
         */
        public function get_checkbox( $id = '' ) {
            $default = [
                'type'  =>  'checkbox',
                'transport' =>  'postMessage'
            ];
            $control_array = [
                'blogdescription_option'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Display site description', 'online-newspaper' ),
                    'priority'  =>  40
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns toggle array
         * 
         * @since 1.0.0
         */
        public function get_toggle( $id = '' ) {
            $default = [];
            $control_array = [
                'sticky_posts_option'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Show Sticky Posts', 'online-newspaper' ),
                ]),
                'site_schema_ready' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Make website schema ready', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'disable_admin_notices'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Disabled the theme admin notices', 'online-newspaper' ),
                    'description'	      => esc_html__( 'This will hide all the notices or any message shown by the theme like review notices, change log notices', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'preloader_option'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Enable site preloader', 'online-newspaper' )
                ]),      
                'single_post_related_posts_option'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Show related articles', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns simple toggle array
         * 
         * @since 1.0.0
         */
        public function get_simple_toggle( $id = '' ) {
            $default = [];
            $control_array = [
                'header_buiilder_header_sticky' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Header Section Sticky', 'online-newspaper' )
                ]),
                'header_first_row_header_sticky' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Header Sticky in 1st row', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ){
                        return $control->manager->get_control( 'header_buiilder_header_sticky' )->value();
                    },
                    'transport' =>  'postMessage'
                ]),
                'header_second_row_header_sticky' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Header Sticky in 2nd row', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ){
                        return $control->manager->get_control( 'header_buiilder_header_sticky' )->value();
                    },
                    'transport' =>  'postMessage'
                ]),
                'header_third_row_header_sticky' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Header Sticky in 3rd row', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ){
                        return $control->manager->get_control( 'header_buiilder_header_sticky' )->value();
                    },
                    'transport' =>  'postMessage',
                    'bottom_separator'  =>  true
                ]),
                'ticker_news_frontpage' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Ticker as Frontpage Section', 'online-newspaper' ),
                    'description' => esc_html__( 'When turned on, ticker will not be shown in header instead will be shown as frontpage section and can be re-ordered.', 'online-newspaper' )
                ]),
                'site_breadcrumb_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show breadcrumb trails', 'online-newspaper' ),
                ]),
                'header_ads_banner_image_link_url' => $this->get_params( $default, [
                    'label' => esc_html__( 'Link Url', 'online-newspaper' )
                ]),
                'global_show_author_image' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show author image', 'online-newspaper' )
                ]),
                'sticky_hide_empty' => $this->get_params( $default, [
                    'label' => esc_html__( 'Hide posts with no featured image', 'online-newspaper' )
                ]),
                'header_first_row_full_width' => $this->get_params( $default, [
                    'label' => esc_html__( 'Row Full Width', 'online-newspaper' ),
                    'description' => esc_html__( 'This only applies to the controls below.', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'header_second_row_full_width' => $this->get_params( $default, [
                    'label' => esc_html__( 'Row Full Width', 'online-newspaper' ),
                    'description' => esc_html__( 'This only applies to the controls below.', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'header_third_row_full_width' => $this->get_params( $default, [
                    'label' => esc_html__( 'Row Full Width', 'online-newspaper' ),
                    'description' => esc_html__( 'This only applies to the controls below.', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'footer_first_row_full_width' => $this->get_params( $default, [
                    'label' => esc_html__( 'Row Full Width', 'online-newspaper' ),
                    'description' => esc_html__( 'This only applies to the controls below.', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'footer_second_row_full_width' => $this->get_params( $default, [
                    'label' => esc_html__( 'Row Full Width', 'online-newspaper' ),
                    'description' => esc_html__( 'This only applies to the controls below.', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'footer_third_row_full_width' => $this->get_params( $default, [
                    'label' => esc_html__( 'Row Full Width', 'online-newspaper' ),
                    'description' => esc_html__( 'This only applies to the controls below.', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'footer_social_icons_display_label' => $this->get_params( $default, [
                    'label' => esc_html__( 'Display Label', 'online-newspaper' )
                ]),
                'time_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Time', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'date_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Date', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'date_time_display_block' => $this->get_params( $default, [
                    'label' => esc_html__( 'Display Block', 'online-newspaper' ),
                    'description'   =>  esc_html__( 'Show date and time in different lines.', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'frontpage_sidebar_sticky_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable sidebar sticky', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'archive_sidebar_sticky_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable sidebar sticky', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'single_sidebar_sticky_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable sidebar sticky', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'page_sidebar_sticky_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable sidebar sticky', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'ticker_news_thumbnail_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show post thumbnail image', 'online-newspaper' )
                ]),
                'main_banner_slider_categories_option'  =>  $this->get_params( $default, [
                    'label'	      => esc_html__( 'Show post categories', 'online-newspaper' )
                ]),
                'main_banner_slider_date_option'    =>  $this->get_params( $default, [
                    'label'	      => esc_html__( 'Show post date', 'online-newspaper' )
                ]),
                'archive_page_title_prefix' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show archive title prefix', 'online-newspaper' )
                ]),
                'archive_page_category_option'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show archive categories', 'online-newspaper' )
                ]),
                'single_post_show_original_image_option'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show original image', 'online-newspaper' )
                ]),
                'single_post_image_caption'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show image caption', 'online-newspaper' )
                ]),
                'page_show_original_image_option'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show original image', 'online-newspaper' )
                ]),
                'page_image_caption'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show image caption', 'online-newspaper' )
                ]),
                'main_banner_card_enable'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable Card', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'web_stories_card_enable'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable Card', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'full_width_card_enable'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable Card', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'leftc_rights_card_enable'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable Card', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'lefts_rightc_card_enable'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable Card', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'bottom_full_width_card_enable'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable Card', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'two_column_card_enable'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable Card', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'archive_card_enable'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable Card', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'ticker_news_card_enable'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable Card', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'single_post_card_enable'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable Card', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'page_card_enable'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable Card', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
                'main_banner_list_posts_categories_option'  =>  $this->get_params( $default, [
                    'label'	      => esc_html__( 'Show post categories', 'online-newspaper' ),
                ]),
                'main_banner_list_posts_date_option'    =>  $this->get_params( $default, [
                    'label'	      => esc_html__( 'Show date', 'online-newspaper' ),
                ]),
                'main_banner_list_posts_author_option'  =>  $this->get_params( $default, [
                    'label'	      => esc_html__( 'Show post author', 'online-newspaper' ),
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_simple_toggle() Method

        /**
         * Get all section tab control
         * 
         * @since 1.0.0
         */
        public function get_section_tab( $id = '' ) {
            $default = [
                'choices'   =>  [
                    [
                        'name'  =>  'general',
                        'title' =>  esc_html__( 'General', 'online-newspaper' )
                    ],
                    [
                        'name'  =>  'design',
                        'title' =>  esc_html__( 'Design', 'online-newspaper' )
                    ]
                ],
                'priority'  =>  1
            ];
            $control_array = [
                'category_colors_section_tab'    =>  $this->get_params( $default, []),
                'date_time_section_tab'    =>  $this->get_params( $default, []),
                'secondary_menu_options_section_tab'    =>  $this->get_params( $default, []),
                'header_builder_section_tab'    =>  $this->get_params( $default, []),
                'site_title_section_tab'    =>  $this->get_params( $default, []),
                'menu_options_section_tab' =>  $this->get_params( $default, []),
                'search_section_tab'    =>  $this->get_params( $default, []),
                'custom_button_section_tab'  =>  $this->get_params( $default, []),
                'theme_mode_section_tab' =>  $this->get_params( $default, []),
                'canvas_menu_setting'   =>  $this->get_params( $default, []),
                'stt_section_tab'   =>  $this->get_params( $default, []),
                'single_post_section_tab'    => $this->get_params( $default, []),
                '404_section_tab'   =>  $this->get_params( $default, []),
                'footer_section_tab'    =>  $this->get_params( $default, []),
                'bottom_footer_section_tab' =>  $this->get_params( $default, []),
                'main_banner_section_tab'  =>  $this->get_params( $default, []),
                'global_icon_pickers_section_tab'   =>  $this->get_params( $default, []),
                'sticky_posts_section_heading'   =>  $this->get_params( $default, []),
                'random_news_section_tab'   =>  $this->get_params( $default, []),
                'subscribe_button_section_tab'   =>  $this->get_params( $default, []),
                'full_width_section_tab'    =>  $this->get_params( $default, []),
                'leftc_rights_section_tab'  =>  $this->get_params( $default, []),
                'lefts_rightc_section_tab'  =>  $this->get_params( $default, []),
                'bottom_full_width_section_tab' =>  $this->get_params( $default, []),
                'two_column_section_tab'    =>  $this->get_params( $default, []),
                'archive_section_tab'  =>  $this->get_params( $default, []),
                'ticker_news_section_heading'  =>  $this->get_params( $default, []),
                'frontpage_sidebar_section_tab'  =>  $this->get_params( $default, []),
                /* Header builder row controls */
                'header_first_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'online-newspaper' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'online-newspaper' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'online-newspaper' )
                        ]
                    ],
                ]),
                'header_second_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'online-newspaper' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'online-newspaper' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'online-newspaper' )
                        ]
                    ],
                ]),
                'header_third_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'online-newspaper' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'online-newspaper' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'online-newspaper' )
                        ]
                    ],
                ]),
                /* Footer builder row controls */
                'footer_first_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'online-newspaper' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'online-newspaper' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'online-newspaper' )
                        ]
                    ],
                ]),
                'footer_second_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'online-newspaper' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'online-newspaper' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'online-newspaper' )
                        ]
                    ],
                ]),
                'footer_third_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'online-newspaper' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'online-newspaper' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'online-newspaper' )
                        ]
                    ],
                ]),
                'mobile_canvas_section_tab'   =>  $this->get_params( $default, [] ),
                'footer_menu_section_tab'   =>  $this->get_params( $default, [] ),
                'web_stories_section_tab'  =>  $this->get_params( $default, []),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_section_tab() Method

        /**
         * Get all spacing controls
         * 
         * @since 1.0.0
         */
        public function get_spacing( $id = '' ) {
            $default = [
                'label' =>  esc_html__( 'Padding ( px )', 'online-newspaper' ),
                'input_attrs' => $this->get_input_attrs([
                    'max'   => 50
                ]),
                'transport' =>  'postMessage'
            ];

            $control_array = [
                'custom_button_padding' =>  $this->get_params( $default, []),
                'mobile_canvas_padding' => $this->get_params( $default, []),
                'leftc_rights_section_sidebar_padding'    =>  $this->get_params( $default, [
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 200
                    ])
                ]),
                'lefts_rightc_section_sidebar_padding'    =>  $this->get_params( $default, [
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 200
                    ])
                ]),
                'sidebar_padding'    =>  $this->get_params( $default, [
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 200
                    ])
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_spacing() Method

        /**
         * Get all radio tab controls
         * 
         * @since 1.0.0
         */
        public function get_radio_tab( $id = '' ) {
            $default = [
                'label' => esc_html__( 'Elements Alignment', 'online-newspaper' ),
                'choices' => [
                    [
                        'value' => 'left',
                        'icon'  =>  'editor-alignleft',
                        'label' =>  esc_html__( 'Left', 'online-newspaper' )
                    ],
                    [
                        'value' => 'center',
                        'icon'  =>  'editor-aligncenter',
                        'label' =>  esc_html__( 'Center', 'online-newspaper' )
                    ],
                    [
                        'value' => 'right',
                        'icon'  =>  'editor-alignright',
                        'label' =>  esc_html__( 'Right', 'online-newspaper' )
                    ]
                ],
                'transport' =>  'postMessage'
            ];
            $control_array = [
                'header_ads_banner_custom_target' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Open in', 'online-newspaper' ),
                    'double_line'   =>  true,
                    'choices'   =>  [
                        [
                            'value' =>  '_blank',
                            'label' =>  esc_html__( 'New tab', 'online-newspaper' )
                        ],
                        [
                            'value' =>  '_self',
                            'label' =>  esc_html__( 'Same tab', 'online-newspaper' )
                        ]
                    ],
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'header_ads_banner_image_link_url' )->value() );
                    }
                ]),
                'custom_button_icon_prefix_suffix'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Context', 'online-newspaper' ),
                    'choices'   =>  [
                        [
                            'value' =>  'prefix',
                            'label' =>  esc_html__( 'Before', 'online-newspaper' )
                        ],
                        [
                            'value' =>  'suffix',
                            'label' =>  esc_html__( 'After', 'online-newspaper' )
                        ]
                    ],
                ]),
                'off_canvas_position'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Canvas Position', 'online-newspaper' ),
                    'choices'   =>  [
                        [
                            'value' => 'left',
                            'label' =>  esc_html__( 'Left', 'online-newspaper' )
                        ],
                        [
                            'value' => 'right',
                            'label' =>  esc_html__( 'Right', 'online-newspaper' )
                        ]
                    ],
                ]),
                'mobile_canvas_alignment'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Alignment', 'online-newspaper' ),
                ]),
                'sticky_posts_position'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Position', 'online-newspaper' ),
                    'choices' => [
                        [
                            'value' => 'left',
                            'icon'  =>  'editor-alignleft',
                            'label' =>  esc_html__( 'Left', 'online-newspaper' )
                        ],
                        [
                            'value' => 'right',
                            'icon'  =>  'editor-alignright',
                            'label' =>  esc_html__( 'Right', 'online-newspaper' )
                        ]
                    ],
                ]),
                /* Footer Builder 1st row */
                'footer_first_row_row_direction'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Row Direction', 'online-newspaper' ),
                    'choices'   =>  [
                        [
                            'value' =>  'vertical',
                            'label' =>  esc_html__( 'Vertical', 'online-newspaper' )
                        ],
                        [
                            'value' =>  'horizontal',
                            'label' =>  esc_html__( 'Horizontal', 'online-newspaper' )
                        ]
                    ],
                ]),
                /* Footer Builder 2nd row */
                'footer_second_row_row_direction'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Row Direction', 'online-newspaper' ),
                    'choices'   =>  [
                        [
                            'value' =>  'vertical',
                            'label' =>  esc_html__( 'Vertical', 'online-newspaper' )
                        ],
                        [
                            'value' =>  'horizontal',
                            'label' =>  esc_html__( 'Horizontal', 'online-newspaper' )
                        ]
                    ],
                ]),
                /* Footer Builder 3rd row */
                'footer_third_row_row_direction'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Row Direction', 'online-newspaper' ),
                   'choices'   =>  [
                        [
                            'value' =>  'vertical',
                            'label' =>  esc_html__( 'Vertical', 'online-newspaper' )
                        ],
                        [
                            'value' =>  'horizontal',
                            'label' =>  esc_html__( 'Horizontal', 'online-newspaper' )
                        ]
                    ],
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_radio_tab() Method

        /**
         * Get all info box control
         * 
         * @since 1.0.0
         */
        public function get_info_box( $id = '' ) {
            $control_array = [
                'site_documentation_info' =>  [
                    'label' => esc_html__( 'Theme Documentation', 'online-newspaper' ),
                    'description' => esc_html__( 'We have well prepared documentation which includes overall instructions and recommendations that are required in this theme.', 'online-newspaper' ),
                    'choices' => [
                        [
                            'label' => esc_html__( 'View Documentation', 'online-newspaper' ),
                            'url'   => esc_url( '//doc.blazethemes.com/online-newspaper' )
                        ]
                    ]
                ],
                'site_support_info'   =>  [
                    'label' => esc_html__( 'Theme Support', 'online-newspaper' ),
                    'description' => esc_html__( 'We provide 24/7 support regarding any theme issue. Our support team will help you to solve any kind of issue. Feel free to contact us.', 'online-newspaper' ),
                    'choices' => [
                        [
                            'label' => esc_html__( 'Support Form', 'online-newspaper' ),
                            'url'   => esc_url( '//blazethemes.com/support' )
                        ]
                    ]
                ]
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_info_box() Method

        /**
         * Get all section heading toggle controls
         * 
         * @since 1.0.0
         */
        public function get_section_heading_toggle( $id = '' ) {
            $default = [];
            $control_array = [
                'logo_and_icon_section_toggle'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Logo & Site Icon', 'online-newspaper' ),
                    'priority'  =>  5
                ]),
                'site_title_section_toggle'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Site Title & Tagline', 'online-newspaper' ),
                    'priority'  =>  20
                ]),
                'sticky_posts_posts_query_section_toggle'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Query Settings', 'online-newspaper' )
                ]),
                'archive_page_layout_header'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Layout Settings', 'online-newspaper' )
                ]),
                'archive_page_elements_setting_header'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Elements Settings', 'online-newspaper' )
                ]),
                'archive_image_settings_header' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Settings', 'online-newspaper' )
                ]),
                'single_post_typo_heading' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Typography', 'online-newspaper' )
                ]),
                'web_stories_query_settings_heading_toggle'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Query Settings', 'online-newspaper' ),
                ]),
                'web_stories_image_settings'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Image Settings', 'online-newspaper' ),
                ]),
                'single_post_card_settings'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Card Settings', 'online-newspaper' ),
                ]),
                'page_card_settings'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Card Settings', 'online-newspaper' ),
                ]),
            ];
            $totalCats = get_categories();
            if( $totalCats ) :
                foreach( $totalCats as $singleCat ) :
                    $cat_id = 'category_' . absint( $singleCat->term_id ) . '_color_heading';
                    $control_array[ $cat_id ] = [
                        'label' => esc_html( $singleCat->name ),
                        'bottom_separator'  =>  true
                    ];
                endforeach;
            endif;

            $totalTags = get_tags();
            $tag_priority = 10;
            if( $totalTags ) :
                foreach( $totalTags as $singleTag ) :
                    $tag_id = 'tag_' . absint( $singleTag->term_id ) . '_color_heading';
                    $control_array += [ $tag_id =>  [
                        'label' => esc_html( $singleTag->name ),
                        'bottom_separator'  =>  true
                    ]];
                    $tag_priority += 10;
                endforeach;
            endif;
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_section_heading_toggle() Method

        /**
         * Get all item sortable control
         * 
         * @since 1.0.0
         */
        public function get_item_sortable( $id = '' ) {
            $control_array = [
                'homepage_content_order'    =>  [
                    'label'         => esc_html__( 'Section Settings', 'online-newspaper' ),
                    'label'         => esc_html__( 'Section Re-order', 'online-newspaper' ),
                    'description'   => esc_html__( 'Hold item and drag vertically to re-order the items', 'online-newspaper' ),
                    'fields'    => [
                        'ticker_news_section'  => [
                            'label' => esc_html__( 'Ticker news Section', 'online-newspaper' )
                        ],
                        'main_banner_section'  => [
                            'label' => esc_html__( 'Main Banner Section', 'online-newspaper' )
                        ],
                        'web_stories_section'  => [
                            'label' => esc_html__( 'Web Stories Section', 'online-newspaper' )
                        ],
                        'full_width_section'  => [
                            'label' => esc_html__( 'Full width Section', 'online-newspaper' )
                        ],
                        'leftc_rights_section'  => [
                            'label' => esc_html__( 'Left Content - Right Sidebar', 'online-newspaper' )
                        ],
                        'lefts_rightc_section'  => [
                            'label' => esc_html__( 'Left Sidebar - Right Content', 'online-newspaper' )
                        ],
                        'bottom_full_width_section'  => [
                            'label' => esc_html__( 'Bottom Full width Section', 'online-newspaper' )
                        ],
                        'two_column_section'  => [
                            'label' => esc_html__( 'Two Column Section', 'online-newspaper' )
                        ],
                        'latest_posts'  => [
                            'label' => esc_html__( 'Latest Posts / Page Content', 'online-newspaper' )
                        ]
                    ]
                ],
                'archive_post_element_order'    =>  [
                    'label'         => esc_html__( 'Elements Re-order', 'online-newspaper' ),
                    'fields'    => [
                        'title'  => [
                            'label' => esc_html__( 'Title', 'online-newspaper' )
                        ],
                        'meta'  => [
                            'label' => esc_html__( 'Meta', 'online-newspaper' )
                        ],
                        'excerpt'  => [
                            'label' => esc_html__( 'Excerpt', 'online-newspaper' )
                        ],
                        'button'  => [
                            'label' => esc_html__( 'Button', 'online-newspaper' )
                        ]
                    ]
                ],
                'archive_post_meta_order'   =>  [
                    'label'         => esc_html__( 'Meta Re-order', 'online-newspaper' ),
                    'fields'    => [
                        'author'  => [
                            'label' => esc_html__( 'Author Name', 'online-newspaper' )
                        ],
                        'date'  => [
                            'label' => esc_html__( 'Published/Modified Date', 'online-newspaper' )
                        ],
                        'comments'  => [
                            'label' => esc_html__( 'Comments Number', 'online-newspaper' )
                        ],
                        'read-time'  => [
                            'label' => esc_html__( 'Read Time', 'online-newspaper' )
                        ]
                    ]
                ],
                'single_post_meta_order'   =>  [
                    'label'         => esc_html__( 'Meta Re-order', 'online-newspaper' ),
                    'fields'    => [
                        'author'  => [
                            'label' => esc_html__( 'Author Name', 'online-newspaper' )
                        ],
                        'date'  => [
                            'label' => esc_html__( 'Published/Modified Date', 'online-newspaper' )
                        ],
                        'comments'  => [
                            'label' => esc_html__( 'Comments Number', 'online-newspaper' )
                        ],
                        'read-time'  => [
                            'label' => esc_html__( 'Read Time', 'online-newspaper' )
                        ]
                    ]
                ],
                'banner_section_three_column_order' =>  [
                    'label'         => esc_html__( 'Layout Five Column Re-order', 'online-newspaper' ),
                    'fields'    => [
                        'list_posts'  => [
                            'label' => esc_html__( 'List Posts Column', 'online-newspaper' )
                        ],
                        'banner_slider'  => [
                            'label' => esc_html__( 'Banner Slider Column', 'online-newspaper' )
                        ],
                        'grid_slider'  => [
                            'label' => esc_html__( 'Grid Posts Slider Column', 'online-newspaper' )
                        ]
                    ]
                ],
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_item_sortable() Method


        /**
         * Get all number controls
         * 
         * @since 1.0.0
         */
        public function get_number( $id = '' ) {
            $default = [
                'unit'  =>  'px',
                'input_attrs'   =>  $this->get_input_attrs(),
                'responsive'    =>  true,
                'transport' =>  'postMessage'
            ];
            $control_array = [
                'site_logo_width'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Logo Width (px)', 'online-newspaper' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  400,
                        'min'   =>  100
                    ])
                ]),
                'search_icon_size'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Size (px)', 'online-newspaper' ),
                    'input_attrs'   =>  $this->get_input_attrs([])
                ]),
                'header_custom_button_border_radius' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'online-newspaper' ),
                    'input_attrs'   =>  $this->get_input_attrs([]),
                ]),
                'custom_button_icon_size'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Size (px)', 'online-newspaper' ),
                    'input_attrs'   =>  $this->get_input_attrs([])
                ]),
                'website_layout_horizontal_gap' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Horizontal Gap', 'online-newspaper' ),
                    'input_attrs'   =>  $this->get_input_attrs([]),
                    'responsive'    =>  true,
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting('website_layout')->value() == 'boxed--layout' );
                    }
                ]),
                'website_layout_vertical_gap'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Vertical Gap', 'online-newspaper' ),
                    'input_attrs'   =>  $this->get_input_attrs([]),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting('website_layout')->value() == 'boxed--layout' );
                    },
                    'bottom_separator'  =>  true
                ]),
                'bottom_footer_logo_width'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Logo Width (px)', 'online-newspaper' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  400
                    ]),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'bottom_footer_header_or_custom' )->value() == 'custom' );
                    }
                ]),
                /* Header Builder row controls */
                'header_first_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'online-newspaper' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 3,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                'header_second_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'online-newspaper' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 3,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                'header_third_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'online-newspaper' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 3,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                /* Footer Builder row controls */
                'footer_first_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'online-newspaper' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 4,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                'footer_second_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'online-newspaper' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 4,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                'footer_third_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'online-newspaper' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 4,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                'global_author_icon_size'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Author', 'online-newspaper' ),
                ]),
                'global_date_icon_size'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date', 'online-newspaper' ),
                ]),
                'global_comments_icon_size'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Comments', 'online-newspaper' ),
                ]),
                'global_read_time_icon_size'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Read Time', 'online-newspaper' ),
                ]),
                'global_slider_icon_size'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Slider Arrows', 'online-newspaper' ),
                ]),
                'widgets_styles_image_border_radius'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (Px)', 'online-newspaper' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  200,
                        'min'   =>  0
                    ])
                ]),
                'archive_image_ratio'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Ratio', 'online-newspaper' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'min'   =>  0,
                        'max'   =>  2,
                        'step'  =>  0.1
                    ])
                ]),
                'single_post_image_ratio'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Ratio', 'online-newspaper' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'min'   =>  0,
                        'max'   =>  2,
                        'step'  =>  0.1
                    ])
                ]),
                'page_image_ratio'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Ratio', 'online-newspaper' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'min'   =>  0,
                        'max'   =>  2,
                        'step'  =>  0.1
                    ])
                ]),
                'web_stories_image_ratio'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Ratio', 'online-newspaper' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  2,
                        'step'  =>  0.1
                    ]),
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_number() Method

        /**
         * Get all section heading controls
         * 
         * @since 1.0.0
         */
        public function get_section_heading( $id = '' ) {
            $default = [
                'bottom_separator'  =>  true
            ];
            $control_array = [
                'header_sub_menu_header'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Sub Menu', 'online-newspaper' ),
                ]),
                'header_main_menu_header'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Main Menu', 'online-newspaper' ),
                ]),
                'typography_preset_header'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography Preset', 'online-newspaper' )
                ]),
                'disable_admin_notices_heading' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Admin Settings', 'online-newspaper' )
                ]),
                'website_layout_header' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Website Layout', 'online-newspaper' )
                ]),
                'website_layout_container_setting_heading'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Container Setting', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting('website_layout')->value() == 'boxed--layout' );
                    }
                ]),
                'block_title_section_heading'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Block Title', 'online-newspaper' )
                ]),
                'site_background_animation_settings_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Animation Settings', 'online-newspaper' ),
                ]),
                'theme_colors_section_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Theme Colors', 'online-newspaper' )
                ]),
                'theme_presets_section_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Presets', 'online-newspaper' )
                ]),
                'post_format_section_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Formats', 'online-newspaper' )
                ]),
                'post_meta_section_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Meta', 'online-newspaper' )
                ]),
                'post_meta_icon_size_section_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Icon Size', 'online-newspaper' )
                ]),
                'global_slider_icon_picker_section_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Slider Arrows', 'online-newspaper' )
                ]),
                'widgets_styles_image_settings_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Image Settings', 'online-newspaper' )
                ]),
                'website_layout_header'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Website Layout', 'online-newspaper' )
                ]),
                'website_content_layout_header'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Website Content Global Layut', 'online-newspaper' )
                ]),
                'frontpage_sidebar_layout_header'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Frontpage Sidebar Layouts', 'online-newspaper' )
                ]),
                'archive_sidebar_layout_header'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Archive Sidebar Layouts', 'online-newspaper' )
                ]),
                'single_sidebar_layout_header'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Sidebar Layouts', 'online-newspaper' )
                ]),
                'page_sidebar_layout_header'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Page Sidebar Layouts', 'online-newspaper' )
                ]),
                'ticker_news_content_header'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Content Setting', 'online-newspaper' )
                ]),
                'main_banner_slider_settings_header'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Slider Setting', 'online-newspaper' )
                ]),
                'main_banner_width_layout_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Width Layouts', 'online-newspaper' )
                ]),
                'full_width_blocks_width_layout_header' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Width Layouts', 'online-newspaper' )
                ]),
                'leftc_rights_blocks_width_layout_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Width Layouts', 'online-newspaper' )
                ]),
                'lefts_rightc_blocks_width_layout_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Width Layouts', 'online-newspaper' )
                ]),
                'bottom_full_width_blocks_width_layout_header'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Width Layouts', 'online-newspaper' )
                ]),
                'two_column_first_column_blocks_header' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'First Column Blocks', 'online-newspaper' )
                ]),
                'two_column_second_column_blocks_header'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Second Column Blocks', 'online-newspaper' )
                ]),
                'two_column_section_layout_header'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Width Layouts', 'online-newspaper' )
                ]),
                'single_post_image_settings_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Settings', 'online-newspaper' )
                ]),
                'single_post_width_layout_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Width Layouts', 'online-newspaper' )
                ]),
                'page_width_layout_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Width Layouts', 'online-newspaper' )
                ]),
                'page_image_settings_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Settings', 'online-newspaper' )
                ]),
                'main_banner_section_settings_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Settings', 'online-newspaper' )
                ]),
                'web_stories_section_settings_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Settings', 'online-newspaper' )
                ]),
                'full_width_section_settings_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Settings', 'online-newspaper' )
                ]),
                'leftc_rights_section_settings_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Settings', 'online-newspaper' )
                ]),
                'lefts_rightc_section_settings_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Settings', 'online-newspaper' )
                ]),
                'bottom_full_width_section_settings_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Settings', 'online-newspaper' )
                ]),
                'two_column_settings_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Settings', 'online-newspaper' )
                ]),
                'leftc_rights_section_sidebar_settings_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Sidebar Settings', 'online-newspaper' )
                ]),
                'lefts_rightc_section_sidebar_settings_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Sidebar Settings', 'online-newspaper' )
                ]),
                'archive_settings_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Settings', 'online-newspaper' )
                ]),
                'ticker_section_settings_header'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Settings', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return $control->manager->get_setting( 'ticker_news_frontpage' )->value();
                    }
                ]),
                'main_banner_card_settings'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Card Settings', 'online-newspaper' )
                ]),
                'web_stories_card_settings'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Card Settings', 'online-newspaper' )
                ]),
                'full_width_card_settings'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Card Settings', 'online-newspaper' )
                ]),
                'leftc_rights_card_settings'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Card Settings', 'online-newspaper' )
                ]),
                'lefts_rightc_card_settings'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Card Settings', 'online-newspaper' )
                ]),
                'bottom_full_width_card_settings'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Card Settings', 'online-newspaper' )
                ]),
                'two_column_card_settings'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Card Settings', 'online-newspaper' )
                ]),
                'archive_card_settings'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Card Settings', 'online-newspaper' )
                ]),
                'ticker_news_card_settings'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Card Settings', 'online-newspaper' )
                ]),
                'main_banner_list_posts_settings_header'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'List Posts Setting', 'online-newspaper' ),
                ]),
                'main_banner_grid_posts_settings_header'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Grid Posts Setting', 'online-newspaper' ),
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_section_heading() Method

        /**
         * Get all redirect controls
         * 
         * @since 1.0.0
         */
        public function get_redirect_control( $id = '' ) {

            $control_array = [
                'canvas_menu_redirects' =>  [
                    'label' => esc_html__( 'Widgets', 'online-newspaper' ),
                    'choices'     => [
                        'canvas-menu-sidebar' => [
                            'type'  => 'section',
                            'id'    => 'sidebar-widgets-off-canvas-sidebar',
                            'label' => esc_html__( 'Manage canvas menu widget', 'online-newspaper' )
                        ]
                    ]
                ],
                'global_button_redirect'    =>  [
                    'choices'     => [
                        'canvas-menu-sidebar' => [
                            'type'  => 'control',
                            'id'    => 'archive_page_layout_header',
                            'label' => esc_html__( 'Head to Archive', 'online-newspaper' )
                        ]
                    ]
                ],
                'leftc_rights_section_sidebar_redirect' =>  [
                    'label'	      => esc_html__( 'Widgets', 'online-newspaper' ),
                    'choices'     => [
                        'footer-column-one' => [
                            'type'  => 'section',
                            'id'    => 'sidebar-widgets-front-right-sidebar',
                            'label' => esc_html__( 'Manage right sidebar', 'online-newspaper' )
                        ]
                    ]
                ],
                'lefts_rightc_section_sidebar_redirect' =>  [
                    'label'	      => esc_html__( 'Widgets', 'online-newspaper' ),
                    'choices'     => [
                        'footer-column-one' => [
                            'type'  => 'section',
                            'id'    => 'sidebar-widgets-front-left-sidebar',
                            'label' => esc_html__( 'Manage left sidebar', 'online-newspaper' )
                        ]
                    ]
                ],
                'archive_button_redirect'  =>  [
                    'choices'     => [
                        'header-social-icons' => [
                            'type'  => 'section',
                            'id'    => 'buttons_section',
                            'label' => esc_html__( 'Edit button styles', 'online-newspaper' )
                        ]
                    ]
                ]
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_redirect_control() Method

        /**
         * Get all radio image controls
         * 
         * @since 1.0.0
         */
        public function get_radio_image( $id = '' ) {
            $theme_directory = get_template_directory_uri();
            $front_sections_width_layout_choices = [
                'global' => [
                    'label' => esc_html__( 'Global', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/global.jpg'
                ],
                'boxed--layout' => [
                    'label' => esc_html__( 'Boxed', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/boxed_content.jpg'
                ],
                'full-width--layout' => [
                    'label' => esc_html__( 'Full Width', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/full_content.jpg'
                ]
            ];
            $control_array = [
                'block_title_layout'  =>  [
                    'choices'  => [
                        'one' => [
                            'label' => esc_html__( 'Layout 1', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/block_title_one.png'
                        ],
                        'two' => [
                            'label' => esc_html__( 'Layout 2', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/block_title_two.png'
                        ],
                        'three' => [
                            'label' => esc_html__( 'Layout 3', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/block_title_three.png'
                        ],
                        'four' => [
                            'label' => esc_html__( 'Layout 4', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/block_title_four.png'
                        ],
                        'five' => [
                            'label' => esc_html__( 'Layout 4', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/block_title_five.png'
                        ]
                    ],
                    'transport' =>  'postMessage'
                ],
                'single_layout'  =>  [
                   'label' =>  esc_html__( 'Single Layout', 'online-newspaper' ),
                   'choices'  => [
                       'three' => [
                           'label' => esc_html__( 'Layout 1', 'online-newspaper' ),
                           'url'   => $theme_directory . '/assets/images/customizer/single_three.jpg'
                       ],
                       'five' => [
                           'label' => esc_html__( 'Layout 2', 'online-newspaper' ),
                           'url'   => $theme_directory . '/assets/images/customizer/single_five.jpg'
                       ]
                    ],
                    'bottom_separator'  =>  true
                ],
                'error_page_sidebar_layout'   =>  [
                   'label' =>  esc_html__( 'Sidebar Layout', 'online-newspaper' ),
                   'choices'  => [
                       'right-sidebar' => [
                           'label' => esc_html__( 'Right Sidebar', 'online-newspaper' ),
                           'url'   => $theme_directory . '/assets/images/customizer/right-sidebar.png'
                       ],
                       'left-sidebar' => [
                           'label' => esc_html__( 'Left Sidebar', 'online-newspaper' ),
                           'url'   => $theme_directory . '/assets/images/customizer/left-sidebar.png'
                       ],
                       'both-sidebar' => [
                           'label' => esc_html__( 'Both Sidebar', 'online-newspaper' ),
                           'url'   => $theme_directory . '/assets/images/customizer/both-sidebar.png'
                       ],
                       'no-sidebar' => [
                           'label' => esc_html__( 'No Sidebar', 'online-newspaper' ),
                           'url'   => $theme_directory . '/assets/images/customizer/no-sidebar.png'
                       ]
                    ],
                    'bottom_separator'  =>  true
                ],
                'header_builder_section_width'  =>  [
                    'label' => esc_html__( 'Section Width', 'online-newspaper' ),
                    'choices' => [
                        'boxed--layout' =>  [
                            'label' => esc_html__('Boxed', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/boxed-width.jpg'
                        ],
                        'full-width--layout'    =>  [
                            'label' => esc_html__('Full Width', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/full-width.jpg'
                        ]
                    ],
                    'transport' =>  'postMessage'
                ],
                'footer_builder_section_width'  =>  [
                    'label' => esc_html__( 'Section Width', 'online-newspaper' ),
                    'choices' => [
                        'boxed--layout' =>  [
                            'label' => esc_html__('Boxed', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/boxed-width.jpg'
                        ],
                        'full-width--layout'    =>  [
                            'label' => esc_html__('Full Width', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/full-width.jpg'
                        ]
                    ],
                    'transport' =>  'postMessage'
                ],
                'website_layout'  =>  [
                    'choices' => [
                        'boxed--layout' =>  [
                            'label' => esc_html__('Boxed', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/boxed-width.jpg'
                        ],
                        'full-width--layout'    =>  [
                            'label' => esc_html__('Full Width', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/full-width.jpg'
                        ]
                    ],
                    'transport' =>  'postMessage'
                ],
                'website_content_layout'  =>  [
                    'choices' => [
                        'boxed--layout' =>  [
                            'label' => esc_html__('Boxed', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/boxed_content.jpg'
                        ],
                        'full-width--layout'    =>  [
                            'label' => esc_html__('Full Width', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/full_content.jpg'
                        ]
                    ],
                    'transport' =>  'postMessage'
                ],
                'frontpage_sidebar_layout'  =>  [
                    'choices' => online_newspaper_get_customizer_sidebar_array()
                ],
                'archive_sidebar_layout'  =>  [
                    'choices' => online_newspaper_get_customizer_sidebar_array()
                ],
                'single_sidebar_layout'  =>  [
                    'choices' => online_newspaper_get_customizer_sidebar_array()
                ],
                'page_sidebar_layout'  =>  [
                    'choices' => online_newspaper_get_customizer_sidebar_array()
                ],
                'ticker_news_width_layout'  =>  [
                    'choices'  => [
                        'global' => [
                            'label' => esc_html__( 'Global', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/global.jpg'
                        ],
                        'boxed--layout' => [
                            'label' => esc_html__( 'Boxed', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/boxed_content.jpg'
                        ],
                        'full-width--layout' => [
                            'label' => esc_html__( 'Full Width', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/full_content.jpg'
                        ]
                    ],
                    'transport' =>  'postMessage',
                    'active_callback'   =>  function( $control ) {
                        return $control->manager->get_setting( 'ticker_news_frontpage' )->value();
                    }
                ],
                'main_banner_width_layout'  =>  [
                    'choices'  => $front_sections_width_layout_choices,
                    'transport' =>  'postMessage'
                ],
                'full_width_blocks_width_layout'    =>  [
                    'choices'   =>  $front_sections_width_layout_choices,
                    'transport' =>  'postMessage'
                ],
                'leftc_rights_blocks_width_layout'  =>  [
                    'choices'   =>  $front_sections_width_layout_choices,
                    'transport' =>  'postMessage'
                ],
                'lefts_rightc_blocks_width_layout'  =>  [
                    'choices'   =>  $front_sections_width_layout_choices,
                    'transport' =>  'postMessage'
                ],
                'bottom_full_width_blocks_width_layout' =>  [
                    'choices'   =>  $front_sections_width_layout_choices,
                    'transport' =>  'postMessage'
                ],
                'web_stories_full_width_blocks_width_layout' =>  [
                    'choices'   =>  $front_sections_width_layout_choices,
                    'transport' =>  'postMessage'
                ],
                'two_column_section_layout' =>  [
                    'choices'   =>  $front_sections_width_layout_choices,
                    'transport' =>  'postMessage'
                ],
                'archive_page_layout'   =>  [
                    'choices'  => [
                        'one' => [
                            'label' => esc_html__( 'Layout One', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/archive_one.jpg'
                        ],
                        'two' => [
                            'label' => esc_html__( 'Layout Two', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/archive_two.jpg'
                        ],
                        'five' => [
                            'label' => esc_html__( 'Layout Five', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/archive_five.jpg'
                        ]
                    ]
                ],
                'archive_width_layout'  =>  [
                    'choices'  => [
                        'global' => [
                            'label' => esc_html__( 'Global', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/global.jpg'
                        ],
                        'boxed--layout' => [
                            'label' => esc_html__( 'Boxed', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/boxed_content.jpg'
                        ],
                        'full-width--layout' => [
                            'label' => esc_html__( 'Full Width', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/full_content.jpg'
                        ]
                    ],
                    'transport' =>  'postMessage'
                ],
                'single_post_width_layout'  =>  [
                    'choices'  => [
                        'global' => [
                            'label' => esc_html__( 'Global', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/global.jpg'
                        ],
                        'boxed--layout' => [
                            'label' => esc_html__( 'Boxed', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/boxed_content.jpg'
                        ],
                        'full-width--layout' => [
                            'label' => esc_html__( 'Full Width', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/full_content.jpg'
                        ]
                    ],
                    'transport' =>  'postMessage'
                ],
                'page_width_layout'  =>  [
                    'choices'  => [
                        'global' => [
                            'label' => esc_html__( 'Global', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/global.jpg'
                        ],
                        'boxed--layout' => [
                            'label' => esc_html__( 'Boxed', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/boxed_content.jpg'
                        ],
                        'full-width--layout' => [
                            'label' => esc_html__( 'Full Width', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/full_content.jpg'
                        ]
                    ],
                    'transport' =>  'postMessage'
                ],
                'error_page_width_layout'  =>  [
                    'choices'  => [
                        'global' => [
                            'label' => esc_html__( 'Global', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/global.jpg'
                        ],
                        'boxed--layout' => [
                            'label' => esc_html__( 'Boxed', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/boxed_content.jpg'
                        ],
                        'full-width--layout' => [
                            'label' => esc_html__( 'Full Width', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/full_content.jpg'
                        ]
                    ],
                    'transport' =>  'postMessage'
                ],
                'search_page_width_layout'  =>  [
                    'choices'  => [
                        'global' => [
                            'label' => esc_html__( 'Global', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/global.jpg'
                        ],
                        'boxed--layout' => [
                            'label' => esc_html__( 'Boxed', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/boxed_content.jpg'
                        ],
                        'full-width--layout' => [
                            'label' => esc_html__( 'Full Width', 'online-newspaper' ),
                            'url'   => $theme_directory . '/assets/images/customizer/full_content.jpg'
                        ]
                    ],
                    'transport' =>  'postMessage'
                ]
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_radio_image() Method

        /**
         * Get all icon picker controls
         * 
         * @since 1.0.0
         */
        public function get_icon_picker( $id = '' ) {
            $default = [
                'include_media' =>  true
            ];

            $control_array = [
                'theme_mode_dark_icon'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Choose Dark Icon', 'online-newspaper' ),
                    'include_media' =>  false,
                    'transport' =>  'postMessage'
                ]),
                'theme_mode_light_icon'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Choose Light Icon', 'online-newspaper' ),
                    'include_media' =>  false,
                    'transport' =>  'postMessage'
                ]),
                'standard_post_format_icon_picker'    =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Standard', 'online-newspaper' ),
                   'transport' =>  'postMessage'
                ]),
                'audio_post_format_icon_picker'   =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Audio', 'online-newspaper' ),
                   'transport' =>  'postMessage'
                ]),
                'gallery_post_format_icon_picker' =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Gallery', 'online-newspaper' ),
                   'transport' =>  'postMessage'
                ]),
                'image_post_format_icon_picker'   =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Image', 'online-newspaper' ),
                   'transport' =>  'postMessage'
                ]),
                'quote_post_format_icon_picker'   =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Quote', 'online-newspaper' ),
                   'transport' =>  'postMessage'
                ]),
                'video_post_format_icon_picker'   =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Video', 'online-newspaper' ),
                   'transport' =>  'postMessage'
                ]),
                'global_slider_prev_icon_picker'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Previous Icon', 'online-newspaper' ),
                    'include_media' =>  false,
                ]),
                'global_slider_next_icon_picker'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Next Icon', 'online-newspaper' ),
                    'include_media' =>  false
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_icon_picker() Method

        /**
         * Get all text controls
         * 
         * @since 1.0.0
         */
        public function get_text( $id = '' ) {
            $default = [
                'label' =>  esc_html__( 'Button Label', 'online-newspaper' ),
                'type'  =>  'text',
                'transport' =>  'postMessage'
            ];

            $control_array = [
                'newsletter_label' =>  $this->get_params( $default, []),
                'global_button_label'   =>  $this->get_params( $default, []),
                'stt_label'  =>  $this->get_params( $default, []),
                'single_post_related_posts_title'   =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Related articles title', 'online-newspaper' )
                ]),
                'random_news_label'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Button Label', 'online-newspaper' )
                ]),
                'custom_button_label'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Button Label', 'online-newspaper' )
                ]),
                'main_banner_list_posts_title'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Popular posts title', 'online-newspaper' ),
                ]),
                'main_banner_grid_posts_title'  =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Popular posts title', 'online-newspaper' )
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_text() Method

        /**
         * Get all select controls
         * 
         * @since 1.0.0
         */
        public function get_select( $id = '' ) {
            $default = [
                'type'  =>  'select',
            ];

            $control_array = [
                'site_title_tag_for_frontpage'    =>  $this->get_params( $default, [
                    'label'   =>  esc_html__( 'Site Title Tag (For Frontpage)', 'online-newspaper' ),
                    'choices'   =>  apply_filters( 'online_newspaper_get_title_tags_array_filter', [] ),
                    'priority'  =>  30
                ]),
                'site_title_tag_for_innerpage'    =>  $this->get_params( $default, [
                    'label'   =>  esc_html__( 'Site Title Tag (For Innerpage)', 'online-newspaper' ),
                    'choices'   =>  apply_filters( 'online_newspaper_get_title_tags_array_filter', [] ),
                    'priority'  =>  30
                ]),
                'header_menu_hover_effect'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hover Effect', 'online-newspaper' ),
                    'choices'   =>  [
                        'none'  =>  esc_html__( 'None', 'online-newspaper' ),
                        'two'  =>  esc_html__( 'Effect 1', 'online-newspaper' ),
                        'four'  =>  esc_html__( 'Effect 2', 'online-newspaper' )
                    ],
                    'transport' =>  'postMessage'
                ]),
                'footer_menu_hover_effect'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hover Effect', 'online-newspaper' ),
                    'choices'   =>  [
                        'none'  =>  esc_html__( 'None', 'online-newspaper' ),
                        'two'  =>  esc_html__( 'Effect 1', 'online-newspaper' ),
                        'four'  =>  esc_html__( 'Effect 2', 'online-newspaper' )
                    ],
                    'transport' =>  'postMessage'
                ]),
                'header_ads_banner_image_rel_attr'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Rel attribute', 'online-newspaper' ),
                    'choices'   =>  [
                        'nofollow'  => esc_html__( 'No Follow', 'online-newspaper' ),
                        'noopener'  => esc_html__( 'No Opener', 'online-newspaper' ),
                        'noreferrer' => esc_html__( 'No Referrer', 'online-newspaper' )
                    ],
                    'active_callback'   =>  function( $control ) {
                        return ( ( $control->manager->get_setting( 'header_ads_banner_image_link_url' )->value() ) );
                    }
                ]),
                'preloader_type'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Preloader Styles', 'online-newspaper' ),
                    'choices'   =>  [
                        '1' =>  esc_html__( 'One', 'online-newspaper' ),
                        '2' =>  esc_html__( 'Two', 'online-newspaper' ),
                        '3' =>  esc_html__( 'Three', 'online-newspaper' )
                    ],
                    'active_callback'   =>  function( $control ) {
                        return $control->manager->get_setting( 'preloader_option' )->value();
                    },
                    'transport' =>  'postMessage'
                ]),
                'bottom_footer_header_or_custom'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Logo From', 'online-newspaper' ),
                    'choices'   =>  [
                        'header'  =>  esc_html__( 'Default Site Logo', 'online-newspaper' ),
                        'custom'  =>  esc_html__( 'Custom', 'online-newspaper' )
                    ],
                    'transport' =>  'postMessage'
                ]),
                'site_date_to_show'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Date To Display', 'online-newspaper' ),
                    'description' => esc_html__( 'Whether to show date published or modified date.', 'online-newspaper' ),
                    'choices'   => [
                        'published'  => esc_html__( 'Published Date', 'online-newspaper' ),
                        'modified'   => esc_html__( 'Modified Date', 'online-newspaper' )
                    ]
                ]),
                'site_date_format'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Date format', 'online-newspaper' ),
                    'description' => esc_html__( 'Date format applied to single and archive pages.', 'online-newspaper' ),
                    'choices'   => [
                        'theme_format'  => esc_html__( 'Default by theme', 'online-newspaper' ),
                        'default'   => esc_html__( 'Wordpress default date', 'online-newspaper' )
                    ]
                ]),
                'post_title_hover_effects'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Post title hover effects', 'online-newspaper' ),
                    'description' => esc_html__( 'Applied to post titles listed in archive pages.', 'online-newspaper' ),
                    'choices'   => [
                        'none'  => __( 'None', 'online-newspaper' ),
                        'six'   => __( 'Effect 1', 'online-newspaper' ),
                        'ten'   => __( 'Effect 2', 'online-newspaper' )
                    ],
                    'transport' =>  'postMessage'
                ]),
                'site_image_hover_effects'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Image hover effects', 'online-newspaper' ),
                    'description' => esc_html__( 'Applied to post thumbanails listed in archive pages.', 'online-newspaper' ),
                    'choices'   => [
                        'none'  => __( 'None', 'online-newspaper' ),
                        'one'   => __( 'Effect 1', 'online-newspaper' ),
                        'four'   => __( 'Effect 2', 'online-newspaper' )
                    ],
                    'transport' =>  'postMessage'
                ]),
                'cursor_animation'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Cursor animation', 'online-newspaper' ),
                    'description' => esc_html__( 'Applied to mouse pointer.', 'online-newspaper' ),
                    'choices'   => [
                        'none' => esc_html__( 'None', 'online-newspaper' ),
                        'one'  => esc_html__( 'Animation 1', 'online-newspaper' )
                    ]
                ]),
                'site_breadcrumb_type'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Breadcrumb type', 'online-newspaper' ),
                    'description' => esc_html__( 'If you use other than "default" one you will need to install and activate respective plugins Breadcrumb NavXT, Yoast SEO and Rank Math SEO', 'online-newspaper' ),
                    'choices'   => [
                        'default' => esc_html__( 'Default', 'online-newspaper' ),
                        'bcn'  => esc_html__( 'NavXT', 'online-newspaper' ),
                        'yoast'  => esc_html__( 'Yoast SEO', 'online-newspaper' ),
                        'rankmath'  => esc_html__( 'Rank Math', 'online-newspaper' )
                    ]
                ]),
                'header_newsletter_hover_animation'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Animation Type', 'online-newspaper' ),
                    'choices'   => [
                        'none'  => esc_html__( 'None', 'online-newspaper' ),
                        'one'   => esc_html__( 'Effect one', 'online-newspaper' ),
                        'two'   => esc_html__( 'Effect Two', 'online-newspaper' ),  
                        'three' => esc_html__( 'Effect Three', 'online-newspaper' ),  
                        'four'  => esc_html__( 'Effect Four', 'online-newspaper' ),  
                        'five'  => esc_html__( 'Effect Five', 'online-newspaper' )  
                    ],
                    'transport' =>  'postMessage'
                ]),
                'site_background_animation'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Background animation', 'online-newspaper' ),
                    'choices'	=>	[
                        'none'	=>	esc_html__( 'None', 'online-newspaper' ),
                        'three'	=>	esc_html__( 'Animation 1', 'online-newspaper' )
                    ],
                    'transport' =>  'postMessage'
                ]),
                'sticky_posts_order'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Order by', 'online-newspaper' ),
                    'choices'   =>  online_newspaper_post_order_args()
                ]),
                'secondary_menu_hover_effect'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Hover Effects', 'online-newspaper' ),
                    'choices'   =>  [
                        'none'  =>  esc_html__( 'None', 'online-newspaper' ),
                        'two'   =>  esc_html__( 'Effect 1', 'online-newspaper' ),
                        'four'  =>  esc_html__( 'Effect 2', 'online-newspaper' )
                    ]
                ]),
                'ticker_news_order_by'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Orderby', 'online-newspaper' ),
                    'choices'   =>  online_newspaper_customizer_orderby_options_array()
                ]),
                'main_banner_slider_order_by'   =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Orderby', 'online-newspaper' ),
                    'choices'   => online_newspaper_customizer_orderby_options_array()
                ]),
                'archive_image_size'   =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Image Size', 'online-newspaper' ),
                    'choices'   => online_newspaper_get_image_sizes()
                ]),
                'archive_pagination_type'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Pagination Type', 'online-newspaper' ),
                    'choices'   =>  [
                        'default'   =>  esc_html__( 'Default', 'online-newspaper' ),
                        'number'    =>  esc_html__( 'Number', 'online-newspaper' )
                    ],
                    'transport' =>  'postMessage'
                ]),
                'web_stories_orderby' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Order by', 'online-newspaper' ),
                    'choices'   =>  [
                        'asc-name'  =>  esc_html__( 'Ascending Name', 'online-newspaper' ),
                        'asc-count'  =>  esc_html__( 'Ascending Count', 'online-newspaper' ),
                        'desc-name'  =>  esc_html__( 'Descending Name', 'online-newspaper' ),
                        'desc-count'  =>  esc_html__( 'Descending Count', 'online-newspaper' )
                    ],
                ]),
                'web_stories_image_sizes'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Image Sizes', 'online-newspaper' ),
                    'choices'   =>  online_newspaper_get_image_sizes_option_array_for_customizer()
                ]),
                'main_banner_grid_posts_order_by'   =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Orderby', 'online-newspaper' ),
                    'choices'   => online_newspaper_customizer_orderby_options_array(),
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_select() Method

        /**
         * Get all border controls
         * 
         * @since 1.0.0
         */
        public function get_border( $id = '' ) {
            $default = [
                'label' =>  esc_html__( 'Border', 'online-newspaper' ),
                'input_attr'    =>  [
                    'max'   =>  100,
                    'min'   =>  0,
                    'step'  =>  1
                ],
                'transport' =>  'postMessage'
            ];

            $control_array = [
                'widgets_styles_image_border'   =>  $this->get_params( $default, [
                    'input_attr'    =>  $this->get_input_attrs([ 'min'   =>  1 ])
                ]),
                'main_banner_section_border'   =>  $this->get_params( $default, [
                    'input_attr'    =>  $this->get_input_attrs([ 'min'   =>  1 ])
                ]),
                'web_stories_section_border'   =>  $this->get_params( $default, [
                    'input_attr'    =>  $this->get_input_attrs([ 'min'   =>  1 ])
                ]),
                'full_width_section_border'   =>  $this->get_params( $default, [
                    'input_attr'    =>  $this->get_input_attrs([ 'min'   =>  1 ])
                ]),
                'leftc_rights_section_border'   =>  $this->get_params( $default, [
                    'input_attr'    =>  $this->get_input_attrs([ 'min'   =>  1 ])
                ]),
                'lefts_rightc_section_border'   =>  $this->get_params( $default, [
                    'input_attr'    =>  $this->get_input_attrs([ 'min'   =>  1 ])
                ]),
                'bottom_full_width_section_border'   =>  $this->get_params( $default, [
                    'input_attr'    =>  $this->get_input_attrs([ 'min'   =>  1 ])
                ]),
                'two_column_section_border'   =>  $this->get_params( $default, [
                    'input_attr'    =>  $this->get_input_attrs([ 'min'   =>  1 ])
                ]),
                'leftc_rights_sidebar_section_border'   =>  $this->get_params( $default, [
                    'input_attr'    =>  $this->get_input_attrs([ 'min'   =>  1 ])
                ]),
                'lefts_rightc_sidebar_section_border'   =>  $this->get_params( $default, [
                    'input_attr'    =>  $this->get_input_attrs([ 'min'   =>  1 ])
                ]),
                'archive_section_border'   =>  $this->get_params( $default, [
                    'input_attr'    =>  $this->get_input_attrs([ 'min'   =>  1 ])
                ]),
                'sidebar_border'   =>  $this->get_params( $default, [
                    'input_attr'    =>  $this->get_input_attrs([ 'min'   =>  1 ])
                ]),
                'ticker_news_border'   =>  $this->get_params( $default, [
                    'input_attr'    =>  $this->get_input_attrs([ 'min'   =>  1 ]),
                    'active_callback'   =>  function( $control ) {
                        return $control->manager->get_setting( 'ticker_news_frontpage' )->value();
                    }
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_border() Method

        /**
         * Get all preset controls
         * 
         * @since 1.0.0
         */
        public function get_preset_colors( $id = '' ) {
            $default = [
                'transport' =>  'postMessage'
            ];

            $control_array = [
                'solid_color_preset'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Solid Presets', 'online-newspaper' ),
                    'description'   =>  esc_html__( 'Set color presets', 'online-newspaper' ),
                    'bottom_separator'  =>  true
                ]),
                'gradient_color_preset'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Gradient Presets', 'online-newspaper' ),
                    'description'   =>  esc_html__( 'Set gradient presets', 'online-newspaper' ),
                    'blend' =>  'gradient'
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_preset_colors() Method

        /**
         * Get all color controls
         * 
         * @since 1.0.0
         */
        public function get_colors( $id = '' ) {
            $default = [
                'involve'   =>  [ 'solid' ],
                'hover' =>  false,
                'transport' =>  'postMessage'
            ];
            
            $control_array = [
                'website_layout_background_color'   => $this->get_params( $default, [
                    'label' => esc_html__( 'Container Background Color', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'website_layout' )->value() == 'boxed--layout' );
                    },
                    'involve'   =>  [ 'solid', 'gradient' ]
                ]),
                'site_background_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Background Color', 'online-newspaper' ),
                    'involve'   =>  [ 'solid', 'gradient' ],
                    'description'   =>  esc_html__( 'If background image is set, this will act as overlay.', 'online-newspaper' )
                ]),
                'header_menu_color'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Text Color', 'online-newspaper' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true,
                ]),
                'header_sub_menu_color' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Text Color', 'online-newspaper' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true,
                ]),
                'search_icon_color'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Icon Color', 'online-newspaper' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'header_newsletter_label_color' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Text Color', 'online-newspaper' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'custom_button_icon_color' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Color', 'online-newspaper' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'theme_mode_dark_icon_color'  => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Dark Icon Color', 'online-newspaper' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'theme_mode_light_icon_color' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Light Icon Color', 'online-newspaper' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'canvas_menu_icon_color'   => $this->get_params( $default, [
                    'label'     => esc_html__( 'Canvas Menu Icon Color', 'online-newspaper' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'stt_color_group' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Icon Text', 'online-newspaper' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'pagination_button_text_color'   => $this->get_params( $default, [
                    'label'     => esc_html__( 'Button Text Color', 'online-newspaper' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'pagination_button_background_color'   => $this->get_params( $default, [
                    'label' => esc_html__( 'Button Background Color', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'archive_pagination_type' )->value(), [ 'number' ] ) );
                    },
                    'involve'   =>  [ 'solid', 'gradient' ],
                    'hover' =>  true
                ]),
                'header_builder_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background', 'online-newspaper' ),
                   'involve' => [ 'solid', 'gradient', 'image' ]
                ]),
                'footer_builder_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background', 'online-newspaper' ),
                   'involve' => [ 'solid', 'gradient', 'image' ],
                ]),
                /* Header builder row settings section */
                'header_first_row_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background Color', 'online-newspaper' ),
                   'involve' => [ 'solid', 'gradient' ]
                ]),
                'header_second_row_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background Color', 'online-newspaper' ),
                   'involve' => [ 'solid', 'gradient' ]
                ]),
                'header_third_row_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background Color', 'online-newspaper' ),
                   'involve' => [ 'solid', 'gradient' ]
                ]),
                /* Footer builder row settings section */
                'footer_first_row_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background Color', 'online-newspaper' ),
                   'involve' => [ 'solid', 'gradient' ]
                ]),
                'footer_second_row_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background Color', 'online-newspaper' ),
                   'involve' => [ 'solid', 'gradient' ]
                ]),
                'footer_third_row_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background Color', 'online-newspaper' ),
                   'involve' => [ 'solid', 'gradient' ]
                ]),
                /* Date / Time */
                'date_color' => $this->get_params( $default, [
                   'label' => esc_html__( 'Date Color', 'online-newspaper' ),
                   'involve' => [ 'solid' ]
                ]),
                'time_color' => $this->get_params( $default, [
                   'label' => esc_html__( 'Time Color', 'online-newspaper' ),
                   'involve' => [ 'solid' ]
                ]),
                'mobile_canvas_icon_color' => $this->get_params( $default, [
                   'label' => esc_html__( 'Icon Color', 'online-newspaper' ),
                   'involve' => [ 'solid' ],
                   'hover'  =>  true,
                ]),
                'mobile_canvas_text_color' => $this->get_params( $default, [
                   'label' => esc_html__( 'Color', 'online-newspaper' ),
                   'involve' => [ 'solid' ],
                   'hover'  =>  false,
                ]),
                'mobile_canvas_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Canvas Background', 'online-newspaper' ),
                   'involve' => [ 'solid', 'gradient' ],
                ]),
                'footer_menu_color' => $this->get_params( $default, [
                   'label' => esc_html__( 'Color', 'online-newspaper' ),
                   'involve' => [ 'solid' ],
                   'hover'  =>  true
                ]),
                'secondary_menu_color' => $this->get_params( $default, [
                   'label' => esc_html__( 'Color', 'online-newspaper' )
                ]),
                'random_news_label_color'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Label Color', 'online-newspaper' ),
                    'involve' => [ 'solid' ],
                    'hover' =>  true
                ]),
                'custom_button_color_group'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Icon / Text Color', 'online-newspaper' ),
                    'involve' => [ 'solid' ],
                    'hover' =>  true
                ]),
                'ticker_news_background_color_group'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Background', 'online-newspaper' ),
                    'involve'   =>  [ 'solid', 'gradient', 'image' ],
                    'active_callback'   =>  function( $control ) {
                        return $control->manager->get_setting( 'ticker_news_frontpage' )->value();
                    }
                ]),
                'ticker_news_title_color'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( ' Title Color', 'online-newspaper' ),
                    'involve'   =>  [ 'solid' ]
                ]),
                'ticker_news_date_color'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( ' Date Color', 'online-newspaper' ),
                    'involve'   =>  [ 'solid' ]
                ]),
                'main_banner_background_color_group'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Background', 'online-newspaper' ),
                    'involve'   =>  [ 'solid', 'gradient', 'image' ]
                ]),
                'web_stories_background_color_group'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Background', 'online-newspaper' ),
                    'involve'   =>  [ 'solid', 'gradient', 'image' ]
                ]),
                'full_width_blocks_background_color_group'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Background', 'online-newspaper' ),
                    'involve'   =>  [ 'solid', 'gradient', 'image' ]
                ]),
                'leftc_rights_blocks_background_color_group'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Background', 'online-newspaper' ),
                    'involve'   =>  [ 'solid', 'gradient', 'image' ]
                ]),
                'lefts_rightc_blocks_background_color_group'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Background', 'online-newspaper' ),
                    'involve'   =>  [ 'solid', 'gradient', 'image' ]
                ]),
                'bottom_full_width_blocks_background_color_group'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Background', 'online-newspaper' ),
                    'involve'   =>  [ 'solid', 'gradient', 'image' ]
                ]),
                'two_column_background_color_group' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Background', 'online-newspaper' ),
                    'involve'   =>  [ 'solid', 'gradient', 'image' ]
                ]),
                'leftc_rights_sidebar_background_color_group'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Background', 'online-newspaper' ),
                    'involve'   =>  [ 'solid', 'gradient', 'image' ]
                ]),
                'lefts_rightc_sidebar_background_color_group'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Background', 'online-newspaper' ),
                    'involve'   =>  [ 'solid', 'gradient', 'image' ]
                ]),
                'archive_color_group'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Background', 'online-newspaper' ),
                    'involve'   =>  [ 'solid', 'gradient', 'image' ]
                ]),
                'sidebar_background'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Background', 'online-newspaper' ),
                    'involve'   =>  [ 'solid', 'gradient', 'image' ]
                ]),
            ];
            $totalCats = get_categories();
            if( $totalCats ) :
                $totalCats_count = count( $totalCats );
                foreach( $totalCats as $key => $singleCat ) :
                    $cat_color_id = 'category_' . absint( $singleCat->term_id ) . '_color';
                    $control_array[ 'category_top_spacing_' . $key ] = [];
                    $control_array[ $cat_color_id ] = [
                        'label' => esc_html__( 'Text Color', 'online-newspaper' ),
                        'involve'   =>  [ 'solid' ],
                        'hover' =>  true,
                        'transport' =>  'postMessage'
                    ];

                    $background_id = 'category_background_' . absint( $singleCat->term_id ) . '_color';
                    $control_array[ $background_id ] = [
                        'label' => esc_html__( 'Background', 'online-newspaper' ),
                        'involve'   =>  [ 'solid', 'gradient' ],
                        'hover' =>  true,
                        'bottom_separator'  =>  true,
                        'transport' =>  'postMessage'
                    ];
                    if( $totalCats_count != ( $key + 1 ) ) $control_array[ 'category_bottom_spacing_' . $key ] = [];
                endforeach;
            endif;

            $totalTags = get_tags();
            $tag_priority = 10;
            if( $totalTags ) :
                $totalTags_count = count( $totalTags );
                foreach( $totalTags as $key => $singleTag ) :
                    $tag_color_id = 'tag_' . absint( $singleTag->term_id ) . '_color';
                    $control_array[ 'tag_top_spacing_' . $key ] = [];
                    $control_array += [ $tag_color_id =>  [
                        'label' => esc_html__( 'Text Color', 'online-newspaper' ),
                        'involve'   =>  [ 'solid' ],
                        'hover' =>  true,
                        'transport' =>  'postMessage'
                    ]];

                    $background_id = 'tag_background_' . absint( $singleTag->term_id ) . '_color';
                    $control_array += [ $background_id   =>  [
                        'label' => esc_html__( 'Background', 'online-newspaper' ),
                        'involve'   =>  [ 'solid', 'gradient' ],
                        'hover' =>  true,
                        'bottom_separator'  =>  true,
                        'transport' =>  'postMessage'
                    ]];
                    $tag_priority += 10;
                    if( $totalTags_count != ( $key + 1 ) ) $control_array[ 'tag_bottom_spacing_' . $key ] = [];
                endforeach;
            endif;
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_colors() Method

        /**
         * Get all editor controls
         * 
         * @since 1.0.0
         */
        public function get_editor_control( $id = '' ) {
            $control_array = [];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_editor_control() Method

        /**
         * Get all Media controls
         * 
         * @since 1.0.0
         */
        public function get_media_control( $id = '' ) {
            $default = [
                'mime_type' => 'image',
            ];

            $control_array = [
                'header_ads_banner_image' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Ads Banner Image', 'online-newspaper' ),
                    'description'   =>  esc_html__( 'Upload ads banner image', 'online-newspaper' )
                ]),
                'error_page_image'    =>  $this->get_params( $default, [
                    'label' => esc_html__( '404 Image', 'online-newspaper' ),
                    'description' => esc_html__( 'Upload image that shows you are on 404 error page', 'online-newspaper' ),
                ]),
                'bottom_footer_logo_option'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Footer Logo', 'online-newspaper' ),
                    'description' => esc_html__( 'Upload image for bottom footer', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'bottom_footer_header_or_custom' )->value() == 'custom' );
                    },
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_media_control() Method

        /**
         * Get all wordpress default color controls
         * 
         * @since 1.0.0
         */
        public function get_predefined_colors( $id = '' ) {
            $default = [
                'priority'  =>  20,
                'transport' =>  'postMessage'
            ];

            $control_array = [
                'site_title_hover_textcolor'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Site Title Hover Color', 'online-newspaper' )
                ]),
                'site_description_color'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Site Description Color', 'online-newspaper' )
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_predefined_colors() Method

        /**
         * Get all custom repeater controls
         * 
         * @since 1.0.0
         */
        public function get_custom_repeaters( $id = '' ) {
            $default = [];
            $control_array = [
                'social_icons' =>  $this->get_params( $default, [
                    'label'         => esc_html__( 'Social Icons', 'online-newspaper' ),
                    'description'   => esc_html__( 'Hold and drag vertically to re-order the icons', 'online-newspaper' ),
                    'row_label'     => 'inherit-icon_class',
                    'add_new_label' => esc_html__( 'Add New Icon', 'online-newspaper' ),
                    'fields'        => [
                        'icon_class'   => array(
                            'type'          =>  'fontawesome-icon-picker',
                            'label'         =>  esc_html__( 'Social Icon', 'online-newspaper' ),
                            'description'   =>  esc_html__( 'Select from dropdown.', 'online-newspaper' ),
                            'default'       =>  esc_attr( 'fa-brands fa-instagram' ),
                            'families'      =>  'social'
                        ),
                        'icon_url'  => array(
                            'type'      => 'url',
                            'label'     => esc_html__( 'URL for icon', 'online-newspaper' ),
                            'default'   => ''
                        ),
                        'item_option'             => 'show'
                    ]
                ]),
                'footer_social_icons' =>  $this->get_params( $default, [
                    'label'         => esc_html__( 'Social Icons', 'online-newspaper' ),
                    'description'   => esc_html__( 'Hold and drag vertically to re-order the icons', 'online-newspaper' ),
                    'row_label'     => 'inherit-icon_class',
                    'add_new_label' => esc_html__( 'Add New Icon', 'online-newspaper' ),
                    'fields'        => [
                        'icon_class'   => array(
                            'type'          =>  'fontawesome-icon-picker',
                            'label'         =>  esc_html__( 'Social Icon', 'online-newspaper' ),
                            'description'   =>  esc_html__( 'Select from dropdown.', 'online-newspaper' ),
                            'default'       =>  esc_attr( 'fa-brands fa-instagram' ),
                            'families'      =>  'social'
                        ),
                        'icon_count'  => array(
                            'type'      => 'text',
                            'label'     => esc_html__( 'Count', 'online-newspaper' ),
                            'default'   => '1K'
                        ),
                        'icon_label'  => array(
                            'type'      => 'text',
                            'label'     => esc_html__( 'Label', 'online-newspaper' )
                        ),
                        'icon_url'  => array(
                            'type'      => 'url',
                            'label'     => esc_html__( 'URL for icon', 'online-newspaper' ),
                            'default'   => ''
                        ),
                        'item_option'             => 'show'
                    ]
                ]),
                'advertisement_repeater'  =>  $this->get_params( $default, [
                    'label'         => esc_html__( 'Advertisements', 'online-newspaper' ),
                    'description'   => esc_html__( 'Hold and drag vertically to re-order the icons', 'online-newspaper' ),
                    'row_label'     => esc_html__( 'Advertisement', 'online-newspaper' ),
                    'add_new_label' => esc_html__( 'Add New Advertisement', 'online-newspaper' ),
                    'fields'        => [
                        'item_image'   => [
                            'type'          => 'image',
                            'label'         => esc_html__( 'Image', 'online-newspaper' ),
                            'default'       => 0
                        ],
                        'item_url'  => [
                            'type'      => 'url',
                            'label'     => esc_html__( 'URL', 'online-newspaper' ),
                            'default'   => ''
                        ],
                        'item_target'   =>  [
                            'type'  =>  'select',
                            'label' =>  esc_html__( 'Open in', 'online-newspaper' ),
                            'default'   =>  '_self',
                            'options'   =>  [
                                '_blank'    =>  esc_html__( 'New tab', 'online-newspaper' ),
                                '_self'    =>  esc_html__( 'Same tab', 'online-newspaper' )
                            ]
                        ],
                        'item_rel_attribute'    =>  [
                            'type'  =>  'select',
                            'label' =>  esc_html__( 'Rel', 'online-newspaper' ),
                            'default'   =>  'opener',
                            'options'   =>  [
                                'nofollow'  =>  esc_html__( 'No follow', 'online-newspaper' ),
                                'noopener'  =>  esc_html__( 'No opener', 'online-newspaper' ),
                                'noreferrer'  =>  esc_html__( 'No referrer', 'online-newspaper' )
                            ]
                        ],
                        'item_heading'  =>  [
                            'type'  =>  'heading',
                            'label' =>  esc_html__( 'Display Area', 'online-newspaper' )
                        ],
                        'item_checkbox_before_post_content' =>  [
                            'type'  =>  'checkbox',
                            'label' =>  esc_html__( 'Before post content', 'online-newspaper' ),  
                            'default'   =>  false
                        ],
                        'item_checkbox_after_post_content' =>  [
                            'type'  =>  'checkbox',
                            'label' =>  esc_html__( 'After post content', 'online-newspaper' ),  
                            'default'   =>  false
                        ],
                        'item_checkbox_random_post_archives' =>  [
                            'type'  =>  'checkbox',
                            'label' =>  esc_html__( 'Random post archives', 'online-newspaper' ),  
                            'default'   =>  false
                        ],
                        'item_alignment'    =>   [
                            'type'  =>  'alignment',
                            'label' =>  esc_html__( 'Ad Alignment', 'online-newspaper' ),
                            'default'   =>  'left',
                            'options'   =>  [
                                'left'  =>  esc_html__( 'fa-solid fa-align-left', 'online-newspaper' ),
                                'center'  =>  esc_html__( 'fa-solid fa-align-center', 'online-newspaper' ),
                                'right'  =>  esc_html__( 'fa-solid fa-align-right', 'online-newspaper' )
                            ]
                        ],
                        'item_image_option' =>  [
                            'type'  =>  'select',
                            'label' =>  esc_html__( 'Image Option', 'online-newspaper' ),
                            'default'   =>  'original',
                            'options'   =>  [
                                'full_width'  =>  esc_html__( 'Full Width', 'online-newspaper' ),
                                'original'  =>  esc_html__( 'Original', 'online-newspaper' )
                            ]
                        ],
                        'item_option' => 'show'
                    ]
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_custom_repeaters() Method

        /**
         * Get all controls rendered using predefined number control
         * 
         * @since 1.0.0
         */
        public function get_custom_number_controls( $id = '' ) {
            $default = [
                'type'  =>  'number',
                'input_attrs'   =>  $this->get_input_attrs([
                    'min'   =>  1
                ]),
            ];

            $control_array = [
                'words_to_read_per_minute'  => $this->get_params( $default, [
                    'label' =>  esc_html( 'Words to read per minute', 'online-newspaper' ),
                    'description' => esc_html__( 'This is used to calculate read time.', 'online-newspaper' ),
                    'full_width'   =>  true,
                    'input_attrs'   =>  $this->get_input_attrs([
                        'min'   =>  1,
                        'max'   =>  5000
                    ]),
                ]),
                'custom_button_icon_distance'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Distance (px)', 'online-newspaper' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   =>  50
                    ]),
                    'transport' =>  'postMessage',
                    'bottom_separator'  =>  true
                ]),
                'sticky_posts_posts_to_append'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Posts to Append', 'online-newspaper' ),
                    'input_attrs' => $this->get_input_attrs()
                ]),
                'sticky_posts_to_show'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Total Number of Posts', 'online-newspaper' ),
                    'input_attrs' => $this->get_input_attrs()
                ]),
                'ticker_news_numbers'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Number of posts to display', 'online-newspaper' ),
                ]),
                'web_stories_no_of_cats_to_show'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'No. of category to show', 'online-newspaper' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   =>  10,
                        'min'   =>  3
                    ]),
                ]),
                'web_stories_max_no_of_inner_stories'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Max no. of inner stories', 'online-newspaper' ),
                    'input_attrs' => $this->get_input_attrs(),
                ]),
                'main_banner_section_border_radius'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (Px)', 'online-newspaper' ),
                    'transport' =>  'postMessage',
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  200,
                        'min'   =>  0
                    ])
                ]),
                'web_stories_section_border_radius'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (Px)', 'online-newspaper' ),
                    'transport' =>  'postMessage',
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  200,
                        'min'   =>  0
                    ])
                ]),
                'full_width_section_border_radius'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (Px)', 'online-newspaper' ),
                    'transport' =>  'postMessage',
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  200,
                        'min'   =>  0
                    ])
                ]),
                'leftc_rights_section_border_radius'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (Px)', 'online-newspaper' ),
                    'transport' =>  'postMessage',
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  200,
                        'min'   =>  0
                    ])
                ]),
                'lefts_rightc_section_border_radius'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (Px)', 'online-newspaper' ),
                    'transport' =>  'postMessage',
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  200,
                        'min'   =>  0
                    ])
                ]),
                'bottom_full_width_section_border_radius'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (Px)', 'online-newspaper' ),
                    'transport' =>  'postMessage',
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  200,
                        'min'   =>  0
                    ])
                ]),
                'two_column_section_border_radius'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (Px)', 'online-newspaper' ),
                    'transport' =>  'postMessage',
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  200,
                        'min'   =>  0
                    ])
                ]),
                'leftc_rights_section_sidebar_border_radius'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (Px)', 'online-newspaper' ),
                    'transport' =>  'postMessage',
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  200,
                        'min'   =>  0
                    ])
                ]),
                'lefts_rightc_section_sidebar_border_radius'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (Px)', 'online-newspaper' ),
                    'transport' =>  'postMessage',
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  200,
                        'min'   =>  0
                    ])
                ]),
                'archive_border_radius'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (Px)', 'online-newspaper' ),
                    'transport' =>  'postMessage',
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  200,
                        'min'   =>  0
                    ])
                ]),
                'sidebar_border_radius'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (Px)', 'online-newspaper' ),
                    'transport' =>  'postMessage',
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  200,
                        'min'   =>  0
                    ])
                ]),
                'ticker_section_border_radius'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (Px)', 'online-newspaper' ),
                    'transport' =>  'postMessage',
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  200,
                        'min'   =>  0
                    ]),
                    'active_callback'   =>  function( $control ) {
                        return $control->manager->get_setting( 'ticker_news_frontpage' )->value();
                    }
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_Farray );
        }   // End of get_custom_number_controls() Method

        /**
         * Get a list of all url controls
         * 
         * @since 1.0.0
         */
        public function get_url( $id = '' ) {
            $default = [
                'type'  =>  'url',
            ];

            $control_array = [
                'header_newsletter_redirect_href_link'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Redirect URL', 'online-newspaper' ),
                    'description'   =>  esc_html__( 'Add url for the button to redirect', 'online-newspaper' ),
                ]),
                'header_ads_banner_image_url' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Banner Url', 'online-newspaper' ),
                    'description'   =>  esc_html__( 'Add url for the ads banner to redirect', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return $control->manager->get_setting( 'header_ads_banner_image_link_url' )->value();
                    }
                ]),
                'custom_button_link' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Button url', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_url() Method

        /**
         * Get all multiselect controls
         * 
         * @since 1.0.0
         */
        public function get_multiselect_controls( $id = '' ) {
            $default = [
                'endpoint'   =>  'extend/get_taxonomy',
                'purpose'   =>  'post',
            ];

            $control_array = [
                // category
                'category_to_include' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Category to include', 'online-newspaper' ),
                    'purpose'   =>  'category'
                ]),
                'category_to_exclude' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Category to exclude', 'online-newspaper' ),
                    'purpose'   =>  'category'
                ]),
                'ticker_news_categories' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Categories', 'online-newspaper' ),
                    'purpose'   =>  'category',
                    'bottom_separator'  =>  true
                ]),
                // posts
                'ticker_news_posts'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts To Include', 'online-newspaper' ),
                    'endpoint'   =>  'extend/get_posts'
                ]),
                // users
                'sticky_posts_categories' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Categories', 'online-newspaper' ),
                    'purpose'   =>  'category'
                ]),
                'sticky_posts_to_include' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts to Include', 'online-newspaper' ),
                    'endpoint'   =>  'extend/get_posts'
                ]),
                'main_banner_slider_categories' =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Categories', 'online-newspaper' ),
                    'purpose'   =>  'category'
                ]),
                'main_banner_posts' =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts To Include', 'online-newspaper' ),
                    'endpoint'   =>  'extend/get_posts'
                ]),
                'web_stories_categories_to_include' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Category to include', 'online-newspaper' ),
                    'purpose'   =>  'category'
                ]),
                'main_banner_list_posts_categories' =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Popular posts categories', 'online-newspaper' ),
                    'purpose'   =>  'category',
                ]),
                'main_banner_grid_posts_categories' =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Popular posts categories', 'online-newspaper' ),
                    'purpose'   =>  'category',
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_multiselect_controls() Method

        /**
         * Get all normal multiselect controls
         * 
         * @since 1.0.0
         */
        public function get_normal_multiselect_controls( $id = '' ) {
            $default = [
                'label'     => esc_html__( 'Field of headings', 'online-newspaper' ),
                'choices'   => [
                    [
                        'value' => 'h1',
                        'label' => esc_html__('H1', 'online-newspaper' )
                    ],
                    [
                        'value' => 'h2',
                        'label' => esc_html__('H2', 'online-newspaper' )
                    ],
                    [
                        'value' => 'h3',
                        'label' => esc_html__('H3', 'online-newspaper' )
                    ],
                    [
                        'value' => 'h4',
                        'label' => esc_html__('H4', 'online-newspaper' )
                    ],
                    [
                        'value' => 'h5',
                        'label' => esc_html__('H5', 'online-newspaper' )
                    ],
                    [
                        'value' => 'h6',
                        'label' => esc_html__('H6', 'online-newspaper' )
                    ]
                ],
                'bottom_separator'  =>  true
            ];

            $control_array = [];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_normal_multiselect_controls() Method

        /**
         * Get all reflector controls
         * 
         * @since 1.0.0
         */
        public function get_builder_reflector_controls( $id ) {
            $default = [
                'label' =>  esc_html__( 'Row Widgets', 'online-newspaper' )
            ];
            $control_array = [
                /* Header builder reflectors */
                'header_first_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'header',
                    'builder'	=>	'header_builder',
                    'row'	=>	1,
                    'responsive'    =>  'responsive-header',
                    'responsive_builder_id' =>  'responsive_header_builder'
                ]),
                'header_second_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'header',
                    'builder'	=>	'header_builder',
                    'row'	=>	2,
                    'responsive'    =>  'responsive-header',
                    'responsive_builder_id' =>  'responsive_header_builder'
                ]),
                'header_third_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'header',
                    'builder'	=>	'header_builder',
                    'row'	=>	3,
                    'responsive'    =>  'responsive-header',
                    'responsive_builder_id' =>  'responsive_header_builder'
                ]),
                /* Footer builder reflectors */
                'footer_first_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'footer',
                    'builder'	=>	'footer_builder',
                    'row'	=>	1,
                    'bottom_separator'  =>  true
                ]),
                'footer_second_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'footer',
                    'builder'	=>	'footer_builder',
                    'row'	=>	2,
                    'bottom_separator'  =>  true
                ]),
                'footer_third_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'footer',
                    'builder'	=>	'footer_builder',
                    'row'	=>	3,
                    'bottom_separator'  =>  true
                ]),
                /* Responsive Header Builder reflector */
                'mobile_canvas_reflector' => $this->get_params( $default, [
                    'placement'	=>	'responsive-header',
                    'builder'	=>	'responsive_header_builder',
                    'row'	=>	4
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_builder_reflector_controls() Method

        /**
         * Get all responsive radio image  controls
         * 
         * @since 1.0.0
         */
        public function get_responsive_radio_image( $id ) {
            $theme_directory = get_template_directory_uri();
            $column_layouts = [
                'one' => [
                    'label' => esc_html__( 'Layout One', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_one.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 1 ]
                ],
                'two' => [
                    'label' => esc_html__( 'Layout One', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_two.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 2 ]
                ],
                'three' => [
                    'label' => esc_html__( 'Layout Two', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_three.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 2 ]
                ],
                'five' => [
                    'label' => esc_html__( 'Layout One', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_five.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 3 ]
                ],
                'six' => [
                    'label' => esc_html__( 'Layout Two', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_six.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 3 ]
                ],
                'eight' => [
                    'label' => esc_html__( 'Layout Three', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_eight.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 3 ]
                ],
                'twenty' => [
                    'label' => esc_html__( 'Layout Four', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_eight.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 3 ]
                ],
                'thirteen' => [
                    'label' => esc_html__( 'Layout Three', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_thirteen.png',
                    'devices'	=>	[ 'smartphone', 'tablet' ],
                    'columns'	=>	[ 2 ]
                ],
                'sixteen' => [
                    'label' => esc_html__( 'Layout Three', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_sixteen.png',
                    'devices'	=>	[ 'smartphone', 'tablet' ],
                    'columns'	=>	[ 3 ]
                ],
            ];

            $footer_column_layouts = [
                'one' => [
                    'label' => esc_html__( 'Layout One', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_one.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 1 ]
                ],
                'two' => [
                    'label' => esc_html__( 'Layout One', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_two.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 2 ]
                ],
                'three' => [
                    'label' => esc_html__( 'Layout Two', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_three.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 2 ]
                ],
                'five' => [
                    'label' => esc_html__( 'Layout One', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_five.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 3 ]
                ],
                'nine' => [
                    'label' => esc_html__( 'Layout One', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_nine.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 4 ]
                ],
                'thirteen' => [
                    'label' => esc_html__( 'Layout Three', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_thirteen.png',
                    'devices'	=>	[ 'smartphone', 'tablet' ],
                    'columns'	=>	[ 2 ]
                ],
                'sixteen' => [
                    'label' => esc_html__( 'Layout Two', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_sixteen.png',
                    'devices'	=>	[ 'smartphone', 'tablet' ],
                    'columns'	=>	[ 3 ]
                ],
                'twenty' => [
                    'label' => esc_html__( 'Layout Four', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_eight.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 3 ]
                ],
                'eighteen' => [
                    'label' => esc_html__( 'Layout Two', 'online-newspaper' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_eighteen.png',
                    'devices'	=>	[ 'smartphone', 'tablet' ],
                    'columns'	=>	[ 4 ]
                ]
            ];
            $default = [
                'label' =>  esc_html__( 'Column layout', 'online-newspaper' ),
                'choices'  => $column_layouts
            ];
            $control_array = [
                /* Header layout row controls */
                'header_first_row_column_layout'    =>  $this->get_params( $default, []),
                'header_second_row_column_layout'    =>  $this->get_params( $default, [
                    'row'   =>  2
                ]),
                'header_third_row_column_layout'    =>  $this->get_params( $default, [
                    'row'   =>  3
                ]),
                /* Footer layout row controls */
                'footer_first_row_column_layout'    =>  $this->get_params( $default, [
                    'builder'   =>  'footer',
                    'choices'   =>  $footer_column_layouts
                ]),
                'footer_second_row_column_layout'    =>  $this->get_params( $default, [
                    'row'   =>  2,
                    'builder'   =>  'footer',
                    'choices'   =>  $footer_column_layouts
                ]),
                'footer_third_row_column_layout'    =>  $this->get_params( $default, [
                    'row'   =>  3,
                    'builder'   =>  'footer',
                    'choices'   =>  $footer_column_layouts
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_responsive_radio_image() Method

        /**
         * Gets all textarea controls
         * 
         * @since 1.0.0
         */
        public function get_textareas( $id = '' ){
            $default = [
                'type'  =>  'textarea',
                'transport' =>  'postMessage'
            ];
            $control_array = [
                'bottom_footer_site_info' => $this->get_params( $default, [
                    'label' => esc_html__( 'Copyright Text', 'online-newspaper' ),
                    'description' => esc_html__( 'Add %year% to retrieve current year.', 'online-newspaper' )
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Gets all responsive radio tab controls
         * 
         * @since 1.0.0
         */
        public function get_responsive_radio_tab( $id = '' ){
            $default = [
                'choices' => [
                    [
                        'value' => 'left',
                        'icon'  =>  'editor-alignleft',
                        'label' =>  esc_html__( 'Left', 'online-newspaper' )
                    ],
                    [
                        'value' => 'center',
                        'icon'  =>  'editor-aligncenter',
                        'label' =>  esc_html__( 'Center', 'online-newspaper' )
                    ],
                    [
                        'value' => 'right',
                        'icon'  =>  'editor-alignright',
                        'label' =>  esc_html__( 'Right', 'online-newspaper' )
                    ]
                ],
                'transport' =>  'postMessage'
            ];
            $control_array = [
                /* Header builder first row */
                'header_first_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_first_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'header_first_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_first_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'header_first_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_first_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                /* Header builder second row */
                'header_second_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_second_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'header_second_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_second_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'header_second_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_second_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                /* Header builder third row */
                'header_third_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_third_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'header_third_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_third_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'header_third_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_third_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                /* Footer builder first row */
                'footer_first_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_first_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'footer_first_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_first_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'footer_first_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_first_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                'footer_first_row_column_four'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 4 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_first_row_column' )->value(), [ 4 ] ) );
                    },
                ]),
                /* Footer builder second row */
                'footer_second_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_second_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'footer_second_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_second_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'footer_second_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_second_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                'footer_second_row_column_four'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 4 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_second_row_column' )->value(), [ 4 ] ) );
                    },
                ]),
                /* Footer builder third row */
                'footer_third_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_third_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'footer_third_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_third_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'footer_third_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_third_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                'footer_third_row_column_four'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 4 Alignment', 'online-newspaper' ),
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_third_row_column' )->value(), [ 4 ] ) );
                    },
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns all typography preset controls
         * 
         * @since 1.0.0
         */
        public function get_typography_preset_controls( $id = '' ) {

            $control_array = [
                'typography_presets' =>   [
                    'label' =>  esc_html__( 'Typography Preset', 'online-newspaper' ),
                    'description'   =>  esc_html__( 'This is the control to use in future projects.', 'online-newspaper' ),
                    'transport' =>  'postMessage'
                ]
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns all preset color controls
         * 
         * @since 1.0.0
         */
        public function get_theme_colors( $id = '' ) {
            $default = [
                'transport' =>  'postMessage'
            ];

            $control_array = [
                // preset colors
                'theme_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Theme Color', 'online-newspaper' ),
                    'variable'   => '--online-newspaper-global-preset-theme-color'
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns all builder controls
         * 
         * @since 1.0.0
         */
        public function get_builder_controls( $id = '' ) {
            $default = [];
            $control_array = [
                'header_builder' => $this->get_params( $default, [
                    'builder_settings_section'	=>	'header_builder_section_settings',
                    'responsive_builder'	=>	'responsive_header_builder',
                    'widgets'	=>	[
                        'site-logo'	=>	[
                            'label' 	=>	esc_html__( 'Site Logo and Title', 'online-newspaper' ),
                            'icon' 	=>	'admin-site',
                            'section'	=>	'title_tagline'
                        ],
                        'date-time'	=>	[
                            'label' 	=>	esc_html__( 'Date Time', 'online-newspaper' ),
                            'icon' 	=>	'clock',
                            'section'	=>	'date_time_section'
                        ],
                        'newsletter'	=>	[
                            'label' 	=>	esc_html__( 'Newsletter / Subscribe Button', 'online-newspaper' ),
                            'icon' 	=>	'megaphone',
                            'section'	=>	'header_newsletter_section'
                        ],
                        'social-icons'	=>	[
                            'label' 	=>	esc_html__( 'Social Icons', 'online-newspaper' ),
                            'icon' 	=>	'networking',
                            'section'	=>	'social_icons_section'
                        ],
                        'search'	=>	[
                            'label' 	=>	esc_html__( 'Search', 'online-newspaper' ),
                            'icon' 	=>	'search',
                            'section'	=>	'header_live_search_section'
                        ],
                        'menu'	=>	[
                            'label' 	=>	esc_html__( 'Primary Menu', 'online-newspaper' ),
                            'icon' 	=>	'menu',
                            'section'	=>	'header_menu_options_section'
                        ],
                        'button'	=>	[
                            'label' 	=>	esc_html__( 'Button', 'online-newspaper' ),
                            'icon' 	=>	'button',
                            'section'	=>	'custom_button_section'
                        ],
                        'theme-mode'	=>	[
                            'label' 	=>	esc_html__( 'Theme Mode', 'online-newspaper' ),
                            'icon' 	=>	'lightbulb',
                            'section'	=>	'theme_mode_section'
                        ],
                        'off-canvas'	=>	[
                            'label' 	=>	esc_html__( 'Off Canvas', 'online-newspaper' ),
                            'icon' 	=>	'text-page',
                            'section'	=>	'canvas_menu_section'
                        ],
                        'image'	=>	[
                            'label' 	=>	esc_html__( 'Image', 'online-newspaper' ),
                            'icon' 	=>	'format-image',
                            'section'	=>	'header_advertisement_banner_section'
                        ],
                        'random-news'	=>	[
                            'label' 	=>	esc_html__( 'Random News', 'online-newspaper' ),
                            'icon' 	=>	'randomize',
                            'section'	=>	'random_news_section'
                        ],
                        'secondary-menu'	=>	[
                            'label' 	=>	esc_html__( 'Secondary Menu', 'online-newspaper' ),
                            'icon' 	=>	'menu-alt2',
                            'section'	=>	'secondary_menu_options'
                        ],
                        'ticker-news'	=>	[
                            'label' 	=>	esc_html__( 'Ticker news', 'online-newspaper' ),
                            'icon' 	=>	'slides',
                            'section'	=>	'ticker_news_section'
                        ],
                        'widget-area'	=>	[
                            'label' 	=>	esc_html__( 'Widget Area', 'online-newspaper' ),
                            'icon' 	=>	'columns',
                            'section'	=>	'sidebar-widgets-header-builder-widget-area'
                        ]
                    ]
                ]),
                'footer_builder' => $this->get_params( $default, [
                    'builder_settings_section'	=>	'footer_builder_section_settings',
                    'placement'	=>	'footer',
                    'widgets'	=>	[
                        'logo'	=>	[
                            'label' 	=>	esc_html__( 'Logo', 'online-newspaper' ),
                            'icon' 	=>	'admin-site',
                            'section'	=>	'footer_logo'
                        ],
                        'social-icons'	=>	[
                            'label' 	=>	esc_html__( 'Social Icons', 'online-newspaper' ),
                            'icon' 	=>	'networking',
                            'section'	=>	'footer_social_icons_section'
                        ],
                        'copyright'	=>	[
                            'label' 	=>	esc_html__( 'Copyright', 'online-newspaper' ),
                            'icon' 	=>	'privacy',
                            'section'	=>	'footer_copyright'
                        ],
                        'menu'	=>	[
                            'label' 	=>	esc_html__( 'Secondary Menu', 'online-newspaper' ),
                            'icon' 	=>	'menu',
                            'section'	=>	'footer_menu_options_section'
                        ],
                        'sidebar-one'	=>	[
                            'label' 	=>	esc_html__( 'Sidebar 1', 'online-newspaper' ),
                            'icon' 	=>	'columns',
                            'section'	=>	'sidebar-widgets-footer-sidebar--column-1'
                        ],
                        'sidebar-two'	=>	[
                            'label' 	=>	esc_html__( 'Sidebar 2', 'online-newspaper' ),
                            'icon' 	=>	'columns',
                            'section'	=>	'sidebar-widgets-footer-sidebar--column-2'
                        ],
                        'sidebar-three'	=>	[
                            'label' 	=>	esc_html__( 'Sidebar 3', 'online-newspaper' ),
                            'icon' 	=>	'columns',
                            'section'	=>	'sidebar-widgets-footer-sidebar--column-3'
                        ],
                        'sidebar-four'	=>	[
                            'label' 	=>	esc_html__( 'Sidebar 4', 'online-newspaper' ),
                            'icon' 	=>	'columns',
                            'section'	=>	'sidebar-widgets-footer-sidebar--column-4'
                        ],
                        'scroll-to-top'	=>	[
                            'label' 	=>	esc_html__( 'Scroll to Top', 'online-newspaper' ),
                            'icon' 	=>	'arrow-up-alt2',
                            'section'	=>	'stt_options_section'
                        ],
                    ]
                ])
            ];

            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns all responsive builder controls
         * 
         * @since 1.0.0
         */
        public function get_responsive_builder_controls( $id = '' ) {
            $default = [];
            $control_array = [
                'responsive_header_builder' => $this->get_params( $default, [
                    'builder_settings_section'	=>	'header_builder_section_settings',
                    'placement'	=>	'header',
                    'responsive_canvas_id'	=>	'responsive-canvas',
                    'responsive_section'	=>	'mobile_canvas_section',
                    'widgets'	=>	[
                        'site-logo'	=>	[
                            'label' 	=>	esc_html__( 'Site Logo and Title', 'online-newspaper' ),
                            'icon' 	=>	'admin-site',
                            'section'	=>	'title_tagline'
                        ],
                        'date-time'	=>	[
                            'label' 	=>	esc_html__( 'Date Time', 'online-newspaper' ),
                            'icon' 	=>	'clock',
                            'section'	=>	'date_time_section'
                        ],
                        'newsletter'	=>	[
                            'label' 	=>	esc_html__( 'Newsletter / Subscribe Button', 'online-newspaper' ),
                            'icon' 	=>	'megaphone',
                            'section'	=>	'header_newsletter_section'
                        ],
                        'social-icons'	=>	[
                            'label' 	=>	esc_html__( 'Social Icons', 'online-newspaper' ),
                            'icon' 	=>	'networking',
                            'section'	=>	'social_icons_section'
                        ],
                        'search'	=>	[
                            'label' 	=>	esc_html__( 'Search', 'online-newspaper' ),
                            'icon' 	=>	'search',
                            'section'	=>	'header_live_search_section'
                        ],
                        'menu'	=>	[
                            'label' 	=>	esc_html__( 'Primary Menu', 'online-newspaper' ),
                            'icon' 	=>	'menu',
                            'section'	=>	'header_menu_options_section'
                        ],
                        'button'	=>	[
                            'label' 	=>	esc_html__( 'Button', 'online-newspaper' ),
                            'icon' 	=>	'button',
                            'section'	=>	'custom_button_section'
                        ],
                        'theme-mode'	=>	[
                            'label' 	=>	esc_html__( 'Theme Mode', 'online-newspaper' ),
                            'icon' 	=>	'lightbulb',
                            'section'	=>	'theme_mode_section'
                        ],
                        'off-canvas'	=>	[
                            'label' 	=>	esc_html__( 'Off Canvas', 'online-newspaper' ),
                            'icon' 	=>	'text-page',
                            'section'	=>	'canvas_menu_section'
                        ],
                        'image'	=>	[
                            'label' 	=>	esc_html__( 'Image', 'online-newspaper' ),
                            'icon' 	=>	'format-image',
                            'section'	=>	'header_advertisement_banner_section'
                        ],
                        'random-news'	=>	[
                            'label' 	=>	esc_html__( 'Random News', 'online-newspaper' ),
                            'icon' 	=>	'randomize',
                            'section'	=>	'random_news_section'
                        ],
                        'toggle-button'	=>	[
                            'label' 	=>	esc_html__( 'Toggle Button', 'online-newspaper' ),
                            'icon' 	=>	'ellipsis',
                            'section'	=>	'mobile_canvas_section'
                        ],
                        'secondary-menu'	=>	[
                            'label' 	=>	esc_html__( 'Secondary Menu', 'online-newspaper' ),
                            'icon' 	=>	'menu-alt2',
                            'section'	=>	'secondary_menu_options'
                        ],
                        'ticker-news'	=>	[
                            'label' 	=>	esc_html__( 'Ticker news', 'online-newspaper' ),
                            'icon' 	=>	'slides',
                            'section'	=>	'ticker_news_section'
                        ],
                        'widget-area'	=>	[
                            'label' 	=>	esc_html__( 'Widget Area', 'online-newspaper' ),
                            'icon' 	=>	'columns',
                            'section'	=>	'sidebar-widgets-header-builder-widget-area'
                        ]
                    ]
                ])
            ];

            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns all term colors controls
         * 
         * @since 1.0.0
         */
        public function get_term_colors( $id = '' ) {
            $control_array = [
                'category_colors' => [
                    'bottom_separator'  =>  true,
                    'transport' =>  'postMessage',
                    'terms'  =>  get_categories([ 'fields' => 'id=>name', 'hide_empty' => true ])
                ],
                'tag_colors' => [
                    'bottom_separator'  =>  true,
                    'transport' =>  'postMessage',
                    'terms'  =>  get_tags([ 'fields' => 'id=>name', 'hide_empty' => true ])
                ]
            ];

            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns all responsive multiselect tab
         * 
         * @since 1.0.0
         */
        public function get_responsive_multiselect_tab_controls( $id = '' ) {
            $default = [
                'transport' =>  'postMessage'
            ];
            $control_array = [
                'stt_responsive_option'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Scroll To Top Visibility', 'online-newspaper' ),
                    'choices' => [
                        [
                            'value' => 'desktop',
                            'icon'  =>  'desktop',
                            'label' =>  esc_html__( 'Desktop', 'online-newspaper' )
                        ],
                        [
                            'value' => 'tablet',
                            'icon'  =>  'tablet',
                            'label' =>  esc_html__( 'Tablet', 'online-newspaper' )
                        ],
                        [
                            'value' => 'mobile',
                            'icon'  =>  'smartphone',
                            'label' =>  esc_html__( 'Mobile', 'online-newspaper' )
                        ]
                    ],
                    'bottom_separator'  =>  true
                ]),
                'header_ads_banner_responsive_option'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Ads Banner Visibility', 'online-newspaper' ),
                    'choices' => [
                        [
                            'value' => 'desktop',
                            'icon'  =>  'desktop',
                            'label' =>  esc_html__( 'Desktop', 'online-newspaper' )
                        ],
                        [
                            'value' => 'tablet',
                            'icon'  =>  'tablet',
                            'label' =>  esc_html__( 'Tablet', 'online-newspaper' )
                        ],
                        [
                            'value' => 'mobile',
                            'icon'  =>  'smartphone',
                            'label' =>  esc_html__( 'Mobile', 'online-newspaper' )
                        ]
                    ],
                    'bottom_separator'  =>  true
                ]),
            ];

            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns all block repeater controls
         * 
         * @since 1.0.0
         */
        public function get_block_repeater_controls( $id = '' ) {
            $default = [
                'label' =>  esc_html__( 'Blocks to show in this section', 'online-newspaper' ),
                'description'   =>  esc_html__( 'Hold block item and drag vertically to re-order blocks', 'online-newspaper' )
            ];
            $control_array = [
                'full_width_blocks' =>  $this->get_params( $default, []),
                'leftc_rights_blocks'   =>  $this->get_params( $default, []),
                'lefts_rightc_blocks'   =>  $this->get_params( $default, []),
                'bottom_full_width_blocks'  =>  $this->get_params( $default, []),
                'two_column_first_column_blocks'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Blocks to show in this column', 'online-newspaper' ),
                    'fields_to_exclude' =>  [ 'column' ]
                ]),
                'two_column_second_column_blocks'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Blocks to show in this column', 'online-newspaper' ),
                    'fields_to_exclude' =>  [ 'column' ]
                ])
            ];

            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Get controls parameters necessary in add_control function
         * 
         * @since 1.0.0
         */
        public function get_params( $default = [], $append = [] ) {
            if( ! empty( $append ) && is_array( $append ) ) return $append += $default;
            return $default;
        }

        /**
         * Get input_attrs array
         * 
         * @since 1.0.0
         */
        public function get_input_attrs( $append = [] ) {
            $default = [
                'max'   =>  100,
                'min'   =>  0,
                'step'   =>  1,
                'reset'   =>  true
            ];
            if( ! empty( $append ) && is_array( $append ) ) return $append += $default;
            return $default;
        }
    }
endif;