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
		<nav>
			<?php 
			wp_nav_menu(
				array(
					'theme_location' => 'navigation-menu',
					'menu_id' => 'footer-navigation',
					'depth' => 1,
				)
			);
			?>
		</nav>
		<div class="site-info">
			<?php
				printf( esc_html__( '© Copyright %d %s', 'jape' ), '2022', get_bloginfo( 'name' ) );
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
