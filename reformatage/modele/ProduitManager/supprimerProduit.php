<?php

	public function supprimerProduit($numProduit)
	{
		$produit = self::getInformationsProduit($numProduit);
		$produit = $produit->fetch();
		$prix = floatval((-1)*floatval($produit["prix"]));
		
		$requete = "update produit set prix = :prix where numProduit = :numProduit";
		$params = array(
				'prix' => $prix,
				'numProduit' => $numProduit
				);
		$resultat = $this->executerRequete($requete, $params);
		$resultat = $resultat->fetch();
		
		# Si on supprime plus d'1 produit, on dit qu'il y a eu une erreur
		if($resultat == 1) return true;
		else return false;
	}