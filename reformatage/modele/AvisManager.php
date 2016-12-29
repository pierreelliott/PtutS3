<?php
    require("Model.php");
    require("UserManager.php");

    class AvisManager extends Model
    {
        public UserManager $um = new UserManager();
        //Ajouter un avis
        public function addAvis($commentaire, $pseudo, $note)
        {
            //Test si l'utilisateur n'a pas deja donné un avis
            $doublon = $this->executerRequete("select numUser from avis where numUser in (select pseudo
                                                                                           from utilisateur
                                                                                           where pseudo = ?)", $array($pseudo);)
            $doublon = $doublon->fetchAll(PDO::FETCH_ASSOC);
            if($doublon == false)
            {
                //Si que des espaces on mets a null
                if($commentaire == " ")
                {
                    $commentaire == null;
                }
                //On recupere le NumUser associé
                $user = $um->getNumUser($pseudo);

                $resultat = $this->executerRequete('insert into avis (Numuser, avis, note, date, dateDernierVote)
                                        values(?, ?, ?, CURRENT_DATE(), null)', array($user['NumUser'], $commentaire, $note));

                //Correspond a l'erreur du trigger: avisSansCommande
                if($resultat->errorCode() == '12000')
                {
                    return false;
                }
                return true;
            }
        }

        //Modifier avis
        public function modifAvis($commentaire, $pseudo, $note)
        {
            //On recupere le NumUser associé
            $user = $um->getNumUser($pseudo);

            //Si que des espaces on mets a null
            if($commentaire == " ")
            {
                $commentaire == null;
            }

            $resultat = $this->executerRequete('update avis
                                                set commentaire= ?, note = ?
                                                where numUser= ?', array($commentaire, $note, $user));

            return $resultat;
        }

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



        //Recupere l'avis en fonction du pseudo de l'utilisateur
        public function getAvis($pseudo)
        {
            $user = $um->getNumUser($pseudo);

            $resultat = $this->executerRequete('select avis, note, date from avis where numUser = ?', array($user))
            $resultat = $resultat->fetch();

            return $resultat;
        }



        //Recupere le nombre de votes positif
        public function getVotePositif($numAvis)
        {
            $requete = $this->executerRequete("select nvl(count(vote), 0)
                                            from vote
                                            where vote ='true' and
                                            numAvis= ?", array($numAvis));
            $vote = $requete->fetch();

            return $vote;
        }

        //Recupere le nombre de votes négatif
        public function getVoteNegatif($numAvis)
        {
            $requete = $this->executerRequete("select nvl(count(vote), 0)
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
                                            where vote = 'true' and
                                            max(count(vote))");
            $numAvis = $requete->fetch();
            $avis = $this->getAvis($numAvis['NUMAVIS']);
            return $avis;
        }

    }
 ?>
