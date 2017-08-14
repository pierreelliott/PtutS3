<?php

namespace Models;

class CommandManagerPDO extends CommandManager
{
    public function getCommands($userNo)
    {
        $sql = 'select DATE_FORMAT(date, \'%d/%m/%Y\') date, typeCommande, numCommande from commande where numUser = ? order by numCommande desc';
        $requete = $this->dao->prepare($sql);
        $requete->execute(array($userNo));
        $resultat = $requete->fetchAll(\PDO::FETCH_ASSOC);

        foreach($resultat as $res)
        {
            $res['prix'] = $this->getCommandPrice($res['numCommande']);
        }

        return $resultat;
    }

    public function getCommand($commandNo)
    {
        $sql = 'select typeCommande, date, p.numProduit numProduit, description, quantite
                from produit p join quantiteProduit q
                on p.NUMPRODUIT = q.NUMPRODUIT
                join commande c
                on c.NUMCOMMANDE= q.NUMCOMMANDE
                where c.numCommande = ?';
        $requete = $this->dao->prepare($sql);
        $requete->execute(array($commandNo));

        return $requete->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCommandPrice($commandNo)
    {
        $sql = 'select quantite, prix from produit p join quantiteProduit q
                on p.NUMPRODUIT = q.NUMPRODUIT
                where numCommande = ?';
        $requete = $this->dao->prepare($sql);
        $requete->execute(array($commandNo));

        $resultat = $requete->fetchAll(\PDO::FETCH_ASSOC);

        // Si la requête renvoie des données
        if($resultat)
        {
            $prixTotal = 0;
            foreach ($resultat as $produit)
            {
                $prixTotal += $produit['quantite'] * $produit['prix'];
            }
            return $prixTotal;
        }

        // Gérer erreur
        return 0;
    }

    public function getNbProducts($commandNo)
    {
        $requete = $this->dao->prepare('select count(numProduit) nombreProduit from quantiteProduit where numCommande= ?');
        $requete->execute(array($commandNo));

        $resultat = $requete->fetch();

        return $resultat['nombreProduit'];
    }

    public function isCommandOf($commandNo, $userNo)
    {
        $requete = $this->dao->prepare('select numCommande from commande where numUser = ? and numCommande = ?');
        $requete->execute(array($userNo, $commandNo));

        return $requete->fetch(\PDO::FETCH_ASSOC);
    }

    public function addCommand($userNo, $products, $commandType)
    {
        $sql = 'select nom, prenom, mdp, mail, ville, rue, codePostal, telephone, pseudo, numRue, dateInscription from utilisateur where numUser = ?';
		$requete = $this->dao->prepare($sql);
		$requete->execute(array($userNo));
		$user = $requete->fetch(\PDO::FETCH_ASSOC);

        // A gérer en dehors du modèle juste avant de valider la commande
        if
        (
            $commandType == 'Livraison' and
            ($user['ville'] == null or $user['rue'] == null or $user['telephone'] == null or $user['numRue'] == null or $user['codePostal'] == null)
        )
        {
            return false;
        }

        // Insertion dans la table Commande
        $sql = 'insert into commande(rue, date, ville, numRue, codePostal, typeCommande, numUser) values(?, CURRENT_DATE(), ?, ?, ?, ?, ?)';
        $requete = $this->dao->prepare($sql);
        $requete->execute(array($user['rue'], $user['ville'], $user['numRue'], $user['codePostal'], $commandType, $userNo));

        // Récupère le numCommande de la commande insérée
        $numCommande = $this->dao->query('select max(numCommande) numCommande from commande');
        $numCommande = $numCommande->fetch();

        foreach($produits as $prod)
        {
            $requete = $this->dao->prepare('insert into quantiteProduit(numCommande, numProduit, quantite) values(?, ?, ?)');
            $requete->execute(array($numCommande['numCommande'], $prod['numProduit'], $prod['quantite']));
        }

        return true;
    }
}
