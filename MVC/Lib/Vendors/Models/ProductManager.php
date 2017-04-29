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
}
