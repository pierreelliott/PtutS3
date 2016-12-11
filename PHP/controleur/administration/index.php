<?php
//    include("modele/administration/AdministrationModele.php");
    
    session_start();

    if(isset($_GET["action"]))
    {
        switch($_GET["action"])
        {
            case "ajout" :
                include("vue/administration/ajoutProduit.php");
            break;
            case "modification" :
                include("vue/administration/modificationProduit.php");
            break;
            case "suppression" :
                include("vue/administration/suppressionProduit.php");
            break;
            default :
                include("vue/404.php");
        }   
    }
    else
    {
        include("vue/404.php");
    }
    
