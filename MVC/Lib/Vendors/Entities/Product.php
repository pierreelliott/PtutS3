<?php

namespace Entity;

use \LibPtut\Entity;

class Product extends Entity
{
	protected $libelle;
	protected $description;
	protected $prix;
	protected $typeProduit;
	protected $numImage;
	protected $isFavorite;

	const LIBELLE_INVALIDE = 1;
	const DESCRIPTION_INVALIDE = 2;
	const TYPE_PRODUIT_INVALIDE = 3;

	public function isValid()
	{
		return !(empty($this->libelle) || empty($this->description) || empty($this->typeProduit));
	}


	// SETTERS
	public function setLibelle($libelle)
	{
		if (!is_string($libelle) || empty($libelle))
		{
			$this->erreurs[] = self::LIBELLE_INVALIDE;
		}

		$this->libelle = $libelle;
	}

	public function setDescription($description)
	{
		if (!is_string($description) || empty($description))
		{
			$this->erreurs[] = self::DESCRIPTION_INVALIDE;
		}

		$this->description = $description;
	}

	public function setPrix($prix)
	{
		$this->prix = (int) $prix;
	}

	public function setTypeProduit($typeProduit)
	{
		if (!is_string($typeProduit) || empty($typeProduit))
		{
			$this->erreurs[] = self::TYPE_PRODUIT_INVALIDE;
		}

		$this->typeProduit = $typeProduit;
	}

	public function setNumImage($numImage)
	{
		$this->numImage = (int) $numImage;
	}

	public function setFavorite($favorite)
	{
		$this->isFavorite = boolval($favorite);
	}

	// GETTERS
	public function getLibelle()
	{
		return $this->libelle;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getPrix()
	{
		return $this->prix;
	}

	public function getTypeProduit()
	{
		return $this->typeProduit;
	}

	public function getNumImage()
	{
		return $this->numImage;
	}

	public function isFavorite()
	{
		return $this->isFavorite;
	}
}
