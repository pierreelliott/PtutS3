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
     * Méthode qui teste si la commande est celle de l'utilisateur
     * @param $commandNo int Le numéro de la commande
     * @param $userNo int Le numéro de l'utilisateur
     * @return boolval true si la commande appartient à l'utilisateur, false sinon
     */
    abstract public function isCommandOf($commandNo, $userNo);
}
