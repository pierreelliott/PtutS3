<?php

	require_once("modele/Model.php");

    class InscriptionModel extends Model
    {
        public function inscription($pseudo, $mdpHash, $nom, $prenom, $email, $tel, $numRue, $rue, $ville, $codePostal)
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
        }

        public function getPseudo($pseudo)
        {
            $requete = "select pseudo from utilisateur where pseudo = '?';";
            $resultat = $this->executerRequete($requete, array($pseudo));

            return $resultat;
        }
    }