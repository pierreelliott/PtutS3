<?php

namespace Models;

class UserManagerPDO extends UserManager
{
	public function connect($pseudo, $hashPwd)
	{
		$sql = "select numUser, pseudo, mdp, nom, prenom, mail, telephone, numRue, rue, ville, codePostal, typeUser, dateInscription from utilisateur where pseudo = :pseudo and mdp = :mdpHash;";
		$params = array(
			'pseudo' => $pseudo,
			'mdpHash' => $hashPwd
		);

		$requete = $this->dao->prepare($sql);
		$requete->execute($params);

		return $requete->fetch(\PDO::FETCH_ASSOC);
	}
}
