<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
							<section class="error-404 not-found">
								<?php
									/**
									 * hook - online_newspaper_before_inner_content
									 * 
									 */
									do_action( 'online_newspaper_before_inner_content' );
								?>
								<div class="post-inner-wrapper online-newspaper-card">
									<header class="page-header">
										<h1 class="page-title online-newspaper-block-title"><?php echo esc_html__( 'Oops! That page can\'t be found.', 'online-newspaper' ); ?></h1>
									</header><!-- .page-header -->

									<div class="page-content">
										<?php
											$error_page_image = ONP\online_newspaper_get_customizer_option( 'error_page_image' );
											if( $error_page_image != 0 ) {
												echo wp_get_attachment_image( $error_page_image, 'full' );
											} 
										?>
										<p><?php echo esc_textarea( 'It looks like nothing was found at this location. Maybe try another search?' ); ?></p>
									</div><!-- .page-content -->

									<div class="page-footer">
										<a class="button-404" href="<?php echo esc_url( home_url() ); ?>">
											<?php
												echo online_newspaper_get_icon_control_html([ 'type' => 'icon', 'value' => 'fa-solid fa-tent-arrow-turn-left' ]);
												
												echo '<span class="button-label">'. esc_html__( 'Go back to home', 'online-newspaper' ) .'</span>';
											?>
										</a>	
									</div>
								</div><!-- .post-inner-wrapper -->
							</section><!-- .error-404 -->
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
