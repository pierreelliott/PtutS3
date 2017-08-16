<?php

namespace App\Frontend\Modules\Administration;

use \LibPtut\Controller;
use \LibPtut\HTTPRequest;
use \LibPtut\HTTPResponse;
use \LibPtut\HTTPException;

class AdministrationController extends Controller
{
    public function executeIndex(HTTPRequest $request)
    {
        $user = $this->app->getUser();

        if(!$user->isAuthenticated() or !$user->getAttribute('typeUser') == 'ADMIN')
		{
            throw new HTTPException('404');
        }

		// On teste la présence des variables POST
		if
		(
			$request->request->has('numProduit') and $request->request->has('libelle') and
			$request->request->has('typeProduit') and $request->request->has('prix') and $request->request->has('description')
		)
		{
			// Upload de l'image
			$imageProduit = null;

			if(isset($_FILES['image']) AND $_FILES['image']['error'] == 0)
			{
				// On upload le fichier image s'il existe
				if ($_FILES['image']['size'] <= 1000000)
				{

					$infosfichier = pathinfo($_FILES['image']['name']);
					$extension_upload = $infosfichier['extension'];
					$extensions_autorisees = array('jpg', 'jpeg', 'png');
					if (in_array($extension_upload, $extensions_autorisees))
					{
						move_uploaded_file($_FILES['image']['tmp_name'], 'src/img/'.basename($_FILES['image']['name']));
						$imageProduit = 'src/img/'.basename($_FILES['image']['name']);
					}
				}
			}

			// On évite les failles XSS
			$numProduit = htmlspecialchars($request->request->get('numProduit'));
			$libelle = htmlspecialchars($request->request->get('libelle'));
			$typeProduit = htmlspecialchars($request->request->get('typeProduit'));
			$prix = htmlspecialchars($request->request->get('prix'));
			$description = htmlspecialchars($request->request->get('description'));

			$produitMenu = array();
			$produitMenuQte = array();

			// On récupère les produits à ajouter dans le nouveau menu (si les tableaux sont vides c'est que l'on n'a pas ajouter un menu mais un produit seul)
			if($request->request->has('lastNumProduit'))
			{
				for($i = 0; $i <= $request->request->get('lastNumProduit'); $i++)
				{
					if($request->request->has('produitMenu'.$i) and $request->request->has('produitMenuQte'.$i))
					{
						$produitMenu[$i] = $request->request->get('produitMenu'.$i);
						$produitMenuQte[$i] = $request->request->get('produitMenuQte'.$i);
					}
				}
			}

			switch($request->query->get('action'))
			{
				case 'add' :
					$this->produit->ajouterProduit($libelle, $description, $typeProduit, $prix, $imageProduit, $imageProduit, $imageProduit, $produitMenu, $produitMenuQte);
					HTTPResponse::create()->redirect('/administration');
				break;

				case 'edit' :
					$this->produit->modifierProduit($numProduit, $libelle, $description , $typeProduit, $prix, $imageProduit, $imageProduit, $imageProduit, $produitMenu, $produitMenuQte);
					HTTPResponse::create()->redirect('/administration');
				break;

				case 'delete' :
					$this->produit->supprimerProduit($numProduit);
					HTTPResponse::create()->redirect('/administration');
				break;
			}
		}
        // ========================= Récupération des données pour les avis =========================================

        // On récupère tous les avis signalés
        $tousAvisBD = $this->managers->getManagerOf('Advice')->getAllReportedAdvices();
        $tousAvis = array();
        if($tousAvisBD != false)
        {
            foreach ($tousAvisBD as $avisBD)
            {
                // Création d'un tableau pour stocker toutes les informations d'un avis + remplissage
                $avis = array(
                    'avis' => $avisBD['avis'],
                    'note' => $avisBD['note'],
                    'date'  => $avisBD['date'],
                    'numuser' =>  $avisBD['numAvis'],
                    'pseudo' => $this->managers->getManagerOf('User')->getInfos($avisBD['numAvis'])['pseudo'],
                    'estCommente' => isset($avisBD['avis'])
                );

                // Ajout d'un tableau en 2 dimensions avec toutes les données
                $tousAvis[$avisBD['numAvis']] = $avis;
            }
        }
        else
        {
            $tousAvis = false;
        }

        $productManager = $this->managers->getManagerOf('Product');
		$typesProduit = $productManager->getProductTypes(); // Utilisé dans la vue
		$produits = $productManager->getMenuCard();

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

			// On teste le type du produit pour savoir si c'est un menu
			if($productManager->isMenu($produit['numProduit']))
			{
				// Si le produit est un menu, on l'enlève de la carte
				unset($produits[$keyMenu]);

				// On récupère les informations du menu (libellé, description, prix)
				$menus[$keyMenu] = $productManager->getProductInformations($produit['numProduit']);

				// On récupère les numéros des produits compatibles du menu (donc les produits contenus dans le menu)
				$produitCompatibles = $productManager->getCompatibleProducts($produit['numProduit']); // C'est un tableau des numProduits2

				// Pour chaque numProduit compatible, on récupère les informations du produit
				foreach($produitCompatibles as $keyProduit => $produitCompatible)
				{
					$menus[$keyMenu]['produits'][$keyProduit] = $productManager->getProductInformations($produitCompatible['numProduit2']);
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

        return $this->renderView(null, array(
            'title' => 'Administration',
            'admin' => true, // L'affichage des produits se modifie en fonction de la carte ou de l'administration
            'produits' => $produits,
            'menus' => $menus,
            'tousAvis' => $tousAvis,
        ), array(
            'administration.js'
        ));
    }

    public function executeProductsAdmin(HTTPRequest $request)
    {
        if(!$request->isXmlHttpRequest())
		{
            throw new HTTPException('404');
        }

        $productManager = $this->managers->getManagerOf('Product');

		// Si on veut récupérer les infos d'un produit en particulier
		if($request->request->has('numProduitAdmin'))
		{
			$produit = $productManager->getProductInformations($request->request->get('numProduitAdmin'));
			$typeProduit = $productManager->getTypeProduit($_POST['numProduitAdmin']);

			if($productManager->isMenu($request->request->get('numProduitAdmin')))
			{
				$produitsCompatibles = $productManager->getCompatibleProducts($request->request->get('numProduitAdmin'));

				foreach($produitsCompatibles as $keyProduit => $produitCompatible)
				{
					$produit['produits'][$keyProduit] = $productManager->getProductInformations($produitCompatible['numProduit2']);
				}
			}

			return new HTTPResponse(json_encode($produit));
		}
		// Si on veut récupérer les infos de tous les produits
		else
		{
			$produits = $productManager->getMenuCard();
			foreach($produits as $key => $produit)
			{
                // On enlève le produit si il n'est plus disponible
				if($produit['prix'] < 0)
				{
					unset($produits[$key]);
					continue;
				}

                // Si c'est un menu on l'enleve
				if($productManager->isMenu($produit['numProduit']))
				{
					unset($produits[$key]);
				}
			}

			// On défragmente le tableau pour avoir des index qui se suivent
			$produits = array_values($produits);

			return new HTTPResponse(json_encode($produits));
		}
    }

    public function executeSearchPseudo(HTTPRequest $request)
    {
		$pseudos = $this->managers->getManagerOf('User')->getPseudosList($request->request('input'));

		return new HTTPResponse(json_encode($pseudos));
    }

    public function executeEditAdmin(HTTPRequest $request)
    {
        if($request->request->has('pseudoAdmin') && $request->request->has('typeUser'))
		{
            $userManager = $this->managers->getManagerOf('User');
			switch($request->request->get('typeUser'))
			{
				case 'admin' :
					$userManager->addAdmin($request->request->get('pseudoAdmin'));
				break;

				case 'user' :
					$userManager->deleteAdmin($request->request->get('pseudoAdmin'));
				break;
			}
		}

		HTTPResponse::create()->redirect('/administration');
    }

    public function executeDeleteComment(HTTPRequest $request)
    {
        $user = $this->app->getUser();
        // On vérifie que l'utilisateur soit connecté et que c'est un administrateur
        if($user->isAuthenticated() and $user->getAttribute('typeUser') == 'ADMIN')
        {
            // On teste que le numAvis existe
            if($request->request->has('numAvis'))
            {
                $adviceManager = $this->managers->getManagerOf('Advice');
                // Supression des commentaires
                $adviceManager->deleteComment($request->request->get('numAvis'));

                // Supression des signalements relatifs à cet avis et on stocke le resultat de la suppression
                $retour = $adviceManager->deleteReports($request->request->get('numAvis'));
            }
        }

        HTTPResponse::create()->redirect('/administration');
    }

    public function executeEditComment(HTTPRequest $request)
    {
        $user = $this->app->getUser();
        // On vérifie que l'utilisateur soit connecté et que c'est un administrateur
        if($user->isAuthenticated() and $user->getAttribute('typeUser') == 'ADMIN')
        {
            // On teste que les valeurs sont passesé en paramètres
            if($request->request->has('numAvis') && $request->request->has('commentaire'))
            {
                $adviceManager = $this->managers->getManagerOf('Advice');
                $adviceManager->editComment($request->request->get('numAvis'), $request->request->get('commentaire'));

                // Supression des signalements relatif a cet avis et on stocke le resultat de la suppression
                $retour = $adviceManager->deleteReports($request->request->get('numAvis'));
            }
        }

        HTTPResponse::create()->redirect('/administration');
    }

    public function executeEditPaypalParameters(HTTPRequest $request)
    {
        if($request->request->has('userPaypal') and $request->request->has('mdpPaypal') and $request->request->has('signaturePaypal'))
		{
			$config = $this->app->getConfig();

            if($request->request->get('userPaypal') != '') {
                $config->set('paypaluser', $request->request->get('userPaypal'));
            }
            if($request->request->get('mdpPaypal') != '') {
                $config->set('paypalmdp', $request->request->get('mdpPaypal'));
            }
            if($request->request->get('signaturePaypal') != '') {
                $config->set('paypalsignature', $request->request->get('signaturePaypal'));
            }
		}

		HTTPResponse::create()->redirect('/administration');
    }

    public function executeReports()
    {
        // On teste qu'il y a eu un appel ajax
        if(!$request->isXmlHttpRequest())
        {
            throw new HTTPException('404');
        }

        // On récupère les signalements
        $signalements = $this->managers->getManagerOf('Advice')->getReports($request->request->get('numAvis'));

        // On passe le tableau en tableau à index numériques
        $signalements = array_values($signalements);

        //On encode les données en JSON recuperable en JavaScript
        return new HTTPResponse(json_encode($signalements));
    }
}
