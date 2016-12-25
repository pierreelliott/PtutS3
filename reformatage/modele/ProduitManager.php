<?php
    require_once("modele/Model.php");

    class ProduitModel extends Model
    {
		require_once("ProduitManager/fonctions.php");
		
		/* ===== Description fonctions =====
		
		########
		# public function getInformationsProduit($numProduit)
		{return numProduit, libelle, description, prix, sourcePetit, sourceMoyen, sourceGrand}
		
		########
		# public function supprimerProduit($numProduit)
		{return 	- true si succès
					- false si échec (plus d'1 produit supprimé)
		}
		
		######## (Pas terminée)
		# public function ajouterProduit($libelle, $description, $typeProduit, $prix, $sourcePetit, $sourceMoyen, $sourceGrand, $compatibilite = null)
		{void}
		
		######## (Pas faite)
		# public function modifierProduit($numProduit)
		{return [...]}
		
		######## (Pas faite)
		# public function ajouterCompatibilite()
		{return [...]}
		
		
		============= Fonctions sur la carte des produits =============
		
		########
		# public function recupererCarte($tailleImage)
			//tailleImage peut être : grand,grande,moyen,moyenne(par défaut),petit,petite
		{return numProduit, libelle, description, sourceImage, prix}
		//sourceImage renvoyée dépend du paramètre
		
		*/
    }