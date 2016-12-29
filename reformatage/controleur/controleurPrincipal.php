<?php
	session_start();
	/* Son but rediriger en fonction de la page où l'on se trouve vers le bon controleur */

	
	# On crée un formulaire invisible pour demander l'appel d'une page
	
	/*if(isset($_POST["page"])) $page = $_POST["page"];
	else $page = "accueil";*/
	
	if(isset($_GET["page"])) $page = $_GET["page"];
	else $page = "accueil";
	
	switch($page)
	{
		case "carte":
			include_once("carteControleur.php");
			$carte = new carteControleur();
			$carte->carte();
			break;
			
		case "connexion":
			include_once("connexionControleur.php");
			$connexion = new connexionControleur();
			$connexion->connexion();
			break;
		
		case "deconnexion":
			include_once("deconnexionControleur.php");
			break;
		
		case "inscription":
			include_once("inscriptionControleur.php");
			$inscription = new inscriptionControleur();
			$inscription->inscription();
			break;
		
		case "panier":
			include_once("panierControleur.php");
			$panier = new panierControleur();
			$panier->afficherPanier();
			break;
		
		case "accueil":
			include_once("vue/accueil.php");
			break;
			
		default:
			include_once("vue/404.php");
			break;
	}
	
	
	
	
	
	
	
?>
