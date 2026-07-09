<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Online Newspaper
 */
use OnlineNewspaper\CustomizerDefault as ONP;
$single_layout = ONP\online_newspaper_get_customizer_option( 'single_layout' );
$single_layout_meta = ( metadata_exists( 'post', get_the_ID(), 'single_layout' ) ) ? get_post_meta( get_the_ID(), 'single_layout', true ) : 'customizer-layout';
$is_customizer_layout = ( $single_layout_meta === 'customizer-layout' );
$args['single_layout'] = $is_customizer_layout ? $single_layout : $single_layout_meta;
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

					<?php if( in_array( $args[ 'single_layout' ], [ 'two', 'four', 'five' ] ) ) online_newspaper_single_layout_part(); ?>

					<div class="row">
						<div class="secondary-left-sidebar">
							<?php get_sidebar('left'); ?>
						</div>
						<div class="primary-content">
							<?php
								/**
								 * hook - online_newspaper_before_inner_content
								 * 
								 */
								do_action( 'online_newspaper_before_inner_content' );
							?>
							<div class="post-inner-wrapper">
								<?php
									while ( have_posts() ) : the_post();

										// get template parts
										get_template_part( 'template-parts/content', 'single', $args );

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
get_footer();