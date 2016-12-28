<?php
    include_once('modele/panierModel.php');

    session_start();

    if(!isset($_SESSION["panier"]))
    {
        $_SESSION["panier"] = array();
        $_SESSION["panier"]["libelle"] = array();
        $_SESSION["panier"]["description"] = array();
        $_SESSION["panier"]["sourceMoyen"] = array();
        $_SESSION["panier"]["quantite"] = array();
        $_SESSION["panier"]["prix"] = array();
    }

    if(isset($_GET["action"]) && isset($_GET["produit"]))
    {
        $tabParams = explode(',', $_GET["produit"]);
        $positionProduit = array_search($tabParams[1],  $_SESSION["panier"]["libelle"]);

        switch ($_GET["action"])
        {
            case "ajout":
                if($positionProduit !== false)
                {
                    $_SESSION["panier"]["quantite"][$positionProduit] += 1;
                }
                else
                {
                    array_push($_SESSION["panier"]["libelle"], $tabParams[1]);
                    array_push($_SESSION["panier"]["description"], $tabParams[2]);
                    array_push($_SESSION["panier"]["sourceMoyen"], $tabParams[3]);
                    array_push($_SESSION["panier"]["quantite"], 1);
                    array_push($_SESSION["panier"]["prix"], $tabParams[4]);
                }
            break;



            case "suppression":
                $tmp = array();
                $tmp["libelle"] = array();
                $tmp["quantite"] = array();
                $tmp["prix"] = array();

                for($i = 0; $i < count($_SESSION["panier"]["libelle"]); $i++)
                {
                   if ($_SESSION["panier"]["libelle"][$i] !== $tabParams[1])
                   {
                      array_push( $tmp["libelle"],$_SESSION["panier"]["libelle"][$i]);
                      array_push( $tmp["quantite"],$_SESSION["panier"]["quantite"][$i]);
                      array_push( $tmp["prix"],$_SESSION["panier"]["prix"][$i]);
                   }
                }
                //On remplace le panier en session par notre panier temporaire à jour
                $_SESSION["panier"] =  $tmp;
                //On efface notre panier temporaire
                unset($tmp);
            break;



            default : echo 'L\'action demandée n\'est pas reconnue';
        }
    }

    include_once('vue/panier.php');
