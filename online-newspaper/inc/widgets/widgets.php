<?php
/**
 * Handle the wigets files and hooks
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function online_newspaper_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'online-newspaper' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'online-newspaper' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title online-newspaper-block-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// left sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Left Sidebar', 'online-newspaper' ),
			'id'            => 'left-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'online-newspaper' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title online-newspaper-block-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// off canvas sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Off Canvas Sidebar', 'online-newspaper' ),
			'id'            => 'off-canvas-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'online-newspaper' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title online-newspaper-block-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// header ads banner sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Ads Banner Sidebar', 'online-newspaper' ),
			'id'            => 'ads-banner-sidebar',
			'description'   => esc_html__( 'Add widgets suitable for displaying ads here.', 'online-newspaper' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title online-newspaper-block-title">',
			'after_title'   => '</h2>',
		)
	);

	// front right sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Frontpage - Middle Right Sidebar', 'online-newspaper' ),
			'id'            => 'front-right-sidebar',
			'description'   => esc_html__( 'Add widgets suitable for middle right here.', 'online-newspaper' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title online-newspaper-block-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// front left sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Frontpage - Middle Left Sidebar', 'online-newspaper' ),
			'id'            => 'front-left-sidebar',
			'description'   => esc_html__( 'Add widgets suitable for middle left here.', 'online-newspaper' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title online-newspaper-block-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// footer sidebar - column 1
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar - Column 1', 'online-newspaper' ),
			'id'            => 'footer-sidebar--column-1',
			'description'   => esc_html__( 'Add widgets here.', 'online-newspaper' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title online-newspaper-block-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// footer sidebar - column 2
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar - Column 2', 'online-newspaper' ),
			'id'            => 'footer-sidebar--column-2',
			'description'   => esc_html__( 'Add widgets here.', 'online-newspaper' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title online-newspaper-block-title"><span>',
			'after_title'   => '</h2>',
		)
	);

	// footer sidebar - column 3
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar - Column 3', 'online-newspaper' ),
			'id'            => 'footer-sidebar--column-3',
			'description'   => esc_html__( 'Add widgets here.', 'online-newspaper' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title online-newspaper-block-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// footer sidebar - column 4
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar - Column 4', 'online-newspaper' ),
			'id'            => 'footer-sidebar--column-4',
			'description'   => esc_html__( 'Add widgets here.', 'online-newspaper' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title online-newspaper-block-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// Header Widget Area
	register_sidebar(
		array(
			'name'          => esc_html__( 'Header Builder Widget Area', 'online-newspaper' ),
			'id'            => 'header-builder-widget-area',
			'description'   => esc_html__( 'Add widgets here.', 'online-newspaper' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title online-newspaper-block-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// Register custom widgets
    register_widget( 'Online_Newspaper_Widget_Title_Widget' ); // custom widget title
	register_widget( 'Online_Newspaper_Posts_List_Widget' ); // post lists widget
	register_widget( 'Online_Newspaper_Posts_Grid_Widget' ); // post grid widget
	register_widget( 'Online_Newspaper_Category_Collection_Widget' ); // category collection widget
	register_widget( 'Online_Newspaper_Author_Info_Widget' ); // author info widget
	register_widget( 'Online_Newspaper_Banner_Ads_Widget' ); // banner ad widget
	register_widget( 'Online_Newspaper_Popular_Posts_Widget' ); // popular posts widget
	register_widget( 'Online_Newspaper_Tabbed_Posts_Widget' ); // tabbed posts widget
	register_widget( 'Online_Newspaper_Carousel_Widget' ); // carousel widget
	register_widget( 'Online_Newspaper_Social_Icons_Widget' ); // social icons widget
	register_widget( 'Online_Newspaper_Posts_Grid_Two_Column_Widget' ); // post grid two column widget
	register_widget( 'Online_Newspaper_News_Filter_Tabbed_Widget' ); // post news filter tabbed widget
	register_widget( 'Online_Newspaper_Ads_Slider_Widget' ); // ads slider widget
}
add_action( 'widgets_init', 'online_newspaper_widgets_init' );

// includes files
require ONLINE_NEWSPAPER_INCLUDES_PATH .'widgets/widget-fields.php';
require ONLINE_NEWSPAPER_INCLUDES_PATH .'widgets/category-collection.php';
require ONLINE_NEWSPAPER_INCLUDES_PATH .'widgets/posts-list.php';
require ONLINE_NEWSPAPER_INCLUDES_PATH .'widgets/posts-grid.php';
require ONLINE_NEWSPAPER_INCLUDES_PATH .'widgets/author-info.php';
require ONLINE_NEWSPAPER_INCLUDES_PATH .'widgets/banner-ads.php';
require ONLINE_NEWSPAPER_INCLUDES_PATH .'widgets/popular-posts.php';
require ONLINE_NEWSPAPER_INCLUDES_PATH .'widgets/tabbed-posts.php';
require ONLINE_NEWSPAPER_INCLUDES_PATH .'widgets/carousel.php';
require ONLINE_NEWSPAPER_INCLUDES_PATH .'widgets/social-icons.php';
require ONLINE_NEWSPAPER_INCLUDES_PATH .'widgets/widget-title.php';
require ONLINE_NEWSPAPER_INCLUDES_PATH .'widgets/posts-grid-two-column.php';
require ONLINE_NEWSPAPER_INCLUDES_PATH .'widgets/news-filter-tabbed.php';
require ONLINE_NEWSPAPER_INCLUDES_PATH .'widgets/banner-ads-slider.php';

function online_newspaper_widget_scripts($hook) {
    if( $hook !== "widgets.php" ) {
        return;
    }
    wp_enqueue_style( 'online-newspaper-widget', get_template_directory_uri() . '/inc/widgets/assets/widgets.css', array(), ONLINE_NEWSPAPER_VERSION );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/lib/fontawesome/css/all.min.css', array(), '6.4.2', 'all' );
	wp_enqueue_media();
	wp_enqueue_script( 'online-newspaper-widget', get_template_directory_uri() . '/inc/widgets/assets/widgets.js', array( 'jquery' ), ONLINE_NEWSPAPER_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'online_newspaper_widget_scripts' );

if( ! function_exists( 'online_newspaper_get_tabbed_icon_classes' ) ) :
	/**
	 * List of icons classes
	 * 
	 * @package Online Newspaper
	 */
	function online_newspaper_get_tabbed_icon_classes() {
		return apply_filters( 'online_newspaper_tabbed_block_icons', array( "fas fa-ban","fas fa-clock","far fa-clock","fas fa-newspaper","far fa-newspaper","fas fa-poll","fas fa-poll-h","fas fa-ban","fas fa-fire","fas fa-fire-alt","fas fa-comments","fas fa-comment-dots","far fa-comment-dots","far fa-comment","far fa-comments","fas fa-comment-alt","far fa-comment-alt" ) );
	}
endif;