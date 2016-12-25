<?php

	public function getProduitsFavoris($pseudo)
	{
		$user = $this->getNumUser($pseudo);
		$resultat = $this->executerRequete('select numImage, description, prix, libelle, typeProduit
											from produit p1 join preference p2
											on p1.NUMPRODUIT = p2.NUMPRODUIT
											where numUser= ?
											order by CLASSEMENT', array($user));

		$data = $resultat->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}