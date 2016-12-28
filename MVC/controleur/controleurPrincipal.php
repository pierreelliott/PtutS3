<?php
	session_start();
	/* Son but rediriger en fonction de la page où l'on se trouve vers le bon controleur */

	$page = "accueil";
	# On crée un formulaire invisible pour demander l'appel d'une page
	//$page = $_POST["page"];
	
	switch($page)
	{
		case "carte":
			include_once("carteControleur.php");
			break;
			
		case "connexion":
			include_once("connexionControleur.php");
			break;
		
		case "deconnexion":
			include_once("deconnexionControleur.php");
			break;
		
		case "inscription":
			include_once("inscriptionControleur.php");
			break;
		
		case "panier":
			include_once("panierControleur.php");
			break;
		
		case "accueil":
		default:
			include_once("vue/accueil.php");
	}
	
	
	
	
	
	
	
?>
