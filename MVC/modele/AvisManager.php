<?php
    require_once("Model.php");
    require_once("UserManager.php");

    class AvisManager extends Model
    {
        public $um;

        public function __construct()
        {
            $this->um = new UserManager();
        }

//=================================== Fonctions sur les avis =================================================================================
        //Ajouter un avis
        public function addAvis($commentaire, $pseudo, $note)
        {
            //Test si l'utilisateur n'a pas deja donné un avis
            $doublon = $this->executerRequete("select numUser from avis where numUser in (select pseudo
                                                                                           from utilisateur
                                                                                           where pseudo = ?)", array($pseudo));
            $doublon = $doublon->fetchAll(PDO::FETCH_ASSOC);
            if($doublon == false)
            {
                //Si que des espaces on mets a null
                $commentaire = $this->convertChaine($commentaire, 0);

                //Supression des espaces inutiles en debut et fin de chaine
                $commentaire = $this->convertChaine($commentaire, 1);


                //On recupere le NumUser associé
                $user = $this->um->getNumUser($pseudo);

                $resultat = $this->executerRequete('insert into avis (Numuser, avis, note, date, dateDernierVote)
                                        values(?, ?, ?, CURRENT_DATE(), null)', array($user, $commentaire, $note));

                //Correspond a l'erreur du trigger: avisSansCommande
                if($resultat->errorCode() == '12000')
                {
                    return false;
                }
                return true;
            }
			return false;
        }

        //Modifier avis, si les valeurs ne sont modifiés ont renvoi les valeurs déja présente
        public function modifAvis($commentaire, $pseudo, $note)
        {
            //On recupere le NumUser associé
            $user = $this->um->getNumUser($pseudo);

            //Si que des espaces on mets a null
            $commentaire = $this->convertChaine($commentaire, 0);

            //Supression des espaces inutiles en debut et fin de chaine
            $commentaire = $this->convertChaine($commentaire, 1);


            $resultat= $this->executerRequete('update avis
                                                set avis= ?, note = ?
                                                where numUser= ?', array($commentaire, $note, $user));

            return $resultat;
        }

        //Seulement supprimé par l'admin
        public function deleteAvis($numAvis)
        {
            $requete = $this->executerRequete('delete from avis where numUser= ?', array($numAvis));

            //Renvoit nb ligne effacé sinon une erreur
            if($requete == 1)
                return true;
            else
                return false;
        }

        //Modifie le commentaire à des fins de modération
        public function modifCommentaire($numAvis, $commentaire)
        {
            $requete = $this->executerRequete('update avis
                                    set avis = ?
                                    where numUser = ?', array($commentaire,$numAvis));
            return $requete;
        }

        //Supprime seulement le commentaire
        public function deleteCommentaire($numAvis)
        {
            $requete = $this->executerRequete('update avis
                                                set avis = NULL
                                                where numUser = ?', array($numAvis));
            return $requete;
        }

        //Recupere l'avis en fonction du pseudo de l'utilisateur
        public function getAvis($pseudo)
        {
            $user = $this->um->getNumUser($pseudo);

            $resultat = $this->executerRequete('select avis, note, date from avis where numUser = ?', array($user));
            $resultat = $resultat->fetch();

            return $resultat;
        }

        //Recupere tous les avis avec un parametre falcultatif pour avoir le tableau trié
        public function getTousAvis($critere = "date", $ordre = "desc")
        {
            if(isset($_SESSION["utilisateur"]["pseudo"]))
            {
                //On recupere le numUser actuelle si il est connecté
                $numUser = $this->um->getNumUser($_SESSION["utilisateur"]["pseudo"]);

                $requete= $this->executerRequete("select avis, note,  DATE_FORMAT(date, '%d/%m/%Y') date, numUser from avis where numUser != ? order by ".$critere." ".$ordre, array($numUser));
            }
            else {
                $requete= $this->executerRequete("select avis, note,  DATE_FORMAT(date, '%d/%m/%Y') date, numUser from avis order by ".$critere." ".$ordre);
            }

            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

            return $resultat;
        }

//===================================== Fonctions sur le signalement ==========================================================================

        //Signaler l'avis le pseudo correspond à la personne qui signale
        public function signalerAvis($numAvis, $pseudo, $remarque)
        {
            $user = $this->um->getNumUser($pseudo);

            //On teste si un signalement a deja été fait
            $doublon = $this->executerRequete('select numAvis from signalavis where numUser= ? and numAvis= ?', array($user,$numAvis));
            $doublon = $doublon->fetchAll(PDO::FETCH_ASSOC);

            if($doublon == false)
            {
                //Si il n'y a que des espaces dans la remarque
                $remarque = $this->convertChaine($remarque, 0);

                //Supression des espaces inutiles en debut et fin de chaine
                $remarque = $this->convertChaine($remarque, 1);

                $requete = $this->executerRequete('insert into signalAvis(numAvis, numUser, remarque)
                                                values(?,?,?)',array($numAvis, $user, $remarque));

                return true;
            }
            else {
                //L'user a déja deposé un signalement sur cette avis
                return false;
            }
        }

        //Test si l'utilisateur a déjà signalé cet Avis
        public function aSignale($numAvis, $pseudo)
        {
           //On recupere le NumUser associé
           $user = $this->um->getNumUser($pseudo);

           $requete = $this->executerRequete('select numSignal from signalAvis where numAvis = ? and  NumUser = ?', array($numAvis, $user ));
           $requete->fetch();

           return $requete;
        }

        //Recupere tous les avis signalé: Numuser correspond a la personne qui signale
        public function getTousAvisSignaler()
        {
            $requete = $this->executerRequete("select avis, note, DATE_FORMAT(date, '%d/%m/%Y') date, s.numAvis
                                            from avis a left join signalAvis s
                                            on a.NumUser= s.numAvis
                                            where numSignal is NOT null");

            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

            return $resultat;
        }

        public function getSignalements($numAvis)
        {
            $requete = $this->executerRequete('select numAvis, numUser, remarque
                                               from signalAvis
                                               where numAvis = ?', array($numAvis));
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

            return $resultat;
        }

        //Supprime tous les signalements d'un avis
        public function deleteSignalements($numAvis)
        {
            $requete = $this->executerRequete('delete from signalAvis where numAvis = ?', array($numAvis));


            //Renvoit nb ligne effacé sinon une erreur
            if($requete >= 1)
                return true;
            else
                return false;
        }

        //Recupere l'avis avec le plus de vote positif
        public function getAvisLePlusAime()
        {

            $requete= $this->executerRequete("select numAvis
                                            from vote
                                            where vote = '1'
                                            group by numAvis having count(vote) >= (select count(vote) from vote
                                                                                    where vote = '1')");
            $numAvis = $requete->fetch();
            $avis = $this->getAvis($numAvis['NUMAVIS']);
            return $avis;
        }

        //Recupere l'avis avec le plus vote negatif
        public function getAvisLePlusDeteste()
        {
            $requete= $this->executerRequete("select numAvis
                                            from vote
                                            where vote = '0'
                                            group by numAvis having count(vote) >= (select count(vote) from vote
                                                                                    where vote = '0')");
            $numAvis = $requete->fetch();
            $avis = $this->getAvis($numAvis['NUMAVIS']);
            return $avis;
        }

//===========================  Fonctions sur les votes   ==============================================

        //L'utilisateur vote
        public function addVote($numAvis, $vote, $pseudo)
        {
            //On recupere le NumUser associé
            $user =  $this->um->getNumUser($pseudo);

            $resultat = $this->executerRequete('insert into vote(numAvis, numUser, vote)
                                               values(?, ?, ?)', array($numAvis, $user, $vote));

            //Correspond au trigger voteSonAvis
            if($resultat->errorCode() == '15000')
            {
                return false;
            }
            //Correspond au trigger voteAvisSansCommentaire
            else if($resultat->errorCode() == '11000')
            {
                return false;
            }
            //Correspond au trigger voteParAvisParUtilisateur
            else if($resultat->errorCode() == '13000')
            {
                return -1;
            }
            return true;
        }

        //Modifie l'avis d'un utilisateur
        public function modifVote($numAvis, $vote, $pseudo)
        {
            //On recupere le NumUser associé
            $user =  $this->um->getNumUser($pseudo);

            $resultat = $this->executerRequete('update vote set vote = ?  where numAvis = ? and numUser = ? ', array($vote, $numAvis, $user ));

            return $resultat;
        }

        public function deleteVote($numAvis, $pseudo)
        {
            //On recupere le NumUser associé
            $user =  $this->um->getNumUser($pseudo);

            $resultat = $this->executerRequete('delete from vote where numAvis = ? and numUser = ? ', array($numAvis, $user));

            return $resultat;
        }

        //Test si un utilisateur a déjà voté pour un avis si il en a un on renvoi le vote sinon on renvoi -1
        public function aVote($numAvis, $pseudo)
        {
            $numuser = $this->um->getNumUser($pseudo);

            $requete = $this->executerRequete('select vote from vote where numAvis= ? and NumUser = ?', array($numAvis,$numuser ));

            if($requete->rowCount() > 0)
            {
                $data = $requete->fetch();
                return $data['vote'];
            }
            else {
                return -1;
            }
        }

        //Recupere le nombre de votes positif sur un avis
        public function getVotePositif($numAvis)
        {
            $requete = $this->executerRequete("select IFNULL(count(vote), 0) votePositif
                                            from vote
                                            where vote = 1 and
                                            numAvis= ?", array($numAvis));
            $vote = $requete->fetch();

            return $vote["votePositif"];
        }

        //Recupere le nombre de votes négatif sur un avis
        public function getVoteNegatif($numAvis)
        {
            $requete = $this->executerRequete("select IFNULL(count(vote), 0) voteNegatif
                                            from vote
                                            where vote = 0 and
                                            numAvis= ?", array($numAvis));
            $vote = $requete->fetch();

            return $vote["voteNegatif"];
        }

    }
 ?>
