<?php
    include_once('modele/panier/PanierModel.php');
    
    session_start();
    
    // On crée le panier s'il n'existe pas déjà
    if(!isset($_SESSION["panier"]))
    {
        $_SESSION["panier"] = array();
    }
    
    if(isset($_GET["action"]) && isset($_GET["produit"]))
    {
        $tabParams = explode(',', $_GET["produit"]);
        if(count($tabParams) != 5 and count($tabParams) != 6)
        {
            echo "Le produit n'est pas reconnu";
        }
        else
        {
            switch ($_GET["action"])
            {
                case "ajout":

                    if(isset($_SESSION["panier"][$tabParams[0]]))
                    {
                        $_SESSION["panier"][$tabParams[0]]["quantite"] += 1;
                    }
                    else
                    {
                        $tmp = array(
                            "libelle" => $tabParams[1],
                            "description" => $tabParams[2],
                            "source" => $tabParams[3],
                            "quantite" => 1,
                            "prix" => $tabParams[4]
                        );

                        $_SESSION["panier"][$tabParams[0]] = $tmp;
                    }
                    
                    header('Location: carte.php');
                break;
                case "suppression":
                    unset($_SESSION["panier"][$tabParams[0]]);
                break;
                default : echo 'L\'action demandée n\'est pas reconnue';
            }      
        }    
    }
    
    include_once('vue/panier/index.php');