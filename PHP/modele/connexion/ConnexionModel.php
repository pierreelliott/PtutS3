<?php
    class ConnexionModel extends Model
    {
        public function connexion($pseudo, $mdpHash)
        {
            $requete = "select numUser, pseudo, mdp, nom, prenom, mail, telephone, numRue, rue, ville, codePostal, typeUser, dateInscription "
                    . "from utilisateur where pseudo = :pseudo and mdp = :mdpHash;";
            
            $params = array(
                'pseudo' => $pseudo,
                'mdpHash' => $mdpHash
                );
            
            $resultat = $this->executerRequete($requete, $params);

            return $resultat;
        }
    }