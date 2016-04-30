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
	<?php if($_GET["lang"]=="it"){
		echo '<p style="color:white;text-align:center;padding-bottom:50px;padding-top: 25px;font-size:12px;">I nostri partenariati</p>';
	}else{
		echo '<p style="color:white;text-align:center;padding-bottom:50px;padding-top: 25px;font-size:12px;">Nos partenariats</p>';
	}
	?>
	<a href="http://www.mairie-meythet.fr/" target="_blank"><img id="meythet_footer_img" src="http://meythet-capaci.com/wp-content/themes/business-leader-child/images/mairie_meythet.png"/></a>
	<a href="http://www.comune.capaci.pa.it/" target="_blank"><img id="capaci_footer_img" src="http://meythet-capaci.com/wp-content/themes/business-leader-child/images/mairie_capaci.png"/></a>
		
		<?php get_sidebar( 'footer' ); ?>
		<div id="footer" class="site-info" align="center">
			<?php if($_GET["lang"]=="it"){
					printf( '&copy; %1$s <a href="%2$s" rel="site url">%3$s</a>', date("Y"), get_site_url(), "Comitato di Gemellaggio - Meythet e Capaci" );
					echo '<a href="http://meythet-capaci.com/mentions-legales/"><p style="color:white;font-size:12px;">Indicazioni Obbligatorie</p></a>';
				  }else{
					printf( '&copy; %1$s <a href="%2$s" rel="site url">%3$s</a>', date("Y"), get_site_url(), "Comité de Jumelage de Meythet et Capaci" );
					echo '<a href="http://meythet-capaci.com/mentions-legales/"><p style="color:white;font-size:12px;">Mentions Légales</p></a>';
				  }
					?>
		</div><!-- .site-info -->
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>