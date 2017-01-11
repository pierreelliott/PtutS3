<?php
	session_start();
	/* Son but rediriger en fonction de la page où l'on se trouve vers le bon controleur */


	# On crée un formulaire invisible pour demander l'appel d'une page

	if(isset($_POST["page"]))
	{
		$page = $_POST["page"];
	}
	else
	{
		$page = "accueil";
	}

	# Inclusion des différents contrôleurs
	include_once("carteControleur.php");
	include_once("connexionControleur.php");
	include_once("controleurUtilisateur.php");
	//include_once("controleurAdministration.php");
	include_once("deconnexionControleur.php");
	include_once("inscriptionControleur.php");
	include_once("panierControleur.php");

	# Instanciation des contrôleurs
	$carte = new carteControleur();
	$connexion = new connexionControleur();
	$utilisateur = new controleurUtilisateur();
	$inscription = new inscriptionControleur();
	$panier = new panierControleur();


	switch($page)
	{
		case "carte":
			$carte->carte();
			break;

		case "connexion":
			$connexion->connexion();
			break;

		case "utilisateur":
			$utilisateur->afficherInfos();
			break;

		case "deconnexion":
			deconnexion();
			break;

		case "inscription":
			$statut = $inscription->inscription();
			if($statut)	$connexion->connexion();
			break;

		case "panier":
			$panier->afficherPanier();
			break;

		case "accueil":
			include_once("vue/accueil.php");
			break;

		case "contact":
			include_once("vue/contact.php");
			break;

		case "avis":
			include_once("vue/avis.php");
			break;

		case "commande":
		case "historiqueCommandes":
		case "administration":
		default:
			include_once("vue/404.php");
			break;
	}
?>
