<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Online Newspaper
 */
use OnlineNewspaper\CustomizerDefault as ONP;
get_header();

$homepage_content_order = json_decode( ONP\online_newspaper_get_customizer_option( 'homepage_content_order' ), true );
foreach( $homepage_content_order as $content_order_key => $content_order ) :
	if( $content_order_key == 'latest_posts' && is_home() && ! is_front_page()  ) $content_order = true;
	if( $content_order ) :
		switch( $content_order_key ) {
			case "main_banner_section": 
								/**
								 * hook - online_newspaper_main_banner_hook
								 * 
								 * hooked- online_newspaper_main_banner_part
								 * @since 1.0.0
								 * 
								 */
								if( is_home() && is_front_page() ) do_action( 'online_newspaper_main_banner_hook' );
							break;
			case "web_stories_section": 
								/**
								 * hook - online_newspaper_web_stories_hook
								 * 
								 * hooked- online_newspaper_web_stories_html
								 * @since 1.0.0
								 * 
								 */
								if( is_home() && is_front_page() ) do_action( 'online_newspaper_web_stories_hook' );
							break;
			case "full_width_section": 
								/**
								 * hook - online_newspaper_full_width_blocks_hook
								 * 
								 * hooked- online_newspaper_full_width_blocks_part
								 * @since 1.0.0
								 * 
								 */
								if( is_home() && is_front_page() ) do_action( 'online_newspaper_full_width_blocks_hook' );
							break;
			case "leftc_rights_section": 
								/**
								 * hook - online_newspaper_leftc_rights_blocks_hook
								 * 
								 * hooked- online_newspaper_leftc_rights_blocks_part
								 * @since 1.0.0
								 * 
								 */
								if( is_home() && is_front_page() ) do_action( 'online_newspaper_leftc_rights_blocks_hook' );
							break;
			case "lefts_rightc_section": 
								/**
								 * hook - online_newspaper_lefts_rightc_blocks_hook
								 * 
								 * hooked- online_newspaper_lefts_rightc_blocks_part
								 * @since 1.0.0
								 * 
								 */
								if( is_home() && is_front_page() ) do_action( 'online_newspaper_lefts_rightc_blocks_hook' );
							break;
			case "bottom_full_width_section": 
								/**
								 * hook - online_newspaper_bottom_full_width_blocks_hook
								 * 
								 * hooked- online_newspaper_bottom_full_width_blocks_part
								 * @since 1.0.0
								 * 
								 */
								if( is_home() && is_front_page() ) do_action( 'online_newspaper_bottom_full_width_blocks_hook' );
							break;
			case "two_column_section": 
								/**
								 * hook - online_newspaper_two_column_section_hook
								 * 
								 * hooked- online_newspaper_two_column_section_columns_part
								 * @since 1.0.0
								 * 
								 */
								if( is_home() && is_front_page() ) do_action( 'online_newspaper_two_column_section_hook' );
							break;
			case 'ticker_news_section' :
								/**
								 * hook - online_newspaper_ticker_news_hook
								 * 
								 * @hooked - online_newspaper_ticker_news_html - 10
								 */
								$show_ticker = ( has_action( 'online_newspaper_ticker_news_hook' ) && is_home() && is_front_page() && ONP\online_newspaper_get_customizer_option('ticker_news_frontpage' ) );
								$header_ticker_news_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'header_builder', 'ticker-news' );
								$hr_ticker_news_option = \Online_Newspaper_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'ticker-news' );
								if( $show_ticker && ( $header_ticker_news_option || $hr_ticker_news_option ) ) do_action( 'online_newspaper_ticker_news_hook' );
							break;
			default: 
				$archive_card_enable = ONP\online_newspaper_get_customizer_option( 'archive_card_enable' );
				$theme_content_class[] = 'card--' . ( $archive_card_enable ? 'on' : 'off' );
				?>
					<div id="theme-content" class="<?php echo esc_attr( implode( ' ', $theme_content_class ) ); ?>">
						<main id="primary" class="site-main <?php echo esc_attr( 'width-' . online_newspaper_get_section_width_layout_val() ); ?>">
							<div class="online-newspaper-container">
                    			<div class="row">
									<div class="secondary-left-sidebar">
										<?php get_sidebar('left'); ?>
									</div>
                    				<div class="primary-content">
										<?php
											if ( have_posts() ) :
												$args['archive_post_element_order'] = json_decode( ONP\online_newspaper_get_customizer_option( 'archive_post_element_order' ), true );
												$newListWrapClass = 'news-list-wrap ' . implode( '-', array_keys( $args['archive_post_element_order'] ) );
												if ( is_home() && ! is_front_page() ) :
													?>
													<header>
														<h1 class="page-title online-newspaper-block-title screen-reader-text"><?php single_post_title(); ?></h1>
													</header>
													<?php
												endif;
												$args['archive_post_meta_order'] = json_decode( ONP\online_newspaper_get_customizer_option( 'archive_post_meta_order' ), true );
												$args['archive_page_category_option'] = ONP\online_newspaper_get_customizer_option( 'archive_page_category_option' );
												$args['archive_image_size'] = ONP\online_newspaper_get_customizer_option( 'archive_image_size' );
												add_filter( 'excerpt_length', 'online_newspaper_archive_excerpt_length', 999 );
												echo '<div class="', esc_attr( $newListWrapClass ) ,'">';
												$ads_info = online_newspaper_algorithm_to_push_ads_in_archive();
												$count = 0;
													/* Start the Loop */
													while ( have_posts() ) :
														the_post();
														if( ! is_null( $ads_info ) ) :
															if( in_array( $wp_query->current_post, $ads_info['random_numbers'] ) ) :
																online_newspaper_random_post_archive_advertisement_part( is_array( $ads_info['ads_to_render'] ) ? $ads_info['ads_to_render'][$count] : $ads_info['ads_to_render'] );
																$count++;
															endif;
														endif;
														/*
														* Include the Post-Type-specific template for the content.
														* If you want to override this in a child theme, then include a file
														* called content-___.php (where ___ is the Post Type name) and that will be used instead.
														*/
														get_template_part( 'template-parts/content', get_post_type(), $args );
													endwhile;
												echo '</div>';
												/**
												 * hook - online_newspaper_pagination_link_hook
												 * 
												 * @package Online Newspaper
												 * @since 1.0.0
												 */
												do_action( 'online_newspaper_pagination_link_hook' );
												remove_filter( 'excerpt_length', 'online_newspaper_archive_excerpt_length', 999 );
											else :
												get_template_part( 'template-parts/content', 'none' );
											endif;
										?>
									</div>
									<div class="secondary-sidebar">
										<?php
											get_sidebar();
										?>
									</div>
								</div>
							</div> <!-- online-newspaper-container end -->
						</main><!-- #main -->
					</div><!-- #theme-content -->
			<?php
		}
	endif;
endforeach;
get_footer();