<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BokMcDok
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<p>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s', 'bokmcdok' ), '<a href="https://github.com/doc-bok/bokmcdok-theme">bokmcdok</a>', '<a href="http://www.bokmcdok.com/about-me/">Doc Bok</a>' );
				?>
			</p>
			<p>
				<?php
				printf( esc_html__( '(c) 2012-2023 %1$s', 'bokmcdok' ), '<a href="http://www.bokmcdok.com/about-me/">Doc Bok</a>' );
				?>				
			</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
