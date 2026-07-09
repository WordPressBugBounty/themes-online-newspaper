<?php
/**
 * Includes functions for selective refresh
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
use OnlineNewspaper\CustomizerDefault as ONP;
if( ! function_exists( 'online_newspaper_customize_selective_refresh' ) ) :
    /**
     * Adds partial refresh for the customizer preview
     * 
     */
    function online_newspaper_customize_selective_refresh( $wp_customize ) {
        if ( ! isset( $wp_customize->selective_refresh ) ) return;

        // site title
        $wp_customize->selective_refresh->add_partial( 'blogname', [
            'selector'        => '.site-header .site-title a',
            'render_callback' => 'online_newspaper_customize_partial_blogname'
        ]);

        // site description
        $wp_customize->selective_refresh->add_partial( 'blogdescription', [
            'selector'        => '.site-description',
            'render_callback' => 'online_newspaper_customize_partial_blogdescription',
            'settings'  =>  [ 'blogdescription_option', 'blogdescription' ]
        ]);

        // post read more button label
        $wp_customize->selective_refresh->add_partial( 'global_button_label', [
            'selector'        => 'article .online-newspaper-button',
            'render_callback' => 'online_newspaper_customizer_read_more_button',
            'settings'  =>  [ 'global_button_label' ],
            'container_inclusive'   =>  true
        ]);

        // scroll to top label
        $wp_customize->selective_refresh->add_partial( 'stt_label', [
            'selector'        => '#online-newspaper-scroll-to-top',
            'render_callback' => 'online_newspaper_customizer_stt_button',
            'settings'  =>  [ 'stt_label' ]
        ]);

        // newsletter icon picker
        $wp_customize->selective_refresh->add_partial( 'newsletter_label', [
            'selector'        => '.newsletter-element',
            'render_callback' => 'online_newspaper_customizer_newsletter_button_label',
            'settings'  =>  [ 'newsletter_label' ]
        ]);

        // random news icon picker
        $wp_customize->selective_refresh->add_partial( 'random_news_label', [
            'selector'        => '.random-news-element',
            'render_callback' => 'online_newspaper_customizer_random_news_button_label',
            'settings'  =>  [ 'random_news_label' ]
        ]);

        // single post related posts option
        $wp_customize->selective_refresh->add_partial( 'single_post_related_posts_option', [
            'selector'        => '.single-related-posts-section-wrap',
            'render_callback' => 'online_newspaper_single_related_posts',
            'settings'  =>  [ 'single_post_related_posts_option' ]
        ]);

        // custom button label
        $wp_customize->selective_refresh->add_partial( 'custom_button_label', [
            'selector'        => '.header-custom-button',
            'render_callback' => 'online_newspaper_custom_button_selective_refresh',
            'settings'  =>  [ 'custom_button_label' ]
        ]);

        // Date Time 
        $wp_customize->selective_refresh->add_partial( 'time_option', [
            'selector'  =>  'body #masthead .top-date-time',
            'render_callback'   =>  'online_newspaper_date_time_selective_refresh',
            'settings'  =>  [ 'time_option', 'date_option' ]
        ]);
        
        // Theme Mode
        $wp_customize->selective_refresh->add_partial( 'theme_mode_light_icon', [
            'selector'  =>  'body #masthead .mode-toggle-wrap',
            'render_callback'   =>  'online_newspaper_theme_mode_selective_refresh',
            'settings'  =>  [ 'theme_mode_light_icon', 'theme_mode_dark_icon' ]
        ]);
        
        // Footer logo
        $wp_customize->selective_refresh->add_partial( 'bottom_footer_header_or_custom', [
            'selector'  =>  '.site-footer .bb-bldr-widget .footer-logo',
            'render_callback'   =>  'online_newspaper_footer_logo_selective_refresh',
            'settings'  =>  [ 'bottom_footer_header_or_custom', 'bottom_footer_logo_option' ]
        ]);

        // Header Builder Edit button
        $wp_customize->selective_refresh->add_partial( 'header_builder_section_tab', [
            'selector'        => 'header.site-header'
        ]);

        // Footer Builder Edit button
        $wp_customize->selective_refresh->add_partial( 'footer_section_tab', [
            'selector'        => 'footer.site-footer'
        ]);

        // Web stories Button and section label
        $wp_customize->selective_refresh->add_partial( 'archive_pagination_type', [
            'selector'        => 'body #primary .primary-content .pagination',
            'render_callback'   =>  'online_newspaper_pagination_fnc',
            'container_inclusive'   =>  true
        ]);
    }
    add_action( 'customize_register', 'online_newspaper_customize_selective_refresh' );
endif;

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function online_newspaper_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function online_newspaper_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

// scroll to top button label
function online_newspaper_customizer_stt_button() {
    $stt_label = ONP\online_newspaper_get_customizer_option( 'stt_label' );
    $stt_icon_picker = [ 'type'  => 'icon', 'value' => 'fa-solid fa-angle-up' ];
    $label_html = '<span class="icon-text">' .esc_html( $stt_label ). '</span>';
    $icon_html = '<span class="icon-holder"><i class="' .esc_attr( $stt_icon_picker['value'] ). '"></i></span>';
    if( $stt_icon_picker['value'] == 'fas fa-ban' || $stt_icon_picker['type'] == 'none' ) return( $label_html );
    return( ( $stt_label ) ? $label_html . $icon_html : $icon_html );
}

// newsletter button label
function online_newspaper_customizer_newsletter_button_label() {
    $newsletter_icon_picker = [ 'type'  => 'none', 'value' => 'fa-solid fa-bell' ];
    $newsletter_label = ONP\online_newspaper_get_customizer_option( 'newsletter_label' );
    $header_newsletter_redirect_href_link = ONP\online_newspaper_get_customizer_option( 'header_newsletter_redirect_href_link' );
    ob_start();
    ?>
        <a href="<?php echo esc_url( $header_newsletter_redirect_href_link ); ?>" target="_blank" data-popup="redirect">
            <?php
                if( isset( $newsletter_icon_picker['value'] ) ) echo '<span class="title-icon"><i class="' .esc_attr( $newsletter_icon_picker['value'] ). '"></i></span>';
                if( $newsletter_label ) echo '<span class="title-text">' .esc_html( $newsletter_label ). '</span>';
            ?>
        </a>
    <?php
    $content = ob_get_clean();
    return $content;
}

// random news button label
function online_newspaper_customizer_random_news_button_label() {
    $random_news_label = ONP\online_newspaper_get_customizer_option( 'random_news_label' );
    $random_news_icon_picker = [ 'type'  => 'icon', 'value' => 'fas fa-random' ];
    ob_start();
    ?>
        <a href="<?php echo esc_url($button_url); ?>" target="_blank">
            <?php
                if( isset( $random_news_icon_picker['value'] ) ) echo '<span class="title-icon"><i class="' .esc_attr( $random_news_icon_picker['value'] ). '"></i></span>';
                if( $random_news_label ) echo '<span class="title-text">' .esc_html( $random_news_label ). '</span>';
            ?>
        </a>
    <?php
    $content = ob_get_clean();
    return $content;
}

// custom button selective refresh
function online_newspaper_custom_button_selective_refresh() {
    $custom_button_label = ONP\online_newspaper_get_customizer_option( 'custom_button_label' );
    $custom_button_icon_picker = [ 'type'  => 'icon', 'value' => 'fab fa-youtube' ];
    if( isset( $custom_button_icon_picker[ 'value' ] ) ) echo '<span class="icon"><i class="', esc_attr( $custom_button_icon_picker[ 'value' ] ), '"></i></span>';
    if( $custom_button_label ) echo '<span class="ticker_label_title_string">', esc_html( $custom_button_label ) ,'</span>';
}

// global button label
function online_newspaper_customizer_read_more_button() {
    $archive_content_reorder = json_decode( ONP\online_newspaper_get_customizer_option( 'archive_post_element_order' ), true );
    if( has_action( 'online_newspaper_section_block_view_all_hook' ) ) do_action( 'online_newspaper_section_block_view_all_hook', [ 'option' => $archive_content_reorder[ 'button' ] ] );
	return;
}

// date time selective refresh callback
function online_newspaper_date_time_selective_refresh() {
    $time_option = ONP\online_newspaper_get_customizer_option( 'time_option' );
    $date_option = ONP\online_newspaper_get_customizer_option( 'date_option' );
    ?>
        <span class="top-date-time-inner">
            <?php
                if( $time_option ) echo '<span class="time">', date( 'H:i:s A' ) ,'</span>';
                if( $date_option ) echo '<span class="date">', date_i18n( 'l, ' . get_option( 'date_format' ), current_time( 'timestamp' )) ,'</span>';
            ?>
        </span>
    <?php
}

// theme mode selective refresh callback
function online_newspaper_theme_mode_selective_refresh() {
    $light_mode_icon_args = ONP\online_newspaper_get_customizer_option( 'theme_mode_light_icon' );
    $dark_mode_icon_args = ONP\online_newspaper_get_customizer_option( 'theme_mode_dark_icon' );
    $light_mode_icon_class = ( array_key_exists( 'value', $light_mode_icon_args ) && is_array( $light_mode_icon_args ) ) ? $light_mode_icon_args['value'] : '';
    $dark_mode_icon_class = ( array_key_exists( 'value', $dark_mode_icon_args ) && is_array( $dark_mode_icon_args ) ) ? $dark_mode_icon_args['value'] : '';
    if( $light_mode_icon_class || $dark_mode_icon_class ) :
        ?>
            <span class="mode-toggle">
                <?php 
                    if( $light_mode_icon_class ) echo '<i class="', esc_attr( $light_mode_icon_args['value'] ), ' light"></i>';
                    if( $dark_mode_icon_class ) echo '<i class="', esc_attr( $dark_mode_icon_args['value'] ), ' dark"></i>';
                ?>
            </span>
        <?php
    endif;
}

// Footer builder site logo
function online_newspaper_footer_logo_selective_refresh() {
    $logo_from = ONP\online_newspaper_get_customizer_option( 'bottom_footer_header_or_custom' );
    $show_site_title = false;
    if( $logo_from == 'header' ) {
        $footer_logo = get_theme_mod( 'custom_logo' );
        if( ! $footer_logo ) $show_site_title = true;
    } else {
        $footer_logo = ONP\online_newspaper_get_customizer_option( 'bottom_footer_logo_option' );
    };

    if( $logo_from !== 'header' ) {
        if( wp_get_attachment_image( $footer_logo, 'full' ) ) echo '<a href="'. home_url() .'" class="footer-site-logo">'. wp_get_attachment_image( $footer_logo, 'full' ) .'</a>';
    } else {
        $site_title_tag_for_frontpage = ONP\online_newspaper_get_customizer_option( 'site_title_tag_for_frontpage' );
        $site_title_tag_for_innerpage = ONP\online_newspaper_get_customizer_option( 'site_title_tag_for_innerpage' );

        the_custom_logo();

        if ( is_front_page() && ! get_custom_logo() ) :
            echo '<'. esc_html( $site_title_tag_for_frontpage ) .' class="site-title"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ) .'</a></'. esc_html( $site_title_tag_for_frontpage ) .'>';
        else :
            echo '<'. esc_html( $site_title_tag_for_innerpage ) .' class="site-title"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ) .'</a></'. esc_html( $site_title_tag_for_innerpage ) .'>';
        endif;
    }
}