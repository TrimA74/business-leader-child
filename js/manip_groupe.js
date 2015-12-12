

jQuery(document).ready(function($) { 

jQuery(window).load(function() {
						  jQuery(".loader").fadeOut("1000");
						  jQuery(".back_loader").fadeOut("1000");
						});
	/* à voir $("#cboxLoadedContent").removeAttr("style");
	$("#cboxLoadedContent").css("width", '900px');
	$("#cboxLoadedContent").css("overflow","hidden");
	$("#cboxLoadedContent").css("height","640px");
*/


$("#secondary").animate({width: '342px'}, "slow");

$("#primary").animate({opacity: '1'}, 1500);

$('.div_drapeaux').css('position','fixed');

var current_url_deco = cjm_object.logout_link;
$(".category-list").hide();
$(".post-navigation").hide();
$("#wp-admin-bar-adminbar_gc_menu").remove();


var loginbox = $('#login-box');
loginbox.hide();
if($(".wpcf7-mail-sent-ok").is(":visible")){
	$("#cboxLoadedContent").empty();
	$("#cboxLoadedContent").html(".wpcf7-mail-sent-ok");

}
$('body').css('transform','rotate(45)');
$('#btnIns').click(function(){
		$('#lightboxIns').css('display','block');
	})
	
$('#croixfermeture').click(function(){
	$('#cboxOverlay').css('display','none');
	$('#cboxContent').css('display','none');
	location.reload();
});
$('#btnins').click(function(){
	$('#cboxOverlay').css('display','block');
	$('#cboxContent').css('display','block');
});
console.log(cjm_object);
			if(cjm_object.is_connected==1)
			{
				$("#masted").animate({top: '32px'}, "slow");
				$(".site-header").animate({top: '32px'}, "slow");
				// $("#masted").css('top','32px');
				// $(".site-header").css('top','32px');
				$("[name='connexion_button_boxopen']").html('Déconnexion');
				$("[name='connexion_button_boxopen']").attr('onclick',"self.location.href='"+current_url_deco+"'");
				loginbox.hide();
				$('.fl_box-1:button').hide();
				$('.div_drapeaux').css('top','32px');
				
				if($(window).width()<=800)
				{
					$('.div_drapeaux').css('top','48px');
				}
				if($(window).width()<=600)
				{
					$('.div_drapeaux').css('position','absolute');
				}
			}
			else{
					$('.div_drapeaux').css('top','0px');
					$("#masthead").animate({top: '0px'}, "slow");
					$(".site-header").animate({top: '0px'}, "slow");
					/* interdire enregistre */
				}
$('.page-header').hide();



$("[name='connexion_button_boxopen']").click(function(){
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
	        }
	});
$('#login-box').append('<div id=\"croix_login\" class=\"croix_ferm\">x</div>');
$('#croix_login').click(function(){
	$('#login-box').hide();
});

$("form-lightbox-1").detach().prependTo("#cboxClose");
$("form-lightbox-1").prependTo("#cboxClose");
/*
* Envoie du formulaire en AJAX sur ajaxController.php pour réserver un voyage/escapade
*
*/
$(".resa_form").submit(function(){
        
      $.ajax({
        type : "POST",
        dataType: "json",
        url : "https://srv-prj.iut-acy.local/jumelage/Best_wordpress_ever/wordpress/wp-content/plugins/cjm/ajaxController.php",
        data : $(this).serialize(),
        success : function(msg){         
             switch(msg){
             	case 1 : $("#resa_div_id").empty().html("Votre Inscription a bien été prise en compte !").css('color','green');
             			break;
             	case 2 : $("#resa_div_id").html("Veuillez réserver au moins une place !").css('color','bleue');
             	
             	default :$("#resa_div_id").append("Veuillez réserver au moins une place !").css('color','red');
             			break; 
             }   
        }
        
      }); 
      return false;

  });
/*
* Envoie du formulaire en AJAX sur ajaxController.php pour annuler une réservation
*
*/
$(".annul_resa_form").submit(function(){
        
      $.ajax({
        type : "POST",
        dataType: "json",
        url : "https://srv-prj.iut-acy.local/jumelage/Best_wordpress_ever/wordpress/wp-content/plugins/cjm/ajaxController.php",
        data : $(this).serialize(),
        success : function(msgd){        
             switch(msgd){
             	case 1 : $(".annul_resa_div").empty().html("Votre réservation a bien été annulée ! ").css('color','green');
             			break;
             	default : $(".annul_resa_div").append("Veuillez contacter l'administrateur du site").css('color','red');
             			break; 
             }   
        }
        
      }); 
      return false;

  });  

});
