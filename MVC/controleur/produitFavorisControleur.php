<?php

    require_once('modele/UserManager.php');
	require_once('modele/ProduitManager.php');

    class produitFavorisControleur
    {
        private $um, $produit;

        public function __construct()
        {
            $this->um = new UserManager();
			$this->produit = new ProduitManager();
        }

        //Affiche les produits favoris sans tester la connexion
        public function afficherProduitFavoris()
        {
			if(isset($_SESSION["utilisateur"]["pseudo"])) {
	            //Contient tous les produits favoris avec tous les détails
	            $produitsFav = $this->um->getProduitsFavoris($_SESSION["utilisateur"]["pseudo"]);

				foreach ($produitsFav as $key => $produit) {
					$partie = explode(".", $produit["typeProduit"]);
					$produitsFav[$key]["estMenu"] = (strcmp( $partie[0] , "menu") == 0);

					$prod = $this->produit->getInformationsProduit($produit["numProduit"]);
					$produitsFav[$key]["sourcePetit"] = $prod["sourcePetit"];
					$produitsFav[$key]["sourceMoyen"] = $prod["sourceMoyen"];
					$produitsFav[$key]["sourceGrand"] = $prod["sourceGrand"];
				}

				// Booléen pour savoir si $produitsFav est vide
				$estVide = (count($produitsFav) == 0);

				include_once("vue/produitsFavoris.php");
			}
			else {
				include_once("vue/404.php");
			}
        }

		public function modifProduitFavoris()
		{
			if(isset($_SESSION["utilisateur"]["pseudo"]))
            {
                $numProduit = $_GET["numProduit"];

                //Teste si le produit est un produit favoris
				if($this->um->estFavoris($_SESSION["utilisateur"]["pseudo"], $numProduit) == false)
                {
                    $resultat = $this->um->addProduitFavoris($_SESSION["utilisateur"]["pseudo"], $numProduit);

                }
                //Le produit est favoris
				elseif($this->um->estFavoris($_SESSION["utilisateur"]["pseudo"], $numProduit) == true)
                {
                    $resultat = $this->um->deleteProduitFavoris($_SESSION["utilisateur"]["pseudo"], $numProduit);
                }
                else
                {
                    $erreur = "Impossible de supprimer ce produit car ce n'est pas un de vos produit favoris";
                }

				header("Location: /carte");
            }
            else {
                include_once("vue/404.php");
            }
		}

        //Supprime un produit favoris a l'utilisateur
        public function deleteProduitFavoris()
        {
            //Teste si l'utilsateur est connecté
            if(isset($_SESSION["utilisateur"]["pseudo"]))
            {
                $NumProduit = $_GET["numProduit"];

                //Teste si le produit est un produit favoris
                if($this->um->estFavoris($_SESSION["utilisateur"]["pseudo"], $NumProduit) == true)
                {
                    $resultat = $this->um->deleteProduitFavoris($_SESSION["utilisateur"]["pseudo"], $NumProduit);
                }
                else
                {
                    $erreur = "Impossible de supprimer ce produit car ce n'est pas un de vos produit favoris";
                }
            }
            else {
                include_once("vue/404.php");
            }
        }

        //Ajoute un produit favoris a l'utilisateur
        public function addProduitFavoris()
        {
            //Teste si l'utilsateur est connecté
            if(isset($_SESSION["utilisateur"]["pseudo"]))
            {
                $NumProduit = $_GET["numProduit"];

                //Teste si le produit est n'est pas déjà un produit favoris
                if($this->um->estFavoris($_SESSION["utilisateur"]["pseudo"], $NumProduit) == false)
                {
                    $resultat = $this->um->addProduitFavoris($_SESSION["utilisateur"]["pseudo"], $NumProduit);
                }
                else
                {
                    $erreur = "Impossible d'ajouter ce produit car il fait déjà parti vos produit favoris";
                }
            }
            else {
                include_once("vue/404.php");
            }
        }
    }
?>
