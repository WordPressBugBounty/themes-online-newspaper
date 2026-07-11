<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Online Newspaper
 */
use OnlineNewspaper\CustomizerDefault as ONP;
use OnlineNewspaper\Cache_Manager as Cache_Manager;
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function online_newspaper_body_classes( $classes ) {
	global $post;

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$classes[] = 'online-newspaper-variables';
	$classes[] = esc_attr( 'online-newspaper-title-' . ONP\online_newspaper_get_customizer_option( 'post_title_hover_effects'  ) ); // post title hover effects
	$classes[] = esc_attr( 'online-newspaper-image-hover--effect-' . ONP\online_newspaper_get_customizer_option( 'site_image_hover_effects' ) ); // site image hover effects
	$classes[] = esc_attr( 'site-' . ONP\online_newspaper_get_customizer_option( 'website_layout' ) ); // site layout
	$classes[] = 'online-newspaper-light-mode';
	$classes[] = 'block-title--layout-eight';
	$classes[] = ' is-desktop';

	if( \Online_Newspaper_Builder\Builder_Base::widget_exists( 'header_builder', 'search' ) ) :
		$classes[] = esc_attr( 'search-popup--three' );
	endif;

	if( \Online_Newspaper_Builder\Builder_Base::widget_exists( 'header_builder', 'off-canvas' ) ) :
		$off_canvas_position = ONP\online_newspaper_get_customizer_option('off_canvas_position');
		$classes[] = esc_attr( 'off-canvas-sidebar-appear--' . $off_canvas_position );
	endif;
	
	// page layout
	if( is_page() || is_404() || is_search() ) :
		if( is_front_page() ) {
			$frontpage_sidebar_layout = ONP\online_newspaper_get_customizer_option( 'frontpage_sidebar_layout' );
			$frontpage_sidebar_sticky_option = ONP\online_newspaper_get_customizer_option( 'frontpage_sidebar_sticky_option' );
			if( $frontpage_sidebar_sticky_option ) $classes[] = esc_attr( 'sidebar-sticky' );
			$classes[] = esc_attr( $frontpage_sidebar_layout );
		} else {
			if( is_page() ) {
				// default value set for post sidebar layout.
				if( !metadata_exists( 'post', $post->ID, 'post_sidebar_layout' ) ) {
					// add post sidebar layout value "custmomizer-setting".
					update_post_meta( $post->ID, 'post_sidebar_layout', 'customizer-setting' );
				}
				$post_sidebar_layout = get_post_meta( $post->ID, 'post_sidebar_layout', true );
				$post_sidebar_layout = ( $post_sidebar_layout ) ? $post_sidebar_layout : 'customizer-setting';
				if( $post_sidebar_layout == 'customizer-setting' ){
					$page_sidebar_layout = ONP\online_newspaper_get_customizer_option( 'page_sidebar_layout' );
				} else {
					$page_sidebar_layout = $post_sidebar_layout;
				}
			} else {
				$page_sidebar_layout = ONP\online_newspaper_get_customizer_option( 'page_sidebar_layout' );
			}
			if( ! is_search() ) $classes[] = esc_attr( $page_sidebar_layout );
			$card = ONP\online_newspaper_get_customizer_option( 'page_card_enable' );
			$classes[] = 'card--' . ( $card ? 'on' : 'off' );
			$page_sidebar_sticky_option = ONP\online_newspaper_get_customizer_option( 'page_sidebar_sticky_option' );
			if( $page_sidebar_sticky_option ) $classes[] = esc_attr( 'sidebar-sticky' );
		}
	endif;

	// single post layout
	if( is_single() ) :
		// default value set for post sidebar layout.
		if( !metadata_exists( 'post', $post->ID, 'post_sidebar_layout' ) ) {
			// add post sidebar layout value "custmomizer-setting".
			update_post_meta( $post->ID, 'post_sidebar_layout', 'customizer-setting' );
		}
		$post_sidebar_layout = get_post_meta( $post->ID, 'post_sidebar_layout', true );
		$post_sidebar_layout = ( $post_sidebar_layout ) ? $post_sidebar_layout : 'customizer-setting';
		if( $post_sidebar_layout == 'customizer-setting' ){
			$single_sidebar_layout = ONP\online_newspaper_get_customizer_option( 'single_sidebar_layout' );
		} else {
			$single_sidebar_layout = $post_sidebar_layout;
		}
		$single_sidebar_sticky_option = ONP\online_newspaper_get_customizer_option( 'single_sidebar_sticky_option' );
		if( $single_sidebar_sticky_option ) $classes[] = esc_attr( 'sidebar-sticky' );
		$single_layout = ONP\online_newspaper_get_customizer_option( 'single_layout' ); 
		$single_layout_meta = ( metadata_exists( 'post', get_the_ID(), 'single_layout' ) ) ? get_post_meta( get_the_ID(), 'single_layout', true ) : 'customizer-layout';
		$is_customizer_layout = ( $single_layout_meta === 'customizer-layout' );
		$classes[] = esc_attr( 'single-layout--' . ( $is_customizer_layout ? $single_layout : $single_layout_meta ) );
		$classes[] = esc_attr( $single_sidebar_layout );
		$card = ONP\online_newspaper_get_customizer_option( 'single_post_card_enable' );
		$classes[] = 'card--' . ( $card ? 'on' : 'off' );
	endif;

	// archive layout
	if( is_archive() || is_home() || is_search() ) :
		$archive_sidebar_layout = ONP\online_newspaper_get_customizer_option( 'archive_sidebar_layout' );
		$archive_page_layout = ONP\online_newspaper_get_customizer_option( 'archive_page_layout' );
		$archive_layout_meta = online_newspaper_get_archive_layout_meta();
		$archive_sidebar_meta = online_newspaper_get_archive_sidebar_meta();
		$is_customizer_layout = ( $archive_layout_meta == 'customizer-layout' );
		$is_customizer_settings = ( $archive_sidebar_meta == 'customizer-setting' );
		$archive_sidebar_sticky_option = ONP\online_newspaper_get_customizer_option( 'archive_sidebar_sticky_option' );
		if( $archive_sidebar_sticky_option ) $classes[] = esc_attr( 'sidebar-sticky' );
		$classes[] = esc_attr( 'post-layout--'. ( $is_customizer_layout ? $archive_page_layout : $archive_layout_meta ) );
		$classes[] = esc_attr( $is_customizer_settings ? $archive_sidebar_layout : $archive_sidebar_meta );
	endif;

	$site_background_animation = ONP\online_newspaper_get_customizer_option( 'site_background_animation' );
	$classes[] = 'background-animation--' . $site_background_animation;

	$website_content_layout = ONP\online_newspaper_get_customizer_option( 'website_content_layout' );
    $classes[] = 'global-content-layout--' . $website_content_layout;

	$ticker_news_frontpage = ONP\online_newspaper_get_customizer_option( 'ticker_news_frontpage' );
    if( $ticker_news_frontpage ) $classes[] = 'ticker-news-frontpage';

	return $classes;
}
add_filter( 'body_class', 'online_newspaper_body_classes' );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function online_newspaper_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'online_newspaper_pingback_header' );

//define constant
define( 'ONLINE_NEWSPAPER_INCLUDES_PATH', get_template_directory() . '/inc/' );

/**
 * Enqueue theme scripts and styles.
 */
function online_newspaper_scripts() {
	global $wp_query;
	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
	$preloader_option = ONP\online_newspaper_get_customizer_option('preloader_option');
	$header_ticker_news_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'header_builder', 'ticker-news' );
	$hr_ticker_news_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'ticker-news' );
	$homepage_content_order = json_decode( ONP\online_newspaper_get_customizer_option( 'homepage_content_order' ), true );
	$header_buiilder_header_sticky = ONP\online_newspaper_get_customizer_option( 'header_buiilder_header_sticky' );
	$web_stories_option = $homepage_content_order[ 'web_stories_section' ];
	$enqueue_scripts_args = [ 'strategy' => 'defer', 'in_footer' => true ];
	$css_dependency = [];
	$js_dependency = [ 'jquery' ];
	$theme_js_dependency = is_search() ? [ 'jquery', 'jquery-ui-datepicker' ] : $js_dependency;
	$template_directory_uri = get_template_directory_uri();
	wp_enqueue_style( 'fontawesome', $template_directory_uri . '/assets/lib/fontawesome/css/all.min.css', $css_dependency, '6.5.1', 'print' );
	wp_enqueue_style( 'slick', $template_directory_uri . '/assets/lib/slick/slick.css', $css_dependency, '1.8.1', 'print' );
	wp_enqueue_style( 'magnific-popup', $template_directory_uri . '/assets/lib/magnific-popup/magnific-popup.css', $css_dependency, '1.1.0', 'print' );
	wp_enqueue_style( 'online-newspaper-typo-fonts', wptt_get_webfont_url( online_newspaper_typo_fonts_url() ), $css_dependency, null, 'print' );
	// enqueue inline style
	wp_enqueue_style( 'online-newspaper-style', get_stylesheet_uri(), $css_dependency, ONLINE_NEWSPAPER_VERSION );
	wp_add_inline_style( 'online-newspaper-style', Cache_Manager::get_dynamic_css() );
	wp_enqueue_style( 'online-newspaper-main-style', $template_directory_uri.'/assets/css/main.css', $css_dependency, ONLINE_NEWSPAPER_VERSION );
	wp_enqueue_style( 'online-newspaper-builder-style', $template_directory_uri.'/assets/css/builder.css', $css_dependency, ONLINE_NEWSPAPER_VERSION );
	// additional css
	wp_enqueue_style( 'online-newspaper-main-style-additional', $template_directory_uri.'/assets/css/add.css', $css_dependency, ONLINE_NEWSPAPER_VERSION, 'print' );
	if( $preloader_option ) wp_enqueue_style( 'online-newspaper-loader-style', $template_directory_uri.'/assets/css/loader.css', $css_dependency, ONLINE_NEWSPAPER_VERSION );
	wp_enqueue_style( 'online-newspaper-responsive-style', $template_directory_uri.'/assets/css/responsive.css', $css_dependency, ONLINE_NEWSPAPER_VERSION, 'print' );
	wp_enqueue_style( 'jquery-ui', get_template_directory_uri() .'/assets/lib/jquery-ui/jquery-ui.min.css', $css_dependency, ONLINE_NEWSPAPER_VERSION, 'print' );
	wp_style_add_data( 'online-newspaper-style', 'rtl', 'replace' );

	wp_enqueue_script( 'slick', $template_directory_uri . '/assets/lib/slick/slick.min.js', $js_dependency, '1.8.1', $enqueue_scripts_args );
	wp_enqueue_script( 'magnific-popup', $template_directory_uri . '/assets/lib/magnific-popup/magnific-popup.min.js', $js_dependency, '1.1.0', $enqueue_scripts_args );
	if( $header_ticker_news_option || $hr_ticker_news_option ) wp_enqueue_script( 'js-marquee', $template_directory_uri . '/assets/lib/js-marquee/jquery.marquee.min.js', $js_dependency, '1.6.0', $enqueue_scripts_args );
	wp_enqueue_script( 'js-cookie', $template_directory_uri . '/assets/lib/jquery-cookie/jquery-cookie.js', $js_dependency, '1.4.1', $enqueue_scripts_args );
	wp_enqueue_script( 'online-newspaper-navigation', $template_directory_uri . '/assets/js/navigation.js', array(), ONLINE_NEWSPAPER_VERSION, $enqueue_scripts_args );
	wp_enqueue_script( 'online-newspaper-ajax', $template_directory_uri . '/assets/js/ajax.js', $theme_js_dependency, time(), $enqueue_scripts_args );
	wp_enqueue_script( 'online-newspaper-theme', $template_directory_uri . '/assets/js/theme.js', $theme_js_dependency, ONLINE_NEWSPAPER_VERSION, $enqueue_scripts_args );
	
	$ajaxVar['_wpnonce'] = wp_create_nonce( 'online-newspaper-nonce' );
	$ajaxVar['ajaxUrl'] 	= esc_url(admin_url('admin-ajax.php'));
	$scriptVars['stt']	= ONP\online_newspaper_get_customizer_option('stt_responsive_option');
	$scriptVars['headerAdsBannerOption']	= ONP\online_newspaper_get_customizer_option( 'header_ads_banner_responsive_option' );
	$ajaxVar['ajaxPostsLoad'] = false;
	$scriptVars['is_customizer'] = is_customize_preview();
	$ajaxVar['isRtl'] = is_rtl();	
	$scriptVars['slickPrev'] = esc_attr__( 'Previous Slide', 'online-newspaper' );
	$scriptVars['slickNext'] = esc_attr__( 'Next Slide', 'online-newspaper' );
	$ajaxVar['slickPrev'] = esc_attr__( 'Previous Slide', 'online-newspaper' );
	$ajaxVar['slickNext'] = esc_attr__( 'Next Slide', 'online-newspaper' );
	if( $header_buiilder_header_sticky ) :
		$scriptVars[ 'headerSticky' ] = ONP\online_newspaper_get_customizer_option( 'header_buiilder_header_sticky' );
	endif;
	
	if( is_single() || is_page() || is_archive() || is_search() ) $scriptVars[ 'themeColor' ]	= ONP\online_newspaper_get_customizer_option( 'theme_color' );

	// localize scripts
	wp_localize_script( 'online-newspaper-theme', 'onlineNewspaperObject' , $scriptVars );
	wp_localize_script( 'online-newspaper-ajax', 'onlineNewspaperAjaxObject', $ajaxVar );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'online_newspaper_scripts' );

/**
 * Minify dynamic css
 * 
 * @since 1.0.0
 */
if( ! function_exists( 'online_newspaper_minifyCSS' ) ) :
	function online_newspaper_minifyCSS( $css ) {
		// Remove comments
		$css = preg_replace( '!/\*.*?\*/!s', '', $css );
		// Remove space after colons
		$css = preg_replace( '/\s*:\s*/', ':', $css );
		// Remove whitespace
		$css = preg_replace( '/\s+/', ' ', $css );
		// Remove space before/after brackets and semicolons
		$css = preg_replace( '/\s*{\s*/', '{', $css );
		$css = preg_replace( '/\s*}\s*/', '}', $css );
		$css = preg_replace( '/\s*;\s*/', ';', $css );
		// Remove final semicolon in a block
		$css = preg_replace( '/;}/', '}', $css );
		// Trim the final output
		return trim( $css );
	}
endif;

if( ! function_exists( 'online_newspaper_get_brand_name' ) ) :
	/**
	 * Return brand name from fontawesome icon class
	 * 
	 * @since 1.0.0
	 */
	function online_newspaper_get_brand_name( string $icon ): string {
		// remove prefix
		$name = str_replace( "fa-brands fa-", "", $icon );

		// replace dashes with spaces
		$name = str_replace( "-", " ", $name );

		// remove unwanted words
		$remove = [ "square", "circle", "alt", "official", "logo", "simple", "cc", 'f', 'ios', 'w', 'v', 's', 'stroke', 'p', 'pp', 'hat', 'alien', 'directional', 'symbol', 'framework', 'squadron', 'k', 'in', 'note', 'browser', 'fi', 'g', 'legacy', 'by', 'nc', 'nc-eu', 'nc-jp', 'nd', 'pd', 'pd-alt', 'sa', 'sampling', 'sampling-plus', 'share', 'zero', 'beyond', 'b', 'reverse' ];
		$name = preg_replace( '/\b(' . implode( '|', $remove ) . ')\b/i', '', $name );

		// clean up multiple spaces
		$name = trim( preg_replace( '/\s+/', ' ', $name ) );

		if( $name === 'x twitter' ) $name = 'x';

		// ucfirst every word
		return ucwords( $name );
	}
endif;

if( ! function_exists( 'online_newspaper_customizer_social_icons' ) ) :
	/**
	 * Function to get social icons from customizer
	 * 
	 * @since 1.0.0
	 * @package Online Newspaper
	 */
	function online_newspaper_customizer_social_icons( $type = '', $limit = '', $inherit = false, $args = [] ) {
        $placement = ( $type !== '' ) ? $type . '_' : '';
		$social_icons = ONP\online_newspaper_get_customizer_option( $placement . 'social_icons' );
		$decoded_social_icons = json_decode( $social_icons, true );
		$display_count = $display_label = false;
		$columns = 2;
        if( $type === 'footer' ) :
            $display_label = ONP\online_newspaper_get_customizer_option( 'footer_social_icons_display_label' );
			if( isset( $args[ 'display_label' ] ) ) $display_label = $args[ 'display_label' ];
        endif;

        $socialIconClasses[] = 'online-newspaper-social-icon';
        if( isset( $args[ 'columns' ] ) && is_int( $args[ 'columns' ] ) ) $socialIconClasses[] = 'column--' . online_newspaper_convert_number_to_numeric_string( $args[ 'columns' ] );
        if( isset( $args[ 'display_count' ] ) ) $display_count = $args[ 'display_count' ];
		if( $display_label ) $socialIconClasses[] = 'is-title';
		if( $inherit ) $socialIconClasses[] .= ' official-color--enabled';

        echo '<div class="', implode( ' ', $socialIconClasses ), '">';
			foreach( $decoded_social_icons as $index => $icon ) :
				if( $limit !== '' && $index >= $limit ) break;
				if( $icon[ 'item_option' ] === 'show' ) :
					$label = online_newspaper_get_brand_name( $icon[ 'icon_class' ] );
					$iconClass = 'social-icon ' . strtolower( $label );
					?>
						<a class="<?php echo esc_attr( $iconClass ); ?>" href="<?php echo esc_url( $icon[ 'icon_url' ] ); ?>" target="_blank" title="<?php echo esc_attr( $label ); ?>">
							<i class="<?php echo esc_attr( $icon[ 'icon_class' ] ); ?>"></i>
							<?php if( $display_label && $label ) echo '<span class="icon-label">', esc_html( $label ), '</span>'; ?>
							<?php if( $display_count ) echo '<span class="icon-count">', esc_html( $icon[ 'icon_count' ] ), '</span>'; ?>
						</a>
					<?php
				endif;
			endforeach;
		echo '</div>';
	}
endif;

if( ! function_exists( 'online_newspaper_get_date_filter_choices_array' ) ) :
	/**
	 * Return array of date filter choices.
	 * 
	 */
	function online_newspaper_get_date_filter_choices_array() {
		return apply_filters( 'online_newspaper_get_date_filter_choices_array_filter', [
			'all'	=> esc_html__('All', 'online-newspaper' ),
			'last-seven-days'	=> esc_html__('Last 7 days', 'online-newspaper' ),
			'today'	=> esc_html__('Today', 'online-newspaper' ),
			'this-week'	=> esc_html__('This Week', 'online-newspaper' ),
			'last-week'	=> esc_html__('Last Week', 'online-newspaper' ),
			'this-month'	=> esc_html__('This Month', 'online-newspaper' ),
			'last-month'	=> esc_html__('Last Month', 'online-newspaper' ),
			'this-year'	=> esc_html__('This Year', 'online-newspaper' )
		]);
	}
endif;

if( ! function_exists( 'online_newspaper_get_array_key_string_to_int' ) ) :
	/**
	 * Return array of int values.
	 * 
	 */
	function online_newspaper_get_array_key_string_to_int( $array ) {
		if( ! isset( $array ) || empty( $array ) ) return;
		$filtered_array = array_map( function($arr) {
			if( is_numeric( $arr ) ) return (int) $arr;
		}, $array);
		return apply_filters( 'online_newspaper_array_with_int_values', $filtered_array );
	}
endif;

/**
 * Return string with "implode" execution in param
 * 
 */
 function online_newspaper_get_categories_for_args($array) {
	if( ! $array ) return apply_filters( 'online_newspaper_categories_for_argument', '' );
	foreach( $array as $value ) {
		if( is_array( $value ) ) $string_array[] = $value['value'];
		if( is_object( $value ) ) $string_array[] = $value->value;
	}
	return apply_filters( 'online_newspaper_categories_for_argument', implode( ',', $string_array ) );
}

/**
 * Return array with execution in param
 * 
 */
function online_newspaper_get_post_id_for_args($array) {
	if( ! $array ) return apply_filters( 'online_newspaper_posts_slugs_for_argument', '' );
	foreach( $array as $value ) {
		if( is_array( $value ) ) $string_array[] = $value['value'];
		if( is_object( $value ) ) $string_array[] = $value->value;
	}
	return apply_filters( 'online_newspaper_posts_slugs_for_argument', $string_array );
}

if( !function_exists( 'online_newspaper_typo_fonts_url' ) ) :
	/**
	 * Filter and Enqueue typography fonts
	 * 
	 * @package Online Newspaper
	 * @since 1.0.0
	 */
	function online_newspaper_typo_fonts_url() {
		$filter = ONLINE_NEWSPAPER_PREFIX . 'typo_combine_filter';

		$typography_presets = ONP\online_newspaper_get_customizer_option( 'typography_presets' );
		if( array_key_exists( 'typographies', $typography_presets ) ) :
			$typographies = $typography_presets[ 'typographies' ]; 
			foreach( $typographies as $typography ) :
				$fonts[] = apply_filters( $filter, 'typography_presets', $typography );
			endforeach;
		endif;
		$fonts[] = apply_filters( $filter, 'site_title_typo' );
		$fonts[] = apply_filters( $filter, 'site_tagline_typo' );
		$fonts[] = apply_filters( $filter, 'date_time_typography' );
		$fonts[] = apply_filters( $filter, 'header_menu_typo' );
		$fonts[] = apply_filters( $filter, 'header_sub_menu_typo' );
		$fonts[] = apply_filters( $filter, 'global_button_typo' );
		$fonts[] = apply_filters( $filter, 'footer_title_typography' );
		$fonts[] = apply_filters( $filter, 'footer_text_typography' );
		$fonts[] = apply_filters( $filter, 'bottom_footer_text_typography' );
		$fonts[] = apply_filters( $filter, 'footer_menu_typography' );
		$fonts[] = apply_filters( $filter, 'global_category_typography' );
		$fonts[] = apply_filters( $filter, 'sticky_posts_label_typography' );
		$fonts[] = apply_filters( $filter, 'sticky_posts_title_typography' );
		$fonts[] = apply_filters( $filter, 'secondary_menu_typo' );
		$fonts[] = apply_filters( $filter, 'site_block_title_typo' );
		$fonts[] = apply_filters( $filter, 'site_post_title_typo' );
		$fonts[] = apply_filters( $filter, 'site_post_meta_typo' );
		$fonts[] = apply_filters( $filter, 'site_post_content_typo' );
		$fonts[] = apply_filters( $filter, 'custom_button_text_typo' );
		$fonts[] = apply_filters( $filter, 'single_post_title_typo' );
		$fonts[] = apply_filters( $filter, 'single_post_meta_typo' );
		$fonts[] = apply_filters( $filter, 'single_post_content_typo' );
		$fonts[] = apply_filters( $filter, 'web_stories_preview_count_typo' );
		$fonts[] = apply_filters( $filter, 'web_stories_preview_title_typo' );
		$fonts[] = apply_filters( $filter, 'web_stories_title_typo' );
		$fonts[] = apply_filters( $filter, 'default_typo_one' );
		$fonts[] = apply_filters( $filter, 'default_typo_two' );

		$get_filtered_fonts = apply_filters( 'online_newspaper_get_fonts_toparse', $fonts );
		$_new_fonts_array = [];
		foreach( $get_filtered_fonts as $fonts ) {
			if( ! isset( $_new_fonts_array[$fonts['font_family']] ) ) {
				$_new_fonts_array[$fonts['font_family']] = [
					$fonts['variant']	=> [$fonts['font_weight']]
				];
			} else {
				if( ! isset( $_new_fonts_array[$fonts['font_family']][$fonts['variant']] ) ) {
					$_new_fonts_array[$fonts['font_family']][$fonts['variant']] = [$fonts['font_weight']];
				} else {
					if( ! in_array( $fonts['font_weight'], $_new_fonts_array[$fonts['font_family']][$fonts['variant']] ) ) $_new_fonts_array[$fonts['font_family']][$fonts['variant']][] = $fonts['font_weight'];
				}
			}
		}
		$_new_fonts_string = '';
		$_new_fonts_strings = [];
		foreach( $_new_fonts_array as $_new_font_key => $_new_font_value ) {
			$prefix_weight = false;
			$normal_weight = false;
			$_new_fonts_string = $_new_font_key . ':';
			if( isset( $_new_font_value['italic'] ) ) {
				$prefix_weight = true;
				$_new_fonts_string .= 'ital,';
			}
			$_new_fonts_string .= 'wght@';
			if( isset( $_new_font_value['normal'] ) && is_array( $_new_font_value['normal'] ) ) {
				$sorted_new_font_value = $_new_font_value['normal'];
				sort( $sorted_new_font_value, SORT_NUMERIC );
				foreach( $sorted_new_font_value as $font_weight_key => $font_weight_value ) {
					if( $font_weight_key > 0 ) $_new_fonts_string .= ';';
					if( $prefix_weight ) $_new_fonts_string .= '0,'. $font_weight_value;
					if( ! $prefix_weight ) $_new_fonts_string .= $font_weight_value;
				}
				$normal_weight = true;
			}

			if( isset( $_new_font_value['italic'] ) && is_array( $_new_font_value['italic'] ) ) {
				$sorted_new_font_value = $_new_font_value['italic'];
				sort( $sorted_new_font_value, SORT_NUMERIC );
				foreach( $sorted_new_font_value as $font_weight_key => $font_weight_value ) {
					if( $normal_weight ) $_new_fonts_string .= ';';
					if( ! $normal_weight && $font_weight_key > 0 ) $_new_fonts_string .= ';';
					if( $prefix_weight ) $_new_fonts_string .= '1,'. $font_weight_value;
					if( ! $prefix_weight ) $_new_fonts_string .= $font_weight_value;
				}
			}
			$_new_fonts_strings[] = urlencode($_new_fonts_string);
		}
		$google_fonts_url = add_query_arg( [
			'family'	=> implode( '&family=', $_new_fonts_strings ),
			'display'	=> 'swap'
		], 'https://fonts.googleapis.com/css2' );
		return $google_fonts_url;
	}
endif;

if(! function_exists('online_newspaper_get_color_format')):
    function online_newspaper_get_color_format( $color ) {
		if( is_array( $color ) ) return $color;
		if( str_contains( $color, '--online-newspaper-global-preset' ) ) {
			return( 'var( ' .esc_html( $color ). ' )' );
		} else {
			return $color;
		}
    }
endif;

if( ! function_exists( 'online_newspaper_get_rcolor_code' ) ) :
	/**
	 * Returns randon color code
	 * 
	 * @package Online Newspaper
	 * @since 1.0.0
	 */
	function online_newspaper_get_rcolor_code() {
		$color_array["color"] = "#333333";
		$color_array["hover"] = "#448bef";
		return apply_filters( 'online_newspaper_apply_random_color_shuffle_value', $color_array );
	}
endif;

require get_template_directory() . '/inc/theme-starter.php'; // theme starter functions.
require get_template_directory() . '/inc/customizer/customizer.php'; // Customizer additions.
require get_template_directory() . '/inc/extras/helpers.php'; // helpers files.
require get_template_directory() . '/inc/extras/extras.php'; // extras files.
require get_template_directory() . '/inc/extras/extend-api.php'; // extras files.
require get_template_directory() . '/inc/widgets/widgets.php'; // widget handlers
require get_template_directory() . '/inc/metaboxes/metabox.php'; // metabox handlers
include get_template_directory() . '/inc/styles.php';
include get_template_directory() . '/inc/admin/admin.php';
new Online_Newspaper_Admin\Admin_Page();
new Online_Newspaper_Extend_Api();

/**
 * Filter posts ajax function
 *
 * @package Online Newspaper
 * @since 1.0.0
 */
function online_newspaper_filter_posts_load_tab_content() {
	check_ajax_referer( 'online-newspaper-nonce', 'security' );
	$options = isset( $_GET['options'] ) ? json_decode( stripslashes( $_GET['options'] ) ): '';
	if( empty( $options ) ) return;
	$query = $options->query;
	$layout = $options->layout;
	$orderArray = explode( '-', $query->order );
	$posts_args = array(
		'posts_per_page'   => absint( $query->count ),
		'order' => esc_html( $orderArray[1] ),
		'orderby' => esc_html( $orderArray[0] ),
		'cat' => esc_html( $options->category_id ),
		'ignore_sticky_posts'    => true,
		'fields'    =>  'ids',
		'no_found_rows' =>  true,
		'update_post_meta_cache'    =>  false,
		'update_post_term_cache'    =>  false,
	);
	if( $query->ids ) $post_args['post__not_in'] = online_newspaper_get_array_key_string_to_int( $query->ids );
	$n_posts = new \WP_Query( $posts_args );
	$total_posts = $n_posts->post_count;
	if( $n_posts -> have_posts() ):
		ob_start();
		echo '<div class="tab-content content-' .esc_html( $options->category_id ). '">';
			while( $n_posts->have_posts() ) : $n_posts->the_post();
				$options->featuredPosts = false;
				$res['loaded'] = true;
				$current_post = $n_posts->current_post;
				if( $layout == 'four' ) {
					if( $current_post === 0 ) echo '<div class="featured-post">';
					if( $current_post === 0 || $current_post === 1 ) $options->featuredPosts = true;
					if( $current_post === 2 ) {
						?>
						<div class="trailing-post">
						<?php
					}
				} else {
					if( ($current_post % 5) === 0 ) echo '<div class="row-wrap">';
						if( $current_post === 0 ) {
							echo '<div class="featured-post">';
							$options->featuredPosts = true;
						}
							if( $current_post === 1 || $current_post === 5 ) {
								?>
								<div class="trailing-post <?php if($current_post === 5) echo esc_attr('bottom-trailing-post'); ?>">
								<?php
							}
				}
								// get template file w.r.t par
								get_template_part( 'template-parts/news-filter/content', 'one', json_decode( json_encode( $options ), true ) );
				if( $layout == 'four' ) {
					if( $total_posts === $current_post + 1 ) echo '</div><!-- .trailing-post -->';
						if( $current_post === 1 ) echo '</div><!-- .featured-post-->';
				} else {
							if( $current_post === 4 || ( $total_posts === $current_post + 1 ) ) echo '</div><!-- .trailing-post -->';
						if( $current_post === 0 ) echo '</div><!-- .featured-post-->';
					if( ($current_post % 5) === 4 || ( $total_posts === $current_post + 1 ) ) echo '</div><!-- .row-wrap -->';
				}
			endwhile;
		echo '</div>';	
		$res['posts'] = ob_get_clean();
	else :
		$res['loaded'] = false;
		$res['posts'] = esc_html__( 'No posts found', 'online-newspaper' );
	endif;
	wp_send_json_success( $res );
	wp_die();
}
add_action( 'wp_ajax_online_newspaper_filter_posts_load_tab_content', 'online_newspaper_filter_posts_load_tab_content');
add_action( 'wp_ajax_nopriv_online_newspaper_filter_posts_load_tab_content', 'online_newspaper_filter_posts_load_tab_content' );

/**
 * Filter posts layout 6 ajax function
 *
 * @package Online Newspaper
 * @since 1.0.0
 */
function online_newspaper_filter_layout_five_posts_load_tab_content() {
	check_ajax_referer( 'online-newspaper-nonce', 'security' );
	$options = isset( $_GET['options'] ) ? json_decode( stripslashes( $_GET['options'] ) ): '';
	if( empty( $options ) ) return;
	$query = $options->query;
	$layout = $options->layout;
	$orderArray = explode( '-', $query->order );
	$posts_args = array(
		'posts_per_page'   => absint( $query->count ),
		'order' => esc_html( $orderArray[1] ),
		'orderby' => esc_html( $orderArray[0] ),
		'cat' => esc_html( $options->category_id ),
		'ignore_sticky_posts'    => true,
		'fields'    =>  'ids',
		'no_found_rows' =>  true,
		'update_post_meta_cache'    =>  false,
		'update_post_term_cache'    =>  false,
	);
	if( $query->ids ) $posts_args['post__not_in'] = online_newspaper_get_array_key_string_to_int( $query->ids );
	$post_query = new \WP_Query( $posts_args );
	$total_posts = $post_query->post_count;
	if( $post_query->have_posts() ):
		ob_start();
		?>
			<div class="tab-content content-<?php echo esc_attr( $options->category_id )?>">
                <?php
                    unset( $posts_args['category_name'] );
					$delay = 0;
					$row_count = 0;
					while( $post_query->have_posts() ) : $post_query->the_post();
						$res['loaded'] = true;
						$options->featuredPosts = ( $layout === 'six' );
						if( $layout === 'five' ) {
							$current_post = $post_query->current_post;
							$last_item = ( $total_posts === ( $current_post + 1 ) );
							if( ( $current_post % 5 ) === 0 && $row_count < 2  ) {
								echo '<div class="row-wrap">';
								$row_count++;
							}
								if( $current_post === 0 ) {
									echo '<div class="featured-post">';
									$options->featuredPosts = true;
								}
									if( $current_post === 1 || $current_post === 5 ) {
										?>
										<div class="trailing-post <?php if($current_post === 5) echo esc_attr('bottom-trailing-post'); ?>">
										<?php
									}
										if( $current_post === 1 ) echo '<div class="grid-posts">';
										if( $current_post === 3 ) echo '<div class="list-posts">';
						}
									$options->delay = $delay;
									// get template file w.r.t par
										get_template_part( 'template-parts/news-filter/content', 'one', json_decode( json_encode( $options ), true ) );
						if( $layout === 'five' ) {
												if( $current_post === 2 || ( $last_item && $total_posts <= 3 && $total_posts >= 2 ) ) echo '</div><!-- .grid-posts -->';
										if( $current_post === 4 || ( $last_item && $total_posts <= 5 && $total_posts >= 4 ) ) echo '</div><!-- .list-posts -->';
									if( $current_post === 4 || $last_item ) echo '</div><!-- .trailing-post -->';
								if( $current_post === 0 ) echo '</div><!-- .featured-post-->';
								if( ! in_array( $current_post, [ 0, 4 ] ) && $last_item ) echo '</div><!-- .total-posts-close -->';
							if( $current_post === 4 && $row_count <= 2 ) echo '</div><!-- .row-wrap -->';
						}
						$delay += 50;
					endwhile;
                ?>
            </div>
		<?php
		$res['posts'] = ob_get_clean();
	else :
		$res['loaded'] = false;
		$res['posts'] = esc_html__( 'No posts found', 'online-newspaper' );
	endif;
	wp_send_json_success( $res );
	wp_die();
}
add_action( 'wp_ajax_online_newspaper_filter_layout_five_posts_load_tab_content', 'online_newspaper_filter_layout_five_posts_load_tab_content');
add_action( 'wp_ajax_nopriv_online_newspaper_filter_layout_five_posts_load_tab_content', 'online_newspaper_filter_layout_five_posts_load_tab_content' );

if( ! function_exists( 'online_newspaper_lazy_load_value' ) ) :
	/**
	 * Echos lazy load attribute value.
	 * 
	 * @package Online Newspaper
	 * @since 1.0.0
	 */
	function online_newspaper_lazy_load_value() {
		echo esc_attr( apply_filters( 'online_newspaper_lazy_load_value', 'lazy' ) );
	}
endif;

if( ! function_exists( 'online_newspaper_add_menu_description' ) ) :
	// merge menu description element to the menu 
	function online_newspaper_add_menu_description( $item_output, $item, $depth, $args ) {
		if($args->theme_location != 'menu-2') return $item_output;
		
		if ( !empty( $item->description ) ) {
			$item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
		}
		return $item_output;
	}
	add_filter( 'walker_nav_menu_start_el', 'online_newspaper_add_menu_description', 10, 4 );
endif;

if( ! function_exists( 'online_newspaper_bool_to_string' ) ) :
	// boolean value to string 
	function online_newspaper_bool_to_string( $bool ) {
		$string = ( $bool ) ? '1' : '0';
		return $string;
	}
endif;

if( ! function_exists( 'online_newspaper_get_image_sizes_option_array' ) ) :
	/**
	 * Get list of image sizes
	 * 
	 * @since 1.0.0
	 * @package Online Newspaper
	 */
	function online_newspaper_get_image_sizes_option_array() {
		$image_sizes = get_intermediate_image_sizes();
		foreach( $image_sizes as $image_size ) :
			$sizes[] = [
				'label'	=> esc_html( $image_size ),
				'value'	=> esc_html( $image_size )
			];
		endforeach;
		return $sizes;
	}
endif;

if( ! function_exists( 'online_newspaper_get_style_tag' ) ) :
	/**
	 * Generate Style tag for image ratio and image radius for news grid, list, carousel
	 * 
	 * @since 1.0.0
	 * @package Online Newspaper
	 */
	function online_newspaper_get_style_tag( $variables, $selectors = '' ) {
		echo '<style id="'. esc_attr( $variables['unique_id'] ) .'-style">';
			if( isset( $variables['image_ratio'] ) ) {
				$image_ratio = $variables['image_ratio'];

				if( $image_ratio[ 'desktop' ] > 0 ) echo "#" . $variables['unique_id']. " article figure.post-thumb-wrap { padding-bottom: calc( " . $image_ratio[ 'desktop' ] . " * 100% ) }\n";

				if( $image_ratio[ 'tablet' ] > 0 ) echo " @media (max-width: 769px){ #" . $variables['unique_id']. " article figure.post-thumb-wrap { padding-bottom: calc( " . $image_ratio[ 'tablet' ] . " * 100% ) } }\n";

				if( $image_ratio[ 'smartphone' ] > 0 ) echo " @media (max-width: 548px){ #" . $variables['unique_id']. " article figure.post-thumb-wrap { padding-bottom: calc( " . $image_ratio[ 'smartphone' ] . " * 100% ) }}\n";

			}
		echo "</style>";
	}
endif;

if( ! function_exists( 'online_newspaper_get_style_tag_fb' ) ) :
	/**
	 * Generates style tag for image ratio and image radius for news filter and new block
	 * 
	 * @since 1.0.0
	 * @package Online Newspaper
	 */
	function online_newspaper_get_style_tag_fb( $variables, $selectors = '' ) {
		echo '<style id="'. esc_attr( $variables['unique_id'] ) .'-style">';
			if( isset( $variables['image_ratio'] ) ) {
				$image_ratio = $variables['image_ratio'];
				// for featured post
				if( $variables['layout'] == 'three' ) {

					if( $image_ratio[ 'desktop' ] > 0 ) echo "#" . $variables['unique_id']. ".online-newspaper-block.layout--three .featured-post figure { padding-bottom: calc( " . ( $image_ratio[ 'desktop' ] * 0.4 ) . " * 100% ) }\n";

					if( $image_ratio[ 'tablet' ] > 0 ) echo "@media (max-width: 769px) {#" . $variables['unique_id']. ".online-newspaper-block.layout--three .featured-post figure { padding-bottom: calc( " . ( $image_ratio[ 'tablet' ] * 0.4 ) . " * 100% ) } }\n";

					if( $image_ratio[ 'smartphone' ] > 0 ) echo "@media (max-width: 769px) {#" . $variables['unique_id']. ".online-newspaper-block.layout--three .featured-post figure { padding-bottom: calc( " . ( $image_ratio[ 'smartphone' ] * 0.4 ) . " * 100% ) } }\n";	

				} else {

					if( $image_ratio[ 'desktop' ] > 0 ) echo "#" . $variables['unique_id']. ".online-newspaper-block .featured-post figure { padding-bottom: calc( " . $image_ratio[ 'desktop' ] . " * 100% ) }\n";

					if( $image_ratio[ 'tablet' ] > 0 ) echo "@media (max-width: 769px) {#" . $variables['unique_id']. ".online-newspaper-block .featured-post figure { padding-bottom: calc( " . $image_ratio[ 'tablet' ] . " * 100% ) } }\n";

					if( $image_ratio[ 'smartphone' ] > 0 ) echo "@media (max-width: 769px) {#" . $variables['unique_id']. ".online-newspaper-block .featured-post figure { padding-bottom: calc( " . $image_ratio[ 'smartphone' ] . " * 100% ) } }\n";

				}

				// for trailing post
				if( $variables['layout'] == 'two' ) {
					
					if( $image_ratio[ 'desktop' ] > 0 ) echo "#" . $variables['unique_id']. ".online-newspaper-block.layout--two .trailing-post figure { padding-bottom: calc( " . ( $image_ratio[ 'desktop' ] * 0.78 ) . " * 100% ) }\n";

					if( $image_ratio[ 'tablet' ] > 0 ) echo "@media (max-width: 769px) {#" . $variables['unique_id']. ".online-newspaper-block .trailing-post figure { padding-bottom: calc( " . ( $image_ratio[ 'tablet' ] * 0.78 ) . " * 100% ) } }\n";

					if( $image_ratio[ 'smartphone' ] > 0 ) echo "@media (max-width: 769px) {#" . $variables['unique_id']. ".online-newspaper-block.layout--two .trailing-post figure { padding-bottom: calc( " . ( $image_ratio[ 'smartphone' ] * 0.78 ) . " * 100% ) } }\n";

				} else {

					if( $image_ratio[ 'desktop' ] > 0 ) echo "#" . $variables['unique_id']. ".online-newspaper-block .trailing-post figure { padding-bottom: calc( " . ( $image_ratio[ 'desktop' ] * 0.3 ) . " * 100% ) }\n";

					if( $image_ratio[ 'tablet' ] > 0 ) echo "@media (max-width: 769px) {#" . $variables['unique_id']. ".online-newspaper-block .trailing-post figure { padding-bottom: calc( " . ( $image_ratio[ 'tablet' ] * 0.3 ) . " * 100% ) } }\n";

					if( $image_ratio[ 'smartphone' ] > 0 ) echo "@media (max-width: 769px) {#" . $variables['unique_id']. ".online-newspaper-block .trailing-post figure { padding-bottom: calc( " . ( $image_ratio[ 'smartphone' ] * 0.3 ) . " * 100% ) } }\n";

				}

			}
		echo "</style>";
	}
endif;

if( ! function_exists( 'online_newspaper_get_image_sizes' ) ) :
	/**
	 * get a list of all images sizes
	 * 
	 * @since 1.0.0
	 * @package Online Newspaper
	 */
	function online_newspaper_get_image_sizes() {
		$image_sizes_args = get_intermediate_image_sizes();
		$image_size_elements_args = [];
		if( ! empty( $image_sizes_args ) ) :
			foreach( $image_sizes_args as $image_size ) :
				$image_size_elements_args[$image_size] = esc_html( $image_size );
			endforeach;
		endif;
		return $image_size_elements_args;
	}
endif;

if( ! function_exists( 'online_newspaper_parse_icon_picker_value' ) ) :
	/**
	 * Function to return image url for icon picker
	 */
	function online_newspaper_parse_icon_picker_value ( $control ) {
		if( $control['type'] == 'svg' ) :
			$control['url'] = wp_get_attachment_image_url( $control['value'], 'full' );
		endif;
		return $control;
	}
endif;

if( ! function_exists( 'online_newspaper_get_all_social_share' ) ) :
	/**
	 * All social share icons and urls
	 * 
	 * @since 1.0.0
	 */
	function online_newspaper_get_all_social_share( $icon = '' ) {
		$postUrl = 'http' . ( isset( $_SERVER['HTTPS'] ) ? 's' : '' ) . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $allIcons = [
			'fa-brands fa-facebook'	=>	[
				'label'	=>	esc_html__( 'Facebook', 'online-newspaper' ),
				'value'	=>	'https://www.facebook.com/sharer/sharer.php?u=',
			],
			'fa-brands fa-facebook-f'	=>	[
				'label'	=>	esc_html__( 'Facebook', 'online-newspaper' ),
				'value'	=>	'https://www.facebook.com/sharer/sharer.php?u=',
			],
			'fa-brands fa-square-facebook'	=>	[
				'label'	=>	esc_html__( 'Facebook', 'online-newspaper' ),
				'value'	=>	'https://www.facebook.com/sharer/sharer.php?u=',
			],
			'fa-brands fa-square-x-twitter'	=>	[
				'label'	=>	esc_html__( 'Twitter', 'online-newspaper' ),
				'value'	=>	'https://twitter.com/intent/tweet?url=',
			],
			'fa-brands fa-x-twitter'	=>	[
				'label'	=>	esc_html__( 'Twitter', 'online-newspaper' ),
				'value'	=>	'https://twitter.com/intent/tweet?url=',
			],
			'fa-brands fa-twitter'	=>	[
				'label'	=>	esc_html__( 'Twitter', 'online-newspaper' ),
				'value'	=>	'https://twitter.com/intent/tweet?url=',
			],
			'fa-brands fa-linkedin'	=>	[
				'label'	=>	esc_html__( 'Linkedin', 'online-newspaper' ),
				'value'	=>	'https://www.linkedin.com/sharing/share-offsite/?url=',
			],
			'fa-brands fa-linkedin-in'	=>	[
				'label'	=>	esc_html__( 'Linkedin', 'online-newspaper' ),
				'value'	=>	'https://www.linkedin.com/sharing/share-offsite/?url=',
			],
			'fa-solid fa-envelope'	=>	[
				'label'	=>	esc_html__( 'Envelope', 'online-newspaper' ),
				'value'	=>	'mailto:?subject={title}&body=',
			],
			'fa-regular fa-envelope'	=>	[
				'label'	=>	esc_html__( 'Envelope', 'online-newspaper' ),
				'value'	=>	'https://mail.google.com/mail/?view=cm&to={email_address}&su={title}&body=',
			],
			'fa-brands fa-instagram'	=>	[
				'label'	=>	esc_html__( 'Instagram', 'online-newspaper' ),
				'value'	=>	'http://www.instagram.com',
			],
			'fa-brands fa-square-instagram'	=>	[
				'label'	=>	esc_html__( 'Instagram', 'online-newspaper' ),
				'value'	=>	'http://www.instagram.com',
			],
			'fa-brands fa-whatsapp'	=>	[
				'label'	=>	esc_html__( 'Whatsapp', 'online-newspaper' ),
				'value'	=>	'https://api.whatsapp.com/send?phone={phone_number}&text=',
			],
			'fa-brands fa-square-whatsapp'	=>	[
				'label'	=>	esc_html__( 'Whatsapp', 'online-newspaper' ),
				'value'	=>	'https://api.whatsapp.com/send?phone={phone_number}&text=',
			],
			'fa-brands fa-reddit'	=>	[
				'label'	=>	esc_html__( 'Reddit', 'online-newspaper' ),
				'value'	=>	'https://reddit.com/submit?url=',
			],
			'fa-brands fa-reddit-alien'	=>	[
				'label'	=>	esc_html__( 'Reddit', 'online-newspaper' ),
				'value'	=>	'https://reddit.com/submit?url=',
			],
			'fa-brands fa-square-reddit'	=>	[
				'label'	=>	esc_html__( 'Reddit', 'online-newspaper' ),
				'value'	=>	'https://reddit.com/submit?url=',
			],
			'fa-brands fa-weixin'	=>	[
				'label'	=>	esc_html__( 'Weixin', 'online-newspaper' ),
				'value'	=>	'https://widget.wechat.com/o/qrcode/',
			],
			'fa-brands fa-tumblr'	=>	[
				'label'	=>	esc_html__( 'Tumblr', 'online-newspaper' ),
				'value'	=>	'https://www.tumblr.com/widgets/share/tool?canonicalUrl=',
			],
			'fa-brands fa-square-tumblr'	=>	[
				'label'	=>	esc_html__( 'Tumblr', 'online-newspaper' ),
				'value'	=>	'https://www.tumblr.com/widgets/share/tool?canonicalUrl=',
			],
			'fa-brands fa-weibo'	=>	[
				'label'	=>	esc_html__( 'Weibo', 'online-newspaper' ),
				'value'	=>	'http://service.weibo.com/share/share.php?url=',
			],
			'fa-brands fa-google-plus'	=>	[
				'label'	=>	esc_html__( 'Google Plus', 'online-newspaper' ),
				'value'	=>	'https://plus.google.com/share?url=',
			],
			'fa-brands fa-google-plus-g'	=>	[
				'label'	=>	esc_html__( 'Google Plus', 'online-newspaper' ),
				'value'	=>	'https://plus.google.com/share?url=',
			],
			'fa-brands fa-square-google-plus'	=>	[
				'label'	=>	esc_html__( 'Google Plus', 'online-newspaper' ),
				'value'	=>	'https://plus.google.com/share?url=',
			],
			'fa-brands fa-skype'	=>	[
				'label'	=>	esc_html__( 'Skype', 'online-newspaper' ),
				'value'	=>	'https://web.skype.com/share?url=',
			],
			'fa-brands fa-telegram'	=>	[
				'label'	=>	esc_html__( 'Telegram', 'online-newspaper' ),
				'value'	=>	'https://telegram.me/share/url?url=',
			],
			'fa-brands fa-pinterest'	=>	[
				'label'	=>	esc_html__( 'Pinterest', 'online-newspaper' ),
				'value'	=>	'http://pinterest.com/pin/create/link/?url=',
			],
			'fa-brands fa-pinterest-p'	=>	[
				'label'	=>	esc_html__( 'Pinterest', 'online-newspaper' ),
				'value'	=>	'http://pinterest.com/pin/create/link/?url=',
			],
			'fa-brands fa-square-pinterest'	=>	[
				'label'	=>	esc_html__( 'Pinterest', 'online-newspaper' ),
				'value'	=>	'http://pinterest.com/pin/create/link/?url=',
			],
			'fa-brands fa-vk'	=>	[
				'label'	=>	esc_html__( 'VK', 'online-newspaper' ),
				'value'	=>	'http://vk.com/share.php?url=',
			],
			'fa-brands fa-line'	=>	[
				'label'	=>	esc_html__( 'Line', 'online-newspaper' ),
				'value'	=>	'https://social-plugins.line.me/lineit/share?url=',
			],
			'fa-brands fa-blogger'	=>	[
				'label'	=>	esc_html__( 'Blogger', 'online-newspaper' ),
				'value'	=>	'https://www.blogger.com/blog-this.g?u=',
			],
			'fa-brands fa-blogger-b'	=>	[
				'label'	=>	esc_html__( 'Blogger', 'online-newspaper' ),
				'value'	=>	'https://www.blogger.com/blog-this.g?u=',
			],
			'fa-brands fa-evernote'	=>	[
				'label'	=>	esc_html__( 'Evernote', 'online-newspaper' ),
				'value'	=>	'https://www.evernote.com/clip.action?url=',
			],
			'fa-brands fa-yahoo'	=>	[
				'label'	=>	esc_html__( 'Yahoo', 'online-newspaper' ),
				'value'	=>	'http://compose.mail.yahoo.com/?to={email_address}&subject={title}&body=',
			],
			'fa-brands fa-odnoklassniki'	=>	[
				'label'	=>	esc_html__( 'Odnoklassniki', 'online-newspaper' ),
				'value'	=>	'https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl=',
			],
			'fa-brands fa-square-odnoklassniki'	=>	[
				'label'	=>	esc_html__( 'Odnoklassniki', 'online-newspaper' ),
				'value'	=>	'https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl=',
			],
			'fa-brands fa-viber'	=>	[
				'label'	=>	esc_html__( 'Viber', 'online-newspaper' ),
				'value'	=>	'viber://forward?text=',
			],
			'fa-brands fa-get-pocket'	=>	[
				'label'	=>	esc_html__( 'Get Pocket', 'online-newspaper' ),
				'value'	=>	'https://getpocket.com/edit?url=',
			],
			'fa-brands fa-mix'	=>	[
				'label'	=>	esc_html__( 'Mix', 'online-newspaper' ),
				'value'	=>	'https://mix.com/add?url=',
			],
			'fa-brands fa-flipboard'	=>	[
				'label'	=>	esc_html__( 'Flipboard', 'online-newspaper' ),
				'value'	=>	'https://share.flipboard.com/bookmarklet/popout?v=2&title=[TITLE]&url=',
			],
			'fa-brands fa-square-xing'	=>	[
				'label'	=>	esc_html__( 'Xing', 'online-newspaper' ),
				'value'	=>	'https://www.xing.com/app/user?op=share;url=',
			],
			'fa-brands fa-xing'	=>	[
				'label'	=>	esc_html__( 'Xing', 'online-newspaper' ),
				'value'	=>	'https://www.xing.com/app/user?op=share;url=',
			],
			'fa-brands fa-digg'	=>	[
				'label'	=>	esc_html__( 'Digg', 'online-newspaper' ),
				'value'	=>	'http://digg.com/submit?url=',
			],
			'fa-brands fa-stumbleupon-circle'	=>	[
				'label'	=>	esc_html__( 'Stumbleupon', 'online-newspaper' ),
				'value'	=>	'http://www.stumbleupon.com/submit?url=',
			],
			'fa-brands fa-stumbleupon'	=>	[
				'label'	=>	esc_html__( 'Stumbleupon', 'online-newspaper' ),
				'value'	=>	'http://www.stumbleupon.com/submit?url=',
			],
			'fa-brands fa-delicious'	=>	[
				'label'	=>	esc_html__( 'Delicious', 'online-newspaper' ),
				'value'	=>	'https://delicious.com/save?v=5&provider=[PROVIDER]&noui&jump=close&url=',
			],
			'fa-brands fa-buffer'	=>	[
				'label'	=>	esc_html__( 'Buffer', 'online-newspaper' ),
				'value'	=>	'http://bufferapp.com/add?text=[post-title]&url=',
			],
			'fa-brands fa-diaspora'	=>	[
				'label'	=>	esc_html__( 'Diaspora', 'online-newspaper' ),
				'value'	=>	'https://share.diasporafoundation.org/?title={title}&url=',
			],
			'fa-brands fa-hacker-news'	=>	[
				'label'	=>	esc_html__( 'Hacker News', 'online-newspaper' ),
				'value'	=>	'https://news.ycombinator.com/submitlink?u=',
			],
			'fa-solid fa-comment-sms'	=>	[
				'label'	=>	esc_html__( 'SMS', 'online-newspaper' ),
				'value'	=>	'sms:{phone_number}?body=',
			],
			'fa-brands fa-wordpress'	=>	[
				'label'	=>	esc_html__( 'Wordpress', 'online-newspaper' ),
				'value'	=>	'https://wordpress.com/press-this.php?u=',
			],
			'fa-brands fa-wordpress-simple'	=>	[
				'label'	=>	esc_html__( 'Wordpress', 'online-newspaper' ),
				'value'	=>	'https://wordpress.com/press-this.php?u=',
			],
			'fa-solid fa-copy'	=>	[
				'label'	=>	esc_html__( 'Copy', 'online-newspaper' ),
				'value'	=>	$postUrl,
			],
			'fa-solid fa-print'	=>	[
				'label'	=>	esc_html__( 'Print', 'online-newspaper' ),
				'value'	=>	'print',
			],
			'fa-brands fa-amazon'	=>	[
				'label'	=>	esc_html__( 'Amazon', 'online-newspaper' ),
				'value'	=>	'http://www.amazon.com/wishlist/add?u=',
			],
			'fa-brands fa-renren'	=>	[
				'label'	=>	esc_html__( 'Renren', 'online-newspaper' ),
				'value'	=>	'https://www.connect.renren.com/share/sharer?url=',
			],
			'fa-brands fa-trello'	=>	[
				'label'	=>	esc_html__( 'Trello', 'online-newspaper' ),
				'value'	=>	'https://trello.com/add-card?mode=popup&url=',
			],
			'fa-brands fa-viadeo'	=>	[
				'label'	=>	esc_html__( 'Viadeo', 'online-newspaper' ),
				'value'	=>	'http://www.viadeo.com/shareit/share/?url=',
			],
			'fa-brands fa-square-viadeo'	=>	[
				'label'	=>	esc_html__( 'Viadeo', 'online-newspaper' ),
				'value'	=>	'http://www.viadeo.com/shareit/share/?url='
			]
		];
		if( $icon === '' ) :
			return $allIcons;
		else:
			return $allIcons[ $icon ];
		endif;
	}
endif;

if ( ! function_exists( 'online_newspaper_create_elementor_kit' ) ) {
    /**
     * Create Elementor default kit
     *
     * @since 1.0.0
     */
    function online_newspaper_create_elementor_kit() {
        if ( ! did_action( 'elementor/loaded' ) ) return;
        $kit = Elementor\Plugin::$instance->kits_manager->get_active_kit();
        if ( ! $kit->get_id() ) :
            $created_default_kit = Elementor\Plugin::$instance->kits_manager->create_default();
            update_option( 'elementor_active_kit', $created_default_kit );
		endif;
    }
    add_action( 'init', 'online_newspaper_create_elementor_kit' );
}

 if( ! function_exists( 'online_newspaper_get_archive_layout_meta' ) ) :
	/**
	 * Get archive layout
	 * 
	 * @since 1.0.0
	 */
 	function online_newspaper_get_archive_layout_meta() {
		$current_id = get_queried_object_id();
		$archive_layout_meta = 'customizer-layout';
		if( is_category() ) :
			$archive_meta_key = '_online_newspaper_category_archive_custom_meta_field';
			$archive_layout_meta = metadata_exists( 'term', $current_id, $archive_meta_key ) ? get_term_meta( $current_id, $archive_meta_key, true ) : 'customizer-layout';
		elseif ( is_tag() ) :
			$archive_meta_key = '_online_newspaper_post_tag_archive_custom_meta_field';
			$archive_layout_meta = metadata_exists( 'term', $current_id, $archive_meta_key ) ? get_term_meta( $current_id, $archive_meta_key, true ) : 'customizer-layout';
		endif;

		return $archive_layout_meta;
	}
 endif;

 if( ! function_exists( 'online_newspaper_get_archive_sidebar_meta' ) ) :
	/**
	 * Get archive sidebar layout
	 * 
	 * @since 1.0.0
	 */
 	function online_newspaper_get_archive_sidebar_meta() {
		$current_id = get_queried_object_id();
		$archive_sidebar_meta = 'customizer-setting';
		if( is_category() ) :
			$archive_meta_key = '_online_newspaper_category_sidebar_custom_meta_field';
			$archive_sidebar_meta = metadata_exists( 'term', $current_id, $archive_meta_key ) ? get_term_meta( $current_id, $archive_meta_key, true ) : 'customizer-setting';
		elseif ( is_tag() ) :
			$archive_meta_key = '_online_newspaper_post_tag_sidebar_custom_meta_field';
			$archive_sidebar_meta = metadata_exists( 'term', $current_id, $archive_meta_key ) ? get_term_meta( $current_id, $archive_meta_key, true ) : 'customizer-setting';
		endif;

		return $archive_sidebar_meta;
	}
 endif;

 if( ! function_exists( 'online_newspaper_post_order_args' ) ) :
	/**
	 * Return post order args
	 * 
	 * @since 1.0.0
	 */
	function online_newspaper_post_order_args() {
		return [
			'date-desc' =>  esc_html__( 'Newest - Oldest', 'online-newspaper' ),
			'date-asc' =>  esc_html__( 'Oldest - Newest', 'online-newspaper' ),
			'rand-desc' =>  esc_html__( 'Random', 'online-newspaper' )
		];
	}
endif;

if( ! function_exists( 'online_newspaper_stories_ajax_call' ) ) :
	/**
	 * Add stories to web stories according to current active story
	 * 
	 * @since 1.0.0
	 */
	function online_newspaper_stories_ajax_call() {
		check_ajax_referer( 'online-newspaper-nonce', '_wpnonce' );
		$story_ids = ( isset( $_POST[ 'storyIds' ] ) ) ? $_POST[ 'storyIds' ] : '';
		$count = ( isset( $_POST[ 'count' ] ) ) ? $_POST[ 'count' ] : '';
		if( $story_ids ) :
			$query_args = [
				'post_type'	=>	'post',
				'post_status'	=>	'publish',
				'no_found_rows'	=>	true,
				'fields'    =>  'ids',
				'update_post_meta_cache'    =>  false,
				'update_post_term_cache'    =>  false,
			];
			$post_per_page = ONP\online_newspaper_get_customizer_option( 'web_stories_max_no_of_inner_stories' );
			$query_args[ 'posts_per_page' ] = absint( $post_per_page );
			$success_flag = false;
			ob_start();
			foreach( $story_ids as $cat_id ) :
				$query_args[ 'cat' ] = $cat_id;
				$query_instance = new WP_Query( apply_filters( 'online_newspaper_query_args_filter', $query_args ) );
				if( $query_instance->have_posts() ) :
					$success_flag = true;
						echo '<div class="inner-story">';
	
							echo '<div class="inner-story-wrap" data-id="', esc_attr( $cat_id ) ,'">';
	
								while( $query_instance->have_posts() ) : $query_instance->the_post();
									?>
										<div class="story-item<?php if( ! has_post_thumbnail() ) echo ' no-thumb'; ?>">
	
											<div class="story-cover-wrap">
	
												<figure class="story-cover">
	
													<?php 
														// thumbnail
														the_post_thumbnail( 'post-thumbnail', [
															'loading'	=>	'lazy'
														]);
	
													?>
	
												</figure>
	
											</div>
	
											<?php
	
												echo '<div class="content-wrap">';
														
													// categories
													online_newspaper_get_post_categories( get_the_ID(), 2 );
	
													// title
													the_title( '<h2 class="title"><a href="'. get_the_permalink() .'">', '</a></h2>' );
	
													// Meta
	
													echo '<div class="meta-wrap">';
		
														// author
														online_newspaper_posted_by();
		
														// date
														online_newspaper_posted_on();
		
													echo '</div>';
	
												echo '</div>';
	
											?>
	
										</div>
	
									<?php
								endwhile;
	
							echo '</div>';
	
						echo '</div>';
						wp_reset_postdata();
					endif;
			endforeach;
			$res = ob_get_clean();
		endif;
		$success_flag ? wp_send_json_success( $res ) : wp_send_json_error( esc_html__( 'No stories found', 'online-newspaper' ) );
		wp_die();
	}
	add_action( 'wp_ajax_online_newspaper_stories_ajax_call', 'online_newspaper_stories_ajax_call' );
	add_action( 'wp_ajax_nopriv_online_newspaper_stories_ajax_call', 'online_newspaper_stories_ajax_call' );
endif;

if( ! function_exists( 'online_newspaper_sticky_posts_ajax_call' ) ) :
	/**
	 * Fetch append posts for sticky posts
	 * 
	 * @since 1.0.0
	 */
	function online_newspaper_sticky_posts_ajax_call() {
		check_ajax_referer( 'online-newspaper-nonce', '_wpnonce' );
		$args[ 'classes' ] = 'append';
		$posts_to_append = ONP\online_newspaper_get_customizer_option( 'sticky_posts_posts_to_append' );
		$total_posts = ONP\online_newspaper_get_customizer_option( 'sticky_posts_to_show' );
		$query_args = online_newspaper_get_query_args( 'sticky' );
		$query_args[ 'posts_per_page' ] = absint( $posts_to_append );
		$query_args[ 'offset' ] = absint( $total_posts - $posts_to_append );
		$query_args[ 'fields' ] = 'ids';
		$query_args[ 'no_found_rows' ] = true;
		$query_args[ 'update_post_meta_cache' ] = false;
		$query_args[ 'update_post_term_cache' ] = false;
		$success_flag = false;
		ob_start();
		$query_instance = new WP_Query( $query_args );
		if( $query_instance->have_posts() ) :
			$success_flag = true;
			$count = $total_posts - $posts_to_append;
			while( $query_instance->have_posts() ) : $query_instance->the_post();
				$count++;
				$args[ 'count' ] = $count;
				get_template_part( 'template-parts/content', 'sticky-posts', $args );
			endwhile;
		endif;
		$res = ob_get_clean();
		$success_flag ? wp_send_json_success( $res ) : wp_send_json_error( esc_html__( 'No posts to append.', 'online-newspaper' ) );
		wp_die();
	}
	add_action( 'wp_ajax_online_newspaper_sticky_posts_ajax_call', 'online_newspaper_sticky_posts_ajax_call' );
	add_action( 'wp_ajax_nopriv_online_newspaper_sticky_posts_ajax_call', 'online_newspaper_sticky_posts_ajax_call' );
endif;

if( ! function_exists( 'online_newspaper_get_query_args' ) ) :
	/**
	 * Get Query Parameters of WP Query
	 * 
	 * @since 1.0.0
	 */
	function online_newspaper_get_query_args( $prefix = '' ) {
		$category_ids = ONP\online_newspaper_get_customizer_option( $prefix . '_posts_categories' );
		$posts_to_include = ONP\online_newspaper_get_customizer_option( $prefix . '_posts_to_include' );
		$post_order = ONP\online_newspaper_get_customizer_option( $prefix . '_posts_order' );
		$exploded_order = explode( '-', $post_order );
		$posts_to_show = ONP\online_newspaper_get_customizer_option( $prefix . '_posts_to_show' );
		$hide_empty = ONP\online_newspaper_get_customizer_option( $prefix . '_hide_empty' );

		$posts_args = [
            'post_type' =>  'post',
            'post_status'  =>  'publish',
            'posts_per_page'    =>  absint( $posts_to_show ),
            'order' =>  $exploded_order[ 1 ],
            'orderby'   =>  $exploded_order[ 0 ],
            'ignore_sticky_posts'   =>  true,
            'fields'    =>  'ids',
			'fields'    =>  'ids',
			'no_found_rows' =>  true,
			'update_post_meta_cache'    =>  false,
			'update_post_term_cache'    =>  false,
        ];

		$post_categories_id_args = ( ! empty( $category_ids ) ) ? implode( ",", array_column( $category_ids, 'value' ) ) : '';
        $post_to_include_id_args = ( ! empty( $posts_to_include ) ) ? array_column( $posts_to_include, 'value' ) : '';

		if( isset( $category_ids ) ) $posts_args[ 'cat' ] = $post_categories_id_args;
        if( isset( $posts_to_include ) ) $posts_args[ 'post__in' ] = $post_to_include_id_args;

		if( $hide_empty ) :
            $posts_args[ 'meta_query' ] = [
                [
                    'key'   =>  '_thumbnail_id',
                    'compare'   =>  'EXISTS'
                ]
            ];
        endif;
		return $posts_args;
	}
endif;

if( ! function_exists( 'online_newspaper_get_reorder_value' ) ) :
	/**
	 * Get Reorder value
	 * 
	 * @since 1.0.0
	 */
	function online_newspaper_get_reorder_value( $reorder ) {
		if( is_array( $reorder ) ) :
			$filtered_value = [];
			foreach( $reorder as $section ) :
				$filtered_value[ $section[ 'value' ] ] = $section[ 'option' ];
			endforeach;
			return $filtered_value;
		endif;
		return $reorder;
	}
endif;

if( ! function_exists( 'online_newspaper_search_query_section' ) ) :
	/**
	 * Search Query Section
	 * 
	 * @since 1.0.0
	 */
	function online_newspaper_search_query_section() {
		$term_args = [
			'fields'	=>	'id=>name',
			'hide_empty'	=>	true
		];
		$categories = get_categories( $term_args );
		$tags = get_tags( $term_args );
		$user_query = new \WP_User_Query([
			'fields'    =>  [ 'ID', 'display_name' ]
		]);
		$post_types = [
			'post'	=>	esc_html__( 'Posts', 'online-newspaper' ),
			'page'	=>	esc_html__( 'Pages', 'online-newspaper' ),
		];
		?>
			<div class="filter-wrapper">
				<div class="filter has-dropdown type">
					<div class="head">
						<span class="label"><?php esc_html_e( 'Types', 'online-newspaper' ); ?></span>
						<span class="icon"><i class="fa-solid fa-angle-down"></i></span>
					</div>
					<div class="body">
						<?php
							if( is_array( $post_types ) && ! empty( $post_types ) ) :
								echo '<div class="items">';
								foreach( $post_types as $key => $type ) :
									?>
										<div class="item">
											<input type="checkbox" name="type-<?php echo esc_attr( $key ); ?>" id="type-<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $key ); ?>">
											<label for="type-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $type ); ?></label>
										</div>
									<?php
								endforeach;
								echo '</div>';
							endif;
						?>
						<button class="clear"><?php esc_html_e( 'Clear', 'online-newspaper' ); ?></button>
					</div>
				</div>
				<div class="filter has-dropdown authors">
					<div class="head">
						<span class="label"><?php esc_html_e( 'Authors', 'online-newspaper' ); ?></span>
						<span class="icon"><i class="fa-solid fa-angle-down"></i></span>
					</div>
					<div class="body">
						<?php
							if( is_array( $user_query->get_results() ) && ! empty( $user_query->get_results() ) ) :
								echo '<div class="items">';
								foreach( $user_query->get_results() as $user ) :
									$user_id = $user->ID;
									?>
										<div class="item">
											<input type="checkbox" name="user-<?php echo esc_attr( $user_id ); ?>" id="user-<?php echo esc_attr( $user_id ); ?>" value="<?php echo esc_attr( $user_id ); ?>">
											<label for="user-<?php echo esc_attr( $user_id ); ?>"><?php echo esc_html( $user->display_name ); ?></label>
										</div>
									<?php
								endforeach;
								echo '</div>';
							endif;
						?>
						<button class="clear"><?php esc_html_e( 'Clear', 'online-newspaper' ); ?></button>
					</div>
				</div>
				<button class="action-btn filter-button disabled"><?php esc_html_e( 'Filter', 'online-newspaper' ); ?></button>
				<button class="action-btn clear-button disabled"><?php esc_html_e( 'Clear', 'online-newspaper' ); ?></button>
			</div>
		<?php
	}
endif;

if( ! function_exists( 'online_newspaper_search_page_ajax_call' ) ) :
	/**
	 * Search page ajax call
	 * 
	 * @since 1.0.0
	 */
	function online_newspaper_search_page_ajax_call() {
		check_ajax_referer( 'online-newspaper-nonce', '_wpnonce' );
		$query_args = ( isset( $_POST[ 'query' ] ) ) ? $_POST[ 'query' ] : [];
		$clicked_button = ( isset( $_POST[ 'clickedButton' ] ) ) ? $_POST[ 'clickedButton' ] : 'load-more';
		$search_page_content = esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'online-newspaper' );
		if( isset( $query_args[ 'before' ] ) ) $query_args[ 'date_query' ] = [ ...$query_args[ 'date_query' ], $query_args[ 'before' ] ];
		if( isset( $query_args[ 'after' ] ) ) $query_args[ 'date_query' ] = [ ...$query_args[ 'date_query' ], $query_args[ 'after' ] ];
		unset( $query_args[ 'before' ] );
		unset( $query_args[ 'after' ] );
		$query_args[ 'posts_per_page' ] =  get_option( 'posts_per_page' );
		$query_args[ 'fields' ] = 'ids';
		$query_args[ 'no_found_rows' ] = true;
		$query_args[ 'update_post_meta_cache' ] = false;
		$query_args[ 'update_post_term_cache' ] = false;
		$instance = new WP_Query( $query_args );
		$success_flag = false;
		if( $instance->have_posts() ) :
			$success_flag = true;
			ob_start();
			if( $instance->max_num_pages === ( $query_args[ 'paged' ] )  ) $res[ 'completed' ] = true;
			while( $instance->have_posts() ) : $instance->the_post();

				get_template_part( 'template-parts/content', 'search' );
				
			endwhile;
			wp_reset_postdata();
			$res = ob_get_clean();
		endif;
		if( ! $success_flag ) $res[ 'message' ] = '<p class="failure-message">'. esc_html( ( $clicked_button === 'load-more' ) ? esc_html__( 'No more results', 'online-newspaper' ) : $search_page_content ) . '</p>';
		$success_flag ? wp_send_json_success( $res ) : wp_send_json_error( $res );
		wp_die();
	}
	add_action( 'wp_ajax_online_newspaper_search_page_ajax_call', 'online_newspaper_search_page_ajax_call' );
	add_action( 'wp_ajax_nopriv_online_newspaper_search_page_ajax_call', 'online_newspaper_search_page_ajax_call' );
endif;

if( ! function_exists( 'online_newspaper_random_post_archive_advertisement_number' ) ) :
    /**
     * Online Newspaper archive ads number
     * 
     * @since 1.0.0
     */
    function online_newspaper_random_post_archive_advertisement_number() {
        $advertisement_repeater = ONP\online_newspaper_get_customizer_option( 'advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $random_post_archive_advertisement = array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_random_post_archives' ) ) return ( $element->item_checkbox_random_post_archives == true && $element->item_option == 'show' ) ? $element : ''; 
        });
        return sizeof( $random_post_archive_advertisement );
    }
 endif;

if( ! function_exists( 'online_newspaper_algorithm_to_push_ads_in_archive' ) ) :
	/**
	 * Algorithm to push ads into archive
	 * 
	 * @since 1.0.0
	 */
	function online_newspaper_algorithm_to_push_ads_in_archive( $args = [] ) {
		global $wp_query;
		$archive_ads_number = online_newspaper_random_post_archive_advertisement_number();
		if( $archive_ads_number <= 0 ) return;
		if( empty( $args ) ) :
			$max_number_of_pages = absint( $wp_query->max_num_pages );
			$paged = absint( ( get_query_var( 'paged' ) == 0 ) ? 0 : ( get_query_var( 'paged' ) - 1 ) );
		else:
			if( ( $args['paged'] - 1 ) == $archive_ads_number ) return;
			$max_number_of_pages = absint( $args['max_number_of_pages'] );
			$paged = absint( $args['paged'] - 1 );
		endif;
		$count = 1;
		$ads_id = 0;
		$loop_var = 0;
		for( $i = $archive_ads_number ; $i > 0; $i-- ) :
			if( $count <= $max_number_of_pages ):
				$ads_to_render_in_a_single_page = ceil( $i / $max_number_of_pages );
				$ads_to_render = [];
				if( $ads_to_render_in_a_single_page > 1 ) :
					$to_loop = $ads_id + $ads_to_render_in_a_single_page;
					for( $j = $ads_id; $j < $to_loop; $j++ ) :
						if( ! in_array( $ads_id, $ads_to_render ) ) $ads_to_render[] = $ads_id;
						$ads_id++;
					endfor;
					$ads_to_render_in_current_page[$loop_var] = $ads_to_render;
				else:
					$ads_to_render_in_current_page[$loop_var] = $ads_id;
					$ads_id++;
				endif;
				$count++;
				$loop_var++;
			endif;
		endfor;
		$current_page_count = empty( $args ) ? absint( $wp_query->post_count ) : absint( $args['post_count'] );
		$ads_of_current_page = array_key_exists( $paged, $ads_to_render_in_current_page ) ? $ads_to_render_in_current_page[$paged] : null;
		$ads_count = is_array( $ads_of_current_page ) ? sizeof( $ads_of_current_page ) : 1;
		$random_numbers = [];
		for( $i = 0; $i < $ads_count; $i++ ) :
			if( ! in_array( $i, $random_numbers ) ) :
				$random_numbers[] = rand( 0, ( $current_page_count - 1 ) );
			else:
				$random_numbers[] = rand( 0, ( $current_page_count - 1 ) );
			endif;
		endfor;
		return [
			'random_numbers'	=>	$random_numbers,
			'ads_to_render'	=>	$ads_of_current_page
		];
	}
 endif;

if( ! function_exists( 'online_newspaper_random_post_archive_advertisement_part' ) ) :
    /**
     * Online Newspaper random advertisement in archive part
     * 
     * @since 1.0.0
     */
    function online_newspaper_random_post_archive_advertisement_part( $ads_rendered ) {
		if( is_null( $ads_rendered ) ) return;
        $advertisement_repeater = ONP\online_newspaper_get_customizer_option( 'advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $random_post_archive_advertisement = array_values(array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_random_post_archives' ) ) return ( $element->item_checkbox_random_post_archives == true && $element->item_option == 'show' ) ? $element : ''; 
        }));
        if( empty( $random_post_archive_advertisement ) ) return;
        $image_option = array_column( $random_post_archive_advertisement, 'item_image_option' );
        $alignment = array_column( $random_post_archive_advertisement, 'item_alignment' );
        $elementClass = 'alignment--' . $alignment[0];
        $elementClass .= ' image-option--' . ( ( $image_option[0] == 'full_width' ) ? 'full-width' : 'original' );
        ?>
            <div class="online-newspaper-advertisement-block post <?php echo esc_html( $elementClass ); ?>">
                <a href="<?php echo esc_url( $random_post_archive_advertisement[$ads_rendered]->item_url ); ?>" target="<?php echo esc_attr( $random_post_archive_advertisement[$ads_rendered]->item_target ); ?>" rel="<?php echo esc_attr( $random_post_archive_advertisement[$ads_rendered]->item_rel_attribute ); ?>">
                    <img src="<?php echo esc_url( wp_get_attachment_image_url( $random_post_archive_advertisement[$ads_rendered]->item_image, 'full' ) ); ?>" loading="lazy">
                </a>
            </div>
        <?php
    }
 endif;

if( ! function_exists( 'online_newspaper_check_youtube_api_key' ) ) :
	/**
	 * function to check whether the api key is valid or not
	 * 
	 * @since 1.0.0
	 * @package Online Newspaper
	 */
	function online_newspaper_check_youtube_api_key( $api_key ) {
		$api_url = "https://www.googleapis.com/youtube/v3/videos?key=" . $api_key . "&part=snippet,contentDetails";
        $remote_get_video_info = wp_remote_get( $api_url );
		return $remote_get_video_info;
	}
endif;

 if( ! function_exists( 'online_newspaper_get_current_page_sidebar' ) ) :
	/**
	 * Get archive meta
	 * 
	 * @since 1.0.0
	 */
 	function online_newspaper_get_current_page_sidebar() {
		$current_id = get_queried_object_id();
		$sidebar_meta_key = '';
		if( is_category() ) :
			$sidebar_meta_key = '_online_newspaper_category_sidebar_custom_meta_field';
		elseif( is_tag() ) :
			$sidebar_meta_key = '_online_newspaper_post_tag_sidebar_custom_meta_field';
		elseif( is_single() ) :
			$sidebar_meta_key = 'post_sidebar_layout';
		elseif( is_page() ) :
			$sidebar_meta_key = 'post_sidebar_layout';
		else:
			return 'customizer-setting';
		endif;

		if( is_category() || is_tag() ) $sidebar_layout_meta = metadata_exists( 'term', $current_id, $sidebar_meta_key ) ? get_term_meta( $current_id, $sidebar_meta_key, true ) : 'customizer-setting';
		if( is_single() || is_page() ) $sidebar_layout_meta = metadata_exists( 'post', $current_id, $sidebar_meta_key ) ? get_post_meta( $current_id, $sidebar_meta_key, true ) : 'customizer-setting';
		return $sidebar_layout_meta;
	}
 endif;

  if( ! function_exists( 'online_newspaper_get_nonce' ) ) {
 	/**
	 * Get nonce 
	 * 
	 * @since 1.0.6
	 */
	function online_newspaper_get_nonce() {
		wp_send_json_success([
			'nonce' => wp_create_nonce( 'online-newspaper-nonce' )
		]);
	}
	add_action( 'wp_ajax_online_newspaper_get_nonce', 'online_newspaper_get_nonce');
	add_action( 'wp_ajax_nopriv_online_newspaper_get_nonce', 'online_newspaper_get_nonce' );
 }