<?php
    include_once('modele/PanierManager.php');
	
    class panierControleur
    {
        public $panier;

        public function __construct()
        {
            $this->panier = new PanierManager;
        }

        public function afficherPanier()
        {
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
                            $this->panier->ajouterProduit($tabParams);
                        break;

                        case "suppression":
                            $this->panier->supprimerProduit($tabParams);
                        break;

                        case "modification":
                            $this->panier->changerQuantiteProduit($tabParams[1], 1);
                            # Nécessite une modification supérieure (ajouter la quantité en paramètre)

                        default : echo 'L\'action demandée n\'est pas reconnue';
                    }
                }      
            }

            include_once('vue/panier.php');
        }
    }