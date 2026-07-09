<?php
/**
 * Includes the helper functions and hooks the theme. 
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
 use OnlineNewspaper\CustomizerDefault as ONP;

if( !function_exists( 'online_newspaper_advertisement_block_html' ) ) :
    /**
     * Calls advertisement block
     * 
     * @since 1.0.0
     */
    function online_newspaper_advertisement_block_html($options,$echo) {
        $media = ( is_object( $options[ 'media' ] ) || is_array( $options[ 'media' ] ) ) ? $options[ 'media' ] :json_decode( $options[ 'media' ] );
        if( ! isset( $media[ 'media_id' ] ) ) return;
        ?>
        <div <?php if( isset( $options[ 'blockId' ] ) && !empty($options[ 'blockId' ]) ) echo 'id="' .esc_attr( $options[ 'blockId' ] ). '"'; ?> class="online-newspaper-advertisement-block is-large">
        <?php
            if( $echo ) {
                if( isset( $options[ 'title' ] ) && $options[ 'title' ] ) echo '<h2 class="online-newspaper-block-title">' .esc_html( $options[ 'title' ] ). '</h2>';
                if( $media[ 'media_id' ] != 0 ) {
                ?>
                    <figure class="inner-ad-block">
                        <a href="<?php echo esc_url( $options[ 'url' ] ); ?>" target="<?php echo esc_attr( $options[ 'targetAttr' ] ); ?>" rel="<?php echo esc_attr( $options[ 'relAttr' ] ); ?>" title="<?php echo esc_attr( get_the_title( $media[ 'media_id' ] ) ); ?>">
                            <?php echo wp_kses_post( wp_get_attachment_image( $media[ 'media_id' ], 'large', false, [ 'alt' => esc_attr( get_the_title( $media[ 'media_id' ] ) ), 'loading' => 'lazy' ] ) ); ?>
                        </a>
                    </figure>
                <?php
                }
            }
        ?>
        </div>
    <?php
    }
 endif;

 if( !function_exists( 'online_newspaper_shortcode_block_html' ) ) :
    /**
     * Calls shortcode block
     * 
     * @since 1.0.0
     */
    function online_newspaper_shortcode_block_html( $options, $echo ) {
        $shortcode = $options[ 'shortcode' ];
        if( ! $shortcode ) return;
        ?>
        <div <?php if( isset( $options[ 'blockId' ] ) && !empty($options[ 'blockId' ]) ) echo 'id="' .esc_attr( $options[ 'blockId' ] ). '"'; ?> class="online-newspaper-shortcode-block is-large">
            <?php
                if( $echo ) {
                    echo do_shortcode( $shortcode );
                }
            ?>
        </div>
        <?php
    }
 endif;

require get_template_directory() . '/inc/hooks/inner-hooks.php'; // inner hooks.
require get_template_directory() . '/inc/hooks/frontpage-sections-hooks.php'; // frontpage sections hooks.
require get_template_directory() . '/inc/hooks/frontpage-sections-hooks.php'; // frontpage sections hooks.

if ( ! function_exists( 'online_newspaper_breadcrumb_trail' ) ) :
    /**
     * Theme default breadcrumb function.
     *
     * @since 1.0.0
     */
    function online_newspaper_breadcrumb_trail() {
        if ( ! function_exists( 'breadcrumb_trail' ) ) {
            // load class file
            require_once get_template_directory() . '/inc/breadcrumb-trail/breadcrumb-trail.php';
        }

        // arguments variable
        $breadcrumb_args = array(
            'container' => 'div',
            'show_browse' => false,
        );
        breadcrumb_trail( $breadcrumb_args );
    }
    add_action( 'online_newspaper_breadcrumb_trail_hook', 'online_newspaper_breadcrumb_trail' );
endif;

if( ! function_exists( 'online_newspaper_breadcrumb_html' ) ) :
    /**
     * Theme breadcrumb
     *
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_breadcrumb_html() {
        $site_breadcrumb_option = ONP\online_newspaper_get_customizer_option( 'site_breadcrumb_option' );
        if ( ! $site_breadcrumb_option ) return;
        if ( is_front_page() || is_home() ) return;
        $site_breadcrumb_type = ONP\online_newspaper_get_customizer_option( 'site_breadcrumb_type' );
        ?>
            <div class="online-newspaper-breadcrumb-wrapper">
                <div class="online-newspaper-container">
                    <div class="row">
                        <div class="online-newspaper-breadcrumb-wrap online-newspaper-card">
                            <?php
                                switch( $site_breadcrumb_type ) {
                                    case 'yoast': if( online_newspaper_compare_wand([online_newspaper_function_exists( 'yoast_breadcrumb' )] ) ) yoast_breadcrumb();
                                            break;
                                    case 'rankmath': if( online_newspaper_compare_wand([online_newspaper_function_exists( 'rank_math_the_breadcrumbs' )] ) ) rank_math_the_breadcrumbs();
                                            break;
                                    case 'bcn': if( online_newspaper_compare_wand([online_newspaper_function_exists( 'bcn_display' )] ) ) bcn_display();
                                            break;
                                    default: do_action( 'online_newspaper_breadcrumb_trail_hook' );
                                            break;
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
endif;

if( ! function_exists( 'online_newspaper_category_archive_featured_posts_html' ) ) :
    /**
     * Html for category archive page featured post
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_category_archive_featured_posts_html() {
        if( ! is_category() ) return;
        $sticky_posts  =  get_option( 'sticky_posts' );
        if( ! $sticky_posts ) return;
        $current_object = get_queried_object();
        $current_object_id = $current_object->term_id;
        foreach( $sticky_posts as $sticky_post_id ) :
            $cat_ids =  wp_get_post_categories( $sticky_post_id, array( 'fields' => 'ids' ) );
            if( in_array( $current_object_id, $cat_ids ) ) {
                $post_to_get = $sticky_post_id;
                break;
            }
        endforeach;
        if( ! isset($post_to_get) ) return;
        ?>
            <div class="online-newspaper-featured-posts-wrapper">
                <div class="online-newspaper-container">
                    <div class="row">
                        <article class="featured-post is-sticky" data-id="<?php echo esc_attr( $post_to_get ); ?>">
                            <figure class="post-thumb-wrap">
                                <a href="<?php the_permalink($post_to_get); ?>" title="<?php the_title_attribute(array('post'  => $post_to_get)); ?>">
                                    <?php if( has_post_thumbnail($post_to_get) ) {
                                            echo get_the_post_thumbnail($post_to_get, 'full', array(
                                                'title' => the_title_attribute(array(
                                                    'post'  => $post_to_get,
                                                    'echo'  => false
                                                ))
                                            ));
                                        }
                                    ?>
                                </a>
                                
                            </figure>
                            <div class="post-element">
                                <?php online_newspaper_get_post_categories( $post_to_get, 2 ); ?>
                                <h2 class="post-title"><a href="<?php the_permalink($post_to_get); ?>" title="<?php the_title_attribute(array('post'  => $post_to_get)); ?>"><?php echo wp_kses_post( get_the_title($post_to_get) ); ?></a></h2>
                                <div class="post-meta">
                                    <?php
                                        online_newspaper_posted_by($post_to_get);
                                        online_newspaper_posted_on($post_to_get);
                                    ?>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        <?php
    }
    add_action( 'online_newspaper_before_main_content', 'online_newspaper_category_archive_featured_posts_html', 20 );
endif;

if( ! function_exists( 'online_newspaper_category_archive_author_html' ) ) :
    /**
     * Html for category archive page featured post
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_category_archive_author_html() {
        if( ! is_author() ) return;
        $author_id =  get_query_var( 'author' );
        $archive_width_layout = ONP\online_newspaper_get_customizer_option( 'archive_width_layout' );
        $classes = 'author-info-wrap width-' . $archive_width_layout;
        ?>
        <div class="<?php echo esc_attr( $classes ); ?>">
          <div class="online-newspaper-container online-newspaper-author-section">
            <div class="row">
            <?php echo wp_kses_post( get_avatar($author_id, 125) ); ?>
            <div class="author-content">
                <h2 class="author-name"><?php echo esc_html( get_the_author_meta( 'display_name', $author_id ) ); ?></h2>
                <p class="author-desc"><?php echo wp_kses_post( get_the_author_meta('description', $author_id) ); ?></p>
                <div class="author-social-networks">
                    <?php
                        $facebook_url = ( get_the_author_meta( 'facebook_url', $author_id ) ) ? esc_url( get_the_author_meta( 'facebook_url', $author_id ) ) : '';
                        $twitter_url = ( get_the_author_meta( 'twitter_url', $author_id ) ) ? esc_url( get_the_author_meta( 'twitter_url', $author_id ) ) : '';
                        $linkedin_url = ( get_the_author_meta( 'linkedin_url', $author_id ) ) ? esc_url( get_the_author_meta( 'linkedin_url', $author_id ) ) : '';
                        $instagram_url = ( get_the_author_meta( 'instagram_url', $author_id ) ) ? esc_url( get_the_author_meta( 'instagram_url', $author_id ) ) : '';
                        if( $facebook_url ) echo '<a class="social-item" href="' .esc_url($facebook_url). '" target="_blank"><i class="fab fa-facebook-f"></i></a>';
                        if( $twitter_url ) echo '<a class="social-item" href="' .esc_url($twitter_url). '" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>';
                        if( $linkedin_url ) echo '<a class="social-item" href="' .esc_url($linkedin_url). '" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
                        if( $instagram_url ) echo '<a class="social-item" href="' .esc_url($instagram_url). '" target="_blank"><i class="fab fa-instagram"></i></a>';
                    ?>
                </div>
            </div>
            </div>
          </div>
        </div>
        <?php
    }
    add_action( 'online_newspaper_before_main_content', 'online_newspaper_category_archive_author_html', 20 );
endif;

if( ! function_exists( 'online_newspaper_button_html' ) ) :
    /**
     * View all html
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_button_html( $args ) {
        if( ! isset( $args[ 'option' ] ) && isset( $args[ 'buttonOption' ] ) && ! $args[ 'buttonOption' ] ) return;
        $global_button_label = ONP\online_newspaper_get_customizer_option( 'global_button_label' );
        $global_button_icon_picker = [ 'type'  => 'icon', 'value' => 'fas fa-angle-right' ];
        $global_button_icon_context = 'after';
        $is_after = ( $global_button_icon_context === 'after' );
        
        $classes = isset( $args['classes'] ) ? 'online-newspaper-button post-link-button' . ' ' .$args['classes'] : 'post-button online-newspaper-button';
        $classes .= ' ' . $global_button_icon_context;
        if( isset( $args[ 'option' ] ) && ! $args['option'] ) $classes .= ' button-off';
        $link = isset( $args['link'] ) ? $args['link'] : get_the_permalink();
        $text = isset( $args['text'] ) ? $args['text'] : apply_filters( 'online_newspaper_global_button_label_filter', $global_button_label );
        $icon = isset( $args['icon'] ) ? $args['icon'] : ( $global_button_icon_picker['type'] !== 'none' ? $global_button_icon_picker['value']: '' );
        $text_html = sprintf( '<span class="button-text">%1$s</span>', esc_html( $text ) );
        $icon_html = ( $icon != '' ) ? sprintf( '<span class="button-icon"><i class="%1$s"></i></span>', esc_attr( $icon ) ) : '';
        echo apply_filters( 'online_newspaper_button_html', sprintf( '<a class="%1$s" href="%2$s">%3$s%4$s</a>', esc_attr( $classes ), esc_url( $link ), wp_kses_post( $is_after ? $text_html : $icon_html ), wp_kses_post( $is_after ? $icon_html : $text_html ) ) );
    }
    add_action( 'online_newspaper_section_block_view_all_hook', 'online_newspaper_button_html', 10, 1 );
endif;

if( ! function_exists( 'online_newspaper_archive_excerpt_length' ) ) :
    /**
     * Custom excerpt length
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_archive_excerpt_length( $length ) {
        return absint( 20 );
    }
endif;

if( ! function_exists( 'online_newspaper_archive_excerpt_more_string' ) ) :
    /**
     * Excerpt more string filter
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_archive_excerpt_more_string( $more ) {
        return '...';
    }
    add_filter('excerpt_more', 'online_newspaper_archive_excerpt_more_string');
endif;

if( ! function_exists( 'online_newspaper_pagination_fnc' ) ) :
    /**
     * Renders pagination html
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_pagination_fnc() {
        if( is_null( paginate_links() ) ) {
            return;
        }
        $pagination_type = ONP\online_newspaper_get_customizer_option( 'archive_pagination_type' );
        switch( $pagination_type ) {
            case 'number' : echo '<div class="pagination">' .wp_kses_post( paginate_links( array( 'prev_text' => '<i class="fas fa-chevron-left"></i>', 'next_text' => '<i class="fas fa-chevron-right"></i>', 'type' => 'list' ) ) ). '</div>';
                    break;
            default : echo '<div class="pagination">' .wp_kses_post( get_the_posts_navigation() ). '</div>';
                    break;
        }
    }
    add_action( 'online_newspaper_pagination_link_hook', 'online_newspaper_pagination_fnc' );
 endif;

 if( ! function_exists( 'online_newspaper_get_background_and_cursor_animation' ) ) :
    /**
     * Renders html for cursor and background animation
     * 
     * @since 1.0.0
     */
    function online_newspaper_get_background_and_cursor_animation() {
        $site_background_animation = ONP\online_newspaper_get_customizer_option( 'site_background_animation' );
        if( $site_background_animation !== 'none' ) online_newspaper_shooting_star_animation_html();
        $cursor_animation = ONP\online_newspaper_get_customizer_option( 'cursor_animation' );
        $cursorclass = 'online-newspaper-cursor';
        if( $cursor_animation != 'none' ) $cursorclass .= ' type--' . $cursor_animation;
        if( in_array( $cursor_animation, [ 'one', 'two' ] ) ) echo '<div class="'. esc_attr( $cursorclass ) .'"></div>';
    }
    add_action( 'online_newspaper_after_footer_hook', 'online_newspaper_get_background_and_cursor_animation', 30 );
 endif;

 if( ! function_exists( 'online_newspaper_shooting_star_animation_html' ) ) :
    /**
     * Background animation one
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_shooting_star_animation_html() {
        $elementClass = 'online-newspaper-background-animation';
        ?>
            <div class="<?php echo esc_attr( $elementClass ); ?>">
                <?php
                    for( $i = 0; $i < 13; $i++ ) :
                        echo '<span class="item"></span>';
                    endfor;
                ?>
            </div>
        <?php
    }
endif;

if( ! function_exists( 'online_newspaper_loader_html' ) ) :
	/**
     * Preloader html
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
	function online_newspaper_loader_html() {
        if( ! ONP\online_newspaper_get_customizer_option( 'preloader_option' ) ) return;
	?>
		<div class="online_newspaper_loading_box">
			<div class="box">
				<div class="loader-item loader-<?php echo esc_attr( ONP\online_newspaper_get_customizer_option( 'preloader_type' ) ); ?>"></div>
			</div>
		</div>
	<?php
	}
    add_action( 'online_newspaper_page_prepend_hook', 'online_newspaper_loader_html', 1 );
endif;

 if( ! function_exists( 'online_newspaper_custom_header_html' ) ) :
    /**
     * Site custom header html
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_custom_header_html() {
        /**
         * Get custom header markup
         * 
         * @since 1.0.0 
         */
        the_custom_header_markup();
    }
    add_action( 'online_newspaper_page_prepend_hook', 'online_newspaper_custom_header_html', 20 );
 endif;

  if( ! function_exists( 'online_newspaper_progress_bar' ) ) :
    /**
     * Display a progress bar
     * 
     * @since 1.0.0
     */
    function online_newspaper_progress_bar() {
        if( is_single() || is_page() || is_archive() || is_search() ) :
            echo '<div class="single-progress"></div>';
        endif;
    }
    add_action( 'online_newspaper_page_prepend_hook', 'online_newspaper_progress_bar', 30 );
endif;


 if( ! function_exists( 'online_newspaper_single_layout_part' ) ) :
    /**
     * Renders part of single layout including meta, title, thumb and category
     * 
     * @since 1.0.0
     */
    function online_newspaper_single_layout_part() {
        if( ! is_single() ) return;
        $single_layout = ONP\online_newspaper_get_customizer_option( 'single_layout' );
        $single_layout_meta = ( metadata_exists( 'post', get_the_ID(), 'single_layout' ) ) ? get_post_meta( get_the_ID(), 'single_layout', true ) : 'customizer-layout';
        $is_customizer_layout = ( $single_layout_meta === 'customizer-layout' );
        $single_layout = $is_customizer_layout ? $single_layout : $single_layout_meta;
        $elementClass = 'entry-header';
        $author_id = get_the_author_meta( 'ID' );
        if( in_array( $single_layout, [ 'two', 'four'] ) ) :
            $elementClass .= ' row';
            $author_id = get_post_field( 'post_author', get_the_ID() );
        endif;
        
        $single_post_meta_order = json_decode( ONP\online_newspaper_get_customizer_option( 'single_post_meta_order' ), true );
        $single_post_image_caption = ONP\online_newspaper_get_customizer_option( 'single_post_image_caption' );
        $single_post_show_original_image_option = ONP\online_newspaper_get_customizer_option( 'single_post_show_original_image_option' );
        ?>
            <header class="<?php echo esc_attr( $elementClass ); ?>">
                <?php if( ! in_array( $single_layout, [ 'five' ] ) ) online_newspaper_post_thumbnail( $single_post_show_original_image_option, $single_post_image_caption ); ?>
                <div class="elements-wrapper">
                    <?php
                        online_newspaper_get_post_categories( get_the_ID(), 2 );
                        the_title( '<h1 class="entry-title"' .online_newspaper_schema_article_name_attributes(). '>', '</h1>' );
                        if ( 'post' === get_post_type() ) :
                            ?>
                                <div class="entry-meta">
                                    <?php
                                        foreach( $single_post_meta_order as $element => $meta_order ) :
                                            if( $meta_order ) {
                                                switch( $element ) {
                                                    case 'author': online_newspaper_posted_by( get_the_ID() );
                                                                break;
                                                    case 'date': online_newspaper_posted_on();
                                                                break;
                                                    case 'comments': online_newspaper_comments_number();
                                                                break;
                                                    case 'read-time': $website_read_time_before_icon = [ 'type'  => 'icon', 'value' => 'fas fa-clock' ];
                                                                        if( $website_read_time_before_icon['type'] == 'none' ) {
                                                                            echo '<span class="read-time">' .online_newspaper_post_read_time( get_the_content() ). ' ' .esc_html__( 'mins', 'online-newspaper' ). '</span>';
                                                                        } else {
                                                                            echo '<span class="read-time ' .esc_attr( $website_read_time_before_icon['value'] ). '">' .online_newspaper_post_read_time( get_the_content() ). ' ' .esc_html__( 'mins', 'online-newspaper' ). '</span>';
                                                                        }
                                                                break;
                                                    default: '';
                                                }
                                            }
                                        endforeach;
                                    ?>
                                </div><!-- .entry-meta -->
                            <?php 
                        endif;
                    ?>
                </div>
            </header><!-- .entry-header -->
        <?php
    }
 endif;

 if( ! function_exists( 'online_newspaper_convert_number_to_numeric_string' )) :
    /**
     * Function to convert int parameter to numeric string
     * 
     * @return string
     */
    function online_newspaper_convert_number_to_numeric_string( $int ) {
        switch( $int ){
            case 2:
                return "two";
                break;
            case 3:
                return "three";
                break;
            case 4:
                return "four";
                break;
            case 5:
                return "five";
                break;
            case 6:
                return "six";
                break;
            case 7:
                return "seven";
                break;
            case 8:
                return "eight";
                break;
            case 9:
                return "nine";
                break;
            case 10:
                return "ten";
                break;
            default:
                return "one";
        }
    }
 endif;

 if( ! function_exists( 'online_newspaper_get_icon_control_html' ) ) :
    /**
     * Generates output for icon control
     * 
     * @since 1.0.0
     */
    function online_newspaper_get_icon_control_html( $archive_date_icon ) {
        if( $archive_date_icon['type'] == 'none' ) return;
        switch( $archive_date_icon['type'] ) {
            case 'svg' : $output = '<img src="' .esc_url( wp_get_attachment_url( $archive_date_icon['value'] ) ). '"/>';
                    break;
            default: $output = '<i class="' .esc_attr( $archive_date_icon['value'] ). '"></i>';
        }
        return $output;
    }
endif;