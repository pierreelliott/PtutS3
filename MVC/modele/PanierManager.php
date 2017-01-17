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
				$_SESSION["nbProduit"] = 0;
			}
		}

		public function estVide()
        {
            if(empty($_SESSION["panier"]))
            {
              return 1;
            }
            else
            {
              return 0;
            }
        }

        //Vide le panier après une commande
        public function viderPanier()
        {
            $_SESSION["panier"] = array();
            $_SESSION["nbProduit"] = 0;
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
				$_SESSION["panier"][$numProduit] = array("quantite" => $quantite,
                                                            "numProduit" => $numProduit);
            }

			$_SESSION["nbProduit"] += 1;

            header('Location: index.php?page=carte');
        }

		public function supprimerProduit($numProduit)
        {
			$_SESSION["nbProduit"] -= $_SESSION["panier"][$numProduit]["quantite"];
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

			$_SESSION["nbProduit"] += $quantite;
		}
    }
