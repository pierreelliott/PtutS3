<?php

	public function addAvis($commentaire, $pseudo, $note)
	{
		//Test si l'utilisateur n'a pas deja donné un avis
		$doublon = $this->executerRequete("select numUser from avis where numUser in (select pseudo
																					   from utilisateur
																					   where pseudo = ?)", $array($pseudo);)
		$doublon = $doublon->fetchAll(PDO::FETCH_ASSOC);
		if($doublon == false)
		{
			//Si que des espaces on mets a null
			if($commentaire == " ")
			{
				$commentaire == null;
			}
			//On recupere le NumUser associé
			$user = $um->getNumUser($pseudo);

			$resultat = $this->executerRequete('insert into avis (Numuser, avis, note, date, dateDernierVote)
									values(?, ?, ?, CURRENT_DATE(), null)', array($user['NumUser'], $commentaire, $note));

			//Correspond a l'erreur du trigger: avisSansCommande
			if($resultat->errorCode() == '12000')
			{
				return false;
			}
			return true;
		}
	}