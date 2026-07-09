<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Online Newspaper
 */
use OnlineNewspaper\CustomizerDefault as ONP;
?>
<section class="no-results not-found">
	<header class="page-header">
		<?php if( is_search() ) : ?>
			<h1 class="page-title online-newspaper-block-title">
				<?php echo esc_html( str_replace( '%key%', get_search_query(), sprintf( esc_html__( 'Nothing Found for - %1s', 'online-newspaper' ), '%key%' ) ) ); ?>
			</h1>
		<?php else : ?>
			<h1 class="page-title online-newspaper-block-title"><?php echo esc_html__( 'Nothing Found', 'online-newspaper' ); ?></h1>
		<?php  endif;  ?>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :
			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'online-newspaper' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);
		elseif ( is_search() ) :
			$search_page_content = esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'online-newspaper' );
			?>
			<p><?php echo esc_textarea( $search_page_content ); ?></p>
			<?php
			get_search_form();

		else :
			?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'online-newspaper' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
