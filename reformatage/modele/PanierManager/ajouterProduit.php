<?php

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