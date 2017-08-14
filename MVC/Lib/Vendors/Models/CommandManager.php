<?php

namespace Models;

use \LibPtut\Manager;

abstract class CommandManager extends Manager
{
    /**
     * Méthode permettant de récupérer les commandes passées par un utilisateur
     * @param $userNo int Le numéro d'utilisateur
     * @return array la liste des commandes
     */
    abstract public function getCommands($userNo);

    /**
     * Méthode permettant de récupérer une commande à partir de son numéro
     * @param $commandNo int Le numéro de la commande
     * @return array Les informations de la commande
     */
    abstract public function getCommand($commandNo);

    /**
     * Méthode permettant d'obtenir le prix total d'une commande
     * @param $commandNo int Le numéro de la commande
     * @return double Le prix de la commande
     */
    abstract public function getCommandPrice($commandNo);

    /**
     * Méthode permettant d'obtenir le nombre de produits dans la commande
     * @param $commandNo int Le numéro de la commande
     * @return int Le nombre de produit de la commande
     */
    abstract public function getNbProducts($commandNo);

    /**
     * Méthode qui teste si la commande est celle de l'utilisateur
     * @param $commandNo int Le numéro de la commande
     * @param $userNo int Le numéro de l'utilisateur
     * @return boolval true si la commande appartient à l'utilisateur, false sinon
     */
    abstract public function isCommandOf($commandNo, $userNo);

    /**
     * Méthode permettant de créer une commande
     * @param $userNo int Le numéro d'utilisateur
     * @param $products array Tableau indexé à 2 dimensions : [i][numProduit] et [i][quantiteProduit]
     * @param $commandType string Le type de la commande (Livraison ou à emporter)
     * @return boolval True en cas de succès, false sinon
     */
    abstract public function addCommand($userNo, $products, $commandType);
}
