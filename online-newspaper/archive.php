<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Online Newspaper
 */
use OnlineNewspaper\CustomizerDefault as ONP;
get_header();
$args['archive_post_element_order'] = json_decode( ONP\online_newspaper_get_customizer_option( 'archive_post_element_order' ), true );
$newListWrapClass = 'post-inner-wrapper news-list-wrap ' . implode( '-', array_keys( $args['archive_post_element_order'] ) );
$archive_card_enable = ONP\online_newspaper_get_customizer_option( 'archive_card_enable' );
$sectionClass[] = 'theme-content';
$sectionClass[] = 'card--' . ( $archive_card_enable ? 'on': 'off' );
	?>
		<div id="theme-content" class="<?php echo esc_attr( implode( ' ', $sectionClass ) ); ?>">
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
								
								if ( have_posts() ) : ?>
								<div class="<?php echo esc_attr( $newListWrapClass ); ?>">
									<header class="page-header">
										<?php
											if( ! is_author() ) :
												the_archive_title( '<h1 class="page-title online-newspaper-block-title">', '</h1>' );
												the_archive_description( '<div class="archive-description">', '</div>' );
											endif;
										?>
									</header><!-- .page-header -->
									<?php
										
										$args['archive_post_meta_order'] = json_decode( ONP\online_newspaper_get_customizer_option( 'archive_post_meta_order' ), true );
										$args['archive_page_category_option'] = ONP\online_newspaper_get_customizer_option( 'archive_page_category_option' );
										$args['archive_image_size'] = ONP\online_newspaper_get_customizer_option( 'archive_image_size' );
										add_filter( 'excerpt_length', 'online_newspaper_archive_excerpt_length', 999 );
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
										remove_filter( 'excerpt_length', 'online_newspaper_archive_excerpt_length', 999 );
									else :
										get_template_part( 'template-parts/content', 'none' );
									endif;
									?>
								</div>
								<?php
									if( have_posts() ) :
										/**
										 * hook - online_newspaper_pagination_link_hook
										 * 
										 * @package Online Newspaper
										 * @since 1.0.0
										 */
										do_action( 'online_newspaper_pagination_link_hook' );
									endif;
								?>
						</div>
						<div class="secondary-sidebar">
							<?php
								get_sidebar();
							?>
						</div>
					</div>
				</div>
			</main><!-- #main -->
		</div><!-- #theme-content -->
	<?php
get_footer();