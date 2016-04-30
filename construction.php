<?php 

 session_start();
 $_SESSION["construction_login_admin"]="nop";
?>

 <!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Site en construction</title>
  <link rel="stylesheet" href="style.css">
</head>
<body style="background-image: url(images/bg_construct.jpg); width:100%; height:100%;">
	<form action="construction_verif.php" method="POST">
		<div style="height:300px;width:400px;background-color: rgba(0, 0, 0, 0.7); margin-left:35%;margin-top:15%;  border-radius: 10px;">
			<p style="color:white; margin-left:25px;margin-right:25px;">Le site étant en construction, vous devez être administrateur afin d'y accéder.</p>
			<input type="password" name="pass" placeholder="Mot de passe" style="margin-left:50px; margin-top:50px;"/> 
			<input type="submit" value="Valider" style="margin-left:150px; margin-top:50px; color:white; border-color:white;"/>
		</div>
	</form>
</body>
</html>