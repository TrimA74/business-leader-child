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
		<div id="footer" class="site-info" align="center">
			Optimisé pour Chrome et Firefox
			<?php printf( '&copy; %1$s <a href="%2$s" rel="site url">%3$s</a>', date("Y"), get_site_url(), get_bloginfo('name') ); ?>
			</br></br>
Les informations recueillies sont nécessaires pour votre inscription.</br>

Elles font l’objet d’un traitement informatique et sont destinées au Comité de Jumelage de Meythet-Capaci. En application des articles 39 et suivants de la loi du 6 janvier 1978 modifiée, vous bénéficiez d’un droit d’accès et de rectification aux informations qui vous concernent.</br>

Si vous souhaitez exercer ce droit et obtenir communication des informations vous concernant, veuillez vous adresser à : [your-email] ou modifier directement vos informations via la rubrique "Mon Profil" du site.
		</div><!-- .site-info -->
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>