<?php

namespace Models;

use \LibPtut\Manager;

abstract class CartManager extends Manager
{
	/**
	 * Méthode faisant la connexion d'un utilisateur et renvoyant ses informations
	 * @param $prodNo string Le numéro du produit
	 */
	abstract public function addProduct($prodNo);

	/**
	 * Méthode faisant l'inscription d'un utilisateur
	 * @param $prodNo string Le numéro du produit
	 */
	abstract public function deleteProduct($prodNo);

	/**
	 * Méthode testant si un produit est favori pour un utilisateur
	 * @param $prodNo string Le numéro du produit
	 * @param $quantity int La quantité à modifier
	 */
	abstract public function modifyProduct($prodNo, $quantity);

	/**
	 * Méthode permettant de récupérer le prix total du panier
	 * @return double Le prix total du panier
	 */
	abstract public function getCartPrice();

	/**
	 * Méthode déterminant si le panier est vide ou non
	 * @return boolval true si le panier est vide, false sinon
	 */
	abstract public function isEmpty();

	/**
	 * Méthode qui vide le panier
	 */
	abstract public function emptyCart();

	/**
	 * Méthode récupérant la quantité de produit dans le panier
	 * @return int La quantité totale de produit dans le panier
	 */
	abstract public function getQuantity();
}
