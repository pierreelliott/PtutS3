<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    include_once('modele/AvisManager.php');


    class AvisControleur
    {
        public $avis;

        public function __construct()
        {
            $this->avis = new AvisManager();
        }

        public function afficherAvis()
        {
            $userAvis = $this->avis->getAvis($_SESSION["pseudo"]);

            //Si l'utilisateur n'a pas d'avis
            if($userAvis == false)
            {
                $userAvis = null;
            }

            $tousAvis = $this->avis->getTousAvis();
            //Ajout des compteurs de vote
            foreach ($tousAvis as $avis) {
                $avis["PouceBleu"] = $this->avis->getVotePositif($avis["numAvis"]);
                $avis["PouceRouge"] = $this->avis->getVoteNegatif($avis["numAvis"]);
            }

        }


    }
?>
