<?php
    class InscriptionModel extends Model
    {
        public function inscription($pseudo, $mdpHash, $email)
        {
            $requete = "insert into utilisateur(pseudo, mdp, email, dateInscription) values('?', '?', '?', CURDATE())";
            $this->executerRequete($requete, array($pseudo, $mdpHash, $email));
        }

        public function getPseudo($pseudo)
        {
            $requete = "select pseudo from utilisateur where pseudo = '?';";
            $resultat = $this->executerRequete($requete, array($pseudo));

            return $resultat;
        }
    }