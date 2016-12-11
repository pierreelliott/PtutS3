<?php
    session_start();
    
    // Si l'utilisateur est connecté on affiche ses informations
    if(isset($_SESSION["utilisateur"]))
    {
        //$bdd = new UtilisateurModel();
        
        //$bdd->recupererInfosUtilisateur($_SESSION["numUser"]);
        include("vue/utilisateur/index.php");
    }
    // Sinon on renvoie à la page d'accueil
    else
    {
        header("Location: index.php");
    }

