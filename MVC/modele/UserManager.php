<?php
    require_once("Model.php");

    class UserManager extends Model
    {
        //Teste les logs de connexion à la BD
        public function connexion($pseudo, $mdpHash)
        {
            $requete = "select numUser, pseudo, mdp, nom, prenom, mail, telephone, numRue, rue, ville, codePostal, typeUser, dateInscription from utilisateur where pseudo = :pseudo and mdp = :mdpHash;";
			// Je ne sais pas si c'est vraiment utile de tout retourner (demander à Axel)
            $params = array(
                'pseudo' => $pseudo,
                'mdpHash' => $mdpHash
                );

            $resultat = $this->executerRequete($requete, $params);
			//$resultat = $resultat->fetch();

            return $resultat;
        }

        //Ajoute le nouveau utilisateur à la BD
        public function inscription($pseudo, $mdpHash, $nom, $prenom, $email, $tel, $numRue, $rue, $ville, $codePostal)
        {
            $doublon = $this->executerRequete("select pseudo from utilisateur where pseudo = ?", array($pseudo));
            $doublon = $doublon->fetchAll(PDO::FETCH_ASSOC);

            //Si fetch renvoit rien il est égal a false
            if($doublon == false)
            {
                $requete = "insert into utilisateur(pseudo, mdp, nom, prenom, mail, telephone, numRue, rue, ville, codePostal, typeUser, dateInscription)"
                        . "values(:pseudo, :mdp, :nom, :prenom, :mail, :tel, :numRue, :rue, :ville, :codePostal, 'USER', CURDATE())";

				$numRue = $this->convertChaine($numRue, 0);
				$rue = $this->convertChaine($rue, 0);
				$ville = $this->convertChaine($ville, 0);
				$codePostal = $this->convertChaine($codePostal, 0);

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

		// Permet de modifier les informations d'un utilisateur
		// Le paramètre $infos doit être un tableau associatif dont les clés sont les champs à modifier
		// (ex : array("numRue" => $numRue, "rue" => $rue) pour modifier le numéro de rue et la rue)
		public function modifierInfos($numUser, array $infos)
		{
			$setPseudo = $setMdp = $setNumRue = $setRue = $setVille = $setCodePostal = "";

			if($infos != null && !empty($infos))
			{
				$cpt = 1;
				foreach($infos as $key => $info)
				{
					$setVariable = "set".ucfirst($key);
					$$setVariable = "";

					if($cpt > 1)
					{
						$$setVariable = ", ";
					}

					$$setVariable .= $key." = :".$key;
					$_SESSION["utilisateur"][$key] = $info;

					$cpt++;
				}

				$infos["numUser"] = $numUser;

				$requete = $this->executerRequete("update utilisateur set ".$setPseudo . $setMdp . $setNumRue . $setRue . $setVille . $setCodePostal." where numUser = :numUser", $infos);
			}
		}

        //Permet de recuperer le NumUser à partir du pseudo
        public function getNumUser($pseudo)
        {
            $requete= $this->executerRequete('select numUser from utilisateur where pseudo = ?', array($pseudo));
            $resultat = $requete->fetch();

            return $resultat['numUser'];
        }

        //Permet de récupérer le pseudo de l'utilisateur
        public function getPseudo($numUser)
        {
            $requete= $this->executerRequete('select pseudo from utilisateur where numUser = ?', array($numUser));
            $resultat = $requete->fetch();

            return $resultat['pseudo'];
        }

        //Recupere les informations de l'user
        public function getInfo($pseudo)
        {
            $requete = $this->executerRequete('select nom, prenom, mdp, mail, ville, rue, codePostal, telephone, pseudo, numRue, dateInscription
                                            from utilisateur
                                            where pseudo= ?', array($pseudo));
            $data = $requete->fetch(PDO::FETCH_ASSOC);
            return $data;
        }

        /* ============= Fonctions sur les produits favoris ============= */

        //Recupere les produits favoris de l'utilisateur
        public function getProduitsFavoris($pseudo)
        {
            $user = $this->getNumUser($pseudo);
            $resultat = $this->executerRequete('select numImage, description, prix, libelle, typeProduit
                                                from produit p1 join preference p2
                                                on p1.NUMPRODUIT = p2.NUMPRODUIT
                                                where numUser= ? and prix > 0
                                                order by CLASSEMENT', array($user));

            $data = $resultat->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        //Ajoute le produit aux favoris de l'utilisateur
        public function addProduitFavoris($pseudo, $NUMPRODUIT)
        {
            $user = $this->getNumUser($pseudo);

            $classement = $this->executerRequete('select max(classement) from preference where numUser = ?', array($user));
            $classement = $classement['CLASSEMENT'] + 1;

            $requete = $this->executerRequete('insert into preference(numUser, NUMPRODUIT, CLASSEMENT)
                                            values(?, ?, ?)', array($user, $NUMPRODUIT, $classement));
            return $requete;

        }

        //Supprime un produit des favoris
        public function deleteProduitFavoris($pseudo, $NUMPRODUIT)
        {
            $user = $this->getNumUser($pseudo);

            $requete = $this->executerRequete('delete from preference where numUser = ? and NumProduit= ?',
                                            array($user, $NUMPRODUIT));
            return $requete;
        }

        //Recupere les produits favoris en fin de vie
        public function getProduitsFavorisMort($pseudo)
        {
            $user = $this->getNumUser($pseudo);

            $produitMort = $this->executerRequete('select NumProduit from produit
                                                where prix < 0 and NumProduit in (select NumProduit from preference
                                                                                where numUser = ?)', array($user));
            $produitMort = $produitMort->fetchAll(PDO::FETCH_ASSOC);

            return $produitMort;
        }

        //Verifie que le produit est un produit favoris pour l'utilisateur
        public function estFavoris($pseudo, $numProduit)
        {
            $requete = $this->executerRequete('select numProduit from preference where NumProduit = ?', array($numProduit));

            $requete= $requete->fetch();

            if($requete != false)
            {
                return true;
            }
            return false;
        }

        /* ============= Fonctions sur les types User ============= */

        //Passer un utilisateur en admin
        public function addAdmin($pseudo)
        {
            $user = $this->getNumUser($pseudo);

            $requete = $this->executerRequete("update utilisateur set typeUser='ADMIN' where numUser=? ", array($user));
        }

        //Passer un admin en Utilisateur
        public function deleteAdmin($pseudo)
        {
            $user = $this->getNumUser($pseudo);

            $requete = $this->executerRequete("update utilisateur set typeUser='USER' where numUser=? ", array($user));
        }


    }
