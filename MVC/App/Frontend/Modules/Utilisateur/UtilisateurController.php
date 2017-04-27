<?php

namespace App\Frontend\Modules\Utilisateur;

use \LibPtut\Controller;
use \LibPtut\HTTPRequest;

class UtilisateurController extends Controller
{
	function executeIndex(HTTPRequest $request)
	{
		$user = $this->app->getUser();

		if($user->isAuthenticated())
		{
			$this->page->addVar('numUser', $user->getAttribute('numUsesr'));
			$this->page->addVar('pseudo', $user->getAttribute('pseudo'));
			$this->page->addVar('nom', $user->getAttribute('nom'));
			$this->page->addVar('prenom', $user->getAttribute('prenom'));
			$this->page->addVar('typeUser', $user->getAttribute('typeUser'));
			$this->page->addVar('dateInscription', $user->getAttribute('dateInscription'));
			$this->page->addVar('mail', $user->getAttribute('mail'));
			$this->page->addVar('telephone', $user->getAttribute('telephone'));
			$this->page->addVar('numRue', $user->getAttribute('numRue'));
			$this->page->addVar('rue', $user->getAttribute('rue'));
			$this->page->addVar('codePostal', $user->getAttribute('codePostal'));
			$this->page->addVar('ville', $user->getAttribute('ville'));
		}
		else
		{
			$this->app->getHttpResponse()->redirect('/connection-request');
		}

		$this->page->addVar('title', 'Mon compte');
	}

	function executeConnectionRequest(HTTPRequest $request)
	{
		$this->page->addVar('title', 'Connexion nécessaire');
	}

	function executeConnection(HTTPRequest $request)
	{
		if($request->getMethod() == 'POST')
        {
			$user = $this->app->getUser();

            $pseudo = htmlspecialchars($_POST["pseudo"]);
            $mdpHash = sha1($_POST["mdp"]);

			// $resultat contient un tableau dont chaque élément est une ligne renvoyée sous forme de tableau
			// $resultat est donc une matrice ne contenant qu'une ligne
            $resultat = $this->managers->getManagerOf('User')->connect($pseudo, $mdpHash);
			print_r($resultat);

            // Si la connexion a réussi (le tableau $resultat n'est pas vide)
            if(!empty($resultat))
            {
				$user->setAuthenticated(true);
				foreach($resultat as $attr => $value)
				{
					$user->setAttribute($attr, $value);
				}

                // Si l'utilisateur coche la case de connexion automatique
                /*if(isset($_POST["connAuto"]))
                {
                    setcookie("pseudo", $pseudo);
                    setcookie("mdpHash", $mdpHash);
                }*/

                $this->app->getHttpResponse()->redirect('/');
            }
            else
            {
                $user->setFlash('Pseudo ou mot de passe incorrects');
            }
        }

		$this->page->addVar('title', 'Se connecter');
	}
}
