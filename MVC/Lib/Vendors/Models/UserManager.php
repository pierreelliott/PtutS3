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
	 * @param $userNo int L'identifiant de l'utilisateur
	 * @param $prodNo int L'identifiant du produit
	 * @return boolval true si le produit est favori de l'utilisateur, false sinon
	 */
	abstract public function isFavorite($userNo, $prodNo);

	/**
	 * Méthode permettant de récupérer les informations d'un utilisateur
	 * @param $userNo int L'identifiant de l'utilisateur
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
	 * @param $userNo int L'identifiant de l'utilisateur
	 * @param $prodNo int L'identifiant du produit
	 * @return array Le résultat de la requête
	 */
	abstract public function addFavoriteProduct($userNo, $prodNo);

	/**
	 * Méthode supprimant un produit favori d'un utilisateur
	 * @param $userNo int L'identifiant de l'utilisateur
	 * @param $prodNo int L'identifiant du produit
	 * @return array Le résultat de la requête
	 */
	abstract public function deleteFavoriteProduct($userNo, $prodNo);

	/**
	 * Méthode renvoyant une liste de pseudo en fonction d'une chaîne de caractères donnée en entrée
	 * @param $input string La chaîne à utiliser pour la recherche de pseudos
	 * @return array Un tableau contenant la liste des pseudos correspondant à la recherche
	 */
	abstract public function getPseudosList($input);

	/**
	 * Méthode passant un utilisateur en administrateur
	 * @param $userNo int L'identifiant de l'utilisateur
	 */
	abstract public function addAdmin($userNo);

	/**
	 * Méthode passant un administrateur en utilisateur
	 * @param $userNo int L'identifiant de l'utilisateur
	 */
	abstract public function deleteAdmin($userNo);

	/**
	 * Méthode testant la présence d'un pseudo dans la base
	 * @param $pseudo string Le pseudo de l'utilisateur
	 * @return boolval True si le pseudo existe déjà, false sinon
	 */
	abstract public function checkDuplicate($pseudo);

	/**
	 * Méthode permettant de modifier les informations d'un utilisateur
	 * @param $userNo int L'identifiant de l'utilisateur
 	 * @param $infos array Un tableau associatif dont les clés sont les champs à modifier
 	 * (ex : array('numRue' => $numRue, 'rue' => $rue) pour modifier le numéro de rue et la rue)
	 */
	abstract public function setUserInfos($userNo, array $infos);
}
