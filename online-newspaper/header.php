<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Online Newspaper
 */
use OnlineNewspaper\CustomizerDefault as ONP;
require get_template_directory() . '/builder/responsive-header.php';
use Online_Newspaper_Builder as ONB;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo ( ( is_home() || is_front_page() || is_404() || is_search() ) ? get_bloginfo( 'description' ) : get_the_excerpt() ); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php online_newspaper_schema_body_attributes(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'online-newspaper' ); ?></a>
	<div class="online_newspaper_ovelay_div"></div>
	<?php
		/**
		 * hook - online_newspaper_page_prepend_hook
		 * 
		 * @package Online Newspaper
		 * @since 1.0.0
		 */
		do_action( "online_newspaper_page_prepend_hook" );

		$headerClass = 'site-header ' . ONP\online_newspaper_get_customizer_option( 'header_builder_section_width' );
	?>
	
	<header id="masthead" class="<?php echo esc_html( $headerClass ); ?>">
		<?php
			new ONB\Header_Builder_Render();
			new ONB\Responsive_Header_Builder_Render();
			echo '<div class="search-form-wrap hide">';
			get_search_form();
			echo '</div>';
		?>
	</header><!-- #masthead -->
	
	<?php

	if( is_single() ) online_newspaper_breadcrumb_html();

	/**
	* hook - online_newspaper_sticky_posts_hook
	* 
	* @hooked - online_newspaper_sticky_posts_html - 10
	*/
	if( has_action( 'online_newspaper_sticky_posts_hook' ) ) do_action( 'online_newspaper_sticky_posts_hook' );