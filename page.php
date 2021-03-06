<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Business Leader
 */
//Construction site acces
 session_start();

if($_SESSION["construction_login_admin"] != "connecte"){
	header('Location: http://meythet-capaci.com/wp-content/themes/business-leader-child/construction.php');
}
 
get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php 


if( is_front_page() ){
	get_sidebar('sidebar-1');	
}
else{
	
	get_sidebar('page');
}
?>
<?php get_footer(); ?>