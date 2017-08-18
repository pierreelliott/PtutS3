<?php

namespace Models;

class UserManagerPDO extends UserManager
{
	public function connect($pseudo, $hashPwd)
	{
		$sql = 'select numUser, pseudo, mdp, nom, prenom, mail, telephone, numRue, rue, ville, codePostal, typeUser, date_format(dateInscription, \'%d/%m/%Y\') dateInscription from utilisateur where pseudo = :pseudo and mdp = :mdpHash';
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
                    . 'values(:pseudo, :mdp, :nom, :prenom, :mail, :tel, :numRue, :rue, :ville, :codePostal, \'USER\', CURDATE())';

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

	public function getInfos($userNo)
	{
		$sql = 'select nom, prenom, mdp, mail, ville, rue, codePostal, telephone, pseudo, numRue, dateInscription from utilisateur where numUser = ?';
		$requete = $this->dao->prepare($sql);
		$requete->execute(array($userNo));

		return $requete->fetch(\PDO::FETCH_ASSOC);
	}

	public function getFavoriteProducts($userNo)
	{
		$sql = 'select p1.numProduit numProduit, numImage, description, prix, libelle, typeProduit
											from produit p1 join preference p2
											on p1.NUMPRODUIT = p2.NUMPRODUIT
											where numUser= ? and prix > 0
											order by CLASSEMENT';
		$requete = $this->dao->prepare($sql);
		$requete->execute(array($userNo));

		return $requete->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function addFavoriteProduct($userNo, $prodNo)
	{
		var_dump('test');
		$requete = $this->dao->prepare('insert into preference(numUser, numProduit, classement) values(?, ?, 0)');
		$requete->execute(array($userNo, $prodNo));
	}

	public function deleteFavoriteProduct($userNo, $prodNo)
	{
		$requete = $this->dao->prepare('delete from preference where numUser = ? and numProduit = ?');
		$requete->execute(array($userNo, $prodNo));
	}

	public function getPseudosList($input)
	{
		$requete = $this->dao->prepare('select pseudo, typeUser from utilisateur where pseudo like ?');
		$requete->execute(array("$input%"));

		return $requete->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function addAdmin($userNo)
    {
        $requete = $this->dao->prepare('update utilisateur set typeUser = \'ADMIN\' where numUser = ?');
		$requete->execute(array($userNo));
    }

    public function deleteAdmin($userNo)
    {
        $requete = $this->dao->prepare('update utilisateur set typeUser = \'USER\' where numUser = ?');
		$requete->execute(array($userNo));
    }

	public function checkDuplicate($pseudo)
	{
		$requete = $this->dao->prepare('select pseudo from utilisateur where pseudo = ?');
		$requete->execute(array($pseudo));
        $resultat = $requete->fetchAll(\PDO::FETCH_ASSOC);

		return boolval($resultat);
	}

	public function setUserInfos($userNo, array $infos)
	{
		$setPseudo = $setMdp = $setNumRue = $setRue = $setVille = $setCodePostal = '';

		if($infos != null && !empty($infos))
		{
			$cpt = 1;
			foreach($infos as $key => $info)
			{
				$setVariable = 'set'.ucfirst($key);
				$$setVariable = '';

				if($cpt > 1)
				{
					$$setVariable = ', ';
				}

				$$setVariable .= $key.' = :'.$key;

				$cpt++;
			}

			$infos['numUser'] = $userNo;

			$sql = 'update utilisateur set '.$setPseudo . $setMdp . $setNumRue . $setRue . $setVille . $setCodePostal.' where numUser = :numUser';
			$requete = $this->dao->prepare($sql);
			$requete->execute($infos);
			$_SESSION = array_merge($_SESSION, $infos);
		}
	}
}
