<?php

    require_once('modele/UserManager.php');

    class produitFavorisControleur
    {
        private $um, $produit;

        public function __construct()
        {
            $this->um = new UserManager();
        }

        //Affiche les produits favoris sans tester la connexion
        public function afficherProduitFavoris()
        {
			if(isset($_SESSION["utilisateur"]["pseudo"])) {
	            //Contient tous les produits favoris avec tous les détails
	            $produitsFav = $this->um->getProduitsFavoris($_SESSION["utilisateur"]["pseudo"]);

				// Booléen pour savoir si $produitsFav est vide
				$estVide = true;

				include_once("vue/produitsFavoris.php");
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
