<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    include_once('modele/PaypalManager.php');
    include_once('modele/CommandeManager.php');
    include_once('modele/PanierManager.php');

    class PaypalControleur
    {
        public $paypal, $commande, $panier, $urlSite;

        public function __construct()
        {
            $this->paypal = new PaypalManager();
            $this->commande = new CommandeManager();
            $this->panier = new PanierManager();

            $this->setUrlSite();
        }

        //Determine l'url en fonction de la ou est hebergé le site
        public function setUrlSite()
        {
            if($_SERVER["SERVER_NAME"] == "localhost")
            {
                 $this->urlSite = "127.0.0.1/";
            }
            else if($_SERVER["SERVER_NAME"] == "sushinoss.alwaysdata.net")
            {
                 $this->urlSite = "http://sushinoss.alwaysdata.net/";
            }
            elseif ( $_SERVER["SERVER_NAME"] == "ptut") {
                 $this->urlSite = "http://ptut/";
            }
            else
        	{
        		$this->urlSite = "http://iutdoua-web.univ-lyon1.fr/~p1402690/";
        	}
        }

        //Redirige l'utilisateur sur le site de paypal pour payer
        public function paiementPaypal()
        {
            //Si un prix est passé en parametre
            if(isset($_POST["prix"]))
            {
                $prix = $_POST["prix"];
                $requete = $this->paypal->construitURL();
                $typeCommande = null;
                if($_POST["typeCommande"] == "Livraison")
                {
                    $typeCommande = "Livraison";
                }
                else {
                    $typeCommande = "A Emporter";
                }
                //Ajout des parametres variables
                $requete = $requete."&METHOD=SetExpressCheckout".
                                    "&CANCELURL=".urlencode($this->urlSite."/annule-paypal").
                                    "&RETURNURL=".urlencode($this->urlSite."/retour-paypal").
                                    "&AMT=$prix".
                                    "&CURRENCYCODE=EUR".
                                    "&DESC=".urlencode("SUSHI").
                                    "&LOCALECODE=FR";

                //Creation d'une session cURL
                $ch = curl_init($requete);
                //Ignore le certificat SSL
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                //Permet de recuperer les données issus de la requete
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                //Execute la requete
                $resultat_paypal = curl_exec($ch);

                //On test si c'est bien paypal qui veut acceder a la page

                //Si elle n'a pas marché
                if (!$resultat_paypal)
                {
                    //Affichage de l'erreur
                    echo "<p>Erreur</p><p>".curl_error($ch)."</p>";
                }
                //Sinon on effectue les traitements
                else
                {
                    //Recupere les parametre en les séparant puis les stock dans un tableau
                    $liste_param = $this->paypal->separeParametres($resultat_paypal);
                    $parametres = $this->paypal->stockerParametre($liste_param);

                    // Si la requête a été traitée avec succès
                    if ($parametres['ACK'] == 'Success')
                    {
                        echo "string";
                        // Redirige le visiteur sur le site de PayPal
                        header("Location: https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=".$parametres['TOKEN']);
                        exit();
                    }
                    else // En cas d'échec, affiche la première erreur trouvée.
                    {
                        echo "<p>Erreur de communication avec le serveur PayPal.<br />".$parametres['L_SHORTMESSAGE0']."<br />"
                        .$parametres['L_LONGMESSAGE0']."</p>";

                        echo "\n".$requete;

                        echo "\n".urlencode("http://127.0.0.1/retour-paypal");
                    }
                }
                //Fermeture de la session
                curl_close($ch);
            }

        }

        //Valide la transaction paypal apres le paiemet ou le refus
        public function retourPaypal($typeCommande)
        {
            $requete = $this->paypal->construitURL();

           //Ajout des parametre variables
            $requete = $requete."&METHOD=DoExpressCheckoutPayment".
                                // Ajoute le jeton qui nous a été renvoyé
                                "&TOKEN=".htmlentities($_GET['token'], ENT_QUOTES).
                                "&AMT=".$_SESSION["prixPanier"].
                                "&CURRENCYCODE=EUR".
                                // Ajoute l'identifiant du paiement qui nous a également été renvoyé
                                "&PayerID=".htmlentities($_GET['PayerID'], ENT_QUOTES).
                                "&PAYMENTACTION=sale";

            // Initialise notre session cURL.
            $ch = curl_init($requete);

            // ignorer la vérification du certificat SSL.
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            // Retourne directement le transfert sous forme de chaîne de la valeur retournée par curl_exec()
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
                //Recupere les parametre en les séparant  puis les stock dans un tableau
                $liste_param = $this->paypal->separeParametres($resultat_paypal);
                $parametres = $this->paypal->stockerParametre($liste_param);

                // Si la requête a été traitée avec succès
                if ($parametres['ACK'] == 'Success')
                {
                    //Ajout du panier comme une commande
                    $this->commande->addCommande($_SESSION["utilisateur"]["pseudo"], $_SESSION["panier"], $typeCommande);
                    //Vider Panier
                    $this->panier->viderPanier();

                }
                else // En cas d'échec, affiche la première erreur trouvée.
                {
                    echo "<p>Erreur de communication avec le serveur PayPal.<br />".$parametres['L_SHORTMESSAGE0']."<br />"
                    .$parametres['L_LONGMESSAGE0']."</p>";
                }
            }
            // On ferme notre session cURL.
            curl_close($ch);
        }

        /* Pas utile si on ne stocke pas les données de la transaction
        public function traitementPaypal()
        {

            $requete = $this->paypal->construitURL();
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
        */
    }
?>
