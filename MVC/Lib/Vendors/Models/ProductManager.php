<?php

namespace Models;

use \LibPtut\Manager;

abstract class ProductManager extends Manager
{
	/**
	 * Méthode permettant de récupérer tous les produits et menus disponibles sur la carte du restaurant
	 * @param $imageSize string La taille de l'image (petite, moyenne, grande)
	 * @return array La liste des produits et menus de la carte
	 */
	abstract public function getMenuCard($imageSize = null);

	/**
	 * Méthode pour récupérer les produits compatibles avec le produit passé en paramètre.
	 * Cela permet de former les menus de la carte
	 * @param $numProduit int Le nuémro du produit
	 * @return array Liste des numéros des produits compatibles
	 */
	abstract public function getCompatibleProducts($productNo);

	/**
	 * Méthode permettant de récupérer les informations d'un produit
	 * @param $numProduit int Le nuémro du produit
	 * @return array Les informations du produit
	 */
	abstract public function getProductInformations($productNo);

	/**
	 * Méthode permettant de savoir si un produit est un menu
	 * @param $produxtNo int Le nuémro du produit
	 * @return boolval True si le produit est un menu, false sinon
	 */
	abstract public function isMenu($productNo);

	/**
	 * Méthode permettant de chercher les produits par rapport au nom du produit
	 * @param $wording Libellé du produit
	 * @return array La liste des produits correspondant aux critères de recherche
	 */
	abstract public function searchProduct($wording);

	/**
	 * Méthode permettant de récupérer la liste des types de produits
	 * @return array Un tableau contenant la liste des types de produits
	 */
	abstract public function getProductTypes();
}
