<?php
    include_once("modele/Model.php");

    class UtilisateurModel extends Model
    {
        public function recupererInfosUtilisateur($numUser)
        {
            $requete = "select * from utilisateur where numUser = :numUser;";
            $resultat = $this->executerRequete($requete, array('numUser' => $numUser));

            return $resultat;
        }
    }

