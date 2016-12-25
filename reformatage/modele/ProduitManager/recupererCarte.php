<?php

	public function recupererCarte($tailleImage)
	{
		switch($tailleImage)
		{
		# Oui je me suis tapé un petit kiff,
		# on peut accorder en genre ou non le paramètre :-)
			case "grand":
			case "grande":
				$requete = "select numProduit, libelle, description, sourceGrand, prix from produit p join image i on p.numImage = i.numImage;";
			break;
		
			case "petit":
			case "petite":
			$requete = "select numProduit, libelle, description, sourcePetit, prix from produit p join image i on p.numImage = i.numImage;";
		
			case "moyen":
			case "moyenne":
			default:
			$requete = "select numProduit, libelle, description, sourceMoyen, prix from produit p join image i on p.numImage = i.numImage;";
		}
		$resultat = $this->executerRequete($requete);

		return $resultat;
	}