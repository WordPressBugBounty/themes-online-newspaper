<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Online Newspaper
 */
use OnlineNewspaper\CustomizerDefault as ONP;
require get_template_directory() . '/builder/footer-builder.php';
require get_template_directory() . '/inc/hooks/footer-hooks.php';
use Online_Newspaper_Builder as ONB;

	/**
	* hook - online_newspaper_before_footer_section
	*/
	if( has_action( 'online_newspaper_before_footer_section' ) ) do_action( 'online_newspaper_before_footer_section' );

  $footerClass = 'site-footer ' . ONP\online_newspaper_get_customizer_option( 'footer_builder_section_width' );
?>
	<footer id="colophon" class="<?php echo esc_attr( $footerClass ); ?>">
		<?php
			new ONB\Footer_Builder_Render();
		?>
	</footer><!-- #colophon -->
	<?php
		/**
		* hook - online_newspaper_after_footer_hook
		*
		* @hooked - online_newspaper_scroll_to_top
		*
		*/
		if( has_action( 'online_newspaper_after_footer_hook' ) ) do_action( 'online_newspaper_after_footer_hook' );
	?>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>