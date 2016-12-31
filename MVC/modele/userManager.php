<?php
    require("Model.php");
	
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
			$resultat = $resultat->fetch();

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
				
				if($numRue == "") $numRue = null;
				if($rue == "") $rue = null;
				if($ville == "") $ville = null;
				if($codePostal == "") $codePostal = null;
				
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

        public function getPseudo($pseudo)
        {
            $requete = "select pseudo from utilisateur where pseudo = '?';";
            $resultat = $this->executerRequete($requete, array($pseudo));

            $resultat->fetch();

            return $resultat;
        }

        //Permet de recuperer le NumUser à partir du pseudo
        public function getNumUser($pseudo)
        {
            $resultat = $this->executerRequete('select numUser from utilisateur where pseudo = ?', array($pseudo));
            $resultat->fetch();

            return $resultat;
        }

        //Recupere les informations de l'user
        public function getInfo($pseudo)
        {
            $requete = $this->executerRequete('select nom, prenom, mail, ville, rue, codePostal, telephone, pseudo, numRue, dateInscription
                                            from utilisateur
                                            where pseudo= ?', array($pseudo));
            $data = $requete->fetch();
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
                                                where numUser= ?
                                                order by CLASSEMENT', array($user['numUser']));

            $data = $resultat->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        //Ajoute le produit aux favoris de l'utilisateur
        public function addProduitFavoris($pseudo, $NUMPRODUIT)
        {
            $user = $this->getNumUser($pseudo);

            $classement = $this->executerRequete('select max(classement) from preference where numUser = ?', array($user['numUser']));
            $classement = $classement['CLASSEMENT'] + 1;

            $requete = $this->executerRequete('insert into preference(numUser, NUMPRODUIT, CLASSEMENT)
                                            values(?, ?, ?)', array($user['numUser'], $NUMPRODUIT, $classement));
            return $requete;

        }

        //Supprime un produit des favoris
        public function deleteProduitFavoris($pseudo, $NUMPRODUIT)
        {
            $user = $this->getNumUser($pseudo);

            $requete = $this->executerRequete('delete from preference where numUser = ? and NumProduit= ?',
                                            array($user['numUser'], $NUMPRODUIT, $classement));
            return $requete;
        }

        //Recupere les produits favoris en fin de vie
        public function getProduitsFavorisMort($pseudo)
        {
            $user = $this->getNumUser($pseudo);

            $produitMort = $this->executerRequete('select NumProduit from produit
                                                where prix < 0 and NumProduit in (select NumProduit from preference
                                                                                where numUser = ?)', array($user['numUser']));
            $produitMort = $produitMort->fetchAll(PDO::FETCH_ASSOC);

            return $produitMort;
        }

        /* ============= Fonctions sur les types User ============= */

        //Passer un utilisateur en admin
        public function addAdmin($pseudo)
        {
            $user = $this->getNumUser($pseudo);

            $requete = $this->executerRequete("update utilisateur set typeUser='ADMIN' where numUser=? ", array($user['numUser']));
        }

        //Passer un admin en Utilisateur
        public function deleteAdmin($pseudo)
        {
            $user = $this->getNumUser($pseudo);

            $requete = $this->executerRequete("update utilisateur set typeUser='USER' where numUser=? ", array($user['numUser']));
        }


    }
?>
