<?php

namespace Models;

use \LibPtut\Manager;

abstract class CommandManager extends Manager
{
    /**
     * Méthode permettant de récupérer les commandes passées par un utilisateur
     * @param $userNo Le numéro d'utilisateur
     * @return array la liste des commandes
     */
    abstract public function getCommands($userNo);

    /**
     * Méthode permettant d'obtenir le prix total d'une commande
     * @param $commandNo Le numéro de la commande
     * @return double Le prix de la commande
     */
    abstract public function getCommandPrice($commandNo);
}
