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
            if(isset($_POST["action"]) and isset($_POST["produit"]))
            {
                $tabParams = explode(',', $_POST["produit"]);
                if(count($tabParams) != 5 and count($tabParams) != 6)
                {
                    echo "Le produit n'est pas reconnu";
                }
                else
                {
                    switch ($_POST["action"])
                    {
                        case "ajout":
                            $this->panier->ajouterProduit($tabParams);
                        break;

                        case "suppression":
                            $this->panier->supprimerProduit($tabParams);
                        break;

                        case "modification":
                            if(isset($_POST["qte"]))
                            {
                                $this->panier->changerQuantiteProduit($tabParams, $_POST["qte"]);
                            }
                        break;

                        default : echo 'L\'action demandée n\'est pas reconnue';
                    }
                }
            }

            include_once('vue/panier.php');
        }
    }
