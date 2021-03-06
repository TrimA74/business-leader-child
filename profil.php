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
	 <p id="mon_profil" class="aligntitre"><?php if($_GET["lang"]=="it"){ echo "Mio Profilo"; }else{ echo "Mon Profil";} ?></p>
	 <table id="profiltable">
	<tr >
		<th id="largeur_th"><label id="prenom" for="first_name"><?php if($_GET["lang"]=="it"){ echo "Nome"; }else{ echo "Prénom";} ?></label></th>
		<div>
		<?php 
			$current_user = wp_get_current_user();
			$id_user = $current_user->ID;
		echo '<td><input type="text" onblur="verifPrenom(this)" name="first_name"  id="first_name" value="'.esc_attr($current_user->first_name).'"  class="regular-text" /></td>';
		?>
		</div>
	</tr>

	<tr >
		<th id="largeur_th"><label id="nom" for="last_name"><?php if($_GET["lang"]=="it"){ echo "Cognome"; }else{ echo "Nom";} ?></label></th>
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
		<th id="largeur_th"><label id="tel" for="tel_profil"><?php if($_GET["lang"]=="it"){ echo "Telefono"; }else{ echo "Tel";} ?></label></th>
		<div>
		<?php 
			$current_user = wp_get_current_user();
			$id_user = $current_user->ID;
		echo '<td><input type="text" onblur="verifTel(this)" name="tel_profil" id="tel_profil" value="'.esc_attr($current_user->tel).'"  class="regular-text" /></td>';
		?>
		</div>
	</tr>
	<tr >
		<th id="largeur_th"><label id="adresse_label" for="adresse_update"><?php if($_GET["lang"]=="it"){ echo "Indirizzo"; }else{ echo "Adresse";} ?></label></th>
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
		<th id="largeur_th"><label id="codepostal" for="codepostal_profil"><?php if($_GET["lang"]=="it"){ echo "Codice postale"; }else{ echo "Code Postal";} ?><span class="description"></span></label></th>
		<div>
		<td><input type="text"  onblur="verifCP(this)" name="codepostal_profil" id="codepostal_profil" value="<?php echo esc_attr($current_user->cp) ?>" class="regular-text" /></td>
		</div>
	</tr>

	<tr >
		<th id="largeur_th"><label id="ville" for="ville_profil"><?php if($_GET["lang"]=="it"){ echo "Città"; }else{ echo "Ville";} ?></label></th>
		<div>
		<?php 
			$current_user = wp_get_current_user();
			$id_user = $current_user->ID;
		echo '<td><input type="text" onblur="verifVille(this)" name="ville_profil" id="ville_profil" value="'.esc_attr($current_user->ville).'"  class="regular-text" /></td>';
		?>
		</div>
	</tr>

	<tr >
		<th id="largeur_th"><label id="ancienmdp" for="ancienmdp_profil"><?php if($_GET["lang"]=="it"){ echo "Vecchia password"; }else{ echo "Ancien mot de passe";} ?></label></th>
		<div>
		<?php 
			$current_user = wp_get_current_user();
			$id_user = $current_user->ID;
		echo '<td><input type="password" onblur="verifAncienMDP(this)" name="ancienmdp_profil" id="ancienmdp_profil" class="regular-text" /></td>';
		?>
		</div>
	</tr>

	<tr id="password" class="user-pass1-wrap">
		<th id="largeur_th"><label for="pass1"><?php if($_GET["lang"]=="it"){ echo "Nuova password"; }else{ echo "Nouveau mot de passe";} ?></label></th>
		<td>		
			<div class="wp-pwd hide-if-js">
				<span class="password-input-wrapper">
					<input type="password" onblur="verifNewMDP(this)" name="pass1" id="pass1" class="regular-text" value="" autocomplete="off" data-pw="1lp$q*EjAF#M$@mQ02nY0owb" aria-describedby="pass-strength-result" />
				</span>
			</div>
		</td>
	</tr>
	<tr class="user-pass2-wrap hide-if-js">
		<th id="largeur_th" scope="row"><label for="pass2"><?php if($_GET["lang"]=="it"){ echo "Ripeta il Nuova password"; }else{ echo "Répétez le nouveau mot de passe";} ?></label></th>
		<td>
		<input name="pass2" type="password" onblur="verifNewMDP2(this)" id="pass2" class="regular-text" value="" autocomplete="off" />
		</td>
	</tr>
	</table>
	</div>
	<button id="buttonenregistrer" name="button_update" style="margin-left:40%;margin-bottom:30px;padding: 0.7em 1em;font-size: 1.7rem;font-weight: 400;font-family: 'Lato',Helvetica,Arial,sans-serif;text-transform: uppercase;line-height: 1;background: transparent none repeat scroll 0% 0% padding-box;color: black;border: 2px solid black;border-radius: 4px;"><?php if($_GET["lang"]=="it"){ echo "Salvare le modifiche"; }else{ echo "Enregistrer les modifications";} ?></button>
</form>
<?php
	echo "<div id='message_erreur'>";
	if($_GET["lang"]=="it"){
		if($_SESSION["fn"]=="true"){
		echo "<br/>Il nome non può contenere di caratteri speciali.";
		}
		if($_SESSION["ln"]=="true")
		{
			echo "<br/>Il nome non può contenere dei caratteri speciali.";
		}
		if($_SESSION["tel"]=="true")
		{
			echo "<br/>Il telefono può contenere solamente 10 cifre.";
		}
		if($_SESSION["ville"]=="true")
		{
			echo "<br/>La città non può contenere di caratteri speciali.";
		}
		if($_SESSION["cp"]=="true")
		{
			echo "<br/>Il codice postale può contenere solamente 5 cifre.";
		}
		if($_SESSION["adresse"]=="true")
		{
			echo "<br/>L'indirizzo non può contenere di caratteri speciali altri che ,.'-";
			
		}
		if($_SESSION["newpass"]=="true")
		{
			echo "<br/>La vecchia parola di ordine è scorretta.";
			
		}
		
		if($_SESSION["nvxpass"]=="!identiques")
		{
			echo "<br/>I campi di nuovo parola di ordine deve essere identica.";
			
		}
		echo "</div>";
	}else{
		if($_SESSION["fn"]=="true"){
		echo "<br/>Le prénom ne peut pas contenir de caractères spéciaux.";
		}
		if($_SESSION["ln"]=="true")
		{
			echo "<br/>Le nom ne peut pas contenir de caractères spéciaux.";
		}
		if($_SESSION["tel"]=="true")
		{
			echo "<br/>Le téléphone ne peut contenir que 10 chiffres.";
		}
		if($_SESSION["ville"]=="true")
		{
			echo "<br/>La ville ne peut pas contenir de caractères spéciaux.";
		}
		if($_SESSION["cp"]=="true")
		{
			echo "<br/>Le code postal ne peut contenir que 5 chiffres.";
		}
		if($_SESSION["adresse"]=="true")
		{
			echo "<br/>L'adresse ne peut pas contenir de caractères spéciaux autres que ,.'-";
			
		}
		if($_SESSION["newpass"]=="true")
		{
			echo "<br/>L'ancien mot de passe est incorrect.";
			
		}
		
		if($_SESSION["nvxpass"]=="!identiques")
		{
			echo "<br/>Les champs de nouveau mot de passe doivent être identiques.";
			
		}
		echo "</div>";
	
	}
	
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