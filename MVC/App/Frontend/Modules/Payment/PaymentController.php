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
}
