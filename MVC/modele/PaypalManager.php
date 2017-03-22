<?php
    require_once("Model.php");

    class PaypalManager extends Model
    {
        //Definit tout les parametre statique de l'URL
        public function construitUrl()
        {
			$paramsPaypal = $this->getParametresAPI();
			
            //Site de l'API Paypal
            $urlPaypal = "https://api-3t.sandbox.paypal.com/nvp?";
            //Version de l'API de paypal
            $version = "204.0";
            //Concaténation pour avoir l'url de base
            $urlPaypal = $urlPaypal.'VERSION='.$version.'&USER='.$paramsPaypal["user"].'&PWD='.$paramsPaypal["mdp"].'&SIGNATURE='.$paramsPaypal["signature"];

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
		
		public function getParametresAPI()
		{
			$paramsPaypal = array();
			$config = new \DOMDocument;
			$config->load("config/config.xml");
			$xmlParamsPaypal = $xml->getElementsByTagName("paypal");
			
			//Compte Utilisateur du vendeur
			$paramsPaypal["user"] = $xmlParamsPaypal->getAttribute("user");
			//Mot de passe pour acceder à l'API
			$paramsPaypal["mdp"] = $xmlParamsPaypal->getAttribute("mdp");
			//Signature de l'API
			$paramsPaypal["signature"] = $xmlParamsPaypal->getAttribute("signature");
			
			return $paramsPaypal;
		}
    }
