<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Online Newspaper
 */
use OnlineNewspaper\CustomizerDefault as ONP;
$single_layout = $args['single_layout'];
?>
<article <?php online_newspaper_schema_article_attributes(); ?> id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner online-newspaper-card">
		<?php
			if( ! in_array( $single_layout, [ 'two', 'four', 'five' ] ) ) online_newspaper_single_layout_part();
			if( in_array( $single_layout, [ 'five' ] ) ) :
				$single_post_image_caption = ONP\online_newspaper_get_customizer_option( 'single_post_image_caption' );
				$single_post_show_original_image_option = ONP\online_newspaper_get_customizer_option( 'single_post_show_original_image_option' );
				online_newspaper_post_thumbnail( $single_post_show_original_image_option, $single_post_image_caption );
			endif;
		?>

		<div <?php online_newspaper_schema_article_body_attributes(); ?> class="entry-content">
			<?php
				do_action( 'online_newspaper_before_single_content_hook' );
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'online-newspaper' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);
				do_action( 'online_newspaper_after_single_content_hook' );

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'online-newspaper' ),
						'after'  => '</div>',
					)
				);
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php online_newspaper_tags_list(); ?>
			<?php online_newspaper_entry_footer(); ?>
		</footer><!-- .entry-footer -->
		<?php
			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle"><i class="fas fa-angle-double-left"></i>' . esc_html__( 'Previous:', 'online-newspaper' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'online-newspaper' ) . '<i class="fas fa-angle-double-right"></i></span> <span class="nav-title">%title</span>',
				)
			);
		?>
	</div>
	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php
	/**
	 * hook - online_newspaper_single_post_append_hook
	 * 
	 */
	do_action( 'online_newspaper_single_post_append_hook' );
?>