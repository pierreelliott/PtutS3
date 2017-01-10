<?php
    include_once('modele/PanierManager.php');
	require_once("modele/ProduitManager.php");

    class panierControleur
    {
        public $panier;
        public $produit;

        public function __construct()
        {
          $this->panier = new PanierManager;
	        $this->produit = new ProduitManager;
        }

        public function afficherPanier()
        {
            if(isset($_POST["action"]) and isset($_POST["produit"]))
            {
			          $numProduit = $_POST["produit"];

        				switch ($_POST["action"])
        				{
        					case "ajout":
        						$this->panier->ajouterProduit($numProduit);
        					break;

        					case "suppression":
        						$this->panier->supprimerProduit($numProduit);
        					break;

        					case "modification":
        						if(isset($_POST["qte"]))
        						{
        							$this->panier->changerQuantiteProduit($numProduit, $_POST["qte"]);
        						}
        					break;

        					default : echo 'L\'action demandée n\'est pas reconnue';
        				}

                /*$tabParams = explode(',', $_POST["produit"]);
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
                }*/
            }

      			$estVide = ($this->panier->estVide());

      			$produits = array();
      			foreach($_SESSION["panier"] as $numProduit => $prod)
      			{
      				$qte = $prod["quantite"];
      				$p = $this->produit->getInformationsProduit($numProduit);

      				$produit = array(
      							"libelle" => $p["libelle"],
      							"description" => $p["description"],
      							"quantite" => $qte,
      							"prix" => $p["prix"],
      							"prixTotal" => $p["prix"]*$qte,
      							"sourcePetit" => $p["sourcePetit"],
      							"sourceMoyen" => $p["sourceMoyen"],
      							"sourceGrand" => $p["sourceGrand"]
      				);

      				$produits[$numProduit] = $produit;
      			}

      			$quantiteTotale = $this->panier->getQteTotale();
      			$prixTotal = $this->panier->getPrixPanier();

            include_once('vue/panier.php');
        }
    }
