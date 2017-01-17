<?php
    require_once("Model.php");

    class PaypalManager extends Model
    {
        //Definit tout les parametre statique de l'URL
        public function construitUrl()
        {
            //Site de l'API Paypal
            $urlPaypal = "https://api-3t.sandbox.paypal.com/nvp?";
            //Version de l'API de paypal
            $version = "204.0";
            //Compte Utilisateur du vendeur
            $user = "test.seller_api1.yopmail.com";
            //Mot de passe pour acceder à l'API
            $pass = "CMASHX59W3RDVVKE";
            //Signature de l'API
            $signature = "AFcWxV21C7fd0v3bYYYRCpSSRl31AD3ZWGs6j9kywv41tSL0XrUzyrSf";
            //Concaténation pour avoir l'url de base
            $urlPaypal = $urlPaypal.'VERSION='.$version.'&USER='.$user.'&PWD='.$pass.'&SIGNATURE='.$signature;

            return $urlPaypal;
        }

        //Deconcatène les données reçues apres une requete
        public function separeParametres($parametres)
        {
            $listeParametre = explode("&", $parametres);

            return $listeParametre;
        }

        public function stockerParametre($listeParametres)
        {
            foreach($listeParametres as $param)
        	{
        		/* On récupère le nom du paramètre et sa valeur dans 2 variables différentes.
                Elles sont séparées par = */
        		list($nom, $valeur) = explode("=", $param);

        		/* On crée un tableau contenant le nom du paramètre comme identifiant et la valeur comme valeur.
                Tout en  Décodant toutes les séquences %##  et les remplace par leur valeur.*/
        		$listeParametres[$nom]=urldecode($valeur);
        	}

            return $listeParametres;
        }
    }
