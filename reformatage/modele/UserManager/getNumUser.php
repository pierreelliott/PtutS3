<?php

	public function getNumUser($pseudo)
	{
		$resultat = $this->executerRequete('select numUser from utilisateur where pseudo = ?', array($pseudo));
		$resultat->fetch();

		return $resultat;
	}