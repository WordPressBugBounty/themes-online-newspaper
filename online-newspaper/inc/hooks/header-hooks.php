<?php
/**
 * Header hooks and functions
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
use OnlineNewspaper\CustomizerDefault as ONP;

if( ! function_exists( 'online_newspaper_social_icons_html' ) ) :
    /**
     * MARK: Social Icons
     * 
     * @since 1.0.0
     */
    function online_newspaper_social_icons_html() {

        echo '<div class="social-icons-wrap">';

            online_newspaper_customizer_social_icons( '', 4 );

        echo '</div>';

    }
    add_action( 'online_newspaper_social_icons_hook', 'online_newspaper_social_icons_html' );
 endif;

 if( ! function_exists( 'online_newspaper_header_site_branding_part' ) ) :
    /**
     * MARK: Site Logo & Title
     * 
     * @since 1.0.0
     */
    function online_newspaper_header_site_branding_part() {
        echo '<div class="site-branding">';

            $site_description_show_hide = ONP\online_newspaper_get_customizer_option( 'blogdescription_option' );

            the_custom_logo();

            $tag = ( is_front_page() && is_home() ) ? 'h1' : 'p';

            echo '<', $tag, ' class="site-title"><a href="', esc_url( home_url( '/' ) ), '" rel="home">', get_bloginfo( 'name' ), '</a></', $tag, '>';

            $online_newspaper_description = get_bloginfo( 'description', 'display' );

            if ( $site_description_show_hide && ( $online_newspaper_description || is_customize_preview() ) ) echo '<p class="site-description">', $online_newspaper_description, '</p>';

        echo '</div><!-- .site-branding -->';
    }
    add_action( 'online_newspaper_header__site_branding_section_hook', 'online_newspaper_header_site_branding_part' );
 endif;

 if( ! function_exists( 'online_newspaper_header_advertisement_html' ) ) :
    /**
     * MARK: Advertisement
     * 
     * @since 1.0.0
     */
    function online_newspaper_header_advertisement_html() {
        if( ! ONP\online_newspaper_get_customizer_option( 'header_ads_banner_responsive_option' ) ) return;
        $header_ads_banner_image = ONP\online_newspaper_get_customizer_option( 'header_ads_banner_image' );
        $header_ads_banner_image_url = ONP\online_newspaper_get_customizer_option( 'header_ads_banner_image_url' );
        $header_ads_banner_custom_target = ONP\online_newspaper_get_customizer_option( 'header_ads_banner_custom_target' );
        if( ! empty( $header_ads_banner_image ) ) :
        ?>
            <div class="ads-banner">
                <a href="<?php echo esc_url( $header_ads_banner_image_url ); ?>" target="<?php echo esc_html( $header_ads_banner_custom_target ); ?>" aria-label="<?php echo get_the_title( $header_ads_banner_image ); ?>">
                    <?php echo wp_get_attachment_image( $header_ads_banner_image, 'large', false, [ 'class' => 'header-image' ] ); ?>
                </a>
            </div><!-- .ads-banner -->
        <?php
        endif;
     }
    add_action( 'online_newspaper_header_advertisement_hook', 'online_newspaper_header_advertisement_html', 10 );
 endif;

 if( ! function_exists( 'online_newspaper_newsletter_html' ) ) :
    /**
     * MARK: Newsletter
     * 
     * @since 1.0.0
     */
     function online_newspaper_newsletter_html() {
        $newsletter_label = ONP\online_newspaper_get_customizer_option( 'newsletter_label' );
        $newsletter_icon_picker = [ 'type'  => 'none', 'value' => 'fa-solid fa-bell' ];
        $header_newsletter_redirect_href_link = ONP\online_newspaper_get_customizer_option( 'header_newsletter_redirect_href_link' );
        $header_newsletter_hover_animation = ONP\online_newspaper_get_customizer_option( 'header_newsletter_hover_animation' );
        $elementClass = 'newsletter-element animation--' . $header_newsletter_hover_animation;
        ?>
            <div class="<?php echo esc_html( $elementClass ); ?>" <?php if( isset($newsletter_label) && !empty($newsletter_label) ) echo 'title="' . esc_attr( $newsletter_label ) . '"'; ?>>
                <a href="<?php echo esc_url( $header_newsletter_redirect_href_link ); ?>" target="_blank" data-popup="redirect">
                    <?php
                        if( isset( $newsletter_icon_picker['value'] ) && ! empty( $newsletter_icon_picker['value'] ) ) echo '<span class="title-icon"><i class="', esc_attr( $newsletter_icon_picker['value'] ), '"></i></span>';
                        if( $newsletter_label ) echo '<span class="title-text">', esc_html( $newsletter_label ), '</span>';
                    ?>
                </a>
            </div><!-- .newsletter-element -->
        <?php
    }
    add_action( 'online_newspaper_newsletter_hook', 'online_newspaper_newsletter_html' );
 endif;

 if( ! function_exists( 'online_newspaper_random_news_html' ) ) :
    /**
     * MARK: Random News
     * 
     * @since 1.0.0
     */
     function online_newspaper_random_news_html() {
        $random_news_icon_picker = [ 'type'  => 'icon', 'value' => 'fas fa-random' ];
        $random_news_label = ONP\online_newspaper_get_customizer_option( 'random_news_label' );
        $button_url = online_newspaper_get_random_news_url();
        $icon = $random_news_icon_picker['value'];
        ?>
            <div class="random-news-element" <?php if( isset( $random_news_label ) && !empty( $random_news_label ) ) echo 'title="' . esc_attr( $random_news_label ) . '"'; ?>>
                <a href="<?php echo esc_url($button_url); ?>" target="_blank">
                    <?php
                        if( isset( $icon ) && ! empty( $icon ) ) echo '<span class="title-icon"><i class="', esc_attr( $icon ), '"></i></span>';
                        if( $random_news_label) echo '<span class="title-text">' .esc_html( $random_news_label ). '</span>';
                    ?>
                </a>
            </div><!-- .random-news-element -->
        <?php
    }
    add_action( 'online_newspaper_random_news_hook', 'online_newspaper_random_news_html' );
 endif;

 if( ! function_exists( 'online_newspaper_off_canvas_html' ) ) :
    /**
     * MARK: Off Canvas
     * 
     * @since 1.0.0
     */
     function online_newspaper_off_canvas_html() {
        ?>
            <div class="sidebar-toggle-wrap">
                <button class="off-canvas-trigger" href="javascript:void(0);" aria-label="<?php echo esc_attr__( 'Open Canvas', 'online-newspaper' ); ?>">
                    <div class="online_newspaper_sidetoggle_menu_burger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
                <div class="sidebar-toggle hide">
                <span class="off-canvas-close"><i class="fas fa-times"></i></span>
                    <div class="online-newspaper-container">
                    <div class="row">
                        <?php dynamic_sidebar( 'off-canvas-sidebar' ); ?>
                    </div>
                    </div>
                </div>
            </div>
        <?php
    }
    add_action( 'online_newspaper_off_canvas_hook', 'online_newspaper_off_canvas_html' );
 endif;

 if( ! function_exists( 'online_newspaper_primary_menu_html' ) ) :
    /**
     * MARK: Primary Menu
     * 
     * @since 1.0.0
     */
    function online_newspaper_primary_menu_html() {
      ?>
        <nav id="site-navigation" class="main-navigation <?php echo esc_attr( 'hover-effect--' . ONP\online_newspaper_get_customizer_option( 'header_menu_hover_effect' ) ); ?>">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <div id="online_newspaper_menu_burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <span class="menu_txt"><?php esc_html_e( 'Menu', 'online-newspaper' ); ?></span></button>
            <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-2',
                        'menu_id'        => 'header-menu',
                    )
                );
            ?>
        </nav><!-- #site-navigation -->
      <?php
    }
    add_action( 'online_newspaper_primary_menu_hook', 'online_newspaper_primary_menu_html' );
 endif;

 if( ! function_exists( 'online_newspaper_header_search_html' ) ) :
   /**
    * MARK: Search
    * 
    * @since 1.0.0
    */
    function online_newspaper_header_search_html() {
        ?>
            <div class="search-wrap">
                <button class="search-trigger search-action" title="<?php echo esc_attr__( 'Open Search', 'online-newspaper' ); ?>">
                    <i class="fas fa-search"></i>
                </button>
                <?php
                    echo '<button class="search-close-btn search-action hide"><i class="fas fa-times"></i></button>';
                ?>
            </div>
        <?php
    }
    add_action( 'online_newspaper_header_search_hook', 'online_newspaper_header_search_html' );
endif;

 if( ! function_exists( 'online_newspaper_custom_button_html' ) ) :
    /**
     * MARK: Custom Button
     * 
     * @since 1.0.0
     */
     function online_newspaper_custom_button_html() {
        $custom_button_link = ONP\online_newspaper_get_customizer_option( 'custom_button_link' );
        $custom_button_label = ONP\online_newspaper_get_customizer_option( 'custom_button_label' );
        $custom_button_icon_picker = [ 'type'  => 'icon', 'value' => 'fab fa-youtube' ];
        ?>
            <a class="header-custom-button" href="<?php echo esc_url( $custom_button_link ); ?>" target="_blank">
                <?php if( $custom_button_icon_picker['type'] == 'icon' && $custom_button_icon_picker['value'] != "fas fa-ban" ) : ?>
                    <span class="icon">
                        <i class="<?php echo esc_attr( $custom_button_icon_picker['value'] ); ?>"></i>
                    </span>
                <?php endif;
                if( $custom_button_label ) :
                ?>
                    <span class="ticker_label_title_string"><?php echo esc_html( $custom_button_label ); ?></span>
                <?php endif; ?>
            </a>
        <?php
    }
    add_action( 'online_newspaper_custom_button_hook', 'online_newspaper_custom_button_html' );
 endif;

 if( ! function_exists( 'online_newspaper_ticker_news_html' ) ) :
    /**
     * MARK: Ticker News
     * 
     * @since 1.0.0
     */
    function online_newspaper_ticker_news_html() {
        $ticker_news_order_by = ONP\online_newspaper_get_customizer_option( 'ticker_news_order_by' );
        $ticker_news_numbers = ONP\online_newspaper_get_customizer_option( 'ticker_news_numbers' );
        $ticker_news_posts = ONP\online_newspaper_get_customizer_option( 'ticker_news_posts' );
        $ticker_news_categories = ONP\online_newspaper_get_customizer_option( 'ticker_news_categories' );

        $orderArray = explode( '-', $ticker_news_order_by );
        $ticker_args = array(
            'order' => esc_html( $orderArray[1] ),
            'orderby' => esc_html( $orderArray[0] ),
            'ignore_sticky_posts'    => true,
            'fields'    =>  'ids',
            'no_found_rows' =>  true,
            'update_post_meta_cache'    =>  false,
            'update_post_term_cache'    =>  false,
        );
        $ticker_args['posts_per_page'] = absint( $ticker_news_numbers );
        if( $ticker_news_categories ) $ticker_args['cat'] = online_newspaper_get_categories_for_args( $ticker_news_categories );
        if( $ticker_news_posts ) $ticker_args['post__in'] = online_newspaper_get_post_id_for_args( $ticker_news_posts );

        $elementClass = 'ticker-news-wrap online-newspaper-ticker layout--two';
        if( ! ONP\online_newspaper_get_customizer_option( 'ticker_news_thumbnail_option' ) ) $elementClass .= ' no-feat-img';
        $ticker_news_frontpage = ONP\online_newspaper_get_customizer_option( 'ticker_news_frontpage' );
        $ticker_news_card_enable = ONP\online_newspaper_get_customizer_option( 'ticker_news_card_enable' );
        $sectionClass[] = 'online-newspaper-section';
        $sectionClass[] = 'online-newspaper-ticker-news';
        $sectionClass[] = 'width-' . online_newspaper_get_section_width_layout_val( 'ticker_news_width_layout' );
        $sectionClass[] = 'card--' . ( $ticker_news_card_enable ? 'on' : 'off' );
        ?>
            <?php if( $ticker_news_frontpage ) echo '<section id="online-newspaper-ticker-news" class="', esc_attr( implode( ' ', $sectionClass ) ),'"><div class="online-newspaper-container"><div class="row">'; ?>
            <div class="<?php echo esc_attr( $elementClass ); ?>">
                <div class="ticker_label_title ticker-title online-newspaper-ticker-label">
                    <span class="icon"></span>
                    <?php 
                        echo '<span class="ticker_label_title_string">', esc_html__( 'Headlines', 'online-newspaper' ), '</span>';
                    ?>
                </div>
                <div class="online-newspaper-ticker-box">
                    <?php
                        $online_newspaper_direction = 'left';
                        $online_newspaper_dir = 'ltr';
                        if( is_rtl() ){
                            $online_newspaper_direction = 'right';
                            $online_newspaper_dir = 'ltr';
                        }
                    ?>

                    <div class="ticker-item-wrap" direction="<?php echo esc_attr($online_newspaper_direction); ?>" dir="<?php echo esc_attr($online_newspaper_dir); ?>">
                        <?php get_template_part( 'template-parts/ticker-news/template', 'two', $ticker_args ); ?>
                    </div>
                </div>
            </div>
            <?php
            if( $ticker_news_frontpage ) echo '</div></div></section>';
    }
    add_action( 'online_newspaper_ticker_news_hook', 'online_newspaper_ticker_news_html', 10 );
 endif;

if( ! function_exists( 'online_newspaper_date_time_html' ) ) :
    /**
     * MARK: Date Time
     * 
     * @since 1.0.0
    */
    function online_newspaper_date_time_html() {
        $time_option = ONP\online_newspaper_get_customizer_option( 'time_option' );
        $date_option = ONP\online_newspaper_get_customizer_option( 'date_option' );
        $display_block = ONP\online_newspaper_get_customizer_option( 'date_time_display_block' );
        $dateTimeClass = 'top-date-time';
        if( $display_block ) $dateTimeClass .= ' block';
        ?>
            <div class="<?php echo esc_attr( $dateTimeClass ); ?>">
                <span class="top-date-time-inner">
                    <?php
                        if( $time_option ) echo '<span class="time">', date( 'H:i:s A' ) ,'</span>';
                        if( $date_option ) echo '<span class="date">', date_i18n( 'l, ' . get_option( 'date_format' ), current_time( 'timestamp' )) ,'</span>';
                    ?>
                </span>
            </div>
        <?php
    }
    add_action( 'online_newspaper_date_time_hook', 'online_newspaper_date_time_html', 10 );
endif;

if( ! function_exists( 'online_newspaper_secondary_menu_html' ) ) :
   /**
    * MARK: Secondary Menu
    * 
    * @since 1.0.0
    */
    function online_newspaper_secondary_menu_html() {
        $nav_classes = 'top-nav-menu main-navigation hover-effect--' . ONP\online_newspaper_get_customizer_option( 'secondary_menu_hover_effect' );
        ?>
            <div class="site-navigation-wrapper secondary-menu">
                <nav id="site-navigation-secondary" class="<?php echo esc_attr( $nav_classes ); ?>">
                    <?php
                        wp_nav_menu([
                            'theme_location'    =>  'menu-1',
                            'menu_id'   =>  'top-menu',
                            'depth' =>  1
                        ]);
                    ?>
                </nav><!-- #site-navigation -->
            </div>
        <?php
    }
   add_action( 'online_newspaper_secondary_menu_hook', 'online_newspaper_secondary_menu_html' );
endif;

if( ! function_exists( 'online_newspaper_get_toggle_button_html' ) ) :
    /**
     * MARK: Toggle Button
     * 
     * @since 1.0.0
     */
    function online_newspaper_get_toggle_button_html() {
        ?>
            <div class="toggle-button-wrapper">
                <button class="canvas-menu-icon" aria-label="<?php echo esc_attr__( 'Open mobile canvas', 'online-newspaper' )?>"></button>
            </div>
        <?php
    }
endif;

if( ! function_exists( 'online_newspaper_theme_mode_html' ) ) :
    /**
     * MARK: Theme Mode
     * 
     * @since 1.0.0
     */
    function online_newspaper_theme_mode_html() {
        $light_mode_icon_args = ONP\online_newspaper_get_customizer_option( 'theme_mode_light_icon' );
        $dark_mode_icon_args = ONP\online_newspaper_get_customizer_option( 'theme_mode_dark_icon' );
        $light_mode_icon_class = ( array_key_exists( 'value', $light_mode_icon_args ) && is_array( $light_mode_icon_args ) ) ? $light_mode_icon_args['value'] : '';
        $dark_mode_icon_class = ( array_key_exists( 'value', $dark_mode_icon_args ) && is_array( $dark_mode_icon_args ) ) ? $dark_mode_icon_args['value'] : '';
        if( $light_mode_icon_class || $dark_mode_icon_class ) :
            $elementClass = 'mode-toggle-wrap';
            ?>
                <div class="<?php echo esc_attr( $elementClass ); ?>">
                    <span class="mode-toggle">
                        <?php 
                            if( $light_mode_icon_class ) echo '<i class="', esc_attr( $light_mode_icon_args['value'] ), ' light"></i>';
                            if( $dark_mode_icon_class ) echo '<i class="', esc_attr( $dark_mode_icon_args['value'] ), ' dark"></i>';
                        ?>
                    </span>
                </div>
            <?php
        endif;
    }
    add_action( 'online_newspaper_theme_mode_hook', 'online_newspaper_theme_mode_html' );
endif;