<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jape
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<?php
				printf( esc_html__( '© Copyright %d %s', 'jape' ), '2022', get_bloginfo( 'name' ) );
			?>
			<span class="sep"> | </span>
				<?php
				$the_theme = wp_get_theme();
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'jape' ), esc_html( $the_theme->get( 'Name' ) ), '<a href="' . esc_attr( $the_theme->get( 'AuthorURI' ) ) . '">' . esc_html( $the_theme->get( 'Author' ) ) . '</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
