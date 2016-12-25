<?php

	public function getInformationsProduit($numProduit)
	{
		$requete = "select numProduit, libelle, description, prix, sourcePetit, sourceMoyen, sourceGrand from produit p join image i on p.numImage = i.numImage where numProduit = ?;";
		$resultat = $this->executerRequete($requete);
		$resultat = $resultat->fetch();
		
		return $resultat;
	}