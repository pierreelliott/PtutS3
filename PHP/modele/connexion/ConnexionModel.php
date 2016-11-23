<?php
    class ConnexionModel extends Model
    {
        public function connexion($pseudo, $mdpHash)
        {
            $requete = "select numUser from utilisateur where pseudo = '?' and mdp = '?';";
            $resultat = $this->executerRequete($requete, array($pseudo, $mdpHash));

            return $resultat;
        }
    }