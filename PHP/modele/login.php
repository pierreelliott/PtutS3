<?php
//    $serveur = "phpmyadmin.alwaysdata.com";
//    $utilisateur = "sushinoss";
//    $mdp = "sushinos";
//    $base = "sushinoss_bd";
    
	if($_SERVER["SERVER_NAME"] == "localhost")
	{
		$serveur = "localhost";
		$utilisateur = "root";
		$mdp = "";
		$base = "ptuts3";
	}
	else if($_SERVER["SERVER_NAME"] == "iutdoua-web.univ-lyon1.fr")
	{
		$serveur = "localhost";
		$utilisateur = "p1503940";
		$mdp = "241638";
		$base = "p1503940";
	}
    

