<?php
/**
 * Template Name: Profil
 *
 * @package WordPress
 * @subpackage business-leader
 * 
 */

if (!is_user_logged_in()){ 
   global $wp_query;
	  $wp_query->set_404();
	  status_header( 404 );
	  get_template_part( 404 ); exit();
}

 
get_header(); 

if(isset($_POST["button_update"]))
	{
		
	}

?>

<!-- onblur="verifname(this)" -->

<form onsubmit="verifForm(this)" action="#" method="POST">
	<div id="profilleft">
	<br/>
	 <p id="mon_profil" class="aligntitre">Mon Profil</p>
	 <table id="profiltable">
	<tr >
		<th id="largeur_th"><label id="prenom" for="first_name"><?php _e('Prénom') ?></label></th>
		<div>
		<?php 
			$current_user = wp_get_current_user();
			$id_user = $current_user->ID;
		echo '<td><input type="text" onblur="verifPrenom(this)" name="first_name"  id="first_name" value="'.esc_attr($current_user->first_name).'"  class="regular-text" /></td>';
		?>
		</div>
	</tr>

	<tr >
		<th id="largeur_th"><label id="nom" for="last_name"><?php _e('Nom') ?></label></th>
		<div>
		<?php 
		echo '<td><input type="text" name="last_name" onblur="verifNom(this)" id="last_name" value="'.esc_attr($current_user->last_name).'" class="regular-text" /></td>';
		?>
		</div>
	</tr>


	<tr >
		<th id="largeur_th"><label id="email" for="email_profil">Email <span class="description"></span></label></th>
		<div>
		<td><input type="text" onblur="verifEmail(this)"  name="email_profil" id="email_profil" value="<?php echo esc_attr($current_user->user_email) ?>" class="regular-text"  disabled="disabled"/></td>
		</div>
	</tr>

	<tr >
		<th id="largeur_th"><label id="tel" for="tel_profil"><?php _e('Téléphone') ?></label></th>
		<div>
		<?php 
			$current_user = wp_get_current_user();
			$id_user = $current_user->ID;
		echo '<td><input type="text" onblur="verifTel(this)" name="tel_profil" id="tel_profil" value="'.esc_attr($current_user->tel).'"  class="regular-text" /></td>';
		?>
		</div>
	</tr>
	<tr >
		<th id="largeur_th"><label id="adresse_label" for="adresse_update"><?php _e('Adresse') ?></label></th>
		<div>
		<?php 
		echo '<td><input type="text" onblur="verifAdresse(this)" name="adresse_update" id="adresse_update" value="'.esc_attr($current_user->adresse).'" class="regular-text ltr" /></td>';
		?>
		</div>
	</tr>

	</table>
	</div>
	<div id="compteright">
	<table id="comptetable">

	<tr >
		<th id="largeur_th"><label id="codepostal" for="codepostal_profil">Code Postal <span class="description"></span></label></th>
		<div>
		<td><input type="text"  onblur="verifCP(this)" name="codepostal_profil" id="codepostal_profil" value="<?php echo esc_attr($current_user->cp) ?>" class="regular-text" /></td>
		</div>
	</tr>

	<tr >
		<th id="largeur_th"><label id="ville" for="ville_profil"><?php _e('Ville') ?></label></th>
		<div>
		<?php 
			$current_user = wp_get_current_user();
			$id_user = $current_user->ID;
		echo '<td><input type="text" onblur="verifVille(this)" name="ville_profil" id="ville_profil" value="'.esc_attr($current_user->ville).'"  class="regular-text" /></td>';
		?>
		</div>
	</tr>

	<tr >
		<th id="largeur_th"><label id="ancienmdp" for="ancienmdp_profil"><?php _e('Ancien Mot de Passe') ?></label></th>
		<div>
		<?php 
			$current_user = wp_get_current_user();
			$id_user = $current_user->ID;
			echo $current_user->user_pass ;
		echo '<td><input type="password" onblur="verifAncienMDP(this)" name="ancienmdp_profil" id="ancienmdp_profil" class="regular-text" /></td>';
		?>
		</div>
	</tr>

	<tr id="password" class="user-pass1-wrap">
		<th id="largeur_th"><label for="pass1">Nouveau mot de passe</label></th>
		<td>		
			<div class="wp-pwd hide-if-js">
				<span class="password-input-wrapper">
					<input type="password" onblur="verifNewMDP(this)" name="pass1" id="pass1" class="regular-text" value="" autocomplete="off" data-pw="1lp$q*EjAF#M$@mQ02nY0owb" aria-describedby="pass-strength-result" />
				</span>
			</div>
		</td>
	</tr>
	<tr class="user-pass2-wrap hide-if-js">
		<th id="largeur_th" scope="row"><label for="pass2">Répétez le nouveau mot de passe</label></th>
		<td>
		<input name="pass2" type="password" onblur="verifNewMDP2(this)" id="pass2" class="regular-text" value="" autocomplete="off" />
		</td>
	</tr>
	</table>
	</div>
	<button id="buttonenregistrer" class="button button-primary" name="button_update">Enregistrer les modifications</button>
</form>
<?php 
	if($_SESSION["fn"]=="true"){
		echo "Le prénom ne peut pas contenir de caractères spéciaux.";
	}
	if($_SESSION["ln"]=="true")
	{
		echo "Le nom ne peut pas contenir de caractères spéciaux.";
	}
	if($_SESSION["tel"]=="true")
	{
		echo "Le téléphone ne peut contenir que 10 chiffres.";
	}
	if($_SESSION["ville"]=="true")
	{
		echo "La ville ne peut pas contenir de caractères spéciaux.";
	}
	if($_SESSION["cp"]=="true")
	{
		echo "Le code postal ne peut contenir que 5 chiffres.";
	}
	if($_SESSION["adresse"]=="true")
	{
		echo "L'adresse ne peut pas contenir de caractères spéciaux autres que ,.'-";
	    
	}
	echo  var_dump($_SESSION["tel"]);
	echo var_dump($_SESSION['pass']);
?>

 <p id="mesreservs" class="aligntitre">Mes Réservations</p>
 <?php
 	
 	$query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}reservation WHERE id_participant = $id_user");
 	if($query == null){
 		echo '<p>Vous n\'avez pas effectué de réservation</p></br></br>';
 	}else{

 		echo '<table id="tab_mesreservs">';
 		echo '<thead>';
		echo '<tr>';
		echo '<th>Nom Réservation</th>';
		echo '<th>Type</th>';
		echo '<th>Date de réservation</th>';
		echo '<th>Liste d\'attente</th>';
		echo '<th>Enfants</th>';
		echo '<th>Adultes</th>';
		echo '<th>Paiements</th>';
		echo '<th>prix total</th>';
		echo '<th>Voir la page</th>';
 		echo '</tr>';
 		echo '</thead>';
 	    
 		foreach($query as $resa){

 		$tabcat = get_post_meta( $resa->id_evenement, '_nom_voyage', true);
 		$postname=get_the_category($resa->id_evenement);
 		echo '<tbody>';
 		echo '<tr>';
		echo '<td>'.$tabcat.'</td>';
		echo '<td>'.$postname[0]->category_nicename.'</td>';
		echo '<td>'.date("d-m-Y", strtotime($resa->date_resa)).'</td>';
		if($resa->liste_attente == 1){
			echo '<td>Oui</td>';
		}else{
			echo '<td>Non</td>';
		}
		echo '<td>'.$resa->nbplace_enf.'</td>';
		echo '<td>'.$resa->nbplace.'</td>';
		echo '<td>'.$resa->paiement.'</td>';
		echo '<td>'.$resa->prix_total.'</td>';
		echo '<td><a href="'.get_permalink($resa->id_evenement).'"><button id="voir">Voir</button></a></td>';
 		echo '</tr>';
 		echo '</tbody>';
 		}
 		echo '</table>';
 	}

  ?>
<?php

get_footer(); 