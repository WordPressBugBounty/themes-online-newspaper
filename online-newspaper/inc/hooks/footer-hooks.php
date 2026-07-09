<?php
/**
 * Footer hooks and functions
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
use OnlineNewspaper\CustomizerDefault as ONP;

if( ! function_exists( 'online_newspaper_footer_menu_html' ) ) :
    /**
     * MARK: Footer menu
     * 
     * @since 1.0.0
     */
    function online_newspaper_footer_menu_html() {
        $footer_menu_hover_effect = ONP\online_newspaper_get_customizer_option( 'footer_menu_hover_effect' );
        $menuClass = 'menu';
        $menuClass .= ' hover-effect--' . $footer_menu_hover_effect;
        wp_nav_menu([
            'theme_location'    =>  'menu-3',
            'menu_class'    =>  esc_attr( $menuClass ),
            'container' =>  'ul',
            'menu_id'   =>  'footer-menu',
        ]);
    }
    add_action( 'online_newspaper_footer_menu_hook', 'online_newspaper_footer_menu_html' );
endif;

if( ! function_exists( 'online_newspaper_footer_logo_html' ) ) :
    /**
     * MARK: Footer Logo
     * 
     * @since 1.0.0
     */
    function online_newspaper_footer_logo_html() {
        $logo_from = ONP\online_newspaper_get_customizer_option( 'bottom_footer_header_or_custom' );
        $show_site_title = false;
        if( $logo_from == 'header' ) {
            $footer_logo = get_theme_mod( 'custom_logo' );
            if( ! $footer_logo ) $show_site_title = true;
        } else {
            $footer_logo = ONP\online_newspaper_get_customizer_option( 'bottom_footer_logo_option' );
        };
        ?>
            <div class="footer-logo">
                <?php
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
                ?>
            </div>
        <?php
    }
    add_action( 'online_newspaper_footer_logo_hook', 'online_newspaper_footer_logo_html' );
endif;

if( ! function_exists( 'online_newspaper_footer_social_html' ) ) :
   /**
    * MARK: Social Icons
    * 
    * @since 1.0.0
    */
    function online_newspaper_footer_social_html() {
        ?>
            <div class="social-icons-wrap footer">
                <?php online_newspaper_customizer_social_icons( 'footer' ); ?>
            </div>
        <?php
    }
    add_action( 'online_newspaper_footer_social_hook', 'online_newspaper_footer_social_html' );
endif;

if( ! function_exists( 'online_newspaper_copyright_html' ) ) :
   /**
    * MARK: Copyright
    * 
    * @since 1.0.0
    */
    function online_newspaper_copyright_html() {
      $bottom_footer_site_info = ONP\online_newspaper_get_customizer_option( 'bottom_footer_site_info' );
      if( ! $bottom_footer_site_info ) return;
     ?>
        <div class="site-info">
            <?php echo wp_kses_post( str_replace( '%year%', date('Y'), $bottom_footer_site_info ) ); ?>
        </div>
     <?php
    }
    add_action( 'online_newspaper_copyright_hook', 'online_newspaper_copyright_html' );
endif;

if( ! function_exists( 'online_newspaper_scroll_to_top_html' ) ) :
    /**
     * MARK: Scroll to top
     *
     * @since 1.0.0
     */
    function online_newspaper_scroll_to_top_html() {
        if( ! ONP\online_newspaper_get_customizer_option('stt_responsive_option') ) return;
        $stt_label = ONP\online_newspaper_get_customizer_option( 'stt_label' );
        $stt_icon_picker = [ 'type'  => 'icon', 'value' => 'fa-solid fa-angle-up' ];
        $icon = ( $stt_icon_picker['type'] == 'icon' && ! empty( $stt_icon_picker['value'] ) ) ? $stt_icon_picker['value'] : 'fas fa-ban';
        $icon_text = isset( $stt_label ) ? $stt_label : '';
    ?>
        <div id="online-newspaper-scroll-to-top" class="fixed align--right">
            <?php 
                if( $icon_text ) echo '<span class="icon-text">', esc_html( $icon_text ), '</span>';
                if( $icon != 'fas fa-ban' ) echo '<span class="icon-holder"><i class="', esc_attr( $icon ), '"></i></span>';
            ?>
        </div><!-- #online-newspaper-scroll-to-top -->
    <?php
    }
    add_action( 'online_newspaper_scroll_to_top_hook', 'online_newspaper_scroll_to_top_html' );
 endif;