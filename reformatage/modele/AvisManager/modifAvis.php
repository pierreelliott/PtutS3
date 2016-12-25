<?php

	public function modifAvis($commentaire, $pseudo, $note)
	{
		//On recupere le NumUser associé
		$user = $um->getNumUser($pseudo);

		//Si que des espaces on mets a null
		if($commentaire == " ")
		{
			$commentaire == null;
		}

		$resultat = $this->executerRequete('update avis
											set commentaire= ?, note = ?
											where numUser= ?', array($commentaire, $note, $user));

		return $resultat;
	}