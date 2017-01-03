<?php

    require("UserManager.php");

    class CommandeManager extends Model
    {
        public $um;

        public function __construct()
        {
            $this->$um = new UserManager();
        }

        //Creer une commande: $Produits est un tableau indexé 2 dimension [i][numProduit] et [i][quantiteProduit]
        public function addCommande($pseudo, $produits, $typeCommande)
        {
            $numUser = $um->getNumUser($pseudo);

            $user = $um->getInfo($pseudo);
            //A gerer en dehors du modele juste avant de valider commande
            if($typeComande == "Livraison" and ($user['ville'] == null or $user['rue'] == null or rue['telephone'] == null or
                $user['numRue'] == null or $user['codePostal'] == null))
            {
                return false;
            }

            $prixCommande = $this->calcCommande($produits);

            //Insertion dans la table Commande
            $requete = $this->executerRequete('insert into commande(rue, date, ville, numRue, codePostal,
                                            typeCommande, numUser)
                                            values(?, CURRENT_DATE(), ?, ?, ?, ?, ?)',
                                            array($user['rue'], $user['ville'], $user['numRue'], $user['codePostal'],
                                            $typeCommande, $numUser['numUser']));

            //Recpere le numCommande de la commande insérer
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

        //Calculer le prix d'une commande ($Produits est un tableau a 2 dimension [numProduit][quantiteProduit])
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

    }












 ?>
