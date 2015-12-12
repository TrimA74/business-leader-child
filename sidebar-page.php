<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Business Leader
 */




?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php if ( ! dynamic_sidebar( 'page-sidebar' ) ) : ?>

			

			<aside id="meta" class="widget">
				<h1 class="widget-title"><?php _e( 'Meta', 'bus_leader' ); ?></h1>
				<ul>
					
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->
	<?php get_sidebar( 'footer' ); ?>
	
