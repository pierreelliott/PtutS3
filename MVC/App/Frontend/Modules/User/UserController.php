<?php

namespace App\Frontend\Modules\User;

use \LibPtut\Controller;
use \LibPtut\HTTPRequest;
use \LibPtut\HTTPResponse;
use \LibPtut\HTTPException;

class UserController extends Controller
{
	public function executeIndex(HTTPRequest $request)
	{
		$user = $this->app->getUser();

		if(!$user->isAuthenticated())
		{
			HTTPResponse::create()->redirect('/connection-request');
		}

		return $this->renderView(null, array(
			'title' => 'Mon compte',
			'numUser' => $user->getAttribute('numUser'),
			'pseudo' => $user->getAttribute('pseudo'),
			'nom' => $user->getAttribute('nom'),
			'prenom' => $user->getAttribute('prenom'),
			'typeUser' => $user->getAttribute('typeUser'),
			'dateInscription' => $user->getAttribute('dateInscription'),
			'mail' => $user->getAttribute('mail'),
			'telephone' => $user->getAttribute('telephone'),
			'numRue' => $user->getAttribute('numRue'),
			'rue' => $user->getAttribute('rue'),
			'codePostal' => $user->getAttribute('codePostal'),
			'ville' => $user->getAttribute('ville')
		), array(
			'utilisateur.js'
		));
	}

	public function executeConnectionRequest(HTTPRequest $request)
	{
		return $this->renderView(null, array(
			'title' => 'Connexion nécessaire'
		));
	}

	public function executeRegistration(HTTPRequest $request)
	{
		if($request->getMethod() == 'POST')
        {
            $inscriptionValide = true;
			$message = '';

            // On vérifie que l'utilisateur a entré quelque chose
            if
			(
				$_POST['pseudo'] == '' or $_POST['mdp'] == '' or $_POST['mdpConfirm'] == '' or
                $_POST['nom'] == '' or $_POST['prenom'] == '' or
                $_POST['email'] == '' or $_POST['tel'] == ''
			)
            {
                $message = 'Un ou plusieurs champs obligatoires ne sont pas remplis';
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
                $message = 'Les deux mots de passe ne sont pas identiques. Veuillez ressaisir votre mot de passe';
                $inscriptionValide = false;
            }

            // On vérifie que l'email a une forme valide
            if(!preg_match('#[a-zA-Z0-9]+@[a-zA-Z]{2,}.[a-z]{2,4}#', $email))
            {
                $message = 'L\'adresse email doit avoir une forme valide';
                $inscriptionValide = false;
            }

            // On vérifie que le téléphone contient bien 10 chiffres
            if(!preg_match('#^0[1-9]([-. ]?[0-9]{2}){4}$#', $tel))
            {
                $message = 'Le numéro de téléphone doit avoir une forme valide';
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

				HTTPResponse::create()->redirect('/');
            }

			return $this->renderView(null, array(
				'message' => $message
			));
        }
	}

	public function executeConnection(HTTPRequest $request)
	{
		if($request->getMethod() == 'POST')
        {
			$user = $this->app->getUser();
            $pseudo = htmlspecialchars($request->request->get('pseudo'));
            $mdpHash = sha1($request->request->get('mdp'));

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

                HTTPResponse::create()->redirect('/');
            }
            else
            {
                $message = 'Pseudo ou mot de passe incorrects';
            }
        }

		return $this->renderView(null, array(
			'title' => 'Se connecter'
		));
	}

	public function executeDisconnection(HTTPRequest $request)
	{
		// Suppression des variables de session et de la session
		$_SESSION = array();
		session_destroy();

		// Suppression des cookies de connexion automatique
		//setcookie('pseudo', '');
		//setcookie('mdpHash', '');

		HTTPResponse::create()->redirect('/');
	}

	public function executeAdvice(HTTPRequest $request)
	{
		$user = $this->app->getUser();
		$adviceManager = $this->managers->getManagerOf('Advice');
		$userAdvice = null;
		$message = null;
		//Si l'utilisateur est connecté
		if($user->isAuthenticated())
		{
			// Teste si l'utilisateur a un avis
			$userAdvice = $adviceManager->getAdvice($user->getAttribute('numUser'));
		}
		else
		{
			$message = 'Vous devez vous connecter pour poster un avis';
		}

		$allAdvicesDB = $adviceManager->getAllAdvices();

		// Création du tableau qui va contenir tous les avis
		$allAdvices = array();

		foreach ($allAdvicesDB as $keyAdvice => $adviceDB) {

			// Création d'un tableau pour stocker toutes les informations d'un avis + remplissage
			$advice = array(
				'avis' => $adviceDB['avis'],
				'note' => $adviceDB['note'],
				'date'  => $adviceDB['date'],
				'numuser' =>  $adviceDB['numUser'],
				'pouceBleu' =>  $adviceManager->getPositiveVotes($adviceDB['numUser']),
				'pouceRouge' => $adviceManager->getNegativeVotes($adviceDB['numUser']),
				'pseudo' => $this->managers->getManagerOf('User')->getInfos($adviceDB['numUser'])['pseudo'],
				'estCommente' => isset($adviceDB['avis'])
			);
			// Ajout d'un tableau en 2 dimensions avec toutes les données
			$allAdvices[$keyAdvice] = $advice;
			// Pour permettre l'affichage des caractères comme '\n' en balise <br> (ça cause des problèmes donc je mets ça en commmentaire en attendant)
			// $allAdvices[$keyAdvice]['avis'] = nl2br($allAdvices[$keyAdvice]['avis']);
		}

		return $this->renderView(null, array(
			'title' => 'Avis des utilisateurs du site',
			'userAvis' => $userAdvice,
			'tousAvis' => $allAdvices,
			'message' => $message
		), array(
			'notes.js',
			'avis.js',
			'afficheNote.js'
		));
	}

	public function executeAddAdvice(HTTPRequest $request)
	{
		$erreur = null;

		// Si l'utilisateur a posté quelque chose
		if($request->getMethod() == 'POST')
		{
			// On récupère le pseudo
			$userNo = $this->app->getUser()->getAttribute('numUser');

			// On enlève les espaces inutiles du commentaire
			$comment = trim($request->request->get('commentaire'));

			$adviceManager = $this->managers->getManagerOf('Advice');

			// Si l'utilisateur a déjà un avis
			if($adviceManager->getAdvice($userNo) != false)
			{
				// Modification de l'avis
				$adviceManager->editAdvice($request->request->get('commentaire'), $userNo, $request->request->get('note'));
			}
			else
			{
				// Ajout de l'avis
				$adviceManager->addAdvice($request->request->get('commentaire'), $userNo, $request->request->get('note'));
			}
		}
		else
		{
			$erreur = 'Vous n\'avez rien rempli';
		}

		HTTPResponse::create()->redirect('/advice');
	}

	public function executeVote(HTTPRequest $request)
	{
		$user = $this->app->getUser();
		// Teste si on a toutes les variables
		if($request->query->has('pouce') && $request->query->has('numAvis') && $user->isAuthenticated())
		{
			$adviceManager = $this->managers->getManagerOf('Advice');
			// On test si l'utilisateur n'a pas déjà voté pour cet avis
			$vote = $adviceManager->hasVoted($request->query->get('numAvis'), $user->getAttribute('numUser'));
			if($vote == -1)
			{
				// Si il n'en a pas on ajoute le vote
				$resultat = $adviceManager->addVote($request->query->get('numAvis'), $request->query->get('pouce'), $user->getAttribute('numUser'));

				// Si il vote pour un avis qui n'a pas de commentaire
				if($resultat == false)
				{
					$erreur = 'Vous ne pouvez voter pour cet avis car il n\'a pas de commentaire';
				}
			}
			// S'il en a déjà un
			else {
				// Si c'est le même vote
				if($vote == $request->query->get('pouce'))
				{
					$adviceManager->deleteVote($request->query->get('numAvis'), $user->getAttribute('numUser'));
				}
				else
				{
					// Si ce n'est pas le même on modifie le vote
					$adviceManager->editVote($request->query->get('numAvis'), $request->query->get('pouce'), $user->getAttribute('numUser'));
				}
			}
		}

		HTTPResponse::create()->redirect('/advice');
	}

	public function executeReport(HTTPRequest $request)
	{
		$user = $this->app->getUser();
		// Teste si on a toutes les variables
		if($request->getMethod() == 'POST' && $user->isAuthenticated())
		{
			$adviceManager = $this->managers->getManagerOf('Advice');
			// On recupere le commentaire de l'avis signale
			$advice = $adviceManager->getAdvice($user->getAttribute('numUser'));
			// On test qu'il n'est pas null
			if(trim($advice['avis']) == '')
			{
				 $doublon = $adviceManager->reportAdvice($request->request->get('numAvis'), $user->getAttribute('numUser'), $request->request->get('remarque'));
				 // Si l'utillisateur a déjà signalé l'avis
				 echo json_encode($doublon);
			}
		}

		HTTPResponse::create()->redirect('/advice');
	}

	public function executeFavoriteProducts(HTTPRequest $request)
	{
		$user = $this->app->getUser();

		if(!$user->isAuthenticated())
		{
			throw new HTTPException('404');
		}

		// Contient tous les produits favoris avec tous les détails
		$favoriteProducts = $this->managers->getManagerOf('User')->getFavoriteProducts($user->getAttribute('numUser'));

		foreach ($favoriteProducts as $key => $product) {
			$partie = explode('.', $product['typeProduit']);
			$favoriteProducts[$key]['estMenu'] = (strcmp( $partie[0] , 'menu') == 0);

			$prod = $this->managers->getManagerOf('Product')->getProductInformations($product['numProduit']);
			$favoriteProducts[$key]['sourcePetit'] = $prod['sourcePetit'];
			$favoriteProducts[$key]['sourceMoyen'] = $prod['sourceMoyen'];
			$favoriteProducts[$key]['sourceGrand'] = $prod['sourceGrand'];
		}

		// Booléen pour savoir si $favoriteProducts est vide
		$estVide = (count($favoriteProducts) == 0);

		return $this->renderView(null, array(
			'title' => 'Produits Favoris',
			'estVide' => $estVide,
			'produitsFav' => $favoriteProducts
		), array(
			'carte.js'
		));
	}

	public function executeEditFavoriteProducts(HTTPRequest $request)
	{
		$user = $this->app->getUser();

		if(!$user->isAuthenticated())
		{
			throw new HTTPException('404');
		}

		$prodNo = $request->query->get('numProduit');
		$userManager = $this->managers->getManagerOf('User');

		// Teste si le produit est un produit favoris
		if(!$userManager->isFavorite($user->getAttribute('numUser'), $prodNo))
		{
			$userManager->addFavoriteProduct($user->getAttribute('numUser'), $prodNo);
		}
		else
		{
			$userManager->deleteFavoriteProduct($user->getAttribute('numUser'), $prodNo);
		}

		HTTPResponse::create()->redirect('/menu');
	}

	public function executeEditPassword(HTTPRequest $request)
	{
		if
		(
			$request->request->has('userNo') and $request->request->has('oldMdp') and
			$request->request->has('newMdp') and $request->request->has('confirmNewMdp')
		)
		{
			$userNo = $request->request->get('userNo');
			$oldMdp = sha1($request->request->get('oldMdp'));
			$newMdp = $request->request->get('newMdp');
			$confirmNewMdp = $request->request->get('confirmNewMdp');

			$userManager = $this->managers->getManagerOf('User');

			// On récupère le mot de passe
			$checkMdp = $userManager->getInfos($userNo)['mdp'];

			if($checkMdp == $oldMdp && $newMdp == $confirmNewMdp)
			{
				$userManager->setUserInfos($userNo, array('mdp' => sha1($newMdp)));
			}
		}

		HTTPResponse::create()->redirect('/user');
	}

	public function executeEditPseudo(HTTPRequest $request)
	{
		if($request->request->has('pseudo') && $request->request->has('numUser'))
		{
			$newPseudo = htmlspecialchars($request->request->get('pseudo'));

			$userManager = $this->managers->getManagerOf('User');

			if(!$userManager->checkDuplicate($newPseudo))
			{
				$userManager->setUserInfos($request->request->get('numUser'), array('pseudo' => $newPseudo));
			}
		}

		HTTPResponse::create()->redirect('/user');
	}
}
