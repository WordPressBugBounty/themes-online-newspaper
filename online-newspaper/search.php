<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Online Newspaper
 */
use OnlineNewspaper\CustomizerDefault as ONP;
get_header();
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
							<div class="news-list layout--two">
								<?php
									/**
									 * hook - online_newspaper_before_inner_content
									 * 
									 */
									do_action( 'online_newspaper_before_inner_content' );
									
									if ( have_posts() ) :
										?>
											<header class="page-header">
												<h1 class="page-title online-newspaper-block-title">
													<?php
														$prefix = '<span class="search-page-title-prefix">'. esc_html__( 'Search Results for', 'online-newspaper' ) .'</span>';
														/* translators: %s: search query. */
														printf( esc_html( '%s %s' ), $prefix, '<span class="search-page-title-suffix">' . get_search_query() . '</span>' );
													?>
												</h1>
											</header><!-- .page-header -->
											<?php 
												echo '<div class="online-newspaper-search-page">', get_search_form(), '</div>';
												online_newspaper_search_query_section();
											?>
											<div class="post-inner-wrapper">
												<div class="news-list-wrap column--one">
													<?php
														/* Start the Loop */
														while ( have_posts() ) :
															the_post();
															/**
															 * Run the loop for the search to output the results.
															 * If you want to overload this in a child theme then include a file
															 * called content-search.php and that will be used instead.
															 */
															get_template_part( 'template-parts/content', 'search' );

														endwhile;
													?>
												</div>
												<?php
													if( have_posts() ) :
														echo '<div class="pagination"><button class="ajax-load-more">', esc_html__( 'Load More', 'online-newspaper' ), '</button></div>';
													endif;
												?>
											</div>
										<?php
									else :
										get_template_part( 'template-parts/content', 'none' );
									endif;
								?>
							</div>
						</div>
						<div class="secondary-sidebar">
							<?php get_sidebar(); ?>
						</div>
					</div>
				</div>
			</main><!-- #main -->
			<?php get_sidebar(); ?>
		</div><!-- #theme-content -->
	<?php
get_footer();
