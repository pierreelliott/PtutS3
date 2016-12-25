<?php

	public function getAvis($pseudo)
	{
		$user = $um->getNumUser($pseudo);

		$resultat = $this->executerRequete('select avis, note, date from avis where numUser = ?', array($user))
		$resultat = $resultat->fetch();

		return $resultat;
	}