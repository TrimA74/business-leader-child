<?php
// if(isset($_GET["blabla"]))
// {
  // echo "test";
  // $user = wp_get_current_user();
  // echo json_encode($user);
// }


session_start();

function traitement_formulaire_update() {
	if (isset($_POST['first_name']) &&
		isset($_POST['last_name']) &&
		isset($_POST['tel_profil']) &&
		isset($_POST['adresse_update']) &&
		isset($_POST['ville_profil']) &&
		isset($_POST['ancienmdp_profil']) &&
		isset($_POST['pass1']) &&
		isset($_POST['pass2']) &&
		isset($_POST['codepostal_profil'])) {

		$_SESSION['fn']='';
		$_SESSION['ln']='';
		$_SESSION['tel']='';
		$_SESSION['adresse']='';
		$_SESSION['ville']='';
		$_SESSION['cp']='';
		$_SESSION['pass']='';

		if (!empty($_POST['first_name'])){

			$fn=$_POST['first_name'];
      $regex = "/[0-9<,>^@&\"()\\!_\$\*€£\+=\/;?#\[\]\{\}]/";
			if (!preg_match($regex, $fn)){
					update_user_meta(get_current_user_id(), first_name, esc_attr($fn));
			}
			else{
				$_SESSION['fn'] = 'true';
			}


		}
		if (!empty($_POST['last_name'])){

			$ln=$_POST['last_name'];
			$Syntaxelastname="/[0-9<,>^@&\"()\\!_\$\*€£\+=\/;?#\[\]\{\}]/";
			if (!preg_match($Syntaxelastname, $ln)){
					update_user_meta(get_current_user_id(), last_name, esc_attr($ln));
			}
			else{
				$_SESSION['ln'] = 'true';
			}

		}
		if(!empty($_POST['tel_profil'])){
			$tel=$_POST['tel_profil'];
			$Syntaxetel="#^0[0-9]([ .-]?[0-9]{2}){4}$#";
			if (preg_match($Syntaxetel, $tel)){
				update_user_meta(get_current_user_id(), tel, esc_attr($tel));
			}
			else{
				$_SESSION['tel'] = 'true';
			}

		}
		if(!empty($_POST['adresse_update'])){
			$adresse=$_POST['adresse_update'];
			$Syntaxeadresse="/[<>^@&\"()\\!_\$\*€£\+=\/;?#\[\]\{\}]/";
			if (!preg_match($Syntaxeadresse, $adresse)){
				update_user_meta(get_current_user_id(), adresse, esc_attr($adresse));
			}
			else{
				$_SESSION['adresse'] = 'true';
			}
		}
		if(!empty($_POST['ville_profil'])){
			$ville=$_POST['ville_profil'];
			$Syntaxeville="/[0-9<,>^@&\"()\\!_\$\*€£\+=\/;?#\[\]\{\}]/";
			if (!preg_match($Syntaxeville, $ville)){
				update_user_meta(get_current_user_id(), ville, esc_attr($ville));
			}
			else{
				$_SESSION['ville'] = 'true';
			}

		}
		if(!empty($_POST['codepostal_profil'])){
			$cp=$_POST['codepostal_profil'];
			$Syntaxecp="#^[0-9]{5}$#";
			if (preg_match($Syntaxecp, $cp)){
				update_user_meta(get_current_user_id(), cp, esc_attr($cp));
			}
			else{
				$_SESSION['cp'] = 'true';
			}

		}
		if(!empty($_POST['ancienmdp_profil']) &&
		   !empty($_POST['pass1']) &&
		   !empty($_POST['pass2'])){
			$_SESSION['pass'] = wp_get_current_user()->user_pass;
			$passcomparaison = wp_get_current_user()->user_pass;
			$iddugugus= get_current_user_id();
			$ancienmdp=get_user_meta(get_current_user_id(), $passcomparaison, true );
			$_SESSION["iddugugus"]=get_current_user_id();
			$_SESSION["ancienmdp_profil"]=$_POST['ancienmdp_profil'];
			$recupmdpform=$_POST['ancienmdp_profil'];

			if(wp_check_password($recupmdpform, $passcomparaison, $iddugugus)){
				if($_POST['pass1'] == $_POST['pass2']){
					wp_set_password( $_POST['pass2'], $iddugugus );

				}
				else{
					$_SESSION["nvxpass"]="!identiques";
				}

			}
			else{
				$_SESSION['pass1'] = 'false';
				$_SESSION["newpass"]="true";
			}
		}


	}
}

add_action( 'template_redirect', 'traitement_formulaire_update' );


function admin_enqueue_scripts () {
  wp_register_script( 'admin_js',get_site_url() . '/wp-content/themes/business-leader-child/js/' . 'admin.js', 'jquery', '1.0');
  wp_enqueue_script( 'admin_js' );
}
add_action( 'admin_enqueue_scripts', 'admin_enqueue_scripts' );
function cjm_enqueue_scripts() {
  global $wp_styles;
  global $wp_scripts;
    /*
    * Ajout du script manip_groupe.js quelque soit le naviguateur
    */
    wp_register_script( 'manip_groupe',get_site_url() . '/wp-content/themes/business-leader-child/js/' . 'manip_groupe.js', 'jquery', '1.0');
    wp_enqueue_script( 'analytics',get_site_url() . '/wp-content/themes/business-leader-child/js/' . 'analytics.js', '1.0');
    wp_localize_script( 'manip_groupe', 'cjm_object',
         array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'site_url_js' => get_site_url(), 'logout_link' => wp_logout_url() , "is_connected" => is_user_logged_in(), "current_lang" => $_GET['lang']) );
    wp_enqueue_script( 'manip_groupe' );


    /*
    * Ajout feuille de style ie.css et script ie.js pour Internet Explorer avec version inférieur à 10
    */
    wp_enqueue_style( 'my-theme-ie',get_site_url()."/wp-content/themes/business-leader-child/ie.css");
    wp_register_script( 'ie_js',get_site_url() . '/wp-content/themes/business-leader-child/js/' . 'ie.js', 'jquery', '1.0');
    $wp_scripts->add_data( 'ie_js', 'conditional', 'lt IE 10' );
    wp_enqueue_script( 'ie_js' );
    $wp_styles->add_data( 'my-theme-ie', 'conditional', 'lt IE 10' );
}

add_action( 'wp_enqueue_scripts', 'cjm_enqueue_scripts');

function cfp($atts, $content = null) {
    extract(shortcode_atts(array( "id" => "", "title" => "", "pwd" => "" ), $atts));

    if(empty($id) || empty($title)) return "";

    $cf7 = do_shortcode('[contact-form-7 id="' . $id . '" title="' . $title . '"]');

    $pwd = explode(',', $pwd);
    foreach($pwd as $p) {
        $p = trim($p);
        $cf7 = preg_replace('/<input type="text" name="' . $p . '"/usi', '<input type="password" name="' . $p . '"', $cf7);
        $cf7 = preg_replace('/<input type="text" name="insConfPasswd"/usi', '<input type="password" name="insConfPasswd"', $cf7);
    }

    return $cf7;
}
add_shortcode('cfp', 'cfp');
/*Modifications du formulaire d'inscriptions*/

add_filter( 'wpcf7_validate_email*', 'custom_email_confirmation_validation_filter', 20, 2 );
function custom_email_confirmation_validation_filter( $result, $tag ) {
    $tag = new WPCF7_Shortcode( $tag );

    if ( 'ConfEmail' == $tag->name ) {
        $your_email = isset( $_POST['Email'] ) ? trim( $_POST['Email'] ) : '';
        $your_email_confirm = isset( $_POST['ConfEmail'] ) ? trim( $_POST['ConfEmail'] ) : '';

        if(!email_exists($your_email)){

            if ( $your_email != $your_email_confirm ) {
                $result->invalidate( $tag, "Les adresses mails ne correspondent pas" );
            }
        }else{
                $result->invalidate( $tag, "Adresse mail déjà utilisée" );
        }
    }

    return $result;
}

add_filter( 'wpcf7_validate_text*', 'custom_password_confirmation_validation_filter', 20, 2 );
function custom_password_confirmation_validation_filter( $result, $tag ) {
    $tag = new WPCF7_Shortcode( $tag );

    if ( 'insConfPasswd' == $tag->name ) {
        $your_email = isset( $_POST['insPasswd'] ) ? trim( $_POST['insPasswd'] ) : '';
        $your_email_confirm = isset( $_POST['insConfPasswd'] ) ? trim( $_POST['insConfPasswd'] ) : '';

        if ( $your_email != $your_email_confirm ) {
            $result->invalidate( $tag, "Les mots de passe ne correspondent pas" );
        }
    }

    return $result;
}


function create_user_from_registration($cfdata) {
    if (!isset($cfdata->posted_data) && class_exists('WPCF7_Submission')) {
        // Contact Form 7 version 3.9 removed $cfdata->posted_data and now
        // we have to retrieve it from an API
        $submission = WPCF7_Submission::get_instance();
        if ($submission) {
            $formdata = $submission->get_posted_data();
        }
    } elseif (isset($cfdata->posted_data)) {
        // For pre-3.9 versions of Contact Form 7
        $formdata = $cfdata->posted_data;
    } else {
        // We can't retrieve the form data
        return $cfdata;
    }
    // Check this is the user registration form
    if ( $cfdata->title() == 'Inscription') {
        $insprenom = $formdata['Prnom'];
        $insname = $formdata['Nom'];
        $insmail = $formdata['Email'];
        $instel = $formdata['insTel'];
        $insadresse = $formdata['insAdresse'];
        $inscp = $formdata['insCp'];
        $insville  = $formdata['insVille'];
        $password = $formdata['insPasswd'];


        if ( !email_exists( $email ) ) {


            // Create the user
            $userdata = array(
                'user_login' => $insmail,
                'user_email' => $insmail,
                'user_pass' =>  $password,
                'first_name' => $insprenom,
                'last_name' => $insname
            );
            $user_id = wp_insert_user( $userdata );
            if ( !is_wp_error($user_id) ) {

                 $userMetaUpdate = array(
                'tel' => $instel,
                'adresse' => $insadresse,
                'cp' => $inscp,
                'ville' =>$insville
            );
            foreach($userMetaUpdate as $k => $v)
            {
               $update_user =  update_user_meta($user_id,$k,$v);

               if ($update_user==false)
               {
                    echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-danger">';
                    echo '<strong>Erreur d\'insertion base de données('.$k.')</strong>';
                    echo '</div>';
               }
            }
                    $code = sha1( $user_id . time() );
                    $activation_link = add_query_arg( array( 'key' => $code, 'user' => $user_id ), get_permalink(63));
                    add_user_meta( $user_id, 'has_to_be_activated', $code, true );
                    wp_mail( $insmail, 'Confirmez votre inscription', '

                   Le Comité de Jumelage de Meythet-Capaci vous remercie de votre inscription. Veuillez confirmer la validité de votre adresse e-mail en cliquant sur le lien d\'activation suivant: ' . $activation_link);
            }
    }
    return $cfdata;
  }
}


add_action( 'template_redirect', 'wpse8170_activate_user' );
function wpse8170_activate_user() {
    if ( is_page() && get_the_ID() == 63 ){
        $user_id = filter_input( INPUT_GET, 'user', FILTER_VALIDATE_INT, array( 'options' => array( 'min_range' => 1 ) ) );
        if ( $user_id ) {
            // get user meta activation hash field
            $code = get_user_meta( $user_id, 'has_to_be_activated', true );
            if ( $code == filter_input( INPUT_GET, 'key' ) ) {
                delete_user_meta( $user_id, 'has_to_be_activated' );
            }
        }
    }
}
/*function cjm_enqueue_scripts() {
wp_register_script( 'manip_groupe',get_site_url() . '/wp-content/themes/zerif-lite child/js/' . 'manip_groupe.js', 'jquery', '1.0');
wp_enqueue_script( 'manip_groupe' );
}

add_action( 'wp_enqueue_scripts', 'cjm_enqueue_scripts');*/

add_action('wpcf7_before_send_mail', 'create_user_from_registration', 1);



function theme_add_user_info_column( $columns ) {
        $columns['tel'] = __( 'Téléphone');
        $columns['adresse'] = __( 'Adresse');
        $columns['ville'] = __( 'Ville');
        $columns['cp'] = __( 'Code postal');
        return $columns;
}
function theme_show_user_tel_data( $value, $column_name, $user_id ) {
     return esc_attr__(get_user_meta( $user_id, $column_name, true ));
}
add_filter('manage_users_columns','theme_add_user_info_column');
add_action('manage_users_custom_column','theme_show_user_tel_data',10,3);



remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker' );


add_action( 'show_user_profile', 'yoursite_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'yoursite_extra_user_profile_fields' );
function yoursite_extra_user_profile_fields( $user ) {
?>
  <h3><?php _e("Mes Informations", "blank"); ?></h3>
  <table class="form-table">
    <tr>
      <th><label for="tel"><?php _e("Tel"); ?></label></th>
      <td>
        <input type="text" name="tel" id="tel" class="regular-text"
            value="<?php echo esc_attr( get_the_author_meta( 'tel', $user->ID ) ); ?>" /><br />
        <span class="description"><?php _e(""); ?></span>
      </td>
    </tr>
    <tr>
      <th><label for="adresse"><?php _e("Adresse"); ?></label></th>
      <td>
        <input type="text" name="adresse" id="adresse" class="regular-text"
            value="<?php echo esc_attr( get_the_author_meta( 'adresse', $user->ID ) ); ?>" /><br />
        <span class="description"><?php _e(""); ?></span>
      </td>
    </tr>
     <tr>
      <th><label for="cp"><?php _e("Code Postal"); ?></label></th>
      <td>
        <input type="text" name="cp" id="cp" class="regular-text"
            value="<?php echo esc_attr( get_the_author_meta( 'cp', $user->ID ) ); ?>" /><br />
        <span class="description"><?php _e(""); ?></span>
      </td>
    </tr>
     <tr>
      <th><label for="ville"><?php _e("Ville"); ?></label></th>
      <td>
        <input type="text" name="ville" id="ville" class="regular-text"
            value="<?php echo esc_attr( get_the_author_meta( 'ville', $user->ID ) ); ?>" /><br />
        <span class="description"><?php _e(""); ?></span>
      </td>
    </tr>
  </table>
<?php
}

add_action( 'personal_options_update', 'yoursite_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'yoursite_save_extra_user_profile_fields' );
function yoursite_save_extra_user_profile_fields( $user_id ) {
  $saved = false;
  if ( current_user_can( 'edit_user', $user_id ) ) {
    update_user_meta( $user_id, 'tel', $_POST['tel'] );
    update_user_meta( $user_id, 'adresse', $_POST['adresse'] );
    update_user_meta( $user_id, 'cp', $_POST['cp'] );
    update_user_meta( $user_id, 'ville', $_POST['ville'] );
    $saved = true;
  }
  return true;
}



function hide_profile_fields( $contactmethods ) {
  if($user->roles[0] == 'subscriber'){

  unset($contactmethods['user_login']);
  unset($contactmethods['admin_color']);
  unset($contactmethods['comment_shortcuts']);
  unset($contactmethods['user_description']);
  unset($contactmethods['rich_editing']);
  unset($contactmethods['user_level']);
  unset($contactmethods['plugins_per_page']);
  unset($contactmethods['description']);
  unset($contactmethods['user_status']);
  unset($contactmethods['user_activation_key']);
  unset($contactmethods['user_url']);

}
  return $contactmethods;
}
add_filter('user_contactmethods','hide_profile_fields',10,1);

function register_my_widget_theme() {
	// sidebar pour les pages
   register_sidebar(array(
   'id' => 'page-sidebar', // identifiant
    'name' => 'Sidebar Page', // Nom a afficher dans le tableau de bord
   'description' => 'Sidebar pour mes pages.', // description facultatif
   'before_widget' => '<li id="%1$s" class="widget %2$s">', // class attribuer pour le contenu (css)
   'after_widget' => '</li>',
   'before_title' => '<h2 class="widgettitle">', // class attribuer  pour le titre (css)
   ));
	}
add_action( 'init', 'register_my_widget_theme' );

add_action('wp_print_scripts', 'gkp_no_autosave');
function gkp_no_autosave() {
      wp_deregister_script('autosave');
}



/*function namespace_add_custom_types( $query ) {

  if( is_category('Voyages') && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'nav_menu_item', 'reservation'
    ));
    return $query;
  }
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );*/

add_action( 'show_user_profile', 'recup_user' );
function recup_user(){
  $user = wp_get_current_user();
 //json_encode($user);
 //wp_send_json( $user );
  echo $user->roles;
  if($user->roles[0] == 'subscriber'){
    //var_dump($user->roles);
  }

}

//admin-bar custom

function remove_wp_logo() {
  global $wp_admin_bar;
  if ( !current_user_can( 'manage_options' ) ) {

    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('site-name');
    $wp_admin_bar->remove_menu('search');
    $wp_admin_bar->remove_menu('admin-dashboard');
    $wp_admin_bar->remove_menu('my-account');

  }else{
     $wp_admin_bar->remove_menu('wp-logo');
     $wp_admin_bar->remove_menu('search');
     $wp_admin_bar->remove_menu('new-content');
     $wp_admin_bar->remove_menu('comments');
  }
}
add_action( 'wp_before_admin_bar_render', 'remove_wp_logo' );


add_role('adherent_user', 'Adhérent', array(
      'read' => true,
  )); 

// remove_role( "admin_comite" );
add_role('admin_comite', 'Membre du comité', array(
      'read' => true,
      'delete_others_pages' => true, 
      'delete_others_posts' => true,
      'delete_pages' => true,
      'delete_posts' => true,
      'delete_private_pages' => true,
      'delete_private_posts' => true,
      'delete_published_pages' => true,
      'delete_published_posts' => true,
      'edit_dashboard' => true,
      'edit_others_pages' => true,
      'edit_others_posts' => true,
      'edit_pages' => true,
      'edit_posts' => true,
      'edit_private_pages' => true,
      'edit_private_posts' => true,
      'edit_published_pages' => true,
      'edit_published_posts' => true,
      'edit_theme_options' => true,
      'export' => true,
      'import' => true,
      'list_users' => true,
      'manage_categories' => true,
      'manage_links' => true,
      'manage_options' => true,
      'moderate_comments' => true,
      'promote_users' => true,
      'publish_pages' => true,
      'publish_posts' => true,
      'read_private_pages' => true,
      'read_private_posts' => true,
      'upload_files' => true,
      'update_core' => true, 
      'update_plugins' => true, 
      'update_themes' => true, 
      'install_plugins' => true, 
      'install_themes' => true, 
      'delete_themes' => true, 
      'edit_plugins' => true, 
      'edit_themes' => true, 
      'delete_plugins' => true, 
      'delete_users' => true,
      'edit_files' => true,
      'create_users' => true,
      'edit_users' => true,
      'unfiltered_html' => true,
      'manage_network_plugins' => true,
  )); 
/*Profil*/
function custom_adminbar_menu( $meta = TRUE ) {
  global $wp_admin_bar;
    if ( is_user_logged_in() && !current_user_can( 'manage_options' ) ){
	if($_GET["lang"]=="it"){
		$wp_admin_bar->add_menu( array(
		'id' => 'custom_menu',
		'title' => __( 'Mio profilo' ),
		'href' => get_site_url().'?page_id=159&lang=it'
		 ));
	}else{
		$wp_admin_bar->add_menu( array(
		'id' => 'custom_menu',
		'title' => __( 'Mon Profil' ),
		'href' => get_site_url().'?page_id=159&lang=fr'
		 ));
	}

  }
}
add_action( 'admin_bar_menu', 'custom_adminbar_menu', 75 );
/* The add_action # is the menu position:
10 = Before the WP Logo
15 = Between the logo and My Sites
25 = After the My Sites menu
100 = End of menu
*/

/*Articles protégés => privés*/
add_filter('protected_title_format', 'GkProtected');
function GkProtected($title) {
       return 'Privé : %s';
}
// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end
function df_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'df_disable_comments_admin_bar');

/*
Configuration mails
*/

add_filter('wp_mail_from', 'new_mail_from');
add_filter('wp_mail_from_name', 'new_mail_from_name');

function new_mail_from() { return 'jumelage.meythet.capaci@gmail.com'; }
function new_mail_from_name() { return 'Jumelage Meythet-Capaci'; }
// function my_custom_stuff_gwolle ($output) {
// 	$output .= '<button style="text-align:center;" type="button" id="ins_resa" value="sinscrire" href="'.do_shortcode( '[formlightbox title="" text="Inscrivez-vous"]
// 					[cfp id="62" title="Sans titre" pwd="insPasswd"][/formlightbox]').'</button>';
// 	$output .= '<button style="text-align:center;" param="livreor" type="button" id="con_resa" value="se connecter">Connectez vous pour écrire un message</button>';
// 	return $output;
// }
// add_filter('gwolle_gb_entries_read','my_custom_stuff_gwolle');
