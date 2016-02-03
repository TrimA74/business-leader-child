<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Business Leader
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head();?>
<?php 
//if( !current_user_can( 'manage_options' ) ) {
?>
<!--<script>
	function clickIE()
		{
			if (document.all) {
				(message);return false;
			}
		}
		function clickNS(e) {
			if(document.layers||(document.getElementById&&!document.all)) {
				if (e.which==2||e.which==3) {
					(message);return false;
				}
			}
		}
		if (document.layers){
			document.captureEvents(Event.MOUSEDOWN);
			document.onmousedown=clickNS;
		}
		else{
			document.onmouseup=clickNS;
			document.oncontextmenu=clickIE;
			}
		document.oncontextmenu=new Function("return false");
</script>-->
<?php
/*}*/
?>
 
</head>

<body <?php body_class(); ?>>
	<div class="loader"></div>
	<div class="back_loader"></div>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'bus_leader' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<button id="btnconnec"  name="connexion_button_boxopen">Connexion</button>
		<button id="btnins"  href= <?php	echo do_shortcode( '[formlightbox title="" text="Inscription"]
					[cfp id="62" title="Sans titre" pwd="insPasswd"][/formlightbox]' );?></button>
			<?php 
					
			        $site_url = get_site_url();
			       	$current_get=$_GET;
			        $current_site_url = $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
			    ?>
			 
		<div id="nav-menu-toggle" class="menu-toggle">
		    <i class="fa fa-bars"></i>
		    <a href="#site-navigation" class="screen-reader-text"><?php _e( 'Menu', 'bus_leader' ); ?></a>
		</div><!-- #nav-menu-toggle -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="site-branding">
			<?php if ( get_header_image() ) : ?>
			<div class="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php echo "<img id='logo_header' src='".$site_url."/wp-content/themes/business-leader-child/images/LogoI.png' width='55px' height='80px' alt='' >"; ?>
				</a>
			</div><!-- .logo -->
			<?php endif; // End header image check. ?>
			
		</div><!-- .site-branding -->
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			
				</div> 
			    <div id="login-box" style="display:none;">

				<?php echo do_shortcode('[login-with-ajax]'); ?>
				</div> 
			
				
			<div class="div_drapeaux">
			   	<?php echo "<a href=".$site_url."/?lang=it title='Italiano'>" ?>
			   		<?php echo "<img alt='Italiano' src='".$site_url."/wp-content/plugins/qtranslate-x/flags/it.png'></a>"; ?>
			   	</a>
			   		<?php echo "<a href=".$site_url." title='Français'>" ?>
			   		<?php echo "<img alt='Français' src='".$site_url."/wp-content/plugins/qtranslate-x/flags/fr.png'>"; ?>
			   		
			   	</a>
			</div>
		</nav><!-- #site-navigation -->
		<!--[if !IE]><!-->
		<script type="text/javascript">
						if(cjm_object.is_connected)
						{
							 var data = {
							      'action': 'get_logged_user',
							      'user': 'true'
							      };
							jQuery.post(cjm_object.ajax_url,data,function (data) {	
								
  							},"json");
						}
						if(cjm_object.current_lang!='it')
							cjm_object.current_lang='fr';
						var lang = document.getElementsByClassName("div_drapeaux");
						lang[0].children[0].href = window.location.href+"?lang=it";
						var url = window.location.href;
						if(url.search("fr"))
						{
							lang[0].children[1].href = window.location.href;
						}
						else {
							if(url.search("?"))
							{
								lang[0].children[1].href = window.location.href+"&lang=fr";
							}
							else {
								lang[0].children[1].href = window.location.href+"?lang=fr";
							}
						}
						
						var lienit = lang[0].children[0].href;
						var lienfr = lang[0].children[1].href;
						var newLienfr = lienfr.replace("it","fr");
						var newLienit = lienit.replace("fr","it");
						var nth = 0;
						newLienit = newLienit.replace(/\?/g, function (match, i, original) {
						    nth++;
						    return (nth > 1) ? "&" : match;
						});
						lang[0].children[1].href = newLienfr;
						lang[0].children[0].href = newLienit;
						var current_get='<?php echo $current_get ?>';
						if (cjm_object.is_connected==1) {
							cjm_object.is_connected=true;
						}else {
							cjm_object.is_connected=false;
						}

					
					
						// cjm_object.is_connected est égale à 1(connecté) ou 0
					</script><!--<![endif]-->
					
	</header><!-- #masthead -->

	<?php bus_leader_get_header_container(); ?>

	<div id="content" class="site-content">
	
