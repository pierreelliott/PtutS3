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

        return $requete->fetchAll(PDO::FETCH_ASSOC);
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

    public function isCommandOf($commandNo, $userNo)
    {
        $requete = $this->dao->prepare('select numCommande from commande where numUser = ? and numCommande = ?');
        $requete->execute(array($userNo, $commandNo));

        return $requete->fetch(PDO::FETCH_ASSOC);
    }
}
