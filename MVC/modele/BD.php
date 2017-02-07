<?php
    if($_SERVER["SERVER_NAME"] == "localhost")
    {
            $serveur = "localhost";
            $utilisateur = "root";
            $mdp = "";
            $base = "ptuts3";
    }
    else if($_SERVER["SERVER_NAME"] == "sushinoss.alwaysdata.net")
    {
            $serveur = "mysql-sushinoss.alwaysdata.net";
            $utilisateur = "sushinoss";
            $mdp = "sushinos";
            $base = "sushinoss_bd";
    }
    else if ($_SERVER["SERVER_NAME"] == "ptuts4") {
        $serveur = "localhost";
        $utilisateur = "root";
        $mdp = "";
        $base = "ptut";
    }
    else
	{
			$serveur = "iutdoua-web.univ-lyon1.fr";
            $utilisateur = "p1402690";
            $mdp = "212340";
            $base = "p1402690";
	}
?>
