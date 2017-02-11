<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    include_once('modele/AvisManager.php');
    require_once('modele/UserManager.php');

    class AvisControleur
    {
        public $avis, $user;

        public function __construct()
        {
            $this->avis = new AvisManager();
            $this->user= new UserManager();
        }

        public function afficherAvis()
        {
            //Si l'utilisateur est connecté
            if(isset($_SESSION["utilisateur"]["pseudo"]))
            {
                $userAvis = $this->avis->getAvis($_SESSION["utilisateur"]["pseudo"]);

                //Si l'utilisateur n'a pas d'avis
                if($userAvis == false)
                {
                    $userAvis = null;
                }
            }
            else
            {
                $message = "Vous devez vous connecter pour poster un avis";
            }

            $tousAvisBD = $this->avis->getTousAvis();

            //Creation du tableau qui va conteir tous les avis
            $tousAvis = array();

            foreach ($tousAvisBD as $avisBD) {

                //Creation d'un tableau pour stocker toutes les informations d'un avis + remplissage
                $avis = array('avis' => $avisBD['avis'],
                                'note' => $avisBD['note'],
                                'date'  => $avisBD['date'],
                                'numuser' =>  $avisBD['numUser'],
                                'pouceBleu' =>  $this->avis->getVotePositif($avisBD['numUser']),
                                'pouceRouge' => $this->avis->getVoteNegatif($avisBD['numUser']),
                                'pseudo' => $this->user->getPseudo($avisBD['numUser']));
                //Ajout d'un tableau en 2 dimensions avec toutes les donnees
                $tousAvis[$avisBD['numUser']] = $avis;
            }

            include_once("vue/avis.php");
        }

        //Ajout d'un avis à la base de données
        public function addAvis()
        {

        }

    }
?>
