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
        public function deleteProduitFavoris($NumProduit)
        {
            //Teste si l'utilsateur est connecté
            if(isset($_SESSION["utilisateur"]["pseudo"]))
            {
                $resultat = $this->um->deleteProduitFavoris($_SESSION["utilisateur"]["pseudo"], $NumProduit);
            }
            else {
                include_once("vue/404.php");
            }
        }

        //Ajoute un produit favoris a l'utilisateur
        public function addProduitFavoris($NumProduit)
        {
            //Teste si l'utilsateur est connecté
            if(isset($_SESSION["utilisateur"]["pseudo"]))
            {
                $resultat = $this->um->addProduitFavoris($_SESSION["utilisateur"]["pseudo"], $NumProduit);
            }
            else {
                include_once("vue/404.php");
            }
        }
    }
