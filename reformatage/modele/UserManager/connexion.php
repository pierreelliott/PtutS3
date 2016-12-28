<?php

	public function connexion($pseudo, $mdpHash)
	{
		$requete = "select numUser from utilisateur where pseudo = :pseudo and mdp = :mdpHash";

		$params = array(
			'pseudo' => $pseudo,
			'mdpHash' => $mdpHash
			);

		$resultat = $this->executerRequete($requete, $params);

		return $resultat;
	}