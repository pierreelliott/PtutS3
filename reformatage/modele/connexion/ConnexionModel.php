<?php

	require_once("modele/Model.php");

    class ConnexionModel extends Model
    {
        public function connexion($pseudo, $mdpHash)
        {
            $requete = "select numUser from utilisateur where pseudo = :pseudo and mdp = :mdpHash;";
            
            $params = array(
                'pseudo' => $pseudo,
                'mdpHash' => $mdpHash
                );
            
            $resultat = $this->executerRequete($requete, $params);

            return $resultat;
        }
    }