<?php

namespace App\Frontend\Modules\Payment;

use \LibPtut\Controller;
use \LibPtut\HTTPRequest;

class PaymentController extends Controller
{
    public function executeCommands(HTTPRequest $request)
    {
        /*
        Creation d'un tableau 2 dimension contenant
        toutes les commandes avec 2 colonnes en plus: prix et
        nbProduits
        1er dimension contient le nbCommande
        2ème les differentes colonne de la requete sql
        */
        $commandes = array();

        //On recupere les commandes dans la base de données
		$data = $this->managers->getManagerOf('Command')->getCommands($this->app->getUser()->getAttribute('numUser'));

        foreach ($data as $d)
        {
            $com = array(
                'date'          => $d['date'],
                'typeCommande'  => $d['typeCommande'],
                'numCommande'   => $d['numCommande'],
                'prix'          => $this->bdCommande->getPrixTotalCommande($d['numCommande']),
                'nbProduits'    => $this->bdCommande->getNbProduit($d['numCommande'])
            );

            // Ajout de la commande dans le tableau final
            $commandes[$com['numCommande']] = $com;
        }

		$this->page->addVars(array(
            'title' => 'Historique des commandes',
            'commandes' => $commandes,
            'estVide' => (count($commandes) == 0)
        ));
    }

    public function executeCommand(HTTPRequest $request)
    {
        $commandManager = $this->managers->getManagerOf('Command');

        // Si la commande lui appartient
        if($commandManager->isCommandOf($request->query->get('commandNo'), $this->app->getUser()->getAttribute('pseudo')))
        {
            $commande = $commandManager->getCommand($request->query->get('commandNo'));

            // Tester la valeur de retour de la fonction getInfos Commande
			if($commande)
			{
                $dateCommande = null;

                foreach($commande as $res)
                {
                    $dateCommande = $res['date'];
                }

    			$prixCommande = $commandManager->getCommandPrice($request->query->get('commandNo'));

                $produits = array();

                // Pour chaque produit dans la commande
				foreach($commande as $prod)
				{
					$p = $this->managers->getManagerOf('Product')->getProductInformations($prod['numProduit']);

					$partie = explode('.', $p['typeProduit']);

					$produit = array(
						'numProduit' => $p['numProduit'],
						'libelle' => $p['libelle'],
						'description' => $p['description'],
						'quantite' => $prod['quantite'],
						'prix' => $p['prix'],
						'prixTotal' => $p['prix']* $prod['quantite'],
						'sourcePetit' => $p['sourcePetit'],
						'sourceMoyen' => $p['sourceMoyen'],
						'sourceGrand' => $p['sourceGrand'],
						'estMenu' => (strcmp( $partie[0] , 'menu') == 0)
					);
                    // Ajout d'un tableau en 2 dimensions avec toutes les donnees
					$produits[$prod['numProduit']] = $produit;
				}

				$this->page->addVars(array(
                    'title' => 'Commande du '.$dateCommande,
                    'dateCommande' => $dateCommande,
                    'prixCommande' => $prixCommande,
                    'produits' => $produits
                ));
			}
        }
		else
		{
			$this->app->getHttpResponse()->redirect404();
		}
    }
}
