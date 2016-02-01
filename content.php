
<?php
/**
 * @package Business Leader
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="index-box">
		<?php
	    if ( has_post_thumbnail() ) {
	        echo '<div class="small-index-thumbnail clear">';
	        echo '<a href="' . get_permalink() . '" title="' . __('Lire L\'article', 'bus_leader') . get_the_title() . '" rel="bookmark">';
	        the_post_thumbnail('index-thumb');
	        echo '</a>';
	        echo '</div><!-- .small-index-thumbnail -->';
	    }
		?>
		<header class="entry-header">
			<?php 

			//gestion affichage voyages et escapades
			$post_type = get_post_type();
			 if($post_type == 'reservation'){
			 	$post_id = get_the_ID();
			 	$etat_resa = get_post_custom_values('_etat_resa', $post_id);
			 	if($etat_resa[0] == 'ouvert'){
			 		$etat = 'Ouvert';
			 		$span_id = 'span_ouv';
			 	}else if($etat_resa[0] == 'cloture'){
	                $etat = 'Cloturé';
	                $span_id = 'span_clot';
			 	}else if($etat_resa[0] == 'file_attente'){
			 		$etat = 'Inscriptions en file d\'attente';
	                $span_id = 'span_filat';
			 	}
			 	the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), ' - <span id="'.$span_id.'">'.$etat.'</span></a></h1>' ); 
			 }else{
			 	the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); 


			 }
			
			?>
			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php bus_leader_posted_on(); ?>
				<?php bus_leader_comments_link(); ?>
				<?php bus_leader_edit_link() ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		

		<footer class="entry-footer read-more">
			<?php echo '<a href="' . get_permalink() . '" title="' . __('Lire l\'article ', 'bus_leader') . get_the_title() . '" rel="bookmark">Voir l\'article<span class="screen-reader-text">  ' . get_the_title() . '</span></a>'; ?>
		</footer><!-- .entry-footer -->
	</div><!-- .index-box -->
</article><!-- #post-## -->
