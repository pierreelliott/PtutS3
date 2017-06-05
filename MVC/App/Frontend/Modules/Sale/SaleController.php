<?php

namespace App\Frontend\Modules\Sale;

use \LibPtut\Controller;
use \LibPtut\HTTPRequest;

class SaleController extends Controller
{
    public function executeIndex(HTTPRequest $request)
    {
		$productManager = $this->managers->getManagerOf('Product');
		$produits = $productManager->getMenuCard();

		$user = $this->app->getUser();
		if($user->isAuthenticated())
		{
			foreach($produits as $keyProduit => $produit)
			{
				$produit['favori'] = $this->managers->getManagerOf('User')->isFavorite($user->getAttribute('numUser'), $produit['numProduit']);
				$produits[$keyProduit] = $produit;
			}
		}


		$menus = array();
		foreach($produits as $keyMenu => $produit)
		{
			// Si le prix est négatif, on ne l'affichera pas
			// (peu importe que que ce soit un produit seul ou un menu)
			if($produit['prix'] < 0)
			{
				unset($produits[$keyMenu]);
				continue;
			}

			// Pour permettre l'affiche des caractères comme '\n' en balise <br> (ça cause des problèmes donc je met ça en commmentaire en attendant)
			//$produits[$keyMenu]['description'] = nl2br($produits[$keyMenu]['description']);

			// On teste le type du produit pour savoir si c'est un menu
			if(explode('.', $produit['typeProduit'])[0] == 'menu')
			{
				// Si le produit est un menu, on l'enlève de la carte et on l'ajoute au tableau des menus
				$menus[$keyMenu] = $produit;
				unset($produits[$keyMenu]);

				// On récupère les numéros des produits compatibles du menu (donc les produits contenus dans le menu)
				$produitCompatibles = $productManager->getCompatibleProducts($produit['numProduit']); // C'est un tableau des numProduits2

				// Pour chaque numProduit compatible, on récupère les informations du produit
				foreach($produitCompatibles as $keyProduit => $produitCompatible)
				{
					$menus[$keyMenu]['produits'][$keyProduit] = $productManager->getProductInformations($produitCompatible['numProduit2']);
					// Pour permettre l'affiche des caractères comme '\n' en balise <br> (ça cause des problèmes donc je met ça en commmentaire en attendant)
					//$menus[$keyMenu]['produits'][$keyProduit]['description'] = nl2br($menus[$keyMenu]['produits'][$keyProduit]['description']);
				}
			}
			// La variable $menus est de la forme
			/*	menus	[$numMenu1]	['libelle']
									['description']
									['prix']
									['produits']	[$numProduit1]	['libelle']
																	['description']
													[$numProduit2]	['libelle']
																	['description']
						[$numMenu2]	(...)
			*/
		}

		$this->page->addVars(array(
            'produits' => $produits,
            'menus' => $menus,

		    'title' => 'La carte'
        ));

        $this->page->addScript('carte.js');
    }

	public function executeCart(HTTPRequest $request)
	{
		$this->updateCart($request);

		$cartManager = $this->managers->getManagerOf('Cart');

		$this->page->addVar('estVide', $cartManager->isEmpty());

		$produits = array();
		foreach($_SESSION['panier'] as $numProduit => $prod)
		{
			$qte = $prod['quantite'];
			$p = $this->managers->getManagerOf('Product')->getProductInformations($numProduit);

			$produit = array(
				'numProduit' => $p['numProduit'],
				'libelle' => $p['libelle'],
				'description' => $p['description'],
				'quantite' => $qte,
				'prix' => $p['prix'],
				'prixTotal' => $p['prix']*$qte,
				'sourcePetit' => $p['sourcePetit'],
				'sourceMoyen' => $p['sourceMoyen'],
				'sourceGrand' => $p['sourceGrand']
			);

			$produits[$numProduit] = $produit;
		}

		$quantiteTotale = $cartManager->getQuantity();
		$prixTotal = $cartManager->getCartPrice();
	    $_SESSION['prixPanier'] = $prixTotal;

        $this->page->addVar('title', 'Mon panier');

        $this->page->addScript('panier.js');
	}

    public function executeContact(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Contactez-nous');
    }

    public function executeSearch(HTTPRequest $request)
    {
        if($request->request->has('nomProduitRecherche'))
		{
			$produits = $this->managers->getManagerOf('Product')->searchProduct($request->request->get('nomProduitRecherche'));

			$rechercheVide = empty($produits);

			$menus = array();
			foreach($produits as $key => $produit)
			{
				if($produit["prix"] < 0)
				{
					unset($carte[$key]);
					continue;
				}

                // On teste le type du produit pour savoir si c'est un menu
                if(explode('.', $produit['typeProduit'])[0] == 'menu')
    			{
    				// Si le produit est un menu, on l'enlève de la carte et on l'ajoute au tableau des menus
    				$menus[$keyMenu] = $produit;
    				unset($produits[$keyMenu]);

    				// On récupère les numéros des produits compatibles du menu (donc les produits contenus dans le menu)
    				$produitCompatibles = $productManager->getCompatibleProducts($produit['numProduit']); // C'est un tableau des numProduits2

    				// Pour chaque numProduit compatible, on récupère les informations du produit
    				foreach($produitCompatibles as $keyProduit => $produitCompatible)
    				{
    					$menus[$keyMenu]['produits'][$keyProduit] = $productManager->getProductInformations($produitCompatible['numProduit2']);
    					// Pour permettre l'affiche des caractères comme '\n' en balise <br> (ça cause des problèmes donc je met ça en commmentaire en attendant)
    					//$menus[$keyMenu]['produits'][$keyProduit]['description'] = nl2br($menus[$keyMenu]['produits'][$keyProduit]['description']);
    				}
    			}
			}

            $this->page->addVars(array(
                'title' => 'Résultat de la recherche',

                'produits' => $produits,
                'menus' => $menus,
                'rechercheVide' => $rechercheVide
            ));
            $this->page->addScript('carte.js');
		}
        else
        {
            $this->app->getHttpResponse()->redirect404();
        }
    }

	private function updateCart(HTTPRequest $request)
	{
		if($request->getMethod() == 'POST')
        {
			$numProduit = $request->request->get('produit');

			switch($request->request->get('action'))
			{
				case 'ajout':
					$this->panier->addProduct($numProduit);
					break;

				case 'suppression':
					$this->panier->deleteProduct($numProduit);
					break;

				case 'modification':
					if($request->request->has('qte'))
					{
						$this->panier->modifyProduct($numProduit, $request->request->get('qte'));
					}
					break;

				default :
					throw new \Exception('L\'action demandée n\'est pas reconnue');
			}
        }
	}
}
