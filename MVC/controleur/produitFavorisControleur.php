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

        public function deleteProduitFavoris($NumProduit)
        {
            $resultat = $this->um->deleteProduitFavoris($_SESSION["utilisateur"]["pseudo"], $NumProduit);
        }
    }
