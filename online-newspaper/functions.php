<?php
/**
 * Online Newspaper functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Online Newspaper
 */
use OnlineNewspaper\CustomizerDefault as ONP;
if ( ! defined( 'ONLINE_NEWSPAPER_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	$theme_info = wp_get_theme();
	define( 'ONLINE_NEWSPAPER_VERSION', $theme_info->get( 'Version' ) );
}

if ( ! defined( 'ONLINE_NEWSPAPER_PREFIX' ) ) {
	// Replace the prefix of theme if changed.
	define( 'ONLINE_NEWSPAPER_PREFIX', 'online_newspaper_' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function online_newspaper_setup() {
	$nprefix = 'online-newspaper-';
	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	* If you're building a theme based on Online Newspaper, use a find and replace
	* to change 'online-newspaper' to the name of your theme in all the template files.
	*/
	load_theme_textdomain( 'online-newspaper', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	/*
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support( 'post-thumbnails' );

	// add_image_size( 'online-newspaper-large', 1400, 800, true );
	add_image_size( $nprefix . 'featured', 1020, 700, true );
	add_image_size( $nprefix . 'list', 600, 400, true );
	add_image_size( $nprefix . 'thumb', 300, 200, true );
	add_image_size( $nprefix . 'small', 150, 95, true );
	add_image_size( $nprefix . 'grid', 400, 250, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Top Header', 'online-newspaper' ),
			'menu-2' => esc_html__( 'Main Header', 'online-newspaper' ),
			'menu-3' => esc_html__( 'Bottom Footer', 'online-newspaper' )
		)
	);

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			ONLINE_NEWSPAPER_VERSION . 'custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 100,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'online_newspaper_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function online_newspaper_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'online_newspaper_content_width', 640 );
}
add_action( 'after_setup_theme', 'online_newspaper_content_width', 0 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Cache Manager
 */
require get_template_directory() . '/inc/managers/class-cache-manager.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/builder/base.php';

add_filter( 'get_the_archive_title_prefix', 'online_newspaper_prefix_string' );
function online_newspaper_prefix_string($prefix) {
	$archive_page_title_prefix = ONP\online_newspaper_get_customizer_option( 'archive_page_title_prefix' );
	if( $archive_page_title_prefix ) return apply_filters( 'online_newspaper_archive_page_title_prefix', $prefix );
	return apply_filters( 'online_newspaper_archive_page_title_prefix', false );
}

/**
 * Defer non critical css to prevent css files from blocking render
 * 
 * @param string $html The html tag
 * @param string $handle Tag handle
 * @since 1.0.0
 */
add_filter( 'style_loader_tag', function( $html, $handle ) {
	if( in_array( $handle, [ 'fontawesome', 'slick', 'magnific-popup', 'online-newspaper-typo-fonts', 'online-newspaper-main-style-additional', 'online-newspaper-responsive-style', 'jquery-ui' ] ) ) {
		$async = str_replace( "media='print'", "media='print' onload=\"this.media='all'\"", $html );
		$async .= "<noscript>$html</noscript>";
		return $async;
	}
	return $html;
}, 10, 2 );

if( ! function_exists( 'online_newspaper_preconnect_to_google_fonts' ) ) {
	/**
	 * Preconnect to google links to fetch font families
	 * 
	 * @since 1.0.0
	 */
	function online_newspaper_preconnect_to_google_fonts() {
		echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
		echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
	}
	add_action( 'wp_head', 'online_newspaper_preconnect_to_google_fonts' , 1 );
}