<?php

namespace Models;

class UserManagerPDO extends UserManager
{
	public function connect($pseudo, $hashPwd)
	{
		$sql = 'select numUser, pseudo, mdp, nom, prenom, mail, telephone, numRue, rue, ville, codePostal, typeUser, dateInscription from utilisateur where pseudo = :pseudo and mdp = :mdpHash;';
		$params = array(
			'pseudo' => $pseudo,
			'mdpHash' => $hashPwd
		);

		$requete = $this->dao->prepare($sql);
		$requete->execute($params);

		return $requete->fetch(\PDO::FETCH_ASSOC);
	}

	public function register($pseudo, $hashPwd, $lastName, $firstName, $mail, $phone, $streetNo, $streetName, $city, $postalCode)

    {
		$requete = $this->dao->prepare('select pseudo from utilisateur where pseudo = ?');
		$requete->execute(array($pseudo));
        $doublon = $requete->fetch(\PDO::FETCH_ASSOC);
		echo '<pre><br><br><br><br>';
		print_r($doublon);
		echo '</pre>';

        // Si fetch ne renvoit rien il est égal a false
        if(!$doublon)
        {
            $sql = 'insert into utilisateur(pseudo, mdp, nom, prenom, mail, telephone, numRue, rue, ville, codePostal, typeUser, dateInscription)'
                    . 'values(:pseudo, :mdp, :nom, :prenom, :mail, :tel, :numRue, :rue, :ville, :codePostal, 'USER', CURDATE())';

			$streetNo = trim($streetNo);
			$streetName = trim($streetName);
			$city = trim($city);
			$postalCode = trim($postalCode);

            $params = array(
                'pseudo' => $pseudo,
                'mdp' => $hashPwd,
                'nom' => $lastName,
                'prenom' => $firstName,
                'mail' => $mail,
                'tel' => $phone,
                'numRue' => $streetNo,
                'rue' => $streetName,
                'ville' => $city,
                'codePostal' => $postalCode
                );

            $requete = $this->dao->prepare($sql);
			$requete->execute($params);
            return true;
        }
        return false;
    }

	public function isFavorite($userNo, $prodNo)
	{
		$requete = $this->dao->prepare('select numProduit from preference where numUser = ? and numProduit = ?');
		$requete->execute(array($userNo, $prodNo));

        return boolval($requete->fetch());
	}
}
