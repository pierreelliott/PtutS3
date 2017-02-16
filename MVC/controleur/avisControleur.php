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
            //Si l'utilisateur a posté quelque chose
            if(isset($_POST['commentaire']) && isset($_POST['note']))
            {
                //On recupere le pseudo
                $pseudo = $_SESSION["utilisateur"]["pseudo"];

                //Si l'utilisateur a un avis
                if($this->avis->getAvis($pseudo) != false)
                {
                    //Modifie l'avis
                    $this->avis->modifAvis($_POST['commentaire'], $pseudo, $_POST['note']);
                }
                else
                {
                    //Ajout de l'avis
                    $this->avis->addAvis($_POST['commentaire'], $pseudo, $_POST['note']);
                }
            }
            else
            {
                $erreur = "Vous n'avez rien rempli";
            }
            header("Location: /avis");
        }

        public function vote()
        {
            //Teste si on a toutes les variables
            if(isset($_GET["pouce"]) && isset($_GET["numAvis"]) && isset($_SESSION["utilisateur"]["pseudo"]))
            {
                //On test si l'utilisateur n'a pas deja voté pour cet avis
                $vote = $this->avis->aVote($_GET["numAvis"], $_SESSION["utilisateur"]["pseudo"]);
                if($vote == -1)
                {
                    //Si il n'en a pas on ajoute le vote
                    $resultat = $this->avis->addVote($_GET["numAvis"], $_GET["pouce"], $_SESSION["utilisateur"]["pseudo"]);

                    //Si il vote pour un avis qui n'a pas de commentaire
                    if($resultat == false)
                    {
                        $erreur = "Vous ne pouvez voter pour cet avis car il n'a pas de commentaire";
                    }
                }
                //Si en a deja un
                else {
                    //Si c'est le meme vote
                    if($vote == $_GET["pouce"])
                    {
                        $this->avis->deleteVote($_GET["numAvis"], $_SESSION["utilisateur"]["pseudo"] );
                    }
                    else
                    {
                        //Si ce n'est pas le même on modifie le vote
                         $this->avis->modifVote($_GET["numAvis"], $_GET["pouce"], $_SESSION["utilisateur"]["pseudo"] );
                    }
                }
            }
            header("Location: /avis");
        }

        public function signaler()
        {
             //Teste si on a toutes les variables
            if(isset($_POST['numAvis'])  && isset($_SESSION["utilisateur"]["pseudo"]) &&
                isset($_POST['remarque']))
            {

                    $doublon = $this->avis->signalerAvis($_POST['numAvis'], $_SESSION["utilisateur"]["pseudo"], $_POST['remarque']);
                     //Si l'utillisateur a déjà signalé l'avis
                    if($doublon == true)
                    {
                        header("Location: /avis");
                        $erreur = "Vous avez déjà signalé cet avis";
                    }

            }

        }

    }
?>
