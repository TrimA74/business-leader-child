<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * @package Business Leader
 */
?>

<?php 

			        $site_url = get_site_url();
			        $current_lang = $_GET['lang'];
			       	$current_get=$_GET;
			        $current_site_url = $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
					$is_connected = is_user_logged_in();
					$logout_link = wp_logout_url(home_url());
			    ?>

<section class="<?php if ( is_404() ) { echo 'error-404'; } else { echo 'no-results'; } ?> not-found">
    <div class="index-box">
    	
  
    	<header class="entry-header">
    		<h1 class="entry-title">
                        <?php 
					
                        if ( is_404() ) { _e( 'Page Non Disponible', 'bus_leader' ); }
                        else if ( is_search() ) { printf( __( 'Page Vide %s', 'bus_leader' ), '<em>' . get_search_query() . '</em>' ); }
                        else { _e( 'Page Non Disponible', 'bus_leader' ); }
                        ?>
                    </h1>
    	</header>

    	<div class="entry-content">
    		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

    			<p><?php printf( __( 'Prêt à rédiger votre premier message? <a href="%1$s">Commencer Ici</a>.', 'bus_leader' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
                            
                    <?php elseif ( is_404() ) : ?>
                            
                            <p><?php _e( 'Désolé,  cette page n\'est pas disponible. Essayez une recherche:', 'bus_leader' ); ?></p>
                            <?php get_search_form(); ?>
                            
    		<?php elseif ( is_search() ) : ?>

    			<p><?php _e( 'Désolé, la recherche n\'a rien retourné. Essayer une autre recherche :', 'bus_leader' ); ?></p>
    			<?php get_search_form(); ?>

    		<?php else : ?>

    			<p><?php if($current_lang = "fr") {_e( 'Désolé, rien n\'a été trouvé, lancer une nouvelle recherche : ', 'bus_leader' );} else {_e( 'gitano !!!!, rien n\'a été trouvé, lancer une nouvelle recherche : ', 'bus_leader' );} ?></p>
    			<?php get_search_form(); ?>

    		<?php endif; ?>
    	</div><!-- .entry-content -->
    </div><!-- .index-box -->
    
    <?php
    if ( is_404() || is_search() ) {
        
        ?>
    <div class="index-box index-page-header">
        <header class="page-header"><h1 class="page-title">Articles récents</h1></header>
    </div><!-- .index-box -->

        
       <?php wp_reset_postdata();}?>

   
    
</section><!-- .no-results -->
