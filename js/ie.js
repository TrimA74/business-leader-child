jQuery(document).ready(function($) { 
	
var loginbox = $('#login-box');
loginbox.hide();
$("#btnconnec").click(function() {
	if(loginbox.css('display')=='none')
	{
		loginbox.show();
	}
	else {
		loginbox.hide();
	}
});





});