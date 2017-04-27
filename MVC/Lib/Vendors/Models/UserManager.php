<?php

namespace Models;

use \LibPtut\Manager;

abstract class UserManager extends Manager
{
  /**
   * Méthode testant la connexion d'un utilisateur et renvoyant ses informations
   * @param $pseudo string Le pseudo de l'utilisateur
   * @param $pwd string Le mot de passe haché de l'utilisateur
   * @return array Les données de l'utilisateur
   */
  abstract public function connect($pseudo, $pwd);
}
