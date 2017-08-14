<?php

namespace App\Frontend\Modules\Payment;

use \LibPtut\Controller;
use \LibPtut\HTTPRequest;
use \LibPtut\HTTPResponse;
use \LibPtut\HTTPException;

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
        $commandManager = $this->managers->getManagerOf('Command');

        //On recupere les commandes dans la base de données
		$data = $commandManager->getCommands($this->app->getUser()->getAttribute('numUser'));

        foreach ($data as $d)
        {
            $com = array(
                'date'          => $d['date'],
                'typeCommande'  => $d['typeCommande'],
                'numCommande'   => $d['numCommande'],
                'prix'          => $commandManager->getCommandPrice($d['numCommande']),
                'nbProduits'    => $commandManager->getNbProducts($d['numCommande'])
            );

            // Ajout de la commande dans le tableau final
            $commandes[$com['numCommande']] = $com;
        }

        return $this->renderView(null, array(
            'title' => 'Historique des commandes',
            'commandes' => $commandes,
            'estVide' => (count($commandes) == 0)
        ));
    }

    public function executeCommand(HTTPRequest $request)
    {
        $commandManager = $this->managers->getManagerOf('Command');

        // Si la commande ne lui appartient pas
        if(!$commandManager->isCommandOf($request->query->get('commandNo'), $this->app->getUser()->getAttribute('pseudo')))
        {
            throw new HTTPException('404');
		}

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

			return $this->renderView(null, array(
                'title' => 'Commande du '.$dateCommande,
                'dateCommande' => $dateCommande,
                'prixCommande' => $prixCommande,
                'produits' => $produits
            ));
		}
    }

    public function executeCommandRecap(HTTPRequest $request)
    {
        $produits = array();
        foreach($_SESSION['panier'] as $prod)
        {
            $p = $this->managers->getManagerOf('Product')->getProductInformations($prod['numProduit']);
            $produit = array(
                'numProduit' => $p['numProduit'],
                'libelle' => $p['libelle'],
                'description' => $p['description'],
                'quantite' => $prod['quantite'],
                'prix' => $p['prix'],
                'prixTotal' => $p['prix']* $prod['quantite'],
                'sourcePetit' => $p['sourcePetit'],
                'sourceMoyen' => $p['sourceMoyen'],
                'sourceGrand' => $p['sourceGrand']
            );
            $produits[$prod['numProduit']] = $produit;
        }
        $prixCommande = $_SESSION['prixPanier'];

        return $this->renderView(null, array(
            'title' => 'Récapitulatif de la commande',
            'produits' => $produits,
            'prixCommande' => $prixCommande
        ));
    }

    public function executePaypalPayment(HTTPRequest $request)
    {
        // Si un prix est passé en parametre
        if($request->request->has('prix'))
        {
            $prix = $request->request->get('prix');
            $requete = $this->buildUrl();

            if($request->request->get('typeCommande') == 'Livraison')
            {
                $typeCommande = 1;
            }
            else
            {
                $typeCommande = 0;
            }

            $siteUrl = '';
            switch($request->server('SERVER_NAME'))
            {
                case 'localhost' :
                    $siteUrl = '127.0.0.1/';
                break;
                case 'sushinoss.alwaysdata.net' :
                    $siteUrl = 'http://sushinoss.alwaysdata.net/';
                break;
                case 'ptut' :
                    $siteUrl = 'http://ptutobjet/';
                break;
                case 'ptutobjet' :
                    $siteUrl = 'http://ptut/';
                break;
                default :
                    $siteUrl = 'http://iutdoua-web.univ-lyon1.fr/~p1402690/';
            }

            // Ajout des paramètres variables
            $requete = $requete.'&METHOD=SetExpressCheckout'.
                                '&CANCELURL='.urlencode($siteUrl.'paypal-cancel').
                                '&RETURNURL='.urlencode($siteUrl.'paypal-return').
                                '&AMT='.$prix.
                                '&CURRENCYCODE=EUR'.
                                '&DESC='.urlencode('SUSHI').
                                '&LOCALECODE=FR';

            // Création d'une session cURL
            $ch = curl_init($requete);
            // Ignore le certificat SSL
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            // Permet de récupérer les données issues de la requête
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // Exécute la requête
            $resultat_paypal = curl_exec($ch);

            // On test si c'est bien paypal qui veut acceder à la page

            // Si elle n'a pas marché
            if (!$resultat_paypal)
            {
                // Affichage de l'erreur
                echo '<p>Erreur</p><p>'.curl_error($ch).'</p>';
            }
            // Sinon on effectue les traitements
            else
            {
                // On récupère les paramètres en les séparant puis on les stocke dans un tableau
                $parametres = $this->urlQueryToArray($resultat_paypal);

                // Si la requête a été traitée avec succès
                if ($parametres['ACK'] == 'Success')
                {
                    // Redirige le visiteur sur le site de PayPal
                    HTTPResponse::create()->redirect('https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token='.$parametres['TOKEN']);
                    exit();
                }
                else // En cas d'échec, affiche la première erreur trouvée.
                {
                    echo '<p>Erreur de communication avec le serveur PayPal.<br />'.$parametres['L_SHORTMESSAGE0'].'<br />'
                    .$parametres['L_LONGMESSAGE0'].'</p>';

                    echo "\n".$requete;

                    echo "\n".urlencode('http://127.0.0.1/retour-paypal');
                }
            }
            // Fermeture de la session
            curl_close($ch);
        }
    }

    public function executePaypalReturn(HTTPRequest $request)
    {
        /*if($_GET['typeCommande'] == 0)
        {
            $typeCommande = 'A Emporter';
        }
        else {
            $typeCommande = 'Livraison';
        }*/
        $typeCommande = 'A Emporter';
        $requete = $this->buildUrl();

        // Ajout des paramètres variables
        $requete = $requete.'&METHOD=DoExpressCheckoutPayment'.
                            // Ajoute le jeton qui nous a été renvoyé
                            '&TOKEN='.htmlentities($request->query('token'), ENT_QUOTES).
                            '&AMT='.$_SESSION['prixPanier'].
                            '&CURRENCYCODE=EUR'.
                            // Ajoute l'identifiant du paiement qui nous a également été renvoyé
                            '&PayerID='.htmlentities($request->query('PayerID'), ENT_QUOTES).
                            '&PAYMENTACTION=sale';

        // Initialise notre session cURL.
        $ch = curl_init($requete);

        // ignorer la vérification du certificat SSL.
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // Retourne directement le transfert sous forme de chaîne de la valeur retournée par curl_exec()
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // On lance l'exécution de la requête URL et on récupère le résultat dans une variable
        $resultat_paypal = curl_exec($ch);

        if (!$resultat_paypal) // S'il y a une erreur, on affiche 'Erreur', suivi du détail de l'erreur.
        {
            echo '<p>Erreur</p><p>'.curl_error($ch).'</p>';
        }
        // S'il s'est exécuté correctement, on effectue les traitements...
        else
        {
            // On récupère les paramètres en les séparant puis on les stocke dans un tableau
            $parametres = $this->urlQueryToArray($resultat_paypal);

            // Si la requête a été traitée avec succès
            if ($parametres['ACK'] == 'Success')
            {
                // Ajout du panier comme une commande
                $this->managers->getManagerOf('Command')->addCommand($this->app->getUser()->getAttribute('numUser'), $_SESSION['panier'], $typeCommande);
                // Vider Panier
                $this->managers->getManagerOf('Cart')->emptyCart();

                return $this->renderView('validatedCommand', array(
                    'title' => 'Commande validée'
                ));
            }
            else // En cas d'échec, affiche la première erreur trouvée.
            {
                echo '<p>Erreur de communication avec le serveur PayPal.<br />'.$parametres['L_SHORTMESSAGE0'].'<br />'
                .$parametres['L_LONGMESSAGE0'].'</p>';
            }
        }
        // On ferme notre session cURL.
        curl_close($ch);
    }

    public function executePaypalCancel(HTTPRequest $request)
    {
        return $this->renderView(null, array(
            'title' => 'Paiement annulé'
        ));
    }

    /* Pas utile si on ne stocke pas les données de la transaction
    public function traitementPaypal()
    {

        $requete = $this->paypal->construitURL();
        $requete = $requete.'&METHOD=GetExpressCheckoutDetails'.
                            '&TOKEN='.htmlentities($_GET['token'], ENT_QUOTES); // Ajoute le jeton

        $ch = curl_init($requete);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $resultat_paypal = curl_exec($ch);

        if (!$resultat_paypal) // S'il y a une erreur
        {
            echo '<p>Erreur</p><p>'.curl_error($ch).'</p>';
        }
        // S'il s'est exécuté correctement
        else
        {
            $liste_param_paypal = recup_param_paypal($resultat_paypal);

            // On affiche tous les paramètres afin d'avoir un aperçu global des valeurs exploitables (pour vos traitements). Une fois que votre page sera comme vous le voulez, supprimez ces 3 lignes. Les visiteurs n'auront aucune raison de voir ces valeurs s'afficher.
            echo '<pre>';
            print_r($liste_param_paypal);
            echo '</pre>';

            // Si la requête a été traitée avec succès

            // Mise à jour de la base de données & traitements divers... Exemple :
            mysql_query('INSERT INTO client(nom, prenom) VALUE(''.$liste_param_paypal['FIRSTNAME'].'', ''.$liste_param_paypal['LASTNAME'].'')');
        }
        curl_close($ch);
    }
    */

    private function buildUrl()
    {
        $paramsPaypal = $this->getAPIParameters();

        // Site de l'API Paypal
        $urlPaypal = 'https://api-3t.sandbox.paypal.com/nvp?';
        // Version de l'API de paypal
        $version = '204.0';
        // Concaténation pour avoir l'url de base
        $urlPaypal = $urlPaypal.'VERSION='.$version.'&USER='.$paramsPaypal['user'].'&PWD='.$paramsPaypal['mdp'].'&SIGNATURE='.$paramsPaypal['signature'];

        return $urlPaypal;
    }

    private function urlQueryToArray($query)
    {
        $params = explode('&', $query);

        foreach($params as $param)
        {
            // On récupère le nom du paramètre et sa valeur dans 2 variables différentes
            // Elles sont séparées par '='
            list($key, $value) = explode('=', $param);

            // On crée un tableau contenant le nom du paramètre comme identifiant et la valeur comme valeur
            // tout en décodant toutes les séquences %##  et les remplace par leur valeur
            $params[$key] = urldecode($value);
        }

        return $params;
    }

    private function getAPIParameters()
    {
        $paramsPaypal = array();

        // Compte Utilisateur du vendeur
        $paramsPaypal['user'] = $this->app->getConfig()->get('paypaluser');
        // Mot de passe pour acceder à l'API
        $paramsPaypal['mdp'] = $this->app->getConfig()->get('paypalmdp');
        // Signature de l'API
        $paramsPaypal['signature'] = $this->app->getConfig()->get('paypalsignature');

        return $paramsPaypal;
    }
}
