<?php

namespace App\Frontend\Modules\User;

use \LibPtut\Controller;
use \LibPtut\HTTPRequest;

class UserController extends Controller
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

	function executeRegistration(HTTPRequest $request)
	{
		if($request->getMethod() == 'POST')
        {
            $inscriptionValide = true;

            // On vérifie que l'utilisateur a entré quelque chose
            if
			(
				$_POST['pseudo'] == '' or $_POST['mdp'] == '' or $_POST['mdpConfirm'] == '' or
                $_POST['nom'] == '' or $_POST['prenom'] == '' or
                $_POST['email'] == '' or $_POST['tel'] == ''
			)
            {
                $this->page->addVar('message', 'Un ou plusieurs champs obligatoires ne sont pas remplis');
                $inscriptionValide = false;
            }

            $pseudo = htmlspecialchars($_POST['pseudo']);
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST['email']);
            $tel = htmlspecialchars($_POST['tel']);
            $rue = htmlspecialchars($_POST['rue']);
            $ville = htmlspecialchars($_POST['ville']);
            $codePostal = htmlspecialchars($_POST['codePostal']);

            /*$resultat = $this->bdd->getPseudo($pseudo);

            // On vérifie que le pseudo est libre (la requête ne renvoie pas de résultat)
            if($resultat->rowCount() != 0)
            {
                $message = 'Ce pseudo n\'est pas libre.<br>';
                $inscriptionValide = false;
            }*/

            // On vérifie que les deux mots de passe sont identiques
            if($_POST['mdp'] != $_POST['mdpConfirm'])
            {
                $this->page->addVar('message', 'Les deux mots de passe ne sont pas identiques. Veuillez ressaisir votre mot de passe');
                $inscriptionValide = false;
            }

            // On vérifie que l'email a une forme valide
            if(!preg_match('#[a-zA-Z0-9]+@[a-zA-Z]{2,}.[a-z]{2,4}#', $email))
            {
                $this->page->addVar('message', 'L\'adresse email doit avoir une forme valide');
                $inscriptionValide = false;
            }

            // On vérifie que le téléphone contient bien 10 chiffres
            if(!preg_match('#^0[1-9]([-. ]?[0-9]{2}){4}$#', $tel))
            {
                $this->page->addVar('message', 'Le numéro de téléphone doit avoir une forme valide');
                $inscriptionValide = false;
            }
			
            // Si les données de l'inscription sont valides on fait l'inscription
            if($inscriptionValide)
            {
				$user = $this->app->getUser();
                $mdpHash = sha1($_POST['mdp']);
                $this->managers->getManagerOf('User')->register($pseudo, $mdpHash, $nom, $prenom, $email, $tel, $_POST['numRue'], $rue, $ville, $codePostal);

				$resultat = $this->managers->getManagerOf('User')->connect($pseudo, $mdpHash);

				$user->setAuthenticated();
				foreach($resultat as $attr => $value)
				{
					$user->setAttribute($attr, $value);
				}

				$this->app->getHttpResponse()->redirect('/');
            }
        }
	}

	function executeConnection(HTTPRequest $request)
	{
		if($request->getMethod() == 'POST')
        {
			$user = $this->app->getUser();

            $pseudo = htmlspecialchars($request->postData('pseudo'));
            $mdpHash = sha1($request->postData('mdp'));

			// $resultat contient un tableau dont chaque élément est une ligne renvoyée sous forme de tableau
			// $resultat est donc une matrice ne contenant qu'une ligne
            $resultat = $this->managers->getManagerOf('User')->connect($pseudo, $mdpHash);

            // Si la connexion a réussi (le tableau $resultat n'est pas vide)
            if(!empty($resultat))
            {
				$user->setAuthenticated();
				foreach($resultat as $attr => $value)
				{
					$user->setAttribute($attr, $value);
				}

                // Si l'utilisateur coche la case de connexion automatique
                /*if(isset($_POST['connAuto']))
                {
                    setcookie('pseudo', $pseudo);
                    setcookie('mdpHash', $mdpHash);
                }*/

                $this->app->getHttpResponse()->redirect('/');
            }
            else
            {
                $message = 'Pseudo ou mot de passe incorrects';
            }
        }

		$this->page->addVar('title', 'Se connecter');
	}

	function executeDisconnection(HTTPRequest $request)
	{
		// Suppression des variables de session et de la session
		$_SESSION = array();
		session_destroy();

		// Suppression des cookies de connexion automatique
		//setcookie('pseudo', '');
		//setcookie('mdpHash', '');

		header('Location: /');
	}
}
