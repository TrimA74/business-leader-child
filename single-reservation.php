<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Business Leader
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
                $etat_resa1 = get_post_custom_values('_etat_resa', $post_id);
            


			 if(!is_user_logged_in()){
				
				     if($etat_resa1[0] == "cloture"){
		            	echo '<h2 class="idtitrenoIns">Cette réservation est cloturée</h2>';
		            }else{
		            	echo '<h2 class="idtitrenoIns">Vous devez être inscrit pour pouvoir réserver votre séjour</h2>';
		            	echo '<center><button style="text-align:center;" type="button" id="con_resa" value="se connecter">Connexion</button>';
		            	echo '<button style="text-align:center;" type="button" id="ins_resa" value="sinscrire" href="'.do_shortcode( '[formlightbox title="" text="Inscription"]
					[cfp id="62" title="Sans titre" pwd="insPasswd"][/formlightbox]').'</button></center>';
		            }
		    }?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'partials/content', 'single' ); ?>

			<?php bus_leader_post_nav(); ?>

			<?php
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			
			
		
			
				if(is_user_logged_in()){
				global $wpdb;
				$post_id = get_the_ID();
				$current_user = wp_get_current_user();
				$id_user = $current_user->ID;
				$nbplace_adulte = get_post_custom_values('_nb_place', $post_id);
				$nbplace_enfant = get_post_custom_values('_nb_place_enf', $post_id);
				
				$query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}reservation WHERE id_evenement = $post_id AND id_participant = $id_user");
				$etat_resa = get_post_custom_values('_etat_resa', $post_id);
				
				     if($etat_resa[0] == "cloture"){
		            	echo '<h2 class="idtitrenoIns">Cette réservation est cloturée</h2>';
		             }elseif($etat_resa[0] == "ouvert"){
						if(count($query) != 0){
							
							echo '<div id="annul_resa_div" class="annul_resa_div">';
							echo '<form class="annul_resa_form">';
							echo '<h2>Vous avez déjà réservé !</h2>';
							echo '<input name="post_id" type="hidden" value="'.$post_id.'"/>';
							echo '<input name="user_id" type="hidden" value="'.$id_user.'"/>';
							echo '<input type="submit" name="resa_submit2" value="Annuler ma réservation"/>';
							echo ' </form>';
							echo '</div>';
						}else{
							echo '<div id="resa_div_id" class="resa_div">';
							echo '<h1>Ma réservation</h1>';
							echo '<form class="resa_form">';
								echo '<label for ="pl_adulte">Place Adultes</label>';
								echo '<input type="number" name="pl_adulte" min="0" max="'.$nbplace_adulte[0].'"  placeholder="0"/>';
								echo '<label for ="pl_enfant">Place Enfants</label>';
								echo '<input type="number" name="pl_enfant" min="0" max="'.$nbplace_enfant[0].'"  placeholder="0"/>';
								echo '<input name="post_id" type="hidden" value="'.$post_id.'"/>';
								echo '<input type="submit" name="resa_submit"/>';
						  	echo ' </form>';
						    echo '<p>Prix Total : <span id="price_span"><span>€</p>';
						    echo '</div>';
						}
				      }else{
				        	echo '<h2 class="idtitrenoIns">Les réservations effectuées sur cet évènement seront placées en liste d\'attente</h2>';
				            echo '<div id="resa_div_id" class="resa_div">';
							echo '<h1>Ma réservation</h1>';
							echo '<form class="resa_form">';
								echo '<label for ="pl_adulte">Place Adultes</label>';
								echo '<input type="number" name="pl_adulte" min="0" max="'.$nbplace_adulte[0].'"  placeholder="0"/>';
								echo '<label for ="pl_enfant">Place Enfants</label>';
								echo '<input type="number" name="pl_enfant" min="0" max="'.$nbplace_enfant[0].'"  placeholder="0"/>';
								echo '<input name="post_id" type="hidden" value="'.$post_id.'"/>';
								echo '<input type="submit" name="resa_submit"/>';
						  	echo ' </form>';
						    echo '<p>Prix Total : <span id="price_span"><span>€</p>';
						    echo '</div>';
				      }
				   }

				 ?> 
				 
				

			
			

		<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>