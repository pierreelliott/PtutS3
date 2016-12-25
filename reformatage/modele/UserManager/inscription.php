<?php

	public function inscription($pseudo, $mdpHash, $nom, $prenom, $email, $tel, $numRue, $rue, $ville, $codePostal)
	{
		$doublon = $this->executerRequete("select pseudo from utilisateur where pseudo = ?", array($pseudo));
		$doublon = $doublon->fetchAll(PDO::FETCH_ASSOC);

		//Si fetch renvoit rien il est égal a false
		if($doublon == false)
		{
			$requete = "insert into utilisateur(pseudo, mdp, nom, prenom, mail, telephone, numRue, rue, ville, codePostal, typeUser, dateInscription)"
					. "values(:pseudo, :mdp, :nom, :prenom, :mail, :tel, :numRue, :rue, :ville, :codePostal, 'USER', CURDATE())";

			$params = array(
				'pseudo' => $pseudo,
				'mdp' => $mdpHash,
				'nom' => $nom,
				'prenom' => $prenom,
				'mail' => $email,
				'tel' => $tel,
				'numRue' => $numRue,
				'rue' => $rue,
				'ville' => $ville,
				'codePostal' => $codePostal
				);

			$this->executerRequete($requete, $params);
			return true;
		}
		return false;
	}