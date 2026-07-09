<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Online Newspaper
 */
use OnlineNewspaper\CustomizerDefault as ONP;
$args[ 'page_show_original_image_option' ] = ONP\online_newspaper_get_customizer_option( 'page_show_original_image_option' );
$args[ 'page_image_caption' ] = ONP\online_newspaper_get_customizer_option( 'page_image_caption' );
get_header();
	if( is_front_page() ) :

		$homepage_content_order = json_decode( ONP\online_newspaper_get_customizer_option( 'homepage_content_order' ), true );
		foreach( $homepage_content_order as $content_order_key => $content_order ) :
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
								do_action( 'online_newspaper_full_width_blocks_hook' );
							break;
					case "leftc_rights_section": 
								/**
								 * hook - online_newspaper_leftc_rights_blocks_hook
								 * 
								 * hooked- online_newspaper_leftc_rights_blocks_part
								 * @since 1.0.0
								 * 
								 */
								do_action( 'online_newspaper_leftc_rights_blocks_hook' );
							break;
					case "lefts_rightc_section": 
								/**
								 * hook - online_newspaper_lefts_rightc_blocks_hook
								 * 
								 * hooked- online_newspaper_lefts_rightc_blocks_part
								 * @since 1.0.0
								 * 
								 */
								do_action( 'online_newspaper_lefts_rightc_blocks_hook' );
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
					case "bottom_full_width_section": 
								/**
								 * hook - online_newspaper_bottom_full_width_blocks_hook
								 * 
								 * hooked- online_newspaper_bottom_full_width_blocks_part
								 * @since 1.0.0
								 * 
								 */
								do_action( 'online_newspaper_bottom_full_width_blocks_hook' );
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
							<?php
								/**
								 * hook - online_newspaper_before_main_content
								 * 
								 */
								do_action( 'online_newspaper_before_main_content' );
							?>
							<main id="primary" class="site-main">
								<div class="online-newspaper-container">
									<div class="row">
									<div class="secondary-left-sidebar">
											<?php
												get_sidebar('left');
											?>
										</div>
										<div class="primary-content">
											<?php
												/**
												 * hook - online_newspaper_before_inner_content
												 * 
												 */
												do_action( 'online_newspaper_before_inner_content' );
											?>
											<div class="post-inner-wrapper online-newspaper-card">
												<?php
													while ( have_posts() ) :
														the_post();

														get_template_part( 'template-parts/content', 'page', $args );

														// If comments are open or we have at least one comment, load up the comment template.
														if ( comments_open() || get_comments_number() ) :
															comments_template();
														endif;

													endwhile; // End of the loop.
												?>
											</div>
										</div>
										<div class="secondary-sidebar">
											<?php get_sidebar(); ?>
										</div>
									</div>
								</div>
							</main><!-- #main -->
						</div><!-- #theme-content -->
					<?php
				}
			endif;
		endforeach;
	else :
		?>
			<div id="theme-content">
				<?php
					/**
					 * hook - online_newspaper_before_main_content
					 * 
					 */
					do_action( 'online_newspaper_before_main_content' );
				?>
				<main id="primary" class="site-main <?php echo esc_attr( 'width-' . online_newspaper_get_section_width_layout_val() ); ?>">
					<div class="online-newspaper-container">
						<div class="row">
						<div class="secondary-left-sidebar">
								<?php
									get_sidebar('left');
								?>
							</div>
							<div class="primary-content">
								<?php
									/**
									 * hook - online_newspaper_before_inner_content
									 * 
									 */
									do_action( 'online_newspaper_before_inner_content' );
								?>
								<div class="post-inner-wrapper online-newspaper-card">
									<?php
										while ( have_posts() ) :
											the_post();

											get_template_part( 'template-parts/content', 'page', $args );

											// If comments are open or we have at least one comment, load up the comment template.
											if ( comments_open() || get_comments_number() ) :
												comments_template();
											endif;

										endwhile; // End of the loop.
										wp_reset_postdata();
									?>
								</div>
							</div>
							<div class="secondary-sidebar">
								<?php get_sidebar(); ?>
							</div>
						</div>
					</div>
				</main><!-- #main -->
			</div><!-- #theme-content -->
		<?php
	endif;
get_footer();
