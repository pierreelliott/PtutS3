<?php

	public function addVote($numAvis, $vote, $pseudo)
	{
		//On recupere le NumUser associé
		$user = $um->getNumUser($pseudo);

		$resultat = $this->executerRequete('insert into vote(numAvis, numUser, vote)
										   values(?, ?, ?)', array($numAvis, $user, $vote));

		//Correspond au trigger voteSonAvis
		if($resultat->errorCode() == '15000')
		{
			return false;
		}
		//Correspond au trigger voteAvisSansCommentaire
		else if($resultat->errorCode() == '11000')
		{
			return false;
		}
		//Correspond au trigger voteParAvisParUtilisateur
		else if($resultat->errorCode() == '13000')
		{
			return false;
		}
		return true;
	}