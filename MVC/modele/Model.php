<?php

    abstract class Model
    {

        // Objet PDO d'accès à la BD
        private static $bdd;

        // Exécute une requête SQL éventuellement paramétrée
        protected function executerRequete($sql, $params = null)
        {
            if ($params == null)
            {
                $resultat = self::getBdd()->query($sql);// exécution directe
            }
            else
            {
                $resultat = self::getBdd()->prepare($sql);// requête préparée
                $resultat->execute($params);
            }
            return $resultat;
        }

        private static function getBdd()
        {
            if(self::$bdd == null)
            {
                require("BD.php");

                try
                {
                    self::$bdd = new PDO('mysql:host='.$serveur.';dbname='.$base, $utilisateur, $mdp);
                }
                catch (Exception $ex)
                {
                    echo $ex->getMessage();
                }

                self::$bdd->exec('SET NAMES utf8');
                self::$bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }
            return self::$bdd;
        }

        //Convertir un chaine en mode particulier
        public function convertChaine($chaine, $mode)
        {
            //Mode à 0 correspond à isNull
            if($mode == 0)
            {
                //ctype_space teste si y a que des espaces ou tabulation dans une chainne
                if(ctype_space($chaine ) == true)
                {
                    return null;
                }
            }
            //Mode 1 supprime les espace en fin et debut de chaine
            else if ($mode == 1)
             {
                $chaine = trim($chaine);
            }
            return $chaine;
        }
    }
?>
