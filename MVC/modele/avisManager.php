<?php
    require_once("Model.php");
    require_once("UserManager.php");

    class AvisManager extends Model
    {
        public $um;

        public function __construct()
        {
            $this->$um = new UserManager();
        }

        //Ajouter un avis
        public function addAvis($commentaire, $pseudo, $note)
        {
            //Test si l'utilisateur n'a pas deja donné un avis
            $doublon = $this->executerRequete("select numUser from avis where numUser in (select pseudo
                                                                                           from utilisateur
                                                                                           where pseudo = ?)", $array($pseudo));
            $doublon = $doublon->fetchAll(PDO::FETCH_ASSOC);
            if($doublon == false)
            {
                //Si que des espaces on mets a null
                $commentaire = $this->convertChaine($commentaire, 0);
                //On recupere le NumUser associé
                $user = $um->getNumUser($pseudo);

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
            $user = $um->getNumUser($pseudo);

            //Si que des espaces on mets a null
            $commentaire = $this->convertChaine($commentaire, 0);


            $resultat= $this->executerRequete('update avis
                                                set commentaire= ?, note = ?
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

        //Recupere l'avis en fonction du pseudo de l'utilisateur
        public function getAvis($pseudo)
        {
            $user = $um->getNumUser($pseudo);

            $resultat = $this->executerRequete('select avis, note, date from avis where numUser = ?', array($user));
            $resultat = $resultat->fetch();

            return $resultat;
        }

        //Recupere tous les avis avec un parametre falcultatif pour avoir le tableau trié
        public function getTousAvis($critere = "NUMAVIS", $ordre = "asc")
        {
            $requete= $this->executerRequete('select avis, note, date from avis order by'.$critere.' '.$ordre);

            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

            return $resultat;
        }

        //Signaler l'avis le pseudo correspond à la personne qui signale
        public function signalerAvis($numAvis, $pseudo, $remarque)
        {
            $user = $um->getNumUser($pseudo);

            //On teste si un signalement a deja été fait
            $doublon = $this->executerRequete('select numAvis from signalAvis where numUser= ? and numAvis= ?', array($user,$numAvis));
            $doublon->fetch();

            if($doublon == false)
            {
                //Si il n'y a que des espaces dans la remarque
                $remarque = $this->convertChaine($remarque, 0);

                $requete = $this->executerRequete('insert into signalAvis(numAvis, numUser, remarque)
                                                values(?,?,?)',array($numAvis, $numUser, $remarque));

                return true;
            }
            else {
                //L'user a déja deposé un signalement sur cette avis
                return false;
            }
        }

        //Recupere tous les avis signalé: Numuser correspond a la personne qui signale
        public function getTousAvisSignaler()
        {
            $requete = $this->executerRequete('select avis, note, date, s.numUser, remarque
                                            from avis a join signalAvis s
                                            on a.NumUser= s.numAvis
                                            where numSignal is NOT null; ');

            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

            return $resultat
        }

        public function getSignalements($numAvis)
        {
            $requete = $this->executerRequete('select numAvis, numUser, remarque
                                               from signalAvis
                                               where numAvis = ?', array($numAvis));
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

            return $resultat;
        }

//===========================  Fonctions sur les votes   ==============================================

        //L'utilisateur vote
        public function addVote($numAvis, $vote, $pseudo)
        {
            //On recupere le NumUser associé
            $user = $um->getNumUser($pseudo);

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
                return false;
            }
            return true;
        }

        //Recupere le nombre de votes positif sur un avis
        public function getVotePositif($numAvis)
        {
            $requete = $this->executerRequete("select IFNULL(count(vote), 0)
                                            from vote
                                            where vote ='true' and
                                            numAvis= ?", array($numAvis));
            $vote = $requete->fetch();

            return $vote;
        }

        //Recupere le nombre de votes négatif sur un avis
        public function getVoteNegatif($numAvis)
        {
            $requete = $this->executerRequete("select IFNULL(count(vote), 0)
                                            from vote
                                            where vote ='false' and
                                            numAvis= ?", array($numAvis));
            $vote = $requete->fetch();

            return $vote;
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

    }
 ?>
