<?php
/**
 * The Template for displaying all custom post type 'Reservation'.
 *
 * @package Business Leader
 */

get_header(); 
?>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php 
                $etat_resa1 = get_post_custom_values('_etat_resa', $post_id);
                $nbplace = get_post_custom_values('_nb_place', $post_id);
				echo "<p id='nb_place_p_id'>Nombre de places disponibles : <span id='nb_place_span_id'>".$nbplace[0]."</span></p>";
                
			 if(!is_user_logged_in()){
				
				     if($etat_resa1[0] == "cloture"){
		            	echo '<h2 class="idtitrenoIns">Cet évènement est cloturé</h2>';
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
				  $date_debut = get_post_custom_values('_date_debut',$post_id);
				  $date_fin = get_post_custom_values('_date_fin',$post_id);
				  $nb_place = get_post_custom_values('_nb_place',$post_id);
				  $nb_place_total = get_post_custom_values('_nb_place_total',$post_id);
				  $tarif_adulte = get_post_custom_values('_tarif_adulte',$post_id);
				  $tarif_enfant = get_post_custom_values('_tarif_enfant',$post_id);
				  $tarif_adherent = get_post_custom_values('_tarif_adherent',$post_id);
                ?>
                    <div class="entry-content" id="div_resa_info_gal">
	                    <h1 id="titre_info_resa">Informations Générales</h1>
	                	<form id="form_info_resa">
	                	    </br>
	                	    <div class="div_resa_info">
	                		<label class="lbl_info_resa"> Date de début  </label>
	                		<span class="span_info_resa"><?php echo $date_debut[0] ?></span>
	                	    </div>
	                	     </br>
	                	    <div class="div_resa_info">
	                		<label class="lbl_info_resa"> Date de fin  </label>
	                		<span class="span_info_resa"><?php echo $date_fin[0] ?></span>
	                		</div>
	                		 </br>
	                		<div class="div_resa_info">
	                		<label class="lbl_info_resa"> Nombre de places disponibles  </label>
	                		<span class="span_info_resa"><?php echo $nb_place[0] ?></span>
	                		</div>
	                		 </br>
	                		<div class="div_resa_info">
	                		<label class="lbl_info_resa"> Nombre de places totales  </label>
	                		<span class="span_info_resa"><?php echo $nb_place_total[0] ?></span>
	                		</div>
	                		 </br>
	                		<div class="div_resa_info">
	                		<label class="lbl_info_resa"> Tarif Adultes  </label>
	                		<span class="span_info_resa"><?php echo $tarif_adulte[0] ?> €</span>
	                		</div>
	                		 </br>
	                		<div class="div_resa_info">
	                		<label class="lbl_info_resa"> Tarif Enfants  </label>
	                		<span class="span_info_resa"><?php echo $tarif_enfant[0] ?> €</span>
	                		</div>
	                		 </br>
	                		<div class="div_resa_info">
	                		<label class="lbl_info_resa"> Tarif Adhérents  </label>
	                		<span class="span_info_resa"><?php echo $tarif_adherent[0] ?> €</span>
	                		</div>
	                		 </br>
	                		 </br>
	                	</form>
                    </div>
                <?php

				if(is_user_logged_in()){

				global $wpdb;
				$post_id = get_the_ID();
				$current_user = wp_get_current_user();
				$id_user = $current_user->ID;
				$nbplace = get_post_custom_values('_nb_place', $post_id);
                $prix_adt = get_post_custom_values('_tarif_adulte', $post_id);
                $prix_enf = get_post_custom_values('_tarif_enfant', $post_id);
                $prix_adh = get_post_custom_values('_tarif_adherent', $post_id);
				echo '<input type="hidden" id="ipt_role_user" value="'.$current_user->roles[0].'"/> ';
				echo '<input type="hidden" id="ipt_prix_adulte" value="'.$prix_adt[0].'"/> ';
				echo '<input type="hidden" id="ipt_prix_enfant" value="'.$prix_enf[0].'"/> ';
				echo '<input type="hidden" id="ipt_prix_adherent" value="'.$prix_adh[0].'"/> ';
				$query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}reservation WHERE id_evenement = $post_id AND id_participant = $id_user");
				$etat_resa = get_post_custom_values('_etat_resa', $post_id);
				$url = site_url()."/contact";
				     if($etat_resa[0] == "cloture"){
		            	echo '<h2 class="idtitrenoIns">Cet évènement est cloturé</h2>';
		             }else{
						if(count($query) != 0){
							 if($query[0]->liste_attente == 1){
						    	echo '<p id="etat_resa_p" class="idtitrenoIns">Votre réservation est placée en liste d\'attente</p>';
						    }


						    echo '<div id="span_reza_del"></div>';
							echo '<div id="annul_resa_div" class="annul_resa_div">';
							echo '<p class="p_reza">Vous avez déjà réservé !</p>';
							echo '</br>';
							echo '<p id="id_msg_price">Prix total : '.$query[0]->prix_total.' €</p>';
							echo '</br>';
							echo '<p>Nombre de places adultes : '.$query[0]->nbplace.'</p>';
							echo '</br>';
							echo '<p>Nombre de places enfants : '.$query[0]->nbplace_enf.'</p>';


						if($query[0]->paiement == 0){	
							echo '</br>';
							echo '<input type="button" id="resa_modif" value="Modifier ma réservation"/>';
							echo '</br>';
							echo '</br>';
							echo '<form class="annul_resa_form">';
							echo '<input name="post_id_annul" type="hidden" value="'.$post_id.'"/>';
							echo '<input class="sub_annul_reza" type="submit" name="resa_submit2" value="Annuler ma réservation"/>';
							echo ' </form>';
							echo '</div>';
							echo '<div id="modif_resa_div" class="resa_div">';
							echo '<p class="p_reza">Modifier ma réservation</p>';
							echo '</br>';
							if($query[0]->liste_attente != 1){
						    	$nombre_place = get_post_custom_values('_nb_place', $post_id);
							    echo '<p>Nombre de places disponibles : '.$nombre_place[0].'</p>';
						    }
							echo '</br>';
							$nbplacenew = $nbplace[0]+$query[0]->nbplace+$query[0]->nbplace_enf;
							echo '<p>Prix : <span id="span_prix">'.$query[0]->prix_total.'</span> €</p>';
							echo '</br>';
							echo '<form class="modif_resa_form">';
							    echo '<div class="div_modif_resa_form">';
								echo '<p><label class="lbl_resa_div" for ="pl_adulte_upd">Place Adultes  </label>';
								echo '<input id="iptupd_place_adt" class="ipt_modif_resa_form" type="number" name="pl_adulte_upd" min="0" max="'.$nbplacenew.'" value="'.esc_attr($query[0]->nbplace).'"/></p></br>';
								echo '<div class="div2_modif_resa_formstyle">      </div>';
								echo '<p><label class="lbl_resa_div" for ="pl_enfant_upd">Place Enfants  </label>';
								echo '<input id="iptupd_place_enf" class="ipt_modif_resa_form" type="number" name="pl_enfant_upd" min="0" max="'.$nbplacenew.'"  value="'.esc_attr($query[0]->nbplace_enf).'"/></p></br>';
								echo '<input name="post_id_upd" type="hidden" value="'.$post_id.'"/></br>';
								echo '<input id="ipt_sub_modif_reza" type="submit" id="resa_submit_upd" value="Modifier ma réservation"/>';
						  		echo '</div>';
						  	echo ' </form>';
							echo '</div>';
						}else{
							echo '<hr/>';
							echo '<p>Votre paiement a été enregistré,</p>';
							echo '<p>vous ne pouvez pas modifier ou annuler votre réservation.</p>';
							echo '</br>';
							echo '<p>Vous pouvez cependant nous contacter : </p>';
							echo '</br>';
							echo '<form action="'.$url.'" method="post">';
							echo '<input type="submit" value="Contact"/>';
							echo '</form>';
						}


						}
						else{
							if($etat_resa[0] == "file_attente"){
						    	echo '<p class="idtitrenoIns">Les réservations effectuées sur cet évènement seront placées en liste d\'attente</p>';
						        $max = 1500;
						    }else{
						    	$max = $nbplace[0];
						    }
							echo '<div id="span_reza"></div>';
							echo '<div id="resa_div_id" class="resa_div">';
							echo '<p class="p_reza">Ma réservation</p>';
							echo '</br>';
							if($query[0]->liste_attente != 1){
						    	$nombre_place = get_post_custom_values('_nb_place', $post_id);
							    echo '<p>Nombre de places disponibles : '.$nombre_place[0].'</p>';
							    echo '</br>';							    
						    }
                            echo '<p>Prix : <span id="span_prix">0.00</span> €</p>';
                            echo '</br>';
							echo '<form class="resa_form">';
							    echo '<div class="div_modif_resa_form">';
								echo '<p><label class="lbl_resa_div" for="pl_adulte">Place Adultes  </label>';
								echo '<input id="ipt_place_adt" class="ipt_modif_resa_form" type="number" name="pl_adulte" min="0" max="'.$max.'"  placeholder="0"/></p></br>';
								echo '<div class="div2_modif_resa_formstyle">      </div>';
								echo '<p><label class="lbl_resa_div" for="pl_enfant">Place Enfants  </label>';
								echo '<input id="ipt_place_enf" class="ipt_modif_resa_form" type="number" name="pl_enfant" min="0" max="'.$max.'"  placeholder="0"/></p></br>';
								echo '<input name="post_id" type="hidden" value="'.$post_id.'"/>';
								echo '<input class="ipt_resa_form" type="submit" name="resa_submit"/>';
						  		echo '</div>';
						  	echo ' </form>';
						    echo '</div>';
						    
						}
						
				      }
				   }
				   
				 ?> 
				 
				

			
			

		<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>