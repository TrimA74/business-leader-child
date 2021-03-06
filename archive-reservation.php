<?php
/**
 * The template for displaying Archive pages.
 *
 * 
 *
 * @package Business Leader
 */

get_header(); ?>
    
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					if ( 'aside' == get_post_format() ) {
						get_template_part( 'partials/content', 'aside' );
					}
					else {
						get_template_part( 'content', get_post_format() );
					}
				?>

			<?php endwhile; ?>

			<?php bus_leader_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'partials/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php if( is_front_page() ){
	get_sidebar('sidebar-1');	
}
else{
	
	get_sidebar('page');
} ?>
<?php get_footer(); ?>
