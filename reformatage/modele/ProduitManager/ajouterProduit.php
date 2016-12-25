<?php

	public function ajouterProduit($libelle, $description, $typeProduit, $prix, $sourcePetit, $sourceMoyen, $sourceGrand, $compatibilite = null)
	{
		/*$resultat = $this->executerRequete('insert into image values(?, ?, ?)', array($sourcePetit, $sourceMoyen, $sourceGrand));
		$image = $this->executerRequete('select numImage from image where sourcePetit')*/
		/* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! */
		/* !!!!! Comment ajouter les images pour un produit (contraintes clefs étrangères) ? !!!!! */
		/* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! */
		
		# On considère qu'on a le $numImage
		$resultat = $this->executerRequete('insert into produit (libelle,description,typeProduit,prix,numImage)
							values (?,?,?,?,?)', array($libelle, $description, $typeProduit, $prix, $numImage));
		
		
		if($compatibilite == null)
		{
			
		}
	}