<?php
    require("../Model.php");

    public class avisManager extends Model
    {


        public function addAvis($commentaire, $pseudo, $note)
        {
            //Test si l'utilisateur n'a pas deja donné un avis
            $doublon = $this->executerRequete("select numUser from avis where numUser in (select pseudo
                                                                                           from utilisateur
                                                                                           where pseudo = ?)", $array($pseudo);)
            $doublon = $doublon->fetchAll(PDO::FETCH_ASSOC);

            if($doublon == false)
            {
                //Test si l'utilisateur a une commande
                $commande = $this->executerRequete("select numCommande
                                                    from commande
                                                    where numUser in (select numUser
                                                                    from utilisateur
                                                                    where pseudo = ?)",array($pseudo));
                $commande = $commande->fetchAll(PDO::FETCH_ASSOC);

                if($commande == false)
                {
                    $user = $this->executerRequete('select numUser from utilisateur where pseudo = ?', array($pseudo));
                    $user->fetch();


                    $this->executerRequete('insert into avis (Numuser, avis, note, date, dateDernierVote)
                                            values(?, ?, ?, CURRENT_DATE(), null)', array($user['NumUser'], $commentaire, $note));
                }

            }
        }






    }

 ?>
