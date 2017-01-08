<?php
    require_once("Model.php");
	require_once("ProduitManager.php");

    class PanierManager extends Model
    {
		public $produit;
		
		# Constructeur du panier
		# Fonctionne comme n'importe quel constructeur (mais pas d'appel implicite au constructeur parent)

		/* Description variables du panier */
		#Ce serait bien que tu décrives un peu les variables du panier Axel, parce que j'ai pas tout suivi ^^'
                # ==> en gros on a un champ "panier" dans $_SESSION puis les numéros de produit dans $_SESSION["panier"]
                #     et dans chaque case $_SESSION["panier"][$numproduit] on a la quantité du produit

		public function __construct()
		{
			$this->produit = new ProduitManager;
			
			if(!isset($_SESSION["panier"]))
			{
				$_SESSION["panier"] = array();
			}
		}

		public function estVide()
        {
            return empty($_SESSION["panier"]);
        }

		public function getQteTotale()
        {
            $resultat = 0;
            foreach($_SESSION["panier"] as $produit)
            {
                $resultat += $produit["quantite"];
            }

            return $resultat;
        }

		public function getPrixTotalProduit($numProduit)
        {
            return $_SESSION["panier"][$numProduit]["quantite"] * $this->produit->getInformationsProduit($numProduit)["prix"];
        }

		public function getPrixPanier()
        {
            $resultat = 0;
            foreach($_SESSION["panier"] as $numProduit => $produit)
            {
                $resultat += $this->getPrixTotalProduit($numProduit);
            }

            return $resultat;
        }

		public function ajouterProduit($numProduit, $quantite = null)
        {
			if($quantite == null) $quantite = 1;
            if(isset($_SESSION["panier"][$numProduit]))
            {
                $_SESSION["panier"][$numProduit]["quantite"] += $quantite;
            }
            else
            {
				$_SESSION["panier"][$numProduit] = array("quantite" => $quantite);
                /*$tmp = array(
                    "libelle" => $produit[1],
                    "description" => $produit[2],
                    "source" => $produit[3],
                    "quantite" => 1,
                    "prix" => $produit[4]
                );

                $_SESSION["panier"][$produit[0]] = $tmp;*/
            }

            header('Location: index.php?page=carte');
        }

		public function supprimerProduit($numProduit)
        {
            unset($_SESSION["panier"][$numProduit]);
        }

		public function changerQuantiteProduit($numProduit, $quantite)
		{
			if(isset($_SESSION["panier"][$numProduit]))
			{
				$_SESSION["panier"][$numProduit]["quantite"] += $quantite;
				if($_SESSION["panier"][$numProduit]["quantite"] <= 0)
				{
				  $this->supprimerProduit($numProduit);
				}
			}
			else
			{
				if($quantite < 0) $quantite = 1;
				$this->ajouterProduit($numProduit, $quantite);
			}
		}
    }
