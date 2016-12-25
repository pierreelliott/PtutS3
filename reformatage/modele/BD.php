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
?>