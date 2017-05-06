<?php

namespace Models;

if(session_status() == PHP_SESSION_NONE)
	session_start();

class CartManagerPDO extends CartManager
{
	private $productManager;

	public function __construct($dao)
	{
		parent::__construct($dao);

		$this->productManager = new ProductManagerPDO($dao);

		if(!isset($_SESSION["panier"]))
		{
			$_SESSION["panier"] = array();
			$_SESSION["nbProduit"] = 0;
		}
	}

	public function addProduct($prodNo)
	{
        if(isset($_SESSION["panier"][$prodNo]))
        {
            $_SESSION["panier"][$prodNo]["quantite"]++;
        }
        else
        {
			$_SESSION["panier"][$prodNo] = array(
				"quantite" => 1,
                "numProduit" => $prodNo
			);
        }

		$_SESSION["nbProduit"]++;
        $_SESSION["prixPanier"] = $this->getCartPrice();
	}

	public function deleteProduct($prodNo)
	{
		$_SESSION["nbProduit"] -= $_SESSION["panier"][$prodNo]["quantite"];
        unset($_SESSION["panier"][$prodNo]);
        $_SESSION["prixPanier"] = $this->getCartPrice();
	}

	public function modifyProduct($prodNo, $quantity)
	{
		if(isset($_SESSION["panier"][$prodNo]))
		{
			$_SESSION["panier"][$prodNo]["quantite"] += $quantity;
			if($_SESSION["panier"][$prodNo]["quantite"] <= 0)
			{
				$this->deleteProduct($prodNo);
			}
		}
		else
		{
			if($quantity < 0) $quantity = 1;
			$this->addProduct($prodNo, $quantity);
		}

		$_SESSION["nbProduit"] += $quantity;
        $_SESSION["prixPanier"] = $this->getCartPrice();
	}

	public function getCartPrice()
	{
		$resultat = 0;
        foreach($_SESSION["panier"] as $numProduit => $produit)
        {
			// On ajoute le prix total du produit (prix * quantité)
            $resultat += $this->productManager->getProductInformations($numProduit)["prix"] * $_SESSION["panier"][$numProduit]["quantite"];
        }

        return $resultat;
	}

	public function isEmpty()
	{
		return empty($_SESSION["panier"]);
	}

	public function emptyCart()
	{
		$_SESSION["panier"] = array();
        $_SESSION["nbProduit"] = 0;
	}

	public function getQuantity()
	{
		$resultat = 0;
        foreach($_SESSION["panier"] as $produit)
        {
            $resultat += $produit["quantite"];
        }

        return $resultat;
	}
}
