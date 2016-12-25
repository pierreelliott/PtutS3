<?php

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