<?php
	session_start();
	/* Son but rediriger en fonction de la page où l'on se trouve vers le bon controleur */


	# On crée un formulaire invisible pour demander l'appel d'une page

	if(isset($_GET["page"]))
	{
		$page = $_GET["page"];
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
	include_once("commandeControleur.php");
	include_once("paypalControleur.php");
	include_once("adminControleur.php");


	# Instanciation des contrôleurs
	$carte = new carteControleur();
	$connexion = new connexionControleur();
	$utilisateur = new controleurUtilisateur();
	$inscription = new inscriptionControleur();
	$panier = new panierControleur();
	$commande = new CommandeControleur();
	$paypal = new paypalControleur();
	$administration = new AdminControleur();


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

		case "historiqueCommandes":
			$commande->afficherHistorique($_SESSION["utilisateur"]["pseudo"]);
			break;
		case "commande":
			$commande->afficherCommande($_GET['numCommande']);
			break;
		//Appelé lorsque l'on clique sur le bouton payer du panier
		case "paiement":
			$commande->recapCommande();
			break;
		//Si la transaction est annulé
		case "paiementPaypal":
			//Appel a la page de paiement avec le prix du panier
			$paypal->paiementPaypal($_SESSION["prixPanier"]);
		break;
		case "annulePaypal":
			include_once("vue/annulePaypal.php");
			break;
		//Si la transaction s'ést déroulé normalement
		case 'retourPaypal':
			$typeCommande = $_GET["typeCommande"];
			$paypal->retourPaypal($typeCommande);

			include_once("vue/commandeValidee.php");
			break;
		case "administration":
			$administration->administrer();
			break;
		default:
			include_once("vue/404.php");
			break;
	}
?>
