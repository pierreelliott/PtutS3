<?php
    require_once("Model.php");

    class PanierManager extends Model
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
		
		public function getPrixPanier()
		{
			$resultat = sum($_SESSION["panier"]["prix"]);
			return $resultat;
		}
		
		public function ajouterProduit($Produit)
		{
			$positionProduit = array_search($Produit[1],  $_SESSION["panier"]["libelle"]);
			
			if($positionProduit != false)
				{
					$_SESSION["panier"]["quantite"][$positionProduit] += 1;
				}
			else
			{
				array_push($_SESSION["panier"]["libelle"], $tabParams[1]);
				array_push($_SESSION["panier"]["description"], $tabParams[2]);
				array_push($_SESSION["panier"]["sourceMoyen"], $tabParams[3]);
				array_push($_SESSION["panier"]["quantite"], 1);
				array_push($_SESSION["panier"]["prix"], $tabParams[4]);
				
				/* Quand on pourra faire des ajouts plus précis */
				# array_push($_SESSION["panier"]["quantite"], $tabParams[4]);
				# array_push($_SESSION["panier"]["prix"], $tabParams[5]);
			}
		}
		
		public function supprimerProduit($libelleProduit)
		{
			$positionProduit = array_search($libelleProduit,  $_SESSION["panier"]["libelle"]);
			
			if($positionProduit != false)
			{
				if($_SESSION["panier"]["quantite"][$positionProduit] == 1)
				{
					# On détruit les cases de tableau associées au produit à supprimer
					unset($_SESSION["panier"]["libelle"][$positionProduit]);
					unset($_SESSION["panier"]["description"][$positionProduit]);
					unset($_SESSION["panier"]["sourceMoyen"][$positionProduit]);
					unset($_SESSION["panier"]["quantite"][$positionProduit]);
					unset($_SESSION["panier"]["prix"][$positionProduit]);
					
					# On met à jour les index des tableaux (pour éviter les sauts d'index)
					$_SESSION["panier"]["libelle"] = array_values($_SESSION["panier"]["libelle"]);
					$_SESSION["panier"]["description"] = array_values($_SESSION["panier"]["description"]);
					$_SESSION["panier"]["sourceMoyen"] = array_values($_SESSION["panier"]["sourceMoyen"]);
					$_SESSION["panier"]["quantite"] = array_values($_SESSION["panier"]["quantite"]);
					$_SESSION["panier"]["prix"] = array_values($_SESSION["panier"]["prix"]);
				}
				else
				{
					$_SESSION["panier"]["quantite"][$positionProduit] -= 1;
				}
			}
			else
			{
				// Erreur ! (à gérer)
			}
		}
		
		public function changerQuantiteProduit($libelleProduit, $quantite)
		{
			$positionProduit = array_search($libelleProduit,  $_SESSION["panier"]["libelle"]);
			
			if($positionProduit != false)
			{
				$_SESSION["panier"]["quantite"][$positionProduit] == $quantite;
			}
			else
			{
				// Erreur ! (à gérer)
			}
		}
    }