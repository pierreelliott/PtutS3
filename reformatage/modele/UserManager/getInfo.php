<?php

	public function getInfo($pseudo)
	{
		$requete = $this->executerRequete('select nom, prenom, mail, ville, rue, codePostal, telephone, pseudo, numRue, dateInscription
										from utilisateur
										where pseudo= ?', array($pseudo));
		$data = $requete->fetch();
		return $data;
	}