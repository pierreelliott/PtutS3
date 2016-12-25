<?php

	public function getPseudo($pseudo)
	{
		$requete = "select pseudo from utilisateur where pseudo = '?';";
		$resultat = $this->executerRequete($requete, array($pseudo));

		$resultat->fetch();

		return $resultat;
	}