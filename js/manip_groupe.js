jQuery(document).ready(function($) {
$(".header-image").eq(0).removeClass('header-image-overlay').attr("style","background-image: url('http://meythet-capaci.com/wp-content/uploads/2016/03/bandeau.jpg')");
var loginbox = $('#login-box');
/*
******** CACHE élements inutile du livre d'or
*/
$("#gwolle_gb_new_entry h3,#gwolle_gb_new_entry form,.gwolle_gb_author_name,.gwolle_gb_author_email").hide();

	$(".ipt_modif_resa_form").bind('keyup mouseup', function () {
    });

 //  function get_logged_user() {
 //       var data = {
 //      'action': 'get_logged_user'
 //      };
 //      return Promise.resolve(jQuery.post(cjm_object.ajax_url, data,function (data) {
 //        },"json"));
 //    }

	// get_logged_user().then(function (data) {
	// 	console.log(data);
	// });
if(cjm_object.is_connected==0)
{
	$("#gwolle_gb_write_button").hide();
	$("#con_resa").show();
	$("#ins_resa").show();
}
else {
	$("#con_resa").hide();
	$("#ins_resa").hide();
}


/*
* Fonction qui sert au bootstrap, à chaque redimensionnement de la page
*/
$(window).resize(function() {
if(this.resizeTO) clearTimeout(this.resizeTO);
this.resizeTO = setTimeout(function() {
  $(this).trigger('windowResize');
}, 500);
});
jQuery(window).load(function() {
  jQuery(".loader").fadeOut("1000");
  jQuery(".back_loader").fadeOut("1000");
});
/*
****** ANIMATION CHARGEMENT DE LA PAGE (plus swag =) )
*/
$("#secondary").animate({width: '342px'}, "slow");
$("#primary").animate({opacity: '1'}, 1500);

var current_url_deco = cjm_object.logout_link;
$(".category-list").hide();
$(".post-navigation").hide();
$("#wp-admin-bar-adminbar_gc_menu").remove();

loginbox.hide();
if($(".wpcf7-mail-sent-ok").is(":visible")){
	$("#cboxLoadedContent").empty();
	$("#cboxLoadedContent").html(".wpcf7-mail-sent-ok");
}
$('body').css('transform','rotate(45)');
$('#btnins, #ins_resa').click(function(){
		$('#lightboxIns').css('display','block');
		$('#cboxOverlay').css('display','block');
		$('#cboxContent').css('display','block');
		console.log(window.innerWidth);
		if(window.innerWidth<500){
			$("#cboxLoadedContent").css('background-color','red');
		}
	});
/*
****** SI QUELQU'UN EST CONNECTE
*/
if(cjm_object.is_connected==1)
{
	/*
	**** GESTION POSITION DES DRAPEAUX
	*/
	if($(window).width()<=780)
		{
			$('.div_drapeaux').css('top','48px');
			$('.div_drapeaux').css('position','absolute');
			$(".site-header").animate({top: '46px'}, "slow");
			$('#wp-admin-bar-custom_menu').css('display','block');
			$('#wp-admin-bar-custom_menu').css('marginRight','20px');
		}
		else {
			$("#masted").animate({top: '32px'}, "slow");
			$(".site-header").animate({top: '32px'}, "slow");
			$('.div_drapeaux').css('top','38px');
			$('.div_drapeaux').css('position','fixed');

		}
	$(window).on('windowResize', function() {
		if($(window).width()<=780)
		{
			$('.div_drapeaux').css('top','48px');
			$('.div_drapeaux').css('position','absolute');
			$(".site-header").animate({top: '46px'}, "slow");
			$('#wp-admin-bar-custom_menu').css('display','block');
			$('#wp-admin-bar-custom_menu').css('marginRight','10px');
		}
		else {
			$("#masted").animate({top: '32px'}, "slow");
			$(".site-header").animate({top: '32px'}, "slow");
			$('.div_drapeaux').css('top','38px');
			$('.div_drapeaux').css('position','fixed');

		}
	});
	if(cjm_object.current_lang=='it'){
		$("[name='connexion_button_boxopen']").html('Deconnessione');
	}
	else{
		$("[name='connexion_button_boxopen']").html('Déconnexion');
	}
	$("[name='connexion_button_boxopen']").attr('onclick',"self.location.href='"+current_url_deco+"'");
	loginbox.hide();
	$('.fl_box-1:button').hide();
}
else{
	$('.div_drapeaux').css('top','0px');
	$("#masthead").animate({top: '0px'}, "slow");
	$(".site-header").animate({top: '0px'}, "slow");
	/* interdire enregistre */
}
/*
Cache une header image sur le page d'événement
*/
$('.page-header').hide();
$("[name='connexion_button_boxopen'], #con_resa").click(function(){
  var isDisplay = loginbox.css('display');
    if (isDisplay=='block' || !$('#lwa_wp-submit').is(':hidden')){
        loginbox.hide();
		if(!$('#lwa_wp-submit').is(':hidden')){
			if(cjm_object.current_lang=='it'){
				$("[name='connexion_button_boxopen']").html('Deconnessione');
			}
			else{
				$("[name='connexion_button_boxopen']").html('Déconnexion');
			}
			$('.fl_box-1:button').hide();
			$("[name='connexion_button_boxopen']").attr('onclick',"self.location.href='"+current_url_deco+"'");
		}
    }
    else{
		if($('#lwa_wp-submit').is(':hidden')){
			if(cjm_object.current_lang=='it'){
				$("[name='connexion_button_boxopen']").html('Connessione');
				// <p id="connessione" style="margin-right:-30px;">Connessione</p>
			}else{
				$("[name='connexion_button_boxopen']").html('Connexion');
			}
		}
		else {
			if(cjm_object.current_lang=='it'){
				$("[name='connexion_button_boxopen']").html('Deconnessione');
			}
			else{
				$("[name='connexion_button_boxopen']").html('Déconnexion');
			}
			loginbox.hide();
			$("[name='connexion_button_boxopen']").attr('onclick',"self.location.href='"+current_url_deco+"'");
		}
		var isDeco = $('#wp-logout').html(); // récup le contenu html du bouton se déconnecter
		if (isDeco=="Déconnexion" || isDeco=="Deconnessione" && $('#wp-logout').is(":visible")){
			loginbox.hide();
		}
		else {
        	loginbox.show();
        	loginbox.addClass("loginbox");
        	if(event.target.id!="con_resa")
        	{
        		loginbox.removeClass("login_resa_phone");
        	}
		}
    	if(cjm_object.current_lang=='it'){
    		$('.lwa-username-label label').text("Indirizzo mail");
    	}
    	if(cjm_object.current_lang=='fr'){
    		$('.lwa-username-label label').text("Adresse mail");
    	}
    	if($(this)[0].id=="con_resa")
			{
				$('.loginbox').addClass("login_resa_phone");
			}
    }
});
loginbox.append('<div id=\"croix_login\" class=\"croix_ferm\">x</div>');
$('#croix_login').click(function(){
	loginbox.hide();
});

$("form-lightbox-1").detach().prependTo("#cboxClose");
$("form-lightbox-1").prependTo("#cboxClose");
$('.croixfermeture').click(function(){
	$('#cboxOverlay').css('display','none');
	$('#cboxContent').css('display','none');
	location.reload();
});


//Affichage du prix dynamique

 $(".ipt_modif_resa_form").bind('keyup mouseup', function () {
 	$("#span_prix").empty();
 	var role_user = $("#ipt_role_user").attr("value");
 	var prix_adt = $("#ipt_prix_adulte").attr("value");
 	var prix_enf = $("#ipt_prix_enfant").attr("value");
 	var prix_adh = $("#ipt_prix_adherent").attr("value");
 	var prix = 0;

 	if($(this).attr("name") == 'pl_adulte' || $(this).attr("name") == 'pl_enfant'){
 		 if(role_user == 1){
 		 	prix_adt = prix_adh;
 		 }

 		 prix = prix_adt * $("#ipt_place_adt").attr("value") + prix_enf * $("#ipt_place_enf").attr("value");
 	}

 	if($(this).attr("name") == 'pl_adulte_upd' || $(this).attr("name") == 'pl_enfant_upd'){

 		 if(role_user == 1){
 		 	prix_adt = prix_adh;
 		 }
 		 prix = prix_adt * $("#iptupd_place_adt").attr("value") + prix_enf * $("#iptupd_place_enf").attr("value");
 	}

    $("#span_prix").append(prix.toFixed(2));
});

  //cjm_object.admin_url

	// document.querySelector( "#nav-toggle" )
 //  .addEventListener( "click", function() {
 //    this.classList.toggle( "active" );
 //  });

 // sidebarrebackgund
 // var hauteufenetre = $("#content").outerHeight();
 // if(window.innerWidth>980){
 // 	if($("#primary").height()>1350){
 // 		hauteufenetre = $("#primary").height()+120;
 // 	}
 // 	 else {
 // 	first_aside = $("#secondary").children().eq(0)[0].clientHeight;
 // 	if($("#secondary aside").length==1){
 // 		first_aside = 672;
 // 	}
 // 	console.log(first_aside);
 // 	second_aside =  $("#secondary").children().eq(1)[0].clientHeight;
 // 	console.log(second_aside);
 // 	 	hauteufenetre = first_aside+second_aside+200;
 // 	console.log(hauteufenetre);
 // 	 }
 // }
 // else {
 // 	hauteufenetre = 1350;
 // }
 // $("#secondary").css('width','342px');

 // $("#secondary").css('height',hauteufenetre+'px');
 // if(window.innerWidth>980){
 // $("#secondary").css('position','relative');
 // }


	// Cocher décocher toutes les newsletters
	var bool=0;
		$("#form-wysija-5 p").eq(1).click(function(){
			if(bool==0){
			$(".wysija-checkbox-paragraph label input").attr('checked', true);
			bool=1;
			}
			else{
			$(".wysija-checkbox-paragraph label input").attr('checked', false);
			bool=0;
			}
		});

var url = window.location.search;
var lang = url.substring(url.lastIndexOf("=")+1);

if(lang =="it"){
	$(".srp-widget-title").html("Articoli Recentemente");
	$("#wysija-5 h1").html("Registrati per ricevere la nostra newsletter");
	$(".wysija-checkbox-label").html("Seleziona uno o più Newsletters");
}



});

// Regex profil

	function surligne(champ, erreur)
	{
	   if(erreur)
		  champ.style.border = "medium solid rgb(255, 89, 0)";
	   else
		  champ.style.border = "medium solid rgb(132, 212, 100)";
	}

	function verifPrenom(champ)
	{
		var regex = /[0-9?&~"#{(\[|_\\^@)\]=}$?£µ*%:,\/!,;.?+]/;
	   if(verifField(champ.value,document.getElementById("first_name"),regex) == true)
	   {
		  surligne(champ, true);
		  return false;
	   }
	   else
	   {
		  surligne(champ, false);
		  return true;
	   }
	}

	function verifNom(champ)
	{
		var regex = /[0-9?&~"#{(\[|_\\^@)\]=}$?£µ*%:,\/!,;.?+]/;
	   if(verifField(champ.value,document.getElementById("last_name"),regex) == true)
	   {
		  surligne(champ, true);
		  return false;
	   }
	   else
	   {
		  surligne(champ, false);
		  return true;
	   }
	}


	function verifTel(champ)
	{
		var regex = /[a-zA-Z?&~"#{(\[|_\\^@)\]=}$?£µ*%:\/!,;.?+]/;
	   if(verifField(champ.value,document.getElementById("tel_profil"),regex) == true || champ.value.length > 10 || champ.value.length < 10)
	   {
		  surligne(champ, true);
		  return false;
	   }
	   else
	   {
		  surligne(champ, false);
		  return true;
	   }
	}

	function verifAdresse(champ)
	{
		var regex = /[?&~"#{(\[|_\\^@)\]=}$?£µ*%:\/!;.?+]/;
	   if(verifField(champ.value,document.getElementById("adresse_update"),regex) == true)
	   {
		  surligne(champ, true);
		  return false;
	   }
	   else
	   {
		  surligne(champ, false);
		  return true;
	   }
	}

	function verifCP(champ)
	{
		var regex = /[a-zA-Z?&~"#{(\[|_\\^@)\]=}$?£µ*%:\/!,;.?+]/;
	   if(verifField(champ.value,document.getElementById("codepostal_profil"),regex) == true || champ.value.length > 5 || champ.value.length < 5)
	   {
		  surligne(champ, true);
		  return false;
	   }
	   else
	   {
		  surligne(champ, false);
		  return true;
	   }
	}

	function verifVille(champ)
	{
		var regex = /[0-9?&~"#{(\[|_\\^@)\]=}$?£µ*%:\/!,;.?+]/;
	   if(verifField(champ.value,document.getElementById("ville_profil"),regex) == true)
	   {
		  surligne(champ, true);
		  return false;
	   }
	   else
	   {
		  surligne(champ, false);
		  return true;
	   }
	}

	function verifAncienMDP(champ)
	{
	   if(champ.value.length < 2 || champ.value.length > 25)
	   {
		  surligne(champ, true);
		  return false;
	   }
	   else
	   {
		  surligne(champ, false);
		  return true;
	   }
	}

	function verifNewMDP(champ)
	{
	   if(champ.value.length < 5 || champ.value.length > 25)
	   {
		  surligne(champ, true);
		  return false;
	   }
	   else
	   {
		  surligne(champ, false);
		  return true;
	   }
	}

	function verifNewMDP2(champ)
	{
	   if(champ.value.length < 2 || champ.value.length > 25)
	   {
		  surligne(champ, true);
		  return false;
	   }
	   else
	   {
		  surligne(champ, false);
		  return true;
	   }
	}

	function verifField(chaine,phrase,regex){
		if(regex.test(chaine) == false){
			return false;
		}else{
			return true;
		}
	}
