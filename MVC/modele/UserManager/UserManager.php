<?php
    require("../Model.php");
    public class UserManager extends Model
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
?>
