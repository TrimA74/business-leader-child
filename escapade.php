<?php
/**
 * Template Name: Escapades
 *
 * @package WordPress
 * @subpackage business-leader
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


			 <?php $loop = new WP_Query( array( 'post_type' => 'reservation', 'category_name' => 'Escapades' ) ); 

			 while ( $loop->have_posts() ) : $loop->the_post(); 

			     //the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' ); 
			 		if ( 'aside' == get_post_format() ) {
						get_template_part( 'partials/content', 'aside' );
					}
					else {
						get_template_part( 'content', get_post_format() );
					}

			 endwhile; 

			 	?>
			

			

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