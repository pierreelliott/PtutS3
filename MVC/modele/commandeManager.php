<?php

    require_once("userManager.php");

    class CommandeManager extends Model
    {
        public $um;

        public function __construct()
        {
            $this->um = new UserManager();
        }

        //Creer une commande: $Produits est un tableau indexé 2 dimension [i][numProduit] et [i][quantiteProduit]
        public function addCommande($pseudo, $produits, $typeCommande)
        {
            $numUser = $um->getNumUser($pseudo);

            $user = $um->getInfo($pseudo);
            //A gerer en dehors du modele juste avant de valider commande
            if($typeComande == "Livraison" and ($user['ville'] == null or $user['rue'] == null or $user['telephone'] == null or
                $user['numRue'] == null or $user['codePostal'] == null))
            {
                return false;
            }

            //Pas utilisé
            $prixCommande = $this->calcCommande($produits);

            //Insertion dans la table Commande
            $requete = $this->executerRequete('insert into commande(rue, date, ville, numRue, codePostal,
                                            typeCommande, numUser)
                                            values(?, CURRENT_DATE(), ?, ?, ?, ?, ?)',
                                            array($user['rue'], $user['ville'], $user['numRue'], $user['codePostal'],
                                            $typeCommande, $numUser['numUser']));

            //Recupere le numCommande de la commande insérer
            $numCommande = $this->executerRequete('select max(numCommande) numCommande from commande');
            $numCommande = $numCommande->fetch();

            foreach($produits as $prod)
            {
                $requete = $this->executerRequete('insert into quantiteProduit(numCommande, numProduit, quantite)
                                                values(?, ?, ?)',
                                                array($numCommande['numCommande'], $produits['numProduit'],
                                                    $produits['quantiteProduit']));
            }

            return true;
        }

        public function modifTypeCommande($numCommande, $type)
        {
            $requete = $this->executerRequete('update commande
                                                set TYPECOMMANDE= ?
                                                where numCommande= ?', array($type, $numCommande));
            return $requete;

        }

        /*Calculer le prix d'une commande ($Produits est un tableau a 2 dimension [numProduit][quantiteProduit])*/
          //Inutile
        public function calcCommande($produits)
        {
            $prixTotal = 0;
            foreach($produits as $prod)
            {
                $prix = $this->executerRequete('select prix from produit
                                            where numProduit = ?', array($prod['numProduit']));
                $prix = $prix->fetch();

                $prixTotal += $prix[prix] * $prod['quantiteProduit'];
            }

            return $prixTotal;
        }

        //Recupere l'historique des commandes de l'utilisateur choisi
        public function getHistoriqueCommande($pseudo)
        {
            $user = $this->um->getNumUser($pseudo);
            $requete = $this->executerRequete('select date, typeCommande, numCommande from commande
                                                where NumUser= ?', array($user));
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultat as $res) {
                 $res["prix"] = $this->getPrixTotalCommande($res['numCommande']);
            }

            return $resultat;
        }

        //Affiche le detail d'une commande: Produit, quantite, prix commande, type commande, date
        public function getInfosCommande($numCommande)
        {
            $requete = $this->executerRequete('select typeCommande, date, numProduit, description, quantite
                                            from produit p join quantiteproduit q
                                            on p.NUMPRODUIT = q.NUMPRODUIT
                                            join commande c
                                            on c.NUMCOMMANDE= q.NUMCOMMANDE
                                            where c.numCommande = ?;', array($numCommande));

            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

            return $resultat;
        }

        //Calcule prix total d'une commande
        public function getPrixTotalCommande($numCommande)
        {
            $requete = $this->executerRequete('select quantiteproduit, prix, from produit join quantite q
                                                on p.NUMPRODUIT = q.NUMPRODUIT
                                                where numCommande = ?', array($numCommande));

            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

            // Si la requete renvoit des données
            if($resultat != false)
            {
                $prixTotal = 0;
                foreach ($resultat as $produit) {
                    $prixTotal += $produit["quantiteproduit"] * $produit["prix"];
                }
                return $prixTotal;
            }

            //Gerer erreur
            return false;
        }

        public function getNbProduit($numCommande)
        {
            $requete = $this->executerRequete('select count(numProduit) nombreProduit from quantiteproduit
                                            where numCommande= ?', array($numCommande));

            $resultat = $requete->fetch();

            return $resultat['nombreProduit'];
        }

    }




 ?>
