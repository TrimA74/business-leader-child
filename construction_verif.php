<?php
 session_start();

if($_POST["pass"]=="Meythet74Capaci-jumelage"){
	$_SESSION["construction_login_admin"]="connecte";
	header('Location: http://meythet-capaci.com?success=connecte');
}
else{
	$_SESSION["construction_login_admin"]="nop";
	header('Location: http://meythet-capaci.com/wp-content/themes/business-leader-child/construction.php?success=nonconnecte');
}