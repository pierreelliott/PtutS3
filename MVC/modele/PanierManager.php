<?php
    require_once("Model.php");

    class PanierManager extends Model
    {
		# Constructeur du panier
		# Fonctionne comme n'importe quel constructeur (mais pas d'appel implicite au constructeur parent)

		/* Description variables du panier */
		#Ce serait bien que tu décrives un peu les variables du panier Axel, parce que j'ai pas tout suivi ^^'
                # ==> en gros on a un champ "panier" dans $_SESSION puis les numéros de produit dans $_SESSION["panier"]
                #     et dans chaque case $_SESSION["panier"][$numproduit] on a les données du produits (libellé, prix, image, qte...)

		public function __construct()
		{
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
            return $_SESSION["panier"][$numProduit]["quantite"] * $_SESSION["panier"][$numProduit]["prix"];
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

		public function ajouterProduit(array $produit)
        {
            if(isset($_SESSION["panier"][$produit[0]]))
            {
                $_SESSION["panier"][$produit[0]]["quantite"] += 1;
            }
            else
            {
                $tmp = array(
                    "libelle" => $produit[1],
                    "description" => $produit[2],
                    "source" => $produit[3],
                    "quantite" => 1,
                    "prix" => $produit[4]
                );

                $_SESSION["panier"][$produit[0]] = $tmp;
            }

            header('Location: index.php?page=carte');
        }

		public function supprimerProduit(array $produit)
        {
            unset($_SESSION["panier"][$produit[0]]);
        }

		public function changerQuantiteProduit(array $produit, $quantite)
		{
			if(isset($_SESSION["panier"][$produit[0]]))
			{
				$_SESSION["panier"][$produit[0]]["quantite"] += $quantite;
        if($_SESSION["panier"][$produit[0]]["quantite"] <= 0)
        {
          $this->supprimerProduit($produit);
        }
			}
			else
			{
				// Erreur ! (à gérer)
			}
		}
    }
