<?php

namespace Models;

use \LibPtut\Manager;

abstract class UserManager extends Manager
{
	/**
	 * Méthode faisant la connexion d'un utilisateur et renvoyant ses informations
	 * @param $pseudo string Le pseudo de l'utilisateur
	 * @param $hashPwd string Le mot de passe haché de l'utilisateur
	 * @return array Les données de l'utilisateur
	 */
	abstract public function connect($pseudo, $hashPwd);

	/**
	 * Méthode faisant l'inscription d'un utilisateur
	 * @param $pseudo string Le pseudo de l'utilisateur
	 * @param $hashPwd string Le mot de passe haché de l'utilisateur
	 * @param $lastName string Le nom de famille de l'utilisateur
	 * @param $firstName string Le prénom de l'utilisateur
	 * @param $mail string L'adresse email de l'utilisateur
	 * @param $phone string Le numéro de téléphone de l'utilisateur
	 * @param $streetNo int Le numéro de rue
	 * @param $streetName string Le nom de la rue
	 * @param $city string La ville
	 * @param $postalCode string Le code postal
	 * @return boolval true si l'inscription est réussie, false sinon
	 */
	abstract public function register($pseudo, $hashPwd, $lastName, $firstName, $mail, $phone, $streetNo, $streetName, $city, $postalCode);

	/**
	 * Méthode testant si un produit est favori pour un utilisateur
	 * @param $userNo L'identifiant de l'utilisateur
	 * @param $prodNo L'identifiant du produit
	 * @return boolval true si le produit est favori de l'utilisateur, false sinon
	 */
	abstract public function isFavorite($userNo, $prodNo);

	/**
	 * Méthode permettant de récupérer les informations d'un utilisateur
	 * @param $userNo L'identifiant de l'utilisateur
	 * @return array Les informations de l'utilisateur
	 */
	abstract public function getInfos($userNo);

	/**
	 * Méthode récupérant les produits favoris d'un utilisateur
	 * @param $userNo int L'identifiant de l'utilisateur
	 * @return array Les informations des produits favoris de l'utilisateur
	 */
	abstract public function getFavoriteProducts($userNo);

	/**
	 * Méthode ajoutant un produit favori à un utilisateur
	 * @param $userNo L'identifiant de l'utilisateur
	 * @param $prodNo L'identifiant du produit
	 * @return array Le résultat de la requête
	 */
	abstract public function addFavoriteProduct($userNo, $prodNo);

	/**
	 * Méthode supprimant un produit favori d'un utilisateur
	 * @param $userNo L'identifiant de l'utilisateur
	 * @param $prodNo L'identifiant du produit
	 * @return array Le résultat de la requête
	 */
	abstract public function deleteFavoriteProduct($userNo, $prodNo);
}
