jQuery(document).ready(function($) {

	$(".ipt_modif_resa_form").bind('keyup mouseup', function () {         
    });

  function get_logged_user() {
       var data = {
      'action': 'get_logged_user'
      };
      return Promise.resolve(jQuery.post(cjm_object.ajax_url, data,function (data) {  
        },"json"));
    }

	get_logged_user().then(function (data) {
		console.log(data);
	});


var loginbox = $('#login-box');
$("#gwolle_gb").prepend('<button style="text-align:center;" param="livreor" type="button" id="con_resa" value="se connecter">Connectez vous pour écrire un message</button>');
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
	/* à voir $("#cboxLoadedContent").removeAttr("style");
	$("#cboxLoadedContent").css("width", '900px');
	$("#cboxLoadedContent").css("overflow","hidden");
	$("#cboxLoadedContent").css("height","640px");
*/
// $("#con_resa").click(function () {
// loginbox.show();

// });

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
$('#btnIns, #ins_resa').click(function(){
		$('#lightboxIns').css('display','block');
	});
$('#btnIns, #ins_resa').click(function(){
	$('#cboxOverlay').css('display','block');
	$('#cboxContent').css('display','block');
});
if(cjm_object.is_connected==1)
{
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
	$("[name='connexion_button_boxopen']").html('Déconnexion');
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
$('.page-header').hide();


$("[name='connexion_button_boxopen'], #con_resa").click(function(){	
		  var isDisplay = $('#login-box').css('display');
	        if (isDisplay=='block' || !$('#lwa_wp-submit').is(':hidden'))
					{
	            loginbox.hide();
							if(!$('#lwa_wp-submit').is(':hidden'))
							{
								$("[name='connexion_button_boxopen']").html('Déconnexion');
								$('.fl_box-1:button').hide();
								$("[name='connexion_button_boxopen']").attr('onclick',"self.location.href='"+current_url_deco+"'");
							}
	        }
	        else
					{
						if($('#lwa_wp-submit').is(':hidden'))
							{
								$("[name='connexion_button_boxopen']").html('Connexion');
							}
						else
							{
									$("[name='connexion_button_boxopen']").html('Déconnexion');
									loginbox.hide();
									$("[name='connexion_button_boxopen']").attr('onclick',"self.location.href='"+current_url_deco+"'");
							}

						var isDeco = $('#wp-logout').html(); // récup le contenu html du bouton se déconnecter
						if (isDeco=="Déconnexion" && $('#wp-logout').is(":visible"))
							{
								loginbox.hide();
							}
						else
							{
		        	loginbox.show();
		        	loginbox.addClass("loginbox");
							}
	        	
	        	if(cjm_object.current_lang=='it')
	        	{
	        		$('.lwa-username-label label').text("Indirizzo mail");       
	        	}
	        			if(cjm_object.current_lang=='fr')
	        	{
	        		$('.lwa-username-label label').text("Adresse mail");
	        	}
	        	if($(this)[0].id=="con_resa")
					{
						$('.loginbox').css("top","40%"); $('.loginbox').css("right","50%");

					}
					else {
						$('.loginbox').css("top","5vw"); $('.loginbox').css("right","0");
					}
	        }
	});
$('#login-box').append('<div id=\"croix_login\" class=\"croix_ferm\">x</div>');
$('#croix_login').click(function(){
	$('#login-box').hide();
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
    
 	
    console.log("test");
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
 var hauteufenetre = $("#content").height();
 $("#secondary").css('width','342px');
 $("#secondary").css('height',hauteufenetre+'px');


	// Cocher décocher toutes les newsletters
	var bool=0;
		$("#form-wysija-6 p").eq(1).click(function(){
			if(bool==0){
			$(".wysija-checkbox-paragraph label input").attr('checked', true);
			bool=1;
			}
			else{
			$(".wysija-checkbox-paragraph label input").attr('checked', false);
			bool=0;
			}
		});
	

	
});

// Regex profil

function surligne(champ, erreur)
	{
	   if(erreur)
		  champ.style.border = "medium solid red";
	   else
		  champ.style.border = "medium solid green";
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

	
	function verifForm(f)
	{
	   // var pseudoOk = verifPrenom(f.identite);
	   /*if(pseudoOk && mailOk && sujetOk && messageOk){
		  document.getElementById("validation_formulaire").innerHTML = "Votre message a bien été pris en compte et sera traité dans les plus brefs délais.";
		  return true;
	   }else
	   {
		  document.getElementById("validation_formulaire").innerHTML = "Veuillez vérifier les champs du formulaire.";
		  return false;
	   }*/
	}
