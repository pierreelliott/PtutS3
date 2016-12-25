<?php
	session_start();
	/* Son but rediriger en fonction de la page où l'on se trouve vers le bon controleur */

	include_once("carteControleur.php");
	include_once("connexionControleur.php");
	include_once("deconnexionControleur.php");
	include_once("inscriptionControleur.php");
	include_once("panierControleur.php");
?>
