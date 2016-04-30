<?php
/**
 * Template Name: Activation
 *
 * @package WordPress
 * @subpackage business-leader
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


			 
			

			    <p id="valid_confirm">Bienvenue sur le site du Comité de Jumelage de Meythet-Capaci, votre inscription a bien été validée, vous pouvez dès à présent vous connecter :</p>
               <?php echo '</br><p><center><input style="text-align:center;" type="button" id="con_resa" value="se connecter"/></center></p>';?>
               
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if( is_front_page() ){
	get_sidebar('sidebar-1');	
}
else{
	
	get_sidebar('page');
} ?>
<?php get_footer(); ?>