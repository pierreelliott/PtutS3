<?php

    require("UserManager.php");

    class commandeManager extends Model
    {
        public $um;

        public function __construct()
        {
            $this->$um = new UserManager();
        }

        //Creer une commande: Produit est un tableau indexé 2 dimension [i][numProduit] et [i][quantiteProduit]
        public function addCommande($pseudo, $produits, $typeCommande)
        {
            $numUser = $um->getNumUser($pseudo);

            $user = $um->getInfo($pseudo);

            if($typeComande == "Livraison" and $user['ville'] == null and $user['rue'] and rue['telephone'] and
                $user['numRue'] and $user['codePostal'] )
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

            foreach ($produit as $prod)
            {
                $requete = $this->executerRequete('insert into quantiteProduit(numCommande, numProduit, quantite)
                                                values(?, ?, ?)',
                                                array($numCommande['numCommande'], $produits['numProduit'],
                                                    $produits['quantiteProduit']));
            }

            return true;
        }

        //Calculer le prix d'une commande (Produit est un tableau a 2 dimension [numProduit][quantiteProduit])
        public function calcCommande($produits)
        {
            $prixTotal = 0;
            foreach($produits as $prod)
            {
                $prix = $this->executerRequete('select prix from produit
                                            where numProduit = ?', array($produits['numProduit']));
                $prix = $prix->fetch();

                $prixTotal += $prix[prix] * prod['quantiteProduit'];
            }

            return $prixTotal;
        }

    }












 ?>
