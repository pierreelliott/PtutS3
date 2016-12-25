<?php
    require_once("modele/Model.php");

    class PanierModel extends Model
    {
		# Constructeur du panier
		# Fonctionne comme n'importe quel constructeur (mais pas d'appel implicite au constructeur parent)
		public function __construct()
		{
			if(!isset($_SESSION["panier"]))
			{
				$_SESSION["panier"] = array();
				$_SESSION["panier"]["libelle"] = array();
				$_SESSION["panier"]["description"] = array();
				$_SESSION["panier"]["sourceMoyen"] = array();
				$_SESSION["panier"]["quantite"] = array();
				$_SESSION["panier"]["prix"] = array();
			}
		}
		
		require_once("PanierManager/fonctions.php");
		
		/* ======= Description fonctions =======
		
		#########
		# public function getPrixPanier()
		{return prixTotalPanier}
		
		#########
		# public function ajouterProduit($Produit)
		{return void}
		
		######### (à terminer)
		# public function supprimerProduit($libelleProduit)
		{return void}
		
		######### (à terminer)
		# public function changerQuantiteProduit($libelleProduit, $quantite)
		{return void}
		
		*/
		
		/*
        public function recupererPanier()
        {
			# Vraiment utile ?
			# Etant donné qu'on le récupère toujours par les variables de session
			# Puis surtout je vois pas trop en quoi c'est plus pratique que $_SESSION
        }
		*/
    }