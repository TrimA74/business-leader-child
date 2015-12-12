<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Business Leader
 */
?>

	</div><!-- #content -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php get_sidebar( 'footer' ); ?>
		<div id="footer" class="site-info">
			Optimisé pour Chrome et Firefox
			<?php printf( '&copy; %1$s <a href="%2$s" rel="site url">%3$s</a>', date("Y"), get_site_url(), get_bloginfo('name') ); ?>
		</div><!-- .site-info -->
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>