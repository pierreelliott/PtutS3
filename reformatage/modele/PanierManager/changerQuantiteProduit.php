<?php

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