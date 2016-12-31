<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    include_once('modele/PanierManager.php');

    //session_start();

    class panierControleur
    {
        public $paypal;

        public function __construct()
        {
            $this->paypal = new PaypalManager;
        }
        
        public function paiementPaypal()
        {
            include("fonction_api.php");
            $requete = $this->paypal->construitURL();
            $requete = $requete."&METHOD=SetExpressCheckout".
                                "&CANCELURL=".urlencode("http://127.0.0.1/index.php?page=annulePaypal").
                                "&RETURNURL=".urlencode("http://127.0.0.1/index.php?page=retourPaypal").
                                "&AMT=10.0".
                                "&CURRENCYCODE=EUR".
                                "&DESC=".urlencode("Magnifique oeuvre d'art (que mon fils de 3 ans a peint.)").
                                "&LOCALECODE=FR".
                                "&HDRIMG=".urlencode("http://www.siteduzero.com/Templates/images/designs/2/logo_sdz_fr.png");

            $ch = curl_init($requete);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $resultat_paypal = curl_exec($ch);

            if (!$resultat_paypal)
            {
                echo "<p>Erreur</p><p>".curl_error($ch)."</p>";
            }
            else
            {
                $liste_param_paypal = $this->paypal->recupParams($resultat_paypal); // Lance notre fonction qui dispatche le résultat obtenu en un array

                // Si la requête a été traitée avec succès
                if ($liste_param_paypal['ACK'] == 'Success')
                {
                    // Redirige le visiteur sur le site de PayPal
                    header("Location: https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=".$liste_param_paypal['TOKEN']);
                    exit();
                }
                else // En cas d'échec, affiche la première erreur trouvée.
                {
                    echo "<p>Erreur de communication avec le serveur PayPal.<br />".$liste_param_paypal['L_SHORTMESSAGE0']."<br />".$liste_param_paypal['L_LONGMESSAGE0']."</p>";
                }
            }
            curl_close($ch);
        }
        
        public function retourPaypal()
        {
            $requete = $this->paypal->construitURL(); // Construit les options de base

            // On ajoute le reste des options
            // La fonction urlencode permet d'encoder au format URL les espaces, slash, deux points, etc.)
            $requete = $requete."&METHOD=DoExpressCheckoutPayment".
                                "&TOKEN=".htmlentities($_GET['token'], ENT_QUOTES). // Ajoute le jeton qui nous a été renvoyé
                                "&AMT=10.0".
                                "&CURRENCYCODE=EUR".
                                "&PayerID=".htmlentities($_GET['PayerID'], ENT_QUOTES). // Ajoute l'identifiant du paiement qui nous a également été renvoyé
                                "&PAYMENTACTION=sale";

            // Initialise notre session cURL. On lui donne la requête à exécuter.
            $ch = curl_init($requete);

            // Modifie l'option CURLOPT_SSL_VERIFYPEER afin d'ignorer la vérification du certificat SSL. Si cette option est à 1, une erreur affichera que la vérification du certificat SSL a échoué, et rien ne sera retourné. 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            // Retourne directement le transfert sous forme de chaîne de la valeur retournée par curl_exec() au lieu de l'afficher directement. 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // On lance l'exécution de la requête URL et on récupère le résultat dans une variable
            $resultat_paypal = curl_exec($ch);

            if (!$resultat_paypal) // S'il y a une erreur, on affiche "Erreur", suivi du détail de l'erreur.
            {
                echo "<p>Erreur</p><p>".curl_error($ch)."</p>";
            }
            // S'il s'est exécuté correctement, on effectue les traitements...
            else
            {
                $liste_param_paypal = $this->paypal->recupParams($resultat_paypal); // Lance notre fonction qui dispatche le résultat obtenu en un array

                // On affiche tous les paramètres afin d'avoir un aperçu global des valeurs exploitables (pour vos traitements). Une fois que votre page sera comme vous le voulez, supprimez ces 3 lignes. Les visiteurs n'auront aucune raison de voir ces valeurs s'afficher.
                echo "<pre>";
                print_r($liste_param_paypal);
                echo "</pre>";

                // Si la requête a été traitée avec succès
                if ($liste_param_paypal['ACK'] == 'Success')
                {
                    echo "<h1>Youpii, le paiement a été effectué</h1>"; // On affiche la page avec les remerciements, et tout le tralala...
                    /*********************************************/
                    /* Faire la requête pour valider la commande */
                    /*********************************************/
                }
                else // En cas d'échec, affiche la première erreur trouvée.
                {
                    echo "<p>Erreur de communication avec le serveur PayPal.<br />".$liste_param_paypal['L_SHORTMESSAGE0']."<br />".$liste_param_paypal['L_LONGMESSAGE0']."</p>";
                }
            }
            // On ferme notre session cURL.
            curl_close($ch);
        }
        
        public function traitementPaypal()
        {
            include("fonction_api.php");
            $requete = construit_url_paypal();
            $requete = $requete."&METHOD=GetExpressCheckoutDetails".
                                "&TOKEN=".htmlentities($_GET['token'], ENT_QUOTES); // Ajoute le jeton

            $ch = curl_init($requete);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $resultat_paypal = curl_exec($ch);

            if (!$resultat_paypal) // S'il y a une erreur
            {
                echo "<p>Erreur</p><p>".curl_error($ch)."</p>";
            }
            // S'il s'est exécuté correctement
            else
            {
                $liste_param_paypal = recup_param_paypal($resultat_paypal);

                // On affiche tous les paramètres afin d'avoir un aperçu global des valeurs exploitables (pour vos traitements). Une fois que votre page sera comme vous le voulez, supprimez ces 3 lignes. Les visiteurs n'auront aucune raison de voir ces valeurs s'afficher.
                echo "<pre>";
                print_r($liste_param_paypal);
                echo "</pre>";

                // Si la requête a été traitée avec succès

                // Mise à jour de la base de données & traitements divers... Exemple :
                mysql_query("INSERT INTO client(nom, prenom) VALUE('".$liste_param_paypal['FIRSTNAME']."', '".$liste_param_paypal['LASTNAME']."')");
            }
            curl_close($ch);
        }
    }
?>